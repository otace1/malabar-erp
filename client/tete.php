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
  <!-- <link rel="stylesheet" type="text/css" href="query.dataTables.min.css"> -->
  <link rel="stylesheet" type="text/css" href="jquery.dataTables.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->

  <script src="../plugins/jquery/jquery.min.js"></script>
  <script src="jquery.dataTables.min.js"></script>
  <script src="dataTables.bootstrap.min.js"></script>
  <script src="dataTables.autoFill.min.js"></script>


  <link rel="stylesheet" type="text/css" href="dataTables.bootstrap.min.css">
  <!-- <link rel="stylesheet" type="text/css" href="autoFill.dataTables.min.css"> -->
  <!-- <script src="jquery.min.js"></script> -->

  <script src="../pages/graphiques/code/highcharts.js"></script>
  <script src="../pages/graphiques/code/modules/exporting.js"></script>
  <script src="../pages/graphiques/code/modules/export-data.js"></script>

  <!-- --------- AJAX -------- -->

  <!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
  <!-- <script src="ajax/jquery-1.12.4.js"></script> -->
  <!--<script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>-->
  <!-- <script src="ajax/jquery.dataTables.min.js"></script> -->
  <!--<script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>-->
  <!-- <script src="ajax/dataTables.bootstrap.min.js"></script> -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />-->
  <!-- <link rel="stylesheet" href="ajax/bootstrap-datepicker.css" /> -->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>-->
  <!-- <script src="ajax/bootstrap-datepicker.js"></script> -->
  <!-- --------- AJAX -------- -->

  <link rel="icon" href="../images/logo.jpeg" type="image/x-icon">
      <style type="text/css">
        td.highlight {
        font-weight: bold;
        background-color: #318ce7;
        color: white;
    }

    .box
   {
    width:1270px;
    padding:20px;
    background-color:#fff;
    border:1px solid #ccc;
    border-radius:5px;
    margin-top:25px;
   }
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

    </style>
    <script type="text/javascript">

      function is_weekend(date1){
          var dt = new Date(date1);
           
          if(dt.getDay() == 0)
             {
              alert('Be careful, you have selected a Sunday!!');
              //return "weekend";
              } 
      }

    </script>
</head>