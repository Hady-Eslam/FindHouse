<?php
function MyProfile_Begin(){
	MyProfile_Get_Posts();
	include_once MyProfile_Template;
}

function MyProfile_Get_Posts(){
	$Result = (new MYSQLClass('Profile'))
		->FetchAllRows('SELECT * FROM posts WHERE user_email = ? AND deleted = ?',
		array( (new HashingClass())->Hash_POSTS($_SESSION['Email']), '0'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Query_Results'] = [];
	else
		$GLOBALS['Query_Results'] = $Result->Data;
}

function MyProfile_GetPosts($Post, $Count){

	?>
	<div id="<?php echo $id; ?>">
	    <p>Post <?php echo $Count; ?></p>

	    <input type="button" name="Delete"  value="X"
	            onclick="DeletePost(<?php echo $id.', '.$Count; ?>);">

	    <a href="<?php echo Post.$id; ?>">Click Here To See The Post</a>
	</div>
	<?php
	return ($Count + 1);
}