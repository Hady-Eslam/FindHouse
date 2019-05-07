<?php

use CoreModels\ModelExcutionEngine;
use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

/*
	Notifications Types
	1	=>	SomeOne Likes Your Post
	2	=>	SomeOne DisLikes Your Post
	3	=>	SomeOne Comment In Your Post

	4	=>	Admin Deleted Your Post
	5	=>	Admin Approved Your Post
	6	=>	Admin Rejected Your Post

	7	=>	User Wants To Approve Post From Admin
	8	=>	You Have New Message
*/

function Begin($Request){
	$_SESSION['Page Name'] = 'Notifications';
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Notifications');

	$MySql = new ModelExcutionEngine();
	$Hashing = new HashingEngine();

	$Result = $MySql->FetchAllRows(
		'SELECT * FROM notifications WHERE to_user = ? ORDER BY id DESC LIMIT 50',
		array(
			$Hashing->Hash_Notifications($_SESSION['Email'])
		));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Notifications');
	
	else if ( $Result->Result == 0 ){
		$GLOBALS['Result'] = [];
		$Notifications_Number = 0;
	}
	
	else{
		$GLOBALS['Result'] = $Result->Data;
		$Notifications_Number = $MySql->GetAffectedRowsNumber();
	}

	return (new SiteRenderEngine())->Notifications_Render($Notifications_Number);
}