
<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');
include('afficherRowTableauExcel.php');

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

	/*function convert_date($date_string){
	  //$date = DateTime::createFromFormat('Y-m-d', $date_string); //2016-10-05 16:00
	  $date = new DateTime($date_string); 
	  return $date;
	};*/

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
		$excel->getActiveSheet()->freezePane('H8');

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
			-> setCellValue('D4', 'TRACKING REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' LICENCE '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']));
		$excel->getActiveSheet()
			->getStyle('D4')->applyFromArray($styleHeader2);

		$excel-> getActiveSheet()
			-> setCellValue('G1', 'Lubumbashi, le '.date('d/m/Y'));


		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A7', '#')
			-> setCellValue('B7', 'CUSTOMER CODE')
			-> setCellValue('C7', 'CUSTOMER NAME')
			-> setCellValue('D7', 'SECTOR')
			-> setCellValue('E7', 'EN COURS')
			-> setCellValue('F7', 'ECHEANCE -40 JOURS')
			-> setCellValue('G7', 'EXPIREES')
			-> setCellValue('H7', 'CIF LICENCE <> CIF DOSSIERS')
			-> setCellValue('I7', 'CLOTURE TRACKING')
			-> setCellValue('J7', 'APUREES(PARTIELLE/TOTALE)');

		cellColor('A'.$row, 'AF002A');
		cellColor('B'.$row, 'AF002A');
		cellColor('C'.$row, 'AF002A');
		cellColor('D'.$row, 'AF002A');
		cellColor('E'.$row, 'AF002A');
		cellColor('F'.$row, 'AF002A');
		cellColor('G'.$row, 'AF002A');
		cellColor('H'.$row, 'AF002A');
		cellColor('I'.$row, 'AF002A');
		cellColor('J'.$row, 'AF002A');

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

		// $excel-> getActiveSheet()
		// 	-> mergeCells('A7:A8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('B7:B8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('C7:C8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('D7:D8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('E7:E8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('F7:F8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('G7:G8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('H7:H8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('I7:I8');
		// $excel-> getActiveSheet()
		// 	-> mergeCells('J7:J8');
		
		
		$excel-> getActiveSheet()-> getStyle('A'.$row.':J'.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
                		'color' => array('rgb' => 'FFFFFF')
					)
				)
			)
		);
		//FIN Priemière ligne de l'en-tete

		if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
			$sqlClient = ' AND id_cli = "'.$_GET['id_cli'].'"';
		}else{
			$sqlClient = '';
		}


		$col = 'A';
		$compteur = 0;
		$requeteClient = $connexion-> prepare("SELECT * 
												FROM client 
												WHERE id_cli IN (
														SELECT DISTINCT(id_cli) AS id_cli 
															FROM dossier
															WHERE id_mod_lic = ?
													)
													$sqlClient
												ORDER BY nom_cli ASC");
		$requeteClient-> execute(array($_GET['id_mod_lic']));
		while ($reponseClient = $requeteClient-> fetch()) {
			$row++;
			$compteur++;

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur);

			$excel-> getActiveSheet()
				-> setCellValue('B'.$row, $reponseClient['code_cli']);

			$excel-> getActiveSheet()
				-> setCellValue('C'.$row, $reponseClient['nom_cli']);

			$excel-> getActiveSheet()
				-> setCellValue('D'.$row, 'LUBUMBASHI');

			alignement('A'.$row);
			/*alignement('B'.$row);
			alignement('C'.$row);*/
			alignement('D'.$row);

			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
			$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
			$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(15);

			$col = 'E';
			$nombre_jour = 0;

			//Recuperation des nombres

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'EN COURS', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'EXTREME VALIDATION -40 JOURS', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'EXPIRES', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'CIF LICENCE DIFFERENT CIF DOSSIER(S)', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'APPUREES TRACKING ATTENTE BANQUE', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreLicenceDashboard($_GET['id_mod_lic'], 'APPUREES PAR BANQUE', $_GET['id_cli'], NULL));

				alignement($col.$row);

				$col++;


			//FIN Recuperation des nombres

		}$requeteClient-> closeCursor();
		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);
		$excel->getActiveSheet()->setTitle('SUMMARY');

		//Creation des classeurs par status
		$row = 3;
		$nom_stat = '';
		// $requeteClasseurStatus = $connexion-> prepare("SELECT * 
		// 										FROM status_dashboard 
		// 										WHERE id_mod_lic = ?
		// 											AND active = '1'
		// 											AND nom_stat <> 'CLEARING COMPLETED'
		// 										ORDER BY rang_stat ASC");
		// $requeteClasseurStatus-> execute(array($_GET['id_mod_lic']));
		// while ($reponseClasseurStatus = $requeteClasseurStatus-> fetch()) {

		// 	$nom_stat = str_replace("/", "_", $reponseClasseurStatus['nom_stat']);
			
			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('EN COURS');
			$type = 'EN COURS';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs


			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('EXTREME VALIDATION -40 JOURS');
			$type = 'EXTREME VALIDATION -40 JOURS';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs


			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('EXPIRES');
			$type = 'EXPIRES';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs


			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('CIF LICENCE DIFFERENT CIF DOSSIER(S)');
			$type = 'CIF LICENCE DIFFERENT CIF DOSSIER(S)';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs


			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('APPUREES TRACKING ATTENTE BANQUE');
			$type = 'APPUREES TRACKING ATTENTE BANQUE';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs


			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle('APPUREES PAR BANQUE');
			$type = 'APPUREES PAR BANQUE';
			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardLicences.php');
			//FIN Affichage des contenues des classeurs

		//}$requeteClasseurStatus-> closeCursor();
		
		// //FIN Creation des classeurs par status



$titre = 'TRACKING REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'_'.date('d_m_Y_h_i_s');
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