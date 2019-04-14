<?php

namespace CoreForms;
use CoreForms\FormsFieldsEngine;

abstract class FormsEngine extends FormsFieldsEngine{
	
	private $FormisValid = NULL;
	public $FILTERED_DATA = [];

	/**
		Check if Form is Valid Or Not
	*/
	function isValid(){

		if ( $this->FormisValid !== NULL )
			return $this->FormisValid;

		else if ( !$this->GetFormData() )
			return False;

		foreach ($this->OBJECTS as $FieldName => $FieldValue){

			if ( $FieldName == 'FORMDATA' || $FieldName == 'OBJECTS' ||
					$FieldName == 'FILTERED_DATA' )
				continue;
			
			else if ( !isset($this->FORMDATA[$FieldName]) ){
				if ( !$FieldValue->NotSetReturn() ){
					$this->FormisValid = False;
					return False;
				}
				$this->FILTERED_DATA[$FieldName] = $FieldValue->Value;
			}

			else{
				if ( !$FieldValue->SetReturn($this->FORMDATA[$FieldName]) ){
					$this->FormisValid = False;
					return False;
				}
				$this->FILTERED_DATA[$FieldName] = $FieldValue->Value;
			}
		}
		$this->FormisValid = True;
		return True;
	}

	/**
	 *	Get Data From Form
	 * 
 	 * @author  Hady Eslam <abdoaslam000@gmail.com>
 	 * @param   NONE
 	 * @return  boolean
	 */
	private function GetFormData(){

		$DATA = [];

		foreach ($this->FORMDATA as $Value) {
			
			if ( !is_array($Value) ){
				$this->FormisValid = False;
				return False;
			}
			foreach ($Value as $KEY => $VALUE)
				$DATA[$KEY] = $VALUE;
		}
		$this->FORMDATA = $DATA;
		$this->FormisValid = True;
		return True;
	}

	/**
		
	*/
	function Filtered_Data(...$Data){

	}

	/**
		Check if this Value is Clean From Begining Or Not
	*/
	function isClean($Value){
		if ( !isset($this->FILTERED_DATA[$Value]) )
			throw new FormExceptionEngine("Form Don't Have This Value");
		return ( $this->FILTERED_DATA[$Value] != $this->FORMDATA[$Value] ) ? False : True;
	}
}