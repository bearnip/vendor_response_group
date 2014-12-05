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


		//Go to the database
		$db = Database::getDB();

		$user_collection = $db->VRMusers;

		//Find user with matching ID ( You can change this to Email if that works later on )
		$params = array("userID"=>$user);

		$user_cursor = $user_collection->find($params);

		$thisUser = $user_cursor->getNext();

		//If we get a response from the database
		if( isset($thisUser) && ( $thisUser != null ) ){

			//And the password matches
			if($thisUser["password"] == $password ){

				//Intialize the user
				self::$loggedIn = true;
				self::initializeUser($thisUser);

			}else{ //Passwords mismatch
				echo "Failed Login";
			}

		}else{ // Didn't enter ID
			echo "User does not exist";
		}
	}


	/** If the users login is successfull this function initialized
		the User object with the users database information
		The fucntion then sets session IDs and a session cookie to
		keep the user logged in etc
	**/
	private function initializeUser($userInfo){

		//User info
		self::$userID = $userInfo["userID"]; 
		self::$type = $userInfo["type"];

		//Contact info
		self::$contactName = $userInfo["contactName"];
		self::$contactNum = $userInfo["contactNum"];
		self::$email = $userInfo["email"];
		

		//Company info
		self::$companyName = $userInfo["companyName"];
		//self::$companyCeo = $userInfo["companyCeo"];

		//Address info
		//self::$companyStreet = $userInfo["companyStreet"];
		//self::$companyCity = $userInfo["companyCity"];
		//self::$companyState = $userInfo["companyState"];
		//self::$companyZip = $userInfor["companyZip"];


		//Set session variables
		$_SESSION["userID"] = self::$userID;
		$_SESSION["name"] = self::$contactName;

		//Create a cookie
  		$lifetime=600;
  		setcookie(session_name(),session_id(),time()+$lifetime);

	}

	//For getting all of the Responses the vendor has posted
	public static function getMyResponses(){

			$db = Database::getDB();
			
			$response_collection = $db->RFPnRES;

			//Get responses this user posted
			$params = array("userId"=> $_SESSION["userID"] ); 

			$myResponses = $response_collection->find($params);

			return $myResponses;
	}

	public static function getMyAccountInfo(){
		
		$db = Database::getDB();
		$user_collection = $db->users; 
		$user_cursor = $user_collection->find(array("userID"=>$_SESSION["userID"]));
		$myInfo = $user_cursor->getNext();
	
		return $myInfo;
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