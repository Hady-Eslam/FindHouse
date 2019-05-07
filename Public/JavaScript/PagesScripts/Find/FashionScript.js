function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMoreFashionPostsPage,
        data : 'Fashion_Count=' + Fashion_Count,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Fashion_Count += 21;
                    $('#FashionPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Fashion Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Fashion Posts',
                    'in FashionScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}