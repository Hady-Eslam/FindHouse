$(document).ready(function(){

	$('#SendMessage').click(function(){
		SendMessage();
	})
})

function SendMessage(){
    if ( $('#MessageEmail').length != 0 ){
        if ( !CheckLength('#MessageEmail', Email_Len) ){
            $('#MessageEmail').css('border-color', 'red');
            return ;
        }
        Email = '&MessageEmail=' + $('#MessageEmail').val();
    }
    else
        Email = '';

	if ( !CheckLength('#Message', Message_Len) ){
        $('#Message').css('border-color', 'red');
		return ;
    }

	$.ajax({
        type : "POST",
        url : MakeMessagePage,
        data : 'Message=' + $('#Message').val() + Email,
        error: function (jqXHR, exception) {
            console.log(jqXHR);
            TriggerMessage(3500, 'red', '<p>Error Occurred</p>');
        },
        
        success : function(Data){
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 )
                	TriggerMessage(3500, 'red', '<p>Post Not Found</p>');

                else if ( Data['Result'] == 1 ){
                	TriggerMessage(3500, 'green', '<p>Sent</p>');
                    $('#Message').val('');
                    if ( Email != '' )
                        $('#MessageEmail').val('');
                }
                else
                    TriggerMessage(3500, 'red', '<p>Not Valid Data</p>');
            }
            catch(e){
                SetError_Function('in Making Message',
                    'in PostScript.js', 'in SendMessage Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', true);
            }    
        }
    });
}
// Line 153