<?php
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID']) ){
		
		$ID = $_POST['ID'];
		$Query = "UPDATE posts SET deleted='YES' WHERE id='$ID'";

		try{
			$pdo = new PDO("mysql:host=localhost;dbname=findhouse", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = $pdo->prepare($Query);
            $sql->execute();

			echo "Success";
		}catch(Exception $e){
			echo "Failed";
		}
		exit();
	}
?>