<?php

namespace Forms\BackEndForms;
use CoreForms\FormsEngine;

use SiteEngines\HashingEngine;

class DeletePostForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->ID = FormsEngine::IntegerField(['Require' => True, 'Max_Length' => ID_Len]);

		$this->Category = FormsEngine::SelectField(['Require' => True,
				'Options' => [1, 2, 3, 4, 5, 6, 7, 8, 9] ]);

		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	function GetID(){
		return $this->FILTERED_DATA['ID'];
	}

	function GetCategory(){
		return $this->FILTERED_DATA['Category'];
	}

	function GetTable(){
		
		if ( $this->FILTERED_DATA['Category'] == 1 )
			return 'homes';
		
		else if ( $this->FILTERED_DATA['Category'] == 2 )
			return 'mobiles';

		else if ( $this->FILTERED_DATA['Category'] == 3 )
			return 'cars';
		
		else if ( $this->FILTERED_DATA['Category'] == 4 )
			return 'elc';
		
		else if ( $this->FILTERED_DATA['Category'] == 5 )
			return 'lux';
		
		else if ( $this->FILTERED_DATA['Category'] == 6 )
			return 'fashion';
		
		else if ( $this->FILTERED_DATA['Category'] == 7 )
			return 'eat';
		
		else if ( $this->FILTERED_DATA['Category'] == 8 )
			return 'doc';
		
		return 'ant';
	}

	function GetHashedEmail($Email){

		if ( $this->FILTERED_DATA['Category'] == 1 )
			return (new HashingEngine())->Hash_HOMES($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 2 )
			return (new HashingEngine())->Hash_MOBILES($Email);

		else if ( $this->FILTERED_DATA['Category'] == 3 )
			return (new HashingEngine())->Hash_CARS($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 4 )
			return (new HashingEngine())->Hash_ELC($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 5 )
			return (new HashingEngine())->Hash_ELC($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 6 )
			return (new HashingEngine())->Hash_ELC($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 7 )
			return (new HashingEngine())->Hash_EAT($Email);
		
		else if ( $this->FILTERED_DATA['Category'] == 8 )
			return (new HashingEngine())->Hash_ELC($Email);
		
		return (new HashingEngine())->Hash_ELC($Email);
	}
}