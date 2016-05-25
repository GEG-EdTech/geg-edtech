<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $nombreRamo=$_POST['nombreramo'];
                $nombreRamo = stripslashes($nombreRamo);
		$nombreRamo = mysql_real_escape_string($nombreRamo);
    $userName = $_SESSION['username'];
                $userName = stripslashes($userName);
                $userName = mysql_real_escape_string($userName);
    $queryId="SELECT id FROM users WHERE username='$userName'";
    $resultId = mysql_query($queryId);
    
    while ($fila = mysql_fetch_assoc($resultId)) {
        $id = $fila['id'];
    }
    
    // se inicializa con la base y se busca toda la informacion que se ingreso
    // a traves de $_POST
    
    $query = "INSERT INTO ramo (nombre_ramo, users_id) VALUES ('$nombreRamo', '$id')";
    $result = mysql_query($query);
        if($result){
            echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
        }
    else {
       echo "Error al agregar los datos";
       
    }
   ?>