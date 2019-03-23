<?php
include_once CheckUser;
$FILTER = new FILTERSClass();

if ( isset($_POST['N']) ){
	$Result = $FILTER->FilterString($_POST['N'], Name_Len);
	if ( $Result->Result != 'OK' )
		return $Result;
	return CheckUserName($Result->Data);
}

else if ( isset($_POST['Ph']) ){
	$Result = $FILTER->FilterString($_POST['Ph'], Phone_Len);
	if ( $Result->Result != 'OK' )
		return $Result;
	return CheckUserPhone($Result->Data);
}

else{
	$Result = $FILTER->FilterEmail($_POST['E']);
	if ( $Result->Result != 'OK' )
		return $Result;
	return CheckUserEmail($Result->Data);
}
?>