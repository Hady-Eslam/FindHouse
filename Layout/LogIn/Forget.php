<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P5';     // Only For Pages
set_error_handler("Error_Handeler");

/*
                            Check The Status Of The Page
                            Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Forget Password");
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
$_SESSION['Page Name'] = 'Forget';
$Result = array(-2 ,'');

if ( isset($_SESSION['Name']) ){
    include_once LogOutPage;
    exit();
}

/*
                            if The Request is Send
*/

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset( $_POST['E'] )
    && isset($_SERVER["HTTP_REFERER"]) ){

    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }
    
    if ( $URL_REFERER->URLResult != Forget ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
    CheckData Output
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

        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' ){
            header("Location:".Forget );
            exit();
        }
        else if ( $Result[1] == 'Found In Users' || $Result[1] == 'Found In Waiting_Users' ){
/*
    GetToken_SendMail Output
        return array(-1, $MySql->Error, 'Getting Token', 'GetToken_SendMail');
        return array(-1, $MySql->Error, 'Saving Token', 'GetToken_SendMail');
        return array(-1, $PHPMail->Error, 'Sending Email', 'GetToken_SendMail');
        return array(0, 'Failed To Send Email', 'GetToken_SendMail');
        return array(0, 'Done');
*/
            include_once Log_Dir_PHP.'ForgetCheck.php';
            $Result = GetToken_SendMail();
        }
    }
}
?>

<!DOCTYPE>
<html>
<head>
	<title>Forget Password</title>
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

    <script src="<?php echo Log_Dir_Script; ?>ForgetScript.js"></script>
</head>
<body>

	<?php include_once NotLoggedHeaders; ?>

	<section>

		<div class = 'Title'>
            Forget Password
        </div>

        <?php   include_once MessageBox; ?>
<?php
    if ( $Result[0] == -2 || $Result[0] == 0 && $Result[1] == 'Not Found' ){
?>
		<form id='ForgetForm' method="post" enctype="multipart/form-data"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">

			<p>Please enter your email</p>
			<P>To Send You Email To Make New Password</P>
            <div>
				<input class='Input_Data' onfocus="Focus(this);" 
                    onblur="Blur(this);" type="text" id='Email' 
                    required name="E" placeholder="Enter Your Email"
                    <?php
                        if ( $Result[0] != -2 )
                            echo 'value="'.$GLOBALS['E'].'"';
                    ?>>
			</div>

			<div>
                <input type="submit" value="Send" class='Button'>
            </div>
        </form>
<?php
    }
    else if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Failed To Send Email' ){
        ?>
            <p style="color: red;">Failed To Send Email Please Re Make The Proccess</p>
        <?php
        }
        else if ( $Result[1] == 'Done' ){
        ?>
            <p style="color: green;">The Email is Succesfull Sended</p>
            <p><strong style="color: red">Note : </strong>The Token Will Be Deleted After 3 Days</p>
        <?php
        }
    }
    else{
    ?>
        <p style="color: red;">Error Occured</p>
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
    else if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Not Found' ){
        ?>
            $('#Email').css('border-color', 'red');
        <?php
        }
    }
?>
	</script>

	<script type="text/javascript">
		var Email_Len = <?php echo Email_Len; ?>;
	</script>

</body>
</html>