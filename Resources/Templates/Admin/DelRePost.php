<?php
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ID']) ){
		
		$ID = $_POST['ID'];
		$Query = "UPDATE posts SET ";

		if ( $_POST['Status']=='Delete' )
			$Query .= "deleted='YES' WHERE id='$ID'";
		else
			$Query .= "deleted='NO' WHERE id='$ID'";
		
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

<!DOCTYPE>
<html>
<head>
    <title>Del Re Post</title>
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