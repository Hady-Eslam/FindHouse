<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P13';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Help");
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
$_SESSION['Page Name'] = 'Help';
$Result = array(-2 ,'');

?>
<!DOCTYPE>
<html>
<head>
	<title>Help Center</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>
</head>

<body>

	<?php include_once AllHeaders; ?>

    <section style="text-align: left;">
    	<p>Questions On How To Use WebSite</p>
    	<a href="">How To Post Advertising</a>
    	<a href="">How To Use Predict</a>
    	<a href="">How To Use Search</a>
    	<a href="">How To Make New Acount</a>
    	<a href="">How To Change The Profile Information</a>
    	<a href="">How To Delete Post</a>
    </section>

    <?php  include_once Footer;  ?>

</body>
</html>