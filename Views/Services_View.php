<?php  set_error_handler("Error_Handeler");

function Services_Help(){
	$_SESSION['Page Name'] = 'Help';
	include_once Help_Template;
}

function Services_Privacy(){
	$_SESSION['Page Name'] = 'Privacy';
	include_once Privacy_Template;
}
?>