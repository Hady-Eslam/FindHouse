<?php

function ShowResult($Result){
	if ( $Result == '' )
		return '<strong style="color:green;">Thanks For Registering in Our News Feed And You Will Recieve Notifications On Updates</strong>';
	return '<strong style="color:red;">You Must Register Valid Email</strong>';
}