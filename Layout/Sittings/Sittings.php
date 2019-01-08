<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P9';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Sittings");
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
$_SESSION['Page Name'] = 'Sittings';
$Result = array(-2 ,'');

if ( !isset($_SESSION['Name']) ){
    include_once UnAuthurithedUser;
    exit();
}
else if ( $_SESSION['Status'] == '2' ){
    include_once UnAuthurithedUser;
    exit();
}

if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_SERVER["HTTP_REFERER"]) &&
    (
        ( isset($_POST['PictureSubmit']) && isset($_FILES['File1']) ) ||
        ( isset($_POST['NameSubmit']) && isset($_POST['N']) ) ||
        ( isset($_POST['PhoneSubmit']) && isset($_POST['Ph']) ) ||
        ( isset($_POST['PasswordSubmit']) && isset($_POST['OP']) && isset($_POST['P']) ) ||
        ( isset($_POST['NotificationsSubmit']) ) ||
        ( isset($_POST['EmailNotificationsSubmit']) ) ||
        ( isset($_POST['DeactivateSubmit']) )
    )
){
    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }
    
    if ( $URL_REFERER->URLResult != Sittings ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
    CheckData()
        return array(0, 'Empty');
        return array(0, 'Too Long');

        return array(-1, $MySql->Error, 'in Saving The Picture in DataBase', 'Check Data');
        return array(-1, $MySql->Error, 'in Saving The Name in DataBase', 'Check Data');
        return array(-1, $MySql->Error, 'in Saving The Phone in DataBase', 'Check Data');
        return array(-1, $MySql->Error, 'in Searching The Password is Right Or Not',
                                    'Check Data');
        return array(0, 'Wrong Password');
        return array(-1, $MySql->Error, 'in Saving The Password in DataBase', 'Check Data');
        return array(-1, $MySql->Error, 'in Saving The Notifications in DataBase', 
                                    'Check Data');
        return array(-1, $MySql->Error, 'in Saving The Notifications in DataBase', 
                                    'Check Data');
        return array(0, 'Done');
*/  
    include_once Sittings_Dir_PHP.'Change.php';
    $Result = CheckData();
    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' ){
            header("Location:".Sittings);
            exit();
        }
        header("Location:".Sittings.'?Status='.$Result[1]);
    }
    else
        header("Location:".Sittings.'?Status=NO');
}
?>

<!DOCTYPE >
<html>
<head>
	<title>Sittings</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

<?php
    if ( isset($_GET['Section']) ){

        if ( $_GET['Section'] == 'Picture' ){
        ?>
            <script src="<?php echo AddPictureScript; ?>"></script>
            <script src="<?php echo Sittings_Dir_Script; ?>Picture.js"></script>
        <?php
        }
        else if ( $_GET['Section'] == 'Name' ){
        ?>
            <script src="<?php echo CheckNameScript; ?>"></script>
            <script src="<?php echo CheckLenScript; ?>"></script>
            <script src="<?php echo Sittings_Dir_Script; ?>Name.js"></script>
        <?php
        }
        else if ( $_GET['Section'] == 'Phone' ){
        ?>
            <script src="<?php echo Sittings_Dir_Script; ?>Phone.js"></script>
        <?php
        }
        else if ( $_GET['Section'] == 'Password' ){
        ?>
            <script src="<?php echo CheckLenScript; ?>"></script>
            <script src="<?php echo CheckinputLenScript; ?>"></script>
            <script src="<?php echo ConfirmPasswordScript; ?>"></script>
            <script src="<?php echo Sittings_Dir_Script; ?>Password.js"></script>
        <?php
        }
        else if ( $_GET['Section'] == 'Notifications' ){
        ?>
            <script src="<?php echo Sittings_Dir_Script; ?>Notifications.js"></script>
        <?php
        }
        else if ( $_GET['Section'] == 'Email' ){
        ?>
            <script src="<?php echo Sittings_Dir_Script; ?>EmailNotifications.js"></script>
        <?php
        }
        else{
        ?>
            <script src="<?php echo Sittings_Dir_Script; ?>DeActivate.js"></script>
        <?php
        }
    }
    else{
    ?>
        <script src="<?php echo AddPictureScript; ?>"></script>
        <script src="<?php echo Sittings_Dir_Script; ?>Picture.js"></script>
    <?php
    }
?>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>
    <script src="<?php echo TriggerFormScript; ?>"></script>
    <script src="<?php echo Sittings_Dir_Script; ?>SittingsScript.js"></script>

    <style type="text/css">
        .Div1{
            display: inline-block;
            text-align: left;
        }
        .Div1 .Div2{
            
        }
        .Button_Div{
            text-align: center;
        }
        .Sittings_Button{
            display: block;
            width: 200px;
            margin: 10 10 10 10;
        }
    </style>

</head>
<body>

    <?php include_once LoggedHeaders; ?>

    <section style="text-align: left;">

        <div class = 'Title' >
            Sittings
        </div>

        <?php include_once MessageBox; ?>

        <div class="Div1" >
            
            <input type="button" name="" class="Button Sittings_Button" 
                    value="Change Profile Picture" id='PictureButton'>

            <input type="button" name="" class="Button Sittings_Button" 
                    value="Change Name" id='NameButton'>
            
            <input type="button" name="" class="Button Sittings_Button"
                    value="Change Phone" id='PhoneButton'>
            
            <input type="button" name="" class="Button Sittings_Button"
                    value="Change Password" id='PasswordButton'>
            
            <input type="button" name="" class="Button Sittings_Button"
                    value="Notifications" id='NotificationsButton'>
            
            <input type="button" name="" class="Button Sittings_Button"
                    value="Email Notifications" id='EmailButton'>
            
            <input type="button" name="" class="Button Sittings_Button"
                    value="De Activate" id='DeActivateButton'>
        </div>

        <div class="Div1">
<?php
    if ( isset($_GET['Section']) ){
        
        if ( $_GET['Section'] == 'Picture' )
            include_once Sittings_Dir_Layout.'Picture.php';
        else if ( $_GET['Section'] == 'Name' )
            include_once Sittings_Dir_Layout.'Name.php';
        else if ( $_GET['Section'] == 'Phone' )
            include_once Sittings_Dir_Layout.'Phone.php';
        else if ( $_GET['Section'] == 'Password' )
            include_once Sittings_Dir_Layout.'Password.php';
        else if ( $_GET['Section'] == 'Notifications' )
            include_once Sittings_Dir_Layout.'Notifications.php';
        else if ( $_GET['Section'] == 'Email' )
            include_once Sittings_Dir_Layout.'EmailNotifications.php';
        else
            include_once Sittings_Dir_Layout.'DeActivate.php';
    }
    else
        include_once Sittings_Dir_Layout.'Picture.php';
?>
        </div>

    </section>

    <?php  include_once Footer;  ?>

    <script type="text/javascript">
        // Length
        var Name_Len = <?php echo Name_Len; ?>;
        var Phone_Len = <?php echo Phone_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;

        // Pages
        var CheckPage = '<?php echo Check; ?>';
        var MyPage = '<?php echo Sittings; ?>';
    </script>
    <script type="text/javascript">
<?php
    if ( isset($_GET['Status']) ){
        if ( $_GET['Status'] == 'NO' )
            include_once TrigerMessage;
        else if ( $_GET['Status'] == 'Done' ){
        ?>
            SetMessage(2500, 'green' , '<p>Changed</p>');
        <?php
        }
        else{
        ?>
            SetMessage(2500, 'red' , '<p>Wrong Password</p>');
        <?php
        }
    }
?>
    </script>

</body>
</html>