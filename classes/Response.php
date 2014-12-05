<?php
class Response{

	private static $RfpNum, $userID;
	private static $sumDesc, $cost, $title, $vPartners;
	private static $file;

	private static $errors;



	public function __construct(){

		self::validatePostData();

		if(count(self::$errors) == 0){
			self::submitResponse();
		}

	}

	private function validatePostData(){


		self::$RfpNum  = $_POST["RfpNum"];
		self::$sumDesc = $_POST["sumDesc"];
		self::$cost = $_POST["propCost"];
		self::$title = $_POST["propTitle"];
		self::$userID = $_POST["userID"];
		
		$vendorPartners = [];

		//Put vendor partners into an array
   		foreach($_POST as $key => $val){
    		if(strpos($key, "vP") !== false){
    			if($val != ( "" || null ) ){

       				array_push($vendorPartners, $val);
    			}
        	}
  		}

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