<?php
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" ){

		function Get(){

			$Query = "SELECT * FROM posts";
			$X = 0;

			if ( $_POST['Rent']=='Y' ){
				$X = 1;
				$Query .= " WHERE ( status='Rent' ";
			}

			if ( $_POST['Buy']=='Y' ){
				
				if ( $X==1 )
					$Query .= " OR status='Buy' )";
				else
					$Query .= " WHERE status='Buy' ";

				$X = 2;
			}

			if ( $X==1 )
				$Query .=")" ;
			

			$x = 0;
			if ( $_POST['Families']=='Y' ){
				$x = 1;

				if ( $X!=0 )
					$Query .=" AND ( type='For Families' ";
				else
					$Query .=" WHERE ( type='For Families' ";
			}

			if ( $_POST['Offices']=='Y'){
				
				if ( $x==1 )
					$Query .= " OR type='For Offices' ";
				else
					if ( $X==0 )
						$Query .= " WHERE ( type='For Offices' ";
					else
						$Query .= " AND ( type='For Offices' ";
				$x = 2;
			}

			if ( $_POST['Students']=='Y'){
				
				if ( $x!=0 )
					$Query .= " OR type='For Students' ";
				else
					if ( $X==0 )
						$Query .= " WHERE ( type='For Students' ";
					else
						$Query .= " AND ( type='For Students' ";
				$x = 3;
			}

			if ( $x!=0 )
				$Query .= ')';

			if ( $X==0 && $x==0 )
				$Query .= " WHERE deleted='NO' ";
			else
				$Query .= " AND deleted='NO' ";

			$Number = $_POST['Number'];
			$Query .= ' LIMIT '.$Number.", 3";
			return $Query;
		}

		$Query = Get();

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
	        	
				$distruct = $XML->createElement('distruct',$result['distruct']);
				$Result->appendChild($distruct);
				
				$status = $XML->createElement('status',$result['status']);
				$Result->appendChild($status);
				
				$type = $XML->createElement('type',$result['type']);
				$Result->appendChild($type);
				
				$price = $XML->createElement('price',$result['price']);
				$Result->appendChild($price);
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
?>


<!DOCTYPE>
<html>
<head>
    <title>Search Posts</title>
    <link rel="stylesheet" type="text/css" href="Footer.css">
    <link rel="icon" type="image/JPG" href="LOGO.PNG">
</head>
<body>
	<div style="text-align: center;background-color: red;margin: 20 20 20 20;
				padding: 20 20 20 20;border-color: red; border-style: solid;
				border-radius: 5px;border-width: 1px;">
    	<p>This Page Is Not For You To Enter Go Back</p>
    	<a href='http://localhost/FindHouse/Main/Main.php'>Go To Main Page</a>
    </div>
</body>
</html>