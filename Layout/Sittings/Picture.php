<p>Profile Picture</p>
<div class="Div2" id="ProfilePicture">
	<div class="Div3">
	    <input type="image" src="<?php echo AddPicture; ?>"
	        width="80" height="80" alt="AddPicture" id='image1'
	        style="cursor: pointer;" onclick="GetPicture('#File1');"
	        name = 'image1'>

	    <input type="file" id='File1' style="display: none;"
	        onchange="Read(this, '#image1');" name='File1'>

	    <p style="font-size: 15px;">Change Profile Picture</p>

	</div>
    <div class="Button_Div">
        <input type="submit" class="Button" value="Save Picture"
            name = 'PictureSubmit' id="PictureSubmit" style="width: auto;">
    </div>
</div>