<?php

function Error_Handeler($Error_Level, $Error_Message, $Error_File, $Error_Line) {
?>
    <!DOCTYPE>
    <html>
    <head>
        <title>Error in Loading</title>
    </head>
    <body>
        <p>Error Title = Error in Loading Page</p>
        <p>Error Discription = Something Goes Wrong</p>
        <p>Error Line = <?php echo $Error_Line; ?></p>
        <p>Error Message = <?php echo $Error_Message;?></p>
<?php
        $POS = strrpos($Error_File, "\\");
        if ( $POS !== false ){
?>              <p>Error File = <?php echo substr($Error_File, $POS+1); ?></p>
<?php
        }
        Debug(false);
?>
    </body>
    </html>
<?php
    exit();
}

set_error_handler("Error_Handeler");

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

define('ROOT', $_SERVER['DOCUMENT_ROOT']);
define('HTTP_ROOT', 'http://findhouse.com');

	define('Public_ROOT', ROOT.'/Public/');
	define('Public_HTTP', HTTP_ROOT.'/Public/');

	define('Resources', ROOT.'/Resources/');
		
		define('Library', Resources.'Library/');

		define('Templates', Resources.'Templates/');

	define('Views', ROOT.'/Views/');

	define('Uploads_ROOT', ROOT.'/Uploads/');
	define('Uploads_HTTP', HTTP_ROOT.'/Uploads/');

//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////

// PHP Library Folder

	// Pages Functions
	define('PagesPHP', Library.'PagesPHP/');


	// Classes
	define('Classes', Library.'Classes/');

		define('MySqlDB', Classes.'/DataBases/MySqlDB.php');
		define('MongoDB', Classes.'/DataBases/MongoDB.php');
		define('MongoDBAutoload', Classes.'/DataBases/MongoDBFile/vendor/autoload.php');

		define('PHPMailClass', Classes.'Mails/PHPMailClass.php');
		define('HashClass', Classes.'Hashing.php');
		define('DATE', Classes.'DATE.php');
		define('JSON', Classes.'JSON.php');
		define('FILTERS', Classes.'FILTERS.php');
		define('PageStatus', Classes.'PagesStatus.php');
		define('URL', Classes.'URL.php');
		define('Session', Classes.'Session.php');

	
	// Global Functions
	define('Global_Fun_PHP', Library.'GlobalFunctions/');
		
		define('CheckUser', Global_Fun_PHP.'CheckUser.php');
		define('CheckToken', Global_Fun_PHP.'CheckToken.php');
		define('OpenSession', Global_Fun_PHP.'OpenSession.php');
		define('ChangePassword', Global_Fun_PHP.'ChangePassword.php');
		define('Files', Global_Fun_PHP.'Files.php');

		define('CheckAcount', Global_Fun_PHP.'CheckAcount.php');


/////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////


// Templates

	//Headers
	define('Headers', Templates.'Headers/');
		// Small Headers
		define('BasicHeaders', Headers.'BasicHeaders/');

		define('NavBar', BasicHeaders.'NavBar.php');
		define('Notifications_Header', BasicHeaders.'Notifications_Header.php');
		
		define('UserHeader', BasicHeaders.'User.php');
		define('UserNotLoggedHeader', BasicHeaders.'UserNotLogged.php');

		// Big Headers
		define('NotLoggedHeaders', Headers.'NotLoggedHeaders.php');
		define('LoggedHeaders', Headers.'LoggedHeaders.php');
		define('AllHeaders', Headers.'AllHeaders.php');
		
	// Footer
	define('Footer', Templates.'Footer.php');

	// Message Boxs
	define('MessageBox', Templates.'MessageBoxs/MessageBox.php');

	// Page Status
	define('StatusPages', Templates.'StatusPages/');
		define('ClosedPage', StatusPages.'ClosedPage.php');
		define('CanNotAccessNowPage', StatusPages.'CanNotAccessNowPage.php');
		
		define('UnAuthurithedUserPage', StatusPages.'UnAuthurithedUserPage.php');
		
		define('LogOutPage', StatusPages.'LogOutPage.php');

		define('ErrorPage', StatusPages.'ErrorPage.php');

		define('NotFoundPage', StatusPages.'404.php');


	// Pages
		// Register
		define('Register_Templates', Templates.'Register/');
			define('SignUP_Template', Register_Templates.'SignUP_Template.php');
			define('SuccessSignUP_Template',
						Register_Templates.'SuccessSignUP_Template.php');
			define('ConfirmUser_Template',
						Register_Templates.'ConfirmUser_Template.php');

			define('Login_Template', Register_Templates.'Login_Template.php');
			define('ForgetPassword_Template',
						Register_Templates.'ForgetPassword_Template.php');
			define('ReSetPassword_Template',
						Register_Templates.'ReSetPassword_Template.php');

		// DO
		define('DO_Templates', Templates.'DO/');
			define('Find_Template', DO_Templates.'Find_Template.php');
			define('Advertise_Template', DO_Templates.'Advertise_Template.php');
			define('Predict_Template', DO_Templates.'Predict_Template.php');
			define('interested_Template', DO_Templates.'interested_Template.php');
			define('Post_Template', DO_Templates.'Post_Template.php');			


		// Services
		define('Services_Templates', Templates.'Services/');
			define('Help_Template', Services_Templates.'Help_Template.php');
			define('Privacy_Template', Services_Templates.'Privacy_Template.php');


		// Profile
		define('Profile_Templates', Templates.'Profile/');
			define('Settings_Template', Profile_Templates.'Settings_Template.php');
			define('User_Template', Profile_Templates.'User_Template.php');
			define('MyProfile_Template', Profile_Templates.'MyProfile_Template.php');
			define('Notifications_Template',
						Profile_Templates.'Notifications_Template.php');


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Back End Pages
	define('BackEnd', Resources.'BackEndPages/');
		
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Views
	// Register
	define('Register_View', Views.'Register/');
		define('SignUP_View', Register_View.'SignUP_View.php');
		define('SuccessSignUP_View', Register_View.'SuccessSignUP_View.php');
		define('ConfirmUser_View', Register_View.'ConfirmUser_View.php');

		define('Login_View', Register_View.'Login_View.php');
		define('ForgetPassword_View', Register_View.'ForgetPassword_View.php');
		define('ReSetPassword_View', Register_View.'ReSetPassword_View.php');


	// DO
	define('DO_View', Views.'DO/');
		define('Find_View', DO_View.'Find_View.php');
		define('Advertise_View', DO_View.'Advertise_View.php');
		define('Predict_View', DO_View.'Predict_View.php');
		define('interested_View', DO_View.'interested_View.php');
		define('Post_View', DO_View.'Post_View.php');


	// Services
	define('Services_View', Views.'Services_View.php');


	// Profile
	define('Profile_View', Views.'Profile/');
		define('Settings_View', Profile_View.'Settings_View.php');
		define('User_View', Profile_View.'User_View.php');
		define('MyProfile_View', Profile_View.'MyProfile_View.php');
		define('Notifications_View', Profile_View.'Notifications_View.php');


	// Back End Pages
	define('BackEnd_View', Views.'BackEnd_View.php');
	

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Pages HTTP Requestes
	// Register
	define('Register_HTTP', HTTP_ROOT.'/Register/');
		define('SignUP', Register_HTTP.'SignUP');
		define('SuccessSignUP', Register_HTTP.'SuccessSignUP');
		define('ConfirmUser', Register_HTTP.'ConfirmUser');

		define('Login', Register_HTTP.'Login');
		define('ForgetPassword', Register_HTTP.'ForgetPassword');
		define('ReSetPassword', Register_HTTP.'ReSetPassword');


	// DO
	define('DO_HTTP', HTTP_ROOT.'/DO/');
		define('Find', DO_HTTP.'Find');
		define('Advertise', DO_HTTP.'Advertise');
		define('Predict', DO_HTTP.'Predict');
		define('interested', DO_HTTP.'interested');
		define('Post', DO_HTTP.'Post/');


	// Services
	define('Services_HTTP', HTTP_ROOT.'/Services/');
		define('Help', Services_HTTP.'Help');
		define('Privacy', Services_HTTP.'Privacy');

		define('AboutMe', Services_HTTP.'AboutMe');


	// Profile
	define('Profile_HTTP', HTTP_ROOT.'/Profile/');
		define('Settings', Profile_HTTP.'Settings');
		define('User', Profile_HTTP.'User/');
		define('MyProfile', Profile_HTTP.'MyProfile');
		define('Notifications', Profile_HTTP.'Notifications');


	// Back End Page
	define('BackEnd_HTTP', HTTP_ROOT.'/BackEnd/');
		define('CheckPage', BackEnd_HTTP.'CheckPage');
		define('LogOut', BackEnd_HTTP.'LogOut');
		define('DeletePostPage', BackEnd_HTTP.'DeletePost');
		define('MakeCommentPage', BackEnd_HTTP.'MakeComment');
		define('MakeLike_DisLikePage', BackEnd_HTTP.'MakeLike-DisLike');
		
		

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// CSS Folder 
define('CSS', Public_HTTP.'CSS/');
	
	define('MainCSS', CSS.'MainCSS/');

		define('AllPagesCSS', MainCSS.'AllPagesCSS.CSS');
		define('BootStrapCSS', MainCSS.'MainBootstrap');


	define('PagesCSS', CSS.'PagesCSS/');

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Picture Folder
define('Pictures', Public_HTTP.'Pictures/');

	define('UserPictures', Uploads_ROOT.'UserPictures/');
	define('UserPictures_HTTP', Uploads_HTTP.'UserPictures/');
	
	// Main Pictures
	define('LOGO', Pictures.'LOGO.JPG');
	define('Housing', Pictures.'Housing.PNG');
	define('OfflineUsers', Pictures.'OfflineUser.PNG');
	define('OnlineUser', Pictures.'OnlineUser.PNG');
	define('AddPicture', Pictures.'AddPicture.PNG');
	define('NoNotification', Pictures.'NoNotification.PNG');
	define('Notification', Pictures.'Notification.PNG');
	define('Send', Pictures.'Send.PNG');
	


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// JavaScript Folder
define('JavaScript', Public_HTTP.'JavaScript/');
	
	// Main Scripts
	define('MainScripts', JavaScript.'MainScripts/');
		
		define('JQueryScript', MainScripts.'jquery-3.3.1.js');
		define('JQueryCookieScript', MainScripts.'js.cookie.js');
		define('DropBoxScript', MainScripts.'BodyLoadScript.js');
		define('SetCookieScript', MainScripts.'SetCookie.js');


	// Global Functions
	define('Global_Fun_Scripts', JavaScript.'GlobalFunctions/');

		define('CheckLenScript', Global_Fun_Scripts.'CheckLen.js');
		define('CheckinputLenScript', Global_Fun_Scripts.'CheckinputLen.js');

		define('CheckMinMaxScript', Global_Fun_Scripts.'CheckMinMax.js');
		define('CheckDataLenAndNumberScript',
				Global_Fun_Scripts.'CheckDataLenAndNumber.js');

		define('CheckPatternScript', Global_Fun_Scripts.'CheckPattern.js');

		define('CheckPasswordScript', Global_Fun_Scripts.'CheckPassword.js');

		define('isNumberScript', Global_Fun_Scripts.'isNumber.js');
		define('CheckinputLenAndNumberScript',
				Global_Fun_Scripts.'CheckinputLenAndNumber.js');

		define('AddPictureScript', Global_Fun_Scripts.'AddPicture.js');

		define('CheckNameScript', Global_Fun_Scripts.'CheckName.js');

		define('TriggerFormScript', Global_Fun_Scripts.'TriggerForm.js');
		
		define('TriggerMessageScript', Global_Fun_Scripts.'TriggerMessage.js');
		define('SetError_FunctionScript',
				Global_Fun_Scripts.'SetError_Function.js');
		
	
	// Pages Scripts
	define('PagesScripts', JavaScript.'PagesScripts/');


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// Length

// Register
define('Email_Len', 100);	// 200 character 
define('Password_Len', 40); // 100
define('Name_Len', 40);		// 100
define('Phone_Len', 11);	// 20
define('Token_Len', 20);	// 100

// DO
define('Address_Len', 150); // 200

define('Area_Len', 5);		// 20

define('Status_Len', 10);	// 20
define('Type_Len', 10);		// 30
define('Furnished_Len',10);	// 10

define('Storey_Len', 2);	// 5
define('Rooms_Len', 1);		// 5

define('Money_Len', 11);	// 20

define('Discreption_Len', 500);	// 600

// Picture Size in Bytes
define('Picture_Len', 2097152);

define('Page_Len', 3);

// My Profile
define('ID_Len', 7);

// Post
define('Comment_Len', 500);

/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// DataBase info

define('DBLanguage', 'mysql');

define('Host', 'localhost');

define('DBName', 'findhouse');

define('UserName', 'root');
//define('UserName', 'Session')
//define('UserName', 'BackEnd');
//define('UserName', 'Register');
//define('UserName', 'Token');
//define('UserName', 'DO');
//define('UserName', 'Settings');
//define('UserName', 'Profile');
define('Passwords', '');


/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////

// SuperGlobal Functions

// Error Function
function Error($ErrorType, $ErrorCode, $ErrorMessage){
	return (object)[
		'Error Type' => $ErrorType,
		'Error Code' => $ErrorCode,
		'Error Message' => $ErrorMessage
	];
}

// Returns Function
function Returns($Result, $Data = '', $Error = ''){
	return (object)[
		'Result' => $Result,
		'Data' => $Data,
		'Error' => $Error
	];
}

// Debug Function
function Debug($DoExit = false, $Object = ''){
	var_dump($Object);
	echo '__________________________________________________________________________';
	var_dump( debug_backtrace() );
	if ( $DoExit == true )
		exit();
}

// Redirect Function
function Redirect($URL){
	header("Location:".$URL);
	exit();
}

// Check Session is Set OR NOT
function SESSION(){
	return (isset($_SESSION['Name']))?true:false;
}

function RESET_GLOBAL_Variables(){
	$_POST = array();
	$_GET = array();
	$_FILES = array();
}

function RESET_SESSION($PageName = ''){
	$_SESSION = array();
	$_SESSION['Page Name'] = $PageName;
}
?>