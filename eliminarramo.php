<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $ramo=$_POST['ramo'];
            $ramo = stripslashes($ramo);
            $ramo = mysql_real_escape_string($ramo);
    $username = $_SESSION['username'];
            $username = stripslashes($username);
            $username = mysql_real_escape_string($username);
    $query_id="SELECT id FROM users WHERE username='$username'";
    $result_id = mysql_query($query_id);

    while ($fila = mysql_fetch_assoc($result_id)) {
        $id = $fila['id'];
    }
    if(!$link){
        echo 'Error en la consulta';
    }
    
    else {
    //elimina el curso, la fila que tiene el nombre curso seleccionado 
    $sql="DELETE FROM ramo WHERE nombre_ramo='$ramo' AND users_id='$id'"; 

    $result=mysqli_query($link, $sql);
        if(!$result){
            echo "Error <br>";
        }

    echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
    } 
?>

