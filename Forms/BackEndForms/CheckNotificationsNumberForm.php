<?php

namespace Forms\BackEndForms;
use CoreForms\FormsEngine;

class CheckNotificationsNumberForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Notifications_Number =
			FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetNumber(){
		return $this->FILTERED_DATA['Notifications_Number'];
	}
}