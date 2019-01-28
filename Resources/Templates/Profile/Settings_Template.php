<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE >
<html>
<head>
	<title>Sittings</title>
	
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Settings.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>
    
    <script src="<?php echo TriggerFormScript; ?>"></script>

<?php
if ( $GLOBALS['Section'] == 'Picture' ){
?>
    <script src="<?php echo AddPictureScript; ?>"></script>
    <script src="<?php echo PagesScripts; ?>Settings_PictureScript.js"></script>
<?php
}
else if ( $GLOBALS['Section'] == 'Name' ){
?>
    <script src="<?php echo CheckLenScript; ?>"></script>

    <script src="<?php echo CheckNameScript; ?>"></script>
    <script src="<?php echo PagesScripts; ?>Settings_NameScript.js"></script>
<?php
}
else if ( $GLOBALS['Section'] == 'Phone' ){
?>
    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>Settings_PhoneScript.js"></script>
<?php
}
else if ( $GLOBALS['Section'] == 'Password' ){
?>
    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo CheckPasswordScript; ?>"></script>
    <script src="<?php echo PagesScripts; ?>Settings_PasswordScript.js"></script>
<?php
}
else if ( $GLOBALS['Section'] == 'DeActivate' ){
?>
    <script src="<?php echo PagesScripts; ?>Settings_DeActivateScript.js"></script>
<?php
}
?>

</head>
<body>

    <?php include_once LoggedHeaders; ?>
    <?php include_once MessageBox; ?>

    <section>


        <div class="DivLeft" >
            
            <a href="<?php echo Settings.'/Picture'; ?>">Change Profile Picture</a>
            <a href="<?php echo Settings.'/Name'; ?>">Change Name</a>
            <a href="<?php echo Settings.'/Password'; ?>">Change Password</a>
            <a href="<?php echo Settings.'/Phone'; ?>">Change Phone</a>
            <a href="<?php echo Settings.'/DeActivate'; ?>">De Activate Account</a>

        </div>

        <div class="Div1">
<?php
        
    if ( $GLOBALS['Section'] == 'Picture' )
        include_once Profile_Templates.'Settings_Picture_Template.php';
    else if ( $GLOBALS['Section'] == 'Name' )
        include_once Profile_Templates.'Settings_Name_Template.php';
    else if ( $GLOBALS['Section'] == 'Phone' )
        include_once Profile_Templates.'Settings_Phone_Template.php';
    else if ( $GLOBALS['Section'] == 'Password' )
        include_once Profile_Templates.'Settings_Password_Template.php';
    else if ( $GLOBALS['Section'] == 'DeActivate' )
        include_once Profile_Templates.'Settings_DeActivate_Template.php';
?>
        </div>

    </section>

    <?php  include_once Footer;  ?>

    <script type="text/javascript">
        var Name_Len = <?php echo Name_Len; ?>;
        var Phone_Len = <?php echo Phone_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;

        var CheckPage = '<?php echo CheckPage; ?>';
        var MyPage = '<?php echo Settings; ?>';
    </script>

    <script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == 'NameDone' ){
    ?>
        TriggerMessage(3000, '#53A01A', '<p>Name Changed</p>');
    <?php
    }
    else if ( $GLOBALS['Result'] == 'ReservedName' ){
    ?>
        $('#Name').css('border-color', 'red');
    <?php
    }
    else if ( $GLOBALS['Result'] == 'PhoneDone' ){
    ?>
        TriggerMessage(3000, '#53A01A', '<p>Phone Changed</p>');
    <?php
    }
    else if ( $GLOBALS['Result'] == 'PictureDone' ){
    ?>
        TriggerMessage(3000, '#53A01A', '<p>Picture Changed</p>');
    <?php
    }
    else if ( $GLOBALS['Result'] == 'PasswordDone' ){
    ?>
        TriggerMessage(3000, '#53A01A', '<p>Password Changed</p>');
    <?php
    }
    else if ( $GLOBALS['Result'] == 'WrongPassword' ){
    ?>
        $('#OldPassword').css('border-color', 'red');
    <?php
    }
?>
    </script>

</body>
</html>

<?php exit(); ?>