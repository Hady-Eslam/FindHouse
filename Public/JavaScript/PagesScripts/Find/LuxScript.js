function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMoreLuxPostsPage,
        data : 'Lux_Count=' + Lux_Count,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Lux_Count += 21;
                    $('#LuxPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Lux Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Lux Posts',
                    'in LuxScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}