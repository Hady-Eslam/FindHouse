<div class='Profile'>

	<div class='Profile_Item'>
		<p style="color: #FFFFFF;"><?php echo $_SESSION['Name']; ?></p>
		<p style="color: #FFFFFF;">My Posts : <?php echo $_SESSION['Posts']; ?></p>
	</div>

	<div class='Profile_Item' onmouseenter="In(this);" onmouseleave="Out(this);">
		<a href="<?php echo Profile; ?>">My Profile</a>
	</div>

	<div class='Profile_Item' onmouseenter="In(this);" onmouseleave="Out(this);">
		<a href="">Analysis</a>
	</div>
	
	<div class='Profile_Item' onmouseenter="In(this);" onmouseleave="Out(this);">
		<a href="<?php echo Sittings; ?>">Sittings</a>
	</div>
	
	<div class='Profile_Item' onmouseenter="In(this);" onmouseleave="Out(this);">
		<a href="<?php echo LogOutUser; ?>">Log Out</a>
	</div>

</div>