<?php
  include('../classes/maClasse.class.php');

  $maClasse = new MaClasse();

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MALABAR | ERP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

  <script src="jquery.min.js"></script>

  <script src="graphiques/code/highcharts.js"></script>
  <script src="graphiques/code/modules/exporting.js"></script>
  <script src="graphiques/code/modules/export-data.js"></script>
  <!-- pace-progress -->
  <link rel="stylesheet" href="../plugins/pace-progress/themes/black/pace-theme-flat-top.css">

  <!-- --------- AJAX -------- -->

  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <script src="ajax/jquery-1.12.4.js"></script>
  <!--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
  <script src="ajax/jquery.dataTables.min.js"></script>
  <!--<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>-->
  <script src="ajax/dataTables.bootstrap.min.js"></script>
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />-->
  <link rel="stylesheet" href="ajax/bootstrap-datepicker.css" />
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>-->
  <script src="ajax/bootstrap-datepicker.js"></script>
  <!-- --------- AJAX -------- -->


    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />


  <link rel="icon" href="../images/logo.jpeg" type="image/x-icon">
</head>
<body class="hold-transition lockscreen">
<!-- Automatic element centering -->
<div class="wrapper">
  <div class="lockscreen-logo">
    <a href=""><img src="../images/malabar.png"></a>
  </div>
  <!-- User name -->
  <div class="lockscreen-name">
    <?php echo $maClasse-> getClient($maClasse-> getFactureGlobale(str_replace('2022', '22', $_GET['ref_fact']))['id_cli'])['nom_cli'];?> | Facture : <?php echo str_replace('2022', '22', $_GET['ref_fact']);?>
  </div>

  <!-- START LOCK SCREEN ITEM -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-danger card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-folder-open"></i>
                   supporting documents
                </h3>
              </div>
              <div class="card-body pad table-responsive">
                <div class="row">
                  <div class="col-2">
                    <button class="btn btn-danger" onclick="window.open('<?php echo $maClasse-> getFactureModeleFacture($maClasse-> getFactureGlobale(str_replace('2022', '22', $_GET['ref_fact']))['id_mod_fact'])['view_page'];?>?ref_fact=<?php echo str_replace('2022', '22', $_GET['ref_fact']);?>','pop1','width=1000,height=800');">
                      <i class="fas fa-calculator"></i> Invoice File
                    </button>
                    <button class="btn btn-success" onclick="window.location.replace('<?php echo $maClasse-> getFactureModeleFacture($maClasse-> getFactureGlobale(str_replace('2022', '22', $_GET['ref_fact']))['id_mod_fact'])['excel'];?>?ref_fact=<?php echo str_replace('2022', '22', $_GET['ref_fact']);?>','pop1','width=1000,height=800');">
                      <i class="fas fa-file-excel"></i> Annexe File
                    </button>
                  </div>
                  <div class="col-10">
                    <table width="" class="table table-bordered table-hover text-nowrap table-sm table-head-fixed table-responsive">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>FILE REF.</th>
                          <th>DOCUMENTS</th>
                        </tr>
                      </thead>
                      <tbody id="detail_facture_dossier">
                        <?php
                          $maClasse-> getDocumentDossierFacture(str_replace('2022', '22', $_GET['ref_fact']));
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
              <!-- /.card -->
            </div>
          </div>
          <!-- /.col -->
        </div>
      </div>
    </section>

  <!-- /.lockscreen-item -->
  <hr>
</div>
  <div class="small">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 0.5
    </div>
    <strong>Copyright &copy; <font style="color: rgb(193, 0, 0) ">MALABAR</font> <font style="color: black;">GROUP</font> <?php date("Y");?> All rights
    reserved. Build by <a href="http://www.belej-consulting.com" onclick="window.open(this.href);return false;"> <font style="color: orange;">BELEJ - </font><font style="color: grey;">CONSULTING</font> </a></strong>
  </div>

<!-- /.center -->
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
