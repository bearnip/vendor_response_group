<?php
class User{

	private static $userID, $type, $email;
	//Omitting password
	private static $companyName, $companyCeo;
	private static $companyStreet, $companyCity, $companyState, $companyZip;
	private static $contactName, $contactNum, $contactEmail;  

	private static $loggedIn = false;


	public function __construct($u, $p){

		self::login($u, $p); 

	}

	public function login($user, $password){

		$db = Database::getDB();

		$user_collection = $db->users;

		$params = array("userID"=>$user);

		$user_cursor = $user_collection->find($params);

		$thisUser = $user_cursor->getNext();

		if( isset($thisUser) && ( $thisUser != null ) ){

			if($thisUser["password"] == $password ){

				self::$loggedIn = true;
				//Initialize user
				self::initializeUser($thisUser);

			}else{ //Passwords mismatch
				echo "Failed Login";
			}

		}else{ // Didn't enter ID
			echo "Failure";
		}
	}


	private function initializeUser($userInfo){
		self::$userID = $userInfo["userID"]; 
		self::$contactName = $userInfo["contactName"];
		self::$email = $userInfo["email"];

	}

	//Session related stuff
	public static function getID(){
		return self::$userID;
	}

	public static function isLoggedIn(){
		return self::$loggedIn;
	}

	//Account related stuff
	public static function getContactName(){
		return self::$contactName;
	}
	public static function getEmail(){
		return self::$email;
	}

}