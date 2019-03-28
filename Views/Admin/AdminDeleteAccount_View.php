<?php

function AdminDeleteAccount_Begin($User_ID){
	$MySql = new MYSQLClass('Admin');
	$Hashing = new HashingClass();
	$GLOBALS['Page Name'] = 'Deleting Account '.$User_ID;

	$Result = $MySql->FetchOneRow('SELECT * FROM users WHERE id = ? AND deleted = ?',
		array(
			$User_ID,
			'0'
		));
	
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();

	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = 'User Not Found';
	
	else{
		//var_dump($Result->Data['email']);
		$Email = $Hashing->Get_Hashed_Users($Result->Data['email']);
		if ( $Email->Result != 1 )
			StatusPages_Error_Page();
		//var_dump($Email);
		$Result = $MySql->excute('UPDATE posts SET deleted = ? WHERE user_email = ?',
				array(
					'1',
					$Hashing->Hash_POSTS($Email->Data)
				));
		
		if ( $Result->Result == -1 )
			StatusPages_Error_Page();

		$Result = $MySql->excute('UPDATE users SET deleted = ? WHERE email = ?',
				array(
					'1',
					$Hashing->Hash_Users($Email->Data)
				));
		
		if ( $Result->Result == -1 )
			StatusPages_Error_Page();

		$GLOBALS['Result'] = 'Account Deleted';
	}

	include_once AdminOperations_Template;
}