<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");


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

$rsocial=$_POST['rsocial'];
$identh=$_POST['identh'];
$telefono=$_POST['telefono'];
$mail=$_POST['mail'];
$pais=$_POST['pais'];
$provincia=$_POST['provincia'];
$ciudad=$_POST['ciudad'];
$direccion=$_POST['direccion'];

//QUERY SQL PARA MODIFICAR TABLAR
$sqlsave=mysql_query("UPDATE `USUARIO` SET `telefono`='$telefono',`mail`='$mail',`pais`='$pais',`provincia`='$provincia',`ciudad`='$ciudad',`direccion`='$direccion' WHERE `rsocial`='$rsocial' AND `identh`='$identh'");

if($sqlsave){
//imprimir a pdf
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'FICHA EDICION HOTEL',1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Razon Social: '.$rsocial,0,2,'L');
$ppdf->Cell(50,9,'Identificacion: '.$ident,0,2,'L');
$ppdf->Cell(50,9,'Telefono: '.$telefono,0,2,'L');
$ppdf->Cell(50,9,'Mail: '.$mail,0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$pais,0,2,'L');
$ppdf->Cell(50,9,'Provincia: '.$provincia,0,2,'L');
$ppdf->Cell(50,9,'Ciudad: '.$ciudad,0,2,'L');
$ppdf->Cell(50,9,'Direccion: '.$direccion,0,2,'L');
$ppdf->Output();
}
?>


