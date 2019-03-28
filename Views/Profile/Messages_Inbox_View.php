<?php

function Messages_Inbox_Begin(){
	Search_Inbox_Messages();
	include_once Messages_Template;
}

function Search_Inbox_Messages(){
	$MySql = new MYSQLClass('Profile');
	$Hashing = new HashingClass();
	$Result = $MySql->FetchAllRows(
			'SELECT * FROM messages WHERE user_email = ? AND deleted = ? ORDER BY id DESC',
			array(
				$Hashing->Hash_Messages($_SESSION['Email']),
				'0'
			));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Messages'] = [];
	else
		$GLOBALS['Messages'] = $Result->Data;
}

function Messages_Print_Messages($Message){
	Messages_Get_Data_From_Hashing($Message);
	$Result = Messages_Get_Add_Name_From_Hashing($Message['post_id']);
	if ( $Result->Result == 0 )
		return ;

	?>
		<div style="border-bottom-width: 1px;border-bottom-color: #454545;border-bottom-style: solid;" id="<?php echo $GLOBALS['MESSAGE_ID']; ?>">
	       			
   			<input type="image" onclick="DeleteMessage(<?php echo $GLOBALS['MESSAGE_ID']; ?>);" 
   				style="width: 50px;width: 35px;height: 35px;" src="<?php echo DeleteImage; ?>">
   			
   			<p style="vertical-align: top; padding-left: 2%;padding-right: 2%;text-overflow: ellipsis;overflow: hidden;font-size: 17px;white-space: nowrap;width: 20%"><?php echo $GLOBALS['Message_Email']; ?>: </p>

   			<p style="vertical-align: top; padding-left: 2%;padding-right: 2%;text-overflow: ellipsis;overflow: hidden;font-size: 17px;white-space: nowrap;width: 20%"><?php echo $GLOBALS['Add_Name']; ?>: </p>

   			<p style="display: inline-block;text-overflow: ellipsis;overflow: hidden;
					white-space: nowrap;width: 60%;vertical-align: top;font-size: 17px;">
						<?php echo $GLOBALS['Message_Body']; ?>
					</p>

			<p style="font-size: 15px;"><?php echo $GLOBALS['Message_Date']; ?></p>

			<a href="<?php echo Message.$GLOBALS['MESSAGE_ID']; ?>">Full Message</a>
   		</div>
	<?php
}

function Messages_Get_Data_From_Hashing($Message){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Message['id'], 'Key' => 'MESSAGE_ID' ],
		['Type' => 'Messages', 'Data' => $Message['message_email'], 'Key' => 'Message_Email'],
		['Type' => 'Messages', 'Data' => $Message['message_body'], 'Key' => 'Message_Body'],
		['Type' => '', 'Data' => $Message['message_date'], 'Key' => 'Message_Date']
	], 'StatusPages_Error_Page');
}

function Messages_Get_Add_Name_From_Hashing($Post_id){

	$Result = (new MYSQLClass('Profile'))->FetchOneRow(
			'SELECT addname FROM posts WHERE id = ?', array( $Post_id ));

	if ($Result->Result == -1 )
		StatusPages_Error_Page();

	else if ( $Result->Result == 0 )
		return Returns(0);

	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => 'POSTS', 'Data' => $Result->Data['addname'], 'Key' => 'Add_Name']
	], 'StatusPages_Error_Page');

	return Returns(1);
}