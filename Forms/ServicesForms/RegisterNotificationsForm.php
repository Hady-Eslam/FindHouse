<?php

namespace Forms\ServicesForms;
use CoreForms\FormsEngine;

class RegisterNotificationsForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->FooterEmail = FormsEngine::EmailField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Email_Len]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetEmail(){
		return $this->FILTERED_DATA['FooterEmail'];
	}
}