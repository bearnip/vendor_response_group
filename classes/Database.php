<?php 
class Database{
	private static $mongoUrl = "mongodb://team:csc400@ds047020.mongolab.com:47020/csc400";
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
}
?>