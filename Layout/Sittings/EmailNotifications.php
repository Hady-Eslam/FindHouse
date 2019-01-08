<p>Email Notifications</p>

<div class="Div2" style="font-size: 17px;" id='EmailNotifications'>
    <div class="Div3">
        
        <input type="checkbox" name="NewUpdates"
        <?php
            if ( $_SESSION['E_New_Updates'] == 1 )
                echo 'checked';
        ?>> Notify My Email When New Updates is Happend

        <br><br>
        <input type="checkbox" name="Comment"
        <?php
            if ( $_SESSION['E_Comment'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone Write Comment in Your Post

        <br><br>
        <input type="checkbox" name="Negotations"
        <?php
            if ( $_SESSION['E_Negotations'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone Send Negotation 

        <br><br>
        <input type="checkbox" name="See"
        <?php
            if ( $_SESSION['E_See'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone See The Post

        <br><br>
        <input type="checkbox" name="Like"
        <?php
            if ( $_SESSION['E_Like'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone Like The Post

        <br><br>
        <input type="checkbox" name="ReportPost"
        <?php
            if ( $_SESSION['E_Report_Post'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone Report My Post

        <br><br>
        <input type="checkbox" name="ReportAcount"
        <?php
            if ( $_SESSION['E_Report_Acount'] == 1 )
                echo 'checked';
        ?>> Notify My Email When Someone Report My Acount
    </div>

    <div class="Button_Div">
        <input type="submit" class="Button" value="Save Data"
            name = 'EmailNotificationsSubmit' id="EmailNotificationsSubmit" 
            style="width: auto;">
    </div>
</div>