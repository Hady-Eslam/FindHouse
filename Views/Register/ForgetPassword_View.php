<?php set_error_handler("Error_Handeler");
include_once PHPMailClass;
include_once CheckUser;

function ForgetPassword_Begin(){
	if ( (new URLClass())->Request() == "POST" )
		ForgetPassword_POST();
	ForgetPassword_GET();
}

function ForgetPassword_POST(){
    $URL = new URLClass();
    if ( isset($_POST['E']) && $URL->REFFERE_is_SET() ){

        if ( !$URL->CheckREFFERE(ForgetPassword) )
            StatusPages_Not_Authurithed_User_Page();

        (new FILTERSClass())->FILTER_POST(
            [ 'E' => ['Type' => 'EMAIL'] ], 'Redirect', ForgetPassword);

        ForgetPassword_CheckData();
    }
    ForgetPassword_GET();
}

function ForgetPassword_GET($Result = ''){
    $GLOBALS['Result'] = $Result;
    include_once ForgetPassword_Template;
}

function ForgetPassword_CheckData(){
    $MySql = new MYSQLClass('Register');
    $Hashing = new HashingClass();

    // Check Email in DataBase
    if ( ($Result = CheckUserEmail($GLOBALS['E']))->Result == -1 )
        StatusPages_Error_Page('in Searching For User in DataBase');
    else if ( $Result->Data == 'Found email in Waiting_Users')
        Redirect(SuccessSignUP);
    else if ( $Result->Data != 'Found email in Users' )
    	ForgetPassword_GET('Email Not Found');

    // Make Log in Token
    $RowCount = $MySql->GetRowCount('SELECT COUNT(*) FROM log_in_token');
    if ( $RowCount->Result == -1 )
        StatusPages_Error_Page('Getting Token For SignUP');

    // Save Token into DataBase
    if ( ($Result=$MySql->excute("INSERT INTO log_in_token (token_email, token,"
            ." token_date) VALUES (?, ?, ?)",
        array(
            $Hashing->Hash_Login_Token($GLOBALS['E']),
            $Hashing->Hash_Login_Token($RowCount->Data),
            date('D d-m-Y H:i:s')
        )))->Result == -1 )
        StatusPages_Error_Page('inserting Token into DataBase');

    // Send Forget Password Email
    if ( ($Result = (new MailClass())->
            SendForgetPasswordMail( $GLOBALS['E'], $RowCount->Data )) ->Result == -1 )
        StatusPages_Error_Page('Send Email For Forget Password');
    else if ( $Result->Result == 0 )
        StatusPages_Error_Page('Failed in Sending Mail');

    ForgetPassword_GET('Done');
}
?>