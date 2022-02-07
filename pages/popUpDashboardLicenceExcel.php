<?php
  
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  if ($_GET['type'] == 'EN COURS') {

    $couleur = 'info';

  }else if ($_GET['type'] == 'EXTREME VALIDATION -40 JOURS') {

    $couleur = 'warning';

  }else if ($_GET['type'] == 'EXPIRES') {

    $couleur = 'danger';
    
  }else if ($_GET['type'] == 'APPUREES TRACKING ATTENTE BANQUE') {

    $couleur = 'dark';
    
  }else if ($_GET['type'] == 'APPUREES PAR BANQUE') {

    $couleur = 'success';
    
  }else if ($_GET['type'] == 'CIF LICENCE DIFFERENT CIF DOSSIER(S)') {

    $couleur = 'teal';
    
  }
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
  }

  if( isset($_GET['id_type_lic']) && ($_GET['id_type_lic'] != '')){
    $type_licence = ' | '.$maClasse-> getNomTypeLicence($_GET['id_type_lic']);
  }else{
    $type_licence = '';
  }

  if(!isset($_GET['id_cli'])){
    $_GET['id_cli'] = null;
  }
  if(!isset($_GET['id_type_lic'])){
    $_GET['id_type_lic'] = null;
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
          DETAIL LICENCE(S) <?php echo $_GET['type'].$client.$type_licence;?>
        </th>
			</tr>
      <tr>
        <th style="text-align: center; ">#</th>
        <th>NUMERO</th>
        <th>SOUSCRIPTEUR</th>
        <th>DATE VALIDATION</th>
        <th>EXTREME VALIDATION</th>
        <?php
        if ($_GET['id_mod_lic'] == '1') {
        ?>
        <th>MEASURE</th>
        <th>NB. AUTHORIZED</th>
        <?php
        }else {
        ?>
        <th>MONNAIE</th>
        <th>FOB</th>
        <?php
        }
        ?>
        <th>BALANCE</th>
        <th>Nbre DOSSIERS</th>
        <?php
        if ($_GET['id_mod_lic'] == '1') {
        ?>
        <th>VALEUR DOSSIERS</th>
        <?php
        }else {
        ?>
        <th>FOB DOSSIERS</th>
        <?php
        }
        ?>
      </tr>
        </thead>
          <tbody>
            <?php
              $maClasse-> afficherLicencePopUpExcel($_GET['id_mod_lic'], $_GET['type'], $_GET['id_cli'], $_GET['id_type_lic']);
            ?>
          </tbody>
      </table>
    </div>
	</body>

</html>
