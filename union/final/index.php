<?php 
require("db.php");  //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Inicio</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="jquery-ui.css" rel="stylesheet">
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

<!--Informacion sobre el tiempo -->
<style>
* {margin: 0; padding: 0;}

.timer {
	padding: 5px;
	background: linear-gradient(top, #222, #444);
	overflow: hidden;
	display: inline-block;
	border: 2px solid #000000;
	border-radius: 5px;
	position: relative;
	
	box-shadow: 
		inset 0 -2px 10px 1px rgba(0, 0, 0, 0.75), 
		0 5px 20px -10px rgba(0, 0, 0, 1);
}

.cell {
	width: 0.60em;
	height: 40px;
	font-size: 35px;
	overflow: hidden;
	position: relative;
	float: left;
}

.numbers {
	width: 0.6em;
	line-height: 40px;
	font-family: digital, arial, verdana;
	text-align: center;
	color: #000000;
	
	position: absolute;
	top: 0;
	left: 0;
	
	text-shadow: 0 0 5px rgba(255, 255, 255, 1);
}

#timer_controls {
	margin-top: -5px;
}
#timer_controls label {
	cursor: pointer;
	padding: 5px 10px;
	background: #efefef;
	font-family: arial, verdana, tahoma;
	font-size: 11px;
	border-radius: 0 0 3px 3px;
}
input[name="controls"] {display: none;}

/*Panel de control*/
#stop:checked~.timer .numbers {animation-play-state: paused;}
#start:checked~.timer .numbers {animation-play-state: running;}
#reset:checked~.timer .numbers {animation: none;}

.moveten {
	/*Animacion de los digitos de a 10 digitos por 10 pasos*/
	animation: moveten 1s steps(10, end) infinite;
	/*Se crea una pausa a la animacion*/
	animation-play-state: paused;
}
.movesix {
	animation: movesix 1s steps(6, end) infinite;
	animation-play-state: paused;
}

/*Una animacion por segundo*/
/*Se crea el calculo de lo que significan 10 segundos*/
.second {animation-duration: 10s;}
.tensecond {animation-duration: 60s;}

/*Se crea el calculo de lo que significan milisegundos*/
.milisecond {animation-duration: 1s;} 
/*Se crea el calculo de lo que significan 10 milisegundos*/
.tenmilisecond {animation-duration: 0.1s;}
/*Se crea el calculo de lo que significan 100 milisegundos*/
.hundredmilisecond {animation-duration: 0.01s;}

/*Se crea el calculo de lo que significa un minuto*/
.minute {animation-duration: 600s;}
/*Se crea el calculo de lo que significan 10 minutos*/
.tenminute {animation-duration: 3600s;}

/*Se crea el calculo de lo que significa una hora*/
.hour {animation-duration: 36000s;} 
/*Se crea el calculo de lo que significan 10 hora*/
.tenhour {animation-duration: 360000s;} 

@keyframes moveten {
	0% {top: 0;}
	100% {top: -400px;} 
	}

@keyframes movesix {
	0% {top: 0;}
	100% {top: -240px;} 
}


/*Tipografia utilizada en los numeros*/
@font-face {
	font-family: 'digital';
	src: url('http://thecodeplayer.com/uploads/fonts/DS-DIGI.TTF');
	
}
</style>

</head>
<body>

<header>
</header>

<nav>
    <br>
    <!--Mostrar todos los ramos del alumno-->
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
        </form><br>
    
    <!--Ingresar nuevo ramo a la BBDD del alumno-->
    <h3>Ingresar Nuevo Ramo</h3>
    <form method="POST" action="agregarramo.php">
    Nombre Ramo: <input type="text" name="nombreramo"><br>
    <input type="submit" value="Guardar">
    </form>

</nav>

<section>
    <h1>Bienvenido <?php echo $_SESSION['username']; ?>!</h1><br>
    <!--Se muestra el promedio general del alumno-->
    <h3>Promedio general</h3><br>
    
    <h4>Promedio real: </h4>
    <?php
    //se busca en la BBDD cada nota con su respectiva ponderacion.
    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id'";
    $resultNota = mysql_query($query);
    while($row = mysql_fetch_array($resultNota)){ 
        $sumaReal = $sumaReal + ($row['nota'] * $row['ponderacion']);
    }
    echo $sumaReal;?><br><br>
    
    <h4>Promedio esperado con rendimiento actual: </h4>
    <?php
    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id'";
    $resultNota = mysql_query($query);
    while($row = mysql_fetch_array($resultNota)){ 
        $sumaPonderacion = $sumaPonderacion + $row['ponderacion'];
        $sumaNota = $sumaNota + $row['nota'];
        $contador = $contador + 1;
        $suma = $suma + ($row['nota'] * $row['ponderacion']);
    }
    $nota = $sumaNota / $contador;
    $restoPonderacion= 1 - $sumaPonderacion;
    $suma = $suma + ($nota * $restoPonderacion);
    echo $suma;
    ?><br><br>
    <!--Mostrar gráfico de rendimiento actual de alumno-->
    <h4>Gráfico de rendimiento</h4><br>
    <div id="progressbar"></div><br>
    
    <!--Nota que espero sacarme como promedio general-->
    
    
    
    
    
    
    
    
    <br><br><br><br><br><br><br><br><br>
</section>
 
<aside>
    <br>
    <!--Calendario-->
    <div>
    <iframe src="http://localhost/final/pruebas2.html">
    </iframe>
</div>
    <!--Tiempo de estudio-->
    Cuenta cuanto estudias de verdad <br>
    <input id="start" name="controls" type="radio" />
    <input id="stop" name="controls" type="radio" />
    <input id="reset" name="controls" type="radio" />
    <div class="timer">
            <div class="cell">
                    <div class="numbers tenhour moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell">
                    <div class="numbers hour moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell divider"><div class="numbers">:</div></div>
            <div class="cell">
                    <div class="numbers tenminute movesix">0 1 2 3 4 5 6</div>
            </div>
            <div class="cell">
                    <div class="numbers minute moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell divider"><div class="numbers">:</div></div>
            <div class="cell">
                    <div class="numbers tensecond movesix">0 1 2 3 4 5 6</div>
            </div>
            <div class="cell">
                    <div class="numbers second moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell divider"><div class="numbers">:</div></div>
            <div class="cell">
                    <div class="numbers milisecond moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell">
                    <div class="numbers tenmilisecond moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
            <div class="cell">
                    <div class="numbers hundredmilisecond moveten">0 1 2 3 4 5 6 7 8 9</div>
            </div>
    </div>
    <!-- Controladores del tiempo -->
    <div id="timer_controls"><br>
            <label for="start">Iniciar</label>
            <label for="stop">Detener</label>
            <label for="reset">Reiniciar</label>
    </div>
    <script src="http://thecodeplayer.com/uploads/js/prefixfree.js" type="text/javascript"></script>
    <br><br><a href="logout.php">Logout</a>
    
</aside>


<footer>
Copyright
</footer>
    
<!--Muestra caracteristicas sobre el grafico -->
<script src="external/jquery/jquery.js"></script>
<script src="jquery-ui.js"></script>
<script>
$( "#progressbar" ).progressbar({
	value: <?php echo $suma; ?>,
        min: 0, 
        max: 7
});
</script>

</body>
</html>
