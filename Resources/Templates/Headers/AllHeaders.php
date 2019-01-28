<header >
		
<?php
		include_once NavBar;
?>
	<div class="Profile_Picture">
		<input onclick="ShowProfileMenu();" type="image" 
		src="<?php
				if ( SESSION() )
					echo $_SESSION['Picture'];
				else
					echo OfflineUsers;
			?>">
		
<?php
	if ( SESSION() )
		include_once UserHeader;
	else
		include_once UserNotLoggedHeader;
?>
	</div>
	
</header>