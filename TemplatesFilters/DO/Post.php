<?php

use CoreModels\ModelExcutionEngine;
use SiteEngines\HashingEngine;

function GetStatus($Status){
    
    if ( $Status == '0' )
        return '<h2 style="color: #c6c608">Still Pedding</h2>';
    
    else if ( $Status == '-1' )
        return '<h2 style="color: red">Rejected</h2>';

    return '';
}

function AdminOperations($Status, $User_Status){
    if ( $User_Status == '0' ){
        if ( $Status == '0' )
            return '<div class="information-area mb-80 wow fadeInUp" data-wow-delay="200ms">
                        <h4 class="mb-30">Admin Operations</h4>

                        <!-- Content -->
                        <a class="btn rehomes-btn mt-10" href="<< Approve_Add >>">Approve Add</a>
                        <a class="btn rehomes-btn mt-10" href="<< Reject_Add >>">Reject Add</a>
                    </div>';
        else
            return '<div class="information-area mb-80 wow fadeInUp" data-wow-delay="200ms">
                        <h4 class="mb-30">Admin Operations</h4>

                        <!-- Content -->
                        <a class="btn rehomes-btn mt-10" href="<< Delete_Add >>">Delete Add</a>
                    </div>';
    }
    else
        return '';
}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function GetFirstPicture($Data){
	for ( $i=1; $i <5 ; $i++ )
		if ( $Data['Picture'.$i] != Housing ){
			$GLOBALS['ValidPicture'] = $i;
			return '
				<div class="Pictures">
                    	<img src="'.$Data['Picture'.$i].'"style="vertical-align: top;">
                </div>';
		}

	$GLOBALS['ValidPicture'] = 5;
	return '
		<div class="Pictures">
            	<img src="'.$Data['Picture1'].'"style="vertical-align: top;">
        </div>';
}

function GetAllPictures($Data){
	if ( $GLOBALS['ValidPicture'] == 5 )
		return '';

	$String = '';

	for ( $i = $GLOBALS['ValidPicture']+1; $i <5; $i++ ) { 
		if ( $Data['Picture'.$i] != Housing ){
			$String .= '<div class="Pictures">
                    	<img src="'.$Data['Picture'.$i].'" style="vertical-align: top;">
                </div>';
		}
	}
	return $String;
}

function CheckContactInfo($Contact_Status){
	if ( $Contact_Status != '2' ){
        return '<p>Phone: <span><< Phone >></span></p>';
    }
    return '';
}

function GetStatusColor($Status){
	if ( $Status == 0 )
		return 'background-color: #c6c608;border-color: #c6c608;';
	else if ( $Status == -1 )
		return 'background-color: red;border-color: red;';
	else
		return 'background-color: green;border-color: green;';
}

function GetStatusText($Status){
	if ( $Status == 0 )
		return 'Still Pedding';
	else if ( $Status == -1 )
		return 'Rejected';
	else
		return 'Available';
}

function GetAdminSettings($Status){

	if ( SESSION() && $_SESSION['Status'] == '0' && $Status == '0' )
        return '<script type="text/javascript">
                    function ApprovePost(){
                        location.href = "<< AdminAcceptPost >>";
                    }

                    function RejectPost(){
                        location.href = "<< AdminRejectPost >>";
                    }
                </script>

                <div style="height: 30px;">
                    <input type="button" value="Approve" style="background-color: green;
                            width: 35%;border-color: green;"
                            onclick="ApprovePost()">
                    <input type="button" value="Reject" style="background-color: red;
                            width: 35%;border-color: red;"
                            onclick="RejectPost()">
                </div>';

    else if ( SESSION() && $_SESSION['Status'] == '0' && $Status == '1' )
        return '<script type="text/javascript">
                    function DeletePost(){
                        if ( confirm("Are You Sure Want To Delete This Post ?") == false )
                            return ;

                        location.href = "<< AdminDeletePost >>";
                    }
                </script>

                <div style="height: 30px;">
                    <input type="button" value="Delete Advertise" 
                        style="background-color: red;width: 70%;border-color: red;"
                        onclick="DeletePost()">
                </div>';

    return '';
}

function Check_Email(){
	return ( !SESSION() )? '
	<div class="col-12 col-lg-4">
        <input type="email" name="MessageEmail" id="MessageEmail" class="form-control mb-30" placeholder="Email" oninput="CheckEmailLength()">
    </div>'
	: '';
}

function GetMessage($Contact_Status){

	if ( $Contact_Status != '1' )
		return '
			<!-- Leave A Reply -->
            <div class="rehomes-comment-form mb-80 wow fadeInUp" data-wow-delay="200ms">
                <h4 class="mb-30">Make Message</h4>

                <!-- Form -->
                <div id="MakeMessage">
                    <div class="row">
                    	<< Filter : Check_Email >>
                        <div class="col-12">
                            <textarea name="Message" class="form-control mb-30" placeholder="Messages" id="Message"
                                oninput="CheckMessageLength()"></textarea>
                        </div>

                    <!-- First Message -->
                        <input type="image" src="<< AddPicture >>" width="80"
                            height="80" alt="AddPicture" id="image1" name = "image1"
                            onclick="GetPicture(\'#File1\');" style="display: inline-block;
                            padding:0px !important;margin:0px !important;">
                        
                        <input type="file" id="File1" name="File1"
                        	onchange="Read(this,\'#image1\');">

                    <!-- Second Message -->
                        <input type="image" src="<< AddPicture >>" width="80"
                            height="80" alt="AddPicture" id="image2" name = "image2"
                            onclick="GetPicture(\'#File2\');" style="display: inline-block;
                            padding:0px !important;margin:0px !important;">
                        
                        <input type="file" id="File2" name="File2"
                                onchange="Read(this,\'#image2\');">

                    <!-- Third Message -->
                        <input type="image" src="<< AddPicture >>" width="80"
                            height="80" alt="AddPicture" id="image3" name = "image3"
                            onclick="GetPicture(\'#File3\');" style="display: inline-block;
                            padding:0px !important;margin:0px !important;">
                        
                        <input type="file" id="File3" name="File3"
                                onchange="Read(this,\'#image3\');">

                    <!-- Forth Message -->
                        <input type="image" src="<< AddPicture >>" width="80"
                            height="80" alt="AddPicture" id="image4" name = "image4"
                            onclick="GetPicture(\'#File4\');" style="display: inline-block;
                            padding:0px !important;margin:0px !important;">
                        
                        <input type="file" id="File4" name="File4"
                                onchange="Read(this,\'#image4\');">

                    <!-- Fifth Message -->
                        <input type="image" src="<< AddPicture >>" width="80"
                            height="80" alt="AddPicture" id="image5" name = "image5"
                            onclick="GetPicture(\'#File5\');" style="display: inline-block;
                            padding:0px !important;margin:0px !important;">
                        
                        <input type="file" id=\'File5\' name=\'File5\'
                                onchange="Read(this,\'#image5\');">

                    	<div class="col-12">
                            <button type="submit" class="btn rehomes-btn mt-15" id="SendMessage">Send Message</button>
                        </div>
                    </div>
                </div>
            </div>';
    return '';
}

///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////

function GetUserPosts($Email, $User_Profile, $User_Picture, $User_Name){

	$Result = (new ModelExcutionEngine())->FetchAllRows(
		'SELECT * FROM posts WHERE user_email = ? AND deleted = ? AND status = ? ORDER BY id DESC LIMIT 3',
	array(
		(new HashingEngine())->Hash_POSTS($Email),
		'0',
		'1'
	));

	if ( $Result->Result != 1 )
		$GLOBALS['User_Posts'] = [];
	else
		$GLOBALS['User_Posts'] = $Result->Data;

	$String = '';
	$GLOBALS['User_Profile'] = $User_Profile;
	$GLOBALS['User_Picture'] = $User_Picture;
	$GLOBALS['User_Name'] = $User_Name;

	foreach ($GLOBALS['User_Posts'] as $Value)
		$String .= Show_User_Post($Value);

	return $String;
}

function Show_User_Post($Post){

	$GLOBALS['Error'] = False;
	Post_Get_User_Post_From_Hashing($Post);
	if ( $GLOBALS['Error'] )
		return '';

	return '<!-- Single Recent Post -->
            <div class="single-recent-post d-flex align-items-center">
                
                <!-- Thumb -->
                <div class="properties-post-thumb">
                    <a href="'.Post.$GLOBALS['POST_ID'].'">
                    	<img src="'.Post_GetPicture().'" alt=""></a>
                </div>

                <!-- Post Content -->
                <div class="post-content">
                    <a href="'.Post.$GLOBALS['POST_ID'].'" class="post-title">'
                    	.$GLOBALS['Add_Name'].'</a>
                    <p class="properties--location"><i class="fa fa-map-marker" aria-hidden="true"></i> '.$GLOBALS['Address'].'</p>
                    <p class="properties--rent">'.$GLOBALS['BigType'].': <span>$ '
                    		.$GLOBALS['Money'].'</span></p>
                </div>

            </div>';
}

function Post_Get_User_Post_From_Hashing($Data){
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'POST_ID' ],
		
		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Status' ],

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

	], 'Post_Status_Error');
}

function Post_Status_Error(){
	$GLOBALS['Error'] = True;
}

function Post_GetPicture(){

	for ($i=1; $i < 5; $i++)
		if ( $GLOBALS['Picture'.$i] != Housing )
			return $GLOBALS['Picture'.$i];

	return Housing;
}