<!DOCTYPE>
<html>
<head>
	<title>Forget Password</title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>ForgetPassword.CSS">
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>ForgetPasswordScript.js"></script>
</head>
<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class = 'Title'>
            Forget Password
        </div>
<?php
    if ( $GLOBALS['Result'] == 'Done' ){
?>  
        <p>The Email is Succesfully Sended</p>
        <p><strong>Note : </strong>The Token Will Be Deleted After 3 Days</p>
<?php
    }
    else{
?>
		<form id='ForgetForm' method="post" enctype="multipart/form-data"
            action="<?php echo ForgetPassword; ?>">

			<p>Please Enter Your Email</p>
			<P>To Send You The Reset Link</P>
            <div>
				<input type="text" id='Email' required name="E"
                        placeholder="Enter Your Email">
			</div>

			<div>
                <input type="submit" value="Send">
            </div>
        </form>
<?php
    }
?>
	</section>

	<?php  include_once Footer; ?>

	<script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == 'Email Not Found' )
        echo "$('#Email').css('border-color', 'red');";
?>
	</script>

	<script type="text/javascript">
		var Email_Len = <?php echo Email_Len; ?>;
	</script>

</body>
</html>

<?php exit(); ?>