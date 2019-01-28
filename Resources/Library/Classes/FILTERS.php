<?php set_error_handler("Error_Handeler");
/*
    -info
        php page    =>  FILTERS.php
        init name   =>  FILTERS
        class name  =>  FILTERSClass
        object name =>  FILTER

    - Depences Files :
        NONE
*/

class FILTERSClass{

    private Function Call_Function($Function, $Para_Or_Value, $Key){
        if ( $Function == 'Redirect' )
            Redirect($Para_Or_Value);
        else if ( $Function == 'interested_GET' )
            call_user_func($Function, $Para_Or_Value);
        else if ( $Function != '' )
            call_user_func($Function);
        else
            $GLOBALS[$Key] = $Para_Or_Value;
    }

    private function FILTER_SUPER_DATA($Type, $Data, $Function, $Para){
        foreach ($Data as $Key => $Value) {
            $Result = NULL;
            $DataValue = '';

            if ( $Type == 'POST' && isset($_POST[$Key]) )
                $DataValue = $_POST[$Key];
            else if ( $Type == 'GET' && isset($_GET[$Key]) )
                $DataValue = $_GET[$Key];
            else
                if ( isset($Value['Default']) )
                    $this->Call_Function('', $Value['Default'], $Key);
                else if ( isset($Value['Error_Function'] ) )
                    $this->Call_Function($Value['Error_Function'],
                            $Value['Error_Function_Para'], $Key);
                else
                    $this->Call_Function($Function, $Para, $Key);

            if ( $Value['Type'] == 'EMAIL' )
                $Result = $this->FilterEmail($DataValue);
            else if ( $Value['Type'] == 'INT' )
                $Result = $this->FilterNumber($DataValue, $Value['Len'],
                            $Value['Min'], $Value['Max']);
            else
                $Result = $this->FilterString($DataValue, $Value['Len'] );

            if ( $Result->Result != 'OK' )
                if ( isset($Value['Default']) )
                    $this->Call_Function('', $Value['Default'], $Key);
                else if ( isset($Value['Error_Function'] ) )
                    $this->Call_Function($Value['Error_Function'],
                            $Value['Error_Function_Para'], $Key);
                else
                    $this->Call_Function($Function, $Para, $Key);
            else
                $GLOBALS[$Key] = $Result->Data;
        }
    }

    function FILTER_POST($Data, $Function = '', $Para = ''){
        return $this->FILTER_SUPER_DATA('POST', $Data, $Function, $Para);
    }

    function FILTER_GET($Data, $Function = '', $Para = ''){
        return $this->FILTER_SUPER_DATA('GET', $Data, $Function, $Para);
    }

    private function CheckString($String, $Len){
        if ( strlen($String) == 0 )
            return Returns('Empty');
        if ( strlen($String) > $Len )
            return Returns('Too Long', $String);
        return Returns('OK', $String);
    }
    // Filter Email
    function FilterEmail($Email){
        return $this->CheckString(filter_var($Email, FILTER_VALIDATE_EMAIL), Email_Len);
    }

    // Filter String
    function FilterString($String, $Len){
        return $this->CheckString( filter_var($String, FILTER_SANITIZE_STRING), $Len);
    }

    // Filter Number
    function FilterNumber($Number, $Len, $Min, $Max){
        
        $Result = $this->FilterString($Number, $Len);
        if ( $Result->Result != 'OK' )
            return $Result;
        
        if ( is_numeric($Result->Data) == false )
            return Returns('Not Number', $Result->Data );

        $Result->Data = intval($Result->Data);
        
        if ( $Result->Data >= $Min && $Result->Data <= $Max )
            return Returns('OK', $Result->Data );

        return Returns('Not in Range', $Result->Data );
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
        
        if ( $_FILES[ $Key ]['size'] > Picture_Len )
            return Returns('Too Long');

        else if ( $_FILES[ $Key ]['size'] == 0 )
            return Returns('Empty');

        else if ( empty($_FILES[ $Key]['name']) ){
            if ( $_FILES[ $Key ]['size'] != 0 )
                return Returns('Name Empty');
            return Returns('Empty');
        }

        else if ( empty($_FILES[ $Key ]['tmp_name']) )
            return Returns('Not Found');

        $Ext = strtolower( pathinfo($_FILES[ $Key ]['name'], PATHINFO_EXTENSION) );
        if ( $Ext != 'jpeg' && $Ext != 'jpg' && $Ext != 'png' && $Ext != 'gif' )
            return Returns('Wrong Extention');

        return Returns('OK');
    }
}
$FILTER = new FILTERSClass();
?>