function ShowMore(){
    SendQuery();
}

function Delete(ID){

    if ( confirm("Are You Sure Want To Delete")==true ){

        $.ajax({
            type : "POST",
            url : "http://localhost/FindHouse/Profile/DeletePost.php",
            data : "ID="+ID,

            success : function(message){
                if ( message=='Success' ){
                    $('#Result').css('top',$(window).scrollTop()+200)
                                .css('visibility','visible');
                    setTimeout(function () {
                        window.location.reload(true);
                    }, 1300);
                }
                else{
                    $('#End').text(message);
                    $('#Show').css('visibility','visible');
                    $('.Div_Show_More').css('visibility','hidden');
                }
            }
        });
    }
}

function Edit(ID){
    window.location.href = 'http://localhost/FindHouse/Profile/Edit.php?ID='+ID;
}

function Go(ID){
    window.location.href = 'http://localhost/FindHouse/Show.php?ID='+ID;
}