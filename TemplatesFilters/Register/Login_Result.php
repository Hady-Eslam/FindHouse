<?php

function Login_Result($Result){

    if ( $Result == 'Email Not Found' )
    	return '<strong style="color: red;font-size: 30px;">Wrong Email</strong>';

    else if ( $Result == 'Wrong Password' )
    	return '<strong style="color: red;font-size: 30px;">Wrong Password</strong>';

    return '';
}