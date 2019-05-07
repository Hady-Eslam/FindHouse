<?php

use SiteEngines\HashingEngine;
use SiteEngines\SiteRenderEngine;

use CoreModels\ModelExcutionEngine;

use Forms\DOForms\FindForm;

include_once _DIR_.'/Configs/Configs.php';
include_once Session;

function Begin($Request){

	$_SESSION['Page Name'] = 'Cars';
	return (new SiteRenderEngine())->Cars_Render();
}