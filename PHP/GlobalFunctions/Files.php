<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/findhouse.com/PHP/init.php';

if ( isset($GLOBALS['Page_API_Error_Code']) )
    $GLOBALS['Page_API_Error_Code'] .= '.G6';
else
    $GLOBALS['Page_API_Error_Code'] = 'G6';
set_error_handler("Error_Handeler");

function MakePostFile($Userid, $Postid){
    MakeFile( UserPicturesFolder.'User'.$Userid );
    MakeFile( UserPicturesFolder.'User'.$Userid.'/Post'.$Postid );
}

function MakeFile($Path){
    if ( file_exists($Path) == 1 )
        return array(0, 'Found');
    mkdir($Path);
    return array(0, 'Done');
}
?>