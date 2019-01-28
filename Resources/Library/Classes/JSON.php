<?php set_error_handler("Error_Handeler");
/*
	-info
		php page  	=>  JSON.php
		init name 	=>  JSON
		class name 	=> 	JSONClass
		object name => 	$JSON

	- Depences Files :
        NONE
*/

class JSONClass{

	function MakeJson($Object){
		try{
			return json_encode($Object);
		}
		catch (Exception $e){
			return json_encode( Returns(-1, '',
				Error('JSON Error', '15', 'Error in Converting To JSON') ) );
		}
	}
}
$JSON = new JSONClass();
?>