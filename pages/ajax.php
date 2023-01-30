<?php
	session_start();
	include('../classes/maClasse.class.php');
	$maClasse = new MaClasse();

	if(!isset($_SESSION['id_util'])){// Si la session a expiree ont deconneccte

        $response['logout'] = 'Your session has expired, please log in again';
        echo json_encode($response);

  	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauExportInvoiceSingle'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauImportInvoiceSingle'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureExportSingle'){// On enregistre la facture Export Single

  		if(isset($_POST['ref_fact'])){
  			try {
  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'partielle', NULL);
  			$maClasse-> MAJ_roe_decl($_POST['id_dos'], $_POST['roe_decl']);

  			for ($i=1; $i <= 24 ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {
  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i]);
  				}
  				
  			}

  			$response = array('message' => 'Invoice Created');
  			$response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
  			$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);exit;
	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureExportMultiple'){// On enregistre la facture Export Multiple

		if (isset($_POST['nbre'])) {
			
			if(isset($_POST['ref_fact'])){
	  			try {
	  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

  					if((isset($_POST['dde'.$i]) && ($_POST['dde'.$i]>1) && isset($_POST['roe_decl_'.$i]) && ($_POST['roe_decl_'.$i]>1)) || isset($_POST['check_'.$i]) ){

  						$poids = $maClasse-> getDossier($_POST['id_dos_'.$i])['poids'];
  							
						//MAJ ROE
	  					$maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);

  						if(isset($_POST['dde_'.$i]) && ($_POST['dde_'.$i]>1)){

		  					//---- TAXES ----

		  					//Inserer DDE
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 2, $_POST['dde_'.$i], '0', '0');

  						}
	  					
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 1, $_POST['rie_'.$i], $_POST['rie_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 3, $_POST['rls_'.$i], $_POST['rls_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 37, $_POST['cso_'.$i], $_POST['cso_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 4, $_POST['fsr_'.$i], $_POST['fsr_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 7, $_POST['gov_tax_'.$i], $_POST['gov_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 8, $_POST['concentrate_tax_'.$i], $_POST['concentrate_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 5, $_POST['fere_'.$i], $_POST['fere_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 6, $_POST['lmc_'.$i], $_POST['lmc_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 9, $_POST['occ_samp_'.$i], $_POST['occ_samp_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 10, $_POST['occ_cgea_'.$i], $_POST['occ_cgea_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, $_POST['ceec_30_'.$i], $_POST['ceec_30_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 12, $_POST['ceec_60_'.$i], $_POST['ceec_60_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 13, $_POST['dgda_seal_'.$i], $_POST['dgda_seal_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 15, $_POST['assay_'.$i], $_POST['assay_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 18, $_POST['occ_fees_'.$i], $_POST['occ_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 17, $_POST['com_ext_'.$i], $_POST['com_ext_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 14, $_POST['nac_'.$i], $_POST['nac_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 22, $_POST['klsa_border_'.$i], $_POST['klsa_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 57, $_POST['sncc_lshi_'.$i], $_POST['sncc_lshi_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 56, $_POST['sakania_border_'.$i], $_POST['sakania_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 53, $_POST['ceec_fees_'.$i], $_POST['ceec_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 16, $_POST['mine_div_'.$i], $_POST['mine_div_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 25, $_POST['mine_police_'.$i], $_POST['mine_police_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 26, $_POST['anr_'.$i], $_POST['anr_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 27, $_POST['dgda_ops_'.$i], $_POST['dgda_ops_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 28, $_POST['print_'.$i], $_POST['print_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 29, $_POST['bank_'.$i], $_POST['bank_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 30, $_POST['kisanga_'.$i], $_POST['kisanga_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 31, $_POST['transfert_'.$i], $_POST['transfert_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 19, $_POST['preclarence_'.$i], $_POST['preclarence_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 20, $_POST['cost_intern_'.$i], $_POST['cost_intern_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 58, $_POST['other_service_'.$i], $_POST['other_service_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 21, $_POST['frais_agence_'.$i], $_POST['frais_agence_tva_'.$i], '1');

	  					//1.5% Finance Cost
	  					if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.015;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 54, $somme_taxe, '0', '1');

	  						// $response['somme_taxe'] = $somme_taxe;
	  					} 

  					}

	  			}
	  				
	  			

	  			// $response['somme_taxe'] = $maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb'];
	  			$response['message'] = 'Invoice Created';
	  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
	  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

	  			} catch (Exception $e) {

		            $response = array('error' => $e->getMessage());

		        }

	  		}

		}

  		// $response = array('message' => 'Invoice Created');

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_facture'){// On recupere les donnees du dossier a facturer 

  		$reponse['tableau_modele_facture'] = $maClasse-> getModeleFacturation($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_send_invoice'){// On recupere les donnees du dossier a facturer 

  		$reponse['tableau_email'] = $maClasse-> getAdresseMailFacturation($_POST['ref_fact']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='send_invoice_mail'){// On recupere les donnees du dossier a facturer 

		include($maClasse-> getDataModeleFacture($maClasse-> getFactureGlobale($_POST['ref_fact'])['id_mod_fact'])['save']);
		include($maClasse-> getDataModeleFacture($maClasse-> getFactureGlobale($_POST['ref_fact'])['id_mod_fact'])['save_excel']);

		include('send_invoice_mail.php');

		$maClasse-> MAJ_send_mail_facture_dossier($_POST['ref_fact'], $_SESSION['id_util']);
		
  		$reponse['tableau_email'] = $maClasse-> getAdresseMailFacturation($_POST['ref_fact']);
		$reponse = array('message' => 'Email sended');

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getAllInvoices'){// On recupere les donnees du dossier a facturer 

  		$reponse['invoice_pending_validation'] = $maClasse-> getInvoicePendingValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_pending_validation'] = $maClasse-> getNombreFactureDossierEnAttenteValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_waiting_to_send'] = $maClasse-> getInvoiceAwaitingToSend($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_waiting_to_send'] = $maClasse-> getNombreFactureDossierEnAttenteEnvoie($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_send'] = $maClasse-> getInvoiceSended($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_send'] = $maClasse-> getNombreFactureDossierEnvoyee($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='validerFacture'){// On recupere les donnees du dossier a facturer 

		$maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact'], '1');

  		$reponse['invoice_pending_validation'] = $maClasse-> getInvoicePendingValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_pending_validation'] = $maClasse-> getNombreFactureDossierEnAttenteValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_waiting_to_send'] = $maClasse-> getInvoiceAwaitingToSend($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_waiting_to_send'] = $maClasse-> getNombreFactureDossierEnAttenteEnvoie($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimerFacture'){// On recupere les donnees du dossier a facturer 

		$maClasse-> supprimerFactureDossier($_POST['ref_fact']);

  		$reponse['invoice_pending_validation'] = $maClasse-> getInvoicePendingValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_pending_validation'] = $maClasse-> getNombreFactureDossierEnAttenteValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_waiting_to_send'] = $maClasse-> getInvoiceAwaitingToSend($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_waiting_to_send'] = $maClasse-> getNombreFactureDossierEnAttenteEnvoie($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='searchInvoice'){// On recupere les donnees du dossier a facturer 

  		$reponse['results_searchInvoice'] = $maClasse-> getInvoiceSearched($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['ref_fact']);
  		$reponse['nbre_searchInvoice'] = $maClasse-> getNbreInvoiceSearched($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['ref_fact']);

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='creerFactureAcide'){// On recupere les donnees du dossier a facturer 
  		
  		$reponse['dossiers_a_facturer'] = $maClasse-> getDossierPourFacturationClientModeleLicence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_mod_trans'], $_POST['id_march']);

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='getDataDossier'){// On recupere les donnees du dossier a facturer 

		if(!empty($_POST['id_dos'])){
			$reponse['commodity'] = $maClasse-> getDossier($_POST['id_dos'])['commodity'];
			$reponse['roe_decl'] = $maClasse-> getDossier($_POST['id_dos'])['roe_decl'];
	  		$reponse['camion'] = $maClasse-> getDossier($_POST['id_dos'])['horse'].' / '.$maClasse-> getDossier($_POST['id_dos'])['trailer_1'].' / '.$maClasse-> getDossier($_POST['id_dos'])['trailer_2'];
	  		$reponse['declaration'] = $maClasse-> getDossier($_POST['id_dos'])['ref_decl'].' du '.$maClasse-> getDossier($_POST['id_dos'])['date_decl'];
	  		$reponse['liquidation'] = $maClasse-> getDossier($_POST['id_dos'])['ref_liq'].' du '.$maClasse-> getDossier($_POST['id_dos'])['date_liq'];
	  		$reponse['quittance'] = $maClasse-> getDossier($_POST['id_dos'])['ref_quit'].' du '.$maClasse-> getDossier($_POST['id_dos'])['date_quit'];
	  		
	  		$reponse['suivi_dossier'] = 260;
			$reponse['occ_lab'] = 104.4;
			$reponse['scelle'] = 40;
			$reponse['quarantaine'] = 10;
			$reponse['localisation'] = 25;
			$reponse['nac'] = 25;

			$reponse['seguce'] = 120;
			$reponse['bivac'] = 45;
			$reponse['dgda'] = 115;
			$reponse['occ'] = 30;
			$reponse['transit'] = 70;
			$reponse['cout_operation'] = 75;
			$reponse['frais_agence'] = 170;

		}else{
			$reponse['suivi_dossier'] = '';
			$reponse['occ_lab'] = '';
			$reponse['scelle'] = '';
			$reponse['quarantaine'] = '';
			$reponse['localisation'] = '';
			$reponse['nac'] = '';
			$reponse['total'] = '';
			$reponse['cout_auxil'] = '';
			$reponse['scelle'] = '';

			$reponse['seguce'] = '';
			$reponse['bivac'] = '';
			$reponse['dgda'] = '';
			$reponse['occ'] = '';
			$reponse['transit'] = '';
			$reponse['cout_operation'] = '';
			$reponse['frais_agence'] = '';
		}
  		
  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='creerDetailFactureDossierACID'){// On recupere les donnees du dossier a facturer 

		//On test si la facture existe deja
		if (empty($maClasse-> getFactureGlobale($_POST['ref_fact']))) {
			
  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);
		}

		$maClasse-> MAJ_roe_decl($_POST['id_dos'], $_POST['roe_decl']);

  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 32, $_POST['ddi'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 3, $_POST['rls'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 33, $_POST['qpt'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 34, $_POST['tpi'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 35, $_POST['cog'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 36, $_POST['rco'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 37, $_POST['cso'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 38, $_POST['rii'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 39, $_POST['ret'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 40, $_POST['ran'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 41, $_POST['ana'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 42, $_POST['lab'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 43, $_POST['roc'], '0', '0');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 52, $_POST['suivi_dossier'], '0', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 45, $_POST['scelle'], '0', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 51, $_POST['quarantaine'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 49, $_POST['localisation'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 44, $_POST['seguce'], '0', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 46, $_POST['bivac'], '0', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 27, $_POST['dgda'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 48, $_POST['occ'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 50, $_POST['transit'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 20, $_POST['cout_operation'], '1', '1');
  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], 21, $_POST['frais_agence'], '1', '1');

  		$reponse['dossiers_a_facturer'] = $maClasse-> getDossierPourFacturationClientModeleLicence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_mod_trans'], $_POST['id_march']);
  		$reponse['detail_facture_dossier'] = '';//$maClasse-> getDetatilFactureDossierCDM($_POST['ref_fact']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='editFactureExportMultiple'){// On modifie la facture Export Multiple

		if (isset($_POST['nbre'])) {
			
			if(isset($_POST['ref_fact'])){
	  			try {

	  				$maClasse-> supprimerFactureDossier($_POST['ref_fact']);

	  				$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

  					if((isset($_POST['dde'.$i]) && ($_POST['dde'.$i]>1) && isset($_POST['roe_decl_'.$i]) && ($_POST['roe_decl_'.$i]>1)) || isset($_POST['check_'.$i]) ){

  						$poids = $maClasse-> getDossier($_POST['id_dos_'.$i])['poids'];
  							
						//MAJ ROE
	  					$maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);

  						if(isset($_POST['dde_'.$i]) && ($_POST['dde_'.$i]>1)){

		  					//---- TAXES ----

		  					//Inserer DDE
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 2, $_POST['dde_'.$i], '0', '0');

  						}
	  					
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 1, $_POST['rie_'.$i], $_POST['rie_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 3, $_POST['rls_'.$i], $_POST['rls_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 37, $_POST['cso_'.$i], $_POST['cso_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 4, $_POST['fsr_'.$i], $_POST['fsr_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 7, $_POST['gov_tax_'.$i], $_POST['gov_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 8, $_POST['concentrate_tax_'.$i], $_POST['concentrate_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 5, $_POST['fere_'.$i], $_POST['fere_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 6, $_POST['lmc_'.$i], $_POST['lmc_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 9, $_POST['occ_samp_'.$i], $_POST['occ_samp_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 10, $_POST['occ_cgea_'.$i], $_POST['occ_cgea_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, $_POST['ceec_30_'.$i], $_POST['ceec_30_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 12, $_POST['ceec_60_'.$i], $_POST['ceec_60_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 13, $_POST['dgda_seal_'.$i], $_POST['dgda_seal_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 15, $_POST['assay_'.$i], $_POST['assay_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 18, $_POST['occ_fees_'.$i], $_POST['occ_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 17, $_POST['com_ext_'.$i], $_POST['com_ext_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 14, $_POST['nac_'.$i], $_POST['nac_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 22, $_POST['klsa_border_'.$i], $_POST['klsa_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 57, $_POST['sncc_lshi_'.$i], $_POST['sncc_lshi_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 56, $_POST['sakania_border_'.$i], $_POST['sakania_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 53, $_POST['ceec_fees_'.$i], $_POST['ceec_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 16, $_POST['mine_div_'.$i], $_POST['mine_div_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 25, $_POST['mine_police_'.$i], $_POST['mine_police_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 26, $_POST['anr_'.$i], $_POST['anr_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 27, $_POST['dgda_ops_'.$i], $_POST['dgda_ops_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 28, $_POST['print_'.$i], $_POST['print_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 29, $_POST['bank_'.$i], $_POST['bank_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 30, $_POST['kisanga_'.$i], $_POST['kisanga_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 31, $_POST['transfert_'.$i], $_POST['transfert_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 20, $_POST['preclarence_'.$i], $_POST['preclarence_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 20, $_POST['cost_intern_'.$i], $_POST['cost_intern_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 58, $_POST['other_service_'.$i], $_POST['other_service_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 21, $_POST['frais_agence_'.$i], $_POST['frais_agence_tva_'.$i], '1');

	  					//1.5% Finance Cost
	  					if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.015;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 54, $somme_taxe, '0', '1');

	  						// $response['somme_taxe'] = $somme_taxe;
	  					} 

  					}

	  			}
	  				
	  			

	  			// $response['somme_taxe'] = $maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb'];
	  			$response['message'] = 'Invoice Updated';
	  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
	  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

	  			} catch (Exception $e) {

		            $response = array('error' => $e->getMessage());

		        }

	  		}

		}

  		// $response = array('message' => 'Invoice Created');

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='rapportFacturation'){ // On Recupere les data pour rapport facturation
		$response['nbre_facture'] = $maClasse-> getNbreFacture();
		$response['nbre_dossier_facture'] = $maClasse-> getNbreDossierFacture();
		$response['nbre_dossier_non_facture'] = $maClasse-> getNbreDossierNonFacture();
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpFacture'){ // On Recupere les data pour rapport facturation Popup
		echo json_encode($maClasse-> getListeFactures($_POST['statut']));
	}elseif(isset($_POST['operation']) && $_POST['operation']=='rapportOperations'){ // On Recupere les data pour rapport Operations
		$response['nbre_dossier_encours'] = $maClasse-> getNbreDossier('Dossiers En Cours');
		$response['nbre_dossier_non_declare'] = $maClasse-> getNbreDossier('Dossiers non declarés');
		$response['nbre_dossier_non_liquide'] = $maClasse-> getNbreDossier('Dossiers Declarés Non Liquidés');
		$response['nbre_dossier_sans_quittance'] = $maClasse-> getNbreDossier('Dossiers En Attente Quittance');
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpOperations'){ // On Recupere les data pour rapport Operations Popup
		echo json_encode($maClasse-> getListeOperation($_POST['statut']));
	}elseif(isset($_POST['operation']) && $_POST['operation']=='invoice_pending_validation_CDN'){ // On Recupere les factures CDN

		echo json_encode($maClasse-> getInvoicePendingValidationCDN($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_paiement'){ // On Recupere les data pour rapport Operations
		$response['ref_fact'] = $_POST['ref_fact'];
		$response['montant'] = round($maClasse-> getMontantFactureGlobale($_POST['ref_fact']), 2);
		$response['label_montant'] = number_format(round($maClasse-> getMontantFactureGlobale($_POST['ref_fact']), 2), 2, '.', ',');
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='paiement_invoice'){ // On Recupere les data pour rapport Operations
		$maClasse-> creerPaiementFacture($_POST['ref_fact'], $_POST['ref_paie'], $_POST['date_paie'], $_POST['montant_paie'], $_POST['libelle_paie']);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='liste_client'){
		echo json_encode($maClasse-> getListeClient());

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_facture_client'){

  		$reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='view_debours_modele_facture'){

  		$reponse['tableau_debours_modele_facture'] = $maClasse-> getDeboursClientModeleLicence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  		$reponse['nom_march'] = $maClasse-> getMarchandise($_POST['id_march']);
  		$reponse['nom_mod_lic'] = $maClasse-> getNomModeleLicence($_POST['id_mod_lic']);
  		$reponse['nom_mod_trans'] = $maClasse-> getModeTransport($_POST['id_mod_trans'])['nom_mod_trans'];

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creerAffectationModeleFacture'){

  		$maClasse-> creerAffectationModeleFacture($_POST['id_mod_fact'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']);
  		$reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_affectation_debours'){

  		$reponse['select_debours'] = $maClasse-> select_debours($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creerAffectationDebours'){

  		$maClasse-> creerAffectationDebours($_POST['id_deb'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_mod_lic'], $_POST['montant'], $_POST['usd'], $_POST['tva']);
  		$reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		$reponse['tableau_debours_modele_facture'] = $maClasse-> getDeboursClientModeleLicence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  		$reponse['select_debours'] = $maClasse-> select_debours($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimerAffectationDebours'){

  		$maClasse-> supprimerAffectationDebours($_POST['id_deb'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_mod_lic']);
  		// $reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		$reponse['tableau_debours_modele_facture'] = $maClasse-> getDeboursClientModeleLicence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimerAffectationModeleFacture'){

  		$maClasse-> supprimerAffectationModeleFacture($_POST['id_mod_fact'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']);
  		$reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_edit_detail_client'){

  		$reponse = $maClasse-> getClient($_POST['id_cli']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='editClient'){

  		$maClasse-> editClient($_POST['id_cli'], $_POST['nom_complet'], $_POST['rccm_cli'], $_POST['nif_cli'], $_POST['id_nat'], $_POST['nom_cli'], $_POST['code_cli'], $_POST['num_imp_exp'], $_POST['adr_cli']);
  		$reponse['tableau_modele_facture_detail'] = $maClasse-> getModeleFacturationClient($_POST['id_cli']);

  		echo json_encode($reponse);

	}

?>