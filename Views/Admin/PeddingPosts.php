<?php

use CoreModels\ModelExcutionEngine;
use SiteEngines\SiteRenderEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	$_SESSION['Page Name'] = 'Pedding Posts';

	if ( !SESSION() || $_SESSION['Status'] != '0' )
		return (new SiteRenderEngine())->Not_Authurithed_User('Pedding Posts');

	/*	GET USER DATA 		*/

	$MySQL = new ModelExcutionEngine();

	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM homes WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];

	else
		$GLOBALS['Result'] = $Result->Data;


	/*		GET MOBILES POSTS 	*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM mobiles WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET CARS POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM cars WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET ELC POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM elc WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET LUX POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM lux WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);



	/*		GET FASHION POSTS 	*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM fashion WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET EAT POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM eat WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET DOC POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM doc WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);


	/*		GET ANT POSTS 		*/
	$Result = $MySQL->FetchAllRows(
			'SELECT * FROM ant WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array( '0', '0' ));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Pedding Posts');

	else if ( $Result->Result == 1 )
		$GLOBALS['Result'] = array_merge($GLOBALS['Result'], $Result->Data);

	return (new SiteRenderEngine())->PeddingPosts_Render();
}