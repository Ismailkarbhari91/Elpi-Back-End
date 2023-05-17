<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ludo </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="/ludo/assets/js/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="/ludo/assets/css/style.css" class="href">
    <link rel="icon" href="assets/img/dice.png">
    <?php if($_SESSION['valid'] == "inlobby" || $_SESSION['valid'] == "create_room" || $_SESSION['valid'] == "ingame"){  ?>
        <link rel="stylesheet" href="assets/css/main.css?version=<?=time()?>" type="text/css">
        <script src="assets/js/players.js?version=<?=time()?>"></script>
        <script>
            var websocket = new WebSocket("ws://parind.online:8090/demo/php-socket.php"); 
        </script>
    <?php } ?>
</head>
<body>
    <input type="hidden" id="login_name" value="<?php echo $_SESSION['user']['name'];?>">
    <input type="hidden" id="login_user_name" value="<?php echo $_SESSION['user']['username'];?>">
    <?php if($_SESSION['valid'] == "inlobby" || $_SESSION['valid'] == "create_room" || $_SESSION['valid'] == "ingame"){  ?>
        <input type="hidden" id="valid" value="<?php echo $_SESSION['valid'];?>">
        <input type="hidden" id="roomcode" value="<?php echo $_SESSION['sharecode'];?>">
    <?php } ?>


<div class="main">
        <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark p-3">
            <div class="container-fluid">
                <ul class="navbar-nav">
                <!-- Avatar -->
                <li class="nav-item dropdown">
                    <?php if($_SESSION['valid']){ ?>
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdownMenuLink"
                        role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                        <img src="/ludo/assets/img/gamer.png" class="rounded-circle"
                            height="40" alt="Avatar" loading="lazy" />
                            <span class="text-light ms-1"><?php echo $_SESSION['user']['name'];?></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <a class="dropdown-item text-decoration-none" href="/ludo?logout=true">Logout</a>
                            </li>
                            <li>
                                <a class="dropdown-item text-decoration-none" href="#" id="cancel_link">Cancel Game</a>
                            </li>
                        </ul>
                    <?php }else{?>
                        <a class="text-light text-decoration-none" href="/ludo">Login</a>
                    <?php }?>
                </li>
                </ul>
                <?php if($_SESSION['valid']){ ?>
                    <span class="navbar-text text-light">
                        <?php echo $_SESSION['user']['token_amount'];?>
                        <i class="fa-solid fa-circle-plus text-warning"></i>
                    </span>
                <?php }?>                    
            </div>
        </nav>
    </header>