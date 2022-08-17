<?php
include '../szablondir.php';
?>
<div id="tabela_FP" style="margin-left: 41%; font-size: 300%">
<?php
$scores = db_fetch_all($conn, "SELECT DISTINCT `uzytkownik`.`Nazwa_Użytkownika`,`wynik`.`punkty_zdobyte`
FROM `uzytkownik` INNER JOIN `wynik` ON `wynik`.`ID_Użytkownika`=`uzytkownik`.`ID_Użytkownika` WHERE `wynik`.`ID_gra` LIKE 3 GROUP BY `wynik`.`punkty_zdobyte` DESC");
        echo '
            <table border="4" style="background-color: yellow;" id="test">
            <thead><tr><th>Użytkownik</th><th style="text-align: center">Punkty</th></tr></thead>
            <tbody>';
            
            foreach ($scores as $score) {
            echo "<tr><td>{$score['Nazwa_Użytkownika']}</td><td style=\"text-align: center\">{$score['punkty_zdobyte']}</td></tr>";
            }
            echo "</tbody></table>"; 


?>
</div>