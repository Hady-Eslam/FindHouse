function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMoreElcPostsPage,
        data : 'Elc_Count=' + Elc_Count,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Elc_Count += 21;
                    $('#ElcPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Elcetrical Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Elcictrical Posts',
                    'in ElcScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}