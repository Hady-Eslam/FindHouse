<?php

use SiteEngines\HashingEngine;
use CoreModels\ModelExcutionEngine;

function ShowMessages(){
	$String = '';
	foreach ($GLOBALS['Messages'] as $Value)
		$String .= Messages_Print_Messages($Value);
	
	if ( $String == '' )
		return '<p>No Message Found</p>';
	return $String;
}

function Messages_Print_Messages($Message){

	$GLOBALS['Error'] = False;
	Messages_Get_Data_From_Hashing($Message);
	if ( $GLOBALS['Error'] )
		return '';

	$GLOBALS['Error'] = False;
	$Result = Messages_Get_Add_Name_From_Hashing($Message['post_id'], $Message['post_category']);
	if ( $Result != '1' || $GLOBALS['Error'] )
		return '';

	return '<div class="col-12 col-md-8 col-lg-8">
		        <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">

		            <!-- Property Description -->
		            <div class="property-desc-area">

		                <!-- Property Info -->
		                <p>From : <span>'.$GLOBALS['Message_Email'].'</span></p>
		                <p>To : <span>'.$GLOBALS['User_Email'].'</span></p>
		                <p>Date : <span>'.$GLOBALS['Message_Date'].'</span></p>
		                <p>Addvertise Name: <span>'.$GLOBALS['Add_Name'].'</span></p>
		            </div>

		            <div class="information-area mb-80 wow fadeInUp" data-wow-delay="200ms">
		                <!-- Content -->
		                <a class="btn rehomes-btn mt-10" style="width: 40%"
		                    onclick="DeleteMessage('.$GLOBALS['MESSAGE_ID'].')">Delete</a>

		                <a class="btn rehomes-btn mt-10" style="width: 40%"
		                    href="'.Message.$GLOBALS['MESSAGE_ID'].'">Show Full Message</a>
		            </div>
		        </div>
		    </div>';
}

function Messages_Get_Data_From_Hashing($Message){
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Message['id'], 'Key' => 'MESSAGE_ID' ],
		['Type' => 'Messages', 'Data' => $Message['user_email'], 'Key' => 'User_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_email'], 'Key' => 'Message_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_body'], 'Key' => 'Message_Body'],
		['Type' => '', 'Data' => $Message['message_date'], 'Key' => 'Message_Date']
	], 'Status_Error');
}

function Messages_Get_Add_Name_From_Hashing($Post_id, $Post_Category){
	if ( $Post_Category == '0' || $Post_Category > 9 )
		return '';
	else if ( $Post_Category == '1' ){
		$TableName = 'homes';
		$HashType = 'HOMES';
	}
	else if ( $Post_Category == '2' ){
		$TableName = 'mobiles';
		$HashType = 'MOBILES';
	}
	else if ( $Post_Category == '3' ){
		$TableName = 'cars';
		$HashType = 'CARS';
	}
	else if ( $Post_Category == '4' ){
		$TableName = 'elc';
		$HashType = 'ELC';
	}
	else if ( $Post_Category == '5' ){
		$TableName = 'lux';
		$HashType = 'ELC';
	}
	else if ( $Post_Category == '6' ){
		$TableName = 'fashion';
		$HashType = 'ELC';
	}
	else if ( $Post_Category == '7' ){
		$TableName = 'eat';
		$HashType = 'EAT';
	}
	else if ( $Post_Category == '8' ){
		$TableName = 'doc';
		$HashType = 'ELC';
	}
	else if ( $Post_Category == '9' ){
		$TableName = 'ant';
		$HashType = 'ELC';
	}

	$Result = (new ModelExcutionEngine())->FetchOneRow(
			"SELECT name FROM $TableName WHERE id = ?", array( $Post_id ));

	if ($Result->Result == -1 )
		return '';

	else if ( $Result->Result == 0 )
		return '0';

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => $HashType, 'Data' => $Result->Data['name'], 'Key' => 'Add_Name']
	], 'Status_Error');

	return '1';
}

function Status_Error(){
	$GLOBALS['Error'] = True;
}