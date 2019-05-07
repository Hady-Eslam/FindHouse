<?php

namespace Forms\BackEndForms\FindForms;
use CoreForms\FormsEngine;

use SiteEngines\HashingEngine;

class SearchMobilesForm extends FormsEngine{
	
	function __construct(...$Data){


		$this->Mobiles_Type = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 3, 'Max_Length' => 12, 'Default' => 'All',
				'Options' => [ 'HUAWEI', 'Apple', 'SamSung', 'htc', 'Tecno', 'Lenovo',
								'Nokia', 'ALfa Romeo', 'HONER', 'OPPO', 'Other Brands' ]]);


		$this->Mobiles_Status = FormsEngine::SelectField(['Require' => True, 'Default' => 'All',
				'Min_Length' => 3, 'Max_Length' => 3, 'Options' => [ 'New', 'Old' ]]);


		$this->Mobiles_Price = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 3, 'Max_Length' => 12, 'Default' => 'All',
				'Options' => [ '500', '1500', '2000', '3000', '4000', '5000' ]]);

		$this->Mobiles_Count =  FormsEngine::IntegerField(['Require' => True,
				'Max_Length' => ID_Len, 'Default' => 21]);


		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////


	function GetQuery(){

		$Query = '';
		if ( $this->FILTERED_DATA['Mobiles_Type'] != 'All' )
			$Query = $this->GetType();

		if ( $Query == '' ){
			if ( $this->FILTERED_DATA['Mobiles_Status'] != 'All'){
				$Query = 'status = '.$this->GetStatus();
			}
		}
		else{
			if ( $this->FILTERED_DATA['Mobiles_Status'] != 'All'){
				$Query .= ' AND '.$this->GetStatus();
			}
		}

		if ( $Query == '' ){
			if ( $this->FILTERED_DATA['Mobiles_Price'] != 'All'){
				$Query = $this->GetPrice();
			}
		}
		else{
			if ( $this->FILTERED_DATA['Mobiles_Status'] != 'All'){
				$Query .= ' AND '.$this->GetPrice();
			}
		}

		return ( $Query == '' ) ? '' : ' WHERE deleted = ? AND status = ? AND '.$Query;
	}

	function GetType(){
		return ( $this->FILTERED_DATA['Mobiles_Type'] != 'All' ) ?
				" type = '".(new HashingEngine())->Hash_MOBILES($this->FILTERED_DATA['Mobiles_Type'])."'" : '';
	}

	function GetTrueType(){
		return $this->FILTERED_DATA['Mobiles_Type'];
	}

	function GetStatus(){
		return ( $this->FILTERED_DATA['Mobiles_Status'] != 'All' ) ?
				" status = '".(new HashingEngine())->Hash_MOBILES($this->FILTERED_DATA['Mobiles_Status'])."'" : '';
	}

	function GetTrueStatus(){
		return $this->FILTERED_DATA['Mobiles_Status'];
	}

	function GetPrice(){
		
		if ( $this->FILTERED_DATA['Mobiles_Price'] == '500' )
			return ' price < 500 ';
		
		else if ( $this->FILTERED_DATA['Mobiles_Price'] == '1500' )
			return ' price > 499 AND price < 1500 ';
		
		else if ( $this->FILTERED_DATA['Mobiles_Price'] == '2000' )
			return ' price > 1499 AND price < 2000 ';
		
		else if ( $this->FILTERED_DATA['Mobiles_Price'] == '3000' )
			return ' price > 1999 AND price < 3000 ';
		
		else if ( $this->FILTERED_DATA['Mobiles_Price'] == '4000' )
			return ' price > 2999 AND price < 4000 ';
		
		else if ( $this->FILTERED_DATA['Mobiles_Price'] == '5000' )
			return ' price > 3999 AND price < 5000 ';
		
		else
			return '';
	}

	function GetTruePrice(){
		return $this->FILTERED_DATA['Mobiles_Price'];
	}

	function GetLimit(){
		return $this->FILTERED_DATA['Mobiles_Count'];
	}
}