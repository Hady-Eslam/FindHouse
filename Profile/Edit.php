<?php
	session_start();
	if (isset($_SESSION['Name'])){
		$_SESSION['Page'] = 'Edit';
?>

<!DOCTYPE >
<html>
<head>
	<title>Edit Post</title>
	<link rel="stylesheet" type="text/css" href="Header.css">
	<link rel="stylesheet" type="text/css" href="Center.css">
	<link rel="stylesheet" type="text/css" href="Footer.css">
	<link rel="icon" type="image/JPG" href="Icon.JPG">
</head>

<body onclick="Hide();" >

	<?php
		include '../HeaderLogged.php';
	?>

	<section>

		<div class='Search'>
			<form id='Form'>
	            <div style="right: 634px;position: absolute;color: #FFF;
	                    background-color:#D10101;border-radius:5px;
	                    top: 800px;visibility: hidden; "
	                    id='Result'>
	                <p id='Text'>Edited</p>
	            </div>

	            <div>
	                Distruct : 
	                <select class="Input_Data" id='Distruct' name='Distruct' 
	                        onfocus="Focus(this);" onblur="Blur(this);">
	                    <option>ElSadat</option>
	                    <option>Mubarak</option>
	                    <option>Teachers</option>
	                    <option>Elweledia</option>
	                </select>
	                &nbsp;&nbsp;
	                <input type="text" name="Street" id='Street' class='Input_Data'
	                    placeholder="Enter The Street" onfocus="Focus(this);" 
	                    onblur="Blur(this);">
	            </div>

	            <div>
	                Status :
	                <select class='Input_Data' name="Status" id='Status'
	                        onfocus="Focus(this);" onblur="Blur(this);">
	                    <option>Rent</option>
	                    <option>Buy</option>
	                </select>
	            </div>

	            <div>
	                Type : 
	                <select class='Input_Data' name="Type" id="Type"
	                        onfocus="Focus(this);" onblur="Blur(this);">
	                    <option>For Students</option>
	                    <option>For Families</option>
	                    <option>For Offices</option>
	                </select>
	            </div>

	            <div>
	                <input type="text" name="Phone" id='Phone' required
	                    class='Input_Data' placeholder="Enter The Phone"
	                    onfocus="Focus(this);" onblur="Blur(this);">
	            </div>

	            <div>
	                <input type="text" name="Area" id='Area' required
	                    class='Input_Data' placeholder="Enter The Area"
	                    onfocus="Focus(this);" onblur="Blur(this);">
	            </div>

	            <div>
	                <input type="text" name="Rooms" id='Rooms' required
	                    class='Input_Data' placeholder="Number Of Rooms"
	                    onfocus="Focus(this);" onblur="Blur(this);">
	            </div>

	            <div>
	                <input type="text" name="PathRooms" id='PathRooms' required
	                    class='Input_Data'placeholder="Number Of PathRooms"
	                    onfocus="Focus(this);" onblur="Blur(this);">
	            </div>

	            <div>
	                <input type="text" name="Money" id='Money' required
	                    class='Input_Data' placeholder="Enter The Money"
	                    onfocus="Focus(this);" onblur="Blur(this);">
	            </div>

	            <div>
	                Is Furnished : 
	                <select class='Input_Data' name="Condition" id='Condition' 
	                        onfocus="Focus(this);" onblur="Blur(this);">
	                    <option value="Yes" selected>YES</option>
	                    <option value="No">NO</option>
	                </select>
	            </div>

	            <div>
	                <textarea cols="40" rows="7" style="border-radius: 2px;
	                    border-style: solid;border-width: 2px;
	                    border-color: #FFF;padding: 7 7 7 7;font-size: 15px;"
	                    placeholder="Enter Your Discreption Here" name="Discreption"
	                    id="Discreption"onfocus="Focus(this);" onblur="Blur(this);">
	                </textarea>
	            </div>

	            <div>
	                <input type="submit" name="" value="Post" class="Button">
	            </div>

	        </form>
		</div>
		
	</section>

	<?php
    	include '../Footer.php';
    ?>

    <script src="http://localhost/FindHouse/jquery-3.3.1.js"></script>
    <script src="http://localhost/FindHouse/DropBox.js"></script>
    <script type="text/javascript">
    	$.ajax({
	        type : "POST",
	        url : "http://localhost/FindHouse/GetPostToEdit.php",
	        data : "ID=<?php echo $_GET['ID']?>",

	        success : function(message){
	            //alert(message);
	            if (message=='Success'){
	            	GetData();
	            }
	            else{
	            	$(".Search").empty();
		            $("<div style='text-align: center;font-size: 40px;color:"
		                +" red;'><p>"+message+"</p></div>").appendTo(".Search");
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
							distruct = $(this).find("distruct").text();
							street = $(this).find("street").text();
							status = $(this).find("status").text();
							type = $(this).find("type").text();
							area = $(this).find("area").text();
							Furnished = $(this).find("Furnished").text();
							rooms = $(this).find("rooms").text();
							pathrooms = $(this).find("pathrooms").text();
							phone = $(this).find("phone").text();
							discreption = $(this).find("discreption").text();
							price = $(this).find("price").text();
							alert('Success');
							/*PutData(distruct,street,status,type,price,area,
								Furnished,rooms,pathrooms,phone,
								discreption);*/
						});
					});
				},
				error : function(data){
					$(".Search").empty();
		            $("<div style='text-align: center;font-size: 40px;color: red;'>"
		                +"<p>Error Occured/p></div>").appendTo(".Search");
				}
			});
		}

    </script>

</body>
</html>

<?php
	}
	else{
?>

<!DOCTYPE>
<html>
<head>
	<title>Edit Post</title>
	<link rel="icon" type="image/JPG" href="Icon.JPG">
</head>
<body style="text-align: center;">
	<p style="margin-top: 200px;">Can Not Go To This Page</p>
	<a href='http://localhost/FindHouse/Main.php'>Go To The Main Page</a>
</body>
</html>

<?php
	}
	session_write_close();
?>