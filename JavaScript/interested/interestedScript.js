$(document).ready(function(){

    SetCokiee();
    $("#Submit").click(function(event){
        if ( CheckData() == true )
            GO('#interestedDiv');
    });
})

function CheckData(){
	Result = true;
//
	if ( $('#AreaFrom').val().length > 0 ){
		if ( CheckLength('#AreaFrom', Area_Len) == false )
	        Result = false;
	    if ( isNumber('#AreaFrom') == false )
	        Result = false;
	}

    if ( $('#AreaTo').val().length > 0 ){
	    if ( CheckLength('#AreaTo', Area_Len) == false )
	        Result = false;
	    if ( isNumber('#AreaTo') == false )
	        Result = false;
	}
//
	if ( $('#MoneyFrom').val().length > 0 ){
	    if ( CheckLength('#MoneyFrom', Money_Len) == false )
	        Result = false;
	    if ( isNumber('#MoneyFrom') == false )
	        Result = false;
	}

    if ( $('#MoneyTo').val().length > 0 ){
	    if ( CheckLength('#MoneyTo', Money_Len) == false )
	        Result = false;
	    if ( isNumber('#MoneyTo') == false )
	        Result = false;
	}

//	
	if ( UserStatus == 0 ){

		Found = false;
		if ( $('#Phone').val().length > 0 ){
			if ( $('#Phone').val().length != Phone_Len ){
		        $('#Phone').css('border-color','red');
			        Result = false;
			}
			Found = true;
		}

		if ( $('#Email').val().length > 0 ){
			if ( CheckLength('#Email', Email_Len) == false ){
				if ( Found == false )
	        		Result = false;
			}
			Found = true;
		}
		if ( Found == false ){
			$('#Phone').css('border-color','red');
			$('#Email').css('border-color','red');
			Result = false;
		}
	}
	else{
		if ( $('#Phone').val().length > 0 ){
			if ( $('#Phone').val().length != Phone_Len ){
		        $('#Phone').css('border-color','red');
			        Result = false;
			}
		}

		if ( $('#Email').val().length > 0 ){
			if ( CheckLength('#Email', Email_Len) == false )
	        	Result = false;

		}
	}

	if ( $('#Months :selected').text() == '0 Month' ){
    	if ( $('#Days :selected').text() == '0 Day' ){
    		$('#Months').css('border-color','red');
        	Result = false;
    	}
    }

	return Result;
}