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
$indiceSheet = 0;

include('../classes/connexion.php');
//Font-Color

		$row = 3;
		$col = 'D';

		//Image dans la cellule
		$objDrawing = new PHPExcel_Worksheet_Drawing();
		$objDrawing->setName('test_img');
		$objDrawing->setDescription('Logo en-tete');
		$objDrawing->setPath('../images/Logo MRDC.JPG');
		$objDrawing->setHeight(40);
		$objDrawing->setCoordinates('E1');
		$objDrawing->setWorksheet($excel->getActiveSheet());

		//Figer colonne
		$excel->getActiveSheet()->freezePane('F4');

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
			-> setCellValue('A1', $_GET['type']);
		$excel->getActiveSheet()
			->getStyle('A1')->applyFromArray($styleHeader2);

		//Fusionner les cellules
		$excel-> getActiveSheet()
			-> mergeCells('A1:I1');

		//Recuperation des en-tête
		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, '#')
			-> setCellValue('B'.$row, 'LICENCE REF.')
			-> setCellValue('C'.$row, 'CUSTOMER NAME')
			-> setCellValue('D'.$row, 'DATE VALIDATION')
			-> setCellValue('E'.$row, 'EXTREME VALIDATION');

		cellColor('A'.$row, '000000');
		cellColor('B'.$row, '000000');
		cellColor('C'.$row, '000000');
		cellColor('D'.$row, '000000');
		cellColor('E'.$row, '000000');
		alignement('A'.$row);
		alignement('B'.$row);
		alignement('C'.$row);
		alignement('D'.$row);
		alignement('E'.$row);
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

		if ($_GET['id_mod_lic'] == '1') {
			$excel-> getActiveSheet()
				-> setCellValue('F'.$row, 'MEASURE')
				-> setCellValue('G'.$row, 'NB. AUTHORIZED')
				-> setCellValue('H'.$row, 'NB. FILES')
				-> setCellValue('I'.$row, 'NB. USED')
				-> setCellValue('J'.$row, 'BALANCE');
	
			cellColor('F'.$row, '000000');
			alignement('F'.$row);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);

			cellColor('G'.$row, '000000');
			alignement('G'.$row);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);

			cellColor('H'.$row, '000000');
			alignement('H'.$row);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);

			cellColor('I'.$row, '000000');
			alignement('I'.$row);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);

			cellColor('J'.$row, '000000');
			alignement('J'.$row);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);

		}else{
			$excel-> getActiveSheet()
				-> setCellValue('F'.$row, 'CURRENCY')
				-> setCellValue('G'.$row, 'FOB')
				-> setCellValue('H'.$row, 'CIF')
				-> setCellValue('I'.$row, 'NB. FILES')
				-> setCellValue('J'.$row, 'FOB USED')
				-> setCellValue('K'.$row, 'CIF USED')
				-> setCellValue('L'.$row, 'FOB BALANCE');

			cellColor('F'.$row, '000000');
			alignement('F'.$row);
			$excel->getActiveSheet()
				->getStyle('F'.$row)->applyFromArray($styleHeader);

			cellColor('G'.$row, '000000');
			alignement('G'.$row);
			$excel->getActiveSheet()
				->getStyle('G'.$row)->applyFromArray($styleHeader);

			cellColor('H'.$row, '000000');
			alignement('H'.$row);
			$excel->getActiveSheet()
				->getStyle('H'.$row)->applyFromArray($styleHeader);

			cellColor('I'.$row, '000000');
			alignement('I'.$row);
			$excel->getActiveSheet()
				->getStyle('I'.$row)->applyFromArray($styleHeader);

			cellColor('J'.$row, '000000');
			alignement('J'.$row);
			$excel->getActiveSheet()
				->getStyle('J'.$row)->applyFromArray($styleHeader);

			cellColor('K'.$row, '000000');
			alignement('K'.$row);
			$excel->getActiveSheet()
				->getStyle('K'.$row)->applyFromArray($styleHeader);

			cellColor('L'.$row, '000000');
			alignement('L'.$row);
			$excel->getActiveSheet()
				->getStyle('L'.$row)->applyFromArray($styleHeader);


		}

		if(isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']=='2')){
			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
			}else{
				$sqlClient = ' AND cl.id_cli = 857';
			}

		}else if(isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic']=='1')){
			if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
				$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
			}else{
				$sqlClient = ' AND cl.id_cli = 869';
			}

		} 

		//----------- Récuperation des Licences ------------
			$col = 'A';
			$col2 = '';
			$row++;

			$entree['id_mod_lic'] = $_GET['id_mod_lic'];
			$compteur = 0;
			$bg = '';
			$style = '';

			$sql = '';
			$sql2 = '';
			$sql3 = '';

			if( ($_GET['id_cli'] != null) && ($_GET['id_cli'] != '')){
				$sql = ' AND l.id_cli = '.$_GET['id_cli'];
			}

			if( ($_GET['id_cli'] != null) && ($_GET['id_cli'] != '')){
				$sql = ' AND l.id_cli = '.$_GET['id_cli'];
			}

			if($_GET['type'] == 'EXPIRES'){
				$sql3 = ' AND l.date_val IS NOT NULL ';
			}

			$sommeFob = 0;

			if ($_GET['id_mod_lic'] == '1') {
				
				$requete = $connexion-> prepare("SELECT l.num_lic AS num_lic, 
														DATE(CURRENT_DATE()) AS aujourdhui, 
														l.poids AS fob,
														(l.poids) AS cif,
														UPPER(cl.nom_cli) AS nom_cli,
														l.unit_mes AS sig_mon,
														DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val
													FROM licence l, client cl, monnaie mo
													WHERE l.id_mod_lic = ?
														AND l.id_cli = cl.id_cli
														AND l.id_mon = mo.id_mon
													$sql
													$sql2
													$sql3");
			}else{

				$requete = $connexion-> prepare("SELECT l.num_lic AS num_lic, 
														DATE(CURRENT_DATE()) AS aujourdhui, 
														l.fob AS fob,
														(l.fob+l.fret+l.assurance+l.autre_frais) AS cif,
														UPPER(cl.nom_cli) AS nom_cli,
														mo.sig_mon AS sig_mon,
														DATE_FORMAT(l.date_val, '%d/%m/%Y') AS date_val
													FROM licence l, client cl, monnaie mo
													WHERE l.id_mod_lic = ?
														AND l.id_cli = cl.id_cli
														AND l.id_mon = mo.id_mon
													$sql
													$sql2
													$sql3");
			}

			$requete-> execute(array($entree['id_mod_lic']));
			while ($reponse = $requete-> fetch()) {
				$marchandise = $maClasse-> getMarchandiseLicence($reponse['num_lic']);
				$date_exp = $maClasse-> getLastEpirationLicence2($reponse['num_lic']);
				$date_exp2 = $maClasse-> getLastEpirationLicence($reponse['num_lic']);
				$bg = "";
				$sommeFob += $reponse['fob'];

				// $excel-> getActiveSheet()
				// -> setCellValue($col.$row, ));
				
				if ($_GET['type'] == 'EN COURS') {

					if( ($maClasse-> getDifferenceDate($date_exp, $reponse['aujourdhui']) >= 0) && ($maClasse-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $maClasse-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $reponse['cif']);
						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));
							
						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));
						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));
									
						$row++;
						$col2 = $col;
						$col = 'A';
					}


				}else if ($_GET['type'] == 'EXTREME VALIDATION -40 JOURS') {

					if(($maClasse-> getDifferenceDate($date_exp, $reponse['aujourdhui']) <= 40) && ($maClasse-> getDifferenceDate($date_exp, $reponse['aujourdhui']) > 0) && ($reponse['fob'] > $maClasse-> getSommeFobLicence($reponse['num_lic']))){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						cellColor($col.$row, 'FFA500');
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $reponse['cif']);
						}
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));
						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));
							
						$row++;
						$col2 = $col;
						$col = 'A';
					}

				}else if ($_GET['type'] == 'EXPIRES') {

					if(($date_exp < $reponse['aujourdhui']) && ($reponse['fob'] > $maClasse-> getSommeFobLicence($reponse['num_lic'])) && ( $reponse['num_lic'] != $maClasse-> getLicenceApuree($reponse['num_lic'])) ){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						cellColor($col.$row, 'FF0000');
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $reponse['cif']);
						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));

						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));

						$row++;
						$col2 = $col;
						$col = 'A';

					}

				}else if ($_GET['type'] == 'APPUREES TRACKING ATTENTE BANQUE') {

					if(($reponse['fob'] == $maClasse-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['fob'] != $maClasse-> getSommeFobAppureLicence($reponse['num_lic'])) &&  ( $reponse['num_lic'] != $maClasse-> getLicenceApuree($reponse['num_lic'])) && ($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) == false)){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $reponse['cif']);
						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));

						if ($_GET['id_mod_lic'] == '2') {
							$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

							$excel-> getActiveSheet()
								-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));

						}

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));

						$row++;
						$col2 = $col;
						$col = 'A';

					}

				}else if ($_GET['type'] == 'APPUREES PAR BANQUE') {

					if( ($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) != false) && ($reponse['num_lic'] != 'UNDER VALUE') ){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['cif']);

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));

						$row++;
						$col2 = $col;
						$col = 'A';

					}

				}else if ($_GET['type'] == 'CIF LICENCE DIFFERENT CIF DOSSIER(S)') {

					if(($reponse['fob'] == $maClasse-> getSommeFobLicence($reponse['num_lic'])) && ($reponse['cif'] != $maClasse-> getSommeCIFLicence($reponse['num_lic']))){
						$compteur++;
						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $compteur);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['num_lic']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['nom_cli']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['date_val']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $date_exp2);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['sig_mon']);
						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']);

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['cif']);
						cellColor($col.$row, '00FF00');

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getNbreDossierLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeFobLicence($reponse['num_lic']));

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $maClasse->getSommeCIFLicence($reponse['num_lic']));
						cellColor($col.$row, '00FF00');

						$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

						$excel-> getActiveSheet()
							-> setCellValue($col.$row, $reponse['fob']-$maClasse->getSommeFobLicence($reponse['num_lic']));

						$row++;
						$col2 = $col;
						$col = 'A';

					}

				}

			}$requete-> closeCursor();

		$excel-> getActiveSheet()-> getStyle('A4:'.$col2.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);


		$excel->getActiveSheet()
	        ->getColumnDimension('A:'.$col2)
	        ->setAutoSize(true);


		// if (isset($_GET['commodity']) && ($_GET['commodity'] != '')) {
		// 	$sql1 = ' AND d.commodity = "'.$_GET['commodity'].'"';
		// }

		// if ($_GET['id_mod_trans'] == '1') {
		// 	$sqlOrder = ' ORDER BY d.id_dos ASC';
		// }/*else if ($_GET['id_mod_trans'] == '2' && $_GET['id_mod_lic'] == '857') {
		// 	$sqlOrder = ' ORDER BY d.id_dos ASC';
		// }*/else if ($_GET['id_mod_lic'] == '2' && $_GET['id_cli'] == '857') {
		// 	$sqlOrder = ' ORDER BY d.id_dos ASC';
		// }else  {
		// 	$sqlOrder = ' ORDER BY d.ref_dos ASC';
		// }

		// if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
		// 	$sqlIdMarch = ' AND d.id_march = '.$_GET['id_march'];
		// }

  //           if ($_GET['id_mod_trans'] == '1') {
              
		// 		if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
		// 			$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
		// 		}else{
		// 			$sqlClient = '';
		// 		}

  //           }else if ($_GET['id_mod_trans'] == '2') {
              
		// 		if (isset($_GET['id_cli']) && ($_GET['id_cli']!='')) {
		// 			$sqlClient = ' AND cl.id_cli = "'.$_GET['id_cli'].'"';
		// 		}else{
		// 			$sqlClient = '';
		// 		}

  //           }

		// $row = 4;
		// $col = 'D';
		// $compteur = 0;
		// $requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
		// 										UPPER(cl.nom_cli) AS nom_cli,
		// 										d.ref_fact AS ref_fact,
		// 										d.fob AS fob_dos,
		// 										d.fret AS fret,
		// 										d.assurance AS assurance,
		// 										d.autre_frais AS autre_frais,
		// 										d.num_lic AS num_lic,
		// 										d.montant_decl AS montant_decl,
		// 										d.*,
		// 										s.nom_site AS nom_site,
		// 										d.dgda_in AS dgda_in_1,
		// 										d.dgda_out AS dgda_out_1,
		// 										d.custom_deliv AS custom_deliv_1,
		// 										d.arrival_date AS arrival_date_1,
		// 										d.cleared AS cleared,
		// 										DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
		// 										DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
		// 									FROM dossier d, client cl, site s, mode_transport mt
		// 									WHERE d.id_cli =  cl.id_cli
		// 										$sqlClient
		// 										AND d.id_site = s.id_site
		// 										AND d.id_mod_trans = mt.id_mod_trans
		// 										AND mt.id_mod_trans = ?
		// 										AND d.id_mod_lic = ?
		// 										AND d.statut = ?
		// 										$sqlIdMarch
		// 										$sqlStatus
		// 										$sql1
		// 									$sqlOrder");
		// $requete-> execute(array($_GET['id_mod_trans'], $_GET['id_mod_lic'], $reponseClasseurStatus['nom_stat']));
		// while ($reponse = $requete-> fetch()) {
		// 	$compteur++;
		// 	$bg = "";

		// 	if ($reponse['cleared'] == '1') {
		// 		$style = "style='color: blue;'";
		// 		$styleHeader = array(
		// 		    'font'  => array(
		// 		        'color' => array('rgb' => '0000FF')
		// 		    ));

		// 	}else if ($reponse['cleared'] == '2') {
		// 		$style = "style='color: red;'";
		// 		$styleHeader = array(
		// 		    'font'  => array(
		// 		        'color' => array('rgb' => 'FF0000')
		// 		    ));
		// 	}else{
		// 		$style = "";
		// 		$styleHeader = array(
		// 		    'font'  => array(
		// 		        'color' => array('rgb' => '000000')
		// 		    ));
		// 	}

		// 	$date_exp = $maClasse-> getLastEpirationLicence($reponse['num_lic']);

		// 	$excel-> getActiveSheet()
		// 		-> setCellValue('A'.$row, $compteur)
		// 		-> setCellValue('B'.$row, $reponse['ref_dos'])
		// 		-> setCellValue('C'.$row, $reponse['nom_cli']);

		// 	$excel->getActiveSheet()
		// 		->getStyle('A'.$row)->applyFromArray($styleHeader);
		// 	$excel->getActiveSheet()
		// 		->getStyle('B'.$row)->applyFromArray($styleHeader);
		// 	$excel->getActiveSheet()
		// 		->getStyle('C'.$row)->applyFromArray($styleHeader);

		// 	alignement('A'.$row);
		// 	alignement('B'.$row);
		// 	alignement('C'.$row);

		// 	afficherRowTableauExcel($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader);

		// 	$row++;

		// }$requete-> closeCursor();
		// //----------- FIN Récuperation des Licences ------------

		//Dimension des Colonnes
		$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

		// //Dimension des Colonnes
		// $excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		// $excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		// $excel-> getActiveSheet()-> getColumnDimension('C')-> setWidth(20);

		// $col = 'D';
		// $requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
		// 								FROM colonne c, client cl, affectation_colonne_client_modele_licence af
		// 								WHERE c.id_col = af.id_col
		// 									AND af.id_cli = cl.id_cli
		// 								    AND cl.id_cli = ?
		// 								    AND af.id_mod_lic = ?
		// 								    AND af.id_mod_trans = ?
		// 								ORDER BY af.rang ASC");
		// $requete-> execute(array($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans']));
		// while ($reponse = $requete-> fetch()) {

		// 	if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '44') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '42') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '43') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '2') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '12') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else if ($reponse['id_col'] == '16') {
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}else{
		// 		$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
		// 		$col++;

						$excel->getActiveSheet()
					        ->getColumnDimension($col)
					        ->setAutoSize(true);

		// 	}

		// }$requete-> closeCursor();

		//      $excel->getActiveSheet()->getStyle('B:'.$col)->getAlignment()->applyFromArray(
		//              array(
		//                  'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		//                  'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		//                  'rotation'   => 0,
		//                  'wrap'       => true
		//              )
		//      );


		// //Bordure des Cellules
		// $excel-> getActiveSheet()-> getStyle('A3:'.$col.($row-1))-> applyFromArray(
		// 	array(
		// 		'borders' => array(
		// 			'allborders' => array(
		// 				'style' => PHPExcel_Style_Border::BORDER_THIN
		// 			)
		// 		)
		// 	)
		// );


	

	$excel->getActiveSheet()->setTitle($_GET['type']);


	// Set active sheet index to the first sheet, so Excel opens this as the first sheet
	$excel->setActiveSheetIndex($indiceSheet);


	$indiceSheet++;

	$excel->createSheet();


$titre = 'LICENCES_'.$maClasse-> getElementModeleLicence($_GET['id_mod_lic'])['sigle_mod_lic'].'_'.$_GET['type'].'_'.$maClasse-> getNomClient($_GET['id_cli']).'_'.date('d_m_Y_h_i_s');
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