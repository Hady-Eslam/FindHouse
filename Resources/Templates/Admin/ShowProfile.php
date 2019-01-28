<?php
	session_start();
	$_SESSION['Page'] = 'ShowProfile';
	if (isset($_SESSION['Name'])){
?>

<!DOCTYPE >
<html>
<head>
	<title>My Profile</title>
	<link rel="stylesheet" type="text/css" href="../Header.css">
	<link rel="stylesheet" type="text/css" href="../Center.css">
	<link rel="stylesheet" type="text/css" href="../Footer.css">
	<link rel="icon" type="image/JPG" href="../LOGO.PNG">
	<style type="text/css">
		.information{
			display: inline-block;
			text-align: left;
			border-radius: 5px;
			border-width: 2px;
			border-style: solid;
			border-color: #0DBC77;
		}
		.Search{
			border-width: 2px;
			border-radius: 5px;
			border-style: solid;
    		border-color:#0DBC77;
			text-align: left;
			margin: 10 10 10 10;
			padding: 1 1 1 1;
		}
		.Search_Item{
			display: inline-block;
			margin-left: 5;
			margin-right: 5;
			text-align: center;
		}
		.Delete{
			background-color: #CD0101;
			border-color: #CD0101;
			border-style: solid;
			border-width: 1px;
			border-radius: 5px;
			width: 40px;
			height: 40px;
			font-size: 20px;
			color: #FFF;
			cursor: pointer;
			display: inline-block;
		}
        span{
            color: #359007;
        }
	</style>
</head>

<body onclick="Hide();" >

	<?php
		include '../HeaderLogged.php';
	?>

    <section style="text-align: left;">
    	
    	<div class='information'>
    		<div style="display: inline-block;">
    			<img src="../Happy.PNG" id='Photo' width="180" height="180">
    		</div>
    		<div style="display: inline-block;" id='Info'>

    		</div>
    	</div>

    	<form>
    		<div id='Result' style="right: 634px;position: absolute;
    				background-color:#0DBC77;border-radius:5px;top: 600px;
                    border-color: #0DBC77;border-style: solid;
                    border-width: 1px;visibility: hidden;color: #FFF ">
                <p id='Text'>Deleted</p>
            </div>

    		<div style="border-color: black;border-radius: 5px;
    					border-width: 2px;border-style: solid;
    					margin: 20 20 20 20;padding: 20 20 20 20;">

		    	<div style="visibility: hidden;text-align: center;" id='Show'>
		        	<p id='End' style="color: #A60303;">Results Ends Here</p>
		        </div>

		        <div class='Div_Show_More'>
		        	<a class='Show_More' onclick="ShowMore();">Show More</a>
		        </div>
    		</div>
    	</form>
    	
    </section>

    <?php
    	include '../Footer.php';
    ?>

    <script src="http://localhost/FindHouse/jquery-3.3.1.js"></script>
    <script src="http://localhost/FindHouse/DropBox.js"></script>

    <script type="text/javascript">
    	var Num = 0;
    	var UserEmail = "<?php echo $_GET['Email'];?>" ;
		$(document).ready(function(){
			GetInformations();
			SendQuery();
		});

		function SendQuery(){

			$.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/ProfileSearchPosts.php",
		        data : "Number="+Num+"&Email="+UserEmail,

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

		    function GetData(){
				$.ajax({
					type:"GET",
					url:"Result.xml",
					dataType:"xml",
					success : function(data){
				
						$(data).find("Results").each(function(){
							
							$(this).find("result").each(function(){
								ID = $(this).find("id").text();
								status = $(this).find("status").text();
								type = $(this).find("type").text();
								price = $(this).find("price").text();
								deleted = $(this).find("deleted").text();
								post_day = $(this).find("post_day").text();
								post_month = $(this).find("post_month").text();
								post_year = $(this).find("post_year").text();
			                    views = $(this).find("views").text();

								PutData(Num,ID,status,type,deleted,price,post_day,
									post_month,post_year,views);
							});
						});
					},
					error : function(data){
						$('#End').text("Error Occured");
						$('#Show').css('visibility','visible');
					}
				});

				function PutData(num,ID,status,type,deleted,price,post_day
					,post_month,post_year,views){
					id = num+1;

					s = "<div class='Search' id='_"+id+"' onclick='GO("+ID+")' "
							+"style='cursor:pointer;'>"
							+"<div class='Search_Item'>"
								if (deleted=='NO'){
					        		s += "<div style='text-align: center;'>"
					        			+"<input type='button' value='X' class='Delete'"
					        					+"onclick='Delete("+ID+");'>"
					        		+"</div>"
					        	}
					        	else{
					        		s += "<div style='text-align: center;'>"
					        			+"<input type='button' value='Re-Post' class='Button'"
					        					+"onclick='RePost("+ID+");'>"
					        		+"</div>"
					        	}
				        		s += "<p style='font-size: 17px;"
				        			+"margin: 0 0 0 0;padding: 0 0 0 0 ;'>"
				        			+"Searching = "+views
				        		+"</p>"
				        	+"</div>"

				        	+"<div class='Search_Item'>"
			        			+"<p><span>Deleted</span></p>"
			        			+"<p>"+deleted+"</p>"
			        		+"</div>"
				        	
				        	+"<div class='Search_Item' >"
			        			+"<p>"+status+" &nbsp;&nbsp;"+type+"</p>"
			        			+"<p><span>Price</span> : "+price+" pound"+"</p>"
			        		+"</div>"
			        		
			        		+"<div class='Search_Item'>"
			        			+"<p><span>Date Of Posting</span></p>"
			        			+"<p>"+post_day+" / "+post_month+" / "+post_year
			        			+"</p>"
			        		+"</div>"
			        	+"</div>";

					if ( num==0 )
						$("#Show").before(s);
					else
						$(s).insertAfter( "#_"+num );
					Num++;
				}
			}
		}

		function ShowMore(){
		    SendQuery();
		}

		function Delete(ID){
		    $.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/DelRePost.php",
		        data : "ID="+ID+"&Status=Delete",

		        success : function(message){

		            $('#Text').text(message);
		            if ( message=='Success' )
		            	$('#Text').text("Deleted");
		            $('#Result').css('top',$(window).scrollTop()+200)
		                        .css('visibility','visible');
		            setTimeout(function () {
	                    window.location.reload(true);
	                }, 1300);
		        }
		    });
		}

		function RePost(ID){
		    $.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/DelRePost.php",
		        data : "ID="+ID+"&Status=RePost",

		        success : function(message){
		            
		            $('#Text').text(message);
		            if ( message=='Success' )
		            	$('#Text').text("Re Posted");
		            $('#Result').css('top',$(window).scrollTop()+200)
		                        .css('visibility','visible');
		            setTimeout(function () {
	                    window.location.reload(true);
	                }, 1300);
		        }
		    });
		}
    </script>

    <script type="text/javascript">
    	function GetInformations(){
    		$.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/ProfileData.php",
		        data : "Email="+UserEmail,

		        success : function(message){
		        	if ( message=='Success' ){
		                GetInfoData();
		            }
		            else{
		            	$('#Text').text(message);
			            $('#Result').css('top',$(window).scrollTop()+200)
			                        .css('visibility','visible');
			            setTimeout(function () {
		                    $('#Result').css('visibility','hidden');
		                }, 1300);
		            }
		        }
		    });

		    function GetInfoData(){
		    	$.ajax({
					type:"GET",
					url:"Profile.xml",
					dataType:"xml",
					success : function(data){
				
						$(data).find("Results").each(function(){
							
							$(this).find("result").each(function(){
								ID = $(this).find("id").text();
								deleted = $(this).find("deleted").text();
								name = $(this).find("name").text();
								email = $(this).find("email").text();
								phone = $(this).find("phone").text();
								password = $(this).find("password").text();
								posts = $(this).find("posts").text();
								date = $(this).find("date").text();

								PutInfoData(ID,deleted,name,email,phone,password,
									posts,date);
							});
						});
					},
					error : function(data){
						$('#Text').text(message);
			            $('#Result').css('top',$(window).scrollTop()+200)
			                        .css('visibility','visible');
			            setTimeout(function () {
		                    $('#Result').css('visibility','hidden');
		                }, 1300);
					}
				});

				function PutInfoData(ID,deleted,name,email,phone,password,
								posts,date){
					$("<p><span>ID = </span>"+ID+"</p>").appendTo("#Info");
					$("<p><span>Deleted = </span>"+deleted+"</p>")
							.appendTo("#Info");
					$("<p><span>Name = </span>"+name+"</p>").appendTo("#Info");
					$("<p><span>Email = </span>"+email+"</p>").appendTo("#Info");
					$("<p><span>Phone = </span>"+phone+"</p>").appendTo("#Info");
					$("<p><span>Password = </span>"+password+"</p>")
							.appendTo("#Info");
					$("<p><span>Number Of Posts = </span>"+posts+"</p>")
							.appendTo("#Info");
					$("<p><span>Date Of Sign In = </span>"+date+"</p>")
							.appendTo("#Info");
				}
		    }
    	}
    </script>

    <script type="text/javascript">
    	function GO(ID){
    		window.location.href 
    			= 'http://localhost/FindHouse/Show.php?Permession=YES&ID='+ID;
    	}
    </script>

</body>
</html>

<?php
	}else{
?>

<!DOCTYPE>
<html>
<head>
	<title>Show Profile</title>
	<link rel="icon" type="image/JPG" href="../LOGO.PNG">
</head>
<body style="text-align: center;">
	<p style="margin-top: 200px;">Can Not Go To This Page</p>
	<a href='http://localhost/FindHouse/Main/Main.php'>Go To The Main Page</a>
</body>
</html>

<?php
	}session_write_close();
?>