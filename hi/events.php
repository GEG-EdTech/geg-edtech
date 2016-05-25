<?php
// lista de eventos
 $json = array();

 // query para pedir los eventos
 $requete = "SELECT * FROM evenement ORDER BY id";

 // conexion a la db
 try {
 $bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', '');
 } catch(Exception $e) {
  exit('Unable to connect to database.');
 }
 // ejecutar query
 $resultat = $bdd->query($requete) or die(print_r($bdd->errorInfo()));

 // envia el resultado encodeado
 echo json_encode($resultat->fetchAll(PDO::FETCH_ASSOC));

?>
