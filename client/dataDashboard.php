<?php
	session_start();
	include('../classes/connexion.php');

	//$id_cli = $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2');
	$id_cli = $_GET['id_cli'];
	$id_mod_trans = $_GET['id_mod_trans'];
	$id_mod_lic = $_GET['id_mod_lic'];
	$statut = str_replace('_', '/', $_GET['statut']);
	$compteur = 0;

	if($id_mod_lic=='2'){
		if ($statut == 'AWAITING CRF/AD/INSURANCE') {

			$sqlStatus = " AND d.date_crf IS NULL
							AND d.date_ad IS NULL
							AND d.date_assurance IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING CRF/AD') {

			$sqlStatus = " AND d.date_crf IS NULL
							AND d.date_ad IS NULL
							AND d.date_assurance IS NOT NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING CRF/INSURANCE') {

			$sqlStatus = " AND d.date_crf IS NULL
							AND d.date_ad IS NOT NULL
							AND d.date_assurance IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING CRF') {

			$sqlStatus = " AND d.date_crf IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING AD/INSURANCE') {

			$sqlStatus = " AND d.date_crf IS NOT NULL
							AND d.date_ad IS NULL
							AND d.date_assurance IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}else if ($statut == 'AWAITING AD') {

			$sqlStatus = " AND d.date_ad IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}/*else if ($statut == 'AWAITING INSURANCE') {

			$sqlStatus = " AND d.date_crf IS NOT NULL
							AND d.date_ad IS NOT NULL
							AND d.date_assurance IS NULL
							AND d.ref_dos NOT LIKE '%20-%'
							AND d.cleared <> '2'";

		}*/else if ($statut == 'AWAITING INSURANCE') {

			$sqlStatus = " AND d.date_assurance IS NULL
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
										UPPER(cl.nom_cli) AS nom_cli,
										d.ref_fact AS ref_fact,
										d.fob AS fob_dos,
										d.fret AS fret,
										d.assurance AS assurance,
										d.autre_frais AS autre_frais,
										d.num_lic AS num_lic,
										d.montant_decl AS montant_decl,
										d.*,
										d.supplier AS fournisseur,
										s.nom_site AS nom_site,
										d.dgda_in AS dgda_in_1,
										d.dgda_out AS dgda_out_1,
										d.custom_deliv AS custom_deliv_1,
										d.arrival_date AS arrival_date_1,

										
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
									FROM dossier d, client cl, site s, mode_transport mt
									WHERE d.id_cli =  cl.id_cli
										AND cl.id_cli = $id_cli
										AND d.id_site = s.id_site
										AND d.id_mod_trans = mt.id_mod_trans
										AND mt.id_mod_trans = $id_mod_trans
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