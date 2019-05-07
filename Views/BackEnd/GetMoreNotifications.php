<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\JsonEngine;
use SiteEngines\HashingEngine;

use CoreModels\ModelExcutionEngine;

use Forms\BackEndForms\CheckNotificationsNumberForm;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	$_SESSION['Page Name'] = 'Get More Notifications';

	if ( !SESSION() || !$Request->isPOST() || !$Request->CHECK_REFERER(Notifications) )
		return (new SiteRenderEngine())->Not_Authurithed_User('Get More Notifications');

	$Form = new CheckNotificationsNumberForm($Request->POST);
	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Get More Notifications');

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchAllRows(
		'SELECT * FROM notifications WHERE to_user = ? ORDER BY id DESC LIMIT '
			.( $Form->GetNumber() -1 ).' , 7',
			array(
				(new HashingEngine())->Hash_Notifications($_SESSION['Email'])
			));

	if ( $Result->Result == -1 )
		return (new JsonEngine)->MakeJson(Returns(-1,'Error in Getting More Notifications',
					$Result->Error));
	
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	
	else
		$GLOBALS['Result'] = $Result->Data;

	$GLOBALS['Number'] = 0;
	$String = GetNotifications();

	if ( $GLOBALS['Number'] == 0 )
		return (new JsonEngine)->MakeJson( 0, 'No Notifications', '');
	else
		return (new JsonEngine)->MakeJson( Returns(1, [
			'Number' => $GLOBALS['Number'],
			'Data' => $String
		], ''));
}

function GetNotifications(){
	$String = '';

    foreach ($GLOBALS['Result'] as $Value)
        $String .= Notifications_Get_Notification($Value);

    if ( $String == '' )
    	return '<div style="text-align: center;">
                	<p>You Have No Notifications</p>
            	</div>';
    
    return $String;
}

function Notifications_Get_Notification($Notification){

	$GLOBALS['Error'] = False;
	Notifications_Get_Data_From_Hashing($Notification);
	if ( $GLOBALS['Error'] )
		return '';

	Notifications_GetPicture();
	if ( $GLOBALS['Error'] )
		return '';

	Notifications_Get_Message();
	$GLOBALS['Number'] = $GLOBALS['NOTIFICATION_ID'];

	return '
	<!-- Agent Information Info -->
    <div class="agent-information-info d-flex align-items-center" id="'
    		.$GLOBALS['NOTIFICATION_ID'].'">
        <!-- Agent Thumb -->
        <div class="agent-thumb">
            <img src="'.$GLOBALS['User_Picture'].'" alt="" style="width:100px;height:100px">
        </div>
        <!-- Agent Info -->
        <div class="agent-info">
            <h4>By : '.$GLOBALS['User_Name'].'</h4>
            <!-- Agent Contact -->
            <p>Date : <span>'.$GLOBALS['Date'].'</span></p>
            '.Notifications_Get_Status().'
            <p>'.$GLOBALS['Message'].'</p>
        </div>
    </div>';
}

function Notifications_Get_Data_From_Hashing($Notification){
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Notification['id'], 'Key' => 'NOTIFICATION_ID'],
		['Type' => 'Notifications', 'Data' => $Notification['from_user'], 'Key' => 'From_User'],
		['Type' => 'Notifications', 'Data' => $Notification['to_user'], 'Key' => 'To_User'],

		['Type' => '','Data' => $Notification['notification_type'],'Key' => 'Notification_Type'],
		['Type' => 'Notifications', 'Data' => $Notification['message'], 'Key' => 'Message'],

		['Type' => '', 'Data' => $Notification['see'], 'Key' => 'See'],
		['Type' => '', 'Data' => $Notification['notification_date'], 'Key' => 'Date']
	], 'Notifications_Set_Error');
}

function Notifications_Set_Error(){
	$GLOBALS['Error'] = True;
}

function Notifications_GetPicture(){
	if ( $GLOBALS['Notification_Type'] == '4' || $GLOBALS['Notification_Type'] == '5' ||
			$GLOBALS['Notification_Type'] == '6' ){
		$GLOBALS['User_Picture'] = Admin;
		$GLOBALS['User_Name'] = 'Admin';
	}

	else{
		$Hashing = new HashingEngine();
		$Result = (new ModelExcutionEngine())->FetchOneRow(
			'SELECT * FROM users WHERE email = ? AND deleted = ? AND activate = ?',
			array(
				$Hashing->Hash_Users($GLOBALS['From_User']),
				'0',
				'1'
			));

		if ( $Result->Result == -1 )
			return -1;
		
		else if ( $Result->Result == 0 ){
			$GLOBALS['User_Picture'] = OfflineUsers;
			$GLOBALS['User_Name'] = $GLOBALS['From_User'];
		}
		
		else{
			$Hashing->Get_Data_From_Hashing([
				['Type' => 'User', 'Data' => $Result->Data['picture'], 'Key' => 'User_Picture'],
				['Type' => 'User', 'Data' => $Result->Data['name'], 'Key' => 'User_Name']
			], 'Notifications_Set_Error');
		}
	}
}

function Notifications_Get_Message(){
	if ( $GLOBALS['Notification_Type'] == '4' || $GLOBALS['Notification_Type'] == '5' ||
			$GLOBALS['Notification_Type'] == '6' ){
		if ( preg_match('/(\d+)/', $GLOBALS['Message'], $Result) ){
			Notifications_CheckPost($Result[1]);
		}
	}
}

function Notifications_CheckPost($Post_id){
	$Result = (new ModelExcutionEngine())->FetchOneRow('SELECT addname FROM posts WHERE id = ?', array( $Post_id ));
	if ( $Result->Result == 1 ){
		$Re = (new HashingEngine())->Get_Hashed_POSTS($Result->Data['addname']);
		if ( $Re->Result == 1 )
			$GLOBALS['Message'] = preg_replace('/(\d+)/',
				'<span style = "color : green;">'.$Re->Data.'</span>', $GLOBALS['Message']);
	}
}

function Notifications_Get_Status(){
	if ( $GLOBALS['Notification_Type'] == '4' || $GLOBALS['Notification_Type'] == '5' ||
			$GLOBALS['Notification_Type'] == '6' )
		return '<p>Status : <span style="color: green;">Authorized Admin</span></p>';
	else
		return '<p><span>Status : </span>User</p>';
}