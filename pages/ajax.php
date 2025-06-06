<?php
	session_start();
	include('../classes/maClasse.class.php');
	$maClasse = new MaClasse();

	if(!isset($_SESSION['id_util'])){// Si la session a expiree ont deconneccte

        $response['logout'] = 'Your session has expired, please log in again';
        echo json_encode($response);

  	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauExportInvoiceSingle'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientExport($reponse['id_cli'], $reponse['id_mod_lic'], $reponse['id_march'], $reponse['id_mod_trans'], $_POST['id_dos']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauExportInvoiceSingle_edit'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientExport_edit($_POST['ref_fact'], $reponse['id_cli'], $reponse['id_mod_lic'], $reponse['id_march'], $reponse['id_mod_trans'], $_POST['id_dos']);

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
  		$reponse['template_invoice'] = $maClasse-> selectionnerMarchandiseTemplateFacture($reponse['id_cli'], $reponse['id_mod_trans'], $reponse['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauImportInvoiceSingleEdit'){// On recupere les donnees du dossier a facturer 

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$reponse['statut_arsp'] = $maClasse-> getFactureGlobale($_POST['ref_fact'])['statut_arsp'];
  		$reponse['tax_duty_part'] = $maClasse-> getDataFactureDossier($_POST['id_dos'])['tax_duty_part'];
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjaxEdit($reponse['id_cli'], $reponse['id_mod_lic'], $reponse['id_march'], $reponse['id_mod_trans'], $_POST['id_dos'], $_POST['ref_fact']);

  		$reponse['label_mon_fob'] = $maClasse-> getMonnaie($maClasse-> getDataDossier($_POST['id_dos'])['id_mon_fob'])['sig_mon'];
  		$reponse['template_invoice'] = $maClasse-> selectionnerMarchandiseTemplateFacture($reponse['id_cli'], $reponse['id_mod_trans'], $reponse['id_mod_lic']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_roe_decl'){// MAJ Roe decl

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_roe_decl($_POST['id_dos'], $_POST['roe_decl']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_roe_liq'){// MAJ Roe Liq

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_roe_liq($_POST['id_dos'], $_POST['roe_liq']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_statut_arsp'){// MAJ ARSP

  		$maClasse-> maj_statut_arsp($_POST['ref_fact'], $_POST['statut_arsp']);
  		$reponse['message'] = 'Done!';

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_bank_liq'){// MAJ id_bank_liq

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_bank_liq($_POST['id_dos'], $_POST['id_bank_liq']);
  		$reponse['roe_decl'] = $maClasse-> getMontantTauxBanqueDate($_POST['id_bank_liq'], $maClasse-> getDataDossier($_POST['id_dos'])['date_quit']);
  		$maClasse-> MAJ_roe_decl($_POST['id_dos'], $reponse['roe_decl']);

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
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);
	}elseif(isset($_POST['operation']) && $_POST['operation']=='editerFactureExportSingle'){// On enregistre la facture Export Single

  		if(isset($_POST['ref_fact'])){
  			try {
  			$maClasse-> MAJ_roe_decl($_POST['id_dos'], $_POST['roe_decl']);
  			$maClasse-> supprimerDetailFactureDossier($_POST['ref_fact']);

  			for ($i=1; $i <= 24 ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {
  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i]);
  				}
  				
  			}

  			$response = array('message' => 'Invoice Created');
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);
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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 212, $_POST['lse_'.$i], $_POST['lse_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 7, $_POST['gov_tax_'.$i], $_POST['gov_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 8, $_POST['concentrate_tax_'.$i], $_POST['concentrate_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 5, $_POST['fere_'.$i], $_POST['fere_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 196, $_POST['ogefrem_10_'.$i], $_POST['ogefrem_10_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 197, $_POST['ogefrem_20_'.$i], $_POST['ogefrem_20_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 198, $_POST['ogefrem_40_'.$i], $_POST['ogefrem_40_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 6, $_POST['lmc_'.$i], $_POST['lmc_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 9, $_POST['occ_samp_'.$i], $_POST['occ_samp_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 10, $_POST['occ_cgea_'.$i], $_POST['occ_cgea_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, $_POST['ceec_30_'.$i], $_POST['ceec_30_tva_'.$i], '1');
	  					// Test CEEC Impala 
	  					$dossier = $maClasse-> getDossier($_POST['id_dos_'.$i]);
	  					if (!empty($maClasse-> verifierFonctionnalite($dossier['id_cli'], 1, $dossier['id_mod_lic'], $dossier['id_mod_trans'], $dossier['id_march']))) {

	  						if ($dossier['poids']>=30) {
	  							$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, 600, '0', '1');
	  							$maClasse-> creerDepenseDossier(8, $_POST['id_dos_'.$i], date('Y-m-d'), 200, 'ANNICK');
	  						}else{
	  							$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, 600, '0', '1');
	  						}
	  						

	  					}else{
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 12, $_POST['ceec_60_'.$i], $_POST['ceec_60_tva_'.$i], '1');
	  					}
	  					
	  					//DGDA Seal
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 13, $_POST['dgda_seal_'.$i], $_POST['dgda_seal_tva_'.$i], '1');
	  					//-- Additionnal Fee KIPOI
	  					if ($_POST['id_cli']==905) {
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 216, 25, '0', '1');
	  					}

	  					//DGDA Seal

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
	  				
	  			
  				$maClasse-> maj_statut_arsp($_POST['ref_fact'], $_POST['statut_arsp']);
  				

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

  		if (!empty($maClasse-> getFacturation_licence_globale($_POST['id_cli'], $_POST['id_mod_lic']))) {
  			$reponse['modal_facture_licence_globale'] = $maClasse-> modal_facture_licence_globale($_POST['id_cli'], $_POST['id_mod_lic']); 
  		}else {
  			$reponse['modal_facture_licence_globale'] = '';
  		}

  		// $reponse['tableau_modele_facture_2'] = $maClasse-> getModeleFacturation_2($_POST['id_cli'], $_POST['id_mod_lic']);

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

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimerNoteDebit'){// On recupere les donnees du dossier a facturer 

		$maClasse-> supprimerNoteDebit($_POST['ref_note']);
		$reponse['message'] = 'Done!';

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
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 212, $_POST['lse_'.$i], $_POST['lse_tva_'.$i], '0');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 7, $_POST['gov_tax_'.$i], $_POST['gov_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 8, $_POST['concentrate_tax_'.$i], $_POST['concentrate_tax_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 5, $_POST['fere_'.$i], $_POST['fere_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 196, $_POST['ogefrem_10_'.$i], $_POST['ogefrem_10_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 197, $_POST['ogefrem_20_'.$i], $_POST['ogefrem_20_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 198, $_POST['ogefrem_40_'.$i], $_POST['ogefrem_40_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 6, $_POST['lmc_'.$i], $_POST['lmc_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 9, $_POST['occ_samp_'.$i], $_POST['occ_samp_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 10, $_POST['occ_cgea_'.$i], $_POST['occ_cgea_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, $_POST['ceec_30_'.$i], $_POST['ceec_30_tva_'.$i], '1');
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 12, $_POST['ceec_60_'.$i], $_POST['ceec_60_tva_'.$i], '1');

	  					//DGDA Seal
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 13, $_POST['dgda_seal_'.$i], $_POST['dgda_seal_tva_'.$i], '1');
	  					
	  					//-- Additionnal Fee KIPOI
	  					if ($_POST['id_cli']==905) {
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 216, 25, '0', '1');
	  					}

	  					//DGDA Seal

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
		$response['nbre_dossier_facture_excel'] = $maClasse-> getNbreDossierFactureExcel($id_mod_lic);
		$response['nbre_facture_sans_taux'] = $maClasse-> nbre_facture_sans_taux($id_mod_lic);
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
		echo json_encode($maClasse-> getListeFactures($_POST['statut'], $id_mod_lic, $id_util, $debut, $fin, $_POST['id_cli']));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpFacture2'){ // On Recupere les data pour rapport facturation Popup
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
		echo json_encode($maClasse-> popUpFacture2($_POST['statut'], $id_mod_lic, $id_util, $debut, $fin, $_POST['id_cli']));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='pay_report'){ 

		if (!empty($_POST['id_dos']) && ($_POST['id_dos']>0)) {
			echo json_encode($maClasse-> pay_report_dossier($_POST['statut'], $_POST['date_create_debut'], $_POST['date_create_fin'], $_POST['date_visa_dept_debut'], $_POST['date_visa_dept_fin'], $_POST['date_visa_fin_debut'], $_POST['date_visa_fin_fin'], $_POST['date_decaiss_debut'], $_POST['date_decaiss_fin'], $_POST['id_dep'], $_POST['id_dos']));
		}else {
			echo json_encode($maClasse-> pay_report($_POST['statut'], $_POST['date_create_debut'], $_POST['date_create_fin'], $_POST['date_visa_dept_debut'], $_POST['date_visa_dept_fin'], $_POST['date_visa_fin_debut'], $_POST['date_visa_fin_fin'], $_POST['date_decaiss_debut'], $_POST['date_decaiss_fin'], $_POST['id_dep']));
		}
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='pay_report_file'){ 

		echo json_encode($maClasse-> pay_report_file());
		
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='pay_report_file_pending_invoice'){ 

		echo json_encode($maClasse-> pay_report_file_pending_invoice($_POST['id_mod_lic']));
		
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='pay_report_file_df'){ 

		echo json_encode($maClasse-> pay_report_file_df($_POST['id_df']));
		
		
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
  			$maClasse-> maj_statut_arsp($_POST['ref_fact'], $_POST['statut_arsp']);

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

		$reponse['nbre_facture'] = $maClasse-> getNbreFacture($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin'], $_POST['id_cli']);
		$reponse['nbre_dossier_facture'] = $maClasse-> getNbreDossierFacture($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin'], $_POST['id_cli']);
		$response['nbre_dossier_non_facture'] = $maClasse-> getNbreDossierNonFacture($_POST['id_mod_lic'], $_POST['id_cli']);
		$response['nbre_dossier_facture_excel'] = $maClasse-> getNbreDossierFactureExcel($_POST['id_mod_lic'], $_POST['id_cli']);
		$reponse['btn_info_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Factures&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'&amp;id_cli='.$_POST['id_cli'].'\',\'pop1\',\'width=950,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		$reponse['btn_info_dossiers_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'&amp;id_cli='.$_POST['id_cli'].'\',\'pop1\',\'width=1200,height=700\');">
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
	  
		$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL, '0', NULL, NULL, $_POST['id_mod_trans']);
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
		$response['roe_liq'] =$maClasse-> getDossier($_POST['id_dos'])['roe_liq'];
		$response['id_bank_liq'] =$maClasse-> getDossier($_POST['id_dos'])['id_bank_liq'];
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
	  
		$maClasse-> MAJ_mca_b_ref($_POST['id_dos'], $_POST['mca_b_ref']);
		$maClasse-> MAJ_not_fact($_POST['id_dos'], $_POST['not_fact']);
		$maClasse-> MAJ_ref_decl($_POST['id_dos'], $_POST['ref_decl']);
		$maClasse-> MAJ_date_decl($_POST['id_dos'], $_POST['date_decl']);
		$maClasse-> MAJ_ref_liq($_POST['id_dos'], $_POST['ref_liq']);
		$maClasse-> MAJ_date_liq($_POST['id_dos'], $_POST['date_liq']);
		$maClasse-> MAJ_ref_quit($_POST['id_dos'], $_POST['ref_quit']);
		$maClasse-> MAJ_date_quit($_POST['id_dos'], $_POST['date_quit']);
		$maClasse-> MAJ_id_march($_POST['id_dos'], $_POST['id_march']);
		$maClasse-> MAJ_ref_fact_excel($_POST['id_dos'], $_POST['ref_fact_excel']);
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

        $maClasse-> editerDossierRisque($_POST['id'], $_POST['ref_doc'], $_POST['date_doc'], $_POST['date_recept'], $_POST['id_bur_douane'], $_POST['id_etap'], $_POST['id_sen'], $_POST['date_proch_pres'], $_POST['id_reg'], $_POST['date_pres'], $_POST['remarque'], $_POST['id_cli']);

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
			
  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', $_POST['information'], $_POST['note_debit'], $_POST['type_case'], $_POST['taux']);
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

	}else if(isset($_POST['operation']) && $_POST['operation']=='creerFactureService'){// creerFactureService

  		$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', $_POST['information'], $_POST['note_debit'], NULL, $_POST['taux']);

  		for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
  			
  			if (!empty($_POST['detail_'.$i]) && ($_POST['montant_'.$i]>0)) {
  				$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos'], $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], '1', $_POST['detail_'.$i], $_POST['unite_'.$i]);
  			}

  		}
  		
  		$reponse['msg'] = 'Done!';

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='afficherMonitoringTaux'){// Afiicher Taux

  		$reponse['afficherMonitoringTaux'] = $maClasse-> afficherMonitoringTaux();

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='creation_taux_banque'){// creation_taux_banque
		// creerTauxBCC($date_taux, $montant)
		// getTauxBCCDate($date_taux)
		// creerTauxBanque($id_taux_bcc, $id_banq, $date_taux, $montant)

  		$maClasse-> creerTauxBCC($_POST['date_taux'], $_POST['bcc']);
  		$id_taux_bcc = $maClasse-> getTauxBCCDate($_POST['date_taux'])['id'];
  		//ecobank
  		$maClasse-> creerTauxBanque($id_taux_bcc, 5, $_POST['date_taux'], $_POST['ecobank']);
  		//rawbank
  		$maClasse-> creerTauxBanque($id_taux_bcc, 2, $_POST['date_taux'], $_POST['rawbank']);
  		//equity
  		$maClasse-> creerTauxBanque($id_taux_bcc, 3, $_POST['date_taux'], $_POST['equity']);
  		//access
  		$maClasse-> creerTauxBanque($id_taux_bcc, 10, $_POST['date_taux'], $_POST['access']);
		
		$maClasse-> appliquer_taux($id_taux_bcc);
		
  		$reponse['msg'] = 'Done!';

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='delete_taux_banque'){// creation_taux_banque
		// creerTauxBCC($date_taux, $montant)
		// getTauxBCCDate($date_taux)
		// creerTauxBanque($id_taux_bcc, $id_banq, $date_taux, $montant)

  		$maClasse-> delete_taux_banque($_POST['id']);

  		$reponse['msg'] = 'Done!';

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='files_awaiting_rate'){// Afiicher Taux

  		$reponse['files_awaiting_rate'] = $maClasse-> files_awaiting_rate($_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_id_bank_liq2'){// MAJ id_bank_liq 2

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_id_bank_liq($_POST['id_dos'], $_POST['id_bank_liq']);
  		$reponse['roe_decl'] = $maClasse-> getMontantTauxBanqueDate($_POST['id_bank_liq'], $maClasse-> getDataDossier($_POST['id_dos'])['date_quit']);
  		$maClasse-> MAJ_roe_decl($_POST['id_dos'], $reponse['roe_decl']);
  		$reponse['files_awaiting_rate'] = $maClasse-> files_awaiting_rate($_POST['id_mod_lic']);

		$reponse['nbre_facture_sans_taux'] = $maClasse-> nbre_facture_sans_taux($_POST['id_mod_lic']);
		$reponse['nbre_facture_excel'] = $maClasse-> nbre_facture_excel($_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='appliquer_taux'){// appliquer_taux

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> appliquer_taux($_POST['id']);
  		$reponse['msg'] = 'Done!';
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='nouveauDossierLicence'){ 

		echo json_encode($maClasse-> nouveauDossierLicence($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='tableau_creation_dossiers_lot'){ 

		$ref_dos = $maClasse-> getMcaFileExport($_POST['id_cli'], $_POST['id_mod_trans'], $_POST['id_march'], $_POST['id_mod_lic'], 1);
		$site = $maClasse-> getClient($_POST['id_cli'])['site'];
		$response['tableau_creation_dossiers_lot'] = '';
		if ($_POST['id_mod_lic']==1) {

			if ($_POST['id_mod_trans'] == '1') {
				$maxPoids = 'max=45';
			}else{
				$maxPoids = 'max=50';
			}

			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
			
				$response['tableau_creation_dossiers_lot'] .= '<tr>
											<td class="col_1">'.$i.'</td>
											<td class="col_6"><input type="text" name="ref_dos_'.$i.'" id="ref_dos_b_'.$i.'"  value="'.$ref_dos.'"></td>
											<td><input type="text" name="num_lic_'.$i.'" id="num_lic_'.$i.'" value="'.$_POST['num_lic'].'"></td>
				<td style="border: 0.5px solid black;">
					<input type="date" style="width: 10em;" class="form-control cc-exp form-control-sm" name="load_date_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="text" value="'.$site.'" style="width: 10em;" class="form-control cc-exp form-control-sm" name="site_load_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="destination_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="horse_'.$i.'">
				</td>';
				if ($_POST['id_mod_trans'] != '4') {
					$response['tableau_creation_dossiers_lot'] .= '
						<td style="border: 0.5px solid black;">
							<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="trailer_1_'.$i.'">
						</td>
						<td style="border: 0.5px solid black;">
							<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="trailer_2_'.$i.'">
						</td>
						<td style="border: 0.5px solid black;">
							<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="container_'.$i.'">
						</td>
						<td style="border: 0.5px solid black;">
							<select style="width: 10em;" class="form-control cc-exp form-control-sm" name="pied_container_'.$i.'">
								<option></option>
								<option value="10">10</option>
								<option value="20">20</option>
								<option value="40">40</option>
							</select>
						</td>';
				} else {
					$response['tableau_creation_dossiers_lot'] .= '
						<input type="hidden" style="width: 10em;" class="form-control cc-exp form-control-sm" name="trailer_1_'.$i.'">
						<input type="hidden" style="width: 10em;" class="form-control cc-exp form-control-sm" name="trailer_2_'.$i.'">';
				}
				$response['tableau_creation_dossiers_lot'] .= '
				<td style="border: 0.5px solid black;">
					<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="nbr_bags_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="number" step="0.001" style="width: 10em;" '.$maxPoids.' class="form-control cc-exp form-control-sm" name="poids_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="num_lot_'.$i.'">
				</td>
				<td style="border: 0.5px solid black;">
					<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="dgda_seal_'.$i.'">
				</td>';
				if ($_POST['id_mod_trans'] != '4') {
					$response['tableau_creation_dossiers_lot'] .= '
						<td style="border: 0.5px solid black;">
							<input type="text" style="width: 10em;" class="form-control cc-exp form-control-sm" name="transporter_'.$i.'">
						</td>';
				} else {
					$response['tableau_creation_dossiers_lot'] .= '
						<input type="hidden" style="width: 10em;" class="form-control cc-exp form-control-sm" name="transporter_'.$i.'">';
				}
				$response['tableau_creation_dossiers_lot'] .= '</tr>';

				$ref_dos++;

			}
		}else{
			for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
			
				$response['tableau_creation_dossiers_lot'] .= '<tr>
											<td class="col_1">'.$i.'</td>
											<td class="col_6"><input type="text" name="ref_dos_'.$i.'" id="ref_dos_b_'.$i.'" value="'.$ref_dos.'"></td>
											<td><input type="text" name="mca_b_ref_'.$i.'" id="mca_b_ref_b_'.$i.'"></td>
											<td><input type="text" name="num_lic_'.$i.'" id="num_lic_'.$i.'" value="'.$_POST['num_lic'].'"></td>
											<td><input type="text" name="t1_'.$i.'" id="t1_'.$i.'"></td>
											<td><input type="number" step="0.001" name="poids_'.$i.'" id="poids_'.$i.'"></td>
											<td><input type="number" step="0.001" name="fob_'.$i.'" id="fob_'.$i.'"></td>
											<td><input type="text" name="ref_fact_'.$i.'" id="ref_fact_'.$i.'"></td>
											<td><input type="text" name="horse_'.$i.'" id="horse_'.$i.'"></td>
											<td><input type="text" name="trailer_1_'.$i.'" id="trailer_1_'.$i.'"></td>
											<td><input type="text" name="trailer_2_'.$i.'" id="trailer_2_'.$i.'"></td>
												<td><input type="date" name="klsa_arriv_'.$i.'" id="klsa_arriv_'.$i.'"></td>
											<td><input type="date" name="crossing_date_'.$i.'" id="crossing_date_'.$i.'"></td>
											<td><input type="date" name="wiski_arriv_'.$i.'" id="wiski_arriv_'.$i.'"></td>
											<td><input type="date" name="wiski_dep_'.$i.'" id="wiski_dep_'.$i.'"></td>
											<td><input type="text" name="ref_crf_'.$i.'" id="ref_crf_'.$i.'"></td>
											<td><input type="date" name="date_crf_'.$i.'" id="date_crf_'.$i.'"></td>
										</tr>';

				$ref_dos++;

			}
		}
		
		$response['tableau_creation_dossiers_lot'] .='<input type="hidden" name="nbre" value="'.$i.'">';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popFilesInvoicingStatus'){
		$id_mod_lic = NULL;
		if (isset($_POST['id_mod_lic'])&&($_POST['id_mod_lic']!='')) {
			$id_mod_lic = $_POST['id_mod_lic'];
		}
		echo json_encode($maClasse-> popFilesInvoicingStatus($_POST['id_mod_lic'], $_POST['annee']));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='statut_dossier_air'){ 

		echo json_encode($maClasse-> statut_dossier_air($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_edit_statut_dossier_air'){ 

		$response = $maClasse-> getDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_statut_dossier_air'){ 

		// $response = $maClasse-> getDossier($_POST['id_dos']);
		$_GET['id_cli'] = $maClasse-> getDossier($_POST['id_dos'])['id_cli'];
		$_GET['id_mod_trans'] = $maClasse-> getDossier($_POST['id_dos'])['id_mod_trans'];
		$_GET['id_mod_trac'] = $maClasse-> getDossier($_POST['id_dos'])['id_mod_lic'];
		
	    if (isset($_POST['klsa_arriv']) && ($_POST['klsa_arriv'] != '')) {
	        $maClasse-> MAJ_klsa_arriv($_POST['id_dos'], $_POST['klsa_arriv']);
	    }
      
	    if (isset($_POST['wiski_arriv']) && ($_POST['wiski_arriv'] != '')) {
	        $maClasse-> MAJ_wiski_arriv($_POST['id_dos'], $_POST['wiski_arriv']);
	    }
      
	    if (isset($_POST['wiski_dep']) && ($_POST['wiski_dep'] != '')) {
	        $maClasse-> MAJ_wiski_dep($_POST['id_dos'], $_POST['wiski_dep']);
	    }
      
	    if (isset($_POST['dispatch_klsa']) && ($_POST['dispatch_klsa'] != '')) {
	        $maClasse-> MAJ_dispatch_klsa($_POST['id_dos'], $_POST['dispatch_klsa']);
	    }
      
	    $response['message'] = 'Done!';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='transmis_apurement'){ 

		echo json_encode($maClasse-> transmis_apurement($_POST['id_cli'], $_POST['id_mod_lic']));

	}else if (isset($_POST['modifierTransmissionApurement'])) {
	    
	    if (isset($_FILES['fichier_trans_ap']['name'])) {

	      $fichier_trans_ap = $_FILES['fichier_trans_ap']['name'];
	      $tmp = $_FILES['fichier_trans_ap']['tmp_name'];

	      $maClasse-> uploadAccuseeRecpetionTransmissionApurement($_POST['id_trans_ap'], $fichier_trans_ap, $tmp);

	    }else{
	      $fichier_trans_ap = NULL;
	      $tmp = NULL;
	    }

	    $response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <strong>Opération reussie!</strong> 
		                </div>';
		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='nouvelle_licence_import') {


        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
        }

        if (isset($_FILES['fichier_lic']['name'])) {

          $fichier_lic = $_FILES['fichier_lic']['name'];
          $tmp = $_FILES['fichier_lic']['tmp_name'];

        }else{
          $fichier_lic = NULL;
          $tmp = NULL;
        }

        if (isset($_FILES['fichier_fact']['name'])) {

          $fichier_fact = $_FILES['fichier_fact']['name'];
          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

        }else{
          $fichier_fact = NULL;
          $tmp_fact = NULL;
        }
    

      if ( $maClasse-> getLicence($_POST['num_lic']) == null ){
      	$_POST['id_post'] = NULL;
      	$_POST['id_mod_trans'] = 1;
      	$_POST['tonnage'] = $_POST['consommable'];
        $maClasse-> creerLicenceIB2($_POST['id_banq'], $_POST['num_lic'], $_POST['id_cli'], 
                                  $_POST['id_post'], $_POST['id_mon'], $_POST['fob'], 
                                  $_POST['assurance'], $_POST['fret'], $_POST['autre_frais'], 
                                  $_POST['fsi'], $_POST['aur'], 
                                  $_POST['id_mod_trans'], $_POST['ref_fact'], $_POST['date_fact'], 
                                  $_POST['fournisseur'], $_POST['date_val'], $_POST['date_exp'], 
                                  NULL, $_POST['id_mod_lic'], $_SESSION['id_util'], 
                                  $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
                                  $_POST['id_type_lic'], $_POST['id_mod_paie'], 
                                  $_POST['id_sous_type_paie'], $_POST['provenance'],
                                  $_POST['commodity'], $_POST['tonnage'], 
                                  $_POST['poids'], $_POST['unit_mes'], $_POST['cod'], $_POST['consommable']);
        	$response['message'] = 'Done!';
        }else{

          $response['message'] = 'Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro';

        }

		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='modal_modifier_transmis') {

		$response = $maClasse-> getTransmissionApurement($_POST['id_trans_ap']);

		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='modifier_transmis_apurement') {

		$maClasse-> update_date_depot_transmis($_POST['id_trans_ap'], $_POST['date_depot']);

		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='archive_transmis_apurement') {

		if (isset($_FILES['fichier_trans_ap']['name'])) {

	      $fichier_trans_ap = $_FILES['fichier_trans_ap']['name'];
	      $tmp = $_FILES['fichier_trans_ap']['tmp_name'];

	      $maClasse-> uploadAccuseeRecpetionTransmissionApurement($_POST['id_trans_ap'], $fichier_trans_ap, $tmp);

	    }else{
	      $fichier_trans_ap = NULL;
	      $tmp = NULL;
	    }

		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='annuler_accuser_reception_transmis_apurement') {

		$maClasse-> annuler_accuser_reception_transmis_apurement($_POST['id_trans_ap']);

		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if (isset($_POST['operation']) && $_POST['operation']=='build_reference_transmis') {

		$response['ref_trans_ap'] = $maClasse-> buildReferenceTransmissionApurementModeleLicence($_POST['id_mod_lic']);
		
		$response['dossier_a_apures'] = $maClasse-> getDossierEnAttenteApurementAjax($_POST['id_cli'], $_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherMonitoringNoteDebit'){

		$reponse['nbre_note_debit'] = $maClasse-> getNbreNoteDebit($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin']);
		$reponse['nbre_note_debit_per_file'] = $maClasse-> getNbreNoteDebitFile($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin']);
		$reponse['nbre_depenses'] = $maClasse-> getNbreDepenseNoteDebit($_POST['id_mod_lic'], NULL, $_POST['debut'], $_POST['fin']);
		$reponse['btn_info_note_debit_per_file'] = '<span onclick="window.open(\'popUpRapportNoteDebit.php?id_mod_lic='.$_POST['id_mod_lic'].'\',\'pop1\',\'width=900,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		$reponse['btn_info_depense'] = '<span onclick="window.open(\'popUpDashboardDepense.php?statut=Depenses&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'\',\'pop1\',\'width=900,height=700\');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </span>';
		// $reponse['btn_info_dossiers_factures'] = '<span onclick="window.open(\'popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic='.$_POST['id_mod_lic'].'&amp;debut='.$_POST['debut'].'&amp;fin='.$_POST['fin'].'\',\'pop1\',\'width=1200,height=700\');">
        //         Details <i class="fas fa-arrow-circle-right"></i>
        //       </span>';

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='upload_depense'){
      
      $fichier = $_FILES['fichier']['tmp_name'];

      require('../PHPExcel-1.8/Classes/PHPExcel.php');
      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

      $objExcel = PHPExcel_IOFactory::load($fichier);

      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
        $highestRow = $worsheet-> getHighestRow();
        for ($row=2; $row <= $highestRow ; $row++) { 
          

            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
            $date_dep = $worsheet-> getCellByColumnAndRow(1, $row)-> getFormattedValue();
            $montant = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
            $assigned_to = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();

            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];
            echo '<br> id_dos  = '.$id_dos;
            if (isset($id_dos)) {
              
              $maClasse-> creerDepenseDossier($_POST['id_dep'], $id_dos, $date_dep, $montant, $assigned_to);

            }

        }
        $response['message'] = 'Done !';
      }


  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpDepense'){ // On Recupere les data pour rapport facturation Popup
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
		echo json_encode($maClasse-> getListeDepense($_POST['statut'], $_POST['id_mod_lic'], $id_util, $debut, $fin));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='client_note_debit'){

		echo json_encode($maClasse-> client_note_debit($_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='client_note_debit2'){

		echo json_encode($maClasse-> client_note_debit2($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='kamoa_nd'){

		$response['tableau_kamoa_nd'] = $maClasse-> kamoa_nd($_POST['id_mod_lic'], $_POST['id_cli']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creer_note_debit'){

		$maClasse-> creerNoteDebit($_POST['ref_note'], $_POST['id_model_nd'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], $_POST['libelle']);
		for ($i=1; $i <= $_POST['nbre'] ; $i++) { 

			$maClasse-> creerDetailNoteDebit($_POST['ref_note'], $_POST['id_dep_dos_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i]);
			
		}

		if (!empty($_POST['label_other_fee']) && !empty($_POST['unite']) && !empty($_POST['parametre']) && !empty($_POST['base'])) {
			
			$maClasse-> updateNoteDebit($_POST['ref_note'], $_POST['label_other_fee'], $_POST['unite'], $_POST['parametre'], $_POST['base']);

		}

  		$response = array('message' => 'Invoice Created');

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getAllNoteDebit'){// On recupere les donnees du dossier a facturer 

  		$reponse['invoice_pending_validation'] = $maClasse-> getInvoicePendingValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_pending_validation'] = $maClasse-> getNombreFactureDossierEnAttenteValidation($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_waiting_to_send'] = $maClasse-> getInvoiceAwaitingToSend($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_waiting_to_send'] = $maClasse-> getNombreFactureDossierEnAttenteEnvoie($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_send'] = $maClasse-> getInvoiceSended($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['nbre_invoice_send'] = $maClasse-> getNombreFactureDossierEnvoyee($_POST['id_cli'], $_POST['id_mod_lic']);
  		$reponse['invoice_payed'] = $maClasse-> getInvoicePayed($_POST['id_cli'], $_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getNoteDebitAjax'){ // On Recupere les factures CDN

		echo json_encode($maClasse-> getNoteDebitAjax($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='validerNoteDebit'){ 

		$maClasse-> MAJ_validation_note_debit($_POST['ref_note'], '1');
		$reponse['msg'] = 'Done!';
  		echo json_encode($reponse);

	}else if (isset($_POST['operation']) && $_POST['operation']=='creerEBTrackingAjax') {
	    
        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
        }

        if (isset($_FILES['fichier_lic']['name'])) {

          $fichier_lic = $_FILES['fichier_lic']['name'];
          $tmp = $_FILES['fichier_lic']['tmp_name'];

        }else{
          $fichier_lic = NULL;
          $tmp = NULL;
        }

        if (isset($_FILES['fichier_fact']['name'])) {

          $fichier_fact = $_FILES['fichier_fact']['name'];
          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

        }else{
          $fichier_fact = NULL;
          $tmp_fact = NULL;
        }
    
	    $maClasse-> creerEBTrackingAjax($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
	                                $_POST['unit_mes'], $_POST['id_cli'], $_POST['id_march'], 
	                                $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
	                                $_POST['acheteur'], $_POST['id_mod_trans'], $_POST['id_banq'], 
	                                $_POST['fob'], $_POST['id_type_lic'], NULL,
	                            	$fichier_lic, $tmp, $_POST['id_mon']);


		$reponse['msg'] = 'Done!';
  		echo json_encode($reponse);
	}else if (isset($_POST['operation']) && $_POST['operation']=='getLicence') {
	    
		$reponse = $maClasse-> getLicence($_POST['num_lic']);
		$reponse['date_exp'] = $maClasse-> getLastEpirationLicence2($_POST['num_lic']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossiersPretAEtreApuresAjax'){ 

		echo json_encode($maClasse-> afficherDossiersPretAEtreApuresAjax($_POST['id_mod_lic'], $_POST['id_cli'], $_POST['type_trans_ap']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDossier'){ 

		$response = $maClasse-> getDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_dossier'){ 


      	if (isset($_POST['ref_assurance']) && ($_POST['ref_assurance'] != '')) {
        	$maClasse-> MAJ_ref_assurance($_POST['id_dos'], $_POST['ref_assurance']);
      	}

      	if (isset($_POST['type_apurement']) && ($_POST['type_apurement'] != '')) {
        	$maClasse-> MAJ_type_apurement($_POST['id_dos'], $_POST['type_apurement']);
      	}

      	if (isset($_POST['remarque_apurement']) && ($_POST['remarque_apurement'] != '')) {
        	$maClasse-> MAJ_remarque_apurement($_POST['id_dos'], $_POST['remarque_apurement']);
      	}

      	//ref_cvee
      	if (isset($_POST['ref_cvee']) && ($_POST['ref_cvee'] != '')) {
        	$maClasse-> MAJ_ref_cvee($_POST['id_dos'], $_POST['ref_cvee']);
      	}
      	//fob_cvee
      	if (isset($_POST['fob_cvee']) && ($_POST['fob_cvee'] != '')) {
        	$maClasse-> MAJ_fob_cvee($_POST['id_dos'], $_POST['fob_cvee']);
      	}
      	//fob
      	if (isset($_POST['fob']) && ($_POST['fob'] != '')) {
        	$maClasse-> MAJ_fob($_POST['id_dos'], $_POST['fob']);
      	}


		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDossierEnAttenteApurementLicenceAjax'){ 

		$response['tableau_dossier'] = $maClasse-> getDossierEnAttenteApurementLicenceAjax($_POST['num_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDossierEnAttenteApurementLicenceAjaxDGDA'){ 

		$response['tableau_dossier'] = $maClasse-> getDossierEnAttenteApurementLicenceAjaxDGDA($_POST['num_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDossierEnAttenteApurementLicenceAjaxOCC'){ 

		$response['tableau_dossier'] = $maClasse-> getDossierEnAttenteApurementLicenceAjaxOCC($_POST['num_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherApurementAjax'){ 

		echo json_encode($maClasse-> afficherApurementAjax($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherApurementAjaxDGDA'){ 

		echo json_encode($maClasse-> afficherApurementAjax($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['type_trans_ap']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTransmissionApurement'){ 

		$response = $maClasse-> getTransmissionApurement($_POST['id_trans_ap']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_transmit'){ 

		$maClasse-> update_date_depot_transmis($_POST['id_trans_ap'], $_POST['date_depot']);
		$maClasse-> update_ref_trans_ap($_POST['id_trans_ap'], $_POST['ref_trans_ap']);

		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='rapportAdvanceTransmitLicence'){ 

		echo json_encode($maClasse-> rapportAdvanceTransmitLicence($_POST['id_mod_lic'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_non_transmis_licence'){ 

		echo json_encode($maClasse-> dossier_non_transmis_licence($_POST['num_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_transmis_licence_sans_ar'){ 

		echo json_encode($maClasse-> dossier_transmis_licence_sans_ar($_POST['num_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_transmis_licence_avec_ar'){ 

		echo json_encode($maClasse-> dossier_transmis_licence_avec_ar($_POST['num_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='master_data_transmit'){ 

		echo json_encode($maClasse-> master_data_transmit($_POST['id_mod_lic'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='statut_licence'){ 

		echo json_encode($maClasse-> statut_licence($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_dossier_pending_worksheet'){ 

		$response['tableau_dossier_pending_worksheet'] = $maClasse-> tableau_dossier_pending_worksheet($_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_client_worksheet'){ 

		$response['tableau_client_worksheet'] = $maClasse-> tableau_client_worksheet($_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_client_ogefrem'){ 

		$response['tableau_client_ogefrem'] = $maClasse-> tableau_client_ogefrem();

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_pending_worsheet'){ 

		echo json_encode($maClasse-> dossier_pending_worsheet($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_ogefrem'){ 

		echo json_encode($maClasse-> dossier_ogefrem($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_ogefrem_dashboard'){ 

		echo json_encode($maClasse-> dossier_ogefrem_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_lmc_dashboard'){ 

		echo json_encode($maClasse-> dossier_lmc_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_loading_dashboard'){ 

		echo json_encode($maClasse-> dossier_loading_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_worksheet'){ 

		$response = $maClasse-> getDossier($_POST['id_dos']);
		$response['label_mon_fob'] = $maClasse-> getMonnaie($maClasse-> getDataDossier($_POST['id_dos'])['id_mon_fob'])['sig_mon'];
  		$response['mon_fob'] = '<select class="" name="mon_fob" id="mon_fob" onchange="maj_id_mon_fob(id_dos_worsheet.value, this.value);" required><option value="'.$response['id_mon_fob'].'">'.$maClasse-> getMonnaie($response['id_mon_fob'])['sig_mon'].'</option>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$response['mon_fret'] = '<select class="" name="mon_fret" id="mon_fret" onchange="maj_id_mon_fret(id_dos_worsheet.value, this.value);" required><option value="'.$response['id_mon_fret'].'">'.$maClasse-> getMonnaie($response['id_mon_fret'])['sig_mon'].'</option>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$response['mon_autre_frais'] = '<select class="" name="mon_autre_frais" id="mon_autre_frais" onchange="maj_id_mon_autre_frais(id_dos_worsheet.value, this.value);" required><option value="'.$response['id_mon_autre_frais'].'">'.$maClasse-> getMonnaie($response['id_mon_autre_frais'])['sig_mon'].'</option>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
  		$response['mon_assurance'] = '<select class="" name="mon_assurance" id="mon_assurance" onchange="maj_id_mon_assurance(id_dos_worsheet.value, this.value);" required><option value="'.$response['id_mon_assurance'].'">'.$maClasse-> getMonnaie($response['id_mon_assurance'])['sig_mon'].'</option>
  								'.$maClasse-> selectionnerMonnaie2().'
  							</select>';
		$response['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creerWorksheet'){ 

		$maClasse-> creerWorksheet($_POST['id_dos'], $_POST['nom_march'], $_POST['num_av'], $_POST['ref_fact'], $_POST['code_tarif_march'], $_POST['position_av'], $_POST['origine'], $_POST['provenance'], $_POST['code_add'], $_POST['nbr_bags'], $_POST['qte'], $_POST['poids'], $_POST['fob']);
		$response['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
		// $response = $maClasse-> getDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getSommeMarchandiseDossier'){ 

		$response['fob'] = $maClasse-> getFOBMarchandiseDossier($_POST['id_dos']);
		// $response = $maClasse-> getDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_regime'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_regime($_POST['id_dos'], $_POST['regime']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_incoterm'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_incoterm($_POST['id_dos'], $_POST['incoterm']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='maj_roe_feuil_calc'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> maj_roe_feuil_calc($_POST['id_dos'], $_POST['roe_feuil_calc']);
		$response['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimerMarchandiseDossier'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> supprimerMarchandiseDossier($_POST['id_march_dos']);
		$response['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='valider_worksheet'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_verif_feuil_calc($_POST['id_dos']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='valider_worksheet_ops'){// MAJ Montant Decl

  		// $reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_verif_feuil_calc_ops($_POST['id_dos']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_worsheet_waiting_validation'){ 

		echo json_encode($maClasse-> dossier_worsheet_waiting_validation($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_worsheet_validated'){ 

		echo json_encode($maClasse-> dossier_worsheet_validated($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_worsheet_validated_ops'){ 

		echo json_encode($maClasse-> dossier_worsheet_validated_ops($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='code_tarifaire_ajax'){ 

		echo json_encode($maClasse-> code_tarifaire_ajax());

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_edit_note_debit'){

  		$reponse['detail_debit_note'] = $maClasse-> detail_debit_note($_POST['ref_note']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='delete_detail_depense'){

  		$maClasse-> delete_detail_depense($_POST['ref_note'], $_POST['id_dep_dos']);
  		$reponse['detail_debit_note'] = $maClasse-> detail_debit_note($_POST['ref_note']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_note_debit'){

  		$maClasse-> edit_note_debit($_POST['ref_note_old'], $_POST['date_create'], $_POST['ref_note']);
  		$reponse['message'] = 'Done!';

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_detail_depense'){

  		$maClasse-> edit_detail_depense($_POST['ref_note'], $_POST['id_dep_dos'], $_POST['montant']);
  		// $reponse['detail_debit_note'] = $maClasse-> detail_debit_note($_POST['ref_note']);
  		$reponse['message'] = 'Done!';

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='popUpRapportNoteDebit'){ // On Recupere les data pour rapport facturation Popup
		$id_mod_lic = NULL;
		if (isset($_POST['id_mod_lic'])&&($_POST['id_mod_lic']!='')) {
			$id_mod_lic = $_POST['id_mod_lic'];
		}
		
		echo json_encode($maClasse-> popUpRapportNoteDebit($_POST['id_mod_lic']));
		
	}elseif(isset($_POST['operation']) && $_POST['operation']=='monitoring_depenses'){ 

		echo json_encode($maClasse-> monitoring_depenses($_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='depense_pending_invoicing'){ 

		echo json_encode($maClasse-> depense_pending_invoicing($_POST['id_dep'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='depense_invoiced'){ 

		echo json_encode($maClasse-> depense_invoiced($_POST['id_dep'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='depense_note_debit'){ 

		echo json_encode($maClasse-> depense_note_debit($_POST['id_dep'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_fret'){// MAJ Fret

  		$maClasse-> MAJ_fret($_POST['id_dos'], $_POST['fret']);
  		$reponse['message'] = 'Done!';
		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_assurance'){// MAJ Assurance

  		$maClasse-> MAJ_assurance($_POST['id_dos'], $_POST['assurance']);
  		$reponse['message'] = 'Done!';
		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_autre_frais'){// MAJ autre_frais

  		$maClasse-> MAJ_autre_frais($_POST['id_dos'], $_POST['autre_frais']);
  		$reponse['message'] = 'Done!';
		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_duree_loyer'){// MAJ duree_loyer

  		$maClasse-> MAJ_duree_loyer($_POST['id_dos'], $_POST['duree_loyer']);
  		$reponse['message'] = 'Done!';
		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='grouper_marchandise'){

  		$maClasse-> grouper_marchandise($_POST['id_dos']);
		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);
  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='check_camion'){
		
		if (!empty($maClasse-> check_camion($_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], $_POST['road_manif']))) {
			$reponse['msg_check_camion'] = '<span>
												<div class="alert alert-warning alert-dismissible fade show" role="alert">
												  <strong>Alert Doublon Camion!</strong><br>
												  Le dossier <b>'.$maClasse-> check_camion($_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], $_POST['road_manif'])['ref_dos'].'</b> cree le  '.$maClasse-> check_camion($_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], $_POST['road_manif'])['date_creat_dos'].' contient les information de ce camion.
												  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
												    <span aria-hidden="true">&times;</span>
												  </button>
												</div>
											</span>';

			$reponse['delai'] = $maClasse-> check_camion($_POST['horse'], $_POST['trailer_1'], $_POST['trailer_2'], $_POST['road_manif'])['delai'];
		}else{
			$reponse['message'] = 'Done!';
		}

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_depense_modele_licence'){// On recupere les donnees du dossier a facturer 

  		$reponse['tableau_client_depense_modele_licence'] = $maClasse-> tableau_client_depense_modele_licence($_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_depense_modele_licence'){// On recupere les donnees du dossier a facturer 

  		$reponse['tableau_client_depense_modele_licence'] = $maClasse-> tableau_client_depense_modele_licence($_POST['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='selectPONewNoteDebitKamoa'){

  		$reponse['selectPONewNoteDebitKamoa'] = $maClasse-> selectPONewNoteDebitKamoa($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossierNewNoteDebitKamoa'){

  		$reponse['afficherDossierNewNoteDebitKamoa'] = $maClasse-> afficherDossierNewNoteDebitKamoa($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep'], $_POST['po_ref']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossierNewNoteDebitOther'){

  		$reponse['afficherDossierNewNoteDebitOther'] = $maClasse-> afficherDossierNewNoteDebitOther($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossierNewNoteDebitCEECImpala'){

  		$reponse['afficherDossierNewNoteDebitCEECImpala'] = $maClasse-> afficherDossierNewNoteDebitCEECImpala($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_edit_marchandise_dossier'){

  		$reponse['marchandiseDossier'] = $maClasse-> getMarchandiseDossierEdit($_POST['id_dos'], $_POST['ligne']);

  		echo json_encode($reponse);

	}//num_av
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_num_av'){

  		$maClasse-> maj_march_dos_num_av($_POST['id_march_dos'], $_POST['num_av']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//ref_fact
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_ref_fact'){

  		$maClasse-> maj_march_dos_ref_fact($_POST['id_march_dos'], $_POST['ref_fact']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//position_av
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_position_av'){

  		$maClasse-> maj_march_dos_position_av($_POST['id_march_dos'], $_POST['position_av']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//origine
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_origine'){

  		$maClasse-> maj_march_dos_origine($_POST['id_march_dos'], $_POST['origine']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//provenance
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_provenance'){

  		$maClasse-> maj_march_dos_provenance($_POST['id_march_dos'], $_POST['provenance']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//code_add
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_code_add'){

  		$maClasse-> maj_march_dos_code_add($_POST['id_march_dos'], $_POST['code_add']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//nbr_bags
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_nbr_bags'){

  		$maClasse-> maj_march_dos_nbr_bags($_POST['id_march_dos'], $_POST['nbr_bags']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//qte
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_qte'){

  		$maClasse-> maj_march_dos_qte($_POST['id_march_dos'], $_POST['qte']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//poids
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_poids'){

  		$maClasse-> maj_march_dos_poids($_POST['id_march_dos'], $_POST['poids']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//fob
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_fob'){

  		$maClasse-> maj_march_dos_fob($_POST['id_march_dos'], $_POST['fob']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}//nom_march
	elseif(isset($_POST['operation']) && $_POST['operation']=='maj_march_dos_nom_march'){

  		$maClasse-> maj_march_dos_nom_march($_POST['id_march_dos'], $_POST['nom_march']);
  		$response['message'] = 'Done !';

  		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='reloadMarchandiseDossier'){ 

		$response['marchandiseDossier'] = $maClasse-> getMarchandiseDossier($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='updateNoteDebit'){ 

		if (!empty($_POST['label_other_fee']) && !empty($_POST['unite']) && !empty($_POST['parametre']) && !empty($_POST['base'])) {
			
			$maClasse-> updateNoteDebit($_POST['ref_note'], $_POST['label_other_fee'], $_POST['unite'], $_POST['parametre'], $_POST['base']);

		}

		$response['message'] = 'Done!';

		echo json_encode($response);

	}else if(isset($_POST['operation']) && $_POST['operation']=='afficherMonitoringFile'){

  		$reponse['nbre_awaiting_elq'] = $maClasse-> nbre_awaiting_elq($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_awaiting_invoice'] = $maClasse-> nbre_awaiting_invoice($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_liq_not_invoice'] = $maClasse-> nbre_liq_not_invoice($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_dispatched_not_invoice'] = $maClasse-> nbre_dispatched_not_invoice($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_invoiced'] = $maClasse-> nbre_invoiced($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_disabled'] = $maClasse-> nbre_disabled($_POST['id_mod_lic'], $_POST['id_cli']);
  		$reponse['nbre_dossier_facture_excel'] = $maClasse-> getNbreDossierFactureExcel($_POST['id_mod_lic'], $_POST['id_cli']);

  		echo json_encode($reponse);

	}else if(isset($_POST['operation']) && $_POST['operation']=='getReportPendingInvoiceCommodityCategory'){

  		$reponse['getReportPendingInvoiceCommodityCategory'] = $maClasse-> getReportPendingInvoiceCommodityCategory($_POST['id_mod_lic']);
  		echo json_encode($reponse);

	}else if ($_POST['operation']=="statutDossier2") {
		echo json_encode($maClasse-> afficherStatutDossierFactureAjax2($_POST['statut'], $_POST['id_mod_lic'], $_POST['id_cli']));
	}else if ($_POST['operation']=="reportPendingInvoiceCommodityCategory") {
		echo json_encode($maClasse-> reportPendingInvoiceCommodityCategory($_POST['id_mod_lic'], $_POST['id_march']));
	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDeboursPourFactureClientModeleLicenceAjaxChange'){// On recupere le modele a facturer
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjaxChange($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_dos']);
  		// $reponse['template_invoice'] = $maClasse-> selectionnerMarchandiseTemplateFacture($reponse['id_cli'], $reponse['id_mod_trans'], $reponse['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDeboursPourFactureClientModeleLicenceAjaxChangeEdit'){// On recupere le modele a facturer
  		$reponse['debours'] = $maClasse-> getDeboursPourFactureClientModeleLicenceAjaxChangeEdit($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_dos'], $_POST['ref_fact']);
  		// $reponse['template_invoice'] = $maClasse-> selectionnerMarchandiseTemplateFacture($reponse['id_cli'], $reponse['id_mod_trans'], $reponse['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_client_rapport_invoice'){ 

		$response['tableau_client_rapport_invoice'] = $maClasse-> tableau_client_rapport_invoice($_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='search_client_rapport_invoice'){ 

		$response['tableau_client_rapport_invoice'] = $maClasse-> tableau_client_rapport_invoice($_POST['id_mod_lic'], $_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='invoice_report'){ // On Recupere les factures CDN

		echo json_encode($maClasse-> invoice_report($_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='search_client_worksheet'){ 

		$response['tableau_client_worksheet'] = $maClasse-> search_client_worksheet($_POST['id_mod_lic'], $_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='search_client_ogefrem'){ 

		$response['tableau_client_ogefrem'] = $maClasse-> search_client_ogefrem($_POST['mot_cle']);

		echo json_encode($response);

	}//note_feuille
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_note_feuille'){

  		$reponse['message'] = 'Done!';
  		$maClasse-> MAJ_note_feuille($_POST['id_dos'], $_POST['note_feuille']);

  		echo json_encode($reponse);

	}//note_fret
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_note_fret'){

  		$reponse['message'] = 'Done!';
  		$maClasse-> MAJ_note_fret($_POST['id_dos'], $_POST['note_fret']);

  		echo json_encode($reponse);

	}//note_assurance
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_note_assurance'){

  		$reponse['message'] = 'Done!';
  		$maClasse-> MAJ_note_assurance($_POST['id_dos'], $_POST['note_assurance']);

  		echo json_encode($reponse);

	}//note_autre_frais
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_note_autre_frais'){

  		$reponse['message'] = 'Done!';
  		$maClasse-> MAJ_note_autre_frais($_POST['id_dos'], $_POST['note_autre_frais']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='calculFOBWorksheet'){

  		$reponse['fob'] = $maClasse-> getDataDossier($_POST['id_dos'])['fob'];

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='resume_facture_client'){
		echo json_encode($maClasse-> resume_facture_client($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='detail_cotation'){

		$response['detail_cotation'] = $maClasse-> detail_cotation($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);
		$response['label_cotation'] = '<span class="badge badge-dark text-md">'.$maClasse-> getClient($_POST['id_cli'])['nom_cli'].' | '.$maClasse-> getMarchandise($_POST['id_march']).' | '.$maClasse-> getNomModeTransport($_POST['id_mod_trans']).'</span>';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='inserer_aff_debours'){

		$maClasse-> inserer_aff_debours($_POST['id_deb'], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['montant'], $_POST['montant_under_value'], $_POST['usd'], $_POST['tva'], $_POST['unite']);
		$response['message'] = 'Done!';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='supprimer_aff_debours'){

		$maClasse-> supprimer_aff_debours($_POST['id_deb'], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march'], $_POST['id_mod_trans']);
		$response['message'] = 'Done!';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modele_facture_client'){
		echo json_encode($maClasse-> modele_facture_client($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='template_invoice_excl_client'){ 

		echo json_encode($maClasse-> template_invoice_excl_client($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='insert_modele_facture'){ 
		$response['message'] = 'Done!';

		$maClasse-> insert_modele_facture($_POST['id_mod_fact'], $_POST['id_cli'], $_POST['id_march'], $_POST['id_mod_trans'], $_POST['id_cli_old'], $_POST['id_mod_lic']);

		echo json_encode($response);

	}else if ($_POST['operation']=="menuLicence") {

		$response['table_menuLicence'] = $maClasse-> table_menuLicence($_POST['id_mod_lic'], $_POST['mot_cle']);

		echo json_encode($response);

	}else if ($_POST['operation']=="table_client_note_debit") {

		$response['table_client_note_debit'] = $maClasse-> table_client_note_debit($_POST['mot_cle']);

		echo json_encode($response);

	}else if ($_POST['operation']=="table_menuLicence_synthese") {

		$response['table_menuLicence'] = $maClasse-> table_menuLicence_synthese($_POST['id_mod_lic'], $_POST['id_type_lic'], $_POST['page'], $_POST['mot_cle']);

		echo json_encode($response);

	}//roe_fob
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_roe_fob'){

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_roe_fob($_POST['id_dos'], $_POST['roe_fob']);

  		echo json_encode($reponse);

	}
//roe_fret
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_roe_fret'){

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_roe_fret($_POST['id_dos'], $_POST['roe_fret']);

  		echo json_encode($reponse);

	}
//roe_assurance
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_roe_assurance'){

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_roe_assurance($_POST['id_dos'], $_POST['roe_assurance']);

  		echo json_encode($reponse);

	}
//roe_autre_frais
	elseif(isset($_POST['operation']) && $_POST['operation']=='MAJ_roe_autre_frais'){

  		$reponse = $maClasse-> getDataDossier($_POST['id_dos']);
  		$maClasse-> MAJ_roe_autre_frais($_POST['id_dos'], $_POST['roe_autre_frais']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='kpi_tracking_report'){ 

		echo json_encode($maClasse-> kpi_tracking_report($_POST['debut'], $_POST['fin']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='kpi_tracking_reportAll'){ 

		echo json_encode($maClasse-> kpi_tracking_reportAll($_POST['debut'], $_POST['fin'], $_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='kpi_tracking_reportAll2'){ 

		echo json_encode($maClasse-> kpi_tracking_reportAll2($_POST['champ_col'], $_POST['debut'], $_POST['fin'], $_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='update_OGEFREM'){ 

		$maClasse-> MAJ_ogefrem_ref_fact($_POST['id_dos'], $_POST['ogefrem_ref_fact']);
		$maClasse-> MAJ_lmc_id($_POST['id_dos'], $_POST['lmc_id']);

		$response['message'] = 'Done!';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='synthese_licence'){ 

		echo json_encode($maClasse-> synthese_licence($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_type_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='new_synthese_licence'){ 

		$maClasse-> new_synthese_licence_EB($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                $_POST['unit_mes'], $_POST['id_cli'], $_POST['id_march'], 
                                $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                $_POST['acheteur'], $_POST['id_mod_trans'], $_POST['id_banq'],
                                 $_POST['fob'], $_POST['lot_pret'], $_FILES['fichier_lic']['name'], 
                                 $_FILES['fichier_lic']['tmp_name'], $_POST['id_type_lic']);

		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_edit_synthese_licence'){ 

		$response = $maClasse-> getLicence($_POST['num_lic']);
		$response['date_exp'] = $maClasse-> getDateExpirationLicence2($_POST['num_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_synthese_licence'){ 

		$maClasse-> edit_synthese_licence_EB($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                $_POST['unit_mes'], $_POST['id_cli'], $_POST['id_march'], 
                                $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                $_POST['acheteur'], $_POST['id_mod_trans'], $_POST['id_banq'],
                                 $_POST['fob'], $_POST['lot_pret'], $_POST['num_lic_old']);

		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getNombreNotificationApurement'){ 

		//dgda
		$response['nbre_dossier_no_apurement_dgda'] = $maClasse-> nbre_dossier_no_apurement_dgda($_POST['id_cli'], $_POST['id_mod_lic']);
		$response['nbre_transmis_no_ar_dgda'] = $maClasse-> nbre_transmis_no_ar_dgda($_POST['id_cli'], $_POST['id_mod_lic']);
		//occ
		$response['nbre_dossier_no_apurement_occ'] = $maClasse-> nbre_dossier_no_apurement_occ($_POST['id_cli'], $_POST['id_mod_lic']);
		$response['nbre_transmis_no_ar_occ'] = $maClasse-> nbre_transmis_no_ar_occ($_POST['id_cli'], $_POST['id_mod_lic']);

		$response['nbre_dossier_sans_fob_apurement'] = $maClasse-> nbre_dossier_sans_fob_apurement($_POST['id_cli'], $_POST['id_mod_lic']);
		
		$response['nbre_dossier_sans_manifeste_apurement'] = $maClasse-> nbre_dossier_sans_manifeste_apurement($_POST['id_cli'], $_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='new_transmit_ap_dgda'){ 
		
		$maClasse-> creerTransmissionApurement(NULL, $_POST['ref_trans_ap'], 
                                  $_SESSION['id_util'], NULL, $_POST['banque'], $_POST['date_trans_ap']);

	    $id_trans_ap = $maClasse-> verifierTransmissionApurement($_POST['ref_trans_ap'], $_POST['date_trans_ap'], $_POST['banque'], $_POST['type_trans_ap']);

	    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
	      
	      if (isset($_POST['id_dos_'.$i]) && ($_POST['id_dos_'.$i]!='')) {
	        
	        $maClasse-> creerDetailApurement($id_trans_ap, $_POST['id_dos_'.$i]);
	        // echo $id_trans_ap.' '.$_POST['id_dos_'.$i].'<br>';

	      }

	    }

	    $response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='upload_ar_transmit'){ 
		
		if (isset($_FILES['fichier_trans_ap']['name'])) {

	      $fichier_trans_ap = $_FILES['fichier_trans_ap']['name'];
	      $tmp = $_FILES['fichier_trans_ap']['tmp_name'];

	      $maClasse-> uploadAccuseeRecpetionTransmissionApurement($_POST['id_trans_ap'], $fichier_trans_ap, $tmp);

	    }else{
	      $fichier_trans_ap = NULL;
	      $tmp = NULL;
	    }

	    $response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='buildReferenceTransmissionApurementModeleLicence'){ 
		
		$code = '';

		$i = 1;

		$a = $maClasse-> getTailleCompteur2($i);

		$code = $a.'-'.$maClasse-> getElementModeleLicence($_POST['id_mod_lic'])['sigle_mod_lic'].'-'.date('y');

		while($maClasse-> verifierReferenceTransmissionApurement($code) == true){
			$i++;

			$a = $maClasse-> getTailleCompteur2($i);

			$code = $a.'-'.$maClasse-> getElementModeleLicence($_POST['id_mod_lic'])['sigle_mod_lic'].'-'.date('y');
		}


	    $response['ref_trans_ap'] = $code;

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='afficherDossiersSansFOBApuresAjax'){ 

		echo json_encode($maClasse-> afficherDossiersSansFOBApuresAjax($_POST['id_mod_lic'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDeboursPourFactureLicenceGlobale'){// On recupere les donnees du dossier a facturer 

  		$reponse['debours'] = $maClasse-> getDeboursPourFactureLicenceGlobale($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['num_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creerFactureLicenceGlobale'){// On enregistre la facture FactureLicenceGlobale

  		if(isset($_POST['ref_fact'])){
  			try {
  			$maClasse-> creerFactureLicenceGlobale($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'partielle', $_POST['num_lic'], '0', NULL, $_POST['taux']);

  			for ($i=1; $i <= $_POST['compteur'] ; $i++) { 
  				if (isset($_POST['montant_'.$i]) && $_POST['montant_'.$i] > 1) {
  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], 1, $_POST['id_deb_'.$i], $_POST['montant_'.$i], $_POST['tva_'.$i], $_POST['usd_'.$i]);
  				}
  				
  			}

  			$response = array('message' => 'Invoice Created');
  			// $response['ref_fact'] = $maClasse-> buildRefFactureGlobale($_POST['id_cli']);
  			// $response['ref_dos'] =$maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_march']);

  			} catch (Exception $e) {

	            $response = array('error' => $e->getMessage());

	        }

  		}
	    echo json_encode($response);
	}elseif(isset($_POST['operation']) && $_POST['operation']=='getTableauEMSExport'){// On recupere les donnees du dossier a facturer 

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
  		$reponse['template_invoice'] = $maClasse-> selectionnerMarchandiseTemplateFacture($reponse['id_cli'], $reponse['id_mod_trans'], $reponse['id_mod_lic']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='get_tableau_kpis'){

  		$reponse['get_tableau_kpis1'] = $maClasse-> get_tableau_kpis1($_POST['debut'], $_POST['fin']);
  		$reponse['get_tableau_kpis2'] = $maClasse-> get_tableau_kpis2($_POST['debut'], $_POST['fin']);
  		$reponse['mois_kpis'] = $maClasse-> get_mois_kpis($_POST['debut'], $_POST['fin']);

  		echo json_encode($reponse);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_client_cvee'){ 

		$response['tableau_client_cvee'] = $maClasse-> tableau_client_cvee();

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='search_client_cvee'){ 

		$response['tableau_client_cvee'] = $maClasse-> search_client_cvee($_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_cvee'){ 

		echo json_encode($maClasse-> dossier_cvee($_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='update_CVEE'){ 
		
      	//ref_cvee
      	if (isset($_POST['ref_cvee']) && ($_POST['ref_cvee'] != '')) {
        	$maClasse-> MAJ_ref_cvee($_POST['id_dos'], $_POST['ref_cvee']);
      	}
      	//fob_cvee
      	if (isset($_POST['fob_cvee']) && ($_POST['fob_cvee'] != '')) {
        	$maClasse-> MAJ_fob_cvee($_POST['id_dos'], $_POST['fob_cvee']);
      	}

		$response['message'] = 'Done!';
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_loading_dashboard'){ 

		echo json_encode($maClasse-> dossier_loading_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_dispatch_dashboard'){ 

		echo json_encode($maClasse-> dossier_dispatch_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_no_dispatch_dashboard'){ 

		echo json_encode($maClasse-> dossier_no_dispatch_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='dossier_quittance_dashboard'){ 

		echo json_encode($maClasse-> dossier_quittance_dashboard($_POST['debut'], $_POST['fin'], $_POST['id_cli'], $_POST['id_mod_lic']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creer_demande_fond'){ 

		//Check Dossier doublon dans la meme demande de fond
		$erreur_1 = '';
		$erreur_2 = '';
		$dossier_tmp_1 = '';
		$dossier_tmp_2 = '';

    	for ($a=0; $a < $_POST['nbre'] ; $a++) { 

    		$dossier_tmp_1 = $_POST['id_dos_'.$a];

    		for ($j=0; $j < $_POST['nbre'] ; $j++) { 
    			
    			if ($a!=$j) {
    				
    				$dossier_tmp_2 = $_POST['id_dos_'.$j];
    				if ($dossier_tmp_1 == $dossier_tmp_2) {
    				
	    				$erreur_1 .= $maClasse-> getDossier($dossier_tmp_1)['ref_dos'].'<br>';

	    			}

    			}

    		}

    	}

    	for ($a=0; $a < $_POST['nbre'] ; $a++) { 


    		if (!empty($maClasse-> double_check_request($_POST['id_dos_'.$a], $_POST['id_dep']))) {
    				
				$erreur_2 .= $maClasse-> getDossier($_POST['id_dos_'.$a])['ref_dos'].'<br>';

			}

    	}

    	if ($erreur_1!='') {

    		$response['erreur_1'] = '
	    				<div class="alert alert-danger alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <strong>Duplicate Entry Error: </strong><br> '.$erreur_1.'
		                </div>';

    	}else if ($erreur_2!='') {

    		$response['erreur_2'] = '
	    				<div class="alert alert-danger alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <strong>Duplicate expense error on file: </strong><br> '.$erreur_2.'
		                </div>';

    	}else{


			$maClasse-> creer_demande_fond($_POST['id_dept'], $_POST['id_site'], $_POST['beneficiaire'], $_POST['id_cli'], $_POST['cash'], $_POST['montant'], $_POST['usd'], $_POST['libelle'], $_POST['id_util_visa_dept'], $_POST['id_dep']);
	    	
	    	$id_df = $maClasse-> getLastDemandeFond()['id_df'];
			
			if (($_FILES['fichier_df']['name'])) {

	    		$file = $_FILES['fichier_df'];
	    		$filename = $file['name'];
	    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

	    		$fichier_df = uniqid();
	    		// $id_df = str_replace("/", "_", "$id_df");
				
				$dossier = '../demande_fond/'.$id_df;

				if(!is_dir($dossier)){
					mkdir("../demande_fond/$id_df", 0777);
				}
				$uploadFile = $dossier.'/'.$fichier_df.'.'.$ext;
				move_uploaded_file($file['tmp_name'], $uploadFile);

	    		$maClasse-> inserer_fichier_df($id_df, $fichier_df.'.'.$ext);

	    	}

	    	for ($i=0; $i <= $_POST['nbre'] ; $i++) { 

	    		if (isset($_POST['id_dos_'.$i])) {

	    			$maClasse-> creerDepenseDossierDF($_POST['id_dep'], $_POST['id_dos_'.$i], date('Y-m-d'), $_POST['montant_'.$i], $id_df);
	    			

	    		}

	    	}

		    $response['message'] = '
		    				<div class="alert alert-success alert-dismissible" role="alert">
			                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			                  <strong>Payment request has been created!</strong> 
			                </div>';

			$response['id_df'] = $id_df;


    	}

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='edit_demande_fond'){ 

		$maClasse-> edit_demande_fond($_POST['id_dept'], $_POST['id_site'], $_POST['beneficiaire'], $_POST['id_cli'], $_POST['cash'], $_POST['montant'], $_POST['usd'], $_POST['libelle'], $_POST['id_util_visa_dept'], $_POST['id_dep'], $_POST['id_df']);
    	
    	$id_df = $_POST['id_df'];
		
    	for ($i=0; $i <= $_POST['nbre'] ; $i++) { 

    		if (isset($_POST['id_dos_'.$i])) {

    			$maClasse-> creerDepenseDossierDF($_POST['id_dep'], $_POST['id_dos_'.$i], date('Y-m-d'), $_POST['montant_'.$i], $id_df);
    			

    		}

    	}

	    $response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <strong>Payment request has been update!</strong> 
		                </div>';

		$response['id_df'] = $id_df;

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='update_fichier_df'){ 

    	$id_df = $_POST['id_df'];
		
		if (($_FILES['fichier_df']['name'])) {

    		$file = $_FILES['fichier_df'];
    		$filename = $file['name'];
    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

    		$fichier_df = uniqid();
    		// $id_df = str_replace("/", "_", "$id_df");
			
			$dossier = '../demande_fond/'.$id_df;

			if(!is_dir($dossier)){
				mkdir("../demande_fond/$id_df", 0777);
			}
			$uploadFile = $dossier.'/'.$fichier_df.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $uploadFile);

    		$maClasse-> inserer_fichier_df($id_df, $fichier_df.'.'.$ext);

    	}

	    $response['message'] = 'Done!	';

		$response['id_df'] = $id_df;

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='remove_fichier_df'){ 

    	$maClasse-> remove_fichier_df($_POST['id_df']);

	    $response['message'] = 'Done!	';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='demande_fond'){ 

		echo json_encode($maClasse-> demande_fond($_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='demande_fond_2'){ 

		echo json_encode($maClasse-> demande_fond_2($_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='demande_fond_bank'){ 

		echo json_encode($maClasse-> demande_fond_bank($_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='demande_fond_cash'){ 

		echo json_encode($maClasse-> demande_fond_cash($_POST['statut']));

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getDemandeFond'){ 

		$response = $maClasse-> getDemandeFond($_POST['id_df']);

		$response['visa_dept_df'] = $maClasse-> getUtilisateur($_SESSION['id_util'])['visa_dept_df'];
		$response['visa_dir_df'] = $maClasse-> getUtilisateur($_SESSION['id_util'])['visa_dir_df'];
		$response['visa_fin_df'] = $maClasse-> getUtilisateur($_SESSION['id_util'])['visa_fin_df'];
		$response['decaiss_df'] = $maClasse-> getUtilisateur($_SESSION['id_util'])['decaiss_df'];
		$response['nbre_dos'] = $maClasse-> get_nbre_dossier($_POST['id_df']);

		$response['detail_df'] = '';
		$response['btn_edit_df'] = '';
		$titre = '';
		$btn_action = '';
      	$btn_visa_dept_df = '';
      	$btn_visa_dir_df = '';
      	$btn_visa_fin_df = '';
      	$btn_decaiss_df = '';

      	if ($response['date_visa_dept']==null) {
      		$response['btn_edit_df'] = '<a class="btn btn-xs btn-warning" onclick="window.location.replace(\'edit_demande_fond.php?id_df='.$response['id_df'].'\');"> <i class="fa fa-edit"></i> Edit</a>';
      	}

          if($response['visa_dept_df']=='1'){
            $btn_visa_dept_df = '<span class="btn btn-xs btn-success" onclick="modal_visa_dept_df('.$response['id_df'].')"><i class="fa fa-check"></i> Approve</span> <span class="btn btn-xs btn-danger" onclick="modal_reject_dept_df('.$response['id_df'].')"><i class="fa fa-times"></i> Reject</span>';
          }
          if($response['visa_dir_df']=='1'){
            $btn_visa_dir_df = '<span class="btn btn-xs btn-success" onclick="ok_visa_dir_df('.$response['id_df'].')"><i class="fa fa-check"></i> Approve</span> <span class="btn btn-xs btn-danger" onclick="modal_reject_dept_df('.$response['id_df'].')"><i class="fa fa-times"></i> Reject</span>';
          }
          if($response['visa_fin_df']=='1'){
            $btn_visa_fin_df = '<span class="btn btn-xs btn-success" onclick="ok_visa_fin_df('.$response['id_df'].')"><i class="fa fa-check"></i> Approve</span> <span class="btn btn-xs btn-danger" onclick="modal_reject_dept_df('.$response['id_df'].')"><i class="fa fa-times"></i> Reject</span>';
          }

          if($response['decaiss_df']=='1'){
            $btn_decaiss_df = '<span class="btn btn-xs btn-success" onclick="modal_decaiss_df('.$response['id_df'].')"><i class="fa fa-check"></i> Make the Payment</span>';
          }

		if ($response['id_util_reject_dept']!=null){

			$titre ='<span class="text-sm badge badge-danger">Rejected</span><br><span class="text-sm text text-danger">by '.$response['nom_util_reject_dept'].' | '.$response['date_reject_dept'].' <br> '.$response['motif_reject_dept'].'</span>';

		}else if ($response['date_visa_dept']==null){

			$titre ='<span class="text-sm badge badge-warning">Awaiting Departement Approval</span>';
			$btn_action = $btn_visa_dept_df;

		}else if ($response['date_visa_fin']==null){

			$titre ='<span class="text-sm badge badge-warning">Awaiting Finance Approval</span>';
			$btn_action = $btn_visa_fin_df;

		}else if ($response['date_visa_dir']==null && ($response['cash']=='1'||$response['a_facturer']=='1')){

			$titre ='<span class="text-sm badge badge-warning">Awaiting Management Approval</span>';
			$btn_action = $btn_visa_dir_df;

		}else if ($response['date_decaiss']==null){

			$titre ='<span class="text-sm badge badge-warning">Pending Payment</span>';
			$btn_action = $btn_decaiss_df;

		}else{

			$titre ='<span class="text-sm badge badge-success">Paid</span>';
			$btn_action = '';

		}

		$response['detail_df'] = '
			<tr>
				<td colspan="2" class="text-center">'.$titre.'</td>
			</tr>
			<tr>
				<td>Reference: </td>
				<td><b>'.$response['id_df'].'</b></td>
			</tr>
			<tr>
				<td>Date: </td>
				<td><b>'.$response['date_create'].'</b></td>
			</tr>
			<tr>
				<td>Departement: </td>
				<td><b>'.$response['nom_dept'].'</b></td>
			</tr>
			<tr>
				<td>Location: </td>
				<td><b>'.$response['nom_site'].'</b></td>
			</tr>
			<tr>
				<td>Requestor: </td>
				<td><b>'.$response['nom_util'].'</b></td>
			</tr>
			<tr>
				<td>Type Payment: </td>
				<td><b>'.$response['type_payment'].'</b></td></tr>
			<tr>
				<td>Amount: </td>
				<td><b>'.$response['monnaie'].' '.number_format($response['montant'], 2, ',', ' ').'</b></td>
			</tr>
			<tr>
				<td>Chargeback: </td>
				<td class="bg bg-warning"><b>'.$response['monnaie'].' '.number_format($response['montant_fact'], 2, ',', ' ').'</b> <b>'.$response['btn_fichier_fact'].'</b></td></tr>
			<tr>
				<td>Expense: </td>
				<td><b>'.$response['nom_dep'].'</b></td>
			</tr>
			<tr>
				<td>Motif: </td>
				<td><b>'.$response['libelle'].'</b></td>
			</tr>
			<tr>
				<td>Beneficiary: </td>
				<td><b>'.$response['beneficiaire'].'</b></td>
			</tr>
			<tr>
				<td>Client: </td>
				<td><b>'.$response['nom_cli'].'</b></td>
			</tr>
			<tr>
				<td>Nbre of Files: </td>
				<td><b>'.$response['nbre_dos'].'</b> <a href="#" onclick="window.open(\'popUpRapportPayFile2.php?id_df='.$response['id_df'].'\',\'popUpRapportPayFile2\',\'width=1300,height=900\')"><i class="fa fa-eye"></i></a></td>
			</tr>
			<tr>
				<td>Support Doc.: </td>
				<td><b>'.$response['support_doc'].'</b></td>
			</tr>
			<tr>
				<td>Depart.Approval: </td>
				<td><b>'.$response['nom_util_visa_dept'].'  '.$response['date_visa_dept'].'</b></td>
			</tr>
			<tr>
				<td>Finance Approval: </td>
				<td><b>'.$response['nom_util_visa_fin'].'  '.$response['date_visa_fin'].'</b></td>
			</tr>
			<tr>
				<td>Management Approval: </td>
				<td><b>'.$response['nom_util_visa_dir'].'  '.$response['date_visa_dir'].'</b></td>
			</tr>
			<tr>
				<td>Paid by: </td>
				<td><b>'.$response['nom_util_decaiss'].'  '.$response['date_decaiss'].'</b></td>
			</tr>
			<tr>
				<td>Voucher Ref.: </td>
				<td><b>'.$response['ref_decaiss'].'  '.$response['btn_fichier_decaiss'].'</b></td>
			</tr>
			<tr>
				<td>Action: </td>
				<td>'.$btn_action.'</td>
			</tr>';
	
		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='visa_dept_df'){ 

		if (!isset($_POST['montant_fact'])) {
			$_POST['montant_fact'] = '0';
		}else{

			if (($_FILES['fichier_fact']['name'])) {
			// if (!empty($_FILES)) {

	    		$file = $_FILES['fichier_fact'];
	    		$filename = $file['name'];
	    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

	    		$fichier_fact = uniqid();
	    		$id_df = $_POST['id_df'];
	    		// $id_df = str_replace("/", "_", "$id_df");
				
				$dossier = '../demande_fond/'.$id_df;

				if(!is_dir($dossier)){
					mkdir("../demande_fond/$id_df", 0777);
				}
				$uploadFile = $dossier.'/'.$fichier_fact.'.'.$ext;
				move_uploaded_file($file['tmp_name'], $uploadFile);

	    		$maClasse-> inserer_fichier_fact($id_df, $fichier_fact.'.'.$ext);

	    	}

	    	$maClasse-> depense_dossier_chargeback_DF($_POST['id_df']);

		}

		$maClasse-> visa_dept_df($_POST['id_df'], $_POST['a_facturer'], $_POST['montant_fact']);
		$response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-check"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been approved by the departement!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='reject_dept_df'){ 

		$maClasse-> reject_dept($_POST['id_df'], $_POST['motif_reject_dept']);
		$response['message'] = '
	    				<div class="alert alert-danger alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-times"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been rejected!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='decaiss_df'){ 

		if (!empty($_FILES)) {

    		$file = $_FILES['fichier_decaiss'];
    		$filename = $file['name'];
    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

    		$fichier_decaiss = uniqid();
    		$id_df = $_POST['id_df'];
    		// $id_df = str_replace("/", "_", "$id_df");
			
			$dossier = '../demande_fond/'.$id_df;

			if(!is_dir($dossier)){
				mkdir("../demande_fond/$id_df", 0777);
			}
			$uploadFile = $dossier.'/'.$fichier_decaiss.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $uploadFile);

    		$maClasse-> inserer_fichier_decaiss($id_df, $fichier_decaiss.'.'.$ext);

    	}

		$maClasse-> decaiss_df($_POST['id_df'], $_POST['ref_decaiss'], $_POST['montant_decaiss'], $_POST['nom_recep_fond']);
		$response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-check"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been paid!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='ok_visa_dir_df'){ 

		$maClasse-> ok_visa_dir_df($_POST['id_df']);
		$response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-check"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been approved by the Management!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='ok_visa_fin_df'){ 


		$maClasse-> ok_visa_fin_df($_POST['id_df']);
		$response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-check"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been approved by the finance departement!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_search_dossier_df'){ 

		$response['table_dossier_df'] = $maClasse-> modal_search_dossier_df($_POST['id_cli'], $_POST['id_dep'], $_POST['ligne'], $_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='modal_search_dossier_df_report'){ 

		$response['table_dossier_df'] = $maClasse-> modal_search_dossier_df_report($_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='table_dossier_demande'){ 

		$response['table_dossier_demande'] = $maClasse-> table_dossier_demande($_POST['id_df']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='check_date_error'){ 

		$response['date_error'] = $maClasse-> check_date_error($_POST['id_dos']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='getNombreNotificationRequestFund'){ 

		//dgda
		$response['nbre_dossier_no_apurement_dgda'] = $maClasse-> nbre_dossier_no_apurement_dgda($_POST['id_cli'], $_POST['id_mod_lic']);
		$response['nbre_transmis_no_ar_dgda'] = $maClasse-> nbre_transmis_no_ar_dgda($_POST['id_cli'], $_POST['id_mod_lic']);
		//occ
		$response['nbre_dossier_no_apurement_occ'] = $maClasse-> nbre_dossier_no_apurement_occ($_POST['id_cli'], $_POST['id_mod_lic']);
		$response['nbre_transmis_no_ar_occ'] = $maClasse-> nbre_transmis_no_ar_occ($_POST['id_cli'], $_POST['id_mod_lic']);

		$response['nbre_dossier_sans_fob_apurement'] = $maClasse-> nbre_dossier_sans_fob_apurement($_POST['id_cli'], $_POST['id_mod_lic']);
		
		$response['nbre_dossier_sans_manifeste_apurement'] = $maClasse-> nbre_dossier_sans_manifeste_apurement($_POST['id_cli'], $_POST['id_mod_lic']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='licence_for_excel_tracking'){ 
		
		$response['licence_for_excel_tracking'] = $maClasse-> licence_for_excel_tracking($_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_mod_trans'], $_POST['commodity'], $_POST['statut'], $_POST['id_march'], $_POST['mot_cle']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='double_check_request'){ 
		
		$response = $maClasse-> double_check_request($_POST['id_dos'], $_POST['id_dep']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='selectionnerDepenseAjax'){ 
		
		$response['option'] = $maClasse-> selectionnerDepenseAjax();

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='new_depense'){ 
		
		$maClasse-> new_depense($_POST['nom_dep']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='build_new_file_other_service'){ 
		
		$response['ref_dos'] = $maClasse-> build_new_file_other_service();

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='file_other_service'){ 
		
		echo json_encode($maClasse-> file_other_service());

	}elseif(isset($_POST['operation']) && $_POST['operation']=='new_file_other_service'){ 
		
		$maClasse-> new_file_other_service($_POST['ref_dos'], $_POST['id_cli'], $_POST['remarque']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='nbre_notification_demande_fond'){ 
		
		$response = $maClasse-> nbre_notification_demande_fond();

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='tableau_demande_fond_notification'){ 
		
		$response['tableau_demande_fond_notification'] = $maClasse-> tableau_demande_fond_notification($_POST['niveau']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='upload_dossier_df'){ 
		
		
      $fichier_dossier_df = $_FILES['fichier_dossier_df']['tmp_name'];

      require('../PHPExcel-1.8/Classes/PHPExcel.php');
      require_once('../PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');

      $objExcel = PHPExcel_IOFactory::load($fichier_dossier_df);

      $table = '';
      $compteur = 0;

      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
        $highestRow = $worsheet-> getHighestRow();
        for ($row=1; $row <= $highestRow ; $row++) { 
          

            $ref_dos = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
            // $date_dep = $worsheet-> getCellByColumnAndRow(1, $row)-> getFormattedValue();
            $montant = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();

            $id_dos = $maClasse-> getDossierRefDos($ref_dos)['id_dos'];

            
            if (isset($id_dos)) {

            	if(!empty($maClasse-> double_check_request($id_dos, $_POST['id_dep']))){

            	}else{
            		$table .='<tr>
    						<td>'.($compteur+1).'</td>
    						<td><input type="hidden" id="id_dos_'.$compteur.'" name="id_dos_'.$compteur.'" value="'.$id_dos.'"><span id="label_ref_dos_'.$compteur.'">'.$ref_dos.'</span> <a href="#" class="text-primary" onclick="modal_search_dossier_df('.$compteur.')"><i class="fa fa-search"></i></a> <a href="#" class="text-danger" onclick="remove_dossier_df('.$compteur.')"><i class="fa fa-times"></i></a></td>
    						<td><input type="number" step="0.001" class=" text-right" style="width: 8em;" id="montant_'.$compteur.'" name="montant_'.$compteur.'" value="'.$montant.'" required></td>
    					</tr>';
    				$compteur++;

            	}

              
              // $maClasse-> creerDepenseDossier($_POST['id_dep'], $id_dos, $date_dep, $montant, $assigned_to);

            }

        }
        
      }

      $response['table_dossier_df'] = $table;
      $response['nbre'] = $compteur+1;

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='decaiss_df_edit'){ 

		if (!empty($_FILES) && $_FILES['fichier_decaiss']['name']!='') {

    		$file = $_FILES['fichier_decaiss'];
    		$filename = $file['name'];
    		$ext = pathinfo($filename, PATHINFO_EXTENSION);

    		$fichier_decaiss = uniqid();
    		$id_df = $_POST['id_df'];
    		// $id_df = str_replace("/", "_", "$id_df");
			
			$dossier = '../demande_fond/'.$id_df;

			if(!is_dir($dossier)){
				mkdir("../demande_fond/$id_df", 0777);
			}
			$uploadFile = $dossier.'/'.$fichier_decaiss.'.'.$ext;
			move_uploaded_file($file['tmp_name'], $uploadFile);

    		$maClasse-> inserer_fichier_decaiss($id_df, $fichier_decaiss.'.'.$ext);

    	}

		$maClasse-> decaiss_df_edit($_POST['id_df'], $_POST['ref_decaiss'], $_POST['montant_decaiss'], $_POST['nom_recep_fond']);
		$response['message'] = '
	    				<div class="alert alert-success alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <i class="fa fa-check"></i> The payment request <b>No.'.$_POST['id_df'].'</b> has been paid!
		                </div>';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='delete_depense_dossier'){ 

		$maClasse-> delete_depense_dossier($_POST['id_dos'], $_POST['id_df']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='creerDepenseDossierDF'){ 

		$erreur_2 = '';

		if (!empty($maClasse-> double_check_request($_POST['id_dos'], $_POST['id_dep']))) {
    				
			$erreur_2 .= $maClasse-> getDossier($_POST['id_dos'])['ref_dos'].'<br>';

		}

		if ($erreur_2!='') {

    		$response['erreur_2'] = '
	    				<div class="alert alert-danger alert-dismissible" role="alert">
		                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		                  <strong>Duplicate expense error on file: </strong><br> '.$erreur_2.'
		                </div>';

    	}else{
    		$maClasse-> creerDepenseDossierDF($_POST['id_dep'], $_POST['id_dos'], date('Y-m-d'), $_POST['montant'], $_POST['id_df']);
			$response['message'] = 'Done!';
    	}

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='add_aff_modele_note_debit'){ 

		$maClasse-> add_aff_modele_note_debit($_POST['id_model_nd'], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='delete_aff_modele_note_debit'){ 

		$maClasse-> delete_aff_modele_note_debit($_POST['id_model_nd'], $_POST['id_cli'], $_POST['id_mod_lic'], $_POST['id_dep']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='commentaire_dossier'){ 

		$response['titre_col'] = $maClasse-> getDataColonne($_POST['id_col'])['titre_col'];
		$response['ref_dos'] = $maClasse-> getDossier($_POST['id_dos'])['ref_dos'];
		$response['lister_commentaire_dossier'] = $maClasse-> lister_commentaire_dossier($_POST['id_dos'], $_POST['id_col']);

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='add_commentaire_dossier'){ 

		$maClasse-> add_commentaire_dossier($_POST['id_dos'], $_POST['id_col'], $_POST['valeur']);
		$response['message'] = 'Done!';

		echo json_encode($response);

	}elseif(isset($_POST['operation']) && $_POST['operation']=='get_montant_total_depense_dossier_DF'){ 

		$response['montant'] = $maClasse-> get_montant_total_depense_dossier_DF($_POST['id_df']);

		echo json_encode($response);

	}


?>