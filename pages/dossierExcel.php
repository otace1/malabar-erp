<?php
  
  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' <br>MODE: '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
  }else{
    $mode_transport = '';
  }

  if( isset($_GET['id_mod_trac']) && ($_GET['id_mod_trac'] != '')){
    $transit = ' <br>TRANSIT: '.$maClasse-> getNomModeleLicence($_GET['id_mod_trac']);
  }else{
    $transit = '';
  }

  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $id_cli = $maClasse-> getElementClient($_GET['id_cli']);
    $client = ' <br>CLIENT: '.$id_cli['nom_cli'];
  }else{
    $client = '';
  }

  if(isset($_GET['num_lic']) && ($_GET['num_lic'] != '')){
    $licence = '<br>LICENCE: '.$_GET['num_lic'];
  }else{
    $licence = '';
    $_GET['num_lic'] = NULL;
  }

  if(isset($_GET['id_march']) && ($_GET['id_march'] != '')){
    $marchandise = '<br>COMMODITY: '.$maClasse-> getMarchandise($_GET['id_march']);;
  }else{
    $marchandise = '';
    $_GET['id_march'] = NULL;
  }

  if(isset($_GET['commodity']) && ($_GET['commodity'] != '')){
    $commodity = '<br>COMMODITY: '.$_GET['commodity'];
  }else{
    $commodity = '';
    $_GET['commodity'] = NULL;
  }

  if(isset($_GET['statut']) && ($_GET['statut'] != '')){
    $status = '<br>STATUS: '.$_GET['statut'];
  }else{
    $status = '';
    $_GET['statut'] = NULL;
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
          DAILY CLEARING ACTIVITY TRACKING SHEET <?php echo date('Y-m-d');?>
          <?php
            echo $client.$transit.$mode_transport.$licence.$commodity.$marchandise.$status;
          ?>
        </th>
			</tr>
        <?php
          $maClasse-> afficherEnTeteTableauExcel($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans']);
          /*if ($_GET['id_mod_trans'] == '1') {
            //include("enTeteAcid.php");
            include("enTeteImportRouteExcel.php");

          }else if ($_GET['id_mod_trans'] == '3') {
            //include("enTeteAcid.php");
            include("enTeteImportAirExcel.php");

          }*/
        ?>
          </thead>
        <tbody>
          <?php
            $maClasse-> afficherRowDossierClientModeTransportModeLicenceExcel($_GET['id_cli'], 
                                                $_GET['id_mod_trans'], $_GET['id_mod_trac'], $_GET['commodity'], $_GET['id_march'], $_GET['statut']);
          ?>
        </tbody>
    </table>
</div>
	</body>

</html>
