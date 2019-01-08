<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once FILTERS;
include_once MySqlDB;
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.P4F1';
else
    $GLOBALS['Page_API_Error_Code'] = 'P4F1';
set_error_handler("Error_Handeler");

/*
    - What is Doing ?
        Check if Password is Correct

    - Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(0, 'OK');
        
        return array(-1, $MySql->Error, 'Check if Password is Correct',
                        'Check Password Correct');
        return array(0, 'Wrong Password');
        return array(0, 'Right Password');

*/
function CheckPasswordCorrect($Table){
    $MySql = new MYSQLClass('Log');
    $Hashing = new HashingClass();
    $FILTER = new FILTERSClass();

    if ( ( $Result = $FILTER->FilterPassword($_POST['P']) )[1] != 'OK' )
        return $Result;

    if ( ($Result = $MySql->isFound("SELECT * FROM $Table WHERE email = ? AND password = ?",
                    array(
                        $Hashing->Hash_Email($GLOBALS['E']),
                        $Hashing->Hash_Password( $FILTER->FILTER_Result )
                    ) )) == -1 )
        return array(-1, $MySql->Error, 'Check if Password is Correct',
                        'Check Password Correct');
    else if ( $Result == 0 )
        return array(0, 'Wrong Password');
    return array(0, 'Right Password');
}
?>