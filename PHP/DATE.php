<?php
/*
	-info
		php page  	=>  DATE.php
		init name 	=>  DATE
		class name 	=> 	DATEClass
		object name => 	Date

	-Errors
		13	=>	DATE Error 	=>	Error in Converting Date ( invalid Style )
		16	=>	DATE Error 	=>	Error in Getting Houres Diffrence
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C5';
else
    $GLOBALS['Page_API_Error_Code'] = 'C5';
set_error_handler("Error_Handeler");

class DATEClass{

	// Error Array
	public $Error = array(
					'Error Location' 	=> '',
					'Error Code' 		=> '',
					'Error Message' 	=> '',
				);
	public $ResultDate = '';
	private function ErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
		$this->Error['Error Location'] = $ErrorLocation;
    	$this->Error['Error Code'] = $ErrorCode;
    	$this->Error['Error Message'] = $ErrorMessage;
    	return -1;
	}

	function GetDateDiff($FirstDate, $SecondDate){
		try{
			$First = new DateTime($FirstDate);
			$Second = new DateTime($SecondDate);
			$Dif = $Second->diff($First);
			$this->ResultDate = $Dif;
			return 1;
		}
		catch(Exception $e){
			return $this->ErrorReturn('DATE Error', '13',
					 "Error in Converting Date ( invalid Style )");
		}
	}

	function GetHoureDiff($Date, $Hours){
		try{
			if ( $Date->y > 0 || $Date->m >0 || $Date->d >0 )
				return 1;
			if ( $Date->h >= $Hours )
				return 1;
			return 0;
		}
		catch(Exception $e){
			return $this->ErrorReturn('DATE Error', '16', "Error in Getting Houres Diffrence");
		}
	}
}
$Date = new DATEClass();
?>