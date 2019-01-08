<?php
/*	
	-info
		php page  	=>  Hashing.php
		init name 	=>  HashClass
		class name 	=> 	HashingClass
		object name => 	Hashing

	-Functions
		1 	=> 	Hash (Name, Email, Phone, Password)
		2	=>	Try To Get Hashed (Name, Email, Phone, Password)
		3	=>	Get SignUP Token And Hash It
		4	=>	Try To Get Hashed SignUP Token

	-Errors
		6	=>	'Hashing '.$Location.' Error' =>	Length is Short, Can't Hashing
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C4';
else
    $GLOBALS['Page_API_Error_Code'] = 'C4';
set_error_handler("Error_Handeler");

class HashingClass{

	public $Error = array(
					'Error Location' 	=> '',
					'Error Code' 		=> '',
					'Error Message' 	=> '',
				);

	private $NAME_HASH_LEN = 2;
	private $EMAIL_HASH_LEN = 4;
	private $PHONE_HASH_LEN = 6;
	private $PASWORD_HASH_LEN = 8;
	private $TOKEN_HASH_LEN = 10;
	private $IP_HASH_LEN = 12;
	private $Picture_HASH_LEN = 14;
	private $Session_HASH_LEN = 16;

	public $HashedText = '';

	function Hash_Name($Name){
		return 'MY'.$Name;
	}

	function Hash_Email($Email){
		return 'MYNA'.$Email;
	}

	function Hash_Phone($Phone){
		return 'MYNAME'.$Phone;
	}

	function Hash_Password($Password){
		return 'MYNAMEHA'.$Password;
	}

	function Hash_Token($Token){
		return 'MYNAMEHADY'.$Token;
	}

	function Hash_IP($IP){
		return 'MYNAMEHADYES'.$IP;
	}

	function Hash_Picture($Picture){
		return 'MYNAMEHADYESLA'.$Picture;
	}

	function Hash_Session($Session){
		return 'MYNAMEHADYESLAMM'.$Session;
	}

	function Get_Hashed_Name($Name){
		if ( $this->CheckLength($Name, $this->NAME_HASH_LEN, 'Name') != 1 )
			return -1;
		$this->HashedText = substr($Name, 2);
		return 1;
	}

	function Get_Hashed_Email($Email){
		if ( $this->CheckLength($Email, $this->EMAIL_HASH_LEN, 'Email') != 1 )
			return -1;
		$this->HashedText = substr($Email, 4);
		return 1;
	}

	function Get_Hashed_Phone($Phone){
		if ( $this->CheckLength($Phone, $this->PHONE_HASH_LEN, 'Phone') != 1 )
			return -1;
		$this->HashedText = substr($Phone, 6);
		return 1;
	}

	function Get_Hashed_Password($Password){
		if ( $this->CheckLength($Password, $this->PASWORD_HASH_LEN, 'Password') != 1 )
			return -1;
		$this->HashedText = substr($Password, 8);
		return 1;
	}

	function Get_Hashed_Token($Token){
		if ( $this->CheckLength($Token, $this->TOKEN_HASH_LEN, 'Token') != 1 )
			return -1;
		$this->HashedText = substr($Token, 10);
		return 1;
	}

	function Get_Hashed_IP($IP){
		if ( $this->CheckLength($IP, $this->IP_HASH_LEN, 'IP') != 1 )
			return -1;
		$this->HashedText = substr($IP, 12);
		return 1;
	}

	function Get_Hashed_Picture($Picture){
		if ( $this->CheckLength($Picture, $this->Picture_HASH_LEN, 'Picture') != 1 )
			return -1;
		$this->HashedText = substr($Picture, 14);
		return 1;
	}

	function Get_Hashed_Session($Session){
		if ( $this->CheckLength($Session, $this->Session_HASH_LEN, 'Session') != 1 )
			return -1;
		$this->HashedText = substr($Session, 16);
		return 1;
	}

	function CheckLength($String, $LEN, $Location){
		if ( strlen($String)<$LEN ){
			$this->ErrorReturn('Hashing '.$Location.' Error', '6', 
								"Length is Short, Can't Hashing");
			return 0;
		}
		return 1;
	}

	private function ErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
		$this->Error['Error Location'] = $ErrorLocation;
    	$this->Error['Error Code'] = $ErrorCode;
    	$this->Error['Error Message'] = $ErrorMessage;
    	return -1;
	}
}
$Hashing = new HashingClass();
?>