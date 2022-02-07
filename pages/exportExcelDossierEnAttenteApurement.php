
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
include('afficherDossierEnAttenteApurementExcel.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;

	//--- Recuperation d'années -------
		//Selecting active sheet
		$excel-> setActiveSheetIndex($indiceSheet);


		//Get data
		//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

		//$entree['id_mod_lic'] = $_GET['id_mod_lic'];
		//$entree['id_cli'] = $_GET['id_cli'];


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
		$excel->getActiveSheet()->freezePane('C8');

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
			-> setCellValue('D4', 'DOSSIERS EN ATTENTE APUREMENT '.$maClasse-> getNomClient($_GET['id_cli']));
		$excel->getActiveSheet()
			->getStyle('D4')->applyFromArray($styleHeader2);

		//Fusionner les cellules
		/*$excel-> getActiveSheet()
			-> mergeCells('A1:I1');*/

		//Recuperation des en-tête

		$excel-> getActiveSheet()
			-> setCellValue('A7', '#')
			-> setCellValue('B7', 'MCA REF')
			-> setCellValue('C7', 'FOB')
			-> setCellValue('D7', 'FRET')
			-> setCellValue('E7', 'ASSURANCE')
			-> setCellValue('F7', 'AUTRES FRETS')
			-> setCellValue('G7', 'CIF')
			-> setCellValue('H7', 'REF. DECL.')
			-> setCellValue('I7', 'DATE DECL.')
			-> setCellValue('J7', 'REF. LIQUID.')
			-> setCellValue('K7', 'DATE LIQUID.')
			-> setCellValue('L7', 'REF. QUIT.')
			-> setCellValue('M7', 'DATE QUIT.')
			-> setCellValue('N7', 'NUM. LICENCE')
			-> setCellValue('O7', 'MONNAIE')
			-> setCellValue('P7', 'DATE VAL.')
			-> setCellValue('Q7', 'DATE ECH.')
			-> setCellValue('R7', 'CIF')
			-> setCellValue('S7', 'NUM. AV')
			-> setCellValue('T7', 'MONTANT AV')
			-> setCellValue('U7', 'FACTURE')
			-> setCellValue('V7', 'BL/LTA');


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
		cellColor('Q'.$row, '000000');
		cellColor('R'.$row, '000000');
		cellColor('S'.$row, '000000');
		cellColor('T'.$row, '000000');
		cellColor('U'.$row, '000000');
		cellColor('V'.$row, '000000');


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
		alignement('Q'.$row);
		alignement('R'.$row);
		alignement('S'.$row);
		alignement('T'.$row);
		alignement('U'.$row);
		alignement('V'.$row);

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
		$excel->getActiveSheet()
			->getStyle('R'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('S'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('T'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('U'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('V'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()-> getStyle('A'.$row.':V'.$row)-> applyFromArray(
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

			//Affichage des dossiers
			afficherDossierEnAttenteApurementExcel($_GET['id_cli'], $_GET['id_mod_lic'], $row, $excel, $compteur);

		//----------- FIN Récuperation des LICENCES ------------


		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		$excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('D')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('E')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('F')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('G')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('H')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('I')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('J')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('K')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('L')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('M')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('N')-> setWidth(25);
		$excel-> getActiveSheet()-> getColumnDimension('O')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('P')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('Q')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('R')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('S')-> setWidth(25);
		$excel-> getActiveSheet()-> getColumnDimension('T')-> setWidth(10);
		$excel-> getActiveSheet()-> getColumnDimension('U')-> setWidth(45);
		$excel-> getActiveSheet()-> getColumnDimension('V')-> setWidth(30);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		// Rename worksheet

		$excel->getActiveSheet()->setTitle("EN_ATTENTE_APUREMENT");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();


//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_EN_ATTENTE_APUREMENT_'.date('d_m_Y_h_i_s');
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