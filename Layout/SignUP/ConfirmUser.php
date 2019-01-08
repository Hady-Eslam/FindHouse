<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P3';     // Only For Pages
set_error_handler("Error_Handeler");

/*
                            Check The Status Of The Page
                            Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Confirm User");
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
$_SESSION['Page Name'] = 'Confirm User';
$Result = array(-2 ,'');

/*
								Check The Data
*/
if ( $_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['E']) && isset($_GET['T']) ){

// Check Email
include_once HashClass;
	// if Can't Get Hashed Email
	if ( $Hashing->Get_Hashed_Email($_GET['E']) == -1 ){
		include_once UnAuthurithedUser;
	    exit();
	}

include_once FILTERS;
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
		include_once UnAuthurithedUser;
	    exit();
	}
	$GLOBALS['T'] = $FILTER->FILTER_Result;

// Find User
/*
	- CheckUser Output
		array(-1, $MySql->Error, 'Searching Token And Email Query', 'Check User');
		array(-1, $MySql->Error, 'Fetching Token And Email', 'Check User');
		array(0, 'Not Found');
		array(0, 'Found');
*/
	include_once CheckToken;
	$Result = CheckToken($GLOBALS['E'], $GLOBALS['T'], 'sign_up_token', 'SignUP');
	if ( $Result[0] == 0 ){
		if ( $Result[1] == 'Not Found' ){
			include_once UnAuthurithedUser;
			exit();
		}
/*
	- SaveData Output
		array(-1, $MySql->Error, 'Searching Email Query', 'Save Data');
		array(-1, $MySql->Error, 'Fetching Data', 'Save Data');
		array(0, 'Not Found');

		- SaveinUsers
			array(-1, $MySql->Error, 'insert Data Query', 'Save in Users');

			- DeleteFrom_Waiting
				array(-1, $MySql->Error, 'Delete Data Query', 'Delete From Waiting');
				array(-1, $MySql->Error, 'Delete Token Query', 'Delete From Waiting');
				array(0, 'Done');
*/
		include_once Sign_Dir_PHP.'SaveUser.php';
		$Result = SaveData($GLOBALS['E']);
		if ( $Result[0] == 0 ){
			if ( $Result[1] == 'Not Found' ){
				include_once UnAuthurithedUser;
				exit();
			}
		}
	}
}
else{
	include_once UnAuthurithedUser;
	exit();
}

?>
<!DOCTYPE>
<html>
<head>
	<title>Confirm User</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

	<script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo SetMessageBoxScript; ?>"></script>

</head>
<body>
	<?php 	include_once AllHeaders; ?>

	<section>

		<?php include_once MessageBox; ?>

<?php
	if ( $Result[0] == 0 ){
	?>
		<p style="color: green;">Congratulation On Completing The Process Of Sign UP</p>
		<p style="color: green;">Go To Log in Page To Log And use Your Acount</p>
	<?php
	}
	else{
	?>
		<p style="color: red">Error : Something Goes Wrong</p>
	<?php
	}
?>
		
	</section>

	<?php  include_once Footer; ?>

	<script type="text/javascript">
<?php
	if ( $Result[0] == -1 )
		include_once TrigerMessage;
?>
	</script>
</body>
</html>