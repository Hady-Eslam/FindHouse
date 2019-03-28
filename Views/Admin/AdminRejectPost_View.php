<?php

function AdminRejectPost_Begin($Post_ID){
	$MySql = new MYSQLClass('Admin');
	$Hashing = new HashingClass();
	$GLOBALS['Page Name'] = 'Reject Post '.$Post_ID;

	$Result = $MySql->FetchOneRow('SELECT * FROM posts WHERE id = ? AND deleted = ?',
		array(
			$Post_ID,
			'0'
		));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = 'Post Not Found';
	else{
		$Email = $Hashing->Get_Hashed_POSTS($Result->Data['user_email']);
		$Result = $MySql->excute('UPDATE posts SET status = ? WHERE id = ?',
			array(
				'-1',
				$Post_ID
			));
		if ( $Result->Result == -1 )
			StatusPages_Error_Page();
		else{
			$GLOBALS['Result'] = 'Posts Rejected';
			if ( $Email->Result == 1 ){

				$MySql->excute('INSERT INTO notifications(from_user, to_user, notification_type, message, notification_date) VALUES(?, ?, ?, ?, ?)',
				array(
					$Hashing->Hash_Notifications($_SESSION['Email']),
					$Hashing->Hash_Notifications($Email->Data),
					'6',
					$Hashing->Hash_Notifications("Your Post $Post_ID Has Been Rejected"),
					date('D d-m-Y H:i:s')
				));
			}
		}
	}

	include_once AdminOperations_Template;
}