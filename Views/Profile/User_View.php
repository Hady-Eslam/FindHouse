<?php set_error_handler("Error_Handeler");

function User_Begin($id){
	$GLOBALS['ID'] = $id;
	User_Check_User();
	include_once User_Template;
}

function User_Check_User(){

	if ( ($Result = (new MYSQLClass('Profile'))->FetchOneRow(
			'SELECT * FROM users WHERE id = ? AND deleted = ? AND activate = ?',
			array( $GLOBALS['ID'], '0', '1' )))->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		StatusPages_Not_Found_Page();
	else
		User_Get_User_Posts($Result->Data);
}

function User_Get_User_Posts($User_Data){
	$Hashing = new HashingClass();
	$MySql = new MYSQLClass('Profile');
	$Hashing->Get_Data_From_Hashing([
		['Type' => 'User', 'Data' => $User_Data['picture'], 'Key' => 'Picture',
			'Default' => OnlineUser ],
		['Type' => 'User', 'Data' => $User_Data['name'], 'Key' => 'Name' ],
		['Type' => 'User', 'Data' => $User_Data['email'], 'Key' => 'Email' ]
	], 'StatusPages_Error_Page');

	$Result = $MySql->FetchAllRows(
			'SELECT id FROM posts WHERE user_email = ? AND deleted = ?',
			array( $Hashing->Hash_POSTS($GLOBALS['Email']), '0' ));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Query_Results'] = [];
	else{
		$GLOBALS['Query_Results'] = $Result->Data;
		$GLOBALS['Posts_Number'] = $MySql->GetAffectedRowsNumber();
	}
}

function User_GetPosts($id, $Count){
	?>
	<div id="<?php echo $id; ?>">
	    <p>Post <?php echo $Count; ?></p>

	    <a href="<?php echo Post.$id; ?>">Click Here To See The Post</a>
	</div>
	<?php
	return ($Count + 1);
}
?>