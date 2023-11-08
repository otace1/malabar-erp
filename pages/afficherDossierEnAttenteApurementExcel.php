<?php

function afficherDossierEnAttenteApurementExcel($id_cli, $id_mod_lic, $row, $excel, $compteur){
	include('../classes/connexion.php');

	$maClasse = new MaClasse();
	$entree['id_mod_lic'] = $id_mod_lic;
	$bg = '';
	$compteur = 0;

	if (isset($id_cli) && ($id_cli!='')) {
		$sqlClient = ' AND d.id_cli = "'.$id_cli.'"';
	}else{
		$sqlClient = '';
	}


	$requeteDossier = $connexion-> prepare("SELECT d.ref_dos AS ref_dos, d.num_lic AS num_lic, 
													d.ref_fact,
													d.fob AS fob, d.ref_av AS ref_av, d.montant_av AS montant_av,
													d.ref_fact AS ref_fact, d.ref_decl AS ref_decl,
													d.road_manif AS road_manif,
													d.fob AS fob,
													d.fret AS fret,
													d.assurance AS assurance,
													d.autre_frais AS autre_frais,
													(d.fob+d.assurance+d.autre_frais+d.fret) AS cif,
													DATE_FORMAT(d.date_decl, '%d/%m/%Y') AS date_decl,
													DATE_FORMAT(d.date_liq, '%d/%m/%Y') AS date_liq,
													DATE_FORMAT(d.date_quit, '%d/%m/%Y') AS date_quit,
													d.ref_decl AS ref_decl,
													d.ref_liq AS ref_liq,
													d.ref_quit AS ref_quit
												FROM dossier d
												WHERE d.id_mod_lic = ?
													$sqlClient
													AND d.ref_quit IS NOT NULL
													AND d.ref_quit <> ''
													AND d.ref_decl IS NOT NULL
													AND d.ref_decl <> ''
													AND d.ref_decl <> ''
													AND d.ref_quit <> ''
													AND d.num_lic <> 'N/A'
													AND d.num_lic <> 'UNDER VALUE'
													AND d.num_lic <> 'UNDERVALUE'
													AND d.num_lic NOT LIKE '%UNDER%'
													AND d.id_dos NOT IN(
															SELECT id_dos FROM detail_apurement
														)
													AND (d.id_cli <> 869 AND d.id_cli <> 929 AND d.id_cli <> 927 AND d.id_cli <> 870 AND d.id_cli <> 902 AND d.id_cli <> 873 AND d.id_cli <> 871 AND d.id_cli <> 872)
												ORDER BY d.ref_dos DESC");
	$requeteDossier-> execute(array($entree['id_mod_lic']));
	while ($reponseDossier = $requeteDossier-> fetch()) {

				$date_exp = $maClasse-> getDateExpirationLicence($reponseDossier['num_lic']);
				$compteur++;

		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, $compteur)
			-> setCellValue('B'.$row, $reponseDossier['ref_dos'])
			-> setCellValue('C'.$row, $reponseDossier['fob'])
			-> setCellValue('D'.$row, $reponseDossier['fret'])
			-> setCellValue('E'.$row, $reponseDossier['assurance'])
			-> setCellValue('F'.$row, $reponseDossier['autre_frais'])
			-> setCellValue('G'.$row, $reponseDossier['cif'])
			-> setCellValue('H'.$row, $reponseDossier['ref_decl'])
			-> setCellValue('I'.$row, $reponseDossier['date_decl'])
			-> setCellValue('J'.$row, $reponseDossier['ref_liq'])
			-> setCellValue('K'.$row, $reponseDossier['date_liq'])
			-> setCellValue('L'.$row, $reponseDossier['ref_quit'])
			-> setCellValue('M'.$row, $reponseDossier['date_quit'])
			-> setCellValue('N'.$row, $reponseDossier['num_lic'])
			-> setCellValue('O'.$row, $maClasse-> getDataLicence($reponseDossier['num_lic'])['sig_mon'])
			-> setCellValue('P'.$row, $maClasse-> getDataLicence($reponseDossier['num_lic'])['date_val'])
			-> setCellValue('Q'.$row, $date_exp)
			-> setCellValue('R'.$row, ($maClasse-> getDataLicence($reponseDossier['num_lic'])['fob']+$maClasse-> getDataLicence($reponseDossier['num_lic'])['fret']+$maClasse-> getDataLicence($reponseDossier['num_lic'])['assurance']+$maClasse-> getDataLicence($reponseDossier['num_lic'])['autre_frais']))
			-> setCellValue('S'.$row, $reponseDossier['ref_av'])
			-> setCellValue('T'.$row, $reponseDossier['montant_av'])
			-> setCellValue('U'.$row, $reponseDossier['ref_fact'])
			-> setCellValue('V'.$row, $reponseDossier['road_manif']);

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
		alignement('V'.$row);

		$row++;

	}$requeteDossier-> closeCursor();


		//Bordure des Cellules
		$excel-> getActiveSheet()-> getStyle('A8:V'.($row-1))-> applyFromArray(
			array(
				'borders' => array(
					'allborders' => array(
						'style' => PHPExcel_Style_Border::BORDER_THIN
					)
				)
			)
		);


}