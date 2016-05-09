<?php 
require('db.php');  //ingreso y conexion a la BBDD
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
    Ramo<br>
    <form method="POST" action="dashboard.php">
        
        <?php
        
         if(!$link){
            echo 'Error en la consulta';
        }
        else
            {
        $sql="SELECT nombre_ramo FROM ramo"; 
        //selecciona nombre de la tabla courses
        
        $result=mysqli_query($link, $sql);
        if(!$result){echo"Error";}
        echo'Nombre Ramo: <select name="ramo" >';
        while($row= mysqli_fetch_array($result,MYSQLI_ASSOC))
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
<p>Bienvenido <?php echo $_SESSION['username']; ?>!</p>
<p><a href="dashboard.php">Dashboard</a></p>
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
