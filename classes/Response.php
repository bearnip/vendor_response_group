<?php
class Response{

	private static $RfpNum, $userID;
	private static $sumDesc, $cost, $title, $vPartners;
	private static $file;

	private static $errors;


	public function __construct(){
  	
  		//Validate input
		self::validatePostData();

		if(count(self::$errors) == 0){
			self::submitResponse();
		}

	}

	private function validatePostData(){

		//Array holds validation errors
		$errors = []; 


		//Get data from post
		self::$RfpNum  = $_POST["RfpNum"];
		self::$sumDesc = $_POST["sumDesc"];
		self::$cost = $_POST["propCost"];
		self::$title = $_POST["propTitle"];
		self::$userID = $_POST["userID"];


		//Check for a valid RFP number
		if( !empty($_POST["RfpNum"] ) ){
			if( is_int( (int)$_POST["RfpNum"] ) ){
				echo "<h1>It's an int!</h1>";
				//Set the self for RFPNUM to this number
			}else{
				$errors[] = "RFP ID is invalid";
				var_dump($errors);
			}
		
		}else{ //No RFP number set

			$errors[] = "RFP Number Not Set";
		}

		//Escape string input
		if( !empty($_POST["sumDesc"] ) ){
			self::$sumDesc = htmlspecialchars( $_POST["sumDesc"] , ENT_QUOTES);
		}else{
			$errors[] = "Please Enter a Summary";
		}

		//Check for valid cost
		if( !empty( $_POST["propCost"] ) ){

			//If the string can be converted to an int
			if( $rawCost = (double)$_POST["propCost"] ){

				//Format cost to 2 decimal places
				$formatCost = round($rawCost, 2);  // 1.96

				self::$cost = $formatCost;
			}
		}else{
			$errors[] = "Please Enter a Cost"; 
		}

		//Check for valid title
		if( !empty($_POST["propTitle"] ) ){

			self::$title = htmlspecialchars( $_POST["sumDesc"] , ENT_QUOTES);

		}else{
			$errors[] = "Please Enter A Title";
		}	


		//Process Vendor Partners


		$vendorPartners = [];

		//Put vendor partners into an array
   		foreach($_POST as $key => $val){
    		if(strpos($key, "vP") !== false){
    			if($val != ( "" || null ) ){

    				$val = htmlspecialchars( $val , ENT_QUOTES);
       				array_push($vendorPartners, $val);

    			}
        	}
  		}

  		//Set vendor partners field of Response
  		self::$vPartners = $vendorPartners;

	}


	//For getting all of the Responses the vendor has posted
	public static function submitResponse(){

		//Get to the response collection
		$db = Database::getDB();
		$response_collection = $db->RFPnRES; 



  		//Create response Array
		$responseArray = array(
						//"responseN"=> will db insert?
						"Rfpnum"=>self::$RfpNum,
						"title"=>self::$title,
						"userId"=>$_SESSION["userID"], 
						"desc"=>self::$sumDesc,
						"vendorPartners"=>self::$vPartners,
						"filePath"=>"/pdf/Stuff.pdf",
						"cost"=>self::$cost
					);

		//Insert the response
		$response_collection->insert($responseArray);

	}

}