<?php

namespace Forms\DOForms\AdvertiseForms;
use CoreForms\FormsEngine;

class AdvertiseHomeForm extends FormsEngine{
	
	function __construct(...$Data){

		$this->Advertise_Name = FormsEngine::TextField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Advertise_Name_Len]);

		$this->Advertise_Price = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => Money_Len, 'Min_Value' => 0]);

		$this->Advertise_Garage = FormsEngine::CheckBoxField();
		$this->Advertise_Security = FormsEngine::CheckBoxField();
		$this->Advertise_Garden = FormsEngine::CheckBoxField();


		$this->Advertise_Rooms = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => 1, 'Min_Value' => 0, 'Max_Value' => 9]);

		$this->Advertise_PathRooms = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => 1, 'Min_Value' => 0, 'Max_Value' => 9]);


		$this->Advertise_Furnished = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 2, 'Max_Length' => 3, 'Options' => [ 'Yes', 'No' ]]);

		$this->Advertise_Storey = FormsEngine::IntegerField(['Require' => True,
				'Min_Length' => 1, 'Max_Length' => 2, 'Min_Value' => 0, 'Max_Value' => 20]);


		$this->Advertise_Finishing = FormsEngine::SelectField(['Require' => True,
				'Min_Length' => 3, 'Max_Length' => 13, 'Default' => 'Normal',
				'Options' => [ 'Red Bricks', 'On Cement', 'Normal', 'Semi Finished',
								'Lux', 'Super Lux', 'High Lux']]);


		$this->Advertise_Area = FormsEngine::IntegerField(['Require' => True, 'Min_Length' => 1,
				'Max_Length' => Area_Len, 'Min_Value' => 0]);

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

	function GetAdvertise_Garage(){
		return ( $this->FILTERED_DATA['Advertise_Garage'] ) ? '1' : '0' ;
	}
	function GetAdvertise_Security(){
		return ( $this->FILTERED_DATA['Advertise_Security'] ) ? '1' : '0' ;
	}
	function GetAdvertise_Garden(){
		return ( $this->FILTERED_DATA['Advertise_Garden'] ) ? '1' : '0' ;
	}

	function GetAdvertise_Rooms(){
		return $this->FILTERED_DATA['Advertise_Rooms'];
	}

	function GetAdvertise_PathRooms(){
		return $this->FILTERED_DATA['Advertise_PathRooms'];
	}

	function GetAdvertise_Furnished(){
		return $this->FILTERED_DATA['Advertise_Furnished'];
	}

	function GetAdvertise_Storey(){
		return $this->FILTERED_DATA['Advertise_Storey'];
	}

	function GetAdvertise_Finishing(){
		return $this->FILTERED_DATA['Advertise_Finishing'];
	}

	function GetAdvertise_Area(){
		return $this->FILTERED_DATA['Advertise_Area'];
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