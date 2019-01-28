<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>404 Not Found</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet"type="text/css"href="<?php echo PagesCSS;?>404.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Page Not Found
		</div>

		<p>We Are Sorry To Say This Page Not Found</p>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>