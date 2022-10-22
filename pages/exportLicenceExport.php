
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
	if (isset($_GET['annee']) && ($_GET['annee']!='')) {
		$anneeDebut = $_GET['annee'];
		$anneeFin = $_GET['annee'];
	}else{
		$anneeDebut = date('Y');
		$anneeFin = 2020;
	}
	for ($annee=$anneeDebut; $annee >= $anneeFin; $annee--) { 
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
		$excel->getActiveSheet()->freezePane('C5');

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

		$col = 'A';

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, '#');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);
		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Num.LICENSE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;


		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Bank');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'License Weight');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'VALIDATION');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'EXTREM_VALID.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'MCA REF');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'Lot Num.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'File Weight');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'BALANCE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'REMARK');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DECL.REF.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'DECL.DATE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'LIQ.REF.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'LIQ.DATE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'QUITT.REF.');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'QUITT.DATE');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'FILE_REMARKS');
		cellColor($col.$row, '000000');
		alignement($col.$row);
		
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$col++;

		$excel-> getActiveSheet()
			-> setCellValue($col.$row, 'LICENSE_REMARKS');

		$excel->getActiveSheet()
	        ->getColumnDimension($col)
	        ->setAutoSize(true);

		$excel-> getActiveSheet()-> getStyle('A'.$row.':AG'.$row)-> applyFromArray(
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

		$tmp_lic='';
		$tmp_fob_lic = '';
		$tmp_col = '';

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
												CURRENT_DATE() AS ajourdhui,
												(d.fob+d.fret+d.assurance) AS cif_dos,
												d.ref_dos AS ref_dos,
												d.ref_decl AS ref_decl,
												d.date_decl AS date_decl,
												d.ref_liq AS ref_liq,
												d.date_liq AS date_liq,
												d.ref_quit AS ref_quit,
												d.date_quit AS date_quit,
												d.poids AS poids,
												d.fret AS fret_dos,
												d.assurance AS assurance_dos,
												d.autre_frais AS autre_frais_dos,
												d.id_dos AS id_dos,
												d.po_ref AS po_ref,
												d.cod AS cod,
												d.num_lot AS num_lot,
												l.cod AS cod_lic,
												l.poids AS poids_lic,
												b.nom_banq AS nom_banq,
												mon.*
											FROM licence l
											LEFT JOIN dossier d ON l.num_lic = d.num_lic
											LEFT JOIN monnaie mon ON l.id_mon = mon.id_mon
											LEFT JOIN banque b ON l.id_banq = b.id_banq
											WHERE l.id_cli = ?
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
			$col = 'A';

			$date_exp = $maClasse-> getLastEpirationLicence2($reponse['num_lic']);

			//Licence Apurée
			if (($reponse['apurement'] == '1') || ( ($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) == $maClasse-> getNombreDossierLicence($reponse['num_lic'])) && ($maClasse-> getNombreDossierLicence($reponse['num_lic']) > 1) ) || (($reponse['fob']-$maClasse-> getSommePoidsAppureLicence($reponse['num_lic']))<1) ) {

				$couleur = '00FF7F';
				$apurement = 'Closed';

			}//Partiellement Apurée
			else if(($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) >= 1) && ($date_exp >= $reponse['ajourdhui']) ){
				
				$couleur = 'F0E68C';
				$apurement = 'Partial';

			}//Partiellement Apurée et Expirée
			else if(($maClasse-> verifierApurementDossierLicence($reponse['num_lic']) >= 1) && ($date_exp < $reponse['ajourdhui']) ){
				
				$couleur = 'DA70D6';
				$apurement = 'Partial & Expired';

			}//Licence Expirée
			else if($date_exp <= $reponse['ajourdhui']){

				$couleur = 'CD5C5C';
				$apurement = 'Expired';

			}//Non-apuréé
			else{

				$couleur = 'FFFFFF';
				$apurement = 'Not Closed';

			}

			if ($maClasse-> verifierApurementDossier($reponse['id_dos'])==true) {
				$statut_apurement = 'Transmitted';
			}else{
				$statut_apurement = 'To be transmitted';
			}

			// $styleHeader = array(
			//         'fill' => array(
			//             'type' => PHPExcel_Style_Fill::FILL_SOLID,
			//             'color' => array('rgb' => $couleur)
			//         ));

			// $excel->getActiveSheet()
			// 	->getStyle('A'.$row.':AF'.$row)->applyFromArray($styleHeader);

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $compteur);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['num_lic']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['nom_banq']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['poids_lic']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
		    $tmp_col = $col;
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_val']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $date_exp);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_dos']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['num_lot']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['poids']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;
			if ($tmp_lic==$reponse['num_lic']) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '='.$col.($row-1).'-'.$tmp_col.$row);
			}else if ($tmp_lic!=$reponse['num_lic']) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, '=H'.$row.'-'.$tmp_col.$row);
					$tmp_lic=$reponse['num_lic'];
			}
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
		    $tmp_col = $col;
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, '=IF(ROUND('.$tmp_col.$row.',0)<0, "License Amount Exceeded", "OK")');
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_decl']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_decl']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			//Format date
			if (isset($reponse['date_decl']) && ($reponse['date_decl']!='')) {
				
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_decl'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_liq']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_liq']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			//Format date
			if (isset($reponse['date_liq']) && ($reponse['date_liq']!='')) {
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_liq'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['ref_quit']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $reponse['date_quit']);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			//Format date
			if (isset($reponse['date_quit']) && ($reponse['date_quit']!='')) {
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date($reponse['date_quit'])));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $statut_apurement);
			cellColor($col.$row, $couleur);
			alignement($col.$row);
			// $excel->getActiveSheet()
			// 	->getStyle($col.$row)->applyFromArray($styleHeader);
			$excel->getActiveSheet()
		        ->getColumnDimension($col)
		        ->setAutoSize(true);
			$col++;

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $apurement);


			// alignement('A'.$row);
			// alignement('B'.$row);

			// $incrementColonne = 3;
			// $lettre = 'C';

			// while ($incrementColonne <= 32) {

			// 	alignement($lettre.$row);

			// 	$lettre++;
			// 	$incrementColonne++;
			// }

			//Affichage des dossiers
			//afficherDossierLicenceExcel($reponse['num_lic'], $row, $excel, $compteur, $couleur);

			// $excel-> getActiveSheet()
			// 	-> setCellValue('A'.$row, $compteur);
			// alignement('A'.$row);
			

			$row++;
			$compteur++;

		}$requete-> closeCursor();
		//----------- FIN Récuperation des LICENCES ------------

		//Dimension des Colonnes
		// $excel-> getActiveSheet()-> getColumnDimension('A')-> setWidth(5);
		// $excel-> getActiveSheet()-> getColumnDimension('B')-> setWidth(15);
		//$excel-> getActiveSheet()-> getColumnDimension('')-> setWidth(25);
		$incrementColonne = 3;
		$lettre = 'C';
		while ($incrementColonne <= 33) {

			// if ($lettre == 'C') {
			// 	$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(35);
			// }else{
			// 	$excel-> getActiveSheet()-> getColumnDimension("$lettre")-> setWidth(25);
			// }

			// $excel->getActiveSheet()
		 //        ->getColumnDimension($lettre)
		 //        ->setAutoSize(true);

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

	    //alignement($lettre.$row);
	    alignement('A5:'.$lettre.($row-1));
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
$excel->setActiveSheetIndex(0);

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