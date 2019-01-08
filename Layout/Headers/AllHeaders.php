<header >
		
<?php
		include_once NavBar;
?>
	<div style="display: inline-block;margin: 5 5 5 5;padding: 5 5 5 5;">
		<input onmouseenter="Show();" type="image" 
		src="<?php
				if ( isset($_SESSION['Name']) )
					echo $_SESSION['Picture'];
				else
					echo OfflineUsers;
			?>"width="30" height="30">
		
<?php
			if (isset($_SESSION['Name'])){
				if ( $_SESSION['Status'] == '1' ){
					include_once UserHeader;
				}
				else{
					include_once Waiting_UserHeader;
				}
			}
			else{
				include_once UserNotLoggedHeader;
			}
?>
	</div>
	
</header>