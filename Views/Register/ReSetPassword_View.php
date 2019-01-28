<?php set_error_handler("Error_Handeler");
include_once CheckToken;
include_once ChangePassword;

function ReSetPassword_Begin(){
	if ( (new URLClass())->Request() == "POST")
		ReSetPassword_POST();
	ReSetPassword_GET();
}

function ReSetPassword_POST(){
	$URL = new URLClass();
	if ( isset($_POST['E']) && isset($_POST['T']) && isset($_POST['P']) &&
		 $URL->REFFERE_is_SET() ){
		
		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Register\/ReSetPassword\?E=(.*)&T=(.*)/',
			$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();
		
		(new FILTERSClass())->FILTER_POST([
            	'E' => ['Type' => 'EMAIL'],
            	'T' => ['Type' => 'STRING', 'Len' => Token_Len ],
            	'P' => ['Type' => 'STRING', 'Len' => Password_Len ]
        	], 'StatusPages_Not_Authurithed_User_Page' );

		$Result = Check_Login_Token($GLOBALS['E'], $GLOBALS['T']);
		if ( $Result->Result == -1 )
			StatusPages_Error_Page();
		else if ( $Result->Result != 'Found' )
			StatusPages_Not_Authurithed_User_Page();

		$Token_ID = $Result->Data['token_id'];
		
		$Result = ChangePassword($GLOBALS['E'], $GLOBALS['P']);
		if ( $Result->Result == -1 )
			StatusPages_Error_Page($Result->Data);

		// Delete Token From DataBase
		$Result = (new MYSQLClass('Register'))->excute(
					'DELETE FROM log_in_token WHERE token_id = ?', array( $Token_ID ));

		ReSetPassword_OpenTemplate('Done');
	}
	StatusPages_Not_Authurithed_User_Page();
}

function ReSetPassword_GET(){
	if ( (new URLClass())->Request() == 'GET' && isset($_GET['E']) && isset($_GET['T'])){
		
		ReSetPassword_Check_GET_Data();
		$Result = Check_Login_Token($GLOBALS['E'], $GLOBALS['T']);
		if ( $Result->Result == -1 )
			StatusPages_Error_Page();
		else if ( $Result->Result == 'Found' )
			ReSetPassword_OpenTemplate();
	}
	StatusPages_Not_Authurithed_User_Page();
}

function ReSetPassword_OpenTemplate($Result = ''){
	$GLOBALS['Result'] = $Result;
	include_once ReSetPassword_Template;
}

function ReSetPassword_Check_GET_Data(){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => 'Login_Token', 'Data' => $_GET['E'], 'Key' => 'E' ],
		['Type' => 'Login_Token', 'Data' => $_GET['T'], 'Key' => 'T' ],
	], 'StatusPages_Not_Authurithed_User_Page');
	
	$_GET['E'] = $GLOBALS['E'];
	$_GET['T'] = $GLOBALS['T'];

	(new FILTERSClass())->FILTER_GET([
    	'E' => ['Type' => 'EMAIL'],
    	'T' => ['Type' => 'STRING', 'Len' => Token_Len ]
	], 'StatusPages_Not_Authurithed_User_Page' );
}
?>