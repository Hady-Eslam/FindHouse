<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>interested in</title>

	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>interested.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo isNumberScript; ?>"></script>
    <script src="<?php echo CheckinputLenAndNumberScript; ?>"></script>

    <script src="<?php echo CheckMinMaxScript; ?>"></script>
    <script src="<?php echo CheckDataLenAndNumberScript; ?>"></script>

    <script src="<?php echo CheckPatternScript; ?>"></script>

    <script src="<?php echo TriggerFormScript; ?>"></script>

    <script src="<?php echo TriggerMessageScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>interestedScript.js"></script>

</head>

<body>

	<?php include_once AllHeaders; ?>

	<section>

		<div class='Title'>
			Interested in : 
		</div>

        <?php   include_once MessageBox; ?>

<?php
    if ( isset($_GET['Saved']) ){
        interested_Get_Button();
    }
    else{
    ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#interestedDiv').slideDown(2000);
            })
        </script>
    <?php
    }
?>

		<div id="interestedDiv">

            <div class="First_Row">
                <div>
                    <p>Area</p>
                    <input type="text" placeholder="Min Area" id="MinArea" name="MinA"
                        oninput="CheckinputLenAndNumber(this.id, Area_Len);">
                    <br>
                    <input type="text" placeholder="Max Area" id="MaxArea" name="MaxA"
                        oninput="CheckinputLenAndNumber(this.id, Area_Len);">
                </div>

                <!-- The Number Of Rooms -->
                <div>
                    <p>Rooms</p>
                    <input type="text" placeholder="Min Rooms" id="MinRooms" name="MinR"
                        oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                    <br>
                    <input type="text" placeholder="Max Rooms" id="MaxRooms" name="MaxR"
                        oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                </div>

                <!-- The Number Of PathRooms -->
                <div>
                    <p>PathRooms</p>
                    
                    <input placeholder="Min PathRooms" id="MinPathRooms" name="MinPR" 
                    type="text"oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                    <br>

                    <input placeholder="Max PathRooms"id="MaxPathRooms" name="MaxPR" 
                     type="text" oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                </div>

                <div>
                    <p>Storey</p>

                    <input  placeholder="Min Storey" id="MinStorey" name="MinStorey"
                    type="text" oninput="CheckinputLenAndNumber(this.id, Storey_Len);">
                    <br>
                    <input placeholder="Max Storey" id="MaxStorey" name="MaxStorey"
                    type="text" oninput="CheckinputLenAndNumber(this.id, Storey_Len);">
                </div>
            </div>

            
    <!-- Second Section -->

        <div class="CheckBoxs_Div">

            <div>
                <p>Status</p>
                <input type="checkbox" name="Rent"> Rent
                <br>
                <input type="checkbox" name="Buy"> Buy
            </div>

            <div>
                <p>Type</p>

                <input type="checkbox" name="Students" id="Students">
                <label for="Students">Students</label>
                <br>
                <input type="checkbox" name="Families" id="Families">
                <label for="Families">Families</label>
                <br>
                <input type="checkbox" name="Offices" id="Offices">
                <label for="Offices">Offices</label>
            </div>

            <div>
                <p>Furnished</p>

                <input type="checkbox" name="Yes"> Yes
                <br>
                <input type="checkbox" name="No"> No
            </div>
        </div>

        <div class="Third_Row">

            <div>
                <p>Money</p>

                <input type="text" placeholder="Min Money" id='MinMoney' name="MinM"
                    oninput="CheckinputLenAndNumber(this.id, Money_Len);">
                <br>
                <input type="text" placeholder="Max Money" id='MaxMoney' name="MaxM"
                    oninput="CheckinputLenAndNumber(this.id, Money_Len);">
            </div>

            <div>
                <p>Stop Search After :</p>
                
                <select id="Days" name="Days">
                    <?php
                    for ($Count = 0; $Count<=30; $Count++)
                        echo '<option value='.$Count.'>'.$Count.' Day</option>';
                    ?>
                </select>

                <select id='Months' name="Months">
                    <?php
                    for ($Count = 0; $Count<=12; $Count++)
                        echo '<option value='.$Count.'>'.$Count.' Month</option>';
                    ?>
                </select>
            </div>
        </div>
        <!-- Money -->

<?php
    if ( !$GLOBALS['UserisSet'] ){
    ?>
            <div class="Email">

                <div>
                    <p>Please Put Email Where The Result is Send To</p>
                    
                </div>
                <input type="text" placeholder="Enter Email" id="Email" name="E"
                        oninput="CheckinputLen(this.id, Email_Len);">
            </div>
    <?php
    }
?>
            <div>
            	<input type="submit" value="Save interested" id="Submit">
            </div>

		</div>
	</section>

	<?php  include_once Footer;  ?>

    <script type="text/javascript">
        var Area_Len = <?php echo Area_Len; ?>;
        var Rooms_Len = <?php echo Rooms_Len; ?>;
        var Storey_Len = <?php echo Storey_Len; ?>;

        var Money_Len = <?php echo Money_Len; ?>;
        var Email_Len = <?php echo Email_Len; ?>;
        var User = <?php echo (!$GLOBALS['UserisSet'])?0:1; ?>;

        var MyPage = '<?php echo interested; ?>';
    </script>

    <script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == 'EmailNotRightOrNotSet' )
        echo "$('#Email').css('border-color', 'red');";
    else if ( $GLOBALS['Result'] == 'MonthsNotSet' )
        echo "$('#Months').css('border-color', 'red');";
    else if ( isset($_GET['Saved']) )
        echo "TriggerMessage(3000, '#53A01A', '<p>Saved</p>');";
?>
    </script>

</body>
</html>

<?php exit(); ?>