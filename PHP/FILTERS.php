<?php
/*
    -info
        php page    =>  FILTERS.php
        init name   =>  FILTERS
        class name  =>  FILTERSClass
        object name =>  FILTER

*/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C7';
else
    $GLOBALS['Page_API_Error_Code'] = 'C7';
set_error_handler("Error_Handeler");

class FILTERSClass{

    public $FILTER_Result = '';

    
    function FilterEmail($Email){
        $this->FILTER_Result = filter_var($Email, FILTER_VALIDATE_EMAIL) ;

        if ( empty($Email) )
            return array(0, 'Empty');
        if ( strlen($Email) > Email_Len )
            return array(0, 'Too Long');
        return array(0, 'OK');
    }

    function FilterName($Name){
        return $this->FilterString($Name, Name_Len);
    }

    function FilterPassword($Password){
        return $this->FilterString($Password, Password_Len);
    }

    function FilterPhone($Phone){
        $this->FILTER_Result = filter_var($Phone, FILTER_SANITIZE_STRING);

        if ( empty($Phone) )
            return array( 0, 'Empty');
        if ( strlen($Phone) != Phone_Len )
            return array(0, 'Too Long');
        return array(0, 'OK');
    }

    function FilterToken($Token){
        return $this->FilterString($Token, Token_Len);
    }

    /*
        - Return : 
            return array(0, 'Empty');
            return array(0, 'Too Long');
            return array(0, 'OK');
    */
    function FilterString($String, $Len){
        $this->FILTER_Result = filter_var($String, FILTER_SANITIZE_STRING);

        if ( empty($String) )
            return array(0, 'Empty');
        else if ( strlen($String) > $Len )
            return array(0, 'Too Long');
        return array(0, 'OK');
    }

    /*
        Return :
            return array(0, 'Too Long');
            return array(0, 'Wrong Extention');
            return array(0, 'Not Found');
            return array(0, 'Name Empty');
            return array(0, 'Empty');
            return array(0, 'OK');
    */
    function FilterPicture($Key){
        $File_Size = $_FILES[ $Key ]['size'];
        if ( $File_Size > Picture_Len )
            return array(0, 'Too Long');

        $Ext = strtolower( pathinfo($_FILES[ $Key ]['name'], PATHINFO_EXTENSION) );
        if ( $Ext != 'jpeg' && $Ext != 'jpg' && $Ext != 'png' && $Ext != 'gif' )
            return array(0, 'Wrong Extention');

        else if ( empty($_FILES[ $Key ]['tmp_name']) )
            return array(0, 'Not Found');

        else if ( empty($_FILES[ $Key]['name']) ){
            if ( $File_Size != 0 )
                return array(0, 'Name Empty');
            return array(0, 'Empty');
        }

        else if ( $File_Size == 0 )
            return array(0, 'Empty');

        return array(0, 'OK');
    }
}

$FILTER = new FILTERSClass();
?>