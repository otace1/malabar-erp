<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');

$maClasse = new MaClasse();

//Create PHPExcel object
$excel = new PHPExcel();

//Background-color
	function cellColor($cells,$color){
	    global $excel;

	    $excel->getActiveSheet()->getStyle($cells)->getFill()->applyFromArray(array(
	        'type' => PHPExcel_Style_Fill::FILL_SOLID,
	        'startcolor' => array(
	             'rgb' => $color
	        )
	    ));
	}
	
	function alignement($cells){
		global $excel;
		$style = array(
			  'alignment' => array( 
			  	'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
			  	'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
			  	'wrap' => true // retour à la ligne automatique
			  ),
			  'font'  => array(
			  	'size'  => 9
			  )
			);
		$excel->getActiveSheet()->getStyle($cells)->applyFromArray($style);
	}


include('../classes/connexion.php');
include('afficherRowTableauExcel.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;

		//Selecting active sheet
		$excel-> setActiveSheetIndex($indiceSheet);


		//Get data
		//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

		$row = 3;
		$col = 'C';
		$compteur = 0;

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/Logo MRDC.JPG');
		$objDrawing->setHeight(40);
		$objDrawing->setCoordinates('I1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('D4');

		/*$objDrawing = new PHPExcel_Worksheet_MemoryDrawing();
		$objDrawing->setName('Sample image');
		$objDrawing->setDescription('Sample image');
		$objDrawing->setImageResource($gdImage);
		$objDrawing->setRenderingFunction(PHPExcel_Worksheet_MemoryDrawing::RENDERING_JPEG);
		$objDrawing->setMimeType(PHPExcel_Worksheet_MemoryDrawing::MIMETYPE_DEFAULT);
		$objDrawing->setHeight(150);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($excel->getActiveSheet());*/

		//Font-Color
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
			-> setCellValue('A1', $_GET['etat']);
				
		$excel->getActiveSheet()
			->getStyle('A1')->applyFromArray($styleHeader2);

		//Fusionner les cellules
		$excel-> getActiveSheet()
			-> mergeCells('A1:I1');

		//Recuperation des en-tête
		if($_GET['id_mod_lic']=='1'){

			$entree['id_cli'] = 869;

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['titre_col']);
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;
			}$requete-> closeCursor();



			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND d.id_cli = '.$_GET['id_cli']; 
			}else{
				$sqlClient = '';
			}

			if (isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']!='')) {
				$sqlModeLic = " AND d.id_mod_lic = $id_mod_lic"; 
			}else{
				$sqlModeLic = '';
			}

			if (isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans']!='')) {
				$sqlTrans = " AND d.id_mod_trans = $id_mod_trans"; 
			}else{
				$sqlTrans = '';
			}

			if (isset($_GET['commodity']) && ($_GET['commodity']!='')) {
				$sqlCommodity = " AND d.commodity = $commodity"; 
			}else{
				$sqlCommodity = '';
			}
			
			$sqlCleared = '';
			if ($_GET['etat'] == 'TOTAL FILES') {
				$sqlCleared = '';
			}else if ($_GET['etat'] == 'CLEARING COMPLETED') {
				$sqlCleared = "AND d.cleared='1'";
			}else if ($_GET['etat'] == 'FILES IN PROCESS') {
				$sqlCleared = "AND d.cleared='0'";
			}else if ($_GET['etat'] == 'CANCELLED') {
				$sqlCleared = "AND d.cleared='2'";
			}

			$row = 4;
			$col = 'C';
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
													d.cleared AS cleared,

													
													IF(d.id_mod_lic='2' AND d.id_mod_trans='1',
														IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
													      'AWAITING CRF/AD/INSURRANCE',
													      IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
													        'AWAITING CRF/AD',
													          IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
													            'AWAITING CRF/INSURRANCE',
													            IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NOT NULL,
													              'AWAITING CRF', 
													              IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
													                'AWAITING AD/INSURRANCE',
													                IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
													                  'AWAITING AD',
													                    IF(d.date_crf IS NOT NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
													                      'AWAITING INSURRANCE',

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

													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													$sqlClient
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sqlCleared
												ORDER BY d.id_dos ASC");
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
					-> setCellValue('B'.$row, $reponse['ref_dos']);

				$excel->getActiveSheet()
					->getStyle('A'.$row)->applyFromArray($styleHeader);
				$excel->getActiveSheet()
					->getStyle('B'.$row)->applyFromArray($styleHeader);

				alignement('A'.$row);
				alignement('B'.$row);

				afficherRowTableauExcel($_GET['id_mod_lic'], $entree['id_cli'], $_GET['id_mod_trans'], $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader, $reponse['statut'], $reponse['klsa_status'], $reponse['amicongo_status'], $reponse['kzi_status']);

				$row++;

			}$requete-> closeCursor();

		}else if($_GET['id_mod_lic']=='2'){

			$entree['id_cli'] = 857;

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {
				
				if ($reponse['id_col']=='42' && $_GET['id_mod_trans']=='1' && $_GET['id_mod_lic']=='2') {
					$excel-> getActiveSheet()
						-> setCellValue($col.$row, 'GENERAL STATUS');
					cellColor($col.$row, '000000');
					alignement($col.$row);
					$excel->getActiveSheet()
						->getStyle($col.$row)->applyFromArray($styleHeader);

					$excel->getActiveSheet()
				        ->getColumnDimension($col)
				        ->setAutoSize(true);

					$col++;

					$excel-> getActiveSheet()
						-> setCellValue($col.$row, 'KLSA STATUS');
					cellColor($col.$row, '000000');
					alignement($col.$row);
					$excel->getActiveSheet()
						->getStyle($col.$row)->applyFromArray($styleHeader);

					$excel->getActiveSheet()
				        ->getColumnDimension($col)
				        ->setAutoSize(true);

					$col++;

					$excel-> getActiveSheet()
						-> setCellValue($col.$row, 'AMICONGO STATUS');
					cellColor($col.$row, '000000');
					alignement($col.$row);
					$excel->getActiveSheet()
						->getStyle($col.$row)->applyFromArray($styleHeader);

					$excel->getActiveSheet()
				        ->getColumnDimension($col)
				        ->setAutoSize(true);

					$col++;

					$excel-> getActiveSheet()
						-> setCellValue($col.$row, 'KZI STATUS');
					cellColor($col.$row, '000000');
					alignement($col.$row);
					$excel->getActiveSheet()
						->getStyle($col.$row)->applyFromArray($styleHeader);

					$excel->getActiveSheet()
				        ->getColumnDimension($col)
				        ->setAutoSize(true);

					$col++;
				}else{
					$excel-> getActiveSheet()
						-> setCellValue($col.$row, $reponse['titre_col']);
					cellColor($col.$row, '000000');
					alignement($col.$row);
					$excel->getActiveSheet()
						->getStyle($col.$row)->applyFromArray($styleHeader);

					$excel->getActiveSheet()
				        ->getColumnDimension($col)
				        ->setAutoSize(true);

					$col++;
				}
				
			}$requete-> closeCursor();



			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND d.id_cli = '.$_GET['id_cli']; 
			}else{
				$sqlClient = '';
			}

			if (isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']!='')) {
				$sqlModeLic = ' AND d.id_mod_lic = '.$_GET['id_mod_lic']; 
			}else{
				$sqlModeLic = '';
			}

			if (isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans']!='')) {
				$sqlTrans = ' AND d.id_mod_trans = '.$_GET['id_mod_trans']; 
			}else{
				$sqlTrans = '';
			}

			if (isset($_GET['commodity']) && ($_GET['commodity']!='')) {
				$sqlCommodity = " AND d.commodity = $commodity"; 
			}else{
				$sqlCommodity = '';
			}
			
			$sqlCleared = '';
			if ($_GET['etat'] == 'TOTAL FILES') {
				$sqlCleared = '';
			}else if ($_GET['etat'] == 'CLEARING COMPLETED') {
				$sqlCleared = "AND d.cleared='1'";
			}else if ($_GET['etat'] == 'FILES IN PROCESS') {
				$sqlCleared = "AND d.cleared='0'";
			}else if ($_GET['etat'] == 'CANCELLED') {
				$sqlCleared = "AND d.cleared='2'";
			}

			$row = 4;
			$col = 'C';
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
													d.cleared AS cleared,

													
													IF(d.id_mod_lic='2' AND d.id_mod_trans='1',
														IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
													      'AWAITING CRF/AD/INSURRANCE',
													      IF(d.date_crf IS NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
													        'AWAITING CRF/AD',
													          IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
													            'AWAITING CRF/INSURRANCE',
													            IF(d.date_crf IS NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NOT NULL,
													              'AWAITING CRF', 
													              IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NULL,
													                'AWAITING AD/INSURRANCE',
													                IF(d.date_crf IS NOT NULL AND d.date_ad IS NULL AND d.date_assurance IS NOT NULL,
													                  'AWAITING AD',
													                    IF(d.date_crf IS NOT NULL AND d.date_ad IS NOT NULL AND d.date_assurance IS NULL,
													                      'AWAITING INSURRANCE',

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

													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													$sqlClient
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													$sqlCleared
												ORDER BY d.id_dos ASC");
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
					-> setCellValue('B'.$row, $reponse['ref_dos']);

				$excel->getActiveSheet()
					->getStyle('A'.$row)->applyFromArray($styleHeader);
				$excel->getActiveSheet()
					->getStyle('B'.$row)->applyFromArray($styleHeader);

				alignement('A'.$row);
				alignement('B'.$row);

				afficherRowTableauExcel($_GET['id_mod_lic'], $entree['id_cli'], $_GET['id_mod_trans'], $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader, $reponse['statut'], $reponse['klsa_status'], $reponse['amicongo_status'], $reponse['kzi_status']);

				$row++;

			}$requete-> closeCursor();

		}
			
		//----------- Récuperation des dossiers ------------
		
		//----------- FIN Récuperation des dossiers ------------
		$excel-> getActiveSheet()-> getStyle('A4:'.$col.($row-1))-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);

		$excel->getActiveSheet()->setTitle($_GET['etat']);
		$titre = $_GET['etat'].'_'.date('d_m_Y_h_i_s');


		


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


//--- FIN Recuperation années -------
	


// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$titre.'.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel5');
ob_end_clean();
$objWriter->save('php://output');

?>