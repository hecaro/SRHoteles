<?php 
 
 session_start();
$usuario=$_SESSION['rsocial'];
$estado = false;

if(isset($usuario)){
	$estado=true;

}


?>