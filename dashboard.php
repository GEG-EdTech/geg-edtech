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
<?php 
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $nombreramo=$_POST['ramo'];
                $nombreramo = stripslashes($nombreramo);
		$nombreramo = mysql_real_escape_string($nombreramo);
    echo $nombreramo;

?>


<form method="POST" action="eliminarramo.php">
   <input type="hidden" name="ramo" value="<?php echo $nombreramo; ?>">
   <input type="submit" value="Eliminar">
</form>

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

