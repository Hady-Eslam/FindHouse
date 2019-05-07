<?php

namespace Forms\ProfileForms;
use CoreForms\FormsEngine;

class PasswordForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Password = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Password_Len]);
		$this->OldPassword = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Password_Len]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetPassword(){
		return $this->FILTERED_DATA['Password'];
	}

	function GetOldPassword(){
		return $this->FILTERED_DATA['OldPassword'];
	}
}