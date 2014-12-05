<?php 
class Database{
	private static $mongoUrl = "mongodb://vendors:vendor@ds039960.mongolab.com:39960/csc400";
	private static $db; 

	private function __construct(){}

	//Allows for one connection to database per session
	public static function getDB(){
		if (!isset(self::$db)){ //If there is no connection
			try{//Make one
				$m = new MongoClient(self::$mongoUrl);
				self::$db =  $m->csc400;
			}catch(MongoConnectionException $e){
				die("Couldn't connect to database");
			}catch(MongoException $e){
				die('Error: ' . $e->getMessage());
			}	
		}
		return self::$db;
	}


	/** getRFPs() gets every rfp that's stored in the database
		and returns an array of those responses to the calling function
	**/
	public static function getRFPs(){

		//Get all rfps from database
		$db = self::getDB();
		$rfp_collection = $db->rfps; 
		$rfp_cursor = $rfp_collection->find(); //Change this to check dates

		return $rfp_cursor;

	}

	public static function getSingleRFP($rfpId){

		//Get all this RFPs Info From Database --> Display w/ option to respond
		$db = self::getDB();
		$rfp_collection = $db->rfps; 

		//search parameters
		$params = array("rfpnum"=>intval($rfpId));
		$rfp_cursor = $rfp_collection->find($params);

		//Get first result
		$rfp = $rfp_cursor->getNext();

		return $rfp;
	}
}
?>