<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request, $Message_ID){
	$_SESSION['Page Name'] = "Message $Message_ID";
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User("Message $Message_ID");

	$MySql = new ModelExcutionEngine();
	$Hashing = new HashingEngine();

	$Result = $MySql->FetchOneRow('SELECT * FROM messages WHERE id = ? AND ( message_email = ? OR user_email = ? ) AND deleted = ?',
		array(
			$Message_ID,
			$Hashing->Hash_Messages($_SESSION['Email']),
			$Hashing->Hash_Messages($_SESSION['Email']),
			'0'
		));
	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Message $Message_ID");

	else if ( $Result->Result == 0 || $Result->Data['post_category'] == '0' ||
			$Result->Data['post_category'] > 9 )
		return (new SiteRenderEngine())->Not_Found_Page();

	if ( $Result->Data['post_category'] == '1' ){
		$TableName = 'homes';
		$HashType = 'HOMES';
	}
	else if ( $Result->Data['post_category'] == '2' ){
		$TableName = 'mobiles';
		$HashType = 'MOBILES';
	}
	else if ( $Result->Data['post_category'] == '3' ){
		$TableName = 'cars';
		$HashType = 'CARS';
	}
	else if ( $Result->Data['post_category'] == '4' ){
		$TableName = 'elc';
		$HashType = 'ELC';
	}
	else if ( $Result->Data['post_category'] == '5' ){
		$TableName = 'lux';
		$HashType = 'ELC';
	}
	else if ( $Result->Data['post_category'] == '6' ){
		$TableName = 'fashion';
		$HashType = 'ELC';
	}
	else if ( $Result->Data['post_category'] == '7' ){
		$TableName = 'eat';
		$HashType = 'EAT';
	}
	else if ( $Result->Data['post_category'] == '8' ){
		$TableName = 'doc';
		$HashType = 'ELC';
	}
	else if ( $Result->Data['post_category'] == '9' ){
		$TableName = 'ant';
		$HashType = 'ELC';
	}

	$Message = $Result->Data;

	$Data = (new HashingEngine())->Get_Data_From_Hash([
		['Type' => '', 'Data' => $Message['id'], 'Key' => 'MESSAGE_ID' ],
		['Type' => 'Messages', 'Data' => $Message['user_email'], 'Key' => 'User_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_email'], 'Key' => 'Message_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_body'], 'Key' => 'Message_Body'],
		['Type' => '', 'Data' => $Message['message_date'], 'Key' => 'Message_Date'],
		['Type' => '', 'Data' => $Message['post_id'], 'Key' => 'Post_id'],
		['Type' => '', 'Data' => $Message['post_category'], 'Key' => 'Post_Category'],

		['Type' => 'Messages', 'Data' => $Message['f1_picture'], 'Key' => 'Picture1'],
		['Type' => 'Messages', 'Data' => $Message['f2_picture'], 'Key' => 'Picture2'],
		['Type' => 'Messages', 'Data' => $Message['f3_picture'], 'Key' => 'Picture3'],
		['Type' => 'Messages', 'Data' => $Message['f4_picture'], 'Key' => 'Picture4'],
		['Type' => 'Messages', 'Data' => $Message['f5_picture'], 'Key' => 'Picture5'],

	]);

	if ( $Data->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Message $Message_ID");


	$Result = (new ModelExcutionEngine())->FetchOneRow(
			"SELECT name FROM $TableName WHERE id = ?", array( $Data->Data['Post_id'] ));

	if ($Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Message $Message_ID");

	$Result = (new HashingEngine())->Get_Data_From_Hash([
		['Type' => $HashType, 'Data' => $Result->Data['name'], 'Key' => 'Add_Name']
	]);

	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Message $Message_ID");

	$GLOBALS['Message'] = $Data->Data;
	$GLOBALS['Message']['Add_Name'] = $Result->Data['Add_Name'];
	
	return (new SiteRenderEngine())->Message_Render();
}