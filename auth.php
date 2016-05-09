<?php
//incluir auth.php en todas las paginas seguras
session_start();
if(!isset($_SESSION["username"])){
header("Location: login.php");
exit(); }
?>
