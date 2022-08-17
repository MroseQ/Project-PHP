<?php 
include 'szablon.php';
    ?>
    <body>
      <div style="margin-left: 17%;margin-top: 1%;margin-right: 1%; background-color: #9966ff; border-width: 5px; border-style: solid; border-radius: 10px" id="choice">
       <?php 
       if(!isset($_SESSION["user"])){
         echo "Musisz być zalogowany by przeglądać stronę!";
         return;
       }else{
       }
       ?> 
        <a style="margin-left: 13%; text-shadow: 1px 1px green; font-size: 20px; color: yellow"href="wyniki/TTT_Wyniki.php">Wyniki</a>
        <a style="margin-left: 26%; text-shadow: 1px 1px green; font-size: 20px; color: yellow"href="wyniki/PTT_Wyniki.php">Wyniki</a>
        <a style="margin-left: 34%; text-shadow: 1px 1px green; font-size: 20px; color: yellow"href="wyniki/RPS_Wyniki.php">Wyniki</a>
        <br>
        <a style="margin-left: 6%"href="gry/TicTacToe.php">
        <img style="width: 18%; height: 18%;"src="TTT.png"></img>
        </a>
        <a style="margin-left: 12.5%"href="gry/PTT.php">
        <img style="width: 18%; height: 20%;"src="ptt.png"></img>
        </a>
        <a style="margin-left: 19%"href="gry/RPS.php">
        <img style="width: 18%; height: 18%;"src="RPS.png"></img>
        </a>
        <br>
          <div style="display: flex;"id="teksty">
          <p style="flex: 1 0 auto; text-align: center; font-size: 30px; text-shadow: 1px 1px green">Kółko i krzyżyk</p>
          <p style="flex: 1 0 auto; text-align: center; padding-right: 3%; font-size: 30px; text-shadow: 1px 1px green">Pick the tenth</p>
          <p style="flex: 1 0 auto; text-align: center; font-size: 30px; text-shadow: 1px 1px green">Papier kamień nożyce!</p>
          </div>
      </div>
</body>
