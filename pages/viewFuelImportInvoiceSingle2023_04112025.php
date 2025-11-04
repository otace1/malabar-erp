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
$pdf->SetMargins(6,4 ,4);


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
// $pdf->SetFont('courier', 'N', 8);
$pdf->setPrintHeader(false);
// add a page
$pdf->AddPage('P', 'A4');

$pdf->Image('../images/malabar2.png', 5, 4, 110, '', '', '', '', false, 300);
$sceau='';
if ( ($maClasse-> getFactureGlobale($_GET['ref_fact'])['validation']) == '0' ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	if (!empty($maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['signature_facture'])) {
		$sceau = '<img src="../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['signature_facture'].'" width="'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_util_validation'])['size_signature_facture'].'">';
	}
	
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
$dossiers = $maClasse-> getDossierFactureExportSingle($_GET['ref_fact']);

$ref_fact = $_GET['ref_fact'];//$maClasse-> getNumFactureEnCours($_GET['facture']);

if ($maClasse-> getFactureGlobale($_GET['ref_fact'])['tax_duty_part']=='Exclude') {
	header("Location: viewImportInvoiceSingle2023ExcluDuty.php?ref_fact=$ref_fact");
}

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

$taxe = $maClasse-> getDetailFactureImportSingle2023($_GET['ref_fact'], '1');

$autres_charges = $maClasse-> getDetailFactureImportSingle2025Fuel($_GET['ref_fact'], '2');

$operational_cost = $maClasse-> getDetailFactureImportSingle2025Fuel($_GET['ref_fact'], '3');

$service_fee = $maClasse-> getDetailFactureImportSingle2025Fuel($_GET['ref_fact'], '4');

$totalAll = $maClasse-> getTotalFactureImportSingle2023($_GET['ref_fact'], $sceau);

$total = $maClasse-> getTotalForFacturePartielle($_GET['ref_fact']);
$arsp = $maClasse-> getARSPForFacturePartielle($_GET['ref_fact']);

$taux =  number_format($maClasse-> getTauxFacture($_GET['ref_fact'])['roe_decl'], 4, ',', '.');
$roe_inv =  number_format($maClasse-> getTauxFacture($_GET['ref_fact'])['roe_inv'], 4, ',', '.');
$totalHT = number_format($maClasse-> getTotalHTFacture($_GET['ref_fact']), 2, ',', '.');
$totalTVA = number_format($maClasse-> getTotalTVAFacture($_GET['ref_fact']), 2, ',', '.');
$totalTTC = number_format(($maClasse-> getTotalTVAFacture($_GET['ref_fact'])+$maClasse-> getTotalHTFacture($_GET['ref_fact'])), 2, ',', '.');

$nom_bur_douane = $maClasse-> getBureauDouane($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['bur_douane'])['nom_bur_douane'];
$nif_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['nif_cli'];
$rccm_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['rccm_cli'];
$adr_cli = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['adr_cli'];
$id_nat = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['id_nat'];
$num_imp_exp = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['num_imp_exp'];
$num_tva = $maClasse-> getClient($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_cli'])['num_tva'];

$nom_mod_trans = $maClasse-> getModeTransport($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mod_trans'])['nom_mod_trans'];
$truck = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['truck'];
$reg_dgda = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['reg_dgda'];
$load_date = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['load_date'];
$exit_drc = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['exit_drc'];
$bur_douane = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['bur_douane'];
$commodity = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['commodity'];
$ref_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos'];
$dispatch_deliv = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['dispatch_deliv'];
$supplier = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['supplier'];
$ref_decl = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_decl'];
$date_decl = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_decl'];
$ref_liq = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_liq'];
$date_liq = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_liq'];
$ref_quit = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_quit'];
$date_quit = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['date_quit'];
$ref_crf = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_crf'];
$po_ref = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['po_ref'];
$num_exo = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['num_exo'];
$m3 = number_format($maClasse-> getDataDossiersMultipleInvoiceFuel($_GET['ref_fact'])['m3'], 2, ',', '.');
$fob_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fob_usd'], 2, ',', '.');
$fob_en_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fob_en_usd'], 2, ',', '.');
$fret_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fret_usd'], 2, ',', '.');
$autre_frais_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['autre_frais_usd'], 2, ',', '.');
$assurance_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['assurance_usd'], 2, ',', '.');
$road_manif = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['road_manif'];

$liste_dossiers = $maClasse-> getRangDossierFacture($_GET['ref_fact']);
$ref_dos_min = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos_min'];
$ref_dos_max = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_dos_max'];
$nbre_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['nbre_dos'];
$ref_fact_dos = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['ref_fact'];
$supplier = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['supplier'];
$po_ref = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['po_ref'];
$code_tarif = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['code_tarif'];
$horse = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['horse'];
$trailer_1 = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['trailer_1'];
$trailer_2 = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['trailer_2'];
$num_lic = $maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['num_lic'];
$roe_decl = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['roe_decl'], 4, ',', ' ');
$fob = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fob'], 2, ',', '.');
$fret = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['fret'], 2, ',', '.');
$assurance = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['assurance'], 2, ',', '.');
$autre_frais = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['autre_frais'], 2, ',', '.');
$cif_usd = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif_usd'], 2, ',', '.');
$cif_cdf = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif_cdf'], 2, ',', '.');
$cif = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif'], 2, ',', '.');
// $cif_cdf = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['cif']*$maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['roe_decl'], 2, ',', '.');
$id_mon_fob = $maClasse-> getMonnaie($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mon_fob'])['sig_mon'];
$id_mon_fret = $maClasse-> getMonnaie($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mon_fret'])['sig_mon'];
$id_mon_assurance = $maClasse-> getMonnaie($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mon_assurance'])['sig_mon'];
$id_mon_autre_frais = $maClasse-> getMonnaie($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_mon_autre_frais'])['sig_mon'];

if($maClasse-> get_aff_client_modele_licence($maClasse-> getFactureGlobale($_GET['ref_fact'])['id_cli'], $maClasse-> getFactureGlobale($_GET['ref_fact'])['id_mod_lic'])['bank_rate']=='0'){

	$roe_liq = $roe_decl;

}else{

	$roe_liq =  number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['roe_liq'], 4, ',', '.');
	
}

$nom_banq = $maClasse-> getDataBancaire($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['id_bank_liq'])['nom_banq'];

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
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BCDC		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
			<td width="10%"></td>
		</tr>';

// $banque = '<tr>
// 			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
// 			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
// 			<td width="10%"></td>
// 		</tr>
// 		<tr>
// 			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
// 			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
// 			<td width="10%"></td>
// 		</tr>
// 		<tr>
// 			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
// 			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI</td>
// 			<td width="10%"></td>
// 		</tr>
// 		<tr>
// 			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
// 			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BCDC		
// 			<br>&nbsp;LUBUMBASHI		
// 			<br>&nbsp;R.D. CONGO</td>
// 			<td width="10%"></td>
// 		</tr>
// 		<tr>
// 			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
// 			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;PRCBCDKI</td>
// 			<td width="10%"></td>
// 			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
// 			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBCDKIXXX</td>
// 		</tr>
// 		<tr>
// 			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
// 			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA		
// 			<br>&nbsp;LUBUMBASHI		
// 			, R.D. CONGO</td>
// 			<td width="10%"></td>
// 			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
// 			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK
// 			<br>&nbsp;LUBUMBASHI		
// 			, R.D. CONGO</td>
// 		</tr>';

/*if ($facture['id_cli']==878 || $facture['id_cli']==876) {
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
					, R.D. CONGO</td>
					<td width="10%"></td>
				</tr>';
}else if ($facture['id_cli']==864 || $facture['id_cli']==899 || $facture['id_cli']==916 || $facture['id_cli']==906 || $facture['id_cli']==901 || $facture['id_cli']==932 || $facture['id_cli']==856 || $facture['id_cli']==923 || $facture['id_cli']==905 || $facture['id_cli']==912 || $facture['id_cli']==927 || $facture['id_cli']==869 || $facture['id_cli']==919 || $facture['id_cli']==922 || $facture['id_cli']==934 || $facture['id_cli']==879 || $facture['id_cli']==859 || $facture['id_cli']==938 || $facture['id_cli']==903 || $facture['id_cli']==918 || $facture['id_cli']==925 || $facture['id_cli']==914) {
	$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
					<td width="10%"></td>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
					<td width="10%"></td>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;05100-05130-01003333601-20</td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI</td>
					<td width="10%"></td>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBCDKIXXX</td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDC		
					<br>&nbsp;LUBUMBASHI		
					, R.D. CONGO</td>
					<td width="10%"></td>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK
					<br>&nbsp;LUBUMBASHI		
					, R.D. CONGO</td>
				</tr>';
}else */
if ($facture['id_cli']==905) {
	$banque = '<tr>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
			<td width="10%"></td>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;05100-05130-01003333601-20</td>
			<td width="10%"></td>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBCDKIXXX</td>
			<td width="10%"></td>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI</td>
		</tr>
		<tr>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
			<td width="10%"></td>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BCDC		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
		</tr>';
}else if ($facture['id_cli']==913 || $facture['id_cli']==905) {
	$banque = '<tr>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;05100-05130-01003333601-20</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBCDKIXXX</td>
			<td width="10%"></td>
		</tr>
		<tr>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
			<td width="10%"></td>
		</tr>';
}else if ($facture['id_cli']==857) {
	$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
					<td width="10%"></td>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL V/C KAMOA COPPER SA-DGDA</td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41/USD</td>
					<td width="10%"></td>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-15055-52000867229-60/USD</td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI</td>
					<td width="10%"></td>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKIxxx</td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA LUBUMBASHI , R.D. CONGO</td>
					<td width="10%"></td>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA LUBUMBASHI , R.D. CONGO</td>
				</tr>';
}

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
		<tr>
			<td width="45%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">FACTURE</td>
		</tr>
		<br>
		<tr>
			<td width="45%" rowspan="7" style="text-align: left; border: 0.3px solid black; font-size: 7px;"><span><u>CLIENT</u></span>
			<br><b><font size="8px">$nom_complet</font> </b>
			<span style="font-size: 6px;"><br>$adresse_client
			<br>No.RCCM: $rccm_cli
			<br>No.NIF.: $nif_cli
			<br>No.IDN.: $id_nat
			<br>No.IMPORT/EXPORT: $num_imp_exp
			<br>No.TVA: $num_tva</span></td>
			<td width="15%" style="text-align: center;"></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-weight: bold;">&nbsp;FACTURE Nº</td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$ref_fact</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: center;"></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Date</td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$date_fact</td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 6px;">&nbsp;Mode Transport</td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$nom_mod_trans</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: center;"></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Truck/Trailer/Container</td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$truck</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: center;"></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Fournisseur</td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$supplier</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Facture/PFI: </td>
			<td width="13%" style="text-align: center; border: 0.3px solid black; font-size: 6px; font-weight: bold;">$ref_fact_dos</td>
			<td width="6%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;PO Four.: </td>
			<td width="13%" style="text-align: center; border: 0.3px solid black; font-size: 6px; font-weight: bold;">$po_ref</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Produit: </td>
			<td width="32%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$commodity</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; "></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;BIVAC Insp.: </td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-size: 6px; font-weight: bold;">$ref_crf</td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Tariff Code: </td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$code_tarif</td>
		</tr>
		<tr>
			<td width="60%"></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;License: </td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$num_lic</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;M3: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$m3</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-weight: bold;">&nbsp;File Ref.: </td>
			<td width="32%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$liste_dossiers</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;FOB/$id_mon_fob: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$fob_usd</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Exoneration/Code: </td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$num_exo</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Fret/$id_mon_fret: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$fret_usd</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="13%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Rate(CDF/USD) BCC: </td>
			<td width="8.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$roe_liq</td>
			<td width="12%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Rate(CDF/$id_mon_fob) Inv.</td>
			<td width="6.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$roe_inv</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Autres Charges/$id_mon_autre_frais: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$autre_frais_usd</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Bank: </td>
			<td width="16%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$nom_banq</td>
			<td width="8%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Bank Rate: </td>
			<td width="8%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$roe_decl</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Assurance/$id_mon_assurance: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$assurance_usd</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Declaration: </td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_decl</td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$date_decl</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-weight: bold;">&nbsp;CIF/$id_mon_fob: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7.5px; font-weight: bold;">$cif_usd</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Liquidation: </td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_liq</td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$date_liq</td>
		</tr>
		<tr>
			<td width="23%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-weight: bold;">&nbsp;CIF/CDF: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7.5px; font-weight: bold;">$cif_cdf</td>
			<td width="15%" style="text-align: left; "></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Quiittance: </td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_quit</td>
			<td width="12.5%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$date_quit</td>
		</tr>

		<tr>
			<td width="100%"></td>
		</tr>

		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; font-size: 7px;">&nbsp;<u>CUSTOMS CLEARANCE FEES / FRAIS DEDOUANEMENT</u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px; text-align: center;">&nbsp;<u>Description</u></td>
			<td width="9%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Unit</td>
			<td width="9%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">CIF/Split</td>
			<td width="8%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">%</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Rate/CDF</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">VAT/CDF</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Total/CDF</td>
		</tr>
		$taxe
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; font-size: 7px;">&nbsp;<u>OTHER CHARGES / AUTRES FRAIS </u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px; text-align: center;">&nbsp;<u>Description</u></td>
			<td width="9%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Applicable</td>
			<td width="8%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Qty</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Taux/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TVA/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TOTAL  EN USD</td>
		</tr>
		$autres_charges
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; font-size: 7px;">&nbsp;<u>OPERATIONAL COSTS / COUT OPERATIONEL</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px; text-align: center;">&nbsp;<u>Description</u></td>
			<td width="9%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Applicable</td>
			<td width="8%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Qty</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Taux/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TVA/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TOTAL  EN USD</td>
		</tr>
		$operational_cost
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; font-size: 7px;">&nbsp;<u>SERVICE FEE / SERVICES</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px; text-align: center;">&nbsp;<u>Description</u></td>
			<td width="9%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Applicable</td>
			<td width="8%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Qty</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Taux/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TVA/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TOTAL  EN USD</td>
		</tr>
		$service_fee
		<tr>
			<td rowspan="9" style="text-align: center; font-weight: bold; font-size: 8px;" width="65.5%">$sceau
			</td>
			<td></td>
			<td></td>
		</tr>
		$totalAll
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td></td>
		</tr>
		<tr>
			<td width="100%" style=" font-size: 5.5px; text-align: center;">
			VEUILLEZ TROUVER CI-DESSOUS LES DETAILS DE NOTRE COMPTE BANCAIRE
			</td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		$banque
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; text-align: center; font-size: 7px;">Thank you for you business!</td>
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