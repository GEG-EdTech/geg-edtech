<!DOCTYPE html>
<?php
        $host="localhost";
        $user="root";
        $password="";
        $dbname="mydb";
        $link = mysqli_connect($host,$user,$password,$dbname);
?>
<html>
<head>
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
    width:150px;
    float:left;
    padding:5px;	      
}
section {
    width:350px;
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
    <?php
         if(!$link){
            echo 'Error en la consulta';
        }
        else
            {
       
        $sql="select Nombre from ramos"; //selecciona el nombre de los ramos
        
        $result=mysqli_query($link, $sql);
        if(!$result){echo"Error";}
        echo'Ramos: <select name="ramo" >';
        while($row= mysqli_fetch_array($result,MYSQLI_ASSOC))
                { 
        foreach ($row as $key=>$dato)
            // se muestra todos los nombres de los ramos para poder seleccionarlos 
            {if($key=='name')
            {
                echo '<option value= "'.$dato.'"> '.$dato. '</option>';
            }
            }
                 }
            echo'</select> <br>';
        }
        ?>
        <br>
<form method="POST" action="nuevocurso.php">
Agregar Ramo: <input type="text" name="nombrecurso"><br>
<input type="submit" value="Guardar"><br>
Eliminar Ramo:
<?php   
         if(!$link){
            echo 'Error en la consulta';
        }
        else
            {
       
        $sql="select Nombre from ramos WHERE usuario_ID=ID.usuario"; //selecciona name de la tabla courses
        
        $result=mysqli_query($link, $sql);
        if(!$result){echo"Error";}
        echo'Ramo: <select name="ramo" >';
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
</form>

</nav>

<section>
<h1>Ramo1</h1>
<p>Informacion</p>
</section>
 
<aside>
    <p>Calendario</p>  
</aside>


<footer>
Copyright
</footer>

</body>
</html>
