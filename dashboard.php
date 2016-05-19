<?php 
require('db.php');   //ingreso y conexion a la BBDD
include("auth.php"); //incluir auth.php en todas las paginas seguras?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Información</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" href="css/style.css" />
    <link href="jquery-ui.css" rel="stylesheet">

<!--Informacion sobre la pagina-->
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

<!--Informacion sobre el slider-->
<style>
.range-slider {
  margin: 0 0 0 0%;
}

.range-slider {
  width: 100%;
}

.range-slider__range {
  -webkit-appearance: none;
  width: calc(100% - (73px));
  height: 10px;
  border-radius: 5px;
  background: #d7dcdf;
  outline: none;
  padding: 0;
  margin: 0;
}
.range-slider__range::-webkit-slider-thumb {
  -webkit-appearance: none;
          appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #78b941;
  cursor: pointer;
  -webkit-transition: background .15s ease-in-out;
  transition: background .15s ease-in-out;
}
.range-slider__range::-webkit-slider-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-webkit-slider-thumb {
  background: #1abc9c;
}
.range-slider__range::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border: 0;
  border-radius: 50%;
  background: #78b941;
  cursor: pointer;
  -webkit-transition: background .15s ease-in-out;
  transition: background .15s ease-in-out;
}
.range-slider__range::-moz-range-thumb:hover {
  background: #1abc9c;
}
.range-slider__range:active::-moz-range-thumb {
  background: #1abc9c;
}

.range-slider__value {
  display: inline-block;
  position: relative;
  width: 60px;
  color: #fff;
  line-height: 20px;
  text-align: center;
  border-radius: 3px;
  background: #78b941;
  padding: 5px 10px;
  margin-left: 8px;
}
.range-slider__value:after {
  position: absolute;
  top: 8px;
  left: -7px;
  width: 0;
  height: 0;
  border-top: 7px solid transparent;
  border-right: 7px solid #70ae3c;
  border-bottom: 7px solid transparent;
  content: '';
}

::-moz-range-track {
  background: #78b941;
  border: 0;
}

input::-moz-focus-inner,
input::-moz-focus-outer {
  border: 0;
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

/*Control code*/
#stop:checked~.timer .numbers {animation-play-state: paused;}
#start:checked~.timer .numbers {animation-play-state: running;}
#reset:checked~.timer .numbers {animation: none;}

.moveten {
	/*The digits move but dont look good. We will use steps now
	10 digits = 10 steps. You can now see the digits swapping instead of 
	moving pixel-by-pixel*/
	animation: moveten 1s steps(10, end) infinite;
	/*By default animation should be paused*/
	animation-play-state: paused;
}
.movesix {
	animation: movesix 1s steps(6, end) infinite;
	animation-play-state: paused;
}

/*Now we need to sync the animation speed with time speed*/
/*One second per digit. 10 digits. Hence 10s*/
.second {animation-duration: 10s;}
.tensecond {animation-duration: 60s;} /*60 times .second*/

.milisecond {animation-duration: 1s;} /*1/10th of .second*/
.tenmilisecond {animation-duration: 0.1s;}
.hundredmilisecond {animation-duration: 0.01s;}

.minute {animation-duration: 600s;} /*60 times .second*/
.tenminute {animation-duration: 3600s;} /*60 times .minute*/

.hour {animation-duration: 36000s;} /*60 times .minute*/
.tenhour {animation-duration: 360000s;} /*10 times .hour*/

/*The stopwatch looks good now. Lets add some styles*/

/*Lets animate the digit now - the main part of this tutorial*/
/*We are using prefixfree, so no need of vendor prefixes*/
/*The logic of the animation is to alter the 'top' value of the absolutely
positioned .numbers*/
/*Minutes and Seconds should be limited to only '60' and not '100'
Hence we need to create 2 animations. One with 10 steps and 10 digits and
the other one with 6 steps and 6 digits*/
@keyframes moveten {
	0% {top: 0;}
	100% {top: -400px;} 
	/*height = 40. digits = 10. hence -400 to move it completely to the top*/
}

@keyframes movesix {
	0% {top: 0;}
	100% {top: -240px;} 
	/*height = 40. digits = 6. hence -240 to move it completely to the top*/
}


/*Lets use a better font for the numbers*/
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
<!--Se muestra el nombre del ramo seleccionado-->
<?php 
    require('db.php');  //ingreso y conexion a la BBDD
    include("auth.php"); //incluir auth.php en todas las paginas seguras
    $nombreramo=$_POST['ramo'];
                $nombreramo = stripslashes($nombreramo);
		$nombreramo = mysql_real_escape_string($nombreramo);
    echo "<h2>".$nombreramo."</h2>";
?>
<br>

<!--Mostrar el slider de la dificultad-->
<h4>Dificultad en el ramo:
<!--Se guarda la dificultad del alumno en el ramo -->
<form method="POST" action="agregardificultad.php">
    <input type="hidden" name="ramo" value="<?php echo $nombreramo; ?>">
    <div class="range-slider">
        <input class="range-slider__range" type="range" name="dificultad" min="0" max="10" value="5" style="width: 300px; height: 10px;">
        <span class="range-slider__value"></span>
    </div>
    <input type="submit" value="Guardar">
</form><br>

<!--Mostrar gráfico de rendimiento actual de alumno-->
<h4>Gráfico de rendimiento</h4><br>
<div id="progressbar"></div><br>

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
    <h4>Nota real: </h4>
    <?php
    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id' and ramo_id_ramo='$id_ramo'";
    $result_nota = mysql_query($query);
    while($row = mysql_fetch_array($result_nota)){ 
        $sumareal = $sumareal + ($row['nota'] * $row['ponderacion']);
    }
    echo $sumareal;
    ?><br><br>
    
<!--Mostrar promedio en el ramo del alumno-->
    <h4>Nota esperada con rendimiento actual: </h4>
    <?php
    $query = "SELECT nota, ponderacion FROM nota WHERE ramo_users_id='$id' and ramo_id_ramo='$id_ramo'";
    $result_nota = mysql_query($query);
    while($row = mysql_fetch_array($result_nota)){ 
        $sumaponderacion = $sumaponderacion + $row['ponderacion'];
        $sumanota = $sumanota + $row['nota'];
        $contador = $contador + 1;
        $suma = $suma + ($row['nota'] * $row['ponderacion']);
    }
    $nota = $sumanota / $contador;
    $restoponderacion= 1 - $sumaponderacion;
    $suma = $suma + ($nota * $restoponderacion);
    echo $suma;
    ?><br>

<!--Permitir agregar notas al ramo-->
    <br>
    <h4>Ingresar Nueva Nota</h4>
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
    </form><br>

<!--Vuelve al menu principal-->
<h4><a href="index.php">Inicio</a></h4>

</section>
 
<aside>
    <br>
    <!--Calendario-->
    
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

<!--Codigo para el slider input -->
<script>
function myFunction() {
    var x = document.getElementById("myRange").value;
    document.getElementById("demo").innerHTML = x;
}
var rangeSlider = function(){
  var slider = $('.range-slider'),
      range = $('.range-slider__range'),
      value = $('.range-slider__value');
    
  slider.each(function(){

    value.each(function(){
      var value = $(this).prev().attr('value');
      $(this).html(value);
    });

    range.on('input', function(){
      $(this).next(value).html(this.value);
    });
  });
};

rangeSlider();
</script>
</body>
</html>

