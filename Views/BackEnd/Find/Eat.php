<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\JsonEngine;

use Forms\BackEndForms\FindForms\SearchEatForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	if ( $Request->isPOST() )
		return GetMorePosts($Request->POST);

	return (new SiteRenderEngine())->Not_Authurithed_User('Find Foods');
}

function GetMorePosts($POST){

	$Form = new SearchEatForm($POST);
	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Find Foods');

	
	$Result = (new ModelExcutionEngine())->FetchAllRows(
		'SELECT * FROM eat WHERE deleted = ? AND status = ? LIMIT '
			.$Form->GetLimit().' , 21',
		array(
			'0',
			'1'
		));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Find Foods');
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