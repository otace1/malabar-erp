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
$pdf->SetMargins(6,10 ,4);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Debit Note '.$_GET['ref_note']);
$pdf->SetSubject('act');
$pdf->SetKeywords('act');


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

$pdf->Image('../images/malabar2.png', 5, 10, 110, '', '', '', '', false, 300);
$sceau='';
if ( !($maClasse-> getNote($_GET['ref_note'])['id_util_validation']) ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	if (!empty($maClasse-> getDataUtilisateur($maClasse-> getNote($_GET['ref_note'])['id_util_validation'])['signature_facture'])) {
		$sceau = '<img src="../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getNote($_GET['ref_note'])['id_util_validation'])['signature_facture'].'" width="'.$maClasse-> getDataUtilisateur($maClasse-> getNote($_GET['ref_note'])['id_util_validation'])['size_signature_facture'].'">';
	}
	
}

if(isset($_GET['ref_note'])){

	if ($maClasse-> getNote($_GET['ref_note'])['id_cli'] == '887' || $maClasse-> getNote($_GET['ref_note'])['id_cli'] == '885') {
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
	
$data_note_debit = $maClasse-> getNote($_GET['ref_note']);
$dossiers ='';// $maClasse-> getDossierFactureExportSingle($_GET['ref_note']);

$ref_note = $_GET['ref_note'];//$maClasse-> getNumFactureEnCours($_GET['facture']);

// if ($maClasse-> getNote($_GET['ref_note'])['tax_duty_part']=='Exclude') {
// 	header("Location: viewImportInvoiceSingle2023ExcluDuty.php?ref_note=$ref_note");
// }

$date_note = $maClasse-> getNote($_GET['ref_note'])['date_note'];//$maClasse-> getDateFactureEnCours($_GET['facture']);
$code_client = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['code_cli'];
$nom_client = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['nom_cli'];
$nom_complet = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['nom_complet'];

$note_debit = 'NOTE DE DEBIT';

$detail_note_debit = $maClasse-> getDetailNoteDebitKAMOAImport($_GET['ref_note']);

$nif_cli = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['nif_cli'];
$rccm_cli = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['rccm_cli'];
$adr_cli = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['adr_cli'];
$id_nat = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['id_nat'];
$num_imp_exp = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['num_imp_exp'];
$num_tva = $maClasse-> getClient($maClasse-> getNote($_GET['ref_note'])['id_cli'])['num_tva'];

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
			, R.D. CONGO</td>
			<td width="10%"></td>
			<td width="10%" style="border-bottom: 1px solid black; border-left: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;BANQUE</td>
			<td width="35%" style="border-bottom: 1px solid black; border-right: 1px solid black; text-align: left;  font-size: 7px;">&nbsp;RAWBANK
			<br>&nbsp;LUBUMBASHI		
			, R.D. CONGO</td>
		</tr>';

if ($data_note_debit['id_cli']==878 || $data_note_debit['id_cli']==876) {
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
}else if ($data_note_debit['id_cli']==864 || $data_note_debit['id_cli']==899 || $data_note_debit['id_cli']==916 || $data_note_debit['id_cli']==906 || $data_note_debit['id_cli']==901 || $data_note_debit['id_cli']==932 || $data_note_debit['id_cli']==856 || $data_note_debit['id_cli']==923 || $data_note_debit['id_cli']==905 || $data_note_debit['id_cli']==912 || $data_note_debit['id_cli']==927 || $data_note_debit['id_cli']==869 || $data_note_debit['id_cli']==919 || $data_note_debit['id_cli']==922 || $data_note_debit['id_cli']==934 || $data_note_debit['id_cli']==879 || $data_note_debit['id_cli']==859 || $data_note_debit['id_cli']==938 || $data_note_debit['id_cli']==903 || $data_note_debit['id_cli']==918 || $data_note_debit['id_cli']==925 || $data_note_debit['id_cli']==914) {
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
}else if ($data_note_debit['id_cli']==857) {
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
			<td width="45%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">NOTE DE DEBIT</td>
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
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px; font-weight: bold;">&nbsp;NOTE DE DEBIT Nº</td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 7px;">$ref_note</td>
		</tr>
		<tr>
			<td width="15%" style="text-align: center;"></td>
			<td width="15%" style="text-align: left; border: 0.3px solid black; font-size: 7px;">&nbsp;Date</td>
			<td width="25%" style="text-align: center; border: 0.3px solid black; font-size: 7px;">$date_note</td>
		</tr>

		<tr>
			<td width="15%" style="text-align: center;"></td>
		</tr>

		<tr>
			<td width="15%" style="text-align: center;"></td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
		</tr>

		<tr>
			<td width="15%" style="text-align: left; "></td>
		</tr>
		<tr>
			<td width="15%" style="text-align: left; "></td>
		</tr>

		<tr>
			<td width="100%"></td>
		</tr>
	</table>
	<table  cellpadding="3">

		<tr>
			<td width="50%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px; text-align: center;">&nbsp;<u>Description</u></td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Applicable</td>
			<td width="15%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Taux/USD</td>
			<td width="10%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">TVA/USD</td>
			<td width="15%" style="font-weight: bold; border: 1px solid black; background-color: rgb(220,220,220); font-size: 7px;text-align: center;">Total/USD</td>
		</tr>
	</table>
	<table  cellpadding="2">
		$detail_note_debit
	</table>
	<table>
		<tr>
			<td width="100%"></td>
		</tr>
		<tr>
			<td width="50%" style="text-align: center;">$sceau
			</td>
			<td width="50%">
			</td>
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

$pdf->Output($_GET['ref_note'].'.pdf', 'I');

  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+