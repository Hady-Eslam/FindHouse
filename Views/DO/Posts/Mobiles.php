<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\HashingEngine;
use SiteEngines\SiteRenderEngine;

use Forms\DOForms\PostForm;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;
include_once Files;

function Begin($Request, $Post_ID){
	$_SESSION['Page Name'] = "Mobile Post $Post_ID";
	if ( $Request->isPOST() )
		return Post_POST($Request, $Post_ID);
	return Post_GET($Request, $Post_ID);
}

function Post_GET($Request, $Post_id){

	$MySql = new ModelExcutionEngine();
	$Hashing = new HashingEngine();
	
	$Result = $MySql->FetchOneRow('SELECT * FROM mobiles WHERE id = ? AND deleted = ?',
			array( $Post_id , '0'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	else if ( $Result->Result == 0 )
		return (new SiteRenderEngine())->Not_Found_Page();

	$Data = $Result->Data;
	$User_Email = $Hashing->Get_Data_From_Hash([
		['Type' => 'MOBILES', 'Data' => $Data['user_email'], 'Key' => 'Email' ]
	]);

	if ( $User_Email->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("mobile Post $Post_id");
	$User_Email = $User_Email->Data['Email'];


	if ( ($Result = (new ModelExcutionEngine())
			->FetchOneRow('SELECT * FROM users WHERE email = ? AND activate = ?',
				array( $Hashing->Hash_Users( $User_Email ), '1' )))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	else if ( $Result->Result == 0 )
		return (new SiteRenderEngine())->Not_Found_Page();

	if ( $Data['status'] == -1 && !SESSION() || $Data['status'] == 0 && !SESSION() ||
			$Data['status'] == -1 && $User_Email != $_SESSION['Email'] ||
			$Data['status'] == 0 && $User_Email != $_SESSION['Email'] )
		if ( !SESSION() || $_SESSION['Status'] != '0' )
			return (new SiteRenderEngine())->Not_Found_Page();

	$User_Profile = User.$Result->Data['id'];

	$Data = $Hashing->Get_Data_From_Hash([
		['Type' => 'User', 'Data' => $Result->Data['picture'], 'Key' => 'User_Picture' ],

		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'MOBILES', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'MOBILES', 'Data' => $Data['can_change'], 'Key' => 'Add_Can_Change' ],

		['Type' => 'MOBILES', 'Data' => $Data['installment'], 'Key' => 'Add_Installment' ],

		['Type' => 'MOBILES', 'Data' => $Data['free'], 'Key' => 'Add_Free' ],

		['Type' => 'MOBILES', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'MOBILES', 'Data' => $Data['mobile_status'], 'Key' => 'Add_MobileStatus' ],

		['Type' => 'MOBILES', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'MOBILES', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'MOBILES', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'MOBILES', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'MOBILES', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]
	]);

	if ( $Data->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	return (new SiteRenderEngine())->Mobiles_Post_Render(
		$User_Profile, $Data->Data['User_Picture'], $User_Email, $Data->Data, $Post_id );
}

function Post_POST($Request, $Post_id){

	$Form = new PostForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() )
		return Post_GET($Request, $Post_id);

	/*
		Get Email
	*/
	$Email = '';
	if ( !SESSION() && $Form->GetEmail() == 'Testing@Testing.Testing' )
		return Post_GET($Request, $Post_id);

	else if ( !SESSION() )
		$Email = $Form->GetEmail();
	
	else
		$Email = $_SESSION['Email'];

	/*
		Check if Post Found Or Not
	*/
	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT * FROM mobiles WHERE id = ? AND deleted = ? AND status = ?',
			array( $Post_id , '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	else if ( $Result->Result == 0 )
		return (new SiteRenderEngine())->Not_Found_Page();

	else if ( $Result->Data['contact_status'] == '1' )
		return Post_GET($Request, $Post_id);

	/*
		Get User Email From Hashing
	*/
	$Hashing = new HashingEngine();
	$Result = $Hashing->Get_Hashed_MOBILES($Result->Data['user_email']);
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");
	$User_Email = $Result->Data;

	/*
		Get User Data
	*/
	$Result = $MySql->FetchOneRow(
			'SELECT * FROM users WHERE email = ? AND deleted = ? AND activate = ?',
			array( $Hashing->Hash_Users($User_Email) , '0', '1'));

	if ( $Result->Result == -1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	else if ( $Result->Result == 0 )
		return (new SiteRenderEngine())->Not_Found_Page();

	/*
		Get The Last Message id
	*/
	$LastMessageID = $MySql->FetchOneRow('SELECT MAX(id) FROM messages',
			array());
	if ( $LastMessageID->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");

	else
		$LastMessageID = $LastMessageID->Data['MAX(id)'] + 1;

	MakeMessageFile( $Result->Data['id'], $LastMessageID);
	$Pic1 = ReNamePicture( $Form->GetFile1(), $Result->Data['id'], $LastMessageID, '1');
	$Pic2 = ReNamePicture( $Form->GetFile2(), $Result->Data['id'], $LastMessageID, '2');
	$Pic3 = ReNamePicture( $Form->GetFile3(), $Result->Data['id'], $LastMessageID, '3');
	$Pic4 = ReNamePicture( $Form->GetFile4(), $Result->Data['id'], $LastMessageID, '4');
	$Pic5 = ReNamePicture( $Form->GetFile5(), $Result->Data['id'], $LastMessageID, '5');

	/*
		Saving Message
	*/
	if ( ($Result = $MySql->excute('INSERT INTO messages (message_email, message_body, user_email, message_date, post_category, post_id, f1_picture, f2_picture, f3_picture, f4_picture, f5_picture) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', 
			array(
				$Hashing->Hash_Messages( $Email ),
				$Hashing->Hash_Messages( $Form->GetMessage() ),
				$Hashing->Hash_Messages( $User_Email ),
				date('D d-m-Y H:i:s'),
				'2',
				$Post_id,
				$Hashing->Hash_Messages( $Pic1 ),
				$Hashing->Hash_Messages( $Pic2 ),
				$Hashing->Hash_Messages( $Pic3 ),
				$Hashing->Hash_Messages( $Pic4 ),
				$Hashing->Hash_Messages( $Pic5 )
			)))->Result != 1 )
		return (new SiteRenderEngine())->Error_Page("Mobile Post $Post_id");
	/*
		Saving Notification
	*/
	$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES(?, ?, ?, ?, ?)', array(
		$Hashing->Hash_Notifications( $Email ),
		$Hashing->Hash_Notifications( $User_Email ),
		'8',
		$Hashing->Hash_Notifications('You Have New Message'),
		date('D d-m-Y H:i:s')
	));
	Redirect(Post.'Mobiles/'.$Post_id.'/Message');
}

function ReNamePicture($File, $User_ID, $Message_ID, $ID){

	if ( $File['size'] != -1 ){
		$Ext = '.'.pathinfo( $File['name'], PATHINFO_EXTENSION );
		$NewName = MessagesPictures.'User'.$User_ID.'/Message'.$Message_ID.'/'.$ID.$Ext;
		$Result = rename( $File['tmp_name'], $NewName );
		if ( $Result == False )
			return Housing;
		else
			return MessagesPictures_HTTP.'User'.$User_ID.'/Message'.$Message_ID.'/'.$ID.$Ext;
	}
	return Housing;
}
