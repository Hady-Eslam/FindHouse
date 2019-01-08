var Num = 0;
$(document).ready(function(){
	SendQuery();
});

function SendQuery(){

	$.ajax({
        type : "POST",
        url : "http://localhost/FindHouse/Profile/ProfileSearchPosts.php",
        data : "Number="+Num,

        success : function(message){
        	if ( message=='Success' )
                GetData();
            else{
            	$('#End').text(message);
            	if ( message=='NoData' )
            		$('#End').text("Results Ends Here");
                $('#Final').css('visibility','visible');
            	$('.Div_Show_More').css('visibility','hidden');
            }
        }
    });
}

function GetData(){
	$.ajax({
		type:"GET",
		url:"Posts.xml",
		dataType:"xml",
		success : function(data){
	
			$(data).find("Results").each(function(){
				
				$(this).find("result").each(function(){
					ID = $(this).find("id").text();
					status = $(this).find("status").text();
					type = $(this).find("type").text();
					price = $(this).find("price").text();
					date = $(this).find("date").text();
                    views = $(this).find("views").text();
					PutData(Num,ID,status,type,price,date,views);
				});
			});
		},
		error : function(data){
			$('#End').text("Error Occured");
			$('#Final').css('visibility','visible');
            $('.Div_Show_More').css('visibility','hidden');
		}
	});
}

function PutData(num,ID,status,type,price,date,views){

	id = num+1;
	s = "<div class='Search' id='_"+id+"' "
            +"style='font-size: 17px;' >"
            +"<div class='Search_Item' >"
                +"<div style='text-align: center;'>"
                    +"<input type='button' value='X' class='Delete'"
                        +"onclick='return Delete("+ID+");'"
                        +"style='font-size: 17px;height: auto;width: auto;'>"
                    +"<input type='button' value='Edit' class='Button'>"
                +"</div>"
                +"<p style='font-size: 17px;margin: 0 0 0 0;padding: 0 0 0 0 ;'>"
                    +"Searching = "+views+"</p>"
            +"</div >"
            +"<div onclick='Go("+ID+")' class='Search_Item'"
                +"style='cursor: pointer;'>"
                +"<div class='Search_Item'>"
                    +"<p>"+status+" &nbsp;&nbsp;&nbsp;"+type+"</p>"
                    +"<p><span>Price</span> : "+price+" pound</p>"
                +"</div>"
                +"<div class='Search_Item'>"
                    +"<p><span>Date Of Posting</span></p>"
                     +"<p>"+date+"</p>"
                +"</div>"
            +"</div>"
        +"</div>";

	if ( num==0 )
		$("#Final").before(s);
	else
		$(s).insertAfter( "#_"+num );
	Num++;
}