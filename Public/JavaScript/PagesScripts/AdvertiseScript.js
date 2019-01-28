$(document).ready(function(){

    $("#Submit").click(function(event){
        if ( CheckData() == true )
            GO('#AdvertiseDiv');
    });

    $('#ShowAdvertise').click(function(){
        location.href = MyPage;
    })
})

function CheckData(){
    Result = CheckLength('#Address', Address_Len);
    Result = CheckLength('#Phone', Phone_Len, Result);
    Result = CheckDataLenAndNumber(Result, '#Area', Area_Len, 0, 10000);
    Result = CheckDataLenAndNumber(Result, '#Rooms', Rooms_Len, 0, 9);
    Result = CheckDataLenAndNumber(Result, '#PathRooms', Rooms_Len, 0, 9);
    Result = CheckDataLenAndNumber(Result, '#Storey', Storey_Len, 0, 20);
    Result = CheckDataLenAndNumber(Result, '#Money', Money_Len, 0, 10000000000);
    return CheckLength('#Discreption', Discreption_Len, Result, true);
}