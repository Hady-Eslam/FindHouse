<!DOCTYPE >
<html>
<head>
	<title>Log in</title>

    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>LoginScript.js"></script>
</head>

<body>

    <?php include_once NotLoggedHeaders; ?>

	<section>

        <div class ='Title'>
            Log in
        </div>

		<form id='LogForm' method="post" enctype="multipart/form-data"
                action="<?php echo Login; ?>">
			<div>
				<input type="text" id='Email' required name="E"
                    placeholder="Enter Your Email" value="<?php echo $GLOBALS['E']; ?>">
			</div>
			
            <div>
				<input id='Password' type="Password" name="P" required
                            placeholder="Enter Password">
			</div>

            <div>
                <a href="<?php echo ForgetPassword; ?>">Forget Your Password?</a>
            </div>

            <div>
                <input type="submit" value="Log in">
            </div>

			<div>
				<a href="<?php echo SignUP; ?>">Create New Acount</a>
			</div>
		</form>

	</section>

	<?php  include_once Footer; ?>

    <script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == 'Email And Phone Not Found' )
        echo "$('#Email').css('border-color','red');";

    else if ( $GLOBALS['Result'] == 'Wrong Password' )
        echo "$('#Password').css('border-color','red');";
?>
    </script>

    <script type="text/javascript">
        var Email_Len = <?php echo Email_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;
    </script>

</body>
</html>

<?php exit(); ?>