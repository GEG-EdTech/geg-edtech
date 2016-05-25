<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Registro</title>
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
    width:150px;
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
<?php
	require('db.php');
    // se requiere para incluir informacion en la BBDD
    if (isset($_POST['username'])){
        $userName = $_POST['username'];
	$eMail = $_POST['email'];
        $password = $_POST['password'];
		$userName = stripslashes($userName);
		$userName = mysql_real_escape_string($userName);
		$eMail = stripslashes($eMail);
		$eMail = mysql_real_escape_string($eMail);
		$password = stripslashes($password);
		$password = mysql_real_escape_string($password);
		$trnDate = date("Y-m-d H:i:s");
        $query = "INSERT into `users` (username, password, email, trn_date) VALUES ('$userName', '".md5($password)."', '$eMail', '$trnDate')";
        $result = mysql_query($query);
        if($result){
            echo "<div class='form'><h3>Fuistes registrado satisfactoriamente.</h3><br/>Has click aqui para <a href='login.php'>Ingresar</a></div>";
        }
    }else{
?>
<div class="form">
<h1>Registro</h1>
<form name="registration" action="" method="post">
<input type="text" name="username" placeholder="Nombre" required />
<input type="email" name="email" placeholder="Email" required />
<input type="password" name="password" placeholder="Clave" required />
<input type="submit" name="submit" value="Registrar" />
</form>
<p>¿Ya estas registrado? <a href='login.php'>Ingresa aqui!</a></p>
</div>
<?php } ?>
</section>
 
<aside>

</aside>

<footer>
Copyright
</footer>

</body>
</html>

