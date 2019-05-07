<?php

function MakePostFile($Userid, $Category, $Postid){
    MakeFile( UserPictures.'User'.$Userid );
    MakeFile( UserPictures.'User'.$Userid.'/'.$Category );
    MakeFile( UserPictures.'User'.$Userid.'/'.$Category.'/Post'.$Postid );
}

function MakeMessageFile($User_id, $Message_id){
    MakeFile( MessagesPictures.'User'.$User_id );
    MakeFile( MessagesPictures.'User'.$User_id.'/Message'.$Message_id );
}

function MakeFile($Path){
    if ( file_exists($Path) == 1 )
        return array(0, 'Found');
    mkdir($Path);
    return array(0, 'Done');
}