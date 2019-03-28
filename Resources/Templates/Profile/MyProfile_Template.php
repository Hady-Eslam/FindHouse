<!DOCTYPE>
<html>
<head>
	<title>My Profile</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>MyProfile.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>


    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

    <script src="<?php echo PagesScripts; ?>MyProfileScript.js"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

        <?php   include_once MessageBox; ?>

        <div class="info" style="position: sticky;width: 30%;">

            <a href="<?php echo User.$_SESSION['ID']; ?>">
                <input type="image" src="<?php echo $_SESSION['Picture']; ?>"></a>
            <p><span>ID</span> : <?php echo $_SESSION['ID'];?></p>
            <p><span>Name</span> : <?php echo $_SESSION['Name'];?></p>
            <p><span>Email</span> : <?php echo $_SESSION['Email'];?></p>
            <p><span>Phone</span> : <?php echo $_SESSION['Phone'];?></p>
            <p><span>Sign UP Date</span> : <?php echo $_SESSION['Sign_UP_Date'];?></p>
            <p><span>Number Of Posts</span> =
                <span class="Number"><?php echo $_SESSION['Posts'];?></span></p>

        </div>

        <div class="Posts" style="vertical-align: top;width: 65%;padding-left: 35%;
                position: sticky;top: 70px;">

            <div>
                <input type="button" value="All Adds" style="width: 20%;
                    background-color: green;border-color: green;margin: 5px;"
                    onclick="location.href = '<?php echo MyProfile; ?>';">

                <input type="button" value="Pedding Adds" style="width: 20%;margin: 5px;
                    background-color: #c6c608;border-color: #c6c608;"
                    onclick="location.href ='<?php echo MyProfile.'/PeddingPosts'; ?>';">

                <input type="button" value="Rejected Adds" style="width: 20%;margin: 5px;
                    background-color: red;border-color: red;"
                    onclick="location.href = '<?php echo MyProfile.'/RejectedPosts'; ?>';">

                <input type="button" value="Approved Adds" style="width: 20%;margin: 5px;
                    background-color: green;border-color: green;"
                    onclick="location.href = '<?php echo MyProfile.'/ApprovedPosts'; ?>';">
            </div>
            
            <!--<div  id="Post2"  class="Article" >
                <div   class="Article_Header" >
                    <div   >
                        <a  href="http://127.0.0.1:8000/Profile/User/1">
                            <input type="image" src="/Static/Pictures/OnlineUser.PNG"   >
                        </a>
                    </div>
                    <div   >
                        <p   >
                            <strong  >By </strong> : Eslam
                        </p>
                        <p   >
                            <strong  >Date </strong> : 2019-02-01 16:58:03.390239+00:00
                        </p>
                    </div>
                    <div   class="Options" >
                        <input type="image" src="/Static/Pictures/DropDown.PNG"   onclick="MakeSlide(2);">
                        <div  id="DropDownBox2"  >
                            <a    onclick="Edit(2)" >Edit</a>
                            <a   class="Delete"  onclick="Delete(2)" >Delete</a>
                        </div>
                    </div>
                </div>
                <p   class="Article_Title" ><strong  >Title : </strong>New Article</p>
                <p   class="Article_Tags" ><strong  >Tags : </strong>
                    <a   class="Tags"  ><strong  >#Edit Here</strong></a>
                    <a   class="Tags"  ><strong  >#HELLO</strong></a>
                    <a   class="Tags"  ><strong  >#OKOKOK</strong></a>
                </p>
                <div>
                    <p   >Hey</p>
                    <p>From</p>
                    <p></p>
                </div>
                <div   class="Article_Link" >
                    <a  href="http://127.0.0.1:8000/Articles/Article/2"   >The Link To Full Article</a>
                </div>
                <div   class="Article_Statics" >
                    <p   ><span  >Likes </span>7</p>
                    <p   ><span  >DisLikes </span>3
                    </p><p   ><span  >Comments </span>9
                    </p>
                </div>
            </div>-->

            <?php
                $Count = false;
                foreach ($GLOBALS['Result'] as $Value){
                    $Count = true;
                    MyProfile_Get_Post($Value);
                }

                if ( $Count == false )
                    echo '<p>No Posts Found</p>';
            ?>
        </div>

    </section>


    <?php  include_once Footer;  ?>

    <script type="text/javascript">
        var DeletePostPage = '<?php echo DeletePostPage; ?>';
    </script>

</body>
</html>

<?php exit(); ?>