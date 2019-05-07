<?php

function ShowResult($Result){
	if ( $Result == '' )
		return '';
	else if ( $Result == 'Done' )
		return '<div>
		            <h2 style="color: green">Done Sending Your Message</h2>    
		        </div>';
	return '<div>
	            <h2 style="color: red">Not Valid Data</h2>    
	        </div>';
}