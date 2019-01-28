<?php set_error_handler("Error_Handeler");
include_once CheckUser;
include_once OpenSession;

function Login_Begin(){
	if ( (new URLClass())->Request() == "POST" )
		Login_POST();
	Login_GET();
}

function Login_POST(){
	$URL = new URLClass();
	if ( isset($_POST['E']) && isset($_POST['P']) && $URL->REFFERE_is_SET() ){
		if ( !$URL->CheckREFFERE(Login) )
			StatusPages_Not_Authurithed_User_Page();
		Login_CheckData();
	}
	Login_GET();
}

function Login_GET($Result = ''){
	Login_SetVariables($Result);
	include_once Login_Template;
}

function Login_SetVariables($Result){
	if ( !isset($GLOBALS['E']) )
		$GLOBALS['E'] = '';
	if ( !isset($GLOBALS['P']) )
		$GLOBALS['P'] = '';
	$GLOBALS['Result'] = $Result;
}

function Login_CheckData(){
    $Hashing = new HashingClass();
    (new FILTERSClass())->FILTER_POST([
            'E' => ['Type' => 'EMAIL'],
            'P' => ['Type' => 'STRING', 'Len' => Password_Len ] 
        ], 'Redirect', Login );

    // Check Email Found Or Not
    if ( ($Result = CheckUserEmail($GLOBALS['E']))->Result == -1 )
    	StatusPages_Error_Page('in Checking User Email');
    else if ( $Result->Data == 'email Not Found' )
    	Login_GET('Email Not Found');

    // Check if Password is Correct Or Not
    $Table = ($Result->Data == 'Found email in Users')?'users':'waiting_users';
    $Email = ($Table == 'users')?
    			$Hashing->Hash_Users($GLOBALS['E']):
    			$Hashing->Hash_WaitingUsers($GLOBALS['E']);
    $Password = ($Table == 'users')?
    			$Hashing->Hash_Users($GLOBALS['P']):
    			$Hashing->Hash_WaitingUsers($GLOBALS['P']);

    if ( ($Result = (new MYSQLClass('Register'))->FetchOneRow(
    		"SELECT * FROM $Table WHERE email = ?",
				array( $Email )))->Result == -1 )
    	StatusPages_Error_Page('Check if Password is Right Or Wrong');
    else
    	Login_CheckData_CheckAccount($Result->Data, $Table);
}

function Login_CheckData_CheckAccount($Data, $Table){
	if ( $Table == 'waiting_users'){
		if ( $Data['password'] != $GLOBALS['P'] )
			Login_GET('Wrong Password');
		Redirect(SuccessSignUP);
	}

    $Hashing = new HashingClass();
	if ( $Data['deleted'] == '1' )
		Login_GET('Email Not Found');
	else if ( $Data['password'] != $Hashing->Hash_Users($GLOBALS['P']) )
		Login_GET('Wrong Password');
	else if ( $Data['activate'] == '0' ){
		if ( ($Result = (new MYSQLClass('Register'))->
				excute('UPDATE users SET activate = ? WHERE email = ?',
						array(
							'1',
							$Hashing->Hash_Users($GLOBALS['E'])
						)))->Result == -1 )
			StatusPages_Error_Page('Error in Checking Account is Activate Or Not');
	}
	// Open Session
	if ( ($Result = OpenSession($GLOBALS['E']))->Result == -1 ||
		 $Result->Result == 0 && $Result->Data == 'User Not Found')
		StatusPages_Error_Page('in Opening Session');
	Redirect(Find);
}
?>