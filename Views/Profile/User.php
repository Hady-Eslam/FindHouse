<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request, $User_ID){

	$_SESSION['Page Name'] = "User $User_ID";
	$Hashing = new HashingEngine();
	$MySQL = new ModelExcutionEngine();

	$User_Data = $MySQL->FetchOneRow(
			'SELECT * FROM users WHERE id = ? AND deleted = ? AND activate = ?',
		array(
			$User_ID,
			'0',
			'1'
		));
	if ( $User_Data->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("User $User_ID");

	else if ( $User_Data->Result == 0 )
		return (new SiteRenderEngine())->Not_Found_Page();

	$Data = $Hashing->Get_Data_From_Hash([
		['Type' => 'User', 'Data' => $User_Data->Data['picture'], 'Key' => 'User_Picture',
			'Default' => OnLineUser ],
		['Type' => 'User', 'Data' => $User_Data->Data['name'], 'Key' => 'Base_User_Name' ],
		['Type' => 'User', 'Data' => $User_Data->Data['email'], 'Key' => 'Base_User_Email' ]
	]);

	if ( $Data->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("User $User_ID");



/*	GET USER DATA 		*/
	
	$Posts_Number = 0;

	$Result = $MySQL->FetchAllRows('SELECT * FROM homes WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_HOMES($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];

	else{
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = $Result->Data;
	}


	/*		GET MOBILES POSTS 	*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM mobiles WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_MOBILES($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}


	/*		GET CARS POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM cars WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_CARS($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}



	/*		GET ELC POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM elc WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}


	/*		GET LUX POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM lux WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}



	/*		GET FASHION POSTS 	*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM fashion WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}


	/*		GET EAT POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM eat WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_EAT($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}



	/*		GET DOC POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM doc WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($Data->Data['Base_User_Email']), '0', '1'));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}



	/*		GET ANT POSTS 		*/
	$Result = $MySQL->FetchAllRows('SELECT * FROM ant WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( $Hashing->Hash_ELC($Data->Data['Base_User_Email']), '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('User '.$Data->Data['Base_User_Name']);

	else if ( $Result->Result == 1 ){
		$Posts_Number += $MySQL->GetAffectedRowsNumber();
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);
	}

	return (new SiteRenderEngine())->User_Render( $Data->Data, $User_ID, $Posts_Number );
}
