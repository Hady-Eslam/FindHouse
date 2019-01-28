<?php set_error_handler("Error_Handeler");
/*
    Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(-1, $MySql->Error, 'Changing The User Password', 'Change Password');
        return array(0 'Done');
*/

function ChangePassword($Email, $Password){
    $Hashing = new HashingClass();
    if ( ($Result = (new MYSQLClass('Register'))->excute(
                "UPDATE users SET password = ? WHERE email = ?",
                    array(
                        $Hashing->Hash_Users($Password),
                        $Hashing->Hash_Users($Email)
                    )))->Result == -1 )
        return Returns(-1, 'Changing User Password', $Result->Error);
    return Returns(0, 'Done');
}
?>