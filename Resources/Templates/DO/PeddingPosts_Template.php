<!DOCTYPE>
<html>
<head>
	<title>Pedding Posts</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

		<div class="Title">
			Pedding Posts
		</div>

		<div style="text-align: left;">
			
			<div style="border-bottom-width: 1px;border-bottom-color: #454545;
					border-bottom-style: solid;">
				<div>
					<div style="display: inline-block;margin: 0px;padding: 0px;">
						<a href="">
							<input type="image" src="<?php echo OnlineUser; ?>"
							style="width: 80px;height: 80px;">
						</a>
					</div>

					<div style="display: inline-block;margin: 0px;padding: 0px;">
						<p><strong>By : </strong>Hady Eslam</p>
						<p><strong>Date : </strong>5/5/2019</p>
					</div>
				</div>
				<p style="padding: 0px;margin: 0px;"><strong>Title : </strong> Hello World</p>
				<div style="font-size: 15px;">
					<p>Hello From The Advertise</p>
				</div>
				<div style="padding: 0px;">
					<a href="">See Full Advertise</a>
				</div>
			</div>

			<?php 
				$Count = false;
				foreach ($GLOBALS['Result'] as $Value){
					$Count = true;
					PeddingPosts_Get_Pedding_Post($Value);
				}

				if ( $Count == false )
					echo '<p>No Pedding Posts Found</p>';
			?>
			
		</div>
	
	</section>

	<?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>