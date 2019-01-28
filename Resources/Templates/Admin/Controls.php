<?php
	session_start();
	$_SESSION['Page'] = 'Controls';
	if (isset($_SESSION['Name']) ){
		if ( $_SESSION['Status']=='Admin'){
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
			padding: 5 5 5 5;
		}
		.Search{
			border-width: 1px;
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
    	
    	<div style="margin: 0 0 0 0; padding: 0 0 0 0;">
    		<div class='information' style="display: inline-block;">
	    		<div style="display: inline-block;">
	    			<img src="../Happy.PNG" height="180" width="180">
	    		</div>
	    		<div style="display: inline-block;">
	    			<p><span>Name</span> : <?php echo $_SESSION['Name'];?></p>
	    			<p><span>Email</span> &nbsp;: <?php echo $_SESSION['Email'];?></p>
	    		</div>
	    	</div>
	    	<div style="display: inline-block;" class="information">
	    		<input type="checkbox" id='Find'>
	    		<label for="Find">Find</label>
	    		<br>
	    		<input type="checkbox" id='Advertise'>
	    		<label for="Advertise">Advertise</label>
	    		<br>
	    		<input type="checkbox" id='Predict'>
	    		<label for="Predict">Predict</label>
	    		<br>
	    		<input type="checkbox" id='Interested'>
	    		<label for="Interested">Interested In</label>
	    		<br>
	    		<input type="checkbox" id='Profile'>
	    		<label for="Profile">Profile</label>
	    		<br>
	    		<input type="checkbox" id='Analysis'>
	    		<label for="Analysis">Analysis</label>
	    		<br>
	    		<input type="checkbox" id='Sittings'>
	    		<label for="Sittings">Sittings</label>
	    	</div>
    	</div>
    	
    	<form>
    		<div >
    			<input type="button" value="Active Acounts" class="Button"
    				style='height: auto;width: auto;cursor: pointer;'
    				id='Active' onclick="Activated_Acounts();">

    			<input type="button" value="Deleted Acounts" class="Button" 
    				style='height: auto;width: auto;cursor: pointer;'
    				id='Deleted' onclick="Deleted_Acounts();">
    			
    			<input type="button" value="Send Notification" class="Button" 
    				style='height: auto;width: auto;cursor: pointer;'
    				id='Send_Notification' onclick="Send();">

    			<input type="button" value="Set Post" class="Button" 
    				style='height: auto;width: auto;cursor: pointer;'
    				id='Set_Post' onclick="Post();">
    		</div>
    		<div id='Result' style="right: 634px;position: absolute;
    				background-color:#0DBC77;border-radius:5px;top: 600px;
                    border-color: #0DBC77;border-style: solid;
                    border-width: 1px;visibility: hidden;color: #FFF ">
                <p id='Text'>Deleted</p>
            </div>

    		<div style="border-color: black;border-radius: 5px;
    					border-width: 2px;border-style: solid;
    					margin: 20 20 20 20;padding: 20 20 20 20;"
    				id='Container'>

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
    	$(document).ready(function(){
    		Activated_Acounts();
    	});

    	function Change(text){
    		$(text).removeClass('Button');
		    $(text).addClass('Button_Clicked');
		}

		function Remove(text){
			$(text).removeClass('Button_Clicked');
		    $(text).addClass('Button');
		}

    	var Num = 0;
    	function Activated_Acounts(){
    		Num = 0;
    		Change("#Active");
    		Remove("#Deleted");
    		Remove("#Send_Notification");
    		Remove("#Set_Post");
    		Empty();
    		$(".Show_More").attr('id','Activate');
    		Search("Permession=OK&Type=Active&Num="+Num,"Active");
    	}

    	function Deleted_Acounts(){
    		Num = 0;
    		Change("#Deleted");
    		Remove("#Active");
    		Remove("#Send_Notification");
    		Remove("#Set_Post");
    		Empty();
    		$(".Show_More").attr('id','Delete');
    		Search("Permession=OK&Type=Deleted&Num="+Num,"Delete");
    	}

    	function Search(Data,Status){
	    	$.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/AdminSearch.php",
		        data : Data,

		        success : function(message){
		        	if (message=='Success'){
		        		GetData(Status);
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

		    function GetData(Status){
		    	$.ajax({
					type:"GET",
					url:"Result.xml",
					dataType:"xml",
					success : function(data){
				
						$(data).find("Results").each(function(){
							
							$(this).find("result").each(function(){
								id = $(this).find("id").text();
								name = $(this).find("name").text();
								email = $(this).find("email").text();
								date = $(this).find("date").text();
								PutData(Num,id,name,email,date,Status);
							});
						});
					},
					error : function(data){
						$('#Text').text("Error Occured");
						$('#Result').css('visibility','visible');
						setTimeout(function(){
							$('#Result').css('visibility','hidden');
						}, 1500);
					}
				});

				function PutData(num,ID,name,email,date,Status){
					id = num+1;
					s = "<div class='Search' style='cursor:pointer;'"
							+"id='_"+id+"' onclick='Go(\""+email+"\")'>"
		    				+"<div class='Search_Item'>"
		    					+"<div class='Search_Item'>";
		    					if ( Status=='Delete'){
		    						s += "<input type='button' value='Activate' class='Button' style='height: auto;width: auto;cursor: pointer;'"
		    							+" onclick='Active_Acount("+ID+")'>";
		    					}
		    					else{
		    						s += "<input type='button' value='X' class='Delete' "
		    							+" onclick='Delete_Acount("+ID+")'>";
		    					}
		    					s+="</div>"

		    					+"<div class='Search_Item'>"
		    						+"<img src='../PIC.JPG' width='80' height='80'>"
		    					+"</div>"
		    					
		    					+"<div class='Search_Item'>"
		    						+"<span>Sign In Date</span>"
		    						+"<p>"+date+"</p>"
		    					+"</div>"
		    					
		    					+"<div class='Search_Item'>"
		    						+"<span>Email</span>"
		    						+"<p>"+email+"</p>"
		    					+"</div>"
		    					
		    					+"<div class='Search_Item'>"
		    						+"<span>Name</span>"
		    						+"<p>"+name+"</p>"
		    					+"</div>"
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

	    function Empty(){
		    $('#Container').empty();
		    
		    $( '#Container' ).append("<div style='visibility: hidden;' id='Show'>"
		        +"<p id='End' style='color: #A60303;text-align:center;'>Results Ends Here</p></div><div"
		        +" class='Div_Show_More'><a class='Show_More' onclick='ShowMore();'>Show More"
		        +"</a></div>");
		}

		function ShowMore(){
			if ( $('.Show_More').attr('id')=='Activate' )
				Search("Permession=OK&Type=Active&Num="+Num);
			else if ( $('.Show_More').attr('id')=='Delete' )
				Search("Permession=OK&Type=Deleted&Num="+Num);
		}

		function Delete_Acount(ID){
			$.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/DeleteEditAcount.php",
		        data : "ID="+ID+"&Status=Delete",

		        success : function(message){
		        	$('#Text').text("Error Occured");
		        	if (message=='Success')
		        		$('#Text').text("Deleted");

		        	$('#Result').css('visibility','visible');
					setTimeout(function(){
						$('#Result').css('visibility','hidden');
						window.location.href 
							= 'http://localhost/FindHouse/Admin/Admin.php';
					}, 1500);
		        }
		    });
		}

		function Active_Acount(ID){
			$.ajax({
		        type : "POST",
		        url : "http://localhost/FindHouse/Admin/DeleteEditAcount.php",
		        data : "ID="+ID+"&Status=Active",

		        success : function(message){
		        	
		        	$('#Text').text("Error Occured");
		        	if (message=='Success')
		        		$('#Text').text("Activated");

		        	$('#Result').css('visibility','visible');
					setTimeout(function(){
						$('#Result').css('visibility','hidden');
						window.location.href 
							= 'http://localhost/FindHouse/Admin/Admin.php';
					}, 1500);
		        }
		    });
		}
    </script>

    <script type="text/javascript">
    	function Send(){
    		Change("#Send_Notification");
    		Remove("#Active");
    		Remove("#Deleted");
    		Remove("#Set_Post");
    		$('#Container').empty();
    		s = "<div style='text-align: center;'>"
    				+"<div>"
    					+"<p style='display: inline-block;'>To : </p>"
    					+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	    				+"<input type='text' placeholder='Enter email' size='20'"
	    					+"class='Input_Data'>"
	    				+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
	    				+"<input type='checkbox' id='All'>"
	    				+"<label for='All'>To All</label>"
    				+"</div>"
    				+"<div>"
    					+"<textarea cols='40' rows='7' style='border-radius: 5px;"
                    		+"border-style: solid;border-width: 1px;"
                    		+"border-color: #FFF;padding: 7 7 7 7;font-size: 15px;'"
                    		+"id='Discreption'>"
                		+"</textarea>"
    				+"</div>"
    				+"<div>"
    					+"<input type='button' class='Button' value='Send' style='cursor: pointer;'>"
    				+"</div>"
    			+"</div>";
    		$(s).appendTo("#Container");
    	}
    </script>

    <script type="text/javascript">
    	function Post(){
    		Change("#Set_Post");
    		Remove("#Active");
    		Remove("#Deleted");
    		Remove("#Send_Notification");
    		$('#Container').empty();
    		s = "<div style='text-align: center;'>"
    				+"<div>"
		                +"<textarea cols='60' rows='12' style='border-radius: 5px;"
		                    +"border-style: solid;border-width: 1px;"
		                    +"border-color: #FFF;padding: 7 7 7 7;font-size: 15px;'"
		                    +"id='Discreption'>"
		                +"</textarea>"
		            +"</div>"
		            +"<div>"
		            	+"<input type='button' value='Post' class='Button' style='cursor: pointer;'>"
		            +"</div>"
    			+"</div>";
    		$(s).appendTo("#Container");
    	}
    </script>
    <script type="text/javascript">
    	function Go(email){
    		window.location.href 
    			= 'http://localhost/FindHouse/Admin/ShowProfile.php?Email='+email;
    	}
    </script>


</body>
</html>

<?php
	}}else{
?>

<!DOCTYPE>
<html>
<head>
	<title>Controls</title>
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