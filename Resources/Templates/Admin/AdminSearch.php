<?php
	session_start();
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Name']) ){
		if ( $_SESSION['Status']=='Admin' && isset($_POST['Permession']) ){

			$Query = "SELECT * FROM users WHERE status='User' AND ";
			if ( $_POST['Type']=='Active' )
				$Query .= "deleted='NO' LIMIT ".$_POST['Num'].",5";
			else if ( $_POST['Type']=='Deleted' )
				$Query .= "deleted='YES' LIMIT ".$_POST['Num'].",5";

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
					
					$name = $XML->createElement('name',$result['name']);
					$Result->appendChild($name);

					$email = $XML->createElement('email',$result['email']);
					$Result->appendChild($email);
					
					$date = $XML->createElement('date'
						,$result['sign_in_day'].'/'.$result['sign_in_month'].'/'.
						$result['sign_in_year']);
					$Result->appendChild($date);

	        		$End = true;
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