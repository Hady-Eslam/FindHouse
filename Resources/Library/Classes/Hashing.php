<?php
/*	
	-info
		php page  	=>  Hashing.php
		init name 	=>  HashClass
		class name 	=> 	HashingClass
		object name => 	Hashing

	- Depences Files :
        NONE
*/

class HashingClass{

	private $USER_HASH_LEN = 2;
	private $WAITING_USER_HASH_LEN = 4;
	private $SESSION_HASH_LEN = 6;
	private $SIGNUP_TOKEN_HASH_LEN = 8;
	private $LOGIN_TOKEN_HASH_LEN = 10;
	private $POSTS_HASH_LEN = 12;
	private $INTERESTED_HASH_LEN = 14;
	private $COMMENTS_HASH_LEN = 16;
	private $LIKE_DISLIKE_HASH_LEN = 18;
	private $NOTIFICATIONS_HASH_LEN = 20;
	private $MESSAGES_HASH_LEN = 22;

	// Hash
	function Hash_Users($User){
		return 'MY'.$User;
	}

	function Hash_WaitingUsers($User){
		return 'MYNA'.$User;
	}

	function Hash_Session($Session){
		return 'MYNAME'.$Session;
	}

	function Hash_SignUP_Token($Token){
		return 'MYNAMEHA'.$Token;
	}

	function Hash_Login_Token($Token){
		return 'MYNAMEHADY'.$Token;
	}

	function Hash_POSTS($POST){
		return 'MYNAMEHADYES'.$POST;
	}

	function Hash_interested($interested){
		return 'MYNAMEHADYESLA'.$interested;
	}

	function Hash_Comments($Comments){
		return 'MYNAMEHADYESLAMM'.$Comments;
	}

	function Hash_Like_DisLike($Like_DisLike){
		return 'MYNAMEHADYESLAMMOH'.$Like_DisLike;
	}

	function Hash_Notifications($Notification){
		return 'MYNAMEHADYESLAMMOHAM'.$Notification;
	}

	function Hash_Messages($Message){
		return 'MYNAMEHADYESLAMMOHAMME'.$Message;
	}

	// Get Hashed
	private function GetString($String, $LEN, $Location){
		try{
			if ( strlen($String) < $LEN )
				return Returns(-1 , '', Error('Hashing Error', '8',
							"Length is Short, Can't Hashing") );
			return Returns(1 , substr($String, $LEN));
		}
		catch(Exception $e){
			return Returns(-1,'',Error('Hashing Error','14',"Can't Get Object Hashed"));
		}
	}

	function Get_Hashed_Users($User){
		return $this->GetString($User, $this->USER_HASH_LEN, 'User');
	}

	function Get_Hashed_WaitingUsers($WaitingUser){
		return $this->GetString($WaitingUser, $this->WAITING_USER_HASH_LEN,
					'Waiting User');
	}

	function Get_Hashed_Session($Session){
		return $this->GetString($Session, $this->SESSION_HASH_LEN, 'Session');
	}

	function Get_Hashed_SignUP_Token($Token){
		return $this->GetString($Token, $this->SIGNUP_TOKEN_HASH_LEN, 'Sign UP Token');
	}

	function Get_Hashed_Login_Token($Token){
		return $this->GetString($Token, $this->LOGIN_TOKEN_HASH_LEN, 'Log in Token');
	}

	function Get_Hashed_POSTS($POST){
		return $this->GetString($POST, $this->POSTS_HASH_LEN, 'POSTS');
	}

	function Get_Hashed_interested($interested){
		return $this->GetString($interested, $this->INTERESTED_HASH_LEN, 'interested');
	}

	function Get_Hashed_Comments($Comments){
		return $this->GetString($Comments, $this->COMMENTS_HASH_LEN, 'Comments');
	}

	function Get_Hashed_Like_DisLike($Like_DisLike){
		return $this->GetString($Like_DisLike, $this->LIKE_DISLIKE_HASH_LEN,
							'Like DisLike');
	}

	function Get_Hashed_Notifications($Notification){
		return $this->GetString($Notification, $this->NOTIFICATIONS_HASH_LEN,
							'Notification');
	}

	function Get_Hashed_Messages($Messages){
		return $this->GetString($Messages, $this->MESSAGES_HASH_LEN,
							'Messages');
	}

	// Get Data From Hashing
	/*
		Type
		Key
		Data
		Default
	*/
	function Get_Data_From_Hashing($Data, $Function = ''){
		foreach ($Data as $key => $Value) {
			$Result = NULL;

			if ( $Value['Type'] == 'User' )
				$Result = $this->Get_Hashed_Users($Value['Data']);
			else if ( $Value['Type'] == 'Waiting_User' )
				$Result = $this->Get_Hashed_WaitingUsers($Value['Data']);
			else if ( $Value['Type'] == 'Session' )
				$Result = $this->Get_Hashed_Session($Value['Data']);
			else if ( $Value['Type'] == 'SignUP_Token' )
				$Result = $this->Get_Hashed_SignUP_Token($Value['Data']);
			else if ( $Value['Type'] == 'Login_Token' )
				$Result = $this->Get_Hashed_Login_Token($Value['Data']);
			else if ( $Value['Type'] == 'POSTS' )
				$Result = $this->Get_Hashed_POSTS($Value['Data']);
			else if ( $Value['Type'] == 'interested' )
				$Result = $this->Get_Hashed_interested($Value['Data']);
			else if ( $Value['Type'] == 'Comments' )
				$Result = $this->Get_Hashed_Comments($Value['Data']);
			else if ( $Value['Type'] == 'Like_DisLike' )
				$Result = $this->Get_Hashed_Like_DisLike($Value['Data']);
			else if ( $Value['Type'] == 'Notifications' )
				$Result = $this->Get_Hashed_Notifications($Value['Data']);
			else if ( $Value['Type'] == 'Messages' )
				$Result = $this->Get_Hashed_Messages($Value['Data']);
			else{
				$GLOBALS[ $Value['Key'] ] = $Value['Data'];
				continue;
			}
			
			if ( $Result->Result == -1 )
				if ( isset($Value['Default']) )
					$GLOBALS[ $Value['Key'] ] = $Value['Default'];
				else
					$this->Call_Function($Function);
			else
				$GLOBALS[ $Value['Key'] ] = $Result->Data;
		}
	}

	private function Call_Function($Function){
		if ( $Function != '' )
			call_user_func($Function);
	}
}
$Hashing = new HashingClass();
?>