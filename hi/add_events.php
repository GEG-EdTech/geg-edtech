
<?php

// Values received via ajax
$title = $_POST['title'];
$start = $_POST['start'];
$end = $_POST['end'];
$color = $_POST['color'];
$description = $_POST['description'];
// conexxion a la db			
try {
$bdd = new PDO('mysql:host=localhost;dbname=fullcalendar', 'root', '');
$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// insertar en db
$sql = "INSERT INTO evenement (title, start, end, color, description) VALUES ('$title', '$start', '$end', '$color', '$description')";
$bdd ->exec($sql);

}
catch(PDOException $e)
{
	echo $sql . "<br>" . $e->getMessage();
}
//enviar encodeado en json valor de id, para resolver bug de eliminar evento creado
try {
$sql2 = "SELECT id FROM evenement WHERE title='$title'";
$query2=$bdd ->query($sql2);
echo json_encode($query2->fetchAll(PDO::FETCH_ASSOC));
}
catch(PDOException $e)
{
	echo $sql2 . "<br>" . $e->getMessage();
}

$bdd = null;

?>
