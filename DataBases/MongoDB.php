<?php
/*
	php page  	=>  MongoDB.php
	init name 	=>  MongoDB
	class name 	=> 	MongoClass
	object name => 	Mongo
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
require_once ROOT.'/DataBases/MongoDBFile/vendor/autoload.php';
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C8';
else
    $GLOBALS['Page_API_Error_Code'] = 'C8';
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