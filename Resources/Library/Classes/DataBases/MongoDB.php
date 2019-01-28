<?php
/*
	php page  	=>  MongoDB.php
	init name 	=>  MongoDB
	class name 	=> 	MongoClass
	object name => 	Mongo
*/
require_once MongoDBAutoload;
include_once HashClass;

set_error_handler("Error_Handeler");

class MongoClass{

	public $MongoDB;
	public $FindHouse;
	public $WaitingList;
	private $Hashing;

	function __construct(){

		$this->MongoDB = new MongoDB\Client;
		$this->FindHouse = $this->MongoDB->FindHouse;
		$this->WaitingList = $this->FindHouse->WaitingList;

		$this->Hashing = new HashingClass();
	}
}

$Mongo = new MongoClass();
?>