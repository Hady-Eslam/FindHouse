<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Predict</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Predict.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>PredictScript.js"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Predict Price
		</div>

        <div>
            <p>This Function Under Mentainance</p>
        </div>
	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>