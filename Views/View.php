<?php set_error_handler("Error_Handeler");
/*
	- included Classes :
		URL
		MySql
		Hashing
		Session
		FILTER
*/
include_once Session;
include_once FILTERS;
$GLOBALS['Result'] = array(-2 ,'');

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Register 
	// Sign UP Page
function Register_SignUP(){
	$_SESSION['Page Name'] = 'Sign UP';
	if ( SESSION() )
	    StatusPages_Log_Out_Page('Must Log Out To Enter This Page');
	include_once SignUP_View;
	SignUP_Begin();
}
	
	// Success Sign UP Page
function Register_SuccessSignUP(){
	$_SESSION['Page Name'] = 'Success Sign UP';
	if ( SESSION() )
	    StatusPages_Not_Authurithed_User_Page('Not Authorized User To Enter This Page');
	include_once SuccessSignUP_Template;
}

	// Confirm User Page
function Register_ConfirmUser(){
	$_SESSION['Page Name'] = 'Confirm User';
	if ( SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once ConfirmUser_View;
	ConfirmUser_Begin();
}

/////////////////

	// Log in Page
function Register_Login(){
	$_SESSION['Page Name'] = 'Log in';
	if ( SESSION() )
	    StatusPages_Log_Out_Page();
	include_once Login_View;
	Login_Begin();
}
	
	// Forget Password Page
function Register_ForgetPassword(){
	$_SESSION['Page Name'] = 'Forget Password';
	if ( SESSION() )
	    StatusPages_Log_Out_Page();
	include_once ForgetPassword_View;
	ForgetPassword_Begin();
}

	// ReSet Password Page
function Register_ReSetPassword(){
	$_SESSION['Page Name'] = 'ReSet Password';
	if ( SESSION() )
	    StatusPages_Log_Out_Page();
	include_once ReSetPassword_View;
	ReSetPassword_Begin();
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// DO

	// Find House
function DO_Find(){
	$_SESSION['Page Name'] = 'Find';
	include_once Find_View;
	Find_Begin();
}

	// Predict Price
function DO_Predict(){
	$_SESSION['Page Name'] = 'Predict';
	include_once Predict_View;
	Predict_Begin();
}

	// Advertise
function DO_Advertise(){
	$_SESSION['Page Name'] = 'Advertise';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Advertise_View;
	Advertise_Begin();
}

	// interested
function DO_interested(){
	$_SESSION['Page Name'] = 'interested';
	include_once interested_View;
	interested_Begin();
}

function DO_Post(){
	$Post_id = (new URLClass())->GetMetched('/DO\/Post\/(\d+)$/');
	$_SESSION['Page Name'] = 'Post '.$Post_id;
	include_once Post_View;
	Post_Begin($Post_id);
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Profile

	// Settings
function Profile_Settings($URL){
	$_SESSION['Page Name'] = 'Settings';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Settings_View;
	Settings_Begin($URL);
}

	// User
function Profile_User(){
	$User_id = (new URLClass())->GetMetched('/Profile\/User\/(\d+)$/');
	$_SESSION['Page Name'] = 'User '.$User_id;
	include_once User_View;
	User_Begin($User_id);
}

	// My Profile
function Profile_MyProfile(){
	$_SESSION['Page Name'] = 'My Profile';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once MyProfile_View;
	MyProfile_Begin();
}

	// Notifications
function Profile_Notifications(){
	$_SESSION['Page Name'] = 'Notifications';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Notifications_View;
	Notifications_Begin();
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Services
function Services($URL){
	include_once Services_View;
	if ( $URL == Help )
		Services_Help();
	Services_Privacy();
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Back End Pages
function BackEnd($URL){
	include_once BackEnd_View;
	if ( $URL == CheckPage )
		CheckPage_Begin();
	else if ( $URL == LogOut )
		LogOut_Begin();
	else if ( $URL == DeletePostPage )
		DeletePost_Begin();
	else if ( $URL == MakeCommentPage )
		MakeComment_Begin();
	else if ( $URL == MakeLike_DisLikePage )
		MakeLike_DisLike_Begin();
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Status Pages
function StatusPages_Not_Found_Page($Message = ''){
	include_once NotFoundPage;
	exit();
}

function StatusPages_Log_Out_Page($Message = ''){
	include_once LogOutPage;
	exit();
}

function StatusPages_Not_Authurithed_User_Page($Message = ''){
	include_once UnAuthurithedUserPage;
	exit();
}

function StatusPages_Error_Page($Message = ''){
	include_once ErrorPage;
	exit();
}
?>