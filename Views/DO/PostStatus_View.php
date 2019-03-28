<?php

function PostStatus_Begin($Post_id){
	$Hashing = new HashingClass();
	$GLOBALS['Post_id'] = $Post_id;

	$Result = (new MYSQLClass('DO'))->FetchOneRow(
		'SELECT * FROM posts WHERE id = ? AND user_email = ?',
			array(
				$Post_id,
				$Hashing->Hash_POSTS($_SESSION['Email'])
			));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 ){
		$GLOBALS['Result'] = 'Post Not Found';
		$GLOBALS['Add_Name'] = 'Post Not Found';
	}
	else{
		
		if ( $Result->Data['deleted'] == '1' )
			$GLOBALS['Result'] = 'Post Deleted';
		
		else if ( $Result->Data['status'] == '0' )
			$GLOBALS['Result'] = 'Post Pedding';
		
		else if ( $Result->Data['status'] == '1' )
			$GLOBALS['Result'] = 'Post Approved';
		
		else
			$GLOBALS['Result'] = 'Post Rejected';
		
		$Hashing->Get_Data_From_Hashing([
			['Type' => 'POSTS', 'Data' => $Result->Data['addname'], 'Key' => 'Add_Name' ]
		], 'StatusPages_Error_Page');

	}
	include_once PostStatus_Template;
}