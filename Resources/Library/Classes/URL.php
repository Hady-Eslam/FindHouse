<?php set_error_handler("Error_Handeler");
/*
    -info
        php page    =>  URL.php
        init name   =>  URL
        class name  =>  URLClass
        object name =>  URL_REFERER

    - Depences Files :
        NONE
*/

class URLClass{

    function Request(){
        return $_SERVER["REQUEST_METHOD"];
    }

    function REFFERE_is_SET(){
        if ( isset($_SERVER["HTTP_REFERER"]) )
            return true;
        return false;
    }

    function Get_REFFERE(){
        if ( isset($_SERVER["HTTP_REFERER"]) )
            return $_SERVER["HTTP_REFERER"];
        return '';
    }

    /*
        What is Doing Check Where The Request is Coming From
        $_SERVER["HTTP_REFERER"] is getting Where The Request Coming From
    */
    function CheckREFFERE($URL){
        try{
            if ( !isset($_SERVER["HTTP_REFERER"]) )
                return false;
            return $this->Compare( $URL, $_SERVER["HTTP_REFERER"]);
        }
        catch(Exception $e){
            return false;
        }
    }

    // Compare The Coming URL With The Specific URL
    function Compare($URL, $incomingURL = ''){
        if ( empty($incomingURL) )
            $incomingURL = HTTP_ROOT.'/'.$_GET['URL'];
        if ( $incomingURL == $URL )
            return true;
        return false;
    }

    function Match($Pattern, $URL = ''){
        $URL = ( $URL == '' )? $_GET['URL'] : $URL ;
        return preg_match($Pattern, $URL);
    }

    function GetMetched($Pattern, $URL = '', $index = 1){
        $URL = ( $URL == '' )? $_GET['URL'] : $URL ;
        preg_match($Pattern, $URL, $Result);
        return $Result[$index];
    }
}
$URL = new URLClass();
?>