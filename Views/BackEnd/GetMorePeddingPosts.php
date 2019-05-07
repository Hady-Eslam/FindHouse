<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\JsonEngine;

use Forms\BackEndForms\PeddingPostsForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	if ( !SESSION() || $_SESSION['Status'] != '0' )
		return (new SiteRenderEngine())->Not_Authurithed_User('Check User');

	else if ( $Request->isPOST() && $Request->CHECK_REFERER(PeddingPosts) )
		return GetMorePosts($Request->POST);

	return (new SiteRenderEngine())->Not_Authurithed_User('Check User');
}

function GetMorePosts($POST){

	$Form = new PeddingPostsForm($POST);
	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Check User');

	/*	GET USER DATA 		*/

	$MySQL = new ModelExcutionEngine();

	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM homes WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetHomes().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];

	else
		$GLOBALS['Result'] = $Result->Data;


	/*		GET MOBILES POSTS 	*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM mobiles WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetMobiles().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET CARS POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM cars WHERE status = ? AND deleted = ? LIMIT '
				.$Form->GetCars().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET ELC POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM elc WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetElc().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET LUX POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM lux WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetLux().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET FASHION POSTS 	*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM fashion WHERE status = ? AND deleted = ? LIMIT '
				.$Form->GetFashion().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET EAT POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM eat WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetEat().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET DOC POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM doc WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetDoc().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET ANT POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM ant WHERE status = ? AND deleted = ? LIMIT '
					.$Form->GetAnt().', 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);

	include_once _DIR_.'/TemplatesFilters/Profile/User.php';

	$String = GetUserPosts();

	return (new JsonEngine)->MakeJson( [
		'Count' => ( $String == '<p>No Posts Found</p>' ) ? False : True,
		'Posts' => $String
	] );
}