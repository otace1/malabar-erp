<?php
//Font-Color

		$row = 3;
		$col = 'D';

		//Image dans la cellule
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('test_img');
		// $objDrawing->setDescription('Logo en-tete');
		// $objDrawing->setPath('../images/Logo MRDC.JPG');
		// $objDrawing->setHeight(40);
		// $objDrawing->setCoordinates('E1');
		// $objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('F4');

		$styleHeader2 = array(
		    'font'  => array(
		        'bold' => true,
		        'color' => array('rgb' => '0000FF'),
		        'name' => 'Verdana'
		    ));

		$styleHeader = array(
		    'font'  => array(
		        'bold' => true,
		        'color' => array('rgb' => 'FFFFFF'),
		        'name' => 'Verdana'
		    ));

		$excel-> getActiveSheet()
			-> setCellValue('A1', $statut);
		$excel->getActiveSheet()
			->getStyle('A1')->applyFromArray($styleHeader2);

		//Fusionner les cellules
		$excel-> getActiveSheet()
			-> mergeCells('A1:I1');

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, '#')
			-> setCellValue('B'.$row, 'MCA REF')
			-> setCellValue('C'.$row, 'CUSTOMER NAME');

		cellColor('A'.$row, '000000');
		cellColor('B'.$row, '000000');
		cellColor('C'.$row, '000000');
		alignement('A'.$row);
		alignement('B'.$row);
		alignement('C'.$row);
		$excel->getActiveSheet()
			->getStyle('A'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('B'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('C'.$row)->applyFromArray($styleHeader);

		if(isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']=='2')){
			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
			}else{
				$sqlClient = ' AND cl.id_cli = 857';
			}

		}else if(isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']=='1')){
			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
			}else{
				$sqlClient = ' AND cl.id_cli = 869';
			}

		} 

		$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
										FROM colonne c, client cl, affectation_colonne_client_modele_licence af
										WHERE c.id_col = af.id_col
											AND af.id_cli = cl.id_cli
										    $sqlClient
										    AND af.id_mod_lic = ?
										    AND af.id_mod_trans = ?
										ORDER BY af.rang ASC");
		$requete-> execute(array($_GET['id_mod_lic'], $_GET['id_mod_trans']));
		while ($reponse = $requete-> fetch()) {
			if ($reponse['id_col']=='42' && $_GET['id_mod_lic']=='2') {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, 'GENERAL STATUS');
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, 'KLSA STATUS');
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, 'AMICONGO STATUS');
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, 'KZI STATUS');
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);

			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['titre_col']);
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
			}


			if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			}else if ($reponse['id_col'] == '44') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
			}else if ($reponse['id_col'] == '42' && $_GET['id_mod_lic']=='2') {

				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);

			}else if ($reponse['id_col'] == '42') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
			}else if ($reponse['id_col'] == '43') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
			}else if ($reponse['id_col'] == '2') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			}else if ($reponse['id_col'] == '12') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			}else if ($reponse['id_col'] == '16') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
			}else{
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
			}

			$col++;
		}$requete-> closeCursor();

		
		//----------- Récuperation des dossiers ------------

		if (isset($_GET['commodity']) && ($_GET['commodity'] != '')) {
			$sql1 = ' AND d.commodity = "'.$_GET['commodity'].'"';
		}

		if ($_GET['id_mod_trans'] == '1') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}/*else if ($_GET['id_mod_trans'] == '2' && $_GET['id_mod_lic'] == '857') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}*/else if ($_GET['id_mod_lic'] == '2' && $_GET['id_cli'] == '857') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}else  {
			$sqlOrder = ' ORDER BY d.ref_dos ASC';
		}

		if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
			$sqlIdMarch = ' AND d.id_march = '.$_GET['id_march'];
		}

            if ($_GET['id_mod_trans'] == '1') {
              
				if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
					$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
				}else{
					$sqlClient = '';
				}

            }else if ($_GET['id_mod_trans'] == '2') {
              
				if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
					$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
				}else{
					$sqlClient = '';
				}

            }else if ($_GET['id_mod_trans'] == '3') {
              
				if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
					$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
				}else{
					$sqlClient = '';
				}

            }

		if ($statut == 'AWAITING CRF/AD/INSURANCE') {

			$sqlStatus = " AND d.date_crf IS NULL
											AND d.ref_dos NOT LIKE '%20-%'
											AND d.cleared <> '2'";

		}else if ($statut == 'UNDER PREPARATION') {

			$sqlStatus = " AND d.date_crf IS NOT NULL
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

		$row = 4;
		$col = 'D';
		$compteur = 0;
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

												IF(d.id_mod_lic='2',
													IF(d.date_crf IS NULL, 'AWAITING CRF/AD/INSURANCE',
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
													,
													d.statut) AS statut,

												IF(d.id_mod_trans='1' AND d.id_mod_lic='2', 
													IF(d.klsa_arriv IS NOT NULL AND d.wiski_arriv IS NULL,'ARRIVED AT K\'LSA', 
														IF(d.wiski_arriv IS NOT NULL AND d.dispatch_klsa IS NULL, 'AT WISKI',
															IF(d.dispatch_klsa IS NOT NULL, 'DISPATCHED FROM K\'LSA', 'EXCEPTED TO ARRIVE')
															)
														)
													, '') AS klsa_status,
												IF(d.id_mod_trans='1' AND d.id_mod_lic='2', 
													IF(d.bond_warehouse='LUBUMBASHI',
														IF(d.warehouse_arriv IS NOT NULL AND d.warehouse_dep IS NOT NULL, 'DISPATCHED FROM AMICONGO', 
															IF(d.warehouse_arriv IS NOT NULL, 'ARRIVED AT AMICONGO', '')
															)
														,'')
													,'') AS amicongo_status,
												IF(d.id_mod_trans='1' AND d.id_mod_lic='2', 
													IF(d.bond_warehouse='KOLWEZI',
														IF(d.warehouse_arriv IS NOT NULL AND d.warehouse_dep IS NOT NULL, 'DISPATCHED FROM WAREHOUSE', 
															IF(d.warehouse_arriv IS NOT NULL, 'ARRIVED AT WAREHOUSE', '')
															)
														,'')
													,'') AS kzi_status,

												d.cleared AS cleared,
												DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
												DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
											FROM dossier d, client cl, site s, mode_transport mt
											WHERE d.id_cli =  cl.id_cli
												$sqlClient
												AND d.id_site = s.id_site
												AND d.id_mod_trans = mt.id_mod_trans
												AND mt.id_mod_trans = ?
												AND d.id_mod_lic = ?
												$sqlIdMarch
												$sqlStatus
												$sql1
											$sqlOrder");
		$requete-> execute(array($_GET['id_mod_trans'], $_GET['id_mod_lic']));
		while ($reponse = $requete-> fetch()) {
			$compteur++;
			$bg = "";

			if ($reponse['cleared'] == '1') {
				$style = "style='color: blue;'";
				$styleHeader = array(
				    'font'  => array(
				        'color' => array('rgb' => '0000FF')
				    ));

			}else if ($reponse['cleared'] == '2') {
				$style = "style='color: red;'";
				$styleHeader = array(
				    'font'  => array(
				        'color' => array('rgb' => 'FF0000')
				    ));
			}else{
				$style = "";
				$styleHeader = array(
				    'font'  => array(
				        'color' => array('rgb' => '000000')
				    ));
			}

			$date_exp = $maClasse-> getLastEpirationLicence($reponse['num_lic']);

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur)
				-> setCellValue('B'.$row, $reponse['ref_dos'])
				-> setCellValue('C'.$row, $reponse['nom_cli']);

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C'.$row)->applyFromArray($styleHeader);

			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);

			afficherRowTableauExcel($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader, $reponse['statut'], $reponse['klsa_status'], $reponse['amicongo_status'], $reponse['kzi_status']);

			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des dossiers ------------


		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);

		$col = 'D';
		$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
										FROM colonne c, client cl, affectation_colonne_client_modele_licence af
										WHERE c.id_col = af.id_col
											AND af.id_cli = cl.id_cli
										    AND cl.id_cli = ?
										    AND af.id_mod_lic = ?
										    AND af.id_mod_trans = ?
										ORDER BY af.rang ASC");
		$requete-> execute(array($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans']));
		while ($reponse = $requete-> fetch()) {

			if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
				$col++;
			}else if ($reponse['id_col'] == '44') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
				$col++;
			}else if ($reponse['id_col'] == '42' && $_GET['id_mod_lic']=='2') {

				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$col++;
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$col++;
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$col++;
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);

			}else if ($reponse['id_col'] == '42') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$col++;
			}else if ($reponse['id_col'] == '43') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
				$col++;
			}else if ($reponse['id_col'] == '2') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
				$col++;
			}else if ($reponse['id_col'] == '12') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
				$col++;
			}else if ($reponse['id_col'] == '16') {
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				$col++;
			}else{
				$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
				$col++;
			}

		}$requete-> closeCursor();

		     $excel->getActiveSheet()->getStyle('B:'.$col)->getAlignment()->applyFromArray(
		             array(
		                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		                 'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		                 'rotation'   => 0,
		                 'wrap'       => true
		             )
		     );


		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A3:'.$col.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);


	


?>