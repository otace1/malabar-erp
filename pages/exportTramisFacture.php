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
include('afficherDossierFactureTransmisionExcel.php');
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

		$row = 11;
		$col = 'C';

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/malabar2.png');
		$objDrawing->setHeight(50);
		$objDrawing->setCoordinates('A1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		//$excel->getActiveSheet()->freezePane('D11');

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

		$styleHeader3 = array(
		    'font'  => array(
		        'bold' => true,
		        'color' => array('rgb' => '000000'),
		        'name' => 'Verdana'
		    ));

		$styleHeader = array(
		    'font'  => array(
		        'bold' => true,
		        'color' => array('rgb' => 'FFFFFF'),
		        'name' => 'Verdana'
		    ));

		$excel-> getActiveSheet()
			-> setCellValue('G1', 'Lubumbashi, le '.date('d/m/Y'));

		$excel-> getActiveSheet()
			-> setCellValue('G3', $maClasse-> getClient($_GET['id_cli'])['nom_cli']);
		$excel->getActiveSheet()
			->getStyle('G3')->applyFromArray($styleHeader3);

		$excel-> getActiveSheet()
			-> setCellValue('D5', 'TRANSMIS '.$maClasse-> getTransmisFactureDossier($_GET['id_trans_fact'])['ref_trans_fact'].' DU '.$maClasse-> getTransmisFactureDossier($_GET['id_trans_fact'])['date_trans_fact']);
		$excel->getActiveSheet()
			->getStyle('D5')->applyFromArray($styleHeader3);

		$excel-> getActiveSheet()
			-> setCellValue('C7', 'CONCERNE: TRANSMISSION FACTURE DOUANE EXPRESS CUSTOMS');

		$excel-> getActiveSheet()
			-> setCellValue('C9', 'Veuillez trouver en annexe pour paiement les factures ci-après:');

		// $excel-> getActiveSheet()
		// 	-> setCellValue('H1', 'Lubumbashi, le '.$maClasse-> getTransmissionApurement($_GET['id_trans_fact'])['date_trans_ap']);

		// $excel-> getActiveSheet()
		// 	-> setCellValue('H3', 'charles@malabar-group.com');

		// $excel-> getActiveSheet()
		// 	-> setCellValue('H4', 'Tél.: +243 81 403 0796');

		// $excel-> getActiveSheet()
		// 	-> setCellValue('H5', 'Tél.: +243 81 403 0796');

		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, '#')
			-> setCellValue('B'.$row, 'Reference Facture')
			-> setCellValue('C'.$row, 'Reference Dossier')
			-> setCellValue('D'.$row, 'Description')
			-> setCellValue('E'.$row, 'Num. Déclaration')
			-> setCellValue('F'.$row, 'Date Déclaration')
			-> setCellValue('G'.$row, 'Num. Liquidation')
			-> setCellValue('H'.$row, 'Date Liquidation')
			-> setCellValue('I'.$row, 'Num. Quittance')
			-> setCellValue('J'.$row, 'Date Quittance')
			-> setCellValue('K'.$row, 'MONTANT');


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
		cellColor('K'.$row, '000000');


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
		alignement('K'.$row);

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

		$excel-> getActiveSheet()-> getStyle('A'.$row.':K'.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
                		'color' => array('rgb' => 'FFFFFF')
					)
				)
			)
		);

		//----------- Récuperation des FACTURES ------------

		$row=12;
		$col = 'C';

		$requete = $connexion-> prepare("SELECT DISTINCT(fd.ref_fact) AS ref_fact
											FROM facture_dossier fd, transmis_facture_dossier tr, detail_transmis_facture_dossier det
											WHERE tr.id_trans_fact = ?
												AND tr.id_trans_fact = det.id_trans_fact
												AND det.ref_fact = fd.ref_fact
											ORDER BY fd.date_fact");

		$requete-> execute(array($_GET['id_trans_fact']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = '';
			$apurement = '';

			$excel-> getActiveSheet()
				-> setCellValue('B'.$row, $reponse['ref_fact']);

			//Format date
			// $excel-> getActiveSheet()
			// 	->setCellValue('E'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($maClasse-> getDataLicence2($reponse['ref_fact'])['date_val'])));
			// $excel->getActiveSheet()->getStyle('E'.$row)->getNumberFormat()
   //           ->setFormatCode('dd/mm/yyyy');


            //Alignement 
            alignement('B'.$row);

			//Affichage des dossiers
			afficherDossierFactureTransmisionExcel($reponse['ref_fact'], $excel, $row, $compteur);

			/*if ($maClasse-> getNombreDossierApureLicence($reponse['ref_fact'], $_GET['id_trans_fact']) > 1) {
				
				for ($i=$compteur; $i <= $maClasse-> getNombreDossierApureLicence($reponse['ref_fact'], $_GET['id_trans_fact']) ; $i++) { 
					$excel-> getActiveSheet()
						-> setCellValue('A'.$row, $compteur+1);
					alignement('A'.$row);
				}

			}else{
				$excel-> getActiveSheet()
					-> setCellValue('A'.$row, $compteur);
				alignement('A'.$row);
			}*/

			/*$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur);
			alignement('A'.$row);*/
			
             if ($maClasse-> getNombreDossierFacture2($reponse['ref_fact']) > 1) {

				//Fusionner les cellules
				$excel-> getActiveSheet()
					-> mergeCells('B'.$row.':B'.($row+$maClasse-> getNombreDossierFacture2($reponse['ref_fact'])-1));

				$row += $maClasse-> getNombreDossierFacture2($reponse['ref_fact']);
				$compteur += $maClasse-> getNombreDossierFacture2($reponse['ref_fact']);
			}else{
				$row++;
				$compteur++;
			}

		}$requete-> closeCursor();

		$excel-> getActiveSheet()
			-> mergeCells('A'.$row.':F'.$row);
		$excel-> getActiveSheet()
				-> setCellValue('A'.$row, 'TOTAL')
				-> setCellValue('G'.$row, '=ROUND(SUM(G12:G'.($row-1).'),3)')
				-> setCellValue('K'.$row, '=SUM(K12:K'.($row-1).')');

		alignement('A'.$row);
		alignement('G'.$row);
		alignement('J'.$row);
		alignement('K'.$row);

		//----------- FIN Récuperation des FACTURES ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A11:K'.($row))-> applyFromArray(
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
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		$incrementColonne = 3;
		$lettre = 'C';
		while ($incrementColonne <= 14) {

			if ($lettre == 'C') {
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(20);
			}else if ($lettre == 'D') {
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(30);
			}else{
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(15);
			}

			alignement("$lettre");

			$lettre++;
			$incrementColonne++;
		}

		// Rename worksheet
		$ref_trans_fact = $maClasse-> getTransmisFactureDossier($_GET['id_trans_fact'])['ref_trans_fact'];
		$date_trans_ap = $maClasse-> getTransmisFactureDossier($_GET['id_trans_fact'])['date_trans_fact2'];
		$excel->getActiveSheet()->setTitle("$ref_trans_fact DU $date_trans_ap");


		//Cache / Sceau
		// $objDrawing = new PHPExcel_Worksheet_Drawing();
		// $objDrawing->setName('sceau');
		// $objDrawing->setDescription('Sceau');
		// $objDrawing->setPath('../images/sceau.png');
		// $objDrawing->setHeight(380);
		// $objDrawing->setCoordinates('D'.$row);
		// $objDrawing->setWorksheet($excel->getActiveSheet());


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = 'TRANSMIS '.$maClasse-> getTransmisFactureDossier($_GET['id_trans_fact'])['ref_trans_fact'].'_'.date('d_m_Y_h_i_s');
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