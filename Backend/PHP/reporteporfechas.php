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
$checkin=$_POST['checkin'];
$checkout=$_POST['checkout'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
$idhotel=$_SESSION['hotelid'];



if(!$_SESSION){
	header("location:../../index.html");

}
//Fin Conexion
//error en 51 

if (isset($_SESSION['user']) && ($_SESSION['clave']) ){
$consultusuario=("SELECT * FROM  `REGISTRO_HUESPED` INNER JOIN `USUARIO` ON `hotel` = `hotelid`  WHERE  `checkin` AND  `checkout` BETWEEN  '$checkin' AND  '$checkout'  AND  `stat` = 'reservado' AND `rsocial`  = '$usuario' LIMIT 0 , 30");
$query=mysql_query($consultusuario);
if($query){
//secra funcion para mostrar los datos 
function mostrardatos ($resultados) {
//condicion para saber si a funcion no es nula (forzarla)
if ($resultados !=NULL) {
ob_clean();
include_once('fpdf.php');
$ppdf= new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'Reporte de Reservas ' .$usuario=$_SESSION['rsocial'],1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Encargado: '.$resultados['encargado'],0,2,'L');
$ppdf->Cell(50,9,'Nombre : '.$resultados['nombrefr'],0,2,'L');
$ppdf->Cell(50,9,'Identificacion : '.$resultados['ident'],0,2,'L');
$ppdf->Cell(50,9,'Numero de personas: ' .$resultados['nropers'],0,2,'L');
$ppdf->Cell(50,9,'Tipo de Huesped: '.$resultados['thuesped'],0,2,'L');
$ppdf->Cell(50,9,'Referencia: '.$resultados['referencia'] ,0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$resultados['paisfr'] ,0,2,'L');
$ppdf->Cell(50,9,'Ciudad: '.$resultados['ciudadfr'] ,0,2,'L');
$ppdf->Cell(50,9,'Telefono: '.$resultados['telefonofr'] ,0,2,'L');
$ppdf->Cell(50,9,'Mail: '.$resultados['mailfr'] ,0,2,'L');
$ppdf->Cell(50,9,'ID Habitacion: '.$resultados['habitacionid'] ,0,2,'L');
$ppdf->Cell(50,9,'Dias de Reserva: '.$resultados['diasreserva'] ,0,2,'L');
$ppdf->Cell(50,9,'Checkin: ' .$resultados['checkin'] ,0,2,'L');
$ppdf->Cell(50,9,'Checkout: ' .$resultados['checkout'],0,2,'L');
$ppdf->Cell(50,9,'Status: ' .$resultados['stat'],0,2,'L');
$ppdf->Output();
}
else {echo "<br/>No hay más datos!!! <br/>";
}
}
}



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
	header("Content-Type: text/html;charset=utf8_spanish_ci");
	
	//se llama la funcion para imprimir dentro de un ciclo while
	while($imprimir=mysql_fetch_array($query)){
		mostrardatos($imprimir);
	}
	
	}
	session_write_close();
	?>
	
	</p>
</div>
</body>
</html>