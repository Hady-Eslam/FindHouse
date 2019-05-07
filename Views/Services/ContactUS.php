<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use Forms\ServicesForms\ContactUSForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
	if ( $Request->isPOST() )
		return ContactUS_POST($Request);

	return (new SiteRenderEngine())->ContactUS_Render();
}

function ContactUS_POST($Request){

	$Form = new ContactUSForm($Request->POST);

	if ( !$Form->isValid() )
		return (new SiteRenderEngine())->ContactUS_Render('Wrong Data',
			$Request->POST['Name'], $Request->POST['Email'], $Request->POST['Message']);

	$Hashing = new HashingEngine();

	if ( (new ModelExcutionEngine())->excute('INSERT INTO contact_us(user_name, user_email, user_message, user_date) VALUES (?, ?, ?, ?)',array(
		$Hashing->Hash_ContactUS($Form->GetName()),
		$Hashing->Hash_ContactUS($Form->GetEmail()),
		$Hashing->Hash_ContactUS($Form->GetMessage()),
		date('D d-m-Y H:i:s')
	))->Result == -1 )
		return (new SiteRenderEngine())->Error_Page('Contact US');

	return (new SiteRenderEngine())->ContactUS_Render('Done');
}