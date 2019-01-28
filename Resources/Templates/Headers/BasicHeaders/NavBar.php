<div class="NavBar">
	<a href="<?php echo Find; ?>">
		<input type="image" src="<?php echo LOGO; ?>"width="40" height="40">
	</a>

	<a href="<?php echo Find; ?>">Find</a>

	<a href="<?php echo Advertise; ?>">Advertise</a>

	<a href="<?php echo Predict; ?>">Predict</a>

	<a href="<?php echo interested; ?>">interested in</a>
	
</div>

<div class="Profile_NavBar">

	<script type="text/javascript">
		function ShowProfileMenu(){
			if ( $('.Profile').css('display') == 'none' )
				$('.Profile').slideDown(400);
			else
				$('.Profile').slideUp(400);
		}
		function ShowNotificationsMenu(){
			if ( $('#Notifications').css('display') == 'none' )
				$('#Notifications').slideDown(400);
			else
				$('#Notifications').slideUp(400);
		}
	</script>

	<div>
		<?php
			if ( SESSION() ){
		?>
		<div>
			<input type="image" src="<?php echo NoNotification; ?>" width="30"
					height="30" onclick="ShowNotificationsMenu();">
			<?php include_once Notifications_Header; ?>
		</div>
		<?php
			}
		?>
	</div>

</div>