<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>User</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>User.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>


    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>
		
		<div class='Title'>
            User Profile
        </div>

        <?php   include_once MessageBox; ?>

        <div class="info">

            <input type="image" src="<?php echo $GLOBALS['Picture']; ?>">
            <p><span>ID</span> : <?php echo $GLOBALS['ID'];?></p>
            <p><span>Name</span> : <?php echo $GLOBALS['Name'];?></p>
            <p><span>Number Of Posts</span> = <?php echo $GLOBALS['Posts_Number'];?></p>

        </div>

        <div class="Posts">
            <?php
                $Count = 1;
                foreach ($GLOBALS['Query_Results'] as $Value) {
                    $Count = User_GetPosts($Value['id'], $Count);
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

</body>
</html>

<?php exit(); ?>