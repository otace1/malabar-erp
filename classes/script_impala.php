<?php
	include('connexion.php');

	// //$requete = $connexion-> exec("update dossier_kcc_import set probleme = '1' WHERE remarque is not null ");
	// //echo '<br>'.$requete;
	// //Modifier Manuellement les poids en chaines de caractère Ex: AWBEWKCC002434
	// $requete = $connexion-> exec("update impala set cleared = '1' WHERE cleared = 'CLEARED'");
	// $requete = $connexion-> exec("update impala set cleared = '0' WHERE cleared = 'TRANSIT'");

	$requeteGetData = $connexion-> query('SELECT * FROM impala');
	while ($reponseGetData = $requeteGetData-> fetch()) {
		$reponseGetData['id_cli'] = '909';
		$reponseGetData['id_mod_trans'] = '3';
		$reponseGetData['id_trans'] = '1';

		if ($reponseGetData['date_dep_fbm']=='NULL' || $reponseGetData['date_dep_fbm']=='' || $reponseGetData['date_dep_fbm']==NULL) {
			$reponseGetData['date_dep_fbm'] = NULL;
		}
		if ($reponseGetData['date_transit']=='NULL' || $reponseGetData['date_transit']=='' || $reponseGetData['date_transit']==NULL) {
			$reponseGetData['date_transit'] = NULL;
		}
		if ($reponseGetData['date_fd']=='NULL' || $reponseGetData['date_fd']=='' || $reponseGetData['date_fd']==NULL) {
			$reponseGetData['date_fd'] = NULL;
		}
		if ($reponseGetData['deliv_date']=='NULL' || $reponseGetData['deliv_date']=='' || $reponseGetData['deliv_date']==NULL) {
			$reponseGetData['deliv_date'] = NULL;
		}
		

		$requeteInsertData = $connexion-> prepare("INSERT INTO dossier_logistique(ref_dos, id_util, road_manif, ref_batch, poids, origine, destination, date_dep_fbm, transit, date_transit, date_fd, deliv_date, statut, remarque, id_cli, id_mod_trans, id_trans)
															VALUES(?, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$requeteInsertData-> execute(array($reponseGetData['ref_dos'], $reponseGetData['road_manif'], $reponseGetData['ref_batch'], $reponseGetData['poids'], $reponseGetData['origine'], $reponseGetData['destination'], $reponseGetData['date_dep_fbm'], $reponseGetData['transit'], $reponseGetData['date_transit'], $reponseGetData['date_fd'], $reponseGetData['deliv_date'], $reponseGetData['statut'], $reponseGetData['remarque'], $reponseGetData['id_cli'], $reponseGetData['id_mod_trans'], $reponseGetData['id_trans']));

		echo '<br>ref_dos = '.$reponseGetData['ref_dos'];
		echo '<br>id_util = 1';
		echo '<br>road_manif = '.$reponseGetData['road_manif'];
		echo '<br>ref_batch = '.$reponseGetData['ref_batch'];
		echo '<br>poids = '.$reponseGetData['poids'];
		echo '<br>origine = '.$reponseGetData['origine'];
		echo '<br>destination = '.$reponseGetData['destination'];
		echo '<br>date_dep_fbm = '.$reponseGetData['date_dep_fbm'];
		echo '<br>transit = '.$reponseGetData['transit'];
		echo '<br>date_transit = '.$reponseGetData['date_transit'];
		echo '<br>date_fd = '.$reponseGetData['date_fd'];
		echo '<br>deliv_date = '.$reponseGetData['deliv_date'];
		echo '<br>statut = '.$reponseGetData['statut'];
		echo '<br>remarque = '.$reponseGetData['remarque'];
		echo '<br>id_cli = '.$reponseGetData['id_cli'];
		echo '<br>id_mod_trans = '.$reponseGetData['id_mod_trans'];
		echo '<br>id_trans = '.$reponseGetData['id_trans'];
		 echo '<br>------------------------<br>';
		 echo '<br>------------------------<br>';
		
	}$requeteGetData-> closeCursor();
?>