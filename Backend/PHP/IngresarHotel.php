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
 session_start();
$usuario=$_SESSION['rsocial'];
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");
}
//Sentencia SQL Para almacenar variable

$rsocial=$_POST['rsocial'];
$userh=$_POST['userh'];
$identh=$_POST['identh'];
$claveh=$_POST['claveh'];
$claverep=$_POST['claverep'];
$telefono=$_POST['telefono'];
$mail=$_POST['mail'];
$pais=$_POST['pais'];
$prov=$_POST['prov'];
$city=$_POST['city'];
$dir=$_POST['dir'];

if ($claveh==$claverep){
	//Ejecutar Sentencia
	$ejecsent=mysql_query("INSERT INTO `USUARIO` (`rsocial`, `usuarioh`, `identh`, `claveh`, `claver`, `telefono`, `mail`, `pais`, `provincia`, `ciudad`, `direccion`) VALUES ('$rsocial','$userh','$identh','$claveh','$claverep','$telefono','$mail','$pais','$prov','$city','$dir')");
	}
else {
	header("location:../../Frontend/HTML/InfoIngreso.html");
	}

//imprimir a pdf
include_once('fpdf.php');
$ppdf=new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'FICHA ADMINISTRADOR HOTEL',1,2,'C');
$ppdf->Ln();
$ppdf->Cell(50,9,'Razon Social: '.$_POST['rsocial'],0,2,'L');
$ppdf->Cell(50,9,'Usuario: '.$_POST['userh'],0,2,'L');
$ppdf->Cell(50,9,'Telefono Celular: '.$_POST['telefono'],0,2,'L');
$ppdf->Cell(50,9,'Correo Electronico: '.$_POST['mail'],0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$_POST['pais'],0,2,'L');
$ppdf->Cell(50,9,'Provincia: '.$_POST['prov'],0,2,'L');
$ppdf->Cell(50,9,'Cidudad: '.$_POST['city'],0,2,'L');
$ppdf->Cell(50,9,'Direccion: '.$_POST['dir'],0,2,'L');
$ppdf->Ln();

$ppdf->Output();
//mysql_close($conectar);

?>