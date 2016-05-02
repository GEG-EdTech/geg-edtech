<!DOCTYPE html>
<?php
        $host="localhost";
        $user="root";
        $password="";
        $dbname="mydb";
    $db = mysqli_connect($host,$user,$password,$dbname);
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
Ramo 1<br>
Ramo 2<br>
Ramo 3
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
