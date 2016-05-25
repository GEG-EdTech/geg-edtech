<?php

require('db.php');  //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras

$userName = $_SESSION['username'];
$userName = stripslashes($userName);
$userName = mysql_real_escape_string($userName);
$queryId = "SELECT id FROM users WHERE username='$userName'";
$resultId = mysql_query($queryId);
while ($fila = mysql_fetch_assoc($resultId)) {
    $id_u = $fila['id'];
}

// Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$color = $_POST['color'];
$description = $_POST['description'];

// conexxion a la db			
try {
    $bdd = new PDO('mysql:host=localhost;dbname=mydb', 'root', '');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// insertar en db
    $sql = "INSERT INTO fecha (title, start, end, color, description, users_id) VALUES ('$title', '$start', '$end', '$color', '$description','$id_u')";
    $bdd->exec($sql);
} 

catch (PDOException $e) {
    echo $sql . "<br>" . $e->getMessage();
}
//enviar encodeado en json valor de id, para resolver bug de eliminar evento creado
try {
    $sql2 = "SELECT id_fecha FROM fecha WHERE title='$title' AND users_id='$id_u' AND color='$color'";
    $query2 = $bdd->query($sql2);
    echo json_encode($query2->fetchAll(PDO::FETCH_ASSOC));
} 

catch (PDOException $e) {
    echo $sql2 . "<br>" . $e->getMessage();
}

$bdd = null;
?>
