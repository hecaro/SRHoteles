<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
session_start();
$_SESSION['user'];
$_SESSION['clave'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
$clave= $_SESSION['clave'];
$idhabitacion=$_SESSION['idhabitacion'];
session_write_close();
//Conectar base de datos
$conectar=@mysql_connect('localhost','srhotfai_david','5rHD@v1D20it');
//verfi	car
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
//almacenar variable
$costohabitacion=$_POST['costohabitacion'];
$encargado=$_POST['encargado'];
$nombrefr=$_POST['nombrefr'];
$ident=$_POST['ident'];
$npers=$_POST['npers'];
$thuesped=$_POST['thuesped'];
$referencia=$_POST['referencia'];
$paisfr=$_POST['paisfr'];
$ciudadfr=$_POST['ciudadfr'];
$telefonofr=$_POST['telefonofr'];
$mailfr=$_POST['mailfr'];
$checkin=$_POST['checkinfr'];
$checkout=$_POST['checkoutfr'];
$cantsimp=$_POST['cantsimp'];
$cantmat=$_POST['cantmat'];
$canttwin=$_POST['canttwin'];
$canttri=$_POST['canttri'];
//para cuando de el error:  PHP Notice:  Undefined variable: pasifrprint in.. colocar el siguiente codigo...
$stat=isset($_POST['stat']) ? $_POST['stat'] : "";
$nota=$_POST['nota'];
$lavanderia=$_POST['lavanderia'];
$bar=$_POST['bar'];
$extra=$_POST['extra'];

//editar la base de datos con los campos ingresados en buscar.php... en las tablas bar avanderia y extra esta definido el valor null predeterminado="0", por esto se puede editar con update de una vez sin hacer insert
$ejecutar=mysql_query("UPDATE  `REGISTRO_HUESPED` SET  `encargado` =  '$encargado', `nombrefr` = '$nombrefr', `ident` = '$ident', `nropers` = '$npers', `thuesped` = '$thuesped', `referencia` = '$referencia', `paisfr` = '$paisfr', `ciudadfr` = '$ciudadfr', `telefonofr` = '$telefonofr', `mailfr` = '$mailfr', `checkin` = '$checkin', `checkout` = '$checkout', `cantsimp` = '$cantsimp', `cantmat` = '$cantmat', `canttwin` = '$canttwin', `canttri` = '$canttri', `stat` = '$stat', `nota` = '$nota',`lavanderia` ='$lavanderia', `bar` = '$bar', `extra` = '$extra'  WHERE  `ident` =  '$ident'");
//query para hacer update el campo status en habitacion y registro_huesped a finalizado o cancelada para que en el flujo de caja solo salgan las canceladas y que se hizo click en checkout
$updatestatusres=mysql_query("UPDATE `REGISTRO_HUESPED` SET `stat`='finalizada' WHERE `ident`='$ident' ");



$dias=mysql_query("SELECT `diasreserva`,`hotel`,`habitacionid` FROM `REGISTRO_HUESPED` INNER JOIN `HABITACIONES` ON `hotel`=`idhotel` AND `habitacionid`=`idhabitacion` ");
$diass=mysql_fetch_array($dias);
//se declaran variables tomadas del metodo post para ser imprimidas en el pdf
$diasreserva=$diass['diasreserva'];
$nombreprint = $_POST['nombrefr'];
$identprint = $_POST['ident'];
$npersprint = $_POST['npers'];
$thuespedprint = $_POST['thuesped'];
$referenciaprint = $_POST['referencia'];
$paisfrprint = $_POST['paisfr'];
$ciudadfrprint = $_POST['ciudadfr'];
$telefonofrprint = $_POST['telefonofr'];
$mailfrprint = $_POST['mailfr'];
$checkinprint = $_POST['checkinfr'];
$checkoutprint = $_POST['checkoutfr'];
$cantsimpleprint = $_POST['cantsimp'];
$cantmatprint = $_POST['cantmat'];
$canttwinprint = $_POST['canttwin'];
$canttriprint = $_POST['canttri'];
$statprint = $_POST['stat'];
$notaprint = $_POST['nota'];
$lavanderiaprint = $_POST['lavanderia'];
$barprint = $_POST['bar'];
$extraprint = $_POST['extra'];
//variable p almacena suma de servicion extra...
$sumaextras= $lavanderiaprint + $barprint + $extraprint;
$totalhabitacion=$diasreserva * $costohabitacion;
$total= $totalhabitacion + $sumaextras; 

//imprimir a pdf
//se tratan de dejar espacios en cada linea del pedf para que quepa toda la informacion en una sola hoja
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
$ppdf->Cell(50,9,'Nombre: '.$nombreprint.'                                              Identificacion: '.$identprint,0,2,'L');
$ppdf->Cell(50,9,'Nro de Personas: '.$npersprint.'                                      Tipo de Huesped: '.$thuespedprint ,0,2,'L');
$ppdf->Cell(50,9,'Tipo de Huesped: '.$thuespedprint.'                            Referencia: '.$referenciaprint,0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$paisfrprint.'                                                Cidudad: '.$ciudadfrprint,0,2,'L');
$ppdf->Cell(50,9,'Nro. De telefono: '.$telefonofrprint.'                           Correo Electronico: '.$mailfrprint,0,2,'L');
$ppdf->Cell(50,9,'Check-IN: '.$checkinprint.'                                   Check-OUT: '.$checkoutprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Simples: '.$cantsimpleprint.'                            Habitaciones Matrimoniales: '.$cantmatprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Twin: '.$canttwinprint.'                                 Habitaciones Triples: '.$canttriprint,0,2,'L');
$ppdf->Cell(50,9,'Nota: '.$notaprint,0,2,'L');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,' PRE-CUENTA',1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Costo de habitacion: '.$costohabitacion.'                      Dias de reserva: '.$diasreserva,0,2,'L');
$ppdf->Cell(50,9, 'Total habitacion: '.$totalhabitacion,0,2,'L');
$ppdf->Cell(50,9,'Lavanderia: '.$lavanderiaprint.'                                     Bar/Restaurante: '.$barprint.'        Extra: '.$extraprint,0,2,'L');
$ppdf->Cell(50,9,'Total Servicios Extras: '.$sumaextras,0,2,'L');
$ppdf->Cell(50,9, '' ,0,2,'L');
$ppdf->Cell(50,9,'Total a pagar: '.$total,0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(50,9, '   ',0,2,'L');
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'FIRMA',0,2,'C');
$ppdf->Cell(50,9,'________________________',0,2,'C');
$ppdf->Output();
?>
