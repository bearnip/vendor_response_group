 <?php
 include('classes/Database.php');
 include('classes/User.php');

session_start();

//Get the action the user is requesting
if( isset( $_SESSION["userID"] ) ){


	if( isset($_POST["action"] ) ){

		$action = $_POST["action"]; 

	}elseif( isset($_GET["action"] ) ){

   		$action = $_GET["action"]; 

	}else{

		$action="home"; 
	}

}else{ //User not logged in

   $action = "login"; 
}



//Take appropraite action
if( $action == "login"){

	//If they're coming to the page the first time
	if( !isset( $_POST["user"] ) ){

		include('views/login.php');

	}else{ //Request is a POST

		$userID = $_POST["user"];
		$password = $_POST["pass"];

		$user = new User($userID, $password);

		if($user->isLoggedIn() ){

			$_SESSION["userID"] = $user->getID();
			$_SESSION["name"] = $user->getContactName();

  			$lifetime=600;
  
  			setcookie(session_name(),session_id(),time()+$lifetime);

  			//Get a list of the Vendors responses to RFPs and display
			$db = Database::getDB();
			$response_collection = $db->responses;

			//Get responses this user posted
			$params = array("userID"=>$_SESSION["userID"]); 

			$myResponses = $response_collection->find($params);

			include('views/home.php');

		}else{

			echo "<h1>User not logged in</h1>";
		}

	}
}//end login


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if( $action == "home"){

	//Get a list of the Vendors responses to RFPs and display
	$db = Database::getDB();
	$response_collection = $db->responses;

	//Get responses this user posted
	$params = array("userID"=>$_SESSION["userID"]); 

	$myResponses = $response_collection->find($params);

	if( isset( $_SESSION["userID"] ) ){
		include('views/home.php');	
	}else{
		echo "you're logged out";
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//To view page of all Rfps
elseif( $action == "viewRfps"){

	if( isset($_SESSION["userID"]) ){

		//Get all rfps from database
		$db = Database::getDB();
		$rfp_collection = $db->rfps; 
		$rfp_cursor = $rfp_collection->find(); //Change this to check dates


		//Put all rfps in an array
		$allRfps = []; 
		foreach($rfp_cursor as $rfp){
			$allRfps[] = $rfp; 
		}

		include('views/rfps.php');

	}else{

		include('views/login.php');
	}
}

//To view details of one rfp
elseif( $action == "viewSingleRfp"){

	if(isset($_POST["RfpNum"] )){

		$rfpId = $_POST["RfpNum"];

		//Get all this RFPs Info From Database --> Display w/ option to respond
		$db = Database::getDB();
		$rfp_collection = $db->rfps; 

		//search parameters
		$params = array("RfpNum"=>$rfpId);
		$rfp_cursor = $rfp_collection->find($params);

		//Get first result
		$rfp = $rfp_cursor->getNext();

		//Get readable format for booleans
		$hq = ($rfp["hqAudio"]==true ? "Yes" : "No");
    	$stadium = ( $rfp["stadium"]==true ? "Yes" : "No");

		include("views/singleRfp.php");

	}
	
}

//If they're submitting a response to an RFP
elseif( $action == "submitResponse" ){

	//Get connected to database	
	$db = Database::getDB();
	$rfp_collection = $db->rfps;


	$RfpNum = 	$_POST["RfpNum"]; 

	//Get the RFP we're responding to
	$rfp = $rfp_collection->find(array("RfpNum"=>$RfpNum));




	$sumDesc = 	$_POST["sumDesc"]; 

	$cost = 	$_POST["propCost"];

	$title = 	$_POST["propTitle"];




	//Put all vendor partners in an array
	$vPartners = []; 
   	foreach($_POST as $key => $val){
    	if(strpos($key, "vP") !== false){
    		if($val != ( "" || null ) ){

       			array_push($vPartners, $val);
    		}
        }
  	} 

  	//Le Response
	$Vresponse = array(
					//"responseN"=> will db insert?
					"Rfpnum"=>$_POST["RfpNum"],
					"title"=>$title,
					"userID"=>$_SESSION["userID"], 
					"desc"=>$sumDesc,
					"vendorPartners"=>$vPartners,
					"filePath"=>"/pdf/Stuff.pdf",
					"cost"=>$cost
				);

	$db = Database::getDB();
	$response_collection = $db->responses; 

	$response_collection->insert($Vresponse);

}



elseif( $action == "account" ){
	$db = Database::getDB();
	$user_collection = $db->users; 
	$user_cursor = $user_collection->find(array("userID"=>$_SESSION["userID"]));
	$myInfo = $user_cursor->getNext();
	//Get all user contact info and put in an editable form
	include('views/account.php');

}


elseif( $action == "logout"){
	session_destroy();
	include('views/login.php');
}

?>