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
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/IngresarHotel.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<title>Registro - SRHoteles</title>
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
		<div>
		
			<h2 class="Login">REGISTRO</h2>
			<form action="../../Backend/PHP/IngresarHotel.php" method="post" target="_blank" id="Contenedor">
			
		<!-- la sentencia de php $_SESSION es para traer el dato guardado en la sesion php 
		<h3><class="BarraTexto" readonly="readonly">USUARIO:  <?php echo $usuario;?>-->
		
		
				<h3>
					R. SOCIAL
					<input class="BarraTextoNomb" type="text" name="rsocial">
				</h3>
				<h3>
					IDENT.
					<input class="BarraTextoIdent" type="text" name="identh">
				</h3>
				<h3>
					USUARIO
					<input class="BarraTextoUsuario" type="text" name="userh">
				</h3>
				<h3>
					CLAVE
					<input class="BarraTextoPass" type="password" name="claveh">
				</h3>
				<h3>
					CLAVE
					<input class="BarraTextoPass" type="password" name="claverep">
				</h3>
				<h3>
					TELF.
					<input class="BarraTextoTlfno" type="text" name="telefono">
				</h3>
				<h3>
					E-MAIL
					<input class="BarraTextoMail" type="text" name="mail">
				</h3>
				<h3>
					PAIS
					<input class="BarraTextoPais" type="text" name="pais">
				</h3>
				<h3>
				<h3>
					PROV.
					<input class="BarraTextoProv" type="text" name="prov">
				</h3>
				<h3>
					CIUDAD
					<input class="BarraTextoCity" type="text" name="city">
				</h3>
				<h3>
					DIRECC.
					<input class="BarraTextoDir" type="text" name="dir">
				</h3>
				<p>
				<button class="boton" type="submit" >
					GUARDAR
					</p>
				</button>
			</form>
		</div>
	
</body>
</html>
