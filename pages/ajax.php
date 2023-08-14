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
  		$reponse['id_mon'] = '<select disabled class="bg bg-dark" name="id_mon" required>
  								<option>'.$maClasse-> getDataLicence($reponse['num_lic'])['sig_mon'].'</option>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$reponse['mon_fob'] = '<select class="bg bg-dark" name="mon_fob" id="mon_fob" onchange="maj_id_mon_fob(id_dos.value, this.value);" required>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$reponse['mon_fret'] = '<select class="bg bg-dark" name="mon_fret" id="mon_fret" onchange="maj_id_mon_fret(id_dos.value, this.value);" required>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$reponse['mon_assurance'] = '<select class="bg bg-dark" name="mon_assurance" id="mon_assurance" onchange="maj_id_mon_assurance(id_dos.value, this.value);" required>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$reponse['mon_autre_frais'] = '<select class="bg bg-dark" name="mon_autre_frais" id="mon_autre_frais" onchange="maj_id_mon_autre_frais(id_dos.value, this.value);" required>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		// $reponse['mon_fob'] = $maClasse-> selectionnerMonnaie3('id_mon_fob');
  		// $reponse['mon_fret'] = $maClasse-> selectionnerMonnaie3('id_mon_fret');
  		// $reponse['mon_assurance'] = $maClasse-> selectionnerMonnaie3('id_mon_assurance');
  		// $reponse['mon_autre_frais'] = $maClasse-> selectionnerMonnaie3('id_mon_autre_frais');
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjax($reponse['id_cli'], $reponse['id_mod_lic'], $reponse['id_march'], $reponse['id_mod_trans'], $_POST['id_dos'], $_POST['consommable']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauImportInvoiceSingleEdit'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$reponse['tax_duty_part'] = $maClasse-> getDataFactureDossier($_POST['id_dos'])['tax_duty_part'];
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjaxEdit($reponse['id_cli'], $reponse['id_mod_lic'], $reponse['id_march'], $reponse['id_mod_trans'], $_POST['id_dos'], $_POST['ref_fact']);

  		$reponse['label_mon_fob'] = $maClasse-> getMonnaie($maClasse-> getDataDossier($_POST['id_dos'])['id_mon_fob'])['sig_mon'];
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_roe_decl'){// MAJ Roe decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_roe_decl($_POST['id_dos'], $_POST['roe_decl']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_roe_inv'){// MAJ Roe Inv

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_roe_inv($_POST['id_dos'], $_POST['roe_inv']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_montant_liq'){// MAJ Montant Liquidation

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_montant_liq($_POST['id_dos'], $_POST['montant_liq']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_fob_usd'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_fob_usd($_POST['id_dos'], $_POST['fob_usd']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_fret_usd'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_fret_usd($_POST['id_dos'], $_POST['fret_usd']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_assurance_usd'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_assurance_usd($_POST['id_dos'], $_POST['assurance_usd']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_autre_frais_usd'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_autre_frais_usd($_POST['id_dos'], $_POST['autre_frais_usd']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_code_tarif'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_code_tarif($_POST['id_dos'], $_POST['code_tarif']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_horse'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_horse($_POST['id_dos'], $_POST['horse']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_trailer_1'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_trailer_1($_POST['id_dos'], $_POST['trailer_1']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_trailer_2'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_trailer_2($_POST['id_dos'], $_POST['trailer_2']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_poids'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_poids($_POST['id_dos'], $_POST['poids']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_num_exo'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_num_exo($_POST['id_dos'], $_POST['num_exo']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_mon_fob'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_mon_fob($_POST['id_dos'], $_POST['id_mon_fob']);
  		$reponse['label_mon_fob'] = $maClasse-> getMonnaie( $_POST['id_mon_fob'])['sig_mon'];

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_mon_fret'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_mon_fret($_POST['id_dos'], $_POST['id_mon_fret']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_mon_assurance'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_mon_assurance($_POST['id_dos'], $_POST['id_mon_assurance']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_mon_autre_frais'){// MAJ Montant Decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_mon_autre_frais($_POST['id_dos'], $_POST['id_mon_autre_frais']);

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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 172, $_POST['dmc_ce_'.$i], $_POST['dmc_ce_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 173, $_POST['dilolo_'.$i], $_POST['dilolo_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 15, $_POST['assay_'.$i], $_POST['assay_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 18, $_POST['occ_fees_'.$i], $_POST['occ_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 17, $_POST['com_ext_'.$i], $_POST['com_ext_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 14, $_POST['nac_'.$i], $_POST['nac_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 22, $_POST['klsa_border_'.$i], $_POST['klsa_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 23, $_POST['occ_ops_'.$i], $_POST['occ_ops_tva_'.$i], '1');
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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 176, $_POST['seguce_'.$i], $_POST['seguce_tva_'.$i], '1');

	  					//1.5% Finance Cost
	  					if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.015;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 54, $somme_taxe, '0', '1');

	  						// $response['somme_taxe'] = $somme_taxe;
	  					} 

	  					//1% Finance Cost
	  					if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(101, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(101, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.01;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 101, $somme_taxe, '0', '1');

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
  		$reponse['invoice_payed'] = $maClasse-> getInvoicePayed($_POST['id_cli'], $_POST['id_mod_lic']);

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

	  				$maClasse-> supprimerDetailFactureDossier($_POST['ref_fact']);

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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 172, $_POST['dmc_ce_'.$i], $_POST['dmc_ce_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 173, $_POST['dilolo_'.$i], $_POST['dilolo_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 15, $_POST['assay_'.$i], $_POST['assay_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 18, $_POST['occ_fees_'.$i], $_POST['occ_fees_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 17, $_POST['com_ext_'.$i], $_POST['com_ext_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 14, $_POST['nac_'.$i], $_POST['nac_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 22, $_POST['klsa_border_'.$i], $_POST['klsa_border_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 23, $_POST['occ_ops_'.$i], $_POST['occ_ops_tva_'.$i], '1');
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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 176, $_POST['seguce_'.$i], $_POST['seguce_tva_'.$i], '1');

	  					//1.5% Finance Cost
	  					if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(54, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.015;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 54, $somme_taxe, '0', '1');

	  						// $response['somme_taxe'] = $somme_taxe;
	  					} 
	  					else if(!empty(($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(101, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans']))) && ($maClasse-> getMontantDeboursClientModeleLicenceMarchandiseModeTransport(101, $_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'])['id_deb']!=0)){
	  						$somme_taxe = $maClasse-> getMontantFactureTypeDeboursDossier($_POST['ref_fact'], '1', $_POST['id_dos_'.$i])*0.01;
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 101, $somme_taxe, '0', '1');

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
		$id_mod_lic = NULL;
		if (isset($_POST['id_mod_lic'])&&($_POST['id_mod_lic']!='')) {
			$id_mod_lic = $_POST['id_mod_lic'];
		}
		$response['nbre_facture'] = $maClasse-> getNbreFacture($id_mod_lic);
		$response['nbre_dossier_facture'] = $maClasse-> getNbreDossierFacture($id_mod_lic);
		$response['nbre_dossier_non_facture'] = $maClasse-> getNbreDossierNonFacture($id_mod_lic);
		$response['btn_info_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Factures&amp;id_mod_lic='.$id_mod_lic.'\',\'pop1\',\'width=1200,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		$response['btn_info_dossiers_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic='.$id_mod_lic.'\',\'pop1\',\'width=1200,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpFacture'){ // On Recupere les data pour rapport facturation Popup
		$id_mod_lic = NULL;
		if (isset($_POST['id_mod_lic'])&&($_POST['id_mod_lic']!='')) {
			$id_mod_lic = $_POST['id_mod_lic'];
		}
		$id_util = NULL;
		if (isset($_POST['id_util'])&&($_POST['id_util']!='')) {
			$id_util = $_POST['id_util'];
		}
		$debut = NULL;
		if (isset($_POST['debut'])&&($_POST['debut']!='')) {
			$debut = $_POST['debut'];
		}
		$fin = NULL;
		if (isset($_POST['fin'])&&($_POST['fin']!='')) {
			$fin = $_POST['fin'];
		}
		echo json_encode($maClasse-> getListeFactures($_POST['statut'], $id_mod_lic, $id_util, $debut, $fin));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='rapportOperations'){ // On Recupere les data pour rapport Operations
		$response['nbre_dossier_encours'] = $maClasse-> getNbreDossier('Dossiers En Cours');
		$response['nbre_dossier_non_declare'] = $maClasse-> getNbreDossier('Dossiers non declarés');
		$response['nbre_dossier_non_liquide'] = $maClasse-> getNbreDossier('Dossiers Declarés Non Liquidés');
		$response['nbre_dossier_sans_quittance'] = $maClasse-> getNbreDossier('Dossiers En Attente Quittance');
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpOperations'){ // On Recupere les data pour rapport Operations Popup
		echo json_encode($maClasse-> getListeOperation($_POST['statut']));
	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_paiement'){ // On Recupere les data pour rapport Operations
		$response['ref_fact'] = $_POST['ref_fact'];
		$response['montant'] = round($maClasse-> getMontantFactureGlobale($_POST['ref_fact']), 2);
		$response['label_montant'] = number_format(round($maClasse-> getMontantFactureGlobale($_POST['ref_fact']), 2), 2, '.', ',');
		$response['nom_banq'] = $maClasse-> getDataFactureGlobale($_POST['ref_fact'])['nom_banq'];
		$response['compte_bancaire'] = '<select id="num_cmpt_paie" class="form-control form-control-sm cc-exp" onchange="getDataCompteBancaire(this.value)" name="num_cmpt_paie" required><option value="'.$maClasse-> getDataFactureGlobale($_POST['ref_fact'])['num_cmpt'].'">'.$maClasse-> getDataFactureGlobale($_POST['ref_fact'])['num_cmpt'].'</option>'.$maClasse-> selectionnerCompteBancaireAjax().'</select>';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='paiement_invoice'){ // On effectue le paiement de la facture

		$maClasse-> creerPaiementFacture($_POST['ref_fact'], $_POST['ref_paie'], $_POST['date_paie'], $_POST['num_cmpt_paie'], $_SESSION['id_util']);
  		$reponse['invoice_send'] = $maClasse-> getInvoiceSended($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_send'] = $maClasse-> getNombreFactureDossierEnvoyee($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_payed'] = $maClasse-> getInvoicePayed($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_payed'] = $maClasse-> getNombreFactureDossierPayees($_POST['id_cli'], $_POST['id_mod_lic']);
		echo json_encode($reponse);

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

	}elseif(isset($_POST['operation']) && $_POST['operation']=='files_upload'){

  		
	    if (!empty($_FILES)) {
	      $file = $_FILES['fichier'];
	      $filename = $file['name'];
	      $ext = pathinfo($filename, PATHINFO_EXTENSION);
	      $allowed = array('php', 'PDF', 'xls', 'xlsx', 'doc', 'docx', 'jpg', 'jpeg', 'png');

	      // if (!in_array($ext, $allowed)) {
	      //   $response = array('error' => 'Fichier non-autorisé');
	      //   echo json_encode($response);exit;
	      // }

	      // $uploadFile = 'licences/'.$maClasse-> getLicence($_POST['num_lic'])['id_lic'].'/'.uniqid().'.'.$ext;
	      // // $uploadFile = 'licences/'.uniqid().'.'.$ext;

	      // if (move_uploaded_file($file['tmp_name'], $uploadFile)) {
	      //   $response = array('message' => 'Fichier enregistré');
	      //   echo json_encode($response);exit;
	      // }
	      if ($file['size']>5000000) {
	        $response = array('error' => 'File too large, maximum 20M. Please Change the file!');
	       
	        echo json_encode($response);exit;
	      }
	      else{

	        try {

			  $dossier = '../'.$_POST['localisation'];

			  chmod("$dossier", 0777);
	          
	          $uploadFile = $dossier.'/'.$filename;
	          move_uploaded_file($file['tmp_name'], $uploadFile);
	          $reponse['message'] = 'ok';

	        } catch (Exception $e) {

	            $response['message'] = $e->getMessage();

	        }

	        echo json_encode($response);exit;
	      }

	    }

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureImportSingle'){// On enregistre la facture Export Single

  		if(isset($_POST['ref_fact'])){
  			try {
  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'partielle', NULL);
  			$maClasse-> MAJ_tax_duty_part_facture_dossier($_POST['ref_fact'], $_POST['tax_duty_part']);

  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {

  					if (!isset($_POST['pourcentage_qte_ddi_'.$i]) || empty($_POST['pourcentage_qte_ddi_'.$i]) || ($_POST['pourcentage_qte_ddi_'.$i]=='') || ($_POST['pourcentage_qte_ddi_'.$i]<0)) {
  						$_POST['pourcentage_qte_ddi_'.$i] = NULL;
  					}

  					if (!isset($_POST['montant_tva_'.$i]) || empty($_POST['montant_tva_'.$i]) || ($_POST['montant_tva_'.$i]=='') || ($_POST['montant_tva_'.$i]<0)) {
  						$_POST['montant_tva_'.$i] = 0;
  					}

  					$maClasse-> creerDetailFactureDossier2($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL, $_POST['pourcentage_qte_ddi_'.$i], $_POST['montant_tva_'.$i]);
  					// $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL);
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
	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureImportMMGAcid'){// On enregistre la facture MMG Acide

  		if(isset($_POST['ref_fact'])){
  			try {
  			
  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {

  					if (!isset($_POST['pourcentage_qte_ddi_'.$i]) || empty($_POST['pourcentage_qte_ddi_'.$i]) || ($_POST['pourcentage_qte_ddi_'.$i]=='') || ($_POST['pourcentage_qte_ddi_'.$i]<0)) {
  						$_POST['pourcentage_qte_ddi_'.$i] = NULL;
  					}

  					$maClasse-> creerDetailFactureDossier3($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL, $_POST['pourcentage_qte_ddi_'.$i]);
  					// $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL);
  				}
  				
  			}

  			$response = array('message' => 'File Invoiced');
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
			$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise3($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['num_lic']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);exit;
	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureImportShalina'){// On enregistre la facture Shalina

  		if(isset($_POST['ref_fact'])){
  			try {
  			
  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {

  					if (!isset($_POST['pourcentage_qte_ddi_'.$i]) || empty($_POST['pourcentage_qte_ddi_'.$i]) || ($_POST['pourcentage_qte_ddi_'.$i]=='') || ($_POST['pourcentage_qte_ddi_'.$i]<0)) {
  						$_POST['pourcentage_qte_ddi_'.$i] = NULL;
  					}

  					$maClasse-> creerDetailFactureDossier3($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL, $_POST['pourcentage_qte_ddi_'.$i]);
  					// $maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL);
  				}
  				
  			}

  			$response = array('message' => 'File Invoiced');
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
			$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);exit;
	}elseif(isset($_POST['operation']) && $_POST['operation']=='editFactureImportSingle'){// On enregistre la facture Export Single

  		if(isset($_POST['ref_fact'])){
  			try {

  			$maClasse-> supprimerDetailFactureDossier($_POST['ref_fact']);

  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'partielle', NULL);
  			$maClasse-> MAJ_tax_duty_part_facture_dossier($_POST['ref_fact'], $_POST['tax_duty_part']);

  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 

  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {

  					if (!isset($_POST['pourcentage_qte_ddi_'.$i]) || empty($_POST['pourcentage_qte_ddi_'.$i]) || ($_POST['pourcentage_qte_ddi_'.$i]=='') || ($_POST['pourcentage_qte_ddi_'.$i]<0)) {
  						$_POST['pourcentage_qte_ddi_'.$i] = NULL;
  					}

  					if (!isset($_POST['montant_tva_'.$i]) || empty($_POST['montant_tva_'.$i]) || ($_POST['montant_tva_'.$i]=='') || ($_POST['montant_tva_'.$i]<0)) {
  						$_POST['montant_tva_'.$i] = 0;
  					}

  					$maClasse-> creerDetailFactureDossier2($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL, $_POST['pourcentage_qte_ddi_'.$i], $_POST['montant_tva_'.$i]);
  					//$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i]);
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

	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureAcidImportMultiple'){// On enregistre la facture Acid Import Multiple

		if (isset($_POST['nbre'])) {
			
			if(isset($_POST['ref_fact'])){
	  			try {
	  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

  					if( isset($_POST['check_'.$i]) ){

  						$poids = $maClasse-> getDossier($_POST['id_dos_'.$i])['poids'];
  							
						//MAJ ROE
	  					$maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);

  						if(isset($_POST['ddi_'.$i]) && ($_POST['ddi_'.$i]>1)){
		  					//Inserer ddi
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 32, $_POST['ddi_'.$i], '0', '0');

  						}
  						if(isset($_POST['fpi_'.$i]) && ($_POST['fpi_'.$i]>1)){
		  					//Inserer fpi
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 95, $_POST['fpi_'.$i], '0', '0');

  						}
  						if(isset($_POST['rls_'.$i]) && ($_POST['rls_'.$i]>1)){
		  					//Inserer rls
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 3, $_POST['rls_'.$i], '0', '0');

  						}
  						if(isset($_POST['rii_'.$i]) && ($_POST['rii_'.$i]>1)){
		  					//Inserer rii
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 38, $_POST['rii_'.$i], '0', '0');

  						}
  						if(isset($_POST['cog_'.$i]) && ($_POST['cog_'.$i]>1)){
		  					//Inserer cog
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 35, $_POST['cog_'.$i], '0', '0');

  						}
  						if(isset($_POST['cso_'.$i]) && ($_POST['cso_'.$i]>1)){
		  					//Inserer cso
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 37, $_POST['cso_'.$i], '0', '0');

  						}
  						if(isset($_POST['rii_'.$i]) && ($_POST['rii_'.$i]>1)){
		  					//Inserer rii
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 38, $_POST['rii_'.$i], '0', '0');

  						}
  						if(isset($_POST['dci_'.$i]) && ($_POST['dci_'.$i]>1)){
		  					//Inserer dci
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 96, $_POST['dci_'.$i], '0', '0');

  						}
  						if(isset($_POST['autre_taxe_'.$i]) && ($_POST['autre_taxe_'.$i]>1)){
		  					//Inserer autre_taxe
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 97, $_POST['autre_taxe_'.$i], '0', '0');

  						}

	  					$maClasse-> creerDetailFactureWithoutTaxe($_POST['ref_fact'], $_POST['id_dos_'.$i], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  					}

	  			}
	  				
	  			$response['message'] = 'Invoice Created';

	  			} catch (Exception $e) {

		            $response = array('error' => $e->getMessage());

		        }

	  		}

		}
	    echo json_encode($response);exit;

	}elseif(isset($_POST['operation']) && $_POST['operation']=='editFactureAcidImportMultiple'){// On enregistre la facture Acid Import Multiple

		if (isset($_POST['nbre'])) {
			
			if(isset($_POST['ref_fact'])){
	  			try {
	  				
	  				$maClasse-> supprimerDetailFactureDossier($_POST['ref_fact']);

	  			// 	$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			// $maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

  					if( isset($_POST['check_'.$i]) ){

  						$poids = $maClasse-> getDossier($_POST['id_dos_'.$i])['poids'];
  							
						//MAJ ROE
	  					$maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);

  						if(isset($_POST['ddi_'.$i]) && ($_POST['ddi_'.$i]>1)){
		  					//Inserer ddi
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 32, $_POST['ddi_'.$i], '0', '0');

  						}
  						if(isset($_POST['fpi_'.$i]) && ($_POST['fpi_'.$i]>1)){
		  					//Inserer fpi
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 95, $_POST['fpi_'.$i], '0', '0');

  						}
  						if(isset($_POST['rls_'.$i]) && ($_POST['rls_'.$i]>1)){
		  					//Inserer rls
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 3, $_POST['rls_'.$i], '0', '0');

  						}
  						if(isset($_POST['rii_'.$i]) && ($_POST['rii_'.$i]>1)){
		  					//Inserer rii
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 38, $_POST['rii_'.$i], '0', '0');

  						}
  						if(isset($_POST['cog_'.$i]) && ($_POST['cog_'.$i]>1)){
		  					//Inserer cog
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 35, $_POST['cog_'.$i], '0', '0');

  						}
  						if(isset($_POST['cso_'.$i]) && ($_POST['cso_'.$i]>1)){
		  					//Inserer cso
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 37, $_POST['cso_'.$i], '0', '0');

  						}
  						if(isset($_POST['rii_'.$i]) && ($_POST['rii_'.$i]>1)){
		  					//Inserer rii
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 38, $_POST['rii_'.$i], '0', '0');

  						}
  						if(isset($_POST['dci_'.$i]) && ($_POST['dci_'.$i]>1)){
		  					//Inserer dci
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 96, $_POST['dci_'.$i], '0', '0');

  						}
  						if(isset($_POST['autre_taxe_'.$i]) && ($_POST['autre_taxe_'.$i]>1)){
		  					//Inserer autre_taxe
		  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 97, $_POST['autre_taxe_'.$i], '0', '0');

  						}

	  					$maClasse-> creerDetailFactureWithoutTaxe($_POST['ref_fact'], $_POST['id_dos_'.$i], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);

  					}

	  			}
	  				
	  			$response['message'] = 'Invoice Created';

	  			} catch (Exception $e) {

		            $response = array('error' => $e->getMessage());

		        }

	  		}

		}
	    echo json_encode($response);exit;

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDataCompteBancaire'){

  		$reponse = $maClasse-> getDataCompteBancaire($_POST['num_cmpt']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dashboardAV'){

  		$reponse['sans_fob_consommable'] = $maClasse-> getNombrePartielleEtat(NULL, '1', 'Partial Without FOB');
  		$reponse['btn_sans_fob_consommable'] = '<a href="#" class="btn btn-xs btn-primary" onclick="window.open(\'popUpPartielleDashboard.php?id_cli=&etat=Partial Without FOB&consommable=1\',\'pop1\',\'width=1300,height=900\');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>';
  		$reponse['sans_poids_consommable'] = $maClasse-> getNombrePartielleEtat(NULL, '1', 'Partial Without Weight');
  		$reponse['btn_sans_poids_consommable'] = '<a href="#" class="btn btn-xs btn-primary" onclick="window.open(\'popUpPartielleDashboard.php?id_cli=&etat=Partial Without Weight&consommable=1\',\'pop1\',\'width=1300,height=900\');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>';
  		$reponse['fob_negatif_consommable'] = $maClasse-> getNombrePartielleEtat(NULL, '1', 'Partial Having Negative FOB Balance');
  		$reponse['btn_fob_negatif_consommable'] = '<a href="#" class="btn btn-xs btn-primary" onclick="window.open(\'popUpPartielleDashboard.php?id_cli=&etat=Partial Having Negative FOB Balance&consommable=1\',\'pop1\',\'width=1300,height=900\');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>';

  		echo json_encode($reponse);

	}else if ($_POST['operation']=="statutDossier") {
		echo json_encode($maClasse-> afficherStatutDossierFactureAjax($_POST['id_cli'], $_POST['id_mod_lic']));
	}else if ($_POST['operation']=="statutDossierRisqueDouane") {
		echo json_encode($maClasse-> afficherStatutDossierRisqueDossierAjax($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['statut']));
	}else if ($_POST['operation']=="archivage") {
		echo json_encode($maClasse-> afficherDossierArchivageAjax($_POST['id_mod_lic']));
	}else if ($_POST['operation']=='getStatutDossiersImport') {
		
		$response['en_attente_av'] = number_format($maClasse-> getNombreDossierStatus('AWAITING AV', NULL, 2), 0, ',', ' ');
		$response['btn_en_attente_av'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=AWAITING AV&id_mod_lic=2&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		$response['en_attente_ad'] = number_format($maClasse-> getNombreDossierStatus('AWAITING AD', NULL, 2), 0, ',', ' ');
		$response['btn_en_attente_ad'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=AWAITING AD&id_mod_lic=2&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		$response['en_attente_ass'] = number_format($maClasse-> getNombreDossierStatus('AWAITING INSURANCE', NULL, 2), 0, ',', ' ');
		$response['btn_en_attente_ass'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=AWAITING INSURANCE&id_mod_lic=2&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		$response['en_attente_liquidation'] = number_format($maClasse-> getNombreDossierSansLiquidationApresCotation( NULL, 2), 0, ',', ' ');
		$response['btn_en_attente_liquidation'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=En attente Liquidation&id_mod_lic=2&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		$response['en_attente_quittance'] = number_format($maClasse-> getNombreDossierSansQuittanceApresIM4( NULL, 2), 0, ',', ' ');
		$response['btn_en_attente_quittance'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=En attente Quittance&id_mod_lic=2&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';

		$response['en_attente_liquidation_export'] = number_format($maClasse-> getNombreDossierSansLiquidationApresCotation( NULL, 1), 0, ',', ' ');
		$response['btn_en_attente_liquidation_export'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=En attente Liquidation&id_mod_lic=1&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		$response['en_attente_quittance_export'] = number_format($maClasse-> getNombreDossierSansQuittanceApresIM4( NULL, 1), 0, ',', ' ');
		$response['btn_en_attente_quittance_export'] = '<button class="btn btn-xs btn-primary" onclick="window.open(\'popUpStatutDossierRisqueDouane.php?statut=En attente Quittance&id_mod_lic=1&id_cli=\',\'pop1\',\'width=1000,height=800\');"><i class="fa fa-eye"></i>
		                </button>';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_check_multiple'){

  		$reponse['table_invoices_check_multiple'] = $maClasse-> table_invoices_check_multiple($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='check_multiple'){

		$compteur = 0;

        for ($i=1; $i <= $_POST['nbre_invoice'] ; $i++) { 
            if (isset($_POST['check_'.$i])) {
                // echo $_POST['adr_mail_'.$i];
                $compteur++;
                $maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact_'.$i], '1');
                // $mail->addAddress($_POST['adr_mail_'.$i]);
            }
        }

  		// $reponse['table_invoices_check_multiple'] = $maClasse-> table_invoices_check_multiple($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['compteur'] = $compteur;

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossierEnAttenteFactureAjax'){

  		$reponse['afficherDossierEnAttenteFactureAjax'] = $maClasse-> afficherDossierEnAttenteFactureAjax($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_not_fact'){

  		$maClasse-> MAJ_not_fact($_POST['id_dos'], '1');
  		$reponse['afficherDossierEnAttenteFactureAjax'] = $maClasse-> afficherDossierEnAttenteFactureAjax($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherMonitoringFacturation'){

  		$reponse['afficherMonitoringFacturation'] = $maClasse-> afficherMonitoringFacturation($_POST['id_mod_lic'], $_POST['debut'], $_POST['fin']);

		$reponse['nbre_facture'] = $maClasse-> getNbreFacture($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin']);
		$reponse['nbre_dossier_facture'] = $maClasse-> getNbreDossierFacture($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin']);
		$reponse['btn_info_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Factures&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'\',\'pop1\',\'width=950,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		$reponse['btn_info_dossiers_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'\',\'pop1\',\'width=1200,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';

  		echo json_encode($reponse);

	}else if($_POST['operation']=='creerPVContentieux'){//Creation PV Contentieux

      $file = $_FILES['fichier_pv'];
      $filename = $file['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $allowed = array('pdf', 'PDF', 'xls', 'xlsx', 'doc', 'docx', 'jpg', 'jpeg', 'png');

     try {

        $fichier_pv = uniqid();

        $maClasse-> creerPVContentieux($_POST['ref_pv'], $_POST['date_pv'], $_POST['date_reception'], $_POST['id_bur_douane'], $_POST['annee'], $_POST['marchandise'], $_POST['id_cli'], $_POST['id_mod_lic'], $fichier_pv.'.'.$ext, $_SESSION['id_util']);

        $ref_pv_folder = $_POST['ref_pv'];

        $ref_pv_folder = str_replace("/", "_", "$ref_pv_folder");
        
				$dossier = '../pv/'.$ref_pv_folder;

				if(!is_dir($dossier)){
					mkdir("../pv/$ref_pv_folder", 0777);
				}

          $uploadFile = $dossier.'/'.$fichier_pv.'.'.$ext;
          move_uploaded_file($file['tmp_name'], $uploadFile);

          $response = array('message' => 'PV créée avec succès!');

        } catch (Exception $e) {

            $response = array('error' => $e->getMessage());

        }
        
		$response['tableau_pv_contentieux'] = $maClasse-> getPVContentieux();
        echo json_encode($response);exit;

    }else if ($_POST['operation']=='modal_modificationPVContentieux') {
		  
		$response = $maClasse-> getDataPVContentieux($_POST['id_pv']);
		
		echo json_encode($response);

	}else if ($_POST['operation']=='modificationPVContentieux') {
		  
        $maClasse-> modificationPVContentieux($_POST['id_pv_edit'], $_POST['ref_pv'], $_POST['date_pv'], $_POST['date_reception'], $_POST['id_bur_douane_edit'], $_POST['annee'], $_POST['marchandise'], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_etat_edit'], $_POST['id_sen'], $_POST['remarque'], $_POST['date_deb_contrad'], $_POST['date_next_pres'], $_POST['delai_grief'], $_POST['infraction'], $_POST['droit_cdf'], $_POST['droit_usd'], $_POST['amende_cdf'], $_POST['amende_usd'], $_POST['risque_potentiel']);
		
         $response = array('message' => 'PV modifié avec succès!');
		$response['tableau_pv_contentieux'] = $maClasse-> getPVContentieux();
		echo json_encode($response);

	}else if ($_POST['operation']=='modal_actePV') {
	  
		$response['tableau_acte_pv'] = $maClasse-> tableau_acte_pv($_POST['id_pv']);
		$response['ref_pv_acte'] = $maClasse-> getDataPVContentieux($_POST['id_pv'])['ref_pv'];
		$response['id_pv_acte'] = $maClasse-> getDataPVContentieux($_POST['id_pv'])['id_pv'];
		echo json_encode($response);

	}else if ($_POST['operation']=='ajouterActePV') {
	  
		$maClasse-> ajouterActePV($_POST['date_act'], $_POST['detail_act'], $_POST['id_pv']);
		$response['tableau_acte_pv'] = $maClasse-> tableau_acte_pv($_POST['id_pv']);
		$response['ref_pv_acte'] = $maClasse-> getDataPVContentieux($_POST['id_pv'])['ref_pv'];
		$response['tableau_pv_contentieux'] = $maClasse-> getPVContentieux();
		echo json_encode($response);

	}else if ($_POST['operation']=='groups_account') {
	  
		$response['groups_account'] = $maClasse-> groups_account();
		echo json_encode($response);

	}else if ($_POST['operation']=='creerClasseCompte') {
	  
		$maClasse-> creerClasseCompte($_POST['nom_class'], $_POST['id_cat_cmpte']);
		$response['ok'] = 'Ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='modalEditClasse') {
	  
		$response = $maClasse-> getDataClasse($_POST['id_class']);
		echo json_encode($response);

	}else if ($_POST['operation']=='editClasseCompte') {
	  
		$maClasse-> editClasseCompte($_POST['id_class'], $_POST['nom_class'], $_POST['id_cat_cmpte']);
		$response['ok'] = 'Ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='account') {
	  
		$response['account'] = $maClasse-> account();
		echo json_encode($response);

	}else if ($_POST['operation']=='creerClasseCompte') {
	  
		$maClasse-> creerClasseCompte($_POST['nom_compte'], $_POST['code_compte'], $_POST['id_class']);
		$response['ok'] = 'Ok';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='enregistrerFactureImport2BlocsExclDuty'){// On enregistre la facture Import Exclu Duty

  		if(isset($_POST['ref_fact'])){
  			try {
  			$maClasse-> creerFactureDossierWithDuty($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'partielle', NULL, NULL, $_POST['with_duty']);
  			// $maClasse-> MAJ_roe_decl($_POST['id_dos'], $_POST['roe_decl']);

  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
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
	}else if ($_POST['operation']=="rapportEmail") {
		echo json_encode($maClasse-> detailRapportEmailAjax($_POST['statut']));
	}else if ($_POST['operation']=='liste_compte_tresorerie') {
	  
		$response['liste_compte_tresorerie'] = $maClasse-> liste_compte_tresorerie($_POST['compteur_compte']);
		echo json_encode($response);

	}else if ($_POST['operation']=='nom_compte_tresorerie_search') {
	  
		$response['liste_compte_tresorerie'] = $maClasse-> nom_compte_tresorerie_search($_POST['nom_compte'], $_POST['compteur_compte']);
		echo json_encode($response);

	}else if ($_POST['operation']=='creerCompte') {
	  
		$maClasse-> creerCompte($_POST['nom_compte'], $_POST['code_compte'], $_POST['id_class']);
		$response['msg'] = 'Compte Cree';
		echo json_encode($response);

	}else if ($_POST['operation']=='creerEcritureAppro') {
	  
		$maClasse-> creerEcritureAppro($_POST['date_e'], $_POST['libelle_e'], $_POST['id_jour'], $_POST['id_taux'], $_SESSION['id_util'], $_POST['id_mon']);

		$id_e = $maClasse-> getLastEcritureUtilisateur($_SESSION['id_util'])['id_e'];

		for ($i=0; $i <=$_POST['nbre'] ; $i++) { 
			
			if (isset($_POST['id_compte_'.$i])&&($_POST['montant_'.$i]>0)) {
				if ($i==0) {
					$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], NULL, $_POST['montant_'.$i]);
				}else{
					$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], $_POST['montant_'.$i], NULL);
				}
			}

		}

		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if ($_POST['operation']=='nom_compte_search') {
	  
		$response['liste_compte_journal'] = $maClasse-> nom_compte_search($_POST['nom_compte'], $_POST['compteur_compte']);
		echo json_encode($response);

	}else if ($_POST['operation']=='loadPageRegister') {
	  
		$response['taux'] = $maClasse-> getLastTaux()['montant'];
		$response['id_taux'] = $maClasse-> getLastTaux()['id_taux'];
		echo json_encode($response);

	}else if ($_POST['operation']=='ecriture_journal') {
	  
		$response['ecriture_journal'] = $maClasse-> ecriture_journal();
		echo json_encode($response);

	}else if ($_POST['operation']=='modal_creer_facture_en_cours') {
	  
		$response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_mod_trans'], $_POST['id_march']);
		echo json_encode($response);

	}else if ($_POST['operation']=='liste_ref_fact_non_validee') {
	  
		$response['liste_ref_fact_non_validee'] = $maClasse-> selectionnerFactureNonValideeClient($_POST['id_cli'], $_POST['id_mod_trans'], $_POST['id_mod_lic']);
		echo json_encode($response);

	}else if ($_POST['operation']=='detail_invoice_acid') {
	  
		$response['detail_invoice_acid'] = $maClasse-> detail_invoice_acid($_POST['ref_fact']);
		echo json_encode($response);

	}else if ($_POST['operation']=='creer_facture_en_cours') {
	  
		$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);
		$response['message'] = 'ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='supprimerDetailFactureDossier2') {
	  
		$maClasse-> supprimerDetailFactureDossier2($_POST['id_dos']);
		$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise3($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['num_lic']);
		$response['message'] = 'ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='modalEditDetailFactureDossier') {
	  
		$response['horse'] =$maClasse-> getDossier($_POST['id_dos'])['horse'];
		$response['trailer_1'] =$maClasse-> getDossier($_POST['id_dos'])['trailer_1'];
		$response['trailer_2'] =$maClasse-> getDossier($_POST['id_dos'])['trailer_2'];
		$response['roe_decl'] =$maClasse-> getDossier($_POST['id_dos'])['roe_decl'];
		$response['poids'] =$maClasse-> getDossier($_POST['id_dos'])['poids'];
  		$response['detail_facture_dossier'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjaxEdit($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_dos'], $_POST['ref_fact']);
		// $response['message'] = 'ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='editerDetailFactureDossier') {
	  
		$maClasse-> supprimerDetailFactureDossier2($_POST['id_dos_edit']);

  		if(isset($_POST['ref_fact_edit'])){
  			try {
  			
  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {

  					if (!isset($_POST['pourcentage_qte_ddi_'.$i]) || empty($_POST['pourcentage_qte_ddi_'.$i]) || ($_POST['pourcentage_qte_ddi_'.$i]=='') || ($_POST['pourcentage_qte_ddi_'.$i]<0)) {
  						$_POST['pourcentage_qte_ddi_'.$i] = NULL;
  					}

  					if (!isset($_POST['montant_tva_'.$i]) || empty($_POST['montant_tva_'.$i]) || ($_POST['montant_tva_'.$i]=='') || ($_POST['montant_tva_'.$i]<0)) {
  						$_POST['montant_tva_'.$i] = 0;
  					}

  					$maClasse-> creerDetailFactureDossier2($_POST['ref_fact_edit'], $_POST['id_dos_edit'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i], NULL, NULL, $_POST['pourcentage_qte_ddi_'.$i], $_POST['montant_tva_'.$i]);
  				}
  				
  			}

  			$response = array('message' => 'File Invoiced');
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
			$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise3($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['num_lic']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
		$response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise3($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['num_lic']);
		// $response['message'] = 'ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='getEcritureJournal') {

  		$response['getEcritureJournal'] = $maClasse-> getEcritureJournal($_POST['id_jour']);
		echo json_encode($response);

	}else if ($_POST['operation']=='journaux') {
	  
		$response['journaux'] = $maClasse-> journaux();
		echo json_encode($response);

	}else if ($_POST['operation']=='creerJournal') {
	  
		$maClasse-> creerJournal($_POST['nom_jour']);
		$response['message'] = 'Register Created!';
		echo json_encode($response);

	}else if ($_POST['operation']=='modalEditJournal') {
	  
		$response = $maClasse-> getDataJournal($_POST['id_jour']);
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='editJournal'){

  		$maClasse-> editJournal($_POST['id_jour'], $_POST['nom_jour']);
  		$reponse['message'] = 'Register Updated!';

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='compte_journal'){

  		$reponse['compte_journal'] = $maClasse-> compte_journal($_POST['id_jour']);
  		$reponse['nom_jour'] = $maClasse-> getDataJournal($_POST['id_jour'])['nom_jour'];

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='liste_compte_hors_journal'){

  		$reponse['liste_compte_hors_journal'] = $maClasse-> liste_compte_hors_journal($_POST['id_jour']);;

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creer_compte_journal'){

  		$maClasse-> creer_compte_journal($_POST['id_compte'], $_POST['id_jour']);;
  		$reponse['liste_compte_hors_journal'] = $maClasse-> liste_compte_hors_journal($_POST['id_jour']);
  		$reponse['compte_journal'] = $maClasse-> compte_journal($_POST['id_jour']);
  		$reponse['message'] = 'Account added!';

  		echo json_encode($reponse);

	}else if ($_POST['operation']=='liste_compte_journal') {
	  
		$response['liste_compte_journal'] = $maClasse-> liste_compte_journal($_POST['compteur_compte'], $_POST['id_jour']);
		echo json_encode($response);

	}else if ($_POST['operation']=='nom_compte_search_journal') {
	  
		$response['liste_compte_journal'] = $maClasse-> nom_compte_search_journal($_POST['nom_compte'], $_POST['compteur_compte'], $_POST['id_jour']);
		echo json_encode($response);

	}else if ($_POST['operation']=="afficherAllCompteAjax") {
		echo json_encode($maClasse-> afficherAllCompteAjax());
	}else if ($_POST['operation']=="afficherEcritureCompte") {
		echo json_encode($maClasse-> afficherEcritureCompte($_POST['id_compte']));
	}else if ($_POST['operation']=='modal_edit_statut_dossier_facturation') {
	  
		$response = $maClasse-> getDossier($_POST['id_dos']);
		echo json_encode($response);

	}else if ($_POST['operation']=='modal_edit_statut_dossier_facturation') {
	  
		$response = $maClasse-> getDossier($_POST['id_dos']);
		echo json_encode($response);

	}else if ($_POST['operation']=='edit_statut_dossier_facturation') {
	  
		$maClasse-> MAJ_not_fact($_POST['id_dos'], $_POST['not_fact']);
		$maClasse-> MAJ_ref_decl($_POST['id_dos'], $_POST['ref_decl']);
		$maClasse-> MAJ_date_decl($_POST['id_dos'], $_POST['date_decl']);
		$maClasse-> MAJ_ref_liq($_POST['id_dos'], $_POST['ref_liq']);
		$maClasse-> MAJ_date_liq($_POST['id_dos'], $_POST['date_liq']);
		$maClasse-> MAJ_ref_quit($_POST['id_dos'], $_POST['ref_quit']);
		$maClasse-> MAJ_date_quit($_POST['id_dos'], $_POST['date_quit']);
		$response['message'] = 'File Updated!';
		echo json_encode($response);

	}else if ($_POST['operation']=="afficherLicenceAjax") {
		echo json_encode($maClasse-> afficherLicenceAjax($_POST['id_mod_lic'], $_POST['id_cli']));
	}else if ($_POST['operation']=="tableau_pv_contentieux") {
		echo json_encode($maClasse-> getPVContentieux());
	}else if ($_POST['operation']=="afficherBalanceSheetAjax") {
		echo json_encode($maClasse-> afficherAllCompteAjax());
	}else if ($_POST['operation']=="tresorerie_mois") {
		echo json_encode($maClasse-> tresorerie_mois($_POST['id_tres']));
	}else if ($_POST['operation']=="new_mouvement") {
		$maClasse-> new_mouvement($_POST['date_mvt'], $_POST['entree'], $_POST['sortie'], $_POST['libelle'], $_POST['reference'], $_POST['id_tres']);
		$response['msg'] = 'Done!';
		echo json_encode($response);
	}else if ($_POST['operation']=="supprimer_mouvement_tresorerie") {
		$maClasse-> supprimer_mouvement_tresorerie($_POST['id_mvt']);
		$response['msg'] = 'Done!';
		echo json_encode($response);
	}else if ($_POST['operation']=="modal_edit_mouvement") {

		$response = $maClasse-> getDataMouvementTresorerie($_POST['id_mvt']);

		echo json_encode($response);
	}else if ($_POST['operation']=="edit_mouvement") {
		$maClasse-> edit_mouvement($_POST['date_mvt'], $_POST['entree'], $_POST['sortie'], $_POST['libelle'], $_POST['reference'], $_POST['id_mvt']);
		$response['msg'] = 'Done!';
		echo json_encode($response);
	}else if ($_POST['operation']=="tresorerie_all") {
		echo json_encode($maClasse-> tresorerie_all($_POST['id_tres']));
	}else if ($_POST['operation']=="getMontantTresorerie") {
		$response = $maClasse-> getMontantTresorerie($_POST['id_tres']);
		echo json_encode($response);
	}else if ($_POST['operation']=="modal_ajuster_cif_cdf") {
		$response = $maClasse-> getDossier2($_POST['id_dos']);
		echo json_encode($response);
	}else if ($_POST['operation']=="ajuster_cif_cdf") {

		$assurance_usd = (($_POST['cif_cdf']-$maClasse-> getDossier2($_POST['id_dos'])['cif_cdf'])/$maClasse-> getDossier2($_POST['id_dos'])['roe_decl'])+$maClasse-> getDossier2($_POST['id_dos'])['assurance_usd'];

		$maClasse-> MAJ_assurance_usd($_POST['id_dos'], $assurance_usd);

		$response = $maClasse-> getDossier2($_POST['id_dos']);
		
		echo json_encode($response);
	}else if ($_POST['operation']=="getMontantClientFinance") {
		echo json_encode($maClasse-> getMontantClientFinance());
	}else if ($_POST['operation']=="client_finance") {
		echo json_encode($maClasse-> client_finance());
	}else if ($_POST['operation']=="detail_client_finance") {
		echo json_encode($maClasse-> detail_client_finance($_POST['id_cli']));
	}else if ($_POST['operation']=="modal_paiement_facture") {
		$response['detail_paiement_facture'] = $maClasse-> modal_paiement_facture($_POST['ref_fact']);
		echo json_encode($response);
	}else if ($_POST['operation']=="paiement_facture") {
		$maClasse-> paiement_facture($_POST['ref_paie'], $_POST['date_paie'], $_POST['montant_paie'], $_POST['ref_fact'], $_POST['id_tres']);
		$maClasse-> new_mouvement($_POST['date_paie'], $_POST['montant_paie'], NULL, 'Receipt Payment Invoice '.$_POST['ref_fact'], $_POST['ref_paie'], $_POST['id_tres']);
		$response['detail_paiement_facture'] = $maClasse-> modal_paiement_facture($_POST['ref_fact']);
		echo json_encode($response);
	}else if ($_POST['operation']=="fournisseur_finance") {
		echo json_encode($maClasse-> fournisseur_finance());
	}else if ($_POST['operation']=="new_vendor") {
		$maClasse-> new_vendor($_POST['nom_four'], $_POST['nif_four'], $_POST['rccm_four'], $_POST['adr_four'], $_POST['tel_four']);
		$response['msg'] = 'ok';
		echo json_encode($response);
	}else if ($_POST['operation']=="detail_fournisseur_finance") {
		echo json_encode($maClasse-> detail_fournisseur_finance($_POST['id_four']));
	}else if ($_POST['operation']=="new_invoice") {
		$maClasse-> new_invoice($_POST['ref_fact'], $_POST['date_fact'], $_POST['montant'], $_POST['remarque'], $_POST['id_four']);
		$response['msg'] = 'Done!';
		echo json_encode($response);
	}else if ($_POST['operation']=="getMontantFournisseurFinance") {
		$response = $maClasse-> getMontantFournisseurFinance();
		echo json_encode($response);
	}else if ($_POST['operation']=="modal_paiement_facture_fournisseur") {
		$response = $maClasse-> get_facture_fournisseur($_POST['id_fact']);
		$response['detail_paiement_facture_fournisseur'] = $maClasse-> modal_paiement_facture_fournisseur($_POST['id_fact']);
		echo json_encode($response);
	}else if ($_POST['operation']=="paiement_facture_fournisseur") {
		$maClasse-> paiement_facture_fournisseur($_POST['ref_paie'], $_POST['date_paie'], $_POST['montant'], $_POST['id_fact'], $_POST['id_tres']);
		$maClasse-> new_mouvement($_POST['date_paie'], NULL, $_POST['montant'], 'Payment Vendor Invoice '.$maClasse-> get_facture_fournisseur($_POST['id_fact'])['ref_fact'], $_POST['ref_paie'], $_POST['id_tres']);
		$response['detail_paiement_facture_fournisseur'] = $maClasse-> modal_paiement_facture_fournisseur($_POST['id_fact']);
		echo json_encode($response);
	}else if($_POST['operation']=='creerDossierRisque'){//Creation PV Contentieux

      $file = $_FILES['fichier'];
      $filename = $file['name'];
      $ext = pathinfo($filename, PATHINFO_EXTENSION);
      $allowed = array('pdf', 'PDF', 'xls', 'xlsx', 'doc', 'docx', 'jpg', 'jpeg', 'png');

     try {

        $fichier = uniqid();

        $maClasse-> creerDossierRisque($_POST['ref_doc'], $_POST['id_cli'], $_POST['date_doc'], $_POST['date_recept'], $_POST['id_bur_douane'], $_POST['id_etap'], $_POST['date_proch_pres'], $_POST['id_reg'], $fichier.'.'.$ext, $_SESSION['id_util']);

        $ref_doc_folder = $maClasse-> getLastDossierRisqueDouaneUtilisateur($_SESSION['id_util'])['id'];

        $maClasse-> creerPresentationRisqueDouane($ref_doc_folder, $_POST['date_proch_pres'], NULL, NULL, NULL);

        $ref_doc_folder = str_replace("/", "_", "$ref_doc_folder");
        
				$dossier = '../pv/'.$ref_doc_folder;

				if(!is_dir($dossier)){
					mkdir("../pv/$ref_doc_folder", 0777);
				}

          $uploadFile = $dossier.'/'.$fichier.'.'.$ext;
          move_uploaded_file($file['tmp_name'], $uploadFile);

          $response = array('message' => 'Notification créée avec succès!');

        } catch (Exception $e) {

            $response = array('error' => $e->getMessage());

        }
        
		$response['tableau_pv_contentieux'] = $maClasse-> getPVContentieux();
        echo json_encode($response);exit;

    }else if ($_POST['operation']=="dossier_risque_douane") {
		echo json_encode($maClasse-> dossier_risque_douane());

		$response['selectionnerBureauDouane'] = $maClasse-> selectionnerBureauDouaneAjax2();
		$response['selectionnerRegime'] = $maClasse-> selectionnerRegimeGroupingAjax();
	}else if ($_POST['operation']=='modal_dossier_risque_douane') {
		  
		$response = $maClasse-> get_dossier_risque_douane($_POST['id']);
		$response['presentation_risque_douane'] = $maClasse-> presentation_risque_douane($_POST['id']);
		$response['document_joint_risque'] = $maClasse-> document_joint_risque($_POST['id']);
		
		echo json_encode($response);

	}else if($_POST['operation']=='editDossierRisque'){//Creation PV Contentieux

        $maClasse-> editerDossierRisque($_POST['id'], $_POST['ref_doc'], $_POST['date_doc'], $_POST['date_recept'], $_POST['id_bur_douane'], $_POST['id_etap'], $_POST['id_sen'], $_POST['date_proch_pres'], $_POST['id_reg'], $_POST['date_pres'], $_POST['remarque']);

        $response = array('message' => 'Notification modifiée avec succès!');
        echo json_encode($response);exit;

    }else if($_POST['operation']=='creerPresentationRisqueDouane'){//Creation Presentation


    	if ($_FILES['fichier']) {
    		$file = $_FILES['fichier'];
    		$filename = $file['name'];
    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

    		$fichier = uniqid();
    		$id = $_POST['id'];
    		$id = str_replace("/", "_", "$id");
			
			$dossier = '../pv/'.$id;

			if(!is_dir($dossier)){
				mkdir("../pv/$id", 0777);
			}
			$uploadFile = $dossier.'/'.$fichier.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $uploadFile);

    		$maClasse-> creerPresentationRisqueDouane($_POST['id'], $_POST['date_prevu'], $_POST['date_pres'], $_POST['remarque'], $fichier.'.'.$ext);

    	}else{
    		$maClasse-> creerPresentationRisqueDouane($_POST['id'], $_POST['date_prevu'], $_POST['date_pres'], $_POST['remarque'], NULL);
    	}


        $response['message'] = 'Presentation créée avec succès!';
		$response['presentation_risque_douane'] = $maClasse-> presentation_risque_douane($_POST['id']);
        echo json_encode($response);exit;

    }else if ($_POST['operation']=='deletePresentation') {
		  
		$response = $maClasse-> deletePresentation($_POST['id_pres']);
		$response['presentation_risque_douane'] = $maClasse-> presentation_risque_douane($_POST['id']);
		
		echo json_encode($response);

	}else if ($_POST['operation']=='modal_editPresentation') {
		  
		$response = $maClasse-> getPresentation($_POST['id_pres']);
		
		echo json_encode($response);

	}else if($_POST['operation']=='editPresentation'){//Creation Presentation


    	if (!empty($_FILES['fichier']) && $_FILES['fichier']['name']!='') {
    		$file = $_FILES['fichier'];
    		$filename = $file['name'];
    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

    		$fichier = uniqid();
    		$id = $_POST['id'];
    		$id = str_replace("/", "_", "$id");
			
			$dossier = '../pv/'.$id;

			if(!is_dir($dossier)){
				mkdir("../pv/$id", 0777);
			}
			$uploadFile = $dossier.'/'.$fichier.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $uploadFile);

    		$maClasse-> editPresentation($_POST['id_pres'], $_POST['date_prevu'], $_POST['date_pres'], $_POST['remarque'], $fichier.'.'.$ext);

    	}else{
    		$maClasse-> editPresentation2($_POST['id_pres'], $_POST['date_prevu'], $_POST['date_pres'], $_POST['remarque']);
    	}


        $response['message'] = 'Presentation créée avec succès!';
		$response['presentation_risque_douane'] = $maClasse-> presentation_risque_douane($_POST['id']);
        echo json_encode($response);exit;

    }else if ($_POST['operation']=='getNombreDossierRisqueDouane') {
		  
		$response['nbre_not_pres'] = $maClasse-> getNombreDossierRisqueDouane()['nbre_not_pres'];
		$response['nbre_not_pres_10'] = $maClasse-> getNombreNotPres10()['nbre_not_pres_10'];
		
		echo json_encode($response);

	}else if ($_POST['operation']=="popUpPresentation") {
		echo json_encode($maClasse-> popUpPresentation($_POST['statut']));
	}else if ($_POST['operation']=='liste_compte') {
	  
		$response['liste_compte'] = $maClasse-> liste_compte($_POST['compteur_compte']);
		echo json_encode($response);

	}else if ($_POST['operation']=='creerEcriture') {
	  
		$maClasse-> creerEcriture($_POST['date_e'], $_POST['libelle_e'], $_POST['id_jour'], $_POST['id_taux'], $_SESSION['id_util'], $_POST['id_t_e'], $_POST['reference'], $_POST['id_mon']);

		$id_e = $maClasse-> getLastEcritureUtilisateur($_SESSION['id_util'])['id_e'];

		for ($i=0; $i <=$_POST['nbre'] ; $i++) { 
			
			if (isset($_POST['id_compte_'.$i])&&($_POST['montant_debit_'.$i]>0)) {
				$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], $_POST['montant_debit_'.$i], NULL);
				
			}
			if (isset($_POST['id_compte_'.$i])&&($_POST['montant_credit_'.$i]>0)) {
				$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], NULL, $_POST['montant_credit_'.$i]);
				
			}

		}

		$response['message'] = 'Accounting voucher created succefully! ID: '.$id_e;

		echo json_encode($response);

	}else if ($_POST['operation']=="ecriture_comptable") {
		echo json_encode($maClasse-> ecriture_comptable());
	}else if ($_POST['operation']=='getEcriture') {

  		$response = $maClasse-> getEcriture($_POST['id_e']);
		echo json_encode($response);

	}else if ($_POST['operation']=="detail_ecriture_comptable") {
		echo json_encode($maClasse-> detail_ecriture_comptable($_POST['id_e']));
	}else if($_POST['operation']=='creerDocumentJointRisque'){//Joindre Fichier Dossier Risque

		$file = $_FILES['fichier'];
		$filename = $file['name'];
		$ext = pathinfo($filename, PATHINFO_EXTENSION);

		$fichier = uniqid();
		$id = $_POST['id'];
		$id = str_replace("/", "_", "$id");
		
		$dossier = '../pv/'.$id;

		if(!is_dir($dossier)){
			mkdir("../pv/$id", 0777);
		}
		$uploadFile = $dossier.'/'.$fichier.'.'.$ext;
		move_uploaded_file($file['tmp_name'], $uploadFile);

		$maClasse-> creerDocumentJointRisque($_POST['id'], $_POST['id_doc'], $fichier.'.'.$ext);

        $response['message'] = 'Fichier joint avec succès!';
		$response['document_joint_risque'] = $maClasse-> document_joint_risque($_POST['id']);
        echo json_encode($response);exit;

    }else if ($_POST['operation']=='creerEcriture_1') {
	  
		$maClasse-> creerEcriture($_POST['date_e'], $_POST['libelle_e'], $_POST['id_jour'], $_POST['id_taux'], $_SESSION['id_util'], $_POST['id_t_e'], $_POST['reference'], $_POST['id_mon']);

		$id_e = $maClasse-> getLastEcritureUtilisateur($_SESSION['id_util'])['id_e'];

		$total = 0;

		if ($_POST['mvt']=='debit') {

			for ($i=1; $i <=$_POST['nbre'] ; $i++) { 
			
				if (isset($_POST['id_compte_'.$i])&&($_POST['montant_'.$i]>0)) {
					$total += $_POST['montant_'.$i];
					$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], NULL, $_POST['montant_'.$i]);
				}

			}
			$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_0'], $total, NULL);

		}else if ($_POST['mvt']=='credit') {

			for ($i=1; $i <=$_POST['nbre'] ; $i++) { 
			
				if (isset($_POST['id_compte_'.$i])&&($_POST['montant_'.$i]>0)) {
					$total += $_POST['montant_'.$i];
					$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_'.$i], $_POST['montant_'.$i], NULL);
				}

			}
			$maClasse-> creerDetailEcriture($id_e, $_POST['id_compte_0'], NULL, $total);
		}


		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if ($_POST['operation']=='creerBureauDouane') {
	  
		$maClasse-> creerBureauDouane($_POST['nom_bur_douane']);
		$response['message'] = 'Done!';
		$response['selectionnerBureauDouane'] = $maClasse-> selectionnerBureauDouaneAjax2();

		echo json_encode($response);

	}else if ($_POST['operation']=='creerRegime') {
	  
		$maClasse-> creerRegime($_POST['nom_reg'], $_POST['id_mod_lic']);
		$response['message'] = 'Done!';
		$response['selectionnerRegime'] = $maClasse-> selectionnerRegimeGroupingAjax();

		echo json_encode($response);

	}else if ($_POST['operation']=='selectionnerBureauDouane') {
	  
		$response['selectionnerBureauDouane'] = $maClasse-> selectionnerBureauDouaneAjax2();
		$response['selectionnerRegime'] = $maClasse-> selectionnerRegimeGroupingAjax();

		echo json_encode($response);

	}else if ($_POST['operation']=="getSelectRisque") {
		$response['selectionnerBureauDouane'] = $maClasse-> selectionnerBureauDouaneAjax2();
		$response['selectionnerRegime'] = $maClasse-> selectionnerRegimeGroupingAjax();
		$response['selectionnerBureauDouane_edit'] = $maClasse-> selectionnerBureauDouaneAjax2_edit();
		$response['selectionnerRegime_edit'] = $maClasse-> selectionnerRegimeGroupingAjax_edit();
		echo json_encode($response);
	}else if ($_POST['operation']=='liste_compte2') {
	  
		// $response['liste_compte'] = $maClasse-> liste_compte2($_POST['compteur_compte']);
		// echo json_encode($response);

		echo json_encode($maClasse-> liste_compte2Ajax($_POST['compteur_compte']));

	}else if ($_POST['operation']=="afficherTialBalanceAjax") {
		echo json_encode($maClasse-> afficherTialBalanceAjax());
	}else if ($_POST['operation']=="detail_sub_class_trial_balance") {
		echo json_encode($maClasse-> detail_sub_class_trial_balance($_POST['id_sub_class']));
	}elseif(isset($_POST['operation']) && $_POST['operation']=='getInvoiceAjax'){ // On Recupere les factures CDN

		echo json_encode($maClasse-> getInvoiceAjax($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossiers_facture'){ // On Recupere les dossiers de factures

		echo json_encode($maClasse-> dossiers_facture_ajax($_POST['ref_fact']));

	}else if ($_POST['operation']=='remove_file_invoice') {
	  
		$maClasse-> supprimerDetailFactureDossier2($_POST['id_dos']);
		$response['message'] = 'ok';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='pending_report'){ // On Recupere les dossiers de factures

		echo json_encode($maClasse-> pending_report());

	}elseif(isset($_POST['operation']) && $_POST['operation']=='detail_invoice_pending_report'){ // On Recupere les dossiers de factures

		echo json_encode($maClasse-> detail_invoice_pending_report($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='invoice_assigned'){ // On Recupere les dossiers de factures

		echo json_encode($maClasse-> invoice_assigned());

	}else if ($_POST['operation']=='remove_assignement') {
	  
		$maClasse-> remove_assignement($_POST['id_util'], $_POST['id_mod_lic'], $_POST['id_cli']);
		$response['message'] = 'ok';
		echo json_encode($response);

	}else if ($_POST['operation']=='create_assignement') {
	  
		$maClasse-> create_assignement($_POST['id_util'], $_POST['id_mod_lic'], $_POST['id_cli']);
		$response['message'] = 'ok';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='liste_dossier_ajax'){ 

		echo json_encode($maClasse-> liste_dossier_ajax($_POST['id_cli'], $_POST['id_mod_lic']));

	}else if(isset($_POST['operation']) && $_POST['operation']=='creerDetailFactureDossier'){// On recupere les donnees du dossier a facturer 

		//On test si la facture existe deja
		if (empty($maClasse-> getFactureGlobale($_POST['ref_fact']))) {
			
  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', $_POST['information'], $_POST['note_debit']);
		}

  		$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb'], $_POST['montant'], $_POST['tva'], '1');
  		
  		$reponse['detail_invoice'] = $maClasse-> detail_invoice($_POST['ref_fact']);

  		echo json_encode($reponse);

	}else if ($_POST['operation']=='supprimerDetailFactureDossier3') {
	  
		$maClasse-> supprimerDetailFactureDossier3($_POST['ref_fact'], $_POST['id_dos']);
		$response['detail_invoice'] = $maClasse-> detail_invoice($_POST['ref_fact']);
		echo json_encode($response);

	}else if ($_POST['operation']=='modal_edit_avance') {
	  
		$response['detail_facture_avance'] = $maClasse-> modal_edit_avance($_POST['ref_fact']);
		$response['taxe'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['taxe'];
		$response['other'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['other'];
		$response['service'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['service'];
		$response['ops'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['ops'];
		echo json_encode($response);

	}else if ($_POST['operation']=="detail_compte") {
		echo json_encode($maClasse-> detail_compte($_POST['id_compte']));
	}else if ($_POST['operation']=='advance_edit') {

		$maClasse-> advance_edit($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb'], $_POST['montant'], $_POST['montant_tva'], $_POST['tva'], $_POST['usd']);
	  
		$response['detail_facture_avance'] = $maClasse-> modal_edit_avance($_POST['ref_fact']);
		$response['taxe'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['taxe'];
		$response['other'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['other'];
		$response['service'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['service'];
		$response['ops'] = $maClasse-> get_total_advance($_POST['ref_fact'], $_POST['id_dos'])['ops'];
		echo json_encode($response);

	}else if ($_POST['operation']=="facturation_suivi_licence") {
		echo json_encode($maClasse-> facturation_suivi_licence($_POST['id_cli'], $_POST['id_mod_lic']));
	}else if ($_POST['operation']=='edit_suivi_licence') {
	  
		$maClasse-> MAJ_fact_suiv_lic($_POST['num_lic'], $_POST['fact_suiv_lic']);
		$response['message'] = 'Done!';
		echo json_encode($response);

	}else if ($_POST['operation']=="afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs") {
		echo json_encode($maClasse-> afficherDossierEnAttenteFactureAjax2($_POST['id_cli'], $_POST['id_mod_lic'], '0'));
	}else if ($_POST['operation']=="afficherDossierEnAttenteFactureAjaxWithSupportDocs") {
		echo json_encode($maClasse-> afficherDossierEnAttenteFactureAjax2($_POST['id_cli'], $_POST['id_mod_lic'], '1'));
	}else if ($_POST['operation']=='MAJ_support_doc') {
	  
		$maClasse-> MAJ_support_doc($_POST['id_dos'], $_POST['support_doc']);
		$response['message'] = 'Done!';
		echo json_encode($response);

	}else if ($_POST['operation']=='getPathArchive') {
	  
		$response['lien'] = $maClasse-> getPathArchive($_POST['id_dos']).$maClasse-> getDossier($_POST['id_dos'])['ref_dos'].'.pdf';
		
		echo json_encode($response);

	}else if ($_POST['operation']=='deroulerMenuLicence') {
	  
		$response['menuLicence'] = $maClasse-> deroulerMenuLicence($_POST['id_mod_lic']);
		
		echo json_encode($response);

	}else if ($_POST['operation']=='factureLicenceDisponible') {
	  
		$response['factureLicenceDisponible'] = $maClasse-> factureLicenceDisponible($_POST['id_cli'], $_POST['id_mod_lic']);
		
		echo json_encode($response);

	}else if ($_POST['operation']=='getDataFacture') {
	  
		$response = $maClasse-> getDataFacture($_POST['ref_fact']);
		
		echo json_encode($response);

	}
?>