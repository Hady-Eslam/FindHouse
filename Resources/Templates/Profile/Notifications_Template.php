<!DOCTYPE>
<html>
<head>
	<title>My Notifications</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet"type="text/css"href="<?php echo PagesCSS;?>Notifications.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Notifications
		</div>

        <div class="Notifications">
            <?php 
                $Count = false;
                foreach ($GLOBALS['Result'] as $Value) {
                    $Count = true;
                    Notifications_Get_Notification($Value);
                }

                if ( !$Count ){
                    ?>
                        <div style="text-align: center;">
                            <p>You Have No Notifications</p>
                        </div>
                    <?php
                }
            ?>
        </div>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>