<?php 

ob_start();
session_start();

include '../config.php';
include '../functions/functions.php';

if(count($_POST)>0){
    $sql = "UPDATE game_meta SET game_status='ingame' WHERE sharecode='".$_POST['sharecode']."' AND game_status='inlobby'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['valid'] = "ingame";

        echo json_encode(array("statusCode"=>200));
    } 
    else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    $conn->close();
}