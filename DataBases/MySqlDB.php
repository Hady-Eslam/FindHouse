<?php
/* 	
	-some important info
	deleted 	1 => Yes 	0 => NO 	2 => Suspended		Defult => 0
	status 		0 => Admin 	1 => User 	2 => Waiting User 	Defult => 1
	updates 	0 => NO 	1 => YES 						Defult => 1

	
	-info
		php page  	=>  MySqlDB.php
		init name 	=>  MySqlDB
		class name 	=> 	MYSQLClass
		object name => 	MySql

	-users 				Password 			What is Doing
		root  		=> 	''
		SignUP 		=> 	0079521111
		CheckUser	=> 	0079521111te
		Log 		=>	52975
		Session 	=>	''
		Post 		=>	''
		Sittings 	=>	''

	-Errors
		4 	=>	My Sql Error 	=>	Access Denied
		5	=>	My Sql Error 	=>	Error in excuting Query
		12	=>	My Sql Error 	=>	Error in Counting Query
		17	=>	My Sql Error 	=>	Error in Fetching a Row
		18	=>	My Sql Error 	=>	Error in Fetching Rows
		20	=>	My Sql Error 	=>	Error in Searching For Column
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C2';
else
    $GLOBALS['Page_API_Error_Code'] = 'C2';
set_error_handler("Error_Handeler");

class MYSQLClass{
	
	public $SQL;
	public $pdo;
	public $Fetched_Data;

	private $Password = '';
	private $SignUP_Password = 'SignUP0079521111';
	private $CheckUser_Password = '0079521111te';

	// Error Array
	public $Error = array(
					'Error Location' 	=> '',
					'Error Code' 		=> '',
					'Error Message' 	=> '',
				);

	function __construct($UserName){
		try{
			$this->Password = $this->GetPassword($UserName);
			$UserName = 'root';
			$this->pdo = new PDO("mysql:host=localhost;dbname=findhouse", 
									$UserName, $this->Password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES,false); 
		}
		catch(Exception $e){
			$this->ErrorReturn('My Sql Error', '4', "Access Denied For ".$UserName);
	    }
	}

	function SetUser($User){
		$this->__construct($User);
	}

	function GetPassword($UserName){
		if ( $UserName == 'SignUP' )	
			$this->Password = '';
		else if ( $UserName == 'CheckUser' )	
			$this->Password = '';
		else if ( $UserName == 'Log' )
			$this->Password = '';
		else if ( $UserName == 'Session' )
			$this->Password = '';

		$this->Password = '';
	}

	private function ErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
		$this->Error['Error Location'] = $ErrorLocation;
    	$this->Error['Error Code'] = $ErrorCode;
    	$this->Error['Error Message'] = $ErrorMessage;
    	return -1;
	}

	public function excute($Query, $Array){
		if ( $this->Error['Error Code'] == '4' )
			return -1;
		try{
			$this->SQL = $this->pdo->prepare($Query);
	        $this->SQL->execute($Array);
	        return 1;
	    }
	    catch(Exception $e){
	    	return $this->ErrorReturn('My Sql Error', '5', 'Error in excuting Query');
	    }
	}

	public function GetRowCount($Query){
		if ( $this->Error['Error Code'] == '4' )
			return -1;
		try{
			return $this->pdo->query($Query)->fetchColumn();
		}
		catch(Exception $e){
	    	return $this->ErrorReturn('My Sql Error', '12', 'Error in Counting Query');
	    }
	}

	public function FetchOneRow($Query, $Array){
		if ( $this->Error['Error Code'] == '4' )
			return -1;
		try{
			if ( $this->excute($Query, $Array) == -1 )
				return -1;

			$this->Fetched_Data = $this->SQL->fetch(PDO::FETCH_ASSOC);
			if ( empty($this->Fetched_Data) )
				return 0;
			return 1;
		}
		catch(Exception $e){
			return $this->ErrorReturn('My Sql Error', '17', 'Error in Fetching One Row');
		}
	}

	public function FetchAllRows($Query, $Array){
		if ( $this->Error['Error Code'] == '4' )
			return -1;

		try{
			if ( $this->excute($Query, $Array) == -1 )
				return -1;

			$this->Fetched_Data = $this->SQL->fetchAll(PDO::FETCH_ASSOC);
			if ( empty($this->Fetched_Data) )
				return 0;
			return 1;
		}
		catch(Exception $e){
			return $this->ErrorReturn('My Sql Error', '18', 'Error in Fetching All Rows');
		}
	}

	public function isFound($Query, $Array){
		if ( $this->Error['Error Code'] == '4' )
			return -1;

		try{
			if ( $this->excute($Query, $Array) == -1 )
				return -1;

			while ( $Fetch = $this->SQL->fetch(PDO::FETCH_ASSOC) )
				return 1;
			return 0;
		}
		catch(Exception $e){
			return $this->ErrorReturn('My Sql Error', '20', 'Error in Searching For Column');
		}
	}
}
$MySql = new MYSQLClass('root');
?>