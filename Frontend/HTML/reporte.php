<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/reporte.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<title>Menu Reportes - SRHoteles</title>
</head>
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
session_start();
$_SESSION['user'];
$_SESSION['clave'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
session_write_close();

?>
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
		<img class="Imagen" src="../Recursos/LogoTexto.png" alt="Cabezal" width="500" height="400" />
		<div class="contenedor">
			<p>
			<button class="boton" id="infr" onclick="location='../../Frontend/HTML/reportefechas.php'" >
				REPORTE DE RESERVAS
			</button>
			</p>
			<p>
			<button class="boton" id="infh" onclick="location='reportefechascanceladas.php'" >
				 REPORTE RESERVACIONES CANCELADAS
			</button>
			</p>
			<p>
			<button class="boton" id="flujo" onclick="location='flujocajaporfecha.php'" >
				FLUJO DE CAJA
			</button>
			</p>
			<p>
			<button class="boton" id="pocu" onclick="location='porcentaje.php'" >
				PORCENTAJE DE OCUPACION
			</button>
			</p>
			<p>
			<button class="boton" id="reping" onclick="location='ingresos.php'" >
				REPORTE DE INGRESOS
			</button>
			</p>
		</div>
	</body>
</html>