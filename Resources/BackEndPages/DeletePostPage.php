<?php set_error_handler("Error_Handeler");
$MySql = new MYSQLClass('BackEnd');

$Result = (new FILTERSClass())->FilterString($_POST['ID'], ID_Len);
if ( $Result->Result != 'OK' )
	return $Result;
$GLOBALS['ID'] = $Result->Data;

if ( ($Result = $MySql->isFound(
		'SELECT * FROM posts WHERE id = ? AND user_email = ? AND deleted = ?',
		array(
			$GLOBALS['ID'],
			(new HashingClass())->Hash_POSTS($_SESSION['Email']),
			'0'
		)))->Result == -1 )
	return Returns(-1, 'Searching For Post', $Result->Error);
else if ( $Result->Result == 0 )
	return Returns(0, 'Not Found');

if ( ($Result = $MySql->excute('UPDATE posts SET deleted = ? WHERE id = ?',
			array('1', $GLOBALS['ID']) ))->Result == -1 )
	return Returns(-1, 'Deleting Post', $Result->Error);

if ( $_SESSION['Posts'] != 0 )
	$_SESSION['Posts'] -= 1;
return Returns(1, 'Done');
?>