<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Help Center</title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Advertise.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>
</head>

<body>

	<?php include_once AllHeaders; ?>

    <section style="text-align: left;">
    	<p>Questions On How To Use WebSite</p>
    	<a href="">How To Post Advertising</a>
    	<a href="">How To Use Predict</a>
    	<a href="">How To Use Search</a>
    	<a href="">How To Make New Acount</a>
    	<a href="">How To Change The Profile Information</a>
    	<a href="">How To Delete Post</a>

        <a href="">About DeAcivating Your Account</a>
        <a href="">About Deleting Your Account</a>
    </section>

    <?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>