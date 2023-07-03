<?php
  session_start();

  if (!$_SESSION) {
    header("Location: ../deconnexion.php");
  }

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
<!-- 
  <script src="graphiques/code/highcharts.js"></script>
  <script src="graphiques/code/modules/exporting.js"></script>
  <script src="graphiques/code/modules/export-data.js"></script> -->
  <!-- pace-progress -->
  <link rel="stylesheet" href="../plugins/pace-progress/themes/black/pace-theme-flat-top.css">

  <!-- --------- AJAX -------- -->

  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <script src="ajax/jquery-1.12.4.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
  <script src="../datatable/jquery.dataTables.min.js"></script>
  <script src="../datatable/dataTables.bootstrap.min.js"></script>
  <script src="../datatable/dataTables.autoFill.min.js"></script>
  <script src="../datatable/dataTables.buttons.min.js"></script>
  <script src="../datatable/jszip.min.js"></script>
  <!-- <script src="pdfmake.min.js"></script> -->
  <script src="../datatable/vfs_fonts.js"></script>
  <script src="../datatable/buttons.html5.min.js"></script>
  <script src="../datatable/buttons.print.min.js"></script>
  <script src="../datatable/dataTables.rowGroup.min.js"></script>

  <!-- --------- AJAX -------- -->
  
  <!-- DataTables -->
  <link rel="stylesheet" href="../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <!-- Bootstrap Core Css -->
    <!-- <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet"> -->

    <!-- Waves Effect Css -->
    <!-- <link href="../plugins/node-waves/waves.css" rel="stylesheet" /> -->

    <!-- Animation Css -->
    <!-- <link href="../plugins/animate-css/animate.css" rel="stylesheet" /> -->

    <!-- Morris Chart Css-->
    <!-- <link href="../plugins/morrisjs/morris.css" rel="stylesheet" /> -->


  <link rel="icon" href="../images/logo.jpeg" type="image/x-icon">
<style type="text/css">
  table.dataTable tr.dtrg-group.dtrg-end th {
      text-align: right;
      font-weight: normal;
  }
  
      ::-webkit-scrollbar{
        width: 15px;
      }

      ::-webkit-scrollbar-thumb{
        background: linear-gradient(red, grey);
        border-radius: 20px;
      }

#spinner-div {
  position: fixed;
  display: none;
  width: 100%;
  height: 100%;
  top: auto;
  left: auto;
  text-align: center;
  background-color: rgba(255, 255, 255, 0.8);
  z-index: 2;
}

</style>
</head>
<body>
  <div id="spinner-div" class="pt-5">
    <!-- <div class="spinner-border text-primary" role="status"></div> -->
    <!-- <img src="../images/86b6e3f28ee33d8104291ba874349e04_w200.gif" width="250px"> -->
    <img src="../images/GD.gif" width="250px">
  </div>
<div class="wrapper">