<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();
	

	if(!empty($_POST['num_lic']) && ($_POST['num_lic']=='UNDER VALUE')){
		$reponse['balance_fob_licence'] = '<input type="text" name="balance_fob_licence" value="$ 2 500" disabled class="form-control cc-exp bg-dark">';
		$reponse['balance_poids_licence'] = '<input type="text" name="balance_poids_licence" value="-" disabled class="form-control cc-exp bg-dark">';
	}else if(!empty($_POST['num_lic'])){
		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob, SUM(poids) AS poids
											FROM dossier
											WHERE num_lic = ?");
		$requete-> execute(array($_POST['num_lic']));
		$reponse = $requete-> fetch();
		$reponse['fob'] = $maClasse-> getLicence($_POST['num_lic'])['fob']-$reponse['fob'];
		$reponse['poids'] = $maClasse-> getLicence($_POST['num_lic'])['poids_lic']-$reponse['poids'];
		$reponse['balance_fob_licence'] = '<input type="text" name="balance_fob_licence" value="'.number_format($reponse['fob'], 2, ',', ' ').'" disabled class="form-control cc-exp bg-dark">';
		$reponse['balance_poids_licence'] = '<input type="text" name="balance_poids_licence" value="'.number_format($reponse['poids'], 2, ',', ' ').'" disabled class="form-control cc-exp bg-dark">';
	}

	echo json_encode($reponse);
?>