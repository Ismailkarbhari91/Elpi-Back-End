<div class="gameover" style="display:none">
        
        <div class="scoreboard">
        <h1>Game Over</h1>
            <div class="playerlist"><div class="player movered1 bg-red"></div><div id="r1">Red Player</div><img src="assets/img/crown1.png" class="icon2"/></div>
            <div class="playerlist"><div class="player movegreen1 bg-green"></div><div id="r2">Green Player</div><img src="assets/img/crown2.png" class="icon2"/></div>
            <div class="playerlist"><div class="player moveyellow1 bg-yellow"></div><div id="r3">Yellow Player</div><img src="assets/img/crown3.png" class="icon2"/></div>
            <div class="playerlist"><div class="player moveblue1 bg-blue"></div><div id="r4">Blue Player</div> Looser</div>

</div>
    </div>
  
 <main class="container mt-4">
<div class="ludo-board">
<div class="red-home red-home-bg bg-red super-center">
    <div class="white-box super-center">
   <div class="player-room">

</div>
    </div>
</div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="green-home green-home-bg bg-green super-center">
<div class="white-box super-center">
   <div class="player-room">

</div>
    </div>
</div>
<div class="step"></div>
<div class="step bg-green"></div>
<div class="step bg-green"></div>
<div class="step red-stop"></div>
<div class="step bg-green"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-green"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-green"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-green"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-red">
    
</div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="winner-home">
    <div class="rwh stack"></div>
    <div class="gwh stack"></div>
    <div class="bwh stack"></div>
    <div class="ywh stack"></div>

</div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step green-stop"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-red"></div>
<div class="step bg-red"></div>
<div class="step bg-red"></div>
<div class="step bg-red"></div>
<div class="step bg-red"></div>
<div class="step bg-yellow"></div>
<div class="step bg-yellow"></div>
<div class="step bg-yellow"></div>
<div class="step bg-yellow"></div>
<div class="step bg-yellow"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step blue-stop"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-yellow"></div>
<div class="step"></div>
<div class="blue-home bg-blue blue-home-bg super-center">
<div class="white-box super-center">
   <div class="player-room">

</div>
    </div>
</div>
<div class="step"></div>
<div class="step bg-blue"></div>
<div class="step"></div>
<div class="yellow-home yellow-home-bg bg-yellow super-center">
<div class="white-box super-center">
   <div class="player-room">

</div>
    </div>
</div>
<div class="step"></div>
<div class="step bg-blue"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-blue"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step bg-blue"></div>
<div class="step yellow-stop"></div>
<div class="step bg-blue"></div>
<div class="step bg-blue"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>
<div class="step"></div>




</div>

<div class="test_controller">
    <div class="topbar">
        <!-- <div class="timer">
            <img src="assets/img/clock.png" class="icon"/> 
            <span id="watch">00:00:00</span>
        </div> -->
        <div class="timer">Turn : <span class="current_turn">...</span>
           <span id="dice_value"></span>
        </div>
    </div>

  


    <!-- <button id="dic" class="d0" hidden></button> -->
    <button id="dice" class="d0"></button>
<div class="red_control control"> 
    <button id="movered1" class="players movered1 bg-red" hidden></button>
    <button id="movered2" class="players movered2 bg-red" hidden></button>
    <button id="movered3" class="players movered3 bg-red" hidden></button>
    <button id="movered4" class="players movered4 bg-red" hidden></button>

    <button class="player movered1 bg-red" data-attr="#movered1"></button>
    <button class="player movered2 bg-red" data-attr="#movered2"></button>
    <button class="player movered3 bg-red" data-attr="#movered3"></button>
    <button class="player movered4 bg-red" data-attr="#movered4"></button>
       
</div>

<div class="green_control control"> 
    <button id="movegreen1" class="players movegreen1 bg-green" hidden></button>
    <button id="movegreen2" class="players movegreen2 bg-green" hidden></button>
    <button id="movegreen3" class="players movegreen3 bg-green" hidden></button>
    <button id="movegreen4" class="players movegreen4 bg-green" hidden></button>

    <button class="player movegreen1 bg-green" data-attr="#movegreen1"></button>
    <button class="player movegreen2 bg-green" data-attr="#movegreen2"></button>
    <button class="player movegreen3 bg-green" data-attr="#movegreen3"></button>
    <button class="player movegreen4 bg-green" data-attr="#movegreen4"></button>
</div>
<div class="yellow_control control"> 
    <button id="moveyellow1" class="players moveyellow1 bg-yellow" hidden></button>
    <button id="moveyellow2" class="players moveyellow2 bg-yellow" hidden></button>
    <button id="moveyellow3" class="players moveyellow3 bg-yellow" hidden></button>
    <button id="moveyellow4" class="players moveyellow4 bg-yellow" hidden></button>

    <button class="player moveyellow1 bg-yellow" data-attr="#moveyellow1"></button>
    <button class="player moveyellow2 bg-yellow" data-attr="#moveyellow2"></button>
    <button class="player moveyellow3 bg-yellow" data-attr="#moveyellow3"></button>
    <button class="player moveyellow4 bg-yellow" data-attr="#moveyellow4"></button>
</div> 
<div class="blue_control control"> 
    <button id="moveblue1" class="players moveblue1 bg-blue" hidden></button>
    <button id="moveblue2" class="players moveblue2 bg-blue" hidden></button>
    <button id="moveblue3" class="players moveblue3 bg-blue" hidden></button>
    <button id="moveblue4" class="players moveblue4 bg-blue" hidden></button>

    <button class="player moveblue1 bg-blue"  data-attr="#moveblue1"></button>
    <button class="player moveblue2 bg-blue"  data-attr="#moveblue2"></button>
    <button class="player moveblue3 bg-blue"  data-attr="#moveblue3"></button>
    <button class="player moveblue4 bg-blue"  data-attr="#moveblue4"></button>

</div>

</div>

</main>