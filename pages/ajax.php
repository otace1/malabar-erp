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

		if (isset($_POST['unite_deb_9'])) {
			
			if(isset($_POST['ref_fact'])){
	  			try {
	  			$maClasse-> creerFactureDossier($_POST['ref_fact'], $_POST['id_mod_fact'], $_POST['id_cli'], $_SESSION['id_util'], $_POST['id_mod_lic'], 'globale', NULL);

	  			for ($i=1; $i <= $_POST['unite_deb_9'] ; $i++) { 

  					if(isset($_POST['id_deb_2_'.$i]) && ($_POST['id_deb_2_'.$i]>1) && isset($_POST['roe_decl_'.$i]) && ($_POST['roe_decl_'.$i]>1)){

  						$poids = $maClasse-> getDossier($_POST['id_dos_'.$i])['poids'];

	  					//MAJ ROE
	  					$maClasse-> MAJ_roe_decl($_POST['id_dos_'.$i], $_POST['roe_decl_'.$i]);

	  					//---- TAXES ----

	  					//Inserer DDE
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 2, $_POST['id_deb_2_'.$i], '0', '0');

	  					//Inserer TAX GOV 50$
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 7, ($poids*50), '0', '1');

	  					//Inserer FERE 3$
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 5, ($poids*3), '0', '1');

	  					//Inserer LMC 5$
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 6, ($poids*5), '0', '1');

	  					//Inserer OCC 250$
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 9, 250, '0', '1');

	  					//Inserer CGEA 3$
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 10, 80, '0', '1');
	  					
	  					if ($poids<30) {
	  						//Inserer CEEC < 30T
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 11, 125, '0', '1');
	  					}else if ($poids>=30) {
	  						//Inserer CEEC >= 30T
	  						$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 12, 250, '0', '1');
	  					}

	  					//Inserer DGDA Seal
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 13, 40, '0', '1');

	  					//---- FIN TAXES ----

	  					//---- COUT OPERAIONNELS ----

	  					//Inserer ASSAY FEE / FRAIS LABO
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 15, 125, '1', '1');

	  					//Inserer OCC FEES / FRAIS OCC
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 18, 20, '1', '1');
	  					//Inserer COMMERCE EXTERIOR / COMMERCE EXTERIEUR
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 17, 25, '1', '1');
	  					//Inserer KASUMBALEA BORDER CHARGES / FORMALITES FRONTIERE KASUMBALESA
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 22, 50, '1', '1');
	  					//Inserer OPERATIONS COST : OCC FEES / COUT OPERATIONNEL FRAIS OCC
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 23, 35, '1', '1');
	  					//Inserer OPERATIONS COST : MINE DIVISION /COUT OPERATIONNEL DIVISION DES MINES
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 24, 45, '1', '1');
	  					//Inserer OPERATIONS COST : MINE POLICE / COUT OPERATIONNEL POLICE DES MINES
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 25, 20, '1', '1');
	  					//Inserer OPERATIONS COST : ANR / COUT OPERATIONNEL ANR
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 26, 20, '1', '1');
	  					//Inserer OPERATIONS COST : DGDA / COUT OPERATIONNEL DGDA
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 27, 75, '1', '1');
	  					//Inserer OPERATIONS COST : PRINTING AND STATIONERY / FRAIS ADMINISTRATIFS
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 28, 10, '1', '1');
	  					//Inserer OPERATIONS COST : BANK CHARGES / FRAIS BANCAIRE
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 29, 10, '1', '1');
	  					//Inserer OPERATIONS COST : KISANGA TOLL GATES / COUT OPERATIONNEL PEAGE
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 30, 5, '1', '1');
	  					//Inserer TRANSFER FEE / FRAIS DE TRANSFERT
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 31, 35, '1', '1');

	  					//---- FIN COUT OPERAIONNELS ----

	  					//---- SERVICE FEES ----

	  					//Inserer CONTRACTOR AGENCY FEE / FRAIS D`AGENCE
	  					$maClasse-> creerDetailFactureDossier($_POST['ref_fact'], $_POST['id_dos_'.$i], 21, 120, '1', '1');

	  					//---- FIN SERVICE FEES ----


  					}

	  			}
	  				
	  			

	  			$response = array('message' => 'Invoice Created');
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

	}

?>