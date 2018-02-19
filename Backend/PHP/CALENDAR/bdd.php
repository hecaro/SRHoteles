<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=srhotfai_srhotelesdb;charset=utf8', 'srhotfai_david', '5rHD@v1D20it');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
