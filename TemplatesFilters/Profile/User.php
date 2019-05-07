<?php

use SiteEngines\HashingEngine;

function GetAdminControl($User_Status){
	if ( $User_Status == '0' )
		return '<div class="information-area mb-80 wow fadeInUp" data-wow-delay="200ms"
			        style="padding-left: 10%">
			        <!--<h4 class="mb-30">Admin Operations</h4>-->

			        <!-- Content -->
			        <a class="btn rehomes-btn mt-10" href="<< DeleteAccount >>">Delete Account</a>
			    </div>';

    return '';
}

function GetUserPosts(){
	$String = '';
    foreach ( $GLOBALS['Result'] as $Value)
        $String .= MyProfile_Get_Post($Value);

    if ( $String == '' )
        return '<p>No Posts Found</p>';
    return $String;
}

function MyProfile_Get_Post($Post){
	
	$GLOBALS['Error'] = False;
	
	if ( isset($Post['security']) )
		User_Get_Post_Home_From_Hashing($Post);
	else if ( isset($Post['free'])  )
		User_Get_Post_Mobile_From_Hashing($Post);
	else if ( isset($Post['model'])  )
		User_Get_Post_Car_From_Hashing($Post);
	else if ( isset($Post['elc_status'])  )
		User_Get_Post_Elc_From_Hashing($Post);
	else if ( isset($Post['lux_status'])  )
		User_Get_Post_Lux_From_Hashing($Post);
	else if ( isset($Post['fashion_status'])  )
		User_Get_Post_Fashion_From_Hashing($Post);
	else if ( isset($Post['doc_status'])  )
		User_Get_Post_Doc_From_Hashing($Post);
	else if ( isset($Post['ant_status'])  )
		User_Get_Post_Ant_From_Hashing($Post);
	else if ( isset($Post['product_name'])  )
		User_Get_Post_Eat_From_Hashing($Post);


	if ( $GLOBALS['Error'] )
		return '';

	if ( isset($Post['security']) )
		return Homes_Category();
	else if ( isset($Post['free']) )
		return Mobiles_Category();
	else if ( isset($Post['model']) )
		return Cars_Category();
	else if ( isset($Post['elc_status']) )
		return Elc_Category();
	else if ( isset($Post['lux_status']) )
		return Lux_Category();
	else if ( isset($Post['fashion_status']) )
		return Fashion_Category();
	else if ( isset($Post['doc_status']) )
		return Doc_Category();
	else if ( isset($Post['ant_status']) )
		return Ant_Category();
	else if ( isset($Post['product_name']) )
		return Eat_Category();
}

function User_Get_Post_Home_From_Hashing($Data){

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],
		['Type' => 'HOMES', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		['Type' => 'HOMES', 'Data' => $Data['garage'], 'Key' => 'Add_Garage' ],
		['Type' => 'HOMES', 'Data' => $Data['security'], 'Key' => 'Add_Security' ],
		['Type' => 'HOMES', 'Data' => $Data['garden'], 'Key' => 'Add_Garden' ],
		['Type' => '', 'Data' => $Data['rooms'], 'Key' => 'Add_Rooms' ],
		['Type' => '', 'Data' => $Data['pathrooms'], 'Key' => 'Add_PathRooms' ],
		['Type' => 'HOMES', 'Data' => $Data['furnished'], 'Key' => 'Add_Furnished' ],
		['Type' => '', 'Data' => $Data['storey'], 'Key' => 'Add_Storey' ],
		['Type' => 'HOMES', 'Data' => $Data['finishing'], 'Key' => 'Add_Finishing' ],
		['Type' => '', 'Data' => $Data['area'], 'Key' => 'Add_Area' ],
		['Type' => 'HOMES', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'HOMES', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'HOMES', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'HOMES', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'HOMES', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'HOMES', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'HOMES', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'HOMES', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Mobile_From_Hashing($Data){

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'MOBILES', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'MOBILES', 'Data' => $Data['can_change'], 'Key' => 'Add_Can_Change' ],

		['Type' => 'MOBILES', 'Data' => $Data['installment'], 'Key' => 'Add_Installment' ],

		['Type' => 'MOBILES', 'Data' => $Data['free'], 'Key' => 'Add_Free' ],

		['Type' => 'MOBILES', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'MOBILES', 'Data' => $Data['mobile_status'], 'Key' => 'Add_MobileStatus' ],

		['Type' => 'MOBILES', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'MOBILES', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'MOBILES', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'MOBILES', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'MOBILES', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'MOBILES', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Car_From_Hashing($Data){

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'CARS', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'CARS', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],
		['Type' => '', 'Data' => $Data['year'], 'Key' => 'Add_Year' ],
		['Type' => 'CARS', 'Data' => $Data['model'], 'Key' => 'Add_Model' ],
		['Type' => 'CARS', 'Data' => $Data['engine'], 'Key' => 'Add_Engine' ],
		['Type' => 'CARS', 'Data' => $Data['motion_vector'], 'Key' => 'Add_MotionVector' ],

		['Type' => 'CARS', 'Data' => $Data['car_status'], 'Key' => 'Add_CarStatus' ],

		['Type' => 'CARS', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'CARS', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'CARS', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'CARS', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'CARS', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'CARS', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'CARS', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'CARS', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Elc_From_Hashing($Data){

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'ELC', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'ELC', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],
		['Type' => 'ELC', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'ELC', 'Data' => $Data['elc_status'], 'Key' => 'Add_ElcStatus' ],
		['Type' => 'ELC', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'ELC', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'ELC', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'ELC', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'ELC', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Lux_From_Hashing($Data){
	
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'ELC', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'ELC', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],
		['Type' => 'ELC', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'ELC', 'Data' => $Data['lux_status'], 'Key' => 'Add_LuxStatus' ],
		['Type' => 'ELC', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'ELC', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'ELC', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'ELC', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'ELC', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Fashion_From_Hashing($Data){

	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'ELC', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'ELC', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],
		['Type' => 'ELC', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'ELC', 'Data' => $Data['fashion_status'], 'Key' => 'Add_FashionStatus' ],
		['Type' => 'ELC', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'ELC', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'ELC', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'ELC', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'ELC', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Eat_From_Hashing($Data){
	
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'EAT', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'EAT', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],

		['Type' => 'EAT', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'EAT', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'EAT', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'EAT', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'EAT', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'EAT', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'EAT', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'EAT', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Doc_From_Hashing($Data){
	
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'ELC', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'ELC', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],
		['Type' => 'ELC', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'ELC', 'Data' => $Data['doc_status'], 'Key' => 'Add_DocStatus' ],
		['Type' => 'ELC', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'ELC', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'ELC', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'ELC', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'ELC', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}

function User_Get_Post_Ant_From_Hashing($Data){
	
	(new HashingEngine())->Get_Data_From_Hashing([
		['Type' => '', 'Data' => $Data['id'], 'Key' => 'ADD_ID' ],

		['Type' => 'ELC', 'Data' => $Data['name'], 'Key' => 'Add_Name' ],
		['Type' => '', 'Data' => $Data['price'], 'Key' => 'Add_Price' ],
		
		['Type' => 'ELC', 'Data' => $Data['product_name'], 'Key' => 'Add_Product_Name' ],
		['Type' => 'ELC', 'Data' => $Data['type'], 'Key' => 'Add_Type' ],

		['Type' => 'ELC', 'Data' => $Data['ant_status'], 'Key' => 'Add_AntStatus' ],
		['Type' => 'ELC', 'Data' => $Data['descreption'], 'Key' => 'Add_Descreption' ],

		['Type' => 'ELC', 'Data' => $Data['pic1'], 'Key' => 'Picture1',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic2'], 'Key' => 'Picture2',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic3'], 'Key' => 'Picture3',
			'Default' => Housing ],
		['Type' => 'ELC', 'Data' => $Data['pic4'], 'Key' => 'Picture4',
			'Default' => Housing ],

		['Type' => '', 'Data' => $Data['contact_status'], 'Key' => 'Add_ContactStatus' ],

		['Type' => 'ELC', 'Data' => $Data['user_phone'], 'Key' => 'User_Phone' ],
		['Type' => 'ELC', 'Data' => $Data['user_city'], 'Key' => 'User_City' ],
		['Type' => 'ELC', 'Data' => $Data['user_name'], 'Key' => 'User_Name' ],

		['Type' => '', 'Data' => $Data['status'], 'Key' => 'Add_Status' ],

		['Type' => '', 'Data' => $Data['add_date'], 'Key' => 'Add_Date' ]

	], 'User_Post_Error');
}


/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////


function Homes_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Home Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Homes/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Sqft: <span>'.$GLOBALS['Add_Area'].' m2</span></p>
                        <p>Rooms: <span>'.$GLOBALS['Add_Rooms'].'</span></p>
                        <p>PathRooms: <span>'.$GLOBALS['Add_PathRooms'].'</span></p>
                        <p>Furnished: <span>'.$GLOBALS['Add_Furnished'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Mobiles_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Mobile Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Mobiles/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Status: <span>'.$GLOBALS['Add_MobileStatus'].' m2</span></p>
                        <p>Can Installment: <span>'.( ( $GLOBALS['Add_Installment'] == '0' ) ? 'No' : 'Yes' ).'</span></p>
                        <p>Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>is Free: <span>'.( ( $GLOBALS['Add_Free'] == '0' ) ? 'No' : 'Yes' )
                        		.'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Cars_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Car Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Cars/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        
                        <p>Car Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Car Model: <span>'.$GLOBALS['Add_Model'].'</span></p>
                        <p>Car Year: <span>'.$GLOBALS['Add_Year'].'</span></p>

                        <p>Status: <span>'.$GLOBALS['Add_CarStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Elc_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Elecrical Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Elc/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Electrical Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                        <p>Electrical Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Status: <span>'.$GLOBALS['Add_ElcStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Lux_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Accessory Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Lux/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Accessory Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                        <p>Accessory Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Status: <span>'.$GLOBALS['Add_LuxStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Fashion_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Fashion Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Fashion/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Fashion Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                        <p>Fashion Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Status: <span>'.$GLOBALS['Add_FashionStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Eat_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Food Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Eat/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Food Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Doc_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Doctors Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Doc/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Medical Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                        <p>Medical Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Status: <span>'.$GLOBALS['Add_DocStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Ant_Category(){
	return '
		<div class="col-12 col-md-6 col-lg-4">
            <div class="single-property-area wow fadeInUp" data-wow-delay="200ms">
                <!-- Property Thumb -->
                <div class="property-thumb">
                    <img src="'.Get_Post_Image().'" alt="Antiques Picture" style="height:400px;">
                </div>

                <!-- Property Description -->
                <div class="property-desc-area">
                    <!-- Property Title & Seller -->
                    <div class="property-title-seller d-flex justify-content-between">
                        <!-- Title -->
                        <div class="property-title">
                            <h4><a href="'.Post.'Doc/'.$GLOBALS['ADD_ID'].'">'
                            				.$GLOBALS['Add_Name'].'</a></h4>
                            <p><i class="fa fa-map-marker" aria-hidden="true"></i>' 
                            	.$GLOBALS['User_City'].'</p>
                        </div>
                        <!-- Seller -->
                        <div class="property-seller">
                            <p>Seller:</p>
                            <h6>'.$GLOBALS['User_Name'].'</h6>
                        </div>
                    </div>
                    <!-- Property Info -->
                    <div class="property-info-area d-flex flex-wrap">
                        <p>Antique Name: <span>'.$GLOBALS['Add_Product_Name'].'</span></p>
                        <p>Antique Type: <span>'.$GLOBALS['Add_Type'].'</span></p>
                        <p>Status: <span>'.$GLOBALS['Add_AntStatus'].'</span></p>
                    </div>
                </div>

                <!-- Property Price -->
                <div class="property-price">
                    <p class="price">$'.$GLOBALS['Add_Price'].'/month</p>
                </div>
            </div>
        </div>';
}

function Get_Post_Image(){
	for ($i=1; $i < 5; $i++)
		if ( $GLOBALS['Picture'.$i] != Housing )
			return $GLOBALS['Picture'.$i];

	return Housing;
}

function User_Post_Error(){
	$GLOBALS['Error'] = True;
}