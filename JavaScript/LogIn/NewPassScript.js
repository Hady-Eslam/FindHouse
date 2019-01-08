$(document).ready(function(){           
    $("#NewPasswordForm").submit(function(event){
        if ( CheckData() == false )
            event.preventDefault();
    });
})

function CheckData(){
    result = true;

    if ( CheckLength('#Password', Password_Len) == false )
        result = false;

    if ( CheckPassword() == false )
        result = false;
    return result;
}