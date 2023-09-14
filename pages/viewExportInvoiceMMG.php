<?php
//============================================================+
// File name   : generateurFacture.php
// Begin       : 18/04/2018
// Last Update : 23/05/2018
//
// Description : Generation de la facture global pour DEC
//
// Author: Jeremy BELE BELE
//
// (c) Copyright:
//              Jeremy BELE BELE
//				jeremy@belej-consulting.com
//				www.belej-consulting.com
//============================================================+

header('Content-type: text/html; charset=UTF-8');

include_once('../classes/maClasse.class.php');
$maClasse = new MaClasse();

require_once('../tcpdf/tcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set margins
$pdf->SetMargins(4,3 ,3);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Facture '.$_GET['ref_fact']);
$pdf->SetSubject('act');
$pdf->SetKeywords('act');


//Qrcode de la facture
//On verifie si le QrCode existe deja
// $ref_fact = str_replace(' ', '', str_replace('/', '_', $_GET['ref_fact']));
// if(file_exists('../qrcode/'. $ref_fact.'.png')){
//     //$qrcode = '../qrcode/'.$ref_mvt.'.png';
//     $qrcode = '<img src="../qrcode/'.$ref_fact.'.png" width="30px">';
// }else{
//     echo '<script>window.location="../qrcode/generateur.php?ref_fact='.$ref_fact.'&type=facturePartielle";</script>';
//     //header('Location: ../qrcode/generateurBonCaisse.php?id_cais='.$_GET['id_cais'].'&ref_mvt='.$ref_mvt.'&lang='.$_GET['lang']);
//     $qrcode = '<img src="../qrcode/'.$ref_fact.'.png" width="20px">';
// }
 $qrcode = '';
//FIN Qrcode de la facture

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------


// set font
$pdf->SetFont('helvetica', 'N', 8);
// $pdf->SetFont('times', 'N', 8);
// $pdf->SetFont('courier', 'N', 8);
$pdf->setPrintHeader(false);
// add a page
$pdf->AddPage('P', 'A4');

$pdf->Image('../images/malabar2.png', 4, 10, 110, '', '', '', '', false, 300);
$sceau='';
if ( ($maClasse-> getFactureGlobale($_GET['ref_fact'])['validation']) == '0' ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	// $pdf->Image('../images/sceau_mca.png', 120, 235, 50, '', '', '', '', false, 300);
	if (!empty($maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['signature_facture'])) {
		$sceau = '<img src="../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['signature_facture'].'" width="'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['size_signature_facture'].'">';
	}
	
	// if ($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_cli'] != '906' && $maClasse-> getFactureGlobale($_GET['ref_fact'])['id_cli'] != '902') {
	// 	$pdf->Image('../images/sceau.png', 50, 200, 105, '', '', '', '', false, 300);
	// }
	
}

if(isset($_GET['ref_fact'])){

	if ($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_cli'] == '887' || $maClasse-> getFactureGlobale($_GET['ref_fact'])['id_cli'] == '885') {
		$banque = '
		<tr>
			<td width="100%" style="text-align: left;border: 1px solid black;">&nbsp;<u>Banque : <b></b></u><br>&nbsp;<u>Numero de Compte : <b></b></u><br>&nbsp;<u>Devise  : <b></b></u><br>&nbsp;<u>Adresse : <b></b></u></td>
		</tr>';
	}else{
		$banque = '
		<tr>
			<td width="40%" style="text-align: left;border: 1px solid black;">&nbsp;<u>Banque : <b></b></u><br>&nbsp;<u>Numero de Compte : <b></b></u><br>&nbsp;<u>Devise  : <b>USD</b></u><br>&nbsp;<u>Swift :<b> </b></u><br>&nbsp;<u>Adresse : <b></b></u></td>
			<td width="20%" style="text-align: center;border-bottom: 1px solid black;">&nbsp;<u><b></b></u><br></td>
			<td width="40%" style="text-align: left;border: 1px solid black;">&nbsp;<u>Banque : <b></b></u><br>&nbsp;<u>Numero de Compte : <b></b></u><br>&nbsp;<u>Devise  : <b></b></u><br>&nbsp;<u>Swift :<b> </b></u><br>&nbsp;<u></u></td>
		</tr>';
	}

$logo = '<img src="../images/malabar2.png" width="250px">';
	
$facture = $maClasse-> getDataFactureGlobale($_GET['ref_fact']);
// $dossiers = $maClasse-> getDossierFactureExportSingle($_GET['ref_fact']);
$dossiers5 = $maClasse-> getDossierFactureExportSingle5($_GET['ref_fact']);
// $dossiers2 = $maClasse-> getDossierFactureExportSingle2($_GET['ref_fact']);
$dossiers4 = $maClasse-> getDossierFactureExportSingle4($_GET['ref_fact']);

$ref_fact = $_GET['ref_fact'];//$maClasse-> getNumFactureEnCours($_GET['facture']);
$date_fact = $maClasse-> getFactureGlobale($_GET['ref_fact'])['date_fact'];//$maClasse-> getDateFactureEnCours($_GET['facture']);
$code_client = $maClasse-> getClientFacture($_GET['ref_fact'])['code_cli'];
$nom_client = $maClasse-> getClientFacture($_GET['ref_fact'])['nom_cli'];
$nom_complet = $maClasse-> getClientFacture($_GET['ref_fact'])['nom_complet'];

if ($maClasse-> getFactureGlobale($_GET['ref_fact'])['note_debit'] == '1') {
	$note_debit = 'NOTE DE DEBIT';
}else{
	$note_debit = '';
}

//$adresse_client = htmlentities($facture['adresse_client'], ENT_QUOTES, "UTF-8");//$maClasse-> getAdresseClientFactureEnCours($_GET['facture']);
$adresse_client = $maClasse-> getClientFacture($_GET['ref_fact'])['adr_cli'];//$maClasse-> getAdresseClientFactureEnCours($_GET['facture']);
$transit = '';//$facture['transit'];//$maClasse-> getTransitFactureEnCours($_GET['facture']);
$voie = '';//$facture['voie'];//$maClasse-> getVoieFactureEnCours($_GET['facture']);
$marchandise = $maClasse-> getMarchandiseFacture($_GET['ref_fact'])['nom_march'];
$fournisseur = $maClasse-> getFournisseurFacture($_GET['ref_fact'])['supplier'];
$info_fact = $maClasse-> getFactureGlobale($_GET['ref_fact'])['information'];

$taxe = $maClasse-> getDetailFactureExportMultiple($_GET['ref_fact'], '1');

$autres_charges = $maClasse-> getDetailFactureExportMultiple($_GET['ref_fact'], '2');

$operational_cost = $maClasse-> getDetailFactureExportMultiple($_GET['ref_fact'], '3');

$service_fee = $maClasse-> getDetailFactureExportMultiple($_GET['ref_fact'], '4');

$totalAll = $maClasse-> getTotalFactureMMGExport($_GET['ref_fact']);

$total = $maClasse-> getTotalForFacturePartielle($_GET['ref_fact']);
$arsp = $maClasse-> getARSPForFacturePartielle($_GET['ref_fact']);

$roe_decl =  number_format($maClasse-> getTauxFacture($_GET['ref_fact'])['roe_decl'], 4, ',', '.');
$roe_liq =  number_format($maClasse-> getTauxFacture($_GET['ref_fact'])['roe_liq'], 4, ',', '.');
$totalHT = number_format($maClasse-> getTotalHTFacture($_GET['ref_fact']), 2, ',', ' ');
$totalTVA = number_format($maClasse-> getTotalTVAFacture($_GET['ref_fact']), 2, ',', ' ');
$totalTTC = number_format(($maClasse-> getTotalTVAFacture($_GET['ref_fact'])+$maClasse-> getTotalHTFacture($_GET['ref_fact'])), 2, ',', ' ');

$nom_bur_douane = $maClasse-> getBureauDouane($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['bur_douane'])['nom_bur_douane'];
$nif_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['nif_cli'];
$rccm_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['rccm_cli'];
$adr_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['adr_cli'];
$id_nat = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['id_nat'];
$num_imp_exp = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['num_imp_exp'];
$num_tva = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['num_tva'];

$nom_mod_trans = $maClasse-> getModeTransport($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mod_trans'])['nom_mod_trans'];
$reg_dgda = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['reg_dgda'];
$load_date = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['load_date'];
$exit_drc = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['exit_drc'];
$bur_douane = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['bur_douane'];
$commodity = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['commodity'];
$ref_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos'];
$supplier = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['supplier'];
$ref_decl = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_decl'];
$date_decl = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_decl'];
$ref_liq = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_liq'];
$date_liq = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_liq'];
$ref_quit = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_quit'];
$date_quit = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_quit'];
$ref_crf = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_crf'];
$poids = number_format($maClasse-> getPoidsFacture($_GET['ref_fact']), 2, ',', ' ');
$poids_fere = number_format($maClasse-> getPoidsFactureFERE($_GET['ref_fact']), 2, ',', ' ');
$road_manif = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['road_manif'];

$liste_dossiers = $maClasse-> getRangDossierFacture($_GET['ref_fact']);
$ref_dos_min = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos_min'];
$ref_dos_max = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos_max'];
$nbre_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['nbre_dos'];
$ref_fact_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_fact'];
$po_ref = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['po_ref'];
$horse = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['horse'];
$trailer_1 = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['trailer_1'];
$trailer_2 = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['trailer_2'];
$num_lic = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['num_lic'];
$roe_decl = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['roe_decl'], 4, ',', ' ');
$fob = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fob'], 2, ',', ' ');
$fret = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fret'], 2, ',', ' ');
$assurance = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['assurance'], 2, ',', ' ');
$autre_frais = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['autre_frais'], 2, ',', ' ');
$cif = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif'], 2, ',', ' ');
$cif_cdf = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif']*$maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['roe_decl'], 2, ',', ' ');
$num_cmpt = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['num_cmpt'];
$nom_banq = $maClasse-> getDataCompteBancaire($num_cmpt)['nom_banq'];
$adr_banq = $maClasse-> getDataCompteBancaire($num_cmpt)['adr_banq'];
$intitule_cmpt = $maClasse-> getDataCompteBancaire($num_cmpt)['intitule_cmpt'];
$swift_banq = $maClasse-> getDataCompteBancaire($num_cmpt)['swift_banq'];

$unite = '';
$cost_usd = '';
$sub_total_usd = '';
$tva_16 = '';
$total_en_usd = '';

$cost_1 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 2)/$maClasse-> getPoidsFacture($_GET['ref_fact']), 2, ',', ' ');
$sub_totat_1 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 2), 2, ',', ' ');
$total_1 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 2), 2, ',', ' ');

$cost_2 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 7)/$maClasse-> getPoidsFacture($_GET['ref_fact']), 2, ',', ' ');
$sub_totat_2 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 7), 2, ',', ' ');
$total_2 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 7), 2, ',', ' ');

$cost_3 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 5)/$maClasse-> getPoidsFactureFERE($_GET['ref_fact']), 2, ',', ' ');
$sub_totat_3 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 5), 2, ',', ' ');
$total_3 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 5), 2, ',', ' ');

$cost_4 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 6)/$maClasse-> getPoidsFacture($_GET['ref_fact']), 2, ',', ' ');
$sub_totat_4 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 6), 2, ',', ' ');
$total_4 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 6), 2, ',', ' ');

$cost_5 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 9), 2, ',', ' ');
$sub_totat_5 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 9), 2, ',', ' ');
$total_5 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 9), 2, ',', ' ');

$nbre_dos_debours_6 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 10)['nbre_dos'];
$cost_6 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 10), 2, ',', ' ');
$sub_totat_6 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 10), 2, ',', ' ');
$total_6 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 10), 2, ',', ' ');

$nbre_dos_debours_7 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 11)['nbre_dos'];
$cost_7 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 11), 2, ',', ' ');
$sub_totat_7 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 11), 2, ',', ' ');
$total_7 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 11), 2, ',', ' ');

$nbre_dos_debours_8 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 12)['nbre_dos'];
$cost_8 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 12), 2, ',', ' ');
$sub_totat_8 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 12), 2, ',', ' ');
$total_8 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 12), 2, ',', ' ');

$nbre_dos_debours_9 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 13)['nbre_dos'];
$cost_9 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 13), 2, ',', ' ');
$sub_totat_9 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 13), 2, ',', ' ');
$total_9 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 13), 2, ',', ' ');

$nbre_dos_debours_ogefrem_40 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 198)['nbre_dos'];
$cost_ogefrem_40 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 198), 2, ',', ' ');
$sub_totat_ogefrem_40 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 198), 2, ',', ' ');
$total_ogefrem_40 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 198), 2, ',', ' ');

$sub_total_1 = $maClasse-> getTotalFactureMMGExport_1($_GET['ref_fact']);

$nbre_dos_debours_10 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 15)['nbre_dos'];
$cost_10 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 15), 2, ',', ' ');
$sub_totat_10 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 15), 2, ',', ' ');
$sub_totat_tva_10 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 15)*0.16, 2, ',', ' ');
$total_10 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 15), 2, ',', ' ');

$nbre_dos_debours_11 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 18)['nbre_dos'];
$cost_11 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 18), 2, ',', ' ');
$sub_totat_11 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 18), 2, ',', ' ');
$sub_totat_tva_11 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 18)*0.16, 2, ',', ' ');
$total_11 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 18), 2, ',', ' ');

$nbre_dos_debours_12 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 24)['nbre_dos'];
$cost_12 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 24), 2, ',', ' ');
$sub_totat_12 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 24), 2, ',', ' ');
$sub_totat_tva_12 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 24)*0.16, 2, ',', ' ');
$total_12 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 24), 2, ',', ' ');

$nbre_dos_debours_13 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 17)['nbre_dos'];
$cost_13 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 17), 2, ',', ' ');
$sub_totat_13 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 17), 2, ',', ' ');
$sub_totat_tva_13 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 17)*0.16, 2, ',', ' ');
$total_13 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 17), 2, ',', ' ');

$nbre_dos_debours_14 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 25)['nbre_dos'];
$cost_14 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 25), 2, ',', ' ');
$sub_totat_14 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 25), 2, ',', ' ');
$sub_totat_tva_14 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 25)*0.16, 2, ',', ' ');
$total_14 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 25), 2, ',', ' ');

$nbre_dos_debours_15 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 22)['nbre_dos'];
$cost_15 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 22), 2, ',', ' ');
$sub_totat_15 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 22), 2, ',', ' ');
$sub_totat_tva_15 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 22)*0.16, 2, ',', ' ');
$total_15 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 22), 2, ',', ' ');

$nbre_dos_debours_16 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 23)['nbre_dos'];
$cost_16 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 23), 2, ',', ' ');
$sub_totat_16 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 23), 2, ',', ' ');
$sub_totat_tva_16 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 23)*0.16, 2, ',', ' ');
$total_16 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 23), 2, ',', ' ');

$nbre_dos_debours_17 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 16)['nbre_dos'];
$cost_17 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 16), 2, ',', ' ');
$sub_totat_17 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 16), 2, ',', ' ');
$sub_totat_tva_17 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 16)*0.16, 2, ',', ' ');
$total_17 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 16), 2, ',', ' ');

$nbre_dos_debours_18 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 25)['nbre_dos'];
$cost_18 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 25), 2, ',', ' ');
$sub_totat_18 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 25), 2, ',', ' ');
$sub_totat_tva_18 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 25)*0.16, 2, ',', ' ');
$total_18 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 25), 2, ',', ' ');

$nbre_dos_debours_19 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 26)['nbre_dos'];
$cost_19 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 26), 2, ',', ' ');
$sub_totat_19 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 26), 2, ',', ' ');
$sub_totat_tva_19 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 26)*0.16, 2, ',', ' ');
$total_19 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 26), 2, ',', ' ');

$nbre_dos_debours_20 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 27)['nbre_dos'];
$cost_20 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 27), 2, ',', ' ');
$sub_totat_20 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 27), 2, ',', ' ');
$sub_totat_tva_20 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 27)*0.16, 2, ',', ' ');
$total_20 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 27), 2, ',', ' ');

$nbre_dos_debours_21 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 28)['nbre_dos'];
$cost_21 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 28), 2, ',', ' ');
$sub_totat_21 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 28), 2, ',', ' ');
$sub_totat_tva_21 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 28)*0.16, 2, ',', ' ');
$total_21 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 28), 2, ',', ' ');

$nbre_dos_debours_22 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 29)['nbre_dos'];
$cost_22 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 29), 2, ',', ' ');
$sub_totat_22 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 29), 2, ',', ' ');
$sub_totat_tva_22 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 29)*0.16, 2, ',', ' ');
$total_22 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 29), 2, ',', ' ');

$nbre_dos_debours_23 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 30)['nbre_dos'];
$cost_23 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 30), 2, ',', ' ');
$sub_totat_23 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 30), 2, ',', ' ');
$sub_totat_tva_23 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 30)*0.16, 2, ',', ' ');
$total_23 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 30), 2, ',', ' ');

$nbre_dos_debours_24 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 31)['nbre_dos'];
$cost_24 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 31), 2, ',', ' ');
$sub_totat_24 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 31), 2, ',', ' ');
$sub_totat_tva_24 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 31)*0.16, 2, ',', ' ');
$total_24 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 31), 2, ',', ' ');

$sub_total_2 = $maClasse-> getTotalFactureMMGExport_2($_GET['ref_fact']);

$nbre_dos_debours_25 = $maClasse-> getDataDossiersFactureDebours($_GET['ref_fact'], 21)['nbre_dos'];
$cost_25 = number_format($maClasse-> getMontantDeboursDetailFacture($_GET['ref_fact'], 21), 2, ',', ' ');
$sub_totat_25 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 21), 2, ',', ' ');
$sub_totat_tva_25 = number_format($maClasse-> getMontantFactureDossierDebours3($_GET['ref_fact'], 21)*0.16, 2, ',', ' ');
$total_25 = number_format($maClasse-> getMontantFactureDossierDeboursWithTVA($_GET['ref_fact'], 21), 2, ',', ' ');

$sub_total_3 = $maClasse-> getTotalFactureMMGExport_3($_GET['ref_fact']);
$nom_banq = $maClasse-> getDataBancaire($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_bank_liq'])['nom_banq'];

$text_bank = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['text_banq'];

$banque = '<tr>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00130-00001020614-41</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;PRCBCDKI</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
			<td width="10%"></td>
		</tr>';

$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDC		
					<br>&nbsp;LUBUMBASHI		
					<br>&nbsp;R.D. CONGO</td>
					<td width="10%"></td>
				</tr>';

$tbl = <<<EOD
    <html>
    <head>
        <meta http-equiv = " content-type " content = " text/html; charset=utf-8" />
    </head>
    <body style="font-weight: bold;" style="">
	<table>
		<tr>
			<td width="45%" style="text-align: center;"></td>
			<td width="55%" style="text-align: right; font-size: 5px;">
			No. 1068, Avenue Ruwe, Quartier Makutano, <br>
			Lubumbashi, DRC<br>
			RCCM: 13-B-1122, ID NAT. 6-9-N91867E<br>
			NIF : A 1309334 L<br>
			VAT Ref # 145/DGI/DGE/INF/BN/TVA/2020<br>
			Capital Social : 45.000.000 FC
			</td>
		</tr>
		<br>
		<br>
		<tr>
			<td width="45%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">FACTURE</td>
		</tr>
		<br>
		<tr>
			<td width="45%" rowspan="7" style="text-align: left; border: 0.3px solid black; font-size: 7px;"><span><u>CLIENT</u></span>
			<br><b><font size="8px">$nom_complet</font> </b>
			<br>$adresse_client
			<br>No.RCCM: $rccm_cli
			<br>No.NIF.: $nif_cli
			<br>No.IDN.: $id_nat
			<br>No.IMPORT/EXPORT: $num_imp_exp
			<br>No.TVA: $num_tva</td>
			<td width="15%" style="text-align: center;"></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;N.FACTURE</td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$ref_fact</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: center;"></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Date</td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$date_fact</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="40%"rowspan="2" colspan="2" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;<u>Dossier(s):</u> <br>
			<b>$liste_dossiers</b></td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; "></td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Nombre de Dossier(s): </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$nbre_dos</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left;"></td>
			<td width="22%" style="text-align: center; font-weight: bold;"></td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left;"></td>
			<td width="22%" style="text-align: center; font-weight: bold;"></td>
		</tr>

		<tr>
			<td width="100%"><br></td>
		</tr>

		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>CUSTOMS CLEARANCE FEES / FRAIS DEDOUANEMENT</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="6%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Unit</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">COST /USD</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TOTAL  EN USD</td>
		</tr>
		<tr>
			<td style="text-align: left; font-weight: bold; border-left: 1px solid black; border-right: 0.5px solid black;" colspan="2" width="49%"></td>
			<td style="text-align: center; border-right: 0.5px solid black;" colspan="2" width="6%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11.5%"></td>
			<td style="text-align: right; border-right: 1px solid black;" width="11.5%"></td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;DGDA EXPORT DUTIES (1%) / FRAIS DEDOUANEMENT</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$poids</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_1</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;GOVERNORS TAX($50/MT) / TAXE VOIRIEGOVERNORS TAX($50/MT) / TAXE VOIRIE</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$poids</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_2</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_2&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;FICHE ELECTRONIQUE DE RENSEIGNEMENT A L'EXPORTATION</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$poids_fere</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_3</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_3&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OGEFREM 40''</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_ogefrem_40</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_ogefrem_40</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_ogefrem_40&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_ogefrem_40&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;LIGNE MARITIME CONGOLAISE (LMC)</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$poids</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_4</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OCC : SAMPLING / ECHATILLIONNAGE OCC</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_5</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_5&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OCC/CGEA : RADIO ACTIVITY TEST / RADIO ACTIVITE OCC/CGEA</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_6</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_6&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;CEEC CERTIFICATE / CERTIFICAT CEEC (UPTO 30MT)</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_7</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_7</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_7&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;CEEC CERTIFICATE / CERTIFICAT CEEC (30MT to 60MT) - WEF 13/12/2017</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_8</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_8</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_8&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_8&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;DGDA SECURITY SEALS / FRAIS DE PLOMB DGDA</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_9</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_9</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_9&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		$sub_total_1
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OPERATIONAL COSTS / COUT OPERATIONEL</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="6%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Unit</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">COST /USD</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TOTAL  EN USD</td>
		</tr>
		<tr>
			<td style="text-align: left; font-weight: bold; border-left: 1px solid black; border-right: 0.5px solid black;" colspan="2" width="49%"></td>
			<td style="text-align: center; border-right: 0.5px solid black;" colspan="2" width="6%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11.5%"></td>
			<td style="text-align: right; border-right: 1px solid black;" width="11.5%"></td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;ASSAY FEE / FRAIS LABO</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_10</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_10</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_10&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OCC FEES / FRAIS OCC</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_11</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_11</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_11&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;MINE DIVISION /DIVISION DES MINES</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_12</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_12&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_12&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_12&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;COMMERCE EXTERIOR / COMMERCE EXTERIEUR</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_13</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_13</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_13&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_13&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_13&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;MINE POLICE / POLICE DES MINES</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">0,00</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;KASUMBALEA BORDER CHARGES / FORMALITES FRONTIERE KASUMBALESA</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_15</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_15</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_15&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_15&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_15&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : OCC FEES / COUT OPERATIONNEL FRAIS OCC</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_16</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_16</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_16&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_16&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_16&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : MINE DIVISION /COUT OPERATIONNEL DIVISION DES MINES</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_17</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_17</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_17&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_17&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_17&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : MINE POLICE / COUT OPERATIONNEL POLICE DES MINES</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_18</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_18</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_18&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_18&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_18&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : ANR / COUT OPERATIONNEL ANR</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_19</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_19</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_19&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_19&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_19&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : DGDA / COUT OPERATIONNEL DGDA</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_20</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_20</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_20&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : PRINTING AND STATIONERY / FRAIS ADMINISTRATIFS</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_21</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_21</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_21&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_21&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_21&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : REDEVANCE IT / COUT OPERATIONNELS REDEVANCE IT</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">0.00</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">0.00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">0,00&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : BANK CHARGES / FRAIS BANCAIRE</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_22</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_22</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_22&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_22&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_22&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;OPERATIONS COST : KISANGA TOLL GATES / COUT OPERATIONNEL PEAGE</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_23</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_23</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_23&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_23&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_23&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;TRANSFER FEE / FRAIS DE TRANSFERT PEAGE</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_24</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_24</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_24&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_24&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_24&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		$sub_total_2
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>SERVICE FEE / SERVICES</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="6%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Unit</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">COST /USD</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TOTAL  EN USD</td>
		</tr>
		<tr>
			<td style="text-align: left; font-weight: bold; border-left: 1px solid black; border-right: 0.5px solid black;" colspan="2" width="49%"></td>
			<td style="text-align: center; border-right: 0.5px solid black;" colspan="2" width="6%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11.5%"></td>
			<td style="text-align: right; border-right: 1px solid black;" width="11.5%"></td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black; font-size: 6.5px;" colspan="2" width="49%">&nbsp;&nbsp;CONTRACTOR AGENCY FEE / FRAIS D`AGENCE</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="6%">$nbre_dos_debours_25</td>
			<td style="text-align: center; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$cost_25</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11%">$sub_totat_25&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 0.5px solid black; font-size: 6.5px;" width="11.5%">$sub_totat_tva_25&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			<td style="text-align: right; border-right: 1px solid black; font-size: 6.5px;" width="11.5%">$total_25&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		$sub_total_3
		<tr>
			<td width="100%"></td>
		</tr>
		$totalAll
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="45%" style=" font-size: 6.5px;">
			VEUILLEZ TROUVER CI-DESSOUS LES DETAILS DE NOTRE COMPTE BANCAIRE
			</td>
			<td width="55%" rowspan="8" style="text-align: center;">$sceau</td>
		</tr>
		<tr>
			<td width="45%" style=" font-size: 6.5px;">
			</td>
		</tr>
		$banque
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="65%" style=" font-size: 7px;">
			LE PAIEMENT DOIT S'EFFECTUER ENDEANS 7 JOURS
			</td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; text-align: center; font-size: 7px;">Thank you for you business!</td>
		</tr>
	</table>
	</body>
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// add a page
$pdf->AddPage('L', 'A4');
if ( ($maClasse-> getFactureGlobale($_GET['ref_fact'])['validation']) == '0' ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	$pdf->Image('../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['signature_facture'], 200, 152, $maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['size_signature_facture_2'], '', '', '', '', false, 300);
	
}

$tbl = <<<EOD
    <html>
    <head>
        <meta http-equiv = " content-type " content = " text/html; charset=utf-8" />
    </head>
    <body style="font-weight: bold;" style="">
	<table>
		<br>
		<br>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="80%" style="">$logo</td>
			<td width="5%" style=""></td>
		</tr>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="83%" style="">DETAILS - EXPORT CLEARING $marchandise LOADS</td>
		</tr>
		<tr>
			<td width="2%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>#<br></span></td>
			<td width="10%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>MCA File No<br></span></td>
			<td width="9%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Destination<br></span></td>
			<td width="9%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Transporter<br></span></td>
			<td width="8%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Horse/Wagon<br></span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Trailer 1<br></span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Trailer 2<br></span></td>
			<td width="8%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Container<br></span></td>
			<td width="4%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Feet<br></span></td>
			<td width="9%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Lot. No.<br></span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Qty(Mt)<br></span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Loading Date</span></td>
			<td width="9%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Clearing Completed Date</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>CLEARED<br></span></td>
		</tr>
		$dossiers5
		<br>
		<br>
		<tr>
			<td width="3%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>#<br></span></td>
			<td width="9%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>MCA File No<br></span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Qty(Mt)<br></span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Loading Date</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Declaration Ref.</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Declaration Date</span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>BCC Rate</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Liquidation Ref.</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Liquidation Date</span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Liq. Amt. CDF</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Quittance Ref.</span></td>
			<td width="6%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Quittance Date</span></td>
			<td width="12%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Bank</span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Bank Rate</span></td>
			<td width="7%" style="text-align: center; border: 1 solid black; font-weight: bold; font-size: 7px;"><span><br>Liq. Amt. USD</span></td>
		</tr>
		$dossiers4
		<br>
		<br>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="90%" style="text-align: right;">Details INV No. $ref_fact du $date_fact</td>
			<td width="5%" style=""></td>
		</tr>
		<br>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="90%" style="text-align: center;"></td>
			<td width="5%" style=""></td>
		</tr>
	</table>
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// Clean any content of the output buffer
ob_end_clean();

$pdf->Output($_GET['ref_fact'].'.pdf', 'I');

  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+