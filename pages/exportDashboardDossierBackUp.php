
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
		$excel->getActiveSheet()->freezePane('H9');

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
			-> setCellValue('D4', 'TRACKING REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']));
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
			-> setCellValue('D7', 'SECTOR');

		cellColor('A'.$row, 'AF002A');
		cellColor('B'.$row, 'AF002A');
		cellColor('C'.$row, 'AF002A');
		cellColor('D'.$row, 'AF002A');

		alignement('A'.$row);
		alignement('B'.$row);
		alignement('C'.$row);
		alignement('D'.$row);

		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);
		$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(20);

		$excel->getActiveSheet()
			->getStyle('A'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('B'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('C'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('D'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> mergeCells('A7:A8');
		$excel-> getActiveSheet()
			-> mergeCells('B7:B8');
		$excel-> getActiveSheet()
			-> mergeCells('C7:C8');
		$excel-> getActiveSheet()
			-> mergeCells('D7:D8');
		
		//Priemière ligne de l'en-tete
		$col = 'E';
		$col2 = '';
		$requeteEnTete = $connexion-> prepare("SELECT * 
												FROM status_dashboard 
												WHERE id_mod_lic = ?
													AND active = '1'
													AND nom_stat <> 'CLEARING COMPLETED'
												ORDER BY rang_stat ASC");
		$requeteEnTete-> execute(array($_GET['id_mod_lic']));
		while ($reponseEnTete = $requeteEnTete-> fetch()) {
			$excel-> getActiveSheet()
				-> setCellValue($col.'7', $reponseEnTete['nom_stat']);
			cellColor($col.'7', 'AF002A');
			alignement($col.'7');
			$excel->getActiveSheet()
				->getStyle($col.'7')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'7:'.($col2).'7');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		}$requeteEnTete-> closeCursor();
		
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
		//FIN Priemière ligne de l'en-tete

		//Deuxième ligne de l'en-tete
		$row++;
		$col = 'E';
		$requeteEnTete = $connexion-> prepare("SELECT * 
												FROM status_dashboard 
												WHERE id_mod_lic = ?
													AND active = '1'
													AND nom_stat <> 'CLEARING COMPLETED'
												ORDER BY rang_stat ASC");
		$requeteEnTete-> execute(array($_GET['id_mod_lic']));
		while ($reponseEnTete = $requeteEnTete-> fetch()) {
			//$col++;
			$excel-> getActiveSheet()
				-> setCellValue($col.'8', 'TOTAL FILES');

			cellColor($col.'8', '87CEEB');
			alignement($col.'8');

			$excel->getActiveSheet()
				->getStyle($col.'8')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'8', 'FILES OVER 5 DAYS');

			cellColor($col.'8', '87CEEB');
			alignement($col.'8');
			$excel->getActiveSheet()
				->getStyle($col.'8')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'8', 'FILES OVER 10 DAYS');

			cellColor($col.'8', '87CEEB');
			alignement($col.'8');
			$excel->getActiveSheet()
				->getStyle($col.'8')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;
		}$requeteEnTete-> closeCursor();
		
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
		//FIN Deuxième ligne de l'en-tete
		

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

			$requeteStatus = $connexion-> prepare("SELECT * 
													FROM status_dashboard 
													WHERE id_mod_lic = ?
														AND active = '1'
														AND nom_stat <> 'CLEARING COMPLETED'
													ORDER BY rang_stat ASC");
			$requeteStatus-> execute(array($_GET['id_mod_lic']));
			while ($reponseStatus = $requeteStatus-> fetch()){
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatus($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat']));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatus($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat']))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDays($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat'], 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDays($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat'], 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

			}$requeteStatus-> closeCursor();

			//FIN Recuperation des nombres

		}$requeteClient-> closeCursor();
		
		//Recuperation des nombres Totaux
		$row++;

		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, 'TOTAL');

		cellColor('A'.$row, '87CEEB');
		alignement('A'.$row);

		$excel->getActiveSheet()
			->getStyle('A'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> mergeCells('A'.$row.':D'.$row);
		$col = 'E';
			$requeteStatus = $connexion-> prepare("SELECT * 
													FROM status_dashboard 
													WHERE id_mod_lic = ?
														AND active = '1'
														AND nom_stat <> 'CLEARING COMPLETED'
													ORDER BY rang_stat ASC");
			$requeteStatus-> execute(array($_GET['id_mod_lic']));
			while ($reponseStatus = $requeteStatus-> fetch()){
				
/*
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierModeLicenceStatus($_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat']));
*/
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'9:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				/*
				$nombre_jour = $maClasse-> getNombreDossierModeLicenceStatusCalculNetDays($_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat'], 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
*/

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'9:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

/*
		
				$nombre_jour = $maClasse-> getNombreDossierModeLicenceStatusCalculNetDays($_GET['id_mod_lic'], $_GET['id_mod_trans'], $reponseStatus['nom_stat'], 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					*/

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'9:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			}$requeteStatus-> closeCursor();

			//FIN Recuperation des nombres Totaux

		
		
		$excel-> getActiveSheet()-> getStyle('A7:'.$col.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
                		'color' => array('rgb' => '000000')
					)
				)
			)
		);

		
		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);
		$excel->getActiveSheet()->setTitle('SUMMARY');

		//Creation des classeurs par status
		$row = 3;
		$nom_stat = '';
		$requeteClasseurStatus = $connexion-> prepare("SELECT * 
												FROM status_dashboard 
												WHERE id_mod_lic = ?
													AND active = '1'
													AND nom_stat <> 'CLEARING COMPLETED'
												ORDER BY rang_stat ASC");
		$requeteClasseurStatus-> execute(array($_GET['id_mod_lic']));
		while ($reponseClasseurStatus = $requeteClasseurStatus-> fetch()) {

			$nom_stat = str_replace("/", "_", $reponseClasseurStatus['nom_stat']);
			
			$indiceSheet++;

			$excel->createSheet();

			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);

			$excel->getActiveSheet()->setTitle($nom_stat);


			//Affichage des contenues des classeurs
			include('contenueClasseurDashboardDossiers.php');
			//FIN Affichage des contenues des classeurs

		}$requeteClasseurStatus-> closeCursor();
		
		//FIN Creation des classeurs par status




$titre = 'TRACKING REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'_'.date('d_m_Y_h_i_s');
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