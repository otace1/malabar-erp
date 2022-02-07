<?php
  
  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    if( $id_cli > 0){
      $client = ' | '.$maClasse-> getNomClient($id_cli);
    }else{
      $client = '';
    }
  }
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }

?>


<html>
	<head>
		<script type="text/javascript">
			var tableToExcel = (function () {
			var uri = 'data:application/vnd.ms-excel;charset=UTF-8;base64,'
					, template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets><x:ExcelWorksheet><x:Name>{worksheet}</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet></x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head><body><table>{table}</table></body></html>'
					, base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
					, format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
				return function (table, name) {
					if (!table.nodeType) table = document.getElementById(table)
					var ctx = { worksheet: name || 'Worksheet', table: table.innerHTML }
					window.location.href = uri + base64(format(template, ctx))
				}
			})()
		</script>
	</head>

	<body>
		<div id="">
		<table id="exportationExcel" summary="Code page support in different versions of MS Windows."
        rules="groups" frame="hsides" cellspacing="0" cellpadding="4" border="1" style="text-align:center; display: none;">
			<thead>
  			<tr>
  				<th colspan="20" style="color: blue; font-size: 18px;text-align:left;">
            SYNTHESE MANIPULATION LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?>
          </th>
  			</tr>
        <tr class="bg bg-dark">
          <th class="col_1" style="border: 1px solid white; background-color: #696969; color: white;">#</th>
          <th class="col_6" style="border: 1px solid white; background-color: #696969; color: white;">MCA</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;" colspan="3">CLIENT</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;" colspan="11">LICENCE.</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;" colspan="3">AV</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;" colspan="7">FACTURE FOURNISSEUR</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;" colspan="5">DOCUMENTS APUREMENT</th>
        </tr>
        <tr class="bg bg-dark">
          <th class="col_1" style="border-bottom: 1px solid white; background-color: #696969; color: white;">&nbsp;</th>
          <th class="col_6" style="border-bottom: 1px solid white; background-color: #696969; color: white;">&nbsp;</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FOURNISSEUR</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">COMMODITY</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> FACTURE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> LICENCE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">MONNAIE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FOB</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FRET</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">ASSURANCE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">AUTRES FRAIS</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">TOTAL</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FSI</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">AUR</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">VALIDATION</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">EXTREME VALIDITE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> COD</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> FXI</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">MONTANT</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">DATE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup></th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FOB</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">FRET</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">ASSURANCE</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">AUTRES FRAIS</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">TOTAL</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> E</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">MONTANT</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> L</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">N<sup><u>o</u></sup> Q</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">DATE Q</th>
          <th style="border: 1px solid white; text-align: center;; background-color: #696969; color: white;">OSERVATION</th>
        </tr>
          </thead>
        <tbody>
          <?php
            if( isset($_GET['id_cli']) && isset($_GET['id_type_lic']) ){
              //$_GET['id_cli'] = null;
              $maClasse-> afficherManipulationLicenceExcel($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
            }
          ?>
        </tbody>
    </table>
</div>
	</body>

</html>
