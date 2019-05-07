<?php

namespace Forms\DOForms\AdvertiseForms;
use CoreForms\FormsEngine;

class AdvertiseMobileForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Advertise_Name = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Advertise_Name_Len]);

		$this->Advertise_Price = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Money_Len, 'Min_Value' => 0]);

		$this->Advertise_Change = FormsEngine::CheckBoxField();
		$this->Advertise_Installment = FormsEngine::CheckBoxField();
		$this->Advertise_Free = FormsEngine::CheckBoxField();

		$this->Advertise_Type = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 3, 'Max_Length' => 12, 'Default' => 'Other Brands',
				'Options' => [ 'HUAWEI', 'Apple', 'SamSung', 'htc', 'Tecno', 'Lenovo',
								'Nokia', 'ALfa Romeo', 'HONER', 'OPPO', 'Other Brands' ]]);

		$this->Advertise_Status = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 3, 'Max_Length' => 3, 'Options' => [ 'New', 'Old' ]]);


		$this->Advertise_Descreption = FormsEngine::TextField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Discreption_Len]);


		//////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////


		$this->File1 = FormsEngine::ImageField(['Require' => True, 'Min_Length' => 0,
				'Max_Length' => Picture_Len, 'Default' => Housing]);

		$this->File2 = FormsEngine::ImageField(['Require' => True, 'Min_Length' => 0,
				'Max_Length' => Picture_Len, 'Default' => Housing]);

		$this->File3 = FormsEngine::ImageField(['Require' => True, 'Min_Length' => 0,
				'Max_Length' => Picture_Len, 'Default' => Housing]);

		$this->File4 = FormsEngine::ImageField(['Require' => True, 'Min_Length' => 0,
				'Max_Length' => Picture_Len, 'Default' => Housing]);


		//////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////


		$this->Advertise_ContactStatus = FormsEngine::RadioButtonField(['Require' => True,
				'Min_Length' => 4, 'Max_Length' => 8, 'Default' => 'Both',
				'Options' => [ 'Messages', 'Phone', 'Both' ]]);


		//////////////////////////////////////////////////////////////////////////////
		//////////////////////////////////////////////////////////////////////////////


		$this->User_City = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Address_Len]);
		$this->User_Name = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Name_Len]);
		$this->User_Phone = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Phone_Len]);


		$this->FORMDATA = $Data;
		$this->OBJECTS = get_object_vars($this);
	}

	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////


	function GetAdvertise_Name(){
		return $this->FILTERED_DATA['Advertise_Name'];
	}

	function GetAdvertise_Price(){
		return $this->FILTERED_DATA['Advertise_Price'];
	}

	function GetAdvertise_Change(){
		return ( $this->FILTERED_DATA['Advertise_Change'] ) ? '1' : '0' ;
	}
	function GetAdvertise_Installment(){
		return ( $this->FILTERED_DATA['Advertise_Installment'] ) ? '1' : '0' ;
	}
	function GetAdvertise_Free(){
		return ( $this->FILTERED_DATA['Advertise_Free'] ) ? '1' : '0' ;
	}

	function GetAdvertise_Type(){
		return $this->FILTERED_DATA['Advertise_Type'];
	}

	function GetAdvertise_Status(){
		return $this->FILTERED_DATA['Advertise_Status'];
	}

	function GetAdvertise_Descreption(){
		return $this->FILTERED_DATA['Advertise_Descreption'];
	}

	/////////////////////////////////////////////////////////

	function GetFile1(){
		return $this->FILTERED_DATA['File1'];
	}

	function GetFile2(){
		return $this->FILTERED_DATA['File2'];
	}
	
	function GetFile3(){
		return $this->FILTERED_DATA['File3'];
	}

	function GetFile4(){
		return $this->FILTERED_DATA['File4'];
	}

	/////////////////////////////////////////////////////////

	function GetContactStatus(){
		if ( $this->FILTERED_DATA['Advertise_ContactStatus'] == 'Both' )
			return 0;
		else if ( $this->FILTERED_DATA['Advertise_ContactStatus'] == 'Phone' )
			return 1;
		return 2;
	}

	/////////////////////////////////////////////////////////

	function GetUser_City(){
		return $this->FILTERED_DATA['User_City'];
	}

	function GetUser_Name(){
		return $this->FILTERED_DATA['User_Name'];
	}

	function GetUser_Phone(){
		return $this->FILTERED_DATA['User_Phone'];
	}
}