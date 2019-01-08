<?php
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Type'])
			&& isset($_POST['Status']) && isset($_POST['Distruct'])
			&& isset($_POST['Area']) && isset($_POST['Furnished'])
			&& isset($_POST['Rooms']) && isset($_POST['PathRooms']) ){

		try{
			$pdo = new PDO("mysql:host=localhost;dbname=findhouse", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			

		}catch(Exception $e){
			echo "Error";
		}
		exit();
	}
?>

<!DOCTYPE>
<html>
<head>
    <title>Predict Price</title>
    <link rel="icon" type="image/JPG" href="../LOGO.PNG">
</head>
<body >
	<div style="text-align: center;background-color: red;
			margin: 20 20 20 20;padding: 20 20 20 20;
			border-color: red; border-style: solid;
			border-radius: 5px;border-width: 1px;">

    	<p >This Page Is Not For You To Enter Go Back</p>
    	<a href='http://localhost/FindHouse/Main/Main.php'>Go To Main Page</a>
    </div>
</body>
</html>