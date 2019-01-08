<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;
include_once FILTERS;
include_once MySqlDB;
include_once Files;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.P8F1';
else
    $GLOBALS['Page_API_Error_Code'] = 'P8F1';
set_error_handler("Error_Handeler");

/*
	- What is Doing ?
		Filtering Data

	Return : 
		return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(0, 'Wrong Data');
*/
function CheckData(){
	$FILTER = new FILTERSClass();
//
	// Filter For Governor
	if ( ( $Result = $FILTER->FilterString($_POST['G'], Governor_Len) )[1] != 'OK' )
        return $Result;
    $GLOBALS['G'] = $FILTER->FILTER_Result;

	// Filter For Station
    if ( ( $Result = $FILTER->FilterString($_POST['S'], Station_Len) )[1] != 'OK' )
        return $Result;
    $GLOBALS['S'] = $FILTER->FILTER_Result;

	// Filter For Distruct
    if ( ( $Result = $FILTER->FilterString($_POST['D'], Distruct_Len) )[1] != 'OK' )
        return $Result;
    $GLOBALS['D'] = $FILTER->FILTER_Result;

	// Filter For Distruct_Show
    $GLOBALS['Distruct_Show'] = false;
    if ( isset($_POST['Distruct_Show']) )
    	$GLOBALS['Distruct_Show'] = true;

	// Filter For Street
    if ( ( $Result = $FILTER->FilterString($_POST['St'], Street_Len) )[1] == 'Too Long' )
        return $Result;
    $GLOBALS['St'] = $FILTER->FILTER_Result;

	// Filter For Street_Show
    $GLOBALS['Street_Show'] = false;
    if ( isset($_POST['Street_Show']) )
    	$GLOBALS['Street_Show'] = true;

//
	// Filter For Status
    if ( ( $Result = $FILTER->FilterString($_POST['Status'], Street_Len) )[1] != 'OK' )
        return $Result;
    if ( $FILTER->FILTER_Result != 'Rent' && $FILTER->FILTER_Result != 'Buy' )
    	return array(0, 'Wrong Data');
    $GLOBALS['Status'] = $FILTER->FILTER_Result;

	// Filter For Type
    if ( ( $Result = $FILTER->FilterString($_POST['Ty'], Street_Len) )[1] != 'OK' )
        return $Result;
    if ( $FILTER->FILTER_Result != 'Students' && $FILTER->FILTER_Result != 'Families'
    	&& $FILTER->FILTER_Result != 'Offices')
    	return array(0, 'Wrong Data');
    $GLOBALS['Ty'] = $FILTER->FILTER_Result;

	// Filter For Furnished
    if ( ( $Result = $FILTER->FilterString($_POST['Fur'], Street_Len) )[1] != 'OK' )
        return $Result;
    if ( $FILTER->FILTER_Result != 'Yes' && $FILTER->FILTER_Result != 'No' )
    	return array(0, 'Wrong Data');
    $GLOBALS['Fur'] = $FILTER->FILTER_Result;

// 
	// Filter For Phone
    if ( ( $Result = $FILTER->FilterPhone($_POST['Ph'], Phone_Len) )[1] != 'OK' )
        return $Result;
    $GLOBALS['Ph'] = $FILTER->FILTER_Result;

    // Filter For Area
    if ( ( $Result = $FILTER->FilterString($_POST['A'], Area_Len) )[1] != 'OK' )
        return $Result;
    if ( is_numeric($FILTER->FILTER_Result) == false )
    	return array(0, 'Not Number');
    $GLOBALS['A'] = $FILTER->FILTER_Result;

    // Filter For Storey
    if ( ( $Result = $FILTER->FilterString($_POST['Storey'], Storey_Len) )[1] != 'OK' )
        return $Result;
    if ( is_numeric($FILTER->FILTER_Result) == false )
    	return array(0, 'Not Number');
    $GLOBALS['Storey'] = $FILTER->FILTER_Result;

    // Filter For Rooms
    if ( ( $Result = $FILTER->FilterString($_POST['R'], Rooms_Len) )[1] != 'OK' )
        return $Result;
    if ( is_numeric($FILTER->FILTER_Result) == false )
    	return array(0, 'Not Number');
    $GLOBALS['R'] = $FILTER->FILTER_Result;

    // Filter For PathRooms
    if ( ( $Result = $FILTER->FilterString($_POST['PR'], PathRooms_Len) )[1] != 'OK' )
        return $Result;
    if ( is_numeric($FILTER->FILTER_Result) == false )
    	return array(0, 'Not Number');
    $GLOBALS['PR'] = $FILTER->FILTER_Result;

    // Filter For Money
    if ( ( $Result = $FILTER->FilterString($_POST['M'], Money_Len) )[1] != 'OK' )
        return $Result;
    if ( is_numeric($FILTER->FILTER_Result) == false )
    	return array(0, 'Not Number');
    $GLOBALS['M'] = $FILTER->FILTER_Result;

    // Filter For Discreption
    if ( ( $Result = $FILTER->FilterString($_POST['Dis'], Discreption_Len) )[1] 
    				== 'Too Long' )
        return $Result;
    $GLOBALS['Dis'] = $FILTER->FILTER_Result;

// Files
    // First Picture
    $GLOBALS['Pic1'] = true;
    if ( ( $Result = $FILTER->FilterPicture('File1') )[1] != 'OK' ){
    	//var_dump( $Result);
    	$GLOBALS['Pic1'] = false;
    }

    // Second Picture
    $GLOBALS['Pic2'] = true;
    if ( ( $Result = $FILTER->FilterPicture('File2') )[1] != 'OK' ){
    	//var_dump( $Result);
    	$GLOBALS['Pic2'] = false;
    }

    // Third Picture
    $GLOBALS['Pic3'] = true;
    if ( ( $Result = $FILTER->FilterPicture('File3') )[1] != 'OK' ){
    	//var_dump( $Result);
    	$GLOBALS['Pic3'] = false;
    }
//exit();
    return SavePictures();
}

function SavePictures(){

	if ( $GLOBALS['Pic1'] == true || $GLOBALS['Pic2'] == true || $GLOBALS['Pic3'] == true ){
		MakePostFile($_SESSION['ID'], $_SESSION['Posts']);
		ReNamePicture('Pic1', 'File1', $_SESSION['ID'], $_SESSION['Posts'], '1');
		ReNamePicture('Pic2', 'File2', $_SESSION['ID'], $_SESSION['Posts'], '2');
		ReNamePicture('Pic3', 'File3', $_SESSION['ID'], $_SESSION['Posts'], '3');
	}
	else{
		$GLOBALS['Pic1'] = AddPicture;
		$GLOBALS['Pic2'] = AddPicture;
		$GLOBALS['Pic3'] = AddPicture;
	}

	return SaveData();
}

/*
	- What is Doing ?
		Change The Picture Name And Move it
*/
function ReNamePicture($GKey, $FKey, $Userid, $Postid, $id){
	if ( $GLOBALS[ $GKey ] == true ){

		$Ext = pathinfo($_FILES[ $FKey ]['name'], PATHINFO_EXTENSION);
		$NewName = UserPicturesFolder.'User'.$Userid.'/Post'.$Postid.'/'.$id.'.'.$Ext;
		$Result = rename( $_FILES[ $FKey ]['tmp_name'], $NewName);
		if ( $Result == false )
			$GLOBALS[ $GKey ] = AddPicture;
		else
			$GLOBALS[ $GKey ] = UserPictures.'User'.$Userid.'/Post'.$Postid
										.'/'.$id.'.'.$Ext;
	}
	else
		$GLOBALS[ $GKey ] = AddPicture;
}

/*
	- What is Doing ?
		Saving Data into DataBase

	Return :
		return array(-1, $MySql->Error, 'Saving Post into DataBase', 'Save Data');
		return array(0, 'Done');
*/
function SaveData(){
	$MySql = new MYSQLClass('Post');
	$Hashing = new HashingClass();

	if ( $MySql->excute('INSERT INTO posts (user_email, governor, station, distruct,'
			.' distruct_show, street, street_show, status, type, furnished, phone,'
			.' area, storey, rooms, pathrooms, money, discreption, f_pic, s_pic,'
			.' th_pic, post_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,'
			.' ?, ?, ?, ?, ?, ?, ?, ?)',
			array(
				$Hashing->Hash_Email($_SESSION['Email']), $GLOBALS['G'], $GLOBALS['S'],
				$GLOBALS['D'],$GLOBALS['Distruct_Show'], $GLOBALS['St'],
				$GLOBALS['Street_Show'],$GLOBALS['Status'], $GLOBALS['Ty'],
				$GLOBALS['Fur'], $GLOBALS['Ph'],$GLOBALS['A'], $GLOBALS['Storey'],
				$GLOBALS['R'], $GLOBALS['PR'],$GLOBALS['M'], $GLOBALS['Dis'],
				$GLOBALS['Pic1'], $GLOBALS['Pic2'],$GLOBALS['Pic3'], date('D d-m-Y H:i:s')
			)) == -1 )
		return array(-1, $MySql->Error, 'Saving Post into DataBase', 'Save Data');
	$_SESSION['Posts']++;
	return array(0, 'Done');
}
?>