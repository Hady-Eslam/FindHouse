<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P10';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Profile");
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
$_SESSION['Page Name'] = 'Profile';
$Result = array(-2 ,'');

if ( !isset($_SESSION['Name']) ){
    include_once UnAuthurithedUser;
    exit();
}
else if ( $_SESSION['Status'] == '2' ){
    include_once UnAuthurithedUser;
    exit();
}
?>

<!DOCTYPE >
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

	<style type="text/css">
		.information{
			display: inline-block;
			text-align: left;
			border-radius: 5px;
			border-width: 2px;
			border-style: solid;
			border-color: #0DBC77;
		}
		.Search{
			border-width: 2px;
			border-radius: 5px;
			border-style: solid;
    		border-color:#0DBC77;
			text-align: left;
			margin: 10 10 10 10;
			padding: 0 0 0 0;
			border-radius: 5px;
			border-width: 1px;
		}
		.Search_Item{
			display: inline-block;
			margin-left: 5;
			margin-right: 5;
			padding: 0 0 0 0;
			margin-top: 0;
			margin-bottom: 0;
			text-align: center;
		}
		.Delete{
			background-color: #CD0101;
			border-color: #CD0101;
			border-style: solid;
			border-width: 1px;
			border-radius: 5px;
			width: 40px;
			height: 40px;
			font-size: 20px;
			color: #FFF;
			cursor: pointer;
			display: inline-block;
		}
        span{
            color: #359007;
        }
	</style>
</head>

<body>

	<?php include_once LoggedHeaders; ?>

    <section style="text-align: left;">

<!-- User informations -->
    	<div class='information'>

    		<div style="display: inline-block;">
    			<img src="<?php echo $_SESSION['Picture'];?>" 
    				width='180' hight='180'>
    		</div>
    		
    		<div style="display: inline-block;">
    			<p><span>Name</span> : <?php echo $_SESSION['Name'];?></p>
    			<p><span>Email</span> &nbsp;: <?php echo $_SESSION['Email'];?></p>
    			<p><span>Phone</span> : <?php echo $_SESSION['Phone'];?></p>
    			<p><span>Number Of Posts</span> = <?php echo $_SESSION['Posts'];?></p>
    		</div>

    	</div>

    	<!--<form id='Form'>
    		<div id='Show' style="position: absolute;border-radius:5px;
    			background-color:#0DBC77;visibility: hidden;color: #FFF ">
                <p id='Text'>Deleted</p>
            </div>

    		<div style="border-color: black;border-radius: 5px;
    					border-width: 2px;border-style: solid;
    					margin: 20 20 20 20;padding: 20 20 20 20;">

    			
		    	<div style="visibility: hidden;text-align: center;" id='Final'>
		        	<p id='End' style="color: #A60303;">Results Ends Here</p>
		        </div>

		        <div class='Div_Show_More'>
		        	<a class='Show_More' onclick="ShowMore();">Show More</a>
		        </div>
    		</div>
    	</form>-->
    	
    </section>

    <?php  include_once Footer;  ?>

</body>
</html>