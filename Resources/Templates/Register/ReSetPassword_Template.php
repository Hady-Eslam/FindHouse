<!DOCTYPE>
<html>
<head>
	<title>New Password</title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>ReSetPassword.CSS">
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckPasswordScript; ?>"></script>
    
    <script src="<?php echo PagesScripts; ?>ReSetPasswordScript.js"></script>
</head>
<body>

	<?php include_once AllHeaders; ?>

	<section>
		
		<div class = 'Title'>
            ReSet Password
        </div>

<?php
    if ( $GLOBALS['Result'] == 'Done' ){
?>
        <p>Password Has Changed</p>
        <a href="<?php echo Login; ?>">Enter To Go To Log in Page</a>
<?php
    }
    else{
?>
		<form id='ReSetPasswordForm' method="post" enctype="multipart/form-data"
            action="<?php echo ReSetPassword; ?>">

            <div>
            	<input type="hidden" name="E" value='<?php echo $GLOBALS['E']; ?>'>
            </div>

            <div>
                <input type="hidden" name="T" value='<?php echo $GLOBALS['T']; ?>'>
            </div>

            <div>
				<input id='Password' type="Password" name="P" required
                    placeholder="Enter New Password">
			</div>

			<div>
				<input id='ConPassword' type="Password" name="ConPassword" required
                    placeholder="Re Enter Password">
			</div>

			<div>
                <input type="submit" value="ReSet Password">
            </div>
			
		</form>
<?php
    }
?>

	</section>

	<?php  include_once Footer; ?>

	<script type="text/javascript">
		var Password_Len = <?php echo Password_Len; ?>;
	</script>

</body>
</html>

<?php exit(); ?>