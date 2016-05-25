<?php

$id = $_POST['id'];
// conexion db
try {
	$bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', '');
} catch(Exception $e) {
	exit('Unable to connect to database.');
}

//query de slq para borrar ramos

$sql = "DELETE from evenement WHERE id=".$id;
$q = $bdd->prepare($sql);
$q->execute();

?>