
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
	
	function cellColor2($cells,$color){
	    global $excel;


		 $excel ->getActiveSheet() ->getStyle($cells) ->getFill() ->setFillType(
		 	PHPExcel_Style_Fill::FILL_SOLID) ->getStartColor() ->setRGB($color); //ie,colorcode=D3D3D3 

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

	function convert_date($date_string){
	  //$date = DateTime::createFromFormat('Y-m-d', $date_string); //2016-10-05 16:00
	  $date = new DateTime($date_string); 
	  return $date;
	};

include('../classes/connexion.php');
include('afficherDossierTransmissionExport.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;

	//--- Recuperation d'années -------
		//Selecting active sheet
		$excel-> setActiveSheetIndex($indiceSheet);


		//Get data
		//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

		//$entree['id_mod_lic'] = $_GET['id_mod_lic'];
		$entree['id_cli'] = $_GET['id_cli'];


		$sql1 = "";
		$sqlOrder = "";
		$sqlIdMarch = "";
		$sqlStatus = "";
		$sqlLicence = "";
		$sqlCleared = "";
		$compteur = 1;

		$row = 7;
		$col = 'C';

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/Logo MRDC.JPG');
		$objDrawing->setHeight(40);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('B8');

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
			-> setCellValue('D4', 'FILES '.$maClasse-> getNomClient($_GET['id_cli']).' FILES MISSING DATA / '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']));
		$excel->getActiveSheet()
			->getStyle('D4')->applyFromArray($styleHeader2);

		$excel-> getActiveSheet()
			-> setCellValue('H1', 'Lubumbashi, le '.date('d/m/Y'));


		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A7', '#')
			-> setCellValue('B7', 'NUMERO MCA')
			-> setCellValue('C7', 'FOB')
			-> setCellValue('D7', 'REF. FACTURE')
			-> setCellValue('E7', 'NUM. AV.')
			-> setCellValue('F7', 'MONTANT AV.')
			-> setCellValue('G7', 'BLT/LTA')
			-> setCellValue('H7', 'REF. DECLARATION')
			-> setCellValue('I7', 'MONTANT DECL')
			-> setCellValue('J7', 'REF. QUITTANCE');


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

		$excel-> getActiveSheet()-> getStyle('A'.$row.':C'.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
                		'color' => array('rgb' => 'FFFFFF')
					)
				)
			)
		);

		//----------- Récuperation des LICENCES ------------

		$row = 8;
		$col = 'C';

		if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
			$sqlClient = ' AND id_cli = "'.$_GET['id_cli'].'"';
		}else{
			$sqlClient = '';
		}


		$requete = $connexion-> prepare("SELECT *
											FROM dossier
											WHERE (
													fob = '' OR fob IS NULL OR fob = '0'
													OR ref_av IS NULL OR ref_av = ''
													OR montant_av IS NULL OR montant_av = ''
													OR road_manif IS NULL OR road_manif = ''
													OR ref_decl IS NULL OR ref_decl = ''
													OR montant_decl IS NULL OR montant_decl = ''
													OR ref_quit IS NULL OR ref_quit = ''
													OR ref_fact IS NULL OR ref_fact = ''
												)
												AND (cleared = '1' OR cleared = '0')
												AND id_mod_lic = ?
												$sqlClient");

		$requete-> execute(array($_GET['id_mod_lic']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur)
				-> setCellValue('B'.$row, $reponse['ref_dos'])
				-> setCellValue('C'.$row, $reponse['fob'])
				-> setCellValue('D'.$row, $reponse['ref_fact'])
				-> setCellValue('E'.$row, $reponse['ref_av'])
				-> setCellValue('F'.$row, $reponse['montant_av'])
				-> setCellValue('G'.$row, $reponse['road_manif'])
				-> setCellValue('H'.$row, $reponse['ref_decl'])
				-> setCellValue('I'.$row, $reponse['fob'])
				-> setCellValue('J'.$row, $reponse['ref_quit']);

            //Alignement 
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

            
			$compteur++;
			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A8:J'.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('E')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('F')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('G')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('H')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('I')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('J')-> setWidth(20);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		// Rename worksheet

		$excel->getActiveSheet()->setTitle("MISSING DATA");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_FILES_MISSING_DATA_'.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'_'.date('d_m_Y_h_i_s');
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