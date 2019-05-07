<?php

function ShowResults(){

    if ( $GLOBALS['Result'] == 'NameDone' )
        return 'alert("Name Changed")';

    else if ( $GLOBALS['Result'] == 'PhoneDone' )
        return 'alert("Phone Changed")';

    else if ( $GLOBALS['Result'] == 'ReservedPhone' )
        return 'alert("Reserved Phone Number")';

    else if ( $GLOBALS['Result'] == 'AddressDone' )
        return 'alert("Address Changed")';

    else if ( $GLOBALS['Result'] == 'PasswordDone' )
        return 'alert("Password Changed")';

    else if ( $GLOBALS['Result'] == 'WrongPassword' )
        return 'alert("Wrong Password")';

    else if ( $GLOBALS['Result'] == 'PictureDone' )
        return 'alert("Picture Changed")';

    else if ( $GLOBALS['Result'] == 'ReservedName' )
        return '$(\'#Name\').css(\'border-color\', \'red\')';

    return '';
}