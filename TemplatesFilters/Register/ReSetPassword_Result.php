<?php

function GetSection($Result){
	if ( $Result == 'Done' )
		return '<p>Password Has Changed</p>
        <a href="<< Login >>">Enter To Go To Log in Page</a>';

    return '<form class="login100-form validate-form" method="POST"
                    action="<< ReSetPassword >>" id="ReSetPasswordForm">

                    
                    <input type="hidden" name="Email" value="<< Email >>">
                    <input type="hidden" name="Token" value="<< Token >>">
                    
                    <span class="login100-form-logo">
                        <i class="zmdi zmdi-landscape"></i>
                    </span>

                    <span class="login100-form-title p-b-34 p-t-27">
                        اعاده تعين كلمه السر
                    </span>

            
                    <div class="wrap-input100 validate-input" data-validate="Enter password">

                        <input class="input100" type="password" name="Password" 
                            id="Password" placeholder="كلمه السر">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Re-enter password">

                        <input class="input100" type="password" name="ConPassword"
                            id="ConPassword" placeholder="اعاده كتابه كلمه السر">
                        <span class="focus-input100" data-placeholder="&#xf191;"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <button class="login100-form-btn">
                            تاكيد
                        </button>
                    </div>
                </form>';
}