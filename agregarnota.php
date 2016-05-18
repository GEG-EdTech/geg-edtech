<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    // se inicializa con la base y se busca toda la informacion que se ingreso
    // a traves de $_POST
    $nombreRamo=$_POST['ramo'];
                $nombreRamo = stripslashes($nombreRamo);
		$nombreRamo = mysql_real_escape_string($nombreRamo);
    $notaRamo=$_POST['notaramo'];
                $notaRamo = stripslashes($notaRamo);
		$notaRamo = mysql_real_escape_string($notaRamo);
    $pondNota=$_POST['pondnota'];
                $pondNota = stripslashes($pondNota);
		$pondNota = mysql_real_escape_string($pondNota);
    $userName = $_SESSION['username'];
                $userName = stripslashes($userName);
                $userName = mysql_real_escape_string($userName);
                
    // se busca informacion de la id sobre el usuario actual
    $queryId="SELECT id FROM users WHERE username='$userName'";
    $resultId = mysql_query($queryId);
    
    while ($fila = mysql_fetch_assoc($resultId)) {
        $id = $fila['id'];
    }
    
    // se busca informacion de la id sobre el ramo actual
    $queryIdRamo="SELECT id_ramo FROM ramo WHERE users_id='$id' and nombre_ramo='$nombreRamo'";
    $resultIdRamo = mysql_query($queryIdRamo);
    
    while ($fila = mysql_fetch_assoc($resultIdRamo)) {
        $idRamo = $fila['id_ramo'];
    }

    $query = "INSERT INTO nota (nota, ponderacion, ramo_id_ramo, ramo_users_id) VALUES ('$notaRamo', '$pondNota','$idRamo','$id')";
    $result = mysql_query($query);
        if($result){
            echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
        }
    else {
       echo "Error al agregar los datos";
       
    }
?>

