<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once MySqlDB;
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.G1';
else
    $GLOBALS['Page_API_Error_Code'] = 'G1';
set_error_handler("Error_Handeler");

/*
    - Return :
        return array(-1, $MySql->Error, $Key);
        return array(0, 'Found In Users', $Key);
        return array(-1, $MySql->Error, $Key);
        return array(0, 'Found In Waiting_Users', $Key);
        return array(0, 'Not Found', $Key);
*/
function CheckUserEmail($Email){
    $Hashing = new HashingClass();
    return Check('email', $Hashing->Hash_Email($Email));
}

/*
    - Return :
        return array(-1, $MySql->Error, 'Check if $Key Found Or Not', 'Check');
        return array(0, 'Found In Users', $Key);
        return array(-1, $MySql->Error, 'Check if $Key Found Or Not', 'Check');
        return array(0, 'Found In Waiting_Users', $Key);
        return array(0, 'Not Found', $Key);
*/
function CheckUserName($Name){
    $Hashing = new HashingClass();
    return Check('name', $Hashing->Hash_Name($Name));
}

function Check($Key, $Value){
    $MySql = new MYSQLClass('SignUP');
// Search in users
    if ( ($Result = $MySql->isFound( "SELECT $Key FROM users WHERE $Key = ?",
            array($Value))) == -1 )
        return array(-1, $MySql->Error, "Check if $Key Found Or Not", 'Check');
    else if ( $Result == 1 )
        return array(0, 'Found In Users', $Key);

// Search in waiting users
    if ( ($Result = $MySql->isFound("SELECT $Key FROM waiting_users WHERE $Key = ?",
                array($Value))) == -1 )
        return array(-1, $MySql->Error, "Check if $Key Found Or Not", 'Check');
    else if ( $Result == 1 )
        return array(0, 'Found In Waiting_Users', $Key);

    return array(0, 'Not Found', $Key);
}
?>