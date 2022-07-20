<?php
	include('connexion.php');
	$compteur = 0;
	$insertColonne['rang'] = 0; 

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

				$insertColonne['id_mod_trans'] = $reponseColonne['id_mod_trans'];

			//Insertion Regime
				//Route
			if($reponseColonne['id_mod_trans']=='1' && $reponseColonne['id_col']=='16'){
				$insertColonne['rang'] = $reponseColonne['rang']+0.01;
				$insertColonne['id_col'] = 118;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', '1', ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['rang']));

				$insertColonne['rang'] = $reponseColonne['rang']+0.02;
				$insertColonne['id_col'] = 113;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', '1', ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['rang']));
			}
				//Air
			if(($reponseColonne['id_mod_trans']=='3'||$reponseColonne['id_mod_trans']=='4') && ($reponseColonne['id_col']=='47' || $reponseColonne['id_col']=='94')){
				$insertColonne['rang'] = $reponseColonne['rang']+0.01;
				$insertColonne['id_col'] = 118;
				$insertColonne['id_mod_trans'] = $reponseColonne['id_mod_trans'];

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));

				$insertColonne['rang'] = $reponseColonne['rang']+0.02;
				$insertColonne['id_col'] = 113;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));
			}
			//Fin Insertion Regime

			//Insertion Border warehouse
			if($reponseColonne['id_col']=='114'){
				$insertColonne['rang'] = $reponseColonne['rang']+0.01;
				$insertColonne['id_col'] = 115;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));
			}
			//Fin Insertion Border warehouse

			//Insertion Border Arrival Date
			if($reponseColonne['id_col']=='116'){
				$insertColonne['rang'] = $reponseColonne['rang']-0.02;
				$insertColonne['id_col'] = 114;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));
			}
			//Fin Insertion Border Arrival Date

			//Insertion Border warehouse arrival date
			if($reponseColonne['id_col']=='117'){
				$insertColonne['rang'] = $reponseColonne['rang']-0.01;
				$insertColonne['id_col'] = 116;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));
			}
			//Fin Insertion Border warehouse arrival date

			//Insertion Border Arrival Date
			if($reponseColonne['id_col']=='113'){
				$insertColonne['rang'] = $reponseColonne['rang']+0.01;
				$insertColonne['id_col'] = 114;

				$requeteCreationColonne = $connexion-> prepare("INSERT INTO affectation_colonne_client_modele_licence(id_col, id_cli, id_mod_lic, id_mod_trans, rang, id_march) 
															VALUES (?, ?, '2', ?, ?, NULL);");
				$requeteCreationColonne-> execute(array($insertColonne['id_col'], $reponseColonne['id_cli'], $insertColonne['id_mod_trans'], $insertColonne['rang']));
			}
			//Fin Insertion Border Arrival Date

		}$requeteColonne-> closeCursor();
		//FIN Recuperation Colonne Import


	}$requeteClient-> closeCursor();

	//delete from affectation_colonne_client_modele_licence where id_col = 118 or id_col = 113 or id_col = 115 or id_col = 116 or id_col = 114 
?>