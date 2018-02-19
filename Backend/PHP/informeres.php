<!doctype html>
<html>
<head>
	<meta charset="utf8_spanish_ci">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title>Informe - SRHoteles</title>
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
	
</br>
</br>


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
	//toma las variables de sesion guardadas anteriormente
session_start();

$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");

}
//Fin Conexion
//error en 51 
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){
//secra funcion para mostrar los datos 
function mostrardatos ($result) {
//condicion para saber si a funcion no es nula (forzarla)
if ($result !=NULL) {
echo "</br>";
echo" Habitacion reservada</br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'ENCARGADO: ' .$result['encargado']. '</br>' ; 
echo 'NOMBRE: '.$result['nombrefr'].'</br>' ; 
echo 'IDENTIFICACION: '.$result['ident'].'</br>' ; 
echo "NUMERO PERSONAS: " .$result['nropers'].'</br>' ; 
echo 'CHECKIN: '  .$result['checkin'].'</br>' ; 
echo 'CHECKOUT: ' .$result['checkout'].'</br>' ; 
echo "-------------------------------------------------------------------</br>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}
//consulta
$consultusuario=("SELECT `encargado`,`nombrefr`,`ident`,`nropers`,`checkin`,`checkout`,`hotel`,`hotelid`,`rsocial` FROM `REGISTRO_HUESPED` INNER JOIN  `USUARIO` ON  `hotel` = `hotelid` WHERE `rsocial` = '$usuario' AND `stat`='reservado' LIMIT 0 , 30");
$resultados=mysql_query($consultusuario) ;
	//bucle para que tom las filas de la consulta y los muestre dentro de la funcion
while ($fila=mysql_fetch_array($resultados)){
//se llama la funcion mostrardatos declarada en la linea 58
mostrardatos($fila);
}
mysql_free_result($resultados);
}




?>
</div>
</body>
</html>

