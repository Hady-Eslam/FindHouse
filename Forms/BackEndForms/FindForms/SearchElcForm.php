<?php

namespace Forms\BackEndForms\FindForms;
use CoreForms\FormsEngine;

use SiteEngines\HashingEngine;

class SearchElcForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Elc_Count =  FormsEngine::IntegerField(['Require' => True,
				'Max_Length' => ID_Len, 'Default' => 21]);


		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////

	function GetLimit(){
		return $this->FILTERED_DATA['Elc_Count'];
	}
}