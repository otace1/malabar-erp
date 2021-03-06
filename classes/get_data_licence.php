<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();

	if(!empty($_POST['num_lic']) && ($_POST['num_lic']=='UNDER VALUE')){
		$reponse['fob'] = '<input type="number" name="fob" step="0.01" class="form-control cc-exp">';

		$reponse['cod'] = '<input type="text" name="cod" value="" class="form-control cc-exp">';

		$reponse['poids'] = '<input type="text" name="poids" value="" class="form-control cc-exp">';

		//return $reponse;
		echo json_encode($reponse);
	}else if(!empty($_POST['num_lic'])){
		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob, SUM(poids) AS poids
											FROM dossier
											WHERE num_lic = ?");
		$requete-> execute(array($_POST['num_lic']));
		$reponse = $requete-> fetch();
		$reponse['fob'] = $maClasse-> getLicence($_POST['num_lic'])['fob']-$reponse['fob'];
		$reponse['poids'] = $maClasse-> getLicence($_POST['num_lic'])['poids_lic']-$reponse['poids'];

		$reponse['fob'] = '<input type="number" name="fob" max="'.$reponse['fob'].'" step="0.01" class="form-control cc-exp">';

		$reponse['poids'] = '<input type="number" name="poids" max="'.$reponse['poids'].'" step="0.01" class="form-control cc-exp">';

		$reponse['cod'] = '<input type="text" name="cod" value="'.$maClasse-> getLicence($_POST['num_lic'])['cod'].'" class="form-control cc-exp">';

		//return $reponse;
		echo json_encode($reponse);
		
	}
?>