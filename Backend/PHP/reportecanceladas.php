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
$checkin=$_POST['checkinfr'];
$checkout=$_POST['checkoutfr'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
session_write_close();
?>
<!doctype html>
<html>
<head>
	<meta charset="utf8_spanish_ci">
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title>Reporte resrvas Canceladas - SRHoteles</title>
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


<?php
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

ob_clean();
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,' HOTEL:  '.$usuario,1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Encargado: '.$resultado['encargado'],0,2,'L');
$ppdf->Cell(50,9,'Nombre : '.$resultado['nombrefr'],0,2,'L');
$ppdf->Cell(50,9,'Identificacion : '.$resultado['ident'],0,2,'L');
$ppdf->Cell(50,9,'Numero de personas: ' .$resultado['nropers'],0,2,'L');
$ppdf->Cell(50,9,'Checkin: ' .$resultado['checkin'] ,0,2,'L');
$ppdf->Cell(50,9,'Checkout: ' .$resultado['checkout'],0,2,'L');
$ppdf->Cell(50,9,'Status: ' .$resultado['stat'],0,2,'L');
$ppdf->Output();	

/*echo "</br>";
echo" Reservacion cancelada</br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'ENCARGADO: ' .$result['encargado']. '</br>' ; 
echo 'NOMBRE: '.$result['nombrefr'].'</br>' ; 
echo 'IDENTIFICACION: '.$result['ident'].'</br>' ; 
echo "NUMERO PERSONAS: " .$result['nropers'].'</br>' ; 
echo 'CHECKIN: '  .$result['checkin'].'</br>' ; 
echo 'CHECKOUT: ' .$result['checkout'].'</br>' ; 
echo 'STATUS: ' .$result['stat'].'</br>';
echo "-------------------------------------------------------------------</br>";
}
else {echo "<br/>No hay más datos!!! <br/>";
}*/
}
}
//consulta
$consultusuario=("SELECT `encargado`,`nombrefr`,`ident`,`nropers`,`checkin`,`checkout`,`hotel`,`hotelid`,`rsocial`,`stat` FROM `REGISTRO_HUESPED` 
INNER JOIN  `USUARIO` ON  `hotel` = `hotelid` WHERE `checkin` AND  `checkout` BETWEEN  '$checkin' AND  '$checkout' AND `rsocial` = '$usuario' AND `stat`='cancelada'  LIMIT 0 , 30");
$resultados=mysql_num_rows(mysql_query($consultusuario)) ;
//condicion por si no hay registros en las fechas seleccionadas...
if($resultados==0){
//lanza un pop-up ara decirle al usuario que no existe la reservaciones en la fecha seleccionada
echo "<script type='text/javascript'>alert('No hay reservaciones canceladas entre las fechas seleccionadas');</script>";
echo "</br></br></br>";
echo "</br></br></br>";
echo "Regresar";
echo " <a href=../../Frontend/HTML/reportefechascanceladas.php value=Regresar> Regresar </a>";
}
else{
while ($fila=mysql_fetch_array($resultados)){
echo "<div class=CuadroExt>";
//se llama la funcion mostrardatos declarada en la linea 58
mostrardatos($fila);
}
mysql_free_result($resultados);
}

}
?>

</h3>
</div>
</body>
</html>