$(document).ready(function(){

	$('#PhoneSubmit').click(function(){
		if ( CheckData() == true )
			GO('#PhoneDiv');
	})
})

function CheckData(){
	Result = true;
	if ( $('#Phone').val().length != Phone_Len ){
        $('#Phone').css('border-color','red');
        Result = false;
    }
    return Result;
}