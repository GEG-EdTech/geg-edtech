<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $nombreramo=$_POST['nombreramo'];
                $nombreramo = stripslashes($nombreramo);
		$nombreramo = mysql_real_escape_string($nombreramo);
    $username = $_SESSION['username'];
                $username = stripslashes($username);
                $username = mysql_real_escape_string($username);
    $query_id="SELECT id FROM users WHERE username='$username'";
    $result_id = mysql_query($query_id);
    
    while ($fila = mysql_fetch_assoc($result_id)) {
        $id = $fila['id'];
    }
    
    // se inicializa con la base y se busca toda la informacion que se ingreso
    // a traves de $_POST
    
    $query = "INSERT into ramo (nombre_ramo, users_id) VALUES ('$nombreramo', '$id')";
    $result = mysql_query($query);
        if($result){
            echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
        }
    else {
       echo "Error al agregar los datos";
       
    }
   ?>

