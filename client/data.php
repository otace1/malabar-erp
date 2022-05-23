<?php
	session_start();
	include('../classes/connexion.php');

	//$id_cli = $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2');
	$id_cli = $_GET['id_cli'];
	$id_mod_trans = $_GET['id_mod_trans'];
	$id_mod_lic = $_GET['id_mod_lic'];
	$compteur = 0;

	$requete = $connexion-> query("SELECT *,
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
										IF(d.id_mod_lic='1',
											m.nom_march,
											d.commodity) AS commodity
										FROM dossier d
										LEFT JOIN marchandise m
											ON d.id_march = m.id_march
										WHERE d.id_cli = $id_cli 
											AND d.id_mod_trans = $id_mod_trans 
											AND d.id_mod_lic = $id_mod_lic
											AND YEAR(d.date_creat_dos) = YEAR(CURRENT_DATE())
										ORDER BY id_dos DESC");
	$rows = array();

	while ($reponse = $requete-> fetch()) {
		$compteur++;
		$rows[] = $reponse;
		// array_push($rows, "apple", "raspberry")
	}$requete-> closeCursor();

	echo json_encode($rows);
?>