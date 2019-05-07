<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\JSONEngine;
use SiteEngines\HashingEngine;

use Forms\BackEndForms\DeletePostForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	
	if ( !SESSION() || !$Request->isPOST() || !$Request->CHECK_REFERER(MyProfile) )
		return (new SiteRenderEngine())->Not_Authurithed_User('Delete Post');

	$MySql = new ModelExcutionEngine();

	$Form = new DeletePostForm($Request->POST);
	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Delete Post');

	if ( ($Result = $MySql->isFound(
			'SELECT * FROM '.$Form->GetTable().' WHERE id = ? AND user_email = ? AND deleted = ?',
			array(
				$Form->GetID(),
				$Form->GetHashedEmail($_SESSION['Email']),
				'0'
			)))->Result == -1 )
		return (new JSONEngine())->MakeJson(Returns(-1, 'Searching For Post', $Result->Error));

	else if ( $Result->Result == 0 )
		return (new JSONEngine())->MakeJson(Returns(0, 'Not Found'));

	if ( ($Result = $MySql->excute('UPDATE '.$Form->GetTable().' SET deleted = ? WHERE id = ?',
				array('1', $Form->GetID()) ))->Result == -1 )
		return (new JSONEngine())->MakeJson(Returns(-1, 'Deleting Post', $Result->Error));

	if ( $_SESSION['Posts'] != 0 )
		$_SESSION['Posts'] -= 1;
	return (new JSONEngine())->MakeJson(Returns(1, 'Done'));
}