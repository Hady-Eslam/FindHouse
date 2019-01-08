<?php
	session_start();
	$_SESSION['Page'] = 'Analysis';
	if (isset($_SESSION['Name'])){
?>

<!DOCTYPE >
<html>
<head>
	<title>Analysis</title>
	<link rel="stylesheet" type="text/css" href="Header.css">
	<link rel="stylesheet" type="text/css" href="Center.css">
	<link rel="stylesheet" type="text/css" href="Footer.css">
	<link rel="icon" type="image/JPG" href="Icon.JPG">
</head>
<body onclick="Hide();" >

	<?php
		include '../HeaderLogged.php';
	?>

	<section>

		<div id='Title'>
			<p>Welcome To Analysis Function</p>
		</div>

	</section>

	<?php
		include '../Footer.php';
	?>

    <script type="text/javascript" src="http://localhost/FindHouse/DropBox.js"></script>

</body>
</html>

<?php
	}
	else{
?>

<!DOCTYPE>
<html>
<head>
	<title>Analysis</title>
	<link rel="icon" type="image/JPG" href="Icon.JPG">
</head>
<body style="text-align: center;">
	<p style="margin-top: 200px;">Can Not Go To This Page</p>
	<a href='http://localhost/FindHouse/MainPage.php'>Go To The Main Page</a>
</body>
</html>

<?php
	}
	session_write_close();
?>