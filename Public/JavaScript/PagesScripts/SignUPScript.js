$(document).ready(function(){
    $("#SignForm").submit(function(event){
        if ( CheckData() == false )
            event.preventDefault();
    });
})

function CheckData(){
    Result = CheckLength('#Name', Name_Len);
    Result = CheckLength('#Email', Email_Len, Result);
    Result = CheckLength('#Phone', Phone_Len, Result);
    Result = CheckLength('#Password', Password_Len, Result);
    Result = CheckEmailPattern(Result);
    return CheckPassword(Result);
}

function CheckEmail(){
    
    if ( $('#Email').val().length == 0 || $('#Email').val().length > Email_Len )
        return ;

    $.ajax({
        type : "POST",
        url : CheckPage,
        data : 'E='+$('#Email').val(),
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 ){
                    
                    if ( Data['Data'] == 'email Not Found' )
                        $('#Email').css('border-color','green');
                    else
                        $('#Email').css('border-color','red');
                }
                else{
                    SetError_Function('in Searching For Email Reservied Or Not',
                        'in SignUPScript.js', 'in CheckEmail Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
                }
            }
            catch(e){
                SetError_Function('in Searching For Email Reservied Or Not',
                    'in SignUPScript.js', 'in CheckEmail Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }    
        }
    });
}