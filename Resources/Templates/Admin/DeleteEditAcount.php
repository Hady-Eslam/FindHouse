<?php
	session_start();
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Name']) 
		&& $_SESSION['Status']=='Admin' && isset($_POST['ID']) ){


		$Query = "UPDATE users SET ";
		
		if ($_POST['Status']=='Delete')
			$Query .= "deleted='YES' WHERE id='".$_POST['ID']."'";
		else
			$Query .= "deleted='NO' WHERE id='".$_POST['ID']."'";

		try{
			$pdo = new PDO("mysql:host=localhost;dbname=findhouse", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = $pdo->prepare($Query);
	        $sql->execute();

	        echo "Success";
		}catch( Exception $e ){
			echo "Failed";
		}
		exit();
	}
?>
<!DOCTYPE>
<html>
<head>
    <title>No Page</title>
    <link rel="icon" type="image/JPG" href="../LOGO.PNG">
</head>
<body >
	<div style="text-align: center;background-color: red;margin: 20 20 20 20;
				padding: 20 20 20 20;border-color: red; border-style: solid;
				border-radius: 5px;border-width: 1px;">
    	<p >This Page Is Not For You To Enter Go Back</p>
    	<a href='http://localhost/FindHouse/Main/Main.php'>Go To Main Page</a>
    </div>
</body>
</html>