<?php

use CoreModels\ModelExcutionEngine;

use SiteEngines\SiteRenderEngine;
use SiteEngines\HashingEngine;

use Forms\DOForms\EditPostForm;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;
include_once Files;

function Begin($Request){
	$_SESSION['Page Name'] = 'Edit Elc Post';

	return (new SiteRenderEngine())->Edit_Elc();
}