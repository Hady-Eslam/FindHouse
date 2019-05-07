<?php

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use Forms\ServicesForms\RegisterNotificationsForm;

use CoreModels\ModelExcutionEngine;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){
    $_SESSION['Page Name'] = 'Register Notifications';

    $Form = new RegisterNotificationsForm($Request->POST);
    if ( !$Form->isValid() )
    	return (new SiteRenderEngine())->RegisterNotifications_Render('Not Valid Email');

    $Hashing = new HashingEngine();
    $MySql = new ModelExcutionEngine();

    $Result = $MySql->FetchOneRow('SELECT * FROM registernotifications WHERE user_email = ?',
		array(
			$Hashing->Hash_RegisterNotifications($Form->GetEmail())
		));
    
    if ( $Result->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Register Notifications');
    
    else if ( $Result->Result == 1 )
    	return (new SiteRenderEngine())->RegisterNotifications_Render();

    if ( ($MySql->excute(
    		'INSERT INTO RegisterNotifications(user_email, register_date) VALUES(?, ?)',
		array(
			$Hashing->Hash_RegisterNotifications($Form->GetEmail()),
			date('D d-m-Y H:i:s')
		)))->Result == -1 )
    	return (new SiteRenderEngine())->Error_Page('Register Notifications');

    return (new SiteRenderEngine())->RegisterNotifications_Render();
}