<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P2';
set_error_handler("Error_Handeler");

/*
							Check The Status Of The Page
                            Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Sign UP");
if ( $PageStatus == 0 ){
    include_once ClosedPage;
    exit();
}
else if ( $PageStatus == -1 ){
    include_once ErrorPage;
    exit();
}

$_SESSION['Page Name'] = 'Success Sign UP';
$Result = array(-2, '');

/*
							If Not Sended From Sign UP
*/

// if E Not Found
if ( !isset($_GET['E']) ){
	include_once UnAuthurithedUser;
    exit();
}

// if Can't Get Hashed Email
include_once HashClass;
if ( $Hashing->Get_Hashed_Email($_GET['E']) == -1 ){
	include_once UnAuthurithedUser;
    exit();
}

// if Can't Filter Email
include_once FILTERS;
if ( ($FILTER->FilterEmail( $Hashing->HashedText ))[1] != 'OK' ){
	include_once UnAuthurithedUser;
    exit();
}

// if user not found in waiting_users
include_once CheckUser;
$Result = CheckUserEmail( $FILTER->FILTER_Result );
if ( $Result[0] == 1 || ( $Result[0] == 0 && $Result[1] != 'Found In Waiting_Users' ) ){
	include_once UnAuthurithedUser;
    exit();
}
?>
<!DOCTYPE>
<html>
<head>
	<title>Success Sign UP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">
</head>
<body>

	<?php 	include_once AllHeaders; 
            include_once MessageBox;
    ?>
	<section>
		<P style='color: green;text-align: center;font-size: 20px;'>Please Check Your Email To Complete The Proccess Of SIGN UP</P>
		<p style='color: red;text-align: center;font-size: 20px;'>
			<strong style="color: black;">Note : </strong> if You Didn't Complete The Process Of Sign UP in One Week Your Data Will be Deleted From Server</p>
	</section>

	<?php  include_once Footer; ?>

	<script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo SetMessageBoxScript; ?>"></script>

    <script type="text/javascript">
<?php
    if ( $Result[0] == -1 ){
        include_once TrigerMessage;
    }
?>
    </script>
</body>
</html>