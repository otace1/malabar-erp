<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();

	if(!empty($_POST['id_part'])){
		$requete = $connexion-> prepare("SELECT SUM(fob) AS fob, SUM(poids) AS poids
											FROM dossier
											WHERE replace(cod, ' ', '') = ?");
		$requete-> execute(array(str_replace(' ', '', $maClasse-> getPartielleID($_POST['id_part'])['cod'].$maClasse-> getPartielleID($_POST['id_part'])['num_part'])));
		$reponse = $requete-> fetch();
		$reponse['fob_old'] = str_replace(' ', '', $maClasse-> getPartielleID($_POST['id_part'])['cod'].$maClasse-> getPartielleID($_POST['id_part'])['num_part']);
		$reponse['fob_part'] = $maClasse-> getPartielleID($_POST['id_part'])['fob'];
		$reponse['fob_dossier'] = $reponse['fob'];
		$reponse['poids_old'] = $maClasse-> getPartielleID($_POST['id_part'])['poids']-$reponse['poids'];
		$reponse['fob'] = $maClasse-> getPartielleID($_POST['id_part'])['fob']-$reponse['fob'];
		$reponse['poids'] = $maClasse-> getPartielleID($_POST['id_part'])['poids']-$reponse['poids'];


		$reponse['balance_fob_partielle'] = '<input type="text" value="'.$reponse['fob'].'" class="form-control cc-exp bg bg-dark" disabled>';

		$reponse['balance_poids_licence'] = '<input type="text" value="'.$reponse['poids'].'" class="form-control cc-exp bg bg-dark" disabled>';


		$reponse['fob'] = '<input type="number" name="fob" step="0.01" class="form-control cc-exp">';

		$reponse['poids'] = '<input type="number" name="poids" max="'.$reponse['poids'].'" step="0.01" class="form-control cc-exp">';

		$reponse['cod_hidden'] = '<input type="hidden" name="cod" value="'.$maClasse-> getPartielleID($_POST['id_part'])['cod'].' '.$maClasse-> getPartielleID($_POST['id_part'])['num_part'].'" class="form-control cc-exp">';
		// $reponse['plus'] = '<span class="btn-primary btn-xs" onclick="window.open(\'partielle_av.php?cod='.$maClasse-> getLicence($_POST['num_lic'])['cod'].'&fob_lic='.$maClasse-> getLicence($_POST['num_lic'])['fob'].'&poids_lic='.$maClasse-> getLicence($_POST['num_lic'])['poids'].'\',\'pop1\',\'width=900,height=600\');"><i class="fa fa-plus"></i></span>';
		// $reponse['id_part'] = '<select name="id_part" class="form-control cc-exp" required>
		// 						<option></option>
		// // 						';
		// $requetePartielle = $connexion-> prepare("SELECT *
		// 											FROM partielle_av
		// 											WHERE cod = ?");
		// $requetePartielle-> execute(array($maClasse-> getLicence($_POST['num_lic'])['cod']));
		// while($reponsePartielle = $requetePartielle-> fetch()){

		// 	$reponse['id_part'] .= '<option value="'.$reponsePartielle['num_part'].'">'.$reponsePartielle['num_part'].'</option>';

		// }$requetePartielle-> closeCursor();

		// $reponse['id_part'] .= '</select>';

		//return $reponse;
		echo json_encode($reponse);
		
	}
?>