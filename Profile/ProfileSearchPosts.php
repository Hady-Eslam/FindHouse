<?php
	
	if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['Number']) ){

		session_start();
		$Email = $_SESSION['Email'];
		$Num = $_POST['Number'];
		session_write_close();

		$Query = "SELECT * FROM posts WHERE deleted='NO' "
				."AND useremail='$Email' LIMIT $Num, 4";

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

				$date = $XML->createElement('date',
					$result['post_day']." / ".$result['post_month']." / ".
					$result['post_year']
				);
				$Result->appendChild($date);

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
	        $XML->save('Posts.xml');
	        if ( $End==true)
	        	echo "Success";
	        else
	        	echo "NoData";

		}catch( Exception $e ){
			echo "Error";
		}
		exit();
	}
?>