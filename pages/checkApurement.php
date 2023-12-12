<?php
include('../classes/maClasse.class.php');
$maClasse = new MaClasse();
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
	</head>
	<body>
		<table>
			<tr>
				<td>#</td>
				<td>ID</td>
				<td>Ref.</td>
				<td>Date</td>
				<td>Fichier</td>
			</tr>
			<?php
				$maClasse-> check_file_transmis_apurement();
			?>
		</table>
	</body>
</html>