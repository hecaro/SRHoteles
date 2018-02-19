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
$_SESSION['hotelid'];
$hotelid=$_SESSION['hotelid'];
$hotelid=$_POST['hotelid'];
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
}
}
//idhotel no queria funcionar por eso este query 
$sacarid=mysql_query("SELECT `idhotel`,`nombrehotel` FROM `HOTEL` WHERE `nombrehotel`='$usuario'");
$sacarhotel=mysql_fetch_array($sacarid);
$hotelids=$sacarhotel['idhotel'];
//query para total de habitaciones
$habi=mysql_query("SELECT * FROM `HABITACIONES` WHERE `idhotel`='$hotelids'");
$habitaciones=mysql_num_rows($habi);
//consulta
//sacar las ocupadas:
//$busqueda=SELECT `status`,`hotel`,`stat`,`hotelid`,`habitacionid`,`idhabitacion`,`checkin`,`checkout` FROM `REGISTRO_HUESPED` INNER JOIN `HABITACIONES` ON `hotel`=`hotelid` 
//WHERE `checkin` AND `checkout` BETWEEN '$checkin' AND '$checkout' AND `stat`='ocupado' AND `status`='ocupado' 
//sacar variable de ocupacion:$query=mysql_fetch_array($busqueda); $ocupacion=mysql_num_rows($query);

$queryocupacion=mysql_query("SELECT  `idhotel` ,  `idhabitacion` ,  `status` ,  `checkin` ,  `checkout` ,  `hotel` FROM  `HABITACIONES` INNER JOIN  `REGISTRO_HUESPED` ON  `idhotel` =  `hotel` 
WHERE  `checkin` AND  `checkout` BETWEEN  '$checkin' AND  '$checkout' AND  `hotel` ='$hotelids' AND  `status` =  'ocupado' AND `stat`='ocupado' LIMIT 0 , 30");

$ocupadas=mysql_num_rows($queryocupacion);

$querylibre=mysql_query("SELECT DISTINCT  `idhotel` ,  `idhabitacion` ,  `status` ,  `checkin` ,  `checkout` ,  `hotel` FROM  `HABITACIONES` INNER JOIN  `REGISTRO_HUESPED` ON  `idhotel` =  `hotel` WHERE  `checkin` AND  `checkout` BETWEEN  '$checkin' AND  '$checkout' AND  `hotel` =  '$hotelids' AND  `status` =  'libre' OR  `status` =  'reservado'
LIMIT 0 , 30");
$libre=mysql_num_rows($querylibre);

$porcentaje= $ocupadas / $habitaciones * 100;
$porcentajes = round ($porcentaje);

?>

<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title> Hotel - SRHoteles</title>
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
<!--  ESTA LINEA DE CODIGO ESTABA HACIENDO QUE SE ENVIARA EL FORMULARIO AUTOMATICAMENTE Y VACIO-->
<!--<body onLoad='javascript:enviarForm();'>-->
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
	

	<div class="contenedor">
	<p>


		<?php
		
		
ob_clean();
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'Porcentaje de Ocupacion '.$usuario,1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9, 'Numero de Habitaciones registradas: '.$habitaciones,0,2,'L');
$ppdf->Cell(50,9, 'Fecha de inicio: '.$checkin,0,2,'L');
$ppdf->Cell(50,9,'Fecha final: '.$checkout,0,2,'L');
$ppdf->Cell(50,9, 'Habitaciones Libres : '.$libre,0,2,'L');
$ppdf->Cell(50,9, 'Habitaciones Ocupadas: '.$ocupadas,0,2,'L');
$ppdf->Cell(50,9, 'Porcentaje de Ocupacion: '.$porcentajes.'%',0,2,'L');
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(19,20,'   ',0);
$ppdf->Cell(19,20,'   ',0);
$ppdf->Cell(100,12,'FIRMA ENCARGADO',0,2,'C');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(100,12,'________________________',0,2,'C');
$ppdf->Output();				
}
	
	/*	
	//imprime resultado del porcentaje
	echo" Hotel ".$usuario;echo "</br>";
	echo "El total de habitaciones es: " .$habitaciones; echo "</br>";
	echo "El numero de habitaciones ocupadas es: " .$ocupadas ; echo "</br>";
	echo "El numero de habitaciones libres es: " .$libre ; echo "</br>";
	echo "El Porcentaje de ocupacion entre las fechas $checkin Y $checkout es:"  .$porcentajes ; echo "%"; echo "</br>";
	*/







?>
</h3>
</div>
</body>
</html>