<a href="<?php echo MainPage;?>" 
	style="display: inline;margin-left: 130px; margin-right: 80px;">
	<input type="image" src="<?php echo LOGO; ?>"width="40" height="40">
</a>

<a href="<?php echo MainPage;?>"
	style="display: inline-block;margin-right: 30px;color: #223617;">Find</a>

<a href="<?php echo Advertise;?>" 
	style="display: inline-block;margin-right: 30px;color: #223617;">Advertise</a>

<a href="http://localhost/findhouse.com/Predict/Predict.php" 
	style="display: inline-block;margin-right: 30px;color: #223617;">Predict</a>

<a href="<?php echo interested; ?>" 
	style="display: inline-block;margin-right: 290px;
		color: #223617;">interested in</a>
<?php
if ( isset($_SESSION['Name']) ){
?>
	<div style="display: inline-block; margin-right: 40px ; padding: 0 0 0 0;
					margin-left: 0; margin-top: 0; margin-bottom: 0">
		<input type="image" 
			src="<?php echo NoNotification; ?>" width="30" height="30">
	</div>
<?php
}
?>