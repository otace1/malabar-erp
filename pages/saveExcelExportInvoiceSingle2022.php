
<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');

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
//--- Recuperation des mode de transport -------
$indiceSheet = 0;

	//Selecting active sheet
	$excel-> setActiveSheetIndex($indiceSheet);

	// $excel->createSheet();
	// $indiceSheet = 1;

	// //Selecting active sheet
	// $excel-> setActiveSheetIndex($indiceSheet);


	//Get data
	//$maClasse-> afficherEnTeteTableauExcel2($_POST['id_mod_lic'], $_POST['id_cli'], $_POST['id_mod_trans'], $excel);

	$entree['ref_fact'] = $_POST['ref_fact'];

	$sql1 = "";
	$sqlOrder = "";
	$sqlIdMarch = "";
	$sqlStatus = "";
	$sqlLicence = "";
	$sqlCleared = "";
	$compteur = 0;

	$row = 3;
	$col = 'A';

	//Image dans la cellule
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('test_img');
	$objDrawing->setDescription('Logo en-tete');
	$objDrawing->setPath('../images/Logo MRDC.JPG');
	$objDrawing->setHeight(40);
	$objDrawing->setCoordinates('E1');
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

	//Recuperation des en-tête
		
	$excel-> getActiveSheet()
		-> setCellValue($col.$row, '#');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'MCA B/REF');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Destination');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Transporter');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Horse');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Trailer 1');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Trailer 2');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Lot. No.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Qty(Mt)');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Loading Date');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Clearing Completed Date');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Status');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Duty in CDF');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RIE');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RIE (USD)');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'DDE');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RLS');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RLS (USD)');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'FSR');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'FSR (USD)');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RATE');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Total in USD');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Per MT Rate');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	//Dimension des Colonnes
	$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
	$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(30);
	$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(30);
	$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('E')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('F')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('G')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('H')-> setWidth(40);
	$excel-> getActiveSheet()-> getColumnDimension('I')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('J')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('K')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('L')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('M')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('N')-> setWidth(20);
	$excel-> getActiveSheet()-> getColumnDimension('O')-> setWidth(20);

	$excel-> getActiveSheet()-> getStyle('A4:O'.($row-1))-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
	$col_RIE_CDF = '';
	$col_RIE_USD = '';
	$col_DDE_CDF = '';
	$col_DDE_USD = '';
	$col_RLS_CDF = '';
	$col_RLS_USD = '';
	$col_FSR_CDF = '';
	$col_FSR_USD = '';
	$col_roe_decl = '';
	$col_total = '';
	$col_poids = '';
	$row++;
	$requete = $connexion-> prepare("SELECT dossier.ref_dos AS ref_dos,
																					dossier.destination AS destination,
																					dossier.transporter AS transporter,
																					dossier.horse AS horse,
																					dossier.trailer_1 AS trailer_1,
																					dossier.trailer_2 AS trailer_2,
																					dossier.num_lot AS num_lot,
																					dossier.poids AS poids,
																					dossier.load_date AS load_date,
																					dossier.exit_drc AS exit_drc,
																					dossier.id_dos AS id_dos,
																					IF(dossier.cleared = '1',
																						'Cleared',
																						IF(dossier.cleared = '0',
																							'Transit',
																							'Cancelled'
																							)
																						) AS cleared,
																					dossier.roe_decl AS roe_decl
																		FROM dossier, detail_facture_dossier
																		WHERE dossier.id_dos = detail_facture_dossier.id_dos
																			AND detail_facture_dossier.ref_fact = ?
																		GROUP BY dossier.id_dos");
	$requete-> execute(array($entree['ref_fact']));
	while($reponse = $requete-> fetch()){
		$col = 'A';
		$compteur++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $compteur);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['ref_dos']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['destination']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['transporter']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['horse']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['trailer_1']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['trailer_2']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['num_lot']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_poids = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['poids']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['load_date']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['exit_drc']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['cleared']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_DDE_CDF = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 2));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_RIE_CDF = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 1));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_RIE_USD = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 1));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_DDE_USD = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], ''));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_RLS_CDF = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 3));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_RLS_USD = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 3));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_FSR_CDF = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 4));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_FSR_USD = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantFactureDossierDebours($entree['ref_fact'], $reponse['id_dos'], 4));
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

	  $col_roe_decl = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['roe_decl']);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   $col++;

		$col_total = $col;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '='.$col_DDE_CDF.$row.'/'.$col_roe_decl.$row);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	  $col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '='.$col_total.$row.'/'.$col_poids.$row);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);
	   //---- USD

	  //RIE
		$excel-> getActiveSheet()
			-> setCellValue($col_RIE_USD.$row, '='.$col_RIE_CDF.$row.'/'.$col_roe_decl.$row);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

	  //RLS
		$excel-> getActiveSheet()
			-> setCellValue($col_RLS_USD.$row, '='.$col_RLS_CDF.$row.'/'.$col_roe_decl.$row);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

	  //FSR
		$excel-> getActiveSheet()
			-> setCellValue($col_FSR_USD.$row, '='.$col_FSR_CDF.$row.'/'.$col_roe_decl.$row);
		alignement($col.$row);
		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);


	  $row++;
	}$requete-> closeCursor();


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

	// Rename worksheet
	$excel->getActiveSheet()->setTitle($_POST['ref_fact'].' DETAILS');


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$excel->setActiveSheetIndex($indiceSheet);


	// $indiceSheet++;

	// $excel->createSheet();


$titre = $_POST['ref_fact'];
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
$objWriter->save("../facture_dossier/$titre.xls");
?>