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

$pdf->Image('../images/malabar2.png', 11, 10, 110, '', '', '', '', false, 300);

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
$cif_cdf = number_format($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['cif']/$maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['roe_decl'], 2, ',', ' ');

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
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>TAXES AND DUTIES (a)</u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Value VAT not incl.</td>
			<td width="15%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;VAT (16%)</td>
			<td width="20%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Total Value</td>
		</tr>
		$taxe
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; font-size: 7px; background-color: rgb(192,192,192);" width="40%">S/Total(a)&nbsp;&nbsp;</td>
			$sommeTaxe
		</tr>
		<tr>
			<td colspan="4"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black;">&nbsp;<u>OTHER TAXES & TECHNICAL COSTS (b)</u></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192); text-align: center;">&nbsp;<u>Description</u></td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Value VAT not incl.</td>
			<td width="15%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;VAT (16%)</td>
			<td width="20%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);text-align: center;">&nbsp;Total Value</td>
		</tr>
		$transits
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; font-size: 7px; background-color: rgb(192,192,192);" width="40%">S/Total(b)&nbsp;&nbsp;</td>
			$sommeTransit
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;<u>AGENCY FEES (3)</u></td>
		</tr>
		$honoraire
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px solid black; border-bottom: 0.5px solid black; font-weight: bold; font-size: 7px; background-color: rgb(192,192,192);" width="40%">S/Total(c)&nbsp;&nbsp;</td>
			$sommeHonoraire
		</tr>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="35%"></td>
			<td style="text-align: center; border-bottom: 0.5px dotted black; border-right: 0.5px dotted black;" colspan="2" width="5%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="25%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="15%"></td>
			<td style="text-align: right; border-right: 1px solid black; border-bottom: 0.5px dotted black;" width="20%"></td>
		</tr>
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px; font-size: 7px;" width="40%">S/Total(a+b+c)&nbsp;&nbsp;</td>
			$totalAll
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="35%"></td>
			<td style="text-align: center; border-bottom: 0.5px dotted black; border-right: 0.5px dotted black;" colspan="2" width="5%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="25%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="15%"></td>
			<td style="text-align: right; border-right: 1px solid black; border-bottom: 0.5px dotted black;" width="20%"></td>
		</tr>
		<tr>
			<td style="text-align: right; border: 1px solid black; font-size: 10px;" width="80%">Total USD&nbsp;&nbsp;</td>
			$total
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; font-weight: bold; text-align: center; font-size: 8px;"><span style="color: blue;">$info_fact</span></td>
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; text-align: center;">Terme de payement : 1 Semaine après livraison de la Marchandise</td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;"><b><u>BANQUE POUR PAIEMENT</u></b></td>
		</tr>
		$banque
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center; font-weight: bold;">$qrcode</td>
		</tr>
	</table>
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');
/*$tbl2 = '';
include('../classes/connexion.php');
$requete = $connexion-> prepare("SELECT fd.ref_fact AS ref_fact
									FROM facture_dossier fd, detail_facture_dossier det, dossier dos
									WHERE fd.note_debit = '1'
										AND fd.ref_fact = det.ref_fact
										AND det.id_dos = dos.id_dos
										AND dos.ref_dos_2 = ?
									GROUP BY fd.ref_fact");
$requete-> execute(array($maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['ref_dos']));
while ($reponse=$requete-> fetch()) {
	
	$facture = $maClasse-> getDataFactureGlobale($reponse['ref_fact']);

	$ref_fact = $reponse['ref_fact'];//$maClasse-> getNumFactureEnCours($reponse['facture']);
	$date_fact = $maClasse-> getFactureGlobale($reponse['ref_fact'])['date_fact'];//$maClasse-> getDateFactureEnCours($reponse['facture']);
	$code_client = $maClasse-> getClientFacture($reponse['ref_fact'])['code_cli'];
	$nom_client = $maClasse-> getClientFacture($reponse['ref_fact'])['nom_cli'];
	//$adresse_client = htmlentities($facture['adresse_client'], ENT_QUOTES, "UTF-8");//$maClasse-> getAdresseClientFactureEnCours($reponse['facture']);
	$adresse_client = $maClasse-> getClientFacture($reponse['ref_fact'])['adr_cli'];//$maClasse-> getAdresseClientFactureEnCours($reponse['facture']);
	$transit = '';//$facture['transit'];//$maClasse-> getTransitFactureEnCours($reponse['facture']);
	$voie = '';//$facture['voie'];//$maClasse-> getVoieFactureEnCours($reponse['facture']);
	$marchandise = $maClasse-> getMarchandiseFacture($reponse['ref_fact'])['nom_march'];
	$fournisseur = $maClasse-> getFournisseurFacture($reponse['ref_fact'])['supplier'];
	$info_fact = $maClasse-> getFactureGlobale($reponse['ref_fact'])['information'];

	$taxe = $maClasse-> getDeboursFacturePartielle($reponse['ref_fact'], '1');
	$sommeTaxe = $maClasse-> getTotalDeboursFacturePartielle($reponse['ref_fact'], '1');

	$transits = $maClasse-> getDeboursFacturePartielle($reponse['ref_fact'], '2');
	$sommeTransit = $maClasse-> getTotalDeboursFacturePartielle($reponse['ref_fact'], '2');

	$honoraire = $maClasse-> getDeboursFacturePartielle($reponse['ref_fact'], '3');
	$sommeHonoraire = $maClasse-> getTotalDeboursFacturePartielle($reponse['ref_fact'], '3');

	$intervention = $maClasse-> getDeboursFacturePartielle($reponse['ref_fact'], '4');
	$sommeIntervention = $maClasse-> getTotalDeboursFacturePartielle($reponse['ref_fact'], '4');

	$totalAll = $maClasse-> getTotalAllDeboursFacturePartielle($reponse['ref_fact']);

	$total = $maClasse-> getTotalForFacturePartielle($reponse['ref_fact']);
	$arsp = $maClasse-> getARSPForFacturePartielle($reponse['ref_fact']);

	$taux = $maClasse-> getTauxFacture($reponse['ref_fact'])['roe_decl'];

	$nom_bur_douane = $maClasse-> getBureauDouane($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['bur_douane'])['nom_bur_douane'];
	$nif_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['id_cli'])['nif_cli'];
	$rccm_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['id_cli'])['rccm_cli'];
	$adr_cli = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['id_cli'])['adr_cli'];
	$id_nat = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['id_cli'])['id_nat'];
	$num_imp_exp = $maClasse-> getClient($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['id_cli'])['num_imp_exp'];

	$reg_dgda = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['reg_dgda'];
	$bur_douane = $maClasse-> getDataDossierFacturePartielle($_GET['ref_fact'])['bur_douane'];
	$commodity = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['commodity'];
	$ref_dos = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['ref_dos'];
	$supplier = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['supplier'];
	$ref_decl = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['ref_decl'];
	$date_decl = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['date_decl'];
	$ref_liq = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['ref_liq'];
	$date_liq = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['date_liq'];
	$ref_quit = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['ref_quit'];
	$date_quit = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['date_quit'];
	$poids = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['poids'], 2, ',', ' ');
	$road_manif = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['road_manif'];
	$po_ref = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['po_ref'];
	$ref_fact_dos = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['ref_fact'];
	$horse = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['horse'];
	$trailer_1 = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['trailer_1'];
	$trailer_2 = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['trailer_2'];
	$num_lic = $maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['num_lic'];
	$roe_decl = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['roe_decl'], 4, ',', ' ');
	$fob = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['fob'], 2, ',', ' ');
	$fret = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['fret'], 2, ',', ' ');
	$assurance = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['assurance'], 2, ',', ' ');
	$autre_frais = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['autre_frais'], 2, ',', ' ');
	$cif = number_format($maClasse-> getDataDossierFacturePartielle($reponse['ref_fact'])['cif'], 2, ',', ' ');
	
	if ( ($maClasse-> getFactureGlobale($_GET['ref_fact'])['validation']) == '0' ) {
		//$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
		$validation = '<img src="../images/no_valid.jpg" width="80px;">';
	}else{
		$validation = '';
	}
	
	$tbl2 .= <<<EOD
    <html>
    <head>
        <meta http-equiv = " content-type " content = " text/html; charset=utf-8" />
    </head>
    <body style="font-weight: bold;">
	<table>
	<br pagebreak="true"/>
		<tr>
			<td width="80%"></td>
			<td width="20% font-weight: bold;">$validation</td>
		</tr>
		<tr>
			<td width="40%" rowspan="3"><img src="../images/logo.jpg"></td>
			<td width="5%" style="text-align: center;"><br><br></td>
		</tr>
		<tr>
			<td width="5%" style="text-align: center;"></td>
			<td width="55%" style="text-align: center; font-weight: bold; font-size: 12px; border: 1px solid black;"><span>NOTE DE DEBIT $ref_fact</span></td>
		</tr>
		<tr>
			<td width="5%" style="text-align: center;"></td>
			<td width="55%" style="text-align: center;"></td>
		</tr>

		<tr>
			<td width="45%" style="text-align: center; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black;">354 AV DE LA REVOLUTION, Q/BAUDOUIN</td>
			<td width="14%" style="text-align: right; font-weight: bold;">Date Facture: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$date_fact</b></td>
			<td width="12%" style="text-align: right;">Ref. Dossier: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$ref_dos</b></td>
		</tr>
		<tr>
			<td width="45%" style="text-align: center;border-left: 1px solid black; border-right: 1px solid black;">LUBUMBASHI - HAUT-KATANGA /DR CONGO</td>
			<td width="14%" style="text-align: right;">Déclaration Place: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">$bur_douane</td>
			<td width="12%" style="text-align: right;">Marchandises: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$commodity</b></td>
		</tr>
		<tr>
			<td width="45%" style="text-align: center;border-left: 1px solid black; border-right: 1px solid black;">RCCM/14-B-1544, ID.NAT : 6-718-N71657E , NIF A1301315U</td>
			<td width="14%" style="text-align: right;">Régime: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$reg_dgda</b></td>
			<td width="12%" style="text-align: right;">Supplier: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$supplier</b></td>
		</tr>
		<tr>
			<td width="45%" style="text-align: center;border-left: 1px solid black; border-right: 1px solid black; border-bottom: 1px solid black;">INTITULE COMPTE: DOUANE EXPRESS CUSTOMS SPRL</td>
			<td width="14%" style="text-align: right;">Déclaration N.: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$ref_decl</b></td>
			<td width="12%" style="text-align: right;">Weight: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$poids</b></td>
		</tr>
		<tr>
			<td width="45%" style="text-align: left;"></td>
			<td width="14%" style="text-align: right;">Déclaration Date: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$date_decl</b></td>
			<td width="12%" style="text-align: right;">Road Manifest: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$road_manif</b></td>
		</tr>
		<tr>
			<td width="20%" style="text-align: center; border-top: 1px solid black; border-left: 1px solid black; font-size: 8px; text-decoration: underline;"><b>$nom_client</b></td>
			<td width="0.5%" style="text-align: left; border-top: 1px solid black;"></td>
			<td width="24.5%" style="text-align: left; border-top: 1px solid black; border-right: 1px solid black;">RCCM: $rccm_cli</td>
			<td width="14%" style="text-align: right;">Liquidation N.: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$ref_liq</b></td>
			<td width="12%" style="text-align: right;">P.O Number: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$po_ref</b></td>
		</tr>
		<tr>
			<td width="20%" rowspan="4" style="text-align: center; border-left: 1px solid black; border-bottom: 1px solid black;">$adr_cli</td>
			<td width="0.5%" style="text-align: left;"></td>
			<td width="24.5%" style="text-align: left;border-right: 1px solid black;">NIF: $nif_cli</td>
			<td width="14%" style="text-align: right;">Liquidation Date: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$date_liq</b></td>
			<td width="12%" style="text-align: right;">Invoice Number: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$ref_fact_dos</b></td>
		</tr>
		<tr>
			<td width="0.5%" style="text-align: left;"></td>
			<td width="24.5%" style="text-align: left;border-right: 1px solid black;">ID Nat.: $id_nat</td>
			<td width="14%" style="text-align: right;">Quittance N.: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$ref_quit</b></td>
			<td width="12%" style="text-align: right;">Truck Number: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$horse</b></td>
		</tr>
		<tr>
			<td width="0.5%" style="text-align: left;"></td>
			<td width="24.5%" style="text-align: left;border-right: 1px solid black;">Imp/Exp: $num_imp_exp</td>
			<td width="14%" style="text-align: right;">Quittance Date: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$date_quit</b></td>
			<td width="12%" style="text-align: right;">Trailer Number: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$trailer_1</b> / $trailer_2</td>
		</tr>
		<tr>
			<td width="0.5%" style="text-align: left; border-bottom: 1px solid black;"></td>
			<td width="24.5%" style="text-align: left;border-right: 1px solid black; border-bottom: 1px solid black;"></td>
			<td width="14%" style="text-align: right;">Taux Fact.: &nbsp;</td>
			<td width="8%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$roe_decl</b></td>
			<td width="12%" style="text-align: right;">Licence N.: &nbsp;</td>
			<td width="20%" style="text-align: left; border: 0.5px solid black; font-weight: bold;">&nbsp;<b>$num_lic</b></td>
		</tr>
		<tr>
			<td width="100%"><br></td>
		</tr>
		<tr>
			<td width="45%" style=""></td>
			<td width="14%" style="text-align: right; border: 0.5px solid black;">Autres Couts: &nbsp;</td>
			<td width="13%" style="text-align: right; border: 0.5px solid black; font-weight: bold;">$autre_frais &nbsp;</td>
			<td width="27%" style=""></td>
		</tr>
		<tr>
			<td width="11%" style="text-align: right; border: 0.5px solid black;">Valeur FOB: &nbsp;</td>
			<td width="11.5%" style="text-align: right; border: 0.5px solid black; font-weight: bold;">$fob &nbsp;</td>
			<td width="11%" style="text-align: right; border: 0.5px solid black;">Valeur Fret: &nbsp;</td>
			<td width="11.5%" style="text-align: right; border: 0.5px solid black; font-weight: bold;">$fret &nbsp;</td>
			<td width="14%" style="text-align: right; border: 0.5px solid black;">Assurance: &nbsp;</td>
			<td width="13%" style="text-align: right; border: 0.5px solid black; font-weight: bold;">$assurance &nbsp;</td>
			<td width="4%" style=""></td>
			<td width="10%" style="text-align: right; border: 0.5px solid black;">Valeur CIF: &nbsp;</td>
			<td width="13%" style="text-align: right; border: 0.5px solid black; font-weight: bold;">$cif &nbsp;</td>
		</tr>
		<tr>
			<td width="100%"><br></td>
		</tr>
		<tr>
			<td width="40%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;<u>DISBURSMENTS (1) TAXES AND DUTIES (a)</u></td>
			<td width="25%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;Value VAT not incl.</td>
			<td width="15%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;VAT (16%)</td>
			<td width="20%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;Total Value</td>
		</tr>
		$taxe
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px;" width="40%">S/Total(a)&nbsp;&nbsp;</td>
			$sommeTaxe
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;<u>DISBURSMENTS (1) TRANSIT (b)</u></td>
		</tr>
		$transits
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px;" width="40%">S/Total(b)&nbsp;&nbsp;</td>
			$sommeTransit
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;<u>INTERVENTIONS (2)</u></td>
		</tr>
		$intervention
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px;" width="40%">S/Total(c)&nbsp;&nbsp;</td>
			$sommeIntervention
		</tr>
		<tr>
			<td width="100%" style="font-weight: bold; border: 1px solid black; background-color: rgb(192,192,192);">&nbsp;<u>AGENCY FEES (3)</u></td>
		</tr>
		$honoraire
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px;" width="40%">S/Total(d)&nbsp;&nbsp;</td>
			$sommeHonoraire
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="35%"></td>
			<td style="text-align: center; border-bottom: 0.5px dotted black; border-right: 0.5px dotted black;" colspan="2" width="5%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="20%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="20%"></td>
			<td style="text-align: right; border-right: 1px solid black; border-bottom: 0.5px dotted black;" width="20%"></td>
		</tr>
		<tr>
			<td style="text-align: right; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black; font-weight: bold; font-size: 7px; font-size: 7px;" width="40%">S/Total(a+b+c+d)&nbsp;&nbsp;</td>
			$totalAll
		</tr>
		<tr>
			<td style="text-align: left; border-left: 1px solid black; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="35%"></td>
			<td style="text-align: center; border-bottom: 0.5px dotted black; border-right: 0.5px dotted black;" colspan="2" width="5%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="20%"></td>
			<td style="text-align: right; border-right: 0.5px dotted black; border-bottom: 0.5px dotted black;" width="20%"></td>
			<td style="text-align: right; border-right: 1px solid black; border-bottom: 0.5px dotted black;" width="20%"></td>
		</tr>
		<tr>
			<td style="text-align: right; border: 1px solid black; font-size: 10px;" width="80%">Total USD&nbsp;&nbsp;</td>
			$total
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td style="text-align: right; border: 1px solid black; font-weight: bold;" width="80%">Frais Redevance ARSP (USD)&nbsp;&nbsp;</td>
			$arsp
		</tr>
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="border-left: 1px solid black;border-top: 1px solid black;border-right: 1px solid black; font-weight: bold;">Douane Express Customs ne peut être tenue responsable en cas de sinistre survenu aux marchandises (vol, casse, manquant, etc.)<br>Il appartient au client d'assurer sa marchandise auprès de l'assureur de son choix ou d'en faire une demande par écrit au préalable à Douane Express Customs. </td>
		</tr>
		<tr>
			<td width="100%" style="border: 1px solid black; text-align: center;">Terme de payement : 1 Semaine après livraison de la Marchandise</td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center;border-left: 1px solid black;border-right: 1px solid black;"><b><u>BANQUE POUR PAIEMENT</u></b></td>
		</tr>
		$banque
		<tr>
			<td><br></td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center; font-weight: bold;">$qrcode</td>
		</tr>
	</table>
	</body>
	</html>
        
EOD;
$pdf->writeHTML($tbl2, true, false, false, false, '');

}$requete-> closeCursor();*/

//$tbl .= $tbl2;
//$pdf->writeHTML($tbl, true, false, false, false, '');
//$pdf->writeHTML($tbl2, true, false, false, false, '');

// Clean any content of the output buffer
ob_end_clean();

$pdf->Output($_GET['ref_fact'].'.pdf', 'I');

  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+