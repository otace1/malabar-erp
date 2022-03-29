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

		$excel-> getActiveSheet()
			-> setCellValue('A1', $_GET['etat']);
				
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
			-> setCellValue('D'.$row, 'Commodity')
			-> setCellValue('E'.$row, 'Ref. Decl.')
			-> setCellValue('F'.$row, 'Date Decl.')
			-> setCellValue('G'.$row, 'Ref. Liq.')
			-> setCellValue('H'.$row, 'Date Liq.')
			-> setCellValue('I'.$row, 'Ref. Quit.')
			-> setCellValue('J'.$row, 'Date Quit.');

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

		//----------- Récuperation des dossiers ------------
		$row = 4;
		$col = 'A';
		$compteur = 0;
		$id_cli = $_GET['id_cli'];
		$id_mod_lic = $_GET['id_mod_lic'];
		$id_mod_trans = $_GET['id_mod_trans'];
		$commodity = $_GET['commodity'];

			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = " AND d.id_cli = $id_cli"; 
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

			if ($_GET['etat'] == 'TOTAL FILES') {
				$requete = $connexion-> query("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														d.cleared AS cleared
													FROM dossier d, client cl
													WHERE d.ref_dos IS NOT NULL
														AND d.id_cli = cl.id_cli
														$sqlClient
														$sqlModeLic
														$sqlTrans
														$sqlCommodity
												");
			}else if ($_GET['etat'] == 'CLEARING COMPLETED') {
				$requete = $connexion-> query("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														d.cleared AS cleared
													FROM dossier d, client cl
													WHERE d.ref_dos IS NOT NULL
														AND d.id_cli = cl.id_cli
														AND d.cleared = '1'
														$sqlClient
														$sqlModeLic
														$sqlTrans
														$sqlCommodity
												");
			}else if ($_GET['etat'] == 'FILES IN PROCESS') {
				$requete = $connexion-> query("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														d.cleared AS cleared
													FROM dossier d, client cl
													WHERE d.ref_dos IS NOT NULL
														AND d.id_cli = cl.id_cli
														AND d.cleared = '0'
														$sqlClient
														$sqlModeLic
														$sqlTrans
														$sqlCommodity
												");
			}else if ($_GET['etat'] == 'CANCELLED') {
				$requete = $connexion-> query("SELECT d.ref_dos AS ref_dos, cl.nom_cli AS nom_cli,
														d.commodity AS commodity,
														d.ref_decl AS ref_decl,
														DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
														d.ref_liq AS ref_liq,
														DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
														d.ref_quit AS ref_quit,
														DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
														d.cleared AS cleared
													FROM dossier d, client cl
													WHERE d.ref_dos IS NOT NULL
														AND d.id_cli = cl.id_cli
														AND d.cleared = '2'
														$sqlClient
														$sqlModeLic
														$sqlTrans
														$sqlCommodity
												");
			}

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
				-> setCellValue($col.$row, $reponse['commodity']);

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