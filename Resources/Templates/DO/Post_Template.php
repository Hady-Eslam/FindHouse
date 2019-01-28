<?php  set_error_handler("Error_Handeler"); ?>
<!DOCTYPE>
<html>
<head>
	<title>Post</title>
	
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
		
		<div class='Title'>
            Post
        </div>

        <?php   include_once MessageBox; ?>

        <div class="Post">
            
            <div class="Pictures">
                <img src="<?php echo $GLOBALS['First_Picture']; ?>">
                <img src="<?php echo $GLOBALS['Second_Picture']; ?>">
            </div>

            <div class="User_info">
                <a href="<?php echo $GLOBALS['User_Profile']; ?>">
                    <p><strong>By : </strong><?php echo $GLOBALS['User']; ?></p>
                </a>
                <p><strong>in : </strong><?php echo $GLOBALS['Date']; ?></p>
                <p><strong>Phone : </strong><?php echo $GLOBALS['Phone']; ?></p>
            </div>

            <div class="info">

                <p><strong>Home Details :</strong></p>
                
                <div>

                    <p><strong>Description :</strong></p>
                    
                    <div class="Discreption">
                        <?php echo (empty($GLOBALS['Discreption']))?
                                'No Discreption': $GLOBALS['Discreption']; ?>
                    </div>

                </div>

                <div class="Someinfo">
                    <p><strong>Features :</strong></p>
                    
                    <div>
                        <p><strong>For </strong><?php echo $GLOBALS['Type']; ?></p>
                        <p><strong>For </strong><?php echo $GLOBALS['Status']; ?></p>
                        <p><strong>is Furnished ? 
                            </strong><?php echo $GLOBALS['Furnished']; ?></p>
                                
                    </div>

                    <div>
                        <p>Area : <strong><?php echo $GLOBALS['Area']; ?></strong>
                                Square Feet</p>
                        <p><?php echo $GLOBALS['Rooms']; ?> <strong>Rooms</strong></p>
                        <p><?php echo $GLOBALS['PathRooms']; ?> 
                            <strong>Pathrooms</strong></p>
                        <p>in <strong><?php echo $GLOBALS['Storey']; ?></strong> Floor</p>
                    </div>

                    <div>
                        <p><strong>in : </strong><?php echo $GLOBALS['Address']; ?></p>
                        <p><strong>Price : $ </strong><?php echo $GLOBALS['Money']; ?></p>
                    </div>
                </div>
            </div>


            <div>
                <input type="button" value="Like" id="Like">
                <input type="button" value="DisLike" id="DisLike">
                <span><span id="Likes">
                    <?php echo $GLOBALS['Post_Likes']; ?></span> Likes</span>
                <span><span id="DisLikes">
                    <?php echo $GLOBALS['Post_DisLikes']; ?></span> DisLikes</span>
                <span><span id="Comments">
                    <?php echo $GLOBALS['Comments_Count']; ?></span> Comments</span>
            </div>
        </div>


        <div class="Comments_Div">
            
            <div class="WriteComment">
                <?php Post_Get_User_Link(); ?>
                <textarea rows="2" placeholder="Write Your Comment Here" id="Comment"
                    oninput="CheckinputLen(this.id, Comment_Len);"></textarea>

                <input type="image" src="<?php echo Send; ?>" id="SendComment">
            </div>

        <?php
            foreach ($GLOBALS['Query_Comments_Result'] as $Data) {
                Post_Set_Comments($Data);
            }
        ?>

        </div>

	</section>

	<?php  include_once Footer;  ?>

    <script type="text/javascript">
        var Comment_Len = <?php echo Comment_Len; ?>;

        var MakeCommentPage = '<?php echo MakeCommentPage; ?>';
        var MakeLike_DisLikePage = '<?php echo MakeLike_DisLikePage; ?>';
        
        var Post_id = <?php echo $GLOBALS['Post_id']; ?>;
        var isUser = <?php echo $GLOBALS['isUser']; ?>;
        var User_Link = '<?php echo $GLOBALS['User_Link']; ?>';
        var User_image = '<?php echo $GLOBALS['User_image']; ?>';
        var User_Name = '<?php echo $GLOBALS['User_Name']; ?>';
    </script>

</body>
</html>

<?php exit(); ?>