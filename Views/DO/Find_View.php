<?php

function Find_Begin(){
	Search();
	include_once Find_Template;
}

function Search(){
	Make_Search_Query();
	$Result = (new MYSQLClass('DO'))->FetchAllRows('SELECT * FROM posts WHERE area >= ? AND area <= ? AND rooms >= ? AND rooms <= ? AND pathrooms >= ? AND pathrooms <= ? AND money >= ? AND money <= ? AND deleted = ? '.$GLOBALS['Status'] .$GLOBALS['Type']
		.$GLOBALS['Furnished'].' LIMIT '.($GLOBALS['The Page'] * 12)
		.' , '.( ($GLOBALS['The Page'] * 12 ) + 12 ),
			array(
				$GLOBALS['MinA'],
				$GLOBALS['MaxA'],
				$GLOBALS['MinR'],
				$GLOBALS['MaxR'],
				$GLOBALS['MinPR'],
				$GLOBALS['MaxPR'],
				$GLOBALS['MinM'],
				$GLOBALS['MaxM'],
				'0'
			));
	if ( $Result->Result == -1 )
		StatusPages_Error_Page();
	else if ( $Result->Result == 1 )
		$GLOBALS['Query_Result'] = $Result->Data;
	else
		$GLOBALS['Query_Result'] = [];
}

function Make_Search_Query(){
	$Hashing = new HashingClass();
	(new FILTERSClass())->FILTER_GET([
		'MinA' =>[ 'Type' => 'INT', 'Len' => Area_Len, 'Min' => 0, 'Max' => 10000,
			'Default' => 0 ],
		'MaxA' =>[ 'Type' => 'INT', 'Len' => Area_Len, 'Min' => 0, 'Max' => 10000,
			'Default' => 10000 ],
		'MinR' =>[ 'Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9,
			'Default' => 0 ],
		'MaxR' =>[ 'Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9,
			'Default' => 9 ],
		'MinPR' =>[ 'Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9,
			'Default' => 0 ],
		'MaxPR' =>[ 'Type' => 'INT', 'Len' => Rooms_Len, 'Min' => 0, 'Max' => 9,
			'Default' => 9 ],
		'MinM' =>[ 'Type' => 'INT', 'Len' => Money_Len, 'Min' => 0, 'Max' => 10000000000,
			'Default' => 0 ],
		'MaxM' =>[ 'Type' => 'INT', 'Len' => Money_Len, 'Min' => 0, 'Max' => 10000000000,
			'Default' => 10000000000 ],
		'Page' =>[ 'Type' => 'INT', 'Len' => 4, 'Min' => 0, 'Max' => 1000,
			'Default' => 0 ]
	], '', 0);
	$Page = $GLOBALS['Page'];
	if ( $Page > 0 )
		$Page = $Page - 1;
	$GLOBALS['The Page'] = $Page;
					/* 		Status Div 		*/
	// Filter For Status
	if ( isset($_GET['StatusBuy']) )
	    $GLOBALS['StatusBuy'] = '( bigtype = "'.$Hashing->Hash_POSTS('Buy').'" ';
	else
		$GLOBALS['StatusBuy'] = '( ';

	// Filter For Status
	if ( isset($_GET['StatusRent']) )
		if ( $GLOBALS['StatusBuy'] == '( ' )
			$GLOBALS['StatusRent'] = 'bigtype = "'.$Hashing->Hash_POSTS('Rent').'" )';
		else
	    	$GLOBALS['StatusRent'] = 'OR bigtype = "'.$Hashing->Hash_POSTS('Rent').'" )';
	else
		$GLOBALS['StatusRent'] = ')';

	if ( $GLOBALS['StatusBuy'].$GLOBALS['StatusRent'] == '( )')
		$GLOBALS['Status'] = '';
	else
		$GLOBALS['Status'] = ' AND '.$GLOBALS['StatusBuy'].$GLOBALS['StatusRent'];

					/* 		Type Div 		*/
	// Filter For Type
	if ( isset($_GET['TypeStudents']) )
	    $GLOBALS['TypeStudents'] = '( smalltype = "'.$Hashing->Hash_POSTS('Flat For Students')
										.'" ';
	else
		$GLOBALS['TypeStudents'] = '( ';

	// Filter For Type
	if ( isset($_GET['TypeFamilies']) )
		if ( $GLOBALS['TypeStudents'] == '( ' )
			$GLOBALS['TypeFamilies'] = 'smalltype = "'.$Hashing->Hash_POSTS('Flat For Families')
									.'" ';
		else
	    	$GLOBALS['TypeFamilies'] = 'OR smalltype = "'.
	    				$Hashing->Hash_POSTS('Flat For Families').'" ';
	else
		$GLOBALS['TypeFamilies'] = '';

	// Filter For Type
	if ( isset($_GET['TypeOffices']) )
		if ( $GLOBALS['TypeFamilies'] == '' )
			$GLOBALS['TypeOffices'] = 'smalltype = "'.$Hashing->Hash_POSTS('Flat For Officess').'" )';
		else
	    	$GLOBALS['TypeOffices'] = 'OR smalltype = "'
	    			.$Hashing->Hash_POSTS('Flat For Officess').'" )';
	else
		$GLOBALS['TypeOffices'] = ')';


	if ( $GLOBALS['TypeStudents'].$GLOBALS['TypeFamilies']
			.$GLOBALS['TypeOffices'] == '( )')
		$GLOBALS['Type'] = '';
	else
		$GLOBALS['Type'] = ' AND '.$GLOBALS['TypeStudents'].$GLOBALS['TypeFamilies']
							.$GLOBALS['TypeOffices'];

					/* 		Furnished Div 		*/
	// Filter For Furnished
	if ( isset($_GET['FurnishedYes']) )
	    $GLOBALS['FurnishedYes'] = '( furnished = "'.$Hashing->Hash_POSTS('Yes').'" ';
	else
		$GLOBALS['FurnishedYes'] = '( ';

	// Filter For Furnished
	if ( isset($_GET['FurnishedNo']) )
		if ( $GLOBALS['FurnishedYes'] == '( ' )
			$GLOBALS['FurnishedNo'] = 'furnished = "'.$Hashing->Hash_POSTS('No').'" )';
		else
	    	$GLOBALS['FurnishedNo'] = 'OR furnished = "'.$Hashing->Hash_POSTS('No').'" )';
	else
		$GLOBALS['FurnishedNo'] = ')';

	if ( $GLOBALS['FurnishedYes'].$GLOBALS['FurnishedNo'] == '( )' )
		$GLOBALS['Furnished'] = '';
	else
		$GLOBALS['Furnished'] = ' AND '.$GLOBALS['FurnishedYes'].$GLOBALS['FurnishedNo'];
}

function Find_Get_Post($Data, $Count){
    $Hashing = new HashingClass();
	$Result = $Hashing->Get_Hashed_POSTS($Data['user_email']);
	if ( $Result->Result != 1 )
		return $Count;

	if ( ($Result = (new MYSQLClass('DO'))
			->isFound('SELECT * FROM users WHERE email = ? AND activate = ?',
				array(
					$Hashing->Hash_Users($Result->Data),
					'1'
				)))->Result == -1 || $Result->Result == 0 )
		return $Count;

	$Link = Post.$Data['id'];

	$Picture = $Hashing->Get_Hashed_POSTS($Data['f_pic']);
	if ( $Picture->Result != 1 || $Picture->Data == Housing ){

		$Picture = $Hashing->Get_Hashed_POSTS($Data['s_pic']);
		if ( $Picture->Result != 1 )
			$Picture = Housing;
		else
			$Picture = $Picture->Data;
	}
	else
		$Picture = $Picture->Data;

	$Money = $Data['money'];
	$Address = $Hashing->Get_Hashed_POSTS($Data['address']);
	if ( $Address->Result != 1 )
		return $Count;
	else
		$Address = $Address->Data;
	?>
	<a href="<?php echo $Link; ?>">
		<div>
			<input type="image" width="200" height="200" src="<?php echo $Picture; ?>">
			<p><strong>$ <?php echo $Money; ?></strong></p>
			<p><strong>in : <?php echo $Address; ?></strong></p>
		</div>
	</a>
	<?php
	return ($Count + 1);
}

function Find_Get_Pages_URLS_Navigation($Count){
	if ( $GLOBALS['The Page'] == 0 ){
	?>
		<span>1</span>
		<a href="<?php echo Find_Get_Navigation_Link(2); ?>">2</a>
		<span>...</span>
	<?php
	}
	else if ( $Count < 12 ){
	?>
		<a href="<?php echo Find_Get_Navigation_Link(1); ?>">1</a>
		<span>...</span>
		<a href="<?php echo Find_Get_Navigation_Link($GLOBALS['The Page']); ?>">
			<?php echo ($GLOBALS['The Page']); ?>
		</a>
		<a href="<?php echo Find_Get_Navigation_Link($GLOBALS['The Page']+1); ?>">
			<?php echo ($GLOBALS['The Page']+1); ?>
		</a>
	<?php
	}
	else{
	?>
		<a href="<?php echo Find_Get_Navigation_Link(1); ?>">1</a>
		<span>...</span>
		<a href="<?php echo Find_Get_Navigation_Link($GLOBALS['The Page']); ?>">
			<?php echo ($GLOBALS['The Page']);?>
		</a>
		<span><?php echo ($GLOBALS['The Page']+1); ?></span>
		<a href="<?php echo Find_Get_Navigation_Link($GLOBALS['The Page']+2); ?>">
			<?php echo ($GLOBALS['The Page']+2); ?>
		</a>
		<span>...</span>
	<?php
	}
}

function Find_Get_Navigation_Link($Number){
	$Link = Find.'?Page='.$Number;
	
	// Status
	if ( isset($_GET['StatusRent']) )
		$Link .= '&StatusRent=on';

	if ( isset($_GET['StatusBuy']) )
		$Link .= '&StatusBuy=on';
	
	// Type
	if ( isset($_GET['TypeStudents']) )
		$Link .= '&TypeStudents=on';
	
	if ( isset($_GET['TypeFamilies']) )
		$Link .= '&TypeFamilies=on';
	
	if ( isset($_GET['TypeOffices']) )
		$Link .= '&TypeOffices=on';
	
	// Furnished
	if ( isset($_GET['FurnishedYes']) )
		$Link .= '&FurnishedYes=on';
	
	if ( isset($_GET['FurnishedNo']) )
		$Link .= '&FurnishedNo=on';

	// Area
	if ( isset($_GET['MinA']) )
		$Link .= '&MinA='.$GLOBALS['MinA'];
	
	if ( isset($_GET['MaxA']) )
		$Link .= '&MaxA='.$GLOBALS['MaxA'];

	// Rooms
	if ( isset($_GET['MinR']) )
		$Link .= '&MinR='.$GLOBALS['MinR'];
	
	if ( isset($_GET['MaxR']) )
		$Link .= '&MaxR='.$GLOBALS['MaxR'];
	
	// PathRooms
	if ( isset($_GET['MinPR']) )
		$Link .= '&MinPR='.$GLOBALS['MinPR'];

	if ( isset($_GET['MaxPR']) )
		$Link .= '&MaxPR='.$GLOBALS['MaxPR'];

	// Storey
	if ( isset($_GET['MinStorey']) )
		$Link .= '&MinStorey='.$GLOBALS['MinStorey'];

	if ( isset($_GET['MaxStorey']) )
		$Link .= '&MaxStorey='.$GLOBALS['MaxStorey'];

	// Money
	if ( isset($_GET['MinM']) )
		$Link .= '&MinM='.$GLOBALS['MinM'];

	if ( isset($_GET['MaxM']) )
		$Link .= '&MaxM='.$GLOBALS['MaxM'];

	return $Link;
}