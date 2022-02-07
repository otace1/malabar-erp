<?php
  
  $licence = $maClasse-> getLicence($_GET['num_lic']);
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
		<table id="exportationExcelApurement" summary="Code page support in different versions of MS Windows."
        rules="groups" frame="hsides" cellspacing="0" cellpadding="4" border="1" style="text-align:center; display: none;">
			<thead>
			<tr>
				<th colspan="20" style="color: blue; font-size: 18px;text-align:left;">
          DOSSIERS APURES PAR BANQUE LICENCE <?php echo $_GET['num_lic'];?>
        </th>
			</tr>
            <tr>
              <th style="text-align: center; ">#</th>
              <th style="text-align: center; ">MCA FILE REF</th>
              <th style="text-align: center; ">REF AV</th>
              <th style="text-align: center; ">MONTANT AV</th>
              <th style="text-align: center; ">N<sup><u>o</u></sup> E</th>
              <th style="text-align: center; ">N<sup><u>o</u></sup> L</th>
              <th style="text-align: center; ">N<sup><u>o</u></sup> Q</th>
              <th style="text-align: center; ">FOB</th>
            </tr>
          </thead>
        <tbody>
          <?php
          	$maClasse-> afficherDossierLicenceAppuresBanqueExcel($_GET['num_lic']);
          ?>
        </tbody>
    </table>
</div>
	</body>

</html>
