<p>Change Password : </p>
<div class="Div2" id="PasswordDiv">
    
    <div class="Div3">
        <p style="font-size: 16px;">Change Password :</p>

        <div style="margin: 0 0 0 0;">
            <input class="Input_Data" onfocus="Focus(this);"
                onblur="Blur(this);" type="password" id='OldPassword' name="OP" 
                required placeholder="Enter Your Old Password"
                oninput="CheckinputLen(this, Password_Len);">
        </div>

        <div style="margin: 0 0 0 0;">
            <input class="Input_Data" onfocus="Focus(this);"
                onblur="Blur(this);" type="password" id='Password' name="P" 
                required placeholder="Enter Your New Password"
                oninput="CheckinputLen(this, Password_Len);">
        </div>

        <div style="margin: 0 0 0 0;">
            <input class="Input_Data" onfocus="Focus(this);"
                onblur="Blur(this);" type="password" id='ConPassword' name="ConP" 
                required placeholder="Re-Enter Password"
                oninput="CheckinputLen(this, Password_Len);">
        </div>

    </div>

    <div class="Button_Div">
        <input type="submit" class="Button" value="Save Password"
            name = 'PasswordSubmit' id="PasswordSubmit" style="width: auto;">
    </div>
</div>