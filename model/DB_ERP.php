<?php
/*
 * USESD FOR HANDELING CONNECTIONS AND INTERACTION TO MSSQL DATABASE
 * Author: DAVID DANIEL
 * Last Edited: 25/10/2017
 * STILL "To Do"
*/
class DB_ERP
{

    // Instantate the variables to hold query data
    private static $_instance = null;
    private $_pdo;
    private $_query;
    private $_error = false;
    private $_results;
    private $_count = 0;
    private $_errormsg;

    // pseudo construct function to handle database connection
    public function __construct()
    {
        // get the instance of the new db;
        try {
            $this->_pdo = new PDO("sqlsrv:Server=" . Config::get('mssql_erp/host') . ";Database=". Config::get('mssql_erp/db'), Config::get('mssql_erp/username'), Config::get('mssql_erp/password'));
        } catch (PDOException $e) {
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
    public static function getInstance()
    {
        // check if an instance previously exists
        if (!isset(self::$_instance)) {
            self::$_instance = new DB_ERP();// no previous instance exists, callon the DB object and establish database connection
        }
        return self::$_instance;// Return the instance ("i.e connection to database") as a static
        //return $dbname."_";
    }

    /*
     * This function execute general SQL queries and statements
     * Parameter = $sql(string), $params(array)
     * function type = public
    */
    public function query($sql, $params = array())
    {
        $this->_error = false;// set the error variable to false, in case of a previously occured error // Prepare the SQL statement
        if ($this->_query = $this->_pdo->prepare($sql)) {
            $x = 1;
            //check to see if an array was passed
            if (count($params)) {
                //if array exists, bind the values of the array to the SQL
                foreach ($params as $param) {
                    $this->_query->bindValue($x, $param);
                    $x++;
                }
            }
            // execute if the query execute successfully
            try {
                // $this->_query->execute();
                if ($this->_query->execute()) {
                    $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                    $this->_count = $this->_query->rowCount();
                } else {
                    //execute if an error occur
                    $this->_error = true;
                    $this->_errormsg = $this->_query->errorInfo();
                }
            } catch (Exception $e) {
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
    public function action($action, $table, $where = array())
    {
        // check for the expected number of array data
        if (count($where) === 3) {
            $operators = array('=', '<', '>', '<=', '>=', 'LIKE', 'like');// instantate the possible operators
           $field    = $where[0];// pass the name of the field
           $operator = $where[1];// pass the name of the operator
           $value    = $where[2];// pass the value

           // check if any f the operators exists in the array
            if (in_array($operator, $operators)) {
                $sql = "{$action} FROM {$table} WHERE {$field} {$operator} ?";// if operator exists, created the SQL statement

                // execute the SQL statement
                if (!$this->query($sql, array($value))->error()) {
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
    public function all($table)
    {
        return $this->action('SELECT *', $table); // pass the variable to the action() method
    }

    /*
     * This function execute SQL statements such as SELECT
     * Parameter = $table(string), $where(array)
     * return type = object
    */
    public function get($table, $where)
    {
        return $this->action('SELECT *', $table, $where); // pass the variable to the action() method
    }

    /*
     * This function returns the result of any executed sql query
     * Parameter = none
     * return type = object
    */
    public function results()
    {
        return $this->_results;
    }

    /*
     * This function returns the First record of any executed sql query
     * Parameter = none
     * return type = object
    */
    public function first()
    {
        return $this->_results[0];
    }

    /*
     * This function returns the error of any failed sql query
     * Parameter = none
     * return type = object
    */
    public function error()
    {
        return $this->_error;
    }

    /*
     * This function returns the First record of any executed sql query
     * Parameter = none
     * return type = integer
    */
    public function count()
    {
        return $this->_count;
    }

    /*
     * This function returns the error message of any executed sql query
     * Parameter = none
     * return type = integer
    */
    public function error_message()
    {
        return $this->_errormsg;
    }
}
