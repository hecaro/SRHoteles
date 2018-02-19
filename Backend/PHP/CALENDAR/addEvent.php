<?php

// Connexion à la base de données
require_once('bdd.php');
//echo $_POST['title'];
session_start();
$usuario=$_SESSION['rsocial'];
$user=$_SESSION['user'];
$clave=$_SESSION['clave'];
$idhotel=$_SESSION['hotelid'];
session_write_close();
if (isset($_POST['title']) && isset($_POST['start']) && isset($_POST['end']) && isset($_POST['color'])){
	
	$title = $_POST['title'];
	$start = $_POST['start'];
	$end = $_POST['end'];
	$color = $_POST['color'];

	$sql = "INSERT INTO events(title, start, end, color,razonsocial) values ('$title', '$start', '$end', '$color','$usuario')";
	//$req = $bdd->prepare($sql);
	//$req->execute();
	
	echo $sql;
	
	$query = $bdd->prepare( $sql );
	if ($query == false) {
	 print_r($bdd->errorInfo());
	 die ('Erreur prepare');
	}
	$sth = $query->execute();
	if ($sth == false) {
	 print_r($query->errorInfo());
	 die ('Erreur execute');
	}

}
header('Location: '.$_SERVER['HTTP_REFERER']);

	
?>
