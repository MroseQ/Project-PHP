<?php
include '../szablondir.php';
?>
<div id="gra" style="margin-left: 23%; margin-right:20%; border-width: 4px; border-style: solid; border-radius: 5px; background-color: #a1a5b0">
    <div class="tekst-górny" style="font-size:20px">
    <?php
    if (isset($_GET["wynik"])){
        $koniec = $_GET["koniec"];
        if ($koniec==true){
        $wynik = $_GET["wynik"];   
        $sql="SELECT * FROM `wynik` WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\" AND `ID_gra` LIKE '1'";
        $czyistnieje = db_fetch_single($conn, $sql);
        if ($czyistnieje == null){
            if ($wynik != 0) {
            $sql = "INSERT INTO `wynik` (`ID_Użytkownika`,`ID_gra`,`punkty_zdobyte`) VALUES (\"{$_SESSION["userid"]}\",1,\"{$wynik}\")";
            db_insert($conn,$sql);
        }}else{
        if ($czyistnieje["punkty_zdobyte"]<$wynik){
        if ($wynik != 0){
            $sql = "INSERT INTO `wynik` (`ID_Użytkownika`,`ID_gra`,`punkty_zdobyte`) VALUES (\"{$_SESSION["userid"]}\",1,\"{$wynik}\")";
            db_insert($conn,$sql);
            $sql = "DELETE FROM `wynik` WHERE `ID_Użytkownika` LIKE \"{$_SESSION["userid"]}\" AND `punkty_zdobyte` < \"{$wynik}\"";
            db_delete($conn,$sql);
        }}}}} 
    ?>
    <a style="margin-left: 47%; text-shadow: 1px 1px black; font-size: 20px; color: yellow"href="../wyniki/TTT_Wyniki.php">Wyniki</a>
    <p style="text-align: center;"><b> Wykonaj swój ruch </b></p>
    <p style="margin-left: 3%; font-size: 25px"> Wynik: <span id="wynik_ttt" style="text-align:right"><b>0</b></span> </p>
    <br>
    </div>
        <div id="widokgry" style="margin-left: 20%; margin-right: 20%">  
        </div>
        <br>
</div>
<script src="ttt.js" charset="utf-8"></script> 