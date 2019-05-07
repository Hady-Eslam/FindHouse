function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMoreDocPostsPage,
        data : 'Doc_Count=' + Doc_Count,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Doc_Count += 21;
                    $('#DocPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Doc Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Doc Posts',
                    'in DocScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}