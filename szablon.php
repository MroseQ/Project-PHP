<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MK.Games</title>
    <link href="styl.css" rel="stylesheet" text="text/css"> 
    
<body>
<?php 
if (isset($_SESSION["flash message"]) && $_SESSION["flash message"] === "Wylogowano"){
    echo "<ul><li> Wylogowano </li></ul>";
    session_unset();
    $_SESSION["user"] = null;
}
include_once 'config.php';
include 'db_functions.php';
$conn = db_connect();
?>
<div id="myModal" class="modal">

  <div class="modal-content">
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
    Nazwa użytkownika: <input style="margin-left: 20px; padding-right: 50px; font-size: 18px" type="text" name="htmluser"><br>
    Hasło: <input style="margin-left: 184px; padding-right: 50px; margin-top: 0px; font-size: 18px" type="password" name="htmlpassword"><br>
    <a href="Przypomnienie.php"> Zapomniałem hasła </a>
    <a style="margin-left: 5%"href="rejestracja.php"> Zajerestruj się </a>
    <button style="font-size: 18px; margin-left: 3%" type="submit" name="zaloguj">Zaloguj się</button>

    </form>
  </div>

</div>

<?php 
            $sql = null;
            $msgs = [];
        $_SESSION['flash message'] = "";
        if ($_SESSION['flash message']) {
          $msgs[] = $_SESSION['flash message'];
          unset($_SESSION['flash message']);
        }
        if (isset($_POST["zaloguj"])){
        if ($_SESSION["user"] == null){ 
        if ($_SERVER["REQUEST_METHOD"] === 'POST'){
            $password = $_POST['htmlpassword'];
            $sql = "SELECT * FROM `uzytkownik` WHERE `Nazwa_Użytkownika` LIKE \"{$_POST['htmluser']}\"";
             $user = db_fetch_single($conn, $sql);
             if ($user == null){
                $msgs[] = "Wpisano złą nazwę użytkownika!";
            } else if ($password !== $user['Hasło_Użytkownika']){
                $msgs[] = "Wpisano złe hasło!";
                $user = null;
            } else {
                header("Location: index.php");
                $msgs[] = "Pomyślnie zalogowano!";
                $_SESSION['user'] = $_POST['htmluser'];
                $_SESSION['password'] = $_POST['htmlpassword'];
                $sql = "SELECT `E-mail` FROM `uzytkownik` WHERE `Nazwa_Użytkownika` LIKE \"{$_POST['htmluser']}\"";
                $_SESSION['email'] = $user["E-mail"];
                $_SESSION['userid'] = $user["ID_Użytkownika"];
                
    }}
  } }

  if ($msgs !== []) {
    echo "<ul>";
    foreach ($msgs as $msg) {
        echo "<li>{$msg}</li>";
    }
    echo "</ul>";
    unset($msgs);
}

    echo '<div id="left_side">';
        if(!isset($_SESSION["user"]) || $_SESSION["user"] == null){
          echo '<button style= "margin-left: 5%; font-size: 20px; margin-top: 5%" id="myBtn" class="button"> Logowanie </button><br><br>';
        } else {
        echo '
        <p style= "margin-left: 5%;margin-bottom: 0%">Zalogowano jako: '; echo $_SESSION["user"]; echo'</p><br><br>
        <a style="text-decoration: none; margin-left: 5%; margin-top: 0%" href="profil.php"> Wyświetl profil </a><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        <a style= "margin-left: 5%;" href="logout.php"> Wyloguj się </a>';
        }
        ?>
      </div>
    <div id="logo_panel">
        <a href="index.php"> <img id="logo" src=logo.png> </a>
        <p style="text-align: left; margin-left: 15%"> <b> ^ -- Główna -- ^ </b> </p>
    </div>
</body>
<script type="text/javascript" src="java.js"></script> 