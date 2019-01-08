<!DOCTYPE >
<html>
<head>
	<title>Predict Price</title>
	<link rel="stylesheet" type="text/css" href="../Header.css">
	<link rel="stylesheet" type="text/css" href="../Center.css">
	<link rel="stylesheet" type="text/css" href="../Footer.css">
	<link rel="icon" type="image/JPG" href="../LOGO.PNG">
</head>

<body onclick="Hide();" >

	<?php
		session_start();
		$_SESSION['Page'] = 'Predict';
		session_write_close();
		include '../HeaderAll.php';
	?>
	
	<section >
		
		<div id='Title' >
            Predict Price
        </div>

        <!--<form style="border-bottom: 3px;border-bottom-width: : 3px;
        			border-bottom-style: solid; border-bottom-color: #DB00C4;
        			border-bottom-right-radius: 2px;border-bottom-left-radius: 2px;">
    		For Distruct : 
    		<select class="Input_Data" >
    			<option>All</option>
    			<option>ElSadat</option>
            	<option>Mubarak</option>
            	<option>Teachers</option>
			    <option>Elweledia</option>
			</select>
			<p>The Average is <span> 0.0 Pound </span></p>
			<p>The Min is <span> 0.0 Pound </span></p>
			<p>The Max is <span> 0.0 Pound </span></p>
			
		</form>-->

		<form id='Form'>
			Predict Price For Spesified House
		    <div>
		        Type : 
		        <select class="Input_Data" id='Type'>
		        	<option>For Families</option>
		            <option>For Students</option>
		            <option>For Offices</option>
		        </select>
		    </div>
		    <div>
		        Statues : 
		        <select class="Input_Data" id='Status'>
		            <option>Buy</option>
		            <option>Rent</option>
		        </select>
		    </div>
		            
		    <div>
		        Distruct : 
		        <select class="Input_Data" id='Distruct'>
		        	<option>All</option>
		            <option>ElSadat</option>
		            <option>Mubarak</option>
		            <option>Teachers</option>
		            <option>Elweledia</option>
		        </select>
		    </div>

		    <div>
		        <input type="text" class="Input_Data" id='Area' 
		        	placeholder="Enter The Area">
		    </div>
		    
		    <div>
		      	<input type="text" class="Input_Data" id='Rooms' 
		      		placeholder="Number Of Rooms">
		   	</div>
		    
		    <div>
		    	<input type="text" class="Input_Data" id='PathRooms'
		    		placeholder="Number Of PathRooms">
		    </div>

		    <div>
		        Is Furnished : 
		        <select class="Input_Data" id='Furnished'>
		            <option>YES</option>
			        <option>NO</option>
			    </select>
			</div>

			<div>
			    <input type="submit" id='Predict' value="Predict" class="Button">
			</div>
			<p>The Predict Price is <span class='Result'> 0.0  Pound </span></p>
			<p>The Min Price is <span class='Result'> 0.0  Pound </span></p>
			<p>The Max Price is <span class='Result'> 0.0  Pound </span></p>
			<p>The Average Price is <span class='Result'> 0.0  Pound </span></p>
			<a href="">Show Floors has same price =></a>
		</form>

	</section>
    
    <?php
    	include '../Footer.php';
    ?>

    <script src="http://localhost/FindHouse/jquery-3.3.1.js"></script>
    <script src="http://localhost/FindHouse/DropBox.js"></script>

    <script type="text/javascript">
    	$(document).ready(function () {

    		$('#Form').submit(function(){

    			event.preventDefault();
    			Send_Data();
    		});
    	});

    	function Send_Data(){
    		Type = $("#Type").find(':selected').text();
    		Status = $("#Status").find(':selected').text();
    		Distruct = $("#Distruct").find(':selected').text();
    		Area = $("#Area").val();
    		Furnished = $("#Furnished").find(':selected').text();
    		Length = Area.length;

    		if ( Length>0 ){
    			Rooms = $("#Rooms").val();
    			RLength = Rooms.length;
    			if ( RLength==0 ){
    				if ( Length<200 )
    					Rooms = 2;
    				else if ( Length<300 )
    					Rooms = 3;
    				else if ( Length<400 )
    					Rooms = 4;
    				else if ( Length<500 )
    					Rooms = 5;
    			}

    			PathRooms = $("#PathRooms").val();
    			PRLength = PathRooms.length;
    			if ( PRLength==0 ){
    				if ( Length<200 )
    					PathRooms = 1;
    				else if ( Length<300 )
    					PathRooms = 2;
    				else if ( Length<400 )
    					PathRooms = 3;
    				else if ( Length<500 )
    					PathRooms = 4;
    			}

    			$.ajax({
			        type : "POST",
			        url : "http://localhost/FindHouse/Predict/PredictPrices.php",
			        data : "Type="+Type+"&Status="+Status+"&Distruct="+Distruct
			        		+"&Area="+Area+"&Furnished="+Furnished
			        		+"&Rooms="+Rooms+"&PathRooms="+PathRooms,

			        success : function(message){
			        	alert(message);
			        }
			    });
    		}
    		else
    			alert('Must Enter The Area');
    	}
    </script>

</body>
</html>