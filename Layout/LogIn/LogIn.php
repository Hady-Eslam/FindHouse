<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P4';     // Only For Pages
set_error_handler("Error_Handeler");

/*
                            Check The Status Of The Page
                            Function OutPut ( -1  0  1 )
*/
include_once PageStatus;

$PageStatus = $Page->isPageOnWork("Log In");
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
$_SESSION['Page Name'] = 'Log in';
$Result = array(-2 ,'');

if ( isset($_SESSION['Name']) ){
    include_once LogOutPage;
    exit();
}

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['E'])
    && isset($_POST['P']) && isset($_SERVER["HTTP_REFERER"]) ){

    include_once URL;
    
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }

    if ( $URL_REFERER->URLResult != LogIn ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
    Return :
        return array( 0, 'Empty');
        return array(0, 'Too Long');

        return array(-1, $MySql->Error, $Key);
        return array( 0, 'Found In Users', $Key);
        return array(0, 'Found In Waiting_Users', $Key);
        return array(0, 'Not Found', $Key);
*/
    include_once CheckAcount;
    $Result = CheckAcount();

    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' || $Result[1] == 'Not Found' ){
            header("Location:".LogIn);
            exit();
        }
        $Table = ( $Result[1] == 'Found In Users' ) ? $Table = 'users' 
                        : $Table = 'waiting_users';
/*
    Return :
        return array(0, 'Empty');
        return array(0, 'Too Long');

        return array(-1, $MySql->Error, 'Check if Password is Correct',
                        'Check Password Correct');
        return array(0, 'Wrong Password');
        return array(0, 'Right Password');
*/
        include_once Log_Dir_PHP.'LoginAcount.php';
        $Result = CheckPasswordCorrect($Table);
        if ( $Result[0] == 0 ){

            if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' ){
                header("Location:".LogIn);
                exit();
            }
            else if ( $Result[1] == 'Right Password' ){
/*
    Return :
        return array(-1, $MySql->Error, 'Getting User Data From DataBase', 'Open Session');
        return array(0, 'Not Found');
        return array(0, 'Done');
*/
                include_once OpenSession;
                $Result = OpenSession($Table);
                if ( $Result[0] == 0 ){
                    
                    if ( $Result[1] == 'Done' ){
                        header("Location:".MainPage);
                        exit();
                    }
                }
            }
        }
    }
}
?>

<!DOCTYPE >
<html>
<head>
	<title>Log in</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>

    <script src="<?php echo Log_Dir_Script; ?>LogScript.js"></script>
</head>

<body>

    <?php include_once NotLoggedHeaders; ?>

	<section >

        <div class ='Title'>
            Log in
        </div>

        <?php   include_once MessageBox; ?>

		<form id='LogForm' method="post" enctype="multipart/form-data"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<div>
				<input class='Input_Data' onfocus="Focus(this);" 
                    onblur="Blur(this);" type="text" id='Email' 
                    required name="E" placeholder="Enter Your Email" 
                    <?php
                        if ( $Result[0] != -2 )
                            echo "value='".$GLOBALS['E']."'";
                    ?>>
			</div>
			
            <div>
				<input class='Input_Data' onfocus="Focus(this);" 
                    onblur="Blur(this);" id='Password' type="Password"
                    name="P" placeholder="Enter Password" required>
			</div>

            <div>
                <a href="<?php echo Log_Dir_Layout.'Forget.php'; ?>">Forget Your Password?</a>
            </div>

            <div>
                <input type="submit" value="Log in" class='Button'>
            </div>

			<div>
				<a href="<?php echo SignUP; ?>">
                    Create New Acount</a>
			</div>
		</form>

	</section>

	<?php  include_once Footer; ?>

    <script type="text/javascript">
<?php
    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Not Found' ){
        ?>
            $('#Email').css('border-color','red');
        <?php
        }
        else{
        ?>
            $('#Password').css('border-color','red');
        <?php
        }
    }
    else if ( $Result[0] == -1 ){
        include_once TrigerMessage;
    }
?>
    </script>
    <script type="text/javascript">
        var Email_Len = <?php echo Email_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;
    </script>
</body>
</html>