<div class='Profile'>

	<div class='Profile_Item'>
		<p style="color: #FFFFFF;"><?php echo $_SESSION['Name'];?></p>
	</div>
	
	<div class='Profile_Item' onmouseenter="In(this);" onmouseleave="Out(this);">
		<a href="<?php echo LogOutUser; ?>">Log Out</a>
	</div>

</div>