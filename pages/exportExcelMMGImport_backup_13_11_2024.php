
<?php
require('../PHPExcel-1.8/Classes/PHPExcel.php');
require('../classes/maClasse.class.php');

$maClasse = new MaClasse();

//Create PHPExcel object
$excel = new PHPExcel();

		// Rename worksheet
		$transit = '';
		if ($_GET['id_mod_trac'] == '1') {
			$transit = 'Export';
		}
		else if ($_GET['id_mod_trac'] == '2') {
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


include('../classes/connexion.php');
include('afficherRowTableauExcel.php');
//--- Recuperation des mode de transport -------
$indiceSheet = 0;
$requeteModeTransport = $connexion-> prepare('SELECT DISTINCT(id_mod_trans) AS id_mod_trans, 
													UPPER(nom_mod_trans) AS nom_mod_trans 
												FROM mode_transport
												WHERE id_mod_trans IN (
													SELECT DISTINCT(id_mod_trans) 
														FROM dossier
														WHERE id_cli = ?
												)');
$requeteModeTransport-> execute(array($_GET['id_cli']));
while ($reponseModeTransport = $requeteModeTransport-> fetch()) {

	//Pour EXPORT créer des tableurs par licence et modes de transport
	
		
		//--- Recuperation d'années -------
		for ($annee=date('Y'); $annee >= 2022; $annee--) { 
			$entree['annee']='%'.substr($annee, -2).'-%';

		$id_march = $_GET['id_march'];


			$requeteLicence = $connexion-> prepare("SELECT DISTINCT(l.num_lic) AS num_lic
														FROM licence l, dossier d
														WHERE d.id_cli = ?
														AND d.id_mod_trans = ?
														AND d.id_march = $id_march
														AND l.num_lic = d.num_lic 
														AND l.id_mod_lic = ?
														AND d.ref_dos LIKE (?)
														ORDER BY l.date_creat_lic DESC");

		$requeteLicence-> execute(array($_GET['id_cli'], $reponseModeTransport['id_mod_trans'], 
									$_GET['id_mod_trac'], $entree['annee']));
		while ($reponseLicence = $requeteLicence-> fetch()) {
			

			//Selecting active sheet
			$excel-> setActiveSheetIndex($indiceSheet);


			//Get data
			//$maClasse-> afficherEnTeteTableauExcel2($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $excel);

			$entree['id_mod_lic'] = $_GET['id_mod_trac'];
			$entree['id_cli'] = $_GET['id_cli'];
			$entree['id_mod_trans'] = $reponseModeTransport['id_mod_trans'];

			$id_mod_lic = $_GET['id_mod_trac'];
			$id_cli = $_GET['id_cli'];
			$id_mod_trans = $reponseModeTransport['id_mod_trans'];

			$sql1 = "";
			$sqlOrder = "";
			$sqlIdMarch = "";
			$sqlStatus = "";
			$sqlLicence = "";
			$sqlCleared = "";
			$compteur = 0;

			$row = 3;
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
			$excel->getActiveSheet()->freezePane('F4');

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
				-> setCellValue('A1', 'DAILY CLEARING ACTIVITY TRACKING SHEET');
			$excel->getActiveSheet()
				->getStyle('A1')->applyFromArray($styleHeader2);

			//Fusionner les cellules
			$excel-> getActiveSheet()
				-> mergeCells('A1:I1');

			//Recuperation des en-tête
			$excel-> getActiveSheet()
				-> setCellValue('A'.$row, '#')
				-> setCellValue('B'.$row, 'MCA REF');

			cellColor('A'.$row, '000000');
			cellColor('B'.$row, '000000');
			alignement('A'.$row);
			alignement('B'.$row);
			$excel->getActiveSheet()
				->getStyle('A'.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
				->getStyle('B'.$row)->applyFromArray($styleHeader);

			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $reponse['titre_col']);
				cellColor($col.$row, '000000');
				alignement($col.$row);
				$excel->getActiveSheet()
					->getStyle($col.$row)->applyFromArray($styleHeader);
				$col++;
			}$requete-> closeCursor();

			
			//----------- Récuperation des dossiers ------------

			if (isset($_GET['commodity']) && ($_GET['commodity'] != '')) {
				$sql1 = ' AND d.commodity = "'.$_GET['commodity'].'"';
			}

			if ($_GET['id_mod_trac'] == '1') {
				$sqlOrder = ' ORDER BY d.id_dos ASC';
			}else if ($_GET['id_mod_trac'] == '2' && $_GET['id_mod_trac'] == '857') {
				$sqlOrder = ' ORDER BY d.id_dos ASC';
			}else if ($_GET['id_mod_trac'] == '2' && $_GET['id_mod_trac'] != '857') {
				$sqlOrder = ' ORDER BY d.ref_dos ASC';
			}

			if (isset($_GET['id_march']) && ($_GET['id_march'] != '')) {
				$sqlIdMarch = ' AND d.id_march = '.$_GET['id_march'];
			}

			if (isset($_GET['statut']) && ($_GET['statut'] != '')) {
				$sqlStatus = ' AND d.statut = "'.$_GET['statut'].'"';
			}

			$row = 4;
			$col = 'C';
			$requete = $connexion-> prepare("SELECT d.ref_dos AS ref_dos,
													UPPER(cl.nom_cli) AS nom_cli,
													d.ref_fact AS ref_fact,
													d.fob AS fob_dos,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													d.num_lic AS num_lic,
													d.montant_decl AS montant_decl,
													d.*,
													s.nom_site AS nom_site,
													d.dgda_in AS dgda_in_1,
													d.dgda_out AS dgda_out_1,
													d.custom_deliv AS custom_deliv_1,
													d.arrival_date AS arrival_date_1,
													d.cleared AS cleared,
													DATEDIFF(d.dgda_out, d.dgda_in) AS dgda_delay,
													DATEDIFF(d.custom_deliv, d.arrival_date) AS arrival_deliver_delay
												FROM dossier d, client cl, site s, mode_transport mt
												WHERE d.id_cli =  cl.id_cli
													AND cl.id_cli = ?
													AND d.id_site = s.id_site
													AND d.id_mod_trans = mt.id_mod_trans
													AND mt.id_mod_trans = ?
													AND d.id_mod_lic = ?
													AND d.num_lic = ?
													$sqlIdMarch
													$sqlStatus
													$sql1
												$sqlOrder");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_trans'], $entree['id_mod_lic'], $reponseLicence['num_lic']));
			while ($reponse = $requete-> fetch()) {
				$compteur++;
				$bg = "";

				if ($reponse['cleared'] == '1') {
					$style = "style='color: blue;'";
					$styleHeader = array(
					    'font'  => array(
					        'color' => array('rgb' => '0000FF')
					    ));

				}else if ($reponse['cleared'] == '2') {
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

				$date_exp = $maClasse-> getLastEpirationLicence($reponse['num_lic']);

				$excel-> getActiveSheet()
					-> setCellValue('A'.$row, $compteur)
					-> setCellValue('B'.$row, $reponse['ref_dos']);

				$excel->getActiveSheet()
					->getStyle('A'.$row)->applyFromArray($styleHeader);
				$excel->getActiveSheet()
					->getStyle('B'.$row)->applyFromArray($styleHeader);

				alignement('A'.$row);
				alignement('B'.$row);

				afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $reponse['id_dos'], $compteur, $col, $excel, $row, $styleHeader);

				$row++;

			}$requete-> closeCursor();
			//----------- FIN Récuperation des dossiers ------------


			//Dimension des Colonnes
			$excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
			$excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);

			$col = 'C';
			$requete = $connexion-> prepare("SELECT c.titre_col AS titre_col, c.id_col AS id_col
											FROM colonne c, client cl, affectation_colonne_client_modele_licence af
											WHERE c.id_col = af.id_col
												AND af.id_cli = cl.id_cli
											    AND cl.id_cli = ?
											    AND af.id_mod_lic = ?
											    AND af.id_mod_trans = ?
											ORDER BY af.rang ASC");
			$requete-> execute(array($entree['id_cli'], $entree['id_mod_lic'], $entree['id_mod_trans']));
			while ($reponse = $requete-> fetch()) {

				if ($reponse['id_col'] == '11' || $reponse['id_col'] == '13' || $reponse['id_col'] == '17') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
					$col++;
				}else if ($reponse['id_col'] == '44') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(40);
					$col++;
				}else if ($reponse['id_col'] == '42') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
					$col++;
				}else if ($reponse['id_col'] == '43') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(55);
					$col++;
				}else if ($reponse['id_col'] == '2') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(25);
					$col++;
				}else if ($reponse['id_col'] == '16') {
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(30);
					$col++;
				}else{
					$excel-> getActiveSheet()-> getColumnDimension($col)-> setWidth(15);
					$col++;
				}

			}$requete-> closeCursor();

			//Bordure des Cellules
			$excel-> getActiveSheet()-> getStyle('A3:'.$col.($row-1))-> applyFromArray(
				array(
					'borders' => array(
						'allborders' => array(
							'style' => PHPExcel_Style_Border::BORDER_THIN
						)
					)
				)
			);

			// Rename worksheet
			$transit = '';
			if ($_GET['id_mod_trac'] == '1') {
				$transit = 'Export';
			}
			else if ($_GET['id_mod_trac'] == '2') {
				$transit = 'Import';
			}

			$excel->getActiveSheet()->setTitle($reponseLicence['num_lic'].' '.$reponseModeTransport['nom_mod_trans'].' '.$annee);


			// Set active sheet index to the first sheet, so Excel opens this as the first sheet
			$excel->setActiveSheetIndex($indiceSheet);


			$indiceSheet++;

			$excel->createSheet();



		}$requeteLicence-> closeCursor();
	}
	//--- FIN Recuperation années -------
	

	
	

//--- FIN Recuperation années -------
	
}$requeteModeTransport-> closeCursor();

// include('excelDiluent.php');

// $indiceSheet++;

// include('excelDivers.php');

//--- FIN Recuperation des mode de transport -------

$titre = $maClasse-> getClient($_GET['id_cli'])['nom_cli'].$marchandise.'_'.$transit.'_'.date('d_m_Y_h_i_s');
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