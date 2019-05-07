<?php

use SiteEngines\HashingEngine;
use SiteEngines\SiteRenderEngine;

use CoreModels\ModelExcutionEngine;

use Forms\DOForms\FindForms\SearchMobilesForm;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	$_SESSION['Page Name'] = 'Mobiles';

	if ( $Request->isPOST() )
		return Mobiles_Post($Request);

	$MySql = new ModelExcutionEngine();

	$Result = $MySql->FetchAllRows('SELECT * FROM mobiles WHERE deleted = ? AND status = ? LIMIT 21',
			array('0', '1'));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Find Mobiles');

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;

	return (new SiteRenderEngine())->Mobiles_Render('All', 'All', 'All');
}

function Mobiles_Post($Request){
	
	$Form = new SearchMobilesForm($Request->POST);
	$Form->isValid();

	$MySql = new ModelExcutionEngine();

	$Result = $MySql->FetchAllRows('SELECT * FROM mobiles '.$Form->GetQuery().' LIMIT 21',
		array(
			'0',
			'1'
		));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Find Mobiles');
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;

	return (new SiteRenderEngine())->Mobiles_Render(
		$Form->GetTrueType(),
		$Form->GetTrueStatus(),
		$Form->GetTruePrice());
}