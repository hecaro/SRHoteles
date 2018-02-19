<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
//Conectar a la base de datos
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

//inicia la session y los datos guardados en ellas
 session_start();
$usuario=$_SESSION['rsocial'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$idhotel=$_SESSION['hotelid'];
session_write_close();

//Sentencia SQL Para almacenar variable
$tipohabitacion=$_POST['tipohabitacion'];
$idhabitacion=$_POST['idhabitacion'];
$costohabitacion=$_POST['costohabitacion'];
$hotel=$_POST['hotel'];
//evalua en las variables de sesion hay algun resultado y prosigue con la sentencia
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){

//Ejecutar Sentencia 
$sqlsave=mysql_query("INSERT INTO `HABITACIONES` (`costohabitacion`, `tipohabitacion`, `idhabitacion`,`idhotel`) 
VALUES ('$costohabitacion','$tipohabitacion','$idhabitacion','$hotel')");
//se crea variable de sesion con el id de la habitacion para pasarlo al formulario de resgistro de huesped y cuando guarde un huesped asigne el id de habitacion e usuario lo pueda escoger y asi guardar el status de esa habitacion
$_SESSION['idhabitacion']=$sqlsave['idhabitacion'];
//cndicion si guada con la sentencia imprime el resultado
if($sqlsave){
echo "</br>";
echo" Ingreso Habitacion</br>";
echo "-------------------------------------------------------------------</br>";
echo "ID HABITACION: ".$idhabitacion.'</br>' ; 
echo 'TIPO HABITACION: '.$tipohabitacion.'</br>' ; 
echo 'COSTO HABITACION: '.$costohabitacion.'</br>' ; 
echo "-------------------------------------------------------------------</br>";
}

else{
echo "no guardo";
die("Ha fallado el acceso a la base de datos: " . mysql_error());
}
}
?>