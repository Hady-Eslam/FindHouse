$(document).ready(function(){

	$('#SendMessage').click(function(event){
		if ( CheckData() == true )
            GO('#MakeMessage');
	})
})

function CheckData(){
    
    if ( $('#MessageEmail').length != 0 ){
        if ( !CheckLength('#MessageEmail', Email_Len) ){
            $('#MessageEmail').css('border-color', 'red');
            return false;
        }
        Email = '&MessageEmail=' + $('#MessageEmail').val();
    }
    else
        Email = '';

    if ( !CheckLength('#Message', Message_Len) ){
        $('#Message').addClass('border border-danger');
        alert('Message Must Not Excced ' + Message_Len + ' Character');
        return false;
    }

    return true;
}

function CheckMessageLength(){
    if ( $('#Message').length != 0 ){

        if ( !CheckLength('#Message', Message_Len) ){
            $('#Message').addClass('border border-danger');
            alert('Message Must Not Excced ' + Message_Len +
                    ' Character And Longer Than 0 Characters');
        }
        else
            $('#Message').addClass('border border-success');
    }
}

function CheckEmailLength(){

    if ( $('#MessageEmail').length != 0 ){
        if ( !CheckLength('#MessageEmail', Email_Len) ){
            $('#MessageEmail').addClass('border border-danger');
            alert('Email Must Not Excced ' + Email_Len + ' Character');
        }
    }
}