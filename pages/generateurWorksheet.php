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
$pdf->SetTitle('Feuille de calcul '.$_GET['ref_dos']);
$pdf->SetSubject('act');
$pdf->SetKeywords('act');

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
$pdf->AddPage('L', 'A4');

$pdf->Image('../images/malabar2.png', 4, 10, 110, '', '', '', '', false, 300);
$sceau='';
if ( empty($maClasse-> getDossier($_GET['id_dos'])['id_verif_feuil_calc']) ) {
	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
}else{
	// $pdf->Image('../images/sceau_mca.png', 120, 235, 50, '', '', '', '', false, 300);
	if (!empty($maClasse-> getDataUtilisateur($maClasse-> getDossier($_GET['id_dos'])['id_verif_feuil_calc'])['signature_facture'])) {
		$sceau = '';//'<img src="../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['id_dos'])['id_verif_feuil_calc'])['signature_facture'].'" width="'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['id_dos'])['id_util_validation'])['size_signature_facture'].'">';
	}
	
}

$ref_dos = $_GET['ref_dos'];
$fob = number_format($maClasse-> getFOBMarchandiseDossier($_GET['id_dos']), 2, '.', ',');
$fret = number_format($maClasse-> getDossier($_GET['id_dos'])['fret'], 2, '.', ',');
$assurance = number_format($maClasse-> getDossier($_GET['id_dos'])['assurance'], 2, '.', ',');
$autre_frais = number_format($maClasse-> getDossier($_GET['id_dos'])['autre_frais'], 2, '.', ',');
$incoterm = $maClasse-> getDossier($_GET['id_dos'])['incoterm'];
$regime = $maClasse-> getDossier($_GET['id_dos'])['regime'];
$num_lic = $maClasse-> getDossier($_GET['id_dos'])['num_lic'];
$roe_feuil_calc = number_format($maClasse-> getDossier($_GET['id_dos'])['roe_feuil_calc'], 2, '.', ',');
$date_feuil = date('Y-m-d H:i:s');
$date_feuil_calc = $maClasse-> getDossier($_GET['id_dos'])['date_feuil_calc_1'];
$util_feuil_calc = $maClasse-> getUtilisateur($maClasse-> getDossier($_GET['id_dos'])['id_feuil_calc'])['nom_util'];
$util_verif_feuil_calc = $maClasse-> getUtilisateur($maClasse-> getDossier($_GET['id_dos'])['id_verif_feuil_calc'])['nom_util'];
$date_verif_feuil_calc = $maClasse-> getDossier($_GET['id_dos'])['date_verif_feuil_calc'];
$marchandise_dossier = $maClasse-> getMarchandiseDossier2($_GET['id_dos']);


$cif = number_format($maClasse-> getFOBMarchandiseDossier($_GET['id_dos'])+$maClasse-> getDossier($_GET['id_dos'])['fret']+$maClasse-> getDossier($_GET['id_dos'])['assurance']+$maClasse-> getDossier($_GET['id_dos'])['autre_frais'], 2, '.', ',');
$coef = number_format(($maClasse-> getFOBMarchandiseDossier($_GET['id_dos'])+$maClasse-> getDossier($_GET['id_dos'])['fret']+$maClasse-> getDossier($_GET['id_dos'])['assurance']+$maClasse-> getDossier($_GET['id_dos'])['autre_frais'])/$maClasse-> getFOBMarchandiseDossier($_GET['id_dos']), 2, '.', ',');

if(isset($_GET['id_dos'])){

$logo = '<img src="../images/malabar2.png" width="250px">';

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
			<td width="40%" style="text-align: center; border: 0.3px solid black; font-weight: bold; font-size: 12px;">FEUILLE DE CALCUL</td>
		</tr>
		<br>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black;  font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Fob General</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$fob</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; ">MCA FILE</td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; font-weight: bold;">$ref_dos</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Fret</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$fret</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black;  border-bottom: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-bottom: 0.3px solid black; border-left: 0.3px solid black; font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Autres Charges</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$autre_frais</td>
		</tr>

		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black;  font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Assurance</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$assurance</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; ">INCOTERM</td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; font-weight: bold;">$incoterm</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">CIF</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$cif</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black;  border-bottom: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-bottom: 0.3px solid black; border-left: 0.3px solid black; font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Coefficient</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$coef</td>
		</tr>

		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; border-top: 0.3px solid black; border-right: 0.3px solid black;  font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Licence</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$num_lic</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; ">REGIME</td>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black; font-weight: bold;">$regime</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Taux de change</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$roe_feuil_calc</td>
		</tr>
		<tr>
			<td width="10%" style="text-align: center; border-left: 0.3px solid black;  border-bottom: 0.3px solid black; "></td>
			<td width="10%" style="text-align: center; border-bottom: 0.3px solid black; border-left: 0.3px solid black; font-weight: bold;"></td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; ">Date</td>
			<td width="10%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">$date_feuil</td>
		</tr>
		
	</table>
	<table  cellpadding="3">
	<tr><td><br></td></tr>
		<tr>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">Description sur facture</td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">N.BIVAC</td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">N.Facture</td>
			<td width="12%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">Position Tarifaire</td>
			<td width="5%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">ORG</td>
			<td width="5%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">PROV</td>
			<td width="6%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">Code Add.</td>
			<td width="6%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">Colis</td>
			<td width="6%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">Poids</td>
			<td width="8%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">FOB Par Article</td>
			<td width="8%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">CIF Par Article</td>
			<td width="8%" style="text-align: center; border: 0.3px solid black; font-weight: bold;">DDI en CDF</td>
		</tr>
		$marchandise_dossier
		<br>
		<tr>
			<td width="50%" style="text-align: center;">
			To be recorded by<br>
			<br>$util_feuil_calc
			<br>$date_feuil_calc
			</td>
			<td width="50%" style="text-align: center;">
			OPS Coordonator Approval<br>
			<br>$util_verif_feuil_calc
			<br>$date_verif_feuil_calc
			</td>
		</tr>
	</table>
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// Clean any content of the output buffer
ob_end_clean();

$pdf->Output($_GET['ref_dos'].'.pdf', 'I');

  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+