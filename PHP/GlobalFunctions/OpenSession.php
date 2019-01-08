<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;
include_once MySqlDB;
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.G5';
else
    $GLOBALS['Page_API_Error_Code'] = 'G5';
set_error_handler("Error_Handeler");

/*
    -What is Doing ?
        Open A User Session

    Return :
        return array(-1, $MySql->Error, 'Getting User Data From DataBase', 'Open Session');
        return array(0, 'Not Found');
        return array(0, 'Done');

    - Opened Data :
        Email
        Name
        Phone
        Picture
        Status
        ID
        Posts
        
        N_Comment
        N_Negotations
        N_See
        N_Like
        N_Report_Post
        N_Report_Acount

        E_New_Updates
        E_Comment
        E_Negotations
        E_See
        E_Like
        E_Report_Post
        E_Report_Acount
*/
function OpenSession($Table){
    $MySql = new MYSQLClass('SignUP');
    $Hashing = new HashingClass();
// Getting Data Fro DataBase
    $MySql->SetUser('Log');
    if ( ( $Result = $MySql->FetchOneRow("SELECT * FROM $Table WHERE email = ?",
                    array(
                        $Hashing->Hash_Email($GLOBALS['E'])
                    )) ) == -1 )
        return array(-1, $MySql->Error, 'Getting User Data From DataBase', 'Open Session');
    else if ( $Result == 0 )
        return array(0, 'Not Found');
    $Data = $MySql->Fetched_Data;

// Get Hashed Email
    if ( $Hashing->Get_Hashed_Email($Data['email']) == -1 )
        return array(-1, $Hashing->Error, 'Getting Hashed Email From DataBase',
                                'Open Session');
    $_SESSION['Email'] = $Hashing->HashedText;

// Get Hashed Name
    if ( $Hashing->Get_Hashed_Name($Data['name']) == -1 )
        return array(-1, $Hashing->Error, 'Getting Hashed Name From DataBase',
                                'Open Session');
    $_SESSION['Name'] = $Hashing->HashedText;

// Get Hashed Phone
    if ( $Hashing->Get_Hashed_Phone($Data['phone']) == -1 )
        return array(-1, $Hashing->Error, 'Getting Hashed phone From DataBase',
                                'Open Session');
    $_SESSION['Phone'] = $Hashing->HashedText;

    if ( $Table == 'waiting_users' ){
        $_SESSION['Picture'] = DefultPicture;
        $_SESSION['Status'] = '2';
        $_SESSION['ID'] = '0';
        $_SESSION['Posts'] = '0';
    }
    else{
        // Get Hashed Picture
        if ( $Hashing->Get_Hashed_Picture($Data['picture']) == -1 )
            return array(-1, $Hashing->Error, 'Getting Hashed Picture From DataBase',
                                'Open Session');
        $_SESSION['Picture'] = $Hashing->HashedText;
        $_SESSION['Status'] = $Data['status'];
        $_SESSION['ID'] = $Data['id'];

        if ( ($Result = $MySql->
                    GetRowCount("SELECT COUNT(*) FROM posts WHERE user_email = '"
                            .$Hashing->Hash_Email($_SESSION['Email'])."'" )
                ) == -1 )
            return array(-1, $MySql->Error, 'Counting User Posts', 'Open Session');
        else
            $_SESSION['Posts'] = $Result;
    }

    // Some Features Of User
    $_SESSION['N_Comment'] = $Data['n_comment'];
    $_SESSION['N_Negotations'] = $Data['n_negotations'];
    $_SESSION['N_See'] = $Data['n_see'];
    $_SESSION['N_Like'] = $Data['n_like'];
    $_SESSION['N_Report_Post'] = $Data['n_report_post'];
    $_SESSION['N_Report_Acount'] = $Data['n_report_acount'];

    $_SESSION['E_New_Updates'] = $Data['e_new_updates'];
    $_SESSION['E_Comment'] = $Data['e_comment'];
    $_SESSION['E_Negotations'] = $Data['e_negotations'];
    $_SESSION['E_See'] = $Data['e_see'];
    $_SESSION['E_Like'] = $Data['e_like'];
    $_SESSION['E_Report_Post'] = $Data['e_report_post'];
    $_SESSION['E_Report_Acount'] = $Data['e_report_acount'];

    return array(0, 'Done');
}
?>