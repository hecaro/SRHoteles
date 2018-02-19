<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf8_spanish_ci">
	
	
	<link rel="stylesheet" type="text/css" href="../CSS/IngresarHuesped.css">
	<link rel="shortcut icon" href="../Recursos/icon.png">
	<title>Buscar Hotel - SRHoteles</title>
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
		<a  href="../../index.html"><img src="../../Recursos/salida.png" id="botcierre" width="25" height="25"/></a>
	</header>
	<header class="BarraMenu" id="CabeceraPrincipal">
		<a id="logoTemp" href="../../Frontend/HTML/MenuAdminSist.php"><h1 class="LC">SRH</h1></a>
	</header>
	<?php

//Conectar a la base de datos
$conectar=@mysql_connect('localhost','srhotfai_david','5rHD@v1D20it');
header("Content-Type: text/html;charset=utf8_spanish_ci");
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
session_write_close();
$busqhotel=isset($_POST['busqhotel']) ? $_POST['busqhotel'] : "";

//evalua en las variables de sesion hay algun resultado y prosigue con la sentencia
if (isset($_SESSION['user']) && ($_SESSION['clave']) ){

//Ejecutar Sentencia 
$sqlsave=mysql_query("SELECT `rsocial`,`identh`,`telefono`,`mail`,`pais`,`provincia`,`ciudad`,`direccion` FROM `USUARIO` WHERE 	`rsocial`='$busqhotel'");
$sql=mysql_fetch_array($sqlsave);
$rsocial=$sql['rsocial'];
$identh=$sql['identh'];
$telefono=$sql['telefono'];
$mail=$sql['mail'];
$pais=$sql['pais'];
$provincia=$sql['provincia'];
$ciudad=$sql['ciudad'];
$direccion=$sql['direccion'];
//cndicion si guada con la sentencia imprime el resultado
if($sqlsave){
	echo "<div class=Titulo><h1 class=FR>FORMULARIO DE EDICION HABITACION</h1><div class=CuadroExt>";
	echo "<h3><div class=BarraTexto>USUARIO:  "; echo $usuario;
	echo "<form method=post target=_blank action=../../Backend/PHP/editarhotel.php>" ;
	echo "<h3>RAZON SOCIAL:<input class=BarraTexto id=rz type=text name=rsocial value=$rsocial></br></h3>";
	echo "<h3>  IDENTFICACION:	<input class=BarraNumero id=identh  type=text readonly=readonly name=identh value='$identh'></br></h3>";
	echo "<h3>TELEFONO: <input class=BarraNumero id=telef type=text name=telefono value='$telefono'></br></h3>";
	echo "<h3>MAIL: <input class=BarraTexto id=mail type=text name=mail value='$mail'</br></h3>";
	echo "<h3>PAIS: <input class=BarraTexto id=pais type=text name=pais value='$pais'</br></h3>";
	echo "<h3>PROVINCIA: <input class=BarraTexto id=prov type=text name=provincia value='$provincia'</br></h3>";
	echo "<h3>CIUDAD: <input class=BarraTexto id=ciudad type=text name=ciudad value='$ciudad'</br></h3>";
	echo "<h3>DIRECCION: <input class=BarraTexto id=dir type=text name=direccion value='$direccion'</br></h3>";
	echo "<h3><button class=boton type=submit >
					EDITAR
				</button> </h3>";
	echo "</div>";
	echo "</form>";
}

else{
echo "no guardo";
die("Ha fallado el acceso a la base de datos: " . mysql_error());
}
}
?>

	
	
</body>
</html>