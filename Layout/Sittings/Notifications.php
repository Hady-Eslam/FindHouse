<p>Notifications</p>

<div class="Div2" style="font-size: 17px;" id='NotificationsDiv'>

    <div class="Div3">

        <input type="checkbox" name="Comment" 
        <?php
            if ( $_SESSION['N_Comment'] == 1 )
                echo 'checked';
        ?>> Notify When Someone Write Comment in Your Post

        <br><br>
        <input type="checkbox" name="Negotations"
        <?php
            if ( $_SESSION['N_Negotations'] == 1 )
                echo 'checked';
        ?>> Notify When Someone Send Negotation 

        <br><br>
        <input type="checkbox" name="See"
        <?php
            if ( $_SESSION['N_See'] == 1 )
                echo 'checked';
        ?>> Notify When Someone See The Post

        <br><br>
        <input type="checkbox" name="Like"
        <?php
            if ( $_SESSION['N_Like'] == 1 )
                echo 'checked';
        ?>> Notify When Someone Like The Post

        <br><br>
        <input type="checkbox" name="ReportPost"
        <?php
            if ( $_SESSION['N_Report_Post'] == 1 )
                echo 'checked';
        ?>> Notify When Someone Report The Post

        <br><br>
        <input type="checkbox" name="ReportAcount"
        <?php
            if ( $_SESSION['N_Report_Acount'] == 1 )
                echo 'checked';
        ?>> Notify When Someone Report Your Acount

    </div>
    <div class="Button_Div">
        <input type="submit" class="Button" value="Save Data" 
            name = 'NotificationsSubmit' id="NotificationsSubmit" style="width: auto;">
    </div>
</div>