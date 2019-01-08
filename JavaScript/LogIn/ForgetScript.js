$(document).ready(function(){            
    $("#ForgetForm").submit(function(event){
        if ( CheckData()==false )
            event.preventDefault();
    });
})

function CheckData(){
    result = true;
    if ( CheckLength('#Email', Email_Len) == false )
        result = false;

    if ( CheckEmailPattern() == false )
        result = false;
    return result;
}