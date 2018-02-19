<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
session_start();
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
$tipohabitacion=$_POST['tipohabitacion'];
$costohabitacion=$_POST['costohabitacion'];
$statushabitacion=$_POST['statushabitacion'];
$ejecutar=mysql_query("UPDATE  `HABITACIONES` SET `tipohabitacion`='$tipohabitacion',`costohabitacion`='$costohabitacion', `status`='$statushabitacion' WHERE `idhabitacion`='$idhabitacion'"); 

if($ejecutar){
//imprimir a pdf
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'EDICION DE HABITACION ' .$usuario,1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Id Habitacion: '.$idhabitacion,0,2,'L');
$ppdf->Cell(50,9,'Tipo de Habitacion: '.$tipohabitacion,0,2,'L');
$ppdf->Cell(50,9,'Costo de Habitacion: '.$costohabitacion,0,2,'L');
$ppdf->Cell(50,9,'Status de Habitacion: '.$statushabitacion,0,2,'L');
$ppdf->Output();
}else{
die ("Ha fallado el acceso a la base de datos: " . mysql_error());

}
?>


