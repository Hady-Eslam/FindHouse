<?php
function Post_Begin($Post_id){
	Post_SetVariables($Post_id);
	Post_Check_Post();
	include_once Post_Template;
}

function Post_SetVariables($Post_id){
	$GLOBALS['isUser'] = ( SESSION() )? 1: 0;
	$GLOBALS['Post_id'] = $Post_id;
	$GLOBALS['User_Link'] = ( SESSION() ) ? User.$_SESSION['ID'] : '';
	$GLOBALS['User_image'] = ( SESSION() ) ? $_SESSION['Picture'] : OfflineUsers;
	$GLOBALS['User_Name'] = ( SESSION() ) ? $_SESSION['Name'] : '';
}

function Post_Check_Post(){
	$MySql = new MYSQLClass('DO');
	$Hashing = new HashingClass();

	$Result = $MySql->FetchOneRow('SELECT * FROM posts WHERE id = ? AND deleted = ?',
			array( $GLOBALS['Post_id'] , '0'));

	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		StatusPages_Not_Found_Page();

	$Data = $Result->Data;
	$Hashing->Get_Data_From_Hashing([
		[ 'Type' => 'POSTS', 'Data' => $Data['user_email'], 'Key' => 'Email' ]
	], 'StatusPages_Error_Page');

	if ( ($Result = (new MYSQLClass('DO'))
			->FetchOneRow('SELECT * FROM users WHERE email = ? AND activate = ?',
				array( $Hashing->Hash_Users($GLOBALS['Email']), '1' )))->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 0 )
		StatusPages_Not_Found_Page();
	else{
		$Data['Phone'] = $Result->Data['phone'];
		$GLOBALS['User_Profile'] = User.$Result->Data['id'];
		Post_Get_Post_Data_From_Hashing($Data);
	}
}

function Post_Get_Post_Data_From_Hashing($Data){
	(new HashingClass())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'POST_ID' ],
		['Type' => 'User', 'Data' => $Data['Phone'], 'Key' => 'Phone' ],

		['Type' => 'POSTS', 'Data' => $Data['address'], 'Key' => 'Address' ],
		['Type' => 'POSTS', 'Data' => $Data['bigtype'], 'Key' => 'BigType' ],
		['Type' => 'POSTS', 'Data' => $Data['furnished'], 'Key' => 'Furnished' ],
		['Type' => '', 'Data' => $Data['area'], 'Key' => 'Area' ],
		['Type' => '', 'Data' => $Data['rooms'], 'Key' => 'Rooms' ],
		['Type' => '', 'Data' => $Data['pathrooms'], 'Key' => 'PathRooms' ],
		['Type' => 'POSTS', 'Data' => $Data['discreption'], 'Key' => 'Discreption' ],
		['Type' => 'POSTS', 'Data' => $Data['f_pic'], 'Key' => 'First_Picture',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['s_pic'], 'Key' => 'Second_Picture',
			'Default' => Housing ],
		['Type' => '', 'Data' => $Data['post_date'], 'Key' => 'Date', 'Default' => '' ],
		['Type' => 'POSTS', 'Data' => $Data['smalltype'], 'Key' => 'SmallType' ],
		['Type' => 'POSTS', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],
		
		['Type' => 'POSTS', 'Data' => $Data['t_pic'], 'Key' => 'Third_Picture',
			'Default' => Housing ],
		['Type' => 'POSTS', 'Data' => $Data['fo_pic'], 'Key' => 'Fourth_Picture',
			'Default' => Housing ],
		['Type' => '', 'Data' => $Data['money'], 'Key' => 'Money' ],

		['Type' => 'POSTS', 'Data' => $Data['addname'], 'Key' => 'Add_Name' ]

	], 'StatusPages_Error_Page');
}

function Post_Get_Comments(){
	$MySql = new MYSQLClass('DO');
	$Result = $MySql->FetchAllRows('SELECT * FROM comments WHERE post_id = ?',
		array( $GLOBALS['Post_id'] ));

	if ( $Result->Result != 1 ){
		$GLOBALS['Query_Comments_Result'] = [];
		$GLOBALS['Comments_Count'] = 0;
	}
	else
		Post_Get_Comments_From_Hashing($Result->Data);
}

function Post_Get_Comments_From_Hashing($Data){
	$Hashing = new HashingClass();
	$GLOBALS['Query_Comments_Result'] = [];
	$GLOBALS['Comments_Count'] = 0;

	foreach ($Data as $Row) {
		$Hashing->Get_Data_From_Hashing([
			['Type' => 'Comments', 'Data' => $Row['user_email'], 'Key' => 'User_Email',
				'Default' => '' ],
			['Type' => 'Comments', 'Data' => $Row['comment'], 'Key' => 'Comment',
				'Default' => ''],
			['Type' => '', 'Data' => $Row['comment_date'], 'Key' => 'Comment_Date',
				'Default' => '' ]
		]);

		if ( $GLOBALS['User_Email'] == '' || $GLOBALS['Comment'] == '' )
			continue;

		$Result = NULL;
		$GLOBALS['Comments_Count']++;
		$Result['User_Email'] = $GLOBALS['User_Email'];
		$Result['Comment'] = $GLOBALS['Comment'];
		$Result['Comment_Date'] = $GLOBALS['Comment_Date'];

		$GLOBALS['Query_Comments_Result'][] = $Result;
	}
}

function Post_Get_Likes_DisLikes(){
	$MySql = new MYSQLClass('DO');

	// Get Likes
	$Result = $MySql->GetRowCount(
		'SELECT COUNT(*) FROM like_dislike_post WHERE post_id = '.$GLOBALS['Post_id']
			.' AND status = 1');
	if ( $Result->Result == -1 )
		$GLOBALS['Post_Likes'] = 0;
	else
		$GLOBALS['Post_Likes'] = $Result->Data;

	// Get DisLikes
	$Result = $MySql->GetRowCount(
		'SELECT COUNT(*) FROM like_dislike_post WHERE post_id = '.$GLOBALS['Post_id']
			.' AND status = 2');
	if ( $Result->Result != -1 )
		$GLOBALS['Post_DisLikes'] = 0;
	else
		$GLOBALS['Post_DisLikes'] = $Result->Data;
}

function Post_Get_User_Link(){
	?>
	<a href="<?php echo $GLOBALS['User_Link']; ?>">
        <input type="image" src="<?php echo $GLOBALS['User_image']; ?>">
    </a>
	<?php
}

function Post_Set_Comments($Data){
	$Hashing = new HashingClass();

	$Result = (new MYSQLClass('DO'))->FetchOneRow(
			'SELECT * FROM users WHERE email = ? AND activate = ? AND deleted = ?',
			array( $Hashing->Hash_Users($Data['User_Email']), '1', '0' ));
	if ( $Result->Result != 1 )
		return ;

	$Hashing->Get_Data_From_Hashing([
		['Type' => 'User', 'Key' => 'Comment_User_Name',
			'Data' => $Result->Data['name'], 'Default' => '' ],
		['Type' => 'User', 'Key' => 'Comment_User_Picture',
			'Data' => $Result->Data['picture'], 'Default' => OnlineUser ]]);
	if ( $GLOBALS['Comment_User_Name'] == '' )
		return ;
	?>
    <div class="Comments">  
        <div>
            <a href="<?php echo $Result->Data['id']; ?>">
                <input type="image"
                	src="<?php echo $GLOBALS['Comment_User_Picture'];?>">
            </a>
            <div>
                <p>By : <?php echo $GLOBALS['Comment_User_Name']; ?></p>
                <p>Date : <?php echo $Data['Comment_Date']; ?></p>
            </div>
        </div>

        <div class="Comment_Text">
            <p><?php echo $Data['Comment']; ?></p>
        </div>
    </div>
	<?php
}

function Post_Check_Email(){
	echo ( !SESSION() )? '
	<input type="text" name="MessageEmail" id="MessageEmail" placeholder="Your Email" style="display: block;margin: 10px;" oninput="CheckinputLen(this.id, Email_Len);">'
	: '';
}
?>