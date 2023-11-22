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
		$excel->getActiveSheet()->freezePane('D8');

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
			-> setCellValue('D4', 'TRANSMIS POUR APUREMENT '.$maClasse-> getNomClient($_GET['id_cli']).' N. '.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['ref_trans_ap'].' DU '.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['date_trans_ap']);
		$excel->getActiveSheet()
			->getStyle('D4')->applyFromArray($styleHeader2);

		$excel-> getActiveSheet()
			-> setCellValue('L1', 'Lubumbashi, le '.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['date_trans_ap']);

		$excel-> getActiveSheet()
			-> setCellValue('L3', 'cina@malabar-group.com');

		$excel-> getActiveSheet()
			-> setCellValue('L4', 'Tél.: +243 81 403 0796');

		$excel-> getActiveSheet()
			-> setCellValue('L5', 'Licence.depart2@malabar-group.com');

		$excel-> getActiveSheet()
			-> setCellValue('L6', 'Tel.: +243 81 465 8850');

		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A7', '#')
			-> setCellValue('B7', 'NUMERO MCA')
			-> setCellValue('C7', 'NUMERO DEC')
			-> setCellValue('D7', 'MONNAIE')
			-> setCellValue('E7', 'DATE VALIDATION')
			-> setCellValue('F7', 'DATE ECHEANCE')
			-> setCellValue('G7', 'CIF')
			-> setCellValue('H7', 'MONTANT APURE')
			-> setCellValue('I7', 'NUMERO AV')
			-> setCellValue('J7', 'MONTANT AV')
			-> setCellValue('K7', 'REF. FACTURE')
			-> setCellValue('L7', 'REF. DECLARATION')
			-> setCellValue('M7', 'REF. ASSURANCE')
			-> setCellValue('N7', 'BL/LTA')
			-> setCellValue('O7', 'TYPE PAIEMENT')
			-> setCellValue('P7', 'REMARQUE');


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
		cellColor('L'.$row, '000000');
		cellColor('M'.$row, '000000');
		cellColor('N'.$row, '000000');
		cellColor('O'.$row, '000000');
		cellColor('P'.$row, '000000');


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
		alignement('L'.$row);
		alignement('M'.$row);
		alignement('N'.$row);
		alignement('O'.$row);
		alignement('P'.$row);

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
		$excel->getActiveSheet()
			->getStyle('P'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()-> getStyle('A'.$row.':P'.$row)-> applyFromArray(
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

		$requete = $connexion-> prepare("SELECT DISTINCT(d.num_lic) AS num_lic
											FROM dossier d, detail_apurement da, transmission_apurement ta
											WHERE ta.id_trans_ap = ?
												AND ta.id_trans_ap = da.id_trans_ap
												AND da.id_dos = d.id_dos
											ORDER BY da.id_trans_ap ASC");

		$requete-> execute(array($_GET['id_trans_ap']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';

			$date_val = $maClasse-> getDataLicence2($reponse['num_lic']);
			$date_exp = $maClasse-> getLastEpirationLicence2($reponse['num_lic']);

			$excel-> getActiveSheet()
				-> setCellValue('C'.$row, $reponse['num_lic'])
				-> setCellValue('D'.$row, $maClasse-> getDataLicence2($reponse['num_lic'])['sig_mon'])
				-> setCellValue('E'.$row, $maClasse-> getDataLicence($reponse['num_lic'])['date_val'])
				-> setCellValue('F'.$row, $date_exp)
				-> setCellValue('G'.$row, $maClasse-> getDataLicence($reponse['num_lic'])['cif']);

			//Format date
			$excel-> getActiveSheet()
				->setCellValue('E'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($maClasse-> getDataLicence2($reponse['num_lic'])['date_val'])));
			$excel->getActiveSheet()->getStyle('E'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');

			$excel-> getActiveSheet()
				->setCellValue('F'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($date_exp)));
			$excel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');

            //Alignement 
            alignement('C'.$row);
            alignement('D'.$row);
            alignement('E'.$row);
            alignement('F'.$row);
            alignement('G'.$row);

			//Affichage des dossiers
			afficherDossierLicenceTransmisionApurementExcel($reponse['num_lic'], $_GET['id_trans_ap'], $row, $excel, $compteur, $couleur);

			/*if ($maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap']) > 1) {
				
				for ($i=$compteur; $i <= $maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap']) ; $i++) { 
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
			
             if ($maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap']) > 1) {

				//Fusionner les cellules
				$excel-> getActiveSheet()
					-> mergeCells('C'.$row.':C'.($row+$maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('D'.$row.':D'.($row+$maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('E'.$row.':E'.($row+$maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('F'.$row.':F'.($row+$maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('G'.$row.':G'.($row+$maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap'])-1));

				$row += $maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap']);
				$compteur += $maClasse-> getNombreDossierApureLicence($reponse['num_lic'], $_GET['id_trans_ap']);
			}else{
				$row++;
				$compteur++;
			}

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A8:P'.($row-1))-> applyFromArray(
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
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		$incrementColonne = 3;
		$lettre = 'C';
		while ($incrementColonne <= 14) {

			if ($lettre == 'C') {
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(35);
			}else if ($lettre == 'D') {
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(10);
			}else{
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(25);
			}

			alignement("$lettre");

			$lettre++;
			$incrementColonne++;
		}

		// Rename worksheet
		$ref_trans_ap = $maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['ref_trans_ap'];
		$date_trans_ap = $maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['date_trans_ap2'];
		$banque = $maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['banque'];
		$excel->getActiveSheet()->setTitle("$ref_trans_ap DU $date_trans_ap $banque");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_TRANSMIS_APUREMENT_'.$maClasse-> getTransmissionApurement($_GET['id_trans_ap'])['ref_trans_ap'].'_'.date('d_m_Y_h_i_s');
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