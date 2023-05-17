function showMessage(messageHTML) {
    // $('#chat-box').append(messageHTML);
    console.log(messageHTML);
}

$(document).ready(function(){
    websocket.onopen = function(event) { 
        showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		
    };

    websocket.onmessage = function(event) {
        var Data = JSON.parse(event.data);
        if(Data.action =='cancel_game' && Data.user == sharecode){
            window.location.href = "/ludo?cancel_room=true&sharecode="+sharecode;
        }else if(Data.action =='start_game'){
            if (init_r) {
                return 0;
            }
            names.red_player_name = $("#red_player_name .cun").val();
            names.green_player_name = $("#green_player_name .cun").val();
            names.yellow_player_name = $("#yellow_player_name .cun").val();
            names.blue_player_name = $("#blue_player_name .cun").val();
            var ap = 0;
            var b = 0;
            if (checku('red')) ap++;
            if (checku('green')) ap++;
            if (checku('yellow')) ap++;
            if (checku('blue')) ap++;
        
            if (bot['red']) b++;
            if (bot['green']) b++;
            if (bot['yellow']) b++;
            if (bot['blue']) b++;

            if (ap > 1 && b < ap) {
                init();
                // $(".rc_name").text(names.red_player_name);
                // $(".gc_name").text(names.green_player_name);
                // $(".yc_name").text(names.yellow_player_name);
                // $(".bc_name").text(names.blue_player_name);
                start_autorun();
                
                $(".lobby-main").hide();
        
            } else {
                // console.log("noooo");
            }
        
        }else if(Data.action =='join_game'){
                location.reload();			
        }else if(Data.action =='click_dice'){
            // if (stoptime) {
            //     startTimer();
            // }
            if (dice_value != 0) {
                return false;
            }
            if (rank_count > (turn_oder.length - 2)) {
                deactivateDice();
        
                return false;
            }
           
            dice_value = Data.data.dice_value;
           
            deactivateDice();
        
            if (dice_value == 6) {
                six_count++;
            } else {
                six_count = 0;
            }
            dice_sound.play();
            if (getActivePlayers(current_turn.players[0].home) == 0 && dice_value != 6) {
                // console.log(current_turn.group + " : no player is active , shifting turn to next player");
                hold(hold_time).then(() => {
                    updateTurn(++current_turn_index);
                    activateDice();
                });
        
            } else if (!getHomePlayers(current_turn.players[0].home) && getActivePlayers(current_turn.players[0].home) == 0 && dice_value == 6) {
                // console.log(current_turn.group + " : you can't use this dice value, so shifting turn to next player");
                hold(hold_time).then(() => {
                    updateTurn(++current_turn_index);
                    activateDice();
                });
            } else if (getActivePlayers(current_turn.players[0].home) == 1 && dice_value < 6) {
                // console.log(current_turn.group + " : you only have 1 active player so moving automatically");
        
                hold(hold_time).then(() => {
                    for (i = 0; i < 4; i++) {
                        if (current_turn.players[i].status == 'active') {
                            $(current_turn.players[i].controller + '').trigger("click");
                        }
                    }
                });
        
            } else if (getActivePlayers(current_turn.players[0].home) == 1 && getHomePlayers(current_turn.players[0].home) == 0 && dice_value == 6) {
                // console.log(current_turn.group + " : you only have 1 active player so moving automatically");
        
                hold(hold_time).then(() => {
                    for (i = 0; i < 4; i++) {
                        if (current_turn.players[i].status == 'active') {
                            $(current_turn.players[i].controller + '').trigger("click");
                        }
                    }
                });
        
            } else if (getHomePlayers(current_turn.players[0].home) == 1 && getActivePlayers(current_turn.players[0].home) == 0 && dice_value == 6) {
                // console.log(current_turn.group + " : you got 6 but , you don't have any active players and only 1 player in home so making it active");
                hold(hold_time).then(() => {
                    for (i = 0; i < 4; i++) {
                        if (current_turn.players[i].status == 'home') {
                            $(current_turn.players[i].controller + '').trigger("click");
                        }
                    }
                });
        
            }	
        }else if(Data.action =='move_player'){
            $(Data.data.target).trigger("click");
        }
        
        showMessage("<div class='chat-connection-ack'>Connection is established!</div>");		

    };
    
    websocket.onerror = function(event){
        showMessage("<div class='error'>Problem due to some Error</div>");
    };
    websocket.onclose = function(event){
        showMessage("<div class='chat-connection-ack'>Connection Closed</div>");
    }; 

    // $('#frmChat').on("submit",function(event){
    //     event.preventDefault();
    //     $('#chat-user').attr("type","hidden");		
    //     var messageJSON = {
    //         chat_user: $('#chat-user').val(),
    //         chat_message: $('#chat-message').val()
    //     };
    //     websocket.send(JSON.stringify(messageJSON));
    // });
});
