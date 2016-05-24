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

/* valores enviados por medio de ajax */
$id = $_POST['id'];
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];

// conexion a la db
try {
 $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
 } catch(Exception $e) {
exit('Unable to connect to database.');
}
 // actualizar db
$sql = "UPDATE fecha SET title=?, start=?, end=? WHERE id_fecha=? AND users_id='$id_u'";
$q = $bdd->prepare($sql);
$q->execute(array($title,$start,$end,$id));
?>