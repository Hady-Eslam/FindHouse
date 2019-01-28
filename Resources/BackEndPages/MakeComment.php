<?php set_error_handler("Error_Handeler");
$MySql = new MYSQLClass('BackEnd');
$FILTER = new FILTERSClass();
$Hashing = new HashingClass();

$Result = $FILTER->FilterString($_POST['ID'], ID_Len);
if ( $Result->Result != 'OK' )
	return $Result;
$GLOBALS['ID'] = $Result->Data;

$Result = $FILTER->FilterString($_POST['Comment'], Comment_Len);
if ( $Result->Result != 'OK' )
	return $Result;
$GLOBALS['Comment'] = $Result->Data;

// Check Post
if ( ($Result = $MySql->FetchOneRow('SELECT * FROM posts WHERE id = ? AND deleted = ?',
		array( $GLOBALS['ID'], '0' )))->Result == -1 )
	return Returns(-1, 'Searching For Post', $Result->Error);
else if ( $Result->Result == 0 )
	return Returns(0, 'Not Found');
else{
	$Result = $Hashing->Get_Hashed_POSTS($Result->Data['user_email']);
	if ( $Result->Result == -1 )
		return $Result;
	$GLOBALS['Post_User_Email'] = $Result->Data;
}

if ( ($Result = $MySql->excute('INSERT INTO comments (post_id, user_email, comment,'
		.' comment_date) VALUES(?, ?, ?, ?)',
		array(
			$GLOBALS['ID'],
			$Hashing->Hash_Comments($_SESSION['Email']),
			$Hashing->Hash_Comments($GLOBALS['Comment']),
			date('D d-m-Y H:i:s')
		)))->Result == -1 )
	return Returns(-1, 'Deleting Post', $Result->Error);

if ( $_SESSION['Email'] == $GLOBALS['Post_User_Email'] )
	return Returns(1, 'Done');

$MySql->excute('INSERT INTO notifications(user_email, notification_type, message, '
			.'notification_date) VALUES(?, ?, ?, ?)',
		array(
			$Hashing->Hash_Notifications($GLOBALS['Post_User_Email']),
			'1',
			$Hashing->Hash_Notifications('User : '.$_SESSION['Email']
				.' in Post '.$GLOBALS['ID']),
			date('D d-m-Y H:i:s')
		));

return Returns(1, 'Done');
?>