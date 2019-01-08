$(document).ready(function(){

    SetCokiee();
    $("#Submit").click(function(event){
        if ( CheckData() == true )
            GO('#AdvertiseDiv');
    });
})

function CheckData(){
    Result = true;
//
    Street = $('#Street').val();
    if ( $('#Street').val().length > Street_Len )
        Result = false;

// 
    Status = $('input[name=Status]:checked').val();
    Result = CheckString(Result, Status, Status_Len);

    Type = $('input[name=Ty]:checked').val();
    Result = CheckString(Result, Type, Type_Len);

    Furnished = $('input[name=Fur]:checked').val();
    Result = CheckString(Result, Furnished, Furnished_Len);

//
    Phone = $('#Phone').val();
    if ( $('#Phone').val().length != Phone_Len ){
        $('#Phone').css('border-color','red');
        Result = false;
    }
    
    Result = CheckDataLenAndNumber(Result, '#Area', Area_Len);
    
    Result = CheckDataLenAndNumber(Result, '#Storey', Storey_Len);

    Result = CheckDataLenAndNumber(Result, '#Rooms', Rooms_Len);

    Result = CheckDataLenAndNumber(Result, '#PathRooms', PathRooms_Len);

    Result = CheckDataLenAndNumber(Result, '#Money', Money_Len);

//
    Discreption = $('#Discreption').val();
    if ( $('#Discreption').val().length > Discreption_Len )
        Result = false;

    return Result;
}

function CheckDataLenAndNumber(Before, id, len){
    Result = Before;
    if ( isNumber(id) == false )
        Result = false;
    if ( CheckLength(id, len) == false )
        Result = false;
    return Result
}

function CheckString(Before, The_String, len){
    Result = Before;
    if ( CheckStringLength(The_String, len) == false )
        Result = false;
    return Result;
}