<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use Forms\ProfileForms\NameForm;
use Forms\ProfileForms\PhoneForm;
use Forms\ProfileForms\AddressForm;
use Forms\ProfileForms\PasswordForm;
use Forms\ProfileForms\PictureForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;
include_once CheckUser;

function Begin($Request){
	
	$_SESSION['Page Name'] = 'Settings';
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Settings');

	else if ( $Request->isPOST() && $Request->IN_POST('Name') )
		return Settings_POST_Name($Request);

	else if ( $Request->isPOST() && $Request->IN_POST('Phone') )
		return Settings_POST_Phone($Request);

	else if ( $Request->isPOST() && $Request->IN_POST('Address') )
		return Settings_POST_Address($Request);

	else if ( $Request->isPOST() && $Request->IN_POST('Password', 'OldPassword') )
		return Settings_POST_Password($Request);

	else if ( $Request->isPOST() && $Request->IN_FILES('File1') )
		return Settings_POST_Picture($Request);
	
	return Settings_GET($Request);


	return Settings_GET_Picture($Request);
}

function Settings_GET($Request){
	
	if ( $Request->IN_GET('PictureDone') )
		$GLOBALS['Result'] = 'PictureDone';
	
	else if ( $Request->IN_GET('NameDone') )
		$GLOBALS['Result'] = 'NameDone';
	
	else if ( $Request->IN_GET('ReservedPhone') )
		$GLOBALS['Result'] = 'ReservedPhone';

	else if ( $Request->IN_GET('PhoneDone') )
		$GLOBALS['Result'] = 'PhoneDone';

	else if ( $Request->IN_GET('AddressDone') )
		$GLOBALS['Result'] = 'AddressDone';

	else if ( $Request->IN_GET('WrongPassword') )
		$GLOBALS['Result'] = 'WrongPassword';

	else if ( $Request->IN_GET('PasswordDone') )
		$GLOBALS['Result'] = 'PasswordDone';

	else
		$GLOBALS['Result'] = '';

	$GLOBALS['Section'] = 'Settings';

	return (new SiteRenderEngine())->Settings_Render('Settings');
}

function Settings_POST_Name($Request){
	
	$Form = new NameForm($Request->POST);
	if ( !$Form->isValid() )
		return Settings_GET($Request);

    // Save in DataBase
    $Hashing = new HashingEngine();
    if ((new ModelExcutionEngine())->
    		excute('UPDATE users SET name = ? WHERE email = ?',
			array(
				$Hashing->Hash_Users( $Form->GetName() ),
				$Hashing->Hash_Users( $_SESSION['Email'] )
			))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Settings');

    $_SESSION['Name'] = $Form->GetName();
    Redirect(Settings.'?NameDone');
}

function Settings_POST_Phone($Request){

	$Form = new PhoneForm($Request->POST);
	if ( !$Form->isValid() )
		return Settings_GET($Request);

    // Check Phone
    if ( ($Result = CheckUserPhone( $Form->GetPhone() ))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Phone Settings');

    else if ( $Result->Data != 'phone Not Found')
    	Redirect(Settings.'?ReservedPhone');

    $Hashing = new HashingEngine();
    // Save in DataBase
    if ((new ModelExcutionEngine())
    		->excute('UPDATE users SET phone = ? WHERE email = ?',
			array(
				$Hashing->Hash_Users( $Form->GetPhone() ),
				$Hashing->Hash_Users( $_SESSION['Email'] )
			))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Phone Settings');

    $_SESSION['Phone'] = $Form->GetPhone();
    Redirect(Settings.'?PhoneDone');
}

function Settings_POST_Address($Request){

	$Form = new AddressForm($Request->POST);
	if ( !$Form->isValid() )
		Settings_GET($Request);

    // Save in DataBase
    $Hashing = new HashingEngine();
    if ((new ModelExcutionEngine())->
    		excute('UPDATE users SET address = ? WHERE email = ?',
			array(
				$Hashing->Hash_Users( $Form->GetAddress() ),
				$Hashing->Hash_Users( $_SESSION['Email'] )
			))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Settings');

    $_SESSION['Address'] = $Form->GetAddress();
    Redirect(Settings.'?AddressDone');
}

function Settings_POST_Password($Request){

	$Form = new PasswordForm($Request->POST);
	if ( !$Form->isValid() )
		return Settings_GET($Request);

    // Check Old Password
    $MySql = new ModelExcutionEngine();
    $Hashing = new HashingEngine();
    if ( ($Result = $MySql->isFound('SELECT password FROM users WHERE password = ?'
    		.' AND email = ?',
					array(
						$Hashing->Hash_Users( $Form->GetOldPassword() ),
						$Hashing->Hash_Users( $_SESSION['Email'] )
					)))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Settings');

    else if ( $Result->Result == 0 )
    	Redirect(Settings.'?WrongPassword');

    // Save in DataBase
    if ( ($Result = $MySql->excute('UPDATE users SET password = ? WHERE email = ?',
			array(
				$Hashing->Hash_Users( $Form->GetPassword() ),
				$Hashing->Hash_Users( $_SESSION['Email'] )
			)))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Settings');
    Redirect(Settings.'?PasswordDone');
}

function Settings_POST_Picture($Request){

	$Form = new PictureForm($Request->FILES);
	if ( !$Form->isValid() )
		return Settings_GET($Request);

    // Process Image
    if ( $Form->GetFile1()['error'] != -1 ){

    	$Ext = pathinfo( $Form->GetFile1()['name'], PATHINFO_EXTENSION );
    	$NewName = UserPictures.'User'.$_SESSION['ID'].'/ProfilePicture.'.$Ext;
		if ( file_exists( $NewName ) == True )
			unlink( $NewName );
		$Result = rename( $Form->GetFile1()['tmp_name'], $NewName);
		
		if ( $Result == True ){
			$Pic = UserPictures_HTTP.'User'.$_SESSION['ID'].'/ProfilePicture.'.$Ext;
			
		    // Save in DataBase
			$Hashing = new HashingEngine();
		    if ((new ModelExcutionEngine())
		    		->excute('UPDATE users SET picture = ? WHERE'
		    		.' email = ?',
						array(
							$Hashing->Hash_Users( $Pic ),
							$Hashing->Hash_Users( $_SESSION['Email'] )
						))->Result == -1 )
		    	return (new SiteRenderEngine())->Error_Page('Settings');
		    $_SESSION['Picture'] = $Pic;
		}
    }
    Redirect(Settings.'?PictureDone');
}