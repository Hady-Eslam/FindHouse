<?php
/*
    -info
        php page    =>  Session.php
        init name   =>  Session
        class name  =>  SessionClass
        object name =>  Seesion

    - Depences Files :
        MySqlDB
        HashClass
*/
include_once MySqlDB;
include_once HashClass;

class MySessionHandeler implements SessionHandlerInterface{
    
	private $MySql;
    private $Hashing;

    public function open($savePath, $sessionName){
    	$this->MySql = new MYSQLClass('Session');
    	$this->Hashing = new HashingClass();
        return true;
    }

    public function close(){
        return true;
    }

    public function destroy($id){
        return true;
    }

    public function gc($maxlifetime){
        return true;
    }

    public function read($id){
        $Result = $this->MySql->FetchOneRow('SELECT * FROM session WHERE id = ?',
                    array(
                        $this->Hashing->Hash_Session($id),
                    ));
    	if ( $Result->Result == -1 || $Result->Result == 0 )
    		return '';
        return $this->Hashing->Get_Hashed_Session( $Result->Data['data'] )->Data;
    }

    public function write($id, $data){
    	if ( $this->MySql->excute('REPLACE INTO session (id, data, session_date) '
    				.'VALUES (?, ?, ?)',
		    		array(
		    			$this->Hashing->Hash_Session($id),
		    			$this->Hashing->Hash_Session($data),
		    			date('D d-m-Y H:i:s')
		    		))->Result == -1 )
    		return true;
        return true;
    }
}

function Begin_Session(){

    session_set_save_handler(new MySessionHandeler(), true);
    register_shutdown_function('session_write_close');
/*
    session_start Must be writen Before Any Output (echo, print, print_r)
*/
    session_start();
}

Begin_Session();

class SessionClass{

    private $Hashing;
    private $MySql;

    function __construct(){
        $this->MySql = new MYSQLClass('Session');
        $this->Hashing = new HashingClass();
    }

    function NewSessionID(){
        session_regenerate_id(true);
    }

    function DestroySession(){
        $this->MySql = new MYSQLClass('Session');
        $this->Hashing = new HashingClass();
        
        if ( ($Result = $this->MySql->excute('DELETE FROM session WHERE id = ?',
                    array(
                        $this->Hashing->Hash_Session(session_id()),
                    )))->Result == -1 )
            return Returns(-1, 'in Deleting User Session', $Result->Error );
        session_unset();
        session_destroy();
        return Returns(0, 'Done');
    }
}

$Session = new SessionClass();
?>