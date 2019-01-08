<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once MySqlDB;
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= 'G3';
else
    $GLOBALS['Page_API_Error_Code'] = 'G3';
set_error_handler("Error_Handeler");

/*
    - What is Doing?
        Check The Token For (log_token, sign_up_token)

    - Return :
        return array(-1, $MySql->Error, 'Fetching Token And Email', 'Check Token');
        return array(0, 'Not Found');
        return array(0, 'Found');
*/
function CheckToken($Email, $Token, $Table, $User){
    $MySql = new MYSQLClass('SignUP');
    $Hashing = new HashingClass();
// Check if Token And Email Found or Not
    if ( ($Result = $MySql->isFound("SELECT * FROM $Table WHERE token_email = ? AND token = ?",
                array(
                    $Hashing->Hash_Email($Email),
                    $Hashing->Hash_Token($Token)
                ))) == -1 )
        return array(-1, $MySql->Error, 'Check Token And Email Found Or Not', 'Check Token');
    else if ( $Result == 0 )
        return array(0, 'Not Found');
    return array(0, 'Found');
}
?>