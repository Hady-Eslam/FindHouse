<?php set_error_handler("Error_Handeler");

function interested_Begin(){
	$GLOBALS['UserisSet'] = (SESSION())?true:false;
	if ( (new URLClass())->Request() == "POST" )
		interested_POST();
	interested_GET();
}

function interested_POST(){
	$URL = new URLClass();
	if ( $URL->REFFERE_is_SET() ){
		if ( !$URL->CheckREFFERE(interested) )
			interested_GET();
		interested_CheckData();
		interested_SaveData();
	}
	interested_GET();
}

function interested_GET($Result = ''){
	$GLOBALS['Result'] = $Result;
	include_once interested_Template;
}

function interested_CheckData(){
	$FILTER = new FILTERSClass();
	$FILTER->FILTER_POST([
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
		'MinStorey' =>[ 'Type' => 'INT', 'Len' => Storey_Len, 'Min' => 0, 'Max' => 20,
			'Default' => 0 ],
		'MaxStorey' =>[ 'Type' => 'INT', 'Len' => Storey_Len, 'Min' => 0, 'Max' => 20,
			'Default' => 20 ],
		'MinM' =>[ 'Type' => 'INT', 'Len' => Money_Len, 'Min' => 0, 'Max' => 10000000000,
			'Default' => 0 ],
		'MaxM' =>[ 'Type' => 'INT', 'Len' => Money_Len, 'Min' => 0, 'Max' => 10000000000,
			'Default' => 10000000000 ],
		'Months' => [ 'Type' => 'INT', 'Len' => 2, 'Min' => 0, 'Max' => 12,
			'Default' => 0 ],
		'Days' => [ 'Type' => 'INT', 'Len' => 2, 'Min' => 0, 'Max' => 30,
			'Default' => 0 ]
	]);
	if ( $GLOBALS['Days'] == 0 && $GLOBALS['Months'] == 0 )
		interested_GET('MonthsNotSet');

	$GLOBALS['Rent'] = (isset($_POST['Rent']))? 'Rent' : '';
	$GLOBALS['Buy'] = (isset($_POST['Buy']))? 'Buy' : '';
	if ( $GLOBALS['Rent'] != '' && $GLOBALS['Buy'] != '' ){
		$GLOBALS['Rent'] = '';
		$GLOBALS['Buy'] = '';
	}

	$GLOBALS['Students'] = (isset($_POST['Students']))? 'Students' : '';
	$GLOBALS['Families'] = (isset($_POST['Families']))? 'Families' : '';
	$GLOBALS['Offices'] = (isset($_POST['Offices']))? 'Offices' : '';
	if ( $GLOBALS['Students'] != '' && $GLOBALS['Families'] != '' &&
		 $GLOBALS['Offices'] != ''){

		$GLOBALS['Students'] = '';
		$GLOBALS['Families'] = '';
		$GLOBALS['Offices'] = '';
	}
	
	$GLOBALS['Yes'] = (isset($_POST['Yes']))? 'Yes' : '';
	$GLOBALS['No'] = (isset($_POST['No']))? 'No' : '';
	if ( $GLOBALS['Yes'] != '' && $GLOBALS['No'] != '' ){
		$GLOBALS['Yes'] = '';
		$GLOBALS['No'] = '';
	}

	if ( !SESSION() )
		$FILTER->FILTER_POST([
			'E' => ['Type' => 'EMAIL', 'Error_Function' => 'interested_GET',
				'Error_Function_Para' => 'EmailNotRightOrNotSet' ]
		]);
	else
		$GLOBALS['E'] = $_SESSION['Email'];
}

function interested_SaveData(){
    $Hashing = new HashingClass();
	if ( (new MYSQLClass('DO'))
			->excute('INSERT INTO interested (deleted, status, type,'
			.' furnished, area, rooms, pathrooms, money, storey, email, user_status,'
			.' search_days, search_months, interested_date) VALUES(?, ?, ?, ?, ?, ?, '
			.'?, ?, ?, ?, ?, ?, ?, ?)',
				array(
					'0',
					$GLOBALS['Rent'].$GLOBALS['Buy'],
					$GLOBALS['Students'].$GLOBALS['Families'].$GLOBALS['Offices'],
					$GLOBALS['Yes'].$GLOBALS['No'],
					$GLOBALS['MinA'].'|'.$GLOBALS['MaxA'],
					$GLOBALS['MinR'].'|'.$GLOBALS['MaxR'],
					$GLOBALS['MinPR'].'|'.$GLOBALS['MaxPR'],
					$GLOBALS['MinStorey'].'|'.$GLOBALS['MaxStorey'],
					$GLOBALS['MinM'].'|'.$GLOBALS['MaxM'],
					$Hashing->Hash_interested($GLOBALS['E']),
					$GLOBALS['UserisSet'],
					$GLOBALS['Days'],
					$GLOBALS['Months'],
					date('D d-m-Y H:i:s')
				))->Result == -1 )
		StatusPages_Error_Page();
	Redirect(interested.'?Saved');
}

function interested_Get_Button(){
	?>
	<div id="Link">
        <input type="button" id="Showinterested" value="Make interested">
    </div>
	<?php
}
?>