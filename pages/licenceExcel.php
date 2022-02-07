<?php
  
  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='licence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
          SYNTHESE LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?>
        </th>
			</tr>
        <?php
          include("enTeteLicenceExcel.php");
        ?>
          </thead>
        <tbody>
          <?php
            if( isset($_GET['id_cli']) && isset($_GET['id_type_lic']) ){
              //$_GET['id_cli'] = null;
              $maClasse-> afficherLicenceExcel($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
            }
          ?>
        </tbody>
    </table>
</div>
	</body>

</html>
