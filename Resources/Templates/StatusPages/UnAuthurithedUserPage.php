<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Un Authurithed User</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" 
    		href="<?php echo PagesCSS;?>UnAuthurizedUser.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Un Authurized User
		</div>

		<P>You  Can't Enter This Page</P>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>