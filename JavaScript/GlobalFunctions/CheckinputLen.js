/*
	- info :
		javascript page    	=>  CheckinputLen.js
        init name   		=>  CheckinputLenScript

	-The Scripts it Depends On (init Name) :
		JQueryScript
		CheckLenScript
*/

// Functions For input 
function CheckinputLen(The_Object, Len){
    if ( CheckLength('#'+The_Object.id, Len) == true )
        $('#'+The_Object.id).css('border-color', '#645A60');
}