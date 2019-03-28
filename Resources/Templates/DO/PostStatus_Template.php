<!DOCTYPE>
<html>
<head>
	<title><?php echo $GLOBALS['Add_Name']?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section style="min-height: 51.9%;">

		<style type="text/css">
			section p{
				padding-top: 80px;
			}
		</style>

<?php
	if ( $GLOBALS['Result'] == 'Post Not Found' ){
		?>
		<p>This Advertise Not Found</p>
		<?php
	}

	else if ( $GLOBALS['Result'] == 'Post Deleted' ){
		?>
		<p>This Advertise had Been Deleted</p>
		<?php
	}

	else if ( $GLOBALS['Result'] == 'Post Pedding' ){
		?>
		<p style="color: #c6c608;">This Advertise is Still Under Pedding</p>
		<?php
	}

	else if ( $GLOBALS['Result'] == 'Post Approved' ){
		?>
		<p style="color: green;">This Advertise Has Been Approved</p>
		<a href="<?php echo Post.$GLOBALS['Post_id']; ?>">Link Of Post</a>
		<?php
	}

	else if ( $GLOBALS['Result'] == 'Post Rejected' ){
		?>
		<p style="color: red;">This Advertise Has Been Rejected</p>
		<?php
	}
?>
	
	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>