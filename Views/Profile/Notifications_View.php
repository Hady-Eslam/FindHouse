<?php set_error_handler("Error_Handeler");

function Notifications_Begin(){
	Notifications_Get_Notifications();
	include_once Notifications_Template;
}

function Notifications_Get_Notifications(){
	$MySql = new MYSQLClass('Profile');
	$Hashing = new HashingClass();

	$Result = $MySql->FetchAllRows(
		'SELECT * FROM notifications WHERE user_email = ? ORDER BY id DESC',
		array( $Hashing->Hash_Notifications($_SESSION['Email']) ));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Notifications_Query_Result'] = [];
	else
		Notifications_Get_Data_From_Hashing($Result->Data);
}

function Notifications_Get_Data_From_Hashing($Data){
	$GLOBALS['Notifications_Query_Result'] = [];
	$Hashing = new HashingClass();

	foreach ($Data as $Row) {
		$Hashing->Get_Data_From_Hashing([
			['Type' => 'Notifications', 'Data' => $Row['message'],
				'Key' => 'Notification_Message', 'Default' => '' ] ]);

		$Result = NULL;
		$Result['Notification_Type'] = $Row['notification_type'];
		$Result['Notification_Message'] = $GLOBALS['Notification_Message'];
		$Result['Notification_Date'] = $Row['notification_date'];

		if ( $GLOBALS['Notification_Message'] != '' )
			$GLOBALS['Notifications_Query_Result'][] = $Result;
	}
}

function Notifications_Set_Notifications($Notification, $Count){
	$Hashing = new HashingClass();
	$Type = $Notification['Notification_Type'];
	$Message = $Notification['Notification_Message'];

	if ( $Type == '1' || $Type == '2' || $Type == '3' ){
		preg_match('/User : (.+) in Post (.\d+)$/', $Message, $Result );
		$QueryResult = (new MYSQLClass('Profile'))->FetchOneRow(
			'SELECT name FROM users WHERE email = ?',
			array($Hashing->Hash_Users($Result[1])) );
		if ( $QueryResult->Result != 1 )
			$User = '';
		else{
			$Hashing->Get_Data_From_Hashing([
				['Type' => 'User', 'Data' => $QueryResult->Data['name'],
					'Key' => 'Notifications_User_Name', 'Default' => '' ] ]);
			$User = $GLOBALS['Notifications_User_Name'];
		}

		if ( $Type == '1' )
			$Message = 'User '.$User.' Made Comment in Your Post <a href="'
				.Post.$Result[2].'">Click Here To See The Post</a>';
		else if ( $Type == '2' )
			$Message = 'User '.$User.' Liked Your Post <a href="'
				.Post.$Result[2].'">Click Here To See The Post</a>';
		else if ( $Type == '3' )
			$Message = 'User '.$User.' DisLiked Your Post <a href="'
				.Post.$Result[2].'">Click Here To See The Post</a>';
	}
	?>
	<div>
        <p>Date : <?php echo $Notification['Notification_Date']; ?></p>

        <div>
            <p><?php echo $Message; ?></p>
        </div>
    </div>
	<?php
	return ($Count + 1);
}
?>