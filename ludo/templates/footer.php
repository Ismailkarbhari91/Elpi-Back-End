
<?php 
    $conn->close();
?>
</div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <?php if($_SESSION['valid'] == "inlobby" || $_SESSION['valid'] == "create_room" || $_SESSION['valid'] == "ingame"){  ?>
        <script>
            var sharecode = $("#roomcode").val();
            var loginname = $("#login_name").val();
            var loginusername = $("#login_user_name").val();
            var steps = document.getElementsByClassName("step");
            var init_r = false;
            var step_sound = new Audio('assets/audio/step.mp3');
            var dead_sound = new Audio('assets/audio/dead.mp3');
            var inout_sound = new Audio('assets/audio/inout.mp3');
            var dice_sound = new Audio('assets/audio/dice.mp3');
            var winner_sound = new Audio('assets/audio/winner.mp3');
            var safe_stops = [19, 6, 5, 27, 52, 65, 66, 44];
            var hold_time = 350;
            var move_time = 300;
            var names = {
                red_player_name: null,
                green_player_name: null,
                blue_player_name: null,
                yellow_player_name: null,
            }
            var bot = {
                red: false,
                blue: false,
                green: false,
                yellow: false,
            }
            var rank_count = 0;
            var six_count = 0;
            var to_
            var turn_oder_lobby = [
                { group: 'RED', rank: 0, players: [red_player_1, red_player_2, red_player_3, red_player_4], user: '<?php echo $_SESSION[$_SESSION['sharecode']]['red']['player_name'];?>'},
                { group: 'GREEN', rank: 0, players: [green_player_1, green_player_2, green_player_3, green_player_4], user: '<?php echo $_SESSION[$_SESSION['sharecode']]['green']['player_name'];?>'},

                { group: 'YELLOW', rank: 0, players: [yellow_player_1, yellow_player_2, yellow_player_3, yellow_player_4], user: '<?php echo $_SESSION[$_SESSION['sharecode']]['yellow']['player_name'];?>'},
                { group: 'BLUE', rank: 0, players: [blue_player_1, blue_player_2, blue_player_3, blue_player_4], user: '<?php echo $_SESSION[$_SESSION['sharecode']]['blue']['player_name'];?>'},
            ];

            var turn_oder = [];
            var current_turn_index = 0;
            var current_turn = turn_oder[current_turn_index];
            var dice_value = 0;
            var isPlayerIsMoving = false;

        </script>
        <!-- <script src="/ludo/assets/js/timer.js?version=<?=time()?>"></script> -->
        <script src="/ludo/assets/js/logic.js?version=<?=time()?>"></script>
        <script src="/ludo/assets/js/autorun.js?version=<?=time()?>"></script>
        <script src="/ludo/assets/js/websocket.js"></script>
        <script src="/ludo/assets/js/lobby.js"></script>
        <script src="/ludo/assets/js/create_room.js"></script>

    <?php } ?>
    <script src="/ludo/assets/js/script.js"></script>
</body>
</html>
