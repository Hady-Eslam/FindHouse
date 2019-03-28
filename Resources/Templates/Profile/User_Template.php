<!DOCTYPE>
<html>
<head>
	<title>User</title>
	
	<link rel="stylesheet" type="text/css" href="<?php echo AllPagesCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo PagesCSS; ?>User.CSS">

    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo DropBoxScript; ?>"></script>


    <script src="<?php echo TriggerMessageScript; ?>"></script>
    <script src="<?php echo SetError_FunctionScript; ?>"></script>

</head>
<body>

    <?php include_once AllHeaders; ?>

	<section>

        <?php   include_once MessageBox; ?>

        <div class="info" style="position: sticky;top: 60px;width: 25%;display: inline-block;
                    font-size: 15px;">

            <input type="image" src="<?php echo $GLOBALS['Base_User_Picture']; ?>">
            <p><span>ID</span> : <?php echo $GLOBALS['User_ID'];?></p>
            <p><span>Name</span> : <?php echo $GLOBALS['Base_User_Name'];?></p>
            <p><span>Number Of Posts</span> = <?php echo $GLOBALS['Posts_Number'];?></p>
            <?php
                if ( SESSION() && $_SESSION['Status'] == '0' ){
                ?>
                    <script type="text/javascript">
                        function DeleteAccount(){
                            location.href = 
                                    '<?php echo AdminDeleteAccount.$GLOBALS['User_ID']; ?>';
                        }
                    </script>

                    <input type="button" value="Delete Account" style="height: 40px;width: 50%;
                        background-color: red;border-color: red;"
                            onclick="DeleteAccount();">
                <?php
                }
            ?>

        </div>

        <div class="Posts" style="width: 60%;display: inline-block;">
            <?php 
                $Count = false;
                foreach ($GLOBALS['Result'] as $Value){
                    $Count = true;
                    User_Get_Post($Value);
                }

                if ( $Count == false )
                    echo '<p>No Pedding Posts Found</p>';
            ?>
        </div>
    </section>


    <?php  include_once Footer;  ?>

</body>
</html>

<?php exit(); ?>