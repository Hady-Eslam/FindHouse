function MakeSlide(id){
    $("#DropDownBox"+id).toggle("slide");
}

function EditPost(id){
    location.href = EditPostPage+id;
}

function DeletePost(id, Category){
	if ( confirm('Are You Sure Want To Delete This Post ?') == false )
		return ;

	$.ajax({
        type : "POST",
        url : DeletePostPage,
        data : 'ID=' + id + '&Category=' + Category,
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 )
                    alert('Post Not Found');

         		else if ( Data['Result'] == 1 ){
         			$('#Post_' + Category + '_' + id).remove();
         			alert('Post Deleted');
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