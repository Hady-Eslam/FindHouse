<?php
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Number'])
			&& isset($_POST['Email']) ){

		$Email = $_POST['Email'];
		$Num = $_POST['Number'];

		$Query = "SELECT * FROM posts WHERE "
				."useremail='$Email' LIMIT $Num, 4";

		try{
			$pdo = new PDO("mysql:host=localhost;dbname=findhouse", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$sql = $pdo->prepare($Query);
	        $sql->execute();

	        $XML = new DOMDocument('1.0');
	        $XML->formatOutput = true;

	        $Results = $XML->createElement('Results');
	        $XML->appendChild($Results);

	        $End = false;

	        while ( $result = $sql->fetch(PDO::FETCH_ASSOC) ) {

	        	$Result = $XML->createElement('result');
	        	$Results->appendChild($Result);
				
				$id = $XML->createElement('id',$result['id']);
				$Result->appendChild($id);

				$status = $XML->createElement('status',$result['status']);
				$Result->appendChild($status);
				
				$type = $XML->createElement('type',$result['type']);
				$Result->appendChild($type);
				
				$price = $XML->createElement('price',$result['price']);
				$Result->appendChild($price);

				$deleted = $XML->createElement('deleted',$result['deleted']);
				$Result->appendChild($deleted);

				$post_day = $XML->createElement('post_day',$result['post_day']);
				$Result->appendChild($post_day);

				$post_month = $XML->createElement('post_month',$result['post_month']);
				$Result->appendChild($post_month);

				$post_year = $XML->createElement('post_year',$result['post_year']);
				$Result->appendChild($post_year);

				$End = true;
				$ID = $result['id'];
				$Query = "SELECT * FROM views WHERE post_id='$ID'";
				
				$MY_SQL = $pdo->prepare($Query);
	        	$MY_SQL->execute();

	        	$Count = 0;
	        	while ( $Res = $MY_SQL->fetch(PDO::FETCH_ASSOC) ) {
	        		$Count++;
	        	}

	        	$views = $XML->createElement('views',$Count);
				$Result->appendChild($views);
	        }
	        $XML->save('Result.xml');
	        if ( $End==true)
	        	echo "Success";
	        else
	        	echo "NoData";

		}catch( Exception $e ){
			echo "Failed";
		}
		exit();
	}
?>

<!DOCTYPE>
<html>
<head>
    <title>Profile Search Posts</title>
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