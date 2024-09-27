<?php

function afficherDossierLicenceTransmisionApurementExcel($num_lic, $id_trans_ap, $row, $excel, $compteur, $couleur){
	include('../classes/connexion.php');

	$maClasse = new MaClasse();
	$entree['num_lic'] = $num_lic;
	$entree['id_trans_ap'] = $id_trans_ap;
	$bg = '';
	//$compteur = 0;

	/*$styleHeader = array(
			    'font'  => array(
			        'color' => array('rgb' => $couleur)
			    ));*/

	$styleHeader = array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => $couleur)
			        ));


	$requeteDossier = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, d.fob AS fob,
													d.ref_crf AS ref_crf, d.montant_av AS montant_av,
													d.ref_fact AS ref_fact, d.ref_decl AS ref_decl,
													d.road_manif AS road_manif, 
													d.ref_assurance AS ref_assurance, 
													d.type_apurement AS type_apurement, 
													d.remarque_apurement AS remarque_apurement, 
													(d.fob+d.fret+d.assurance) AS cif,
													REPLACE(CONCAT(d.ref_crf), ' ', '') AS ref_crf_2
												FROM dossier d, detail_apurement da
												WHERE d.num_lic = ?
													AND d.id_dos = da.id_dos
													AND da.id_trans_ap = ?
												ORDER BY da.id_trans_ap");
	$requeteDossier-> execute(array($entree['num_lic'], $entree['id_trans_ap']));
	while ($reponseDossier = $requeteDossier-> fetch()) {

		$excel->getActiveSheet()
			->getStyle('A'.$row.':AF'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, $compteur)
			-> setCellValue('B'.$row, $reponseDossier['ref_dos'])
			-> setCellValue('H'.$row, $reponseDossier['fob'])
			-> setCellValue('I'.$row, $reponseDossier['ref_crf'])
			-> setCellValue('J'.$row, $maClasse-> getPartielleCRF($reponseDossier['ref_crf_2'])['fob'])
			-> setCellValue('K'.$row, $reponseDossier['ref_fact'])
			-> setCellValue('L'.$row, $reponseDossier['ref_decl'])
			-> setCellValue('M'.$row, $reponseDossier['date_decl'])
			-> setCellValue('N'.$row, $reponseDossier['ref_liq'])
			-> setCellValue('O'.$row, $reponseDossier['date_liq'])
			-> setCellValue('P'.$row, $reponseDossier['ref_quit'])
			-> setCellValue('Q'.$row, $reponseDossier['date_quit'])
			-> setCellValue('R'.$row, $reponseDossier['ref_assurance'])
			-> setCellValue('S'.$row, $reponseDossier['road_manif'])
			-> setCellValue('T'.$row, $reponseDossier['type_apurement'])
			-> setCellValue('U'.$row, $reponseDossier['remarque_apurement']);

		$excel->getActiveSheet()->getStyle('M'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');
		$excel->getActiveSheet()->getStyle('O'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');
		$excel->getActiveSheet()->getStyle('Q'.$row)->getNumberFormat()
             ->setFormatCode('dd/mm/yyyy');


		alignement('A'.$row);
		alignement('B'.$row);
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

		$row++;
		$compteur++;

	}$requeteDossier-> closeCursor();
}