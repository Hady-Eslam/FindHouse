$(document).ready(function(){

    SetCokiee();
    $('#PictureButton').click(function(){
        location.href = MyPage + '?Section=Picture'
    })

    $('#NameButton').click(function(){
        location.href = MyPage + '?Section=Name'
    })

    $('#PhoneButton').click(function(){
        location.href = MyPage + '?Section=Phone'
    })

    $('#PasswordButton').click(function(){
        location.href = MyPage + '?Section=Password'
    })

    $('#NotificationsButton').click(function(){
        location.href = MyPage + '?Section=Notifications';
    })

    $('#EmailButton').click(function(){
        location.href = MyPage + '?Section=Email';
    })

    $('#DeActivateButton').click(function(){
        location.href = MyPage + '?Section=DeActivate';
    })
})