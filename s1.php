<?php

echo empty('0');
exit();




$GLOBALS['Hello'] = 'H';
$Hello = 'H';

echo "$Hello";







exit();
include_once $_SERVER['DOCUMENT_ROOT'].'/Resources/Config.php';
include_once DATE;


echo strtotime(date('d-m-Y')).'<br>';
$first = strtotime(date('d-m-Y'));
$second = strtotime(date('d-m-Y', strtotime('+3 months', strtotime(date('d-m-Y')))));
echo gettype($second);
if ( $first >= $second )
	echo ' | first is bigger or equall<br>';
else
	echo ' | second is bigger<br>';

Debug(true,  (new DateClass())->GetDifferenceWithCurrentDate('Sat 19-01-2019 17:50:17', 1, 0));















exit();
$pdo = new PDO("mysql:host=localhost;dbname=findhouse", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$s = $pdo->prepare('INSERT INTO log_in_token(token_email, token) VALUES ("1", "1")');
$s->execute();

/*
$stmt = $pdo->query("SELECT LAST_INSERT_ID()");
echo $stmt->fetchColumn();
*/








exit();
class x{
	function Hello(){
		echo 'HHH';
	}
}

(new x())->Hello();

echo '<br>';

print_r( preg_match('/\/Post\/(\d+)/', '/Post/555', $Result) );
print_r($Result);


exit();
function My($Hello, $X){
	echo $Hello.'<br>';
}

call_user_func("My", array('Hello', 'X'));
echo 'END HERE';

exit();
$filters = array
  (
  "email"=> FILTER_VALIDATE_EMAIL,
  "name" => FILTER_SANITIZE_STRING,
  "age" => array
    (
    "filter"=>FILTER_VALIDATE_INT,
    "options"=>array
      (
      "min_range"=>1,
      "max_range"=>100
      )
    ),
  );
if( isset($_POST['email'])){

$Result = filter_input_array(INPUT_POST, $filters, true);
if ( isset($_POST['email']) )
	echo $_POST['email'].'<br>';

if ( is_null($Result['email']) )
	echo 'NULL<br>';
else
	echo 'NO<br>';

echo (empty($Result['email']))?'yes<br>':'no<br>';

if ( isset($_POST['name']) )
	echo $_POST['name'].'<br>';
if ( isset($_POST['age']) )
	echo $_POST['age'].'<br>';
}
?>

<?php
/*if ( isset($_POST['submit']) ){
	if ( isset($_POST['male']) )
		echo 'Male is Set<br>';
	if ( isset($_POST['female']) )
		echo 'Female is Set<br>';

	echo $_POST['select'];
}*/
?>

<!DOCTYPE>
<html>
<head>
	<title></title>
</head>
<body>
	<form action="#" method="post">
		<select name="select">
			<option>Hady</option>
			<option>Eslam</option>
		</select>

		<input type="checkbox" name="male">male
		<input type="checkbox" name="female">female
		<input type="submit" name="submit" value="Submit">

		<input type="text" name="email">
		<input type="text" name="name">
		<input type="text" name="age">
	</form>
</body>
</html>

<?php
exit();
$Table = (true)?'True':'False';

echo $Table;
exit();


echo include_once $_SERVER['DOCUMENT_ROOT'].'/s1_2.php';
exit();
echo empty('s');
exit();
$Result = 'Hel';
if ( $Result == ('Hello'||'Hell') ){
	echo $Result;
	echo 'OK';
}
else
	echo 'NO';

if ( $Result == 'Hello'|| $Result == 'Hell' ){
	echo $Result;
	echo 'OK';
}
else
	echo 'NO';
exit();


echo $GLOBALS['HE'];
exit();
define('H', 'HHHE');

$ss = (object)[
	'Hello'=>'He'
];

$JSON = json_encode($ss);
print_r($JSON);
exit();
Echo $ss->Hello;

function HEllo($URL, $ss = (H.'DD')){
	return $ss.$URL;
}
echo HEllo('URL');
exit();
//echo Hello("ME");
?>