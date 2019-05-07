<?php

use SiteEngines\HashingEngine;

function CheckButton(){
	if ( $GLOBALS['Result'] === [] )
		return '';
	else
		return '<div class="information-area mb-80 wow fadeInUp" data-wow-delay="200ms"
	                style="padding-left: 10%;text-align: center !important;" id="ShowMore">
	                <!--<h4 class="mb-30">Admin Operations</h4>-->

	                <!-- Content -->
	                <a class="btn rehomes-btn mt-10" onclick="SeeMore()">See More Posts</a>
	            </div>';
}

function GetPosts(){
	$String = '';
    foreach ( $GLOBALS['Result'] as $Value)
        $String .= MyProfile_Get_Post($Value);

    if ( $String == '' )
        return '<p style="text-align: center;">No Posts Found</p>';
    return $String;
}

function MyProfile_Get_Post($Post){
	
	$GLOBALS['Error'] = False;
	User_Get_Post_Mobile_From_Hashing($Post);
	if ( $GLOBALS['Error'] )
		return '';

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
                	<p class="badge-rent">For Rent</p>
                </div>
            </div>
        </div>';
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

function Get_Post_Image(){
	for ($i=1; $i < 5; $i++)
		if ( $GLOBALS['Picture'.$i] != Housing )
			return $GLOBALS['Picture'.$i];

	return Housing;
}

function User_Post_Error(){
	$GLOBALS['Error'] = True;
}