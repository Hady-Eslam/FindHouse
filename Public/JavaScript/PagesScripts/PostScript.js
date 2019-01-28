$(document).ready(function(){

	$('#Like').click(function(){
		MakeLike();
	})

	$('#DisLike').click(function(){
		MakeDisLike();
	})

	$('#SendComment').click(function(){
		SendComment();
	})
})

function MakeDisLike(){
	if ( !isUser ){
		TriggerMessage(3500, 'red', '<p>Must Log in To DisLike This Post</p>');
		return ;
	}

	$.ajax({
        type : "POST",
        url : MakeLike_DisLikePage,
        data : 'ID=' + Post_id + '&Type=2',
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 )
                	TriggerMessage(3500, 'red', '<p>' +Data['Data']+ '</p>');
                else if ( Data['Result'] == 1 ){
                	TriggerMessage(3500, 'green', '<p>DisLiked</p>');
                	$('#DisLikes').text( parseInt($('#DisLikes').text()) + 1 );
                }
                else
                    SetError_Function('in Making DisLike',
                        'in PostScript.js', 'in MakeDisLike Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
            }
            catch(e){
                SetError_Function('in Making DisLike',
                    'in PostScript.js', 'in MakeDisLike Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', true);
            }    
        }
    });
}

function MakeLike(){
	if ( !isUser ){
		TriggerMessage(3500, 'red', '<p>Must Log in To Like This Post</p>');
		return ;
	}

	$.ajax({
        type : "POST",
        url : MakeLike_DisLikePage,
        data : 'ID=' + Post_id + '&Type=1',
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
        	console.log(Data);
            try{
                Data = JSON.parse(Data);
                if ( Data['Result'] == 0 )
                	TriggerMessage(3500, 'red', '<p>' +Data['Data']+ '</p>');
                else if ( Data['Result'] == 1 ){
                	TriggerMessage(3500, 'green', '<p>Liked</p>');
                	$('#Likes').text( parseInt($('#Likes').text()) + 1 );
                }
                else
                    SetError_Function('in Making Like',
                        'in PostScript.js', 'in MakeLike Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
            }
            catch(e){
                SetError_Function('in Making Like',
                    'in PostScript.js', 'in MakeLike Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', true);
            }    
        }
    });
}

function SendComment(){
	if ( !CheckLength('#Comment', Comment_Len) )
		return ;
	if ( !isUser ){
		TriggerMessage(3500, 'red', '<p>Must Log in To Comment</p>');
		return ;
	}

	$.ajax({
        type : "POST",
        url : MakeCommentPage,
        data : 'ID=' + Post_id + '&Comment=' + $('#Comment').val(),
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
                	date = new Date();
                	The_Comment_Date = date.getDate() + '/' + date.getMonth() + '/'
                		+ date.getFullYear() + '   ' + date.getHours() + ':'
                		+ date.getMinutes() + ':' + date.getSeconds();
                	TriggerMessage(3500, 'green', '<p>Posted</p>');
                	$('<div class="Comments">'+
        				'<div>'+
            				'<a href="' + User_Link + '">'+
                				'<input type="image" src="' + User_image + '">'+
            				'</a>'+
            				'<div>'+
                				'<p>By : ' + User_Name + ' </p>'+
                				'<p>Date : ' + The_Comment_Date + '</p>'+
            				'</div>'+
        				'</div>'+

        				'<div class="Comment_Text">'+
            				'<p>' + $('#Comment').val() + '</p>'+
        					'</div>'+
    				'</div>').appendTo('.Comments_Div');
    				$('#Comment').val('');
    				$('#Comments').text( parseInt($('#Comments').text()) + 1 );
                }
                else
                    SetError_Function('in Making Comment',
                        'in PostScript.js', 'in SendComment Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
            }
            catch(e){
                SetError_Function('in Making Comment',
                    'in PostScript.js', 'in SendComment Function', 'JSON Error',
                    '1', 'Failed To Covert JSON', true);
            }    
        }
    });
}
// Line 153