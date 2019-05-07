<?php

namespace Forms\BackEndForms;
use CoreForms\FormsEngine;

class PeddingPostsForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Homes = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Mobiles = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Cars = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Elc = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Lux = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Fashion = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Eat = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Doc = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);
		$this->Ant = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetHomes(){
		return $this->FILTERED_DATA['Homes'];
	}

	function GetMobiles(){
		return $this->FILTERED_DATA['Mobiles'];
	}

	function GetCars(){
		return $this->FILTERED_DATA['Cars'];
	}

	function GetElc(){
		return $this->FILTERED_DATA['Elc'];
	}

	function GetLux(){
		return $this->FILTERED_DATA['Lux'];
	}

	function GetFashion(){
		return $this->FILTERED_DATA['Fashion'];
	}

	function GetEat(){
		return $this->FILTERED_DATA['Eat'];
	}

	function GetDoc(){
		return $this->FILTERED_DATA['Doc'];
	}

	function GetAnt(){
		return $this->FILTERED_DATA['Ant'];
	}
}