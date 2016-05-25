<?php
require('db.php');  //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras
  
$userName = $_SESSION['username'];
$userName = stripslashes($userName);
$userName = mysql_real_escape_string($userName);
$queryId="SELECT id FROM users WHERE username='$userName'";
$resultId = mysql_query($queryId);
while ($fila = mysql_fetch_assoc($resultId)) {
	$id_u = $fila['id'];
}

// query para pedir eventos
$requete = "SELECT title,start FROM fecha WHERE start>CURRENT_DATE AND users_id='$id_u' ORDER BY start LIMIT 1";

// conexion db
try {
	$bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
// ejecutar query
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

// envia resultado encodeado al succes del ajax
echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));


?>