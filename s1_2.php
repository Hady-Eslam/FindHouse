<?php
private function HEllo(){
	echo 'Hello';
}

function X(){
	HEllo();
}

X();

exit();
Returns 'Hello';
include_once $_SERVER['DOCUMENT_ROOT'].'/s2.php';
?>