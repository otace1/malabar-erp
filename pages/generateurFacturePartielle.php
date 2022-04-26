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
$pdf->SetMargins(2,5 ,2);


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
//$pdf->SetFont('times', 'N', 8);
$pdf->SetFont('courier', 'N', 8);
$pdf->setPrintHeader(false);
// add a page
$pdf->AddPage('P', 'A4');

$pdf->Image('../images/malabar2.png', 2, 10, 110, '', '', '', '', false, 300);

if ( ($maClasse-> getFactureGlobale($_GET['ref_fact'])['validation']) == '0' ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
	$sceau = '';//'<img src="../images/sceau.png" width="210px">';
}else{
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

	
$facture = $maClasse-> getDataFactureGlobale($_GET['ref_fact']);

$ref_fact = $_GET['ref_fact'];//$maClasse-> getNumFactureEnCours($_GET['facture']);
$date_fact = $maClasse-> getFactureGlobale($_GET['ref_fact'])['date_fact'];//$maClasse-> getDateFactureEnCours($_GET['facture']);
$code_client = $maClasse-> getClientFacture($_GET['ref_fact'])['code_cli'];
$nom_client = $maClasse-> getClientFacture($_GET['ref_fact'])['nom_cli'];

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

$taxe = $maClasse-> getDeboursFacturePartielle($_GET['ref_fact'], '1');
$sommeTaxe = $maClasse-> getTotalDeboursFacturePartielle($_GET['ref_fact'], '1');

$transits = $maClasse-> getDeboursFacturePartielle($_GET['ref_fact'], '2');
$sommeTransit = $maClasse-> getTotalDeboursFacturePartielle($_GET['ref_fact'], '2');

$honoraire = $maClasse-> getDeboursFacturePartielle($_GET['ref_fact'], '3');
$sommeHonoraire = $maClasse-> getTotalDeboursFacturePartielle($_GET['ref_fact'], '3');

$intervention = $maClasse-> getDeboursFacturePartielle($_GET['ref_fact'], '4');
$sommeIntervention = $maClasse-> getTotalDeboursFacturePartielle($_GET['ref_fact'], '4');

$totalAll = $maClasse-> getTotalAllDeboursFacturePartielle($_GET['ref_fact']);

$total = $maClasse-> getTotalForFacturePartielle($_GET['ref_fact']);
$arsp = $maClasse-> getARSPForFacturePartielle($_GET['ref_fact']);

$taux = $maClasse-> getTauxFacture($_GET['ref_fact'])['roe_decl'];
$totalHT = number_format($maClasse-> getTotalHTFacture($_GET['ref_fact']), 2, ',', ' ');
$totalTVA = number_format($maClasse-> getTotalTVAFacture($_GET['ref_fact']), 2, ',', ' ');
$totalTTC = number_format(($maClasse-> getTotalTVAFacture($_GET['ref_fact'])+$maClasse-> getTotalHTFacture($_GET['ref_fact'])), 2, ',', ' ');

$nom_bur_douane = $maClasse-> getBureauDouane($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['bur_douane'])['nom_bur_douane'];
$nif_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_cli'])['nif_cli'];
$rccm_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_cli'])['rccm_cli'];
$adr_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_cli'])['adr_cli'];
$id_nat = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_cli'])['id_nat'];
$num_imp_exp = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_cli'])['num_imp_exp'];

$nom_mod_trans = $maClasse-> getModeTransport($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['id_mod_trans'])['nom_mod_trans'];
$reg_dgda = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['reg_dgda'];
$bur_douane = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['bur_douane'];
$commodity = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['commodity'];
$ref_dos = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_dos'];
$supplier = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['supplier'];
$ref_decl = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_decl'];
$date_decl = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['date_decl'];
$ref_liq = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_liq'];
$date_liq = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['date_liq'];
$ref_quit = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_quit'];
$date_quit = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['date_quit'];
$ref_crf = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_crf'];
$poids = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['poids'], 2, ',', ' ');
$road_manif = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['road_manif'];
$po_ref = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['po_ref'];
$ref_fact_dos = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_fact'];
$po_ref = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['po_ref'];
$horse = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['horse'];
$trailer_1 = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['trailer_1'];
$trailer_2 = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['trailer_2'];
$num_lic = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['num_lic'];
$roe_decl = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['roe_decl'], 4, ',', ' ');
$fob = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['fob'], 2, ',', ' ');
$fret = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['fret'], 2, ',', ' ');
$assurance = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['assurance'], 2, ',', ' ');
$autre_frais = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['autre_frais'], 2, ',', ' ');
$cif = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['cif'], 2, ',', ' ');
$cif_cdf = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['cif']*$maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['roe_decl'], 2, ',', ' ');

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
			VAT Ref # 886/2012<br>
			Capital Social : 45.000.000 FC
			</td>
		</tr>
		<br>
		<br>
		<br>
		<tr>
			<td width="40%" rowspan="3" style="text-align: left;"><span><b><u>Client Name</u></b></span>
			<br>$nom_client 
			<br>$adresse_client</td>
			<td width="20%" style="text-align: center;"></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;Invoice No.</td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$ref_fact</td>
		</tr>
		<tr>
			<td width="20%" style="text-align: center;"></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;Invoice Date</td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$date_fact</td>
		</tr>

		<tr>
			<td width="20%" style="text-align: center;"></td>
			<td width="15%" style="text-align: left; "></td>
			<td width="25%" style="text-align: left; "></td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;Weight(kg)</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$poids &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;Rate(CDF/USD) BCC: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$taux</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;FOB</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$fob &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;VAT: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;16%</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;Freight</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$fret &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;Mode of transport: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$nom_mod_trans</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;Insurance</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$assurance &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;PO Number: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$po_ref</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;Other charges</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$autre_frais &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;Invoice/PFI No.: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$ref_fact_dos</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;CIF</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$cif &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" rowspan="2" style="text-align: left; border: 0.3px solid black;">&nbsp;Product: </td>
			<td width="20%" rowspan="2" style="text-align: left; border: 0.3px solid black;">$commodity</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; border: 0.3px solid black;">&nbsp;CIF/CDF</td>
			<td width="20%" style="text-align: right; border: 0.3px solid black;">$cif_cdf &nbsp;</td>
			<td width="25%" style="text-align: left; "></td>
		</tr>
		<tr>
			<td width="15%" style=""></td>
			<td width="20%" style=""></td>
			<td width="25%" style="text-align: left; "></td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;COD BIVAC: </td>
			<td width="20%" style="text-align: left; border: 0.3px solid black;">&nbsp;$ref_crf</td>
		</tr>

		<tr>
			<td width="100%"><br></td>
		</tr>

		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>TAXES AND DUTIES </u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Unit</td>
			<td width="4%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Qty</td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Value VAT not incl.</td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;VAT (16%)</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Total Value</td>
		</tr>
		$taxe
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; background-color: rgb(192,192,192);" width="40%">Sub-Total&nbsp;&nbsp;</td>
			$sommeTaxe
		</tr>
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OTHER TAXES & TECHNICAL COSTS </u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Unit</td>
			<td width="4%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Qty</td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Value VAT not incl.</td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;VAT (16%)</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Total Value</td>
		</tr>
		$transits
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; background-color: rgb(192,192,192);" width="40%">Sub-Total&nbsp;&nbsp;</td>
			$sommeTransit
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OPERATIONS COST/AGENCY FEE</u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Unit</td>
			<td width="4%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">Qty</td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Value VAT not incl.</td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;VAT (16%)</td>
			<td width="11%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Total Value</td>
		</tr>
		$honoraire
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; background-color: rgb(192,192,192);" width="40%">Sub-Total(c)&nbsp;&nbsp;</td>
			$sommeHonoraire
		</tr>

		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td style="" width="65%"></td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black;" width="15%">Total excl. TVA&nbsp;&nbsp;</td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black;" width="20%">
				$totalHT&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td style="" width="65%"></td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black;" width="15%">TVA 16%&nbsp;&nbsp;</td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black;" width="20%">
				$totalTVA&nbsp;&nbsp;
			</td>
		</tr>
		<tr>
			<td style="" width="65%"></td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black; font-weight: bold;" width="15%">Grand Total&nbsp;&nbsp;</td>
			<td style="text-align: right; border: 0.5px solid black; border-bottom: 0.5px dotted black; font-weight: bold;" width="20%">
				$totalTTC&nbsp;&nbsp;
			</td>
		</tr>

		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; font-size: 7px;">
			VEUILLEZ TROUVER CI-DESSOUS LES DETAILS DE NOTRE COMPTE BANCAIRE
			</td>
		</tr>
		<tr>
			<td width="65%" style="border: 1px solid black; font-weight: bold; text-align: left; font-size: 8px;">
			&nbsp;INTITULE <br>
			&nbsp;N.COMPTE <br>
			&nbsp;SWIFT <br>
			&nbsp;BANQUE <br>
			</td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="65%" style="font-weight: bold; font-size: 7px;">
			LE PAIEMENT DOIT S'EFFECTUER ENDEANS 7 JOURS
			</td>
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; text-align: center;">Thank you for you business!</td>
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