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

require_once('../tcpdf/tcpdf.php');


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set margins
$pdf->SetMargins(2,5 ,2);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Facture '.$_POST['ref_fact']);
$pdf->SetSubject('act');
$pdf->SetKeywords('act');


//Qrcode de la facture
//On verifie si le QrCode existe deja
// $ref_fact = str_replace(' ', '', str_replace('/', '_', $_POST['ref_fact']));
// if(file_exists('../qrcode/'. $ref_fact.'.png')){
//     //$qrcode = '../qrcode/'.$ref_mvt.'.png';
//     $qrcode = '<img src="../qrcode/'.$ref_fact.'.png" width="30px">';
// }else{
//     echo '<script>window.location="../qrcode/generateur.php?ref_fact='.$ref_fact.'&type=facturePartielle";</script>';
//     //header('Location: ../qrcode/generateurBonCaisse.php?id_cais='.$_POST['id_cais'].'&ref_mvt='.$ref_mvt.'&lang='.$_POST['lang']);
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

$pdf->Image('../images/malabar2.png', 2, 10, 110, '', '', '', '', false, 300);

if ( ($maClasse-> getFactureGlobale($_POST['ref_fact'])['validation']) == '0' ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	$pdf->Image('../images/sceau_mca.png', 90, 247, 50, '', '', '', '', false, 300);
	$sceau = '<img src="../images/sceau_mca.png" width="210px">';
	// if ($maClasse-> getFactureGlobale($_POST['ref_fact'])['id_cli'] != '906' && $maClasse-> getFactureGlobale($_POST['ref_fact'])['id_cli'] != '902') {
	// 	$pdf->Image('../images/sceau.png', 50, 200, 105, '', '', '', '', false, 300);
	// }
	
}

if(isset($_POST['ref_fact'])){

	if ($maClasse-> getFactureGlobale($_POST['ref_fact'])['id_cli'] == '887' || $maClasse-> getFactureGlobale($_POST['ref_fact'])['id_cli'] == '885') {
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

	
$facture = $maClasse-> getDataFactureGlobale($_POST['ref_fact']);

$ref_fact = $_POST['ref_fact'];//$maClasse-> getNumFactureEnCours($_POST['facture']);
$date_fact = $maClasse-> getFactureGlobale($_POST['ref_fact'])['date_fact'];//$maClasse-> getDateFactureEnCours($_POST['facture']);
$code_client = $maClasse-> getClientFacture($_POST['ref_fact'])['code_cli'];
$nom_client = $maClasse-> getClientFacture($_POST['ref_fact'])['nom_cli'];

if ($maClasse-> getFactureGlobale($_POST['ref_fact'])['note_debit'] == '1') {
	$note_debit = 'NOTE DE DEBIT';
}else{
	$note_debit = '';
}

//$adresse_client = htmlentities($facture['adresse_client'], ENT_QUOTES, "UTF-8");//$maClasse-> getAdresseClientFactureEnCours($_POST['facture']);
$adresse_client = $maClasse-> getClientFacture($_POST['ref_fact'])['adr_cli'];//$maClasse-> getAdresseClientFactureEnCours($_POST['facture']);
$transit = '';//$facture['transit'];//$maClasse-> getTransitFactureEnCours($_POST['facture']);
$voie = '';//$facture['voie'];//$maClasse-> getVoieFactureEnCours($_POST['facture']);
$marchandise = $maClasse-> getMarchandiseFacture($_POST['ref_fact'])['nom_march'];
$fournisseur = $maClasse-> getFournisseurFacture($_POST['ref_fact'])['supplier'];
$info_fact = $maClasse-> getFactureGlobale($_POST['ref_fact'])['information'];

$taxe = $maClasse-> getDetailFactureExportSingle($_POST['ref_fact'], '1');

$autres_charges = $maClasse-> getDetailFactureExportSingle($_POST['ref_fact'], '2');

$operational_cost = $maClasse-> getDetailFactureExportSingle($_POST['ref_fact'], '3');

$service_fee = $maClasse-> getDetailFactureExportSingle($_POST['ref_fact'], '4');

$totalAll = $maClasse-> getTotalFactureExportSingle($_POST['ref_fact']);

$total = $maClasse-> getTotalForFacturePartielle($_POST['ref_fact']);
$arsp = $maClasse-> getARSPForFacturePartielle($_POST['ref_fact']);

$taux =  number_format($maClasse-> getTauxFacture($_POST['ref_fact'])['roe_decl'], 4, ',', '.');
$totalHT = number_format($maClasse-> getTotalHTFacture($_POST['ref_fact']), 2, ',', ' ');
$totalTVA = number_format($maClasse-> getTotalTVAFacture($_POST['ref_fact']), 2, ',', ' ');
$totalTTC = number_format(($maClasse-> getTotalTVAFacture($_POST['ref_fact'])+$maClasse-> getTotalHTFacture($_POST['ref_fact'])), 2, ',', ' ');

$nom_bur_douane = $maClasse-> getBureauDouane($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['bur_douane'])['nom_bur_douane'];
$nif_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_cli'])['nif_cli'];
$rccm_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_cli'])['rccm_cli'];
$adr_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_cli'])['adr_cli'];
$id_nat = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_cli'])['id_nat'];
$num_imp_exp = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_cli'])['num_imp_exp'];

$nom_mod_trans = $maClasse-> getModeTransport($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['id_mod_trans'])['nom_mod_trans'];
$reg_dgda = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['reg_dgda'];
$load_date = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['load_date'];
$exit_drc = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['exit_drc'];
$bur_douane = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['bur_douane'];
$commodity = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['commodity'];
$ref_dos = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_dos'];
$supplier = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['supplier'];
$ref_decl = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_decl'];
$date_decl = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['date_decl'];
$ref_liq = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_liq'];
$date_liq = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['date_liq'];
$ref_quit = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_quit'];
$date_quit = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['date_quit'];
$ref_crf = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_crf'];
$poids = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['poids'], 2, ',', ' ');
$road_manif = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['road_manif'];
$num_lot = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['num_lot'];
$ref_fact_dos = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['ref_fact'];
$po_ref = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['po_ref'];
$horse = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['horse'];
$trailer_1 = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['trailer_1'];
$trailer_2 = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['trailer_2'];
$num_lic = $maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['num_lic'];
$roe_decl = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['roe_decl'], 4, ',', ' ');
$fob = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['fob'], 2, ',', ' ');
$fret = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['fret'], 2, ',', ' ');
$assurance = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['assurance'], 2, ',', ' ');
$autre_frais = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['autre_frais'], 2, ',', ' ');
$cif = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['cif'], 2, ',', ' ');
$cif_cdf = number_format($maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['cif']*$maClasse-> getDataDossierFacturePartielle($_POST['ref_fact'])['roe_decl'], 2, ',', ' ');

$banque = '<tr>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
			<td width="10%"></td>
			<td width="10%" style="border-top: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;INTITULE</td>
			<td width="35%" style="border-top: 1px solid black; border-right: 1px solid black;  font-size: 7px;">&nbsp;MALABAR CLEARING AGENCY SARL</td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;00130-00001020614-41</td>
			<td width="10%"></td>
			<td width="10%" style="border-left: 1px solid black;  font-size: 7px;">&nbsp;N.COMPTE</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;05100-05130-01003333601-20</td>
		</tr>
		<tr>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;PRCBCDKI</td>
			<td width="10%"></td>
			<td width="10%" style="border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;SWIFT</td>
			<td width="35%" style="border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBCDKIXXX</td>
		</tr>
		<tr>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;EQUITY BANK CONGO SA		
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
			<td width="10%"></td>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK
			<br>&nbsp;LUBUMBASHI		
			<br>&nbsp;R.D. CONGO</td>
		</tr>';

if ($facture['id_cli']==864 || $facture['id_cli']==878 || $facture['id_cli']==876 || $facture['id_cli']==905) {
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
			<td width="40%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">FACTURE</td>
		</tr>
		<br>
		<tr>
			<td width="40%" rowspan="13" style="text-align: left; border: 0.3px solid black;"><span><u>CLIENT</u></span>
			<br><b>$nom_client </b>
			<br>$adresse_client</td>
			<td width="20%" style="text-align: center;"></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;N.FACTURE</td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$ref_fact</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: center;"></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Date</td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$date_fact</td>
		</tr>

		<tr>
			<td width="60%" style=""></td>
		</tr>

		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;File Ref.: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_dos</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Num.Lot: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$num_lot</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Num.Licence: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$num_lic</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Weight(Mt): </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$poids</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Loading Date: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$load_date</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-size: 7px;">&nbsp;Clearing Complete Date: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$exit_drc</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Declaration: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_decl du $date_decl</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Liquidation: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_liq du $date_liq</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Quittance: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$ref_quit du $date_quit</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: left; "></td>
			<td width="18%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Rate(CDF/USD) BCC: </td>
			<td width="22%" style="text-align: center; border: 0.3px solid black; font-size: 7px; font-weight: bold;">$taux</td>
		</tr>

		<tr>
			<td width="100%"><br></td>
		</tr>

		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>CUSTOMS CLEARANCE FEES / FRAIS DEDOUANEMENT</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Unit</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">COST /USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TOTAL  EN USD</td>
		</tr>
		$taxe
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OTHER CHARGES / AUTRES FRAIS </u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Unit</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">COST /USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TOTAL  EN USD</td>
		</tr>
		$autres_charges
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OPERATIONAL COSTS / COUT OPERATIONEL</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Unit</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">COST /USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TOTAL  EN USD</td>
		</tr>
		$operational_cost
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>SERVICE FEE / SERVICES</u></td>
		</tr>
		<tr>
			<td width="49%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Unit</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">COST /USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">SUBTOTAL  USD</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TVA- 16%</td>
			<td width="11.5%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">TOTAL  EN USD</td>
		</tr>
		$service_fee
		<tr>
			<td width="100%"></td>
		</tr>
		$totalAll
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style=" font-size: 7px;">
			VEUILLEZ TROUVER CI-DESSOUS LES DETAILS DE NOTRE COMPTE BANCAIRE
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
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
// Clean any content of the output buffer
ob_end_clean();

// $pdf->Output($_POST['ref_fact'].'.pdf', 'I');

$pdf->Output('../facture_dossier/'.$_POST['ref_fact'].'.pdf', 'F');
  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+