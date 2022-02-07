<?php
	include('connexion.php');

	// //$requete = $connexion-> exec("update dossier_kcc_import set probleme = '1' WHERE remarque is not null ");
	// //echo '<br>'.$requete;
	// //Modifier Manuellement les poids en chaines de caractère Ex: AWBEWKCC002434
	$requete = $connexion-> exec("update dossier_ccr_export set cleared = '1' WHERE cleared = 'CLEARED'");
	$requete = $connexion-> exec("update dossier_ccr_export set cleared = '0' WHERE cleared = 'TRANSIT'");

	$requeteGetData = $connexion-> query('SELECT * FROM dossier_ccr_export');
	while ($reponseGetData = $requeteGetData-> fetch()) {

		$requeteInsertData = $connexion-> prepare("INSERT INTO dossier(id_cli, id_util, id_march, id_mod_lic, id_mod_trans, ref_dos, num_lot, num_lic, horse, trailer_1, trailer_2, transporter, nbr_bags, poids, arrival_date, load_date, doc_receiv, pv_mine, demande_attestation, assay_date, ceec_in, ceec_out, min_div_in, min_div_out, date_decl, dgda_in, date_liq, date_quit, dgda_out, gov_in, gov_out, dispatch_date, klsa_arriv, end_form, exit_drc, cleared, statut, remarque)
															VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$requeteInsertData-> execute(array($reponseGetData['id_cli'], $reponseGetData['id_util'], $reponseGetData['id_march'], $reponseGetData['id_mod_lic'], $reponseGetData['id_mod_trans'], $reponseGetData['ref_dos'], $reponseGetData['num_lot'], $reponseGetData['num_lic'], $reponseGetData['horse'], $reponseGetData['trailer_1'], $reponseGetData['trailer_2'], $reponseGetData['transporter'], $reponseGetData['nbr_bags'], $reponseGetData['poids'], $reponseGetData['arrival_date'], $reponseGetData['load_date'], $reponseGetData['doc_receiv'], $reponseGetData['pv_mine'], $reponseGetData['demande_attestation'], $reponseGetData['assay_date'], $reponseGetData['ceec_in'], $reponseGetData['ceec_out'], $reponseGetData['min_div_in'], $reponseGetData['min_div_out'], $reponseGetData['date_decl'], $reponseGetData['dgda_in'], $reponseGetData['date_liq'], $reponseGetData['date_quit'], $reponseGetData['dgda_out'], $reponseGetData['gov_doc_in'], $reponseGetData['gov_doc_out'], $reponseGetData['dispatch_date'], $reponseGetData['klsa_arriv'], $reponseGetData['end_form'], $reponseGetData['exit_drc'], $reponseGetData['cleared'], $reponseGetData['statut'], $reponseGetData['remarque']));

		echo '<br>id_cli = '.$reponseGetData['id_cli'];
		echo '<br>id_util = '.$reponseGetData['id_util'];
		echo '<br>id_march = '.$reponseGetData['id_march'];
		echo '<br>id_mod_lic = '.$reponseGetData['id_mod_lic'];
		echo '<br>id_mod_trans = '.$reponseGetData['id_mod_trans'];
		echo '<br>ref_dos = '.$reponseGetData['ref_dos'];
		echo '<br>num_lot = '.$reponseGetData['num_lot'];
		echo '<br>num_lic = '.$reponseGetData['num_lic'];
		echo '<br>horse = '.$reponseGetData['horse'];
		echo '<br>trailer_1 = '.$reponseGetData['trailer_1'];
		echo '<br>trailer_2 = '.$reponseGetData['trailer_2'];
		echo '<br>transporter = '.$reponseGetData['transporter'];
		echo '<br>nbr_bags = '.$reponseGetData['nbr_bags'];
		echo '<br>poids = '.$reponseGetData['poids'];
		echo '<br>arrival_date = '.$reponseGetData['arrival_date'];
		echo '<br>load_date = '.$reponseGetData['load_date'];
		echo '<br>doc_receiv = '.$reponseGetData['doc_receiv'];
		echo '<br>pv_mine = '.$reponseGetData['pv_mine'];
		echo '<br>demande_attestation = '.$reponseGetData['demande_attestation'];
		echo '<br>assay_date = '.$reponseGetData['assay_date'];
		echo '<br>ceec_in = '.$reponseGetData['ceec_in'];
		echo '<br>ceec_out = '.$reponseGetData['ceec_out'];
		echo '<br>min_div_in = '.$reponseGetData['min_div_in'];
		echo '<br>min_div_out = '.$reponseGetData['min_div_out'];
		echo '<br>date_decl = '.$reponseGetData['date_decl'];
		echo '<br>dgda_in = '.$reponseGetData['dgda_in'];
		echo '<br>date_liq = '.$reponseGetData['date_liq'];
		echo '<br>date_quit = '.$reponseGetData['date_quit'];
		echo '<br>dgda_out = '.$reponseGetData['dgda_out'];
		echo '<br>gov_doc_in = '.$reponseGetData['gov_doc_in'];
		echo '<br>gov_doc_out = '.$reponseGetData['gov_doc_out'];
		echo '<br>dispatch_date = '.$reponseGetData['dispatch_date'];
		echo '<br>klsa_arriv = '.$reponseGetData['klsa_arriv'];
		echo '<br>end_form = '.$reponseGetData['end_form'];
		echo '<br>exit_drc = '.$reponseGetData['exit_drc'];
		echo '<br>cleared = '.$reponseGetData['cleared'];
		echo '<br>statut = '.$reponseGetData['statut'];
		echo '<br>remarque = '.$reponseGetData['remarque'];
		 echo '<br>------------------------<br>';
		 echo '<br>------------------------<br>';
		
	}$requeteGetData-> closeCursor();
?>