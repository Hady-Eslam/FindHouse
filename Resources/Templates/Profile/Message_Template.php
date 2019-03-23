<!DOCTYPE>
<html>
<head>
	<title><?php echo $GLOBALS['Message_Email']; ?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section style="min-height: 51.9%;">

		<div style="text-align: left;">
			<div style="font-size: 15px;border-bottom-color: #454545;border-bottom-style: solid;
					border-bottom-width: 1px;">
				<p>From : <?php echo $GLOBALS['Message_Email']; ?></p>
				<p>To : <?php echo $GLOBALS['User_Email']; ?></p>
				<p>Date : <?php echo $GLOBALS['Message_Date']; ?></p>
			</div>

			<div style="width: 90%;word-wrap: break-word;">
				<?php echo $GLOBALS['Message_Body']; ?>
			</div>
		</div>

    </section>

    <?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>