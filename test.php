<?php
print_r(
	array(
		'kk' => 'sss',
		'k' => 'aa',
		'kkk' => 'bb',
	)
);
$json = "{kk:sss,k:aa,kkk:bb}";
exit();

$Result = 'Hello';
$s = ' $Result ';
echo $s;
exit();
echo 'ss';
echo 'sss';
if ( 0 )
	$Result = 'HEY';
?>

<?php
exit();



include_once $_SERVER['DOCUMENT_ROOT'].'/test_2.php';
exit();

include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
set_error_handler("Error_Handeler");
//include_once MySqlDB;
include_once PageStatus;
/*$m = $s = 'A';
echo $s;
echo '\n'.$m;

//include_once MongoDB;
//echo file_exists('C:/xamp');
//echo mkdir('D:/PHPFolder');
/*class S{

	public $M;
	function __construct($Name){
		$this->M = $Name;
		echo $this->M.'\n';
	}

	function Set(){
		$this->__construct('S');
	}
}

/*
$PP = new S('Hello');
$PP->Set();
echo $PP->M;
*//*include_once Session;
$_SESSION['Page Name'] = 'test.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/WebSitePlane.php';
//echo $_SESSION['Page Name'];
//echo $_SESSION['Page'];
//var_dump($Session->DestroySession());
/*$_SESSION['S'] = 'S';
echo !isset($_SESSION['S']);
/*$_SESSION['S'] = 'Hello';
echo $_SESSION['S'];
/*try{
echo $X;
}
catch(Exception $e){
	echo 'OK';
}
//$_SESSION['Test'] = 'Hady';
//echo $_SESSION['Test'];
exit();
/*$Session = SessionClass();/*
$Session->StartSession('_s', false);
 
$_SESSION['something'] = 'A value.';
echo $_SESSION['something'];
//*///echo 'H';
//header('http://localhost/findhouse.com/WebSitePlane.php');
//exit();
/*echo 'http://localhost'.parse_url('http://localhost/findhouse.com/Layout/LogIn/NewPassword.php', PHP_URL_PATH);
//echo filter_var('Hello<script>My Name</script>5554', FILTER_VALIDATE_EMAIL);
/*$Hashing = new HashingClass();
function D(){
	echo $Hashing->Hash_Email('Hello@gmail.com');
}

D();/*
if ( ( $Result = 'kgjjkjkg' ) == 6 ){
	echo 'YES';
	$NO = 's';
}else if ( $Result == 'kgjjkjkg' ){
	echo 'NO';
}

/*header('Location:http://localhost/findhouse.com/WebSitePlane.php');
exit();
/*try{
	$m = 'H';
	echo $m[5];
}
catch(Exception $e){
	echo 'Error = '.$e->getMessage();
}
*///$Page = new PagesStatusClass();
//var_dump( $Page->PageVisit(date('D d-m-Y H:i:s'), 'Sign UP') );
/*var_dump( $Page->PagesStatus->updateOne(
					['Page' => 'Sign UP' ],
					[ 
						'$set' => [ 'Visits Count.'.date('D d-m-Y') => 10 ] 
					]
					/*if field not found it will create one*/
				//));
/*var_dump( $Page->PagesStatus->findOne([
			'$and' => [
				'Page' => 'Sign UP',
				'Visits Count.'.date('D d-m-Y') => ['$exists' => true] 
				]
			]
			));*/
/*var_dump(	$Page->PagesStatus->insertOne(
	[ 'Page' => 'interested', 'On Work' => '1']
				)
);
/*var_dump( $Page->PagesStatus->deleteOne(
		['_id'=>new \MongoDB\BSON\ObjectID('5b8cf9d0c886f70afc00668c')]
	));
/*5b893122c886f70afc006687
$MySql = new MYSQLClass("SignUP");
$Result = $MySql->excute('SELECT * FROM can_sign WHERE user_ip = ?',array('MYNAMEHADYES::1'));

try{
	while( $Fetch = $MySql->SQL->fetch(PDO::FETCH_ASSOC))
		var_dump($Fetch);
}
catch(Exception $e){
	echo $e->getMessage;
}

/*
$myArr = array(
	"John" => 'Hello',
	"Mary" => 'H')
;

$myJSON = json_encode($myArr);

//echo $myJSON;
echo $d = date("d", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
echo $m = date("m", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
echo $y = date("Y", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
echo $h = date("H", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
echo $i = date("i", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
echo $s = date("s", strtotime("Sun 26-08-2018 00:49:28")).'\r\n';
var_dump( date("D d-m-Y H:i:s", strtotime("Sun 26-08-2018 00:49:28")) );
echo date("D d-m-Y H:i:s", strtotime("Sun 26-08-2018 00:56:28"));

$d1=new DateTime("Sun 26-08-2018 00:50:28"); 
$d2=new DateTime("Sun 26-08-2018 00:59:28"); 
$diff=$d2->diff($d1); 
var_dump( $diff );
echo $diff->h;
if ( 3<=5 )
	echo 'OK';
$GLOBALS['d'] = 'dd';
dd();
function dd(){
echo $GLOBALS['d'];
}*/
//unset($_POST);
/*isset($_POST);
var_dump($_FILES);
if (isset($_FILES['File1'])){
	echo $_FILES['File1']['name'].'\n';
	echo $_FILES['File1']['size'].'\n';
	echo $_FILES['File1']['tmp_name'].'\n';
	echo pathinfo($_FILES[ 'File1' ]['name'], PATHINFO_EXTENSION);
}
*/
if ( Check()[1] == 0 )
	echo 'Hady Hello';

function Check(){
	return array(0, 0);
}
/*for ($i=1; $i <5 ; $i++) {
	echo $i; 
	if( $i == 3 ){
		echo 'HELLO';
		break;
	}
}
echo isset($_POST['E']);
if ( $_SERVER["REQUEST_METHOD"] == "POST" ){
	var_dump( $_POST['S'] );
	foreach ($_POST['S'] as $value) {
		echo $value.'\n';
	}
}*/
if (isset($_POST['D'])){
	echo empty($_POST['D']);
	echo 'YES';
}
?>
<!DOCTYPE >
<html>
<head>
	<title>Test</title>
	<script src="<?php echo JavaScript; ?>jquery-3.3.1.js"></script>
	<script src="<?php echo JQueryCookieScript; ?>"></script>
	<!--<script src="http://localhost/findhouse.com/JavaScriptsCommands.js"></script>
	-->
	<!--<input type="text" name="" oninput="Check(P);">
	<script type="text/javascript">
		var P = 20;
		function Check(P){
			alert(P);
		}
	</script>-->
	<script type="text/javascript">
		function Check(){
			return true;
		}
		function GO(){
			alert('HERE WE GO');
		}
	</script>
</head>
<body>
	<input type="text" name="" oninput="DD();" id="ID">
	<form id='AdvertiseForm' method='post' enctype='multipart/form-data'
		action='<?php echo $_SERVER['PHP_SELF']; ?>'>
		<select multiple name="S[]">
			<option>1</option>
			<option>2</option>
			<option>3</option>
			<script type="text/javascript">
				function DD(){
					alert(Number($('#ID').val()));
				}
			</script>
		</select>

		<div id="ff" class="DD" style="color: red;" name='dd'>
                    <input class='Input_Data' type="text" id='Name' name="N" 
                        placeholder="Enter Your Name" 
                        oninput="CheckinputLen(this, 50);">
                </div>
         <script type="text/javascript">
         	$(document).ready(function(){
         		$('.DD').hide();
         		$(this).
         	})
         </script>
        <input type="text" name="D">

	<input type="submit" name="E" value='click'>

</form>
<script type="text/javascript">
	function CheckinputLen(p, len){
		alert(p.value.length);
	}
</script>
	<!--<form id='AdvertiseForm' method="post" enctype="multipart/form-data"
            action="<?php echo $_SERVER['PHP_SELF']; ?>">
-->
	<div id='Dev'>
		<input type="image" src="<?php echo AddPicture; ?>" width="80" height="80"
            alt="AddPicture" id='image1' style="cursor: pointer;"
            onclick="GetPicture('#File1');" name = 'image1'
            ondblclick="GetPicture('#File1');">
        
        <input type="file" id='File1' style="display: none;"
            onchange="Read(this, '#image1');" name='File1'>

		<input type="submit" name="" value='submit' id='Submit'>
	<!--</form>-->
	</div>
	<script type="text/javascript">
		$(document).ready(function(){

		    $("#Submit").click(function(){

		    	$("<form id='AdvertiseForm' method='post'"
		        		+"enctype='multipart/form-data'"
		        		+"action='<?php echo $_SERVER['PHP_SELF']; ?>'></form>")
		    	.appendTo('body');
		        $('#Dev').appendTo('#AdvertiseForm');
		        $('#AdvertiseForm').trigger('submit');
		    });
		})
	</script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('')
		})
	</script>
</body>
</html>