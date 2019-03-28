<!DOCTYPE>
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
        
        <div id='AdvertiseDiv' class="Advertise">

    <!-- -->
		    <div>
                <span>Advertise Name : *</span>
                <input type="text" name="AddName" id='AddName' placeholder="Advertise Name"
                    oninput="CheckinputLen(this.id, Advertise_Name_Len);">
            </div>

            <div style="padding-left: 80px;">

                <p>Type : *</p>

                <select name="BigType" id="BigType">
                    <option>Select</option>
                    <option>Buy</option>
                    <option>Rent</option>
                </select>

                <select name="SmallType" id="SmallType">
                    <option>Select</option>
                    <option value="Officess">Flat For Officess</option>
                    <option value="Families">Flat For Families</option>
                    <option value="Students">Flat For Students</option>
                </select>
            </div>

            <div>
                <span>Money : *</span>
                <input type="text" name="Money" required placeholder="Money" id='Money'
                    oninput="CheckinputLenAndNumber(this.id, Money_Len);">
            </div>

            <div style="padding-left: 80px;">
                <p>Rooms : *</p>
                <select name="Rooms" id="Rooms">
                	<option>Select</option>
                    <?php
                        for ($i = 0; $i <10 ; $i++) { 
                            echo "<option>$i</option>";
                        }
                    ?>
                </select>
            </div>

            <div style="padding-left: 80px;">
                <p>PathRooms : *</p>
                <select name="PathRooms" id="PathRooms">
                	<option>Select</option>
                    <?php
                        for ($i = 0; $i <10 ; $i++) { 
                            echo "<option>$i</option>";
                        }
                    ?>
                </select>
            </div>

            <div>
                <span>Area : *</span>
                <input type="text" name="Area" required placeholder="Area" id='Area'
                    oninput="CheckinputLenAndNumber(this.id, Area_Len);">
            </div>

            <div style="padding-left: 80px;">
                <p>Furnished : </p>
                <select name="Furnished">
                	<option>Select</option>
                	<option>Yes</option>
                	<option>No</option>
                </select>
            </div>

            <div>
                *
                <textarea cols="200" rows="7" id="Discreption" name="Discreption"
                    placeholder="Enter Your Discreption Here"
                    oninput="CheckinputLen(this.id, Discreption_Len);"></textarea>
            </div>

            <div style="border-bottom-color: #454545;border-bottom-style: solid;border-bottom-width: 1px;">

                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image1' name = 'image1'
                    onclick="GetPicture('#File1');">
                
                <input type="file"id='File1'name='File1'onchange="Read(this,'#image1');">

                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image2' name = 'image2'
                    onclick="GetPicture('#File2');">

                <input type="file" id='File2'name='File2'onchange="Read(this,'#image2');">

                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image3' name = 'image3'
                    onclick="GetPicture('#File3');">

                <input type="file" id='File3' name='File3' onchange="Read(this,'#image3');">

                <input type="image" src="<?php echo AddPicture; ?>" width="80"
                    height="80" alt="AddPicture" id='image4' name = 'image4'
                    onclick="GetPicture('#File4');">

                <input type="file" id='File4' name='File4' onchange="Read(this,'#image4');">           
            </div>

            <div>
                <span>City : </span>
                <input type="text" name="City" id='City' placeholder="City"
                    oninput="CheckinputLen(this.id, Address_Len);"
                    value="<?php echo $_SESSION['Address']; ?>">
            </div>

            <div>
                <span>User Name : </span>
                <input type="text" name="UserName" id='UserName' placeholder="User Name"
                    oninput="CheckinputLen(this.id, Name_Len);"
                    value="<?php echo $_SESSION['Name']; ?>">
            </div>

            <div>
                <span>Phone : </span>
                <input type="text" id='Phone' value="<?php echo $_SESSION['Phone']?>"
                    oninput="CheckinputLen(this.id, Phone_Len);" name="Phone">
            </div>

            <div>
                Contact Me By 
                <input type="radio" name="ContactMe" checked value="Both">Both
                <input type="radio" name="ContactMe" value="Phone">Phone
                <input type="radio" name="ContactMe" value="Messages">Messages
            </div>

            <div>
                <span><input type="checkbox" id="TermsOfUse"> When You Advertise You Agree in the Terms of Use</span>
            </div>

    <!--  -->
            <div>
                <input type="submit" value="Post" id='Submit'>
            </div>

        </div>

    </section>

    <?php  include_once Footer;  ?>
    
    <script type="text/javascript">
        var Advertise_Name_Len = <?php echo Advertise_Name_Len; ?>;
        var Area_Len = <?php echo Area_Len; ?>;
        var Discreption_Len = <?php echo Discreption_Len; ?>;

        var Address_Len = <?php echo Address_Len; ?>;
        var Name_Len = <?php echo Name_Len; ?>;
        var Money_Len = <?php echo Money_Len; ?>;
        var Phone_Len = <?php echo Phone_Len; ?>;
    </script>

</body>
</html>

<?php exit(); ?>