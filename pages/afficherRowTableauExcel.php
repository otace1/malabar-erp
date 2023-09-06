<?php
 function convert_date($date_string){
  //$date = DateTime::createFromFormat('Y-m-d', $date_string); //2016-10-05 16:00
  $date = new DateTime($date_string); 
  return $date;
};

function afficherRowTableauExcel($id_mod_lic, $id_cli, $id_mod_trans, $id_dos, $compteur, $col, $excel, $row, $styleHeader, $statut=NULL, $klsa_status=NULL, $amicongo_status=NULL, $kzi_status=NULL, $montant_liq, $statut_invoice, $ref_fact, $date_fact, $montant_fact){
	include('../classes/connexion.php');

	$maClasse = new MaClasse();
	$entree['id_mod_lic'] = $id_mod_lic;
	$entree['id_cli'] = $id_cli;
	$entree['id_mod_trans'] = $id_mod_trans;
	$bg = '';
	$col_debut = '';
	$col_fin = '';

	if ($_GET['id_cli'] == 869 && $_GET['id_march'] == 11 && isset($_GET['id_cli']) && isset($_GET['id_march'])) {
		$id_cli = 883;
	}

            if ($id_mod_lic == '1') {
              
				if (isset($id_cli) && ($id_cli!='')) {
					$sqlClient = ' AND cl.id_cli = "'.$id_cli.'"';
				}else{
					$sqlClient = ' AND cl.id_cli = 869';
				}

            }else if ($id_mod_lic == '2') {
              
				if (isset($id_cli) && ($id_cli!='')) {
					$sqlClient = ' AND cl.id_cli = "'.$id_cli.'"';
				}else{
					$sqlClient = ' AND cl.id_cli = 857';
				}

            }

	$requete = $connexion-> prepare("SELECT c.champ_col AS champ_col, 
											c.type_col AS type_col, 
											c.calcul AS calcul,
											c.id_col AS id_col 
									FROM colonne c, client cl, affectation_colonne_client_modele_licence af
									WHERE c.id_col = af.id_col
										AND af.id_cli = cl.id_cli
									    $sqlClient
									    AND af.id_mod_trans = ?
									    AND af.id_mod_lic = ?
									ORDER BY af.rang ASC");
	$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
	while ($reponse = $requete-> fetch()) {
		//getDataRow($champ_col, $id_dos)
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		if ($reponse['id_col'] == '65') {
			$col_debut = $col;
		}

		if ($reponse['id_col'] == '77') {
			$col_fin = $col;
		}

		if ($reponse['id_col'] == '40' && $id_mod_lic == '2') {
			$getDataRowCalculNetDays = $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
			if ( ($getDataRowCalculNetDays >= 0) && ($getDataRowCalculNetDays <= 3) ) {
				$bg = "background-color: green; color: white;";
				cellColor($col.$row, '00FF00');
			}else if ( ($getDataRowCalculNetDays > 3) && ($getDataRowCalculNetDays <= 5) ) {
				$bg = "background-color: orange; color: white;";
				cellColor($col.$row, 'FFA500');
			}else if ( ($getDataRowCalculNetDays > 5) ) {
				$bg = "background-color: red; color: white;";
				cellColor($col.$row, 'FF0000');
			}
			$styleCalcul = array(
			    'font'  => array(
			        'bold' => true,
			        'color' => array('rgb' => '000000'),
			        'name' => 'Verdana'
			    ));
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleCalcul);

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));

			$excel->getActiveSheet()
				->getStyle($col.$row)->
				getAlignment()->
				applyFromArray(
		         array(
		             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		             'rotation'   => 0,
		             'wrap'       => true
		         )
 				);

			$bg = '';
		}
		else if ($reponse['id_col'] == '40' && $id_mod_lic == '1') {

			if ($id_mod_trans == '4') {
				# code...
			}else{

				

					//$getDataRowCalculNetDays = $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) >= 0) && ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) <= 5) ) {
						$bg = "background-color: green; color: white;";
						cellColor($col.$row, '00FF00');
					}else if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) > 5) && ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) <= 7) ) {
						$bg = "background-color: orange; color: white;";
						cellColor($col.$row, 'FFA500');
					}else if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) > 7) ) {
					$bg = "background-color: red; color: white;";
						cellColor($col.$row, 'FF0000');
					}

			$styleCalcul = array(
			    'font'  => array(
			        'bold' => true,
			        'color' => array('rgb' => '000000'),
			        'name' => 'Verdana'
			    ));
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleCalcul);

			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));

			$excel->getActiveSheet()
				->getStyle($col.$row)->
				getAlignment()->
				applyFromArray(
		         array(
		             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		             'rotation'   => 0,
		             'wrap'       => true
		         )
					);

			if (($maClasse-> getDataRow('dispatch_date', $id_dos)!='')) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)));
			}else {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate(date('Y-m-d'), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), date('Y-m-d')));
			}
				
			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, '=IF('.$col_fin.$row.'<>"", NETWORKDAYS('.$col_fin.$row.','.$col_debut.$row.'), NETWORKDAYS(NOW(),'.$col_debut.$row.'))');

			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, '=NETWORKDAYS(NOW(),'.$maClasse-> getDataRow('load_date', $id_dos).')');
				
					$bg = '';

			}

		}
		else if ($reponse['id_col'] == '38') {
			

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));
		
			$getDataRow = $maClasse-> getDataRow($reponse['champ_col'], $id_dos);
			if ( ($getDataRow == '0') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'TRANSIT');

			}else if ( ($getDataRow == '1') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'CLEARED');

			}else if ( ($getDataRow == '2') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'CANCELLED');

			}

		}else if ($reponse['id_col'] == '17') {
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));

		}else if ($reponse['id_col'] == '18') {
			//Date Expiration Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDateExpirationLicence($maClasse-> getDossier($id_dos)['num_lic']));

		}else if ($reponse['id_col'] == '50') {
			// Poids Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getLicence2($maClasse-> getDossier($id_dos)['num_lic'])['poids']);

		}else if ($reponse['id_col'] == '54') {
			// Balance Tons Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getBalanceLicenceDossier($id_dos));

		}else if ($reponse['id_col'] == '71') {
			// CEEC Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('ceec_out', $id_dos), $maClasse-> getDataRow('ceec_in', $id_dos)));

		}else if ($reponse['id_col'] == '74') {
			// CEEC Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('min_div_out', $id_dos), $maClasse-> getDataRow('min_div_in', $id_dos)));

		}else if ($reponse['id_col'] == '36') {
			// DGDA Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dgda_out', $id_dos), $maClasse-> getDataRow('dgda_in', $id_dos)));

		}else if ($reponse['id_col'] == '88') {
			// DGDA Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('gov_out', $id_dos), $maClasse-> getDataRow('gov_in', $id_dos)));

		}else if ($reponse['id_col'] == '80') {
			// DA To Exit
			if ($maClasse-> getDossier($id_dos)['id_mod_trans'] == '4') {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('docs_sncc', $id_dos), $maClasse-> getDataRow('demande_attestation', $id_dos)));

			}else{
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('demande_attestation', $id_dos)));

			}
		
		}
		else if ($reponse['calcul'] == '1') {
			
			if (isset($maClasse-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']])) {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']]);

			}

		}else if ($reponse['id_col'] == '44') {
			if (!isset($maClasse-> getLicence($maClasse-> getDossier($id_dos)['num_lic'])['fournisseur'])) {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow('supplier', $id_dos));

			}else{

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getLicence($maClasse-> getDossier($id_dos)['num_lic'])['fournisseur']);

			}
		}else if ($reponse['id_col'] == '42') {
			// Status
			if ($id_mod_lic=='2' && $id_mod_trans=='1') {
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $statut);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $klsa_status);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $amicongo_status);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $kzi_status);
				alignement($col.$row);
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $statut);
			}
		
		}else if ($reponse['id_col'] == '44'){

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
		
		}else if ($reponse['id_col'] == '2'){

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, trim($maClasse-> getDataRow($reponse['champ_col'], $id_dos)));
		
		}
		else if ($maClasse-> verifierDimancheDate($maClasse-> getDataRow($reponse['champ_col'], $id_dos))!=false ) {

			$textColor = 'color: black; background-color: #FF4500;';
			$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			cellColor($col.$row, 'AF002A');
			if ($reponse['type_col']=='date' && ($maClasse-> getDataRow($reponse['champ_col'], $id_dos)!='') ) {
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date(  $maClasse-> getDataRow($reponse['champ_col'], $id_dos) )));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			}


		}else{
			if ($reponse['type_col']=='date' && ($maClasse-> getDataRow($reponse['champ_col'], $id_dos)!='') ) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date(  $maClasse-> getDataRow($reponse['champ_col'], $id_dos) )));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			}
		}

		$excel-> getActiveSheet()-> getStyle($col.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		$col++;


	}$requete-> closeCursor();
	
		// Liq. Amount
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $montant_liq);
		alignement($col.$row);
		$col++;
		// Inv Status
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $statut_invoice);
		alignement($col.$row);
		$col++;
		// Inv. Ref.
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $ref_fact);
		alignement($col.$row);
		$col++;
		// Inv. Amount
		$excel-> getActiveSheet()
			-> setCellValue($col.$row, $montant_fact);
		alignement($col.$row);
		$col++;

}

function afficherRowTableauExcelKBP($id_mod_lic, $id_mod_trans, $id_dos, $compteur, $col, $excel, $row, $styleHeader, $statut=NULL, $klsa_status=NULL, $amicongo_status=NULL, $kzi_status=NULL){
	include('../classes/connexion.php');

	$maClasse = new MaClasse();
	$entree['id_mod_lic'] = $id_mod_lic;
	//$entree['id_cli'] = $id_cli;
	$entree['id_mod_trans'] = $id_mod_trans;
	$bg = '';
	$col_debut = '';
	$col_fin = '';

    $sqlClient = ' AND cl.id_cli = 857';

	$requete = $connexion-> prepare("SELECT c.champ_col AS champ_col, 
											c.type_col AS type_col, 
											c.calcul AS calcul,
											c.id_col AS id_col 
									FROM colonne c, client cl, affectation_colonne_client_modele_licence af
									WHERE c.id_col = af.id_col
										AND af.id_cli = cl.id_cli
									    $sqlClient
									    AND af.id_mod_trans = ?
									    AND af.id_mod_lic = ?
									ORDER BY af.rang ASC");
	$requete-> execute(array($entree['id_mod_trans'], $entree['id_mod_lic']));
	while ($reponse = $requete-> fetch()) {
		//getDataRow($champ_col, $id_dos)
		$excel->getActiveSheet()
			->getStyle($col.$row)->applyFromArray($styleHeader);

		if ($reponse['id_col'] == '65') {
			$col_debut = $col;
		}

		if ($reponse['id_col'] == '77') {
			$col_fin = $col;
		}

		if ($reponse['id_col'] == '40' && $id_mod_lic == '2') {
			$getDataRowCalculNetDays = $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
			if ( ($getDataRowCalculNetDays >= 0) && ($getDataRowCalculNetDays <= 3) ) {
				$bg = "background-color: green; color: white;";
				cellColor($col.$row, '00FF00');
			}else if ( ($getDataRowCalculNetDays > 3) && ($getDataRowCalculNetDays <= 5) ) {
				$bg = "background-color: orange; color: white;";
				cellColor($col.$row, 'FFA500');
			}else if ( ($getDataRowCalculNetDays > 5) ) {
				$bg = "background-color: red; color: white;";
				cellColor($col.$row, 'FF0000');
			}
			$styleCalcul = array(
			    'font'  => array(
			        'bold' => true,
			        'color' => array('rgb' => '000000'),
			        'name' => 'Verdana'
			    ));
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleCalcul);

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));

			$excel->getActiveSheet()
				->getStyle($col.$row)->
				getAlignment()->
				applyFromArray(
		         array(
		             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		             'rotation'   => 0,
		             'wrap'       => true
		         )
 				);

			$bg = '';
		}
		else if ($reponse['id_col'] == '40' && $id_mod_lic == '1') {

			if ($id_mod_trans == '4') {
				# code...
			}else{

				

					//$getDataRowCalculNetDays = $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos);
					if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) >= 0) && ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) <= 5) ) {
						$bg = "background-color: green; color: white;";
						cellColor($col.$row, '00FF00');
					}else if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) > 5) && ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) <= 7) ) {
						$bg = "background-color: orange; color: white;";
						cellColor($col.$row, 'FFA500');
					}else if ( ($maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)) > 7) ) {
					$bg = "background-color: red; color: white;";
						cellColor($col.$row, 'FF0000');
					}

			$styleCalcul = array(
			    'font'  => array(
			        'bold' => true,
			        'color' => array('rgb' => '000000'),
			        'name' => 'Verdana'
			    ));
			$excel->getActiveSheet()
				->getStyle($col.$row)->applyFromArray($styleCalcul);

			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));

			$excel->getActiveSheet()
				->getStyle($col.$row)->
				getAlignment()->
				applyFromArray(
		         array(
		             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
		             'vertical'   => PHPExcel_Style_Alignment::VERTICAL_CENTER,
		             'rotation'   => 0,
		             'wrap'       => true
		         )
					);

			if (($maClasse-> getDataRow('dispatch_date', $id_dos)!='')) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), $maClasse-> getDataRow('dispatch_date', $id_dos)));
			}else {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate(date('Y-m-d'), $maClasse-> getDataRow('load_date', $id_dos)) - $maClasse-> getWeekendsAndHolidays($maClasse-> getDataRow('load_date', $id_dos), date('Y-m-d')));
			}
				
			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, '=IF('.$col_fin.$row.'<>"", NETWORKDAYS('.$col_fin.$row.','.$col_debut.$row.'), NETWORKDAYS(NOW(),'.$col_debut.$row.'))');

			// $excel-> getActiveSheet()
			// 	-> setCellValue($col.$row, '=NETWORKDAYS(NOW(),'.$maClasse-> getDataRow('load_date', $id_dos).')');
				
					$bg = '';

			}

		}
		else if ($reponse['id_col'] == '38') {
			

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRowCalculNetDays($reponse['champ_col'], $id_dos));
		
			$getDataRow = $maClasse-> getDataRow($reponse['champ_col'], $id_dos);
			if ( ($getDataRow == '0') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'TRANSIT');

			}else if ( ($getDataRow == '1') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'CLEARED');

			}else if ( ($getDataRow == '2') ) {

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, 'CANCELLED');

			}

		}else if ($reponse['id_col'] == '17') {
			
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));

		}else if ($reponse['id_col'] == '18') {
			//Date Expiration Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDateExpirationLicence($maClasse-> getDossier($id_dos)['num_lic']));

		}else if ($reponse['id_col'] == '50') {
			// Poids Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getLicence2($maClasse-> getDossier($id_dos)['num_lic'])['poids']);

		}else if ($reponse['id_col'] == '54') {
			// Balance Tons Licence
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getBalanceLicenceDossier($id_dos));

		}else if ($reponse['id_col'] == '71') {
			// CEEC Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('ceec_out', $id_dos), $maClasse-> getDataRow('ceec_in', $id_dos)));

		}else if ($reponse['id_col'] == '74') {
			// CEEC Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('min_div_out', $id_dos), $maClasse-> getDataRow('min_div_in', $id_dos)));

		}else if ($reponse['id_col'] == '36') {
			// DGDA Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dgda_out', $id_dos), $maClasse-> getDataRow('dgda_in', $id_dos)));

		}else if ($reponse['id_col'] == '88') {
			// DGDA Delai
			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('gov_out', $id_dos), $maClasse-> getDataRow('gov_in', $id_dos)));

		}else if ($reponse['id_col'] == '80') {
			// DA To Exit
			if ($maClasse-> getDossier($id_dos)['id_mod_trans'] == '4') {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('docs_sncc', $id_dos), $maClasse-> getDataRow('demande_attestation', $id_dos)));

			}else{
				
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDifferenceDate($maClasse-> getDataRow('dispatch_date', $id_dos), $maClasse-> getDataRow('demande_attestation', $id_dos)));

			}
		
		}
		else if ($reponse['calcul'] == '1') {
			
			if (isset($maClasse-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']])) {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRowCalcul($reponse['champ_col'], $id_dos)[$reponse['champ_col']]);

			}

		}else if ($reponse['id_col'] == '44') {
			if (!isset($maClasse-> getLicence($maClasse-> getDossier($id_dos)['num_lic'])['fournisseur'])) {

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow('supplier', $id_dos));

			}else{

				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getLicence($maClasse-> getDossier($id_dos)['num_lic'])['fournisseur']);

			}
		}else if ($reponse['id_col'] == '42') {
			// Status
			if ($id_mod_lic=='2' && $id_mod_trans=='1') {
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $statut);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $klsa_status);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $amicongo_status);
				$col++;
				alignement($col.$row);
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $kzi_status);
				alignement($col.$row);
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $statut);
			}
		
		}else if ($reponse['id_col'] == '44'){

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
		
		}else if ($reponse['id_col'] == '2'){

			$excel-> getActiveSheet()
				-> setCellValue($col.$row, trim($maClasse-> getDataRow($reponse['champ_col'], $id_dos)));
		
		}
		else if ($maClasse-> verifierDimancheDate($maClasse-> getDataRow($reponse['champ_col'], $id_dos))!=false ) {

			$textColor = 'color: black; background-color: #FF4500;';
			$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			cellColor($col.$row, 'AF002A');
			if ($reponse['type_col']=='date' && ($maClasse-> getDataRow($reponse['champ_col'], $id_dos)!='') ) {
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date(  $maClasse-> getDataRow($reponse['champ_col'], $id_dos) )));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			}


		}else{
			if ($reponse['type_col']=='date' && ($maClasse-> getDataRow($reponse['champ_col'], $id_dos)!='') ) {
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
				$excel-> getActiveSheet()
					->setCellValue($col.$row, PHPExcel_Shared_Date::PHPToExcel(convert_date(  $maClasse-> getDataRow($reponse['champ_col'], $id_dos) )));
				$excel->getActiveSheet()->getStyle($col.$row)->getNumberFormat()
	             ->setFormatCode('dd/mm/yyyy');
			}else{
				$excel-> getActiveSheet()
					-> setCellValue($col.$row, $maClasse-> getDataRow($reponse['champ_col'], $id_dos));
			}

		}

		$excel-> getActiveSheet()-> getStyle($col.$row)-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);

		alignement($col.$row);
		$col++;

	}$requete-> closeCursor();
}