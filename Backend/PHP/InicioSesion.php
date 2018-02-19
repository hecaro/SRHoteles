<?php

//recibe datos de formulario

$user=$_POST['user'];
$clave=$_POST['clave'];
if(isset($user)){

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

//inicia sesion
 session_start();

$_SESSION['user']=$user;
$_SESSION['clave']=$clave;
//consulta para comparar usuario y clave con la base de datos
$consulsql=mysql_query("SELECT * FROM USUARIO WHERE usuarioh='$user' and claveh='$clave'");
//variable para tomar la razon social obtenida por medio de la consulta consulsql de alli se extrae en variable de session ident, rsocial hotelid
$consulsqlu=mysql_fetch_array($consulsql);
$filas=mysql_num_rows($consulsql);
if ($filas>0 and $user==='admin'){
$_SESSION['ident'] = $consulsqlu['identh'];
$_SESSION['rsocial']=$consulsqlu['rsocial'];
$_SESSION['hotelid']=$consulsqlu['hotelid'];
//si es el administrador lleva a la vista de administrador
	header("location:../../Frontend/HTML/MenuAdminSist.php");
}	
else if ($filas>0 and $user !=='admin'){	
$_SESSION['ident'] = $consulsqlu['identh'];
$_SESSION['rsocial']=$consulsqlu['rsocial'];
$_SESSION['hotelid']=$consulsqlu['hotelid'];
//si es el administrador lleva a la vista de hotel
header("location:../../Frontend/HTML/MenuAdminHotel.php");		
}

else{
header("location:../../Frontend/HTML/InfoIngreso.html");
}
}
else{
header("location:../../Frontend/HTML/InfoIngreso.html");
}
session_write_close();


//mysqli_free_result($resultado);

?>