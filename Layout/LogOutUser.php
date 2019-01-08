<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P7';
set_error_handler("Error_Handeler");

if ( $Session->DestroySession() == -1 ){
	include_once ErrorPage;
	exit();
}

header("Location:".MainPage);
exit();
?>