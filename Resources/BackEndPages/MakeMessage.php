<?php
$FILTER = new FILTERSClass();
$MySql = new MYSQLClass('BackEnd');
$Hashing = new HashingClass();
$Result = $FILTER->FilterString($_POST['Message'], Message_Len);
if ( $Result->Result != 'OK' )
		return $Result;
$Message = $Result->Data;

$Email = '';
if ( !SESSION() ){
	$Result = $FILTER->FilterEmail($_POST['MessageEmail']);
	if ( $Result->Result != 'OK' )
		return $Result;
	$Email = $Result->Data;
}
else
	$Email = $_SESSION['Email'];

preg_match('/^http:\/\/findhouse\.com\/DO\/Post\/(\d+)/', $URL->Get_REFFERE(), $Result);
$Post_id = $Result[1];

$Result = $MySql->FetchOneRow('SELECT * FROM posts WHERE id = ?',
		array( $Post_id ));
if ( $Result->Result == -1 )
	return $Result;
else if ( $Result->Result == 0 )
	return Returns(0, 'Post Not Found');

$Result = $Hashing->Get_Hashed_POSTS($Result->Data['user_email']);
if ( $Result->Result != 1 )
		return $Result;
$User_Email = $Result->Data;

if ( ($Result = $MySql->excute('INSERT INTO messages (message_email, message_body, user_email, message_date, post_id) VALUES (?, ?, ?, ?, ?)', 
		array(
			$Hashing->Hash_Messages($Email),
			$Hashing->Hash_Messages($Message),
			$Hashing->Hash_Messages($User_Email),
			date('D d-m-Y H:i:s'),
			$Post_id
		)))->Result != 1 )
	return $Result;

return Returns(1, 'Done');
?>