var Num = 0;
$(document).ready(function(){
    SendQuery();

    $('#Rent').click(function(){
        Num = 0;
        Empty();
        Change('#Rent');
        SendQuery();
    });
    $('#Buy').click(function(){
        Num = 0;
        Empty();
        Change('#Buy');
        SendQuery();
    });

    $('#Family').click(function(){
        Num = 0;
        Empty();
        Change('#Family');
        SendQuery();
    });
    $('#Office').click(function(){
        Num = 0;
        Empty();
        Change('#Office');
        SendQuery();
    });
    $('#Student').click(function(){
        Num = 0;
        Empty();
        Change('#Student');
        SendQuery();
    });
});

function Go(){
    SendQuery();
}

function Change(text){
    if ($(text).attr('class')=='Button'){
        $(text).removeClass('Button');
        $(text).addClass('Button_Clicked');
    }
    else{
        $(text).removeClass('Button_Clicked');
        $(text).addClass('Button');
    }
}

function Empty(){
    $('#Container').empty();
    
    $( '#Container' ).append("<div style='visibility: hidden;' id='Show'>"
        +"<p id='End' style='color: #A60303;'>Results Ends Here</p></div><div"
        +" class='Div_Show_More'><a class='Show_More' onclick='Go();'>Show More"
        +"</a></div>");
}

function SendQuery(){

	Rent = Get('#Rent');
	Buy = Get('#Buy');
	Family = Get('#Family');
	Office = Get('#Office');
	Student = Get('#Student');

	$.ajax({
        type : "POST",
        url : "http://localhost/FindHouse/Main/SearchPosts.php",
        data : "Rent="+Rent+"&Buy="+Buy+"&Families="+Family
        		+"&Offices="+Office+"&Students="+Student+"&Number="+Num,

        success : function(message){
        	if ( message=='Success' ){
                GetData();
            }
            else{
            	$('#End').text(message);
            	if ( message=='NoData' )
            		$('#End').text("Results Ends Here");
                $('#Show').css('visibility','visible');
            	$('.Div_Show_More').css('visibility','hidden');
            }
        }
    });
}

function Get(text){
	if ( $(text).attr('class')=='Button_Clicked' )
		return 'Y';
	return 'N';
}

function GetData(){
	$.ajax({
		type:"GET",
		url:"Result.xml",
		dataType:"xml",
		success : function(data){
	
			$(data).find("Results").each(function(){
				
				$(this).find("result").each(function(){
					id = $(this).find("id").text();
					distruct = $(this).find("distruct").text();
					status = $(this).find("status").text();
					type = $(this).find("type").text();
					price = $(this).find("price").text();
					PutData(Num,id,distruct,status,type,price);
				});
			});
		},
		error : function(data){
			$('#End').text("Error Occured");
			$('#Show').css('visibility','visible');
		}
	});
}

function PutData(num,ID,distruct,status,type,price){
	id = num+1;
    s = "<div class='Search' onclick='GO("+ID+");' id='_"+id+"'><div class="
        +"'Search_Item'>"
        +"<div class='Search_Item'><img src='../PIC.JPG' width='80' height='80'>"
        +"</div><div class='Search_Item'><span>Date of Post</span><p>05/10/2018"
        +"</p>"
        +"</div><div class='Search_Item'><p>"+status+" "+type+"</p><p>"
        +"<span>Price</span> : "+price+" Ponud</p></div><div class='Search_Item'>"
        +"<span>Address</span><p>"+distruct+"</p></div></div></div>"
	
    /*s = "<div class='Search' id='_"+id+"' onclick='GO("+ID+");'><div "
        +"class='Search_Item'><div class='Search_Item'><img src='../PIC.JPG'"
        +"width='80'"
        +" height='80'></div><div class='Search_Item'><p>"+type+" , "+status+" , "
        +distruct+" And "+price+"</p></div><div class='Search_Item'>"
        +"</div></div>";*/
	if ( num==0 )
		$("#Show").before(s);
	else
		$(s).insertAfter( "#_"+num );
	Num++;
}

function GO(ID){
    window.location.href = "http://localhost/FindHouse/Show.php?ID="+ID;
}