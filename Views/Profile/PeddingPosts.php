<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\HashingEngine;
use SiteEngines\SiteRenderEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){

	$_SESSION['Page Name'] = 'My Profile';
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User('My Profile');

	/*		GET HOMES POSTS 	*/
	$MySQL = new ModelExcutionEngine();
	$Hashing = new HashingEngine();
	$Result = $MySQL->FetchAllRows('SELECT * FROM homes WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_HOMES($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];

	else
		$GLOBALS['Result'] = $Result->Data;


	/*		GET MOBILES POSTS 	*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM mobiles WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_MOBILES($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('My Profile');

	else if ( $Result->Result != 0 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET CARS POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM cars WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_CARS($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET ELC POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM elc WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET LUX POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM lux WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET FASHION POSTS 	*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM fashion WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET EAT POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM eat WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_EAT($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET DOC POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM doc WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($_SESSION['Email']), '0', '0'));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET ANT POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM ant WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("My Profile");

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	
	return (new SiteRenderEngine())->MyProfile_Render();
}