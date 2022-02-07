<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Statistique de ventes Periodique</title>

		<style type="text/css">

		</style>
	</head>
	<body>
<div class="row">
    <div class="col-md-6">
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
    </div>
</div>




		<script type="text/javascript">

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'GRAPHIQUE'
            },
            subtitle: {
                //text: 'Source: WorldClimate.com'
            },
            xAxis: {
                categories: [''
                    <?php //echo $maClasse-> getJourPourPeriode($_GET['debut'], $_GET['fin']);?>
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: ''
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [
            <?php
                if ($maClasse-> getNombreLicenceEnCoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            {
                name: 'LICENCE(S) EN COURS',
                data: [<?php echo $maClasse-> getNombreLicenceEnCoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]
                //data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }
                    <?php
                }
            ?>
            <?php
                if ($maClasse-> getNombreLicenceExpiration40JoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            , {
                name: 'ETREME VALIDATION -40 JOURS',
                data: [<?php echo $maClasse-> getNombreLicenceExpiration40JoursModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]

            }
                    <?php
                }
            ?>
            <?php
                if ($maClasse-> getNombreLicenceClotureeAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            , {
                name: 'LICENCE(S) APPUREE(S) TRACKING ATTENTE BANQUE',
                data: [<?php echo $maClasse-> getNombreLicenceClotureeAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]

            }
                    <?php
                }
            ?>
            <?php
                if ($maClasse-> getNombreLicenceClotureeTrackingAttenteBanqueAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            , {
                name: 'LICENCE(S) APPUREE(S) BANQUE',
                data: [<?php echo $maClasse-> getNombreLicenceClotureeTrackingAttenteBanqueAppureeModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]

            }
                    <?php
                }
            ?>
            <?php
                if ($maClasse-> getNombreLicenceExpireModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            , {
                name: 'LICENCE(S) EXPIREE(S)',
                data: [<?php echo $maClasse-> getNombreLicenceExpireModele($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]

            }
                    <?php
                }
            ?>
            <?php
                if ($maClasse-> getNombreLicenceCIFLicenceDifferentCIFDossier($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']) > 0) {
                    ?>
            , {
                name: 'CIF LICENCE(S) <> CIF DOSSIER(S)',
                data: [<?php echo $maClasse-> getNombreLicenceCIFLicenceDifferentCIFDossier($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);?>]

            }
                    <?php
                }
            ?>
            ]
        });

		</script>
	</body>
</html>
