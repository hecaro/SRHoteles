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

//inicia la session y los datos guardados en ellas}
$encargado=$_POST['encargado'];
$checkin=$_POST['checkinfr'];
$checkout=$_POST['checkoutfr'];
 session_start();
$usuario=$_SESSION['rsocial'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$idhotel=$_SESSION['hotelid'];
session_write_close();
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){
//ejecutar sentencia para traer las ganancias de cada habitacion por dia semana y mes	
$query=mysql_query("SELECT  `idhabitacion` ,  `stat` ,  `costohabitacion` ,  `tipohabitacion` ,  `idhotel` ,  `hotelid` ,  `status` ,  `checkin` ,  `checkout` ,  `lavanderia` ,  `bar` ,  `extra` ,  `rsocial` ,  `diasreserva` 
FROM  `HABITACIONES` INNER JOIN  `REGISTRO_HUESPED` ON  `hotel` =  `idhotel` INNER JOIN  `USUARIO` ON  `rsocial` =  '$usuario' WHERE  `stat` =  'finalizada' AND  `checkin` 
AND  `checkout` BETWEEN  '$checkin'AND  '$checkout' LIMIT 0 , 30");





//FUNCION QUE SERA LLAMADA PARA MOSTRAR LOS DATOS OBTENIDOS
/*	function mostrardatos ($resultado) {
//condicion para saber si a funcion no es nula (forzarla)

if ($resultado !=NULL) {
echo "</br></br>";
echo" Flujo de Caja</br>";
echo "-------------------------------------------------------------------</br>";
//se llama la variable result con cada uno de los campos que se quiere mostar
echo 'ID HABITACION:  ' .$resultado['idhabitacion']. '</br>' ; 
echo 'COSTO HABITACION: '.$resultado['costohabitacion'].'</br>' ; 
echo "STATUS: " .$resultado['stat'].'</br>' ;  
echo "CHECKIN" .$resultado['checkin'].'</br>';
echo "CHECKOUT: " .$resultado['checkout'].'</br>';
echo "DIAS DE RESERVA: ".$resultado['diasreserva'].'</br>';
$totalhabitacion=$resultado['diasreserva'] * $resultado['costohabitacion'];
echo "TOTAL PAGO HABITACION: ".$totalhabitacion.'</br>';
echo "LAVANDERIA: " .$resultado['lavanderia'].'</br>';
echo "BAR: " .$resultado['bar'].'</br>';
echo "EXTRA: " .$resultado['extra'].'</br>';
$totalextra=$resultado['lavanderia'] + $resultado['bar'] + $resultado['extra'];
echo "TOTAL EXTRAS: " .$totalextra.'</br>';
$totalpagar=$totalhabitacion + $totalextra;
echo "TOTAL: "  .$totalpagar.'</br>';
echo "-------------------------------------------------------------------</br>";
}

}
*/
	

?>
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title> Reporte Ingresos - SRHoteles</title>
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
	

	
	
	
<?php
	$queryocupacion=mysql_query("SELECT * FROM  `HABITACIONES` INNER JOIN  `REGISTRO_HUESPED` ON  `idhotel` =  `hotel` WHERE  `checkin` AND  `checkout` 
	BETWEEN  '$checkin' AND  '$checkout' AND  `hotel` =  '$hotelids' AND  `stat` =  'ocupado' OR  `stat` =  'finalizada' AND  `idhabitacion` =  `habitacionid` LIMIT 0 , 30");

$ocupadas=mysql_num_rows($queryocupacion);

$querylibre=mysql_query("SELECT  `idhotel` ,  `idhabitacion` ,  `status` ,  `checkin` ,  `checkout` ,  `hotel` FROM  `HABITACIONES` INNER JOIN  `REGISTRO_HUESPED` ON  `idhotel` =  `hotel` 
WHERE  `checkin` AND  `checkout` BETWEEN  '$checkin' AND  '$checkout' AND  `hotel` ='$idhotel' AND  `status` =  'libre' OR `stat`='cancelada'  LIMIT 0 , 30");
$libre=mysql_num_rows($querylibre);


	//se llama la funcion para imprimir dentro de un ciclo while
	$totalhabitaciones=0;
	$totaldeextras=0;
	$totalapagar=0;
	$totalavanderia=0;
	$totalbar=0;
	$totalextras=0;
	while($imprimir=mysql_fetch_array($queryocupacion)){
	
	//se llama la variable result con cada uno de los campos que se quiere mostar
	
	$imprimir['stat'];  
	$imprimir['checkin'];
	$imprimir['checkout'];
	$imprimir['diasreserva'];
	$totalhabitacion=$imprimir['diasreserva'] * $imprimir['costohabitacion'];
	$totalhabitacion;
	$imprimir['lavanderia'];
	$imprimir['bar'];
	$imprimir['extra'];
	$totalextra=$imprimir['lavanderia'] + $imprimir['bar'] + $imprimir['extra'];
	$totalextra;
	$totalpagar=$totalhabitacion + $totalextra;
	$totalpagar;
	$totalapagar += $totalpagar;
	$totaldeextras += $totalextra;
	$totalhabitaciones += $totalhabitacion;
	$totalavanderia += $imprimir['lavanderia'];
	$totalbar += $imprimir['bar'];
	$totaldeextras += $imprimir['extra'];
	
	}
	
ob_clean();
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'Reporte de Ingresos  ' .$usuario,1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9, 'Inicio : '.$checkin,0,2,'L');
$ppdf->Cell(50,9, 'Final : '.$checkout,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones ocupadas: '.$ocupadas,0,2,'L');
$ppdf->Cell(50,9,'Total Ingresos en Habitaciones: ' .$totalhabitaciones,0,2,'L');
$ppdf->Cell(50,9,'Total Ingresos en Lavanderia: ' .$totalavanderia ,0,2,'L');
$ppdf->Cell(50,9,'Total Ingresos en Bar/Restaurante: ' .$totalbar,0,2,'L');
$ppdf->Cell(50,9,'Total Ingresos en Servicios Adicionales: ' .$totaldeextras,0,2,'L');
$ppdf->Cell(50,9,'Total Ingresos en Extras: '.$totaldeextras,0,2,'L');
$ppdf->Cell(50,9,'Total Precios: ' .$totalapagar,0,2,'L');
$ppdf->Cell(50,9,'Precios no incluyen iva',0,2,'L');
$ppdf->Cell(50,9,'Encargado: ' .$encargado=$_POST['encargado'],0,2,'L');
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(19,20,'   ',0);
$ppdf->Cell(19,20,'   ',0);
$ppdf->Cell(100,12,'FIRMA ENCARGADO',0,2,'C');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(100,12,'________________________',0,2,'C');
$ppdf->Output();	
}
		
?>	
	
	
	/*
	
	echo "<h3><div class=CuadroExt>";
	echo "</br></br></br>";
	echo" Reporte de Ingresos Entre : ".$checkin; echo " /  ".$checkout; echo "</br>";
	echo "-------------------------------------------------------------------</br>";
	echo "Total de habitaciones: " .$totalhabitaciones;echo "</br>";
	echo "Total lavanderia: " .$totalavanderia;echo "</br>";
	echo "Total bar :" .$totalbar;echo "</br>";
	echo "Total de servicios adicionales: " .$totaldeextras;echo "</br>";
	echo "Total de extras: " .$totaldeextras;echo "</br>";
	echo "Total: " .$totalapagar;echo "</br>";
	echo "-------------------------------------------------------------------</br>";
	echo "</div></h3>";
	}
	*/
	
	
	</body>
	</html>
	