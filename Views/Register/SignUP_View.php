<?php
include_once CheckUser;
include_once PHPMailClass;

function SignUP_Begin(){
    if ( (new URLClass())->Request() == "POST" )
        return SignUP_POST();
    return SignUP_GET();
}

function SignUP_POST(){
    $URL = new URLClass();
    if ( isset($_POST['N']) && isset($_POST['E']) && isset($_POST['P']) &&
        isset($_POST['Ph']) && $URL->REFFERE_is_SET() ){

        if ( !$URL->CheckREFFERE(SignUP) )
            StatusPages_Not_Authurithed_User_Page('Not Authorized Page');

        (new FILTERSClass())->FILTER_POST([
                'E' => ['Type' => 'EMAIL'],
                'N' => [ 'Type' => 'STRING', 'Len' => Name_Len ],
                'Ph' => [ 'Type' => 'STRING', 'Len' => Phone_Len ],
                'P' => [ 'Type' => 'STRING', 'Len' => Password_Len ]
            ], 'Redirect', SignUP );
        SignUP_CheckUser();
        SignUP_SaveData();
    }
    SignUP_GET();
}

function SignUP_GET($Result = ''){
    SignUp_SetVariables($Result);
    include_once SignUP_Template;
}

function SignUP_SetVariables($Result){
    if ( !isset($GLOBALS['N']) )
        $GLOBALS['N'] = '';
    if ( !isset($GLOBALS['E']) )
        $GLOBALS['E'] = '';
    if ( !isset($GLOBALS['Ph']) )
        $GLOBALS['Ph'] = '';
    if ( !isset($GLOBALS['P']) )
        $GLOBALS['P'] = '';

    $GLOBALS['Result'] = $Result;
}

function SignUP_CheckUser(){
    // Check Email
    if ( ($Result = CheckUserEmail($GLOBALS['E']))->Result == -1 )
        StatusPages_Error_Page('in Checking User Email');
    else if ( $Result->Data != 'email Not Found' )
        SignUP_GET('Email Found');

    // Check Name
    /*if ( ($Result = CheckUserName($GLOBALS['N']))->Result == -1 )
        StatusPages_Error_Page('in Checking User Name');
    else if ( $Result->Data != 'name Not Found' )
        SignUP_GET('Name Found');*/

    // Check Phone
    if ( ($Result = CheckUserPhone($GLOBALS['Ph']))->Result == -1 )
        StatusPages_Error_Page('in Checking User Phone');
    else if ( $Result->Data != 'phone Not Found' )
        SignUP_GET('Phone Found');
}

function SignUP_SaveData(){
    $MySql = new MYSQLClass('Register');
    $Hashing = new HashingClass();
    
    // insert Data
    if ( $MySql->excute("INSERT INTO waiting_users (email, name, phone, "
                ."password, sign_date) VALUES (?, ?, ?, ?, ?)", 
        array(
            $Hashing->Hash_WaitingUsers($GLOBALS['E']),
            $Hashing->Hash_WaitingUsers($GLOBALS['N']),
            $Hashing->Hash_WaitingUsers($GLOBALS['Ph']),
            $Hashing->Hash_WaitingUsers($GLOBALS['P']), 
            date('D d-m-Y H:i:s')
        ) )->Result == -1 )
        StatusPages_Error_Page('in inserting User Data into DataBase');
    
    // Get Token
    $RowCount = $MySql->GetRowCount('SELECT COUNT(*) FROM sign_up_token');
    if ( $RowCount->Result == -1 )
        StatusPages_Error_Page('in Getting Sign UP Token');
    
    // insert Token
    if ( $MySql->excute("INSERT INTO sign_up_token (token_email, token,"
            ." token_date) VALUES (?, ?, ?)",
        array(
            $Hashing->Hash_SignUP_Token($GLOBALS['E']),
            $Hashing->Hash_SignUP_Token($RowCount->Data),
            date('D d-m-Y H:i:s')
        ))->Result == -1 )
        StatusPages_Error_Page('in inserting Token into DataBase');
    
    // Send Email
    if ( ($Result = (new MailClass())
            ->SendMailToConfirm( $GLOBALS['E'], $RowCount->Data ))->Result == -1 )
        StatusPages_Error_Page('Send Email To Confirm User');
    else if ( $Result->Result == 0 )
        StatusPages_Error_Page('Failed in Sending Mail');
    Redirect(SuccessSignUP);
}