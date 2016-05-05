<?php
error_reporting(E_ALL ^ E_WARNING);
        $host="localhost";
        $user="root";
        $password="";
        $dbname="mydb";
        $link=mysqli_connect($host,$user,$password,$dbname);
        $nombrecurso=$_POST['nombrecurso'];
        
        if(!$link){
            echo '¡No conectado!'; //revisa si la coneccion con la base de dato funciona
        }
        else {
        
        $q="SELECT MAX(ID) AS MAX_ID FROM ramos";  //se busca el ultimo id de la tabla de courses
        $result=mysqli_query($link, $q);
        
        while($row= mysqli_fetch_array($result,MYSQLI_ASSOC)){ 
        //busca todas las filas y retorna un arreglo con los datos
        //assoc --> asociativo: no repite las columnas           
        foreach ($row as $dato){
              $datoq=$dato;
        }
        }
        
        $datoq=$datoq+1; //se le suma al ultimo id de la tabla courses
        
        $sql="INSERT INTO ramos (ID,Nombre,Dificultad,usuario_ID) VALUES('$datoq','$nombrecurso','0','$usuarioID')"; 
        //se inserta el nuevo curso a la base de datos en la tabla
        mysqli_query($link, $sql);
        
        echo"Felicidades, se ha creado el ramo con exito.";
        }
        
        //
        //
        //falta agregar ID de usuario
        //
        //
        
       ?>
<br><a href="index.php">Volver</a>
