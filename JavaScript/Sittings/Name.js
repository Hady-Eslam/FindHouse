$(document).ready(function(){

	$('#NameSubmit').click(function(){
		if ( CheckData() == true )
			GO('#NameDiv');
	})
})

function CheckData(){
	Result = true;
	if ( CheckLength('#Name', Name_Len) == false )
        Result = false;
    return Result;
}