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
		$objDrawing->setCoordinates('I1');
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

		if ($_GET['type']=='KASUMBALESA TRUCK ARRIVAL') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'KASUMBALESA TRUCK ARRIVAL');

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
													DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 3
													AND d.id_mod_trans = '1'
													AND DATEDIFF(CURRENT_DATE() , d.klsa_arriv)<3
													AND d.ref_dos NOT LIKE '%20-%'
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

		}else if ($_GET['type']=='DISPATCH-DELIVER') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'DISPATCH-DELIVER');

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Dispatch / Deliver');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
													DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.dispatch_deliv, '%d/%m/%Y') AS dispatch_deliv, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 3
													AND d.id_mod_trans = '1'
													AND DATEDIFF(CURRENT_DATE() , d.dispatch_deliv)<3
													AND d.ref_dos NOT LIKE '%20-%'
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

		}else if ($_GET['type']=='WISKI TRUCK ARRIVAL') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'WISKI TRUCK ARRIVAL');

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			cellColor('C'.$row, '000000');
			cellColor('D'.$row, '000000');
			cellColor('E'.$row, '000000');
			cellColor('F'.$row, '000000');
			cellColor('G'.$row, '000000');
			cellColor('H'.$row, '000000');
			cellColor('I'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			alignement('C'.$row);
			alignement('D'.$row);
			alignement('E'.$row);
			alignement('F'.$row);
			alignement('G'.$row);
			alignement('H'.$row);
			alignement('I'.$row);
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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal,
													DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 2
													AND d.id_mod_trans = '1'
													AND DATEDIFF(CURRENT_DATE() , d.wiski_arriv)<3
													AND d.ref_dos NOT LIKE '%20-%'
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

		}else if ($_GET['type']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA');

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Wiski Departure')
				-> setCellValue('K'.$row, 'Dispatch From Klsa')
				-> setCellValue('L'.$row, 'Delay');

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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal, 
													DATE_FORMAT(d.wiski_dep, '%d/%m/%Y') AS wiski_dep, 
													DATE_FORMAT(d.dispatch_klsa, '%d/%m/%Y') AS dispatch_klsa, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													DATEDIFF(CURRENT_DATE(), d.klsa_arriv) AS duree,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 2
													AND d.id_mod_trans = 1
													AND d.dispatch_klsa IS NULL
													AND d.wiski_dep IS NULL
													AND d.klsa_arriv IS NOT NULL
													AND DATEDIFF(CURRENT_DATE() , d.klsa_arriv)>2
													AND d.ref_dos NOT LIKE '%20-%'
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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
					-> setCellValue($col.$row, $reponse['wiski_dep']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_klsa']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['duree']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

				
		}else if ($_GET['type']=='DEPARTED FROM WISKI') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'DEPARTED FROM WISKI');

			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Wiski Departure')
				-> setCellValue('K'.$row, 'Dispatch From Klsa')
				-> setCellValue('L'.$row, 'Dispatch Deliver Date')
				-> setCellValue('M'.$row, 'Delay');

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
			alignement('M'.$row);
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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal, 
													DATE_FORMAT(d.wiski_dep, '%d/%m/%Y') AS wiski_dep, 
													DATE_FORMAT(d.dispatch_klsa, '%d/%m/%Y') AS dispatch_klsa, 
													DATE_FORMAT(d.dispatch_deliv, '%d/%m/%Y') AS dispatch_deliv, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													DATEDIFF(CURRENT_DATE(), d.wiski_dep) AS duree,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 2
													AND d.id_mod_trans = 1
													AND d.dispatch_klsa IS NOT NULL
													AND d.wiski_dep IS NOT NULL
													AND d.dispatch_deliv IS NULL
													AND d.klsa_arriv IS NOT NULL
													AND d.ref_dos NOT LIKE '%20-%'
													AND ( cli.id_cli <> 869 )
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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
					-> setCellValue($col.$row, $reponse['wiski_dep']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_klsa']);

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
					-> setCellValue($col.$row, $reponse['duree']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

				
		}else if ($_GET['type']=='DATES ERROR') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'DATES ERROR');
				
			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Wiski Departure')
				-> setCellValue('K'.$row, 'Dispatch From Klsa')
				-> setCellValue('L'.$row, 'Delay');

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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal, 
													DATE_FORMAT(d.wiski_dep, '%d/%m/%Y') AS wiski_dep, 
													DATE_FORMAT(d.dispatch_klsa, '%d/%m/%Y') AS dispatch_klsa, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													DATEDIFF(CURRENT_DATE(), d.klsa_arriv) AS duree,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_trans = 1
													AND ( (d.klsa_arriv IS NULL 
															AND (d.wiski_arriv IS NOT NULL OR d.dispatch_klsa IS NOT NULL)
															)
														OR (d.wiski_arriv IS NULL AND d.dispatch_klsa IS NOT NULL)

														OR (d.klsa_arriv > d.wiski_arriv)
														OR (d.wiski_arriv > d.wiski_dep)
														OR (d.wiski_dep > d.dispatch_klsa)
														OR (d.klsa_arriv > d.wiski_dep)
														OR (d.klsa_arriv > d.dispatch_klsa)
														OR (d.wiski_arriv > d.dispatch_klsa)
														)
													AND d.ref_dos NOT LIKE '%20-%'");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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
					-> setCellValue($col.$row, $reponse['wiski_dep']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_klsa']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['duree']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

				
		}else if ($_GET['type']=='DATES ERROR KZI') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'DATES ERROR KZI');
				
			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Wiski Departure')
				-> setCellValue('K'.$row, 'Dispatch From Klsa')
				-> setCellValue('L'.$row, 'Dispatch Deliver')
				-> setCellValue('M'.$row, 'Delay (Klsa Arrival - Dispatch Deliver)');

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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal, 
													DATE_FORMAT(d.wiski_dep, '%d/%m/%Y') AS wiski_dep, 
													DATE_FORMAT(d.dispatch_klsa, '%d/%m/%Y') AS dispatch_klsa, 
													DATE_FORMAT(d.dispatch_deliv, '%d/%m/%Y') AS dispatch_deliv, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													DATEDIFF(d.dispatch_deliv, d.klsa_arriv) AS duree,
													d.cleared AS cleared,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_trans = 1
													AND d.dispatch_deliv IS NOT NULL
													AND (d.dispatch_deliv < d.klsa_arriv
															OR d.dispatch_deliv < d.wiski_arriv
															OR d.dispatch_deliv < d.wiski_dep
															OR d.dispatch_deliv < d.dispatch_klsa)
													AND d.ref_dos NOT LIKE '%20-%'");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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
					-> setCellValue($col.$row, $reponse['wiski_dep']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_klsa']);

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
					-> setCellValue($col.$row, $reponse['duree']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

				
		}else if ($_GET['type']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI') {

			$excel-> getActiveSheet()
				-> setCellValue('A1', 'TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI');
					
			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF')
				-> setCellValue('C'.$row, 'CUSTOMER NAME')
				-> setCellValue('D'.$row, 'Horse')
				-> setCellValue('E'.$row, 'Trailer 1')
				-> setCellValue('F'.$row, 'Trailer 2')
				-> setCellValue('G'.$row, 'Prealerte Date')
				-> setCellValue('H'.$row, 'Klsa Arrival')
				-> setCellValue('I'.$row, 'Wiski Arrival')
				-> setCellValue('J'.$row, 'Wiski Departure')
				-> setCellValue('K'.$row, 'Dispatch From Klsa')
				-> setCellValue('L'.$row, 'Delay');

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

			//----------- Récuperation des dossiers ------------
			$row = 4;
			$col = 'A';
			$compteur = 0;
			$requete = $connexion-> query("SELECT DATE_FORMAT(d.klsa_arriv, '%d/%m/%Y') AS klsa_arriv, 
													DATE_FORMAT(d.wiski_arriv, '%d/%m/%Y') AS wiski_arriv, 
													DATE_FORMAT(d.date_preal, '%d/%m/%Y') AS date_preal, 
													DATE_FORMAT(d.wiski_dep, '%d/%m/%Y') AS wiski_dep, 
													DATE_FORMAT(d.dispatch_klsa, '%d/%m/%Y') AS dispatch_klsa, 
													cli.nom_cli AS nom_cli,
													d.id_dos AS id_dos,
													d.ref_dos AS ref_dos,
													d.commodity AS commodity,
													d.cleared AS cleared,
													DATEDIFF(CURRENT_DATE(), d.klsa_arriv) AS duree,
													d.horse AS horse,
													d.trailer_1 AS trailer_1,
													d.trailer_2 AS trailer_2
												FROM dossier d, client cli
												WHERE d.id_cli = cli.id_cli
													AND d.id_mod_lic = 2
													AND d.id_mod_trans = 1
													AND d.dispatch_klsa IS NULL
													AND d.wiski_dep IS NULL
													AND d.klsa_arriv IS NOT NULL
													AND DATEDIFF(CURRENT_DATE() , d.wiski_arriv)>2
													AND d.ref_dos NOT LIKE '%20-%'
												ORDER BY d.date_creat_dos ASC");
			//$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
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
					-> setCellValue($col.$row, $reponse['klsa_arriv']);

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
					-> setCellValue($col.$row, $reponse['wiski_dep']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['dispatch_klsa']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
					
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['duree']);

				alignement($col.$row);

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
			    $col++;

				$row++;

			}$requete-> closeCursor();
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

			$excel->getActiveSheet()->setTitle($_GET['type']);
			$titre = $_GET['type'].'_'.date('d_m_Y_h_i_s');

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