<?php 
include 'szablon.php';
?>

<div style="border-width: 5px; border-style:solid; background-color: yellow; margin-left: 30%; margin-top:2%; margin-bottom:2%; margin-right:20%; display: flex" id="username">
    <p style="font-size: 35px; margin-left: 3%; flex: 0 0 auto; text-align:right"> Nazwa użytkownika:</p>
    <form style="flex: 0 0 auto"action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">  
        <input style="font-size: 35px; margin-top:6%;  flex : 1 0 auto" type="text" name="htmluser_updated" value='<?php echo $_SESSION["user"]?>'>
        <button style="font-size: 35px; flex : 1 0 auto; border-width: 5px; border-type:solid; background-color: #f6bf00" type="submit" name="zmien_użytkownika">Zmień</button>
        <?php 
         if (isset($_POST["zmien_użytkownika"])){
            unset($_POST["zmien_użytkownika"]);
         if($_POST["htmluser_updated"] === $_SESSION["user"]){
             echo "<ul><li> Nic nie zmieniono </ul></li>";
         } else if ($_POST["htmluser_updated"] === null || $_POST["htmluser_updated"] === ""){
             echo "<ul><li> Ale nazwa użytkownika by się przydała ;) </ul></li>";
         } else {
             $sql = "UPDATE `uzytkownik` SET `Nazwa_Użytkownika`=\"{$_POST["htmluser_updated"]}\" WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\";";
             db_update($conn,$sql);
             $_SESSION["user"] = $_POST["htmluser_updated"];
             echo "<ul><li> Zmieniono nazwę użytkownika </ul></li>";
             header('Location: profil.php');
         }}
        ?>
    </form>
</div>

<br>
<div style="border-width: 5px; border-style:solid; background-color: yellow; margin-left: 30%; margin-top:2%; margin-bottom:2%; margin-right:20%; display: flex" id="chpassword">
    <p style="font-size: 35px; margin-left: 3%; flex: 0 0 auto; text-align:right"> Hasło:</p>
    <form style="flex: 0 0 auto; margin-left: 22%"action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">  
        <input style="font-size: 35px; margin-top:6%;  flex : 1 0 auto" type="text" name="htmlpassword_updated" value='<?php echo $_SESSION["password"]?>'>
        <button style="font-size: 35px; flex : 1 0 auto; border-width: 5px; border-type:solid; background-color: #f6bf00" type="submit" name="zmien_hasło">Zmień</button>
        <?php 
         if (isset($_POST["zmien_hasło"])){
            unset($_POST["zmien_hasło"]);
         if($_POST["htmlpassword_updated"] === $_SESSION["password"]){
             echo "<ul><li> Nic nie zmieniono </ul></li>";
         } else if ($_POST["htmlpassword_updated"] === null || $_POST["htmlpassword_updated"] === ""){
             echo "<ul><li> Ale hasło by się przydało ;) </ul></li>";
         } else {
             $sql = "UPDATE `uzytkownik` SET `Hasło_Użytkownika`=\"{$_POST["htmlpassword_updated"]}\" WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\";";
             db_update($conn,$sql);
             $_SESSION["password"] = $_POST["htmlpassword_updated"];
             echo "<ul><li> Zmieniono hasło </ul></li>";
             header('Location: profil.php');
         }}
        ?>
    </form>
</div>
<br>
<div style="border-width: 5px; border-style:solid; background-color: yellow; margin-left: 30%; margin-top:2%; margin-bottom:2%; margin-right:20%; display: flex" id="email">
    <p style="font-size: 35px; margin-left: 3%; flex: 0 0 auto"> Email:</p>
    <form style="flex: 0 0 auto; margin-left: 21.5%"action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">  
        <input style="font-size: 35px; margin-top:6%;  flex : 1 0 auto" type="text" name="htmlemail" value='<?php echo $_SESSION["email"]?>' disabled>
    </form>
</div>
<br>
<div style="margin-left: 33%;"> 
         <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
         <button type="submit" name="usuń" style="border: none;color: red; text-decoration: underline;font-size: 30px; background-color: transparent; text-shadow: black 1px 1px"> 
         Usuń konto </button> </form>
         <br>
         <br>
</div>
<?php 
if (isset($_POST["usuń"])){
    unset($_POST["usuń"]);
    $usuwane = $_SESSION["userid"];
    session_unset();
    $_SESSION["user"] = null;
    $_SESSION["flash message"] = "Usunięto konto!";
    $sql = "DELETE FROM `wynik` WHERE `ID_Użytkownika` = {$usuwane}";
    db_delete($conn,$sql);
    $sql = "DELETE FROM `uzytkownik` WHERE `ID_Użytkownika` = {$usuwane}";
    db_delete($conn,$sql);
    header('Location: index.php');
}
?>