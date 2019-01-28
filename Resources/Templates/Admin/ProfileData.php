<?php
	session_start();
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Name']) ){
		if ( $_SESSION['Status']=='Admin' && isset($_POST['Email']) ){

			$Email = $_POST['Email'];
			$Query = "SELECT * FROM users WHERE status='User' AND email='$Email'";

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

					$deleted = $XML->createElement('deleted',$result['deleted']);
					$Result->appendChild($deleted);
					
					$name = $XML->createElement('name',$result['name']);
					$Result->appendChild($name);

					$email = $XML->createElement('email',$result['email']);
					$Result->appendChild($email);

					$phone = $XML->createElement('phone',$result['phone']);
					$Result->appendChild($phone);

					$password = $XML->createElement('password',$result['password']);
					$Result->appendChild($password);
					
					$date = $XML->createElement('date'
						,$result['sign_in_day'].'/'.$result['sign_in_month'].'/'.
						$result['sign_in_year']);
					$Result->appendChild($date);

	        		$End = true;

					$Query = "SELECT * FROM posts WHERE useremail='$Email'";
					
					$MY_SQL = $pdo->prepare($Query);
		        	$MY_SQL->execute();

		        	$Count = 0;
		        	while ( $Res = $MY_SQL->fetch(PDO::FETCH_ASSOC) ) {
		        		$Count++;
		        	}

		        	$posts = $XML->createElement('posts',$Count);
					$Result->appendChild($posts);
	        	}
	        	$XML->save('Profile.xml');
	        	
	        	if ( $End==true)
		        	echo "Success";
		        else
		        	echo "NoData";

			}catch( Exception $e ){
				echo "Failed";
			}
			exit();
		}
	}
?>

<!DOCTYPE>
<html>
<head>
    <title>Profile Data</title>
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