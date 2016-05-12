<?php 
require('db.php');   //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="css/style.css" />
<style>
header {
    background-color:black;
    color:white;
    text-align:center;
    padding:5px;	 
}
nav {
    line-height:30px;
    background-color:#eeeeee;
    height:300px;
    width:230px;
    float:left;
    padding:5px;	      
}
section {
    width:450px;
    float:left;
    padding:10px;	 	 
}
footer {
    background-color:black;
    color:white;
    clear:both;
    text-align:center;
    padding:5px;	 	 
}
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    text-align: center;
}
th, td {
    padding: 5px;
}
</style>
</head>
<body>

<header>
</header>

<nav>
  <br>
    <form method="POST" action="dashboard.php">
        
        <?php
        
         if(!$link){
            echo 'Error en la consulta';
        }
        else
            {
        //busca el ID del usuario de la session
        $username = $_SESSION['username'];
                $username = stripslashes($username);
                $username = mysql_real_escape_string($username);
        $query_id="SELECT id FROM users WHERE username='$username'";
        $result_id = mysql_query($query_id);

        while ($fila = mysql_fetch_assoc($result_id)) {
            $id = $fila['id'];
        }
        $sql="SELECT nombre_ramo FROM ramo WHERE users_id='$id'";  
        //selecciona los nombres de los ramos de la tabla ramo
        
        $result=mysqli_query($link, $sql);
        if(!$result){
            echo"Error";
        }
        echo'Nombre Ramo: <select name="ramo" >';
        while($row= mysqli_fetch_array($result))
                { 
        foreach ($row as $key=>$dato)
            
            {if($key=='name')
            {
                echo '<option value= "'.$dato.'"> '.$dato. '</option>';
            }
            }
                 }
            echo'</select> <br>';
        }
        ?>
        <input type="submit" value="Seleccionar">
         </form>
    
    Ingresar Nuevo Ramo<br>
    <form method="POST" action="agregarramo.php">
    Nombre Ramo: <input type="text" name="nombreramo"><br>
    <input type="submit" value="Guardar">
    </form>


</nav>

<section>
<br>
<!--Se muestra el nombre del ramo-->
<?php 
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $nombreramo=$_POST['ramo'];
                $nombreramo = stripslashes($nombreramo);
		$nombreramo = mysql_real_escape_string($nombreramo);
    echo $nombreramo;
?>
<br>
<!--Mostrar el slider de la dificultad-->

<!--Mostrar gráfico de rendimiento actual de alumno-->

<!--Mostrar las notas actuales en el ramo del alumno-->
<?php
    // se busca informacion de la id sobre el ramo actual
    $query_id_ramo="SELECT id_ramo FROM ramo WHERE users_id='$id' and nombre_ramo='$nombreramo'";
    $result_id_ramo = mysql_query($query_id_ramo);
    
    while ($fila = mysql_fetch_assoc($result_id_ramo)) {
        $id_ramo = $fila['id_ramo'];
    }

    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id' and ramo_id_ramo='$id_ramo'";
    $result_nota = mysql_query($query);

    echo "<table style='width:70%'>
    <tr>
    <th>Nota</th>
    <th>Ponderacion</th>
    </tr>";

    while($row = mysql_fetch_array($result_nota)){
    echo "<tr>";
    echo "<td>" . $row['nota'] . "</td>";
    echo "<td>" . $row['ponderacion'] . "</td>";
    echo "</tr>";
    }
    echo "</table><br>";
    ?>

<!--Mostrar promedio en el ramo del alumno-->
    Nota actual: <br>
    <?php
    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id' and ramo_id_ramo='$id_ramo'";
    $result_nota = mysql_query($query);
    while($row = mysql_fetch_array($result_nota)){ 
        $suma = $suma + ($row['nota'] * $row['ponderacion']);
    }
    echo $suma;
    ?><br>

<!--Permitir agregar notas al ramo-->
    <br>
    Ingresar Nueva Nota<br>
    <form method="POST" action="agregarnota.php">
    Nota: <input type="text" name="notaramo"><br>
    Ponderacion: <input type="text" name="pondnota"><br>
    <input type="hidden" name="ramo" value="<?php echo $nombreramo; ?>">
    <input type="submit" value="Guardar">
    </form>
<!--Elimina al ramo del alumno-->
    <form method="POST" action="eliminarramo.php">
       <input type="hidden" name="ramo" value="<?php echo $nombreramo; ?>">
       <input type="submit" value="Eliminar">
    </form>

<!--Vuelve al menu principal-->
<p><a href="index.php">Inicio</a></p>

</section>
 
<aside>
<br>
<a href="logout.php">Logout</a>
</aside>


<footer>
Copyright
</footer>

</body>
</html>

