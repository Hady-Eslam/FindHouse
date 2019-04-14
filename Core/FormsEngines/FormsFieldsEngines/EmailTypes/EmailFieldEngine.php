<?php

namespace FormsFields\EmailTypes;
use FormsFields\FieldEngine;

class EmailFieldEngine extends FieldEngine{

	
	public $FieldName = 'Email Field';
	public $ClassType = 'EmailTypes';
	public $Type = 'Email';
	public $Constraints = [
		'Require' => True,
		'Default' => 0,
		'Min_Length' => 0,
		'Max_Length' => 500
	];

	function __construct($Constraints){
		foreach ($Constraints as $Key => $Value)
			$this->Constraints[$Key] = $Value;
		$this->Check();
	}

	function SetReturn($Value){
		$Value = filter_var( $Value, FILTER_VALIDATE_EMAIL );
		
		if ( !empty($Value) && strlen($Value) >= $this->Constraints['Min_Length'] && 
								strlen($Value) <= $this->Constraints['Max_Length'] ){
			$this->Value = $Value;
			return True;
		}
		else if ( $this->Constraints['Default'] === 0 )
			return False;
		else{
			$this->Value = $this->Constraints['Default'];
			return True;
		}
	}
}