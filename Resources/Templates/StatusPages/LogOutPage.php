<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Log Out</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet"type="text/css"href="<?php echo PagesCSS;?>LogOut.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Log Out
		</div>

		<p>You Must Log Out To Enter This Page</p>
    	<a href="<?php echo LogOut; ?>">Enter Here To Log Out</a>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>