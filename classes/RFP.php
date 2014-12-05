<?php 
class RFP{
	
	private static $id, $RfpNum, $userID;
	private static $title, $purpose;
	private static $podiumType, $projection, $hqAudio;
	private static $classNum, $seats, $stadium, $size;
	private static $budget, $compdate;
	private static $width, $height,$length;

	//new fields
	private static $summary;

	//Accepts the result of a database query
	public function __construct($rawRfp){

		self::$id = $rawRfp["_id"]; 
		self::$RfpNum = $rawRfp["rfpnum"];
		//No userID present in databaseself::$userID = $rawRfp["userID"];
		self::$purpose = $rawRfp["purpose"];
		//No title present in databaes self::$title = $rawRfp["title"];
		self::$podiumType = $rawRfp["podium"];
		self::$projection = $rawRfp["projection"];
		self::$hqAudio = $rawRfp["audio"];
		self::$classNum = $rawRfp["classnum"];
		self::$seats = $rawRfp["seats"];
		//No stadium in database self::$stadium = $rawRfp["stadium"];
		self::$width = $rawRfp["width"];
		self::$height = $rawRfp["height"];
		self::$length = $rawRfp["length"];
		self::$budget = $rawRfp["budget"];
		self::$compdate = $rawRfp["compdate"];

		//new fields
		self::$summary = $rawRfp["summary"];
	}

	public function getId(){
		return self::$id;
	}

	public function getSummary(){
		return self::$summary;
	}

	public function getClassNum(){
		return self::$classNum;
	}

	public function getSeats(){
		return self::$seats;
	}

	public function getStadium(){
		return self::$stadium;
	}

	public function getSize(){
		return self::$size;
	}

	public function getBudget(){
		return self::$budget;
	}

	public function getCompDate(){
		return self::$compdate;
	}


	public function getRfpNum(){
		return self::$RfpNum;
	}

	public function getUserId(){
		return self::$userID;
	}

	public function getPurpose(){
		return self::$purpose;
	}

	public function getPodiumType(){
		return self::$podiumType;
	}

	public function getProjection(){
		return self::$projection;
	}

	public function getTitle(){
		return self::$title;
	}

	public function getHqAudio(){
		return self::$hqAudio;
	}


	
}
?>