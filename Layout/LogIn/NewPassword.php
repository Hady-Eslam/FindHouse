<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;
include_once FILTERS;
include_once MySqlDB;
include_once HashClass;

$GLOBALS['Page_API_Error_Code'] = 'P6';     // Only For Pages
set_error_handler("Error_Handeler");

/*
                            Check The Status Of The Page
                            Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("New Password");
if ( $PageStatus == 0 ){
    include_once ClosedPage;
    exit();
}
else if ( $PageStatus == -1 ){
    include_once ErrorPage;
    exit();
}

/* 
                            Check if User Is Logging in
*/
$_SESSION['Page Name'] = 'New Password';
$Result = array(-2 ,'');

if ( isset($_SESSION['Name']) ){
    include_once LogOutPage;
    exit();
}


if ( $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['E']) && isset($_GET['T']) ){
// Check Email
    // if Can't Get Hashed Email
    if ( $Hashing->Get_Hashed_Email($_GET['E']) == -1 ){
        include_once UnAuthurithedUser;
        exit();
    }
    // if Can't Filter Email
    if ( ($FILTER->FilterEmail( $Hashing->HashedText ))[1] != 'OK' ){
        include_once UnAuthurithedUser;
        exit();
    }
    $GLOBALS['E'] = $FILTER->FILTER_Result;
// Check Token

    // if Can't Get Hashed Token
    if ( $Hashing->Get_Hashed_Token($_GET['T']) == -1 ){
        include_once UnAuthurithedUser;
        exit();
    }
    // if Can't Filter Token
    if ( ($FILTER->FilterToken( $Hashing->HashedText ))[1] != 'OK' ){
        header("Location:".Forget);
        exit();
    }
    $GLOBALS['T'] = $FILTER->FILTER_Result;
// Check Token
/*
    CheckToken Output
        return array(-1, $MySql->Error, 'Fetching Token And Email', 'Check Token');
        return array(0, 'Not Found');
        return array(0, 'Found');
*/
    include_once CheckToken;
    $Result = CheckToken($GLOBALS['E'], $GLOBALS['T'], 'log_token', 'Log');
    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Not Found' ){
            header("Location:".Forget);
            exit();
        }
    }
}
else if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['E']) 
    && isset($_POST['P']) && isset($_SERVER["HTTP_REFERER"]) ){

    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }

    if ( $URL_REFERER->URLResult != NewPassword ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
    Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');

        return array( -1, $MySql->Error, $Key, 'Check Data');
        return array( 0, 'Found In Users', $Key, 'Check Data');
        return array( 0, 'Found In Waiting_Users', $Key, 'Check Data');
        return array( 0, 'Not Found', $Key, 'Check Data');
*/
    include_once CheckAcount;
    $Result = CheckAcount();
    if ( $Result[0] == 0 ){

        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' || $Result[1] == 'Not Found' ){
            include_once UnAuthurithedUser;
            exit();
        }

        else if ( $Result[1] == 'Found In Users' || $Result[1] == 'Found In Waiting_Users' ){
/*
    FilterPassword Output
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(0, 'OK');
*/
            $MySql->SetUser('Log');
            if ( ($FILTER->FilterPassword($_POST['P']))[1] == 'OK' ){
                $GLOBALS['P'] = $FILTER->FILTER_Result;
                $Table = ( $Result[1] == 'Found In Users' )? $Table = 'users' 
                            : $Table = 'waiting_users';
/*
    Change Password Output
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(-1, $MySql->Error, 'Changing The User Password', 'Change Password');
        return array(0 'Done');
*/              
                include_once ChangePassword;
                $Result = ChangePassword($GLOBALS['E'], $GLOBALS['P'], $Table, 'Log');
                if ( $MySql->excute("DELETE FROM log_token WHERE token_email = ?",
                        array(
                            $Hashing->Hash_Email($GLOBALS['E'])
                        )) == -1 )
                    $Result = array(-1, $MySql->Error, 'Delete Token From DataBase',
                            'New Password');
                else
                    $Result = array(0, 'Done');
            }
            else{
                include_once UnAuthurithedUser;
                exit();
            }
        }
    }

}
else{
    include_once UnAuthurithedPage;
    exit();
}
?>

<!DOCTYPE>
<html>
<head>
	<title>New Password</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo ConfirmPasswordScript; ?>"></script>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>
    
    <script src="<?php echo Log_Dir_Script; ?>NewPassScript.js"></script>
</head>
<body>

	<?php include_once NotLoggedHeaders; ?>

	<section>
		
		<div class = 'Title'>
            Change Password
        </div>

        <?php include_once MessageBox; 
            if ( $Result[1] != 'Done' ){
        ?>

		<form id='NewPasswordForm' method="post" enctype="multipart/form-data"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">

            <div>
            	<input type="hidden" name="E" value='<?php echo $GLOBALS['E']; ?>'>
            </div>

            <div>
				<input class='Input_Data' onfocus="Focus(this);" 
                    onblur="Blur(this);" id='Password' type="Password"
                    name="P" placeholder="Enter New Password" required>
			</div>

			<div>
				<input class='Input_Data' onfocus="Focus(this);" 
                    onblur="Blur(this);" id='ConPassword' type="Password"
                    name="ConPassword" placeholder="Re Enter New Password" required>
			</div>

			<div>
                <input type="submit" value="Log in" class='Button'>
            </div>
			
		</form>
        <?php
            }
            else{
            ?>
                <p style="color: green;">The Password Changed</p>
            <?php
            }
        ?>

	</section>

	<?php  include_once Footer; ?>

    <script type="text/javascript">
<?php
    if ( $Result[0] == -1 ){
        include_once TrigerMessage;
    }
?>
    </script>
	<script type="text/javascript">
		var Password_Len = <?php echo Password_Len; ?>;
	</script>

</body>
</html>