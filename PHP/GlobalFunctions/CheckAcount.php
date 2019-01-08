<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once FILTERS;
include_once CheckUser;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.G2';
else
    $GLOBALS['Page_API_Error_Code'] = 'G2';
set_error_handler("Error_Handeler");

/*
    - What is Doing ?
        Filter User And Check Acount

    - Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');

        return array( -1, $MySql->Error, $Key, 'Check Data');
        return array( 0, 'Found In Users', $Key, 'Check Data');
        return array( 0, 'Found In Waiting_Users', $Key, 'Check Data');
        return array( 0, 'Not Found', $Key, 'Check Data');
*/    
function CheckAcount(){
    
    $FILTER = new FILTERSClass();
    if ( ( $Result = $FILTER->FilterEmail($_POST['E']) )[1] != 'OK' )
        return $Result;
    $GLOBALS['E'] = $FILTER->FILTER_Result;
    return CheckUserEmail( $FILTER->FILTER_Result );  // Function in CheckUser.php
}
?>