
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
		$excel->getActiveSheet()->freezePane('I8');

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
			-> setCellValue('D4', 'DOSSIERS '.$maClasse-> getNomClient($_GET['id_cli']).' '.$_GET['type']);
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
			-> setCellValue('C7', 'REF. DECLARATION')
			-> setCellValue('D7', 'DATE DECLARATION')
			-> setCellValue('E7', 'REF. LIQUIDATION')
			-> setCellValue('F7', 'DATE LIQUIDATION')
			-> setCellValue('G7', 'REF. QUITTANCE')
			-> setCellValue('H7', 'DATE QUITTANCE');


		cellColor('A'.$row, '000000');
		cellColor('B'.$row, '000000');
		cellColor('C'.$row, '000000');
		cellColor('D'.$row, '000000');
		cellColor('E'.$row, '000000');
		cellColor('F'.$row, '000000');
		cellColor('G'.$row, '000000');
		cellColor('H'.$row, '000000');


		alignement('A'.$row);
		alignement('B'.$row);
		alignement('C'.$row);
		alignement('D'.$row);
		alignement('E'.$row);
		alignement('F'.$row);
		alignement('G'.$row);
		alignement('H'.$row);

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

		if ($_GET['type'] == 'EN ATTENTE FACTURES') {
			$sqlFacture = " AND facture = '0'";
		}else if ($_GET['type'] == 'FACTURES') {
			$sqlFacture = " AND facture = '1'";
		}

		$requete = $connexion-> prepare("SELECT *
											FROM dossier
											WHERE cleared = '1'
												AND id_mod_lic = ?
												$sqlClient
												$sqlFacture");

		$requete-> execute(array($_GET['id_mod_lic']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur)
				-> setCellValue('B'.$row, $reponse['ref_dos'])
				-> setCellValue('C'.$row, $reponse['ref_decl'])
				-> setCellValue('D'.$row, $reponse['date_decl'])
				-> setCellValue('E'.$row, $reponse['ref_liq'])
				-> setCellValue('F'.$row, $reponse['date_liq'])
				-> setCellValue('G'.$row, $reponse['ref_quit'])
				-> setCellValue('H'.$row, $reponse['date_quit']);

            //Alignement 
            alignement('A'.$row);
            alignement('B'.$row);
            alignement('C'.$row);
            alignement('D'.$row);
            alignement('E'.$row);
            alignement('F'.$row);
            alignement('G'.$row);
            alignement('H'.$row);

			//Format date
			$excel-> getActiveSheet()
				->setCellValue('D'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_decl'])));
			$excel->getActiveSheet()->getStyle('D'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');
			$excel-> getActiveSheet()
				->setCellValue('F'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_liq'])));
			$excel->getActiveSheet()->getStyle('F'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');
			$excel-> getActiveSheet()
				->setCellValue('H'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_quit'])));
			$excel->getActiveSheet()->getStyle('H'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');

            
			$compteur++;
			$row++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A8:H'.($row-1))-> applyFromArray(
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
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		// Rename worksheet
		$type = $_GET['type'];
		$excel->getActiveSheet()->setTitle("DOSSIERS $type");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_DOSSIERS_'.$_GET['type'].'_'.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'_'.date('d_m_Y_h_i_s');
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