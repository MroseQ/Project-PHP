<?php
session_start();
header('Location: index.php');
$_SESSION["flash message"] = 'Wylogowano';
?>