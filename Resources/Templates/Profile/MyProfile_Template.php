<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>My Profile</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>MyProfile.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>


    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>MyProfileScript.js"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>
		
		<div class='Title'>
            My Profile
        </div>

        <?php   include_once MessageBox; ?>

        <div class="info">

            <input type="image" src="<?php echo $_SESSION['Picture']; ?>">
            <p><span>ID</span> : <?php echo $_SESSION['ID'];?></p>
            <p><span>Name</span> : <?php echo $_SESSION['Name'];?></p>
            <p><span>Email</span> : <?php echo $_SESSION['Email'];?></p>
            <p><span>Phone</span> : <?php echo $_SESSION['Phone'];?></p>
            <p><span>Sign UP Date</span> : <?php echo $_SESSION['Sign_UP_Date'];?></p>
            <p><span>Number Of Posts</span> =
                <span class="Number"><?php echo $_SESSION['Posts'];?></span></p>

        </div>

        <div class="Posts">
            <?php
                $Count = 1;
                foreach ($GLOBALS['Query_Results'] as $Value) {
                    $Count = MyProfile_GetPosts($Value['id'], $Count);
                }
                if ( $Count == 1 ){
                ?>
                    <p>No Posts Found</p>
                <?php
                }
            ?>
        </div>
    </section>


    <?php  include_once Footer;  ?>

    <script type="text/javascript">
        var DeletePostPage = '<?php echo DeletePostPage; ?>';
    </script>

</body>
</html>

<?php exit(); ?>