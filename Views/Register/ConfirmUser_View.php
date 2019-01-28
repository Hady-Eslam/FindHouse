<?php set_error_handler("Error_Handeler");
include_once CheckToken;

function ConfirmUser_Begin(){
	if ((new URLClass())->Request() == 'GET' && isset($_GET['E']) && isset($_GET['T'])){
		
		CheckData();
		if (($Result = Check_SignUP_Token($GLOBALS['E'], $GLOBALS['T']))->Result == -1 )
			StatusPages_Error_Page($Result->Data);
		else if ( $Result->Data == 'Found' )
			SaveData();
	}
	StatusPages_Not_Authurithed_User_Page();
}

function OpenTemplate(){
	include_once ConfirmUser_Template;
}

function CheckData(){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => 'SignUP_Token', 'Data' => $_GET['E'], 'Key' => 'E' ],
		['Type' => 'SignUP_Token', 'Data' => $_GET['T'], 'Key' => 'T' ],
	], 'StatusPages_Not_Authurithed_User_Page');
	
	$_GET['E'] = $GLOBALS['E'];
	$_GET['T'] = $GLOBALS['T'];

	(new FILTERSClass())->FILTER_GET([
    	'E' => ['Type' => 'EMAIL'],
    	'T' => ['Type' => 'STRING', 'Len' => Token_Len ]
	], 'StatusPages_Not_Authurithed_User_Page' );
}

function SaveData(){
	$MySql = new MYSQLClass('Register');
    $Hashing = new HashingClass();
	
	// Fetch Data
	$Result = $MySql->FetchOneRow('SELECT * FROM waiting_users WHERE email = ?',
				array( $Hashing->Hash_WaitingUsers($GLOBALS['E']) ));

    if ( $Result->Result == -1 )
    	StatusPages_Error_Page('Getting User Data From Waiting User Table');
    else if ( $Result->Result == 0 )
    	StatusPages_Not_Authurithed_User_Page('Not Found in Waiting User');

    (new HashingClass())->Get_Data_From_Hashing([
		['Type' => 'Waiting_User', 'Data' => $Result->Data['email'], 'Key' => 'E' ],
		['Type' => 'Waiting_User', 'Data' => $Result->Data['name'], 'Key' => 'N' ],
		['Type' => 'Waiting_User', 'Data' => $Result->Data['phone'], 'Key' => 'Ph' ],
		['Type' => 'Waiting_User', 'Data' => $Result->Data['password'], 'Key' => 'P' ],
	], 'StatusPages_Error_Page');

	// insert into Users Table
	if ( ($Result = $MySql->excute('INSERT INTO users(picture, name, email, password, '
			.'phone, sign_in_date) VALUES (?, ?, ?, ?, ?, ?)',
				array(
					$Hashing->Hash_Users(OnlineUser),
					$Hashing->Hash_Users($GLOBALS['N']),
					$Hashing->Hash_Users($GLOBALS['E']),
					$Hashing->Hash_Users($GLOBALS['P']),
					$Hashing->Hash_Users($GLOBALS['Ph']),
					date('D d-m-Y H:i:s')
				)))->Result == -1 )
		StatusPages_Error_Page('insert Data into Users To Save it');

	// Delete Data From waiting User
	if ( $MySql->excute('DELETE FROM waiting_users WHERE email = ?',
				array( $Hashing->Hash_WaitingUsers($GLOBALS['E']) ))->Result == -1 )
		OpenTemplate();

	// Delete Token From DataBase
	$MySql->excute('DELETE FROM sign_up_token WHERE token_email = ?',
				array( $Hashing->Hash_SignUP_Token($GLOBALS['E']) ));
	OpenTemplate();
}
?>