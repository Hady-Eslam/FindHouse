<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE >
<html>
<head>
	
	<title>Sign UP</title>

    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>SignUP.CSS">
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo CheckPasswordScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>

    <script src="<?php echo CheckNameScript; ?>"></script>

    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>SignUPScript.js"></script>
</head>

<body>

	<?php include_once NotLoggedHeaders; ?>

	<section>

        <div class="Title">
            Sign UP Form
        </div>

        <p id="Success"></p>

		<form id='SignForm' method="post" enctype="multipart/form-data"
            action="<?php echo SignUP; ?>">

            <?php   include_once MessageBox; ?>

            <div>
    			
                <div>
                    <input oninput="CheckName()" type="text" id='Name' name="N" required
                    placeholder="Enter Your Name"value="<?php echo $GLOBALS['N']; ?>">
    			</div>

    			<div>
    				<input onchange="CheckEmail()"type="text"id='Email' name="E"required
                    placeholder="Enter Your Email" value="<?php echo $GLOBALS['E']; ?>">
    			</div>

                <div>
                    <input id='Phone' type="text" placeholder="Enter Your Phone"
                        oninput="CheckinputLen(this.id, Phone_Len);"name="Ph" required
                        value="<?php echo $GLOBALS['Ph']; ?>">
                </div>

                <div>
                    <input id='Password' type="password" placeholder="Enter Your Password"
                        required name="P" oninput="CheckinputLen(this.id, Password_Len);"
                        value="<?php echo $GLOBALS['P']; ?>">

                </div>

                <div>
                    <input id='ConPassword'type="password"placeholder="Re-Enter Password"
                        required oninput="CheckinputLen(this.id, Password_Len);"
                        value="<?php echo $GLOBALS['P']; ?>">
                </div>
            </div>
            
            <div>
                <div>
                    <input type="submit" value="Sign UP" id='#FormSubmit'>
                </div>
            </div>
		</form>

	</section>

    <?php  include_once Footer;  ?>

    <script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == "Name Found" )
        echo "$('#Name').css('border-color','red');";

    else if ( $GLOBALS['Result'] == "Email Found" )
        echo "$('#Email').css('border-color','red');";
?>
    </script>

    <script type="text/javascript">
        var CheckPage = '<?php echo CheckPage; ?>';

        var Name_Len = <?php echo Name_Len; ?>;
        var Email_Len = <?php echo Email_Len; ?>;
        var Phone_Len = <?php echo Phone_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;
    </script>
</body>
</html>

<?php exit(); ?>