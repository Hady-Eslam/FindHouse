<?php
	session_start();
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['Name']) ){
		try{
			$pdo = new PDO("mysql:host=localhost;dbname=findhouse", "root", "");
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$Query = "SELECT * FROM posts WHERE useremail='".$_SESSION['Email']
				."' AND id='".$_POST['ID']."'";

			$sql = $pdo->prepare($Query);
            $sql->execute();
            $found = false;

            $XML = new DOMDocument('1.0');
	        $XML->formatOutput = true;

	        $Results = $XML->createElement('Results');
	        $XML->appendChild($Results);

			while ( $result = $sql->fetch(PDO::FETCH_ASSOC) ) {
				$found = true;
				$Result = $XML->createElement('result');
	        	$Results->appendChild($Result);
	        	
				$distruct = $XML->createElement('distruct',$result['distruct']);
				$Result->appendChild($distruct);

				$street = $XML->createElement('street',$result['street']);
				$Result->appendChild($street);
				
				$status = $XML->createElement('status',$result['status']);
				$Result->appendChild($status);
				
				$type = $XML->createElement('type',$result['type']);
				$Result->appendChild($type);

				$area = $XML->createElement('area',$result['area']);
				$Result->appendChild($area);

				$Furnished = $XML->createElement('Furnished',$result['Furnished']);
				$Result->appendChild($Furnished);

				$rooms = $XML->createElement('rooms',$result['rooms']);
				$Result->appendChild($rooms);

				$pathrooms = $XML->createElement('pathrooms',$result['pathrooms']);
				$Result->appendChild($pathrooms);

				$phone = $XML->createElement('phone',$result['phone']);
				$Result->appendChild($phone);
				
				$price = $XML->createElement('price',$result['price']);
				$Result->appendChild($price);

				$discreption = $XML->createElement('discreption',
								$result['discreption']);
				$Result->appendChild($discreption);
			}
			$XML->save('Result.xml');
			if ($found==false)
				echo "You Are Not Authorized To Edit This Post";
			else
				echo "Success";
		}catch(Exception $e){
			echo "Failed";
		}
		exit();
	}
	session_write_close();
?>


<!DOCTYPE>
<html>
<head>
	<title>Edit Post</title>
	<link rel="icon" type="image/JPG" href="Icon.JPG">
</head>
<body style="text-align: center;">
	<p style="margin-top: 200px;">Can Not Go To This Page</p>
	<a href='http://localhost/FindHouse/Main.php'>Go To The Main Page</a>
</body>
</html>