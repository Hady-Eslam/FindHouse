<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\JsonEngine;

use Forms\BackEndForms\FindForms\SearchLuxForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	if ( $Request->isPOST() )
		return GetMorePosts($Request->POST);

	return (new SiteRenderEngine())->Not_Authurithed_User('Find Accessories Tools');
}

function GetMorePosts($POST){

	$Form = new SearchLuxForm($POST);
	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Find Accessories Tools');


	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchAllRows('SELECT * FROM lux WHERE deleted = ? AND status = ? LIMIT '
			.$Form->GetLimit().' , 21',
		array(
			'0',
			'1'
		));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Find Accessories Tools');
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;
	
	include_once _DIR_.'/TemplatesFilters/Profile/User.php';

	$String = GetUserPosts();

	return (new JsonEngine)->MakeJson( [
		'Count' => ( $String == '<p>No Posts Found</p>' ) ? False : True,
		'Posts' => $String
	] );
}