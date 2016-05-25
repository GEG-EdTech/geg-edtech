<?php
//ingreso y conexion a la BBDD
$host="localhost";
$user="root";
$password="";
$dbname="mydb";
$connection = mysql_connect($host,$user,$password);
if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysql_select_db('mydb');
if (!$select_db){
    die("Database Selection Failed" . mysql_error());
}
$link=mysqli_connect($host,$user,$password,$dbname);
?>