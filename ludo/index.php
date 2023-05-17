<?php


ob_start();
session_start();

require_once("/var/www/bagisto/ludo/config.php");
// require_once("functions/functions.php");

// print_r($_SESSION);

// if (isset($_POST['login']) && !empty($_POST['login_user_name']) && !empty($_POST['login_password'])) {
//     login();
// }

// if (isset($_POST['register']) && !empty($_POST['reg_full_name']) && !empty($_POST['reg_user_name']) && !empty($_POST['reg_password'])) {
//     registerUser();
// }

// if (isset($_GET['logout'])) {
//     logout();
// }

// if (isset($_GET['cancel_room'])) {
//     cancel_room();
// }

// if (isset($_POST['create_room_btn']) && !empty($_POST['choose_color']) && !$_SESSION['sharecode']) {
//     createRoom();
// }

// if (isset($_POST['join_room_btn']) && !empty($_POST['room_name_field']) && !$_SESSION['sharecode']) {
//     joinroom();
// }


// require_once("templates/header.php");
?>
<div class="page-content d-flex justify-content-center align-items-center">
    <!-- <div id="chat-box"></div> -->
    <?php
        $tab_content = $tab_name = array();

        if(!$_SESSION['valid']){ 
            $tab_name = array("login"=>"Login", "register"=>"Register");
            $tab_content = array("login"=>array(
                "form_fields"=> array(
                    array(
                        "label"=>"Username",
                        "name"=>"login_user_name",
                        "id"=>"user_name_field",
                        "type"=>"text",
                    ),
                    array(
                        "label"=>"Password",
                        "name"=>"login_password",
                        "id"=>"password_field",
                        "type"=>"password",
                    ),
                    array(
                        "label"=>"Login",
                        "name"=>"login",
                        "id"=>"create_login_btn",
                        "type"=>"submit",
                    )
                ),
            ), "register"=>array(
                "form_fields"=> array(
                    array(
                        "label"=>"Full Name",
                        "name"=>"reg_full_name",
                        "id"=>"reg_full_name_field",
                        "type"=>"text",
                    ),
                    array(
                        "label"=>"Username",
                        "name"=>"reg_user_name",
                        "id"=>"reg_user_name_field",
                        "type"=>"text",
                    ),
                    array(
                        "label"=>"Password",
                        "name"=>"reg_password",
                        "id"=>"reg_password_field",
                        "type"=>"password",
                    ),
                    array(
                        "label"=>"Register",
                        "name"=>"register",
                        "id"=>"create_register_btn",
                        "type"=>"submit",
                    )
                ),
            ));
            createTabs($tab_name, $tab_content);

        }else if($_SESSION['valid'] == "create_room"){ 
            $tab_name = array("login"=>"Create Room", "register"=>"Join Room");
            $tab_content = array("login"=>array(
                "form_fields"=> array(
                    array(
                        "label"=>"Choose Color",
                        "name"=>"choose_color",
                        "id"=>"choose_color",
                        "type"=>"select",
                        "value"=>array("red"=>"Red","green"=>"Green","yellow"=>"Yellow","blue"=>"Blue")
                    ),
                    array(
                        "label"=>"Create Room",
                        "name"=>"create_room_btn",
                        "id"=>"create_room_btn",
                        "type"=>"submit",
                    )
                ),
            ), "register"=>array(
                "form_fields"=> array(
                    array(
                        "label"=>"Room Code",
                        "name"=>"room_name_field",
                        "id"=>"room_name_field",
                        "type"=>"text",
                    ),
                    array(
                        "label"=>"Join Room",
                        "name"=>"join_room_btn",
                        "id"=>"join_room_btn",
                        "type"=>"submit",
                    )
                ),
            ));
            createTabs($tab_name, $tab_content);

        }else if($_SESSION['valid'] == "inlobby" || $_SESSION['valid'] == "ingame"){ 
            createlobby();
            creategame();
        }

    ?>
</div>

<?php
    require_once("/var/www/bagisto/ludo/templates/footer.php");

?>
