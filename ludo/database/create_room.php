<?php 

ob_start();
session_start();

include '../config.php';
include '../functions/functions.php';

if(count($_POST)>0){
    $sql = "UPDATE users SET token_amount=token_amount-100 WHERE username='".$_SESSION['user']['username']."'";

    if ($conn->query($sql) === TRUE) {
        $randomstring = generateRandomString();
        $sql1 = "INSERT INTO game_meta (username, sharecode, game_status, playercolor, player1, player2, player3, player4) VALUES ('".$_SESSION['user']['username']."', '$randomstring', 'inlobby', '".$_POST['choose_color']."', '', '', '', '')";

        if ($conn->query($sql1) === TRUE) {
            $_SESSION[$randomstring][$_POST['choose_color']]['player_name'] = $_SESSION['user']['name'];
            $_SESSION['user']['token_amount'] -= 100;
            $_SESSION['valid'] = "inlobby";
            $_SESSION['sharecode'] = $randomstring;

            echo json_encode(array("statusCode"=>200));
        } 
        else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }


    $conn->close();
}