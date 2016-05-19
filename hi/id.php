<?php


// query para pedir eventos
$requete = "SELECT title,start FROM evenement WHERE start>CURRENT_DATE ORDER BY start LIMIT 1";

// conexion db
try {
	$bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', '');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}
// ejecutar query
$resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

// envia resultado encodeado al succes del ajax
echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));


?>