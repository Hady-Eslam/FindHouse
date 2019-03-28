<!DOCTYPE >
<html>
<head>
    <title>Advertise</title>
    
    <link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Advertise.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo CheckDataLenAndNumberScript; ?>"></script>

    <script src="<?php echo isNumberScript; ?>"></script>
    <script src="<?php echo CheckinputLenAndNumberScript; ?>"></script>

    <script src="<?php echo AddPictureScript; ?>"></script>

    <script src="<?php echo TriggerFormScript; ?>"></script>

    <script src="<?php echo TriggerMessageScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>AdvertiseScript.js"></script>
</head>

<body>

    <?php include_once AllHeaders; ?>
    
    <section>
        
        <div class = 'Title' >
            Advertise
        </div>

        <?php   include_once MessageBox; ?>

<?php
    if ( !is_null($GLOBALS['ID']) ){
        Advertise_Get_Link();
    }
    else{
    ?>
        <script type="text/javascript">
            $(document).ready(function(){
                $('#AdvertiseDiv').slideDown(2000);
            })
        </script>
    <?php
    }
?>
        
        <div id='AdvertiseDiv'>

    <!-- -->
            <div>
                <input type="text" name="Add" id='Address' placeholder="Address"
                    oninput="CheckinputLen(this.id, Address_Len);">
            </div>

    <!-- -->
            <div class="PHA">
                <input type="text" name="Ph" id='Phone' placeholder="Phone"
                    oninput="CheckinputLen(this.id, Phone_Len);" required>

                <input type="text" name="A" required placeholder="Area" id='Area'
                    oninput="CheckinputLenAndNumber(this.id, Area_Len);">
            </div>

    <!-- -->
            <div>
                <div style="padding-left: 20px;">
                    <p>Status : </p>
                    <input type="radio" name="Status" value='Rent' checked>Rent
                    <input type="radio" name="Status" value="Buy">Buy
                </div>

                <div style="padding-left: 50px;">
                    <p>Type : </p>
                    <input type="radio" name="Ty" value='Students' checked>Students
                    <input type="radio" name="Ty" value="Families">Families
                    <input type="radio" name="Ty" value="Offices">Offices
                </div>

                <div style="padding-left: 80px;">
                    <p>Furnished : </p>
                    <input type="radio" name="Fur" value='Yes' checked>Yes
                    <input type="radio" name="Fur" value="No">No
                </div>
            </div>
    
    <!-- -->
            <div class="PHA">
                <input type="text" name="R" id='Rooms' placeholder="Rooms"
                    oninput="CheckinputLenAndNumber(this.id, Rooms_Len);" required>
                
                <input type="text" name="PR" id='PathRooms' placeholder="PathRooms"
                    oninput="CheckinputLenAndNumber(this.id, Rooms_Len);" required>
                
                <input type="text" name="Storey" placeholder="Enter The Storey"
                    oninput="CheckinputLenAndNumber(this.id, Storey_Len);" id='Storey'>
            </div>

    <!-- -->
            <div>
                <input type="text" name="M" id='Money'placeholder="Enter The Money"
                    oninput="CheckinputLenAndNumber(this.id, Money_Len);" required>
            </div>

    <!--  -->
            <div>
                <textarea cols="200" rows="7" id="Discreption" name="Dis"
                    placeholder="Enter Your Discreption Here"
                    oninput="CheckinputLen(this.id, Discreption_Len);"></textarea>
            </div>

    <!--  -->
            <div>
                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image1' name = 'image1'
                    onclick="GetPicture('#File1');">
                
                <input type="file"id='File1'name='File1'onchange="Read(this,'#image1');">

                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image2' name = 'image2'
                    onclick="GetPicture('#File2');">

                <input type="file"id='File2'name='File2'onchange="Read(this,'#image2');">           
            </div>

    <!--  -->
            <div>
                <input type="submit" value="Post" id='Submit'>
            </div>

        </div>

    </section>

    <?php  include_once Footer;  ?>
    
    <script type="text/javascript">
        var Address_Len = <?php echo Address_Len; ?>;

        var Phone_Len = <?php echo Phone_Len; ?>;
        var Area_Len = <?php echo Area_Len; ?>;

        var Status_Len = <?php echo Status_Len; ?>;
        var Type_Len = <?php echo Type_Len; ?>;
        var Furnished_Len = <?php echo Furnished_Len; ?>;

        var Rooms_Len = <?php echo Rooms_Len; ?>;
        var Storey_Len = <?php echo Storey_Len; ?>;

        var Money_Len = <?php echo Money_Len; ?>;

        var Discreption_Len = <?php echo Discreption_Len; ?>;

        var MyPage = '<?php echo Advertise; ?>';
    </script>

    <script type="text/javascript">
<?php
    if ( $GLOBALS['Result'] == 'Done' )
        echo "TriggerMessage(3000, '#53A01A', '<p>Posted</p>');";
?>
    </script>

</body>
</html>

<?php exit(); ?>