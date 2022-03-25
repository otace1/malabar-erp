<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');

$maClasse = new MaClasse();

//Create PHPExcel object
$excel = new PHPExcel();

		// Rename worksheet
		$transit = '';
		if ($_GET['id_mod_trac'] == '1') {
			$transit = 'Export';
		}
		else if ($_GET['id_mod_trac'] == '2') {
			$transit = 'Import';
		}


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
$requeteModeTransport = $connexion-> prepare('SELECT DISTINCT(id_mod_trans) AS id_mod_trans, 
													UPPER(nom_mod_trans) AS nom_mod_trans 
												FROM mode_transport
												WHERE id_mod_trans IN (
													SELECT DISTINCT(id_mod_trans) 
														FROM dossier
														WHERE id_cli = ?
												)');
$requeteModeTransport-> execute(array($_GET['id_cli']));
while ($reponseModeTransport = $requeteModeTransport-> fetch()) {

	//Pour EXPORT créer des tableurs par licence et modes de transport
	if ($_GET['id_mod_trac'] == '1') {
		
		//--- Recuperation d'années -------
		if(isset($_GET['annee']) && ($_GET['annee']!='')){
			$valeur_annee = $_GET['annee'];
			$valeur_annee_fin = $_GET['annee'];
		}else{
			$valeur_annee = date('Y');
			$valeur_annee_fin = 2020;
		}
		for ($annee=$valeur_annee; $annee >= $valeur_annee_fin; $annee--) { 
			$entree['annee']='%'.substr($annee, -2).'-%';

		if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
			$id_march = $_GET['id_march'];


			$requeteLicence = $connexion-> prepare("SELECT DISTINCT(l.num_lic) AS num_lic
														FROM licence l, dossier d
														WHERE d.id_cli = ?
														AND d.id_mod_trans = ?
														AND l.num_lic = d.num_lic 
														AND l.id_mod_lic = ?
														AND d.ref_dos LIKE (?)
														ORDER BY l.date_creat_lic DESC");
		}else{


			$requeteLicence = $connexion-> prepare('SELECT DISTINCT(l.num_lic) AS num_lic
														FROM licence l, dossier d
														WHERE d.id_cli = ?
														AND d.id_mod_trans = ?
														AND l.num_lic = d.num_lic 
														AND l.id_mod_lic = ?
														AND d.ref_dos LIKE (?)
														ORDER BY l.date_creat_lic DESC');
		}

		$requeteLicence-> execute(array($_GET['id_cli'], $reponseModeTransport['id_mod_trans'], 
									$_GET['id_mod_trac'], $entree['annee']));
		while ($reponseLicence = $requeteLicence-> fetch()) {
			

			//Selecting active sheet
			$excel-> setActiveSheetIndex($indiceSheet);


			//Get data
			//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

			$entree['id_mod_lic'] = $_GET['id_mod_trac'];
			$entree['id_cli'] = $_GET['id_cli'];
			$entree['id_mod_trans'] = $reponseModeTransport['id_mod_trans'];

			$id_mod_lic = $_GET['id_mod_trac'];
			$id_cli = $_GET['id_cli'];
			$id_mod_trans = $reponseModeTransport['id_mod_trans'];

			$sql1 = "";
			$sqlOrder = "";
			$sqlIdMarch = "";
			$sqlStatus = "";
			$sqlLicence = "";
			$sqlCleared = "";
			$compteur = 0;

			$row = 1;
			$col = 'C';

			// //Image dans la cellule
			// $objDrawing = new PHPExcel_Worksheet_Drawing();
			// $objDrawing->setName('test_img');
			// $objDrawing->setDescription('Logo en-tete');
			// $objDrawing->setPath('../images/Logo MRDC.JPG');
			// $objDrawing->setHeight(40);
			// $objDrawing->setCoordinates('E1');
			// $objDrawing->setWorksheet($excel->getActiveSheet());

			//Figer colonne
			$excel->getActiveSheet()->freezePane('C2');
			
			// if($_GET['id_cli']=='857'){
			// 	$excel->getActiveSheet()->freezePane('D2');
			// }else{
			// 	$excel->getActiveSheet()->freezePane('F2');
			// }
			

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

			// $excel-> getActiveSheet()
			// 	-> setCellValue('A1', 'DAILY CLEARING ACTIVITY TRACKING SHEET');
			// $excel->getActiveSheet()
			// 	->getStyle('A1')->applyFromArray($styleHeader2);

			// //Fusionner les cellules
			// $excel-> getActiveSheet()
			// 	-> mergeCells('A1:I1');

			//Recuperation des en-tête
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

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['titre_col']);
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;
			}$requete-> closeCursor();

			
			//----------- Récuperation des dossiers ------------

			if (isset($_GET['commodity']) && ($_GET['commodity'] != '')) {
				$sql1 = ' AND d.commodity = "'.$_GET['commodity'].'"';
			}

			if ($_GET['id_mod_trac'] == '1') {
				$sqlOrder = ' ORDER BY d.id_dos ASC';
			}else if ($_GET['id_mod_trac'] == '2' && $_GET['id_mod_trac'] == '857') {
				$sqlOrder = ' ORDER BY d.id_dos ASC';
			}else if ($_GET['id_mod_trac'] == '2' && $_GET['id_mod_trac'] != '857') {
				$sqlOrder = ' ORDER BY d.ref_dos ASC';
			}

			// if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
			// 	$sqlIdMarch = ' AND d.id_march = '.$_GET['id_march'];
			// }

			if (isset($_GET['statut']) && ($_GET['statut'] != '')) {
				$sqlStatus = ' AND d.statut = "'.$_GET['statut'].'"';
			}

			$row = 2;
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
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND d.num_lic = ?
													AND d.ref_dos LIKE(?)
													$sqlIdMarch
													$sqlStatus
													$sql1
												$sqlOrder");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic'], $reponseLicence['num_lic'], $entree['annee']));
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

				afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader, $reponse['statut']);

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------


			//Dimension des Colonnes
			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

			$col = 'C';
			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {

				
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;


				// if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
				// 	$col++;
				// }else if ($reponse['id_col'] == '44') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
				// 	$col++;
				// }else if ($reponse['id_col'] == '42') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				// 	$col++;
				// }else if ($reponse['id_col'] == '43') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
				// 	$col++;
				// }else if ($reponse['id_col'] == '2') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
				// 	$col++;
				// }else if ($reponse['id_col'] == '16') {
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
				// 	$col++;
				// }else{
				// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
				// 	$col++;
				// }

			}$requete-> closeCursor();

			//Bordure des Cellules
			$excel-> getActiveSheet()-> getStyle('A2:'.$col.($row-1))-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);

			// Rename worksheet
			$transit = '';
			if ($_GET['id_mod_trac'] == '1') {
				$transit = 'Export';
			}
			else if ($_GET['id_mod_trac'] == '2') {
				$transit = 'Import';
			}

			$excel->getActiveSheet()->setTitle($reponseLicence['num_lic'].' '.$reponseModeTransport['nom_mod_trans'].' '.substr($annee, -2));


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);


			$indiceSheet++;

			$excel->createSheet();



		}$requeteLicence-> closeCursor();
	}
	//--- FIN Recuperation années -------
	

	}else{ // Pour IMPORT créer des tableurs par modes de transport

	//--- Recuperation d'années -------
	if(isset($_GET['annee']) && ($_GET['annee']!='')){
		$valeur_annee = $_GET['annee'];
		$valeur_annee_fin = $_GET['annee'];
	}else{
		$valeur_annee = date('Y');
		$valeur_annee_fin = 2020;
	}

	//GLOBAL SUMMARY POUR IMPORT ROUTE
	if ($reponseModeTransport['id_mod_trans']=='1') {
		
		$styleHeader = array(
		    'font'  => array(
		        'bold' => true,
		        'color' => array('rgb' => 'FFFFFF'),
		        'name' => 'Verdana'
		    ));

		$excel->setActiveSheetIndex($indiceSheet);

		$excel-> getActiveSheet()
			-> setCellValue('A4', 'CLEARING STATUS')
			-> setCellValue('B4', 'GENERAL STATUS')
			-> setCellValue('C4', 'TRUCK  STATUS')
			-> setCellValue('D4', 'Total');

		cellColor('A4', '000000');
		cellColor('B4', '000000');
		cellColor('C4', '000000');
		cellColor('D4', '000000');
		// alignement('A4');
		// alignement('B4');
		$excel->getActiveSheet()
			->getStyle('A4')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('B4')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('C4')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D4')->applyFromArray($styleHeader);

		//-----CANCELLED

		$excel-> getActiveSheet()
			-> setCellValue('A5', 'CANCELLED');
		$excel-> getActiveSheet()
			-> mergeCells('A5:A9');

		$excel-> getActiveSheet()
			-> setCellValue('B5', 'AWAITING CRF');
		$excel-> getActiveSheet()
			-> mergeCells('B5:B7');
		
		$excel-> getActiveSheet()
			-> setCellValue('C5', 'AT WISKI')
			-> setCellValue('D5', $maClasse-> getNbreDossierCancelledAwaitingCRFAtWiskiAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('C6', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D6', $maClasse-> getNbreDossierCancelledAwaitingCRFDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('C7', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D7', $maClasse-> getNbreDossierCancelledAwaitingCRFExceptedToArrivalAll($_GET['id_cli']));

		$excel->getActiveSheet()->setTitle('GLOBAL ROAD SUMMARY');

		$excel-> getActiveSheet()
			-> setCellValue('B8', 'AWAITING INSURANCE');
		$excel-> getActiveSheet()
			-> mergeCells('B8:B9');
		
		$excel-> getActiveSheet()
			-> setCellValue('C8', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D8', $maClasse-> getNbreDossierCancelledAwaitingAssuranceDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('C9', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D9', $maClasse-> getNbreDossierCancelledAwaitingAssuranceExceptedToArrivalAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('A10', 'CANCELLED Total')
			-> setCellValue('D10', '=SUM(D5:D9)');
		$excel-> getActiveSheet()
			-> mergeCells('A10:C10');
		cellColor('A10', '000000');
		cellColor('D10', '000000');
		$excel->getActiveSheet()
			->getStyle('A10')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D10')->applyFromArray($styleHeader);

		//-----CANCELLED

		//-----CLEARED

		$excel-> getActiveSheet()
			-> setCellValue('A11', 'CLEARED');
		$excel-> getActiveSheet()
			-> mergeCells('A11:A15');

		$excel-> getActiveSheet()
			-> setCellValue('B11', 'AWAITING BAE/BS');
		$excel-> getActiveSheet()
			-> setCellValue('C11', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D11', $maClasse-> getNbreDossierClearedAwaitingBAEDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B12', 'AWAITING CRF');
		$excel-> getActiveSheet()
			-> setCellValue('C12', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D12', $maClasse-> getNbreDossierClearedAwaitingCRFDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B13', 'AWAITING INSURANCE');
		$excel-> getActiveSheet()
			-> setCellValue('C13', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D13', $maClasse-> getNbreDossierClearedAwaitingAssuranceDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B14', 'CLEARING COMPLETED');
		$excel-> getActiveSheet()
			-> mergeCells('B14:B15');
		$excel-> getActiveSheet()
			-> setCellValue('C14', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D14', $maClasse-> getNbreDossierClearedCompletedDispatchFromKlsaAll($_GET['id_cli']));
		$excel-> getActiveSheet()
			-> setCellValue('C15', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D15', $maClasse-> getNbreDossierClearedCompletedCRFExceptedToArrivalAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('A16', 'CLEARED Total')
			-> setCellValue('D16', '=SUM(D11:D15)');
		$excel-> getActiveSheet()
			-> mergeCells('A16:C16');
		cellColor('A16', '000000');
		cellColor('D16', '000000');
		$excel->getActiveSheet()
			->getStyle('A16')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D16')->applyFromArray($styleHeader);

		//-----CLEARED

		//-----TRANSIT

		$excel-> getActiveSheet()
			-> setCellValue('A17', 'TRANSIT');
		$excel-> getActiveSheet()
			-> mergeCells('A17:A26');

		$excel-> getActiveSheet()
			-> setCellValue('B17', 'AWAITING BAE/BS');
		$excel-> getActiveSheet()
			-> setCellValue('C17', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D17', $maClasse-> getNbreDossierTransitAwaitingBAEDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B18', 'AWAITING CRF');
		$excel-> getActiveSheet()
			-> setCellValue('C18', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D18', $maClasse-> getNbreDossierTransitAwaitingCRFDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B19', 'AWAITING CRF');
		$excel-> getActiveSheet()
			-> setCellValue('C19', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D19', $maClasse-> getNbreDossierClearedTransitCRFExceptedToArrivalAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B20', 'AWAITING INSURANCE');
		$excel-> getActiveSheet()
			-> setCellValue('C20', 'AT WISKI')
			-> setCellValue('D20', $maClasse-> getNbreDossierTransitAwaitingAssuranceAtWiskiAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B21', 'AWAITING INSURANCE');
		$excel-> getActiveSheet()
			-> setCellValue('C21', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D21', $maClasse-> getNbreDossierTransitAwaitingAssuranceDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B22', 'AWAITING INSURANCE');
		$excel-> getActiveSheet()
			-> setCellValue('C22', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D22', $maClasse-> getNbreDossierTransitAwaitingAssuranceExceptedToArriveAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B23', 'AWAITING QUITTANCE');
		$excel-> getActiveSheet()
			-> setCellValue('C23', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D23', $maClasse-> getNbreDossierClearedAwaitingQuittanceDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B24', 'CLEARING COMPLETED');
		$excel-> getActiveSheet()
			-> setCellValue('C24', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D24', $maClasse-> getNbreDossierTransitClearedCompletedDispatchFromKlsaAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('B25', 'UNDER PREPARATION');
		$excel-> getActiveSheet()
			-> mergeCells('B25:B26');
		$excel-> getActiveSheet()
			-> setCellValue('C25', 'DISPATCHED FROM K\'LSA')
			-> setCellValue('D25', $maClasse-> getNbreDossierTransitUnderPreparationDispatchFromKlsaAll($_GET['id_cli']));
		$excel-> getActiveSheet()
			-> setCellValue('C26', 'EXCEPTED TO ARRIVE')
			-> setCellValue('D26', $maClasse-> getNbreDossierTransitExceptedToArrivalAll($_GET['id_cli']));

		$excel-> getActiveSheet()
			-> setCellValue('A27', 'TRANSIT Total')
			-> setCellValue('D27', '=SUM(D17:D26)');
		$excel-> getActiveSheet()
			-> mergeCells('A27:C27');
		cellColor('A27', '000000');
		cellColor('D27', '000000');
		$excel->getActiveSheet()
			->getStyle('A27')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D27')->applyFromArray($styleHeader);

		//-----TRANSIT
		
		$excel-> getActiveSheet()
			-> setCellValue('A28', 'GLOBAL Total')
			-> setCellValue('D28', '=D10+D16+D27');
		$excel-> getActiveSheet()
			-> mergeCells('A28:C28');
		cellColor('A28', '000000');
		cellColor('D28', '000000');
		$excel->getActiveSheet()
			->getStyle('A28')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D28')->applyFromArray($styleHeader);

		$excel-> getActiveSheet()-> getStyle('A4:D28')-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(25);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(10);

		$excel->getActiveSheet()->setTitle('GLOBAL ROAD SUMMARY');


		$indiceSheet++;

		$excel->createSheet();
		$excel->setActiveSheetIndex($indiceSheet);

	}
	//GLOBAL SUMMARY POUR IMPORT ROUTE


	for ($annee=$valeur_annee; $annee >= $valeur_annee_fin; $annee--) { 
		$entree['annee']='%'.substr($annee, -2).'-%';

		//Selecting active sheet
		$excel-> setActiveSheetIndex($indiceSheet);


		//SUMMARY POUR IMPORT ROUTE
		if ($reponseModeTransport['id_mod_trans']=='1') {
			
			$styleHeader = array(
			    'font'  => array(
			        'bold' => true,
			        'color' => array('rgb' => 'FFFFFF'),
			        'name' => 'Verdana'
			    ));

			$excel->setActiveSheetIndex($indiceSheet);

			$excel-> getActiveSheet()
				-> setCellValue('A4', 'CLEARING STATUS')
				-> setCellValue('B4', 'GENERAL STATUS')
				-> setCellValue('C4', 'TRUCK  STATUS')
				-> setCellValue('D4', 'Total');

			cellColor('A4', '000000');
			cellColor('B4', '000000');
			cellColor('C4', '000000');
			cellColor('D4', '000000');
			// alignement('A4');
			// alignement('B4');
			$excel->getActiveSheet()
				->getStyle('A4')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B4')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C4')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D4')->applyFromArray($styleHeader);

			//-----CANCELLED

			$excel-> getActiveSheet()
				-> setCellValue('A5', 'CANCELLED');
			$excel-> getActiveSheet()
				-> mergeCells('A5:A9');

			$excel-> getActiveSheet()
				-> setCellValue('B5', 'AWAITING CRF');
			$excel-> getActiveSheet()
				-> mergeCells('B5:B7');
			
			$excel-> getActiveSheet()
				-> setCellValue('C5', 'AT WISKI')
				-> setCellValue('D5', $maClasse-> getNbreDossierCancelledAwaitingCRFAtWiski($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('C6', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D6', $maClasse-> getNbreDossierCancelledAwaitingCRFDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('C7', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D7', $maClasse-> getNbreDossierCancelledAwaitingCRFExceptedToArrival($_GET['id_cli'], $entree['annee']));

			$excel->getActiveSheet()->setTitle('SUMMARY '.$annee);

			$excel-> getActiveSheet()
				-> setCellValue('B8', 'AWAITING INSURANCE');
			$excel-> getActiveSheet()
				-> mergeCells('B8:B9');
			
			$excel-> getActiveSheet()
				-> setCellValue('C8', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D8', $maClasse-> getNbreDossierCancelledAwaitingAssuranceDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('C9', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D9', $maClasse-> getNbreDossierCancelledAwaitingAssuranceExceptedToArrival($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('A10', 'CANCELLED Total')
				-> setCellValue('D10', '=SUM(D5:D9)');
			$excel-> getActiveSheet()
				-> mergeCells('A10:C10');
			cellColor('A10', '000000');
			cellColor('D10', '000000');
			$excel->getActiveSheet()
				->getStyle('A10')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D10')->applyFromArray($styleHeader);

			//-----CANCELLED

			//-----CLEARED

			$excel-> getActiveSheet()
				-> setCellValue('A11', 'CLEARED');
			$excel-> getActiveSheet()
				-> mergeCells('A11:A15');

			$excel-> getActiveSheet()
				-> setCellValue('B11', 'AWAITING BAE/BS');
			$excel-> getActiveSheet()
				-> setCellValue('C11', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D11', $maClasse-> getNbreDossierClearedAwaitingBAEDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B12', 'AWAITING CRF');
			$excel-> getActiveSheet()
				-> setCellValue('C12', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D12', $maClasse-> getNbreDossierClearedAwaitingCRFDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B13', 'AWAITING INSURANCE');
			$excel-> getActiveSheet()
				-> setCellValue('C13', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D13', $maClasse-> getNbreDossierClearedAwaitingAssuranceDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B14', 'CLEARING COMPLETED');
			$excel-> getActiveSheet()
				-> mergeCells('B14:B15');
			$excel-> getActiveSheet()
				-> setCellValue('C14', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D14', $maClasse-> getNbreDossierClearedCompletedDispatchFromKlsa($_GET['id_cli'], $entree['annee']));
			$excel-> getActiveSheet()
				-> setCellValue('C15', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D15', $maClasse-> getNbreDossierClearedCompletedCRFExceptedToArrival($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('A16', 'CLEARED Total')
				-> setCellValue('D16', '=SUM(D11:D15)');
			$excel-> getActiveSheet()
				-> mergeCells('A16:C16');
			cellColor('A16', '000000');
			cellColor('D16', '000000');
			$excel->getActiveSheet()
				->getStyle('A16')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D16')->applyFromArray($styleHeader);

			//-----CLEARED

			//-----TRANSIT

			$excel-> getActiveSheet()
				-> setCellValue('A17', 'TRANSIT');
			$excel-> getActiveSheet()
				-> mergeCells('A17:A26');

			$excel-> getActiveSheet()
				-> setCellValue('B17', 'AWAITING BAE/BS');
			$excel-> getActiveSheet()
				-> setCellValue('C17', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D17', $maClasse-> getNbreDossierTransitAwaitingBAEDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B18', 'AWAITING CRF');
			$excel-> getActiveSheet()
				-> setCellValue('C18', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D18', $maClasse-> getNbreDossierTransitAwaitingCRFDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B19', 'AWAITING CRF');
			$excel-> getActiveSheet()
				-> setCellValue('C19', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D19', $maClasse-> getNbreDossierClearedTransitCRFExceptedToArrival($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B20', 'AWAITING INSURANCE');
			$excel-> getActiveSheet()
				-> setCellValue('C20', 'AT WISKI')
				-> setCellValue('D20', $maClasse-> getNbreDossierTransitAwaitingAssuranceAtWiski($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B21', 'AWAITING INSURANCE');
			$excel-> getActiveSheet()
				-> setCellValue('C21', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D21', $maClasse-> getNbreDossierTransitAwaitingAssuranceDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B22', 'AWAITING INSURANCE');
			$excel-> getActiveSheet()
				-> setCellValue('C22', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D22', $maClasse-> getNbreDossierTransitAwaitingAssuranceExceptedToArrive($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B23', 'AWAITING QUITTANCE');
			$excel-> getActiveSheet()
				-> setCellValue('C23', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D23', $maClasse-> getNbreDossierClearedAwaitingQuittanceDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B24', 'CLEARING COMPLETED');
			$excel-> getActiveSheet()
				-> setCellValue('C24', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D24', $maClasse-> getNbreDossierTransitClearedCompletedDispatchFromKlsa($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('B25', 'UNDER PREPARATION');
			$excel-> getActiveSheet()
				-> mergeCells('B25:B26');
			$excel-> getActiveSheet()
				-> setCellValue('C25', 'DISPATCHED FROM K\'LSA')
				-> setCellValue('D25', $maClasse-> getNbreDossierTransitUnderPreparationDispatchFromKlsa($_GET['id_cli'], $entree['annee']));
			$excel-> getActiveSheet()
				-> setCellValue('C26', 'EXCEPTED TO ARRIVE')
				-> setCellValue('D26', $maClasse-> getNbreDossierTransitExceptedToArrival($_GET['id_cli'], $entree['annee']));

			$excel-> getActiveSheet()
				-> setCellValue('A27', 'TRANSIT Total')
				-> setCellValue('D27', '=SUM(D17:D26)');
			$excel-> getActiveSheet()
				-> mergeCells('A27:C27');
			cellColor('A27', '000000');
			cellColor('D27', '000000');
			$excel->getActiveSheet()
				->getStyle('A27')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D27')->applyFromArray($styleHeader);

			//-----TRANSIT
			
			$excel-> getActiveSheet()
				-> setCellValue('A28', 'GLOBAL Total')
				-> setCellValue('D28', '=D10+D16+D27');
			$excel-> getActiveSheet()
				-> mergeCells('A28:C28');
			cellColor('A28', '000000');
			cellColor('D28', '000000');
			$excel->getActiveSheet()
				->getStyle('A28')->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D28')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getStyle('A4:D28')-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);

			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(25);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
			$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
			$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(10);

			$excel->getActiveSheet()->setTitle('SUMMARY '.$annee);


			$indiceSheet++;

			$excel->createSheet();
			$excel->setActiveSheetIndex($indiceSheet);

		}
		//SUMMARY POUR IMPORT ROUTE


		//Get data
		//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

		$entree['id_mod_lic'] = $_GET['id_mod_trac'];
		$entree['id_cli'] = $_GET['id_cli'];
		$entree['id_mod_trans'] = $reponseModeTransport['id_mod_trans'];

		$id_mod_lic = $_GET['id_mod_trac'];
		$id_cli = $_GET['id_cli'];
		$id_mod_trans = $reponseModeTransport['id_mod_trans'];

		$sql1 = "";
		$sqlOrder = "";
		$sqlIdMarch = "";
		$sqlStatus = "";
		$sqlLicence = "";
		$sqlCleared = "";
		$compteur = 0;

		$row = 1;
		$col = 'C';

		// //Image dans la cellule
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('test_img');
		// $objDrawing->setDescription('Logo en-tete');
		// $objDrawing->setPath('../images/Logo MRDC.JPG');
		// $objDrawing->setHeight(40);
		// $objDrawing->setCoordinates('E1');
		// $objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
			if($_GET['id_cli']=='857'){
				$excel->getActiveSheet()->freezePane('D2');
			}else{
				$excel->getActiveSheet()->freezePane('F2');
			}
			

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

		// $excel-> getActiveSheet()
		// 	-> setCellValue('A1', 'DAILY CLEARING ACTIVITY TRACKING SHEET');
		// $excel->getActiveSheet()
		// 	->getStyle('A1')->applyFromArray($styleHeader2);

		// //Fusionner les cellules
		// $excel-> getActiveSheet()
		// 	-> mergeCells('A1:I1');

		//Recuperation des en-tête
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

		$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
										FROM colonne c, client cl, affectation_colonne_client_modele_licence af
										WHERE c.id_col = af.id_col
											AND af.id_cli = cl.id_cli
										    AND cl.id_cli = ?
										    AND af.id_mod_lic = ?
										    AND af.id_mod_trans = ?
										ORDER BY af.rang ASC");
		$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
		while ($reponse = $requete-> fetch()) {

			if ($reponse['id_col']=='42' && $entree['id_mod_trans']=='1') {
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
				$col++;
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['titre_col']);
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;
			}
			
		}$requete-> closeCursor();

		
		//----------- Récuperation des dossiers ------------

		if (isset($_GET['commodity']) && ($_GET['commodity'] != '')) {
			$sql1 = ' AND d.commodity = "'.$_GET['commodity'].'"';
		}

		if ($_GET['id_mod_trac'] == '1') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}/*else if ($_GET['id_mod_trac'] == '2' && $entree['id_mod_lic'] == '857') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}*/else if ($entree['id_mod_lic'] == '2' && $entree['id_cli'] == '857') {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}else  {
			$sqlOrder = ' ORDER BY d.id_dos ASC';
		}

		if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
			$sqlIdMarch = ' AND d.id_march = '.$_GET['id_march'];
		}

		if (isset($_GET['statut']) && ($_GET['statut'] != '')) {
			$sqlStatus = ' AND d.statut = "'.$_GET['statut'].'"';
		}

		$row = 2;
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
												AND cl.id_cli = ?
												AND d.id_site = s.id_site
												AND d.id_mod_trans = mt.id_mod_trans
												AND mt.id_mod_trans = ?
												AND d.id_mod_lic = ?
												AND d.ref_dos LIKE (?)
												$sqlIdMarch
												$sqlStatus
												$sql1
											$sqlOrder");
		$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic'], $entree['annee']));
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

			afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader, $reponse['statut'], $reponse['klsa_status'], $reponse['amicongo_status'], $reponse['kzi_status']);

			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des dossiers ------------

		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

		$col = 'C';
		$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
										FROM colonne c, client cl, affectation_colonne_client_modele_licence af
										WHERE c.id_col = af.id_col
											AND af.id_cli = cl.id_cli
										    AND cl.id_cli = ?
										    AND af.id_mod_lic = ?
										    AND af.id_mod_trans = ?
										ORDER BY af.rang ASC");
		$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
		while ($reponse = $requete-> fetch()) {

			if ($reponse['id_col']=='42' && $entree['id_mod_trans']=='1' && $entree['id_mod_lic']=='2') {
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;
			}else{
				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;
			}
			

			// if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			// 	$col++;
			// }else if ($reponse['id_col'] == '44') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
			// 	$col++;
			// }else if ($reponse['id_col'] == '42') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
			// 	$col++;
			// }else if ($reponse['id_col'] == '43') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
			// 	$col++;
			// }else if ($reponse['id_col'] == '2') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			// 	$col++;
			// }else if ($reponse['id_col'] == '12') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
			// 	$col++;
			// }else if ($reponse['id_col'] == '16') {
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
			// 	$col++;
			// }else{
			// 	$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
			// 	$col++;
			// }

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
		$excel-> getActiveSheet()-> getStyle('A2:'.$col.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		// Rename worksheet
		$transit = '';
		if ($_GET['id_mod_trac'] == '1') {
			$transit = 'Export';
		}
		else if ($_GET['id_mod_trac'] == '2') {
			$transit = 'Import';
		}

		$excel->getActiveSheet()->setTitle($reponseModeTransport['nom_mod_trans'].' '.$annee);


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();

		include("exportExcelRegimeSuspension.php");


	}
	
}
	if ($_GET['id_cli'] == '873') {
		include('ExcelBelote.php');
	}


$excel->setActiveSheetIndex(0);

//--- FIN Recuperation années -------
	
}$requeteModeTransport-> closeCursor();
//--- FIN Recuperation des mode de transport -------

$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].$marchandise.'_'.$transit.'_'.date('d_m_Y_h_i_s');
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