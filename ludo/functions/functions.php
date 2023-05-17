<?php 

include 'database.php';

function get_name_from_username($username){
    global $conn;

    $check = "SELECT name FROM users WHERE username='".$username."'";
    $check_user = $conn->query($check);

    if ($check_user->num_rows > 0) {
        $result = $check_user->fetch_assoc();
        return $result['name'];
    }
    return false;    
}

function createTabs($tab_name, $tab_content) {
    include "./templates/tabs.php";
}

function generateRandomString($length = 10) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}

function login(){
    global $conn;
    $check = "SELECT * FROM users WHERE username='".$_POST['login_user_name']."' AND  password='".$_POST['login_password']."' ";
    $check_user = $conn->query($check);
    $result = $check_user->fetch_assoc();
    if ($check_user->num_rows > 0) {
        $check_game_query = "SELECT * FROM game_meta WHERE username='".$_POST['login_user_name']."' AND game_status='inlobby'";

        $check_game_query1 = "SELECT * FROM game_meta WHERE username='".$_POST['login_user_name']."' AND game_status='ingame'";

        $check_game_status = $conn->query($check_game_query);
        if ($check_game_status->num_rows > 0) {
            $check_game_result = $check_game_status->fetch_assoc();
            $_SESSION['valid'] = "inlobby";
            $_SESSION['sharecode'] = $check_game_result['sharecode'];
        }else if($conn->query($check_game_query1)->num_rows > 0){
            $check_game_result = $check_game_status->fetch_assoc();
            $_SESSION['valid'] = "ingame";
            $_SESSION['sharecode'] = $check_game_result['sharecode'];
        }
        else{
            $_SESSION['valid'] = "create_room";
        }
        $_SESSION['timeout'] = time();
        $_SESSION['user']['name'] = $result['name'];
        $_SESSION['user']['username'] = $result['username'];
        $_SESSION['user']['token_amount'] = $result['token_amount'];
        
    }
}

function registerUser(){
    global $conn;
    $name=$_POST['reg_full_name'];
    $username=$_POST['reg_user_name'];
    $password=$_POST['reg_password'];
    $date = date('Y-m-d h:i:s', time());

    $fetch = "SELECT username FROM users";
    $result = $conn->query($fetch);
    $db_username = '';

    if ($result->num_rows > 0) {
        foreach($result->fetch_all() as $row){
            $db_username .= $row[0].',';
        }
    }
    if(!in_array($username, explode(',', $db_username))){
        $sql = "INSERT INTO users (name, username, password, token_amount, created_at) VALUES ('$name', '$username', '$password', 10000, '$date')";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['valid'] = "create_room";
            $_SESSION['timeout'] = time();
            $_SESSION['user']['name'] = $name;
            $_SESSION['user']['username'] = $username;
            $_SESSION['user']['token_amount'] = 10000;
        } 

    }
}

function logout(){
    unset($_SESSION["valid"]);
    unset($_SESSION["timeout"]);
    unset($_SESSION["user"]);
    unset($_SESSION["player_color"]);
    header('Refresh: 0; URL = /ludo');    
}

function cancel_room(){
    global $conn;

    $sql = "UPDATE game_meta SET game_status='cancelled' WHERE sharecode='".$_GET['sharecode']."' AND game_status='inlobby' OR game_status='ingame'";
    if ($conn->query($sql) === TRUE) {
        $_SESSION['valid'] = "create_room";
        unset($_SESSION[$_GET['sharecode']]);
        unset($_SESSION['sharecode']);
        header('Refresh: 0; URL = /ludo');    
    }
}

// function createRoom(){
//     global $conn;

//     $sql = "UPDATE users SET token_amount=token_amount-100 WHERE username='".$_SESSION['login_user_name']."'";

//     if ($conn->query($sql) === TRUE) {
//         $randomstring = generateRandomString();
//         $sql1 = "INSERT INTO game_meta (username, sharecode, game_status, playercolor) VALUES ('".$_SESSION["login_user_name"]."', '$randomstring', 'inlobby', '".$_POST['choose_color']."')";
//         $conn->query($sql1);

//         $_SESSION['sharecode'] = $randomstring;
//         $_SESSION['amount_token'] -= 100;
//         $_SESSION['color'] = $_POST['choose_color'];
//         $_SESSION['valid'] = "inlobby";
//         $_SESSION['player_color'][$_POST['choose_color']] = $_SESSION['login_name'];

//     }
// }

function createlobby(){
    global $conn;

    $check = "SELECT * FROM game_meta WHERE sharecode='".$_SESSION['sharecode']."' AND  game_status='inlobby'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        foreach($result->fetch_all() as $row){
            $_SESSION[$_SESSION['sharecode']][$row[3]]['player_name'] = get_name_from_username($row[1]);
            $_SESSION['valid'] = 'inlobby';
        }
    }
    echo "<div class='lobby-main'>";
        include "./templates/lobby.php";
    echo "</div>";

}


function creategame(){
    global $conn;

    $check = "SELECT * FROM game_meta WHERE sharecode='".$_SESSION['sharecode']."' AND  game_status='ingame'";
    $result = $conn->query($check);

    if ($result->num_rows > 0) {
        foreach($result->fetch_all() as $row){
            $_SESSION[$_SESSION['sharecode']][$row[3]]['player_name'] = get_name_from_username($row[1]);
            $_SESSION['valid'] = 'ingame';
        }
    }
    echo "<div class='main-board'>";
        include "./templates/ludoboard.php";
    echo "<div>";

}

function joinroom(){
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
            $_SESSION[$_SESSION['sharecode']][$row[3]]['player_name'] = get_name_from_username($row[1]);
        }
        switch ($result->num_rows) {
            case 1:
                if($player_color['red'] != ''){
                    $player_color['yellow'] = $_SESSION['user']['name'];
                    $current_user_color = 'yellow';
                    $_SESSION[$_SESSION['sharecode']]['yellow']['player_name'] = $_SESSION['user']['name'];

                } else if($player_color['yellow'] != ''){
                    $player_color['red'] = $_SESSION['user']['name'];
                    $current_user_color = 'red';
                    $_SESSION[$_SESSION['sharecode']]['red']['player_name'] = $_SESSION['user']['name'];
                } else if($player_color['blue'] != ''){
                    $player_color['green'] = $_SESSION['user']['name'];
                    $current_user_color = 'green';
                    $_SESSION[$_SESSION['sharecode']]['green']['player_name'] = $_SESSION['user']['name'];
                } else if($player_color['green'] != ''){
                    $player_color['blue'] = $_SESSION['user']['name'];
                    $current_user_color = 'blue';
                    $_SESSION[$_SESSION['sharecode']]['blue']['player_name'] = $_SESSION['user']['name'];
                }
                break;
            case 2:
                if($player_color['red'] != '' && $player_color['yellow'] != ''){
                    $player_color['green'] = $_SESSION['user']['name'];
                    $current_user_color = 'green';
                    $_SESSION[$_SESSION['sharecode']]['green']['player_name'] = $_SESSION['user']['name'];
                } else if($player_color['blue'] != '' && $player_color['green'] != ''){
                    $player_color['red'] = $_SESSION['user']['name'];
                    $current_user_color = 'red';
                    $_SESSION[$_SESSION['sharecode']]['red']['player_name'] = $_SESSION['user']['name'];
                }
                break;
            case 3:
                if($player_color['red'] != '' && $player_color['yellow'] != '' && $player_color['green'] != ''){
                    $player_color['blue'] = $_SESSION['user']['name'];
                    $current_user_color = 'blue';
                    $_SESSION[$_SESSION['sharecode']]['blue']['player_name'] = $_SESSION['user']['name'];
                } else if($player_color['blue'] != '' && $player_color['green'] != '' && $player_color['red'] != ''){
                    $player_color['yellow'] = $_SESSION['user']['name'];
                    $current_user_color = 'yellow';
                    $_SESSION[$_SESSION['sharecode']]['yellow']['player_name'] = $_SESSION['user']['name'];
                }
                break;
            default:
                break;
        }

        $sql1 = "INSERT INTO game_meta (username, sharecode, game_status, playercolor) VALUES ('".$_SESSION['user']['username']."', '".$_POST["room_name_field"]."', 'inlobby', '".$current_user_color."')";

        $conn->query($sql1);
        
        $_SESSION['sharecode'] = $_POST['room_name_field'];
        $_SESSION['user']['token_amount'] -= 100;
        $_SESSION['valid'] = "inlobby";
    }
}

?>