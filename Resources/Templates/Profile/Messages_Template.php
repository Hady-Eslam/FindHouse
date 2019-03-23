<!DOCTYPE>
<html>
<head>
	<title>Messages</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Messages.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>MessagesScript.js"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

        <?php   include_once MessageBox; ?>

        <div class="Title">
        	Messages
        </div>

        <div style="text-align: left;">

	       <div style="text-align: left;display: inline-block;position: fixed;">
		       <input type="button" value="inbox" style="display: block;width: 150%;
		       		margin: 10px;" onclick="location.href='<?php echo Messages_Inbox; ?>'">

		       <input type="button" value="Sent" style="display: block;width: 150%;
		       		margin: 10px;" onclick="location.href='<?php echo Messages_Sent; ?>'">
	       </div>

	       <div style="text-align: left;display: inline-block; padding-left: 20%;width: 80%">

	       		<?php 
	       			$Found = false;
	       			foreach ($GLOBALS['Messages'] as $Value) {
	       				$Found = true;
		       			Messages_Print_Messages($Value);
	       			}
	       			if ( !$Found )
	       				echo '<p>No Message Found</p>';
	       		?>

	       </div>
        </div>
       

    </section>

    <?php  include_once Footer;  ?>

    <script type="text/javascript">
    	var DeleteMessagePage = '<?php echo DeleteMessage; ?>'
    </script>

</body>
</html>

<?php exit(); ?>