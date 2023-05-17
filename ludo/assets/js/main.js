function showMessage(messageHTML) {
    // $('#chat-box').append(messageHTML);
    console.log(messageHTML);
}

$(document).ready(function(){
    $("div.lobby").hide();
    $("div.create_room").hide();
    $(".welcome").hide();

    var url = new URL(window.location.href);
    var c = url.searchParams.get("room_name");
    if(c != null){
        $("div.create_room").hide();
        $("div.lobby").show();

        var websocket = new WebSocket("ws://localhost:8090/demo/php-socket.php"); 
        websocket.onopen = function(event) { 
            showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
        }
        websocket.onmessage = function(event) {
            var Data = JSON.parse(event.data);
            if(Data.message_type =='new_user'){
                showMessage("<div class='"+Data.message_type+"'>"+Data.message+"</div>");
                $("#"+Data.message+" input").val(Data.user);
                $("#"+Data.message+" input").attr("readonly", true);
            }
            else if(Data.message_type =='start_game'){
                $("#start_btn").trigger("click");
            }
            else if(Data.message_type =='click_dice'){
                $("#dic").trigger("click");
            }
            else if(Data.message_type =='move_player'){
                console.log(Data.message);
                $(Data.message).trigger("click");
            }

        };
        
        websocket.onerror = function(event){
            showMessage("<div class='error'>Problem due to some Error</div>");
        };
        websocket.onclose = function(event){
            showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
        }; 
        
        $('#frmChat').on("submit",function(event){
            event.preventDefault();
            $('#chat-user').attr("type","hidden");		
            var messageJSON = {
                chat_user: $('#chat-user').val(),
                chat_message: $('#chat-message').val()
            };
            websocket.send(JSON.stringify(messageJSON));
        });
    
    }
        
    
    $("div.share_url").hide();
    // $("div.color_div").hide();
    // $("div#"+$("select#choose_color").val()+"_user").show();
    // $("select#choose_color").change(function(){
    //     $("div.color_div").hide();
    //     $("div#"+$(this).val()+"_user").show();
    // });

    $("button#create_room_btn").click(function(){
        if($("input#room_name_field").val() != ''){
            $("div.create_room").hide();
            $("span#share_url").html("Share url &nbsp;&nbsp;&nbsp;<a href='"+window.location.href+"?room_name="+$("input#room_name_field").val()+"'>"+window.location.href+"?room_name="+$("input#room_name_field").val()+"</a>");
            // window.history.pushState('page2', 'Title', '?room_name='+$("input#room_name_field").val());
            $("div.share_url").show();
        }
    });

    $("input.cun").change(function(){
        console.log($(this).val());
        var messageJSON = {
            chat_user: $(this).val(),
            chat_message: $(this).parent().attr("id"),
            req_type: "new_user"
        };
        websocket.send(JSON.stringify(messageJSON));
    });
    
    $("#start_bt").click(function(){
        var messageJSON = {
            chat_user: false,
            chat_message: false,
            req_type: "start_game"
        };
        websocket.send(JSON.stringify(messageJSON));
    });

    $("#dice").click(function(){
        var messageJSON = {
            chat_user: false,
            chat_message: false,
            req_type: "click_dice"
        };
        websocket.send(JSON.stringify(messageJSON));
    });

    $(".player").click(function(){

        var messageJSON = {
            chat_user: false,
            chat_message: $(this).attr("data-attr"),
            req_type: 'move_player'
        };
        websocket.send(JSON.stringify(messageJSON));
    });

});