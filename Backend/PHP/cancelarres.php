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
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminHotel.php">
			<h1 class="LC">SRH</h1>	
		</a>
	</header>
	<div class="Titulo">
	
		<h1 class="FR">RESERVA CANCELADA</h1>
	<div class="CuadroExt">
	
<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");	
//declaracion de variables de session
session_start();
$_SESSION['clave'];
$_SESSION['user'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
$identi=$_POST['ident'];
$idhabitacion=$_POST['idhabitacion'];

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
$muestra=mysql_query("SELECT * FROM  `REGISTRO_HUESPED` INNER JOIN  `USUARIO` ON  `hotel` =  `hotelid` WHERE  `ident` = '$identi' AND `rsocial`='$usuario' LIMIT 0 , 30");
$hotelid=$muestra['hotel'];
$cancelar=("UPDATE `REGISTRO_HUESPED` SET `stat`='cancelada' WHERE `ident`='$identi'");	
$query=mysql_query($cancelar);
$cancelar2=("UPDATE `HABITACIONES` SET `status`='libre' WHERE `idhabitacion`='$idhabitacion' ");
$query2=mysql_query($cancelar2);

$fila=mysql_query("SELECT * FROM  `REGISTRO_HUESPED` INNER JOIN  `USUARIO` ON  `hotel` =  `hotelid` WHERE  `ident` = '$identi' AND `rsocial`='$usuario' LIMIT 0 , 30");
//consulta para cancelar la solicitud enviada por el metodo post solicitud


//query para cuando se cancele o una reservacion se elimine el registro del calendario
$eventborrar=("DELETE `id`,`title`,`color`,`start`, `end`, `razonsocial`, FROM `events` WHERE `razonsocial`='$usuario' AND `title`='$idhabitacion'");
$borrar=mysql_query($eventborrar);


//query para la muestra de la reservacion cancelada
//declaracion de variables
	$ident=$fila['ident'];
	$encargado=$fila['encargado'];
	$nropers=$fila['nropers'];
	$cantsimp=$fila['cantsimp'];
	$nombre=$fila['nombrefr'];
	$thuesped=$fila['thuesped'];
	$referencia=$fila['referencia'];
	$paisfr=$fila['paisfr'];
	$ciudadfr=$fila['ciudadfr'];
	$telefonofr=$fila['telefonofr'];
	$mailfr=$fila['mailfr'];
	$checkin=$fila['checkin'];
	$checkout=$fila['checkout'];
	$nota=$fila['nota'];
	$stat=$fila['stat'];
	$cantsimp=$fila['cantsimp'];
	$cantmat=$fila['cantmat'];
	$canttwin=$fila['canttwin'];
	$canttri=$fila['canttri'];
//secra funcion para mostrar los datos 
function mostrardatos ($result) {
//condicion para saber si a funcion no es nula (forzarla)
if ($result !=NULL) {
echo "</br><h3>";
echo "Reserva Cancelada </br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'IDENTIDAD:  ' .$result['ident']. '</br>' ; 
echo 'NOMBRE:  ' .$result['nombrefr']. '</br>' ;
echo 'ENCARGADO: '.$result['encargado'].'</br>' ; 
echo 'NUMERO DE PERSONAS: '.$result['nropers'].'</br>' ; 
echo "TIPO DE HUESPED: " .$result['thuesped'].'</br>' ;  
echo "REFERENCIA: " .$result['referencia'].'</br>' ;
echo "PAIS: " .$result['paisfr'].'</br>' ;    
echo "CIUDAD: " .$result['ciudadfr'].'</br>' ;  
echo "TELEFONO: " .$result['telefonofr'].'</br>' ; 
echo "MAIL: " .$result['mailfr'].'</br>' ;   
echo "CHECKIN: " .$result['checkin'].'</br>' ;  
echo "CHECKOUT: " .$result['checkout'].'</br>' ;  
echo "SIMPLES: " .$result['cantsimp'].'</br>' ;  
echo "MATRIMONIALES: " .$result['cantmat'].'</br>' ; 
echo "TWIN: " .$result['canttwin'].'</br>' ;  
echo "TRIPLES: " .$result['canttri'].'</br>' ;  
echo "STATUS: " .$result['stat'].'</br>' ;  
echo "HABITACION: " .$result['habitacionid'].'</br>' ; 
echo "DIAS DE RESERVA: " .$result['diasreserva'].'</br>' ;   
echo "-------------------------------------------------------------------</br></h3>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}


	while ($result=mysql_fetch_array($fila)){
//se llama la funcion mostrardatos declarada en la linea 58
mostrardatos($result);
}

	
?>	
	
	</div>
	</body>
</html>