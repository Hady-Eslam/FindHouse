function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMoreAntPostsPage,
        data : 'Ant_Count=' + Ant_Count,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Ant_Count += 21;
                    $('#AntPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Antiques Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Antiques Posts',
                    'in AntScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}