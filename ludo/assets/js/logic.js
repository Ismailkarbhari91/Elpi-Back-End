// for(i=0;i<steps.length;i++){
//     steps[i].innerText=i;
// }
$(document).keydown((e) => {
    // console.log(e.keyCode)
    if (e.keyCode == 32 || e.keyCode == 13) {
        $("#dice").trigger("click");
    }
    if (e.keyCode == 35 || e.keyCode == 49) {
        $(current_turn.players[0].controller).trigger("click");
    }
    if (e.keyCode == 40 || e.keyCode == 50) {
        $(current_turn.players[1].controller).trigger("click");
    }
    if (e.keyCode == 34 || e.keyCode == 51) {
        $(current_turn.players[2].controller).trigger("click");
    }
    if (e.keyCode == 37 || e.keyCode == 52) {
        $(current_turn.players[3].controller).trigger("click");
    }
});


$("#red_player_name .bot").click(() => {
    $("#red_player_name .bot").toggleClass("botoff");
    $("#red_player_name .bot").toggleClass("boton");
    bot.red = !bot.red;
    $("#red_player_name .cun").attr("disabled", bot.red);
    if (bot.red) {
        $("#red_player_name .cun").val("Botred");
    } else {
        $("#red_player_name .cun").val("");

    }
});

$("#green_player_name .bot").click(() => {
    $("#green_player_name .bot").toggleClass("botoff");
    $("#green_player_name .bot").toggleClass("boton");
    bot.green = !bot.green;
    $("#green_player_name .cun").attr("disabled", bot.green);
    if (bot.green) {
        $("#green_player_name .cun").val("Botgreen");
    } else {
        $("#green_player_name .cun").val("");

    }
});


$("#blue_player_name .bot").click(() => {
    $("#blue_player_name .bot").toggleClass("botoff");
    $("#blue_player_name .bot").toggleClass("boton");
    bot.blue = !bot.blue;
    $("#blue_player_name .cun").attr("disabled", bot.blue);
    if (bot.blue) {
        $("#blue_player_name .cun").val("Botblue");
    } else {
        $("#blue_player_name .cun").val("");

    }
});
$("#yellow_player_name .bot").click(() => {
    $("#yellow_player_name .bot").toggleClass("botoff");
    $("#yellow_player_name .bot").toggleClass("boton");
    bot.yellow = !bot.yellow;
    $("#yellow_player_name .cun").attr("disabled", bot.yellow);

    if (bot.yellow) {
        $("#yellow_player_name .cun").val("Botyellow");
    } else {
        $("#yellow_player_name .cun").val("");

    }
});

$("#start_btn").click((e) => {
    e.preventDefault();
    $.ajax({
        data: {
            sharecode: sharecode
        },
        type: "post",
        url: "database/start_game.php",
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    var messageJSON = {
                        user: sharecode,
                        action: 'start_game',
                        data: {}
                    };
                    websocket.send(JSON.stringify(messageJSON));
                }
                else if(dataResult.statusCode==201){
                   alert(dataResult);
                }
        }
    });
});

function checku(u) {
    var ret = false;
    if (bot[u]) {
        ret = true;
    }
    if (!bot[u] && names[u + "_player_name"] != null && names[u + "_player_name"] != "") {
        ret = true;

    }

    return ret;
}




function init() {
    init_r = true;
    if (checku('red')) {
        $(".red-home .white-box .player-room").append(red_player_1.player + red_player_2.player + red_player_3.player + red_player_4.player);
        turn_oder.push(turn_oder_lobby[0]);
    }
    if (checku('green')) {
        $(".green-home .white-box .player-room").append(green_player_1.player + green_player_2.player + green_player_3.player + green_player_4.player);
        turn_oder.push(turn_oder_lobby[1]);
    }
    if (checku('yellow')) {
        $(".yellow-home .white-box .player-room").append(yellow_player_1.player + yellow_player_2.player + yellow_player_3.player + yellow_player_4.player);
        turn_oder.push(turn_oder_lobby[2]);
    }
    if (checku('blue')) {
        $(".blue-home .white-box .player-room").append(blue_player_1.player + blue_player_2.player + blue_player_3.player + blue_player_4.player);
        turn_oder.push(turn_oder_lobby[3]);
    }

    // $(".winner-home .rwh").append($(".red-home .white-box .player-room").html());
    // $(".winner-home .gwh").append($(".green-home .white-box .player-room").html());
    // $(".winner-home .bwh").append($(".blue-home .white-box .player-room").html());
    // $(".winner-home .ywh").append($(".yellow-home .white-box .player-room").html());

    updateTurn(current_turn_index);


}



const sleep = (milliseconds) => {
    return new Promise(resolve => setTimeout(resolve, milliseconds))
}





$("#dice").click(function (e) {
    if(current_turn.user == loginname){
        dice_valu = Math.random() * (7 - 1) + 1;
        dice_valu = Math.floor(dice_valu);
    
        var messageJSON = {
            user: sharecode,
            action: 'click_dice',
            data: {
                dice_value: dice_valu 
            }
        };
        websocket.send(JSON.stringify(messageJSON));    
    }
});

const hold = async (milliseconds) => {
    ////console.log("holding for "+milliseconds/1000+" seconds");
    await sleep(milliseconds);

}
// function updateTurn(cti){
//     //console.log("Function Input : ",cti);
//     if(rank_count>2){

//         return 0;

//     }
// ////console.log("turn shifted to next player");

//     $(".red_control").hide();
//     $(".yellow_control").hide();
//     $(".blue_control").hide();
//     $(".green_control").hide();
// $(".red-home").css("opacity","1");
// $(".green-home").css("opacity","1");
// $(".yellow-home").css("opacity","1");
// $(".blue-home").css("opacity","1");

// if(cti>turn_oder.length-1){

//     current_turn_index=0;
// }

// current_turn=turn_oder[current_turn_index];
// if(current_turn.rank>0){
//     ++current_turn_index;
//     if(current_turn_index>turn_oder.length-1){
//         current_turn_index=0;
//     }
// current_turn=turn_oder[current_turn_index];  
// }
// if(current_turn.rank>0){
//     ++current_turn_index;
//     if(current_turn_index>turn_oder.length-1){
//         current_turn_index=0;
//     }
// current_turn=turn_oder[current_turn_index];  
// }
// if(current_turn.rank>0){
//     ++current_turn_index;
//     if(current_turn_index>turn_oder.length-1){
//         current_turn_index=0;
//     }
// current_turn=turn_oder[current_turn_index];  
// }
// if(current_turn.rank>0){
//     ++current_turn_index;
//     if(current_turn_index>turn_oder.length-1){
//         current_turn_index=0;
//     }
// current_turn=turn_oder[current_turn_index];  
// }
// // //console.log(current_turn_index);
// if(current_turn.group=='RED') $(".red_control").show();
// if(current_turn.group=='GREEN') $(".green_control").show();
// if(current_turn.group=='BLUE') $(".blue_control").show();
// if(current_turn.group=='YELLOW') $(".yellow_control").show();
// $(".current_turn").text(current_turn.group);
// if(current_turn.rank<1){
//     $(current_turn.players[0].home).css("opacity","0.5");

// }

// //console.log("CTI : ",current_turn_index);
// //console.log("CURRENT USER : ",current_turn.group);
// console.error("-------------------");

// }
function updateTurn(cti) {
    if (rank_count > (turn_oder.length - 2)) {
        return 0;
    }
    if (cti > (turn_oder.length - 1)) {
        cti = 0;
    }

    if (turn_oder[cti].rank > 0) {
        ++current_turn_index;
        updateTurn(++cti);
        return 0;
    }

    current_turn_index = cti;
    current_turn = turn_oder[cti];
    //console.log("current_player : ",current_turn.group);
    $(".current_turn").text(current_turn.user);
    $(".red_control").hide();
    $(".yellow_control").hide();
    $(".blue_control").hide();
    $(".green_control").hide();
    $(".red-home .white-box").css("transform", "scale(1)");
    $(".green-home .white-box").css("transform", "scale(1)");
    $(".yellow-home .white-box").css("transform", "scale(1)");
    $(".blue-home .white-box").css("transform", "scale(1)");
    if (current_turn.group == 'RED') $(".red_control").show();
    if (current_turn.group == 'GREEN') $(".green_control").show();
    if (current_turn.group == 'BLUE') $(".blue_control").show();
    if (current_turn.group == 'YELLOW') $(".yellow_control").show();
    // inout_sound.play();
    $(current_turn.players[0].home + " .white-box").css("transform", "scale(1.15)");
    six_count = 0;
    if (bot[current_turn.group.toLowerCase()]) {
        start_autorun();
    }
}

function getActivePlayers(home) {
    var active_players = 0;
    if (home == ".red-home") {
        if (red_player_1.status == 'active' && red_player_1.current_position + dice_value <= red_player_1.path.length) active_players++;
        if (red_player_2.status == 'active' && red_player_2.current_position + dice_value <= red_player_2.path.length) active_players++;
        if (red_player_3.status == 'active' && red_player_3.current_position + dice_value <= red_player_3.path.length) active_players++;
        if (red_player_4.status == 'active' && red_player_4.current_position + dice_value <= red_player_4.path.length) active_players++;

    }
    if (home == ".green-home") {
        if (green_player_1.status == 'active' && green_player_1.current_position + dice_value <= green_player_1.path.length) active_players++;
        if (green_player_2.status == 'active' && green_player_2.current_position + dice_value <= green_player_2.path.length) active_players++;
        if (green_player_3.status == 'active' && green_player_3.current_position + dice_value <= green_player_3.path.length) active_players++;
        if (green_player_4.status == 'active' && green_player_4.current_position + dice_value <= green_player_4.path.length) active_players++;

    }
    if (home == ".yellow-home") {
        if (yellow_player_1.status == 'active' && yellow_player_1.current_position + dice_value <= yellow_player_1.path.length) active_players++;
        if (yellow_player_2.status == 'active' && yellow_player_2.current_position + dice_value <= yellow_player_2.path.length) active_players++;
        if (yellow_player_3.status == 'active' && yellow_player_3.current_position + dice_value <= yellow_player_3.path.length) active_players++;
        if (yellow_player_4.status == 'active' && yellow_player_4.current_position + dice_value <= yellow_player_4.path.length) active_players++;

    }
    if (home == ".blue-home") {
        if (blue_player_1.status == 'active' && blue_player_1.current_position + dice_value <= blue_player_1.path.length) active_players++;
        if (blue_player_2.status == 'active' && blue_player_2.current_position + dice_value <= blue_player_2.path.length) active_players++;
        if (blue_player_3.status == 'active' && blue_player_3.current_position + dice_value <= blue_player_3.path.length) active_players++;
        if (blue_player_4.status == 'active' && blue_player_4.current_position + dice_value <= blue_player_4.path.length) active_players++;

    }
    return active_players;
}

function getWinPlayers(home) {
    var win_players = 0;
    if (home == ".red-home") {
        if (red_player_1.status == 'win') win_players++;
        if (red_player_2.status == 'win') win_players++;
        if (red_player_3.status == 'win') win_players++;
        if (red_player_4.status == 'win') win_players++;

    }
    if (home == ".green-home") {
        if (green_player_1.status == 'win') win_players++;
        if (green_player_2.status == 'win') win_players++;
        if (green_player_3.status == 'win') win_players++;
        if (green_player_4.status == 'win') win_players++;

    }
    if (home == ".yellow-home") {
        if (yellow_player_1.status == 'win') win_players++;
        if (yellow_player_2.status == 'win') win_players++;
        if (yellow_player_3.status == 'win') win_players++;
        if (yellow_player_4.status == 'win') win_players++;

    }
    if (home == ".blue-home") {
        if (blue_player_1.status == 'win') win_players++;
        if (blue_player_2.status == 'win') win_players++;
        if (blue_player_3.status == 'win') win_players++;
        if (blue_player_4.status == 'win') win_players++;

    }
    return win_players;
}

function getHomePlayers(home) {
    var home_players = 0;
    if (home == ".red-home") {
        if (red_player_1.status == 'home') home_players++;
        if (red_player_2.status == 'home') home_players++;
        if (red_player_3.status == 'home') home_players++;
        if (red_player_4.status == 'home') home_players++;

    }
    if (home == ".green-home") {
        if (green_player_1.status == 'home') home_players++;
        if (green_player_2.status == 'home') home_players++;
        if (green_player_3.status == 'home') home_players++;
        if (green_player_4.status == 'home') home_players++;

    }
    if (home == ".yellow-home") {
        if (yellow_player_1.status == 'home') home_players++;
        if (yellow_player_2.status == 'home') home_players++;
        if (yellow_player_3.status == 'home') home_players++;
        if (yellow_player_4.status == 'home') home_players++;

    }
    if (home == ".blue-home") {
        if (blue_player_1.status == 'home') home_players++;
        if (blue_player_2.status == 'home') home_players++;
        if (blue_player_3.status == 'home') home_players++;
        if (blue_player_4.status == 'home') home_players++;

    }
    return home_players;
}


function movePlayer(M_Player, M_Step, M_Road) {
    if (rank_count > (turn_oder.length - 2)) {
        return 0;
    }
    if (isPlayerIsMoving) {
        return 0;
    }
    if (M_Step == 0) {
        // console.log(M_Player.color + ' : Dice value is 0');
        return 0;
    }

    if (M_Step == 6 && M_Player.status == 'home') {
        M_Player.status = "active";
        // console.log(M_Player.color + ' : Player is active now');
        var player_room_update = $(M_Player.home + " .white-box .player-room").html();
        $(M_Player.home + " .white-box .player-room").html(player_room_update.replace(M_Player.player, ''));

        M_Step = 1;
    }
    if (M_Step != 0 && M_Player.status == 'home') {
        // console.log(M_Player.color + ' : player is not active');

        return 0;
    }
    if (M_Player.status != 'active') {
        ////console.log('Player is not active');
        activateDice();
        return 0;
    }

    if (M_Player.current_position + M_Step > M_Player.path.length && getActivePlayers(M_Player.home) == 1) {
        ////console.log('you need something less to run');
        hold(hold_time).then(() => {
            activateDice();
            updateTurn(++current_turn_index);
        });

        return 0;
    }

    if (M_Player.current_position + M_Step > M_Player.path.length) {
        ////console.log("you need something less");
        return 0;
    }


    const run_point = [];
    for (i = 0; i < M_Step; i++) {
        run_point.push(1);
    }
    const moveNow = async () => {
        ////console.log("player is running");
        isPlayerIsMoving = true;
        for (const item of run_point) {

            M_Player.current_step = M_Road[M_Player.path[M_Player.current_position]];

            if (M_Player.path[M_Player.current_position] == 'win') {
                // alert("winner");
                winner_sound.play();
                M_Player.status = "win";
                M_Player.previous_step = M_Road[M_Player.path[M_Player.current_position - 1]];
                M_Player.previous_step.innerHTML = M_Player.previous_step.innerHTML.replace(M_Player.player, '');
                //  var winner_home = $(".winner-home").html();
                var pl = "";
                if (M_Player.home == ".red-home") {
                    pl = ".rwh";
                }
                if (M_Player.home == ".green-home") {

                    pl = ".gwh";
                }

                if (M_Player.home == ".yellow-home") {

                    pl = ".ywh";
                }
                if (M_Player.home == ".blue-home") {

                    pl = ".bwh";
                }

                $(".winner-home " + pl).html($(".winner-home " + pl).html() + M_Player.player);

                if (getWinPlayers(M_Player.home) > 3) {
                    if (!current_turn.rank > 0) {
                        current_turn.rank = ++rank_count;
                        // console.log(M_Player.color + " : You just got " + rank_count + " rank ");
                    }
                    //console.log("winner "+rank_count, current_turn.group);
                    $(M_Player.home + " .white-box").css("background-image", "url(assets/img/crown" + rank_count + ".png)");


                    $(M_Player.home).css("opacity", "1");

                }
                return 0;
            } else {
                if (M_Player.current_position != 0) {
                    M_Player.previous_step = M_Road[M_Player.path[M_Player.current_position - 1]];
                    M_Player.previous_step.innerHTML = M_Player.previous_step.innerHTML.replace(M_Player.player, '');

                    M_Player.current_step.innerHTML = M_Player.current_step.innerHTML + M_Player.player;
                } else {
                    M_Player.current_step.innerHTML = M_Player.current_step.innerHTML + M_Player.player;


                }
                step_sound.play();
                M_Player.current_position++;
            }


            await sleep(move_time)

        }
    }

    moveNow().then(() => {
        var kill_zone = steps[M_Player.path[M_Player.current_position - 1]];
        if (kill_zone.children.length > 1 && !safe_stops.includes(M_Player.path[M_Player.current_position - 1])) {
            // //console.log("you can kill someone");

            for (i = 0; i < kill_zone.children.length; i++) {
                var enemy = player_list[kill_zone.children[i].getAttribute("id")];

                if (kill_zone.children[i] != M_Player.player && enemy.color != M_Player.color) {

                    //console.log("you have a enemy in your zone");
                    //console.log("Enemy",kill_zone.children[i].getAttribute("id"));
                    //console.log("Enemy Dead Body",player_list[kill_zone.children[i].getAttribute("id")]);
                    $(enemy.home + " .white-box .player-room").append(enemy.player);
                    kill_zone.children[i].remove();
                    dead_sound.play();
                    enemy.resetplayer();
                    isPlayerIsMoving = false;
                    activateDice();
                    return 0;
                }
            }
        }


        if (rank_count > (turn_oder.length - 2)) {
            //console.log("game finished");
            deactivateDice();
            for (i = 0; i < turn_oder.length; i++) {
                if (getWinPlayers(turn_oder[i].players[0].home) != 4) {
                    //console.log(turn_oder[i].group + " is looser");
                    break;
                }
            }
            // stopTimer();
            // for(i=0;i<4;i++){
            //     var pl_rank = turn_oder[i].rank;
            //     var pl_name = turn_oder[i].group;
            //     pl_name = pl_name.toLowerCase();
            //     pl_name=pl_name.charAt(0).toUpperCase()+pl_name.slice(1);


            //     if(pl_rank==0){
            //      $("#r"+i).text(pl_name+" Player");
            //      var pllogo = $("#r4").parent().children()[0];
            //      $(pllogo).addClass("bg-"+pl_name.toLowerCase());

            //     }




            // }
            // $(".gameover").css("display","");

            return 0;
        }
        if (M_Player.status == 'win') {
            if (current_turn.rank > 0) {
                // console.log("game finished for " + M_Player.color);



                isPlayerIsMoving = false;
                activateDice();
                updateTurn(++current_turn_index);
                return 0;
            }
            // console.log("you just winned & getting an extra chance");
            isPlayerIsMoving = false;
            activateDice();
            $(M_Player.controller).attr("disabled", true);
            $(M_Player.controller).css("opacity", "0.6");
            $(M_Player.controller).css("background-color", "grey");
            return 0;
        }

        ////console.log("player is stopped running");

        if (dice_value != 6) {
            updateTurn(++current_turn_index);
        }
        if (six_count > 2) {
            //console.log("you got 3 sixes");
            updateTurn(++current_turn_index);
        }
        isPlayerIsMoving = false;
        activateDice();
    });


}

function activateDice() {
    $("#dice").css("opacity", "1");
    dice_value = 0;
    // $("#dice").css("background-image","url('assets/img/dice"+dice_value+".png')");
    $("#dice").html("<img src='assets/img/dice" + dice_value + ".png' class='dice'/>");

    // $("#dice").attr("class","d"+dice_value);
    // $("#dice_value").text("("+dice_value+")");
    // $("#dice").text("0");
    $("#dice").attr("disabled", false);
}
function deactivateDice() {
    // $("#dice").css("background-image","url('assets/img/dice"+dice_value+".png')");
    $("#dice").html("<img src='assets/img/dice" + dice_value + ".png' class='dice'/>");
    // $("#dice").attr("class","d"+dice_value);

    // $("#dice_value").text("("+dice_value+")");

    $("#dice").css("opacity", "0.5");
    $("#dice").attr("disabled", true);
}




$("#movered1").click(() => {
    if (current_turn.group != "RED") {
        // console.log("wait for your turn, please");
        return 0;
    }

    if (red_player_1.current_position + dice_value > red_player_1.path.length) {
        // console.log("dice value is too big for this player, try another player");
        // return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: red_player_1,
                player2: red_player_2,
                player3: red_player_3,
                player4: red_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(red_player_1, dice_value, steps);
});
$("#movered2").click(() => {
    if (current_turn.group != "RED") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (red_player_2.current_position + dice_value > red_player_2.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: red_player_1,
                player2: red_player_2,
                player3: red_player_3,
                player4: red_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(red_player_2, dice_value, steps);
});
$("#movered3").click(() => {
    if (current_turn.group != "RED") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (red_player_3.current_position + dice_value > red_player_3.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: red_player_1,
                player2: red_player_2,
                player3: red_player_3,
                player4: red_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(red_player_3, dice_value, steps);
});
$("#movered4").click(() => {
    if (current_turn.group != "RED") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (red_player_4.current_position + dice_value > red_player_4.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: red_player_1,
                player2: red_player_2,
                player3: red_player_3,
                player4: red_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(red_player_4, dice_value, steps);
});


$("#movegreen1").click(() => {
    if (current_turn.group != "GREEN") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (green_player_1.current_position + dice_value > green_player_1.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: green_player_1,
                player2: green_player_2,
                player3: green_player_3,
                player4: green_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(green_player_1, dice_value, steps);
});
$("#movegreen2").click(() => {
    if (current_turn.group != "GREEN") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (green_player_2.current_position + dice_value > green_player_2.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: green_player_1,
                player2: green_player_2,
                player3: green_player_3,
                player4: green_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(green_player_2, dice_value, steps);
});
$("#movegreen3").click(() => {
    if (current_turn.group != "GREEN") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (green_player_3.current_position + dice_value > green_player_3.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: green_player_1,
                player2: green_player_2,
                player3: green_player_3,
                player4: green_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(green_player_3, dice_value, steps);
});
$("#movegreen4").click(() => {
    if (current_turn.group != "GREEN") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (green_player_4.current_position + dice_value > green_player_4.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: green_player_1,
                player2: green_player_2,
                player3: green_player_3,
                player4: green_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(green_player_4, dice_value, steps);
});





$("#moveyellow1").click(() => {
    if (current_turn.group != "YELLOW") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (yellow_player_1.current_position + dice_value > yellow_player_1.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: yellow_player_1,
                player2: yellow_player_2,
                player3: yellow_player_3,
                player4: yellow_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(yellow_player_1, dice_value, steps);
});
$("#moveyellow2").click(() => {
    if (current_turn.group != "YELLOW") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (yellow_player_2.current_position + dice_value > yellow_player_2.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: yellow_player_1,
                player2: yellow_player_2,
                player3: yellow_player_3,
                player4: yellow_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(yellow_player_2, dice_value, steps);
});
$("#moveyellow3").click(() => {
    if (current_turn.group != "YELLOW") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (yellow_player_3.current_position + dice_value > yellow_player_3.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: yellow_player_1,
                player2: yellow_player_2,
                player3: yellow_player_3,
                player4: yellow_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(yellow_player_3, dice_value, steps);
});
$("#moveyellow4").click(() => {
    if (current_turn.group != "YELLOW") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (yellow_player_4.current_position + dice_value > yellow_player_4.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }

    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: yellow_player_1,
                player2: yellow_player_2,
                player3: yellow_player_3,
                player4: yellow_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });
    movePlayer(yellow_player_4, dice_value, steps);
});

$("#moveblue1").click(() => {

    if (current_turn.group != "BLUE") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (blue_player_1.current_position + dice_value > blue_player_1.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }

    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: blue_player_1,
                player2: blue_player_2,
                player3: blue_player_3,
                player4: blue_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });

    movePlayer(blue_player_1, dice_value, steps);
});


$("#moveblue2").click(() => {

    if (current_turn.group != "BLUE") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (blue_player_2.current_position + dice_value > blue_player_2.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }

    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: blue_player_1,
                player2: blue_player_2,
                player3: blue_player_3,
                player4: blue_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });

    movePlayer(blue_player_2, dice_value, steps);
});

$("#moveblue3").click(() => {

    if (current_turn.group != "BLUE") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (blue_player_3.current_position + dice_value > blue_player_3.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }

    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: blue_player_1,
                player2: blue_player_2,
                player3: blue_player_3,
                player4: blue_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });

    movePlayer(blue_player_3, dice_value, steps);
});

$("#moveblue4").click(() => {

    if (current_turn.group != "BLUE") {
        // console.log("wait for your turn, please");
        return 0;
    }
    if (blue_player_4.current_position + dice_value > blue_player_4.path.length) {
        // console.log("dice value is too big for this player, try another player");
        return 0;
    }
    
    $.ajax({
        data: {
            sharecode:sharecode,
            username:loginusername,
            color:current_turn.color,
            players:{
                player1: blue_player_1,
                player2: blue_player_2,
                player3: blue_player_3,
                player4: blue_player_4
            },
        },
        type: "post",
        url: "database/player_movement.php",
        processData: false,
        success: function(dataResult){
                var dataResult = JSON.parse(dataResult);
                if(dataResult.statusCode==200){
                    // console.log(dataResult);
                }
                else if(dataResult.statusCode==201){
                //    alert(dataResult);
                }
        }
    });

    movePlayer(blue_player_4, dice_value, steps);
});


$(".restartgame").click(() => {
    location.reload();
});

$(".player").click(function(e){
    if(current_turn.user == loginname){
        var messageJSON = {
            user: sharecode,
            action: 'move_player',
            data: {
                target:$(this).attr("data-attr"),
            }
        };
        websocket.send(JSON.stringify(messageJSON));
    }
});
