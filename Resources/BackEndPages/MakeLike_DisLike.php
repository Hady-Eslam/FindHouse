<?php set_error_handler("Error_Handeler");
$MySql = new MYSQLClass('BackEnd');
$FILTER = new FILTERSClass();
$Hashing = new HashingClass();

// Filter Data
$Result = $FILTER->FilterString($_POST['ID'], ID_Len);
if ( $Result->Result != 'OK' )
	return $Result;
$GLOBALS['ID'] = $Result->Data;

$Result = $FILTER->FilterString($_POST['Type'], 1);
if ( $Result->Result != 'OK')
	return $Result;
if ( $Result->Data != '1' && $Result->Data != '2' )
	return Returns(0, 'Do Not Know What To Do');
$GLOBALS['Type'] = $Result->Data;

// Check Post is Found
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

// Check if Already Liked Or Not
if ( ($Result = $MySql->FetchOneRow(
		'SELECT status FROM like_dislike_post WHERE user_email = ? AND post_id = ?',
		array(
			$Hashing->Hash_Like_DisLike($_SESSION['Email']),
			$GLOBALS['ID'] )))->Result == -1 )
	return Returns(-1, ($GLOBALS['Type']=='1')?'Like A Post':'DisLike A Post',
							$Result->Error);
else if ( $Result->Result == 1 )
	return Returns(0,
		($Result->Data['status']=='1')?'Already Liked':'Already DisLike');

// Make Liked Or DisLiked
if ( ($Result = $MySql->excute('INSERT INTO like_dislike_post(post_id, status,'
		.' user_email, status_date) VALUES(?, ?, ?, ?)',array(
			$GLOBALS['ID'], $GLOBALS['Type'],
			$Hashing->Hash_Like_DisLike($_SESSION['Email']),
			date('D d-m-Y H:i:s')
		)))->Result == -1 )
	return Returns(-1, 'insert Like To Post', $Result->Error);

if ( $_SESSION['Email'] == $GLOBALS['Post_User_Email'] )
	return Returns(1, 'Done');

$MySql->excute('INSERT INTO notifications(user_email, notification_type, message, '
			.'notification_date) VALUES(?, ?, ?, ?)',
		array(
			$Hashing->Hash_Notifications($GLOBALS['Post_User_Email']),
			($GLOBALS['Type']=='1')?'2':'3',
			$Hashing->Hash_Notifications('User : '.$_SESSION['Email']
				.' in Post '.$GLOBALS['ID']),
			date('D d-m-Y H:i:s')
		));

return Returns(1, 'Done');
?>