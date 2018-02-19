<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
session_start();
$hotelid=$_SESSION['hotelid'];

$usuario=$_SESSION['rsocial'];


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
$idhabitacion=$_POST['idhabitacion'];
$_SESSION['idhabitacion']=$idhabitacion;
session_write_close();
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
$stat=$_POST['status'];
$nota=$_POST['nota'];
$lavanderia=$_POST['lavanderia'];
$bar=$_POST['bar'];
$extra=$_POST['extra'];



//editar la base de datos con los campos ingresados en buscar.php... en las tablas bar avanderia y extra esta definido el valor null predeterminado="0", por esto se puede editar con update de una vez sin hacer insert
$ejecutar=mysql_query("UPDATE  `REGISTRO_HUESPED` SET  `encargado` =  '$encargado', `nombrefr` = '$nombrefr', `ident` = '$ident', `nropers` = '$npers', `thuesped` = '$thuesped', `referencia` = '$referencia', `paisfr` = '$paisfr', `ciudadfr` = '$ciudadfr', `telefonofr` = '$telefonofr', `mailfr` = '$mailfr', `checkin` = '$checkin', `checkout` = '$checkout', `cantsimp` = '$cantsimp', `cantmat` = '$cantmat', `canttwin` = '$canttwin', `canttri` = '$canttri', `stat` = '$stat', `nota` = '$nota'  WHERE 
 `ident` =  '$ident'");

//query para modificar la tabla habitaciones en su status segun lo modificado en la pagina anterior
$update=mysql_query("UPDATE `HABITACIONES` SET `status`='$stat' WHERE  `idhabitacion`='$idhabitacion'");
//se declaran variables tomadas del metodo post para ser imprimidas en el pdf
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
$notaprint = $_POST['nota'];

//if para asignar un color segun el status de la habitacion: #0400FF=azul - #FF0000=rojo -  #008000=verde
if($stat=='reservado'){
$color='#008000';
}
	else if ($stat=='ocupado'){
	$color='#FF0000';
	}
	else if ($stat=='bloqueado'){
	$color='#FF0000';
	}
	else {
	$color='#0400FF';
	}
	
	

//query para modificar la tabla events con lo que se edito en la pagina anterior
$eventupdate=mysql_query("UPDATE `events` SET `start`='$checkinprint', `end`='$checkoutprint', `color`='$color' WHERE  `title`='$idhabitacion'  ");

 

//imprimir a pdf
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'FICHA EDICION RESERVA',1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Nombre: '.$nombreprint,0,2,'L');
$ppdf->Cell(50,9,'Identificacion: '.$identprint,0,2,'L');
$ppdf->Cell(50,9,'Nro de Personas: '.$npersprint,0,2,'L');
$ppdf->Cell(50,9,'Tipo de Huesped: '.$thuespedprint,0,2,'L');
$ppdf->Cell(50,9,'Referencia: '.$referenciaprint,0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$paisfrprint,0,2,'L');
$ppdf->Cell(50,9,'Cidudad: '.$ciudadfrprint,0,2,'L');
$ppdf->Cell(50,9,'Nro. De telefono: '.$telefonofrprint,0,2,'L');
$ppdf->Cell(50,9,'Correo Electronico: '.$mailfrprint,0,2,'L');
$ppdf->Cell(50,9,'Check-IN: '.$checkinprint,0,2,'L');
$ppdf->Cell(50,9,'Check-OUT: '.$checkoutprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Simples: '.$cantsimpleprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Matrimoniales: '.$cantmatprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Twin: '.$canttwinprint,0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Triples: '.$canttriprint,0,2,'L');
$ppdf->Cell(50,9,'Nota: '.$notaprint,0,2,'L');
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Cell(70,40,'',0);
$ppdf->Cell(50,9,'FIRMA',0,2,'C');
$ppdf->Cell(50,9,'________________________',0,2,'C');
$ppdf->Output();
?>


