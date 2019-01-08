<?php
if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.i';
else
    $GLOBALS['Page_API_Error_Code'] = 'i';
set_error_handler("Error_Handeler");

function Error_Handeler($Error_Level, $Error_Message, $Error_File, $Error_Line) {
    ?>
    <!DOCTYPE>
    <html>
    <head>
        <title>Error in Loading</title>
    </head>
    <body>
        <p>Error Title = Error in Loading Page</p>
        <p>Page API Error Code = <?php echo $GLOBALS['Page_API_Error_Code'];?></p>
        <p>Error Discription = Something Goes Wrong</p>
        <p>Error Line = <?php echo $Error_Line; ?></p>
        <p>Error Message = <?php echo $Error_Message;?></p>
            
<?php
        $POS = strrpos($Error_File, "\\");
        if ( $POS !== false ){
?>              <p>Error File = <?php echo substr($Error_File, $POS+1); ?></p>
<?php
        }
?>
    </body>
    </html>
<?php
    exit();
}

define('ROOT', $_SERVER['DOCUMENT_ROOT'].'/findhouse.com');
define('HTTP_ROOT', 'http://localhost/findhouse.com');

// PHP Folders
	// Functions
	define('PHP', ROOT.'/PHP/');
		// Pages Functions
		
			// Log In Directory
			define('Log_Dir_PHP', PHP.'LogIn/');

			// Sign UP Directory
			define('Sign_Dir_PHP', PHP.'SignUP/');

			// Main
			define('Main_Dir_PHP', PHP.'Main/');

			// Advertise Directory
			define('Ad_Dir_PHP', PHP.'Advertise/');

			// interested Directory
			define('interested_Dir_PHP', PHP.'interested/');

			// Sittings
			define('Sittings_Dir_PHP', PHP.'Sittings/');

			// Profile
			define('Profile_Dir_PHP', PHP.'Profile/');

			// Privacy Policy
			define('Policy_Dir_PHP', PHP.'Policy/');

			// Help
			define('Help_Dir_PHP', PHP.'Help/');

	// Data Bases
	define('MySqlDB', ROOT.'/DataBases/MySqlDB.php');
	define('MongoDB', ROOT.'/DataBases/MongoDB.php');

	// Mail Class
	define('PHPMailClass', PHP.'Mails/PHPMailClass.php');

	// Hashing Class
	define('HashClass', PHP.'Hashing.php');

	// Date Class
	define('DATE', PHP.'DATE.php');

	// JSON Class
	define('JSON', PHP.'JSON.php');

	// FILTERS Class
	define('FILTERS', PHP.'FILTERS.php');

	// Pages Status Class
	define('PageStatus', PHP.'PagesStatus.php');

	// URL Class
	define('URL', PHP.'URL.php');

	// Session Class
	define('Session', PHP.'Session.php');

	// Global Functions
	define('Global_Fun_PHP', PHP.'GlobalFunctions/');
		// Check User Found Or Not
		define('CheckUser', Global_Fun_PHP.'CheckUser.php');
		// Check Acount
		define('CheckAcount', Global_Fun_PHP.'CheckAcount.php');
		// Check Token
		define('CheckToken', Global_Fun_PHP.'CheckToken.php');
		// Change Password
		define('ChangePassword', Global_Fun_PHP.'ChangePassword.php');
		// Open Session
		define('OpenSession', Global_Fun_PHP.'OpenSession.php');
		// Operations With Files
		define('Files', Global_Fun_PHP.'Files.php');

// Layouts
	// Layouts
	define('Layout_HTTP', 'http://localhost/findhouse.com/Layout/');
	define('Layout_ROOT', ROOT.'/Layout/');

	//Headers
	define('Headers', Layout_ROOT.'Headers/');
		// Small Headers
		define('BasicHeaders', Headers.'BasicHeaders/');

		define('NavBar', BasicHeaders.'NavBar.php');
		define('UserHeader', BasicHeaders.'UserHeader.php');
		define('Waiting_UserHeader', BasicHeaders.'Waiting_UserHeader.php');
		define('UserNotLoggedHeader', BasicHeaders.'UserNotLoggedHeader.php');

		// Big Headers
		define('NotLoggedHeaders', Headers.'NotLoggedHeaders.php');
		define('LoggedHeaders', Headers.'LoggedHeaders.php');
		define('AllHeaders', Headers.'AllHeaders.php');
		
	// Footer
	define('Footer', Layout_ROOT.'Footers/Footer.php');

	// Message Boxs
	define('MessageBox', Layout_ROOT.'MessageBoxs/MessageBox.php');
	define('TrigerMessage', Layout_ROOT.'MessageBoxs/TrigerMessage.php');

	// Page Status
	define('ClosedPage', Layout_ROOT.'PageStatus/ClosedPage.php');
	define('UnAuthurithedUser', Layout_ROOT.'PageStatus/UnAuthurithedUser.php');
	define('LogOutPage', Layout_ROOT.'PageStatus/LogOutPage.php');
	define('CanNotAccessNow', Layout_ROOT.'PageStatus/CanNotAccessNow.php');
	define('ErrorPage', Layout_ROOT.'PageStatus/ErrorPage.php');

	// SimiPages
	define('SimiPages', Layout_HTTP.'SimiPages/');
		// Check User
		define('Check', SimiPages.'Check.php');

	// Pages
		// Log Out User
		define('LogOutUser', Layout_HTTP.'LogOutUser.php');

		// LOG in Page
		define('Log_Dir_Layout', Layout_HTTP.'LogIn/');
		define('LogIn', Log_Dir_Layout.'LogIn.php');
		define('Forget', Log_Dir_Layout.'Forget.php');
		define('NewPassword', Log_Dir_Layout.'NewPassword.php');

		// Sign UP Page
		define('Sign_Dir_Layout', Layout_HTTP.'SignUP/');
		define('SignUP', Sign_Dir_Layout.'SignUP.php');
		define('SuccessSignUP', Sign_Dir_Layout.'SuccessSignUP.php');
		define('ConfirmUser', Sign_Dir_Layout.'ConfirmUser.php');

		// Main Page
		define('Main_Dir_Layout', Layout_HTTP.'Main/');
		define('MainPage', Layout_HTTP.'Main/Main.php');

		// Advertise Page
		define('Ad_Dir_Layout', Layout_HTTP.'Advertise/');
		define('Advertise', Layout_HTTP.'Advertise/Advertise.php');

		// interested in Page
		define('interested_Dir_Layout', Layout_HTTP.'interested/');
		define('interested', Layout_HTTP.'interested/interested.php');

		// Sittings Page
		define('Sittings_Dir_Layout', Layout_ROOT.'Sittings/');
		define('Sittings', Layout_HTTP.'Sittings/Sittings.php');

		// Profile Page
		define('Profile_Dir_Layout', Layout_HTTP.'Profile/');
		define('Profile', Layout_HTTP.'Profile/Profile.php');

		// Policy Page
		define('Policy_Dir_Layout', Layout_HTTP.'Policy/');
		define('Policy', Layout_HTTP.'Policy/Policy.php');

		// Help Page
		define('Help_Dir_Layout', Layout_HTTP.'Help/');
		define('Help', Layout_HTTP.'Help/Help.php');


// CSS Folder 
define('HeaderCSS', 'http://localhost/findhouse.com/CSS/Header.CSS');
define('CenterCSS', 'http://localhost/findhouse.com/CSS/Center.CSS');
define('FooterCSS', 'http://localhost/findhouse.com/CSS/Footer.CSS');

// Picture Folder
define('Pictures', HTTP_ROOT.'/Pictures/');
define('UserPictures', Pictures.'UserPictures/');

define('UserPicturesFolder', ROOT.'/Pictures/UserPictures/');
	
	// Main Pictures
	define('LOGO', Pictures.'LOGO.PNG');
	define('OfflineUsers', Pictures.'Sleeping.JPG');
	define('DefultPicture', Pictures.'ProfilePicture.JPG');
	define('AddPicture', Pictures.'AddPicture.PNG');
	define('NoNotification', Pictures.'NoNotification.PNG');
	define('Notification', Pictures.'Notification.PNG');

// JavaScript Folder
define('JavaScript', 'http://localhost/findhouse.com/JavaScript/');

	// important functions
	define('JQueryScript', JavaScript.'jquery-3.3.1.js');
	define('JQueryCookieScript', JavaScript.'js.cookie.js');
	define('DropBoxScript', JavaScript.'DropBox.js');
	define('SetCookieScript', JavaScript.'SetCookie.js');

	// Global Functions
	define('Global_Fun_Scripts', JavaScript.'GlobalFunctions/');
		define('CheckLenScript', Global_Fun_Scripts.'CheckLen.js');
		define('CheckPatternScript', Global_Fun_Scripts.'CheckPattern.js');
		define('CheckNumberOrNotScript', Global_Fun_Scripts.'CheckNumberOrNot.js');
		define('ConfirmPasswordScript', Global_Fun_Scripts.'ConfirmPassword.js');
		define('SetMessageBoxScript', Global_Fun_Scripts.'SetMessageBox.js');
		define('AddPictureScript', Global_Fun_Scripts.'AddPicture.js');
		define('CheckNameScript', Global_Fun_Scripts.'CheckName.js');
		define('CheckinputLenScript', Global_Fun_Scripts.'CheckinputLen.js');
		define('TriggerFormScript', Global_Fun_Scripts.'TriggerForm.js');
		define('CheckinputLenAndNumberScript',
				Global_Fun_Scripts.'CheckinputLenAndNumber.js');
		
	
	// Pages Scripts
	// Log in Script Dir
	define('Log_Dir_Script', JavaScript.'LogIn/');

	// Sign UP Script Dir
	define('Sign_Dir_Script', JavaScript.'SignUP/');

	// Main Script Dir
	define('Main_Dir_Script', JavaScript.'Main/');

	// Advertise Script Dir
	define('Ad_Dir_Script', JavaScript.'Advertise/');

	// interested Script Dir
	define('interested_Dir_Script', JavaScript.'interested/');

	// Sittings Script Dir
	define('Sittings_Dir_Script', JavaScript.'Sittings/');

	// Profile Script Dir
	define('Profile_Dir_Script', JavaScript.'Profile/');

	// Policy Script Dir
	define('Policy_Dir_Script', JavaScript.'Policy/');

	// Help Script Dir
	define('Help_Dir_Script', JavaScript.'Help/');

// Length
	/*
			
	*/
	// Log And SignUP Length
	define('Email_Len', 100);	// 200 character 
	define('Password_Len', 40); // 100
	define('Name_Len', 40);		// 100
	define('Phone_Len', 11);	// 20
	define('Token_Len', 20);	// 100

	// Advertise Length
	define('Governor_Len', 25);	// 50
	define('Station_Len', 25);	// 50
	define('Distruct_Len', 30);	// 50
	define('Street_Len', 150);	// 200

	define('Status_Len', 10);	// 20
	define('Type_Len', 20);		// 30
	define('Furnished_Len', 3);	// 10

	define('Area_Len', 11);		// 20
	define('Storey_Len', 2);	// 5
	define('Rooms_Len', 1);		// 5
	define('PathRooms_Len', 1);	// 5
	define('Money_Len', 10);	// 20

	define('Discreption_Len', 500);	// 600

	// Picture Size in Bytes
	define('Picture_Len', 2097152);	// 

// Error Object Functions
function ObjectErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
    $GLOBALS['Error']['Error Location'] = $ErrorLocation;
    $GLOBALS['Error']['Error Code'] = $ErrorCode;
    $GLOBALS['Error']['Error Message'] = $ErrorMessage;
    return $GLOBALS['Error'];
}
?>