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
$hotelid=$consultusuario['hotelid'];
$_SESSION['hotelid']=$hotelid;
$_SESSION['rsocial']=$filasusuario['rsocial'];
$usuario=$_SESSION['rsocial'];


if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{


?>
<!doctype html>

		
	<!-- Inicio de Busqueda por ID--><!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/BuscarRes.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<title>BUSQUEDA RESERVAS CANCELADAS- SRHoteles</title>
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
	<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="MenuAdminHotel.php">
			<h1 class="LC">SRH</h1>	
		</a>
	</header>

	<div class="Titulo">
	
		<h1 class="FR">BUSQUEDA RESERVAS CANCELADAS</h1>
	<div class="CuadroExt">
	<!--trae la variable que ocupa $SESSIONrsocial
	<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>!-->
	<!--se crea un link para que se cierre la sesion y asi no pueda volver a entrar sin colocar usuario y clave -->
		
	<!-- Inicio de Busqueda por ID-->
	<form action="../../Backend/PHP/reportecanceladas.php" target="_blank" method="post">
		
		<h3>
			FECHA CHECKIN
			<input class="BarraTexto" id="into" type="datetime-local" name="checkinfr" placeholder="Fecha de Ingreso aaaa-mm-dd">
		</br>
			FECHA CHECKOUT
			<input class="BarraTexto" id="into" type="datetime-local" name="checkoutfr" placeholder="Fecha de Ingreso aaaa-mm-dd">
		</br>
			<button class="boton" type="submit" >
			BUSCAR
		</button>
		</form></br></h3>
	
	<?php
	}
	else{
	header("location:../../index.html");
		}
	session_write_close();
	?>
</body>
</html>