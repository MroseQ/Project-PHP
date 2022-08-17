<?php
include 'szablon.php';
// NIE MOZE BYC PUSTYCH! NIE MOGĄ SIE POWTARZAĆ
?>

<br>
<h1 style="margin-left:30%; color: darkgreen; font-size:250%">REJESTRACJA</h1>
<div id="rejestracja" style="font-size:275%; border-width: 7px; border-color:black; background-color: darkgreen; border-style: solid; margin-left: 30%; margin-right: 20%">
    <form style="margin-left:5%" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <br>
        <label> Twoja nazwa użytkownika:
        <input style="font-size:90%; width: 30%"type="text" name="cruser"></label> <br><br>
        <label> Twoje hasło użytkownika:
        <input style="font-size:90%; width: 30%; margin-left: 2.1%"type="text" name="crpassword"></label> <br><br>
        <label> Twój Email:
        <input style="font-size:90%; width: 30%; margin-left: 30.3%"type="email" name="cremail"> </label>
        <br><br>
        <button type="submit" style="font-size: 35px; flex : 1 0 auto; border-width: 5px; border-type:solid; background-color:#05af05; margin-left: 56.5%" name="utwórz"> Utwórz </button>
        <br><br>
    </form>
    <?php 
$wymagania = false;
if(isset($_POST["utwórz"])){
    $users = db_fetch_all($conn, "SELECT DISTINCT `Nazwa_Użytkownika`,`Hasło_Użytkownika`,`E-mail` FROM `uzytkownik`");
    foreach($users as $defUser){
    if ($_POST["cruser"] !== $defUser["Nazwa_Użytkownika"]){
    if ($_POST["cremail"] !== $defUser["E-mail"]){
    }else{
    echo "Taki email jest już używany!";
    $wymagania=true;
    }
    }else{
    echo "Taka nazwa użytkownika jest już używana!";
    $wymagania=true;
    }
    }
    if ($wymagania === false){
    if ($_POST["cremail"] !== ""){
    if ($_POST["cruser"] !== ""){
        unset($_POST["utwórz"]);
        $sql = "INSERT INTO `uzytkownik` (`Nazwa_Użytkownika`,`Hasło_Użytkownika`,`E-mail`) VALUES (\"{$_POST["cruser"]}\",\"{$_POST["crpassword"]}\",\"{$_POST["cremail"]}\")";
        echo '<p style="margin-left:5%"> Zarejestrowano! </p>';
        db_insert($conn,$sql);
    }else{
        echo "Taka nazwa użytkownika nie spełnia wymagań do rejestracji!";
    }
    }else{
        echo "Taki email nie spełnia wymagań do rejestracji!";
    }}}

 ?>    

</div>