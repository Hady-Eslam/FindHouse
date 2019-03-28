<?php
include_once Files;

function EditPost_Begin($Post_id){
	
	if ( (new URLClass())->Request() == "POST" )
		EditPost_POST($Post_id);
	EditPost_GET($Post_id);
}

function EditPost_GET($Post_id){
	$Result = (new MYSQLClass('Profile'))->FetchOneRow(
		'SELECT * FROM posts WHERE id = ? AND user_email = ? AND deleted = ?',
		array(
			$Post_id,
			(new HashingClass())->Hash_POSTS($_SESSION['Email']),
			'0'
		));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		StatusPages_Not_Found_Page();
	
	EditPost_Get_Data_From_Hashing($Result->Data);
	include_once EditPost_Template;
}

function EditPost_Get_Data_From_Hashing($Data){
	(new HashingClass())->Get_Data_From_Hashing([

		['Type' => 'POSTS', 'Data' => $Data['addname'], 'Key' => 'Add_Name' ],
		['Type' => 'POSTS', 'Data' => $Data['bigtype'], 'Key' => 'BigType' ],
		['Type' => 'POSTS', 'Data' => $Data['smalltype'], 'Key' => 'SmallType' ],
		['Type' => '', 'Data' => $Data['money'], 'Key' => 'Money' ],
		['Type' => '', 'Data' => $Data['rooms'], 'Key' => 'Rooms' ],
		['Type' => '', 'Data' => $Data['pathrooms'], 'Key' => 'PathRooms' ],
		['Type' => '', 'Data' => $Data['area'], 'Key' => 'Area' ],
		['Type' => 'POSTS', 'Data' => $Data['furnished'], 'Key' => 'Furnished' ],
		['Type' => 'POSTS', 'Data' => $Data['discreption'], 'Key' => 'Discreption' ],

		['Type' => 'POSTS', 'Data' => $Data['f_pic'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['s_pic'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['t_pic'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['fo_pic'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => 'POSTS', 'Data' => $Data['address'], 'Key' => 'Address' ],
		['Type' => 'POSTS', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],
		['Type' => 'POSTS', 'Data' => $Data['phone'], 'Key' => 'Phone' ]

	], 'StatusPages_Error_Page');
}

function EditPost_POST($Post_id){
	$URL = new URLClass();
	if ( $URL->REFFERE_is_SET() && isset($_POST['AddName']) && isset($_POST['BigType']) &&
		isset($_POST['SmallType']) && isset($_POST['Rooms']) && isset($_POST['PathRooms']) &&
		isset($_POST['Area']) && isset($_POST['Furnished']) && isset($_POST['Discreption']) &&
		isset($_POST['City']) && isset($_POST['UserName']) && isset($_POST['Money']) &&
    	isset($_FILES['File1']) && isset($_FILES['File2']) && isset($_FILES['File3']) &&
    	isset($_FILES['File4']) && isset($_POST['Phone']) ){

		if ( !$URL->CheckREFFERE(EditPost.$Post_id) )
			StatusPages_Not_Authurithed_User_Page();

		EditPost_CheckData();
		EditPost_SavePictures();
		EditPost_SaveData($Post_id);
	}
	Redirect(EditPost.$Post_id);
}

function EditPost_CheckData(){
    $FILTER = new FILTERSClass();
	$FILTER->FILTER_POST([
            'AddName' => ['Type' => 'STRING', 'Len' => Advertise_Name_Len ],
            'BigType' => ['Type' => 'STRING', 'Len' => BigType_Len ],
            'SmallType' => ['Type' => 'STRING', 'Len' => SmallType_Len ],
            
            'Rooms' => ['Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9 ],
            'PathRooms' => ['Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9 ],

            'Area' => ['Type' => 'INT', 'Len' => Area_Len, 'Min' => 0, 'Max' => 10000 ],

            'Money' => ['Type' => 'INT', 'Len' => Area_Len, 'Min' => 0, 'Max' => 10000000000 ],

            'Furnished' => ['Type' => 'STRING', 'Len' => Furnished_Len ],

            'Discreption' => [ 'Type' => 'STRING', 'Len' => Discreption_Len],

            'City' => ['Type' => 'STRING', 'Len' => Address_Len ],
            'UserName' => ['Type' => 'STRING', 'Len' => Name_Len ],
            'Phone' => ['Type' => 'STRING', 'Len' => Phone_Len ]
        
        ], 'Redirect', Advertise );

	if ( $GLOBALS['Furnished'] == 'Select' || $GLOBALS['Furnished'] == 'NO' )
		$GLOBALS['Furnished'] = 'NO';
	else
		$GLOBALS['Furnished'] = 'YES';

	if ( $GLOBALS['SmallType'] == 'Select' || $GLOBALS['BigType'] == 'Select' )
		Redirect(Advertise);

    // First Picture
    $GLOBALS['Pic1'] = true;
    if ( $FILTER->FilterPicture('File1')->Result != 'OK' )
    	$GLOBALS['Pic1'] = false;

    // Second Picture
    $GLOBALS['Pic2'] = true;
    if ( $FILTER->FilterPicture('File2')->Result != 'OK' )
    	$GLOBALS['Pic2'] = false;

    // Second Picture
    $GLOBALS['Pic3'] = true;
    if ( $FILTER->FilterPicture('File3')->Result != 'OK' )
    	$GLOBALS['Pic3'] = false;


	// Second Picture
    $GLOBALS['Pic4'] = true;
    if ( $FILTER->FilterPicture('File4')->Result != 'OK' )
    	$GLOBALS['Pic4'] = false;
}

function EditPost_SavePictures(){

	MakePostFile($_SESSION['ID'], $_SESSION['Posts']);
	ReNamePicture('Pic1', 'File1', $_SESSION['ID'], $_SESSION['Posts'], '1');
	ReNamePicture('Pic2', 'File2', $_SESSION['ID'], $_SESSION['Posts'], '2');
	ReNamePicture('Pic3', 'File3', $_SESSION['ID'], $_SESSION['Posts'], '3');
	ReNamePicture('Pic4', 'File4', $_SESSION['ID'], $_SESSION['Posts'], '4');
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

function EditPost_SaveData($Post_id){
	$Hashing = new HashingClass();
	$MySql = new MYSQLClass('DO');

	if ( ($Result = $MySql->excute('UPDATE posts SET address = ?, addname = ?, bigtype = ?, furnished = ?, area = ?, rooms = ?, pathrooms = ?, discreption = ?, f_pic = ?, s_pic = ?, smalltype = ?, user_name = ?, t_pic = ?, fo_pic = ?, money = ?, phone = ?, status = ? WHERE id = ?',
		array(
			$Hashing->Hash_POSTS($GLOBALS['City']),
			$Hashing->Hash_POSTS($GLOBALS['AddName']),
			$Hashing->Hash_POSTS($GLOBALS['BigType']),
			$Hashing->Hash_POSTS($GLOBALS['Furnished']),
			$GLOBALS['Area'],
			$GLOBALS['Rooms'],
			$GLOBALS['PathRooms'],
			$Hashing->Hash_POSTS($GLOBALS['Discreption']),
			$Hashing->Hash_POSTS($GLOBALS['Pic1']),
			$Hashing->Hash_POSTS($GLOBALS['Pic2']),
			$Hashing->Hash_POSTS($GLOBALS['SmallType']),
			$Hashing->Hash_POSTS($GLOBALS['UserName']),
			$Hashing->Hash_POSTS($GLOBALS['Pic3']),
			$Hashing->Hash_POSTS($GLOBALS['Pic4']),
			$GLOBALS['Money'],
			$Hashing->Hash_POSTS($GLOBALS['Phone']),
			( $_SESSION['Status'] != '0' ) ? '0' : '1',
			$Post_id
		)))->Result == -1 )
		StatusPages_Error_Page('Editing Post');

	Redirect(Post.$Post_id);
}