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
$usuario=$_SESSION['rsocial'];
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");
}
	
?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../CSS/MenuAdminSist.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<title>Menu Administrador - SRHoteles</title>
</head>
	<body>
	
		<header class="BarraMenu" id="CabeceraSalida">
			<a  href="../../index.html"><img src="../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
		</header>
		<header class="BarraMenu" id="CabeceraPrincipal">
			<a id="logoTemp" href="MenuAdminSist.php">
				<h1 class="LC">SRH</h1>	
			</a>
		</header>
		
		<img class="Imagen" src="../Recursos/LogoTexto.png" alt="Cabezal" width="500" height="400" />
		<div class="contenedor" >
			<p>
		<!-- la sentencia de php $_SESSION es para traer el dato guardado en la sesion php 
		<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>-->
		
		</p>
			<p>
			<button class="boton" id="IH" onclick="location='IngresarHotel.php'" >
				INGRESAR HOTEL
			</button>
			</p>
			<p>
			<button class="boton" id="EH" type="submit" onclick="location='buscarhotel.php'" >
				EDITAR HOTEL
			</button>
			</p>
			<p>
			<button class="boton" id="IA" type="submit" onclick="location='../../Backend/PHP/informehotel.php'">
				INFORMACION AFILIADOS
			</button>
			</p>
		</div>
	</body>
</html>