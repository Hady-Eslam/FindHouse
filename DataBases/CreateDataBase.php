<?php
	
	try{
		$pdo = new PDO("mysql:host=localhost", "root", "");

		$db = "CREATE DATABASE IF NOT EXISTS findhouse";
		$b = $pdo->exec($db);

		if ( $b === false )
			die("couldn't create database");

	}catch(Exception $e){
		die("DB error, ".$e->getMessage());
	}

	$pdo->exec("use findhouse");

	try{
		$tb = <<<TABLE
			CREATE TABLE IF NOT EXISTS users (
				id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(40) NOT NULL,
				email VARCHAR(40) NOT NULL UNIQUE,
				password VARCHAR(40) NOT NULL,
				phone VARCHAR(15) NOT NULL,
				ip VARCHAR(15) NOT NULL,
				sign_in_day INT NOT NULL,
				sign_in_month INT NOT NULL,
				sign_in_year INT NOT NULL
			);
TABLE;

	$b = $pdo->exec($tb);
	if ($b === false)
		die("couldn't create table users");

	}catch(Exception $e){
		die($e->getMessage());
	}

	try{
		$TB = <<<TABLE
				CREATE TABLE IF NOT EXISTS posts (
					id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
					distruct VARCHAR(50) NOT NULL,
					street VARCHAR(50) ,
					status VARCHAR(50) NOT NULL,
					type VARCHAR(50) NOT NULL,
					phone VARCHAR(50) NOT NULL,
					area INT NOT NULL,
					rooms INT NOT NULL,
					pathrooms INT NOT NULL,
					price INT NOT NULL,
					Furnished VARCHAR(20),
					discreption TEXT,
					useremail VARCHAR(50) NOT NULL,
					post_day INT NOT NULL,
					post_month INT NOT NULL,
					post_year INT NOT NULL,
					deleted VARCHAR(5) NOT NULL,
					FOREIGN KEY (useremail) REFERENCES users(email)
				);
TABLE;
		$b = $pdo->exec($TB);
		if ($b === false)
			die("couldn't create table posts");

	}catch(Exception $e){
		die("Error ".$e->getMessage());
	}
	echo "Database FindHouse Created successfull And Table users created successfull";

?>