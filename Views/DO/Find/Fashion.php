<?php

use SiteEngines\HashingEngine;
use SiteEngines\SiteRenderEngine;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	$_SESSION['Page Name'] = 'Fashion';

	$Result = (new ModelExcutionEngine())->FetchAllRows(
		'SELECT * FROM fashion WHERE deleted = ? AND status = ? LIMIT 21',
			array('0', '1'));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Find Fashion');

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;

	return (new SiteRenderEngine())->Fashion_Render();
}