<?php
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    // se inicializa con la base y se busca toda la informacion que se ingreso
    // a traves de $_POST
    $nombreramo=$_POST['ramo'];
                $nombreramo = stripslashes($nombreramo);
		$nombreramo = mysql_real_escape_string($nombreramo);
    $notaramo=$_POST['notaramo'];
                $notaramo = stripslashes($notaramo);
		$notaramo = mysql_real_escape_string($notaramo);
    $pondnota=$_POST['pondnota'];
                $pondnota = stripslashes($pondnota);
		$pondnota = mysql_real_escape_string($pondnota);
    $username = $_SESSION['username'];
                $username = stripslashes($username);
                $username = mysql_real_escape_string($username);
                
    // se busca informacion de la id sobre el usuario actual
    $query_id="SELECT id FROM users WHERE username='$username'";
    $result_id = mysql_query($query_id);
    
    while ($fila = mysql_fetch_assoc($result_id)) {
        $id = $fila['id'];
    }
    
    // se busca informacion de la id sobre el ramo actual
    $query_id_ramo="SELECT id_ramo FROM ramo WHERE users_id='$id' and nombre_ramo='$nombreramo'";
    $result_id_ramo = mysql_query($query_id_ramo);
    
    while ($fila = mysql_fetch_assoc($result_id_ramo)) {
        $id_ramo = $fila['id_ramo'];
    }
    
    //OJO PROBLEMAS PARA INGRESAR NOTA
    $query = "INSERT INTO nota (nota, ponderacion, ramo_id_ramo, ramo_users_id) VALUES ('$notaramo', '$pondnota','$id_ramo','$i')";
    $result = mysql_query($query);
        if($result){
            echo "<script type='text/javascript'> window.location='http://localhost/ingsoftware/index.php'; </script>";
        }
    else {
       echo "Error al agregar los datos";
       
    }
?>

