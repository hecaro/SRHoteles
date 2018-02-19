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
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");

}
		
			
		
?>		

<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/MenuAdminHotel.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<title>Menu - SRHoteles</title>
</head>
	<body>
		<header class="BarraMenu" id="CabeceraSalida">
			<a  href="../../index.html"> <img src="../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
		</header>
		<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
		<header class="BarraMenu" id="CabeceraPrincipal">
			<a id="logoTemp">
				<h1 class="LC">SRH</h1>	
			</a>
		</header>
		<img class="Imagen" src="../Recursos/LogoTexto.png" alt="Cabezal" width="500" height="400" />
		<div class="contenedor" >
			<p>
			<button class="boton" id="hab" onclick="location='habitaciones.php'" >
				HABITACIONES
			</button>
			</p>
			<p>
			<button class="boton" id="IP" onclick="location='IngresarHuesped.php'" >
				INGRESAR HUESPEDES
			</button>
			</p>
			<p>
			<button class="boton" id="bres" onclick="location='BuscarRes.php'" >
				BUSCAR RESERVA
			</button>
			</p>
			<p>
			<button class="boton" id="cal" onclick="location='../../Backend/PHP/CALENDAR/index.php'" >
				CALENDARIO
			</button>
			</p>
			<p>
			<button class="boton" id="inf" onclick="location='reporte.php'" >
				REPORTES
			</button>
			</p>
			
		</div>
	</body>
</html>