<?php 

ob_start();
session_start();

include '../config.php';
include '../functions/functions.php';

if(count($_POST)>0){
    
    global $conn;

    $check = "SELECT * FROM game_meta WHERE sharecode='".$_POST['room_name_field']."' AND  game_status='inlobby'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        $sql = "UPDATE users SET token_amount=token_amount-100 WHERE username='".$_SESSION['user']['username']."'";
        $conn->query($sql);
        $player_color = array('red'=> '', 'green'=> '', 'yellow'=> '', 'blue'=> '');
        $current_user_color = '';
        foreach($result->fetch_all() as $row){
            $db_username .= $row[0].',';
            $player_color[$row[3]] = $row[1];
            $_SESSION[$_POST['room_name_field']][$row[3]]['player_name'] = $row[1];
        }
        switch ($result->num_rows) {
            case 1:
                if($player_color['red'] != ''){
                    $player_color['yellow'] = $_SESSION['login_name'];
                    $current_user_color = 'yellow';
                    $_SESSION[$_POST['room_name_field']]['yellow']['player_name'] = $_SESSION['login_name'];

                } else if($player_color['yellow'] != ''){
                    $player_color['red'] = $_SESSION['login_name'];
                    $current_user_color = 'red';
                    $_SESSION[$_POST['room_name_field']]['red']['player_name'] = $_SESSION['login_name'];
                } else if($player_color['blue'] != ''){
                    $player_color['green'] = $_SESSION['login_name'];
                    $current_user_color = 'green';
                    $_SESSION[$_POST['room_name_field']]['green']['player_name'] = $_SESSION['login_name'];
                } else if($player_color['green'] != ''){
                    $player_color['blue'] = $_SESSION['login_name'];
                    $current_user_color = 'blue';
                    $_SESSION[$_POST['room_name_field']]['blue']['player_name'] = $_SESSION['login_name'];
                }
                break;
            case 2:
                if($player_color['red'] != '' && $player_color['yellow'] != ''){
                    $player_color['green'] = $_SESSION['login_name'];
                    $current_user_color = 'green';
                    $_SESSION[$_POST['room_name_field']]['green']['player_name'] = $_SESSION['login_name'];
                } else if($player_color['blue'] != '' && $player_color['green'] != ''){
                    $player_color['red'] = $_SESSION['login_name'];
                    $current_user_color = 'red';
                    $_SESSION[$_POST['room_name_field']]['red']['player_name'] = $_SESSION['login_name'];
                }
                break;
            case 3:
                if($player_color['red'] != '' && $player_color['yellow'] != '' && $player_color['green'] != ''){
                    $player_color['blue'] = $_SESSION['login_name'];
                    $current_user_color = 'blue';
                    $_SESSION[$_POST['room_name_field']]['blue']['player_name'] = $_SESSION['login_name'];
                } else if($player_color['blue'] != '' && $player_color['green'] != '' && $player_color['red'] != ''){
                    $player_color['yellow'] = $_SESSION['login_name'];
                    $current_user_color = 'yellow';
                    $_SESSION[$_POST['room_name_field']]['yellow']['player_name'] = $_SESSION['login_name'];
                }
                break;
            default:
                break;
        }

        $sql1 = "INSERT INTO game_meta (username, sharecode, game_status, playercolor, player1, player2, player3, player4) VALUES ('".$_SESSION['user']['username']."', '".$_POST["room_name_field"]."', 'inlobby', '".$current_user_color."', '', '', '', '')";

        $conn->query($sql1);
        
        $_SESSION['sharecode'] = $_POST['room_name_field'];
        $_SESSION['user']['token_amount'] -= 100;
        $_SESSION['valid'] = "inlobby";

        echo json_encode(array("statusCode"=>200));

    }else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $conn->close();
}