<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();

	if(!empty($_POST['num_lic'])){
		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob
											FROM dossier
											WHERE num_lic = ?");
		$requete-> execute(array($_POST['num_lic']));
		$reponse = $requete-> fetch();
		$reponse['fob'] = $maClasse-> getLicence($_POST['num_lic'])['fob']-$reponse['fob'];

		$reponse['fob'] = '<input type="number" name="fob" max="'.$reponse['fob'].'" step="0.01" class="form-control cc-exp">';

		$reponse['cod'] = '<input type="text" name="cod" value="'.$maClasse-> getLicence($_POST['num_lic'])['cod'].'" class="form-control cc-exp">';

		//return $reponse;
		echo json_encode($reponse);
		
	}
?>