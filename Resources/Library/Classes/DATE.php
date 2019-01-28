<?php set_error_handler("Error_Handeler");
/*
	-info
		php page  	=>  DATE.php
		init name 	=>  DATE
		class name 	=> 	DATEClass
		object name => 	Date

	- Depences Files :
        NONE
*/

class DATEClass{

	function GetDateDiff($FirstDate, $SecondDate){
		try{
			$First = new DateTime($FirstDate);
			$Second = new DateTime($SecondDate);
			return Returns(1, $Second->diff($First));
		}
		catch(Exception $e){
			return Returns(-1, '',
				Error('DATE Error', '9', "Error in Converting Date ( invalid Style )") );
		}
	}

	function GetHoureDiff($Date, $Hours){
		try{
			if ( $Date->y > 0 || $Date->m >0 || $Date->d >0 )
				return Returns(1);
			if ( $Date->h >= $Hours )
				return Returns(1);
			return Returns(0);
		}
		catch(Exception $e){
			return Returns(-1, '',
				Error('DATE Error', '10', "Error in Getting Houres Diffrence") );
		}
	}

	function isDateBiggerThanCurrentDate($Date, $Months, $Days){
		$First = strtotime(date('d-m-Y'));
		$Second = strtotime(date('d-m-Y',
							strtotime('+'.$Months.' months',
								strtotime('+'.$Days.' days',
									strtotime($Date)))));
		if ( $Second >= $First )
			return true;
		else
			return false;
	}
}
$Date = new DATEClass();
?>