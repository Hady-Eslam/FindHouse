<?php
function MyProfile_Begin($Type){
	MyProfile_Get_Posts($Type);
	include_once MyProfile_Template;
}

function MyProfile_Get_Posts($Type){
	if ( $Type == 1 )
		MyProfile_Get_All_Posts();

	else if ( $Type == 2 )
		MyProfile_Get_Pedding_Posts();
	
	else if ( $Type == 3 )
		MyProfile_Get_Rejected_Posts();
	
	else
		MyProfile_Get_Approved_Posts();
}

function MyProfile_Get_All_Posts(){
	$Result = (new MYSQLClass('Profile'))->FetchAllRows('SELECT * FROM posts WHERE user_email = ? AND deleted = ? ORDER BY id DESC',
		array( (new HashingClass())->Hash_POSTS($_SESSION['Email']), '0'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;
}

function MyProfile_Get_Pedding_Posts(){
	$Result = (new MYSQLClass('Profile'))->FetchAllRows('SELECT * FROM posts WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( (new HashingClass())->Hash_POSTS($_SESSION['Email']), '0', '0'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;
}

function MyProfile_Get_Rejected_Posts(){
	$Result = (new MYSQLClass('Profile'))->FetchAllRows('SELECT * FROM posts WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( (new HashingClass())->Hash_POSTS($_SESSION['Email']), '0', '-1'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;
}

function MyProfile_Get_Approved_Posts(){
	$Result = (new MYSQLClass('Profile'))->FetchAllRows('SELECT * FROM posts WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC',
		array( (new HashingClass())->Hash_POSTS($_SESSION['Email']), '0', '1'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;
}

function MyProfile_Get_Post($Post){
	$GLOBALS['Error'] = false;
	User_Get_Post_From_Hashing($Post);
	if ( $GLOBALS['Error'] )
		return ;
	?>
		<div style="border-bottom-width: 1px;border-bottom-color: #454545;border-bottom-style: solid;">
			<div>
				<div style="display: inline-block;margin: 0px;padding: 0px;">
					<a href="">
						<input type="image" src="<?php echo OnlineUser; ?>"
						style="width: 80px;height: 80px;">
					</a>
				</div>

				<div style="display: inline-block;margin: 0px;padding: 0px;font-size: 15px;">
					<p><strong>By : </strong><?php echo $GLOBALS['User_Name']; ?></p>
					<p><strong>Date : </strong><?php echo $GLOBALS['Date']; ?></p>
				</div>
			</div>
			<p style="padding: 0px;margin: 0px;"><strong>Title : </strong>
				<?php echo $GLOBALS['Add_Name']; ?></p>
			<div style="font-size: 15px;">
				<p><?php $GLOBALS['Discreption']; ?></p>
			</div>
			<div style="padding: 0px;">
				<a href="<?php echo Post.$GLOBALS['POST_ID']; ?>">See Full Advertise</a>
			</div>
		</div>
	<?php
}

function User_Get_Post_From_Hashing($Data){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'POST_ID' ],
		['Type' => 'POSTS', 'Data' => $Data['phone'], 'Key' => 'Phone' ],
		['Type' => 'POSTS', 'Data' => $Data['address'], 'Key' => 'Address' ],
		['Type' => 'POSTS', 'Data' => $Data['bigtype'], 'Key' => 'BigType' ],
		['Type' => 'POSTS', 'Data' => $Data['furnished'], 'Key' => 'Furnished' ],
		['Type' => '', 'Data' => $Data['area'], 'Key' => 'Area' ],
		['Type' => '', 'Data' => $Data['rooms'], 'Key' => 'Rooms' ],
		['Type' => '', 'Data' => $Data['pathrooms'], 'Key' => 'PathRooms' ],
		['Type' => 'POSTS', 'Data' => $Data['discreption'], 'Key' => 'Discreption' ],
		['Type' => 'POSTS', 'Data' => $Data['f_pic'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['s_pic'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => '', 'Data' => $Data['post_date'], 'Key' => 'Date', 'Default' => '' ],
		['Type' => 'POSTS', 'Data' => $Data['smalltype'], 'Key' => 'SmallType' ],
		['Type' => 'POSTS', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],
		
		['Type' => 'POSTS', 'Data' => $Data['t_pic'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['fo_pic'], 'Key' => 'Picture4',
			'Default' => Housing ],
		['Type' => '', 'Data' => $Data['money'], 'Key' => 'Money' ],

		['Type' => 'POSTS', 'Data' => $Data['addname'], 'Key' => 'Add_Name' ]

	], 'User_Post_Error');
}

function User_Post_Error(){
	$GLOBALS['Error'] = true;
}