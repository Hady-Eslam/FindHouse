<?php
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
	
	// Check Post Status
function DO_PostStatus(){
	$_SESSION['Page Name'] = 'Post Status';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once PostStatus_View;
	PostStatus_Begin((new URLClass())->GetMetched('/DO\/PostStatus\/(\d+)$/'));
}

	// interested
function DO_interested(){
	$_SESSION['Page Name'] = 'interested';
	include_once interested_View;
	interested_Begin();
}
	
	// See Posts
function DO_Post(){
	$Post_id = (new URLClass())->GetMetched('/DO\/Post\/(\d+)$/');
	$_SESSION['Page Name'] = 'Post '.$Post_id;
	include_once Post_View;
	Post_Begin($Post_id);
}

	// See All Pedding Posts
function DO_PeddingPosts(){
	if ( !SESSION() || $_SESSION['Status'] != '0' )
		StatusPages_Not_Authurithed_User_Page();
	$_SESSION['Page Name'] = 'Pedding Posts';
	include_once PeddingPosts_View;
	PeddingPosts_Begin();
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
function Profile_MyProfile($Type){
	$_SESSION['Page Name'] = 'My Profile';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once MyProfile_View;
	MyProfile_Begin($Type);
}

	// Edit Posts
function Profile_EditPost(){
	$_SESSION['Page Name'] = 'Edit Post';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once EditPost_View;
	EditPost_Begin((new URLClass())->GetMetched('/Profile\/EditPost\/(\d+)$/'));
}

	// Notifications
function Profile_Notifications(){
	$_SESSION['Page Name'] = 'Notifications';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Notifications_View;
	Notifications_Begin();
}

	// Get Inbox Messages
function Profile_Messages_Inbox(){
	$_SESSION['Page Name'] = 'Messages Inbox';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Messages_Inbox_View;
	Messages_Inbox_Begin();
}

	// Get Sent Message
function Profile_Messages_Sent(){
	$_SESSION['Page Name'] = 'Messages Sent';
	if ( !SESSION() )
	    StatusPages_Not_Authurithed_User_Page();
	include_once Messages_Sent_View;
	Messages_Sent_Begin();
}

	// Message
function Profile_Message(){
	$Message_id = (new URLClass())->GetMetched('/Profile\/Message\/(\d+)$/');
	$_SESSION['Page Name'] = 'Message '.$Message_id;
	include_once Message_View;
	Message_Begin($Message_id);
}

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Admin


	// Admin Deleting Posts
function Admin_AdminDeletePost(){
	$_SESSION['Page Name'] = 'Admin Delete Post';
	if ( !SESSION() || $_SESSION['Status'] != '0' )
	    StatusPages_Not_Authurithed_User_Page();
	include_once AdminDeletePost_View;
	AdminDeletePost_Begin((new URLClass())->GetMetched('/Admin\/AdminDeletePost\/(\d+)$/'));
}

	// Admin Accept Posts
function Admin_AdminAcceptPost(){
	$_SESSION['Page Name'] = 'Admin Accept Post';
	if ( !SESSION() || $_SESSION['Status'] != '0' )
	    StatusPages_Not_Authurithed_User_Page();
	include_once AdminAcceptPost_View;
	AdminAcceptPost_Begin((new URLClass())->GetMetched('/Admin\/AdminAcceptPost\/(\d+)$/'));
}

	// Admin Reject Posts
function Admin_AdminRejectPost(){
	$_SESSION['Page Name'] = 'Admin Reject Post';
	if ( !SESSION() || $_SESSION['Status'] != '0' )
	    StatusPages_Not_Authurithed_User_Page();
	include_once AdminRejectPost_View;
	AdminRejectPost_Begin((new URLClass())->GetMetched('/Admin\/AdminRejectPost\/(\d+)$/'));
}

	// Admin Delete Account
function Admin_AdminDeleteAccount(){
	$_SESSION['Page Name'] = 'Admin Delete Account';
	if ( !SESSION() || $_SESSION['Status'] != '0' )
	    StatusPages_Not_Authurithed_User_Page();
	include_once AdminDeleteAccount_View;
	AdminDeleteAccount_Begin(
		(new URLClass())->GetMetched('/Admin\/AdminDeleteAccount\/(\d+)$/'));
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
	else if ( $URL == MakeMessage )
		MakeMessage_Begin();
	else if ( $URL == DeleteMessage )
		DeleteMessage_Begin();
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

function StatusPages_Maximum_Advertising_Limit(){
	include_once MaximumAdvertisingLimitPage;
	exit();
}