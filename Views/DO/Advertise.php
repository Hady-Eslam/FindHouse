<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use Forms\DOForms\AdvertiseForms\AdvertiseHomeForm;
use Forms\DOForms\AdvertiseForms\AdvertiseMobileForm;
use Forms\DOForms\AdvertiseForms\AdvertiseCarForm;
use Forms\DOForms\AdvertiseForms\AdvertiseElcForm;
use Forms\DOForms\AdvertiseForms\AdvertiseEatForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;
include_once Files;

function Begin($Request){
	$_SESSION['Page Name'] = 'Advertise';
	if ( !SESSION() )
		return (new SiteRenderEngine())->Not_Authurithed_User('Advertise');

	else if ( $Request->isPOST() && $Request->CHECK_REFERER(Advertise) &&
		$Request->IN_POST('Type') )
		return Advertise_POST($Request);

	return (new SiteRenderEngine())->Advertise_Render();
}

function Advertise_POST($Request){
	if ( $Request->POST['Type'] == '1' )
		return Advertise_Homes($Request);

	else if ( $Request->POST['Type'] == '2')
		return Advertise_Mobiles($Request);

	else if ( $Request->POST['Type'] == '3' )
		return Advertise_Eat($Request);

	else if ( $Request->POST['Type'] == '4' )
		return Advertise_Cars($Request);

	else if ( $Request->POST['Type'] == '5' )
		return Advertise_Elc($Request);

	else if ( $Request->POST['Type'] == '6' )
		return Advertise_Doc($Request);

	else if ( $Request->POST['Type'] == '7' )
		return Advertise_Lux($Request);

	else if ( $Request->POST['Type'] == '8' )
		return Advertise_Fashion($Request);

	else if ( $Request->POST['Type'] == '9' )
		return Advertise_Ant($Request);

	return '<p>Not Valid</p>';
}

function Advertise_Homes($Request){

	$Form = new AdvertiseHomeForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM homes;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Homes', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Homes', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Homes', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Homes', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Homes', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO homes(name, price, garage, security, garden, rooms, pathrooms, furnished, storey, finishing, area, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Garage() ),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Security() ),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Garden() ),
			$Form->GetAdvertise_Rooms(),
			$Form->GetAdvertise_PathRooms(),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Furnished() ),
			$Form->GetAdvertise_Storey(),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Finishing() ),
			$Form->GetAdvertise_Area(),
			$Hashing->Hash_HOMES( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_HOMES( $Pic1 ),
			$Hashing->Hash_HOMES( $Pic2 ),
			$Hashing->Hash_HOMES( $Pic3 ),
			$Hashing->Hash_HOMES( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_HOMES( $Form->GetUser_Phone() ),
			$Hashing->Hash_HOMES( $Form->GetUser_City() ),
			$Hashing->Hash_HOMES( $Form->GetUser_Name() ),
			$Hashing->Hash_HOMES( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Homes'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Homes/'.$Post_id);
}

function Advertise_Mobiles($Request){

	$Form = new AdvertiseMobileForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM mobiles;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Mobiles', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Mobiles', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Mobiles', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Mobiles', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Mobiles', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO mobiles(name, price, can_change, installment, free, type, mobile_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Change() ),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Installment() ),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Free() ),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_MOBILES( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_MOBILES( $Pic1 ),
			$Hashing->Hash_MOBILES( $Pic2 ),
			$Hashing->Hash_MOBILES( $Pic3 ),
			$Hashing->Hash_MOBILES( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_MOBILES( $Form->GetUser_Phone() ),
			$Hashing->Hash_MOBILES( $Form->GetUser_City() ),
			$Hashing->Hash_MOBILES( $Form->GetUser_Name() ),
			$Hashing->Hash_MOBILES( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Mobiles'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Mobiles/'.$Post_id);
}

function Advertise_Cars($Request){

	$Form = new AdvertiseCarForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() || !$Form->IS_TYPE_VALID() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM cars;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Cars', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Cars', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Cars', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Cars', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Cars', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO cars(name, price, type, year, model, engine, motion_vector, car_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_CARS( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_CARS( $Form->GetAdvertise_Type() ),
			$Form->GetAdvertise_Year(),
			$Hashing->Hash_CARS( $Form->GetAdvertise_Model() ),
			$Hashing->Hash_CARS( $Form->GetAdvertise_Engine() ),
			$Hashing->Hash_CARS( $Form->GetAdvertise_MotionVector() ),
			$Hashing->Hash_CARS( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_CARS( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_CARS( $Pic1 ),
			$Hashing->Hash_CARS( $Pic2 ),
			$Hashing->Hash_CARS( $Pic3 ),
			$Hashing->Hash_CARS( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_CARS( $Form->GetUser_Phone() ),
			$Hashing->Hash_CARS( $Form->GetUser_City() ),
			$Hashing->Hash_CARS( $Form->GetUser_Name() ),
			$Hashing->Hash_CARS( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Cars'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Cars/'.$Post_id);
}

function Advertise_Eat($Request){

	$Form = new AdvertiseEatForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM eat;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Eat', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Eat', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Eat', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Eat', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Eat', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO eat(name, price, product_name, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_EAT( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_EAT( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_EAT( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_EAT( $Pic1 ),
			$Hashing->Hash_EAT( $Pic2 ),
			$Hashing->Hash_EAT( $Pic3 ),
			$Hashing->Hash_EAT( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_EAT( $Form->GetUser_Phone() ),
			$Hashing->Hash_EAT( $Form->GetUser_City() ),
			$Hashing->Hash_EAT( $Form->GetUser_Name() ),
			$Hashing->Hash_EAT( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Eat'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Eat/'.$Post_id);
}

function Advertise_Elc($Request){

	$Form = new AdvertiseElcForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM elc;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Elc', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Elc', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Elc', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Elc', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Elc', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO elc(name, price, product_name, type, elc_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_ELC( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_ELC( $Pic1 ),
			$Hashing->Hash_ELC( $Pic2 ),
			$Hashing->Hash_ELC( $Pic3 ),
			$Hashing->Hash_ELC( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_ELC( $Form->GetUser_Phone() ),
			$Hashing->Hash_ELC( $Form->GetUser_City() ),
			$Hashing->Hash_ELC( $Form->GetUser_Name() ),
			$Hashing->Hash_ELC( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Elc'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Elc/'.$Post_id);
}

function Advertise_Doc($Request){

	$Form = new AdvertiseElcForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM doc;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Doc', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Doc', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Doc', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Doc', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Doc', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO doc(name, price, product_name, type, doc_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_ELC( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_ELC( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_ELC( $Pic1 ),
			$Hashing->Hash_ELC( $Pic2 ),
			$Hashing->Hash_ELC( $Pic3 ),
			$Hashing->Hash_ELC( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_ELC( $Form->GetUser_Phone() ),
			$Hashing->Hash_ELC( $Form->GetUser_City() ),
			$Hashing->Hash_ELC( $Form->GetUser_Name() ),
			$Hashing->Hash_ELC( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Doc'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Doc/'.$Post_id);
}

function Advertise_Ant($Request){

	$Form = new AdvertiseElcForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM ant;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Ant', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Ant', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Ant', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Ant', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Ant', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO ant(name, price, product_name, type, ant_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_Elc( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_Elc( $Pic1 ),
			$Hashing->Hash_Elc( $Pic2 ),
			$Hashing->Hash_Elc( $Pic3 ),
			$Hashing->Hash_Elc( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_Elc( $Form->GetUser_Phone() ),
			$Hashing->Hash_Elc( $Form->GetUser_City() ),
			$Hashing->Hash_Elc( $Form->GetUser_Name() ),
			$Hashing->Hash_Elc( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Ant'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Ant/'.$Post_id);
}

function Advertise_Fashion($Request){

	$Form = new AdvertiseElcForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM fashion;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Fashion', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Fashion', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Fashion', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Fashion', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Fashion', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO fashion(name, price, product_name, type, fashion_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_Elc( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_Elc( $Pic1 ),
			$Hashing->Hash_Elc( $Pic2 ),
			$Hashing->Hash_Elc( $Pic3 ),
			$Hashing->Hash_Elc( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_Elc( $Form->GetUser_Phone() ),
			$Hashing->Hash_Elc( $Form->GetUser_City() ),
			$Hashing->Hash_Elc( $Form->GetUser_Name() ),
			$Hashing->Hash_Elc( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Fashion'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Fashion/'.$Post_id);
}

function Advertise_Lux($Request){

	$Form = new AdvertiseElcForm($Request->POST, $Request->FILES);
	if ( !$Form->isValid() ){
		var_dump($Form->FILTERED_DATA);
		return (new SiteRenderEngine())->Advertise_Render();
	}

	$MySql = new ModelExcutionEngine();
	$Result = $MySql->FetchOneRow('SELECT MAX(id) FROM lux;', array());
	if ( $Result->Result != 1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');
	$ID = $Result->Data['MAX(id)'] + 1;

	MakePostFile( $_SESSION['ID'], 'Lux', $ID );
	$Pic1 = ReNamePicture( $Form->GetFile1(), $_SESSION['ID'], 'Lux', $ID, '1' );
	$Pic2 = ReNamePicture( $Form->GetFile2(), $_SESSION['ID'], 'Lux', $ID, '2' );
	$Pic3 = ReNamePicture( $Form->GetFile3(), $_SESSION['ID'], 'Lux', $ID, '3' );
	$Pic4 = ReNamePicture( $Form->GetFile4(), $_SESSION['ID'], 'Lux', $ID, '4' );

	$Hashing = new HashingEngine();
	if ( $MySql->excute('INSERT INTO lux(name, price, product_name, type, lux_status, descreption, pic1, pic2, pic3, pic4, contact_status, user_phone, user_city, user_name, user_email, deleted, status, add_date) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
		array(
			$Hashing->Hash_Elc( $Form->GetAdvertise_Name() ),
			$Form->GetAdvertise_Price(),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Product_Name() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Type() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Status() ),
			$Hashing->Hash_Elc( $Form->GetAdvertise_Descreption() ),

			$Hashing->Hash_Elc( $Pic1 ),
			$Hashing->Hash_Elc( $Pic2 ),
			$Hashing->Hash_Elc( $Pic3 ),
			$Hashing->Hash_Elc( $Pic4 ),

			$Form->GetContactStatus(),

			$Hashing->Hash_Elc( $Form->GetUser_Phone() ),
			$Hashing->Hash_Elc( $Form->GetUser_City() ),
			$Hashing->Hash_Elc( $Form->GetUser_Name() ),
			$Hashing->Hash_Elc( $_SESSION['Email'] ),

			'0',
			( $_SESSION['Status'] != '0' ) ? '0' : '1',

			date('D d-m-Y H:i:s')
		))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Advertise');

	$Post_id = $MySql->GetInsertedID();

	if ( $_SESSION['Status'] != '0' ){

		$MySql->excute('INSERT INTO notifications (from_user, to_user, notification_type, message, notification_date) VALUES (?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Notifications( $_SESSION['Email'] ),
				$Hashing->Hash_Notifications('Admin'),
				'7',
				$Hashing->Hash_Notifications(
					'I Want To Approve This Post '.$Post_id.' From Category Lux'),
				date('D d-m-Y H:i:s')
			));
	}

	$_SESSION['Posts']++;
	Redirect(Post.'Lux/'.$Post_id);
}

function ReNamePicture($File, $User_ID, $Category, $Post_ID, $ID){

	if ( $File['size'] != -1 ){
		$Ext = '.'.pathinfo( $File['name'], PATHINFO_EXTENSION );
		$NewName = UserPictures.'User'.$User_ID.'/'.$Category.'/Post'.$Post_ID.'/'.$ID.$Ext;
		$Result = rename( $File['tmp_name'], $NewName );
		if ( $Result == False )
			return Housing;
		else
			return UserPictures_HTTP.'User'.$User_ID.'/'.$Category.'/Post'.$Post_ID
								.'/'.$ID.$Ext;
	}
	return Housing;
}
