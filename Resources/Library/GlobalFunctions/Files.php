<?php set_error_handler("Error_Handeler");

function MakePostFile($Userid, $Postid){
    MakeFile( UserPictures.'User'.$Userid );
    MakeFile( UserPictures.'User'.$Userid.'/Post'.$Postid );
}

function MakeFile($Path){
    if ( file_exists($Path) == 1 )
        return array(0, 'Found');
    mkdir($Path);
    return array(0, 'Done');
}
?>