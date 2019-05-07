<?php

namespace SiteEngines;
use Core\RenderEngine;

class SiteRenderEngine extends RenderEngine{
	
	function __construct(){
		$this->Register_Static_Data([

			// Head Values
			'PagesCSS' => PagesCSS,
			'AllPagesCSS' => AllPagesCSS,
			'LOGO' => LOGO,

			'JQueryScript' => JQueryScript,
			'DropBoxScript' => DropBoxScript,
			'PagesScripts' => PagesScripts,

			// Header Values
			'Find' => Find,
			'Advertise' => Advertise,
			'NoNotification' => NoNotification,
			'Notifications' => Notifications,
			'OnLineUser' => ( SESSION() ) ? $_SESSION['Picture'] : '',
			'OffLineUser' => OffLineUser,

			'SESSION_NAME' => ( SESSION() ) ? $_SESSION['Name'] : '',
			'SESSION_POSTS_NUMBER' => ( SESSION() ) ? $_SESSION['Posts'] : '',
			'Messages_Inbox' => Messages_Inbox,
			'MyProfile' => MyProfile,
			'PeddingPosts' => PeddingPosts,
			'Settings' => Settings,
			'LogOut' => LogOut,
			'Login' => Login,
			'SignUP' => SignUP,

			'ISSET' => ( SESSION() ) ? True : False,
			'UserStatus' => ( SESSION() ) ? $_SESSION['Status'] : '',

			// Footer
			'Help' => Help,
			'Privacy' => Policy,


			/*	Head Area 	*/
			//'Head_Title' => '',
			'Head_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'Head_Style' => 'http://lookandsee.com/Public/rehomes/style.css',


			/*	Header Area 	*/

			'Header_Top_Email_URL' => '',
			'Header_Top_Email' => 'omnia.moh1195@gmail.com',
			'Header_Top_Phone_URL' => '',
			'Header_Top_Phone' => '(12) 345 6789',


			'Header_FaceBook' => '',
			'Header_Twitter' => '',
			'Header_Instagram' => '',
			'Header_Linkedin' => '',
			
				/*	Not Logged User 	*/
				'Header_LOGO_URL' => 'http://lookandsee.com/DO/Find/Homes',
				'Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

				'Header_Login' => Login,


				/*	Logged User 	*/
				'Header_MyProfile' => MyProfile,
				'Header_Advertise' => Advertise,
				'Header_Notifications' => Notifications,
				'Header_MyMessages' => Messages,
				'Header_PeddingPosts' => PeddingPosts,
				'Header_Settings' => Settings,
				'Header_LogOut' => LogOut,
				
				'Header_User_Picture' => ( SESSION() ) ? $_SESSION['Picture'] : '',


			/*	Partner Area 	*/
			'Partner_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/6.png',


			/* 	Footer Area 	*/
			'Footer_BackGround' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'Footer_Homes' => '',
			'Footer_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'Footer_Site_FaceBook' => '',
			'Footer_Site_Twitter' => '',
			'Footer_Site_Instagram' => '',
			'Footer_Site_Linkedin' => '',

			'Footer_Contact_Phone' => '01030968959',
			'Footer_Contact_Email' => 'omnia.moh1195@gmail.com',
			'Footer_Contact_Address' => 'Assuit, ElaZhar, Elnasr',

			'Footer_Notification_Form_URL' =>
				'http://lookandsee.com/Services/RegisterNotifications',

			'Footer_Copy_Write_Email' => 'https://www.facebook.com/M.Magdi.aboelsoud',
			'Footer_Copy_Write_Name' => 'mohammed',

			'Footer_Home' => 'http://lookandsee.com/DO/Find/Homes',
			'Footer_About' => 'http://lookandsee.com/Services/AboutUS',
			'Footer_Contact' => 'http://lookandsee.com/Services/ContactUS',


			/*	JS Files 	*/
			'SCRIPTS_Min_JQuery' =>
				'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' =>
				'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' =>
				'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' =>
				'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' =>
				'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// Register Pages

	function SignUP_Render($Result = '', $Form = ''){
		/*return $this->Render('Register/SignUP.html', [
			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckPasswordScript' => CheckPasswordScript,
			'CheckPatternScript' => CheckPatternScript,

			'CheckPhoneScript' => CheckPhoneScript,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			// Section
			'Name' => ( $Form != '' ) ? $Form->FILTERED_DATA['Name'] : '',
			'Email' => ( $Form != '' ) ? $Form->FILTERED_DATA['Email'] : '',
			'Phone' => ( $Form != '' ) ? $Form->FILTERED_DATA['Phone'] : '',

			// Script
			'Result' => $Result,
			'CheckPage' => CheckPage,
			'Name_Len' => Name_Len,
			'Email_Len' => Email_Len,
			'Phone_Len' => Phone_Len,
			'Password_Len' => Password_Len
		]);*/
		return $this->Render('Register/SignUP_Template.html', [

			/* HEAD AREA */
			'HEAD_Title' => 'انشاء حساب جديد',

			'HEAD_Favicon' => 'http://lookandsee.com/Public/Rehomes/images/icons/favicon.ico',

			'HEAD_Bootstrap_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/css/bootstrap.min.css',

			'HEAD_Fonts_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/font-awesome-4.7.0/css/font-awesome.min.css',

			'HEAD_Fonts_Iconic_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/iconic/css/material-design-iconic-font.min.css',

			'HEAD_Animate_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animate/animate.css',

			'HEAD_Hamburger_Min_CSS' => 'http://lookandsee.com/Public/Rehomes/vendor/css-hamburgers/hamburgers.min.css',

			'HEAD_Animsition_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/css/animsition.min.css',

			'HEAD_Select2_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.css',

			'HEAD_Daterangepicker_CSS' =>
			'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.css',

			
			'HEAD_Util_CSS' => 'http://lookandsee.com/Public/Rehomes/css/util.css',
			'HEAD_Main_CSS' => 'http://lookandsee.com/Public/Rehomes/css/main.css',
			
			'HEAD_Style_CSS' => 'http://lookandsee.com/Public/Rehomes/style.css',

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckPasswordScript' => CheckPasswordScript,
			'CheckPatternScript' => CheckPatternScript,

			'CheckPhoneScript' => CheckPhoneScript,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,


			/* 		HEADER AREA 	*/
			'HEADER_HOME' => '',
			'HEADER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo.png',
			'HEADER_About' => '',
			'HEADER_Contact' => '',


			/* 		Form AREA 	*/
			'Form_Image' => 'http://lookandsee.com/Public/Rehomes/images/bg-01.jpg',
			'SignUP' => SignUP,
			'Name' => ( $Form != '' ) ? $Form->FILTERED_DATA['Name'] : '',
			'Email' => ( $Form != '' ) ? $Form->FILTERED_DATA['Email'] : '',
			'Phone' => ( $Form != '' ) ? $Form->FILTERED_DATA['Phone'] : '',

			/* 		Footer AREA 	*/
			'FOOTER_Image' => 'http://lookandsee.com/Public/Rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo-2.png',

			/* 		JS AREA 	*/
			'JS_JQUERY_Min' => 'http://lookandsee.com/Public/Rehomes/js/jquery.min.js',
			'JS_Proper_Min' => 'http://lookandsee.com/Public/Rehomes/js/popper.min.js',
			'JS_Bootstrap_Min' => 'http://lookandsee.com/Public/Rehomes/js/bootstrap.min.js',
			'JS_Bundle' => 'http://lookandsee.com/Public/Rehomes/js/rehomes.bundle.js',
			'JS_Assest' => 'http://lookandsee.com/Public/Rehomes/js/default-assets/active.js',

			'JS_JQUERY_Min_3_2_1' =>
				'http://lookandsee.com/Public/Rehomes/vendor/jquery/jquery-3.2.1.min.js',
			'JS_Animsition_Min' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/js/animsition.min.js',

			'JS_Proper' =>
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/popper.js',
			'JS_Bootstrap_Min_Vendor' => 
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/bootstrap.min.js',
			'JS_Select2' => 'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.js',
			'JS_Moment' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/moment.min.js',
			'JS_Daterangepicker' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.js',
			'JS_CountDownTime' =>
				'http://lookandsee.com/Public/Rehomes/vendor/countdowntime/countdowntime.js',
			'JS_Main' => 'http://lookandsee.com/Public/Rehomes/js/main.js',


			/* 		Script AREA 	*/
			'Result' => $Result,
			'CheckPage' => CheckPage,
			'Name_Len' => Name_Len,
			'Email_Len' => Email_Len,
			'Phone_Len' => Phone_Len,
			'Password_Len' => Password_Len
		]);
	}

	function SuccessSignUP_Render(){
		//return $this->Render('Register/SuccessSignUP.html', []);
		return $this->Render('Register/SuccessSignUP_Template.html', [
			'Head_Title' => 'Success Sign UP'
		]);
	}

	function ConfirmUser_Render(){
		//return $this->Render('Register/ConfirmUser.html', []);
		return $this->Render('Register/ConfirmUser_Template.html', [
			'Head_Title' => 'Confirm User'
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////

	function Login_Render($Result = '', $Form = ''){
		/*return $this->Render('Register/Login.html', [
			'CheckLenScript' => CheckLenScript,
			'CheckPatternScript' => CheckPatternScript,

			// Section
			'Email' => ( $Form != '' ) ? $Form->FILTERED_DATA['Email'] : '',
			'ForgetPassword' => ForgetPassword,

			// Script
			'Result' => $Result,
			'Email_Len' => Email_Len,
			'Password_Len' => Password_Len
		]);*/
		return $this->Render('Register/Login_Template.html', [

			/* HEAD AREA */
			'HEAD_Title' => 'تسجيل الدخول',

			'HEAD_Favicon' => 'http://lookandsee.com/Public/Rehomes/images/icons/favicon.ico',

			'HEAD_Bootstrap_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/css/bootstrap.min.css',

			'HEAD_Fonts_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/font-awesome-4.7.0/css/font-awesome.min.css',

			'HEAD_Fonts_Iconic_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/iconic/css/material-design-iconic-font.min.css',

			'HEAD_Animate_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animate/animate.css',

			'HEAD_Hamburger_Min_CSS' => 'http://lookandsee.com/Public/Rehomes/vendor/css-hamburgers/hamburgers.min.css',

			'HEAD_Animsition_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/css/animsition.min.css',

			'HEAD_Select2_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.css',

			'HEAD_Daterangepicker_CSS' =>
			'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.css',

			
			'HEAD_Util_CSS' => 'http://lookandsee.com/Public/Rehomes/css/util.css',
			'HEAD_Main_CSS' => 'http://lookandsee.com/Public/Rehomes/css/main.css',
			
			'HEAD_Style_CSS' => 'http://lookandsee.com/Public/Rehomes/style.css',

			'CheckLenScript' => CheckLenScript,
			'CheckPatternScript' => CheckPatternScript,


			/* 		HEADER AREA 	*/
			'HEADER_HOME' => '',
			'HEADER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo.png',
			'HEADER_About' => '',
			'HEADER_Contact' => '',


			/* 		Form AREA 	*/
			'Form_Image' => 'http://lookandsee.com/Public/Rehomes/images/bg-01.jpg',
			'Email' => ( $Form != '' ) ? $Form->FILTERED_DATA['Email'] : '',
			'Login' => Login,
			'SignUP' => SignUP,
			'ForgetPassword' => ForgetPassword,

			/* 		Footer AREA 	*/
			'FOOTER_Image' => 'http://lookandsee.com/Public/Rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo-2.png',

			/* 		JS AREA 	*/
			'JS_JQUERY_Min' => 'http://lookandsee.com/Public/Rehomes/js/jquery.min.js',
			'JS_Proper_Min' => 'http://lookandsee.com/Public/Rehomes/js/popper.min.js',
			'JS_Bootstrap_Min' => 'http://lookandsee.com/Public/Rehomes/js/bootstrap.min.js',
			'JS_Bundle' => 'http://lookandsee.com/Public/Rehomes/js/rehomes.bundle.js',
			'JS_Assest' => 'http://lookandsee.com/Public/Rehomes/js/default-assets/active.js',

			'JS_JQUERY_Min_3_2_1' =>
				'http://lookandsee.com/Public/Rehomes/vendor/jquery/jquery-3.2.1.min.js',
			'JS_Animsition_Min' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/js/animsition.min.js',

			'JS_Proper' =>
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/popper.js',
			'JS_Bootstrap_Min_Vendor' => 
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/bootstrap.min.js',
			'JS_Select2' => 'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.js',
			'JS_Moment' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/moment.min.js',
			'JS_Daterangepicker' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.js',
			'JS_CountDownTime' =>
				'http://lookandsee.com/Public/Rehomes/vendor/countdowntime/countdowntime.js',
			'JS_Main' => 'http://lookandsee.com/Public/Rehomes/js/main.js',


			/* 		Script AREA 	*/
			'Result' => $Result,
			'Email_Len' => Email_Len,
			'Password_Len' => Password_Len
		]);
	}

	function ForgetPassword_Render($Result = '', $Form = ''){
		/*return $this->Render('Register/ForgetPassword.html', [
			'CheckLenScript' => CheckLenScript,
			'CheckPatternScript' => CheckPatternScript,

			// Section
			'Email' => ( $Form != '' ) ? $Form->GetEmail() : '',
			'ForgetPassword' => ForgetPassword,

			// Script
			'Result' => $Result,
			'Email_Len' => Email_Len
		]);*/
		return $this->Render('Register/ForgetPassword_Template.html', [

			/* HEAD AREA */
			'HEAD_Title' => 'اعاده تعيين كلمه السر',

			'HEAD_Favicon' => 'http://lookandsee.com/Public/Rehomes/images/icons/favicon.ico',

			'HEAD_Bootstrap_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/css/bootstrap.min.css',

			'HEAD_Fonts_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/font-awesome-4.7.0/css/font-awesome.min.css',

			'HEAD_Fonts_Iconic_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/iconic/css/material-design-iconic-font.min.css',

			'HEAD_Animate_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animate/animate.css',

			'HEAD_Hamburger_Min_CSS' => 'http://lookandsee.com/Public/Rehomes/vendor/css-hamburgers/hamburgers.min.css',

			'HEAD_Animsition_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/css/animsition.min.css',

			'HEAD_Select2_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.css',

			'HEAD_Daterangepicker_CSS' =>
			'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.css',

			
			'HEAD_Util_CSS' => 'http://lookandsee.com/Public/Rehomes/css/util.css',
			'HEAD_Main_CSS' => 'http://lookandsee.com/Public/Rehomes/css/main.css',
			
			'HEAD_Style_CSS' => 'http://lookandsee.com/Public/Rehomes/style.css',

			'CheckLenScript' => CheckLenScript,
			'CheckPatternScript' => CheckPatternScript,


			/* 		HEADER AREA 	*/
			'HEADER_HOME' => '',
			'HEADER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo.png',
			'HEADER_About' => '',
			'HEADER_Contact' => '',


			/* 		Form AREA 	*/
			'Form_Image' => 'http://lookandsee.com/Public/Rehomes/images/bg-01.jpg',
			'Email' => ( $Form != '' ) ? $Form->GetEmail() : '',
			'ForgetPassword' => ForgetPassword,

			/* 		Footer AREA 	*/
			'FOOTER_Image' => 'http://lookandsee.com/Public/Rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo-2.png',

			/* 		JS AREA 	*/
			'JS_JQUERY_Min' => 'http://lookandsee.com/Public/Rehomes/js/jquery.min.js',
			'JS_Proper_Min' => 'http://lookandsee.com/Public/Rehomes/js/popper.min.js',
			'JS_Bootstrap_Min' => 'http://lookandsee.com/Public/Rehomes/js/bootstrap.min.js',
			'JS_Bundle' => 'http://lookandsee.com/Public/Rehomes/js/rehomes.bundle.js',
			'JS_Assest' => 'http://lookandsee.com/Public/Rehomes/js/default-assets/active.js',

			'JS_JQUERY_Min_3_2_1' =>
				'http://lookandsee.com/Public/Rehomes/vendor/jquery/jquery-3.2.1.min.js',
			'JS_Animsition_Min' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/js/animsition.min.js',

			'JS_Proper' =>
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/popper.js',
			'JS_Bootstrap_Min_Vendor' => 
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/bootstrap.min.js',
			'JS_Select2' => 'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.js',
			'JS_Moment' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/moment.min.js',
			'JS_Daterangepicker' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.js',
			'JS_CountDownTime' =>
				'http://lookandsee.com/Public/Rehomes/vendor/countdowntime/countdowntime.js',
			'JS_Main' => 'http://lookandsee.com/Public/Rehomes/js/main.js',


			/* 		Script AREA 	*/
			'Result' => $Result,
			'Email_Len' => Email_Len
		]);
	}

	function ReSetPassword_Render($Result = '', $Email = '', $Token = ''){
		/*return $this->Render('Register/ReSetPassword.html', [
			'CheckLenScript' => CheckLenScript,
			'CheckPasswordScript' => CheckPasswordScript,

			// Section
			'ReSetPassword' => ReSetPassword,
			'Email' => $Email,
			'Token' => $Token,

			// Script
			'Result' => $Result,
			'Password_Len' => Password_Len
		]);*/

		return $this->Render('Register/ReSetPassword_Template.html', [

			/* HEAD AREA */
			'HEAD_Title' => 'كلمه السر الجديده',

			'HEAD_Favicon' => 'http://lookandsee.com/Public/Rehomes/images/icons/favicon.ico',

			'HEAD_Bootstrap_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/css/bootstrap.min.css',

			'HEAD_Fonts_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/font-awesome-4.7.0/css/font-awesome.min.css',

			'HEAD_Fonts_Iconic_Min_CSS' =>	// DONE
				'http://lookandsee.com/Public/Rehomes/fonts/iconic/css/material-design-iconic-font.min.css',

			'HEAD_Animate_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animate/animate.css',

			'HEAD_Hamburger_Min_CSS' => 'http://lookandsee.com/Public/Rehomes/vendor/css-hamburgers/hamburgers.min.css',

			'HEAD_Animsition_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/css/animsition.min.css',

			'HEAD_Select2_Min_CSS' =>
				'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.css',

			'HEAD_Daterangepicker_CSS' =>
			'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.css',

			
			'HEAD_Util_CSS' => 'http://lookandsee.com/Public/Rehomes/css/util.css',
			'HEAD_Main_CSS' => 'http://lookandsee.com/Public/Rehomes/css/main.css',
			
			'HEAD_Style_CSS' => 'http://lookandsee.com/Public/Rehomes/style.css',

			'CheckLenScript' => CheckLenScript,
			'CheckPasswordScript' => CheckPasswordScript,


			/* 		HEADER AREA 	*/
			'HEADER_HOME' => '',
			'HEADER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo.png',
			'HEADER_About' => '',
			'HEADER_Contact' => '',


			/* 		Form AREA 	*/
			'Form_Image' => 'http://lookandsee.com/Public/Rehomes/images/bg-01.jpg',
			'ReSetPassword' => ReSetPassword,
			'Email' => $Email,
			'Token' => $Token,

			/* 		Footer AREA 	*/
			'FOOTER_Image' => 'http://lookandsee.com/Public/Rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/Rehomes/img/core-img/logo-2.png',

			/* 		JS AREA 	*/
			'JS_JQUERY_Min' => 'http://lookandsee.com/Public/Rehomes/js/jquery.min.js',
			'JS_Proper_Min' => 'http://lookandsee.com/Public/Rehomes/js/popper.min.js',
			'JS_Bootstrap_Min' => 'http://lookandsee.com/Public/Rehomes/js/bootstrap.min.js',
			'JS_Bundle' => 'http://lookandsee.com/Public/Rehomes/js/rehomes.bundle.js',
			'JS_Assest' => 'http://lookandsee.com/Public/Rehomes/js/default-assets/active.js',

			'JS_JQUERY_Min_3_2_1' =>
				'http://lookandsee.com/Public/Rehomes/vendor/jquery/jquery-3.2.1.min.js',
			'JS_Animsition_Min' =>
				'http://lookandsee.com/Public/Rehomes/vendor/animsition/js/animsition.min.js',

			'JS_Proper' =>
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/popper.js',
			'JS_Bootstrap_Min_Vendor' => 
				'http://lookandsee.com/Public/Rehomes/vendor/bootstrap/js/bootstrap.min.js',
			'JS_Select2' => 'http://lookandsee.com/Public/Rehomes/vendor/select2/select2.min.js',
			'JS_Moment' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/moment.min.js',
			'JS_Daterangepicker' =>
				'http://lookandsee.com/Public/Rehomes/vendor/daterangepicker/daterangepicker.js',
			'JS_CountDownTime' =>
				'http://lookandsee.com/Public/Rehomes/vendor/countdowntime/countdowntime.js',
			'JS_Main' => 'http://lookandsee.com/Public/Rehomes/js/main.js',


			/* 		Script AREA 	*/
			'Result' => $Result,
			'Password_Len' => Password_Len
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// DO Pages
	function Advertise_Render(){
		/*return $this->Render('DO/Advertise.html', [
			// Header
			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckDataLenAndNumberScript' => CheckDataLenAndNumberScript,
			'isNumberScript' => isNumberScript,
			'CheckinputLenAndNumberScript' => CheckinputLenAndNumberScript,
			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,
			'TriggerMessageScript' => TriggerMessageScript,

			// Section
			'Address' => $_SESSION['Address'],
			'Phone' => $_SESSION['Phone'],
			'AddPicture' => AddPicture,

			// Script
			'Advertise_Name_Len' => Advertise_Name_Len,
			'Area_Len' => Area_Len,
			'Discreption_Len' => Discreption_Len,
			'Address_Len' => Address_Len,
			'Name_Len' => Name_Len,
			'Money_Len' => Money_Len,
			'Phone_Len' => Phone_Len
		]);*/

		return $this->Render('DO/Advertise_Template.html',[

			/*	Head Area 	*/
			'Head_Title' => 'Advertise',
			'Head_Assest_Style' => 'http://lookandsee.com/Public/New folder/asd/assets/css/styles.css',
			'Head_Assest_Font' =>
				'http://lookandsee.com/Public/New folder/asd/assets/font-awesome/css/font-awesome.css',

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,

			'AddPicture' => AddPicture
		]);

	}

	function Find_Render($Posts){
		return $this->Render('DO/Find.html', [
			// Header
			'CheckLenScript' => CheckLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,

			'isNumberScript' => isNumberScript,
			'CheckinputLenAndNumberScript' => CheckinputLenAndNumberScript,

			'CheckDataLenAndNumberScript' => CheckDataLenAndNumberScript,
			'TriggerFormScript' => TriggerFormScript,

			// Section
			'Posts' => $Posts,

			// Script
			'Area_Len' => Area_Len,
			'Rooms_Len' => Rooms_Len,
			'Storey_Len' => Storey_Len,
			'Money_Len' => Money_Len
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	function Homes_Render(){
		return $this->Render('DO/Find/Homes.html', [

			/*	Head Area 	*/
			'Head_Title' => '',
			'Head_Icon' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'Head_Style' => 'http://lookandsee.com/Public/rehomes/style.css',


			/*	Header Area 	*/

			'Header_Top_Email' => 'omnia.moh1195@gmail.com',
			'Header_Top_Phone' => '(12) 345 6789',
			
				/*	Not Logged User 	*/
				'Header_LOGO_URL' => 'http://lookandsee.com/Public/rehomes/index.html',
				'Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

				'Header_Login' => Login,


				/*	Logged User 	*/
				'Header_MyProfile' => MyProfile,
				'Header_MyMessages' => Messages,
				'Header_PeddingPosts' => PeddingPosts,
				'Header_Settings' => Settings,
				'Header_LogOut' => LogOut,
				
				'Header_User_Picture' => ( SESSION() ) ? $_SESSION['Picture'] : '',


			/*	Partner Area 	*/
			'Partner_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/6.png',


			/* 	Footer Area 	*/
			'Footer_BackGround' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'Footer_Homes' => '',
			'Footer_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'Footer_Contact_Phone' => '01030968959',
			'Footer_Contact_Email' => 'omnia.moh1195@gmail.com',
			'Footer_Contact_Address' => 'Assuit, ElaZhar, Elnasr',

			'Footer_Notification_Form_URL' => '',

			'Footer_Copy_Write_Email' => 'https://www.facebook.com/M.Magdi.aboelsoud',
			'Footer_Copy_Write_Name' => 'mohammed',

			'Footer_Home' => '',
			'Footer_About' => '',
			'Footer_Contact' => '',


			/*	JS Files 	*/
			'SCRIPTS_Min_JQuery' =>
				'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' =>
				'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' =>
				'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' =>
				'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' =>
				'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function Mobiles_Render($Type, $Status, $Price){
		return $this->Render('DO/Find/Mobiles.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Find Mobiles',
			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,


			/*	Scripts Area 	*/
			'Mobiles_Type' => $Type,
			'Mobiles_Status' => $Status,
			'Mobiles_Price' => $Price,

			'GetMoreMobilesPostsPage' => GetMoreMobilesPosts
		]);
	}

	function Cars_Render(){
		return $this->Render('DO/Find/Cars.html', [

			/*	Head Area 	*/
			'Head_Title' => '',
			'Head_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'Head_Style' => 'http://lookandsee.com/Public/rehomes/style.css',


			/*	Header Area 	*/
			'Header_Top_Email' => 'omnia.moh1195@gmail.com',
			'Header_Top_Phone' => '(12) 345 6789',

			'Header_LOGO_URL' => 'http://lookandsee.com/Public/rehomes/index.html',
			'Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			'Header_Login' => Login,


			/*	Partner Area 	*/
			'Partner_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/6.png',


			/* 	Footer Area 	*/
			'Footer_BackGround' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'Footer_Homes' => '',
			'Footer_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'Footer_Contact_Phone' => '01030968959',
			'Footer_Contact_Email' => 'omnia.moh1195@gmail.com',
			'Footer_Contact_Address' => 'Assuit, ElaZhar, Elnasr',

			'Footer_Notification_Form_URL' => '',

			'Footer_Copy_Write_Email' => 'https://www.facebook.com/M.Magdi.aboelsoud',
			'Footer_Copy_Write_Name' => 'mohammed',

			'Footer_Home' => '',
			'Footer_About' => '',
			'Footer_Contact' => '',


			/*	JS Files 	*/
			'SCRIPTS_Min_JQuery' =>
				'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' =>
				'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' =>
				'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' =>
				'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' =>
				'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function Ele_Render(){

		return $this->Render('DO/Find/ElectricalTools.html', [
			'Head_Title' => 'Electrical Tools',

			'GetMoreElcPostsPage' => GetMoreElcPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	function Lux_Render(){
		return $this->Render('DO/Find/Lux.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Accessories',

			'GetMoreLuxPostsPage' => GetMoreLuxPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	function Fashion_Render(){
		return $this->Render('DO/Find/Fashion.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Fashion',

			'GetMoreFashionPostsPage' => GetMoreFashionPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	function Eat_Render(){
		return $this->Render('DO/Find/HomeFoods.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Home Foods',

			'GetMoreEatPostsPage' => GetMoreEatPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	function Doc_Render(){
		return $this->Render('DO/Find/Doc.html', [

			/*	Head Area 	*/
			'Head_Title' => 'MedicalSupplies',

			'GetMoreDocPostsPage' => GetMoreDocPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	function Ant_Render(){
		return $this->Render('DO/Find/Ant.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Antiques',

			'GetMoreAntPostsPage' => GetMoreAntPosts,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	function Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		/*return $this->Render('DO/Post.html', [
			
			// Header
			'Title' => $Data['Add_Name'],
			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,/*
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,*/

			/*'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,

			// Section
			'SmallType' => $Data['SmallType'],
			'BigType' => $Data['BigType'],
			'Date' => $Data['Date'],
			'POST_ID' => $Data['POST_ID'],

			'Data' => $Data,
			'Rooms' => $Data['Rooms'],
			'PathRooms' => $Data['PathRooms'],
			'Area' => $Data['Area'],
			'Furnished' => $Data['Furnished'],
			'Discreption' => $Data['Discreption'],

			'Money' => $Data['Money'],
			'Phone' => $Data['Phone'],

			'Status' => $Data['Status'],
			'Contact_Status' => $Data['Contact_Status'],

			'AdminAcceptPost' => AdminAcceptPost.$Post_ID,
			'AdminRejectPost' => AdminRejectPost.$Post_ID,
			'AdminDeletePost' => AdminDeletePost.$Post_ID,

			'User_Profile' => $User_Profile,
			'User_Picture' => $User_Picture,
			'User_Name' => $Data['User_Name'],

			'AddPicture' => AddPicture,

			'User_Email' => $User_Email,

			// Script
			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);*/

		return $this->Render('DO/Template_Post.html', [

			// Head
			'HEAD_Title' => $Data['Add_Name'],
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			'Title' => 'Contact US',

			// Secion Contact Area
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],

			'Status' => $Data['Status'],
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Address' => $Data['Address'],
			'Type' => $Data['SmallType'],
			'Money' => $Data['Money'],
			'Area' => $Data['Area'],
			'Rooms' => $Data['Rooms'],
			'PathRooms' => $Data['PathRooms'],

			// Admin Operations
			'Approve_Add' => AdminApprovePost.$Data['POST_ID'],
			'Reject_Add' => AdminRejectPost.$Data['POST_ID'],
			'Delete_Add' => AdminDeletePost.$Data['POST_ID'],

			'User_Name' => $Data['User_Name'],
			'BigType' => $Data['BigType'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['Phone'],
			'Contact_Status' => $Data['Contact_Status'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len,

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function Homes_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		
		return $this->Render('DO/Posts/Homes.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Finishing' => $Data['Add_Finishing'],
			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Area' => $Data['Add_Area'],

			'Rooms' => $Data['Add_Rooms'],
			'PathRooms' => $Data['Add_PathRooms'],
			
			'Storey' => $Data['Add_Storey'],
			'Garage' => ( $Data['Add_Garage'] == '0' ) ? 'No' : 'Yes',

			'Security' => ( $Data['Add_Security'] == '0' ) ? 'No' : 'Yes',
			'Garden' => ( $Data['Add_Garden'] == '0' ) ? 'No' : 'Yes',

			'Furnished' => ( $Data['Add_Furnished'] == '0' ) ? 'No' : 'Yes',

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Homes/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Homes/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Homes/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Mobiles_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Mobiles.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Mobile_Status' => $Data['Add_MobileStatus'],

			'Can_Change' => ( $Data['Add_Can_Change'] == '0' ) ? 'No' : 'Yes',
			'Can_Installment' => ( $Data['Add_Installment'] == '0' ) ? 'No' : 'Yes',
			
			'is_Free' => ( $Data['Add_Free'] == '0' ) ? 'No' : 'Yes',

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Mobiles/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Mobiles/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Mobiles/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Cars_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Cars.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Model' => $Data['Add_Model'],
			'Year' => $Data['Add_Year'],
			'Engine' => $Data['Add_Engine'],
			'Motion_Vector' => $Data['Add_MotionVector'],

			'Car_Status' => $Data['Add_CarStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Cars/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Cars/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Cars/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Elc_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Elc.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],
			'Elc_Status' => $Data['Add_ElcStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Elc/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Elc/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Elc/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Lux_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Lux.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],
			'Lux_Status' => $Data['Add_LuxStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Lux/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Lux/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Lux/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Fashion_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Fashion.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],
			'Fashion_Status' => $Data['Add_FashionStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Fashion/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Fashion/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Fashion/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Eat_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Eat.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Eat/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Eat/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Eat/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Doc_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Doc.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],
			'Doc_Status' => $Data['Add_DocStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Doc/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Doc/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Doc/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	function Ant_Post_Render($User_Profile, $User_Picture, $User_Email, $Data, $Post_ID){
		return $this->Render('DO/Posts/Ant.html', [

			/*	Head Area 	*/
			'Head_Title' => $Data['Add_Name'],

			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckMinMaxScript' => CheckMinMaxScript,
			'isNumberScript' => isNumberScript,

			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerMessageScript' => TriggerMessageScript,

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,


			/*	Properties Slider 	*/
			'First_Image' => $Data['Picture1'],
			'Second_Image' => $Data['Picture2'],
			'Third_Image' => $Data['Picture3'],
			'Fourth_Image' => $Data['Picture4'],


			/*	Properties Content Area 	*/
			'Status' => $Data['Add_Status'],

			'Address' => $Data['User_City'],
			'Type' => $Data['Add_Type'],

			'Money' => $Data['Add_Price'],

			'Descreption' => $Data['Add_Descreption'],

			'Product_Name' => $Data['Add_Product_Name'],
			'Ant_Status' => $Data['Add_AntStatus'],

			/*	Properties-area 	*/
			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',

			'Approve_Add' => AdminApprovePost.'Ant/'.$Data['ADD_ID'],
			'Reject_Add' => AdminRejectPost.'Ant/'.$Data['ADD_ID'],
			'Delete_Add' => AdminDeletePost.'Ant/'.$Data['ADD_ID'],

			'User_Name' => $Data['User_Name'],
			'User_Link' => $User_Profile,

			'Email' => $User_Email,
			'User_Profile' => $User_Profile,
			
			'Phone' => $Data['User_Phone'],
			'Contact_Status' => $Data['Add_ContactStatus'],

			'User_Picture' => $User_Picture,

			'AddPicture' => AddPicture,

			'MakeMessage' => MakeMessage,
			'Message_Len' => Message_Len,
			'Email_Len' => Email_Len
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	function Edit_Elc(){
		return $this->Render('DO/EditPosts/Elc.html', [

			// Head
			'Head_Title' => 'Edit Elc Post',
			
			'Head_Assest_Style' => 'http://lookandsee.com/Public/New folder/asd/assets/css/styles.css',
			'Head_Assest_Font' =>
				'http://lookandsee.com/Public/New folder/asd/assets/font-awesome/css/font-awesome.css',

			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,

			'AddPicture' => AddPicture
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	function PostMessage_Render(){
		//return $this->Render('DO/PostMessage.html', []);
		return $this->Render('DO/PostMessage.html', [

			// Head
			'HEAD_Title' => 'Sent Message',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function EditPost_Render($Data){
		return $this->Render('DO/EditPost.html', [

			// Header
			'Title' => $Data['Add_Name'],
			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckDataLenAndNumberScript' => CheckDataLenAndNumberScript,
			'isNumberScript' => isNumberScript,
			'CheckinputLenAndNumberScript' => CheckinputLenAndNumberScript,
			'AddPictureScript' => AddPictureScript,
			'TriggerFormScript' => TriggerFormScript,
			'TriggerMessageScript' => TriggerMessageScript,

			// Section
			'BigType' => $Data['BigType'],
			'SmallType' => $Data['SmallType'],
			'Money' => $Data['Money'],
			'Rooms' => $Data['Rooms'],
			'PathRooms' => $Data['PathRooms'],
			'Area' => $Data['Area'],
			'Furnished' => $Data['Furnished'],
			'Discreption' => $Data['Discreption'],

			'Picture1' => $Data['Picture1'],
			'Picture2' => $Data['Picture2'],
			'Picture3' => $Data['Picture3'],
			'Picture4' => $Data['Picture4'],

			'Address' => $Data['Address'],
			'User_Name' => $Data['User_Name'],
			'Phone' => $Data['Phone'],
			'ContactMe' => $Data['ContactMe'],

			// Scripts
			'Advertise_Name_Len' => Advertise_Name_Len,
			'Area_Len' => Area_Len,
			'Discreption_Len' => Discreption_Len,
			'Address_Len' => Address_Len,
			'Name_Len' => Name_Len,
			'Money_Len' => Money_Len,
			'Phone_Len' => Phone_Len
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// Profile
	function User_Render($Data, $User_ID, $Posts_Number){
		/*return $this->Render('Profile/User.html', [
			
			// Header
			'Title' => $Data['Base_User_Name'],
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			// Section
			'User_ID' => $User_ID,
			'User_Name' => $Data['Base_User_Name'],
			'Posts_Number' => $Posts_Number,

			'AdminDeleteAccount' => AdminDeleteAccount.$User_ID,
			'User_Picture' => $Data['User_Picture'],

			'Posts' => $Posts
		]);*/

		return $this->Render('Profile/User_Template.html', [
			
			'Head_Title' => $Data['Base_User_Name'],


			'User_Picture' => $Data['User_Picture'],
			'User_Name' => $Data['Base_User_Name'],
			'Posts_Number' => $Posts_Number,

			'User_Status' => ( SESSION() ) ? $_SESSION['Status'] : '',
			'DeleteAccount' => AdminDeleteAccount.$User_ID
		]);
	}

	function MyProfile_Render(){
		/*return $this->Render('Profile/MyProfile.html', [

			// Header
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,
			
			// Section
			'User_Profile' => User.$_SESSION['ID'],
			'User_Picture' => $_SESSION['Picture'],
			'User_ID' => $_SESSION['ID'],
			'User_Name' => $_SESSION['Name'],
			'User_Email' => $_SESSION['Email'],
			'User_Phone' => $_SESSION['Phone'],
			'User_SignUP_Date' => $_SESSION['Sign_UP_Date'],
			'User_Posts' => $_SESSION['Posts'],

			'MyProfile' => MyProfile,
			'ProfilePeddingPosts' => MyProfile.'/PeddingPosts',
			'ProfileRejectedPosts' => MyProfile.'/RejectedPosts',
			'ProfileApprovedPosts' => MyProfile.'/ApprovedPosts',

			'Posts' => $GLOBALS['Result'],

			// Scripts
			'DeletePostPage' => DeletePostPage,
			'EditPost' => EditPost
		]);*/

		return $this->Render('Profile/MyProfile_Template.html', [

			// Head
			'Head_Title' => 'My Profile',
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			// User Section
			'User_Picture' => $_SESSION['Picture'],
			'User_Name' => $_SESSION['Name'],
			'User_Phone' => $_SESSION['Phone'],
			'User_Email' => $_SESSION['Email'],
			'Sign_UP_Date' => $_SESSION['Sign_UP_Date'],
			'Posts_Number' => $_SESSION['Posts'],

			'DeletePostPage' => DeletePostPage,

			// Control Section
			'Approved_Adds' => MyProfile.'/ApprovedPosts',
			'Rejected_Adds' => MyProfile.'/RejectedPosts',
			'Pedding_Adds' => MyProfile.'/PeddingPosts'
		]);
	}

	function Messages_Render($Title){
		/*return $this->Render('Profile/Messages.html', [

			// Header
			'Title' => $Title,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,
			

			// Section
			'Messages_Inbox' => Messages_Inbox,
			'Messages_Sent' => Messages_Sent,

			// Scripts
			'DeleteMessage' => DeleteMessage
		]);*/

		return $this->Render('Profile/Messages_Template.html', [

			// Head
			'Head_Title' => $Title,
			'Head_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'Head_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'Head_Style' => 'http://lookandsee.com/Public/rehomes/style.css',

			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			// Secion Contact Area
			'AllMessages' => Messages,
			'Inbox' => Messages_Inbox,
			'Sent' => Messages_Sent
		]);
	}

	function Message_Render(){
		/*return $this->Render('Profile/Message.html', [

			// Header
			'From' => $GLOBALS['Message']['Message_Email'],

			// Section
			'To' => $GLOBALS['Message']['User_Email'],
			'Message_Date' => $GLOBALS['Message']['Message_Date'],
			'Add_Name' => $GLOBALS['Message']['Add_Name'],

			'Message_Body' => $GLOBALS['Message']['Message_Body'],
		]);*/

		return $this->Render('Profile/Message_Template.html', [

			// Head
			'Head_Title' => $GLOBALS['Message']['Message_Email'],

			// Secion Contact Area
			'First_Image' => $GLOBALS['Message']['Picture1'],
			'Second_Image' => $GLOBALS['Message']['Picture2'],
			'Third_Image' => $GLOBALS['Message']['Picture3'],
			'Fourth_Image' => $GLOBALS['Message']['Picture4'],
			'Fifth_Image' => $GLOBALS['Message']['Picture5'],

			// Section Message Info
			'From' => $GLOBALS['Message']['Message_Email'],
			'To' => $GLOBALS['Message']['User_Email'],

			'Date' => $GLOBALS['Message']['Message_Date'],
			'Add_Name' => $GLOBALS['Message']['Add_Name'],

			'Add_Link' => Post.$GLOBALS['Message']['Post_id'],

			'Message' => $GLOBALS['Message']['Message_Body']
		]);
	}

	function Notifications_Render($Notifications_Number){
		//return $this->Render('Profile/Notifications.html', []);
		return $this->Render('Profile/Notifications_Template.html', [

			// Head
			'HEAD_Title' => 'Notifications',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Secion Contact Area
			
			'Notifications_Number' => $Notifications_Number,

			'GetMoreNotifications' => GetMoreNotifications,

			// Section Message Info

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' =>
				'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function Settings_Render($Title){

		/*return $this->Render('Profile/Settings.html', [

			// Header
			'Title' => $Title,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerFormScript' => TriggerFormScript,

			'AddPictureScript' => AddPictureScript,
			'CheckLenScript' => CheckLenScript,
			'CheckinputLenScript' => CheckinputLenScript,
			'CheckPhoneScript' => CheckPhoneScript,
			'CheckPasswordScript' => CheckPasswordScript,

			// Section
			'Settings_Name' => Settings.'/Name',
			'Settings_Address' => Settings.'/Address',
			'Settings_Password' => Settings.'/Password',
			'Settings_Phone' => Settings.'/Phone',
			'Settings_DeActivate' => Settings.'/DeActivate',

			// Scripts
			'Name_Len' => Name_Len,
			'Phone_Len' => Phone_Len,
			'Password_Len' => Password_Len,
			'Address_Len' => Address_Len,

			'CheckPage' => CheckPage
		]);*/

		return $this->Render('Profile/Settings_Template.html', [

			// Header
			'Head_Title' => 'Settings',

			'User_Picture' => $_SESSION['Picture'],

			'AddPictureScript' => AddPictureScript,
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,
			'TriggerFormScript' => TriggerFormScript,


			'Name_Len' => Name_Len,
			'Phone_Len' => Phone_Len,
			'Password_Len' => Password_Len,
			'Address_Len' => Address_Len,


			'CheckLenScript' => CheckLenScript
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// Admin
	function PeddingPosts_Render(){
		//return $this->Render('Admin/PeddingPosts.html', []);
		return $this->Render('Admin/PeddingPosts_Template.html', [

			'Head_Title' => 'Pedding Posts',
			'TriggerMessageScript' => TriggerMessageScript,
			'SetError_FunctionScript' => SetError_FunctionScript,

			'GetMorePeddingPosts' => GetMorePeddingPosts
		]);
	}

	function DeleteUserPost_Render(){
		//return $this->Render('Admin/AdminOperations.html', [ 'Title' => 'Delete User Post' ]);
		return $this->Render('Admin/AdminOperations_Template.html', [

			// Head
			'HEAD_Title' => 'Delete User Post',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function RejectUserPost_Render(){
		//return $this->Render('Admin/AdminOperations.html', [ 'Title' => 'Reject User Post' ]);
		return $this->Render('Admin/AdminOperations_Template.html', [

			// Head
			'HEAD_Title' => 'Reject User Post',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function ApproveUserPost_Render(){
		//return $this->Render('Admin/AdminOperations.html', [ 'Title' => 'Approve User Post' ]);
		return $this->Render('Admin/AdminOperations_Template.html', [

			// Head
			'HEAD_Title' => 'Approve User Post',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function DeleteUserAccount_Render(){
		//return $this->Render('Admin/AdminOperations.html', [ 'Title' => 'Delete User Account' ]);
		return $this->Render('Admin/AdminOperations_Template.html', [

			// Head
			'HEAD_Title' => 'Delete User Account',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// Services Pages
	function Help_Render(){
		//return $this->Render('Services/Help.html', []);
		return $this->Render('Services/Help.html', [

			// Head
			'HEAD_Title' => 'Sent Message',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function Policy_Render(){
		//return $this->Render('Services/Policy.html', []);
		return $this->Render('Services/Policy_Template.html', [

			// Head
			'HEAD_Title' => 'Sent Message',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

	function ContactUS_Render($Result = '', $Name = '', $Email = '', $Message = ''){
		return $this->Render('Services/ContactUS.html', [

			/* 	Head Area 	*/
			'Head_Title' => 'Contact US',

			/*	Contact Area 	*/
			'Contact_BackGround' => 'http://lookandsee.com/Public/rehomes/img/bg-img/30.jpg',
			'Contact_Home' => 'http://lookandsee.com/DO/Find/Homes',

			'Support_FirstImage' => 'http://lookandsee.com/Public/rehomes/img/bg-img/35.jpg',
			'Support_SecondImage' => 'http://lookandsee.com/Public/rehomes/img/bg-img/36.jpg',

			'ContactUS' => 'http://lookandsee.com/Services/ContactUS',

			'Form_Name' => $Name,
			'Form_Email' => $Email,
			'Form_Message' => $Message,

			'Result' => $Result
		]);
	}

	function RegisterNotifications_Render($Result = ''){
		return $this->Render('Services/RegisterNotifications.html', [

			/*	Head Area 	*/
			'Head_Title' => 'Register Notification',

			/* Result Area  */
			'Result' => $Result

		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	function AboutUS_Render(){
		return $this->Render('Services/AboutUS.html', [
			
			/*	Head Area 	*/
			'Head_Title' => 'About US',

			/*	AboutUS Area 	*/
			'AboutUS_BackGround' => 'http://lookandsee.com/Public/rehomes/img/bg-img/30.jpg',
			'AboutUS_Home' => 'http://lookandsee.com/DO/Find/Homes',

			'AboutUS_Intro_FirstImage' =>
				'http://lookandsee.com/Public/rehomes/img/bg-img/31.jpg',
			'AboutUS_Intro_SecondImage' =>
				'http://lookandsee.com/Public/rehomes/img/bg-img/32.jpg',
			'AboutUS_Intro_ThirdImage' =>
				'http://lookandsee.com/Public/rehomes/img/bg-img/33.jpg',

			'Testimonial_BackGround' =>
				'http://lookandsee.com/Public/rehomes/img/bg-img/34.jpg',
			'Testimonial_Icon' =>
				'http://lookandsee.com/Public/rehomes/img/core-img/quote.png'
		]);
	}

	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////////////////////////////////////

	// Status Pages
					// DONE
	function Not_Authurithed_User($PageName){
		//return $this->Render('StatusPages/Not_Authurithed_User.html', [ 'Title' => $PageName ]);
		return $this->Render('StatusPages/Not_Authurithed_User_Template.html', [

			// Head
			'HEAD_Title' => $PageName,
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

					// DONE
	function Error_Page($PageName){
		//return $this->Render('StatusPages/Error_Page.html', [ 'Title' => $PageName ]);
		return $this->Render('StatusPages/Error_Page_Template.html', [

			// Head
			'HEAD_Title' => $PageName,
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

					// DONE
	function Log_Out_Page($PageName){
		//return $this->Render('StatusPages/Log_Out_Page.html', [ 'Title' => $PageName ]);
		return $this->Render('StatusPages/Log_Out_Page_Template.html', [

			// Head
			'HEAD_Title' => $PageName,
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}

					// DONE
	function Not_Found_Page(){
		//return $this->Render('StatusPages/Not_Found_Page.html', []);
		return $this->Render('StatusPages/Not_Found_Page_Template.html', [

			// Head
			'HEAD_Title' => 'Not Found',
			'HEAD_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/favicon.png',
			'HEAD_Font_Awasome' => 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
			'HEAD_Style_SHEET' => 'http://lookandsee.com/Public/rehomes/style.css',

			// Header
				// Top Header Area
			'HEADER_Email' => 'HadyEslam@gmail.com',
			'HEADER_Phone' => '(011) 238 685 07',

				// Main Header
			'Main_Header_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo.png',

			// Partner Area
			'First_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/1.png',
			'Second_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/2.png',
			'Third_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/3.png',
			'Fourth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/4.png',
			'Fifth_Partner_Image' => 'http://lookandsee.com/Public/rehomes/img/core-img/5.png',

			'Support_Person_Thump' => 'img/bg-img/35.jpg',
			'Support_Person_Thump2' => 'img/bg-img/36.jpg',

			// Footer
			'FOOTER_BackGround_Image' => 'http://lookandsee.com/Public/rehomes/img/bg-img/17.jpg',
			'FOOTER_LOGO' => 'http://lookandsee.com/Public/rehomes/img/core-img/logo-2.png',

			'FOOTER_Text' => 'Hello ... Search For Houses?',

			'FOOTER_Phone' => '(011) 238 685 07',
			'FOOTER_Email' => 'HadyEslam@gmail.com',
			'FOOTER_Address' => '40 El-Salam Street, Assuit, Egypt',

			// JavaScript
			'SCRIPTS_Min_JQuery' => 'http://lookandsee.com/Public/rehomes/js/jquery.min.js',
			'SCRIPTS_Min_Proper' => 'http://lookandsee.com/Public/rehomes/js/popper.min.js',
			'SCRIPTS_Min_Bootstrap' => 'http://lookandsee.com/Public/rehomes/js/bootstrap.min.js',
			'SCRIPTS_Min_Bundle' => 'http://lookandsee.com/Public/rehomes/js/rehomes.bundle.js',
			'SCRIPTS_Min_Active' => 'http://lookandsee.com/Public/rehomes/js/default-assets/active.js'
		]);
	}
}