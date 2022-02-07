<?php
	class maClasse{

		//Methodes permettant de créer
		public function creerLicenceIB($id_banq, $num_lic, $id_cli, $id_post, 
										$id_mon, $fob, $assurance, $fret, 
										$autre_frais, $fsi, $aur, 
										$id_mod_trans, $ref_fact, $date_fact, $fournisseur, 
										$date_val, $date_exp, $id_march, $id_mod_lic, 
										$id_util, $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
										$id_type_lic, $id_mod_paie, $id_sous_type_paie,
										$provenance, $commodity){
			include('connexion.php');
			$entree['id_banq'] = $id_banq;$entree['num_lic'] = $num_lic;
			$entree['id_cli'] = $id_cli;$entree['id_post'] = $id_post;
			$entree['id_mon'] = $id_mon;$entree['fob'] = $fob;
			$entree['assurance'] = $assurance;$entree['fret'] = $fret;$entree['autre_frais'] = $autre_frais;
			$entree['fsi'] = $fsi;$entree['aur'] = $aur;
			$entree['id_mod_trans'] = $id_mod_trans;$entree['ref_fact'] = $ref_fact;$entree['date_fact'] = $date_fact;
			$entree['fournisseur'] = $fournisseur;$entree['date_val'] = $date_val;$entree['date_exp'] = $date_exp;
			$entree['id_march'] = $id_march;$entree['id_mod_lic'] = $id_mod_lic;$entree['id_util'] = $id_util;
			$entree['fichier_lic'] = $fichier_lic;$entree['fichier_fact'] = $fichier_fact;
			$entree['id_type_lic'] = $id_type_lic;$entree['id_mod_paie'] = $id_mod_paie;
			$entree['id_sous_type_paie'] = $id_sous_type_paie; $entree['provenance'] = $provenance;
			$entree['commodity'] = $commodity;

			if ($entree['date_fact'] == '') {
				$entree['date_fact'] = NULL;
			}

			if ($entree['date_val'] == '') {
				$entree['date_val'] = NULL;
			}

			if ($entree['date_exp'] == '') {
				$entree['date_exp'] = NULL;
			}
			/*
			if ($entree[''] == '') {
				$entree[''] = NULL;
			}

			if ($entree[''] == '') {
				$entree[''] = NULL;
			}*/

			/*echo "<br> id_banq = $id_banq";echo "<br> num_lic = $num_lic";echo "<br> id_cli = $id_cli";
			echo "<br> id_post = $id_post";echo "<br> id_mon = $id_mon";echo "<br> fob = $fob";
			echo "<br> assurance = $assurance";echo "<br> fret = $fret";echo "<br> autre_frais = $autre_frais";
			echo "<br> fsi = $fsi";echo "<br> aur = $aur";echo "<br> id_mod_trans = $id_mod_trans";
			echo "<br> ref_fact = $ref_fact";echo "<br> date_fact = $date_fact";echo "<br> fournisseur = $fournisseur";
			echo "<br> date_val = $date_val";echo "<br> date_exp = $date_exp";echo "<br> id_march = $id_march";
			echo "<br> id_mod_lic = $id_mod_lic";echo "<br> id_util = $id_util";echo "<br> fichier_lic = $fichier_lic";
			echo "<br> fichier_fact = $fichier_fact";echo "<br> id_type_lic = $id_type_lic";echo "<br> id_mod_paie = $id_mod_paie";
			echo "<br> id_sous_type_paie = $id_sous_type_paie";echo "<br> provenance = $provenance";echo "<br> commodity = $commodity";
			echo "<br>--------------------------------";*/

			$requete = $connexion-> prepare('INSERT INTO licence(id_banq, num_lic, id_cli, 
																id_post, id_mon, fob, 
																assurance, fret, autre_frais, 
																fsi, aur, 
																id_mod_trans, ref_fact, date_fact, 
																fournisseur, date_val, id_march, 
																id_mod_lic, id_util, fichier_lic, fichier_fact,
																id_type_lic, id_mod_paie, id_sous_type_paie, provenance, commodity) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?,
													?, ?)');
			$requete-> execute(array($entree['id_banq'], $entree['num_lic'], $entree['id_cli'], 
									$entree['id_post'], $entree['id_mon'], $entree['fob'], 
									$entree['assurance'], $entree['fret'], $entree['autre_frais'], 
									$entree['fsi'], $entree['aur'], 
									$entree['id_mod_trans'], $entree['ref_fact'], $entree['date_fact'], 
									$entree['fournisseur'], $entree['date_val'], $entree['id_march'], 
									$entree['id_mod_lic'], $entree['id_util'], $entree['fichier_lic'], 
									$entree['fichier_fact'], $entree['id_type_lic'], $entree['id_mod_paie'], 
									$entree['id_sous_type_paie'], $entree['provenance'], $entree['commodity']));
			
			$this-> creerDateExpirationLicence($num_lic, $date_exp);

			$dossier = '../dossiers/'.$num_lic;

			if(!is_dir($dossier)){
				mkdir("../dossiers/$num_lic", 0777);
			}

			move_uploaded_file($tmp, '../dossiers/'.$num_lic.'/' . basename($fichier_lic));
			move_uploaded_file($tmp_fact, '../dossiers/'.$num_lic.'/' . basename($fichier_fact));
			//move_uploaded_file($tmp, '../dossiers/');
		}

		public function creerLicenceIB2($id_banq, $num_lic, $id_cli, $id_post, 
										$id_mon, $fob, $assurance, $fret, 
										$autre_frais, $fsi, $aur, 
										$id_mod_trans, $ref_fact, $date_fact, $fournisseur, 
										$date_val, $date_exp, $id_march, $id_mod_lic, 
										$id_util, $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
										$id_type_lic, $id_mod_paie, $id_sous_type_paie,
										$provenance, $commodity, $tonnage, $poids, $unit_mes){
			include('connexion.php');
			$entree['id_banq'] = $id_banq;$entree['num_lic'] = $num_lic;
			$entree['id_cli'] = $id_cli;$entree['id_post'] = $id_post;
			$entree['id_mon'] = $id_mon;$entree['fob'] = $fob;
			$entree['assurance'] = $assurance;$entree['fret'] = $fret;$entree['autre_frais'] = $autre_frais;
			$entree['fsi'] = $fsi;$entree['aur'] = $aur;
			$entree['id_mod_trans'] = $id_mod_trans;$entree['ref_fact'] = $ref_fact;$entree['date_fact'] = $date_fact;
			$entree['fournisseur'] = $fournisseur;$entree['date_val'] = $date_val;$entree['date_exp'] = $date_exp;
			$entree['id_march'] = $id_march;$entree['id_mod_lic'] = $id_mod_lic;$entree['id_util'] = $id_util;
			$entree['fichier_lic'] = $fichier_lic;$entree['fichier_fact'] = $fichier_fact;
			$entree['id_type_lic'] = $id_type_lic;$entree['id_mod_paie'] = $id_mod_paie;
			$entree['id_sous_type_paie'] = $id_sous_type_paie; $entree['provenance'] = $provenance;
			$entree['commodity'] = $commodity;
			$entree['tonnage'] = $tonnage; $entree['poids'] = $poids;
			$entree['unit_mes'] = $unit_mes;

			if ($entree['date_fact'] == '') {
				$entree['date_fact'] = NULL;
			}

			if ($entree['date_val'] == '') {
				$entree['date_val'] = NULL;
			}

			if ($entree['date_exp'] == '') {
				$entree['date_exp'] = NULL;
			}

			if ($entree['fob'] == '') {
				$entree['fob'] = NULL;
			}
			if ($entree['fret'] == '') {
				$entree['fret'] = NULL;
			}
			if ($entree['assurance'] == '') {
				$entree['assurance'] = NULL;
			}
			if ($entree['autre_frais'] == '') {
				$entree['autre_frais'] = NULL;
			}
			/*
			if ($entree[''] == '') {
				$entree[''] = NULL;
			}

			if ($entree[''] == '') {
				$entree[''] = NULL;
			}*/

			/*echo "<br> id_banq = $id_banq";echo "<br> num_lic = $num_lic";echo "<br> id_cli = $id_cli";
			echo "<br> id_post = $id_post";echo "<br> id_mon = $id_mon";echo "<br> fob = $fob";
			echo "<br> assurance = $assurance";echo "<br> fret = $fret";echo "<br> autre_frais = $autre_frais";
			echo "<br> fsi = $fsi";echo "<br> aur = $aur";echo "<br> id_mod_trans = $id_mod_trans";
			echo "<br> ref_fact = $ref_fact";echo "<br> date_fact = $date_fact";echo "<br> fournisseur = $fournisseur";
			echo "<br> date_val = $date_val";echo "<br> date_exp = $date_exp";echo "<br> id_march = $id_march";
			echo "<br> id_mod_lic = $id_mod_lic";echo "<br> id_util = $id_util";echo "<br> fichier_lic = $fichier_lic";
			echo "<br> fichier_fact = $fichier_fact";echo "<br> id_type_lic = $id_type_lic";echo "<br> id_mod_paie = $id_mod_paie";
			echo "<br> id_sous_type_paie = $id_sous_type_paie";echo "<br> provenance = $provenance";echo "<br> commodity = $commodity";
			echo "<br>--------------------------------";*/

			$requete = $connexion-> prepare('INSERT INTO licence(id_banq, num_lic, id_cli, 
																id_post, id_mon, fob, 
																assurance, fret, autre_frais, 
																fsi, aur, 
																id_mod_trans, ref_fact, date_fact, 
																fournisseur, date_val, id_march, 
																id_mod_lic, id_util, fichier_lic, fichier_fact,
																id_type_lic, id_mod_paie, id_sous_type_paie, provenance, commodity, tonnage, poids, unit_mes) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?,
													?, ?, ?,
													?, ?)');
			$requete-> execute(array($entree['id_banq'], $entree['num_lic'], $entree['id_cli'], 
									$entree['id_post'], $entree['id_mon'], $entree['fob'], 
									$entree['assurance'], $entree['fret'], $entree['autre_frais'], 
									$entree['fsi'], $entree['aur'], 
									$entree['id_mod_trans'], $entree['ref_fact'], $entree['date_fact'], 
									$entree['fournisseur'], $entree['date_val'], $entree['id_march'], 
									$entree['id_mod_lic'], $entree['id_util'], $entree['fichier_lic'], 
									$entree['fichier_fact'], $entree['id_type_lic'], $entree['id_mod_paie'], 
									$entree['id_sous_type_paie'], $entree['provenance'], $entree['commodity'], 
									$entree['tonnage'], $entree['poids'], $entree['unit_mes']));
			if ($date_exp != null) {
				$this-> creerDateExpirationLicence($num_lic, $date_exp);
			}
			
			if ($tmp != null) {
				$dossier = '../dossiers/'.$num_lic;

				if(!is_dir($dossier)){
					mkdir("../dossiers/$num_lic", 0777);
				}

				move_uploaded_file($tmp, '../dossiers/'.$num_lic.'/' . basename($fichier_lic));
				move_uploaded_file($tmp_fact, '../dossiers/'.$num_lic.'/' . basename($fichier_fact));
				}
				//move_uploaded_file($tmp, '../dossiers/');
		}

		public function creerLicenceIBUpload($client, $fournisseur, $commodity, $po, $facture, 
										$num_licence, $monnaie, $fob, $fret, 
										$assurance, $autre_frais, $fsi, $aur, 
										$validation, $id_util, $id_mod_lic, $extreme){
			include('connexion.php');
			$entree['client'] = $client;$entree['fournisseur'] = $fournisseur;
			$entree['po'] = $po;$entree['facture'] = $facture;
			$entree['num_licence'] = $num_licence;$entree['monnaie'] = $monnaie;
			$entree['fob'] = $fob;$entree['fret'] = $fret;$entree['assurance'] = $assurance;
			$entree['autre_frais'] = $autre_frais;$entree['aur'] = $aur;
			$entree['validation'] = $validation;$entree['id_util'] = $id_util;$entree['id_mod_lic'] = $id_mod_lic;
			$entree['extreme'] = $extreme;$entree['commodity'] = $commodity;$entree['fsi'] = $fsi;

			$requete = $connexion-> prepare('INSERT INTO licence_upload(client, fournisseur, po, 
																facture, num_licence, monnaie, 
																fob, fret, assurance, 
																autre_frais, fsi, aur, 
																validation, id_util, id_mod_lic,
																extreme, commodity) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['fournisseur'], $entree['po'], 
									$entree['facture'], $entree['num_licence'], $entree['monnaie'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['fsi'], $entree['aur'], 
									$entree['validation'], $entree['id_util'], $entree['id_mod_lic'], 
									$entree['extreme'], $entree['commodity']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}

		/*public function creerDossierIBUpload($client, $ref_dos, $num_lic, $cod, $fxi, $montant_av, 
										$date_fact, $ref_fact, $fob, $fret, 
										$assurance, $autre_frais, $ref_decl, $montant_decl, 
										$ref_liq, $id_util, $ref_quit, $date_quit, $id_mod_lic){
			include('connexion.php');
			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['num_lic'] = $num_lic;
			$entree['fxi'] = $fxi;$entree['montant_av'] = $montant_av;
			$entree['date_fact'] = $date_fact;$entree['ref_fact'] = $ref_fact;
			$entree['fob'] = $fob;$entree['fret'] = $fret;$entree['assurance'] = $assurance;
			$entree['autre_frais'] = $autre_frais;$entree['montant_decl'] = $montant_decl;
			$entree['ref_liq'] = $ref_liq;$entree['id_util'] = $id_util;$entree['ref_quit'] = $ref_quit;
			$entree['date_quit'] = $date_quit;$entree['cod'] = $cod;$entree['ref_decl'] = $ref_decl;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare('INSERT INTO dossier_upload(client, ref_dos, num_lic, fxi, 
																montant_av, date_fact, ref_fact, 
																fob, fret, assurance, 
																autre_frais, ref_decl, montant_decl, 
																ref_liq, id_util, ref_quit,
																date_quit, cod, id_mod_lic) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['num_lic'], $entree['fxi'], 
									$entree['montant_av'], $entree['date_fact'], $entree['ref_fact'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['ref_decl'], $entree['montant_decl'], 
									$entree['ref_liq'], $entree['id_util'], $entree['ref_quit'], 
									$entree['date_quit'], $entree['cod'], $entree['id_mod_lic']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}*/

		public function creerDossierIBUpload($client, $ref_dos, $num_lic, $cod, $fxi, $montant_av, 
										$date_fact, $ref_fact, $fob, $fret, 
										$assurance, $autre_frais, $ref_decl, $montant_decl, 
										$ref_liq, $id_util, $ref_quit, $date_quit, $id_mod_lic){
			include('connexion.php');
			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['num_lic'] = $num_lic;
			$entree['fxi'] = $fxi;$entree['montant_av'] = $montant_av;
			$entree['date_fact'] = $date_fact;$entree['ref_fact'] = $ref_fact;
			$entree['fob'] = $fob;$entree['fret'] = $fret;$entree['assurance'] = $assurance;
			$entree['autre_frais'] = $autre_frais;$entree['montant_decl'] = $montant_decl;
			$entree['ref_liq'] = $ref_liq;$entree['id_util'] = $id_util;$entree['ref_quit'] = $ref_quit;
			$entree['date_quit'] = $date_quit;$entree['cod'] = $cod;$entree['ref_decl'] = $ref_decl;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare('INSERT INTO dossier_upload(client, ref_dos, num_lic, fxi, 
																montant_av, date_fact, ref_fact, 
																fob, fret, assurance, 
																autre_frais, ref_decl, montant_decl, 
																ref_liq, id_util, ref_quit,
																date_quit, cod, id_mod_lic) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['num_lic'], $entree['fxi'], 
									$entree['montant_av'], $entree['date_fact'], $entree['ref_fact'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['ref_decl'], $entree['montant_decl'], 
									$entree['ref_liq'], $entree['id_util'], $entree['ref_quit'], 
									$entree['date_quit'], $entree['cod'], $entree['id_mod_lic']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}

		public function creerDossierIBUploadTrackingKlsa($client, $ref_dos, $num_lic, $t1, $poids, $ref_fact, 
										$horse, $trailer_1, $trailer_2, $transporteur, 
										$destination, $arrival_date, $crossing_date, $wiski_arriv, 
										$wiski_dep, $remarque, $id_util, $id_mod_lic, $id_mod_trans){
			include('connexion.php');
			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['num_lic'] = $num_lic;
			$entree['poids'] = $poids;$entree['ref_fact'] = $ref_fact;
			$entree['horse'] = $horse;$entree['trailer_1'] = $trailer_1;
			$entree['trailer_2'] = $trailer_2;$entree['transporteur'] = $transporteur;$entree['destination'] = $destination;
			$entree['arrival_date'] = $arrival_date;$entree['wiski_arriv'] = $wiski_arriv;
			$entree['wiski_dep'] = $wiski_dep;$entree['remarque'] = $remarque;
			$entree['id_util'] = $id_util;$entree['t1'] = $t1;$entree['crossing_date'] = $crossing_date;
			$entree['id_mod_lic'] = $id_mod_lic;$entree['id_mod_trans'] = $id_mod_trans;
			/*echo $client.' = client<br>';echo $ref_dos.' = ref_dos<br>';echo $num_lic.' = num_lic<br>';
			echo $poids.' = poids<br>';echo $ref_fact.' = ref_fact<br>';echo $horse.' = horse<br>';
			echo $trailer_1.' = trailer_1<br>';echo $trailer_2.' = trailer_2<br>';echo $transporteur.' = transporteur<br>';
			echo $destination.' = destination<br>';echo $arrival_date.' = arrival_date<br>';echo $crossing_date.' = crossing_date<br>';
			echo $wiski_arriv.' = wiski_arriv<br>';echo $wiski_dep.' = wiski_dep<br>';echo $remarque.' = remarque<br>';
			echo $id_util.' = id_util<br>';echo $t1.' = t1<br>';echo $id_mod_lic.' = id_mod_lic<br>';
			echo $id_mod_trans.' = id_mod_trans<br><br>------------';*/
			$requete = $connexion-> prepare('INSERT INTO dossier_upload_tracking(client, ref_dos, num_lic, poids, 
																ref_fact, horse, trailer_1, 
																trailer_2, transporteur, destination, 
																arrival_date, crossing_date, wiski_arriv, 
																wiski_dep, remarque,
																id_util, t1, id_mod_lic, id_mod_trans) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['num_lic'], $entree['poids'], 
									$entree['ref_fact'], $entree['horse'], $entree['trailer_1'], 
									$entree['trailer_2'], $entree['transporteur'], $entree['destination'], 
									$entree['arrival_date'], $entree['crossing_date'], $entree['wiski_arriv'], 
									$entree['wiski_dep'], $entree['remarque'], 
									$entree['id_util'], $entree['t1'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}

		public function creerDossierIBUpload2($client, $ref_dos, $mca_b_ref, $road_manif, $date_preal, $t1, 
										$poids, $ref_fact, $fob, $fret, 
										$assurance, $autre_frais, $fournisseur, $po, 
										$commodity, $horse, $trailer_1, $trailer_2, $num_lic, $num_exo,
										$arrival_date, $crossing_date, $wiski_arriv, $wiski_dep, $amicongo_arriv,
										$insp_report, $ir, $ref_crf, $date_crf, $ref_decl, $dgda_in, $ref_liq, 
										$date_liq, $ref_quit, $date_quit, $dgda_out, $custom_deliv, $dispatch_deliv,
										$remarque, $statut, $id_mod_trac, $id_util, $regul_ir){
			include('connexion.php');
			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['mca_b_ref'] = $mca_b_ref;
			$entree['date_preal'] = $date_preal;$entree['t1'] = $t1;
			$entree['poids'] = $poids;$entree['ref_fact'] = $ref_fact;
			$entree['fob'] = $fob;$entree['fret'] = $fret;$entree['assurance'] = $assurance;
			$entree['autre_frais'] = $autre_frais;$entree['po'] = $po;
			$entree['commodity'] = $commodity;$entree['horse'] = $horse;$entree['trailer_1'] = $trailer_1;
			$entree['trailer_2'] = $trailer_2;$entree['road_manif'] = $road_manif;$entree['fournisseur'] = $fournisseur;
			$entree['num_lic'] = $num_lic;$entree['num_exo'] = $num_exo;$entree['arrival_date'] = $arrival_date;
			$entree['crossing_date'] = $crossing_date;$entree['wiski_arriv'] = $wiski_arriv;$entree['wiski_dep'] = $wiski_dep;
			$entree['amicongo_arriv'] = $amicongo_arriv;$entree['insp_report'] = $insp_report;$entree['ir'] = $ir;
			$entree['ref_crf'] = $ref_crf;$entree['date_crf'] = $date_crf;$entree['ref_decl'] = $ref_decl;
			$entree['dgda_in'] = $dgda_in;$entree['ref_liq'] = $ref_liq;$entree['date_liq'] = $date_liq;
			$entree['ref_quit'] = $ref_quit;$entree['date_quit'] = $date_quit;$entree['dgda_out'] = $dgda_out;
			$entree['custom_deliv'] = $custom_deliv;$entree['dispatch_deliv'] = $dispatch_deliv;$entree['remarque'] = $remarque;
			$entree['statut'] = $statut;$entree['id_mod_trac'] = $id_mod_trac;$entree['id_util'] = $id_util;
			$entree['regul_ir'] = $regul_ir;
			/*echo $client.' - '.$ref_dos.' - '.$mca_b_ref.' - '.$road_manif.' - '.$date_preal.' - '.$t1.' - '.$poids.' - '.$fob.' - '.$fret.' - '.$assurance.' - '.$autre_frais.' - '.$ref_fact.' - '.$fournisseur.' - '.$po.' - '.$commodity.' - '.$horse.' - '.$trailer_1.' - '.$trailer_2.' - '.$num_lic.' - '.$num_exo.' - '.$crossing_date.' - '.$arrival_date.' - '.$wiski_arriv.' - '.$wiski_dep.' - '.$amicongo_arriv.' - '.$insp_report.' - '.$ir.' - '.$ref_crf.' - '.$date_crf.' - '.$ref_decl.' - '.$dgda_in.' - '.$ref_liq.' - '.$date_liq.' - '.$ref_quit.' - '.$date_quit.' - '.$dgda_out.' - '.$custom_deliv.' - '.$dispatch_deliv.' - '.$statut.' - '.$remarque.'<br><br><br>';*/
			$requete = $connexion-> prepare('INSERT INTO dossier_upload_tracking(client, ref_dos, mca_b_ref, date_preal, 
																t1, poids, ref_fact, 
																fob, fret, assurance, 
																autre_frais, fournisseur, po, 
																commodity, horse, trailer_1,
																trailer_2, road_manif, num_lic, 
																num_exo, arrival_date, crossing_date, wiski_arriv, wiski_dep, amicongo_arriv, insp_report, ir, ref_crf, date_crf, ref_decl, dgda_in, ref_liq, date_liq, ref_quit, date_quit, dgda_out, custom_deliv, dispatch_deliv, remarque, statut,
																id_mod_lic, id_util, regul_ir) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['mca_b_ref'], $entree['date_preal'], 
									$entree['t1'], $entree['poids'], $entree['ref_fact'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['fournisseur'], $entree['po'], 
									$entree['commodity'], $entree['horse'], $entree['trailer_1'], 
									$entree['trailer_2'], $entree['road_manif'], $entree['num_lic'], 
									$entree['num_exo'], $entree['arrival_date'], $entree['crossing_date'], 
									$entree['wiski_arriv'], $entree['wiski_dep'], $entree['amicongo_arriv'], 
									$entree['insp_report'], $entree['ir'], $entree['ref_crf'], 
									$entree['date_crf'], $entree['ref_decl'], $entree['dgda_in'], 
									$entree['ref_liq'], $entree['date_liq'], $entree['dgda_out'], 
									$entree['ref_quit'], $entree['date_quit'], $entree['custom_deliv'], 
									$entree['dispatch_deliv'], $entree['remarque'], $entree['statut'], 
									$entree['id_mod_trac'], $entree['id_util'], $entree['regul_ir']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}

		public function creerDossierTrackingIBUpload($client, $ref_dos, $mca_b_ref, $road_manif, $date_preal, $t1, 
										$poids, $fob, $fret, $assurance, 
										$autre_frais, $ref_fact, $fournisseur, $po, 
										$commodity, $horse, $trailer_1, $trailer_2, $id_mod_lic){
			include('connexion.php');
			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['mca_b_ref'] = $mca_b_ref;
			$entree['date_preal'] = $date_preal;$entree['t1'] = $t1;
			$entree['poids'] = $poids;$entree['fob'] = $fob;
			$entree['fret'] = $fret;$entree['assurance'] = $assurance;$entree['autre_frais'] = $autre_frais;
			$entree['ref_fact'] = $ref_fact;$entree['po'] = $po;
			$entree['commodity'] = $commodity;$entree['horse'] = $horse;$entree['trailer_1'] = $trailer_1;
			$entree['trailer_2'] = $trailer_2;$entree['road_manif'] = $road_manif;$entree['fournisseur'] = $fournisseur;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare('INSERT INTO dossier_upload(client, ref_dos, mca_b_ref, date_preal, 
																t1, poids, fob, 
																fret, assurance, autre_frais, 
																ref_fact, fournisseur, po, 
																commodity, horse, trailer_1,
																trailer_2, road_manif, id_mod_lic) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['mca_b_ref'], $entree['date_preal'], 
									$entree['t1'], $entree['poids'], $entree['fob'], 
									$entree['fret'], $entree['assurance'], $entree['autre_frais'], 
									$entree['ref_fact'], $entree['fournisseur'], $entree['po'], 
									$entree['commodity'], $entree['horse'], $entree['trailer_1'], 
									$entree['trailer_2'], $entree['road_manif'], $entree['id_mod_lic']));
			
			//$this-> creerDateExpirationLicence($num_lic, $date_exp);
		}

		public function creerLicenceIBFromUploade($id_util, $id_mod_lic){
			include('connexion.php');

			$entree['id_util'] = $id_util;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT * 
												FROM licence_upload
												WHERE id_util = ?
													AND id_mod_lic = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if ( $this-> getLicence($reponse['num_licence']) == null ){

                	$this-> creerLicenceIB(7, $reponse['num_licence'], $reponse['client'], 
                                          25, $reponse['monnaie'], $reponse['fob'], 
                                          $reponse['assurance'], $reponse['fret'], $reponse['autre_frais'], 
                                          $reponse['fsi'], $reponse['aur'], 
                                          25, $reponse['facture'], NULL, 
                                          $reponse['fournisseur'], $reponse['validation'], $reponse['extreme'], 
                                          NULL, $id_mod_lic, $id_util, 
                                          NULL, NULL, NULL, NULL, 
                                          1, NULL, NULL,
                                          NULL, $reponse['commodity']);

                }
			}$requete-> closeCursor();

			$requete = $connexion-> prepare("UPDATE licence_upload
												SET etat = 1
												WHERE id_util = ?
													AND id_mod_lic = ?");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
		}
		
		public function creerDossierIBFromUploade($id_util, $id_mod_lic){
			include('connexion.php');

			$entree['id_util'] = $id_util;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT * 
												FROM dossier_upload
												WHERE id_util = ?
													AND id_mod_lic = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				//echo '<br>'.$reponse['ref_dos'];

				$this-> creerDossierIB2($reponse['ref_dos'], $reponse['client'], $reponse['ref_fact'], 
                                          $reponse['fob'], $reponse['fret'], $reponse['assurance'], 
                                          $reponse['autre_frais'], $reponse['num_lic'], $_GET['id_mod_trac'], 
                                          NULL, 1,
                                          NULL, $reponse['cod'], $reponse['fxi'], 
                                          $reponse['montant_av'], $reponse['date_fact'], 
                                          $reponse['ref_decl'], $reponse['montant_decl'], 
                                          $reponse['ref_liq'], $_SESSION['id_util'], 
                                          $reponse['ref_quit'], $reponse['date_quit']);

			}$requete-> closeCursor();

			$requete = $connexion-> prepare("UPDATE dossier_upload
												SET etat = 1
												WHERE id_util = ?
													AND id_mod_lic = ?");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
		}
		
		public function creerDossierIBFromUploadeTrackingKlsa($id_util, $id_mod_lic){
			include('connexion.php');

			$entree['id_util'] = $id_util;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT * 
												FROM dossier_upload_tracking
												WHERE id_util = ?
													AND id_mod_lic = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				//echo '<br>'.$reponse['ref_dos'];
				$this-> creerDossierIBTrackingKlsa($reponse['ref_dos'], $reponse['client'], $reponse['t1'], 
                                          $reponse['poids'], $reponse['ref_fact'], $reponse['horse'], 
                                          $reponse['trailer_1'], $reponse['trailer_2'], $reponse['transporteur'], 
                                          $reponse['destination'], $reponse['id_mod_trans'], 
                                          $reponse['arrival_date'], $reponse['crossing_date'], 
                                          $reponse['wiski_arriv'], $reponse['wiski_dep'], 
                                          $reponse['remarque'], $_SESSION['id_util'], 
                                          $_GET['id_mod_trac'], $reponse['num_lic']);

			}$requete-> closeCursor();

			$requete = $connexion-> prepare("UPDATE dossier_upload_tracking
												SET etat = '1'
												WHERE id_util = ?
													AND id_mod_lic = ?");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
		}
		
		public function creerDossierIBFromUploade2($id_util, $id_mod_lic){
			include('connexion.php');

			$entree['id_util'] = $id_util;
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT * 
												FROM dossier_upload_tracking
												WHERE id_util = ?
													AND id_mod_lic = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				//echo '<br>'.$reponse['ref_dos'];

				if ($this-> verifierDossier($reponse['ref_dos']) == false) {
					//Créer des nouveaux dossiers
					$this-> creerDossierIB3($reponse['client'], $reponse['ref_dos'], $reponse['mca_b_ref'], $reponse['road_manif'], 
                                                $reponse['date_preal'], $reponse['t1'], $reponse['poids'], $reponse['ref_fact'], $reponse['fob'], $reponse['fret'], 
                                                $reponse['assurance'], $reponse['autre_frais'], $reponse['po'], 
                                                $reponse['commodity'], $reponse['horse'], $reponse['trailer_1'], $reponse['trailer_2'], $reponse['num_lic'], 
                                                $reponse['num_exo'], $reponse['arrival_date'], $reponse['crossing_date'], $reponse['wiski_arriv'], 
                                                $reponse['wiski_dep'], $reponse['amicongo_arriv'], $reponse['insp_report'], $reponse['ir'], 
                                                $reponse['ref_crf'], $reponse['date_crf'], $reponse['ref_decl'], $reponse['dgda_in'], $reponse['ref_liq'], 
                                                $reponse['date_liq'], $reponse['ref_quit'], $reponse['date_quit'], $reponse['dgda_out'], 
                                                $reponse['custom_deliv'], $reponse['dispatch_deliv'], $reponse['remarque'], $reponse['statut'], $reponse['regul_ir'], 
                                                $_GET['id_mod_trac'], $_SESSION['id_util'], 1);
				}else{

					//Mettre à jour les dossiers existants
					$id_dos = NULL;
					$id_dos = $this-> getIdDossierClientLicence($reponse['ref_dos'], $reponse['client'], $reponse['num_lic']);

					if (isset($reponse['mca_b_ref']) && ($reponse['mca_b_ref'] != '')) {
						$this-> MAJ_mca_b_ref($id_dos, $reponse['mca_b_ref']);				
					}

					if (isset($reponse['road_manif']) && ($reponse['road_manif'] != '')) {
						$this-> MAJ_road_manif($id_dos, $reponse['road_manif']);				
					}

					if (isset($reponse['date_preal']) && ($reponse['date_preal'] != '')) {
						$this-> MAJ_date_preal($id_dos, $reponse['date_preal']);				
					}

					if (isset($reponse['t1']) && ($reponse['t1'] != '')) {
						$this-> MAJ_t1($id_dos, $reponse['t1']);				
					}

					if (isset($reponse['poids']) && ($reponse['poids'] != '')) {
						$this-> MAJ_poids($id_dos, $reponse['poids']);				
					}

					if (isset($reponse['fob']) && ($reponse['fob'] != '')) {
						$this-> MAJ_fob($id_dos, $reponse['fob']);				
					}

					if (isset($reponse['fret']) && ($reponse['fret'] != '')) {
						$this-> MAJ_fret($id_dos, $reponse['fret']);				
					}

					if (isset($reponse['assurance']) && ($reponse['assurance'] != '')) {
						$this-> MAJ_assurance($id_dos, $reponse['assurance']);				
					}

					if (isset($reponse['autre_frais']) && ($reponse['autre_frais'] != '')) {
						$this-> MAJ_autre_frais($id_dos, $reponse['autre_frais']);				
					}

					if (isset($reponse['ref_fact']) && ($reponse['ref_fact'] != '')) {
						$this-> MAJ_ref_fact($id_dos, $reponse['ref_fact']);				
					}

					if (isset($reponse['fournisseur']) && ($reponse['fournisseur'] != '')) {
						$this-> MAJ_fournisseur($id_dos, $reponse['fournisseur']);				
					}

					if (isset($reponse['po']) && ($reponse['po'] != '')) {
						$this-> MAJ_po_ref($id_dos, $reponse['po']);				
					}

					if (isset($reponse['commodity']) && ($reponse['commodity'] != '')) {
						$this-> MAJ_commodity($id_dos, $reponse['commodity']);				
					}

					if (isset($reponse['horse']) && ($reponse['horse'] != '')) {
						$this-> MAJ_horse($id_dos, $reponse['horse']);				
					}

					if (isset($reponse['trailer_1']) && ($reponse['trailer_1'] != '')) {
						$this-> MAJ_trailer_1($id_dos, $reponse['trailer_1']);				
					}

					if (isset($reponse['trailer_2']) && ($reponse['trailer_2'] != '')) {
						$this-> MAJ_trailer_2($id_dos, $reponse['trailer_2']);				
					}

					if (isset($reponse['num_lic']) && ($reponse['num_lic'] != '')) {
						$this-> MAJ_num_lic($id_dos, $reponse['num_lic']);				
					}

					if (isset($reponse['num_exo']) && ($reponse['num_exo'] != '')) {
						$this-> MAJ_num_exo($id_dos, $reponse['num_exo']);				
					}

					if (isset($reponse['arrival_date']) && ($reponse['arrival_date'] != '')) {
						$this-> MAJ_arrival_date($id_dos, $reponse['arrival_date']);				
					}

					if (isset($reponse['crossing_date']) && ($reponse['crossing_date'] != '')) {
						$this-> MAJ_crossing_date($id_dos, $reponse['crossing_date']);				
					}

					if (isset($reponse['wiski_arriv']) && ($reponse['wiski_arriv'] != '')) {
						$this-> MAJ_wiski_arriv($id_dos, $reponse['wiski_arriv']);				
					}

					if (isset($reponse['wiski_dep']) && ($reponse['wiski_dep'] != '')) {
						$this-> MAJ_wiski_dep($id_dos, $reponse['wiski_dep']);				
					}

					if (isset($reponse['amicongo_arriv']) && ($reponse['amicongo_arriv'] != '')) {
						$this-> MAJ_amicongo_arriv($id_dos, $reponse['amicongo_arriv']);				
					}

					if (isset($reponse['insp_report']) && ($reponse['insp_report'] != '')) {
						$this-> MAJ_insp_report($id_dos, $reponse['insp_report']);				
					}

					if (isset($reponse['ir']) && ($reponse['ir'] != '')) {
						$this-> MAJ_ir($id_dos, $reponse['ir']);				
					}

					if (isset($reponse['ref_crf']) && ($reponse['ref_crf'] != '')) {
						$this-> MAJ_ref_crf($id_dos, $reponse['ref_crf']);				
					}

					if (isset($reponse['date_crf']) && ($reponse['date_crf'] != '')) {
						$this-> MAJ_date_crf($id_dos, $reponse['date_crf']);				
					}

					if (isset($reponse['ref_decl']) && ($reponse['ref_decl'] != '')) {
						$this-> MAJ_ref_decl($id_dos, $reponse['ref_decl']);				
					}

					if (isset($reponse['dgda_in']) && ($reponse['dgda_in'] != '')) {
						$this-> MAJ_dgda_in($id_dos, $reponse['dgda_in']);				
					}

					if (isset($reponse['ref_liq']) && ($reponse['ref_liq'] != '')) {
						$this-> MAJ_ref_liq($id_dos, $reponse['ref_liq']);				
					}

					if (isset($reponse['date_liq']) && ($reponse['date_liq'] != '')) {
						$this-> MAJ_date_liq($id_dos, $reponse['date_liq']);				
					}

					if (isset($reponse['ref_quit']) && ($reponse['ref_quit'] != '')) {
						$this-> MAJ_ref_quit($id_dos, $reponse['ref_quit']);				
					}

					if (isset($reponse['date_quit']) && ($reponse['date_quit'] != '')) {
						$this-> MAJ_date_quit($id_dos, $reponse['date_quit']);				
					}

					if (isset($reponse['dgda_out']) && ($reponse['dgda_out'] != '')) {
						$this-> MAJ_dgda_out($id_dos, $reponse['dgda_out']);				
					}

					if (isset($reponse['custom_deliv']) && ($reponse['custom_deliv'] != '')) {
						$this-> MAJ_custom_deliv($id_dos, $reponse['custom_deliv']);				
					}

					if (isset($reponse['dispatch_deliv']) && ($reponse['dispatch_deliv'] != '')) {
						$this-> MAJ_dispatch_deliv($id_dos, $reponse['dispatch_deliv']);				
					}

					if (isset($reponse['remarque']) && ($reponse['remarque'] != '')) {
						$this-> MAJ_remarque($id_dos, $reponse['remarque']);				
					}

					if (isset($reponse['statut']) && ($reponse['statut'] != '')) {
						$this-> MAJ_statut($id_dos, $reponse['statut']);				
					}

				}

			}$requete-> closeCursor();

			$requete = $connexion-> prepare("UPDATE dossier_upload_tracking
												SET etat = '1'
												WHERE id_util = ?
													AND id_mod_lic = ?");
			$requete-> execute(array($entree['id_util'], $entree['id_mod_lic']));
		}
		
		public function creerDateExpirationLicence($num_lic, $date_exp){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$entree['date_exp'] = $date_exp;

			$requete = $connexion-> prepare('INSERT INTO expiration_licence(num_lic, date_exp, id_etat)
												VALUES(?, ?, 1)');
			$requete-> execute(array($entree['num_lic'], $entree['date_exp']));
		}
		
		public function creerClient($nom_cli){
			include('connexion.php');

			$entree['nom_cli'] = $nom_cli;
			//$entree['date_exp'] = $date_exp;

			$requete = $connexion-> prepare('INSERT INTO client(nom_cli)
												VALUES(?)');
			$requete-> execute(array($entree['nom_cli']));
		}

		public function creerAffectationLicenceModeleLicence($id_cli, $id_mod_lic){

			include('connexion.php');

			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;

			$requete = $connexion-> prepare("INSERT INTO affectation_client_modele_licence(id_cli, id_mod_lic)
														VALUES(?, ?)");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic']));

		}

		public function creerMonnaie($sig_mon){
			include('connexion.php');

			$entree['sig_mon'] = $sig_mon;
			//$entree['date_exp'] = $date_exp;

			$requete = $connexion-> prepare('INSERT INTO monnaie(nom_mon, sig_mon)
												VALUES(?, ?)');
			$requete-> execute(array($entree['sig_mon'], $entree['sig_mon']));
		}
		
		public function creerDocumentAppurement($fichier_doc, $num_lic, $id_util, $tmp){
			include('connexion.php');

			$entree['fichier_doc'] = $fichier_doc;
			$entree['num_lic'] = $num_lic;
			$entree['id_util'] = $id_util;

			/*echo '<br>fichier_doc = '.$fichier_doc;
			echo '<br>num_lic = '.$num_lic;
			echo '<br>id_util = '.$id_util;*/

			$requete = $connexion-> prepare('INSERT INTO document_appurement(fichier_doc, num_lic, id_util)
												VALUES(?, ?, ?)');
			$requete-> execute(array($entree['fichier_doc'], $entree['num_lic'], $entree['id_util']));

			$dossier = '../dossiers/'.$num_lic;

			if(!is_dir($dossier)){
				mkdir("../dossiers/$num_lic", 0777);
			}

			move_uploaded_file($tmp, '../dossiers/'.$num_lic.'/' . basename($fichier_doc));
		}

		public function creerFacture($ref_fact, $date_fact, $date_fact_rec, 
										$fournisseur, $date_val, $fichier_fact, 
										$tmp_fact, $id_mod_lic, $id_cli, $commodity, 
										$montant_fact, $id_mon, $fret_fact, 
										$assurance_fact, $autre_frais_fact){
			include('connexion.php');

			$entree['ref_fact'] = $ref_fact;
			$entree['date_fact'] = $date_fact;
			$entree['date_fact_rec'] = $date_fact_rec;
			$entree['fournisseur'] = $fournisseur;
			$entree['date_val'] = $date_val;
			$entree['fichier_fact'] = $fichier_fact;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$entree['commodity'] = $commodity;
			$entree['montant_fact'] = $montant_fact;
			$entree['id_mon'] = $id_mon;
			$entree['fret_fact'] = $fret_fact;
			$entree['assurance_fact'] = $assurance_fact;
			$entree['autre_frais_fact'] = $autre_frais_fact;

			/*echo '<br>ref_fact = '.$ref_fact;
			echo '<br>date_fact = '.$date_fact;
			echo '<br>date_fact_rec = '.$date_fact_rec;
			echo '<br>fournisseur= '.$fournisseur;
			echo '<br>date_val = '.$date_val;
			echo '<br>fichier_fact = '.$fichier_fact;
			echo '<br>id_mod_lic = '.$id_mod_lic;
			echo '<br>id_cli = '.$id_cli;
			echo '<br>id_march = '.$id_march;*/

			$requete = $connexion-> prepare('INSERT INTO facture_licence(ref_fact, date_fact, date_fact_rec, 
																		fournisseur, date_val, fichier_fact, 
																		id_mod_lic, id_cli, commodity, 
																		montant_fact, id_mon, fret_fact, 
																		assurance_fact, autre_frais_fact)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['ref_fact'], $entree['date_fact'], $entree['date_fact_rec'], 
									$entree['fournisseur'], $entree['date_val'], $entree['fichier_fact'], 
									$entree['id_mod_lic'], $entree['id_cli'], $entree['commodity'], 
									$entree['montant_fact'], $entree['id_mon'], $entree['fret_fact'], 
									$entree['assurance_fact'], $entree['autre_frais_fact']));

			$facture = '../factures/'.$ref_fact;

			if(!is_dir($facture)){
				mkdir("../factures/$ref_fact", 0777);
			}

			move_uploaded_file($tmp_fact, '../factures/'.$ref_fact.'/' . basename($fichier_fact));
		}
		
		public function creerAV($cod, $date_av, $montant_av, 
								$fxi, $num_lic, $fichier_av, 
								$tmp_av, $id_util, $id_mon){
			include('connexion.php');

			$entree['cod'] = $cod;
			$entree['date_av'] = $date_av;
			$entree['montant_av'] = $montant_av;
			$entree['fxi'] = $fxi;
			$entree['num_lic'] = $num_lic;
			$entree['fichier_av'] = $fichier_av;
			$entree['id_util'] = $id_util;
			$entree['id_mon'] = $id_mon;

			/*echo '<br>cod = '.$cod;
			echo '<br>date_av = '.$date_av;
			echo '<br>montant_av = '.$montant_av;
			echo '<br>fxi= '.$fxi;
			echo '<br>num_lic = '.$num_lic;
			echo '<br>fichier_av = '.$fichier_av;
			echo '<br>id_util = '.$id_util;
			echo '<br>id_mon = '.$id_mon;
			echo '<br>id_march = '.$id_march;*/

			$requete = $connexion-> prepare('INSERT INTO av(cod, date_av, montant_av, 
															fxi, num_lic, fichier_av, 
															id_util, id_mon)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['cod'], $entree['date_av'], $entree['montant_av'], 
									$entree['fxi'], $entree['num_lic'], $entree['fichier_av'], 
									$entree['id_util'], $entree['id_mon']));

			/*$av = '../av/'.$fichier_av;

			if(!is_dir($av)){
				mkdir("../av/$fichier_av", 0777);
			}*/

			move_uploaded_file($tmp_av, '../av/' . basename($fichier_av));
		}
		
		public function creerAppurementLicence($id_dos, $id_doc, $id_util){
			include('connexion.php');

			$entree['id_dos'] = $id_dos;
			$entree['id_doc'] = $id_doc;
			$entree['id_util'] = $id_util;

			/*echo '<br>id_dos = '.$id_dos;
			echo '<br>id_doc = '.$id_doc;
			echo '<br>id_util = '.$id_util;
			echo '---------<br>';*/

			$requete = $connexion-> prepare('INSERT INTO appurement_licence(id_dos, id_doc, id_util)
												VALUES(?, ?, ?)');
			$requete-> execute(array($entree['id_dos'], $entree['id_doc'], $entree['id_util']));

		}
		
		public function creerDossierIB($ref_dos, $id_cli, $ref_fact, $fob, 
										$fret, $assurance, $autre_frais, $num_lic, 
										$id_mod_lic, $id_march, $id_mod_trans,
										$ref_av, $cod, $id_util, $road_manif, $date_preal, 
										$t1, $poids,$po_ref, 
										$commodity, $horse, $trailer_1, $trailer_2){
			include('connexion.php');

			/*echo '<br> ref_dos = '.$ref_dos;echo '<br> id_cli = '.$id_cli;
			echo '<br> ref_fact = '.$ref_fact;echo '<br> fob = '.$fob;
			echo '<br> fret = '.$fret;echo '<br> assurance = '.$assurance;
			echo '<br> autre_frais = '.$autre_frais;echo '<br> num_lic = '.$num_lic;
			echo '<br> id_mod_lic = '.$id_mod_lic;*/
			//echo '<br> id_mod_lic = '.$id_mod_lic;

			$entree['ref_dos'] = $ref_dos; $entree['id_cli'] = $id_cli; $entree['ref_fact'] = $ref_fact; 
			$entree['fob'] = $fob; $entree['fret'] = $fret; $entree['assurance'] = $assurance; 
			$entree['autre_frais'] = $autre_frais; $entree['num_lic'] = $num_lic;
			$entree['id_mod_lic'] = $id_mod_lic; $entree['id_march'] = $id_march; 
			$entree['id_mod_trans'] = $id_mod_trans;$entree['ref_av'] = $ref_av;
			$entree['cod'] = $cod;
			$entree['id_util'] = $id_util;
			$entree['road_manif'] = $road_manif;$entree['date_preal'] = $date_preal;
			$entree['t1'] = $t1;$entree['poids'] = $poids;
			$entree['fret'] = $fret;$entree['po_ref'] = $po_ref;
			$entree['commodity'] = $commodity;$entree['horse'] = $horse;
			$entree['trailer_1'] = $trailer_1;$entree['trailer_2'] = $trailer_2;

			if($entree['date_preal'] == '' || (!isset($entree['date_preal'])) ){
				$entree['date_preal'] = NULL;
			}

			if($entree['fob'] == '' || (!isset($entree['fob'])) ){
				$entree['fob'] = NULL;
			}

			if($entree['fret'] == '' || (!isset($entree['fret'])) ){
				$entree['fret'] = NULL;
			}

			if($entree['assurance'] == '' || (!isset($entree['assurance'])) ){
				$entree['assurance'] = NULL;
			}

			if($entree['autre_frais'] == '' || (!isset($entree['autre_frais'])) ){
				$entree['autre_frais'] = NULL;
			}

			if($entree['poids'] == '' || (!isset($entree['poids'])) ){
				$entree['poids'] = NULL;
			}

			$requete = $connexion-> prepare('INSERT INTO dossier(ref_dos, id_cli, ref_fact, fob, 
																fret, assurance, autre_frais, num_lic, 
																id_mod_lic, id_march, id_mod_trans, 
																ref_av,cod, id_util, road_manif, 
																date_preal, t1, poids, 
																po_ref, commodity, horse, 
																trailer_1, trailer_2)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
														?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['ref_dos'], $entree['id_cli'], $entree['ref_fact'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['num_lic'], $entree['id_mod_lic'], 
									$entree['id_march'], $entree['id_mod_trans'], 
									$entree['ref_av'], $entree['cod'], $entree['id_util'], 
									$entree['road_manif'], $entree['date_preal'], $entree['t1'], 
									$entree['poids'], $entree['po_ref'], $entree['commodity'], 
									$entree['horse'], $entree['trailer_1'], $entree['trailer_2']));
		}
			
		public function creerDossierIB2($ref_dos, $id_cli, $ref_fact, $fob, 
										$fret, $assurance, $autre_frais, $num_lic, 
										$id_mod_lic, $id_march, $id_mod_trans,
										$ref_av, $cod, $fxi, $montant_av, $date_fact, $ref_decl,
										$montant_decl, $ref_liq, $id_util, $ref_quit, $date_quit){
			include('connexion.php');

			/*echo '<br> ref_dos = '.$ref_dos;echo '<br> id_cli = '.$id_cli;
			echo '<br> ref_fact = '.$ref_fact;echo '<br> fob = '.$fob;
			echo '<br> fret = '.$fret;echo '<br> assurance = '.$assurance;
			echo '<br> autre_frais = '.$autre_frais;echo '<br> num_lic = '.$num_lic;
			echo '<br> id_mod_lic = '.$id_mod_lic;*/
			//echo '<br> id_mod_lic = '.$id_mod_lic;

			$entree['ref_dos'] = $ref_dos; $entree['id_cli'] = $id_cli; $entree['ref_fact'] = $ref_fact; 
			$entree['fob'] = $fob; $entree['fret'] = $fret; $entree['assurance'] = $assurance; 
			$entree['autre_frais'] = $autre_frais; $entree['num_lic'] = $num_lic;
			$entree['id_mod_lic'] = $id_mod_lic; $entree['id_march'] = $id_march; 
			$entree['id_mod_trans'] = $id_mod_trans;$entree['ref_av'] = $ref_av;
			$entree['cod'] = $cod;$entree['fxi'] = $fxi;
			$entree['montant_av'] = $montant_av;$entree['date_fact'] = $date_fact;
			$entree['ref_decl'] = $ref_decl;$entree['montant_decl'] = $montant_decl;
			$entree['ref_liq'] = $ref_liq;$entree['id_util'] = $id_util;
			$entree['ref_quit'] = $ref_quit;$entree['date_quit'] = $date_quit;

			if($entree['date_fact'] == '' || (strlen($entree['date_fact']) != 10) ){
				$entree['date_fact'] = NULL;
			}

			if($entree['date_quit'] == '' || (strlen($entree['date_quit']) != 10) ){
				$entree['date_quit'] = NULL;
			}

			$requete = $connexion-> prepare('INSERT INTO dossier(ref_dos, id_cli, ref_fact, fob, 
																fret, assurance, autre_frais, num_lic, 
																id_mod_lic, id_march, id_mod_trans, ref_av,cod, 
																fxi, montant_av, date_fact, ref_decl, montant_decl, ref_liq, id_util, ref_quit, date_quit)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
														?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['ref_dos'], $entree['id_cli'], $entree['ref_fact'], 
									$entree['fob'], $entree['fret'], $entree['assurance'], 
									$entree['autre_frais'], $entree['num_lic'], $entree['id_mod_lic'], 
									$entree['id_march'], $entree['id_mod_trans'], 
									$entree['ref_av'], $entree['cod'], $entree['fxi'], 
									$entree['montant_av'], $entree['date_fact'], $entree['ref_decl'], 
									$entree['montant_decl'], $entree['ref_liq'], $entree['id_util'], 
									$entree['ref_quit'], $entree['date_quit']));
		}

		public function creerDossierIBTrackingKlsa($ref_dos, $id_cli, $t1, $poids, 
										$ref_fact, $horse, $trailer_1, $trailer_2, 
										$transporteur, $destination, $id_mod_trans,
										$arrival_date, $crossing_date, $wiski_arriv, 
										$wiski_dep, $remarque, $id_util, $id_mod_lic, 
										$num_lic){
			include('connexion.php');

			/*echo '<br> ref_dos = '.$ref_dos;echo '<br> id_cli = '.$id_cli;
			echo '<br> t1 = '.$t1;echo '<br> poids = '.$poids;
			echo '<br> ref_fact = '.$ref_fact;echo '<br> horse = '.$horse;
			echo '<br> trailer_1 = '.$trailer_1;echo '<br> trailer_2 = '.$trailer_2;
			echo '<br> transporteur = '.$transporteur;echo '<br> destination = '.$destination;
			echo '<br> id_mod_trans = '.$id_mod_trans;echo '<br> arrival_date = '.$arrival_date;
			echo '<br> crossing_date = '.$crossing_date;echo '<br> wiski_arriv = '.$wiski_arriv;
			echo '<br> wiski_dep = '.$wiski_dep;echo '<br> remarque = '.$remarque;
			echo '<br> id_util = '.$id_util;echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br><br>------------';*/
			//echo '<br> transporteur = '.$transporteur;

			$entree['ref_dos'] = $ref_dos; $entree['id_cli'] = $id_cli; $entree['t1'] = $t1; 
			$entree['poids'] = $poids; $entree['ref_fact'] = $ref_fact; $entree['horse'] = $horse; 
			$entree['trailer_1'] = $trailer_1; $entree['trailer_2'] = $trailer_2;
			$entree['transporteur'] = $transporteur; $entree['destination'] = $destination; 
			$entree['id_mod_trans'] = $id_mod_trans;$entree['arrival_date'] = $arrival_date;
			$entree['crossing_date'] = $crossing_date;$entree['wiski_arriv'] = $wiski_arriv;
			$entree['wiski_dep'] = $wiski_dep;$entree['remarque'] = $remarque;
			$entree['id_util'] = $id_util; $entree['id_mod_lic'] = $id_mod_lic; 
			$entree['num_lic'] = $num_lic;

			if($entree['arrival_date'] == '' || (strlen($entree['arrival_date']) != 10) ){
				$entree['arrival_date'] = NULL;
			}

			if($entree['crossing_date'] == '' || (strlen($entree['crossing_date']) != 10) ){
				$entree['crossing_date'] = NULL;
			}

			if($entree['wiski_arriv'] == '' || (strlen($entree['wiski_arriv']) != 10) ){
				$entree['wiski_arriv'] = NULL;
			}

			if($entree['wiski_dep'] == '' || (strlen($entree['wiski_dep']) != 10) ){
				$entree['wiski_dep'] = NULL;
			}

			$requete = $connexion-> prepare('INSERT INTO dossier(ref_dos, id_cli, t1, poids, 
																ref_fact, horse, trailer_1, trailer_2, 
																transporteur, destination, id_mod_trans, arrival_date,crossing_date, 
																wiski_arriv, wiski_dep, remarque, id_util, 
																id_mod_lic, num_lic)
												VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
														?, ?, ?, ?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['ref_dos'], $entree['id_cli'], $entree['t1'], 
									$entree['poids'], $entree['ref_fact'], $entree['horse'], 
									$entree['trailer_1'], $entree['trailer_2'], $entree['transporteur'], 
									$entree['destination'], $entree['id_mod_trans'], 
									$entree['arrival_date'], $entree['crossing_date'], $entree['wiski_arriv'], 
									$entree['wiski_dep'], $entree['remarque'], $entree['id_util'], 
									$entree['id_mod_lic'], $entree['num_lic']));
		}

		public function creerDossierIB3($client, $ref_dos, $mca_b_ref, $road_manif, $date_preal, $t1, 
										$poids, $ref_fact, $fob, $fret, 
										$assurance, $autre_frais, $po_ref, 
										$commodity, $horse, $trailer_1, $trailer_2, $num_lic, $num_exo,
										$arrival_date, $crossing_date, $wiski_arriv, $wiski_dep, $amicongo_arriv,
										$insp_report, $ir, $ref_crf, $date_crf, $ref_decl, $dgda_in, $ref_liq, 
										$date_liq, $ref_quit, $date_quit, $dgda_out, $custom_deliv, $dispatch_deliv,
										$remarque, $statut, $regul_ir, $id_mod_trac, $id_util, $id_mod_trans){
			include('connexion.php');

			/*echo '<br> client = '.$client;echo '<br> ref_dos = '.$ref_dos;echo '<br> mca_b_ref = '.$mca_b_ref;echo '<br> road_manif = '.$road_manif;echo '<br> date_preal = '.$date_preal;echo '<br> t1 = '.$t1;echo '<br> poids = '.$poids;echo '<br> ref_fact = '.$ref_fact;echo '<br> fob = '.$fob;echo '<br> fret = '.$fret;echo '<br> assurance = '.$assurance;echo '<br> autre_frais = '.$autre_frais;echo '<br> po_ref = '.$po_ref;echo '<br> commodity = '.$commodity;echo '<br> horse = '.$horse;echo '<br> trailer_1 = '.$trailer_1;echo '<br> trailer_2 = '.$trailer_2;echo '<br> num_lic = '.$num_lic;echo '<br> num_exo = '.$num_exo;echo '<br> arrival_date = '.$arrival_date;echo '<br> crossing_date = '.$crossing_date;echo '<br> wiski_arriv = '.$wiski_arriv;echo '<br> wiski_dep = '.$wiski_dep;echo '<br> amicongo_arriv = '.$amicongo_arriv;echo '<br> insp_report = '.$insp_report;echo '<br> ir = '.$ir;echo '<br> ref_crf = '.$ref_crf;echo '<br> date_crf = '.$date_crf;echo '<br> ref_decl = '.$ref_decl;echo '<br> dgda_in = '.$dgda_in;echo '<br> ref_liq = '.$ref_liq;echo '<br> date_liq = '.$date_liq;echo '<br> ref_quit = '.$ref_quit;echo '<br> date_quit = '.$date_quit;echo '<br> dgda_out = '.$dgda_out;echo '<br> custom_deliv = '.$custom_deliv;echo '<br> dispatch_deliv = '.$dispatch_deliv;echo '<br> remarque = '.$remarque;echo '<br> statut = '.$statut;echo '<br> id_mod_trac = '.$id_mod_trac;echo '<br> id_util = '.$id_util;echo '<br> id_mod_trans = '.$id_mod_trans;echo '<br><br>------------------<br><br>';*/

			$entree['client'] = $client;$entree['ref_dos'] = $ref_dos;$entree['mca_b_ref'] = $mca_b_ref;
			$entree['date_preal'] = $date_preal;$entree['t1'] = $t1;
			$entree['poids'] = $poids;$entree['ref_fact'] = $ref_fact;
			$entree['fob'] = $fob;$entree['fret'] = $fret;$entree['assurance'] = $assurance;
			$entree['autre_frais'] = $autre_frais;$entree['po_ref'] = $po_ref;
			$entree['commodity'] = $commodity;$entree['horse'] = $horse;$entree['trailer_1'] = $trailer_1;
			$entree['trailer_2'] = $trailer_2;$entree['road_manif'] = $road_manif;
			$entree['num_lic'] = $num_lic;$entree['num_exo'] = $num_exo;$entree['arrival_date'] = $arrival_date;
			$entree['crossing_date'] = $crossing_date;$entree['wiski_arriv'] = $wiski_arriv;$entree['wiski_dep'] = $wiski_dep;
			$entree['amicongo_arriv'] = $amicongo_arriv;$entree['insp_report'] = $insp_report;$entree['ir'] = $ir;
			$entree['ref_crf'] = $ref_crf;$entree['date_crf'] = $date_crf;$entree['ref_decl'] = $ref_decl;
			$entree['dgda_in'] = $dgda_in;$entree['ref_liq'] = $ref_liq;$entree['date_liq'] = $date_liq;
			$entree['ref_quit'] = $ref_quit;$entree['date_quit'] = $date_quit;$entree['dgda_out'] = $dgda_out;
			$entree['custom_deliv'] = $custom_deliv;$entree['dispatch_deliv'] = $dispatch_deliv;$entree['remarque'] = $remarque;
			$entree['statut'] = $statut;$entree['id_mod_trac'] = $id_mod_trac;$entree['id_util'] = $id_util;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['regul_ir'] = $regul_ir;

			if($entree['date_quit'] == '' || (strlen($entree['date_quit']) != 10) ){
				$entree['date_quit'] = NULL;
			}

			if($entree['date_liq'] == '' || (strlen($entree['date_liq']) != 10) ){
				$entree['date_liq'] = NULL;
			}

			if($entree['poids'] == ''){
				$entree['poids'] = NULL;
			}

			if($entree['fob'] == ''){
				$entree['fob'] = NULL;
			}

			if($entree['fret'] == ''){
				$entree['fret'] = NULL;
			}

			if($entree['assurance'] == ''){
				$entree['assurance'] = NULL;
			}

			if($entree['autre_frais'] == '' ){
				$entree['autre_frais'] = NULL;
			}

			if($entree['ir'] == '' ){
				$entree['ir'] = 'NO';
			}

			if($entree['date_preal'] == '' || (strlen($entree['date_preal']) != 10) ){
				$entree['date_preal'] = NULL;
			}

			if($entree['arrival_date'] == '' || (strlen($entree['arrival_date']) != 10) ){
				$entree['arrival_date'] = NULL;
			}

			if($entree['crossing_date'] == '' || (strlen($entree['crossing_date']) != 10) ){
				$entree['crossing_date'] = NULL;
			}

			if($entree['wiski_arriv'] == '' || (strlen($entree['wiski_arriv']) != 10) ){
				$entree['wiski_arriv'] = NULL;
			}

			if($entree['wiski_dep'] == '' || (strlen($entree['wiski_dep']) != 10) ){
				$entree['wiski_dep'] = NULL;
			}

			if($entree['amicongo_arriv'] == '' || (strlen($entree['amicongo_arriv']) != 10) ){
				$entree['amicongo_arriv'] = NULL;
			}

			if($entree['insp_report'] == '' || (strlen($entree['insp_report']) != 10) ){
				$entree['insp_report'] = NULL;
			}

			if($entree['date_crf'] == '' || (strlen($entree['date_crf']) != 10) ){
				$entree['date_crf'] = NULL;
			}

			if($entree['dgda_in'] == '' || (strlen($entree['dgda_in']) != 10) ){
				$entree['dgda_in'] = NULL;
			}

			if($entree['dgda_out'] == '' || (strlen($entree['dgda_out']) != 10) ){
				$entree['dgda_out'] = NULL;
			}

			if($entree['custom_deliv'] == '' || (strlen($entree['custom_deliv']) != 10) ){
				$entree['custom_deliv'] = NULL;
			}

			if($entree['dispatch_deliv'] == '' || (strlen($entree['dispatch_deliv']) != 10) ){
				$entree['dispatch_deliv'] = NULL;
			}

			if($entree['regul_ir'] == '' || (strlen($entree['regul_ir']) != 10) ){
				$entree['regul_ir'] = NULL;
			}

			$requete = $connexion-> prepare('INSERT INTO dossier(id_cli, ref_dos, mca_b_ref, date_preal, 
																id_mod_lic, id_util, id_mod_trans, num_lic, t1, poids, ref_fact, fob, fret, assurance,
																autre_frais, po_ref, commodity, horse, trailer_1, 
																trailer_2, road_manif, num_exo, arrival_date, 
																crossing_date, wiski_arriv, wiski_dep, 
																amicongo_arriv, insp_receiv, ir, ref_crf, 
																date_crf, ref_decl, dgda_in, ref_liq, 
																date_liq, ref_quit, date_quit, dgda_out, 
																custom_deliv, dispatch_deliv, remarque, statut, 
																regul_ir) 
												VALUES(?, ?, ?, 
													?, ?, ?, 
													?, ?, ?, ?, ?, 
													?, ?, ?, ?, ?, 
													?, ?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, 
													?, ?, ?, ?, ?, 
													?, ?, ?, ?, ?)');
			$requete-> execute(array($entree['client'], $entree['ref_dos'], $entree['mca_b_ref'], 
									$entree['date_preal'], $entree['id_mod_trac'], $entree['id_util'], 
									$entree['id_mod_trans'], $entree['num_lic'], $entree['t1'], 
									$entree['poids'], $entree['ref_fact'], $entree['fob'], 
									$entree['fret'], $entree['assurance'], $entree['autre_frais'], 
									$entree['po_ref'], $entree['commodity'], $entree['horse'], 
									$entree['trailer_1'], $entree['trailer_2'], $entree['road_manif'], 
									$entree['num_exo'], $entree['arrival_date'], $entree['crossing_date'], 
									$entree['wiski_arriv'], $entree['wiski_dep'], $entree['amicongo_arriv'], 
									$entree['insp_report'], $entree['ir'], $entree['ref_crf'], 
									$entree['date_crf'], $entree['ref_decl'], $entree['dgda_in'], 
									$entree['ref_liq'], $entree['date_liq'], $entree['ref_quit'], 
									$entree['date_quit'], $entree['dgda_out'], $entree['custom_deliv'], 
									$entree['dispatch_deliv'], $entree['remarque'], $entree['statut'], 
									$entree['regul_ir']));
		}
		//FIN Methodes permettant de créer
	
		//Methodes permettant d'afficher
		public function afficherMenuLicence(){
			include("connexion.php");
			if(!isset($_GET['id_mod_lic'])){
				$_GET['id_mod_lic'] = '';
			}
			$id_cli = '';
			$active = '';
			$open = '';
			if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '5'){
				$sql = "SELECT id_mod_lic, 
							nom_mod_lic,
							sigle_mod_lic
						FROM modele_licence
						WHERE id_etat = 1
						ORDER BY rang_lic ASC";
			$requete = $connexion-> query($sql);
			while($reponse = $requete-> fetch()){
				if($reponse['id_mod_lic'] == $_GET['id_mod_lic']){
					$active = 'active';
					$open = ' menu-open';
				}else{
					$active = '';
					$open = '';
				}
				?>
				<li class="nav-item has-treeview <?php echo $open;?>">
			        <a href="#" class="nav-link  <?php echo $active;?>">
			          <i class="nav-icon fas fa-file"></i>
			          <p>
			            <?php echo $reponse['nom_mod_lic'];?>
			            <i class="right fas fa-angle-left"></i>
			          </p>
			        </a>
		            <ul class="nav nav-treeview">
		              <li class="nav-item">
		                <a href="dashboard.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tachometer-alt"></i>
		                  <p>Dashboard licences <?php echo $reponse['sigle_mod_lic'];?></p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="licence.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
		                  <p>Synthèse <?php echo $reponse['sigle_mod_lic'];?></p>
		                </a>
		              </li>
		              <?php
		              	if ($reponse['id_mod_lic'] == 2) {
		              	?>
		              <li class="nav-item">
		                <a href="manipulation.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-edit nav-icon"></i>
		                  <p>Manipulations</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="facture.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-file nav-icon"></i>
		                  <p>Facture</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="av.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-file nav-icon"></i>
		                  <p>Attestation Verification</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="licence_upload.php?id_mod_lic=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-upload nav-icon"></i>
		                  <p>Uploade Fichier</p>
		                </a>
		              </li>
		              	<?php
		              	}
		              ?>
		            </ul>
			    </li>
				<?php
			}$requete-> closeCursor();

			}

		}

		public function afficherMenuTracking(){
			include("connexion.php");
			if(!isset($_GET['id_mod_lic'])){
				$_GET['id_mod_lic'] = '';
			}
			$id_cli = '';
			$active = '';
			$open = '';
			if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '6'){
				$sql = "SELECT id_mod_lic, 
							nom_mod_lic,
							sigle_mod_lic
						FROM modele_licence
						WHERE id_etat = 1
						ORDER BY rang_lic ASC";

			$requete = $connexion-> query($sql);
			while($reponse = $requete-> fetch()){
				if( (isset($_GET['id_mod_trac'])) && ($reponse['id_mod_lic'] == $_GET['id_mod_trac']) ){
					$active = 'active';
					$open = ' menu-open';
				}else{
					$active = '';
					$open = '';
				}
				?>
				<li class="nav-item has-treeview <?php echo $open;?>">
			        <a href="#" class="nav-link  <?php echo $active;?>">
			          <i class="nav-icon fas fa-file"></i>
			          <p>
			            <?php echo $reponse['nom_mod_lic'];?>
			            <i class="right fas fa-angle-left"></i>
			          </p>
			        </a>
		            <ul class="nav nav-treeview">
		              <!--<li class="nav-item">
		                <a href="dashboardDossier.php?id_mod_trac=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>&commodity=" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tachometer-alt"></i>
		                  <p>Dashboard dossiers <?php echo $reponse['sigle_mod_lic'];?></p>
		                </a>
		              </li>-->

						<li class="nav-item has-treeview">
					        <a href="dashboardDossier.php?id_cli=<?php echo $reponse['id_cli'];?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>" class="nav-link" class="nav-link">
		                  	&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-tachometer-alt"></i>
		                  	<p>Dashboard dossiers <?php echo $reponse['sigle_mod_lic'];?></p>
					        </a>
				            <ul class="nav nav-treeview">
				              <?php
				              	$this-> afficherMenuModeTransportDashboard($id_cli, $reponse['id_mod_lic']);
				              	//$this-> afficherMenuLicenceClient($reponse['id_cli'], $id_mod_lic);
				              ?>
				            </ul>
					    </li>
		              <li class="nav-item">
		                <a href="reporting_dossier.php?id_mod_trac=<?php echo $reponse['id_mod_lic'];?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open nav-icon"></i>
		                  <p>Reporting</p>
		                </a>
		              </li>
		              <?php
		              	//$this-> afficherMenuMarchandiseModeleLicence($reponse['id_mod_lic']);
		              	$this-> afficherMenuClientModeleLicence($reponse['id_mod_lic']);
		              ?>
		              <li class="nav-item">
		                <a href="dossier_upload.php?id_mod_trac=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-upload nav-icon"></i>
		                  <p>Uploade Fichier</p>
		                </a>
		              </li>
		              <li class="nav-item">
		                <a href="dossier_upload2.php?id_mod_trac=<?php echo $reponse['id_mod_lic'];?>&amp;id_cli=<?php echo $id_cli;?>" class="nav-link">
		                  &nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-upload nav-icon"></i>
		                  <p>Uploade Fichier Tracking</p>
		                </a>
		              </li>
		            </ul>
			    </li>
				<?php
			}$requete-> closeCursor();

			}
		}

		public function afficherMenuMarchandiseModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$active = '';
			$open = '';

			$requete = $connexion-> prepare("SELECT UPPER(nom_march) AS nom_march, id_march AS id_march 
												FROM marchandise 
												WHERE id_mod_lic = ?
												ORDER BY nom_march");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_march'])) && ($reponse['id_march'] == $_GET['id_march']) ){
					$active = 'active';
					$open = ' menu-open';
				}else{
					$active = '';
					$open = '';
				}
			?>
				<li class="nav-item has-treeview <?php echo $open;?>">
			        <a href="dossier.php?id_march=<?php echo $reponse['id_march'];?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>" class="nav-link <?php echo $active;?>" class="nav-link  <?php echo $active;?>">
			          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-file"></i>
			          <p>
			            <?php echo $reponse['nom_march'];?>
			            <i class="right fas fa-angle-left"></i>
			          </p>
			        </a>
		            <ul class="nav nav-treeview">
		              <?php
		              	$this-> afficherMenuModeTransport($reponse['id_march'], $id_mod_lic);
		              ?>
		            </ul>
			    </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherMenuClientModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$active = '';
			$open = '';

			$requete = $connexion-> prepare("SELECT UPPER(c.nom_cli) AS nom_cli, c.id_cli AS id_cli 
												FROM client c, affectation_client_modele_licence cm, modele_licence m 
												WHERE m.id_mod_lic = ?
													AND m.id_mod_lic = cm.id_mod_lic
													AND cm.id_cli = c.id_cli
												ORDER BY c.nom_cli");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_cli'])) && ($reponse['id_cli'] == $_GET['id_cli']) ){
					$active = 'active';
					$open = ' menu-open';
				}else{
					$active = '';
					$open = '';
				}
			?>
				<li class="nav-item has-treeview <?php echo $open;?>">
			        <a href="dossier.php?id_cli=<?php echo $reponse['id_cli'];?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>" class="nav-link <?php echo $active;?>" class="nav-link  <?php echo $active;?>">
			          &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fa fa-user"></i>
			          <p>
			            <?php echo $reponse['nom_cli'];?>
			            <i class="right fas fa-angle-left"></i>
			          </p>
			        </a>
		            <ul class="nav nav-treeview">
		              <?php
		              	$this-> afficherMenuModeTransportClient($reponse['id_cli'], $id_mod_lic);
		              	//$this-> afficherMenuLicenceClient($reponse['id_cli'], $id_mod_lic);
		              ?>
		              <?php
		              	if( $reponse['id_cli'] == '869'){
		              	?>
		              	<li class="nav-item">
			                <a href="uploadTrackingKlsa.php?id_cli=<?php echo $reponse['id_cli'];?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>&commodity=" class="nav-link">
			                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-upload nav-icon"></i>
			                  <p>UPLOAD FICHIER</p>
			                </a>
			            </li>
		              	<?php
		              	}
		              ?>
		            </ul>
			    </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherMenuModeTransport($id_march, $id_mod_lic){
			include('connexion.php');
			//$entree['id_mod_lic'] = $id_mod_lic;
			$style = '';

			$requete = $connexion-> query("SELECT UPPER(nom_mod_trans) AS nom_mod_trans, id_mod_trans AS id_mod_trans 
												FROM mode_transport ");
			//$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_march'])) && ($id_march == $_GET['id_march']) && (isset($id_march)) && ($reponse['id_mod_trans'] == $_GET['id_mod_trans']) ){
					$style = 'style="font-weight: bold; color: white;"';
				}else{
					$style = '';
				}
			?>
				<li class="nav-item">
	                <a href="dossier.php?id_march=<?php echo $id_march;?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>&amp;id_mod_trans=<?php echo $reponse['id_mod_trans'];?>" class="nav-link" <?php echo $style;?>>
	                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
	                  <p><?php echo $reponse['nom_mod_trans'];?></p>
	                </a>
	            </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherMenuModeTransportClient($id_cli, $id_mod_lic){
			include('connexion.php');
			//$entree['id_mod_lic'] = $id_mod_lic;
			$style = '';

			$requete = $connexion-> query("SELECT UPPER(nom_mod_trans) AS nom_mod_trans, id_mod_trans AS id_mod_trans 
												FROM mode_transport ");
			//$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_cli'])) && ($id_cli == $_GET['id_cli']) && (isset($id_cli)) && (isset($_GET['id_mod_trans'])) && ($reponse['id_mod_trans'] == $_GET['id_mod_trans']) ){
					$style = 'style="font-weight: bold; color: white;"';
				}else{
					$style = '';
				}
			?>
				<li class="nav-item">
	                <a href="dossier.php?id_cli=<?php echo $id_cli;?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>&amp;id_mod_trans=<?php echo $reponse['id_mod_trans'];?>&commodity=" class="nav-link" <?php echo $style;?>>
	                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
	                  <p><?php echo $reponse['nom_mod_trans'];?></p>
	                </a>
	            </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherMenuModeTransportDashboard($id_cli, $id_mod_lic){
			include('connexion.php');
			//$entree['id_mod_lic'] = $id_mod_lic;
			$style = '';

			$requete = $connexion-> query("SELECT UPPER(nom_mod_trans) AS nom_mod_trans, id_mod_trans AS id_mod_trans 
												FROM mode_transport ");
			//$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_cli'])) && ($id_cli == $_GET['id_cli']) && (isset($id_cli)) && (isset($_GET['id_mod_trans'])) && ($reponse['id_mod_trans'] == $_GET['id_mod_trans']) ){
					$style = 'style="font-weight: bold; color: white;"';
				}else{
					$style = '';
				}
			?>
				<li class="nav-item">
	                <a href="dashboardDossier.php?id_cli=<?php echo $id_cli;?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>&amp;id_mod_trans=<?php echo $reponse['id_mod_trans'];?>&commodity=" class="nav-link" <?php echo $style;?>>
	                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
	                  <p><?php echo $reponse['nom_mod_trans'];?></p>
	                </a>
	            </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherMenuLicenceClient($id_cli, $id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$style = '';

			$requete = $connexion-> prepare("SELECT num_lic
												FROM licence
												WHERE id_mod_lic = ? 
													AND id_cli = ?
												ORDER BY date_creat_lic DESC");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));
			while ($reponse = $requete-> fetch()) {
				if( (isset($_GET['id_cli'])) && ($id_cli == $_GET['id_cli']) && (isset($id_cli)) && ($reponse['num_lic'] == $_GET['num_lic']) ){
					$style = 'style="font-weight: bold; color: white;"';
				}else{
					$style = '';
				}
			?>
				<li class="nav-item">
	                <a href="dossier.php?id_cli=<?php echo $id_cli;?>&amp;id_mod_trac=<?php echo $id_mod_lic;?>&amp;num_lic=<?php echo $reponse['num_lic'];?>" class="nav-link" <?php echo $style;?>>
	                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="far fa-circle nav-icon"></i>
	                  <p><?php echo $reponse['num_lic'];?></p>
	                </a>
	            </li>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherEnTeteTableau($id_mod_lic, $id_cli, $id_mod_trans){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			?>
		    <tr class="bg bg-dark">
		      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">#</th>
		      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">MCA File REF</th>
			<?php
			while ($reponse = $requete-> fetch()) {
				
			?>
			<th style="border: 1px solid white;"><?php echo $reponse['titre_col'];?></th>
			<?php

			}$requete-> closeCursor();
			?>
			</tr>
			<?php
		}

		public function afficherEnTeteTableauExcel($id_mod_lic, $id_cli, $id_mod_trans){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			?>
		    <tr class="bg bg-dark">
		      <th style="border: 0.2px solid white; background-color: #696969; color: white;">#</th>
		      <th style="border: 0.2px solid white; background-color: #696969; color: white;">MCA File REF</th>
			<?php
			while ($reponse = $requete-> fetch()) {
				
			?>
			<th style="border: 0.2px solid white; background-color: #696969; color: white;">
				<?php echo $reponse['titre_col'];?>
			</th>
			<?php

			}$requete-> closeCursor();
			?>
			</tr>
			<?php
		}

		public function afficherRowTableau($id_mod_lic, $id_cli, $id_mod_trans, $id_dos, $compteur){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$bg = '';

			$requete = $connexion-> prepare("SELECT c.champ_col AS champ_col, 
													c.type_col AS type_col, 
													c.calcul AS calcul,
													c.id_col AS id_col 
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_trans = ?
											    AND af.id_mod_lic = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				//getDataRow($champ_col, $id_dos)
				if ($reponse['id_col'] == '40') {
					$getDataRowCalculNetDays = $this-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					if ( ($getDataRowCalculNetDays >= 0) && ($getDataRowCalculNetDays <= 3) ) {
						$bg = "badge badge-success";
					}else if ( ($getDataRowCalculNetDays > 3) && ($getDataRowCalculNetDays <= 5) ) {
						$bg = "badge badge-warning";
					}else if ( ($getDataRowCalculNetDays > 5) ) {
						$bg = "badge badge-danger";
					}
				?>
				<td style="border: 1px solid black; text-align: center;">
					<span class=" <?php echo $bg;?>">
					<?php
						echo $this-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					?>
					</span>
					<?php //echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];?>
				</td>
				<?php
					$bg = '';
				}
				else if ($reponse['id_col'] == '38') {
					
				?>
				<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
					<select name="<?php echo $reponse['champ_col'];?>_<?php echo $compteur;?>">
					<?php
					$getDataRow = $this-> getDataRow($reponse['champ_col'], $id_dos);
					if ( ($getDataRow == '0') ) {
						?>
							<option>TRANSIT</option>
							<option value="1">CLEARED</option>
							<option value="2">CANCELLED</option>
						<?php
					}else if ( ($getDataRow == '1') ) {
						?>
							<option>CLEARED</option>
							<option value="0">TRANSIT</option>
							<option value="2">CANCELLED</option>
						<?php
					}else if ( ($getDataRow == '2') ) {
						?>
							<option>CANCELLED</option>
							<option value="0">TRANSIT</option>
							<option value="1">CLEARED</option>
						<?php
					}
					?>
					</select>
				</td>
				<?php
				}else if ($reponse['id_col'] == '17') {
					
				?>
				<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
					<?php echo $this-> getDataRow($reponse['champ_col'], $id_dos);?>
				</td>
				<?php
				}
				else if ($reponse['calcul'] == '1') {
					
				?>
				<td class=" <?php echo $bg;?>" style="border: 1px solid black; text-align: center;">
					<?php
						if (isset($this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']])) {
							echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];
						}
					?>
					<?php //echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];?>
				</td>
				<?php

				}else{

				?>
				<td class=" <?php echo $bg;?>" style="border: 1px solid black; ">
					<input type="<?php echo $reponse['type_col'];?>" style="" name="<?php echo $reponse['champ_col'];?>_<?php echo $compteur;?>" value="<?php echo $this-> getDataRow($reponse['champ_col'], $id_dos);?>">
				</td>
				<?php

				}

			}$requete-> closeCursor();
		}

		public function afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $id_dos, $compteur){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$bg = '';

			$requete = $connexion-> prepare("SELECT c.champ_col AS champ_col, 
													c.type_col AS type_col, 
													c.calcul AS calcul,
													c.id_col AS id_col 
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_trans = ?
											    AND af.id_mod_lic = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				//getDataRow($champ_col, $id_dos)
				if ($reponse['id_col'] == '40') {
					$getDataRowCalculNetDays = $this-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					if ( ($getDataRowCalculNetDays >= 0) && ($getDataRowCalculNetDays <= 3) ) {
						$bg = "background-color: green; color: white;";
					}else if ( ($getDataRowCalculNetDays > 3) && ($getDataRowCalculNetDays <= 5) ) {
						$bg = "background-color: orange; color: white;";
					}else if ( ($getDataRowCalculNetDays > 5) ) {
						$bg = "background-color: red; color: white;";
					}
				?>
				<td style="border: 0.5px solid black; text-align: center; <?php echo $bg;?>">
					<?php
						echo $this-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					?>
					<?php //echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];?>
				</td>
				<?php
					$bg = '';
				}
				else if ($reponse['id_col'] == '38') {
					
				?>
				<td style="border: 0.5px solid black; text-align: center;">
					<?php
					$getDataRow = $this-> getDataRow($reponse['champ_col'], $id_dos);
					if ( ($getDataRow == '0') ) {
						?>
						TRANSIT
						<?php
					}else if ( ($getDataRow == '1') ) {
						?>
						CLEARED
						<?php
					}else if ( ($getDataRow == '2') ) {
						?>
						CANCELLED
						<?php
					}
					?>
				</td>
				<?php
				}else if ($reponse['id_col'] == '17') {
					
				?>
				<td style="border: 0.5px solid black; text-align: center;">
					<?php echo $this-> getDataRow($reponse['champ_col'], $id_dos);?>
				</td>
				<?php
				}
				else if ($reponse['calcul'] == '1') {
					
				?>
				<td style="border: 0.5px solid black; text-align: center;">
					<?php
						if (isset($this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']])) {
							echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];
						}
					?>
					<?php //echo $this-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']];?>
				</td>
				<?php

				}else{

				?>
				<td style="border: 0.5px solid black; text-align: center;">
					<?php echo $this-> getDataRow($reponse['champ_col'], $id_dos);?>
				</td>
				<?php

				}

			}$requete-> closeCursor();
		}

		public function afficherLicence($id_mod_lic, $id_cli, $id_type_lic, $premiere_entree, $nombre_dossier_par_page){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;

			$sql = "";
			$sql2 = "";
			
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND cl.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$compteur = 0;
			
			if($_SESSION['id_role'] == 1 || $_SESSION['id_role'] == 5){
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							l.fret AS fret,
							l.acheteur AS acheteur,
							l.assurance AS assurance,
							UPPER(cl.nom_cli) AS nom_cli,
							UPPER(l.commodity) AS commodity,
							l.fournisseur AS fournisseur,
							DATE(CURRENT_DATE()) AS aujourdhui,
							UPPER(b.nom_banq) AS nom_banq,
							l.ref_fact AS ref_fact,
							l.remarque AS remarque,
							DATE_FORMAT(l.date_fact, '%d/%m/%Y') AS date_fact							
						FROM licence l, monnaie m, client cl, banque b
						WHERE l.id_mod_lic = ?
							AND l.id_cli = cl.id_cli
							$sql
							$sql2
							AND l.id_mon = m.id_mon
							AND l.id_banq = b.id_banq
						ORDER BY l.date_creat_lic DESC
						LIMIT $premiere_entree, $nombre_dossier_par_page";

			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				$couleur = "";
				
				$style = '';//" style='color: black; background-color: orange;'";
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$bg = "bg-dark";
					$style = " style=''";
					$couleur = "dark";
				}else if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
					$bg = "bg-success";
					$style = " style=''";
					$couleur = "success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
					$bg = "bg-warning";
					$style = " style=''";
					$couleur = "warning";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
					$bg = "bg-info";
					$style = " style=''";
					$couleur = "info";
				}
				
			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="col_1 <?php echo $bg;?>" style=" padding: 0.8rem; text-align: left; border: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="col_6_licence <?php echo $bg;?>" style=" padding: 0.8rem; text-align: left; border: 1px solid black;"><?php echo $reponse['num_lic'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['acheteur'];?></td>
					<?php
				}
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<?php
				}
				if($id_mod_lic != '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['commodity'];?></td>
					<?php
				}
				?>
					<td style="text-align: center;border: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td style="text-align: right;border: 1px solid black;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?></td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']+$reponse['assurance']+$reponse['fret']), 2, ',', ' ');?></td>
					<?php
				}
				?>
				<?php
				if($id_mod_lic == '1'){
				?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl'], 2, ',', ' ');?></td>
					<?php
					}
				?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_banq'];?></td>
				<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl']-$this-> getSommeQteLicence($reponse['num_lic']), 2, ',', ' ');?></td>
					<?php
				}
				/*if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']), 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
					<?php
				}*/
				?>
				<td style="text-align: center; border: 1px solid black;">
					<?php echo $this-> getNbreDossierLicence($reponse['num_lic']);?>
				</td>
				<td style="text-align: center; border: 1px solid black;">
					<?php 
						echo ($reponse['fob'] - $this-> getSommeFobLicence($reponse['num_lic']));
					?>
				</td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['date_fact'];?></td>
					<?php
				}
				?>
					<td style="text-align: center; border: 1px solid black; color: black; background-color: white;">
						<?php echo $reponse['remarque'];?>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<a title="Fichier Licence" href="#" style="color: black;" onclick="window.open('../dossiers/<?php echo $reponse['num_lic'];?>/<?php echo $reponse['fichier_lic'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<a title="Dossiers affectés" href="#" style="color: black;" onclick="window.open('popUpDossierLicence.php?num_lic=<?php echo $reponse['num_lic'];?>&couleur=<?php echo $couleur;?>','pop1','width=1000,height=900');">
							<i class="fa fa-folder-open"></i>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<form method="POST" action="">
							<input type="hidden" value="<?php echo $reponse['num_lic'];?>" name="num_lic">
							<button class="btn btn-warning" name="edit">
								<i class="fa fa-edit"></i>
							</button>
						</form>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();

			}
		}

		public function editLicence($id_mod_lic, $id_cli, $id_type_lic, $num_lic){
			include("connexion.php");
			$entree['num_lic'] = $num_lic;

			$compteur = 0;
			
			if($_SESSION['id_role'] == 1 || $_SESSION['id_role'] == 5){
				$sql = "SELECT l.num_lic AS num_lic,
							l.date_val AS date_val,
							l.fob AS fob,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							l.fret AS fret,
							l.acheteur AS acheteur,
							l.assurance AS assurance,
							UPPER(cl.nom_cli) AS nom_cli,
							UPPER(l.commodity) AS commodity,
							l.fournisseur AS fournisseur,
							DATE(CURRENT_DATE()) AS aujourdhui,
							UPPER(b.nom_banq) AS nom_banq,
							l.ref_fact AS ref_fact,
							l.remarque AS remarque,
							DATE_FORMAT(l.date_fact, '%d/%m/%Y') AS date_fact							
						FROM licence l, monnaie m, client cl, banque b
						WHERE l.num_lic = ?
							AND l.id_cli = cl.id_cli
							AND l.id_mon = m.id_mon
							AND l.id_banq = b.id_banq
						ORDER BY l.date_val DESC";

			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['num_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				$couleur = "";
				
				$style = '';//" style='color: black; background-color: orange;'";
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$bg = "bg-dark";
					$style = " style=''";
					$couleur = "dark";
				}else if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
					$bg = "bg-success";
					$style = " style=''";
					$couleur = "success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
					$bg = "bg-warning";
					$style = " style=''";
					$couleur = "warning";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
					$bg = "bg-info";
					$style = " style=''";
					$couleur = "info";
				}
				
			?>
				<form method="POST" action="">
					<input type="hidden" value="<?php echo $reponse['num_lic'];?>" name="num_lic_old">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="col_1 <?php echo $bg;?>" style=" padding: 0.8rem; text-align: left; border: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style=" text-align: left; border: 1px solid black;">
						<input type="text" name="num_lic" value="<?php echo $reponse['num_lic'];?>" class="form-control cc-exp" required>
					</td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: center; border: 1px solid black;">
						<input type="date" name="date_val" value="<?php echo $reponse['date_val'];?>" class="form-control cc-exp" required>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<input type="date" name="date_exp" value="<?php echo $this-> getLastEpirationLicence2($reponse['num_lic']);?>" class="form-control cc-exp" required>
					</td>
					<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: left; border: 1px solid black;"><input type="text" name="acheteur" value="<?php echo $reponse['acheteur'];?>" class="form-control cc-exp" required></td>
					<?php
				}
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><input type="text" name="fournisseur" value="<?php echo $reponse['fournisseur'];?>" class="form-control cc-exp" required></td>
					<?php
				}
				if($id_mod_lic != '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><input type="text" name="commodity" value="<?php echo $reponse['commodity'];?>" class="form-control cc-exp" required></td>
					<?php
				}
				?>
					<td style="text-align: center;border: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td style="text-align: right;border: 1px solid black;">
						<input type="number" name="fob" value="<?php echo $reponse['fob'];?>" class="form-control cc-exp" required>
					</td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']+$reponse['assurance']+$reponse['fret']), 2, ',', ' ');?></td>
					<?php
				}
				?>
				<?php
				if($id_mod_lic == '1'){
				?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl'], 2, ',', ' ');?></td>
					<?php
					}
				?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_banq'];?></td>
				<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl']-$this-> getSommeQteLicence($reponse['num_lic']), 2, ',', ' ');?></td>
					<?php
				}
				/*if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']), 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
					<?php
				}*/
				?>
				<td style="text-align: center; border: 1px solid black;">
					<?php echo $this-> getNbreDossierLicence($reponse['num_lic']);?>
				</td>
				<td style="text-align: center; border: 1px solid black;">
					<?php 
						echo ($reponse['fob'] - $this-> getSommeFobLicence($reponse['num_lic']));
					?>
				</td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['date_fact'];?></td>
					<?php
				}
				?>
					<td style="text-align: center; border: 1px solid black; color: black; background-color: white;">
						<?php echo $reponse['remarque'];?>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<a title="Fichier Licence" href="#" style="color: black;" onclick="window.open('../dossiers/<?php echo $reponse['num_lic'];?>/<?php echo $reponse['fichier_lic'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<a title="Dossiers affectés" href="#" style="color: black;" onclick="window.open('popUpDossierLicence.php?num_lic=<?php echo $reponse['num_lic'];?>&couleur=<?php echo $couleur;?>','pop1','width=1000,height=900');">
							<i class="fa fa-folder-open"></i>
						</a>
					</td>
					<td style="text-align: center; border: 1px solid black;">
						<button class="btn btn-success" name="modifierLicence">
							<i class="fa fa-check"></i>
						</button>
					</td>
				</tr>
				</form>
			<?php
			}$requete-> closeCursor();

			}
		}

		public function afficherLicenceExcel($id_mod_lic, $id_cli, $id_type_lic){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;

			$sql = "";
			$sql2 = "";
			
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND cl.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$status = "";

			$compteur = 0;
			
			if($_SESSION['id_role'] == 1 || $_SESSION['id_role'] == 5){
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							l.fret AS fret,
							l.acheteur AS acheteur,
							l.assurance AS assurance,
							UPPER(cl.nom_cli) AS nom_cli,
							UPPER(l.commodity) AS commodity,
							l.fournisseur AS fournisseur,
							DATE(CURRENT_DATE()) AS aujourdhui,
							UPPER(b.nom_banq) AS nom_banq,
							l.ref_fact AS ref_fact,
							l.remarque AS remarque,
							DATE_FORMAT(l.date_fact, '%d/%m/%Y') AS date_fact							
						FROM licence l, monnaie m, client cl, banque b
						WHERE l.id_mod_lic = ?
							AND l.id_cli = cl.id_cli
							$sql
							$sql2
							AND l.id_mon = m.id_mon
							AND l.id_banq = b.id_banq
						ORDER BY l.date_val DESC";

			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				$couleur = "";
				
				$style = '';//" style='color: black; background-color: orange;'";
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$bg = "bg-dark";
					$style = " style='color: grey;'";
					$couleur = "dark";
					$status = 'Cloturée avec dossier';
				}else if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
					$bg = "bg-success";
					$style = " style='color: green;'";
					$couleur = "success";
					$status = 'Apurée Banque';
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
					$style = " style='color: red;'";
					$couleur = "danger";
					$status = 'Expirée';
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
					$bg = "bg-warning";
					$style = " style='color: orange;'";
					$couleur = "warning";
					$status = 'Expiration -40 jours';
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
					$bg = "bg-danger";
					$style = " style='color: red;'";
					$couleur = "danger";
					$status = 'Expirée';
				} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
					$bg = "bg-info";
					$style = " style='color: blue;'";
					$couleur = "info";
					$status = 'Partielle';
				}
				
			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="col_1 <?php echo $bg;?>" style=" text-align: left; border: 0.5px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['num_lic'];?></td>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: center; border: 0.5px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border: 0.5px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['acheteur'];?></td>
					<?php
				}
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<?php
				}
				if($id_mod_lic != '3'){
					?>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['commodity'];?></td>
					<?php
				}
				?>
					<td style="text-align: right;border: 0.5px solid black;"><?php echo $reponse['fob'].' '.$reponse['sig_mon'];?></td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo $reponse['assurance'];?></td>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo $reponse['fret'];?></td>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo ($reponse['fob']+$reponse['assurance']+$reponse['fret']);?></td>
					<?php
				}
				?>
				<?php
				if($id_mod_lic == '1'){
				?>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo $reponse['qte_decl'];?></td>
					<?php
					}
				?>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['nom_banq'];?></td>
				<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']);?></td>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo $reponse['qte_decl']-$this-> getSommeQteLicence($reponse['num_lic']);?></td>
					<?php
				}
				/*if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 0.5px solid black;"><?php echo number_format( $reponse['fob']-$this-> getSommeFobLicence($reponse['num_lic']), 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
					<?php
				}*/
				?>
				<td style="text-align: center; border: 0.5px solid black;">
					<?php echo $this-> getNbreDossierLicence($reponse['num_lic']);?>
				</td>
				<td style="text-align: center; border: 0.5px solid black;">
					<?php 
						echo ($reponse['fob'] - $this-> getSommeFobLicence($reponse['num_lic']));
					?>
				</td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td style="text-align: left; border: 0.5px solid black;"><?php echo $reponse['date_fact'];?></td>
					<?php
				}
				?>
					<td style="text-align: center; border: 0.5px solid black; color: black; background-color: white;">
						<?php echo $reponse['remarque'];?>
						</a>
					</td>
					<td style="text-align: center; border: 0.5px solid black; color: black; background-color: white;">
						<?php echo $status;?>
						</a>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();

			}
		}

		public function afficherLicenceUpload($id_mod_lic, $id_util){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			$compteur = 0;

			$requete = $connexion-> prepare("SELECT * FROM licence_upload
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));
			while($reponse = $requete-> fetch()){
				$compteur++;
			?>
				<form method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $reponse['id'];?>">
				<tr class="">
					<td>
						<?php echo $compteur;?>
					</td>
					<td>
						<?php echo $reponse['fournisseur'];?>	
					</td>
					<td>
						<?php echo $reponse['commodity'];?>	
					</td>
					<td>
						<?php echo $reponse['po'];?>	
					</td>
					<td>
						<?php echo $reponse['facture'];?>	
					</td>
					<td>
						<?php echo $reponse['num_licence'];?>	
					</td>
					<td>
						<?php echo $reponse['monnaie'];?>	
					</td>
					<td>
						<?php echo $reponse['fob'];?>	
					</td>
					<td>
						<?php echo $reponse['fret'];?>	
					</td>
					<td>
						<?php echo $reponse['assurance'];?>	
					</td>
					<td>
						<?php echo $reponse['autre_frais'];?>	
					</td>
					<td>
						<?php echo $reponse['fsi'];?>	
					</td>
					<td>
						<?php echo $reponse['aur'];?>	
					</td>
					<td>
						<?php echo $reponse['validation'];?>	
					</td>
					<td>
						<?php echo $reponse['extreme'];?>	
					</td>
					<td style="text-align: center;">
						<button class="btn btn-danger" type="submit" name="deleteLicence">
							<i class="fa fa-times"></i>
						</button>
					</td>
				</tr>
			</form>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossierUpload($id_mod_lic, $id_util){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			$compteur = 0;

			$requete = $connexion-> prepare("SELECT * FROM dossier_upload
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));
			while($reponse = $requete-> fetch()){
				$compteur++;
			?>
				<form method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $reponse['id'];?>">
				<tr class="">
					<td>
						<?php echo $compteur;?>
					</td>
					<td>
						<?php echo $reponse['ref_dos'];?>	
					</td>
					<td>
						<?php echo $reponse['num_lic'];?>	
					</td>
					<td>
						<?php echo $reponse['cod'];?>	
					</td>
					<td>
						<?php echo $reponse['fxi'];?>	
					</td>
					<td>
						<?php echo $reponse['montant_av'];?>	
					</td>
					<td>
						<?php echo $reponse['date_fact'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_fact'];?>	
					</td>
					<td>
						<?php echo $reponse['fob'];?>	
					</td>
					<td>
						<?php echo $reponse['fret'];?>	
					</td>
					<td>
						<?php echo $reponse['assurance'];?>	
					</td>
					<td>
						<?php echo $reponse['autre_frais'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_decl'];?>	
					</td>
					<td>
						<?php echo $reponse['montant_decl'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_liq'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_quit'];?>	
					</td>
					<td>
						<?php echo $reponse['date_quit'];?>	
					</td>
					<td style="text-align: center;">
						<button class="btn btn-danger" type="submit" name="deleteDossierUpload">
							<i class="fa fa-times"></i>
						</button>
					</td>
				</tr>
			</form>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossierUploadTrackingKlsa($id_mod_lic, $id_util){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			$compteur = 0;

			$requete = $connexion-> prepare("SELECT * FROM dossier_upload_tracking
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));
			while($reponse = $requete-> fetch()){
				$compteur++;
			?>
				<form method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $reponse['id'];?>">
				<tr class="">
					<td>
						<?php echo $compteur;?>
					</td>
					<td>
						<?php echo $reponse['ref_dos'];?>	
					</td>
					<td>
						<?php echo $reponse['num_lic'];?>	
					</td>
					<td>
						<?php echo $reponse['t1'];?>	
					</td>
					<td>
						<?php echo $reponse['poids'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_fact'];?>	
					</td>
					<td>
						<?php echo $reponse['horse'];?>	
					</td>
					<td>
						<?php echo $reponse['trailer_1'];?>	
					</td>
					<td>
						<?php echo $reponse['trailer_2'];?>	
					</td>
					<td>
						<?php echo $reponse['transporteur'];?>	
					</td>
					<td>
						<?php echo $reponse['destination'];?>	
					</td>
					<td>
						<?php echo $reponse['arrival_date'];?>	
					</td>
					<td>
						<?php echo $reponse['crossing_date'];?>	
					</td>
					<td>
						<?php echo $reponse['wiski_arriv'];?>	
					</td>
					<td>
						<?php echo $reponse['wiski_dep'];?>	
					</td>
					<td>
						<?php echo $reponse['remarque'];?>	
					</td>
					<td style="text-align: center;">
						<button class="btn btn-danger" type="submit" name="deleteDossierUpload">
							<i class="fa fa-times"></i>
						</button>
					</td>
				</tr>
			</form>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossierUpload2($id_mod_lic, $id_util){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			$compteur = 0;

			$requete = $connexion-> prepare("SELECT * FROM dossier_upload_tracking
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));
			while($reponse = $requete-> fetch()){
				$compteur++;
			?>
				<form method="POST" action="">
					<input type="hidden" name="id" value="<?php echo $reponse['id'];?>">
				<tr class="">
					<td>
						<?php echo $compteur;?>
					</td>
					<td>
						<?php echo $reponse['ref_dos'];?>	
					</td>
					<td>
						<?php echo $reponse['mca_b_ref'];?>	
					</td>
					<td>
						<?php echo $reponse['road_manif'];?>	
					</td>
					<td>
						<?php echo $reponse['date_preal'];?>	
					</td>
					<td>
						<?php echo $reponse['t1'];?>	
					</td>
					<td>
						<?php echo $reponse['poids'];?>	
					</td>
					<td>
						<?php echo $reponse['fob'];?>	
					</td>
					<td>
						<?php echo $reponse['fret'];?>	
					</td>
					<td>
						<?php echo $reponse['assurance'];?>	
					</td>
					<td>
						<?php echo $reponse['autre_frais'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_fact'];?>	
					</td>
					<td>
						<?php echo $reponse['fournisseur'];?>	
					</td>
					<td>
						<?php echo $reponse['po'];?>	
					</td>
					<td>
						<?php echo $reponse['commodity'];?>	
					</td>
					<td>
						<?php echo $reponse['horse'];?>	
					</td>
					<td>
						<?php echo $reponse['trailer_1'];?>	
					</td>
					<td>
						<?php echo $reponse['trailer_2'];?>	
					</td>
					<td>
						<?php echo $reponse['num_lic'];?>	
					</td>
					<td>
						<?php echo $reponse['num_exo'];?>	
					</td>
					<td>
						<?php echo $reponse['crossing_date'];?>	
					</td>
					<td>
						<?php echo $reponse['arrival_date'];?>	
					</td>
					<td>
						<?php echo $reponse['wiski_arriv'];?>	
					</td>
					<td>
						<?php echo $reponse['wiski_dep'];?>	
					</td>
					<td>
						<?php echo $reponse['amicongo_arriv'];?>	
					</td>
					<td>
						<?php echo $reponse['insp_report'];?>	
					</td>
					<td>
						<?php echo $reponse['ir'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_crf'];?>	
					</td>
					<td>
						<?php echo $reponse['date_crf'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_decl'];?>	
					</td>
					<td>
						<?php echo $reponse['dgda_in'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_liq'];?>	
					</td>
					<td>
						<?php echo $reponse['date_liq'];?>	
					</td>
					<td>
						<?php echo $reponse['ref_quit'];?>	
					</td>
					<td>
						<?php echo $reponse['date_quit'];?>	
					</td>
					<td>
						<?php echo $reponse['dgda_out'];?>	
					</td>
					<td>
						<?php echo $reponse['custom_deliv'];?>	
					</td>
					<td>
						<?php echo $reponse['dispatch_deliv'];?>	
					</td>
					<td>
						<?php echo $reponse['statut'];?>	
					</td>
					<td>
						<?php echo $reponse['remarque'];?>	
					</td>
					<td style="text-align: center;">
						<button class="btn btn-danger" type="submit" name="deleteDossierUpload">
							<i class="fa fa-times"></i>
						</button>
					</td>
				</tr>
			</form>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherManipulationLicence($id_mod_lic, $id_cli, $id_type_lic){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;

			$sql = "";
			$sql2 = "";

			$nbre_dossier = 0;
			$num_lic = '';
			$active_rowspan = 1;
			
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND cl.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$compteur = 0;
			
			if($_SESSION['id_role'] == 1 || $_SESSION['id_role'] == 5){
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							l.fret AS fret,
							l.acheteur AS acheteur,
							l.assurance AS assurance,
							l.autre_frais AS autre_frais,
							l.fsi AS fsi,
							l.aur AS aur,
							UPPER(cl.nom_cli) AS nom_cli,
							l.fournisseur AS fournisseur,
							DATE(CURRENT_DATE()) AS aujourdhui,
							UPPER(b.nom_banq) AS nom_banq,
							l.ref_fact AS ref_fact,
							l.remarque AS remarque,
							DATE_FORMAT(l.date_fact, '%d/%m/%Y') AS date_fact,
							d.ref_dos AS ref_dos,
							d.id_dos AS id_dos,
							d.fob AS fob_dos,
							d.fret AS fret_dos,
							d.assurance AS assurance_dos,
							d.autre_frais AS autre_frais_dos,
							d.ref_fact AS ref_fact_dos,
							d.date_fact AS date_fact_dos,
							d.ref_decl AS ref_decl,
							d.ref_liq AS ref_liq,
							d.ref_quit AS ref_quit,
							d.montant_decl AS montant_decl,
							d.cod AS cod_dos,
							d.fxi AS fxi,
							l.commodity AS commodityLic,
							d.montant_av AS montant_av,
							d.remarque_lic AS remarque_lic,
							DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit					
						FROM licence l, monnaie m, client cl, banque b, dossier d
						WHERE l.id_mod_lic = ?
							AND l.id_cli = cl.id_cli
							$sql
							$sql2
							AND l.id_mon = m.id_mon
							AND l.id_banq = b.id_banq
							AND l.num_lic = d.num_lic
						ORDER BY l.date_val, l.num_lic DESC";
			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$nbre_dossier = $this-> getNbreDossierLicence($reponse['num_lic']);
				if ($num_lic != $reponse['num_lic']) {
					$num_lic = $reponse['num_lic'];
					$active_rowspan = 1;
				}
				$num_lic = $reponse['num_lic'];
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				$couleur = "";
				
				$style = '';//" style='color: black; background-color: orange;'";
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$bg = "bg-dark";
					$style = " style=''";
					$couleur = "dark";
				}else if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
					$bg = "bg-success";
					$style = " style=''";
					$couleur = "success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
					$bg = "bg-warning";
					$style = " style=''";
					$couleur = "warning";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
					$bg = "bg-danger";
					$style = " style=''";
					$couleur = "danger";
				} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
					$bg = "bg-info";
					$style = " style=''";
					$couleur = "info";
				}
				
			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style=" border-right: 1px solid black;vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<?php

					if ( ($nbre_dossier > 1) && ($num_lic == $reponse['num_lic']) && ($active_rowspan == 1) ) {
						$active_rowspan = 0;
					?>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: left; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['commodityLic'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['num_lic'];?>
					</td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fret'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['assurance'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['autre_frais'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fsi'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['aur'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
					}elseif ( ($nbre_dossier <= 1) && ($num_lic == $reponse['num_lic']) && ($active_rowspan == 1) ){
					?>
					<td style="text-align: left; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $marchandise;?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['num_lic'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['autre_frais'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fsi'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['aur'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php

					}

					?>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 12em;" type="text" name="cod_<?php echo $compteur;?>" value="<?php echo $reponse['cod_dos'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 10em;" type="text" name="fxi_<?php echo $compteur;?>" value="<?php echo $reponse['fxi'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 8em;" type="number" step="0.01" min="0" name="montant_av_<?php echo $compteur;?>" value="<?php echo $reponse['montant_av'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_fact_dos'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact_dos'];?></td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob_dos'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 8em; text-align: right;" type="number" step="0.01" min="0" name="fret_dos_<?php echo $compteur;?>" value="<?php echo $reponse['fret_dos'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 8em; text-align: right;" type="number" step="0.01" min="0" name="assurance_dos_<?php echo $compteur;?>" value="<?php echo $reponse['assurance_dos'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input style="width: 8em; text-align: right;" type="number" step="0.01" min="0" name="autre_frais_dos_<?php echo $compteur;?>" value="<?php echo $reponse['autre_frais_dos'];?>">
					</td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob_dos']+$reponse['fret_dos']+$reponse['assurance_dos']+$reponse['autre_frais_dos'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_decl'];?></td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['montant_decl'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_liq'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_quit'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_quit'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<input type="text" name="remarque_lic_<?php echo $compteur;?>" value="<?php echo $reponse['remarque_lic'];?>">
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<a title="Dossiers affectés" href="#" style="color: black;" onclick="window.open('popUpDossierLicence.php?num_lic=<?php echo $reponse['num_lic'];?>&couleur=<?php echo $couleur;?>','pop1','width=1000,height=900');">
							<i class="fa fa-folder-open"></i>
						</a>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php

			}

		}

		public function afficherManipulationLicenceExcel($id_mod_lic, $id_cli, $id_type_lic){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;

			$sql = "";
			$sql2 = "";

			$nbre_dossier = 0;
			$num_lic = '';
			$active_rowspan = 1;
			
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND cl.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$compteur = 0;
			
			if($_SESSION['id_role'] == 1 || $_SESSION['id_role'] == 5){
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							l.fret AS fret,
							l.acheteur AS acheteur,
							l.assurance AS assurance,
							l.autre_frais AS autre_frais,
							l.fsi AS fsi,
							l.aur AS aur,
							UPPER(cl.nom_cli) AS nom_cli,
							l.fournisseur AS fournisseur,
							DATE(CURRENT_DATE()) AS aujourdhui,
							UPPER(b.nom_banq) AS nom_banq,
							l.ref_fact AS ref_fact,
							l.remarque AS remarque,
							DATE_FORMAT(l.date_fact, '%d/%m/%Y') AS date_fact,
							d.ref_dos AS ref_dos,
							d.id_dos AS id_dos,
							d.fob AS fob_dos,
							d.fret AS fret_dos,
							d.assurance AS assurance_dos,
							d.autre_frais AS autre_frais_dos,
							d.ref_fact AS ref_fact_dos,
							d.date_fact AS date_fact_dos,
							d.ref_decl AS ref_decl,
							d.ref_liq AS ref_liq,
							d.ref_quit AS ref_quit,
							d.montant_decl AS montant_decl,
							d.cod AS cod_dos,
							d.fxi AS fxi,
							l.commodity AS commodityLic,
							d.montant_av AS montant_av,
							d.remarque_lic AS remarque_lic,
							DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit					
						FROM licence l, monnaie m, client cl, banque b, dossier d
						WHERE l.id_mod_lic = ?
							AND l.id_cli = cl.id_cli
							$sql
							$sql2
							AND l.id_mon = m.id_mon
							AND l.id_banq = b.id_banq
							AND l.num_lic = d.num_lic
						ORDER BY l.date_val, l.num_lic DESC";
			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$nbre_dossier = $this-> getNbreDossierLicence($reponse['num_lic']);
				if ($num_lic != $reponse['num_lic']) {
					$num_lic = $reponse['num_lic'];
					$active_rowspan = 1;
				}
				$num_lic = $reponse['num_lic'];
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				$couleur = "";
				
				$style = '';//" style='color: black; background-color: orange;'";
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$bg = "bg-dark";
					$style = " style='color: grey;'";
					$couleur = "dark";
				}else if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
					$bg = "bg-success";
					$style = " style='color: green;'";
					$couleur = "success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
					$style = " style='color: red;'";
					$couleur = "danger";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
					$bg = "bg-warning";
					$style = " style='color: orange;'";
					$couleur = "warning";
				}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
					$bg = "bg-danger";
					$style = " style='color: red;'";
					$couleur = "danger";
				} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
					$bg = "bg-info";
					$style = " style='color: blue;'";
					$couleur = "info";
				}
				
			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style=" border-right: 1px solid black;vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<?php

					if ( ($nbre_dossier > 1) && ($num_lic == $reponse['num_lic']) && ($active_rowspan == 1) ) {
						$active_rowspan = 0;
					?>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: left; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['commodityLic'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['num_lic'];?>
					</td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fret'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['assurance'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['autre_frais'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais'], 2, ',', ' ');?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fsi'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['aur'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td rowspan="<?php echo $nbre_dossier;?>" style="vertical-align: middle; text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
					}elseif ( ($nbre_dossier <= 1) && ($num_lic == $reponse['num_lic']) && ($active_rowspan == 1) ){
					?>
					<td style="text-align: left; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $marchandise;?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['num_lic'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['autre_frais'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob']+$reponse['fret']+$reponse['assurance']+$reponse['autre_frais'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['fsi'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['aur'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php

					}

					?>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['cod_dos'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['fxi'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['montant_av'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_fact_dos'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_fact_dos'];?></td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob_dos'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['fret_dos'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['assurance_dos'];?>
					</td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['autre_frais_dos'];?>
					</td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['fob_dos']+$reponse['fret_dos']+$reponse['assurance_dos']+$reponse['autre_frais_dos'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_decl'];?></td>
					<td style="text-align: right; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo number_format($reponse['montant_decl'], 2, ',', ' ');?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_liq'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['ref_quit'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;"><?php echo $reponse['date_quit'];?></td>
					<td style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">
						<?php echo $reponse['remarque_lic'];?>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();

			}

		}

		public function afficherLicenceApresRecherche($num_lic, $id_mod_lic){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['num_lic'] = '%'.$num_lic.'%';

			if($_SESSION['id_role'] == '4'){
				$client = $this-> getClientUtilisateur($_SESSION['id_util']);
				$id_cli = $client['id_cli'];
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							UPPER(cl.nom_cli) AS nom_cli,
							l.fournisseur AS fournisseur,
							l.assurance AS assurance,
							l.fret AS fret,
							l.acheteur AS acheteur,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							DATE(CURRENT_DATE()) AS aujourdhui
						FROM licence l, monnaie m, client cl
						WHERE l.num_lic LIKE ?
							AND l.id_mod_lic = ?
							AND l.id_mon = m.id_mon
							AND l.id_cli = cl.id_cli
							AND cl.id_cli = $id_cli";
			}else{
				$sql = "SELECT l.num_lic AS num_lic,
							DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
							l.fob AS fob,
							UPPER(cl.nom_cli) AS nom_cli,
							l.fournisseur AS fournisseur,
							l.assurance AS assurance,
							l.fret AS fret,
							l.acheteur AS acheteur,
							m.sig_mon AS sig_mon,
							l.qte_decl AS qte_decl,
							l.fichier_lic AS fichier_lic,
							DATE(CURRENT_DATE()) AS aujourdhui
						FROM licence l, monnaie m, client cl
						WHERE l.num_lic LIKE ?
							AND l.id_mod_lic = ?
							AND l.id_mon = m.id_mon
							AND l.id_cli = cl.id_cli";
			}

			$compteur = 0;

			$requete = $connexion-> prepare($sql);
			$requete-> execute(array($entree['num_lic'], $entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-info";
				if( ($date_exp >= $reponse['aujourdhui']) ){
					$bg = "bg-success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
				} 
				
			?>
				<tr class="<?php echo $bg;?>" style="">
					<td class="col_1 <?php echo $bg;?>" style=" text-align: left; border: 1px solid black;"><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style="text-align: left; border: 1px solid black;"><?php echo $reponse['num_lic'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['acheteur'];?></td>
					<?php
				}
				if($id_mod_lic == '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<?php
				}
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<?php
				}
				if($id_mod_lic != '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $marchandise;?></td>
					<?php
				}
				?>
					<td style="text-align: right;border: 1px solid black;"><?php echo number_format( $reponse['fob'], 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']+$reponse['assurance']+$reponse['fret']), 2, ',', ' ');?></td>
					<?php
				}
				?>
				<?php
				if($id_mod_lic == '1'){
				?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php //echo number_format( $reponse['qte_decl'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']*0.6), 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']*0.002), 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
					<?php
					}
				?>
					<td style="text-align: center; border: 1px solid black;">
						<a href="#" style="color: black;" onclick="window.open('../dossiers/<?php echo $reponse['num_lic'];?>/<?php echo $reponse['fichier_lic'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</a>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherFactureLicenceModele($id_mod_lic, $id_cli){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$compteur = 0;
			$bg = '';

			$requete = $connexion-> prepare("SELECT f.ref_fact AS ref_fact,
										DATE_FORMAT(f.date_fact, '%d/%m/%Y') AS date_fact,
										DATE_FORMAT(f.date_fact_rec, '%d/%m/%Y') AS date_fact_rec,
										f.date_fact_rec AS date_fact_rec2,
										DATE_FORMAT(f.date_val, '%d/%m/%Y') AS date_val,
										UPPER(cl.nom_cli) AS nom_cli,
										f.fournisseur AS fournisseur,
										f.fichier_fact AS fichier_fact,
										DATE(CURRENT_DATE()) AS aujourdhui,
										f.commodity AS commodity,
										m.sig_mon AS sig_mon,
										f.montant_fact AS montant_fact,
										f.fret_fact AS fret_fact,
										f.assurance_fact AS assurance_fact,
										f.autre_frais_fact AS autre_frais_fact
									FROM facture_licence f, client cl, monnaie m
									WHERE f.id_mod_lic = ?
										AND f.id_cli = cl.id_cli
										AND f.id_mon = m.id_mon");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = '';
				if ( $this-> getLicenceFacture($reponse['ref_fact']) != null ) {
					$bg = "bg bg-success";
				}else if ( $this-> getDifferenceDate($reponse['aujourdhui'], $reponse['date_fact_rec2']) >= '2' ) {
					$bg = "bg bg-danger";
				}
			?>
				<tr class="<?php echo $bg;?>" style="">
					<td class="" style=" text-align: left; border: 1px solid black;"><?php echo $compteur;?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['ref_fact'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['date_fact'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['date_fact_rec']?></td>
					<td class="" style="text-align: center; border: 1px solid black;"><?php echo $this-> getDifferenceDate($reponse['aujourdhui'], $reponse['date_fact_rec2']);?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;">
						<?php echo $reponse['date_val'];?>
					</td>
					<td class="" style="text-align: center; border: 1px solid black;">
						<?php echo $reponse['sig_mon'];?>
					</td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format($reponse['montant_fact'], 2, ',', ' ');?>
					</td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format($reponse['fret_fact'], 2, ',', ' ');?>
					</td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format($reponse['assurance_fact'], 2, ',', ' ');?>
					</td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format($reponse['autre_frais_fact'], 2, ',', ' ');?>
					</td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format($reponse['montant_fact']+$reponse['fret_fact']+$reponse['assurance_fact']+$reponse['assurance_fact'], 2, ',', ' ');?>
					</td>
					<td style="text-align: center; border: 1px solid black; background-color: white;">
						<button class="btn btn-default" onclick="window.open('../factures/<?php echo $reponse['ref_fact'];?>/<?php echo $reponse['fichier_fact'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</button>
					</td>
					<td style="background-color: white; border: 1px solid black;">
						<form method="POST" action="">
							<input type="hidden" name="ref_fact_old" value="<?php echo $reponse['ref_fact'];?>">
							<center>
								<button class="btn btn-warning" type="submit" name="modifier">
									<i class="fa fa-edit"></i>
								</button>
							</center>
						</form>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherAV($id_mod_lic, $id_cli){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$compteur = 0;
			$bg = '';

			$requete = $connexion-> prepare("SELECT a.cod AS cod, DATE_FORMAT(a.date_av, '%d/%m/%Y') AS date_av,
													a.fxi AS fxi, a.montant_av AS montant_av, 
													a.fichier_av AS fichier_av, m.sig_mon AS sig_mon,
													a.num_lic AS num_lic
												FROM av a, monnaie m
												WHERE a.id_mon = m.id_mon
												ORDER BY a.date_creat DESC");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = '';
				/*if ( $this-> getLicenceFacture($reponse['ref_fact']) != null ) {
					$bg = "bg bg-success";
				}else if ( $this-> getDifferenceDate($reponse['aujourdhui'], $reponse['date_fact_rec2']) >= '2' ) {
					$bg = "bg bg-danger";
				}*/
			?>
				<tr class="<?php echo $bg;?>" style="">
					<td class="" style=" text-align: left; border: 1px solid black;"><?php echo $compteur;?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['num_lic'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['cod'];?></td>
					<td class="" style="text-align: center; border: 1px solid black;"><?php echo $reponse['date_av'];?></td>
					<td class="" style="text-align: left; border: 1px solid black;"><?php echo $reponse['fxi']?></td>
					<td class="" style="text-align: right; border: 1px solid black;">
						<?php echo number_format( $reponse['montant_av'], 2, ',', ' ');;?>
					</td>
					<td class="" style="text-align: center; border: 1px solid black;"><?php echo $reponse['sig_mon'];?></td>
					<td style="text-align: center; border: 1px solid black;">
						<a href="#" style="color: black;" onclick="window.open('../av/<?php echo $reponse['fichier_av'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</a>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherLicenceApresRechercheClient($id_cli, $id_mod_lic){
			include("connexion.php");
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;

			$compteur = 0;

			$requete = $connexion-> prepare("SELECT l.num_lic AS num_lic,
													DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
													l.fob AS fob,
													l.assurance AS assurance,
													l.fret AS fret,
													UPPER(cl.nom_cli) AS nom_cli,
													l.fournisseur AS fournisseur,
													m.sig_mon AS sig_mon,
													l.qte_decl AS qte_decl,
													l.acheteur AS acheteur,
													l.fichier_lic AS fichier_lic,
													DATE(CURRENT_DATE()) AS aujourdhui
												FROM licence l, monnaie m, client cl
												WHERE l.id_cli = ?
													AND l.id_mod_lic = ?
													AND l.id_mon = m.id_mon
													AND l.id_cli = cl.id_cli");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
				$compteur++;
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				
				$bg = "bg-info";
				if( ($date_exp >= $reponse['aujourdhui']) ){
					$bg = "bg-success";
				}else if($date_exp < $reponse['aujourdhui']){
					$bg = "bg-danger";
				} 
				
			?>
				<tr class="<?php echo $bg;?>" style="">
					<td class="col_1 <?php echo $bg;?>" style=" text-align: left; border: 1px solid black;"><?php echo $compteur;?></td>
					<td class="col_6 <?php echo $bg;?>" style="text-align: left; border: 1px solid black;"><?php echo $reponse['num_lic'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $reponse['date_val'];?></td>
					<td style="text-align: center; border: 1px solid black;"><?php echo $this-> getLastEpirationLicence($reponse['num_lic']);?></td>
					<?php
				if($id_mod_lic == '1'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['acheteur'];?></td>
					<?php
				}
				if($id_mod_lic == '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<?php
				}
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<td style="text-align: left; border: 1px solid black;"><?php echo $reponse['fournisseur'];?></td>
					<?php
				}
				if($id_mod_lic != '3'){
					?>
					<td style="text-align: left; border: 1px solid black;"><?php echo $marchandise;?></td>
					<?php
				}
				?>
					<td style="text-align: right;border: 1px solid black;"><?php echo number_format( $reponse['fob'], 2, ',', ' ').' '.$reponse['sig_mon'];?></td>
				<?php
				if($id_mod_lic == '2'){
					?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['assurance'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['fret'], 2, ',', ' ');?></td>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( ($reponse['fob']+$reponse['assurance']+$reponse['fret']), 2, ',', ' ');?></td>
					<?php
				}
				?>
				<?php
				if($id_mod_lic == '1'){
				?>
					<td style="text-align: right; border: 1px solid black;"><?php echo number_format( $reponse['qte_decl'], 2, ',', ' ');?></td>
					<?php
					}
				?>
					<td style="text-align: center; border: 1px solid black;">
						<a href="#" style="color: black;" onclick="window.open('../dossiers/<?php echo $reponse['num_lic'];?>/<?php echo $reponse['fichier_lic'];?>','pop1','width=700,height=900');">
							<i class="fa fa-file"></i>
						</a>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossier($id_march, $id_cli, $id_mod_trans){
			include('connexion.php');

			$entree['id_march'] = $id_march;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND cl.id_cli = '.$id_cli;
			} 
			if( ($id_mod_trans != null) && ($id_mod_trans != '')){
				$sql2 = ' AND d.id_mod_trans = '.$id_mod_trans;
			} 

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													l.fournisseur AS fournisseur,
													l.num_lic AS num_lic,
													l.fob AS fob,
													l.tonnage AS tonnage,
													UPPER(m.nom_march) AS nom_march,
													s.nom_site AS nom_site
												FROM dossier d, client cl, marchandise m, licence l, site s
												WHERE d.id_march = ?
													AND d.id_march =  m.id_march
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													$sql2
													$sql
													AND d.id_cli =  cl.id_cli
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_march']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "bg-light";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<?php
						if ($this-> getStructureTracking($id_march) == '1') {
							include('acidRow.php');
						}else if ($this-> getStructureTracking($id_march) == '2') {
							include('diversRow.php');
						}
					?>
					<td class=" <?php echo $bg;?>" style="border: 1px solid black;">
						<select name="cleared_<?php echo $compteur;?>" class="control-form">
							<?php 
							if ($reponse['cleared'] == '1') {
							?>
							<option>CLEARED</option>
							<option value="0">TRANSIT</option>
							<option value="2">CANCELED</option>
							<?php
							}if ($reponse['cleared'] == '2') {
							?>
							<option>CANCELED</option>
							<option value="1">CLEARED</option>
							<option value="0">TRANSIT</option>
							<?php
							}if ($reponse['cleared'] == '0') {
							?>
							<option>TRANSIT</option>
							<option value="1">CLEARED</option>
							<option value="2">CANCELED</option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}

		public function afficherDossierClientModeTransportModeLicence($id_cli, $id_mod_trans, $id_mod_lic, $num_lic, $premiere_entree, $nombre_dossier_par_page){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													l.fournisseur AS fournisseur,
													l.num_lic AS num_lic,
													l.commodity AS commodity,
													l.fob AS fob,
													l.tonnage AS tonnage,
													s.nom_site AS nom_site
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND l.num_lic = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
												ORDER BY d.id_dos DESC
												LIMIT $premiere_entree, $nombre_dossier_par_page");
			$requete-> execute(array($entree['id_cli'], $entree['num_lic'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "bg-light";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['nom_cli'];?></td>
					<?php
						if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}
					?>
					<td class=" <?php echo $bg;?>" style="border: 1px solid black;">
						<select name="cleared_<?php echo $compteur;?>" class="control-form">
							<?php 
							if ($reponse['cleared'] == '1') {
							?>
							<option>CLEARED</option>
							<option value="0">TRANSIT</option>
							<option value="2">CANCELED</option>
							<?php
							}if ($reponse['cleared'] == '2') {
							?>
							<option>CANCELED</option>
							<option value="1">CLEARED</option>
							<option value="0">TRANSIT</option>
							<?php
							}if ($reponse['cleared'] == '0') {
							?>
							<option>TRANSIT</option>
							<option value="1">CLEARED</option>
							<option value="2">CANCELED</option>
							<?php
							}
							?>
						</select>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}

		public function afficherDossierClientModeTransportModeLicence2($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, 
														$premiere_entree, $nombre_dossier_par_page){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													l.num_lic AS num_lic,
													l.fournisseur AS fournisseur,
													l.fob AS fob,
													l.tonnage AS tonnage,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND ((d.date_quit IS NULL AND d.ref_quit IS NULL) 
														OR (d.date_quit = '' OR d.ref_quit = ''))
													$sql1
												ORDER BY d.ref_dos DESC
												LIMIT $premiere_entree, $nombre_dossier_par_page");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<?php
						if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRow.php');
						}
					?>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}

		public function afficherRowDossierClientModeTransportModeLicence2($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, 
														$premiere_entree, $nombre_dossier_par_page){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
												ORDER BY d.ref_dos DESC
												LIMIT $premiere_entree, $nombre_dossier_par_page");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				//$reponse = $this-> getLicence($reponse['num_lic']);

				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<?php
					$this-> afficherRowTableau($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur);
						/*if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRow.php');
						}*/
					?>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}

		public function afficherRowDossierClientModeTransportModeLicenceDashboard($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, 
														$premiere_entree, $nombre_dossier_par_page, $type){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			$sql1 = "";
			$sqlClient = "";
			$sqlType = "";

			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			if (isset($id_cli) && ($id_cli != '')) {
				$sql1 = ' AND d.id_cli = "'.$id_cli.'"';
			}

			if (isset($type) && ($type == 'TOTAL FILES')) {
				$sqlType = '';
			}

			if (isset($type) && ($type == 'CLEARING COMPLETED')) {
				$sqlType = " AND d.cleared = '1'";
			}

			if (isset($type) && ($type == 'FILES IN PROCESS')) {
				$sqlType = " AND d.cleared = '0'";
			}

			if (isset($type) && ($type == 'CANCELLED')) {
				$sqlType = " AND d.cleared = '2'";
			}

			if (isset($type) && ($type == 'KASUMBALESA')) {
				$sqlType = " AND DATE(d.arrival_date) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'WISKI ARRIVAL')) {
				$sqlType = " AND DATE(d.wiski_arriv) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT WISKI')) {
				$sqlType = " AND (d.wiski_arriv IS NOT NULL AND d.wiski_arriv <> '')
												AND (d.wiski_dep IS NULL OR d.wiski_dep = '')";
			}

			if (isset($type) && ($type == 'WISKI DEPARTURE')) {
				$sqlType = " AND DATE(d.wiski_dep) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'AWAIT CRF')) {
				$sqlType = " AND (d.wiski_dep IS NOT NULL AND d.wiski_dep <> '')
												AND ( (d.date_crf IS NULL OR d.date_crf = '') AND (d.ref_crf IS NULL OR d.ref_crf = '' ))";
			}

			if (isset($type) && ($type == 'DGDA IN')) {
				$sqlType = " AND DATE(d.dgda_in) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT DGDA')) {
				$sqlType = " AND (d.dgda_in IS NOT NULL AND d.dgda_in <> '')
												AND (d.dgda_out IS NULL OR d.dgda_out = '')";
			}

			if (isset($type) && ($type == 'LIQUIDATED / AWAIT QUITTANCE')) {
				$sqlType = " AND ( (d.date_liq IS NOT NULL OR d.date_liq <> '')
													OR (d.ref_liq IS NOT NULL AND d.ref_liq <> '') )
												AND ( (d.date_quit IS NULL OR d.date_quit = '') 
													OR (d.ref_quit IS NULL OR d.ref_quit = '') )";
			}

			if (isset($type) && ($type == 'QUITTANCE')) {
				$sqlType = " AND DATE(d.date_quit) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'DGDA OUT')) {
				$sqlType = " AND DATE(d.dgda_out) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'FILES CLEARED WAITING INVOICE')) {
				$sqlType = " AND d.cleared = '1'
												AND d.facture = '0'";
			}

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
													$sqlClient
													$sqlType
												ORDER BY d.ref_dos DESC
												LIMIT $premiere_entree, $nombre_dossier_par_page");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<?php
					$this-> afficherRowTableau($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur);
						/*if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRow.php');
						}*/
					?>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}

		public function afficherRowDossierClientModeTransportModeLicenceExcel($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr>
					<td  style="border: 0.5px solid black; text-align: right;"><?php echo $compteur;?></td>
					<td style="border: 0.5px solid black; text-align: center;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<?php
					$this-> afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur);
						/*if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRow.php');
						}*/
					?>
				</tr>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossierClientModeTransportModeLicenceExcel($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													l.num_lic AS num_lic,
													l.fournisseur AS fournisseur,
													l.fob AS fob,
													l.tonnage AS tonnage,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 0.5px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 0.5px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 0.5px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 0.5px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<td class=" <?php echo $bg;?>" style="border: 0.5px solid black;"><?php echo $reponse['mca_num'];?></td>
					<?php
						if ($id_mod_trans == '1') {
							include('importRouteRowExcel.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRowExcel.php');
						}
					?>
				</tr>
			<?php
			}$requete-> closeCursor();

		}

		public function afficherDossierLicence($num_lic){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT d.*
												FROM dossier d, client cl
												WHERE d.num_lic = ?
													AND d.id_cli =  cl.id_cli");
			$requete-> execute(array($entree['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="<?php echo $bg;?>" style=" " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['cod'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['montant_av'], 2, ',', ' ');?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['fob'], 2, ',', ' ');?>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
				<tr>
					<td class="<?php echo $bg;?>" colspan='7' style="text-align: right;" <?php echo $style;?>>
						TOTAL
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($sommeFob, 2, ',', ' ');?>
					</td>
				</tr>
			<?php
		}

		public function afficherDossierPopUp($id_cli, $id_mod_trans, 
											$id_mod_lic, $commodity, $type,
											$premiere_entree, $nombre_dossier_par_page){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			$sqlClient = "";
			$sqlType = "";

			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			if (isset($id_cli) && ($id_cli != '')) {
				$sql1 = ' AND d.id_cli = "'.$id_cli.'"';
			}

			if (isset($type) && ($type == 'TOTAL FILES')) {
				$sqlType = '';
			}

			if (isset($type) && ($type == 'CLEARING COMPLETED')) {
				$sqlType = " AND d.cleared = '1'";
			}

			if (isset($type) && ($type == 'FILES IN PROCESS')) {
				$sqlType = " AND d.cleared = '0'";
			}

			if (isset($type) && ($type == 'CANCELLED')) {
				$sqlType = " AND d.cleared = '2'";
			}

			if (isset($type) && ($type == 'KASUMBALESA')) {
				$sqlType = " AND DATE(d.arrival_date) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'WISKI ARRIVAL')) {
				$sqlType = " AND DATE(d.wiski_arriv) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT WISKI')) {
				$sqlType = " AND (d.wiski_arriv IS NOT NULL AND d.wiski_arriv <> '')
												AND (d.wiski_dep IS NULL OR d.wiski_dep = '')";
			}

			if (isset($type) && ($type == 'WISKI DEPARTURE')) {
				$sqlType = " AND DATE(d.wiski_dep) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'AWAIT CRF')) {
				$sqlType = " AND (d.wiski_dep IS NOT NULL AND d.wiski_dep <> '')
												AND ( (d.date_crf IS NULL OR d.date_crf = '') AND (d.ref_crf IS NULL OR d.ref_crf = '' ))";
			}

			if (isset($type) && ($type == 'DGDA IN')) {
				$sqlType = " AND DATE(d.dgda_in) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT DGDA')) {
				$sqlType = " AND (d.dgda_in IS NOT NULL AND d.dgda_in <> '')
												AND (d.dgda_out IS NULL OR d.dgda_out = '')";
			}

			if (isset($type) && ($type == 'LIQUIDATED / AWAIT QUITTANCE')) {
				$sqlType = " AND ( (d.date_liq IS NOT NULL OR d.date_liq <> '')
													OR (d.ref_liq IS NOT NULL AND d.ref_liq <> '') )
												AND ( (d.date_quit IS NULL OR d.date_quit = '') 
													OR (d.ref_quit IS NULL OR d.ref_quit = '') )";
			}

			if (isset($type) && ($type == 'QUITTANCE')) {
				$sqlType = " AND DATE(d.date_quit) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'DGDA OUT')) {
				$sqlType = " AND DATE(d.dgda_out) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'FILES CLEARED WAITING INVOICE')) {
				$sqlType = " AND d.cleared = '1'
												AND d.facture = '0'";
			}

			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													l.num_lic AS num_lic,
													l.fournisseur AS fournisseur,
													l.fob AS fob,
													l.tonnage AS tonnage,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
													$sqlClient
													$sqlType
												ORDER BY d.ref_dos DESC
												LIMIT $premiere_entree, $nombre_dossier_par_page");
			$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				$date_exp = $this-> getLastEpirationLicence($reponse['num_lic']);
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="bg-light col_1 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;" <?php echo $style;?>><?php echo $compteur;?></td>
					<td class="bg-light col_6 <?php echo $bg;?>" style=" border-right: 1px solid black; vertical-align: middle; text-align: left; padding: 0.6rem; border-top: 1px solid black;"><?php echo $reponse['ref_dos'];?></td>
					<!--<td class=" <?php echo $bg;?>" style="border: 1px solid black;"><?php echo $reponse['mca_num'];?></td>-->
					<?php
						if ($id_mod_trans == '1') {
							include('importRouteRow.php');
						}else if ($id_mod_trans == '3') {
							include('importAirRow.php');
						}
					?>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
			<tr>
				<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
				<td class="col_1">
					<button type="submit" class="btn btn-success" name="update">
						Mettre à jour
					</button>
				</td>
			</tr>
			<?php
		}


		public function afficherDossierPopUpExcel($id_mod_lic, $type, $id_cli, $id_type_lic){
			include('connexion.php');
/*
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			if ($type == 'EN ATTENTE FACTURATION') {

				$requete = $connexion-> prepare("SELECT d.*,
													UPPER(m.nom_march) AS nom_march,
													UPPER(cl.nom_cli) AS nom_cli
												FROM dossier d, client cl, marchandise m
												WHERE d.id_mod_lic = ?
													AND d.id_march =  m.id_march
													AND d.id_cli =  cl.id_cli
													AND d.cleared = '1'
													AND d.facture = '0'");

			}
			
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<td class="<?php echo $bg;?>" style="border: 0.5px solid black; " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; border: 0.5px solid black;">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['mca_b_ref'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['nom_cli'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['nom_march'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; border: 0.5px solid black;">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; border: 0.5px solid black;">
						<?php echo $reponse['fob'];?>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			
			*/
		}

		public function afficherLicencePopUp($id_mod_lic, $type, $id_cli, $id_type_lic){
			include('connexion.php');

			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND l.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT l.num_lic AS num_lic, 
													DATE(CURRENT_DATE()) AS aujourdhui, 
													l.fob AS fob,
													(l.fob+l.fret+l.assurance+l.autre_frais) AS cif,
													UPPER(cl.nom_cli) AS nom_cli,
													mo.sig_mon AS sig_mon,
													DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val
												FROM licence l, client cl, monnaie mo
												WHERE l.id_mod_lic = ?
													AND l.id_cli = cl.id_cli
													AND l.id_mon = mo.id_mon
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				$date_exp2 = $this-> getLastEpirationLicence($reponse['num_lic']);
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				if ($type == 'EN COURS') {

					if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'EXTREME VALIDATION -40 JOURS') {

					if(($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) <= 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'EXPIRES') {

					if(($date_exp < $reponse['aujourdhui']) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'APPUREES TRACKING ATTENTE BANQUE') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'APPUREES PAR BANQUE') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] == $this-> getSommeFobAppureLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'CIF LICENCE DIFFERENT CIF DOSSIER(S)') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['cif'] != $this-> getSommeCIFLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo number_format( $reponse['fob'], 2, ',', ' ');?>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo number_format($this->getNbreDossierLicence($reponse['num_lic']), 0, ',', ' ');?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo number_format($this->getSommeFobLicence($reponse['num_lic']), 2, ',', ' ');?>
	                    	</td>
						</tr>
						<?php
					}

				}

			?>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherLicencePopUpExcel($id_mod_lic, $type, $id_cli, $id_type_lic){
			include('connexion.php');

			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND l.id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND l.id_type_lic = '.$id_type_lic;
			}

			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT l.num_lic AS num_lic, 
													DATE(CURRENT_DATE()) AS aujourdhui, 
													l.fob AS fob,
													(l.fob+l.fret+l.assurance+l.autre_frais) AS cif,
													UPPER(cl.nom_cli) AS nom_cli,
													mo.sig_mon AS sig_mon,
													DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val
												FROM licence l, client cl, monnaie mo
												WHERE l.id_mod_lic = ?
													AND l.id_cli = cl.id_cli
													AND l.id_mon = mo.id_mon
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				$date_exp2 = $this-> getLastEpirationLicence($reponse['num_lic']);
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				if ($type == 'EN COURS') {

					if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'EXTREME VALIDATION -40 JOURS') {

					if(($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) <= 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'EXPIRES') {

					if(($date_exp < $reponse['aujourdhui']) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'APPUREES TRACKING ATTENTE BANQUE') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'APPUREES PAR BANQUE') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] == $this-> getSommeFobAppureLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}else if ($type == 'CIF LICENCE DIFFERENT CIF DOSSIER(S)') {

					if(($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['cif'] != $this-> getSommeCIFLicence($reponse['num_lic']))){
						$compteur++;
						?>
						<tr>	
							<td class="<?php echo $bg;?>" style=" text-align: left;" <?php echo $style;?>><?php echo $compteur;?></td>
							<td class="<?php echo $bg;?>" style="text-align: left;"><?php echo $reponse['num_lic'];?></td>
							<td style="text-align: left;"><?php echo $reponse['nom_cli'];?></td>
							<td style="text-align: center;"><?php echo $reponse['date_val'];?></td>
							<td style="text-align: center;"><?php echo $date_exp2;?></td>
							<td style="text-align: center;"><?php echo $reponse['sig_mon'];?></td>
							<td style="text-align: right;"><?php echo  $reponse['fob'];?></td>
	                    	<td style="text-align: right;">
	                    		<?php echo $reponse['fob']-$this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: center;">
	                    		<?php echo $this->getNbreDossierLicence($reponse['num_lic']);?>
	                    	</td>
	                    	<td style="text-align: right;">
	                    		<?php echo $this->getSommeFobLicence($reponse['num_lic']);?>
	                    	</td>
						</tr>
						<?php
					}

				}

			?>
			<?php
			}$requete-> closeCursor();
		}

		public function afficherDossierLicencePretAppurement($num_lic){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT d.*
												FROM dossier d, client cl
												WHERE d.num_lic = ?
													AND d.id_cli =  cl.id_cli
													AND (d.ref_decl IS NOT NULL
														AND d.ref_liq IS NOT NULL
														AND d.ref_quit IS NOT NULL)
													AND d.id_dos NOT IN(
															SELECT id_dos FROM appurement_licence
														)");
			$requete-> execute(array($entree['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
					<td class="<?php echo $bg;?>" style=" " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['cod'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['montant_av'], 2, ',', ' ');?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['fob'], 2, ',', ' ');?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<input type="checkbox" name="check_<?php echo $compteur;?>">
						<?php //echo $reponse['ref_quit'];?>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
				<tr>
					<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
					<td class="<?php echo $bg;?>" colspan='7' style="text-align: right;" <?php echo $style;?>>
						TOTAL
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($sommeFob, 2, ',', ' ');?>
					</td>
				</tr>
			<?php
		}

		public function afficherDossierLicencePretAppurementExcel($num_lic){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT d.*
												FROM dossier d, client cl
												WHERE d.num_lic = ?
													AND d.id_cli =  cl.id_cli
													AND (d.ref_decl IS NOT NULL
														AND d.ref_liq IS NOT NULL
														AND d.ref_quit IS NOT NULL)
													AND d.id_dos NOT IN(
															SELECT id_dos FROM appurement_licence
														)");
			$requete-> execute(array($entree['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
					<td class="<?php echo $bg;?>" style=" " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['cod'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $reponse['montant_av'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $reponse['fob'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<input type="checkbox" name="check_<?php echo $compteur;?>">
						<?php //echo $reponse['ref_quit'];?>
					</td>
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
				<tr>
					<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
					<td class="<?php echo $bg;?>" colspan='7' style="text-align: right;" <?php echo $style;?>>
						TOTAL
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $sommeFob;?>
					</td>
				</tr>
			<?php
		}

		public function afficherDossierLicenceAppuresBanque($num_lic){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT d.*
												FROM dossier d, client cl
												WHERE d.num_lic = ?
													AND d.id_cli =  cl.id_cli
													AND (d.ref_decl IS NOT NULL
														AND d.ref_liq IS NOT NULL
														AND d.ref_quit IS NOT NULL)
													AND d.id_dos IN(
															SELECT id_dos FROM appurement_licence
														)");
			$requete-> execute(array($entree['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
					<td class="<?php echo $bg;?>" style=" " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['cod'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['montant_av'], 2, ',', ' ');?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($reponse['fob'], 2, ',', ' ');?>
					</td>
					<!--<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<input type="checkbox" name="check_<?php echo $compteur;?>">
						<?php //echo $reponse['ref_quit'];?>
					</td>-->
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
				<tr>
					<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
					<td class="<?php echo $bg;?>" colspan='7' style="text-align: right;" <?php echo $style;?>>
						TOTAL
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo number_format($sommeFob, 2, ',', ' ');?>
					</td>
				</tr>
			<?php
		}

		public function afficherDossierLicenceAppuresBanqueExcel($num_lic){
			include('connexion.php');

			$entree['num_lic'] = $num_lic;
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sommeFob = 0;
			$requete = $connexion-> prepare("SELECT d.*
												FROM dossier d, client cl
												WHERE d.num_lic = ?
													AND d.id_cli =  cl.id_cli
													AND (d.ref_decl IS NOT NULL
														AND d.ref_liq IS NOT NULL
														AND d.ref_quit IS NOT NULL)
													AND d.id_dos IN(
															SELECT id_dos FROM appurement_licence
														)");
			$requete-> execute(array($entree['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$sommeFob += $reponse['fob'];
				
				/*$ref_dos, $id_cli, $ref_fact, $fob, 
				$fret, $assurance, $autre_frais, $num_lic, 
				$id_mod_lic, $id_march*/

			?>
				<tr class="<?php echo $bg;?>" <?php echo $style;?>>
					<input type="hidden" name="id_dos_<?php echo $compteur;?>" value="<?php echo $reponse['id_dos'];?>">
					<td class="<?php echo $bg;?>" style=" " <?php echo $style;?>>
						<?php echo $compteur;?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['ref_dos'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: left; ">
						<?php echo $reponse['cod'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $reponse['montant_av'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_decl'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_liq'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<?php echo $reponse['ref_quit'];?>
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $reponse['fob'];?>
					</td>
					<!--<td class=" <?php echo $bg;?>" style="text-align: center; ">
						<input type="checkbox" name="check_<?php echo $compteur;?>">
						<?php //echo $reponse['ref_quit'];?>
					</td>-->
				</tr>
			<?php
			}$requete-> closeCursor();
			?>
				<tr>
					<input type="hidden" name="nbre" value="<?php echo $compteur;?>">
					<td class="<?php echo $bg;?>" colspan='7' style="text-align: right;" <?php echo $style;?>>
						TOTAL
					</td>
					<td class=" <?php echo $bg;?>" style="text-align: right; ">
						<?php echo $sommeFob;?>
					</td>
				</tr>
			<?php
		}

		//FIN Methodes permettant d'afficher

		//Methode permettant de verifier 
		public function verifierUtilisateur($pseudo_util, $pass_util){
			include('connexion.php');
			$entree['pseudo_util'] = $pseudo_util;
			$entree['pass_util'] = $pass_util;

			$requete = $connexion-> prepare('SELECT id_util
												FROM utilisateur
												WHERE pseudo_util = ?
													AND pass_util = ?');
			$requete-> execute(array($entree['pseudo_util'], $entree['pass_util']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_util'];
			}else{
				return false;
			}
		}

		public function verifierClient($nom_cli){
			include('connexion.php');
			$entree['nom_cli'] = $nom_cli;
			//$entree['pass_util'] = $pass_util;

			$requete = $connexion-> prepare('SELECT id_cli
												FROM client
												WHERE nom_cli = ?');
			$requete-> execute(array($entree['nom_cli']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_cli'];
			}else{
				return false;
			}
		}

		public function verifierDossier($ref_dos){
			include('connexion.php');
			$entree['ref_dos'] = $ref_dos;
			//$entree['pass_util'] = $pass_util;

			$requete = $connexion-> prepare('SELECT id_dos
												FROM dossier
												WHERE ref_dos = ?');
			$requete-> execute(array($entree['ref_dos']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_dos'];
			}else{
				return false;
			}
		}
		//FIN Methode permettant de verifier 

		//Methode permettant de recuperer

		public function getTailleCompteur($i){
			if(strlen($i) == '1' ){
				$i = '00'.$i;
			}else if(strlen($i) == '2' ){
				$i = '0'.$i;
			}else if(strlen($i) == '3' ){
				$i = ''.$i;
			}
			return $i;
		}

		public function getDataRow($champ_col, $id_dos){
			include('connexion.php');
			$entree['champ_col'] = $champ_col;
			$entree['id_dos'] = $id_dos;

			$requete = $connexion-> prepare("SELECT $champ_col
												FROM dossier
													WHERE id_dos = ?");
			$requete-> execute(array($entree['id_dos']));
			$reponse=$requete-> fetch();
			if($reponse){
				return $reponse["$champ_col"];
			}
		}

		public function getDataRowCalcul($champ_col, $id_dos){
			include('connexion.php');
			$entree['champ_col'] = $champ_col;
			$entree['id_dos'] = $id_dos;

			$requete = $connexion-> prepare("SELECT DATEDIFF(dgda_out, dgda_in) AS dgda_delay,
													DATEDIFF(dispatch_deliv, arrival_date) AS arrival_deliver_delay
												FROM dossier
													WHERE id_dos = ?");
			$requete-> execute(array($entree['id_dos']));
			$reponse=$requete-> fetch();
			if($reponse){
				return $reponse;
			}
		}

		public function getDataRowCalculNetDays($champ_col, $id_dos){
			include('connexion.php');
			$entree['champ_col'] = $champ_col;
			$entree['id_dos'] = $id_dos;

			$requete = $connexion-> prepare("SELECT DATEDIFF(dgda_out, dgda_in) AS dgda_delay,
													DATEDIFF(dispatch_deliv, arrival_date) AS arrival_deliver_delay,
													arrival_date, dispatch_deliv
												FROM dossier
													WHERE id_dos = ?");
			$requete-> execute(array($entree['id_dos']));
			$reponse=$requete-> fetch();
			if($reponse){
				return ( $reponse['arrival_deliver_delay'] - $this-> getWeekendsAndHolidays($reponse['arrival_date'], $reponse['dispatch_deliv']) );
			}
		}

		public function codePourClient($id_cli){
			include('connexion.php');
			$entree['id_cli'] = $id_cli;

			$requete = $connexion-> prepare("SELECT code_cli
												FROM client
													WHERE id_cli = ?");
			$requete-> execute(array($entree['id_cli']));
			$reponse=$requete-> fetch();
			if($reponse){
				return $reponse['code_cli'];
			}
		}

		public function verifierExistanceMCAFile($mca_file){
			include('connexion.php');
			$entree['mca_file'] = $mca_file;

			$requete = $connexion-> prepare("SELECT id_dos
												FROM dossier
													WHERE ref_dos = ?");
			$requete-> execute(array($entree['mca_file']));
			$reponse=$requete-> fetch();
			if($reponse){
				return true;
			}
		}

		public function getMcaFile($id_cli, $id_mod_trans){
			include('connexion.php');
			$entree['id_cli'] = $id_cli;
			$code = '';

			$i = 1;

			$a = $this-> getTailleCompteur($i);

			$cod_mod_trans = $this-> getCodeModeTransport($id_mod_trans);

			$code = $this-> codePourClient($id_cli).'-'.$cod_mod_trans.date('y').'-'.$a;

			while($this-> verifierExistanceMCAFile($code) == true){
				$i++;

				$a = $this-> getTailleCompteur($i);

				$code = $this-> codePourClient($id_cli).'-'.$cod_mod_trans.date('y').'-'.$a;
			}

			return $code;
		}

		public function getCodeModeTransport($id_mod_trans){
			include('connexion.php');
			$entree['id_mod_trans'] = $id_mod_trans;

			$requete = $connexion-> prepare("SELECT UPPER(cod_mod_trans) AS cod_mod_trans
												FROM mode_transport
												WHERE id_mod_trans = ?");
			$requete-> execute(array($entree['id_mod_trans']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['cod_mod_trans'];
			}
		}

		public function getNom($id_util){
			include('connexion.php');
			$entree['id_util'] = $id_util;

			$requete = $connexion-> prepare("SELECT UPPER(nom_util) AS nom_util
												FROM utilisateur
												WHERE id_util = ?");
			$requete-> execute(array($entree['id_util']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_util'];
			}
		}

		public function getNomModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT UPPER(nom_mod_lic) AS nom_mod_lic
												FROM modele_licence
												WHERE id_mod_lic = ?");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_mod_lic'];
			}
		}

		public function getWeekendsAndHolidays($debut, $fin){
			include('connexion.php');
			$entree['debut'] = $debut;
			$entree['fin'] = $fin;

			$requete = $connexion-> prepare("SELECT COUNT(id) AS nbre
												FROM time_dimension
												WHERE (weekend_flag = '1'
													OR holiday_flag = '1')
													AND la_date BETWEEN ? AND ?");
			$requete-> execute(array($entree['debut'], $entree['fin']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nbre'];
			}
		}

		public function getClient($id_cli){
			include('connexion.php');
			$entree['id_cli'] = $id_cli;

			$requete = $connexion-> prepare("SELECT *
												FROM client
												WHERE id_cli = ?");
			$requete-> execute(array($entree['id_cli']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
		}

		public function getIdClient($nom_cli){
			include('connexion.php');
			$entree['nom_cli'] = $nom_cli;

			$requete = $connexion-> prepare("SELECT *
												FROM client
												WHERE nom_cli = ?");
			$requete-> execute(array($entree['nom_cli']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_cli'];
			}
		}

		public function getIdDossierClientLicence($ref_dos, $id_cli, $num_lic){
			include('connexion.php');
			$entree['ref_dos'] = $ref_dos;
			$entree['id_cli'] = $id_cli;
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT id_dos
												FROM dossier
												WHERE ref_dos = ?
													AND id_cli = ?
													AND num_lic = ?");
			$requete-> execute(array($entree['ref_dos'], $entree['id_cli'], $entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_dos'];
			}
		}

		public function getIdMonnaie($sig_mon){
			include('connexion.php');
			$entree['sig_mon'] = $sig_mon;

			$requete = $connexion-> prepare("SELECT *
												FROM monnaie
												WHERE sig_mon = ?");
			$requete-> execute(array($entree['sig_mon']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_mon'];
			}else{
				return false;
			}
		}

		public function getStructureTracking($id_march){
			include('connexion.php');
			$entree['id_march'] = $id_march;

			$requete = $connexion-> prepare("SELECT id_struct
												FROM marchandise
												WHERE id_march = ?");
			$requete-> execute(array($entree['id_march']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_struct'];
			}
		}

		public function getDataFacture($ref_fact){
			include('connexion.php');
			$entree['ref_fact'] = $ref_fact;

			$requete = $connexion-> prepare("SELECT *
												FROM facture_licence
												WHERE ref_fact = ?");
			$requete-> execute(array($entree['ref_fact']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
		}

		public function getLicenceFacture($ref_fact){
			include('connexion.php');
			$entree['ref_fact'] = $ref_fact;

			$requete = $connexion-> prepare("SELECT num_lic
												FROM licence
												WHERE ref_fact = ?");
			$requete-> execute(array($entree['ref_fact']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['num_lic'];
			}
		}

		public function getIdDocumentAppurement($fichier_doc, $id_util){
			include('connexion.php');
			$entree['fichier_doc'] = $fichier_doc;
			$entree['id_util'] = $id_util;

			$requete = $connexion-> prepare("SELECT id_doc
												FROM document_appurement
												WHERE fichier_doc = ?
													AND id_util = ?");
			$requete-> execute(array($entree['fichier_doc'], $entree['id_util']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_doc'];
			}
		}

		public function getLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT l.*, cl.*
												FROM licence l, client cl
												WHERE l.num_lic = ?
													AND l.id_cli = cl.id_cli");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
		}

		public function getNomModeTransport($id_mod_trans){
			include('connexion.php');
			$entree['id_mod_trans'] = $id_mod_trans;

			$requete = $connexion-> prepare("SELECT UPPER(nom_mod_trans) AS nom_mod_trans
												FROM mode_transport
												WHERE id_mod_trans = ?");
			$requete-> execute(array($entree['id_mod_trans']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_mod_trans'];
			}
		}

		public function getSommeFobLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			if ( $this-> getLicence($num_lic)['tonnage'] == '1') {
				
				$requete = $connexion-> prepare("SELECT SUM(poids) AS fob
													FROM dossier
													WHERE num_lic = ?");

			}else{

				$requete = $connexion-> prepare("SELECT SUM(fob) AS fob
													FROM dossier
													WHERE num_lic = ?");
			}

			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['fob'];
			}
		}

		public function getSommeCIFLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT SUM(fob+fret+assurance+autre_frais) AS cif
												FROM dossier
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['cif'];
			}
		}

		public function getSommeFobAppureLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT SUM(d.fob) AS fob
												FROM dossier d
												WHERE d.num_lic = ?
													AND d.id_dos IN(
														SELECT id_dos FROM appurement_licence
													)
												");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['fob'];
			}
		}

		public function getSommeQteLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT SUM(qte_decl) AS qte_decl
												FROM dossier
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['qte_decl'];
			}
		}

		public function getNbreDossierLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT COUNT(id_dos) AS nbre
												FROM dossier
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nbre'];
			}
		}

		public function getMarchandiseLicence($num_lic){
			include('connexion.php');
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare('SELECT UPPER(m.nom_march) AS nom_march
												FROM licence l, marchandise m
												WHERE l.num_lic = ?
													AND l.id_march = m.id_march');
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_march'];
			}
		}

		public function getLastEpirationLicence($num_lic){
			include("connexion.php");
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT DATE_FORMAT(date_exp, '%d/%m/%Y') AS date_exp
												FROM expiration_licence
												WHERE num_lic = ?
												ORDER BY id_date_exp DESC LIMIT 0, 1");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();

			return $reponse['date_exp'];
		}

		public function getLastEpirationLicence2($num_lic){
			include("connexion.php");
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT date_exp
												FROM expiration_licence
												WHERE num_lic = ?
												ORDER BY id_date_exp DESC LIMIT 0, 1");
			$requete-> execute(array($entree['num_lic']));
			$reponse = $requete-> fetch();

			return $reponse['date_exp'];
		}

		public function getElementFacture($ref_fact){
			include('connexion.php');
			$entree['ref_fact'] = $ref_fact;

			$requete = $connexion-> prepare('SELECT cl.id_cli AS id_cli,
													UPPER(cl.nom_cli) AS nom_cli,
													f.date_fact AS date_fact,
													f.date_fact_rec AS date_fact_rec,
													f.fournisseur AS fournisseur,
													f.date_val AS date_val,
													f.ref_fact AS ref_fact,
													f.commodity AS commodity,
													f.montant_fact AS montant_fact,
													f.fret_fact AS fret_fact,
													f.assurance_fact AS assurance_fact,
													f.autre_frais_fact AS autre_frais_fact,
													m.id_mon AS id_mon,
													m.sig_mon AS sig_mon,
													f.fichier_fact AS fichier_fact
												FROM facture_licence f, client cl, monnaie m
												WHERE f.ref_fact = ?
													AND f.id_cli = cl.id_cli
													AND f.id_mon = m.id_mon');
			$requete-> execute(array($entree['ref_fact']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
        }
        
		public function getElementModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare('SELECT id_mod_lic, 
													UPPER(nom_mod_lic) AS nom_mod_lic,
													sigle_mod_lic
												FROM modele_licence
												WHERE id_mod_lic = ?');
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
        }
        
		public function getElementMarchandise($id_march){
			include('connexion.php');
			$entree['id_march'] = $id_march;

			$requete = $connexion-> prepare('SELECT id_march, 
													UPPER(nom_march) AS nom_march
												FROM marchandise
												WHERE id_march = ?');
			$requete-> execute(array($entree['id_march']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
        }
        
		public function getElementClient($id_cli){
			include('connexion.php');
			$entree['id_cli'] = $id_cli;

			$requete = $connexion-> prepare('SELECT *, id_cli, 
													UPPER(nom_cli) AS nom_cli
												FROM client
												WHERE id_cli = ?');
			$requete-> execute(array($entree['id_cli']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse;
			}
        }
        
		public function getNomClient($id_cli){
			include('connexion.php');
			$entree['id_cli'] = $id_cli;

			$requete = $connexion-> prepare('SELECT nom_cli AS nom_cli
												FROM client
												WHERE id_cli = ?');
			$requete-> execute(array($entree['id_cli']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_cli'];
			}
        }
        
		public function getNomTypeLicence($id_type_lic){
			include('connexion.php');
			$entree['id_type_lic'] = $id_type_lic;

			$requete = $connexion-> prepare('SELECT UPPER(nom_type_lic) AS nom_type_lic
												FROM type_licence
												WHERE id_type_lic = ?');
			$requete-> execute(array($entree['id_type_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom_type_lic'];
			}
        }
        
		public function getIdRoleUtilisateur($id){
			include('connexion.php');
			$entree['id'] = $id;

			$requete = $connexion-> prepare('SELECT r.id_role AS id_role
												FROM utilisateur u, role r
												WHERE u.id_util = ?
													AND u.id_role = r.id_role');
			$requete-> execute(array($entree['id']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['id_role'];
			}
        }
        
		public function getNomRoleUtilisateur($id){
			include('connexion.php');
			$entree['id'] = $id;

			$requete = $connexion-> prepare('SELECT r.nom_role AS nom
												FROM utilisateur u, role r
												WHERE u.id_util = ?
													AND u.id_role = r.id_role');
			$requete-> execute(array($entree['id']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nom'];
			}
		}

		public function getNombreLicenceModele($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare('SELECT COUNT(num_lic) AS nbre
												FROM licence
												WHERE id_mod_lic = ?');
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['nbre'];
			}
		}

		public function getNombreDossierClientModeTransportModeLicence3($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT COUNT(d.id_dos) AS nbre
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND ((d.date_quit IS NULL AND d.ref_quit IS NULL) 
														OR (d.date_quit = '' OR d.ref_quit = ''))
													$sql1
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			
			return $reponse['nbre'];
		}

		public function getNombreDossierClientModeTransportModeLicenceUpdate($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, $debut, $fin){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['debut'] = $debut;
			$entree['fin'] = $fin;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT COUNT(d.id_dos) AS nbre
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND ((d.date_quit IS NULL AND d.ref_quit IS NULL) 
														OR (d.date_quit = '' OR d.ref_quit = ''))
													$sql1
													AND d.id_dos BETWEEN ? AND ?
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic'], 
									$entree['debut'], $entree['fin']));
			$reponse = $requete-> fetch();
			
			return $reponse['nbre'];
		}

		public function getNombreLicenceEnCoursModele($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = "";
			$sql2 = "";
			
			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreLicenceExpiration40JoursModele($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) <= 40) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreLicenceExpireModele($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($date_exp < $reponse['aujourdhui']) && ($reponse['fob'] > $this-> getSommeFobLicence($reponse['num_lic']))){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreLicenceClotureeAppureeModele($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreLicenceCIFLicenceDifferentCIFDossier($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob,
													(fob+fret+assurance+autre_frais) AS cif
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['cif'] != $this-> getSommeCIFLicence($reponse['num_lic'])) ){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreLicenceClotureeTrackingAttenteBanqueAppureeModele($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$nbre = 0;

			$sql = '';
			$sql2 = '';

			if( ($id_cli != null) && ($id_cli != '')){
				$sql = ' AND id_cli = '.$id_cli;
			}

			if( ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic, DATE(CURRENT_DATE()) AS aujourdhui, fob
												FROM licence
												WHERE id_mod_lic = ?
												$sql
												$sql2");
			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] == $this-> getSommeFobAppureLicence($reponse['num_lic'])) ){
					$nbre++;
				}
			}$requete-> closeCursor(); 

			return $nbre;
			//return $this-> getDifferenceDate('2020-11-15', $date_exp);
		}

		public function getNombreDossierClientModeTransportModeLicence($id_cli, $id_mod_trans, $id_mod_lic, $num_lic){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['num_lic'] = $num_lic;

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$requete = $connexion-> prepare("SELECT COUNT(d.*) AS nbre
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND l.num_lic = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_cli'], $entree['num_lic'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			return $reponse['nbre'];

		}

		public function getNombreDossierClientModeTransportModeLicence2($id_cli, $id_mod_trans, $id_mod_lic){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			//$entree['num_lic'] = $num_lic;

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$requete = $connexion-> prepare("SELECT COUNT(d.id_dos) AS nbre
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			return $reponse['nbre'];

		}

		public function getNombreLicenceClientModeLicenceTypeLicence($id_cli, $id_mod_lic, $id_type_lic){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_lic'] = $id_mod_lic;


			if((isset($id_type_lic)) && ($id_type_lic != null) && ($id_type_lic != '')){
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}else{
				$sql2 = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(*) AS nbre
												FROM licence
												WHERE id_cli = ?
													AND id_mod_lic = ?
													$sql2");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			return $reponse['nbre'];

		}
		/*
		public function getNombreDossierClientModeTransportModeLicence($id_cli, $id_mod_trans, $id_mod_lic, $num_lic){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['num_lic'] = $num_lic;

			$requete = $connexion-> prepare("SELECT COUNT(d.*) AS nbre
												FROM dossier d, client cl, licence l, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.num_lic = l.num_lic
													AND l.num_lic = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
												ORDER BY d.id_dos DESC");
			$requete-> execute(array($entree['id_cli'], $entree['num_lic'], $entree['id_mod_trans'], $entree['id_mod_lic']));
			$reponse = $requete-> fetch();
			return $reponse['nbre'];

		}
		*/
		public function getDifferenceDate($date1, $date2){
			include('connexion.php');
			$entree['date1'] = $date1;
			$entree['date2'] = $date2;

			$requete = $connexion-> prepare('SELECT DATEDIFF(?,?) AS difference');
			$requete-> execute(array($entree['date1'], $entree['date2']));
			$reponse = $requete-> fetch();
			if($reponse){
				return $reponse['difference'];
			}
		}

		public function nbreImportKlsa(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(klsa_arriv) = CURRENT_DATE()");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreWiskiArrived($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(wiski_arriv) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreWiskiDeparture($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(wiski_dep) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDgdaIn($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(dgda_in) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreUnderWiski($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE (wiski_arriv IS NOT NULL AND wiski_arriv <> '')
												AND (wiski_dep IS NULL OR wiski_dep = '')
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreUnderDgda($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE (dgda_in IS NOT NULL AND dgda_in <> '')
												AND (dgda_out IS NULL OR dgda_out = '')
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierLiquidation($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE ( (date_liq IS NOT NULL OR date_liq <> '')
													OR (ref_liq IS NOT NULL OR ref_liq <> '') )
												AND ( (date_quit IS NULL OR date_quit = '') 
													OR (ref_quit IS NULL OR ref_quit = '') )
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierQuittance($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(date_quit) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDgdaOut($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(dgda_out) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreAwaitCRF($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE (wiski_dep IS NOT NULL AND wiski_dep <> '')
												AND ( (date_crf IS NULL OR date_crf = '') AND (ref_crf IS NULL OR ref_crf = '' ))
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportWiskiDeparture(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(wiski_dep) = CURRENT_DATE()");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportDgdaIn(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(dgda_in) = CURRENT_DATE()");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportDgdaOrLiquidation(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(dgda_in) IS NOT NULL
												AND (dgda_out IS NULL
														AND date_liq IS NULL AND ref_liq IS NULL)
												AND DATEDIFF(CURRENT_DATE(), ADDDATE(dgda_in, 1)) > 1");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierModeleLicence($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE id_mod_lic = ?
											$sql
											$sqlTrans
											$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierCleared($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE cleared = '1'
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierProcess($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE cleared = '0'
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierCanceled($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE cleared = '2'
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierKlsaToDay($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE DATE(arrival_date) = CURRENT_DATE()
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportLiquidation(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE date_liq IS NOT NULL
												AND date_quit IS NULL
												AND ref_quit IS NULL");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportQuitance(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE date_quit IS NOT NULL
												AND ref_quit IS NOT NULL
												AND dgda_out IS NULL");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreImportDgdaOut(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE (DATE(dgda_out) = CURRENT_DATE()
													OR DATE(dgda_out) = ADDDATE(CURRENT_DATE(),-1))");
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		public function nbreDossierClearedWaitFacture($id_mod_lic, $id_cli, $id_mod_trans, $commodity){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			if (isset($id_cli) && ($id_cli != '')) {
				$sql = ' AND id_cli = '.$id_cli;
			}else{
				$sql = '';
			}

			if (isset($id_mod_trans) && ($id_mod_trans != '')) {
				$sqlTrans = ' AND id_mod_trans = '.$id_mod_trans;
			}else{
				$sqlTrans = '';
			}

			if (isset($commodity) && ($commodity != '')) {
				$sqlCommodity = ' AND commodity = "'.$commodity.'"';
			}else{
				$sqlCommodity = '';
			}

			$requete = $connexion-> prepare("SELECT COUNT(ref_dos) AS nbre
											FROM dossier
											WHERE cleared = '1'
												AND facture = '0'
												AND id_mod_lic = ?
												$sql
												$sqlTrans
												$sqlCommodity");
			$requete-> execute(array($entree['id_mod_lic']));
			$reponse = $requete-> fetch();

			if($reponse){
				return $reponse['nbre'];
			}

		}

		//FIN Methode permettant de recuperer

		//Methodes permettant de Selectionner 

		public function selectionnerFacturePourClientModele($id_cli, $id_mod_lic){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_lic'] = $id_mod_lic;
			$option = "";
			$objResponse = new xajaxResponse();
			$bg = '';
			$style = '';
			$option = '';

			$requete = $connexion-> prepare("SELECT *
											FROM facture_licence
											WHERE id_mod_lic = ?
												AND id_cli = ?
											ORDER BY date_creat_fact  DESC");

			$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));

			while($reponse = $requete-> fetch()){

				?>
				<option value="<?php echo $reponse['ref_fact']; ?>">
					<?php echo $reponse['ref_fact']; ?>
				</option>
				<?php
			}$requete-> closeCursor();
		}

		public function selectionnerClientModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> prepare("SELECT UPPER(c.nom_cli) AS nom_cli,
													c.id_cli AS id_cli
												FROM client c, modele_licence ml,
													affectation_client_modele_licence a
												WHERE ml.id_mod_lic = ?
													AND ml.id_mod_lic = a.id_mod_lic
													AND a.id_cli = c.id_cli
													AND a.id_etat = 1
												ORDER BY c.nom_cli ASC");
			$requete-> execute(array($entree['id_mod_lic']));

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_cli'];?>">
				<?php echo $reponse['nom_cli'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerDossierClientModeTransportModeLicence2($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$sqlClient = "";
			if (isset($id_cli) && ($id_cli != '')) {
				$sqlClient = ' AND cl.id_cli = "'.$id_cli.'"';
			}

			$requete = $connexion-> prepare("SELECT d.id_dos AS id_dos, d.ref_dos AS ref_dos
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													$sqlClient
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sql1
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
			
			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['ref_dos'];?>">
				<?php echo $reponse['ref_dos'];?>
			</option>
			<?php
			}$requete-> closeCursor();
		}

		public function selectionnerDossierClientModeTransportModeLicence3($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, $type){
			include('connexion.php');

			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$compteur = $premiere_entree;
			$bg = '';
			$style = '';

			/*echo '<br> id_cli = '.$id_cli;
			echo '<br> id_mod_trans = '.$id_mod_trans;
			echo '<br> id_mod_lic = '.$id_mod_lic;
			echo '<br> num_lic = '.$num_lic;*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$sqlClient = "";
			if (isset($id_cli) && ($id_cli != '')) {
				$sqlClient = ' AND cl.id_cli = "'.$id_cli.'"';
			}

			if (isset($type) && ($type == 'TOTAL FILES')) {
				$sqlType = '';
			}

			if (isset($type) && ($type == 'CLEARING COMPLETED')) {
				$sqlType = " AND cleared = '1'";
			}

			if (isset($type) && ($type == 'FILES IN PROCESS')) {
				$sqlType = " AND cleared = '0'";
			}

			if (isset($type) && ($type == 'CANCELLED')) {
				$sqlType = " AND cleared = '2'";
			}

			if (isset($type) && ($type == 'KASUMBALESA')) {
				$sqlType = " AND DATE(arrival_date) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'WISKI ARRIVAL')) {
				$sqlType = " AND DATE(wiski_arriv) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT WISKI')) {
				$sqlType = " AND (wiski_arriv IS NOT NULL AND wiski_arriv <> '')
												AND (wiski_dep IS NULL OR wiski_dep = '')";
			}

			if (isset($type) && ($type == 'WISKI DEPARTURE')) {
				$sqlType = " AND DATE(wiski_dep) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'AWAIT CRF')) {
				$sqlType = " AND (wiski_dep IS NOT NULL AND wiski_dep <> '')
												AND ( (date_crf IS NULL OR date_crf = '') AND (ref_crf IS NULL OR ref_crf = '' ))";
			}

			if (isset($type) && ($type == 'DGDA IN')) {
				$sqlType = " AND DATE(dgda_in) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT DGDA')) {
				$sqlType = " AND (dgda_in IS NOT NULL AND dgda_in <> '')
												AND (dgda_out IS NULL OR dgda_out = '')";
			}

			if (isset($type) && ($type == 'LIQUIDATED / AWAIT QUITTANCE')) {
				$sqlType = " AND ( (date_liq IS NOT NULL OR date_liq <> '')
													OR (refORq IS NOT NULL AND ref_liq <> '') )
												AND ( (date_quit IS NULL OR date_quit = '') 
													OR (ref_quit IS NULL OR ref_quit = '') )";
			}

			if (isset($type) && ($type == 'QUITTANCE')) {
				$sqlType = " AND DATE(date_quit) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'DGDA OUT')) {
				$sqlType = " AND DATE(dgda_out) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'FILES CLEARED WAITING INVOICE')) {
				$sqlType = " AND cleared = '1'
												AND facture = '0'";
			}

			$requete = $connexion-> prepare("SELECT d.id_dos AS id_dos, d.ref_dos AS ref_dos
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													$sqlClient
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sqlType
													$sql1
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
			
			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['ref_dos'];?>">
				<?php echo $reponse['ref_dos'];?>
			</option>
			<?php
			}$requete-> closeCursor();
		}

		public function selectionnerMarchandiseClientModeleLicence($id_cli, $id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			//echo $id_cli.' - '.$id_mod_lic;
			$requete = $connexion-> prepare("SELECT DISTINCT(UPPER(commodity)) AS commodity
												FROM dossier
												WHERE id_cli = ?
													AND id_mod_lic = ?
												ORDER BY commodity");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic']));

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['commodity'];?>">
				<?php echo $reponse['commodity'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerMarchandiseModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			//$entree['id_cli'] = $id_cli;
			//echo $id_cli.' - '.$id_mod_lic;
			$requete = $connexion-> prepare("SELECT DISTINCT(UPPER(commodity)) AS commodity
												FROM dossier
												WHERE id_mod_lic = ?
												ORDER BY commodity");
			$requete-> execute(array($entree['id_mod_lic']));

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['commodity'];?>">
				<?php echo $reponse['commodity'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerClient(){
			include('connexion.php');
			//$entree['id_mod_lic'] = $id_mod_lic;

			$requete = $connexion-> query("SELECT UPPER(c.nom_cli) AS nom_cli,
													c.id_cli AS id_cli
												FROM client c
												ORDER BY c.nom_cli ASC");
			//$requete-> execute(array($entree['id_mod_lic']));

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_cli'];?>">
				<?php echo $reponse['nom_cli'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerBanque(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT UPPER(nom_banq) AS nom_banq,
													id_banq
												FROM banque
												ORDER BY nom_banq ASC");

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_banq'];?>">
				<?php echo $reponse['nom_banq'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerPoste(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT UPPER(nom_post) AS nom_post,
													id_post
												FROM poste_entree
												ORDER BY nom_post ASC");

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_post'];?>">
				<?php echo $reponse['nom_post'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerTypeLicence(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT UPPER(nom_type_lic) AS nom_type_lic,
													id_type_lic
												FROM type_licence");

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_type_lic'];?>">
				<?php echo $reponse['nom_type_lic'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerModalitePaiement(){
			include('connexion.php');

			$requete = $connexion-> query("SELECT UPPER(nom_mod_paie) AS nom_mod_paie,
													id_mod_paie
												FROM modalite_paiement");

			while($reponse = $requete-> fetch()){
			?>
			<option value="<?php echo $reponse['id_mod_paie'];?>">
				<?php echo $reponse['nom_mod_paie'];?>
			</option>
			<?php
			}$requete-> closeCursor();

		}

		public function selectionnerSousTypePaiement($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$requete = $connexion-> prepare("SELECT id_sous_type_paie, UPPER(nom_sous_type_paie) AS nom_sous_type_paie
											FROM sous_type_paiement
											WHERE id_mod_lic = ?
											ORDER BY nom_sous_type_paie  ASC");
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['id_sous_type_paie'];?>">
				<?php echo $reponse['nom_sous_type_paie'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		public function selectionnerMonnaie(){
			include('connexion.php');
			$requete = $connexion-> query("SELECT id_mon, UPPER(sig_mon) AS nom_mon
											FROM monnaie");
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['id_mon'];?>">
				<?php echo $reponse['nom_mon'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		public function selectionnerModeTransport(){
			include('connexion.php');
			$requete = $connexion-> query("SELECT id_mod_trans, UPPER(nom_mod_trans) AS nom_mod_trans
											FROM mode_transport");
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['id_mod_trans'];?>">
				<?php echo $reponse['nom_mod_trans'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		/*public function selectionnerMarchandiseModeleLicence($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$requete = $connexion-> prepare("SELECT id_march, UPPER(nom_march) AS nom_march
											FROM marchandise
											WHERE id_mod_lic = ?
											ORDER BY nom_march  ASC");
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['id_march'];?>">
				<?php echo $reponse['nom_march'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} */

		public function selectionnerLicenceModele($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$requete = $connexion-> prepare("SELECT num_lic
											FROM licence
											WHERE id_mod_lic = ?
											ORDER BY date_creat_lic  DESC");
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['num_lic'];?>">
				<?php echo $reponse['num_lic'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		public function selectionnerLicenceModele2($id_mod_lic, $id_cli, $id_type_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;

			$sql = '';
			$sql2 = '';

			if (isset($id_cli)) {
				$sql = ' AND id_cli = '.$id_cli;
			}
			if (isset($id_type_lic)) {
				$sql2 = ' AND id_type_lic = '.$id_type_lic;
			}

			$requete = $connexion-> prepare("SELECT num_lic
											FROM licence
											WHERE id_mod_lic = ?
											$sql
											$sql2
											ORDER BY date_creat_lic  DESC");
			$requete-> execute(array($entree['id_mod_lic']));
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['num_lic'];?>">
				<?php echo $reponse['num_lic'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		public function selectionnerLicenceModeleClient($id_mod_lic, $id_cli){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$requete = $connexion-> prepare("SELECT num_lic
											FROM licence
											WHERE id_mod_lic = ?
												AND id_cli = ?
											ORDER BY date_creat_lic  DESC");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));
			while($reponse = $requete-> fetch()){
			?>
			  <option value="<?php echo $reponse['num_lic'];?>">
				<?php echo $reponse['num_lic'];?>
			  </option>
			<?php
			}$requete-> closeCursor();
		} 

		public function selectionnerLicenceEnCoursModele($id_mod_lic){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$bg = '';
			$style = '';

			$requete = $connexion-> prepare("SELECT num_lic, fob, DATE(CURRENT_DATE()) AS aujourdhui
											FROM licence
											WHERE id_mod_lic = ?
											ORDER BY date_creat_lic  DESC");

			$requete-> execute(array($entree['id_mod_lic']));

			while($reponse = $requete-> fetch()){
				$compteur++;
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);
				
				$bg = "bg-light";
				
				if( (!$date_exp) && ($this-> getSommeFobLicence($reponse['num_lic']) <= $fob) ){
					?>
					  <option value="<?php echo $reponse['num_lic'];?>">
						<?php echo $reponse['num_lic'];?>
					  </option>
					<?php
				}else{
						
					$style = '';//" style='color: black; background-color: orange;'";
					if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
						$bg = "bg-success";
						$style = " style=''";
					}else if($date_exp < $reponse['aujourdhui']){
						$bg = "bg-danger";
						$style = " style=''";
					}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
						$bg = "bg-warning";
						$style = " style=''";
					}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
						$bg = "bg-danger";
						$style = " style=''";
					} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
						$bg = "bg-info";
						$style = " style=''";
						?>
						  <option value="<?php echo $reponse['num_lic'];?>">
							<?php echo $reponse['num_lic'];?>
						  </option>
						<?php
					}else{
						?>
						  <option value="<?php echo $reponse['num_lic'];?>">
							<?php echo $reponse['num_lic'];?>
						  </option>
						<?php
					}
				}
			}$requete-> closeCursor();
		} 

		public function selectionnerLicenceEnCoursModeleClient($id_mod_lic, $id_cli){
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_cli'] = $id_cli;
			$bg = '';
			$style = '';

			$requete = $connexion-> prepare("SELECT num_lic, fob, DATE(CURRENT_DATE()) AS aujourdhui
											FROM licence
											WHERE id_mod_lic = ?
												AND id_cli = ?
											ORDER BY date_creat_lic  DESC");

			$requete-> execute(array($entree['id_mod_lic'], $entree['id_cli']));

			while($reponse = $requete-> fetch()){
				$compteur++;
				$marchandise = $this-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $this-> getLastEpirationLicence2($reponse['num_lic']);

				if( (!$date_exp) && ($this-> getSommeFobLicence($reponse['num_lic']) <= $fob) ){
					?>
					  <option value="<?php echo $reponse['num_lic'];?>">
						<?php echo $reponse['num_lic'];?>
					  </option>
					<?php
				}else{
					
					$bg = "bg-light";
					
					$style = '';//" style='color: black; background-color: orange;'";
					if( ($reponse['fob'] == $this-> getSommeFobLicence($reponse['num_lic'])) ){
						$bg = "bg-success";
						$style = " style=''";
					}else if($date_exp < $reponse['aujourdhui']){
						$bg = "bg-danger";
						$style = " style=''";
					}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) ){
						$bg = "bg-warning";
						$style = " style=''";
					}else if( ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 30) && ($this-> getDifferenceDate($date_exp, $reponse['aujourdhui']) < 0) ){
						$bg = "bg-danger";
						$style = " style=''";
					} else if( ($reponse['fob'] >= $this-> getSommeFobLicence($reponse['num_lic'])) && ($this-> getSommeFobLicence($reponse['num_lic'])>0) ){
						$bg = "bg-info";
						$style = " style=''";
						?>
						  <option value="<?php echo $reponse['num_lic'];?>">
							<?php echo $reponse['num_lic'];?>
						  </option>
						<?php
					}else{
						?>
						  <option value="<?php echo $reponse['num_lic'];?>">
							<?php echo $reponse['num_lic'];?>
						  </option>
						<?php
					}
				}
			}$requete-> closeCursor();
		} 

		//FIN Methodes permettant de Selectionner 

		//Methodes permettant de mettre à jour
		public function modifierLicence($num_lic, $date_val, $date_exp, 
										$fournisseur, $commodity, $fob, $num_lic_old){

			include('connexion.php');
			$entree['num_lic'] = $num_lic;
			$entree['num_lic_old'] = $num_lic_old;
			$entree['date_val'] = $date_val;
			$entree['fournisseur'] = $fournisseur;
			$entree['commodity'] = $commodity;
			$entree['fob'] = $fob;

			/*echo '<br> num_lic = '.$num_lic;
			echo '<br> num_lic_old = '.$num_lic_old;
			echo '<br> date_val = '.$date_val;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> commodity = '.$commodity;
			echo '<br> fob = '.$fob;*/

			$requete = $connexion-> prepare("UPDATE licence SET num_lic= ?,  date_val = ?, 
													fournisseur = ?, commodity = ?, fob = ?
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic'], $entree['date_val'], $entree['fournisseur'], 
									$entree['commodity'], $entree['fob'], $entree['num_lic_old']));

			if ($date_exp != $this-> getLastEpirationLicence2($num_lic)) {
				$this-> annulerDateExpirationLicence($num_lic);
				$this-> creerDateExpirationLicence($num_lic, $date_exp);
			}

			$this-> modifierLicencePourDossier($num_lic, $num_lic_old);

		} 

		public function modifierLicencePourDossier($num_lic, $num_lic_old){

			include('connexion.php');
			$entree['num_lic'] = $num_lic;
			$entree['num_lic_old'] = $num_lic_old;

			/*echo '<br> num_lic = '.$num_lic;
			echo '<br> num_lic_old = '.$num_lic_old;
			echo '<br> date_val = '.$date_val;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> commodity = '.$commodity;
			echo '<br> fob = '.$fob;*/

			$requete = $connexion-> prepare("UPDATE dossier SET num_lic= ?	
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic'], $entree['num_lic_old']));

		} 

		public function updateMultipleFiles($debut, $fin, $klsa_arriv, 
			                                  $crossing_date, $wiski_arriv, $wiski_dep, 
			                                  $amicong_arriv, $insp_receiv, $ir, 
			                                  $ref_crf, $date_crf, $dgda_in, $ref_decl,
			                                  $ref_liq, $date_liq, $ref_quit, 
			                                  $date_quit, $custom_deliv, $cleared, 
			                                  $dispatch_deliv, $statut, $remarque, 
			                                  $nbre, $id_cli, $id_mod_trans, $id_mod_lic, 
			                                  $commodity){

			include('connexion.php');
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['debut'] = $debut;
			$entree['fin'] = $fin;

			/*echo '<br> num_lic = '.$num_lic;
			echo '<br> num_lic_old = '.$num_lic_old;
			echo '<br> date_val = '.$date_val;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> commodity = '.$commodity;
			echo '<br> fob = '.$fob;*/
			/*$nbre = $this-> getNombreDossierClientModeTransportModeLicenceUpdate($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, $debut, $fin);

			for ($i=1; $i <= $nbre ; $i++) { 
				# code...
			}*/

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.id_dos AS id_dos, d.ref_dos AS ref_dos
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND d.ref_dos BETWEEN ? AND ?
													$sql1
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic'], 
									$entree['debut'], $entree['fin']));
			
			while($reponse = $requete-> fetch()){

		      if (isset($ref_decl) && ($ref_decl != '')) {
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

		      if (isset($date_decl) && ($date_decl != '')) {
		        $this-> MAJ_date_decl($reponse['id_dos'], $date_decl);
		      }

		      if (isset($ref_liq) && ($ref_liq != '')) {
		        $this-> MAJ_ref_liq($reponse['id_dos'], $ref_liq);
		      }

		      if (isset($date_liq) && ($date_liq != '')) {
		        $this-> MAJ_date_liq($reponse['id_dos'], $date_liq);
		      }

		      if (isset($ref_quit) && ($ref_quit != '')) {
		        $this-> MAJ_ref_quit($reponse['id_dos'], $ref_quit);
		      }

		      if (isset($date_quit) && ($date_quit != '')) {
		        $this-> MAJ_date_quit($reponse['id_dos'], $date_quit);
		      }

		      if (isset($montant_decl) && ($montant_decl != '')) {
		        $this-> MAJ_montant_decl($reponse['id_dos'], $montant_decl);
		      }

		      if (isset($klsa_arriv) && ($klsa_arriv != '')) {
		        $this-> MAJ_klsa_arriv($reponse['id_dos'], $klsa_arriv);
		      }
		      
		      if (isset($crossing_date) && ($crossing_date != '')) {
		        $this-> MAJ_crossing_date($reponse['id_dos'], $crossing_date);
		      }
		      
		      if (isset($wiski_arriv) && ($wiski_arriv != '')) {
		        $this-> MAJ_wiski_arriv($reponse['id_dos'], $wiski_arriv);
		      }
		      
		      if (isset($wiski_dep) && ($wiski_dep != '')) {
		        $this-> MAJ_wiski_dep($reponse['id_dos'], $wiski_dep);
		      }
		      
		      if (isset($ref_crf) && ($ref_crf != '')) {
		        $this-> MAJ_ref_crf($reponse['id_dos'], $ref_crf);
		      }
		      
		      if (isset($date_crf) && ($date_crf != '')) {
		        $this-> MAJ_date_crf($reponse['id_dos'], $date_crf);
		      }
		      
		      if (isset($dgda_in) && ($dgda_in != '')) {
		        $this-> MAJ_dgda_in($reponse['id_dos'], $dgda_in);
		      }
		      
		      if (isset($dgda_out) && ($dgda_out != '')) {
		        $this-> MAJ_dgda_out($reponse['id_dos'], $dgda_out);
		      }

		      if (isset($date_preal) && ($date_preal != '')) {
		        $this-> MAJ_date_preal($reponse['id_dos'], $date_preal);
		      }

		      if (isset($custom_deliv) && ($custom_deliv != '')) {
		        $this-> MAJ_custom_deliv($reponse['id_dos'], $custom_deliv);
		      }
		      
		      if (isset($dispatch_klsa) && ($dispatch_klsa != '')) {
		        $this-> MAJ_dispatch_klsa($reponse['id_dos'], $dispatch_klsa);
		      }
		      
		      if (isset($dispatch_deliv) && ($dispatch_deliv != '')) {
		        $this-> MAJ_dispatch_deliv($reponse['id_dos'], $dispatch_deliv);
		      }
		      
		      if (isset($cleared) && ($cleared != '')) {
		        $this-> MAJ_cleared($reponse['id_dos'], $cleared);
		      }

		      if (isset($statut) && ($statut != '')) {
		        $this-> MAJ_statut($reponse['id_dos'], $statut);
		      }

		      if (isset($remarque) && ($remarque != '')) {
		        $this-> MAJ_remarque($reponse['id_dos'], $remarque);
		      }

		      if (isset($cleared) && ($cleared != '')) {
		        $this-> MAJ_cleared($reponse['id_dos'], $cleared);
		      }

		      if (isset($amicongo_arriv) && ($amicongo_arriv != '')) {
		        $this-> MAJ_amicongo_arriv($reponse['id_dos'], $amicongo_arriv);
		      }

		      if (isset($insp_receiv) && ($insp_receiv != '')) {
		        $this-> MAJ_insp_receiv($reponse['id_dos'], $insp_receiv);
		      }

		      if (isset($ir) && ($ir != '')) {
		        $this-> MAJ_ir($reponse['id_dos'], $ir);
		      }

		      if (isset($ref_decl) && ($ref_decl != '')) {
		      	//echo "<br> $ref_decl";
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

		      if (isset($ref_decl) && ($ref_decl != '')) {
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

			}

		} 

		public function updateMultipleFilesPopUp($debut, $fin, $klsa_arriv, 
			                                  $crossing_date, $wiski_arriv, $wiski_dep, 
			                                  $amicong_arriv, $insp_receiv, $ir, 
			                                  $ref_crf, $date_crf, $dgda_in, $ref_decl,
			                                  $ref_liq, $date_liq, $ref_quit, 
			                                  $date_quit, $dgda_out, $custom_deliv, $cleared, 
			                                  $dispatch_deliv, $statut, $remarque, 
			                                  $nbre, $id_cli, $id_mod_trans, $id_mod_lic, 
			                                  $commodity, $type){

			include('connexion.php');
			$entree['id_cli'] = $id_cli;
			$entree['id_mod_trans'] = $id_mod_trans;
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['debut'] = $debut;
			$entree['fin'] = $fin;

			/*echo '<br> debut = '.$debut;
			echo '<br> fin = '.$fin;
			echo '<br> dgda_out = '.$dgda_out;
			echo '<br> type = '.$type;
			echo '<br> id_cli = '.$id_cli;
			echo '<br> date_val = '.$date_val;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> commodity = '.$commodity;
			echo '<br> fob = '.$fob;*/
			/*$nbre = $this-> getNombreDossierClientModeTransportModeLicenceUpdate($id_cli, $id_mod_trans, 
														$id_mod_lic, $commodity, $debut, $fin);

			for ($i=1; $i <= $nbre ; $i++) { 
				# code...
			}*/
			$sqlType = '';
			$sqlClient = '';

			if (isset($type) && ($type == 'TOTAL FILES')) {
				$sqlType = '';
			}

			if (isset($id_cli) && ($id_cli != '')) {
				$sqlClient = ' AND d.id_cli = '.$id_cli;
			}

			if (isset($type) && ($type == 'CLEARING COMPLETED')) {
				$sqlType = " AND d.cleared = '1'";
			}

			if (isset($type) && ($type == 'FILES IN PROCESS')) {
				$sqlType = " AND d.cleared = '0'";
			}

			if (isset($type) && ($type == 'CANCELLED')) {
				$sqlType = " AND d.cleared = '2'";
			}

			if (isset($type) && ($type == 'KASUMBALESA')) {
				$sqlType = " AND DATE(d.arrival_date) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'WISKI ARRIVAL')) {
				$sqlType = " AND DATE(d.wiski_arriv) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT WISKI')) {
				$sqlType = " AND (d.wiski_arriv IS NOT NULL AND d.wiski_arriv <> '')
												AND (d.wiski_dep IS NULL OR d.wiski_dep = '')";
			}

			if (isset($type) && ($type == 'WISKI DEPARTURE')) {
				$sqlType = " AND DATE(d.wiski_dep) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'AWAIT CRF')) {
				$sqlType = " AND (d.wiski_dep IS NOT NULL AND d.wiski_dep <> '')
												AND ( (d.date_crf IS NULL OR d.date_crf = '') AND (d.ref_crf IS NULL OR d.ref_crf = '' ))";
			}

			if (isset($type) && ($type == 'DGDA IN')) {
				$sqlType = " AND DATE(dgda_in) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'UNDER PROCESS AT DGDA')) {
				$sqlType = " AND (d.dgda_in IS NOT NULL AND d.dgda_in <> '')
												AND (d.dgda_out IS NULL OR d.dgda_out = '')";
			}

			if (isset($type) && ($type == 'LIQUIDATED / AWAIT QUITTANCE')) {
				$sqlType = " AND ( (d.date_liq IS NOT NULL OR d.date_liq <> '')
													OR (d.ref_liq IS NOT NULL OR d.ref_liq <> '') )
												AND ( (d.date_quit IS NULL AND d.date_quit = '') 
													AND (d.ref_quit IS NULL AND d.ref_quit = '') )";
			}

			if (isset($type) && ($type == 'QUITTANCE')) {
				$sqlType = " AND DATE(d.date_quit) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'DGDA OUT')) {
				$sqlType = " AND DATE(d.dgda_out) = CURRENT_DATE()";
			}

			if (isset($type) && ($type == 'FILES CLEARED WAITING INVOICE')) {
				$sqlType = " AND d.cleared = '1'
												AND d.facture = '0'";
			}

			$sql1 = "";
			if (isset($commodity) && ($commodity != '')) {
				$sql1 = ' AND d.commodity = "'.$commodity.'"';
			}

			$requete = $connexion-> prepare("SELECT d.id_dos AS id_dos, d.ref_dos AS ref_dos
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND d.ref_dos BETWEEN ? AND ?
													$sql1
													$sqlType
													$sqlClient
												ORDER BY d.ref_dos ASC");
			$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic'], 
									$entree['debut'], $entree['fin']));
			
			while($reponse = $requete-> fetch()){
				//echo $reponse['id_dos'].'<br>';
		      if (isset($ref_decl) && ($ref_decl != '')) {
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

		      if (isset($date_decl) && ($date_decl != '')) {
		        $this-> MAJ_date_decl($reponse['id_dos'], $date_decl);
		      }

		      if (isset($ref_liq) && ($ref_liq != '')) {
		        $this-> MAJ_ref_liq($reponse['id_dos'], $ref_liq);
		      }

		      if (isset($date_liq) && ($date_liq != '')) {
		        $this-> MAJ_date_liq($reponse['id_dos'], $date_liq);
		      }

		      if (isset($ref_quit) && ($ref_quit != '')) {
		        $this-> MAJ_ref_quit($reponse['id_dos'], $ref_quit);
		      }

		      if (isset($date_quit) && ($date_quit != '')) {
		        $this-> MAJ_date_quit($reponse['id_dos'], $date_quit);
		      }

		      if (isset($montant_decl) && ($montant_decl != '')) {
		        $this-> MAJ_montant_decl($reponse['id_dos'], $montant_decl);
		      }

		      if (isset($klsa_arriv) && ($klsa_arriv != '')) {
		        $this-> MAJ_klsa_arriv($reponse['id_dos'], $klsa_arriv);
		      }
		      
		      if (isset($crossing_date) && ($crossing_date != '')) {
		        $this-> MAJ_crossing_date($reponse['id_dos'], $crossing_date);
		      }
		      
		      if (isset($wiski_arriv) && ($wiski_arriv != '')) {
		        $this-> MAJ_wiski_arriv($reponse['id_dos'], $wiski_arriv);
		      }
		      
		      if (isset($wiski_dep) && ($wiski_dep != '')) {
		        $this-> MAJ_wiski_dep($reponse['id_dos'], $wiski_dep);
		      }
		      
		      if (isset($ref_crf) && ($ref_crf != '')) {
		        $this-> MAJ_ref_crf($reponse['id_dos'], $ref_crf);
		      }
		      
		      if (isset($date_crf) && ($date_crf != '')) {
		        $this-> MAJ_date_crf($reponse['id_dos'], $date_crf);
		      }
		      
		      if (isset($dgda_in) && ($dgda_in != '')) {
		        $this-> MAJ_dgda_in($reponse['id_dos'], $dgda_in);
		      }
		      
		      if (isset($dgda_out) && ($dgda_out != '')) {
		        $this-> MAJ_dgda_out($reponse['id_dos'], $dgda_out);
		      	//echo "<br> $dgda_out";
		      }

		      if (isset($date_preal) && ($date_preal != '')) {
		        $this-> MAJ_date_preal($reponse['id_dos'], $date_preal);
		      }

		      if (isset($custom_deliv) && ($custom_deliv != '')) {
		        $this-> MAJ_custom_deliv($reponse['id_dos'], $custom_deliv);
		      }
		      
		      if (isset($dispatch_klsa) && ($dispatch_klsa != '')) {
		        $this-> MAJ_dispatch_klsa($reponse['id_dos'], $dispatch_klsa);
		      }
		      
		      if (isset($dispatch_deliv) && ($dispatch_deliv != '')) {
		        $this-> MAJ_dispatch_deliv($reponse['id_dos'], $dispatch_deliv);
		      }
		      
		      if (isset($cleared) && ($cleared != '')) {
		        $this-> MAJ_cleared($reponse['id_dos'], $cleared);
		      }

		      if (isset($statut) && ($statut != '')) {
		        $this-> MAJ_statut($reponse['id_dos'], $statut);
		      }

		      if (isset($remarque) && ($remarque != '')) {
		        $this-> MAJ_remarque($reponse['id_dos'], $remarque);
		      }

		      if (isset($cleared) && ($cleared != '')) {
		        $this-> MAJ_cleared($reponse['id_dos'], $cleared);
		      }

		      if (isset($amicongo_arriv) && ($amicongo_arriv != '')) {
		        $this-> MAJ_amicongo_arriv($reponse['id_dos'], $amicongo_arriv);
		      }

		      if (isset($insp_receiv) && ($insp_receiv != '')) {
		        $this-> MAJ_insp_receiv($reponse['id_dos'], $insp_receiv);
		      }

		      if (isset($ir) && ($ir != '')) {
		        $this-> MAJ_ir($reponse['id_dos'], $ir);
		      }

		      if (isset($ref_decl) && ($ref_decl != '')) {
		      	//echo "<br> $ref_decl";
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

		      if (isset($ref_decl) && ($ref_decl != '')) {
		        $this-> MAJ_ref_decl($reponse['id_dos'], $ref_decl);
		      }

			}$requete-> closeCursor();

		} 

		public function modifierFacture($ref_fact, $date_fact, $date_fact_rec, $fournisseur, $date_val, 
										$id_cli, $commodity, $montant_fact, $id_mon, $fret_fact, $assurance_fact, 
										$autre_frais_fact, $ref_fact_old){

			include('connexion.php');
			$entree['ref_fact'] = $ref_fact;
			$entree['date_fact'] = $date_fact;
			$entree['date_fact_rec'] = $date_fact_rec;
			$entree['fournisseur'] = $fournisseur;
			$entree['date_val'] = $date_val;
			$entree['id_cli'] = $id_cli;
			$entree['commodity'] = $commodity;
			$entree['montant_fact'] = $montant_fact;
			$entree['id_mon'] = $id_mon;
			$entree['fret_fact'] = $fret_fact;
			$entree['assurance_fact'] = $assurance_fact;
			$entree['autre_frais_fact'] = $autre_frais_fact;
			$entree['ref_fact_old'] = $ref_fact_old;


			if ($fret_fact == '') {
				$fret_fact = NULL;
			}
			if ($assurance_fact == '') {
				$assurance_fact = NULL;
			}
			if ($autre_frais_fact == '') {
				$autre_frais_fact = NULL;
			}
			if ($montant_fact == '') {
				$montant_fact = NULL;
			}
			/*echo '<br> ref_fact = '.$ref_fact;
			echo '<br> date_fact = '.$date_fact;
			echo '<br> date_fact_rec = '.$date_fact_rec;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> date_val = '.$date_val;
			echo '<br> id_cli = '.$id_cli;
			echo '<br> commodity = '.$commodity;
			echo '<br> montant_fact = '.$montant_fact;
			echo '<br> id_mon = '.$id_mon;
			echo '<br> fret_fact = '.$fret_fact;
			echo '<br> assurance_fact = '.$assurance_fact;
			echo '<br> autre_frais_fact = '.$autre_frais_fact;
			echo '<br> ref_fact_old = '.$ref_fact_old;*/

			$requete = $connexion-> prepare("UPDATE facture_licence 
														SET ref_fact = ?, date_fact = ?, date_fact_rec = ?, 
															fournisseur = ?, date_val = ?, id_cli = ?, 
															commodity = ?, montant_fact = ?, id_mon = ?, 
															fret_fact = ?, assurance_fact = ?, 
															autre_frais_fact = ? 	
												WHERE ref_fact = ?");
			$requete-> execute(array($entree['ref_fact'], $entree['date_fact'], $entree['date_fact_rec'], 
									$entree['fournisseur'], $entree['date_val'], $entree['id_cli'], 
									$entree['commodity'], $entree['montant_fact'], $entree['id_mon'], 
									$entree['fret_fact'], $entree['assurance_fact'], $entree['autre_frais_fact'], 
									$entree['ref_fact_old']));

		} 

		public function modifierFichierFacture($ref_fact, $fichier_fact, $tmp_fact){

			include('connexion.php');
			$entree['ref_fact'] = $ref_fact;
			$entree['fichier_fact'] = $fichier_fact;
			/*echo '<br> ref_fact = '.$ref_fact;
			echo '<br> date_fact = '.$date_fact;
			echo '<br> date_fact_rec = '.$date_fact_rec;
			echo '<br> fournisseur = '.$fournisseur;
			echo '<br> date_val = '.$date_val;
			echo '<br> id_cli = '.$id_cli;
			echo '<br> commodity = '.$commodity;
			echo '<br> montant_fact = '.$montant_fact;
			echo '<br> id_mon = '.$id_mon;
			echo '<br> fret_fact = '.$fret_fact;
			echo '<br> assurance_fact = '.$assurance_fact;
			echo '<br> autre_frais_fact = '.$autre_frais_fact;
			echo '<br> ref_fact_old = '.$ref_fact_old;*/

			$requete = $connexion-> prepare("UPDATE facture_licence 
														SET fichier_fact = ?	
												WHERE ref_fact = ?");
			$requete-> execute(array($entree['fichier_fact'], $entree['ref_fact']));

			$facture = '../factures/'.$ref_fact;

			if(!is_dir($facture)){
				mkdir("../factures/$ref_fact", 0777);
			}

			move_uploaded_file($tmp_fact, '../factures/'.$ref_fact.'/' . basename($fichier_fact));

		} 

		public function annulerDateExpirationLicence($num_lic){

			include('connexion.php');
			$entree['num_lic'] = $num_lic;
			$requete = $connexion-> prepare("UPDATE expiration_licence SET id_etat = '2'
												WHERE num_lic = ?");
			$requete-> execute(array($entree['num_lic']));

		} 

		public function MAJ_mca_b_ref($id_dos, $mca_b_ref){

			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['mca_b_ref'] = $mca_b_ref;
			$requete = $connexion-> prepare("UPDATE dossier SET mca_b_ref = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['mca_b_ref'], $entree['id_dos']));

		} 

		public function MAJ_ref_decl($id_dos, $ref_decl){

			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ref_decl'] = $ref_decl;
			$requete = $connexion-> prepare("UPDATE dossier SET ref_decl = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ref_decl'], $entree['id_dos']));

		} 

		public function MAJ_date_decl($id_dos, $date_decl){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['date_decl'] = $date_decl;
			$requete = $connexion-> prepare("UPDATE dossier SET date_decl = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['date_decl'], $entree['id_dos']));

		} 

		public function MAJ_ref_liq($id_dos, $ref_liq){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ref_liq'] = $ref_liq;
			$requete = $connexion-> prepare("UPDATE dossier SET ref_liq = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ref_liq'], $entree['id_dos']));

		} 

		public function MAJ_date_liq($id_dos, $date_liq){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['date_liq'] = $date_liq;
			$requete = $connexion-> prepare("UPDATE dossier SET date_liq = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['date_liq'], $entree['id_dos']));

		} 

		public function MAJ_ref_quit($id_dos, $ref_quit){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ref_quit'] = $ref_quit;
			$requete = $connexion-> prepare("UPDATE dossier SET ref_quit = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ref_quit'], $entree['id_dos']));

		} 

		public function MAJ_date_quit($id_dos, $date_quit){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['date_quit'] = $date_quit;
			$requete = $connexion-> prepare("UPDATE dossier SET date_quit = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['date_quit'], $entree['id_dos']));

		} 

		public function MAJ_montant_decl($id_dos, $montant_decl){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['montant_decl'] = $montant_decl;
			$requete = $connexion-> prepare("UPDATE dossier SET montant_decl = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['montant_decl'], $entree['id_dos']));

		} 

		public function MAJ_cod($id_dos, $cod){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['cod'] = $cod;
			$requete = $connexion-> prepare("UPDATE dossier SET cod = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['cod'], $entree['id_dos']));

		} 

		public function MAJ_fxi($id_dos, $fxi){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['fxi'] = $fxi;
			$requete = $connexion-> prepare("UPDATE dossier SET fxi = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['fxi'], $entree['id_dos']));

		} 

		public function MAJ_montant_av($id_dos, $montant_av){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['montant_av'] = $montant_av;
			$requete = $connexion-> prepare("UPDATE dossier SET montant_av = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['montant_av'], $entree['id_dos']));

		} 

		public function MAJ_fret_dos($id_dos, $fret){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['fret'] = $fret;
			$requete = $connexion-> prepare("UPDATE dossier SET fret = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['fret'], $entree['id_dos']));

		} 

		public function MAJ_assurance_dos($id_dos, $assurance){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['assurance'] = $assurance;
			$requete = $connexion-> prepare("UPDATE dossier SET assurance = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['assurance'], $entree['id_dos']));

		} 

		public function MAJ_autre_frais_dos($id_dos, $autre_frais){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['autre_frais'] = $autre_frais;
			$requete = $connexion-> prepare("UPDATE dossier SET autre_frais = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['autre_frais'], $entree['id_dos']));

		} 

		public function MAJ_t1($id_dos, $t1){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['t1'] = $t1;
			$requete = $connexion-> prepare("UPDATE dossier SET t1 = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['t1'], $entree['id_dos']));

		}  

		public function MAJ_poids($id_dos, $poids){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['poids'] = $poids;
			$requete = $connexion-> prepare("UPDATE dossier SET poids = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['poids'], $entree['id_dos']));

		}  

		public function MAJ_horse($id_dos, $horse){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['horse'] = $horse;
			$requete = $connexion-> prepare("UPDATE dossier SET horse = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['horse'], $entree['id_dos']));

		}  

		public function MAJ_trailer_1($id_dos, $trailer_1){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['trailer_1'] = $trailer_1;
			$requete = $connexion-> prepare("UPDATE dossier SET trailer_1 = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['trailer_1'], $entree['id_dos']));

		}  

		public function MAJ_trailer_2($id_dos, $trailer_2){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['trailer_2'] = $trailer_2;
			$requete = $connexion-> prepare("UPDATE dossier SET trailer_2 = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['trailer_2'], $entree['id_dos']));

		}  

		public function MAJ_klsa_arriv($id_dos, $klsa_arriv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['klsa_arriv'] = $klsa_arriv;
			$requete = $connexion-> prepare("UPDATE dossier SET klsa_arriv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['klsa_arriv'], $entree['id_dos']));

		}  

		public function MAJ_crossing_date($id_dos, $crossing_date){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['crossing_date'] = $crossing_date;
			$requete = $connexion-> prepare("UPDATE dossier SET crossing_date = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['crossing_date'], $entree['id_dos']));

		}  

		public function MAJ_wiski_arriv($id_dos, $wiski_arriv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['wiski_arriv'] = $wiski_arriv;
			$requete = $connexion-> prepare("UPDATE dossier SET wiski_arriv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['wiski_arriv'], $entree['id_dos']));

		}  

		public function MAJ_wiski_dep($id_dos, $wiski_dep){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['wiski_dep'] = $wiski_dep;
			$requete = $connexion-> prepare("UPDATE dossier SET wiski_dep = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['wiski_dep'], $entree['id_dos']));

		}  

		public function MAJ_ref_crf($id_dos, $ref_crf){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ref_crf'] = $ref_crf;
			$requete = $connexion-> prepare("UPDATE dossier SET ref_crf = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ref_crf'], $entree['id_dos']));

		}  

		public function MAJ_date_crf($id_dos, $date_crf){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['date_crf'] = $date_crf;
			$requete = $connexion-> prepare("UPDATE dossier SET date_crf  = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['date_crf'], $entree['id_dos']));

		}  

		public function MAJ_dgda_in($id_dos, $dgda_in){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['dgda_in'] = $dgda_in;
			$requete = $connexion-> prepare("UPDATE dossier SET dgda_in = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['dgda_in'], $entree['id_dos']));

		}  

		public function MAJ_dgda_out($id_dos, $dgda_out){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['dgda_out'] = $dgda_out;
			$requete = $connexion-> prepare("UPDATE dossier SET dgda_out = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['dgda_out'], $entree['id_dos']));

		}  

		public function MAJ_date_preal($id_dos, $date_preal){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['date_preal'] = $date_preal;
			$requete = $connexion-> prepare("UPDATE dossier SET date_preal = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['date_preal'], $entree['id_dos']));

		}

		public function MAJ_po_ref($id_dos, $po_ref){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['po_ref'] = $po_ref;
			$requete = $connexion-> prepare("UPDATE dossier SET po_ref = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['po_ref'], $entree['id_dos']));

		}
		
		public function MAJ_road_manif($id_dos, $road_manif){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['road_manif'] = $road_manif;
			$requete = $connexion-> prepare("UPDATE dossier SET road_manif = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['road_manif'], $entree['id_dos']));

		}
		
		public function MAJ_arr_bond($id_dos, $arr_bond){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['arr_bond'] = $arr_bond;
			$requete = $connexion-> prepare("UPDATE dossier SET arr_bond = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['arr_bond'], $entree['id_dos']));

		}
		
		public function MAJ_custom_deliv($id_dos, $custom_deliv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['custom_deliv'] = $custom_deliv;
			$requete = $connexion-> prepare("UPDATE dossier SET custom_deliv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['custom_deliv'], $entree['id_dos']));

		}
		
		public function MAJ_lshi_arriv($id_dos, $lshi_arriv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['lshi_arriv'] = $lshi_arriv;
			$requete = $connexion-> prepare("UPDATE dossier SET lshi_arriv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['lshi_arriv'], $entree['id_dos']));

		}
		
		public function MAJ_dispatch_klsa($id_dos, $dispatch_klsa){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['dispatch_klsa'] = $dispatch_klsa;
			$requete = $connexion-> prepare("UPDATE dossier SET dispatch_klsa = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['dispatch_klsa'], $entree['id_dos']));

		}
		
		public function MAJ_dispatch_deliv($id_dos, $dispatch_deliv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['dispatch_deliv'] = $dispatch_deliv;
			$requete = $connexion-> prepare("UPDATE dossier SET dispatch_deliv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['dispatch_deliv'], $entree['id_dos']));

		}
		
		public function MAJ_arrival_date($id_dos, $arrival_date){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['arrival_date'] = $arrival_date;
			$requete = $connexion-> prepare("UPDATE dossier SET arrival_date = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['arrival_date'], $entree['id_dos']));

		}

		public function MAJ_cleared($id_dos, $cleared){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['cleared'] = $cleared;
			$requete = $connexion-> prepare("UPDATE dossier SET cleared = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['cleared'], $entree['id_dos']));

		}

		public function MAJ_ref_fact($id_dos, $ref_fact){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ref_fact'] = $ref_fact;
			$requete = $connexion-> prepare("UPDATE dossier SET ref_fact = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ref_fact'], $entree['id_dos']));

		} 
		
		public function MAJ_fournisseur($id_dos, $fournisseur){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['fournisseur'] = $fournisseur;
			$requete = $connexion-> prepare("UPDATE dossier SET fournisseur = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['fournisseur'], $entree['id_dos']));

		} 

		public function MAJ_commodity($id_dos, $commodity){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['commodity'] = $commodity;
			$requete = $connexion-> prepare("UPDATE dossier SET commodity = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['commodity'], $entree['id_dos']));

		} 

		public function MAJ_num_lic($id_dos, $num_lic){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['num_lic'] = $num_lic;
			$requete = $connexion-> prepare("UPDATE dossier SET num_lic = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['num_lic'], $entree['id_dos']));

		} 

		public function MAJ_amicongo_arriv($id_dos, $amicongo_arriv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['amicongo_arriv'] = $amicongo_arriv;
			$requete = $connexion-> prepare("UPDATE dossier SET amicongo_arriv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['amicongo_arriv'], $entree['id_dos']));

		} 

		public function MAJ_insp_receiv($id_dos, $insp_receiv){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['insp_receiv'] = $insp_receiv;
			$requete = $connexion-> prepare("UPDATE dossier SET insp_receiv = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['insp_receiv'], $entree['id_dos']));

		} 

		public function MAJ_ir($id_dos, $ir){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['ir'] = $ir;
			$requete = $connexion-> prepare("UPDATE dossier SET ir = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['ir'], $entree['id_dos']));

		} 

		public function MAJ_remarque($id_dos, $remarque){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['remarque'] = $remarque;
			$requete = $connexion-> prepare("UPDATE dossier SET remarque = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['remarque'], $entree['id_dos']));

		} 

		public function MAJ_statut($id_dos, $statut){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['statut'] = $statut;
			$requete = $connexion-> prepare("UPDATE dossier SET statut = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['statut'], $entree['id_dos']));

		} 

		public function MAJ_fob($id_dos, $fob){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['fob'] = $fob;
			$requete = $connexion-> prepare("UPDATE dossier SET fob = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['fob'], $entree['id_dos']));

		} 

		public function MAJ_fret($id_dos, $fret){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['fret'] = $fret;
			$requete = $connexion-> prepare("UPDATE dossier SET fret = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['fret'], $entree['id_dos']));

		} 

		public function MAJ_assurance($id_dos, $assurance){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['assurance'] = $assurance;
			$requete = $connexion-> prepare("UPDATE dossier SET assurance = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['assurance'], $entree['id_dos']));

		} 

		public function MAJ_autre_frais($id_dos, $autre_frais){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['autre_frais'] = $autre_frais;
			$requete = $connexion-> prepare("UPDATE dossier SET autre_frais = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['autre_frais'], $entree['id_dos']));

		} 

		public function MAJ_supplier($id_dos, $supplier){
			
			include('connexion.php');
			$entree['id_dos'] = $id_dos;
			$entree['supplier'] = $supplier;
			$requete = $connexion-> prepare("UPDATE dossier SET supplier = ?
												WHERE id_dos = ?");
			$requete-> execute(array($entree['supplier'], $entree['id_dos']));

		} 
/*
*/
		//FIN Methodes permettant de mettre à jour

		//Methode permettant de supprimer
		public function deleteLicenceUpload($id_mod_lic, $id_util){
			
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			/*echo '<br>  id_mod_lic= '.$id_mod_lic;
			echo '<br>  id_util= '.$id_util;*/

			$requete = $connexion-> prepare("DELETE FROM licence_upload
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));

		} 

		public function deleteDossierUpload($id_mod_lic, $id_util){
			
			include('connexion.php');
			$entree['id_mod_lic'] = $id_mod_lic;
			$entree['id_util'] = $id_util;

			/*echo '<br>  id_mod_lic= '.$id_mod_lic;
			echo '<br>  id_util= '.$id_util;*/

			$requete = $connexion-> prepare("DELETE FROM dossier_upload
												WHERE id_mod_lic = ?
													AND id_util = ?
													AND etat = '0'");
			$requete-> execute(array($entree['id_mod_lic'], $entree['id_util']));

		} 
		//FIN Methode permettant de supprimer

	}
?>