<?php

function ShowResults(){
	if ( $GLOBALS['Result'] == 'Post Not Found' )
        return '<p style="font-size: 40px;padding: 10px;color:red;">This Post Not Found Or Deleted</p>';

    else if ( $GLOBALS['Result'] == 'User Not Found' )
        return '<p style="font-size: 40px;padding: 10px;color:red;">This User Not Found Or Deleted</p>';

    else if ( $GLOBALS['Result'] == 'Posts Deleted' )
        return '<p style="font-size: 40px;padding: 10px;color:green;">Post Deleted</p>';
    
    else if ( $GLOBALS['Result'] == 'Posts Accepted' )
        return '<p style="font-size: 40px;padding: 10px;color:green;">Post Has Been Approved</p>';

    else if ( $GLOBALS['Result'] == 'Posts Rejected' )
        return '<p style="font-size: 40px;padding: 10px;color:green;">Post Has Been Rejected</p>';

    else if ( $GLOBALS['Result'] == 'Account Deleted' )
        return '<p style="font-size: 40px;padding: 10px;color:green;">Account Has Been Deleted</p>';
}