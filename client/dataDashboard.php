<?php
	session_start();
	include('../classes/connexion.php');

	//$id_cli = $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2');
	$id_cli = $_GET['id_cli'];
	$id_mod_trans = $_GET['id_mod_trans'];
	$id_mod_lic = $_GET['id_mod_lic'];

	if ($_GET['statut']=='AT GOVERNORS OFFICE') {

		$_GET['statut'] = 'AT GOVERNOR\'S OFFICE';

	}else if ($_GET['statut']=='GOVERNORS OFFICE OUT') {

		$_GET['statut'] = 'GOVERNOR\'S OFFICE OUT';
		
	}

	$statut = str_replace('_', '/', $_GET['statut']);
	$statut = str_replace('\'', '', $_GET['statut']);
	$compteur = 0;

	if($id_mod_lic=='2' && $id_mod_trans=='1'){
		if ($statut == 'AWAITING CRF/AD/INSURANCE') {

			$sqlStatus = " AND (d.date_crf IS NULL
								OR d.date_ad IS NULL
								OR d.date_assurance IS NULL)
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'UNDER PREPARATION') {

			$sqlStatus = " AND d.date_crf IS NOT NULL
											AND d.date_ad IS NOT NULL
											AND d.date_assurance IS NOT NULL
											AND d.date_decl IS NULL 
											AND d.ref_decl IS NULL
											AND d.ref_dos NOT LIKE '%20-%'
											AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING LIQUIDATION') {

			$sqlStatus = " AND d.date_decl IS NOT NULL 
											AND d.ref_decl IS NOT NULL
											AND d.date_liq IS NULL 
											AND d.ref_liq IS NULL
											AND d.ref_dos NOT LIKE '%20-%'
											AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING QUITTANCE') {

			$sqlStatus = " AND d.date_liq IS NOT NULL 
											AND d.ref_liq IS NOT NULL
											AND d.date_quit IS NULL 
											AND d.ref_quit IS NULL
											AND d.ref_dos NOT LIKE '%20-%'
											AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING BAE/BS') {

			$sqlStatus = " AND d.date_quit IS NOT NULL 
											AND d.ref_quit IS NOT NULL
											AND dgda_out IS NULL
											AND d.cleared <> '2'";

		}else if ($statut == 'CLEARING COMPLETED') {

			$sqlStatus = " AND d.dgda_out IS NOT NULL 
											AND d.dispatch_deliv IS NOT NULL
											AND d.cleared <> '2'";

		}
	}else{
		$sqlStatus = ' AND REPLACE(d.statut,"\'","") = "'.$statut.'"';
	}
	$requete = $connexion-> query("SELECT d.ref_dos AS ref_dos,
										d.ref_fact AS ref_fact,
										d.fob AS fob_dos,
										d.fret AS fret,
										d.assurance AS assurance,
										d.autre_frais AS autre_frais,
										d.num_lic AS num_lic,
										d.montant_decl AS montant_decl,
										d.*,
										d.supplier AS fournisseur,
										d.dgda_in AS dgda_in_1,
										d.dgda_out AS dgda_out_1,
										d.custom_deliv AS custom_deliv_1,
										d.arrival_date AS arrival_date_1,
										IF(d.id_mod_lic='2', d.commodity, m.nom_march) AS commodity,
										DATEDIFF(CURRENT_DATE(), d.date_preal) AS delai_prealerte,
										DATEDIFF(DATE(CURRENT_DATE()), d.date_decl) AS delai_decl,
										DATEDIFF(DATE(CURRENT_DATE()), d.date_liq) AS delai_liq,
										DATEDIFF(DATE(CURRENT_DATE()), d.date_quit) AS delai_quit,
										DATEDIFF(DATE(CURRENT_DATE()), d.warehouse_arriv) AS delai_warehouse,
										DATEDIFF(DATE(CURRENT_DATE()), d.load_date) AS delai_load,
										DATEDIFF(DATE(CURRENT_DATE()), d.ceec_in) AS ceec_in_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.ceec_out) AS ceec_out_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.min_div_in) AS min_div_in_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.min_div_out) AS min_div_out_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.dgda_out) AS dgda_out_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.gov_in) AS gov_in_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.gov_out) AS gov_out_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.dispatch_date) AS dispatch_date_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.klsa_arriv) AS klsa_arriv_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.end_form) AS end_form_delai,
										DATEDIFF(DATE(CURRENT_DATE()), d.exit_drc) AS exit_drc_delai,

										
										IF(d.id_mod_lic='2' AND d.id_mod_trans='1',
											IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
										      'AWAITING CRF/AD/INSURANCE',
										      IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
										        'AWAITING CRF/AD',
										          IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
										            'AWAITING CRF/INSURANCE',
										            IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NOT NULL,
										              'AWAITING CRF', 
										              IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
										                'AWAITING AD/INSURANCE',
										                IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
										                  'AWAITING AD',
										                    IF(d.date_crf IS NOT NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
										                      'AWAITING INSURANCE',

										                      IF(d.date_decl IS NULL AND d.ref_decl IS NULL, 'UNDER PREPARATION',
										                        IF(d.date_liq IS NULL AND d.ref_liq IS NULL, 'AWAITING LIQUIDATION',
										                          IF(d.date_quit IS NULL AND d.ref_quit IS NULL, 'AWAITING QUITTANCE',
										                            IF(d.date_quit IS NOT NULL AND d.ref_quit IS NOT NULL AND d.dgda_out IS NULL, 'AWAITING BAE/BS', 
										                              IF(d.dgda_out IS NOT NULL AND d.dispatch_deliv IS NOT NULL, 'CLEARING COMPLETED', '')
										                              )
										                            )
										                          )
										                        )
										                      
										                      )
										                  )
										                )
										              )
										            )
										          )
										      )
											,
											d.statut) AS statut,

										DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
										DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
									FROM dossier d
										LEFT JOIN marchandise m
											ON d.id_march = m.id_march
									WHERE d.id_cli =  $id_cli
										AND d.id_mod_trans = $id_mod_trans
										AND d.id_mod_lic = $id_mod_lic
										$sqlStatus
									");
	$rows = array();

	while ($reponse = $requete-> fetch()) {
		$compteur++;
		$rows[] = $reponse;
		// array_push($rows, "apple", "raspberry")
	}$requete-> closeCursor();

	echo json_encode($rows);
?>