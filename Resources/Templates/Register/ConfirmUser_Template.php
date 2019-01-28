<?php set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Confirm User</title>
	<link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>ConfirmUser.CSS">
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

	<script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>
</head>
<body>

	<?php include_once NotLoggedHeaders; ?>

	<section>

		<div class="Title">
			Confirm User
		</div>

		<p>Congratulation On Completing The Process Of Sign UP</p>
		<p>Go To Log in Page To Log And use Your Acount</p>
		<br>
		<a href="<?php echo Login; ?>">Click To Go To Log in Page</a>
		
	</section>

	<?php  include_once Footer; ?>

</body>
</html>

<?php exit(); ?>