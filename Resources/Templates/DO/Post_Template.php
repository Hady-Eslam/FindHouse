<!DOCTYPE>
<html>
<head>
	<title><?php echo $GLOBALS['Add_Name']?></title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>Post.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>

    <script src="<?php echo SetError_FunctionScript; ?>"></script>
    <script src="<?php echo TriggerMessageScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>PostScript.js"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

        <?php   include_once MessageBox; ?>

        <div class="Post">

            <div style="vertical-align: top;padding: 0px;margin: 0px;display: inline-block;
                    padding-left: 5%;width: 65%">

                <div style="font-size: 15px;">
                    <p style="padding: 0px;margin: 0px;"><?php echo $GLOBALS['Add_Name']?></p>
                    <p><?php echo $GLOBALS['SmallType'].' For '.$GLOBALS['BigType']; ?></p>
                    <p><?php echo $GLOBALS['Date']?></p>
                    <p><?php echo $GLOBALS['POST_ID']?></p>
                </div>
                
                <div class="Pictures" style="border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color: #454545;">
                    <img src="<?php echo $GLOBALS['First_Picture']; ?>"
                        style="vertical-align: top;">
                </div>

                <div style="border-bottom-style: solid;border-bottom-width: 1px;border-bottom-color: #454545;">
                    <div>
                        <span>Rooms : <?php echo $GLOBALS['Rooms']; ?></span>
                        <span>PathRooms : <?php echo $GLOBALS['PathRooms']; ?></span>
                    </div>

                    <div>
                        <span>Area : <?php echo $GLOBALS['Area']; ?></span>
                        <span>Furnished : <?php echo $GLOBALS['Furnished']; ?></span>
                    </div>

                    <div>
                        <p><?php echo $GLOBALS['Discreption']; ?></p>
                    </div>
                </div>

                <div class="Pictures">
                    <img src="<?php echo $GLOBALS['Second_Picture']; ?>"
                        style="vertical-align: top;">
                </div>

                <div class="Pictures">
                    <img src="<?php echo $GLOBALS['Third_Picture']; ?>"
                        style="vertical-align: top;">
                </div>

                <div class="Pictures">
                    <img src="<?php echo $GLOBALS['Fourth_Picture']; ?>"
                        style="vertical-align: top;">
                </div>

            </div>

            <div style="display: inline-block; width: 25%;">
                <div style="background-color: blue;border-color: blue;border-style: solid;border-width: 1px;border-radius: 5px;height: 30px;">
                    <p style="margin: 0px;"><?php echo $GLOBALS['Money']; ?> $</p>
                </div>

                <div style="background-color: blue;border-color: blue;border-style: solid;border-width: 1px;border-radius: 5px;height: 30px;">
                    <p style="margin: 0px;"><?php echo $GLOBALS['Phone']; ?></p>
                </div>

                <div>
                    
                    <div class="User_info">
                        <a href="<?php echo $GLOBALS['User_Profile']; ?>">
                            
                            <img src="<?php echo OnlineUser; ?>" style="width: 80px;height: 80px;
                                border-radius: 50%;display: inline-block;">

                            <div style="display: inline-block;">
                                <p><?php echo $GLOBALS['User_Name']; ?></p>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>

        <div style="text-align: left;" id="MakeMessage">
            <p>Make Message</p>

            <div>
                <?php Post_Check_Email(); ?>

                <textarea cols="10" rows="10" style="display: block;margin: 10px;"
                placeholder="Enter Your Message Here" id="Message" name="Message"></textarea>
            </div>

            <input type="submit" value="Send" id="SendMessage">
        </div>

	</section>

	<?php  include_once Footer;  ?>

    <script type="text/javascript">
        var MakeMessagePage = '<?php echo MakeMessage; ?>';
        var Message_Len = <?php echo Message_Len; ?>;
        var Email_Len = <?php echo Email_Len; ?>;
    </script>

</body>
</html>

<?php exit(); ?>