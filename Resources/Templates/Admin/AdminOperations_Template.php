<!DOCTYPE>
<html>
<head>
	<title><?php echo $GLOBALS['Page Name']; ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>
</head>
<body>

    <?php include_once AllHeaders; ?>

	<section style="min-height: 51.9%">
        <?php
            if ( $GLOBALS['Result'] == 'Post Not Found' )
                echo '<p style="color:red;margin-top:100px;">This Post Not Found Or Deleted</p>';

            else if ( $GLOBALS['Result'] == 'User Not Found' )
                echo '<p style="color:red;margin-top:100px;">This User Not Found Or Deleted</p>';

            else if ( $GLOBALS['Result'] == 'Posts Deleted' )
                echo '<p style="color:green;margin-top:100px;">Post Deleted</p>';
            
            else if ( $GLOBALS['Result'] == 'Posts Accepted' )
                echo '<p style="color:green;margin-top:100px;">Post Has Been Approved</p>';

            else if ( $GLOBALS['Result'] == 'Posts Rejected' )
                echo '<p style="color:green;margin-top:100px;">Post Has Been Rejected</p>';

            else if ( $GLOBALS['Result'] == 'Account Deleted' )
                echo '<p style="color:green;margin-top:100px;">Account Has Been Deleted</p>';
        ?>
	</section>

	<?php include_once Footer; ?>

</body>
</html>

<?php exit(); ?>