<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/Resources/Config.php';
include_once MySqlDB;

var_dump($MySql->excute('UPDATE interested SET deleted = ?', array(
'0'
)));
?>