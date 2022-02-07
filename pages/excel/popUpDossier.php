
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>DOSSIERS</title>
	</head>
	<body>
		<div>
			<table id="popUpDossier" style=" display: none;">

				<thead>
					<tr>
						<!--<td colspan="12">
							<img src="../../images/logo1.jpeg" height="100" width="100">
						</td>-->
					</tr>
                	<tr>
                		<td colspan="9" style="text-align: center; border: 0.5px solid black;">
                			DETAIL DOSSIER(S) <?php echo $_GET['type'].$client.$type_licence;?>
                		</td>
                	</tr>
                  <tr>
                    <th style="text-align: center; border: 0.5px solid black;">#</th>
                    <th style=" border: 0.5px solid black;">MCA FILE REF</th>
                    <th style=" border: 0.5px solid black;">MCA B/REF</th>
                    <th style=" border: 0.5px solid black;">CLIENT</th>
                    <th style=" border: 0.5px solid black;">MARCHANDISE</th>
                    <th style=" border: 0.5px solid black;">N. E</th>
                    <th style=" border: 0.5px solid black;">N. L</th>
                    <th style=" border: 0.5px solid black;">N. Q</th>
                    <th style=" border: 0.5px solid black;">FOB</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    $maClasse-> afficherDossierPopUpExcel($_GET['id_mod_lic'], $_GET['type'], $_GET['id_cli'], $_GET['id_type_lic']);
                  ?>
                </tbody>
			</table>
		</div>
	</body>
</html>