<div class='Profile'>

	<div class="Profile_Name">
		<p><?php echo $_SESSION['Name']; ?></p>
		<p>My Posts : <span id="Posts_Number"><?php echo $_SESSION['Posts']; ?></span></p>
	</div>

	<div class='Profile_Item'><a href="<?php echo Messages_Inbox; ?>">My Messages</a></div>

	<div class='Profile_Item'><a href="<?php echo MyProfile; ?>">My Profile</a></div>

	<?php
		if ( $_SESSION['Status'] == '0' ){
		?>
	<div class='Profile_Item'><a href="<?php echo PeddingPosts; ?>">Pedding Posts</a></div>
		<?php
		}
	?>
	
	<div class='Profile_Item'><a href="<?php echo Settings; ?>">Settings</a></div>
	
	<div class='Profile_Item'><a href="<?php echo LogOut; ?>">Log Out</a></div>

</div>