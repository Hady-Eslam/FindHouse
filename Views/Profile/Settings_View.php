<?php set_error_handler("Error_Handeler");
include_once CheckUser;

function Settings_Begin($incomingURL){
	if ( (new URLClass())->Request() == "POST")
		Settings_POST($incomingURL);
	Settings_GET($incomingURL);
}

function Settings_POST($incomingURL){
	$URL = new URLClass();
	if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings(\?(.+))?/', $incomingURL ) ||
		$URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Picture(\?(.+))?/', $incomingURL ))
		Settings_POST_Picture();
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Name(\?(.+))?/', $incomingURL ) )
		Settings_POST_Name();
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Phone(\?(.+))?/', $incomingURL ) )
		Settings_POST_Phone();
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Password(\?(.+))?/', $incomingURL ))
		Settings_POST_Password();
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/DeActivate(\?(.+))?/',$incomingURL))
		Settings_POST_DeActivate();
}

function Settings_GET($incomingURL){
	Settings_SetVariables($incomingURL);
	include_once Settings_Template;
}

function Settings_SetVariables($incomingURL){
	$URL = new URLClass();
	if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Name(\?(.+))?/', $incomingURL ) )
		$GLOBALS['Section'] = 'Name';
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Password(\?(.+))?/', $incomingURL ))
		$GLOBALS['Section'] = 'Password';
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Phone(\?(.+))?/', $incomingURL ) )
		$GLOBALS['Section'] = 'Phone';
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/DeActivate(\?(.+))?/',$incomingURL))
		$GLOBALS['Section'] = 'DeActivate';
	else if ( $URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings(\?(.+))?/', $incomingURL ) ||
		$URL->Match(
		'/http:\/\/findhouse\.com\/Profile\/Settings\/Picture(\?(.+))?/', $incomingURL ))
		$GLOBALS['Section'] = 'Picture';

	if ( isset($_GET['NameDone']) )
		$GLOBALS['Result'] = 'NameDone';
	else if ( isset($_GET['PhoneDone']) )
		$GLOBALS['Result'] = 'PhoneDone';
	else if ( isset($_GET['PictureDone']) )
		$GLOBALS['Result'] = 'PictureDone';
	else if ( isset($_GET['WrongPassword']) )
		$GLOBALS['Result'] = 'WrongPassword';
	else if ( isset($_GET['PasswordDone']) )
		$GLOBALS['Result'] = 'PasswordDone';
	else if ( isset($_GET['ReservedName']) )
		$GLOBALS['Result'] = 'ReservedName';
	else
		$GLOBALS['Result'] = '';
}

function Settings_POST_Name(){
	$URL = new URLClass();
	$Hashing = new HashingClass();

	if ( $URL->REFFERE_is_SET() && isset($_POST['NameSubmit']) && isset($_POST['N'])){
		
		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings\/Name(\?(.+))?/',
			$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();
		
		(new FILTERSClass())->FILTER_POST(
            [ 'N' => [ 'Type' => 'STRING', 'Len' => Name_Len] ],
            'Redirect', Settings.'/Password');

	    // Check Name
	    if ( ($Result = CheckUserName($GLOBALS['N']))->Result == -1 )
	    	 StatusPages_Error_Page();
	    else if ( $Result->Data != 'name Not Found')
	    	Redirect(Settings.'/Name?ReservedName');

	    // Save in DataBase
	    if ((new MYSQLClass('Settings'))
	    		->excute('UPDATE users SET name = ? WHERE email = ?',
				array(
					$Hashing->Hash_Users($GLOBALS['N']),
					$Hashing->Hash_Users($_SESSION['Email'])
				))->Result == -1 )
	    	StatusPages_Error_Page('Saving Name into DataBase');
	    $_SESSION['Name'] = $GLOBALS['N'];
	    Redirect(Settings.'/Name?NameDone');
	}
	StatusPages_Not_Authurithed_User_Page();
}

function Settings_POST_Phone(){
	$URL = new URLClass();
	$Hashing = new HashingClass();

	if ( $URL->REFFERE_is_SET() && isset($_POST['PhoneSubmit'])&&isset($_POST['Ph'])){
		
		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings\/Phone(\?(.+))?/',
			$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();

		(new FILTERSClass())->FILTER_POST(
            [ 'Ph' => [ 'Type' => 'STRING', 'Len' => Phone_Len] ],
            'Redirect', Settings.'/Phone');

	    // Save in DataBase
	    if ((new MYSQLClass('Settings'))->
	    		excute('UPDATE users SET phone = ? WHERE email = ?',
				array(
					$Hashing->Hash_Users($GLOBALS['Ph']),
					$Hashing->Hash_Users($_SESSION['Email'])
				))->Result == -1 )
	    	StatusPages_Error_Page('Saving Phone into DataBase');
	    Redirect(Settings.'/Phone?PhoneDone');
	}
	StatusPages_Not_Authurithed_User_Page();
}

function Settings_POST_Password(){
	$URL = new URLClass();
	$MySql = new MYSQLClass('Settings');
	$Hashing = new HashingClass();

	if ( $URL->REFFERE_is_SET() && isset($_POST['PasswordSubmit']) &&
		 isset($_POST['P']) && isset($_POST['OP']) ){

		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings\/Password(\?(.+))?/',
			$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();

		(new FILTERSClass())->FILTER_POST([ 
            	'OP' => [ 'Type' => 'STRING', 'Len' => Password_Len ],
              	'P' => [ 'Type' => 'STRING', 'Len' => Password_Len ]
            ], 'Redirect', Settings.'/Password');

	    // Check Old Password
	    if ( ($Result = $MySql->isFound('SELECT password FROM users WHERE password = ?'
	    		.' AND email = ?',
						array(
							$Hashing->Hash_Users($GLOBALS['OP']),
							$Hashing->Hash_Users($_SESSION['Email'])
						)))->Result == -1 )
	    	StatusPages_Error_Page('in Checking Old Password');
	    else if ( $Result->Result == 0 )
	    	Redirect(Settings.'/Password?WrongPassword');

	    // Save in DataBase
	    if ( ($Result = $MySql->excute('UPDATE users SET password = ? WHERE email = ?',
				array(
					$Hashing->Hash_Users($GLOBALS['P']),
					$Hashing->Hash_Users($_SESSION['Email'])
				)))->Result == -1 )
	    	StatusPages_Error_Page('in Saving Password into DataBase');
	    Redirect(Settings.'/Password?PasswordDone');
	}
	StatusPages_Not_Authurithed_User_Page();
}

function Settings_POST_DeActivate(){
	$URL = new URLClass();
	$MySql = new MYSQLClass('Settings');
	$Hashing = new HashingClass();

	if ( $URL->REFFERE_is_SET() &&
		( isset($_POST['DeactivateSubmit']) || isset($_POST['DeleteSubmit']) ) ){
		
		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings\/DeActivate(\?(.+))?/',
			$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();

		if ( isset($_POST['DeactivateSubmit']) ){
			if ( ($Result=$MySql->excute('UPDATE users SET activate = ? WHERE email = ?',
							array(
								'0',
								$Hashing->Hash_Users($_SESSION['Email'])
							)))->Result == -1 )
				StatusPages_Error_Page('DeActivate The Account');
			Redirect(LogOut);
		}
		else if ( isset($_POST['DeleteSubmit']) ){
			if ( ($Result=$MySql->excute('UPDATE users SET deleted = ? WHERE email = ?',
							array(
								'1',
								$Hashing->Hash_Users($_SESSION['Email'])
							)))->Result == -1 )
				StatusPages_Error_Page('Delete The Account');
			Redirect(LogOut);
		}
	}
	StatusPages_Not_Authurithed_User_Page();
}

function Settings_POST_Picture(){
	$URL = new URLClass();
	$Hashing = new HashingClass();
	$FILTER = new FILTERSClass(); 

	if ( $URL->REFFERE_is_SET() && isset($_POST['PictureSubmit']) ){

		if ( !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings(\?(.+))?/',
				$URL->Get_REFFERE()) &&  !$URL->Match(
			'/http:\/\/findhouse\.com\/Profile\/Settings\/Picture(\?(.+))?/',
				$URL->Get_REFFERE()) )
			StatusPages_Not_Authurithed_User_Page();
			
		$GLOBALS['Pic'] = true;
	    if ( (new $FILTER())->FilterPicture('File1')->Result != 'OK' )
	    	$GLOBALS['Pic'] = false;

	    // Process File
	    if ( $GLOBALS['Pic'] == true ){

	    	$Ext = pathinfo($_FILES['File1']['name'], PATHINFO_EXTENSION);
	    	$NewName = UserPictures.'User'.$_SESSION['ID'].'/ProfilePicture.'.$Ext;
			if ( file_exists( $NewName ) == true )
				unlink( $NewName );
			$Result = rename( $_FILES['File1']['tmp_name'], $NewName);
			
			if ( $Result == true ){
				$GLOBALS['Pic'] = UserPictures_HTTP.'User'.$_SESSION['ID']
						.'/ProfilePicture.'.$Ext;
			    
			    // Save in DataBase
			    if ((new MYSQLClass('Settings'))
			    		->excute('UPDATE users SET picture = ? WHERE'
			    		.' email = ?',
							array(
								$Hashing->Hash_Users($GLOBALS['Pic']),
								$Hashing->Hash_Users($_SESSION['Email'])
							))->Result == -1 )
			    	StatusPages_Error_Page('Saving Picture into DataBase');
			    $_SESSION['Picture'] = $GLOBALS['Pic'];
			}
	    }
	    Redirect(Settings.'/Picture?PictureDone');
	}
	StatusPages_Not_Authurithed_User_Page();
}
?>