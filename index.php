 <?php
 include('classes/Database.php');
 include('classes/User.php');
 include('classes/RFP.php');
 include('classes/Response.php');

session_start();


$user = null;


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

		//Grab login info from form
		$userID = $_POST["user"];
		$password = $_POST["pass"];

		//Try to create a user object
		$_SESSION["user"] = new User($userID, $password);


		//If the user is logged in
		if($_SESSION["user"]->isLoggedIn() ){

			//Get all of the vendors responses
  			$myResponses = $_SESSION["user"]->getMyResponses();

			include('views/home.php');

		}else{

			echo "<h1>User not logged in</h1>";
		}

	}
}//end login


///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

if( $action == "home"){

	//if the user is logged in
	if( isset( $_SESSION["user"] ) ){

		///Get all of the vendors responses
  		$myResponses = $_SESSION["user"]->getMyResponses();

		include('views/home.php');

	}else{
		echo "you're logged out";
	}
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//To view page of all Rfps
elseif( $action == "viewRfps"){

	if( isset($_SESSION["userID"]) ){

		//Get all RFPs
		$rfp_cursor = Database::getRFPs();

		$filledRfps = $_SESSION["user"]->getPreviousResponses();


		//Display the page containing the RFPs
		include('views/rfps.php');

	}else{

		include('views/login.php');
	}
}



//To view details of one rfp
elseif( $action == "viewSingleRfp"){

	if(isset($_POST["RfpNum"] )){

		$rfpId = $_POST["RfpNum"];

		//Query database for the rfp
		$rfp = Database::getSingleRFP($rfpId);

		//Get readable format for booleans
		//$hq = ($rfp["audio"]==true ? "Yes" : "No");

		include("views/singleRfp.php");

	}
	
}

//If they're submitting a response to an RFP
elseif( $action == "submitResponse" ){


	$response = new Response();


	//Get all of the vendors responses
  	$myResponses = $_SESSION["user"]->getMyResponses();

	include('views/home.php');
	
}



elseif( $action == "account" ){
	
	$myInfo = $_SESSION["user"]->getMyAccountInfo();

	//Get all user contact info and put in an editable form
	include('views/account.php');

}

elseif( $action == "editInfo"){

	$companyName = $_POST["companyName"]; 
	$contactName = $_POST["contactName"]; 
	$contactNumber = $_POST["contactNumber"]; 
	$contactEmail = $_POST["contactEmail"];

	$myAccount = $_SESSION["user"]->getMyAccountInfo();

	$myAccount["companyName"] = $companyName;
	$myAccount["contactName"] = $contactName;
	$myAccount["contactNum"] = $contactNumber;
	$myAccount["contactEmail"] = $contactEmail;


	$db = Database::getDB();
	$vendors = $db->VRMusers;

	$params = array("userID"=>$_SESSION["userID"]);

	$vendors->update($params, $myAccount);

	$myInfo = $_SESSION["user"]->getMyAccountInfo();

	include('views/account.php');

}


elseif( $action == "logout"){
	session_destroy();
	include('views/login.php');
}


?>