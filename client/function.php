<?php

function getRecords(){
	include('../classes/connexion.php');

	$statement = $connexion-> prepare("SELECT * FROM dossier");
	$statement-> execute();
	return $statement-> rowCount();
}

?>