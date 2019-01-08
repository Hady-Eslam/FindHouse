<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once MySqlDB;
include_once HashClass;
include_once PHPMailClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.P5F1';
else
    $GLOBALS['Page_API_Error_Code'] = 'P5F1';
set_error_handler("Error_Handeler");

/*
    - What is Doing ?
        Check Token is Found or Not, if Found Send Mail With this Token Else
        Make new Token, Save it, Send Mail

    Return :
        return array(-1, $MySql->Error, 'Check Token Found Or Not', 'GetToken_SendMail');
        return array(-1, $MySql->Error, 'Getting Token', 'GetToken_SendMail');
        return array(-1, $MySql->Error, 'Saving Token into DataBase', 'GetToken_SendMail');
        return array(-1, $PHPMail->Error, 'Sending Email', 'GetToken_SendMail');
        return array(0, 'Failed To Send Email', 'GetToken_SendMail');
        return array(0, 'Done');
*/
function GetToken_SendMail(){
    $MySql = new MYSQLClass('Log');
    $Hashing = new HashingClass();

// Check if Token is Found Or Not
    $Result = $MySql->FetchOneRow('SELECT * FROM log_token WHERE token_email = ?',
            array(
                $Hashing->Hash_Email($GLOBALS['E'])
            ));
    if ( $Result == -1 )
        return array(-1, $MySql->Error, 'Check Token Found Or Not', 'GetToken_SendMail');
    else if ( $Result == 1 ){
        $Result = $Hashing->Get_Hashed_Token($MySql->Fetched_Data['token']);
        if ( $Result == -1 )
            return array(-1, $MySql->Error, 'Get Token From Hashing', 'GetToken_SendMail');
        return SendMail( $Hashing->HashedText );
    }

// Getting Token
    $Result = $MySql->GetRowCount('SELECT count(*) FROM log_token');

    if ( $Result == -1 )
        return array(-1, $MySql->Error, 'Getting Token', 'GetToken_SendMail');

    $Token = ( $Result * 5 ) + 16;

// INSERTING Token
    if ( $MySql->excute('INSERT INTO log_token (token_email, token, token_date)'
                    .' VALUES (?, ?, ?)',
                    array(
                        $Hashing->Hash_Email($GLOBALS['E']),
                        $Hashing->Hash_Token($Token),
                        date('D d-m-Y H:i:s')
                    )) == -1 )
        return array(-1, $MySql->Error, 'Saving Token into DataBase', 'GetToken_SendMail');
    return SendMail($Token);
}

function SendMail($Token){
    $PHPMail = new MailClass();
    
    if ( ($Result = $PHPMail->SendForgetPasswordMail($GLOBALS['E'], $Token)) == -1 )
        return array(-1, $PHPMail->Error, 'Sending Email', 'GetToken_SendMail');
    else if ( $Result == 0 )
        return array(0, 'Failed To Send Email', 'GetToken_SendMail');
    return array(0, 'Done');
}
?>