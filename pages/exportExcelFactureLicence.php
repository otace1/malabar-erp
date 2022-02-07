
<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');

$maClasse = new MaClasse();

//Create PHPExcel object
$excel = new PHPExcel();

		// Rename worksheet
		$transit = '';
		/*if ($_GET['id_mod_lic'] == '1') {
			$transit = 'Export';   
          if ($_GET['id_cli'] == '') {
            $_GET['id_cli'] = 869;
          }

		}
		else if ($_GET['id_mod_lic'] == '2') {
			$transit = 'Import';

          if ($_GET['id_cli'] == '') {
            $_GET['id_cli'] = 857;
          }
		}*/


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
	//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

	$entree['id_mod_lic'] = $_GET['id_mod_lic'];
	$entree['id_cli'] = $_GET['id_cli'];

	$id_mod_lic = $_GET['id_mod_lic'];
	$id_cli = $_GET['id_cli'];

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
	$excel->getActiveSheet()->freezePane('F4');

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
		-> setCellValue('A1', '');
	$excel->getActiveSheet()
		->getStyle('A1')->applyFromArray($styleHeader2);

	//Fusionner les cellules
	$excel-> getActiveSheet()
		-> mergeCells('A1:I1');

	//Recuperation des en-tête
		
	$excel-> getActiveSheet()
		-> setCellValue('A'.$row, '#')
		-> setCellValue('B'.$row, 'FACTURE')
		-> setCellValue('C'.$row, 'N.LICENCE')
		-> setCellValue('D'.$row, 'CLIENT')
		-> setCellValue('E'.$row, 'DATE FACTURE')
		-> setCellValue('F'.$row, 'DATE RECEPTION FACTURE')
		-> setCellValue('G'.$row, 'DELAI DE RECEPTION');
	if ($_GET['id_mod_lic'] == '1') {
		$excel-> getActiveSheet()
			-> setCellValue('H'.$row, 'ACHETEUR');
	}else{
		$excel-> getActiveSheet()
			-> setCellValue('H'.$row, 'FOURNISSEUR');
	}
	$excel-> getActiveSheet()
		-> setCellValue('I'.$row, 'DATE SOUSCRIPTION LICENCE')
		-> setCellValue('J'.$row, 'MONNAIE')
		-> setCellValue('K'.$row, 'FOB')
		-> setCellValue('L'.$row, 'FRET')
		-> setCellValue('M'.$row, 'ASSURANCE')
		-> setCellValue('N'.$row, 'AUTRE FRAIS')
		-> setCellValue('O'.$row, 'TOTAL');

	cellColor('A'.$row, '000000');
	cellColor('B'.$row, '000000');
	alignement('A'.$row);
	alignement('B'.$row);
	cellColor('C'.$row, '000000');
	alignement('C'.$row);
	cellColor('D'.$row, '000000');
	alignement('D'.$row);
	cellColor('E'.$row, '000000');
	alignement('E'.$row);
	cellColor('F'.$row, '000000');
	alignement('F'.$row);
	cellColor('G'.$row, '000000');
	alignement('G'.$row);
	cellColor('H'.$row, '000000');
	alignement('H'.$row);
	cellColor('I'.$row, '000000');
	alignement('I'.$row);
	cellColor('J'.$row, '000000');
	alignement('J'.$row);
	cellColor('K'.$row, '000000');
	alignement('K'.$row);
	cellColor('L'.$row, '000000');
	alignement('L'.$row);
	cellColor('M'.$row, '000000');
	alignement('M'.$row);
	cellColor('N'.$row, '000000');
	alignement('N'.$row);
	cellColor('O'.$row, '000000');
	alignement('O'.$row);
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


	$entree['id_mod_lic'] = $id_mod_lic;
	$entree['id_cli'] = $id_cli;
	$etat = $_GET['etat'];
	$compteur = 0;
	$bg = '';
	$sql2 = '';

	$row = 4;
	if( ($id_cli != null) && ($id_cli != '')){
		$sql2 = ' AND cl.id_cli = '.$id_cli;
	}

	if ($etat == 'Factures sans licence') {
		
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
										$sql2
										AND f.id_mon = m.id_mon
										AND f.ref_fact NOT IN(
											SELECT f.ref_fact AS ref_fact
											FROM facture_licence f, client cl, monnaie m
											WHERE f.id_cli = cl.id_cli
												$sql2
												AND f.id_mon = m.id_mon
												AND f.ref_fact IN(SELECT ref_fact FROM licence)
											ORDER BY f.date_creat_fact DESC
										)
									ORDER BY f.date_creat_fact DESC");

	}else if ($etat == 'Facture ayant licence') {
		
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
										$sql2
										AND f.id_mon = m.id_mon
										AND f.ref_fact IN(SELECT ref_fact FROM licence)
									ORDER BY f.date_creat_fact DESC");

	}else{

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
										$sql2
										AND f.id_mon = m.id_mon
									ORDER BY f.date_creat_fact DESC");

	}

	$requete-> execute(array($entree['id_mod_lic']));
	while ($reponse = $requete-> fetch()) {
		$compteur++;
		$bg = '';

		if ($maClasse-> getLicenceFacture($reponse['ref_fact']) != null ) {
			$style = "style='color: blue;'";
			$styleHeader = array(
			    'font'  => array(
			        'color' => array('rgb' => '0000FF')
			    ));

		}else if ( $maClasse-> getDifferenceDate($reponse['aujourdhui'], $reponse['date_fact_rec2']) >= '2') {
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
		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, $compteur);
		alignement('A'.$row);

		$excel-> getActiveSheet()
			-> setCellValue('B'.$row, $reponse['ref_fact']);
		alignement('B'.$row);

		$excel-> getActiveSheet()
			-> setCellValue('C'.$row, $maClasse-> getLicenceFacture($reponse['ref_fact']));
		alignement('C'.$row);

		$excel-> getActiveSheet()
			-> setCellValue('D'.$row, $reponse['nom_cli']);
		alignement('D'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('E'.$row, $reponse['date_fact']);
		alignement('E'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('F'.$row, $reponse['date_fact_rec']);
		alignement('F'.$row);

		if ( $maClasse-> getDelaiFactureLicence($reponse['ref_fact']) != null ) {

			$excel-> getActiveSheet()
				-> setCellValue('G'.$row, $maClasse-> getDelaiFactureLicence($reponse['ref_fact']));
			alignement('G'.$row);
			
		}else{

			$excel-> getActiveSheet()
				-> setCellValue('G'.$row, $maClasse-> getDifferenceDate($reponse['aujourdhui'], $reponse['date_fact_rec2']));
			alignement('G'.$row);
			
		}

		$excel-> getActiveSheet()
			-> setCellValue('H'.$row, $reponse['fournisseur']);
		alignement('H'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('I'.$row, $reponse['date_val']);
		alignement('I'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('J'.$row, $reponse['sig_mon']);
		alignement('J'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('K'.$row, $reponse['montant_fact']);
		alignement('K'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('L'.$row, $reponse['fret_fact']);
		alignement('L'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('M'.$row, $reponse['assurance_fact']);
		alignement('M'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('N'.$row, $reponse['autre_frais_fact']);
		alignement('N'.$row);
		
		$excel-> getActiveSheet()
			-> setCellValue('O'.$row, ($reponse['montant_fact']+$reponse['fret_fact']+$reponse['assurance_fact']+$reponse['assurance_fact']));
		alignement('O'.$row);

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
		//$col++;
		$row++;

	}$requete-> closeCursor();

	
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

	// Rename worksheet
	$transit = '';
	if ($_GET['id_mod_lic'] == '1') {
		$transit = 'Export';
	}
	else if ($_GET['id_mod_lic'] == '2') {
		$transit = 'Import';
	}

	$excel-> getActiveSheet()-> getStyle('A4:O'.($row-1))-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);


	$excel->getActiveSheet()->setTitle('FACTURE '.$_GET['etat']);


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$excel->setActiveSheetIndex($indiceSheet);


	$indiceSheet++;

	$excel->createSheet();


$titre = 'FACTURE_'.$maClasse-> getNomClient($_GET['id_cli']).'_'.$_GET['etat'].'_'.$transit.'_'.date('d_m_Y_h_i_s');
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