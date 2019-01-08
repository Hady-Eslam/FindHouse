<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.P14F1';
else
    $GLOBALS['Page_API_Error_Code'] = 'P14F1';
set_error_handler("Error_Handeler");

function CheckData(){

//
	// Check Governor
	$Governor = '.';
	if ( isset($_POST['G']) )
		foreach ($_POST['G'] as $value)
			$Governor .= $value.'.';

	// Check Station
	$Station = '.';
	if ( isset($_POST['S']) )
		foreach ($_POST['S'] as $value)
			$Station .= $value.'.';

	// Check Distruct
	$Distruct = '.';
	if ( isset($_POST['D']) )
		foreach ($_POST['D'] as $value)
			$Distruct .= $value.'.';

//
	// Status
	$Status = '.'
	if ( isset($_POST['StatusR']) )
		$Status .= 'Rent.';
	if ( isset($_POST['StatusB']) )
		$Status .= 'Buy.';

	// Type 
	$Type = '.';
	if ( isset($_POST['TyS']) )
		$Status .= 'Students.';
	if ( isset($_POST['TyF']) )
		$Status .= 'Families.';
	if ( isset($_POST['TyO']) )
		$Status .= 'Offices.';
}
?>