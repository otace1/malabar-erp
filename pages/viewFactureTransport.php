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
$dossiers = $maClasse-> getDossierFactureExportSingle($_GET['ref_fact']);

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

if ($facture['note_debit'] == '1') {
	$type_note = 'DEBIT NOTE';
}else if ($facture['note_debit'] == '2') {
	$type_note = 'CREDIT NOTE';
}else{
	$type_note = 'FACTURE';
}

//$adresse_client = htmlentities($facture['adresse_client'], ENT_QUOTES, "UTF-8");//$maClasse-> getAdresseClientFactureEnCours($_GET['facture']);
$adresse_client = $maClasse-> getClientFacture($_GET['ref_fact'])['adr_cli'];//$maClasse-> getAdresseClientFactureEnCours($_GET['facture']);
$transit = '';//$facture['transit'];//$maClasse-> getTransitFactureEnCours($_GET['facture']);
$voie = '';//$facture['voie'];//$maClasse-> getVoieFactureEnCours($_GET['facture']);
$marchandise = $maClasse-> getMarchandiseFacture($_GET['ref_fact'])['nom_march'];
$fournisseur = $maClasse-> getFournisseurFacture($_GET['ref_fact'])['supplier'];
$info_fact = $maClasse-> getFactureGlobale($_GET['ref_fact'])['information'];


$detail_facture_transport = $maClasse-> detail_facture_transport($_GET['ref_fact']);

$totalAll = $maClasse-> getTotalFactureGroup($_GET['ref_fact'], $sceau);

$total = $maClasse-> getTotalForFacturePartielle($_GET['ref_fact']);
$arsp = $maClasse-> getARSPForFacturePartielle($_GET['ref_fact']);

$taux =  number_format($maClasse-> getTauxFacture($_GET['ref_fact'])['roe_decl'], 4, ',', '.');
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
$poids = number_format($maClasse-> getDataDossiersMultipleInvoice($_GET['ref_fact'])['poids'], 2, ',', ' ');
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

if ($facture['id_cli']==864 || $facture['id_cli']==878 || $facture['id_cli']==876 || $facture['id_cli']==905 || $facture['id_cli']==904) {
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
}else if ($facture['id_cli']==875 || $facture['id_cli']==911 || $facture['id_cli']==901) {
	$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
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
					<td width="10%" style=" border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style=" border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK S.A</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT<br>
					&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI<br>
					&nbsp;EQUITY BCDC CONGO SA<br>
					&nbsp;LUBUMBASHI, R.D.CONGO</td>
					<td width="10%"></td>
				</tr>';
}else if ($facture['id_cli']==920) {
	$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00018 - 00016 - 01231051200 - 54</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;PRCBCDKI</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style=" border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style=" border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA, <br>LUBUMBASHI, R.D. CONGO</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT<br>
					&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI<br>
					&nbsp;EQUITY BCDC CONGO SA<br>
					&nbsp;LUBUMBASHI, R.D.CONGO</td>
					<td width="10%"></td>
				</tr>';
}else if ($facture['id_cli']==916) {
	$banque = '<tr>
					<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
					<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR RDC SARL</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00026  00004  35200002629  39</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;ECOCCDKI</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style=" border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
					<td width="35%" style=" border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;ECOBANK DRC</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
					<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00011-00130-00001020614-41</td>
					<td width="10%"></td>
				</tr>
				<tr>
					<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT<br>
					&nbsp;BANQUE</td>
					<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BCDCCDKI<br>
					&nbsp;EQUITY BCDC CONGO SA<br>
					&nbsp;LUBUMBASHI, R.D.CONGO</td>
					<td width="10%"></td>
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
		<br>
		<br>
		<tr>
			<td width="45%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">$type_note</td>
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
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;$type_note N.</td>
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
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Nombre de Dossier: </td>
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
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="6%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Unit</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Montant/USD</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Taux/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">TVA/USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220);text-align: center;">Total/USD</td>
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
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px solid black;" colspan="2" width="49%">&nbsp;&nbsp;$info_fact</td>
			<td style="text-align: center; border-right: 0.5px solid black;" colspan="2" width="6%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11%"></td>
			<td style="text-align: right; border-right: 0.5px solid black;" width="11.5%"></td>
			<td style="text-align: right; border-right: 1px solid black;" width="11.5%"></td>
		</tr>
		$detail_facture_transport
		<tr>
			<td width="100%"></td>
		</tr>
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