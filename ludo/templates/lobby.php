<?php

    //  $_SESSION['player_color'] = array('red'=> '', 'green'=> '', 'yellow'=> '', 'blue'=> '');
    //  $_SESSION['player_color'][$_SESSION['color']] = $_SESSION['login_name'];
     $pi = 1;
?>

<div class="main_content pt-0" style="margin-top: -130px;">
    <div class="create_room">
    <div class="row">
        <h4 class="text-center p-2">Lobby</h4>
    </div>
    <div class="row">
        <form action="" method="POST">
            <div class="control3" > 
                <div class="lb flex-row">
                    <span id="room_name" class="f">
                        <label for="share_code">Share Code :</label>&nbsp;&nbsp;
                    </span>
                    <span class="f">
                        <input type="text" class="cun" id="share_code" readonly value="<?php echo $_SESSION['sharecode'];?>" style="width:168px;">
                    </span> 
                </div>
                <?php foreach($_SESSION[$_SESSION['sharecode']] as $player_key=>$player_value){ ?>
                    <div class="lb color_div flex-row" id="<?php echo $player_key;?>_user">
                        <button id="move-blue<?php echo $pi;?>" class="player playersel bg-<?php echo $player_key;?>"></button>&nbsp;&nbsp;&nbsp;
                        <span id="<?php echo $player_key;?>_player_name" class="f">
                            <input type="text" class="cun" value="<?php echo $player_value['player_name'];?>">
                        </span>
                    </div>
                <?php 
                        $pi++;
                    } ?>
            </div>
            <div class="super-center">
                <button class="main_btns" id="start_btn">Start Game</button>
                <button class="main_btns" id="cancel_bt">Cancel Game</button>
                <!-- <a class="main_btns text-decoration-none" href="/ludo?cancel_room=true">Cancel Game</a> -->
                <!-- <button id="start_btn" hidden>Start Game</button> -->
                <button id="loading_btn" style="display:none" disabled>
                    <div class="spinner-border text-danger" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </form>
    </div>

    <div class="row mb-4">
    </div>
    </div>
</div>