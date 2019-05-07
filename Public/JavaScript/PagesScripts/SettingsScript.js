$(document).ready(function (){

	$('#NameSubmit').click(function(){
		if ( CheckLength('#Name', Name_Len) == false ){
			$('#Name').addClass('border border-danger');
			alert('Name Must Be > 0 And < ' + Name_Len);
		}
		else
			GO('#NameForm');
	})

	$('#PhoneSubmit').click(function(){
		if ( CheckLength('#Phone', Phone_Len) == false ){
			$('#Phone').addClass('border border-danger');
			alert('Phone Must Be > 0 And < ' + Phone_Len);
		}
		else
			GO('#PhoneForm');
	})

	$('#AddressSubmit').click(function(){
		if ( CheckLength('#Address', Address_Len) == false ){
			$('#Address').addClass('border border-danger');
			alert('Address Must Be > 0 And < ' + Address_Len);
		}
		else
			GO('#AddressForm');
	})

	$('#PasswordSubmit').click(function(){
		if ( CheckLength('#OldPassword', Password_Len) == false ){
			$('#OldPassword').addClass('border border-danger');
			alert('Password Must Be > 0 And < ' + Password_Len);
		}
		else if ( CheckLength('#Password', Password_Len) == false ){
			$('#Password').addClass('border border-danger');
			alert('Password Must Be > 0 And < ' + Password_Len);
		}
		else if ( $('#Password').val() != $('#ConPassword').val() ){
			$('#ConPassword').addClass('border border-danger');
			alert('Your Confirm Password Does Not Match The New Password');
		}
		else
			GO('#PasswordForm');
	})

	$('#PictureSubmit').click(function(){
		GO('#PictureForm');
	})
})

function CheckNameSize(){
	if (  $('#Name').length != 0 && CheckLength('#Name', Name_Len) == false ){
		$('#Name').addClass('border border-danger');
	}
	else{
		$('#Name').removeClass('border border-danger');
		$('#Name').addClass('border border-success');
	}
}

function CheckPhoneSize(){
	if (  $('#Phone').length != 0 && CheckLength('#Phone', Phone_Len) == false ){
		$('#Phone').addClass('border border-danger');
	}
	else{
		$('#Phone').removeClass('border border-danger');
		$('#Phone').addClass('border border-success');
	}
}

function CheckAddressSize(){
	if (  $('#Address').length != 0 && CheckLength('#Address', Address_Len) == false ){
		$('#Address').addClass('border border-danger');
	}
	else{
		$('#Address').removeClass('border border-danger');
		$('#Address').addClass('border border-success');
	}
}

function CheckOldPasswordSize(){
	if (  $('#OldPassword').length != 0 && CheckLength('#OldPassword', Address_Len) == false ){
		$('#OldPassword').addClass('border border-danger');
	}
	else{
		$('#OldPassword').removeClass('border border-danger');
		$('#OldPassword').addClass('border border-success');
	}
}

function CheckPasswordSize(){
	if (  $('#Password').length != 0 && CheckLength('#Password', Address_Len) == false ){
		$('#Password').addClass('border border-danger');
	}
	else{
		$('#Password').removeClass('border border-danger');
		$('#Password').addClass('border border-success');
	}
}

function CheckConPasswordSize(){
	if (  $('#ConPassword').length != 0 && CheckLength('#ConPassword', Address_Len) == false ){
		$('#ConPassword').addClass('border border-danger');
	}
	else{
		$('#ConPassword').removeClass('border border-danger');
		$('#ConPassword').addClass('border border-success');
	}
}