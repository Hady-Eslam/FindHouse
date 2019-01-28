# Project Title
Find House

# Purpose
For Fun

# Built With
  BackEnd => ( PHP )
  FronEnd => ( HTML, CSS, JAVASCRIPT )

# Technologies Used in it
  1- PHPMailer Class
  2- Composer For PHP Manger
  3- MVC Design Pattern
  4- .htaccess File For Routing URLS
  5- JQuery


# Project Whole Discription
  The Site Do This Functions.
  
  1 - ## Sign UP
    - it register the name, email, phone, password.
    - check if email and name is not found so every user can have unique.
    - it Send Confirm Email using phpmailer class With The User Token For Completing The Procces of SignUP and put him in waiting_user
          List.
    - it Delete the Token And user Data after a week time if he didn't enter the link in the email.
  
  2 - ## Confirm User
    - check if user in waiting list or not and the token is valid or not.
    - Put the Data from the waiting_list to users_list so he can use some of website functions.
  
  3 - Log in
    A - if the user in waiting_list it redirct him to confirm user page.
  
  4 - Forget Password
    A - The user put his email and website check if the email is in users_list or not.
    B - if the email is registered in waiting_list it redirect him in Confirm user page.
    C - if the email is registered in users_list the website send forget password email which contain the token and link of the reset
          password link.
    D - The Token Will be deleted after 3 days.
  
  5 - ReSet Password
    A - check if the token and user is exists in database or not .
    B - the user make the new password.
    C - deleting the token after successfully changing the password.
  
  6 - Log Out
  
  7 - Addvertise
    A - Only users who in users_list can Advertise.
  
  8 - Find
    A - Any User (register or not registered in website) can serach for houses with specefic features.
  
  9 - Predict (The Function Still under maintenence)
    A - Anyone can predict the price of house with specefic features.
  
  10 - Settings
    User Can Change
      A - Name
      B - Phone
      C - Password
      D - Profile Picture
      E - DeActivate Account
        in this it will log out user and his posts will not be shown in the search untill he log in again.
      F - Delete Account
        in this the account will be deleted and his posts will also be deleted.
  
  11 - My Profile
    A - User Sees his info.
    B - See his Posts And Links To This Posts.
    C - Can Delete this Posts.
  
  12 - User
    A - The Users(AnyOne) Can See Someinfo about the user who made the post.
    B - Can See his Posts.
  
  13 - Post
    A - Anyone can see the post.
    B - Only Users Can Make (Like, DisLike, Comment).
  
  14 - interested in:
    A - in it the user (registed or not) can make interested in request which means that the user didn't found the houses with some
        features which he is looking for . so he make interested request so when an advertise is found which is siutable for this
        interested request the website make interested email with the post link.
    B - in non registed users it shows that he must put his email to send the interested requests which is found to this email.
    C - the inereested in request has time limit which the user must put so after this time limit it will be invalid.
  
  15 - Notifications
    The User Can Get Notifications When :
      A - Some One Liked His Post.
      B - Some One DiLiked His Post.
      C - Some One Comment in His Post.
      D - The interested in request found post you may be interested in.
      C - the interested in request has ended.
    

# Current Status
  Not Finished

# Versioning
  The Current Version is 1.1
  
  The Available Versions:
    1 - 1.1
# Authors
  Hady Eslam
