<!doctype html>
<html>
<head>
	<meta charset="utf8_spanish_ci">
	<meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	<link rel="stylesheet" type="text/css" href="../../Frontend/CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../../Frontend/Recursos/icon.png">
	<title>Reserva - SRHoteles</title>
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
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminHotel.php">
			<h1 class="LC">SRH</h1>	
		</a>
	</header>
	
<?php
header("Content-Type: text/html;charset=utf8_spanish_ci");
//cuando de: PHP Notice:  Undefined variable: pasifrprint in... utilizar este codigo para verificar la variable
 $busqid=isset($_POST['nombrehuesped']) ? $_POST['nombrehuesped'] : "";

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
//Fin Conexion
session_start();
$_SESSION['user'];
$_SESSION['clave'];
$user= $_SESSION['user'];
$clave= $_SESSION['clave'];
$usuario=$_SESSION['rsocial'];
$clave= $_SESSION['clave'];
$idhabitacion=$_POST['idhabitacion'];
$idhabitacion=$_POST['idhabitacion'];
if (isset($_SESSION['user']) && ($_SESSION['clave']) )
{

//consulta para traer la reserva segun el usuario y el hotel que inicio la sesion
$consulta=mysql_query("SELECT * FROM  `REGISTRO_HUESPED` INNER JOIN  `USUARIO` ON  `hotel` =  `hotelid` INNER JOIN `HABITACIONES` ON `idhotel`=`hotel` WHERE  `nombrefr` =  '$busqid' AND `rsocial`='$usuario' LIMIT 0 , 30");

$fila=mysql_fetch_array($consulta);
//se crea la variable sesion hotelid para enviarla a editarres para validar el id del hotel y asi poder editar el status de la habitacion que se ha editado a reserva
$hotelid=$fila['hotelid'];
$_SESSION['hotelid']=$hotelid;
session_write_close();


//se crea un formulario para enviar lo editado al archivo html y luego editar
if ($fila){


	$costohabitacion=$fila['costohabitacion'];
	$idhabitacion=$fila['habitacionid'];
	$ident=$fila['ident'];
	$encargado=$fila['encargado'];
	$nropers=$fila['nropers'];
	$cantsimp=$fila['cantsimp'];
	$nombre=$fila['nombrefr'];
	$thuesped=$fila['thuesped'];
	$referencia=$fila['referencia'];
	$paisfr=$fila['paisfr'];
	$ciudadfr=$fila['ciudadfr'];
	$telefonofr=$fila['telefonofr'];
	$mailfr=$fila['mailfr'];
	$checkin=$fila['checkin'];
	$checkout=$fila['checkout'];
	$nota=$fila['nota'];
	$stat=$fila['stat'];
	$cantsimp=$fila['cantsimp'];
	$cantmat=$fila['cantmat'];
	$canttwin=$fila['canttwin'];
	$canttri=$fila['canttri'];
	
	echo "<div class=Titulo><h1 class=FR>FORMULARIO DE REGISTRO</h1><div class=CuadroExt>";
	echo "<h3><div class=BarraTexto>USUARIO:  "; echo $usuario;
		
	echo "<form method=post target=_blank action=../../Backend/PHP/EditarRes.php>" ;
	echo "<h3>Encargado (A):<input class=BarraTexto id=encarg type=text name=encargado value=$encargado></br>
	  	NOMBRE	<input class=BarraTexto id=nombrefr  type=text readonly=readonly name=nombrefr value='$nombre'></h3>";
	  	//se utiliza el aributo readonly=readonly para que no se pueda editar el campo del texto
	echo	"<h3>Identificacion  <input class=BarraTexto id=ident readonly=readonly type=text name=ident value=$ident dissabled=true>
		Nro. DE PERSONAS  <input class=BarraTexto id=nrop type='text' name=npers value=$nropers></h3>";
	echo "<h3>TIPO DE HUESPED <input class=BarraTexto id=th type=text name=thuesped value=$thuesped dissabled=true>
		REFERENCIA	<input class=BarraTexto id=ref type=text name=referencia value=$referencia></h3>";
	echo "<h3>PAIS	<input class=BarraTexto id=pais type=text name=paisfr readonly=readonly value=$paisfr dissabled=true>
		CIUDAD	<input class=BarraTexto id=city type=text name=ciudadfr readonly=readonly value=$ciudadfr dissabled=true></h3>";
	echo "<h3>TELEFONO	<input class=BarraTexto id=tlfno type=text readonly=readonly name=telefonofr value=$telefonofr>
		E-MAIL	<input class=BarraTexto id=mail type=text name=mailfr value=$mailfr></h3>";
	echo "<h3>CHECK-IN	<input class=BarraTexto id=into type=date name=checkinfr value=$checkin>
		CHECK-OUT<input class=BarraTexto id=outo type=date name=checkoutfr value=$checkout></h3>";
	echo "<h3>TIPO DE HABITACION / CANTIDAD: SIMPLE	
		<select class=BarraNumero list=cantidadsimp name=cantsimp id=cantsimp value=$cantsimp>
					<option value=$cantsimp>$cantsimp</option>
					<option value=0>0</option>
					<option value=1>1</option>
					<option value=2>2</option>
					<option value=3>3</option>
					<option value=4>4</option>
					<option value=5>5</option>
					<option value=6>6</option>
					<option value=7>7</option>
					<option value=8>8</option>
					<option value=9>9</option>
					<option value=10>10</option>
					<option value=11>11</option>
					<option value=12>12</option>
					<option value=13>13</option>
					<option value=14>14</option>
					<option value=15>15</option>
				</select>
		MATRIMONIAL <select class=BarraNumero list=cantidadmat name=cantmat id=cantmat value=$cantmat>
					<option value=$cantmat>$cantmat</option>
					<option value=0>0</option>
					<option value=1>1</option>
					<option value=2>2</option>
					<option value=3>3</option>
					<option value=4>4</option>
					<option value=5>5</option>
					<option value=6>6</option>
					<option value=7>7</option>
					<option value=8>8</option>
					<option value=9>9</option>
					<option value=10>10</option>
					<option value=11>11</option>
					<option value=12>12</option>
					<option value=13>13</option>
					<option value=14>14</option>
					<option value=15>15</option>
				</select>
		TWIN <select class=BarraNumero list=cantidadttwin name=canttwin id=canttwin value=$canttwin>
					<option value=$canttwin>$canttwin</option>
					<option value=0>0</option>
					<option value=1>1</option>
					<option value=2>2</option>
					<option value=3>3</option>
					<option value=4>4</option>
					<option value=5>5</option>
					<option value=6>6</option>
					<option value=7>7</option>
					<option value=8>8</option>
					<option value=9>9</option>
					<option value=10>10</option>
					<option value=11>11</option>
					<option value=12>12</option>
					<option value=13>13</option>
					<option value=14>14</option>
					<option value=15>15</option>
				</select>
		TRIPLE <select class=BarraNumero list=cantidadtri name=canttri id=canttri value=$canttri>
					<option value=$canttri>$canttri</option>
					<option value=0>0</option>
					<option value=1>1</option>
					<option value=2>2</option>
					<option value=3>3</option>
					<option value=4>4</option>
					<option value=5>5</option>
					<option value=6>6</option>
					<option value=7>7</option>
					<option value=8>8</option>
					<option value=9>9</option>
					<option value=10>10</option>
					<option value=11>11</option>
					<option value=12>12</option>
					<option value=13>13</option>
					<option value=14>14</option>
					<option value=15>15</option><br>
				</select>
		</h3>";
		echo "<h3>ESTATUS HABITACION:
			<input type=radio name=status id=stat value=reservado> RESERVADO
			<input type=radio name=status id=stat value=bloqueado> BLOQUEADO 
			<input type=radio name=status id=stat value=ocupado> OCUPADO
			<input type=radio name=status id=stat value=NULL> LIBERADO
			</h3>";
		echo "<h3>NOTA:	<input class=BarraNota type=text name=nota value=$nota></h3>";
		echo "<h3>ID HABITACION: <input readonly=readonly  value=$idhabitacion class=BarraTexto name=idhabitacion></h3>";
		echo "<h3><button class=boton type=submit >
					EDITAR</button> 
		<button class=boton type=submit formaction=../../Backend/PHP/cancelarres.php> CANCELAR RESERVA </button> </h3>";
		
		echo "<h3>COSTO DE HABITACION<input value=$costohabitacion class=BarraNumero name=costohabitacion></h3>";
		echo "<h3>EXTRAS<h3>
		Lavanderia: <input type=text class=BarraNumero id=lavanderia name=lavanderia>
		Bar/Restaurante: <input type=text class=BarraNumero id=bar name=bar>
		OTROS: <input type=text class=BarraNumero id=ext name=extra></h3>";
		echo "<h3><button class=boton type=submit formaction=../../Backend/PHP/Checkout.php >
					CHECK-OUT
				</button></div> </h3></div>";	
		echo "</form>";
		
	}
	else{
	echo"</br></br></br></br></br></br>";
	echo"La identificacion introducida no esta ingresada en el sistema";
	}
	}
       else{
	header("location:../../index.html");

}
?>
</div>
</body>
</html>