<?php

namespace Forms\ServicesForms;
use CoreForms\FormsEngine;

class ContactUSForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Name = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Name_Len]);

		$this->Email = FormsEngine::EmailField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Email_Len]);

		$this->Message = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Message_Len]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetName(){
		return $this->FILTERED_DATA['Name'];
	}

	function GetEmail(){
		return $this->FILTERED_DATA['Email'];
	}

	function GetMessage(){
		return $this->FILTERED_DATA['Message'];
	}
}