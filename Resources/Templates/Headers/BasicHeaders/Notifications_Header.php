<div id="Notifications">
<?php
$MySql = new MYSQLClass('Profile');
$Hashing = new HashingClass();

// Getting User Notifications
$Result = $MySql->FetchAllRows(
	'SELECT message, notification_type FROM notifications WHERE user_email = ? '
	.'ORDER BY id DESC LIMIT 3',
		array( $Hashing->Hash_Notifications($_SESSION['Email']) ));

if ( $Result->Result != 1 ){
	?>
	<div>
		<p>No Notifications</p>
	</div>
	<?php
}
else{
	foreach ($Result->Data as $Value) {
		$Hashing->Get_Data_From_Hashing([
			['Type' => 'Notifications', 'Data' => $Value['message'],
				'Key' => 'Notification_Message', 'Default' => '' ]]);

		$Type = $Value['notification_type'];
		if ( $GLOBALS['Notification_Message'] != '' ){
			if ( $Type == '1' || $Type == '2' || $Type == '3'){

				preg_match('/User : (.+) in Post (.\d+)$/',
					$GLOBALS['Notification_Message'], $Post_id );

				if ( $Type == '1' )
					$GLOBALS['Notification_Message'] = 'SomeOne Comment in Your Post'
					.' with id ('.$Post_id[2].')';
				else if ( $Type == '2' )
					$GLOBALS['Notification_Message'] = 'Your Post with id ('.$Post_id[2]
					.') Was Liked';
				else if ( $Type == '3' )
					$GLOBALS['Notification_Message'] = 'Your Post with id ('.$Post_id[2]
					.') Was DisLiked';
			}
			else
				$GLOBALS['Notification_Message'] = 'There is A Post You May Be '
					.'interested in';
			?>
			<div>
				<p><?php echo $GLOBALS['Notification_Message']; ?></p>
			</div>
			<?php
		}
		unset($GLOBALS['Notification_Message']);
	}
}
?>
	<div class="SeeAll">
		<a href="<?php echo Notifications; ?>">See All Notifications</a>
	</div>
</div>