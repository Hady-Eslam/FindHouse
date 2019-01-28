<?php set_error_handler("Error_Handeler");
include_once JSON;

function CheckPage_Begin(){
	$URL = new URLClass();
	if ( $URL->Request() == "POST" && $URL->REFFERE_is_SET() &&
		( isset($_POST['N']) || isset($_POST['E']) ) ){

		if ( $URL->CheckREFFERE(SignUP) ){
			echo (new JSONClass())->MakeJson(include_once BackEnd.'CheckPage.php');
			exit();
		}
	}
	StatusPages_Not_Authurithed_User_Page('UnAuthorized User');
}

function DeletePost_Begin(){
	if ( SESSION() ){
		$URL = new URLClass();
		if ( $URL->Request() == "POST"&&$URL->REFFERE_is_SET()&&isset($_POST['ID']) )
			if ( $URL->CheckREFFERE(MyProfile) ){
				echo (new JSONClass())->MakeJson(include_once BackEnd
								.'DeletePostPage.php');
				exit();
			}
	}
	StatusPages_Not_Authurithed_User_Page('UnAuthorized User');
}

function MakeComment_Begin(){
	if ( SESSION() ){
		$URL = new URLClass();
		if ( $URL->Request() == "POST" && $URL->REFFERE_is_SET() &&
				isset($_POST['ID']) && isset($_POST['Comment']) )
			if ( $URL->Match('/DO\/Post\/(\d+)$/', $URL->Get_REFFERE()) ){
				echo (new JSONClass())->MakeJson(
					include_once BackEnd.'MakeComment.php');
				exit();
			}
	}
	StatusPages_Not_Authurithed_User_Page('UnAuthorized User');
}

function MakeLike_DisLike_Begin(){
	if ( SESSION() ){
		$URL = new URLClass();
		if ( $URL->Request() == "POST" && $URL->REFFERE_is_SET() &&
			isset($_POST['ID']) && isset($_POST['Type']) )
			if ( $URL->Match('/DO\/Post\/(\d+)$/', $URL->Get_REFFERE()) ){
				echo (new JSONClass())->MakeJson(
					include_once BackEnd.'MakeLike_DisLike.php');
				exit();
			}
	}
	StatusPages_Not_Authurithed_User_Page('UnAuthorized User');
}

function MakeDisLike_Begin(){
	if ( SESSION() ){
		$URL = new URLClass();
		if ( $URL->Request() == "POST"&&$URL->REFFERE_is_SET()&&isset($_POST['ID']) )
			if ( $URL->Match('/DO\/Post\/(\d+)$/', $URL->Get_REFFERE()) ){
				echo (new JSONClass())->MakeJson(
					include_once BackEnd.'MakeDisLike.php');
				exit();
			}
	}
	StatusPages_Not_Authurithed_User_Page('UnAuthorized User');
}

function LogOut_Begin(){
	$Page = (isset($_SESSION['Page Name']))?$_SESSION['Page Name']:'Find';
	if ( (new SessionClass())->DestroySession()->Result == -1 )
		StatusPages_Error_Page('in Logging Out User');

	else if ( $Page == 'Sign UP' || $Page == 'Success Sign UP' ||
			  $Page == 'Confirm User')
		Redirect(SignUP);

	else if ( $Page == 'Log in' || $Page == 'Forget Password' ||
			  $Page == 'ReSet Password' )
		Redirect(Login);

	else if ( $Page == 'Predict' )
		Redirect(Predict);

	else if ( $Page == 'interested' )
		Redirect(interested);

	else if ( preg_match('/Post (.*)/', $Page) ){
		preg_match('/Post (.*)/', $Page, $Result);
		$Post_id = $Result[1];
		Redirect(Post.$Post_id);
	}

	else if ( preg_match('/User (.*)/', $Page) ){
		preg_match('/User (.*)/', $Page, $Result);
		$Post_id = $Result[1];
		Redirect(User.$Post_id);
	}

	else if ( $Page == 'Help' )
		Redirect(Help);

	else if ( $Page == 'Privacy' )
		Redirect(Privacy);

	Redirect(Find);
}
?>