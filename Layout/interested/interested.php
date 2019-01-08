<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P14';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("interested");
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
$_SESSION['Page Name'] = 'interested';
$Result = array(-2 ,'');

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_REFERER"]) ){

    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }
    
    if ( $URL_REFERER->URLResult != interested ){
        include_once UnAuthurithedUser;
        exit();
    }

    include_once interested_Dir_PHP.'ProcessData.php';
    $Result = CheckData();
    var_dump($Result);
    exit();
}
?>
<!DOCTYPE>
<html>
<head>
	<title>interested in</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>
    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckNumberOrNotScript; ?>"></script>

    <script src="<?php echo CheckinputLenAndNumberScript; ?>"></script>

    <script src="<?php echo interested_Dir_Script; ?>interestedScript.js"></script>
    
    <style type="text/css">
        .CheckBox{
            border-width: 1px;
            border-style: solid;
            border-radius: 5px;
            padding: 7 7 7 7;
            border-color: #645A60;
            width: 35px;
            height: 18px;
            cursor: pointer;
        }
    </style>
</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div id='Title'>
			Interested In : 
		</div>

        <?php   include_once MessageBox; ?>

		<div id="interestedDiv">

<!--    -->        
			<div>
                Governor Of : 
                <select class="Input_Data" id='Governor' name='G[]' multiple 
                        onfocus="Focus(this);" onblur="Blur(this);">
                    <option>Assiut</option>
                    <option>Menia</option>
                    <option>Sohag</option>
                </select>
                &nbsp;&nbsp;

        <!-- The Station -->
                Station : 
                <select class="Input_Data" id='Station' name='S[]' multiple
                        onfocus="Focus(this);" onblur="Blur(this);">
                    <option>Assiut</option>
                    <option>Manflot</option>
                </select>
            </div>

            <div>
        <!-- The Distruct   -->
                Distruct : 
                <select class="Input_Data" id='Distruct' name='D[]' multiple 
                        onfocus="Focus(this);" onblur="Blur(this);" >
                    <option>ElSadat</option>
                    <option>Mubarak</option>
                    <option>Teachers</option>
                    <option>Elweledia</option>
                </select>
            </div>
<!--    -->
            <div>
                Status :
                <input type="checkbox" name="StatusR" value='Rent' class="CheckBox"> For Rent
                <input type="checkbox" name="StatusB" value="Buy" class="CheckBox"> For Buy
            </div>

            <div>
                Type : 
                <input type="checkbox" name="TyS" value='Students' class="CheckBox"> For Students
                <input type="checkbox" name="TyF" value="Families"class="CheckBox"> For Families
                <input type="checkbox" name="TyO" value="Offices"class="CheckBox"> For Offices
            </div>

            <div>
                Furnished : 
                <input type="checkbox" name="FurY" value='Yes'class="CheckBox"> Yes
                <input type="checkbox" name="FurN" value="No"class="CheckBox"> No
            </div>
<!--    -->
    
        <!-- The Area -->
            <div>
                The Area Size From : 
                <input type="text" name="AF" id='AreaFrom'
                    class='Input_Data' placeholder="Area From"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Area_Len);">
                To : 
                <input type="text" name="AT" id='AreaTo'
                    class='Input_Data' placeholder="Area To"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Area_Len);">
            </div>

        <!-- The Number Of Rooms -->
            <div>
                Rooms : 
                <input type="checkbox" name="R1" class="CheckBox"> 1 
                <input type="checkbox" name="R2" class="CheckBox"> 2 
                <input type="checkbox" name="R3" class="CheckBox"> 3 
                <input type="checkbox" name="R4" class="CheckBox"> 4 
                <input type="checkbox" name="R5" class="CheckBox"> 5 
                <input type="checkbox" name="R6" class="CheckBox"> 6 
                <input type="checkbox" name="R7" class="CheckBox"> 7 
            </div>

        <!-- The Number Of PathRooms -->
            <div>
                PathRooms : 
                <input type="checkbox" name="PR1" class="CheckBox"> 1 
                <input type="checkbox" name="PR2" class="CheckBox"> 2 
                <input type="checkbox" name="PR3" class="CheckBox"> 3 
                <input type="checkbox" name="PR4" class="CheckBox"> 4 
            </div>

        <!-- Money -->
            <div>
                The Price From : 
                <input type="text" name="MF" id='MoneyFrom'
                    class='Input_Data' placeholder="Enter The Money"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Money_Len);">

                To : 
                <input type="text" name="MT" id='MoneyTo'
                    class='Input_Data' placeholder="Enter The Money"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Money_Len);">
            </div>

        <!-- Storey -->
            <div>
                Storey : 
                <input type="checkbox" name="Storey1" class="CheckBox"> 1 
                <input type="checkbox" name="Storey2" class="CheckBox"> 2 
                <input type="checkbox" name="Storey3" class="CheckBox"> 3 
                <input type="checkbox" name="Storey4" class="CheckBox"> 4 
                <input type="checkbox" name="Storey5" class="CheckBox"> 5 
                <input type="checkbox" name="Storey6" class="CheckBox"> 6 
                <input type="checkbox" name="Storey7" class="CheckBox"> 7 
                <input type="checkbox" name="Storey8" class="CheckBox"> 8 
                <input type="checkbox" name="Storey9" class="CheckBox"> 9 
                <input type="checkbox" name="Storey10" class="CheckBox"> 10 
                <input type="checkbox" name="Storey11" class="CheckBox"> 11 
                <input type="checkbox" name="Storey12" class="CheckBox"> 12 
            </div>

            <div>
            	Send Result To Phone ?
            	<br>
                <input type="text" placeholder="Enter Phone" class="Input_Data"
                        id="Phone" name="Ph">
            	<br>Send Result To Email ?
            	<br>
            	<input type="text" placeholder="Enter Email" class="Input_Data"
                        id="Email" name="E">
            </div>

            <div>
            	Stop Search After :
            	<select class="Input_Data" id="Days" name="Days">
            		<option>0 Day</option>
            		<option>1</option>
            		<option>2</option>
            		<option>3</option>
            	</select>
            	<select class="Input_Data" id='Months' name="Months">
            		<option>0 Month</option>
            		<option>1</option>
            		<option>2</option>
            		<option>3</option>
            	</select>
            </div>

            <div>
            	<input type="submit" value="Save" class="Button" id="Submit">
            </div>

		</div>
	</section>

	<?php  include_once Footer;  ?>

    <script type="text/javascript">
        var Area_Len = <?php echo Area_Len; ?>;
        var Money_Len = <?php echo Money_Len; ?>;

        var Phone_Len = <?php echo Phone_Len; ?>;
        var Email_Len = <?php echo Email_Len; ?>;

        var UserStatus = <?php echo (isset($_SESSION['Name']))? 1: 0; ?>;
    </script>
</body>
</html>