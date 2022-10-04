<?php
	require_once("connexion.php");
	require_once("maClasse.class.php");
	$maClasse = new MaClasse();

	if(!empty($_POST['num_lic']) && ($_POST['num_lic']=='UNDER VALUE')){
		$reponse['fob'] = '<input type="number" name="fob" step="0.01" class="form-control form-control-sm cc-exp">';

		$reponse['cod'] = '<input type="text" name="cod" value="" class="form-control form-control-sm cc-exp">';

		$reponse['poids'] = '<input type="text" name="poids" value="" class="form-control form-control-sm cc-exp">';
		$reponse['id_part'] = '<select name="id_part" class="form-control form-control-sm cc-exp"></select>';

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
		$reponse['balance_fob_licence'] = '<input type="text" style="text-align: right;" name="fob" value="'.number_format($reponse['fob'], 2, ',', ' ').'" class="form-control bg bg-dark cc-exp" disabled>';
		$reponse['balance_poids_licence'] = '';

		$reponse['fob'] = '<input type="number" name="fob" max="'.$reponse['fob'].'" step="0.01" class="form-control form-control-sm cc-exp">';

		$reponse['poids'] = '<input type="number" name="poids" max="'.$reponse['poids'].'" step="0.01" class="form-control form-control-sm cc-exp">';

		$reponse['cod'] = '<input type="text" value="'.$maClasse-> getLicence($_POST['num_lic'])['cod'].'" class="form-control bg bg-dark cc-exp" disabled>';

		if (isset($maClasse-> getLicence($_POST['num_lic'])['cod']) && ($maClasse-> getLicence($_POST['num_lic'])['cod']!='')) {
			$reponse['plus'] = '<span class="btn-primary btn-xs" onclick="window.open(\'partielle_av.php?cod='.$maClasse-> getLicence($_POST['num_lic'])['cod'].'&fob_lic='.$maClasse-> getLicence($_POST['num_lic'])['fob'].'&poids_lic='.$maClasse-> getLicence($_POST['num_lic'])['poids'].'\',\'pop1\',\'width=900,height=600\');"><i class="fa fa-plus"></i></span>';
		}else{
			$reponse['plus'] = '<span class="btn-primary btn-xs" onclick="alert(\'Impossible de creer une partielle, veuillez renseigner le COD de la licence!\');"><i class="fa fa-plus"></i></span>';
		}
		
		$reponse['id_part'] = '<select name="id_part" class="form-control form-control-sm cc-exp" onchange="getDataPartielle(this.value);" required>
								<option></option>
								';
		$requetePartielle = $connexion-> prepare("SELECT *
													FROM partielle_av
													WHERE cod = ?");
		$requetePartielle-> execute(array($maClasse-> getLicence($_POST['num_lic'])['cod']));
		while($reponsePartielle = $requetePartielle-> fetch()){

			$reponse['id_part'] .= '<option value="'.$reponsePartielle['id_part'].'">'.$reponsePartielle['num_part'].'</option>';

		}$requetePartielle-> closeCursor();

		$reponse['id_part'] .= '</select>';

		//return $reponse;
		echo json_encode($reponse);
		
	}
?>