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

include_once('../classes/nuts.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set margins
$pdf->SetMargins(5,3 ,5);


// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Demande de Fond '.$_GET['id_df']);
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
$pdf->AddPage('P', 'A5');

$pdf->Image('../images/malabar2.png', 4, 10, 70, '', '', '', '', false, 300);
// $sceau='';
// if ( empty($maClasse-> getDossier($_GET['id_df'])['id_verif_feuil_calc_ops']) ) {
// 	$pdf->Image('../images/no_valid.jpg', 150, 2, 30, '', '', '', '', false, 300);
// }else{
// 	// $pdf->Image('../images/sceau_mca.png', 120, 235, 50, '', '', '', '', false, 300);
// 	if (!empty($maClasse-> getDataUtilisateur($maClasse-> getDossier($_GET['id_df'])['id_verif_feuil_calc'])['signature_facture'])) {
// 		$sceau = '';//'<img src="../images/signature_facture/'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['id_df'])['id_verif_feuil_calc'])['signature_facture'].'" width="'.$maClasse-> getDataUtilisateur($maClasse-> getFactureGlobale($_GET['id_df'])['id_util_validation'])['size_signature_facture'].'">';
// 	}
	
// }

$demande_fond = $maClasse-> getDemandeFond($_GET['id_df']);

$id_df = $_GET['id_df'];
$dossier = $maClasse-> getDossierDemandeDossier($_GET['id_df']);
$date_df = $demande_fond['date_df'];
$nom_dept = $demande_fond['nom_dept'];
$beneficiaire = $demande_fond['beneficiaire'];
$montant = number_format($demande_fond['montant'], 2, ',', ' ');
$monnaie = $demande_fond['monnaie'];
$nom_cli = $demande_fond['nom_cli'];
$libelle = $demande_fond['libelle'];
$type_payment = $demande_fond['type_payment'];

if (!empty($demande_fond['date_visa_dept'])) {
	$nom_util_visa_dept = $demande_fond['nom_util_visa_dept'];
	$date_visa_dept = $demande_fond['date_visa_dept'];
}else{
	$nom_util_visa_dept = '';
	$date_visa_dept = '';
}

if (!empty($demande_fond['date_decaiss'])) {
	$nom_util_decaiss = $demande_fond['nom_util_decaiss'];
	$date_decaiss = $demande_fond['date_decaiss'];
}else{
	$nom_util_decaiss = '';
	$date_decaiss = '';
}

$nom_util_visa_fin = $demande_fond['nom_util_visa_fin'];
$date_visa_fin = $demande_fond['date_visa_fin'];

$nom_util_visa_fin = $demande_fond['nom_util_visa_fin'];
$date_visa_fin = $demande_fond['date_visa_fin'];

$nom_util_visa_dir = $demande_fond['nom_util_visa_dir'];
$date_visa_dir = $demande_fond['date_visa_dir'];

$nom_recep_fond = $demande_fond['nom_recep_fond'];

$nuts = new nuts(number_format($demande_fond['montant'], 2, '.', ''), $monnaie);

$montant_mvt_lettre = ucfirst($nuts->convert('fr-FR'));

$text_a_facture = '';

if ($demande_fond['a_facturer']=='1') {
	
	$nuts = new nuts(number_format($demande_fond['montant_fact'], 2, '.', ''), $monnaie);

	$montant_fact = ucfirst($nuts->convert('fr-FR'));

	$text_a_facture = '
				<tr>
					<td width="30%" style="border-left: solid 1px black;">Chargeback: </td>
					<td width="30%" style=" border-bottom: 0.5px dotted grey;"><b>'.number_format($demande_fond['montant_fact'], 2, '.', '').'</b> </td>
					<td width="10%" style="">Devise: </td>
					<td width="10%" style="border-bottom: 0.5px dotted grey;"><b>'.$monnaie.'</b> </td>
					<td width="20%" style="border-right: solid 1px black; "></td>
				</tr>
				<tr>
					<td width="30%" style="border-left: solid 1px black;">Montant en lettre: </td>
					<td width="70%" style="border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>'.$montant_fact.'</b> </td>
				</tr>';

}

if(isset($_GET['id_df'])){

$logo = '<img src="../images/malabar2.png" width="200px">';

$tbl = <<<EOD
    <html>
    <head>
        <meta http-equiv = " content-type " content = " text/html; charset=utf-8" />
    </head>
    <body style="font-weight: bold;" style="">
	<table  cellpadding="1">
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
	</table>
	<br>
	<br>
	<table  cellpadding="3">
		<tr>
			<td width="100%" style="text-align: center; font-weight: bold; font-size: 10;">DEMANDE DE FONDS No. $id_df</td>
		</tr>
		<tr>
			<td width="80%" style="text-align: center;"></td>
			<td width="20%" style="text-align: center;">$date_df</td>
		</tr>
	</table>
	<table  cellpadding="3">
		<tr>
			<td width="30%" style="border-top: solid 1px black; border-left: solid 1px black;">Department: </td>
			<td width="70%" style="border-top: solid 1px black; border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>$nom_dept</b></td>
		</tr>
		<tr>
			<td width="30%" style="border-left: solid 1px black;">Beneficiare: </td>
			<td width="70%" style="border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>$beneficiaire</b> </td>
		</tr>
		<tr>
			<td width="30%" style="border-left: solid 1px black;">Montant: </td>
			<td width="30%" style=" border-bottom: 0.5px dotted grey;"><b>$montant</b> </td>
			<td width="10%" style="">Devise: </td>
			<td width="10%" style="border-bottom: 0.5px dotted grey;"><b>$monnaie</b> </td>
			<td width="10%" style="">Type: </td>
			<td width="10%" style="border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>$type_payment</b> </td>
		</tr>
		<tr>
			<td width="30%" style="border-left: solid 1px black;">Montant en lettre: </td>
			<td width="70%" style="border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>$montant_mvt_lettre</b> </td>
		</tr>
		$text_a_facture
		<tr>
			<td width="30%" style="border-left: solid 1px black;">Client: </td>
			<td width="70%" style="border-right: solid 1px black; border-bottom: 0.5px dotted grey;"><b>$nom_cli</b> </td>
		</tr>
		<tr>
			<td width="30%" style="border-left: solid 1px black; border-bottom: 0.5px solid black;">Motif: </td>
			<td width="70%" style="border-right: solid 1px black; border-bottom: 0.5px solid black;"><b>$libelle</b></td>
		</tr>
	</table>
	<table  cellpadding="3">
		<tr>
			<td width="100%"><br></td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center;border: solid 1px black;"><u>AUTORISATION</u></td>
		</tr>
		<tr>
			<td width="34%" style="border-top: solid 1px black; border: solid 1px black;">Department: <br><br><b>$nom_util_visa_dept</b> <br><b>$date_visa_dept</b><br></td>
			<td width="33%" style="border-top: solid 1px black; border: solid 1px black; border: solid 1px black;">Management Approval: <br><br><b>$nom_util_visa_dir</b> <br><b>$date_visa_dir</b><br></td>
			<td width="33%" style="border-top: solid 1px black; border: solid 1px black; border: solid 1px black;">Finance: <br><br><b>$nom_util_visa_fin</b> <br><b>$date_visa_fin</b><br></td>
		</tr>
	</table>
	<table  cellpadding="3">
		<tr>
			<td width="100%"><br></td>
		</tr>
		<tr>
			<td width="100%" style="text-align: center;border: solid 1px black;"><u>RETRAIT</u></td>
		</tr>
		<tr>
			<td width="50%" style="border-top: solid 1px black; border: solid 1px black;">Caissier: <br><br><b>$nom_util_decaiss</b> <br><b>$date_decaiss</b><br></td>
			<td width="50%" style="border-top: solid 1px black; border: solid 1px black; border: solid 1px black;">Pour Reception: <br><br><b>$nom_recep_fond</b><br><b>$date_decaiss</b></td>
		</tr>
	</table>
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// add a page
$pdf->AddPage('P', 'A5');
$tbl = <<<EOD
    <html>
    <head>
        <meta http-equiv = " content-type " content = " text/html; charset=utf-8" />
    </head>
    <body style="font-weight: bold;" style="">
	<table cellpadding="2">
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
			<td width="83%" style="">DETAILS - DEMANDE DE FONDS No. $id_df</td>
		</tr>
		<tr>
			<td width="5%" style="text-align: center; border: 1 solid black; font-weight: bold;"><span><br>#<br></span></td>
			<td width="25%" style="text-align: center; border: 1 solid black; font-weight: bold;"><span><br>MCA File No<br></span></td>
			<td width="20%" style="text-align: center; border: 1 solid black; font-weight: bold;"><span><br>Category<br></span></td>
			<td width="30%" style="text-align: center; border: 1 solid black; font-weight: bold;"><span><br>Expense<br></span></td>
			<td width="20%" style="text-align: center; border: 1 solid black; font-weight: bold;"><span><br>Amount<br></span></td>
		</tr>
		$dossier
		
		<br>
		<br>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="90%" style="text-align: right;"></td>
			<td width="5%" style=""></td>
		</tr>
		<br>
		<br>
		<tr>
			<td width="5%" style=""></td>
			<td width="90%" style="text-align: center;">$sceau</td>
			<td width="5%" style=""></td>
		</tr>
	</table>
	</bodystyle="font-weight: bold;">
	</html>
        
EOD;
$pdf->writeHTML($tbl, true, false, false, false, '');

// Clean any content of the output buffer
ob_end_clean();

$pdf->Output($_GET['id_df'].'.pdf', 'I');

  
}





 //header("Location: Stock.php");


//============================================================+
// END OF FILE
//============================================================+