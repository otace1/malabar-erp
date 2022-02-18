
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

		// //Image dans la cellule
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('test_img');
		// $objDrawing->setDescription('Logo en-tete');
		// $objDrawing->setPath('../images/Logo MRDC.JPG');
		// $objDrawing->setHeight(40);
		// $objDrawing->setCoordinates('A1');
		// $objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('H4');

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
			-> setCellValue('D1', 'TRACKING REPORT SUMMARY '.$maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']));
		$excel->getActiveSheet()
			->getStyle('D1')->applyFromArray($styleHeader2);


		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A2', '#')
			-> setCellValue('B2', 'CUSTOMER CODE')
			-> setCellValue('C2', 'CUSTOMER NAME')
			-> setCellValue('D2', 'SECTOR');

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
			-> mergeCells('A2:A3');
		$excel-> getActiveSheet()
			-> mergeCells('B2:B3');
		$excel-> getActiveSheet()
			-> mergeCells('C2:C3');
		$excel-> getActiveSheet()
			-> mergeCells('D2:D3');
		
		//Priemière ligne de l'en-tete
		$col = 'E';
		$col2 = '';

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'AWAITING CRF/AD/INSURANCE');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'UNDER PREPARATION');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'AWAITING LIQUIDATION');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'AWAITING QUITTANCE');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'AWAITING BAE/BS');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

		$excel-> getActiveSheet()
				-> setCellValue($col.'2', 'CLEARING COMPLETED');
			cellColor($col.'2', 'AF002A');
			alignement($col.'2');
			$excel->getActiveSheet()
				->getStyle($col.'2')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(20);

			//Fusion
			$col2 = $col;
			for ($J=1; $J <= 2 ; $J++) { 
				$col2++;
			}

			$excel-> getActiveSheet()
				-> mergeCells($col.'2:'.($col2).'2');
			
			for ($J=1; $J <= 3 ; $J++) { 
				$col++;
			}

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

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

		$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'TOTAL FILES');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');

			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 5 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.'3', 'FILES OVER 10 DAYS');

			cellColor($col.'3', '87CEEB');
			alignement($col.'3');
			$excel->getActiveSheet()
				->getStyle($col.'3')->applyFromArray($styleHeader);

			$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);

			$col++;

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
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING CRF/AD/INSURANCE'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING CRF/AD/INSURANCE'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING CRF/AD/INSURANCE', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING CRF/AD/INSURANCE', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'UNDER PREPARATION'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'UNDER PREPARATION'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'UNDER PREPARATION', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'UNDER PREPARATION', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING LIQUIDATION'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING LIQUIDATION'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING LIQUIDATION', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING LIQUIDATION', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING QUITTANCE'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING QUITTANCE'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING QUITTANCE', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING QUITTANCE', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING BAE/BS'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING BAE/BS'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING BAE/BS', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'AWAITING BAE/BS', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
				//------------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'CLEARING COMPLETED'));

				alignement($col.$row);
				if (($maClasse-> getNombreDossierClientModeLicenceStatusAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'CLEARING COMPLETED'))>0) {
					cellColor($col.$row, 'CD853F');
				}
				
				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'CLEARING COMPLETED', 5, 10);

				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);

				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				$nombre_jour = $maClasse-> getNombreDossierClientModeLicenceStatusCalculNetDaysAutomatique($reponseClient['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], 'CLEARING COMPLETED', 10, 1000);


				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $nombre_jour);
					
				alignement($col.$row);
				if ($nombre_jour>0) {
					cellColor($col.$row, 'CD853F');
				}

				$col++;

				//------------------
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
			
			//---------------
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=SUM('.$col.'4:'.$col.($row-1).')');

				cellColor($col.$row, '87CEEB');
				alignement($col.$row);

				$col++;

			//---------------

			//FIN Recuperation des nombres Totaux

		
		
		$excel-> getActiveSheet()-> getStyle('A2:'.$col.$row)-> applyFromArray(
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

		// //Creation des classeurs par status
		// $row = 3;
		// $nom_stat = '';
		// $requeteClasseurStatus = $connexion-> prepare("SELECT * 
		// 										FROM status_dashboard 
		// 										WHERE id_mod_lic = ?
		// 											AND active = '1'
		// 											AND nom_stat <> 'CLEARING COMPLETED'
		// 										ORDER BY rang_stat ASC");
		// $requeteClasseurStatus-> execute(array($_GET['id_mod_lic']));
		// while ($reponseClasseurStatus = $requeteClasseurStatus-> fetch()) {

		// 	$nom_stat = str_replace("/", "_", $reponseClasseurStatus['nom_stat']);
			
		// 	$indiceSheet++;

		// 	$excel->createSheet();

		// 	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		// 	$excel->setActiveSheetIndex($indiceSheet);

		// 	$excel->getActiveSheet()->setTitle($nom_stat);


		// 	//Affichage des contenues des classeurs
		// 	include('contenueClasseurDashboardDossiers.php');
		// 	//FIN Affichage des contenues des classeurs

		// }$requeteClasseurStatus-> closeCursor();
		
		//FIN Creation des classeurs par status



$excel->setActiveSheetIndex(0);

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