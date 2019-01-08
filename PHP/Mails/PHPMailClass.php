<?php
/*
	php page  	=>  PHPMailClass.php
	init name 	=>  PHPMailClass
	class name 	=> 	MailClass
	object name => 	PHPMail

	-Errors
	7	=>	Mail Error 	=>	Error in Making Server settings
	8	=>	Mail Error 	=>	Error in Making Email Sittings in Confirming Email
	9	=>	Mail Error 	=>	Error in Making Email Sittings in Forgetting Password

	
	-some important info

    	To Enable verbose debug output Make It (   2    )
	    	Question : 
    	
    		when i send email it echo many unnecessary texts, i don't want these text to be printed out. how can i disable these text.

    	Answer :
    	
    		PHPMailer has a "debug" flag that you can turn off.

			Depending on which version you are using, it could be named Debug or SMTPDebug. You'll know it when you see it. If necessary, look into the class file to find out the name.

			Set that to false and all is well.

*/
use PHPMailer\PHPMailer\PHPMailer;
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';
include_once PHP.'Mails/vendor/autoload.php';
include_once HashClass;

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.C3';
else
    $GLOBALS['Page_API_Error_Code'] = 'C3';
set_error_handler("Error_Handeler");

class MailClass{

	public $Mail;

	private $Hashing;
	private $MyEmail = 'abdoaslam000@gmail.com';

	public $Error = array(
					'Error Location' 	=> '',
					'Error Code' 		=> '',
					'Error Message' 	=> '',
				);

	function __construct(){
		try{
			$this->Mail = new PHPMailer();
			//Server settings
		    $this->Mail->SMTPDebug = 0;

		    
		    $this->Mail->isSMTP(true);                        // Set mailer to use SMTP
		    $this->Mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		    $this->Mail->SMTPAuth = true;            // Enable SMTP authentication
		    $this->Mail->Username = 'abdoaslam000@gmail.com';             // SMTP username
		    $this->Mail->Password = '0079521111';                // SMTP password
		    $this->Mail->SMTPSecure = 'tsl';  			//There is Also tsl
		    $this->Mail->Port = 587; 			//tsl uses Port 587 (TCP port to connect to)
		    									//tls on port 587

		    $this->Hashing = new HashingClass();
		}
		catch(Exception $e){
			$this->ErrorReturn('Mail Error', '7', "Error in Making Server settings");
	    }
	}

	private function ErrorReturn($ErrorLocation, $ErrorCode, $ErrorMessage){
		$this->Error['Error Location'] = $ErrorLocation;
    	$this->Error['Error Code'] = $ErrorCode;
    	$this->Error['Error Message'] = $ErrorMessage;
    	return -1;
	}

	function SendMailToConfirm($Email, $Token){
		if ( $this->Error['Error Code'] == '7' )
			return -1;
		
		try{
			$this->Mail->setFrom($this->MyEmail, 'Find House');
		    $this->Mail->addAddress("abdoaslam000@gmail.com");
		    
		    $this->Mail->Subject = 'Confirm The Sien UP Proccess';
		    $this->Mail->Body = '<p>Please Click This Link To Complete The Proccess Of'
		    					." Sien UP </p><a href='".Sign_Dir_Layout."ConfirmUser.php?"
		    					."E=".$this->Hashing->Hash_Email($Email)
		    					."&T=".$this->Hashing->Hash_Token($Token)."'>"
		    					.Sign_Dir_Layout."ConfirmUser.php?E="
		    					.$this->Hashing->Hash_Email($Email)
		    					."&T=".$this->Hashing->Hash_Token($Token)."</a>"
		    					.'<p>Note That the Data Will Be Deleted if You Do Not'
		    					.' Complete The Process Of Sign UP in a Week Time</p>';

		    $this->Mail->AltBody = "Copy This Link In Your Browser To Complete The Proccess"
		    			." Of Sien UP ".Sign_Dir_Layout."ConfirmUser.php?E="
		    			.$this->Hashing->Hash_Email($Email)
		    			.'&T='.$this->Hashing->Hash_Token($Token)
		    			.'<p>Note That the Data Will Be Deleted if You Do Not'
		    			.' Complete The Process Of Sign UP in a Week Time</p>';
		    
		    $this->Mail->isHTML(true);        // Set email format to HTML

		    if ( $this->Mail->send() )
		    	return 1;
		    return 0;
		}
		catch(Exception $e){
			$this->ErrorReturn('Mail Error', '8',
			 "Error in Making Email Sittings in Confirming Email");
	    }
	}

	function SendForgetPasswordMail($Email, $Token){
		if ( $this->Error['Error Code'] == '7' )
			return -1;
		
		try{
			$this->Mail->setFrom($this->MyEmail, 'Find House');
		    $this->Mail->addAddress("abdoaslam000@gmail.com");
		    
		    $this->Mail->Subject = 'Forget Password';
		    $this->Mail->Body = '<p>Click In This Link To Complete The Proccess Of Making'
		    			." New Password </p><a href = '".Log_Dir_Layout."NewPassword.php?"
		    			."E=".$this->Hashing->Hash_Email($Email)
		    			."&T=".$this->Hashing->Hash_Token($Token)."'>"
		    			.Log_Dir_Layout."NewPassword.php?"
		    			."E=".$this->Hashing->Hash_Email($Email)
		    			."&T=".$this->Hashing->Hash_Token($Token)."</a>";

		    $this->Mail->AltBody = "Copy This Link In Your Browser To Complete The "
		    			."Proccess Of Making New Password ".Log_Dir_Layout
		    			."NewPassword.php?E=".$this->Hashing->Hash_Email($Email)
		    			."&T=".$this->Hashing->Hash_Token($Token);

		    $this->Mail->isHTML(true);        // Set email format to HTML

		    if ( $this->Mail->send() )
		    	return 1;
		    return 0;
		}
		catch(Exception $e){
			$this->ErrorReturn('Mail Error', '9',
					 "Error in Making Email Sittings in Forgetting Password");
	    }
	}
}

$PHPMail = new MailClass();
?>