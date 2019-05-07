<?php

function SignUP_Result($Result){
	
    if ( $Result == "Name Found" )
    	return '<strong style="color: red;font-size: 30px;">Name is Reserved</strong>';

    else if ( $Result == "Email Found" )
    	return '<strong style="color: red;font-size: 30px;">Email is Reserved</strong>';

    else if ( $Result == "Phone Found" )
    	return '<strong style="color: red;font-size: 30px;">Phone is Reserved</strong>';
    
    return '';
}