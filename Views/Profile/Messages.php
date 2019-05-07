<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){

	$_SESSION['Page Name'] = 'ALL Messages';
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User('All Messages');

	$Hashing = new HashingEngine();
	$Result = (new ModelExcutionEngine())->FetchAllRows(
			'SELECT * FROM messages WHERE ( user_email = ? OR message_email = ? ) AND deleted = ? ORDER BY id DESC',
			array(
				(new HashingEngine())->Hash_Messages($_SESSION['Email']),
				(new HashingEngine())->Hash_Messages($_SESSION['Email']),
				'0'
			));
	
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('All Messages');

	else if ( $Result->Result == 0 )
		$GLOBALS['Messages'] = [];
	else
		$GLOBALS['Messages'] = $Result->Data;

	return (new SiteRenderEngine())->Messages_Render('All Messages');
}