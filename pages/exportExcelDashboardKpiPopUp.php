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
		$col = 'D';

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/Logo MRDC.JPG');
		$objDrawing->setHeight(40);
		$objDrawing->setCoordinates('O1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('J4');

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

		if ($_GET['id_mod_lic'] == '1') {
		$filtre = ' LOADING DATE BETWEEN '.$_GET['debut'].' AND '.$_GET['fin'];
		}else if ($_GET['id_mod_lic'] == '2' && $_GET['id_mod_trans'] == '1') {
		$filtre = ' WISKI ARRIVAL DATE BETWEEN '.$_GET['debut'].' AND '.$_GET['fin'];
		}else if ($_GET['id_mod_lic'] == '2') {
		$filtre = ' ARRIVAL DATE BETWEEN '.$_GET['debut'].' AND '.$_GET['fin'];
		}

		$nombre_dossier = $maClasse-> nbreKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']);

		$avg = ' | AVG TIME '.round(($maClasse-> getAvgKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin'])/$nombre_dossier),2).' DAY(S)';

		if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
		$mode_transport = ' | '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
		}else{
		$mode_transport = '';
		}

		if( isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic'] != '')){
		$modele_licence = $maClasse-> getNomModeleLicence($_GET['id_mod_lic']);
		}else{
		$modele_licence = '';
		}

		if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
		$client = ' | '.$maClasse-> getElementClient($_GET['id_cli'])['nom_cli'];
		}else{
		$client = '';
		}

		if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
			$sqlClient = ' AND d.id_cli = "'.$_GET['id_cli'].'"';
		}else{
			$sqlClient = '';
		}

		if (isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans']!='')) {
			$sqlModeTransport = ' AND d.id_mod_trans = "'.$_GET['id_mod_trans'].'"';
		}else{
			$sqlModeTransport = '';
		}

		if ($_GET['id_mod_lic']=='1' && ($_GET['id_mod_trans']=='3' || $_GET['id_mod_trans']=='4') ) {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'KPIs '.$modele_licence.$client.$mode_transport.$filtre.$avg.' | TOTAL FILES '.number_format($nombre_dossier, 0, ',', ' '));

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:N1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Commodity')
				-> setCellValue('E'.$row, 'AWB Num')
				-> setCellValue('F'.$row, 'Prealerte Date')
				-> setCellValue('G'.$row, 'Loading Arrival')
				-> setCellValue('H'.$row, 'Ref. Decl.')
				-> setCellValue('I'.$row, 'Date. Decl.')
				-> setCellValue('J'.$row, 'Ref. Liq.')
				-> setCellValue('K'.$row, 'Date. Liq.')
				-> setCellValue('L'.$row, 'Ref. Quit.')
				-> setCellValue('M'.$row, 'Date. Quit.')
				-> setCellValue('N'.$row, 'Exit Drc Date')
				-> setCellValue('O'.$row, 'Timing')
				-> setCellValue('P'.$row, 'Status')
				-> setCellValue('Q'.$row, 'Comment');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			cellColor('J'.$row, '000000');
			cellColor('K'.$row, '000000');
			cellColor('L'.$row, '000000');
			cellColor('M'.$row, '000000');
			cellColor('N'.$row, '000000');
			cellColor('O'.$row, '000000');
			cellColor('P'.$row, '000000');
			cellColor('Q'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
			alignement('J'.$row);
			alignement('K'.$row);
			alignement('L'.$row);
			alignement('M'.$row);
			alignement('N'.$row);
			alignement('O'.$row);
			alignement('P'.$row);
			alignement('Q'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('E'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('K'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('L'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('M'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('N'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('P'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
													d.commodity AS commodity, 
													d.horse AS horse, d.trailer_1 AS trailer_1, 
													d.trailer_2 AS trailer_2,
													DATE_FORMAT(d.load_date, '%d/%m/%Y') AS load_date,
													d.load_date AS load_date_2,
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
													d.ref_decl AS ref_decl,
													DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
													d.ref_liq AS ref_liq,
													DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
													d.ref_quit AS ref_quit,
													DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
													DATE_FORMAT(d.exit_drc, '%d/%m/%Y') AS exit_drc,
													d.exit_drc AS exit_drc_2,
													d.statut AS statut, d.remarque AS remarque,
													d.cleared AS cleared 
												FROM dossier d, client cl
												WHERE d.id_cli = cl.id_cli 
													AND d.id_mod_lic = ?
													AND d.load_date BETWEEN ? AND ?
													$sqlClient
													$sqlModeTransport
											");
			$requete-> execute(array($_GET['id_mod_lic'], $_GET['debut'], $_GET['fin']));

			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$col = 'A';
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

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $compteur);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_dos']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['nom_cli']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['commodity']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['horse']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_preal']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['load_date']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['exit_drc']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, ($maClasse-> getDifferenceDate($reponse['exit_drc_2'], $reponse['load_date_2'])-$maClasse-> getWeekendsAndHolidays($reponse['load_date_2'], $reponse['exit_drc_2'])));

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['statut']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['remarque']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------
			
			$excel-> getActiveSheet()
				-> mergeCells('A'.$row.':N'.$row);
			
			$styleHeader = array(
					    'font'  => array(
					        'bold' => true,
					        'color' => array('rgb' => 'FFFFFF'),
					        'name' => 'Verdana'
					    ));

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
				
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
				
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, 'TOTAL');

			$excel-> getActiveSheet()
				-> setCellValue('O'.$row, '=AVERAGE(O4:O'.($row-1).')');

			alignement('A'.$row);
			cellColor('A'.$row, '000000');
			alignement('O'.$row);
			cellColor('O'.$row, '000000');

		    $row++;

			$excel-> getActiveSheet()-> getStyle('A4:'.$col.($row-1))-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);

			$excel->getActiveSheet()->setTitle('KPIs');
			$titre = 'KPIs_'.date('d_m_Y_h_i_s');

		}else if ($_GET['id_mod_lic']=='1' ) {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'KPIs '.$modele_licence.$client.$mode_transport.$filtre.$avg.' | TOTAL FILES '.number_format($nombre_dossier, 0, ',', ' '));

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:N1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Commodity')
				-> setCellValue('E'.$row, 'Horse')
				-> setCellValue('F'.$row, 'Trailer 1')
				-> setCellValue('G'.$row, 'Trailer 2')
				-> setCellValue('H'.$row, 'Prealerte Date')
				-> setCellValue('I'.$row, 'Loading Arrival')
				-> setCellValue('J'.$row, 'Ref. Decl.')
				-> setCellValue('K'.$row, 'Date. Decl.')
				-> setCellValue('L'.$row, 'Ref. Liq.')
				-> setCellValue('M'.$row, 'Date. Liq.')
				-> setCellValue('N'.$row, 'Ref. Quit.')
				-> setCellValue('O'.$row, 'Date. Quit.')
				-> setCellValue('P'.$row, 'Exit Drc Date')
				-> setCellValue('Q'.$row, 'Timing')
				-> setCellValue('R'.$row, 'Status')
				-> setCellValue('S'.$row, 'Comment');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			cellColor('J'.$row, '000000');
			cellColor('K'.$row, '000000');
			cellColor('L'.$row, '000000');
			cellColor('M'.$row, '000000');
			cellColor('N'.$row, '000000');
			cellColor('O'.$row, '000000');
			cellColor('P'.$row, '000000');
			cellColor('Q'.$row, '000000');
			cellColor('R'.$row, '000000');
			cellColor('S'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
			alignement('J'.$row);
			alignement('K'.$row);
			alignement('L'.$row);
			alignement('M'.$row);
			alignement('N'.$row);
			alignement('O'.$row);
			alignement('P'.$row);
			alignement('Q'.$row);
			alignement('R'.$row);
			alignement('S'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('E'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('K'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('L'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('M'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('N'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('P'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('R'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('S'.$row)->applyFromArray($styleHeader);

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
													d.commodity AS commodity, 
													d.horse AS horse, d.trailer_1 AS trailer_1, 
													d.trailer_2 AS trailer_2,
													DATE_FORMAT(d.load_date, '%d/%m/%Y') AS load_date,
													d.load_date AS load_date_2,
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
													d.ref_decl AS ref_decl,
													DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
													d.ref_liq AS ref_liq,
													DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
													d.ref_quit AS ref_quit,
													DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
													DATE_FORMAT(d.exit_drc, '%d/%m/%Y') AS exit_drc,
													d.exit_drc AS exit_drc_2,
													d.statut AS statut, d.remarque AS remarque,
													d.cleared AS cleared 
												FROM dossier d, client cl
												WHERE d.id_cli = cl.id_cli 
													AND d.id_mod_lic = ?
													AND d.load_date BETWEEN ? AND ?
													$sqlClient
													$sqlModeTransport
											");
			$requete-> execute(array($_GET['id_mod_lic'], $_GET['debut'], $_GET['fin']));

			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$col = 'A';
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

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $compteur);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_dos']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['nom_cli']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['commodity']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['horse']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['trailer_1']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['trailer_2']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_preal']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['load_date']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['exit_drc']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, ($maClasse-> getDifferenceDate($reponse['exit_drc_2'], $reponse['load_date_2'])-$maClasse-> getWeekendsAndHolidays($reponse['load_date_2'], $reponse['exit_drc_2'])));

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['statut']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['remarque']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------
			
			$excel-> getActiveSheet()
				-> mergeCells('A'.$row.':P'.$row);
			
			$styleHeader = array(
					    'font'  => array(
					        'bold' => true,
					        'color' => array('rgb' => 'FFFFFF'),
					        'name' => 'Verdana'
					    ));

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
				
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);
				
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, 'TOTAL');

			$excel-> getActiveSheet()
				-> setCellValue('Q'.$row, '=AVERAGE(Q4:Q'.($row-1).')');

			alignement('A'.$row);
			cellColor('A'.$row, '000000');
			alignement('Q'.$row);
			cellColor('Q'.$row, '000000');

		    $row++;

			$excel-> getActiveSheet()-> getStyle('A4:'.$col.($row-1))-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);

			$excel->getActiveSheet()->setTitle('KPIs');
			$titre = 'KPIs_'.date('d_m_Y_h_i_s');

		}else if ($_GET['id_mod_lic']=='2' && ($_GET['id_mod_trans']=='3' || $_GET['id_mod_trans']=='4') ) {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'KPIs '.$modele_licence.$client.$mode_transport.$filtre.$avg.' | TOTAL FILES '.number_format($nombre_dossier, 0, ',', ' '));

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:N1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Commodity')
				-> setCellValue('E'.$row, 'AWB Num.')
				-> setCellValue('F'.$row, 'Prealerte Date')
				-> setCellValue('G'.$row, 'Arrival Date')
				-> setCellValue('H'.$row, 'Ref. Decl.')
				-> setCellValue('I'.$row, 'Date. Decl.')
				-> setCellValue('J'.$row, 'Ref. Liq.')
				-> setCellValue('K'.$row, 'Date. Liq.')
				-> setCellValue('L'.$row, 'Ref. Quit.')
				-> setCellValue('M'.$row, 'Date. Quit.')
				-> setCellValue('N'.$row, 'Dispatch/Deliver Date')
				-> setCellValue('O'.$row, 'Timing')
				-> setCellValue('P'.$row, 'Status')
				-> setCellValue('Q'.$row, 'Comment');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			cellColor('J'.$row, '000000');
			cellColor('K'.$row, '000000');
			cellColor('L'.$row, '000000');
			cellColor('M'.$row, '000000');
			cellColor('N'.$row, '000000');
			cellColor('O'.$row, '000000');
			cellColor('P'.$row, '000000');
			cellColor('Q'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
			alignement('J'.$row);
			alignement('K'.$row);
			alignement('L'.$row);
			alignement('M'.$row);
			alignement('N'.$row);
			alignement('O'.$row);
			alignement('P'.$row);
			alignement('Q'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('E'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('K'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('L'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('M'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('N'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('P'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity, 
														d.horse AS horse, d.trailer_1 AS trailer_1, 
														d.trailer_2 AS trailer_2,
														DATE_FORMAT(d.arrival_date, '%d/%m/%Y') AS arrival_date,
														d.arrival_date AS arrival_date_2,
														DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														DATE_FORMAT(d.dispatch_deliv, '%d/%m/%Y') AS dispatch_deliv,
														d.dispatch_deliv AS dispatch_deliv_2,
														d.statut AS statut, d.remarque AS remarque 
													FROM dossier d, client cl
													WHERE d.id_cli = cl.id_cli 
														AND d.id_mod_lic = ?
														AND d.arrival_date BETWEEN ? AND ?
														$sqlClient
														$sqlModeTransport
											");
			$requete-> execute(array($_GET['id_mod_lic'], $_GET['debut'], $_GET['fin']));

			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$col = 'A';
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

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $compteur);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_dos']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['nom_cli']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['commodity']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['horse']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_preal']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['arrival_date']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_deliv']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, ($maClasse-> getDifferenceDate($reponse['dispatch_deliv_2'], $reponse['arrival_date_2'])-$maClasse-> getWeekendsAndHolidays($reponse['arrival_date_2'], $reponse['dispatch_deliv_2'])));

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['statut']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['remarque']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------
			
			$excel-> getActiveSheet()
				-> mergeCells('A'.$row.':N'.$row);
			
			$styleHeader = array(
					    'font'  => array(
					        'bold' => true,
					        'color' => array('rgb' => 'FFFFFF'),
					        'name' => 'Verdana'
					    ));

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
				
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
				
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, 'TOTAL');

			$excel-> getActiveSheet()
				-> setCellValue('O'.$row, '=AVERAGE(O4:O'.($row-1).')');

			alignement('A'.$row);
			cellColor('A'.$row, '000000');
			alignement('O'.$row);
			cellColor('O'.$row, '000000');

		    $row++;

			$excel-> getActiveSheet()-> getStyle('A4:'.$col.($row-1))-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);

			$excel->getActiveSheet()->setTitle('KPIs');
			$titre = 'KPIs_'.date('d_m_Y_h_i_s');

		}else if ($_GET['id_mod_lic']=='2') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'KPIs '.$modele_licence.$client.$mode_transport.$filtre.$avg.' | TOTAL FILES '.number_format($nombre_dossier, 0, ',', ' '));

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:N1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Commodity')
				-> setCellValue('E'.$row, 'Horse')
				-> setCellValue('F'.$row, 'Trailer 1')
				-> setCellValue('G'.$row, 'Trailer 2')
				-> setCellValue('H'.$row, 'Prealerte Date')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Ref. Decl.')
				-> setCellValue('K'.$row, 'Date. Decl.')
				-> setCellValue('L'.$row, 'Ref. Liq.')
				-> setCellValue('M'.$row, 'Date. Liq.')
				-> setCellValue('N'.$row, 'Ref. Quit.')
				-> setCellValue('O'.$row, 'Date. Quit.')
				-> setCellValue('P'.$row, 'Dispatch/Deliver Date')
				-> setCellValue('Q'.$row, 'Timing')
				-> setCellValue('R'.$row, 'Status')
				-> setCellValue('S'.$row, 'Comment');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			cellColor('J'.$row, '000000');
			cellColor('K'.$row, '000000');
			cellColor('L'.$row, '000000');
			cellColor('M'.$row, '000000');
			cellColor('N'.$row, '000000');
			cellColor('O'.$row, '000000');
			cellColor('P'.$row, '000000');
			cellColor('Q'.$row, '000000');
			cellColor('R'.$row, '000000');
			cellColor('S'.$row, '000000');

			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
			alignement('J'.$row);
			alignement('K'.$row);
			alignement('L'.$row);
			alignement('M'.$row);
			alignement('N'.$row);
			alignement('O'.$row);
			alignement('P'.$row);
			alignement('Q'.$row);
			alignement('R'.$row);
			alignement('S'.$row);

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('C'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('D'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('E'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('K'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('L'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('M'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('N'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('O'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('P'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('R'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('S'.$row)->applyFromArray($styleHeader);

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity, 
														d.horse AS horse, d.trailer_1 AS trailer_1, 
														d.trailer_2 AS trailer_2,
														IF(d.id_mod_trans='1', DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y'), DATE_FORMAT(d.arrival_date, '%d/%m/%Y')) AS wiski_arriv,
														IF(d.id_mod_trans='1', d.wiski_arriv, d.arrival_date) AS wiski_arriv_2,
														DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														DATE_FORMAT(d.dispatch_deliv, '%d/%m/%Y') AS dispatch_deliv,
														d.dispatch_deliv AS dispatch_deliv_2,
														d.statut AS statut, d.remarque AS remarque,
														d.cleared AS cleared 
													FROM dossier d, client cl
													WHERE d.id_cli = cl.id_cli 
														AND d.id_mod_lic = ?
														AND d.wiski_arriv BETWEEN ? AND ?
														$sqlClient
														$sqlModeTransport
											");
			$requete-> execute(array($_GET['id_mod_lic'], $_GET['debut'], $_GET['fin']));

			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";
				$col = 'A';
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

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $compteur);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_dos']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['nom_cli']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['commodity']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['horse']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['trailer_1']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['trailer_2']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_preal']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['wiski_arriv']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_decl']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_liq']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['ref_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['date_quit']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_deliv']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, ($maClasse-> getDifferenceDate($reponse['dispatch_deliv_2'], $reponse['wiski_arriv_2'])-$maClasse-> getWeekendsAndHolidays($reponse['wiski_arriv_2'], $reponse['dispatch_deliv_2'])));

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['statut']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['remarque']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------
			
			$excel-> getActiveSheet()
				-> mergeCells('A'.$row.':P'.$row);
			
			$styleHeader = array(
					    'font'  => array(
					        'bold' => true,
					        'color' => array('rgb' => 'FFFFFF'),
					        'name' => 'Verdana'
					    ));

			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
				
			$excel->getActiveSheet()
				->getStyle('Q'.$row)->applyFromArray($styleHeader);
				
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, 'TOTAL');

			$excel-> getActiveSheet()
				-> setCellValue('Q'.$row, '=AVERAGE(Q4:Q'.($row-1).')');

			alignement('A'.$row);
			cellColor('A'.$row, '000000');
			alignement('Q'.$row);
			cellColor('Q'.$row, '000000');

		    $row++;

			$excel-> getActiveSheet()-> getStyle('A4:'.$col.($row-1))-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);

			$excel->getActiveSheet()->setTitle('KPIs');
			$titre = 'KPIs_'.date('d_m_Y_h_i_s');

		}

		


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