$(document).ready(function(){

	$('#PasswordSubmit').click(function(){
		if ( CheckData() == true )
			GO('#PasswordDiv');
	})
})

function CheckData(){
	Result = true;
	if ( CheckLength('#OldPassword', Password_Len) == false )
        Result = false;
    if ( CheckLength('#Password', Password_Len) == false )
        Result = false;
    if ( CheckPassword() == false )
    	Result = false;
    return Result;
}