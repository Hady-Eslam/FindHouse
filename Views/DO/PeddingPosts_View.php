<?php

function PeddingPosts_Begin(){

	$Result = (new MYSQLClass('DO'))->FetchAllRows(
		'SELECT * FROM posts WHERE status = ? AND deleted = ? LIMIT 0, 20',
		array(
			'0',
			'0'
		));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		$GLOBALS['Result'] = [];
	else
		$GLOBALS['Result'] = $Result->Data;

	include_once PeddingPosts_Template;
}

function PeddingPosts_Get_Pedding_Post($Post){
	$GLOBALS['Error'] = false;
	PeddingPosts_Get_Post_From_Hashing($Post);
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

				<div style="display: inline-block;margin: 0px;padding: 0px;">
					<p><strong>By : </strong>Hady Eslam</p>
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

function PeddingPosts_Get_Post_From_Hashing($Data){
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

	], 'PeddingPosts_Post_Error');
}

function PeddingPosts_Post_Error(){
	$GLOBALS['Error'] = true;
}