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
$busqhab=isset($_POST['busqhab']) ? $_POST['busqhab'] : "";

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
echo "<h3><div class=CuadroExt>";
echo "</br>";
echo" Informe Habitaciones</br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'ID HABITACION:  ' .$result['idhabitacion']. '</br>' ; 
echo 'TIPO HABITACION: '.$result['tipohabitacion'].'</br>' ; 
echo 'COSTO HABITACION: '.$result['costohabitacion'].'</br>' ; 
echo "STATUS: " .$result['status'].'</br>' ;  
echo "-------------------------------------------------------------------</br>";
echo "</form></h3>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}

//consulta LIKE para que bbusque algun contenido parecido en la consulta se coloca % antes y despues de la variable para que no importa que tengo antes o despues en el campo de la tabla sino que a consulta igualmente la reconozca
$consultusuario=("SELECT `costohabitacion`, `tipohabitacion`, `idhabitacion`,`idhotel`,`status` FROM `HABITACIONES` INNER JOIN  `USUARIO` ON  `idhotel` = `hotelid` WHERE  `rsocial` = '$usuario' AND `idhabitacion` LIKE '%$busqhab%' LIMIT 0 , 30");
$resultados=mysql_query($consultusuario) ;
?>
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
	<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminHotel.php">
			<h1 class="LC">SRH</h1>	
		</a>
	</header>
	
</br>
</br>



	<div class="Titulo">
	
		<h1 class="FR">HABITACIONES</h1>
		
		
		
	<div class="CuadroExt">
	<!--trae la variable que ocupa $SESSIONrsocial
	<h3><div class="BarraTexto">USUARIO:  <?php echo $usuario;?>!-->
	<!--se crea un link para que se cierre la sesion y asi no pueda volver a entrar sin colocar usuario y clave -->
		
	<!-- Inicio de Busqueda por ID-->
	<form action="../../Backend/PHP/buscarhabitacion.php" method="post">
		<h3>
			ID HABITACION
			<input class="BarraTextoUser" type="text" id="idhab" name="busqhab">
		
		<button class="boton" type="submit">
			Editar
		</button>
	
		
		
		
		
	
	<?php
	//bucle para que tom las filas de la consulta y los muestre dentro de la funcion
while ($fila=mysql_fetch_array($resultados)){
//se llama la funcion mostrardatos declarada en la linea 58
mostrardatos($fila);

}

}
else{
	header("location:../../index.html");
		}
		



?>
</h3>
</form>
</div>
</body>
</html>

