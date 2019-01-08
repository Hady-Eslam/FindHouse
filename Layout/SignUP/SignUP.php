<?php
/**
 *  - Page name : SignUP.php
 *  - Discreption : The Page Shows When Signing UP
 *  
 *  - What is Doing
 *      1 - Put Page API ERROR Code
 *      2 - Put Sign Error Handler
 *      3 - include neccessary Files
 *      4 - Check Page Status
 *      5 - Check User IP can Sign Or Not
                ( 2 Sign UP For every 3 Hours)
 *      6 - Check if user is Logged in
                ( Log Out )
 *      7 - Check if Request Send
 *          1 =>    Check Data
 *          2 =>    Save Data And Send Email
 *          3 =>    Save IP
 *          4 =>    Page Statics (not implements)
 *      
**/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;
include_once Sign_Dir_PHP.'ProccessData.php';

$GLOBALS['Page_API_Error_Code'] = 'P1';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Sign UP");
if ( $PageStatus == 0 ){
    include_once ClosedPage;
    exit();
}
else if ( $PageStatus == -1 ){
    include_once ErrorPage;
    exit();
}
/*
                            Check if User Can Enter this Page Or NOT
Function Output
    return array(-1, $MySql->Error, 'Searching IP Query', 'Can This ip Sign');
    return array(-1, $MySql->Error, 'Fetching ip', 'Can This ip Sign');
    return array(-1, $MySql->Error, 'Fetching ip', 'Can This ip Sign');
    return array(-1, $MySql->Error, 'Comparing Date', 'Can This ip Sign');
    return array(-1, $MySql->Error, 'Comparing Date Houres','Can This ip Sign');
    return array(0, 'NO');
    return array(0, 'Can');
    return array(-1, ErrorReturn('My Sql Error', '15',
                "Exception in Dealing With Data in Searching For ip"),
                'Dealing With Data in Searching For ip', 'Can This ip Sign');

*/
$Result = CanThisiPSign();
if ( $Result[0] == -1 ){
    include_once ErrorPage;
    exit();
}
else if ( $Result[0] == 0 ){
    if ( $Result[1] == 'NO' ){
        include_once CanNotAccessNow;
        SetPage('Sign UP', 'You Have Only 2 Sign UP in Every 3 Hours So You Can Not Access This Page Now');
        exit();
    }
}

/* 
                            Check if User Is Logging in
*/
$_SESSION['Page Name'] = 'Sign UP';
$Result = array(-2 ,'');

if ( isset($_SESSION['Name']) ){
    include_once LogOutPage;
    exit();
}

/*
                            if The Request is Send
*/
if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['N'])
    && isset($_POST['E']) && isset($_POST['P'])
    && isset($_POST['Ph']) && isset( $_SERVER["HTTP_REFERER"] ) ){
    
    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }
    
    if ( $URL_REFERER->URLResult != SignUP ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
                            Check Data Sended
    CheckData Output
        return array(0, 'Empty');
        return array(0, 'Too Long');

        return array( -1, $MySql->Error, $Key, 'Check Data');
        return array( 0, 'Found In Users', $Key, 'Check Data');
        return array( 0, 'Found In Waiting_Users', $Key, 'Check Data');
        return array( 0, 'Not Found', $Key, 'Check Data');

*/
    $Result = CheckData();  //  Function in ProcessData.php
    if ( $Result[0] == 0 ){
        
        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' ){
            header('Location:'.SignUP);
            exit();
        }
        else if ( $Result[1] == 'Not Found' ){
/*
                        Saving Data    
SaveData() Output
    return array(-1, $MySql->Error, 'inserting Data', 'Saving Data');
    return array(-1, $MySql->Error, 'Getting Token', 'Saving Data');
    return array(-1, $MySql->Error, 'inserting Token', 'Saving Data');
    return array(-1, $EMaile->Error, 'Emailing', 'Saving Data');
    return array(0, 'Failed Mailing', 'Saving Data');

    SaveIP()
        return array(-1, $MySql->Error, 'Searching IP', 'Saving ip');
        return array(-1, $MySql->Error, 'Fetching Data', 'Saving ip');
        return array(-1, $MySql->Error, 'Comparing Date', 'Saving ip');
        return array(-1, $MySql->Error, 'Comparing Date Houres', 'Saving ip');
        return array(-1, $MySql->Error, 'Saving ip Number of visit', 'Saving ip');
        return array(-1, $MySql->Error, 'Saving ip Last visit', 'Saving ip');
        return array(-1, ErrorReturn('My Sql Error', '15',
                "Exception in Dealing With Data in Searching For ip"),
                'Dealing With Data', 'Saving ip');
        return array(-1, $MySql->Error, 'Saving New IP', 'Saving ip');

        Statics()
            return array(-1, $Page->Error, 'Making Statics', 'Statics');
            return array(0, 'Done');
*/
            $Result = SaveData();   //  Function in ProcessData.php
            include_once HashClass;
            include_once OpenSession;
            if ( $Result[0] == 0 ){
                if ( $Result[1] == 'Done' ){

                    $Result = OpenSession('waiting_users');
                    if ( $Result[0] == 0 ){
                        header("Location:".SuccessSignUP.'?E='
                            .$Hashing->Hash_Email($GLOBALS['E']));
                        exit();
                    }
                }
            }
            else{
                if ( $Result[2] != 'inserting Data'  && $Result[2] != 'Getting Token' 
                  && $Result[2] != 'inserting Token' && $Result[2] != 'Emailing' ){
                    
                    $Result = OpenSession('waiting_users');
                    if ( $Result[0] == 0 ){
                        header("Location:".SuccessSignUP.'?E='
                            .$Hashing->Hash_Email($GLOBALS['E']));
                        exit();
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE >
<html>
<head>
	
	<title>Sign UP</title>
	<link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
	<link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
	<link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">
    <style type="text/css">
        .SignInForm{
            text-align: left;
        }
    </style>
    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo ConfirmPasswordScript; ?>"></script>
    <script src="<?php echo CheckPatternScript; ?>"></script>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>
    <script src="<?php echo CheckNameScript; ?>"></script>

    <script src="<?php echo Sign_Dir_Script; ?>CheckScript.js"></script>
</head>

<body>

	<?php include_once NotLoggedHeaders; ?>

	<section >

		<div class = 'Title'>
			Sign UP
		</div>

<?php
        if ( $Result[0] == -1 && $Result[3] == 'Open Session' ){
        ?>
            <p style="color: red;">Your Data is SuccessFull Saved But Error Occured When Opening Session</p>
            <p style="color: red">So Go To Log in Page</p>
        <?php
        }else{
?>

		<form id='SignForm' method="post" enctype="multipart/form-data"
            class='SignInForm' action="<?php echo $_SERVER['PHP_SELF'];?>">

            <?php   include_once MessageBox; ?>

            <div style="display: block;text-align: center;">
    			
                <div style="margin: 0 0 0 0;">
    				<input class="Input_Data" onfocus="Focus(this);" oninput="CheckName()"
                        onblur="Blur(this);" type="text" id='Name' name="N" 
                        required placeholder="Enter Your Name"  
                        <?php
                            if ( $Result[0] != -2 )
                                echo "value='".$GLOBALS['N']."'";
                        ?>>
    			</div>

    			<div style="margin: 0 0 0 0;">
    				<input class="Input_Data" onfocus="Focus(this);" onchange="CheckEmail()"
                        onblur="Blur(this);" type="text" id='Email' name="E" 
                        required placeholder="Enter Your Email" 
                        <?php
                            if ( $Result[0] != -2 )
                                echo "value='".$GLOBALS['E']."'";
                        ?>>
    			</div>

                <div style="margin: 0 0 0 0;">
                    <input class="Input_Data" onfocus="Focus(this);" 
                        onblur="Blur(this);" id='Phone' type="text" name="Ph" 
                        required placeholder="Enter Your Phone" 
                        <?php
                            if ( $Result[0] != -2 )
                                echo "value='".$GLOBALS['Ph']."'";
                        ?>>
                </div>

                <div style="margin: 0 0 0 0;">
                    <input class="Input_Data" onfocus="Focus(this);" 
                        onblur="Blur(this);" id='Password' type="password" 
                         required name="P" placeholder="Enter Your Password">
                </div>

                <div style="margin: 0 0 0 0;">
                    <input class="Input_Data" onfocus="Focus(this);" 
                        onblur="Blur(this);" id='ConPassword' type="password" 
                         required placeholder="Re-Enter Password">
                </div>
            </div>
            
            <div style="display: block;text-align: center;">

                <div style="font-size: 15px;">
                    <input type="checkbox" id='Terms'> I hereby agree for processing
                    my personal <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;details by
                    <a href="<?php echo Policy; ?>" 
                        style="display: inline;">Terms of use</a> of FindHouse
                </div>

                <div style="font-size: 15px;">
                    <input type="checkbox" id='Updates' name='Up' 
                    <?php
                        if ( $Result[0] != -2 ){
                            if ( isset($_POST['Up']) )
                                echo 'checked';
                        }
                        else
                            echo 'checked'; 
                    ?>>
                        I want to receive news and promotion updates
                </div>

                <div style="text-align: center;">
                    <input type="submit" value="Sign UP" class='Button'
                        id='#FormSubmit'>
                </div>
            </div>
            <a href="<?php echo Help; ?>" 
                style="font-size: 18px;text-align: center;">How To Sign UP ?</a>
		</form>
<?php
    }
?>
	</section>

    <?php  include_once Footer;  ?>

    <script type="text/javascript">
<?php
    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Found In Users' || $Result[1] == 'Found In Waiting_Users' ){
            if ( $Result[2] == 'email' ){
            ?>
                $('#Email').css('border-color','red');
            <?php
            }
            else{
            ?>
                $('#Name').css('border-color','red');
            <?php
            }
        }
        else if ( $Result == 'Failed Mailing' ){
        ?>
            $('#Email').css('border-color','red');
            alert('Failed To Send Email Please Check if The Email is valid');
        <?php
        }
    }
    else if ( $Result[0] == -1 ){
        include_once TrigerMessage;
    }
?>
    </script>
    <script type="text/javascript">
        var CheckPage = '<?php echo Check; ?>';
        var MyPage = '<?php echo SignUP; ?>';

        var Email_Len = <?php echo Email_Len; ?>;
        var Name_Len = <?php echo Name_Len; ?>;
        var Password_Len = <?php echo Password_Len; ?>;
        var Phone_Len = <?php echo Phone_Len; ?>;
    </script>
</body>
</html>