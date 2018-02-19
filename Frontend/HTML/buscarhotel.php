<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/BuscarRes.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<title>BUSQUEDA HOTEL - SRHoteles</title>
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
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
	<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");	
session_start();
$_SESSION['clave'];
$_SESSION['user'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];


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
//consulta para almacenar en las variable de sesion

$consultusuario=mysql_query("SELECT * FROM USUARIO WHERE usuarioh='$user' AND claveh='$clave'");
$filasusuario=mysql_fetch_array($consultusuario);
$_SESSION['rsocial']=$filasusuario['rsocial'];
$usuario=$_SESSION['rsocial'];


if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{


?>
	<div class="Titulo">
	
		<h1 class="FR">BUSQUEDA DE HOTEL</h1>
	<div class="CuadroExt">
	<!--trae la variable que ocupa $SESSIONrsocial
	<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>-->
		<!--se crea un link para que se cierre la sesion y asi no pueda volver a entrar sin colocar usuario y clave -->
		
	<!-- Inicio de Busqueda por ID-->
	<form action="../../Backend/PHP/buscarhotel.php" method="post">
		<h3>
			Razon Social
			<input class="BarraTextoUser" type="text" id="hab" name="busqhotel">
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
