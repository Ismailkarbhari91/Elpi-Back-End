$(document).ready(function(){

    if($("#valid").val() == 'ingame'){
        $(start_btn).trigger("click");
    }
    
    $("#cancel_bt, #cancel_link").click(function(e){
        // alert(sharecode);
        var messageJSON = {
            user: sharecode,
            action: 'cancel_game',
            data: {}
        };
        websocket.send(JSON.stringify(messageJSON));
    }); 
});