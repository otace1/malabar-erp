
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
//include('afficherDossierTransmissionExport.php');
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

		$row = 2;
		$col = 'C';

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
			-> setCellValue('A1', 'LICENSE REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']));
		$excel->getActiveSheet()
			->getStyle('A1')->applyFromArray($styleHeader2);

		$excel-> getActiveSheet()
				-> mergeCells('A1:K1');
		alignement('A1');


		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		/**************************************************************************************/
		/**************************************************************************************/

		$colonne = 'A';
		$ligne = '3';
		$step = 0;
		$colonne2 = '';
		$colonneStatus = '';
		$ligneStatus = '';
		$compteurStatus = 0;
		$sqlClient = "";
		if (isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) {
			$sqlClient = ' AND cl.id_cli = "'.$id_cli.'" ';
		}

		$requeteClient = $connexion-> prepare("SELECT cl.* 
												FROM client cl, licence l 
												WHERE l.id_mod_lic = ?
													$sqlClient
													AND cl.id_cli = l.id_cli
												GROUP BY cl.id_cli
												ORDER BY cl.nom_cli ASC");
		$requeteClient-> execute(array($_GET['id_mod_lic']));
		while ($reponseClient = $requeteClient-> fetch()) {
			$compteurStatus = 0;
			$excel-> getActiveSheet()
				-> setCellValue($colonne.$ligne, $reponseClient['nom_cli']);
			cellColor($colonne.$ligne, 'AF002A');
			alignement($colonne.$ligne);

			$excel->getActiveSheet()
		        ->getColumnDimension($colonne)
		        ->setAutoSize(true);

			$excel->getActiveSheet()
				->getStyle($colonne.$ligne)->applyFromArray($styleHeader);
			$ligneTmp = $ligne;

			$colonne2 = $colonne;
			$colonne2++;

			$excel-> getActiveSheet()
				-> mergeCells($colonne.$ligne.':'.$colonne2.$ligne);

			$ligne++;

			$excel-> getActiveSheet()
				-> setCellValue($colonne.$ligne, '');
			cellColor($colonne.$ligne, 'AF002A');
			alignement($colonne.$ligne);
			// $excel->getActiveSheet()
			// 	->getStyle($colonne.$ligne)->applyFromArray($styleHeader);
			$colonneStatus = $colonne;
			$colonneTMP = $colonne;
			$colonne++;

			$excel-> getActiveSheet()
				-> setCellValue($colonne.$ligne, '');
			cellColor($colonne.$ligne, 'AF002A');
			alignement($colonne.$ligne);
			// $excel->getActiveSheet()
			// 	->getStyle($colonne.$ligne)->applyFromArray($styleHeader);
			$colonne++;

			//-------------------STATUS
			$firstLine = 0;
			$firstLine = $ligne+1;
			// $requeteStatus = $connexion-> prepare("SELECT * 
			// 										FROM status_dashboard 
			// 										WHERE id_mod_lic = ?
			// 											AND active = '1'
			// 											AND nom_stat <> 'CLEARING COMPLETED'
			// 										ORDER BY rang_stat ASC");
			// $requeteStatus-> execute(array($_GET['id_mod_lic']));
			// while ($reponseStatus = $requeteStatus-> fetch()){
			//-- ---------
				$colonneStatus = $colonneTMP;
				$ligne++;
				
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, 'Total licence');

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);

				$colonneStatus++;
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, $maClasse-> getNombreLicenceClientModeLicenceTypeLicence($reponseClient['id_cli'], $_GET['id_mod_lic'], NULL));

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);
			//-- ---------
			//-- ---------
				$colonneStatus = $colonneTMP;
				$ligne++;
				
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, 'Apurement Total');

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);

				$colonneStatus++;
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, $maClasse-> getNombreLicenceTotalementApure($reponseClient['id_cli'], $_GET['id_mod_lic']));

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);
			//-- ---------
			//-- ---------
				$colonneStatus = $colonneTMP;
				$ligne++;
				
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, 'Apurement Partiel');

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);

				$colonneStatus++;
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, $maClasse-> getNombreLicencePartiellementApure($reponseClient['id_cli'], $_GET['id_mod_lic']));

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);
			//-- ---------
			//-- ---------
				$colonneStatus = $colonneTMP;
				$ligne++;
				
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, 'Expirées');

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);

				$colonneStatus++;
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, $maClasse-> getNombreLicenceExpiree($reponseClient['id_cli'], $_GET['id_mod_lic']));

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);
			//-- ---------
			//-- ---------
				$colonneStatus = $colonneTMP;
				$ligne++;
				
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, 'En cours');

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);

				$colonneStatus++;
				$excel-> getActiveSheet()
					-> setCellValue($colonneStatus.$ligne, $maClasse-> getNombreLicenceEnCours($reponseClient['id_cli'], $_GET['id_mod_lic']));

				$excel->getActiveSheet()
			        ->getColumnDimension($colonneStatus)
			        ->setAutoSize(true);
			//-- ---------
			//-------------------FIN STATUS

			//------FIN TOTAL STATUS
				$compteurStatus = 0;
			//Bordure des Cellules
			$excel-> getActiveSheet()-> getStyle($colonneTMP.$ligneTmp.':'.$colonneStatus.$ligne)-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);
			
			$colonne++;

			$step++;

			$ligne--;

			if ($step==4) {
				$colonne = 'A';
				$step = 0;
				$ligne+=5;
			}else{
				$ligne = $ligneTmp;
			}


		}$requeteClient-> closeCursor();

		/**************************************************************************************/
		/**************************************************************************************/

$excel->setActiveSheetIndex(0);

$titre = 'SYNTHESE_LICENCE_'.date('d_m_Y_h_i_s');
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