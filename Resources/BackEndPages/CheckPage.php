<?php set_error_handler("Error_Handeler");
include_once CheckUser;
$FILTER = new FILTERSClass();

if ( isset($_POST['N']) ){
	$Result = $FILTER->FilterString($_POST['N'], Name_Len);
	if ( $Result->Result != 'OK' )
		return $Result;
	return CheckUserName($Result->Data);
}
else{
	$Result = $FILTER->FilterEmail($_POST['E']);
	if ( $Result->Result != 'OK' )
		return $Result;
	return CheckUserEmail($Result->Data);
}
?>