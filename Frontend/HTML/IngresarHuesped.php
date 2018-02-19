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
//Fin Conexion
//inicia la session y los datos guardados en ellas
 session_start();
$usuario=$_SESSION['rsocial'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$hotelid=$_SESSION['hotelid'];
session_write_close();
if(!$_SESSION){
	header("location:../../index.html");

}
?>

<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<title>Registro Huesped - SRHoteles</title>
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
<!--  ESTA LINEA DE CODIGO ESTABA HACIENDO QUE SE ENVIARA EL FORMULARIO AUTOMATICAMENTE Y VACIO
<body onLoad='javascript:enviarForm();'>-->
<body>
		<header class="BarraMenu" id="CabeceraSalida">
			<a  href="../../index.html"> <img src="../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
		</header>
		<header class="BarraMenu" id="CabeceraHotel">
			<h2 id="hotel"><?php echo $usuario;?></h2>
		</header>
		<header class="BarraMenu" id="CabeceraPrincipal">
			<a id="logoTemp" href="MenuAdminHotel.php">
				<h1 class="LC">SRH</h1>	
			</a>
		</header>
	<div class="Titulo">
		<h1 class="FR">FORMULARIO DE REGISTRO</h1>
	<div class="CuadroExt">
	<!--<h3><div class="BarraTexto">USUARIO:  	<?php echo $usuario; ?>-->

		<form name="nameForm" action="../../Backend/PHP/IngresarHuesped.php" method="post" target="_blank">
			<h3>
				Encargado (A):
				<input class="BarraTexto" id="encarg" type="text" name="encargado">
			</h3>
			<h3>
				NOMBRE
				<input class="BarraTexto" id="nomb" type="text" name="nombrefr">
				Identificacion
				<input class="BarraTexto" id="ident" type="text" name="ident">
				Nro. DE PERSONAS
				<input class="BarraTexto" id="nrop" type="text" name="npers">
			</h3>
			<h3>
				TIPO DE HUESPED
				<select class="BarraTexto" id="th" type="text" name="thuesped">
					<option value="Agencia">Agencia</option>
					<option value="Empresa">Empresa</option>
					<option value="WEB">WEB (Pagina)</option>
					<option value="OTAS">OTAS (Booking, Expedia, etc)</option>
					<option value="WalkIn">Walk in (Directo)</option>
				</select>
				REFERENCIA
				<input class="BarraTexto" id="ref" type="text" value="S/R" name="referencia">
			</h3>
			<h3>
				PAIS
				<input class="BarraTexto" id="pais" type="text" name="paisfr">
				CIUDAD
				<input class="BarraTexto" id="city" type="text" name="ciudadfr">
			</h3>
			<h3>
				TELEFONO
				<input class="BarraTexto" id="tlfno" type="text" name="telefonofr">
				E-MAIL
				<input class="BarraTexto" id="mail" type="text" name="mailfr">
			</h3>
			<h3>
				CHECK-IN
				<input class="BarraTexto" id="into" type="datetime-local" name="checkinfr" placeholder="Fecha de Ingreso aaaa-mm-dd">
				CHECK-OUT
				<input class="BarraTexto" id="outo" type="datetime-local" name="checkoutfr" placeholder="Fecha de Salida aaaa-mm-dd">
			</h3>
			<h3>
				TIPO DE HABITACION / CANTIDAD:
				<input type="checkbox" id="simp" value="simple" onchange="habilitar_botonsimp(this.checked);"> SIMPLE
				<select class="BarraNumero" list="cantidadsimp" name="cantsimp" id="cantsimp" placeholder="Nro" value="0" dissabled="true">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>
				<input type="checkbox" id="mat" value="doble" onchange="habilitar_botonmat(this.checked);"> MATRIMONIAL 
				<select class="BarraNumero" list="cantidadmat" name="cantmat" id="cantmat" placeholder="Nro" value="0" dissabled="true">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>
				<input type="checkbox" id="twin" value="doble" onchange="habilitar_botontwin(this.checked);"> TWIN 
				<select class="BarraNumero" list="cantidadttwin" name="canttwin" id="canttwin" placeholder="Nro" value="0" dissabled="true">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option>
				</select>
				<input type="checkbox" id="tri" value="triple" onchange="habilitar_botontri(this.checked);"> TRIPLE 
				<select class="BarraNumero" list="cantidadtri" name="canttri" id="canttri" placeholder="Nro" value="0" dissabled="true">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					<option value="11">11</option>
					<option value="12">12</option>
					<option value="13">13</option>
					<option value="14">14</option>
					<option value="15">15</option><br>
				</select>
			</h3>
			<h3>
				 ID SIMPLE
				<select class="BarraTexto" list="idhabi" name="idhabitacion" id="idhabitacion" >
				<option> </option>
			
				
				<?php
				
				
				header("Content-Type: text/html;charset=utf8_spanish_ci");
				//consulta para tomar el id de habitacion correspondiente al hotel que tiene la sesion iniciada
	$query=mysql_query ("SELECT  `idhotel` ,  `hotelid` ,  `status` ,  `idhabitacion` ,  `rsocial` ,  `tipohabitacion` 
FROM  `HABITACIONES` 
INNER JOIN  `USUARIO` ON  `idhotel` =  `hotelid` 
AND  `rsocial` =  '$usuario'
WHERE    `status` =  'reservado'
OR  `status` =  'libre' OR `status`=''
LIMIT 0 , 30");
			while($valores=mysql_fetch_array($query)){
			$valor=$valores['idhabitacion'];
			echo '<option value='.$valor.'> '.$valor.'</option>';
			}
			$valorstatus=$valores['status'];
			//conddicional para que se actualize el campo status de la tabla habitaciones
			if($valor){
			
			$statushab=mysql_query("UPDATE `HABITACIONES` SET `status`='$valorstatus' WHERE `idhabitacion`='$valor'");
			
			}
				?>
				</select>
				
				
			</h3>
			<h3>
				ESTATUS HABITACION:
				<input type="radio" name="stat" value="reservado"> RESERVADO
				<input type="radio" name="stat" value="bloqueado"> BLOQUEADO 
			</h3>
			<h3>
				NOTA:
				<input class="BarraNota" value="S/N" type="text" name="nota">
			</h3>
			<input type="hidden" name="hotel" value=<?php echo $hotelid; ?>
			
			<p>
				<button class="boton" type="submit" >
					GUARDAR
				</button>
			</p>
	</form>	
</body>
</html>
