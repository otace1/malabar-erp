<?php
	include('connexion.php');
	$compteur = 0;

	$requeteClient = $connexion-> query("SELECT *
											FROM client");
	while ($reponseClient = $requeteClient-> fetch()) {
		$compteur++;

		//Recuperation Colonne Import
		$requeteColonne = $connexion-> prepare("SELECT * 
													FROM affectation_colonne_client_modele_licence
													WHERE id_mod_lic = 2
														AND id_cli = ?");
		$requeteColonne-> execute(array($reponseClient['id_cli']));
		while($reponseColonne = $requeteColonne-> fetch()){

			//Insertion Regime
				//Route
			if($reponseColonne['id_mod_trans']=='1' && $reponseColonne['id_col']=='16'){
				$reponseColonne['rang'] += 0.01;
				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', '1', ?, NULL);");
				$
			}
			//Fin Insertion Regime

		}$requeteColonne-> closeCursor();
		//FIN Recuperation Colonne Import

		//Créer Utilisateur Client
		

		$requeteCreationUtilisateur = $connexion-> prepare("INSERT INTO utilisateur(nom_util, pseudo_util, 
																		pass_util, id_role, tracking_delete, id_cli)
																VALUES(?, ?, ?, ?, '0', ?)");

		for ($s = '', $i = 0, $z = strlen($a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789!(!)-$=:;')-1; $i != 10; $x = rand(0,$z), $s .= $a{$x}, $i++); 

		$entree['pass_util'] = $s;
		echo '<br>----<br>'.$compteur.'<br>Client = '.$reponseClient['nom_cli'].'<br>Code = '.$reponseClient['code_cli'].'<br> password = '.$s;

		$requeteCreationUtilisateur-> execute(array($reponseClient['nom_cli'], $reponseClient['code_cli'], $entree['pass_util'], '4', $reponseClient['id_cli']));

		$requeteCreationUtilisateur = $connexion-> prepare("SELECT * FROM utilisateur 
																WHERE pseudo_util = ?
																	AND pass_util = ?");
		$requeteCreationUtilisateur-> execute(array($reponseClient['code_cli'], $entree['pass_util']));
		$reponseCreationUtilisateur = $requeteCreationUtilisateur-> fetch();
		echo '<br>ID UTIL = '.$reponseCreationUtilisateur['id_util'];
		//FIN Créer Utilisateur Client

		//Affectation Modele Licence
		$requeteModeleLicence = $connexion-> prepare("SELECT * 
														FROM affectation_client_modele_licence
														WHERE id_cli = ?
															AND id_etat = '1'");
		$requeteModeleLicence-> execute(array($reponseClient['id_cli']));
		while ($reponseModeleLicence = $requeteModeleLicence-> fetch()) {
			
			//Affectation Utilisateur Client
			$requeteAffectationClientutilisateur = $connexion-> prepare("INSERT INTO affectation_utilisateur_client(id_util, id_cli, id_role, actif) VALUES(?, ?, '4', '1')");
			$requeteAffectationClientutilisateur-> execute(array($reponseCreationUtilisateur['id_util'], $reponseClient['id_cli']));
			//FIN Affectation Utilisateur Client

		}$requeteModeleLicence-> closeCursor();
		//Fin Affectation Modele Licence


	}$requeteClient-> closeCursor();
?>