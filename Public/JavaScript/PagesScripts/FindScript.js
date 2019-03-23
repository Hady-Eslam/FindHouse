$(document).ready(function(){
    $("#Submit").click(function(event){
        if ( CheckData() == true )
            GO_GET('#Search_Bar');
    });
})

function CheckData(){
    Result = CheckDataLenAndNumber(true, '#MinArea', Area_Len, 0, 10000, true);
    Result = CheckDataLenAndNumber(Result, '#MaxArea', Area_Len, 0, 10000, true);
    Result = CheckMinMax('#MinArea', '#MaxArea', Result);

    Result = CheckDataLenAndNumber(Result, '#MinRooms', Rooms_Len, 0, 9, true);
    Result = CheckDataLenAndNumber(Result, '#MaxRooms', Rooms_Len, 0, 9, true);
    Result = CheckMinMax('#MinRooms', '#MaxRooms', Result);

    Result = CheckDataLenAndNumber(Result, '#MinPathRooms', Rooms_Len, 0, 9, true);
    Result = CheckDataLenAndNumber(Result, '#MaxPathRooms', Rooms_Len, 0, 9, true);
    Result = CheckMinMax('#MinPathRooms', '#MaxPathRooms', Result);

    Result = CheckDataLenAndNumber(Result, '#MinMoney', Money_Len,0,10000000000,true);
    Result = CheckDataLenAndNumber(Result, '#MaxMoney', Money_Len,0,10000000000,true);
    return CheckMinMax('#MinMoney', '#MaxMoney', Result);
}