<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once FILTERS;
include_once MySqlDB;
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.G4';
else
    $GLOBALS['Page_API_Error_Code'] = 'G4';
set_error_handler("Error_Handeler");

/*
    Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(-1, $MySql->Error, 'Changing The User Password', 'Change Password');
        return array(0 'Done');
*/       
function ChangePassword($Email, $Password, $Table, $User){
    $MySql = new MYSQLClass('SignUP');
    $Hashing = new HashingClass();
    $FILTER = new FILTERSClass();

    if ( ( $Result = $FILTER->FilterPassword($_POST['E']) )[1] != 'OK' )
        return $Result;
    $GLOBALS['P'] = $FILTER->FILTER_Result;
    
    if ( $MySql->excute("UPDATE $Table SET password = ? WHERE email = ?",
                    array(
                        $Hashing->Hash_Password($Password),
                        $Hashing->Hash_Email($Email)
                    )) == -1 )
        return array(-1, $MySql->Error, 'Changing The User Password', 'Change Password');
    return array(0, 'Done');
}
?>