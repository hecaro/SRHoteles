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
session_start();
$_SESSION['rsocial'];
$usuario=$_SESSION['rsocial'];
$_SESSION['clave'];
$_SESSION['user'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
//consulta para almacenar en las variable de sesion


if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{


?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/BuscarHab.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title>BUSQUEDA HABITACION - SRHoteles</title>
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
</head>
<body>
	<header class="BarraMenu" id="CabeceraSalida">
			<a  href="../../index.html"> <img src="../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
		</header>
		<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel">
			<?php echo $usuario;?>
			</h2>
		</header>
		<header class="BarraMenu" id="CabeceraPrincipal">
			<a href="MenuAdminHotel" id="logoTemp">
				<h1 class="LC">SRH</h1>	
			</a>
		</header>
	<div class="Titulo">
		<h1 class="FR">BUSQUEDA DE HABITACION</h1>
	<div class="CuadroExt">
	
		
	<!-- Inicio de Busqueda por ID-->
	<form action="../../Backend/PHP/informehab.php" method="post">
		<h3>
			ID HABITACION
			<input class="BarraTextoUser" type="text" id="idhab" name="busqhab">
		</h3>
		<button class="boton" type="submit">
			Buscar
		</button>
	</form>
	<?php
	}
	else{
	header("location:../../index.html");
		}
	session_write_close();
	?>
</body>
</html>
