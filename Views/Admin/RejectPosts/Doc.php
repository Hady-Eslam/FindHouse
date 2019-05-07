<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request, $Post_ID){

	$_SESSION['Page Name'] = "Reject User Post $Post_ID";

	if ( !SESSION() || $_SESSION['Status'] != '0' )
		return (new SiteRenderEngine())->Not_Authurithed_User("Reject User Post $Post_ID");

	$MySql = new ModelExcutionEngine();
	$Hashing = new HashingEngine();
	$GLOBALS['Page Name'] = 'Reject Post '.$Post_ID;

	$Result = $MySql->FetchOneRow('SELECT * FROM doc WHERE id = ? AND deleted = ?',
		array(
			$Post_ID,
			'0'
		));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Reject User Post $Post_ID");
	
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = 'Post Not Found';
	else{
		$Email = $Hashing->Get_Hashed_ELC($Result->Data['user_email']);
		$Result = $MySql->excute('UPDATE doc SET status = ? WHERE id = ?',
			array(
				'-1',
				$Post_ID
			));
		if ( $Result->Result == -1 )
			return (new SiteRenderEngine())->Error_Page("Reject User Post $Post_ID");
		else{
			$GLOBALS['Result'] = 'Posts Rejected';
			if ( $Email->Result == 1 ){

				$MySql->excute('INSERT INTO notifications(from_user, to_user, notification_type, message, notification_date) VALUES(?, ?, ?, ?, ?)',
				array(
					$Hashing->Hash_Notifications($_SESSION['Email']),
					$Hashing->Hash_Notifications($Email->Data),
					'6',
					$Hashing->Hash_Notifications("Your Post $Post_ID Has Been Rejected"),
					date('D d-m-Y H:i:s')
				));
			}
		}
	}

	return (new SiteRenderEngine())->RejectUserPost_Render();
}