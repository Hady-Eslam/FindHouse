$(document).ready(function(){

	$('#DeactivateSubmit').click(function(){
		if ( CheckData() == true )
			GO('#DeactivateDiv');
	})
})

function CheckData(){

	if ( confirm('Are You Sure Want To De-Activate Acount ?') == false )
		return false;
	return true;
}