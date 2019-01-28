<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Success Sign UP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>SuccessSignUP.CSS">
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>
</head>
<body>

    <?php include_once NotLoggedHeaders; ?>

	<section>
		<P class="P1">Please Check Your Email To Complete The Proccess Of SIGN UP</P>
		<p class="P2"><strong>Note : </strong>
            if You Didn't Complete The Process Of Sign UP in One Week Your Data Will be Deleted From Server</p>
	</section>

	<?php  include_once Footer; ?>
</body>
</html>

<?php exit(); ?>