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


//Sentencia SQL Para almacenar variable

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
$cantsimp=isset($_POST['cantsimp']) ? $_POST['cantsimp']: "";
$cantmat=$_POST['cantmat'];
$canttwin=$_POST['canttwin'];
$canttri=$_POST['canttri'];
$status=$_POST['stat'];
$nota=$_POST['nota'];
$hotelid=$_POST['hotel'];
$idhabitacion=$_POST['idhabitacion'];
$_SESSION['idhabitacion']=$idhabitacion;
session_write_close();

//evalua en las variables de sesion hay algun resultado y prosigue con la sentencia
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){

 //query para comparar si en el campo status de la tabla habitaciones y la fechas de checkin y checkout de la tabla registro_huesped  coinciden si es asi no se ejecuta el guardado
 $comparar=mysql_query("SELECT  `status` ,  `checkin` ,  `habitacionid` 
FROM  `HABITACIONES` 
INNER JOIN  `REGISTRO_HUESPED` ON  `status` =  'reservado'
AND  `checkin` AND `checkout` BETWEEN  '$checkin' AND '$checkout'
WHERE  `habitacionid` =  '$idhabitacion'
LIMIT 0 , 30");
 $comparar1=mysql_fetch_array($comparar);
 //CONDICION QUE DICE QUE SI HAY UNA COINCIDENCIA ENTRE EL CHECKIN Y CHECKOUT DEL INGRESO LA RESERVA NO SE HACE EFECTIVA
 if($comparar1 != NULL){
 
 echo '<script type="text/javascript">alert("Habitacion reservada entre las fechas que selecciono")
 	</script>';
 	echo "</br></br>";
 echo "<a href=../../Frontend/HTML/IngresarHuesped.php> Regresar </a>";

 }
 else{

//funcion para contar los dias entre el checkin y el chekout para despues multiplicarlo por el valor que esta en el capo de costo de cada habitacion 


function dias($inicio,$fin)
{
    $dias = (strtotime($inicio)-strtotime($fin))/86400;
    
    $dias = abs($dias); $dias = floor($dias);
    return ($dias);
	}
//el valor devuelto por la funcion se almacena dentro de la variable diasfecha
$diasfecha=dias($checkin,$checkout);
 
	
				
//Ejecutar Sentencia 
$sqlsave=mysql_query("INSERT INTO `REGISTRO_HUESPED` (`encargado`, `nombrefr`, `ident`, `nropers`, `thuesped`, `referencia`, `paisfr`, `ciudadfr`, `telefonofr`, `mailfr`, `checkin`, `checkout`, `cantsimp`, `cantmat`, `canttwin`, `canttri`, `stat`, `nota`,`hotel`,`habitacionid`,`diasreserva`) VALUES ('$encargado','$nombrefr','$ident','$npers','$thuesped','$referencia','$paisfr','$ciudadfr','$telefonofr','$mailfr','$checkin','$checkout','$cantsimp','$cantmat','$canttwin',
'$canttri','$status','$nota','$hotelid','$idhabitacion','$diasfecha')");
//condicion para asignar un color segun el status de cada reserva
if($status='reservado'){
$color='#008000';
}
	elseif ($status='ocupado'){
	$color='#FF0000';
	}
	else if ($stat='bloqueado'){
	$color='#FF0000';
	}
	elseif($status='libre'){
	$color='#0400FF';
	}
//query para ingresar en la tabla eventos con los datos en el ingreso de huespedes
$ingreso=mysql_query("INSERT INTO `events` (`start`,`end`,`razonsocial`,`title`,`color`) VALUES ('$checkin','$checkout','$usuario','$idhabitacion','$color')");

//se crea query para actualizar el capo status de la tabla habitaciones 


			$statushab=mysql_query("UPDATE `HABITACIONES` SET `status`='$status' WHERE `idhabitacion`='$idhabitacion'");

//cndicion si guada con la sentencia imprime el resultado en pdf
if($sqlsave){
//imprimir a pdf
include_once('fpdf.php');
$ppdf=new FPDF();
$ppdf->AddPage();
$ppdf->SetFont('Arial','',11);
$ppdf->Image('../../Frontend/Recursos/LogoPDF.gif', 10, 10, 30, 10,'GIF');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(190,12,'FICHA REGISTRO '.$usuario,1,2,'C');
$ppdf->Cell(19,20,'',0);
$ppdf->Ln();
$ppdf->Cell(19,20,'',0);
$ppdf->Cell(50,9,'Nombre: '.$_POST['nombrefr'],0,2,'L');
$ppdf->Cell(50,9,'Identificacion: '.$_POST['ident'],0,2,'L');
$ppdf->Cell(50,9,'Nro de Personas: '.$_POST['npers'],0,2,'L');
$ppdf->Cell(50,9,'Tipo de Huesped: '.$_POST['thuesped'],0,2,'L');
$ppdf->Cell(50,9,'Referencia: '.$_POST['referencia'],0,2,'L');
$ppdf->Cell(50,9,'Pais: '.$_POST['paisfr'],0,2,'L');
$ppdf->Cell(50,9,'Cidudad: '.$_POST['ciudadfr'],0,2,'L');
$ppdf->Cell(50,9,'Nro. De telefono: '.$_POST['telefonofr'],0,2,'L');
$ppdf->Cell(50,9,'Correo Electronico: '.$_POST['mailfr'],0,2,'L');
$ppdf->Cell(50,9,'Check-IN: '.$_POST['checkinfr'],0,2,'L');
$ppdf->Cell(50,9,'Check-OUT: '.$_POST['checkoutfr'],0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Simples: '.$_POST['cantsimp'],0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Matrimoniales: '.$_POST['cantmat'],0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Twin: '.$_POST['canttwin'],0,2,'L');
$ppdf->Cell(50,9,'Habitaciones Triples: '.$_POST['canttri'],0,2,'L');
$ppdf->Cell(50,9,'Nota: '.$_POST['nota'],0,2,'L');
$ppdf->Ln();
$ppdf->Ln();
$ppdf->Cell(70,40,'',0);
$ppdf->Cell(50,9,'FIRMA',0,2,'C');
$ppdf->Cell(50,9,'________________________',0,2,'C');
$ppdf->Output();
}
}

}
?>