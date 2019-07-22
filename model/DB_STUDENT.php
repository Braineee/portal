<?php
/*
 * USESD FOR HANDELING CONNECTIONS AND INTERACTION TO MSSQL DATABASE
 * Author: DAVID DANIEL
 * Last Edited: 25/10/2017
 * STILL "To Do"
*/
class DB_STUDENT {

    // Instantate the variables to hold query data
    private static $_instance = null;
    private $_pdo,
            $_query,
            $_error = false,
            $_results,
            $_count = 0,
            $_errormsg;

    // pseudo construct function to handle database connection
    public function __construct(){
        // get the instance of the new db;
            try{
                $this->_pdo = new PDO("sqlsrv:Server=" . Config::get('mssql_student/host') . ";Database=". Config::get('mssql_student/db'), Config::get('mssql_student/username'), Config::get('mssql_student/password'));
            }catch (PDOException $e){
                die($e->getMessage());
            }
        //}
    }

    /*
     * This function establish connection to the database
     * Parameter = null
     * function type = static
     * NB: this function calls on the DB object and calls the construct function to establish database connection
    */
    public static function getInstance(){
        // check if an instance previously exists
        if (!isset(self::$_instance)){
            self::$_instance = new DB_STUDENT();// no previous instance exists, callon the DB object and establish database connection
        }
        return self::$_instance;// Return the instance ("i.e connection to database") as a static
        //return $dbname."_";
    }

    /*
     * This function execute general SQL queries and statements
     * Parameter = $sql(string), $params(array)
     * function type = public
    */
    public function query($sql, $params = array()){
        $this->_error = false;// set the error variable to false, in case of a previously occured error // Prepare the SQL statement
        if($this->_query = $this->_pdo->prepare($sql)){
            $x = 1;
            //check to see if an array was passed
            if (count($params)){
                //if array exists, bind the values of the array to the SQL
                foreach ($params as $param){
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            // execute if the query execute successfully
           try{
              // $this->_query->execute();
               if ($this->_query->execute()){
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                }else {
                    //execute if an error occur
                    $this->_error = true;
                    $this->_errormsg = $this->_query->errorInfo();
                }
            }catch (Exception $e){
                die($e->getMessage());
            }
            // reture the this variable
            return $this;
        }
        return false;
    }

   /*
    * This function execute SQL statements such as DELETE and SELECT WHERE
    * Parameter = $action(string), $table(string), $params(array)
    * function type = public
   */
   public function action($action, $table, $where = array()){
       // check for the expected number of array data
       if (count($where) === 3){
           $operators = array('=', '<', '>', '<=', '>=', 'LIKE', 'like');// instantate the possible operators
           $field    = $where[0];// pass the name of the field
           $operator = $where[1];// pass the name of the operator
           $value    = $where[2];// pass the value

           // check if any f the operators exists in the array
           if(in_array($operator, $operators)){
               $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";// if operator exists, created the SQL statement

               // execute the SQL statement
               if(!$this->query($sql, array($value))->error()){
                   return $this;
               }
           }
       }
       return false;
   }

   /*
 	 * This function execute SQL statements such as SELECT ALL
 	 * Parameter = $table(string),
 	 * return type = object
 	*/
 	public function all($table){
 		return $this->action('SELECT *', $table); // pass the variable to the action() method
 	}

   /*
    * This function execute SQL statements such as SELECT
    * Parameter = $table(string), $where(array)
    * return type = object
   */
   public function get($table, $where){
       return $this->action('SELECT *', $table, $where); // pass the variable to the action() method
   }

   /*
    * This function execute SQL statements such as DELETE
    * Parameter = $table(string), $where(array)
    * return type = object
   */
   public function delete($table, $where){
       return $this->action('DELETE', $table, $where);  // pass the variable to the action() method
   }

   /*
    * This function execute SQL statements to CREATE a new data in the database table
    * Parameter = $table(string), $fields(assoc array)
    * return type = boolean
   */
   public function insert($table, $fields = array()){
       if(count($fields)){
           $keys   = array_keys($fields);
           $values = '';
           $x      = 1;
           foreach ($fields as $field){
               $values .= '?';
               if ($x < count($fields)){ // extract the values of the fields array keys and pass the field array value to each Key
                   $values .= ', '; // concantenate the ', ' after each of the valuess
               }
               $x++;
           }
           $sql = "INSERT INTO {$table} (" . implode(', ', $keys). ") VALUES ({$values})"; // execute the sql statement by imploding the field array keys and values

           // check if the sql executed was successfull
           if (!$this->query($sql, $fields)->error()){
               return true;// return true if the sql executed successfully
           }
       }

       return false;// return this if the above fails
   }

   /*
    * This function execute SQL statements such as UPDATE
    * Parameter = $table(string), $id(integer) $field(array)
    * return type = boolean
   */
   public function update($table, $colMatch, $id, $fields){
       $set = '';
       $x = 1;

       foreach ($fields as $name => $value){
           $set .= "{$name} = ?";
           if($x < count($fields)){
               $set .= ', ';
           }
           $x++;
       }

       $sql = "UPDATE {$table} SET {$set} WHERE Matricnum = '{$id}'";

       if(!$this->query($sql, $fields)->error()){
           return true;
       }
       return false;
   }

   /*
    * This function returns the result of any executed sql query
    * Parameter = none
    * return type = object
   */
   public function results(){
       return $this->_results;
   }

   /*
    * This function returns the First record of any executed sql query
    * Parameter = none
    * return type = object
   */
   public function first(){
       return $this->_results[0];
   }

   /*
    * This function returns the error of any failed sql query
    * Parameter = none
    * return type = object
   */
   public function error(){
       return $this->_error;
   }

   /*
    * This function returns the First record of any executed sql query
    * Parameter = none
    * return type = integer
   */
   public function count(){
       return $this->_count;
   }

   /*
    * This function returns the error message of any executed sql query
    * Parameter = none
    * return type = integer
   */
   public function error_message(){
       return $this->_errormsg;
   }
}
