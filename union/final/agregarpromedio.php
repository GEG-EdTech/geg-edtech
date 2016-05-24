<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $promedioEsperar=$_POST['promedioesperar'];
            $promedioEsperar = stripslashes($promedioEsperar);
            $promedioEsperar = mysql_real_escape_string($promedioEsperar);
    $ramo=$_POST['ramo'];
            $ramo = stripslashes($ramo);
            $ramo = mysql_real_escape_string($ramo);
    $userName = $_SESSION['username'];
                $userName = stripslashes($userName);
                $userName = mysql_real_escape_string($userName);
            
    $queryId="SELECT id FROM users WHERE username='$userName'";
    $resultId = mysql_query($queryId);

    while ($fila = mysql_fetch_assoc($resultId)) {
        $id = $fila['id'];
    }
    if(!$link){
        echo 'Error en la consulta';
    }
    
    else {
    //e hace update al curso, la fila que tiene el nombre curso seleccionado 
    $sql="UPDATE ramo SET promedio_objetivo='$promedioEsperar' WHERE nombre_ramo='$ramo' AND users_id='$id'"; 

    $result=mysqli_query($link, $sql);
        if($result){
            echo "Error <br>";
        }

    echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
    } 
?>

