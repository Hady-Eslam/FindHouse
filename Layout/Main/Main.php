<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P11';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Main");
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
$_SESSION['Page Name'] = 'Main';
$Result = array(-2 ,'');

?>
<!DOCTYPE >
<html>
<head>
	<title>Main</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

	<style type="text/css">
		.Search{
			text-align: center;
			border-radius: 5px;
			border-width: 2px;
			border-color: #0DBC77;
			border-style: solid;
			margin: 10 10 10 10;
			padding: 5 5 5 5;
			cursor: pointer;
		}
		.Search_Item{
			display: inline-block;
		}
		.Number_Page{
			display: inline-block;
			color: #FFFFFF;
		}
		span{
			color: #359007;
		}
	</style>
</head>

<body>

	<?php include_once AllHeaders; ?>

	<section >
		
		<div id='Title'>
            Search For House
        </div>

		<form>

	        <div style="margin: 20 20 20 20;">
	        	<input type="button" class='Button' id='Rent' value="Rent">
	        	<input type="button" class='Button' id='Buy' value="Buy">
	        </div>

	        <div style="margin: 20 20 20 20;">
	        	<input class='Button' type="button" id='Family' value="Family">
	        	<input class='Button' type="button" id='Office' value="Office">
	        	<input class='Button' type="button" id='Student' value="Student">
	        </div>

	        <div>
	        	Search Area From : &nbsp;
	        	<input type="text" class='Input_Data' size="4" 
	        		onfocus="Focus(this);" onblur="Blur(this);">
	        	&nbsp;&nbsp;&nbsp;To : 
	        	<input type="text" class='Input_Data' size="4" 
	        		onfocus="Focus(this);" onblur="Blur(this);">
	        </div>

	        <div style="border-radius: 5px;border-style: solid;border-width:2px; "
	        		id='Container'>

		        <div style="visibility: hidden;" id='Show'>
		        	<p id='End' style="color: #A60303;">Results Ends Here</p>
		        </div>

		        <div class='Div_Show_More'>
		        	
		        	<a class='Show_More' onclick="Go();">Show More</a>
		        </div>

	        </div>

        </form>

	</section>

	<?php  include_once Footer;  ?>

</body>
</html>