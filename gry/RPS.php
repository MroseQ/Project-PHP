<?php
include '../szablondir.php';
?>
<div id="gra" style="margin-left: 23%; margin-right:20%; border-width: 4px; border-style: solid; border-radius: 5px; background-color: #a1a5b0">
    <div class="tekst-górny" style="font-size:20px">
    <?php
    if (isset($_GET["wynik"])){
    $wynik = $_GET["wynik"];    
    echo "<p style='margin-left: 5%'<b>Koniec gry! Zdobyto {$wynik} pkt. Powodzenia następnym razem!</b>";
    $src = $_GET["src"];   
    $sql="SELECT * FROM `wynik` WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\" AND `ID_gra` LIKE '3'";
    $czyistnieje = db_fetch_single($conn, $sql);
    if ($czyistnieje == null){
        if ($wynik != 0) {
        $sql = "INSERT INTO `wynik` (`ID_Użytkownika`,`ID_gra`,`punkty_zdobyte`) VALUES (\"{$_SESSION["userid"]}\",3,\"{$wynik}\")";
        db_insert($conn,$sql);
    }}else{
    if ($czyistnieje["punkty_zdobyte"]<$wynik){
    if ($wynik != 0){
        $sql = "INSERT INTO `wynik` (`ID_Użytkownika`,`ID_gra`,`punkty_zdobyte`) VALUES (\"{$_SESSION["userid"]}\",3,\"{$wynik}\")";
        db_insert($conn,$sql);
        $sql = "DELETE FROM `wynik` WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\" AND `punkty_zdobyte` < \"{$wynik}\"";
        db_delete($conn,$sql);
    }}}} 
    ?>
    <a style="margin-left: 47%; text-shadow: 1px 1px black; font-size: 20px; color: yellow"href="../wyniki/RPS_Wyniki.php">Wyniki</a>
    <p style="text-align: center;"><b> Wykonaj swój ruch </b></p>
    <p style="margin-left: 3%"> Wynik: <span id="wynik_rps" style="text-align:right"><b>0</b></span> </p>
    <br>
    </div>
  <div class="wybory" style="margin-left: 19%">  
    <div class="wybór" style="display: inline-block; ">
        <img src="kamień.png" id="kamień" alt="">
        <img src="papier.png" id="papier" alt="">
        <img src="nożyce.png" id="nożyce" alt="">
    </div>
    </div>
    <div class="przeciwnik" style="display: inline-block;margin-left: 40%">
        <div class="outcome">
        <p style="margin-left: 9%"><b> Wybór przeciwnika:</b></p>
        <img src="<?php echo $src;?>" alt="Zacznij grę klikając na przycisk." id="wybór_przeciwnika">
        </div>
    </div>
</div>
<script src="rps.js" charset="utf-8"></script> 


