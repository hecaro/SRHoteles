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
?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHabitacion.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title>Habitacion - SRHoteles</title>
	<style type="text/css">   
	a:link   
	{   
		text-decoration:none;   
	}
	</style>
	<script src="../../Backend/JS/habbot.js"></script>
	<script type='text/javascript'>
                    function enviarForm(){
                        document.nameForm.submit();
                        }
                        </script>
</head>
<!--  ESTA LINEA DE CODIGO ESTABA HACIENDO QUE SE ENVIARA EL FORMULARIO AUTOMATICAMENTE Y VACIO
<body onLoad='javascript:enviarForm();'>-->
<body>
	<header class="BarraMenu" id="CabeceraSalida">
		<a  href="../../index.html"><img src="../../Frontend/Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
	</header>
	<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminHotel.php"><h1 class="LC">SRH</h1></a>
	</header>
	<?php
$busqhab=isset($_POST['busqhab']) ? $_POST['busqhab'] : "";

//evalua en las variables de sesion hay algun resultado y prosigue con la sentencia
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){

//Ejecutar Sentencia 
$sqlsave=mysql_query("SELECT `costohabitacion`,`idhabitacion`,`tipohabitacion`,`status`,`idhotel`,`idhotel` FROM `HABITACIONES` INNER JOIN `USUARIO` ON `idhotel`=`hotelid` WHERE `idhabitacion`='$busqhab' ");
$sql=mysql_fetch_array($sqlsave);
$idhabitacion=$sql['idhabitacion'];
$tipohabitacion=$sql['tipohabitacion'];
$costohabitacion=$sql['costohabitacion'];
$statushabitacion=$sql['status'];
//cndicion si guada con la sentencia imprime el resultado
if($sqlsave){
	echo "<div class=Titulo><h1 class=FR>FORMULARIO DE EDICION HABITACION</h1><div class=CuadroExt>";
	//echo "<h3><div class=BarraTexto>USUARIO:  "; echo $usuario;
	echo "<form method=post target=_blank action=../../Backend/PHP/editarhabitacion.php>" ;
	echo "<h3>TIPO HABITACION:<input class=BarraTexto id=th type=text name=tipohabitacion value=$tipohabitacion></br></h3>";
	echo "<h3>  ID HABITACION:	<input class=BarraTexto id=idhab  type=text readonly=readonly name=idhabitacion value='$idhabitacion'></br></h3>";
	echo "<h3>COSTO HABITACION: <input class=BarraNumero id=costhab type=text name=costohabitacion value='$costohabitacion'></br></h3>";
	echo "<h3>ESTATUS HABITACION: <input class=BarraTexto id=stathab type=text name=statushabitacion value='$statushabitacion'</br></h3>";
	echo "<h3><button class=boton type=submit >
					EDITAR
				</button> </h3>";
	echo "</div>";
	echo "</form>";
}

else{
echo "no guardo";
die("Ha fallado el acceso a la base de datos: " . mysql_error());
}
}
?>

	
	
</body>
</html>
