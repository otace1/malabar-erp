<?php

function afficherDossierLicenceExcel($num_lic, $row, $excel, $compteur, $couleur){
	include('../classes/connexion.php');

	$maClasse = new MaClasse();
	$entree['num_lic'] = $num_lic;
	$bg = '';

	/*$styleHeader = array(
			    'font'  => array(
			        'color' => array('rgb' => $couleur)
			    ));*/

	$styleHeader = array(
			        'fill' => array(
			            'type' => PHPExcel_Style_Fill::FILL_SOLID,
			            'color' => array('rgb' => $couleur)
			        ));


	$requeteDossier = $connexion-> prepare("SELECT *, (fob+fret+assurance) AS cif
												FROM dossier
												WHERE num_lic = ?");
	$requeteDossier-> execute(array($entree['num_lic']));
	while ($reponseDossier = $requeteDossier-> fetch()) {

		$excel->getActiveSheet()
			->getStyle('A'.$row.':AF'.$row)->applyFromArray($styleHeader);

		$excel-> getActiveSheet()
			-> setCellValue('A'.$row, $compteur)
			-> setCellValue('B'.$row, $reponseDossier['ref_dos'])
			-> setCellValue('D'.$row, $reponseDossier['po_ref'])
			-> setCellValue('U'.$row, $reponseDossier['ref_fact'])
			-> setCellValue('Q'.$row, $reponseDossier['cod'])
			-> setCellValue('R'.$row, $reponseDossier['fxi'])
			-> setCellValue('S'.$row, $reponseDossier['montant_av'])
			-> setCellValue('V'.$row, $reponseDossier['fob'])
			-> setCellValue('W'.$row, $reponseDossier['fret'])
			-> setCellValue('X'.$row, $reponseDossier['assurance'])
			-> setCellValue('Y'.$row, $reponseDossier['autre_frais'])
			-> setCellValue('Z'.$row, $reponseDossier['cif'])
			-> setCellValue('AA'.$row, $reponseDossier['ref_decl'])
			-> setCellValue('AB'.$row, $reponseDossier['montant_decl'])
			-> setCellValue('AC'.$row, $reponseDossier['ref_liq'])
			-> setCellValue('AD'.$row, $reponseDossier['ref_quit'])
			-> setCellValue('AE'.$row, $reponseDossier['date_quit']);

		alignement('A'.$row);
		alignement('B'.$row);
		alignement('D'.$row);
		alignement('U'.$row);
		alignement('Q'.$row);
		alignement('R'.$row);
		alignement('S'.$row);
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

		$row++;
		$compteur++;

	}$requeteDossier-> closeCursor();
}