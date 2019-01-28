<header >
		
<?php
		include_once NavBar;
?>

	<div class="Profile_Picture">
		<input onclick="ShowProfileMenu();" type="image"
			src="<?php echo $_SESSION['Picture']; ?>">
<?php
			include_once UserHeader;
?>
	</div>
	
</header>