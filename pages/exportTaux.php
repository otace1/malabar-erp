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


include('../classes/connexion.php');
include('afficherRowTableauExcel.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;
//Selecting active sheet
$excel-> setActiveSheetIndex($indiceSheet);

$col = 'A';
$row = 1;
$compteur = 0;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, '#');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'Date');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'BCC');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RAWBANK Amt');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'RAWBANK Diff.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'EQUITY BCDC Amt');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'EQUITY BCDC Diff.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'ECOBANK Amt');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'ECOBANK Diff.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'ACCESS BANK Amt.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$excel-> getActiveSheet()
		-> setCellValue($col.$row, 'ACCESS BANK Diff.');
	cellColor($col.$row, '000000');
	alignement($col.$row);
	$excel->getActiveSheet()
		->getStyle($col.$row)->applyFromArray($styleHeader);
	$col++;

	$row++;


	$requete = $connexion-> query("SELECT * FROM taux_bcc ORDER BY date_taux");
	// $requete-> execute(array($_GET['id_cli'], $_GET['id_mod_trac']));
	while($reponse=$requete-> fetch()){

		$reste_ecobank = $maClasse-> getMontantTauxBanque(5, $reponse['id'])-$reponse['montant'];
		$reste_rawbank = $maClasse-> getMontantTauxBanque(2, $reponse['id'])-$reponse['montant'];
		$reste_equity = $maClasse-> getMontantTauxBanque(3, $reponse['id'])-$reponse['montant'];
		$reste_access = $maClasse-> getMontantTauxBanque(10, $reponse['id'])-$reponse['montant'];

		$col = 'A';
		$compteur++;
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $compteur);
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['date_taux']);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reponse['montant']);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantTauxBanque(2, $reponse['id']));
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reste_rawbank);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantTauxBanque(3, $reponse['id']));
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reste_equity);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantTauxBanque(5, $reponse['id']));
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reste_ecobank);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $maClasse-> getMontantTauxBanque(10, $reponse['id']));
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $reste_access);
		$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()->setFormatCode('# ### ##0.00');
		alignement($col.$row);
		$col++;

		$row++;

	}$requete-> closeCursor();



$excel->setActiveSheetIndex(0);

$titre = 'Rate_'.date('d_m_Y_h_i_s');
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