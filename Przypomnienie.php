<?php
include 'szablon.php';
?>
<br>
<h1 style="margin-left:30%; color: darkgreen; font-size:250%">Przypominanie hasła</h1>
<div id="rejestracja" style="font-size:275%; border-width: 7px; border-color:black; background-color: #00abc2; border-style: solid; margin-left: 30%; margin-right: 20%">
    <form style="margin-left:5%" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <br>
        <label> Twoja nazwa użytkownika:
        <input style="font-size:90%; width: 30%"type="text" name="chkuser"></label> <br><br>
        <label> Twój Email:
        <input style="font-size:90%; width: 30%; margin-left: 30.3%"type="email" name="chkmail"> </label>
        <br><br>
        <button type="submit" style="font-size: 35px; flex : 1 0 auto; border-width: 5px; border-type:solid; background-color:#00abe3; margin-left: 56.5%" name="przypomnij"> 
        Przypomnij </button>
        <br><br>
    </form>
    <?php 
        
        if(isset($_POST["przypomnij"])){
            $sql = "SELECT `Nazwa_Użytkownika`,`Hasło_Użytkownika` FROM `uzytkownik` WHERE `Nazwa_Użytkownika` LIKE \"{$_POST["chkuser"]}\" AND `E-mail` LIKE \"{$_POST["chkmail"]}\"";
            $remembered_user = db_fetch_single($conn,$sql);
            if ($remembered_user !== null){ 
                if ($_SERVER["REQUEST_METHOD"] === 'POST'){
                    echo "<ul><li>Twoje hasło to: {$remembered_user["Hasło_Użytkownika"]} </ul></li>";  
                    unset($remembered_user);
                }
          } else {
              echo "<ul><li>Źle wpisana nazwa użytkownika bądź email</ul></li>";
              unset($remembered_user);
               }
             }
             unset($_POST["przypomnij"]);
        ?>
    </div>