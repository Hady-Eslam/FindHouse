<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once Session;

$GLOBALS['Page_API_Error_Code'] = 'P8';     // Only For Pages
set_error_handler("Error_Handeler");

/*
    Check The Status Of The Page
        Function OutPut ( -1  0  1 )
*/
include_once PageStatus;
$PageStatus = $Page->isPageOnWork("Advertise");
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
$_SESSION['Page Name'] = 'Advertise';
$Result = array(-2 ,'');

if ( !isset($_SESSION['Name']) ){
    include_once UnAuthurithedUser;
    exit();
}
else if ( $_SESSION['Status'] == '2' ){
    include_once UnAuthurithedUser;
    exit();
}
if ( $_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['G']) &&
    isset($_POST['S']) && isset($_POST['D']) && isset($_POST['St']) &&
    isset($_POST['Status']) && isset($_POST['Ty']) && isset($_POST['Fur']) &&
    isset($_POST['Ph']) && isset($_POST['A']) && isset($_POST['Storey']) &&
    isset($_POST['R']) && isset($_POST['PR']) && isset($_POST['M']) &&
    isset($_FILES['File1']) && isset($_FILES['File2']) && isset($_FILES['File3']) &&
    isset($_POST['Dis']) && isset($_SERVER["HTTP_REFERER"]) 
){
    if ( isset($_GET['Status']) )
        unset($_GET['Status']);
    
    include_once URL;
    if ( $URL_REFERER->GetURLPath() == -1 ){
        include_once ErrorPage;
        exit();
    }
    
    if ( $URL_REFERER->URLResult != Advertise ){
        include_once UnAuthurithedUser;
        exit();
    }
/*
    CheckData() OutPut
        return array(0, 'Empty');
        return array(0, 'Too Long');
        return array(0, 'Wrong Data');

        return array(-1, $MySql->Error, 'Saving Post into DataBase', 'Save Data');
        return array(0, 'Done');
*/
    include_once Ad_Dir_PHP.'ProcessData.php';
    $Result = CheckData();
    //var_dump($Result);
    if ( $Result[0] == 0 ){
        if ( $Result[1] == 'Empty' || $Result[1] == 'Too Long' ||
             $Result[1] == 'Wrong Data' 
         ){
            header('Location:'.Advertise);
            exit();
        }
        header('Location:'.Advertise.'?Status=true');
    }
}
?>
<!DOCTYPE >
<html>
<head>
    <title>Advertise</title>
    <link rel="stylesheet" type="text/css" href="<?php echo HeaderCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo CenterCSS; ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo FooterCSS; ?>">
    <link rel="icon" type="image/JPG" href="<?php echo LOGO; ?>">

    <script src="<?php echo JQueryScript; ?>"></script>
    <script src="<?php echo JQueryCookieScript; ?>"></script>

    <script src="<?php echo DropBoxScript; ?>"></script>
    <script src="<?php echo SetCookieScript; ?>"></script>

    <script src="<?php echo CheckLenScript; ?>"></script>
    <script src="<?php echo CheckNumberOrNotScript; ?>"></script>
    <script src="<?php echo SetMessageBoxScript; ?>"></script>
    <script src="<?php echo AddPictureScript; ?>"></script>
    <script src="<?php echo CheckinputLenScript; ?>"></script>
    <script src="<?php echo CheckinputLenAndNumberScript; ?>"></script>
    <script src="<?php echo TriggerFormScript; ?>"></script>

    <script src="<?php echo Ad_Dir_Script; ?>AdvertiseScript.js"></script>
</head>

<body>

    <?php include_once LoggedHeaders; ?>
    
    <section>
        
        <div class = 'Title' >
            Advertise
        </div>

        <?php   include_once MessageBox; ?>
        <div id='AdvertiseDiv'>
        <!--<form id='AdvertiseForm' method="post" enctype="multipart/form-data"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">-->
<!-- Address -->
            <div>
                Governor Of : 
                <select class="Input_Data" id='Governor' name='G' 
                        onfocus="Focus(this);" onblur="Blur(this);">
                    <option>Assiut</option>
                    <option>Menia</option>
                    <option>Sohag</option>
                </select>
                <span style="color: red;">*</span>
            </div>

            <div>
                Station : 
                <select class="Input_Data" id='Station' name='S' 
                        onfocus="Focus(this);" onblur="Blur(this);">
                    <option>Assiut</option>
                    <option>Manflot</option>
                </select>
                <span style="color: red;">*</span>
            </div>

            <div>
                Distruct : 
                <select class="Input_Data" id='Distruct' name='D' 
                        onfocus="Focus(this);" onblur="Blur(this);">
                    <option>ElSadat</option>
                    <option>Mubarak</option>
                    <option>Teachers</option>
                    <option>Elweledia</option>
                </select>
                <span style="color: red;">*</span>
                &nbsp;&nbsp;
                <input type="checkbox" name='Distruct_Show'>Show It?
            </div>
    
            <div>
                <input type="text" name="St" id='Street' class='Input_Data'
                    placeholder="Enter The Street" onfocus="Focus(this);" 
                    onblur="Blur(this);"
                    oninput="CheckinputLen(this, Street_Len);">
                    &nbsp;&nbsp;
                <input type="checkbox" name='Street_Show'>Show It?
            </div>

<!--  -->
            <div>
                Status : 
                <input type="radio" name="Status" value='Rent' checked> Rent
                <input type="radio" name="Status" value="Buy"> Buy
            </div>

            <div>
                Type : 
                <input type="radio" name="Ty" value='Students' checked> Students
                <input type="radio" name="Ty" value="Families"> Families
                <input type="radio" name="Ty" value="Offices"> Offices
            </div>

            <div>
                Furnished : 
                <input type="radio" name="Fur" value='Yes' checked> Yes
                <input type="radio" name="Fur" value="No"> No
            </div>

<!--  -->
            <div>
                <input type="text" name="Ph" id='Phone' required
                    class='Input_Data' placeholder="Enter The Phone"
                    onfocus="Focus(this);" onblur="Blur(this);">
                <span style="color: red;">*</span>
            </div>

            <div>
                <input type="text" name="A" id='Area' required
                    class='Input_Data' placeholder="Enter The Area"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Area_Len);">
                <span style="color: red;">*</span>
            </div>
            
            <div>
                <input type="text" name="Storey" id='Storey'
                    class='Input_Data' placeholder="Enter The Storey"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Storey_Len);">
            </div>

            <div>
                <input type="text" name="R" id='Rooms' required
                    class='Input_Data' placeholder="Number Of Rooms"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Rooms_Len);">
                <span style="color: red;">*</span>
            </div>
            <div>
                <input type="text" name="PR" id='PathRooms' required
                    class='Input_Data'placeholder="Number Of PathRooms"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, PathRooms_Len);">
            </div>

            <div>
                <input type="text" name="M" id='Money' required
                    class='Input_Data' placeholder="Enter The Money"
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLenAndNumber(this, Money_Len);">
                <span style="color: red;">*</span>
            </div>

<!--  -->
            <div>
                <input type="image" src="<?php echo AddPicture; ?>" width="80" height="80"
                    alt="AddPicture" id='image1' style="cursor: pointer;"
                    onclick="GetPicture('#File1');" name = 'image1'>
                
                <input type="file" id='File1' style="display: none;"
                    onchange="Read(this, '#image1');" name='File1'>


                <input type="image" src="<?php echo AddPicture; ?>" width="80" height="80"
                    alt="AddPicture" id='image2' style="cursor: pointer;"
                    onclick="GetPicture('#File2');" name = 'image2'>

                <input type="file" id='File2' style="display: none;"
                    onchange="Read(this, '#image2');" name='File2'>


                <input type="image" src="<?php echo AddPicture; ?>" width="80" height="80"
                    alt="AddPicture" id='image3' style="cursor: pointer;"
                    onclick="GetPicture('#File3');" name = 'image3'>

                <input type="file" id='File3' style="display: none;"
                    onchange="Read(this, '#image3');" name='File3'>                
            </div>

<!--  -->
            <div>
                <textarea cols="40" rows="7" class='Input_Data' id="Discreption"
                    style="font-size: 15px;" name="Dis"
                    placeholder="Enter Your Discreption Here" 
                    onfocus="Focus(this);" onblur="Blur(this);"
                    oninput="CheckinputLen(this, Discreption_Len);"></textarea>
            </div>

            <div>
                <input type="submit" value="Post" class="Button" id='Submit'>
            </div>

            <a href="<?php echo Help; ?>">How To Post ?</a>

        </div>
        <!--</form>-->

    </section>

    <?php  include_once Footer;  ?>
    
    <script type="text/javascript">
        var Governor_Len = <?php echo Governor_Len; ?>;
        var Station_Len = <?php echo Station_Len; ?>;
        var Distruct_Len = <?php echo Distruct_Len; ?>;
        var Street_Len = <?php echo Street_Len; ?>;

        var Status_Len = <?php echo Status_Len; ?>;
        var Type_Len = <?php echo Type_Len; ?>;
        var Furnished_Len = <?php echo Furnished_Len; ?>;

        var Phone_Len = <?php echo Phone_Len; ?>;
        var Area_Len = <?php echo Area_Len; ?>;
        var Storey_Len = <?php echo Storey_Len; ?>;
        var Rooms_Len = <?php echo Rooms_Len; ?>;
        var PathRooms_Len = <?php echo PathRooms_Len; ?>;
        var Money_Len = <?php echo Money_Len; ?>;

        var Discreption_Len = <?php echo Discreption_Len; ?>;
    </script>

    <script type="text/javascript">
<?php
    if ( $Result[0] == -1 ){
        include_once TrigerMessage;
    }
    else if ( isset($_GET['Status']) ){
    ?>
        SetMessage(2500, 'green' , '<p>Posted</p>');
    <?php
    }
?>
    </script>
</body>
</html>