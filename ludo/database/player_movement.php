<?php 

ob_start();
session_start();

include '../config.php';
include '../functions/functions.php';

if(count($_POST)>0 && $_SESSION['user']['username'] == $_POST['username']){
    $sql = "UPDATE game_meta SET player1='".json_encode($_POST['players']['player1'])."', player2='".json_encode($_POST['players']['player2'])."', player3='".json_encode($_POST['players']['player3'])."', player4='".json_encode($_POST['players']['player4'])."' WHERE sharecode='".$_POST['sharecode']."' AND game_status='ingame' AND username='".$_POST['username']."' AND playercolor='".$_POST['color']."'";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("statusCode"=>200, "data"=>$_POST['players']['player1'], 'username'=>$_POST['username'], 'sharecode'=>$_POST['sharecode']));
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $conn->close();
}