function DeletePost(id, Post_Number){
	if ( confirm('Are You Sure Want To Delete This Post ( ' + Post_Number +
		' ) With id ( ' + id + ' )' ) == false )
		return ;
	$.ajax({
        type : "POST",
        url : DeletePostPage,
        data : 'ID=' + id,
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 )
                    TriggerMessage(3500, '#E30300', '<p>Post Not Found</p>');
         		else if ( Data['Result'] == 1 ){
         			TriggerMessage(4000, '#53A01A',
         				'<p>Post ' + Post_Number + ' Deleted</p>');
         			$('#' + id).remove();
         			Posts = parseInt($('#Posts_Number').text());
         			$('#Posts_Number').text( Posts -1 );
         			$('.Number').text(Posts - 1);
         		}
                else
                    SetError_Function('in Deleting User Post',
                        'in MyProfileScript.js', 'in DeletePost Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
            }
            catch(e){
                SetError_Function('in Deleting User Post',
                    'in MyProfileScript.js', 'in DeletePost Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', true);
            }
        }
    });
}