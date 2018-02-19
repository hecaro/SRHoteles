<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/BuscarRes.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
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
		<a  href="../../index.html"><img src="../../Frontend/Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
	</header>
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminSist.php">
			<h1 class="LC">SRH </h1>	
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
$consultinforme=mysql_query("SELECT * FROM USUARIO WHERE usuarioh!='$user'");

$_SESSION['rsocial'];
$usuario=$_SESSION['rsocial'];


if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{
function mostrardatos ($result) {
//condicion para saber si a funcion no es nula (forzarla)
if ($result !=NULL) {
echo "<h3><div class=CuadroExt>";
echo 'RAZON SOCiAL:  ' .$result['rsocial']. '</br>' ;
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'IDENTIFICACION: '.$result['identh'].'</br>' ;
echo 'TELEFONO: '.$result['telefono'].'</br>' ; 
echo "MAIL: " .$result['mail'].'</br>' ;  
echo "PAIS: " .$result['pais'].'</br>' ;
echo "PROVINCIA: " .$result['provincia'].'</br>' ;
echo "CIUDAD: " .$result['ciudad'].'</br>' ;
echo "DIRECCION: " .$result['direccion'].'</br>' ;
echo "-------------------------------------------------------------------</br>";
echo "</div></h3>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}

?>
	<div class="Titulo">
	
		<h1 class="FR">INFORME HOTELES</h1>
	<div class="CuadroExt">
	<!--trae la variable que ocupa $SESSIONrsocial
	<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>-->
		<!--se crea un link para que se cierre la sesion y asi no pueda volver a entrar sin colocar usuario y clave -->
		
	<!-- Inicio de Busqueda por ID-->
	
	<?php
	
	while($fila=mysql_fetch_array($consultinforme)){
	echo mostrardatos($fila);
}
	
	
	
	}
	else{
	header("location:../../index.html");
		}
	session_write_close();
	?>
</body>
</html>