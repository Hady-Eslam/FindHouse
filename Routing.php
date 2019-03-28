<?php
define('_DIR_', __DIR__);
include_once _DIR_.'/Resources/Config.php';
include_once _DIR_.'/Views/View.php';
include_once URL;

/**
 * generate CSRF token
 * 
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   string $formName
 * @return  string  
 */
/*function generateToken( $formName ) {
    if ( !session_id() ) {
        session_start();
    }
    $sessionId = session_id();
    return sha1( $formName.$sessionId );

}*


/**
 * generate CSRF token
 * 
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   string $formName
 * @return  string  
 */
/*function GenerateToken( $formName ) {
	
    $secretKey = 'gsfhs154aergz2#';
    if ( !session_id() ) {
        session_start();
    }
    $sessionId = session_id();

    return sha1( $formName.$sessionId.$secretKey );
}*/


/**
 * check CSRF token
 * 
 * @author  Joe Sexton <joe@webtipblog.com>
 * @param   string $token
 * @param   string $formName
 * @return  boolean  
 */
/*function checkToken( $token, $formName ){
    return $token === GenerateToken( $formName );
}*/

/*
	- included Classes :
		URL
*/

// Main Page
/*var_dump($_SESSION);
exit();
*/if ( empty($_GET['URL']) )
	echo 'Hello';


//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Register Pages
else if ( $URL->Compare(SignUP) )
	Register_SignUP();
else if ( $URL->Compare(SuccessSignUP) )
	Register_SuccessSignUP();
else if ( $URL->Compare(ConfirmUser) )
	Register_ConfirmUser();

else if ( $URL->Compare(Login) )
	Register_Login();
else if ( $URL->Compare(ForgetPassword) )
	Register_ForgetPassword();
else if ( $URL->Compare(ReSetPassword) )
	Register_ReSetPassword();

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Do Pages
else if ( $URL->Compare(Find) )
	DO_Find();
/*else if ( $URL->Compare(Predict) )
	DO_Predict();
*/else if ( $URL->Compare(Advertise) )
	DO_Advertise();
/*else if ( $URL->Compare(interested) )
	DO_interested();
*/else if ( $URL->Match('/DO\/Post\/(\d+)$/') )
	DO_Post();
/*
else if ( $URL->Match('/DO\/PostStatus\/(\d+)$/') )
	DO_PostStatus();*/

else if ( $URL->Compare(PeddingPosts) )
	DO_PeddingPosts();

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Services Pages
else if ( $URL->Compare(Help) )
	Services(Help);
else if ( $URL->Compare(Privacy) )
	Services(Privacy);

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Profile
else if ( $URL->Compare(Settings) || $URL->Compare(Settings.'/Picture') )
	Profile_Settings(Settings);
	else if ( $URL->Compare(Settings.'/Name') )
		Profile_Settings(Settings.'/Name');
	else if ( $URL->Compare(Settings.'/Phone') )
		Profile_Settings(Settings.'/Phone');
	else if ( $URL->Compare(Settings.'/Password') )
		Profile_Settings(Settings.'/Password');
	else if ( $URL->Compare(Settings.'/DeActivate') )
		Profile_Settings(Settings.'/DeActivate');
	else if ( $URL->Compare(Settings.'/Address') )
		Profile_Settings(Settings.'/Address');

else if ( $URL->Match('/Profile\/User\/(\d+)$/') )
	Profile_User();

else if ( $URL->Compare(MyProfile) )
	Profile_MyProfile(1);

	else if ( $URL->Compare(MyProfile.'/PeddingPosts') )
	Profile_MyProfile(2);

	else if ( $URL->Compare(MyProfile.'/RejectedPosts') )
	Profile_MyProfile(3);

	else if ( $URL->Compare(MyProfile.'/ApprovedPosts') )
	Profile_MyProfile(4);

else if ( $URL->Match('/Profile\/EditPost\/(\d+)$/') )
	Profile_EditPost();

else if ( $URL->Compare(Messages) )
	Redirect(Messages_Inbox);
	else if ( $URL->Compare(Messages_Inbox) )
		Profile_Messages_Inbox();
	else if ( $URL->Compare(Messages_Sent) )
		Profile_Messages_Sent();
else if ( $URL->Match('/Profile\/Message\/(\d+)$/') )
	Profile_Message();

else if ( $URL->Compare(Notifications) )
	Profile_Notifications();

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Admin
else if ( $URL->Match('/Admin\/AdminDeletePost\/(\d+)$/') )
	Admin_AdminDeletePost();

else if ( $URL->Match('/Admin\/AdminAcceptPost\/(\d+)$/') )
	Admin_AdminAcceptPost();

else if ( $URL->Match('/Admin\/AdminRejectPost\/(\d+)$/') )
	Admin_AdminRejectPost();

else if ( $URL->Match('/Admin\/AdminDeleteAccount\/(\d+)$/') )
	Admin_AdminDeleteAccount();

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Beck End Pages
else if ( $URL->Compare(CheckPage) )
	BackEnd(CheckPage);
else if ( $URL->Compare(DeletePostPage) )
	BackEnd(DeletePostPage);
/*else if ( $URL->Compare(MakeCommentPage) )
	BackEnd(MakeCommentPage);
else if ( $URL->Compare(MakeLike_DisLikePage) )
	BackEnd(MakeLike_DisLikePage);
*/else if ( $URL->Compare(LogOut) )
	BackEnd(LogOut);
else if ( $URL->Compare(MakeMessage) )
	BackEnd(MakeMessage);
else if ( $URL->Compare(DeleteMessage) )
	BackEnd(DeleteMessage);

//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////

// Else
else
	StatusPages_Not_Found_Page();