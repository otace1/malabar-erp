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
  <script src="../datatable/dataTables.fixedColumns.min.js"></script>
  <link rel="stylesheet" href="../datatable/fixedColumns.dataTables.min.css">

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
  
      .clignote {
        animation: clignote 1.5s linear infinite;
      }
      @keyframes clignote {  
        50% { opacity: 0; }
      }

      .clignoteb {
        animation: clignoteb 2s linear infinite;
      }
      @keyframes clignoteb {  
        50% { opacity: 0; }
      }

      .tableau1{
        width: auto;
        overflow-x: scroll;
        margin-left: 17em;
      }

      .tableauLicence{
        width: auto;
        overflow-x: scroll;
        margin-left: 25em;
      }

      .tableau1a{
        width: auto;
        overflow-x: scroll;
        margin-left: 17em;
      }

      .table1a.table-head-fixed-2 thead tr:nth-child(1) th {
        background-color: #ffffff;
        border-bottom: 0;
        box-shadow: inset 0 1px 0 #dee2e6, inset 0 -1px 0 #dee2e6;
        position: -webkit-sticky;
        position: sticky;
        top: 0;
        z-index: 10;
      }

      .tableau2{
        width: auto;
        overflow-x: scroll;
        margin-left: 45em;
      }

      .col_1{
        position: absolute;
        width: 3em;
        left: 0em;
        top: auto;
      }

      .col_6{
        position: absolute;
        width: 14.1em;
        left: 3em;
        top: auto;
      }

      .col_6_licence{
        position: absolute;
        width: 22.1em;
        left: 3em;
        top: auto;
      }

      .col_2{
        position: absolute;
        width: 14em;
        left: 17em;
        top: auto;
      }

      .col_2_a{
        position: absolute;
        width: 15em;
        left: 17em;
        top: auto;
      }

      .col_3{
        position: absolute;
        width: 14.1em;
        left: 31em;
        top: auto;
      }

      .tableauDossier{
        width: auto;
        overflow-x: scroll;
        margin-left: 42em;
      }

      .tableau1 tbody tr:hover {
        color: #212529;
        background-color: orange;
      }

      .cadre-tableau-de-donnees{
         max-height: 46em;
         overflow-x: var(top);
      }

      ::-webkit-scrollbar{
        width: 15px;
      }

      ::-webkit-scrollbar-thumb{
        background: linear-gradient(red, grey);
        border-radius: 20px;
      }

      .tableau-de-donnees{
        width: 120%;
      }

      .tableau-de-donnees thead th{
        position: sticky;
        top: 0;
        background: black;
        z-index: 5;
      }

      .tableau-de-donnees thead th:nth-child(2){
        position: sticky;
        left: 0;
        background: black;
        z-index: 6;
      }

      .tableau-de-donnees tbody td:nth-child(2){
        position: sticky;
        left: 0;
        border: 1px solid black;
        background: white;
        z-index: 3;
      }

      .tableau-de-donnees tbody tr:hover td:nth-child(2){
        color: #212529;
        background-color: orange;
      }

      .tableau-de-donnees tbody tr:hover{
        color: #212529;
        background-color: orange;
      }


      #loading {
        position: fixed;
        display: block;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        text-align: center;
        opacity: 0.8;
        background-color: #fff;
        z-index: 99;
      }

      #loading-image {
        position: absolute;
        /*top: 100px;*/
        /*left: 240px;*/
        margin-left: auto;
        margin-right: auto;
        /*text-align: center;*/
        z-index: 100;
      }


      .lds-dual-ring {
        display: inline-block;
        width: 80px;
        height: 80px;
      }
      .lds-dual-ring:after {
        content: " ";
        display: block;
        width: 64px;
        height: 64px;
        margin: 8px;
        border-radius: 50%;
        border: 6px solid #eddfdf;
        border-color: #eddfdf transparent #eddfdf transparent;
        animation: lds-dual-ring 1.2s linear infinite;
      }
      @keyframes lds-dual-ring {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }


.table-hover tbody tr.expandable-body:hover {
  background-color: inherit !important;
}

[data-widget="expandable-table"] {
  cursor: pointer;
}

[data-widget="expandable-table"] i.expandable-table-caret {
  transition: -webkit-transform 0.3s linear;
  transition: transform 0.3s linear;
  transition: transform 0.3s linear, -webkit-transform 0.3s linear;
}

[data-widget="expandable-table"][aria-expanded="true"] td i.expandable-table-caret[class*="right"] {
  -webkit-transform: rotate(90deg);
  transform: rotate(90deg);
}

[data-widget="expandable-table"][aria-expanded="true"] td i.expandable-table-caret[class*="left"] {
  -webkit-transform: rotate(-90deg);
  transform: rotate(-90deg);
}

.expandable-body > td {
  padding: 0 !important;
  width: 100%;
}

.expandable-body > td > div,
.expandable-body > td > p {
  padding: 0.75rem;
}

.expandable-body .table {
  width: calc(100% - 0.75rem);
  margin: 0 0 0 0.75rem;
}

.expandable-body .table tr:first-child td,
.expandable-body .table tr:first-child th {
  border-top: none;
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

.table-hover-color tbody tr:hover {
        color: black;
        background-color: #A9A9A9;
/*        font-size: 12px;*/
        font-weight: bold;
      }

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

table.dataTable tbody tr:hover {
  background-color: #eddfdf;
}

table.dataTable tbody tr:hover > .sorting_1 {
  background-color: #eddfdf;
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