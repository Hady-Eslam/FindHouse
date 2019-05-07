function ShowMoreNotifications(){

    $.ajax({
        type : "POST",
        url : GetMoreNotificationsPage,
        data : 'Notifications_Number=' + Notifications_Number,
        error: function (jqXHR, exception) {
            console.log(jqXHR);
        },
        
        success : function(Data){
            console.log(Data);
            try{
                Data = JSON.parse(Data);
                console.log('Hello');
                if ( Data['Result'] == 0 )
                    $( "#ShowMoreNotifications" ).remove();
                else if ( Data['Result'] == 1 ){
                    Notifications_Number = Data['Data']['Number'];
                    $(Data['Data']['Data']).appendTo('#Notifications');
                    console.log(Notifications_Number);
                }
                else{
                    SetError_Function('in Searching For Email Reservied Or Not',
                        'in SignUPScript.js', 'in CheckEmail Function',
                        Data['Error']['Error Type'], Data['Error']['Error Code'],
                        Data['Error']['Error Message'], true);
                }
            }
            catch(e){
                SetError_Function('in Showing More Notifications',
                    'in NotificationsScript.js', 'in ShowMoreNotifications Function',
                    'JSON Error', '1', 'Failed To Covert JSON', false);
            }    
        }
    });
}