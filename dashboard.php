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
  

</nav>

<section>
<br>
Visualizando ramos
<form method="POST" action="eliminarramo.php">
   
</form>
<p><a href="index.php">Home</a></p>
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

