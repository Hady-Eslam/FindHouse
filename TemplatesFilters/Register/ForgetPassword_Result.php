<?php

function ForgetPassword_Result($Result){
	if ( $Result == 'Email Not Found' )
		return '<strong style="color: red;font-size: 30px;">Email Not Found</strong>';
	return '';
}

function GetSection($Result){
	if ( $Result == 'Done' )
		return '<p>The Email is Succesfully Sended</p>
        <p><strong>Note : </strong>The Token Will Be Deleted After 3 Days</p>';

    return '<form class="login100-form validate-form" method="POST"
	            action="<< ForgetPassword >>" id="ForgetForm">

				<span class="login100-form-logo">
					<i class="zmdi zmdi-landscape"></i>
				</span>

				<span class="login100-form-title p-b-34 p-t-27">
					ادخل البريد الالكترونى او رقم التليفون
				</span>

				<div style="text-align: center;">
                    << Load : Register/ForgetPassword_Result >>
        			<< Filter : ForgetPassword_Result : Result >>
                </div>

				
				<div class="wrap-input100 validate-input" data-validate="Enter E-mail">

					<input class="input100" type="text" name="Email" value="<< Email >>"
						id = "Email" placeholder="االبريد الاكترونى او الموبيل">
					<span  class="focus-input100" ><i class="fa fa-envelope icon" style="color: white;"></i></span>
				</div>

				

				<div class="container-login100-form-btn">
					<button class="login100-form-btn">
						ارسال
					</button>
				</div>

				<div class="text-center p-t-90">
					<a class="txt1" href="<< SignUP >>">
						اشناء حساب جديد
					</a>
				</div>

			</form>';
}