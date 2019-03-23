<!DOCTYPE>
<html>
<head>
	<title>Find</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Find.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckMinMaxScript; ?>"></script>

    <script src="<?php echo isNumberScript; ?>"></script>
    <script src="<?php echo CheckinputLenAndNumberScript; ?>"></script>

    <script src="<?php echo CheckDataLenAndNumberScript; ?>"></script>

    <script src="<?php echo TriggerFormScript; ?>"></script>
	<script src="<?php echo PagesScripts; ?>FindScript.js"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

        <div class="Search_Bar" id="Search_Bar" style="display: inline-block;text-align: left;
            width: 15%;margin: 0px;padding: 0px;vertical-align: top;">

         <!-- Status -->
        	<div style="display: block;width: 100%;">
        		<p>Status</p>

        		<input type="checkbox" name="StatusRent">Rent
                <br>
        		<input type="checkbox" name="StatusBuy">Buy
        	</div>

        <!-- Type -->
        	<div style="display: block;width: 100%;">
        		<p>Type</p>

        		<input type="checkbox" name="TypeStudents" id="Students" >
        		<label for="Students">Students</label>
                <br>
        		<input type="checkbox" name="TypeFamilies" id="Families" >
        		<label for="Families">Families</label>
                <br>
        		<input type="checkbox" name="TypeOffices" id="Offices" >
        		<label for="Offices">Offices</label>
        	</div>

    <!-- Furnished -->
        	<div style="display: block;width: 100%;">
        		<p>Furnished</p>

        		<input type="checkbox" name="FurnishedYes">Yes
                <br>
        		<input type="checkbox" name="FurnishedNo">No
        	</div>

    <!-- Area -->
        	<div style="display: block;width: 100%;">
        		<p>Area</p>

        		<input type="text" name="MinA" required id='MinArea' placeholder="Min"
        			oninput="CheckinputLenAndNumber(this.id, Area_Len);">
                <br>
                <input type="text" name="MaxA" required id='MaxArea' placeholder="Max"
        			oninput="CheckinputLenAndNumber(this.id, Area_Len);">
        	</div>


    <!-- Rooms -->
        	<div style="display: block;width: 100%;">
        		<p>Rooms</p>

        		<input type="text" name="MinR" required id='MinRooms' placeholder="Min"
        			oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                <br>
   
                <input type="text" name="MaxR" required id='MaxRooms' placeholder="Max"
        			oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
        	</div>

    <!-- PathRooms -->
        	<div style="display: block;width: 100%;">
        		<p>PathRooms</p>

        		<input type="text" required id='MinPathRooms' placeholder="Min"
        			name="MinPR" oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
                <br>
                <input type="text" id='MaxPathRooms' required placeholder="Max"
        			name="MaxPR" oninput="CheckinputLenAndNumber(this.id, Rooms_Len);">
        	</div>

    <!-- Money -->
        	<div style="display: block;width: 100%;">
        		<p>Money</p>

        		<input type="text" name="MinM" required id='MinMoney' placeholder="Min"
        			oninput="CheckinputLenAndNumber(this.id, Money_Len);">
                <br>
                <input type="text" name="MaxM" required id='MaxMoney' placeholder="Max"
        			oninput="CheckinputLenAndNumber(this.id, Money_Len);">
        	</div>

        	<div class="Button_Div" style="width: 100%;border: none;">
		        <input type="submit" value="Search" id="Submit" style="width: 100%;">
        	</div>
        </div>



<!-- Result Search -->
        <div class="Result_Bar" style="display: inline-block;width: 65%">

        <?php
        	$Count = 1;
        	foreach ($GLOBALS['Query_Result'] as $Row) {
        		$Count = Find_Get_Post($Row, $Count);
        	}
        	if ( $Count == 1 )
        		echo '<p>No Result Found</p>';
        ?>

        </div>

        <div class="Navigation_Div">
	        <?php Find_Get_Pages_URLS_Navigation($Count); ?>
		</div>

	</section>

	<?php  include_once Footer;  ?>

	<script type="text/javascript">
		var Area_Len = <?php echo Area_Len; ?>;
		var Rooms_Len = <?php echo Rooms_Len; ?>;
		var Storey_Len = <?php echo Storey_Len; ?>;
		var Money_Len = <?php echo Money_Len; ?>;
	</script>
</body>
</html>

<?php exit(); ?>