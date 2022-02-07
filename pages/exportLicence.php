
<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');

$maClasse = new MaClasse();

//Create PHPExcel object
$excel = new PHPExcel();

// Rename worksheet
$transit = '';
if ($_GET['id_mod_lic'] == '1') {
	$transit = 'Export';
}
else if ($_GET['id_mod_lic'] == '2') {
	$transit = 'Import';
}


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
include('afficherDossierLicenceExcel.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;

	//--- Recuperation d'années -------
	for ($annee=date('Y'); $annee >= 2020; $annee--) { 
		//$entree['annee']='%'.substr($annee, -2).'-%';
		$entree['annee']= $annee;

		//Selecting active sheet
		$excel-> setActiveSheetIndex($indiceSheet);


		//Get data
		//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

		$entree['id_mod_lic'] = $_GET['id_mod_lic'];
		$entree['id_cli'] = $_GET['id_cli'];


		$sql1 = "";
		$sqlOrder = "";
		$sqlIdMarch = "";
		$sqlStatus = "";
		$sqlLicence = "";
		$sqlCleared = "";
		$compteur = 1;

		$row = 4;
		$col = 'C';

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/Logo MRDC.JPG');
		$objDrawing->setHeight(40);
		$objDrawing->setCoordinates('E1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('G5');

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
			-> setCellValue('A1', 'TRACKING LICENCES '.$maClasse-> getNomClient($_GET['id_cli']).' '.$annee);
		$excel->getActiveSheet()
			->getStyle('A1')->applyFromArray($styleHeader2);

		//Fusionner les cellules
		$excel-> getActiveSheet()
			-> mergeCells('A1:I1');
		$excel-> getActiveSheet()
			-> mergeCells('A3:B3');
		$excel-> getActiveSheet()
			-> mergeCells('C3:E3');
		$excel-> getActiveSheet()
			-> mergeCells('F3:P3');
		$excel-> getActiveSheet()
			-> mergeCells('Q3:S3');
		$excel-> getActiveSheet()
			-> mergeCells('T3:Z3');
		$excel-> getActiveSheet()
			-> mergeCells('AA3:AE3');

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A3', 'MCA')
			-> setCellValue('C3', 'CLIENT')
			-> setCellValue('F3', 'LICENCE')
			-> setCellValue('Q3', 'AV')
			-> setCellValue('T3', 'FACTURE FOURNISSEUR')
			-> setCellValue('AA3', 'DOCUMENTS APUREMENT');

		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, '#')
			-> setCellValue('B'.$row, 'MCA REF')
			-> setCellValue('C'.$row, 'FOURNISSEUR')
			-> setCellValue('D'.$row, 'Nº PO')
			-> setCellValue('E'.$row, 'Nº FACTURE')
			-> setCellValue('F'.$row, 'Nº LICENCE')
			-> setCellValue('G'.$row, 'MONNAIE')
			-> setCellValue('H'.$row, 'FOB')
			-> setCellValue('I'.$row, 'FRET')
			-> setCellValue('J'.$row, 'ASSURANCE')
			-> setCellValue('K'.$row, 'AUTRES FRAIS')
			-> setCellValue('L'.$row, 'TOTAL')
			-> setCellValue('M'.$row, 'FSI')
			-> setCellValue('N'.$row, 'AUR')
			-> setCellValue('O'.$row, 'VALIDATION')
			-> setCellValue('P'.$row, 'EXTREME VALIDITE')
			-> setCellValue('Q'.$row, 'Nº COD')
			-> setCellValue('R'.$row, 'Nº FXI')
			-> setCellValue('S'.$row, 'MONTANT')
			-> setCellValue('T'.$row, 'DATE')
			-> setCellValue('U'.$row, 'Nº')
			-> setCellValue('V'.$row, 'FOB')
			-> setCellValue('W'.$row, 'FRET')
			-> setCellValue('X'.$row, 'ASSURANCE')
			-> setCellValue('Y'.$row, 'AUTRES FRAIS')
			-> setCellValue('Z'.$row, 'TOTAL')
			-> setCellValue('AA'.$row, 'Nº E')
			-> setCellValue('AB'.$row, 'MONTANT')
			-> setCellValue('AC'.$row, 'Nº L')
			-> setCellValue('AD'.$row, 'Nº Q')
			-> setCellValue('AE'.$row, 'DATE Q')
			-> setCellValue('AF'.$row, 'OBSERVATION');

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
		cellColor('W'.$row, '000000');
		cellColor('X'.$row, '000000');
		cellColor('Y'.$row, '000000');
		cellColor('Z'.$row, '000000');
		cellColor('AA'.$row, '000000');
		cellColor('AB'.$row, '000000');
		cellColor('AC'.$row, '000000');
		cellColor('AD'.$row, '000000');
		cellColor('AE'.$row, '000000');
		cellColor('AF'.$row, '000000');


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
		alignement('W'.$row);
		alignement('X'.$row);
		alignement('Y'.$row);
		alignement('Z'.$row);
		alignement('AA'.$row);
		alignement('AB'.$row);
		alignement('AC'.$row);
		alignement('AD'.$row);
		alignement('AE'.$row);
		alignement('AF'.$row);

		$excel->getActiveSheet()
			->getStyle('A3')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('C3')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('F3')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('Q3')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('T3')->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AA3')->applyFromArray($styleHeader);

		$excel-> getActiveSheet()-> getStyle('A3:Z3')-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN,
                		'color' => array('rgb' => 'FFFFFF')
					)
				)
			)
		);

		cellColor('A3', '000000');
		cellColor('C3', '000000');
		cellColor('F3', '000000');
		cellColor('Q3', '000000');
		cellColor('T3', '000000');
		cellColor('AA3', '000000');

		alignement('A3');
		alignement('C3');
		alignement('F3');
		alignement('Q3');
		alignement('T3');
		alignement('AA3');


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
			->getStyle('Q'.$row)->applyFromArray($styleHeader);
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
		$excel->getActiveSheet()
			->getStyle('W'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('X'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('Y'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('Z'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AA'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AB'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AC'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AD'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AE'.$row)->applyFromArray($styleHeader);
		$excel->getActiveSheet()
			->getStyle('AF'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()-> getStyle('A'.$row.':AF'.$row)-> applyFromArray(
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
		$sqlTypeLicence = '';
		if (isset($_GET['id_type_lic']) && ($_GET['id_type_lic'] != '')) {
			$sqlTypeLicence = ' AND l.id_type_lic = "'.$_GET['id_type_lic'].'"';
		}

		$row = 5;
		$col = 'C';
		$requete = $connexion-> prepare("SELECT UPPER(l.fournisseur) AS fournisseur,
												UPPER(l.acheteur) AS acheteur,
												l.ref_fact AS ref_fact,
												l.num_lic AS num_lic,
												mon.sig_mon AS sig_mon,
												l.fob AS fob,
												l.fret AS fret,
												l.assurance AS assurance,
												l.autre_frais AS autre_frais,
												(l.fob+l.fret+l.autre_frais) AS cif,
												l.fsi AS fsi,
												l.aur AS aur,
												DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val,
												l.date_val AS date_val2,
												l.apurement AS apurement,
												CURRENT_DATE() AS ajourdhui
											FROM licence l, client cl, monnaie mon
											WHERE cl.id_cli = ?
												AND l.id_cli = cl.id_cli
												AND l.id_mon = mon.id_mon
												AND l.id_mod_lic = ?
												AND YEAR(l.date_val) = ?
												$sqlTypeLicence
												ORDER BY l.date_val ASC");
		$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['annee']));
		while ($reponse = $requete-> fetch()) {
			$bg = "";
			$styleHeader = '';
			$couleur = 'FFFFFF';
			$apurement = '';

			$date_exp = $maClasse-> getLastEpirationLicence2($reponse['num_lic']);

			//Licence Apurée
			if (($reponse['apurement'] == '1') || ( ($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) == $maClasse-> getNombreDossierLicence($reponse['num_lic'])) && ($maClasse-> getNombreDossierLicence($reponse['num_lic']) > 1) )/**/ ) {

				$couleur = '00FF7F';
				$apurement = 'TOTAL';

			}//Partiellement Apurée
			else if(($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) >= 1) && ($date_exp >= $reponse['ajourdhui']) ){
				
				$couleur = 'F0E68C';
				$apurement = 'PARTIEL';

			}//Partiellement Apurée et Expirée
			else if(($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) >= 1) && ($date_exp < $reponse['ajourdhui']) ){
				
				$couleur = 'DA70D6';
				$apurement = 'PARTIEL ET EXPIREE';

			}//Licence Expirée
			else if($date_exp <= $reponse['ajourdhui']){

				$couleur = 'CD5C5C';
				$apurement = 'EXPIREE';

			}

			$styleHeader = array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => $couleur)
			        ));

			$excel->getActiveSheet()
				->getStyle('A'.$row.':AF'.$row)->applyFromArray($styleHeader);

			$excel-> getActiveSheet()
				-> setCellValue('C'.$row, $reponse['fournisseur'])
				-> setCellValue('E'.$row, $maClasse-> getFactureLicence($reponse['num_lic'])['ref_fact'])
				-> setCellValue('F'.$row, $reponse['num_lic'])
				-> setCellValue('G'.$row, $reponse['sig_mon'])
				-> setCellValue('H'.$row, $reponse['fob'])
				-> setCellValue('I'.$row, $reponse['fret'])
				-> setCellValue('J'.$row, $reponse['assurance'])
				-> setCellValue('K'.$row, $reponse['autre_frais'])
				-> setCellValue('L'.$row, $reponse['cif'])
				-> setCellValue('M'.$row, $reponse['fsi'])
				-> setCellValue('N'.$row, $reponse['aur'])
				-> setCellValue('O'.$row, $reponse['date_val'])
				-> setCellValue('P'.$row, $date_exp)
				-> setCellValue('AF'.$row, $apurement);

			//Format date
			$excel-> getActiveSheet()
				->setCellValue('O'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_val2'])));
			$excel->getActiveSheet()->getStyle('O'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');
			$excel-> getActiveSheet()
				->setCellValue('P'.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($date_exp)));
			$excel->getActiveSheet()->getStyle('P'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');

			alignement('A'.$row);
			alignement('B'.$row);

			$incrementColonne = 3;
			$lettre = 'C';

			while ($incrementColonne <= 32) {

				alignement($lettre.$row);

				$lettre++;
				$incrementColonne++;
			}

			//Affichage des dossiers
			afficherDossierLicenceExcel($reponse['num_lic'], $row, $excel, $compteur, $couleur);

			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, $compteur);
			alignement('A'.$row);
			
			//On test si la licence a plusieurs dossiers pour fusionner les lignes
			if ($maClasse-> getNombreDossierLicence($reponse['num_lic']) > 1) {

				//Fusionner les cellules
				$excel-> getActiveSheet()
					-> mergeCells('C'.$row.':C'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('E'.$row.':E'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('F'.$row.':F'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('G'.$row.':G'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('H'.$row.':H'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('I'.$row.':I'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('J'.$row.':J'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('K'.$row.':K'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('L'.$row.':L'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('M'.$row.':M'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('N'.$row.':N'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('O'.$row.':O'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('P'.$row.':P'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));
				$excel-> getActiveSheet()
					-> mergeCells('AF'.$row.':AF'.($row+$maClasse-> getNombreDossierLicence($reponse['num_lic'])-1));

				$row += $maClasse-> getNombreDossierLicence($reponse['num_lic']);
				$compteur += $maClasse-> getNombreDossierLicence($reponse['num_lic']);
			}else{
				$row++;
				$compteur++;
			}

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		$incrementColonne = 3;
		$lettre = 'C';
		while ($incrementColonne <= 32) {

			if ($lettre == 'C') {
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(35);
			}else{
				$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(25);
			}

			alignement("$lettre");

			$lettre++;
			$incrementColonne++;
		}

	     $excel->getActiveSheet()->getStyle('B:'.$col)->getAlignment()->applyFromArray(
	             array(
	                 'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
	                 'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
	                 'rotation'   => 0,
	                 'wrap'       => true
	             )
	     );


		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A5:'.$lettre.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		// Rename worksheet

		$excel->getActiveSheet()->setTitle("$annee");


		// Set active sheet index to the first sheet, so Excel opens this as the first sheet
		$excel->setActiveSheetIndex($indiceSheet);


		$indiceSheet++;

		$excel->createSheet();



	}

//--- FIN Recuperation années -------


$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].'_LICENCE_'.$transit.'_'.date('d_m_Y_h_i_s');
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