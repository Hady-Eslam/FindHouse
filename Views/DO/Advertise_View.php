<?php set_error_handler("Error_Handeler");
include_once Files;
include_once DATE;
include_once PHPMailClass;

function Advertise_Begin(){
	if ( (new URLClass())->Request() == "POST" )
		Advertise_POST();
	Advertise_GET();
}

function Advertise_POST(){
	$URL = new URLClass();
	if ( $URL->REFFERE_is_SET() && isset($_POST['Add']) && isset($_POST['Ph']) &&
		isset($_POST['A']) && isset($_POST['Status']) && isset($_POST['Ty']) &&
		isset($_POST['Fur']) && isset($_POST['R']) && isset($_POST['PR']) &&
		isset($_POST['Storey']) && isset($_POST['M']) && isset($_POST['Dis']) &&
    	isset($_FILES['File1']) && isset($_FILES['File2']) ){


		if ( !$URL->CheckREFFERE(Advertise) )
			StatusPages_Not_Authurithed_User_Page();

		Advertise_CheckData();
		Advertise_SavePictures();
		Advertise_SaveData();
	}
	Advertise_GET();
}

function Advertise_GET(){
	Advertise_SetVariables();
	include_once Advertise_Template;
}

function Advertise_Setvariables(){
	if ( isset($_GET['Posted']) )
		$GLOBALS['Result'] = 'Done';
	
	(new FILTERSClass())->FILTER_GET([
		'ID' => ['Type' => 'INT', 'Len' => ID_Len, 'Min' => 0, 'Max' => 1000000,
			'Default' => -1 ]]);

	if ( (new MYSQLClass('DO'))->isFound(
				'SELECT * FROM posts WHERE id = ? AND deleted = ?',
				array( $GLOBALS['ID'], '0' ))->Result != 1 )
		$GLOBALS['ID'] = NULL;

	//Debug(true, $GLOBALS['ID']);
}

function Advertise_CheckData(){
    $FILTER = new FILTERSClass();
	$FILTER->FILTER_POST([
            'Add' => ['Type' => 'STRING', 'Len' => Address_Len ],
            'Ph' => ['Type' => 'STRING', 'Len' => Phone_Len ],
            'A' => ['Type' => 'INT', 'Len' => Area_Len,
                    'Min' => 0, 'Max' => 10000 ],
            'Status' => ['Type' => 'STRING', 'Len' => Status_Len ],
            'Ty' => ['Type' => 'STRING', 'Len' => Type_Len ],
            'Fur' => ['Type' => 'STRING', 'Len' => Furnished_Len ],
            'R' => ['Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9 ],
            'PR' => ['Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9 ],
            'Storey' => ['Type' => 'INT', 'Len' => Storey_Len, 'Min' => 0, 'Max' => 20 ],
            'M' => ['Type' => 'INT', 'Len' => Money_Len,
                    'Min' => 0, 'Max' => 10000000000 ],
            'Dis' => [ 'Type' => 'STRING', 'Len' => Discreption_Len,
            		'Default' => '' ]
        ], 'Redirect', Advertise );

    if ( $GLOBALS['Status'] != 'Rent' && $GLOBALS['Status'] != 'Buy' ||
		 $GLOBALS['Ty'] != 'Students' && $GLOBALS['Ty'] != 'Families' &&
    	 $GLOBALS['Ty'] != 'Offices' ||
    	 $GLOBALS['Fur'] != 'Yes' && $GLOBALS['Fur'] != 'No' )
    	Redirect(Advertise);

    // First Picture
    $GLOBALS['Pic1'] = true;
    if ( $FILTER->FilterPicture('File1')->Result != 'OK' )
    	$GLOBALS['Pic1'] = false;

    // Second Picture
    $GLOBALS['Pic2'] = true;
    if ( $FILTER->FilterPicture('File2')->Result != 'OK' )
    	$GLOBALS['Pic2'] = false;
}

function Advertise_SavePictures(){

	if ( $GLOBALS['Pic1'] == true || $GLOBALS['Pic2'] == true){
		MakePostFile($_SESSION['ID'], $_SESSION['Posts']);
		ReNamePicture('Pic1', 'File1', $_SESSION['ID'], $_SESSION['Posts'], '1');
		ReNamePicture('Pic2', 'File2', $_SESSION['ID'], $_SESSION['Posts'], '2');
	}
	else{
		$GLOBALS['Pic1'] = Housing;
		$GLOBALS['Pic2'] = Housing;
	}
}

function ReNamePicture($PKey, $FKey, $Userid, $Postid, $id){
	if ( $GLOBALS[ $PKey ] == true ){

		$Ext = pathinfo($_FILES[ $FKey ]['name'], PATHINFO_EXTENSION);
		$NewName = UserPictures.'User'.$Userid.'/Post'.$Postid.'/'.$id.'.'.$Ext;
		$Result = rename( $_FILES[ $FKey ]['tmp_name'], $NewName);
		if ( $Result == false )
			$GLOBALS[ $PKey ] = Housing;
		else
			$GLOBALS[ $PKey ] = UserPictures_HTTP.'User'.$Userid.'/Post'.$Postid
										.'/'.$id.'.'.$Ext;
	}
	else
		$GLOBALS[ $PKey ] = Housing;
}

function Advertise_SaveData(){
	$Hashing = new HashingClass();
	$MySql = new MYSQLClass('DO');

	if ( ($Result = $MySql->excute('INSERT INTO posts (user_email, address, status,'
			.' type, furnished, phone, area, storey, rooms, pathrooms, money,'
			.' discreption,f_pic, s_pic, post_date) VALUES '
			.'(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_POSTS($_SESSION['Email']),
				$Hashing->Hash_POSTS($GLOBALS['Add']),
				$Hashing->Hash_POSTS($GLOBALS['Status']),
				$Hashing->Hash_POSTS($GLOBALS['Ty']),
				$Hashing->Hash_POSTS($GLOBALS['Fur']),
				$Hashing->Hash_POSTS($GLOBALS['Ph']),
				$Hashing->Hash_POSTS($GLOBALS['A']),
				$Hashing->Hash_POSTS($GLOBALS['Storey']),
				$Hashing->Hash_POSTS($GLOBALS['R']),
				$Hashing->Hash_POSTS($GLOBALS['PR']),
				$Hashing->Hash_POSTS($GLOBALS['M']),
				$Hashing->Hash_POSTS($GLOBALS['Dis']),
				$Hashing->Hash_POSTS($GLOBALS['Pic1']),
				$Hashing->Hash_POSTS($GLOBALS['Pic2']),
				date('D d-m-Y H:i:s')
			)))->Result == -1 )
		StatusPages_Error_Page('Saving Post into DataBase');
	$_SESSION['Posts']++;
	interested_Check_interested($MySql->GetInsertedID());
}

function interested_Check_interested($ID){
	$Result = (new MYSQLClass('DO'))->FetchAllRows(
			'SELECT * FROM interested WHERE deleted = ?', array('0'));

	if ( $Result->Result == 1 )
		foreach ($Result->Data as $Row) {
			interested_Proccess_Data($Row, $ID);
		}
	Redirect(Advertise.'?Posted&ID='.$ID);
}

function interested_Proccess_Data($Data, $ID){
	$Result = (new DATEClass())->isDateBiggerThanCurrentDate(
		$Data['interested_date'], $Data['search_months'], $Data['search_days']);

	if ( $Result == false ){
		$Result = ((new MYSQLClass('DO')))->
				excute('UPDATE interested SET deleted = ? WHERE id = ?',
				array('1', $Data['id']));
		return ;
	}

	$Row = interested_Get_Data_Filtered($Data);
	if ( $Row['Email'] == '' ||

		$GLOBALS['A'] > $Row['MaxArea'] || $GLOBALS['A'] < $Row['MinArea'] ||
		$GLOBALS['R'] > $Row['MaxRooms'] || $GLOBALS['R'] < $Row['MinRooms'] ||
		$GLOBALS['PR'] > $Row['MaxPathRooms'] ||
		$GLOBALS['PR'] < $Row['MinPathRooms'] ||
		$GLOBALS['Storey'] > $Row['MaxStorey'] ||
		$GLOBALS['Storey'] < $Row['MinStorey'] ||
		$GLOBALS['M'] > $Row['MaxMoney'] || $GLOBALS['M'] < $Row['MinMoney']||
		
		$Row['Status'] == 2 && $GLOBALS['Status'] != 'Rent' ||
		$Row['Status'] == 3 && $GLOBALS['Status'] != 'Buy' ||
		$Row['Furnished'] == 2 && $GLOBALS['Fur'] != 'Yes' ||
		$Row['Furnished'] == 3 && $GLOBALS['Fur'] != 'No' ||
		$Row['Type'] == 2 && $GLOBALS['Ty'] != 'Students' ||
		$Row['Type'] == 3 && $GLOBALS['Ty'] != 'Families' ||
		$Row['Type'] == 4 && $GLOBALS['Ty'] != 'Offices' ||
		$Row['Type'] == 5 && $GLOBALS['Ty'] == 'Offices' ||
		$Row['Type'] == 6 && $GLOBALS['Ty'] == 'Families' ||
		$Row['Type'] == 7 && $GLOBALS['Ty'] == 'Students')
		return ;

	// Make Email Request
	(new MailClass())->SendinterestedMail( $Row['Email'], $ID );
}

function interested_Get_Data_Filtered($Data){
	
	$Area = explode('|', $Data['area']);
		$Result['MinArea'] = $Area[0];
		$Result['MaxArea'] = $Area[1];
	$Rooms = explode('|', $Data['rooms']);
		$Result['MinRooms'] = $Rooms[0];
		$Result['MaxRooms'] = $Rooms[1];
	$PathRooms = explode('|', $Data['pathrooms']);
		$Result['MinPathRooms'] = $PathRooms[0];
		$Result['MaxPathRooms'] = $PathRooms[1];
	$Money = explode('|', $Data['money']);
		$Result['MinMoney'] = $Money[0];
		$Result['MaxMoney'] = $Money[1];
	$Storey = explode('|', $Data['storey']);
		$Result['MinStorey'] = $Storey[0];
		$Result['MaxStorey'] = $Storey[1];

	(new HashingClass())->Get_Data_From_Hashing([[
		'Type' => 'interested', 'Data' => $Data['email'], 'Key' => 'Email',
			'Default' => '']]);
	$Result['Email'] = $GLOBALS['Email'];

	// Status
	if ( $Data['status'] == '' )
		$Result['Status'] = 1;
	else if ( $Data['status'] == 'Rent' )
		$Result['Status'] = 2;
	else
		$Result['Status'] = 3;

	// Furnished
	if ( $Data['furnished'] == '' )
		$Result['Furnished'] = 1;
	else if ( $Data['furnished'] == 'Yes' )
		$Result['Furnished'] = 2;
	else
		$Result['Furnished'] = 3;

	// Type
	if ( $Data['type'] == '' )
		$Result['Type'] = 1;
	else if ( $Data['type'] == 'Students' )
		$Result['Type'] = 2;
	else if ( $Data['type'] == 'Families' )
		$Result['Type'] = 3;
	else if ( $Data['type'] == 'Offices' )
		$Result['Type'] = 4;
	else if ( $Data['type'] == 'StudentsFamilies' )
		$Result['Type'] = 5;
	else if ( $Data['type'] == 'StudentsOffices' )
		$Result['Type'] = 6;
	else if ( $Data['type'] == 'FamiliesOffices' )
		$Result['Type'] = 7;

	return $Result;
}

function Advertise_Get_Link(){
	?>
	<div id="Link">
        <a href="<?php echo Post.$GLOBALS['ID']; ?>">Link Of Post</a>

        <input type="button" id="ShowAdvertise" value="Make Advertise">
    </div>
	<?php
}
?>