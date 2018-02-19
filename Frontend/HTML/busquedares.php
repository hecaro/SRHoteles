	<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");	
session_start();
$usuario=$_SESSION['rsocial'];
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
$usuario=$filasusuario['rsocial'];
$hotelid=$filasusuario['hotelid'];
$busqid=isset($_POST['busqid']) ? $_POST['busqid'] : "";
$busqnomb=isset($_POST['nombrehuesped']) ? $_POST['nombrehuesped'] : "";
$busqref=isset($_POST['referenciahuesped']) ? $_POST['referenciahuesped'] : "";

if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{
function mostrardatos ($result) {
//condicion para saber si a funcion no es nula (forzarla)
if ($result !=NULL) {
echo "<h3><div class=CuadroExt>";
echo "</br>";
echo" RESERVACIONES</br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'ENCARGADO: ' .$result['encargado']. '</br>' ;
echo 'IDENTIFICACION:  ' .$result['ident']. '</br>' ; 
echo 'NOMBRE : '.$result['nombrefr'].'</br>' ; 
echo 'NUMERO DE PERSONAS: '.$result['nropers'].'</br>' ; 
echo "TIPO DE HUESPED: " .$result['thuesped'].'</br>' ;  
echo "REFERENCIA: " .$result['referencia'].'</br>' ; 
echo "PAIS: " .$result['paisfr'].'</br>' ; 
echo "CIUDAD: " .$result['ciudadfr'].'</br>' ; 
echo "TELEFONO: " .$result['telefonofr'].'</br>' ; 
echo "MAIL: " .$result['mailfr'].'</br>' ; 
echo "FECHA DE INGRESO: " .$result['checkin'].'</br>' ;
echo "FECHA DE SALIDA: " .$result['checkout'].'</br>' ; 
echo "HABITACIONES SIMPLES: " .$result['cantsimp'].'</br>' ; 
echo "HABITACIONES MATRIMONIALES: " .$result['cantmat'].'</br>' ; 
echo "HABITACIONES TWIN: " .$result['canttwin'].'</br>' ; 
echo "HABITACIONES TRIPLES: " .$result['canttri'].'</br>' ;
echo "ESTATUS: " .$result['stat'].'</br>' ;   
echo "NOTA: " .$result['nota'].'</br>' ; 
echo "-------------------------------------------------------------------</br>";
echo "</form></h3>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}


//consulta LIKE para que bbusque algun contenido parecido en la consulta se coloca % antes y despues de la variable para que no importa que tengo antes o despues en el campo de la tabla sino que a consulta igualmente la reconozca OR para que busque cualquiera de las condiciones que coloque el usuario en a pagina anterior
$consultusuario=("SELECT DISTINCT  `encargado` ,  `nombrefr` ,  `ident` ,  `hotel` ,  `hotelid` ,  `hotelid` ,  `nropers` ,  `thuesped` ,  `referencia` ,  `paisfr` , `ciudadfr` ,  `telefonofr` ,  `mailfr` ,  `checkin` ,  `checkout` ,  `cantsimp` ,  `cantmat` ,  `canttwin` ,  `canttri` ,  `stat` ,  `nota` 
FROM  `REGISTRO_HUESPED` 
INNER JOIN  `USUARIO` ON  `hotel` ='$hotelid'
INNER JOIN  `HABITACIONES` ON  `hotelid` ='$hotelid'
WHERE  `ident` LIKE  '%$busqid%'
OR  `nombrefr` LIKE  '%busqnomb%'
OR  `referencia` LIKE  '%$busqref%'
AND  `hotel` ='$hotelid'
LIMIT 0 , 30
");
  
$resultados=mysql_query($consultusuario) ;

?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/BuscarHab.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
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
		<h1 class="FR">BUSQUEDA DE RESERVA</h1>
	<div class="CuadroExt">
	<!--trae la variable que ocupa $SESSIONrsocial
	<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>!-->
	<!--se crea un link para que se cierre la sesion y asi no pueda volver a entrar sin colocar usuario y clave -->
		
	<!-- Inicio de Busqueda por ID-->
	<form action="../../Backend/PHP/BuscarRes.php" method="post">
		<h3>
			IDENTIFICACION
			<input class="BarraTextoUser" type="text" id="usuario" name="busqid">
		</h3>
		<button class="boton" type="submit">
			EDITAR
		</button>
		</form>
	<?php
	while ($fila=mysql_fetch_array($resultados)){
//se llama la funcion mostrardatos declarada en la linea 58
mostrardatos($fila);
}
	}
	session_write_close();
	?>
</body>
</html>