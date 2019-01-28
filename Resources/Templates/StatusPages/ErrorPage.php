<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Error Occured</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet"type="text/css"href="<?php echo PagesCSS;?>Error.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Error
		</div>

		<p>Error Occured When Proccessing Data</p>
		<p>Go To Main Page</p>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>