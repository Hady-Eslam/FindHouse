<?php
$MySql = new MYSQLClass('BackEnd');

$Result = (new FILTERSClass())->FilterString($_POST['MessageID'], ID_Len);
if ( $Result->Result != 'OK' )
	return $Result;
$GLOBALS['MessageID'] = $Result->Data;

$GLOBALS['Email'] = 'user_email';
if ( $Page == 'Sent' )
	$GLOBALS['Email'] = 'message_email';

if ( ($Result = $MySql->isFound(
		'SELECT * FROM messages WHERE id = ? AND '.$GLOBALS['Email'].' = ?',
		array(
			$GLOBALS['MessageID'],
			(new HashingClass())->Hash_Messages($_SESSION['Email']),
		)))->Result == -1 )
	return Returns(-1, 'Searching For Message', $Result->Error);
else if ( $Result->Result == 0 )
	return Returns(0, 'Not Found');


if ( ($Result = $MySql->excute('UPDATE messages SET deleted = ? WHERE id = ?',
			array('1', $GLOBALS['MessageID']) ))->Result == -1 )
	return Returns(-1, 'Deleting Message', $Result->Error);

return Returns(1, 'Done');
?>