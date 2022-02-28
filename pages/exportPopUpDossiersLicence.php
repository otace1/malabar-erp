
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

		//$entree['num_lic'] = $_GET['num_lic'];
		//$entree['id_cli'] = $_GET['id_cli'];


		$sql1 = "";
		$sqlOrder = "";
		$sqlIdMarch = "";
		$sqlStatus = "";
		$sqlLicence = "";
		$sqlCleared = "";
		$compteur = 1;

		$row = 9;
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
		$excel->getActiveSheet()->freezePane('I11');

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

		$row = 4;
		$col = 'B';

		$licence = $maClasse-> getLicence($_GET['num_lic']);

		$excel-> getActiveSheet()
			-> setCellValue('H1', 'Lubumbashi, le '.date('d/m/Y'));

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'LICENCE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'SOUSCRIPTEUR');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FOB');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'POIDS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'BALANCE FOB');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'BALANCE POIDS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$row++;
		$col = 'B';

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $licence['num_lic']);
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $licence['nom_cli']);
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $licence['fob']);
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $licence['poids']);
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '');
		alignement($col.$row);
		$col++;

		$row = 6;
		$col = 'B';

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Nbre DOSSIERS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FOB DOSSIERS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'POIDS DOSSIERS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DOSSIERS TRANS. BANQUE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FOB DOSSIERS TRANSMIS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'BALANCE FOB DOSSIERS NON-TRANSMI');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$row++;
		$col = 'B';

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse->getSommeFobLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse->getSommePoidsLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse->getNbreDossierTransmisBanqueLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse->getSommeFobTransmisBanqueLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $licence['fob']-$maClasse->getSommeFobTransmisBanqueLicence($licence['num_lic']));
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()-> getStyle('B4:G'.$row)-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);


		$row=10;
		$col = 'A';
		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '#');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'NUMERO MCA');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REF. AV.');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REF. DECLARATION');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DATE DECLARATION');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REF. LIQUIDATION');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DATE LIQUIDATION');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REF. QUITTANCE');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DATE QUITTANCE');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FOB');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'POIDS');
		$col++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'TRANSMIS');

		$col = 'A';
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');
		$col++;
		cellColor($col.$row, '000000');

		$col = 'A';
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col++;
		alignement($col.$row);
		$col = 'A';
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);


		$excel-> getActiveSheet()-> getStyle('A'.$row.':'.$col.$row)-> applyFromArray(
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

		$row++;

		$requete = $connexion-> prepare("SELECT *,
											IF(cod IS NOT NULL AND cod <> 'TBC', cod, IF(ref_av IS NOT NULL, ref_av, IF(ref_crf IS NOT NULL, ref_crf, NULL))) AS cod
											FROM dossier
											WHERE cleared <> '2'
												AND num_lic = ?");

		$requete-> execute(array($_GET['num_lic']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';
			$col = 'A';
			
			$ok_apurement = '';
			
			if ($maClasse-> verifierApurementDossier($reponse['id_dos'])==true) {
				
				$couleur = '00FF00';
				$ok_apurement = 'YES';

			}else {
				//$bg = 'bg bg-success';
				$ok_apurement = 'NO';
			}

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $compteur);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_dos']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['cod']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_decl']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_decl']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_liq']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_liq']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_quit']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_quit']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;


			//Format date
			if ($reponse['date_decl']!='') {
				$excel-> getActiveSheet()
				->setCellValue('E'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_decl'])));
				$excel->getActiveSheet()->getStyle('E'.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			
			if ($reponse['date_liq']!='') {
				$excel-> getActiveSheet()
				->setCellValue('G'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_liq'])));
				$excel->getActiveSheet()->getStyle('G'.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			
			if ($reponse['date_quit']!='') {
				$excel-> getActiveSheet()
				->setCellValue('I'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_quit'])));
				$excel->getActiveSheet()->getStyle('I'.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['fob']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['poids']);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $ok_apurement);
            
			cellColor($col.$row, $couleur);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$compteur++;
			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		$excel-> getActiveSheet()
			-> mergeCells('A'.$row.':I'.$row);
		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, 'TOTAL');
		// cellColor('A'.$row, '000000');
		alignement('A'.$row);
		// $excel->getActiveSheet()
		// 	->getStyle('A'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> setCellValue('J'.$row, '=SUM(J11:J'.($row-1).')');
		// cellColor('J'.$row, '000000');
		alignement('J'.$row);
		// $excel->getActiveSheet()
		// 	->getStyle('J'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> setCellValue('K'.$row, '=SUM(K11:K'.($row-1).')');
		// cellColor('K'.$row, '000000');
		alignement('K'.$row);
		// $excel->getActiveSheet()
		// 	->getStyle('K'.$row)->applyFromArray($styleHeader);

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A10:L'.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$excel-> getActiveSheet()
			-> setCellValue('F5', '=D5-J'.$row);
		alignement('F5');

		$excel-> getActiveSheet()
			-> setCellValue('G5', '=E5-K'.$row);
		alignement('G5');

		//Dimension des Colonnes
		// $excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		// $excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('E')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('F')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('G')-> setWidth(20);
		// $excel-> getActiveSheet()-> getColumnDimension('H')-> setWidth(20);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		// Rename worksheet
		$type = $_GET['type'];
		$excel->getActiveSheet()->setTitle("DOSSIERS $type");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = $_GET['num_lic'].'_'.date('d_m_Y_h_i_s');
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