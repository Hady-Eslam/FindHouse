function SeeMore(){

	$.ajax({
        type : "POST",
        url : GetMorePeddingPostsPage,
        data : 'Homes=' + Homes + '&Mobiles=' + Mobiles + '&Cars=' + Cars + '&Elc=' + Elc
        			+ '&Lux=' + Lux + '&Fashion=' + Fashion + '&Eat=' + Eat + '&Doc=' + Doc
        			+ '&Ant=' + Ant,

        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Count'] == true ){
                    Homes += 20;
                    Mobiles += 20;
                    Cars += 20;
                    Elc += 20;
                    Lux += 20;
                    Fashion += 20;
                    Eat += 20;
                    Doc += 20;
                    Ant += 20;
                    $('#PeddingPosts').append(Data['Posts']);
                }
                else{
                	alert('No More Pedding Posts Found');
                	$('#ShowMore').remove();
                }
            }
            catch(e){
                SetError_Function('in Getting More Pedding Posts',
                    'in PeddingPostsScript.js', 'in SeeMore Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', false);
            }
        }
    });
}