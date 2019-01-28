<?php
/*
	-info :
		php page  	=>  PagesStatus.php
		init name 	=>  PageStatus
		class name 	=> 	PagesStatusClass
		object name => 	Page

	-Current Pages :
		Sign UP, SuccessSignUp		=>		Sign UP
		Confirm User 				=>		ConfirmUser
		Log in 						=>		Log in
		Forget Password 			=>		Forget Password
		New Password 				=>		New Password

	-Errors :
		1	=>	Mongo DB Error 	=>	Can't Access DataBase Or DataBase Not Found
		2	=>	Mongo DB Error 	=>	Error in excuting Query
		3	=>	Mongo DB Error 	=>	Page Not Found

*/
require_once MongoDBAutoload;
set_error_handler("Error_Handeler");

class PagesStatusClass{

	private $MongoDB;
	private $FindHouse;
	public $PagesStatus;
	
	// Error Array
	public $Error = array(
					'Error Type' 	=> '',
					'Error Code' 		=> '',
					'Error Message' 	=> '',
				);

	function __construct(){
		try{
			$this->MongoDB = new MongoDB\Client;
			$this->FindHouse = $this->MongoDB->FindHouse;
			$this->PagesStatus = $this->FindHouse->PagesStatus;
		}
		catch(Exception $e){
			$this->ErrorReturn('Mongo DB Error', '1', "Can't Access DataBase Or Not Found");
	    }
	}

	/*
		- What is Doing ?
			Make Error Object

		- Return : 
			return -1;
	*/
	private function ErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
		$this->Error['Error Type'] = $ErrorLocation;
    	$this->Error['Error Code'] = $ErrorCode;
    	$this->Error['Error Message'] = $ErrorMessage;
    	$this->Error['Error Found'] = true;
    	return -1;
	}

	/*
		- What is Doing ?
			Check if The Page is Working or Not

		- Return :
			return -1;
			return $this->ErrorReturn('Mongo DB Error', '3', 'Page Not Found');
			return $Result['On Work'];
			return $this->ErrorReturn('Mongo DB Error', '2', 'Error in excuting Query');
	*/
	function isPageOnWork($Page){
		if ( $this->Error['Error Code'] == '1' )
			return -1;

		try{
			$Result = $this->PagesStatus->findOne(
				[ 'Page' => $Page ]
			);
			if ( empty($Result) )
				return $this->ErrorReturn('Mongo DB Error', '3', 'Page Not Found');
			return $Result['On Work'];
		}
		catch(Exception $e){
	    	return $this->ErrorReturn('Mongo DB Error', '2', 'Error in excuting Query');
	    }
	}

	/*
		- What is Doing ?
			Count The Page Visits And increase Every Time User Enter Page
		
		- Return :
	*/
	function PageVisit($Date, $Page){
		if ( $this->Error['Error Code'] == '1' )
			return -1;
		try{
			$Document = $this->PagesStatus->findOne(
				['Visits Count.'.$Date => ['$exists' => true] ]
			);
			return $Document;
			if ( empty($Document) ){
				$Update = $this->PagesStatus->updateMany(
					[ 'Visits Count' ],
					[ '$set' => [ $Date => 1 ] ]
					/*if field not found it will create one*/
				);
			}
			else{
				$Update = $this->PagesStatus->updateMany(
					[ 'Visits Count' ],
					[ '$set' => [ $Date => $Document['Visits Count'][$Date]+1 ] ]
					/*if field not found it will create one*/
				);
			}
			return 1;
		}
		catch(Exception $e){
	    	return $this->ErrorReturn('Mongo DB Error', '14',
	    				'Error in Making Number Of Page Visits');
	    }
	}
}

$Page = new PagesStatusClass();
?>