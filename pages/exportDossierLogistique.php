
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


		$row = 1;
		$col = 'A';

		//Image dans la cellule
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('test_img');
		// $objDrawing->setDescription('Logo en-tete');
		// $objDrawing->setPath('../images/Logo MRDC.JPG');
		// $objDrawing->setHeight(40);
		// $objDrawing->setCoordinates('A1');
		// $objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('G2');

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

		$styleHeader3 = array(
		    'font'  => array(
		        'color' => array('rgb' => 'FFFFFF'),
		        'name' => 'Verdana'
		    ));
if ($_GET['id_trans']==3) {//Import Route
	
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '#');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'MCA File No');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'PoL');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'PoD');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Truck No');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Trailer No');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Driver Name');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Lic Number');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Tel Number');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Date Of Loading');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Date Of Dispatch');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Entry Point');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Border In');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Border Out');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Present Position');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'STATUS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Remarks');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()-> getStyle('A1:'.$col.$row)-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);


		$row++;
		$col = 'A';

		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		
		//----------- Récuperation des DOSSIERS ------------

		$requete = $connexion-> prepare("SELECT d.*, 
												IF(d.id_mod_trans='1', 'ROAD', 'AIR') AS nom_mod_trans
											FROM dossier_logistique d
											WHERE d.id_cli = ?
												AND d.id_trans = ?");

		$requete-> execute(array($_GET['id_cli'], $_GET['id_trans']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';
			$col = 'A';
			
			$compteur++;

			$ok_apurement = '';
			
			if ($reponse['statut']=='ARRIVED') {

				$style = "style='color: blue;'";
				$styleHeader = array(
				    'font'  => array(
				        'color' => array('rgb' => '0000FF')
				    ));

			}else if ($reponse['statut']=='CANCELLED'){
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
				-> setCellValue($col.$row, $compteur);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_dos']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['point_load']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['destination']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['horse']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['trailer_1']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['nom_chauf']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['lic_num']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['tel_chauf']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_load']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_dispatch']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['frontiere']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;


			//Format date
			if ($reponse['front_in']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['front_in'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			//Format date
			if ($reponse['front_out']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['front_out'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['localisation']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['statut']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['remarque']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des DOSSIERS ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A2:'.$col.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$nom_transit = $maClasse-> getNomTransit($_GET['id_trans']);
		$excel->getActiveSheet()->setTitle("LOGISTIC $nom_transit");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


}else{

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '#');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FILE REF');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'MCA FILE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'MODE OF DELIVERY');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'MANIFEST / AWB');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'INVOICE NO.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'BATCH Num.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'POIDS/KG');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'PO/ QUOTE REF');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'AMOUNT');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'ORIGIN');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FINAL DESTINATION');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DEPART FBM');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'TRANSIT');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'TRANSIT DATE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'ARRIVAL FD');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DELIVERY DATE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'POD REF');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'STATUS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REMARK');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()-> getStyle('A1:'.$col.$row)-> applyFromArray(
					array(
						'borders' => array(
							'allborders' => array(
								'style' => PHPExcel_Style_Border::BORDER_THIN
							)
						)
					)
				);


		$row++;
		$col = 'A';

		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		
		//----------- Récuperation des DOSSIERS ------------

		$requete = $connexion-> prepare("SELECT d.*, 
												IF(d.id_mod_trans='1', 'ROAD', 'AIR') AS nom_mod_trans
											FROM dossier_logistique d
											WHERE d.id_cli = ?
												AND d.id_trans = ?");

		$requete-> execute(array($_GET['id_cli'], $_GET['id_trans']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';
			$col = 'A';
			
			$compteur++;

			$ok_apurement = '';
			
			if ($reponse['statut']=='ARRIVED') {

				$style = "style='color: blue;'";
				$styleHeader = array(
				    'font'  => array(
				        'color' => array('rgb' => '0000FF')
				    ));

			}else if ($reponse['statut']=='CANCELLED'){
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
				-> setCellValue($col.$row, $compteur);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_dos']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_mca']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['nom_mod_trans']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['road_manif']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_fact']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_batch']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['poids']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_po']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['montant_po']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['origine']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['destination']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;


			//Format date
			if ($reponse['date_dep_fbm']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_dep_fbm'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['transit']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			//Format date
			if ($reponse['date_transit']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_transit'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			//Format date
			if ($reponse['date_fd']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_fd'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			//Format date
			if ($reponse['deliv_date']!='') {
				$excel-> getActiveSheet()
				->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['deliv_date'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');

				$excel->getActiveSheet()
			        ->getColumnDimension($col)
			        ->setAutoSize(true);
	
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
	            alignement($col.$row);


	             $col++;
			}else{
	             $col++;
			}
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_pod']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['statut']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['remarque']);
            
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleHeader);
            alignement($col.$row);

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des DOSSIERS ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A2:'.$col.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$nom_transit = $maClasse-> getNomTransit($_GET['id_trans']);
		$excel->getActiveSheet()->setTitle("LOGISTIC $nom_transit");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


}
//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_'.$maClasse-> getNomTransit($_GET['id_trans']).'_'.date('d_m_Y_h_i_s');
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