<?php

function User_Header(){
	if ( SESSION() )
		return file_get_contents(_DIR_.'/Templates/Header/SiteHeaders/User_Logged_Header.html');
	return file_get_contents(_DIR_.'/Templates/Header/SiteHeaders/User_Not_Logged_Header.html');
}

function AdminOrUser(){
	if ( SESSION() && $_SESSION['Status'] == '0' )
		return '<li><a href="<< Header_LogOut >>">تسجيل الخروج</a></li>
                <li><a href="<< Header_Settings >>">اعدادات</a></li>

                <li><a href="<< Header_PeddingPosts >>">اعلانات منتظره</a></li>
                <li><a href="<< Header_MyMessages >>">الرسائل</a></li>
                <li><a href="<< Header_MyProfile >>">البروفايل</a></li>
                <li><a href="<< Header_Notifications >>">اخطارات</a></li>
                <li><a href="<< Header_Advertise >>">اضف اعلان</a></li>';

    return '<li><a href="<< Header_LogOut >>">تسجيل الخروج</a></li>
    		<li><a href="<< Header_Settings >>">اعدادات</a></li>

            <li><a href="<< Header_MyMessages >>">الرسائل</a></li>
            <li><a href="<< Header_MyProfile >>">البروفايل</a></li>
            <li><a href="<< Header_Notifications >>">اخطارات</a></li>
            <li><a href="<< Header_Advertise >>">اضف اعلان</a></li>';
}