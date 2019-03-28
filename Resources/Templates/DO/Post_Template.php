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
                    <p><?php echo $GLOBALS['Date']; ?></p>
                    <p><?php echo $GLOBALS['POST_ID']; ?></p>
                </div>
                
                <?php Post_GetFirstPicture(); ?>

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

                <?php  Post_GetPictures(); ?>

            </div>

            <div style="display: inline-block; width: 25%;">
                <div style="background-color: green;border-color: green;border-style: solid;border-width: 1px;border-radius: 5px;height: 30px;">
                    <p style="margin: 0px;"><?php echo $GLOBALS['Money']; ?> $</p>
                </div>

                <?php
                    if ( $GLOBALS['Contact_Status'] != '2' ){
                        ?>
                            <div style="background-color: green;border-color: green;border-style: solid;border-width: 1px;border-radius: 5px;height: 30px;">
                                <p style="margin: 0px;"><?php echo $GLOBALS['Phone']; ?></p>
                            </div>

                        <?php
                    }
                ?>

                <div style="<?php
                    if ( $GLOBALS['Status'] == 0 )
                            echo 'background-color: #c6c608;border-color: #c6c608;';
                        else if ( $GLOBALS['Status'] == -1 )
                            echo 'background-color: red;border-color: red;';
                        else
                            echo 'background-color: green;border-color: green;';
                    ?>
                        border-style: solid;border-width: 1px;border-radius: 5px;height: 30px;">
                    <p style="margin: 0px;"><?php
                        if ( $GLOBALS['Status'] == 0 )
                            echo 'Still Pedding';
                        else if ( $GLOBALS['Status'] == -1 )
                            echo 'Rejected';
                        else
                            echo 'Available';
                    ?></p>
                </div>

        <?php
            if ( SESSION() && $_SESSION['Status'] == '0' && $GLOBALS['Status'] == '0' ){
            ?>
                <script type="text/javascript">
                    function ApprovePost(){
                        location.href =
                            '<?php echo AdminAcceptPost.$GLOBALS['POST_ID']; ?>';
                    }

                    function RejectPost(){
                        location.href =
                            '<?php echo AdminRejectPost.$GLOBALS['POST_ID']; ?>';
                    }
                </script>

                <div style="height: 30px;">
                    <input type="button" value="Approve" style="background-color: green;
                            width: 35%;border-color: green;"
                            onclick="ApprovePost()">
                    <input type="button" value="Reject" style="background-color: red;
                            width: 35%;border-color: red;"
                            onclick="RejectPost()">
                </div>
            <?php
            }

            if ( SESSION() && $_SESSION['Status'] == '0' && $GLOBALS['Status'] == '1' ){
            ?>
                <script type="text/javascript">
                    function DeletePost(){
                        if ( confirm('Are You Sure Want To Delete This Post ?') == false )
                            return ;

                        location.href =
                            '<?php echo AdminDeletePost.$GLOBALS['POST_ID']; ?>';
                    }
                </script>

                <div style="height: 30px;">
                    <input type="button" value="Delete Advertise" 
                        style="background-color: red;width: 70%;border-color: red;"
                        onclick="DeletePost()">
                </div>
            <?php
            }
        ?>

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

        <?php
            if ( $GLOBALS['Contact_Status'] != '1' ){
            ?>
                <div style="text-align: left;" id="MakeMessage">
                    <p>Make Message</p>

                    <div>
                        <?php Post_Check_Email(); ?>

                        <textarea cols="10" rows="10" style="display: block;margin: 10px;"
                            placeholder="Enter Your Message Here" id="Message"
                            name="Message"></textarea>
                    </div>

                    <input type="submit" value="Send" id="SendMessage">
                </div>
            <?php
            }
        ?>

        <div style="text-align: left;">
            <p>Advertisement For This User</p>
            <?php
                Post_Get_User_Posts();
                foreach ($GLOBALS['User_Posts'] as $Value) {
                    Post_Show_User_Post($Value);
                }
            ?>
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