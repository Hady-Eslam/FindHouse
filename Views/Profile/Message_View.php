<?php

function Message_Begin($Message_ID){
	$MySql = new MYSQLClass('Profile');
	$Result = $MySql->FetchOneRow('SELECT * FROM messages WHERE id = ?',
		array(
			$Message_ID
		));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		StatusPages_Not_Found_Page();

	$GLOBAL['Message'] = Message_Get_Message_From_Hashing($Result->Data);
	include_once Message_Template;
}

function Message_Get_Message_From_Hashing($Message){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Message['id'], 'Key' => 'MESSAGE_ID' ],
		['Type' => 'Messages', 'Data' => $Message['user_email'], 'Key' => 'User_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_email'], 'Key' => 'Message_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_body'], 'Key' => 'Message_Body'],
		['Type' => '', 'Data' => $Message['message_date'], 'Key' => 'Message_Date']
	], 'StatusPages_Error_Page');
}