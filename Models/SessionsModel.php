<?php

include_once MySqlDB;
include_once HashClass;

class SessionModel{
	
	function __construct($Name){
		$this->MySql = new MYSQLClass($Name);
		$this->Hashing = new HashingClass();
	}

	function Insert(array $Data){

	}

	function Update(array $Data){

	}

	function Delete($id){
		return $this->MySql->excute('DELETE FROM session WHERE id = ?',
                  	array($this->Hashing->Hash_Session($id));
	}

	function Select(array $Data){

	}
}