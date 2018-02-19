<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
//Conectar base de datos
$conectar=@mysql_connect('localhost','srhotfai_david','5rHD@v1D20it');
//verficar
if(!$conectar){
	echo"No se pudo conectar a el servidor Data Base";
	}
else{
	$base=mysql_select_db('srhotfai_srhotelesdb');
	if (!$base){
		echo"No se encontro la base de datos";
		}
	}
//Fin Conexion
//inicia la session y los datos guardados en ellas
 session_start();
$usuario=$_SESSION['rsocial'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$hotelid=$_SESSION['hotelid'];
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");

}
?>

<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/IngresarHabitacion.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<title>Ingresa Habitacion - SRHoteles</title>
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<script src="../../Backend/JS/habbot.js"></script>
	<script type='text/javascript'>
                    function enviarForm(){
                        document.nameForm.submit();
                        }
                        </script>
</head>
<!--  ESTA LINEA DE CODIGO ESTABA HACIENDO QUE SE ENVIARA EL FORMULARIO AUTOMATICAMENTE Y VACIO
<body onLoad='javascript:enviarForm();'>-->
<body>
	<header class="BarraMenu" id="CabeceraSalida">
			<a  href="../../index.html"> <img src="../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
		</header>
		<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
		<header class="BarraMenu" id="CabeceraPrincipal">
			<a id="logoTemp" href="MenuAdminHotel.php">
				<h1 class="LC">SRH</h1>	
			</a>
		</header>
	<div class="Titulo">
		<h1 class="FR">FORMULARIO DE REGISTRO DE HABITACION</h1>
	<div class="CuadroExt">
	<!--<h3><div class="BarraTexto">USUARIO:  	<?php echo $usuario; ?>-->
	<form name="nameForm" action="../../Backend/PHP/ingresarhabitacion.php" method="post" target="_blank">
		<h3>
			TIPO DE HABITACION:
			<select class="BarraTexto" id="th" type="text" name="tipohabitacion">
				<option value="simple">Simple</option>
				<option value="matrimonial">Matrimonial</option>
				<option value="twin">Twin</option>
				<option value="triple">Triple</option>
				<
			</select>
		<h3>
			ID Habitacion:
			<input class="BarraTexto" id="idhab" type="text" name="idhabitacion">
		</h3>
		<h3>
			COSTO HABITACION:
			<input class="BarraNumero" id="cost" type="text" name="costohabitacion">
		</h3>
		<input type="hidden" name="hotel" value=<?php echo $hotelid; ?>
		<p>
			<button class="boton" type="submit" >
				GUARDAR HABITACION
			</button>
		</p>
	</form>	
</body>
</html>
