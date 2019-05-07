<?php

namespace Forms\DOForms\AdvertiseForms;
use CoreForms\FormsEngine;

class AdvertiseCarForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Advertise_Name = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Advertise_Name_Len]);

		$this->Advertise_Price = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Money_Len, 'Min_Value' => 0]);

		$this->Advertise_TextType = FormsEngine::TextField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Car_Type_Len, 'Default' => '']);

		$this->Advertise_SelectType = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Car_Type_Len, 'Default' => '']);


		$this->Advertise_Year = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => 4, 'Min_Value' => 0]);

		$this->Advertise_Model = FormsEngine::TextField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Car_Model_Len]);

		$this->Advertise_TextEngine = FormsEngine::TextField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Car_Engine_Len, 'Default' => '']);

		$this->Advertise_SelectEngine = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Car_Engine_Len, 'Default' => '']);


		$this->Advertise_SelectMotionVector = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 5, 'Max_Length' => 10,
					'Options' => ['Handy' , 'Automatic' , 'STEPTronic']]);




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

	function IS_TYPE_VALID(){
		if ( $this->FILTERED_DATA['Advertise_TextType'] === '' &&
				$this->FILTERED_DATA['Advertise_SelectType'] === '' ||

				$this->FILTERED_DATA['Advertise_TextEngine'] === '' && 
				$this->FILTERED_DATA['Advertise_SelectEngine'] === ''  )
			return False;
		return True;
	}


	function GetAdvertise_Name(){
		return $this->FILTERED_DATA['Advertise_Name'];
	}

	function GetAdvertise_Price(){
		return $this->FILTERED_DATA['Advertise_Price'];
	}


	function GetAdvertise_Type(){
		return ( $this->FILTERED_DATA['Advertise_TextType'] === '' ) ?
			  $this->FILTERED_DATA['Advertise_SelectType'] :
			  $this->FILTERED_DATA['Advertise_TextType'] ;
	}
	
	function GetAdvertise_Year(){
		return $this->FILTERED_DATA['Advertise_Year'];
	}

	function GetAdvertise_Model(){
		return $this->FILTERED_DATA['Advertise_Model'];
	}

	function GetAdvertise_Engine(){
		return ( $this->FILTERED_DATA['Advertise_TextEngine'] === '' ) ?
			  $this->FILTERED_DATA['Advertise_SelectEngine'] :
			  $this->FILTERED_DATA['Advertise_TextEngine'] ;
	}

	function GetAdvertise_MotionVector(){
		return $this->FILTERED_DATA['Advertise_SelectMotionVector'];
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