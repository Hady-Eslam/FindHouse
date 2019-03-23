<?php set_error_handler("Error_Handeler");

function CheckUserEmail($Email){
    return Check('email', $Email);
}

function CheckUserName($Name){
    return Check('name', $Name);
}

function CheckUserPhone($Phone){
    return Check('phone', $Phone);
}
/*
    - Return :
        return Returns(-1, "Check if $Key Found Or Not in Users", $Result->Error);
        return Returns(0, "Found $Key in Users", '');
        return Returns(-1, "Check if $Key Found Or Not in Waiting Users", $Result->Error);
        return Returns(0, "Found $Key in Waiting_Users", '');
        return Returns(0, "$Key Not Found", '');
*/

function Check($Key, $Value){
    $MySql = new MYSQLClass('BackEnd');
    $Hashing = new HashingClass();
    
    // Search in users
    if ( ($Result = $MySql->isFound("SELECT $Key FROM users WHERE $Key = ?",
            array( $Hashing->Hash_Users($Value) )))->Result == -1 )
        return Returns(-1, "Check if $Key Found Or Not in Users", $Result->Error);
    
    else if ( $Result->Result == 1 )
        return Returns(0, "Found $Key in Users");

    // Search in waiting users
    if ( ($Result = $MySql->isFound("SELECT $Key FROM waiting_users WHERE $Key = ?",
                array( $Hashing->Hash_WaitingUsers($Value) )))->Result == -1 )
        return Returns(-1, "Check if $Key Found Or Not in Waiting Users", $Result->Error);

    else if ( $Result->Result == 1 )
        return Returns(0, "Found $Key in Waiting_Users");

    return Returns(0, "$Key Not Found");
}
?>