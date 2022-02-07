<?php
  session_start();

  if (!$_SESSION) {
    header("Location: ../../deconnexion.php");
  }

  include('../../classes/maClasse.class.php');

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
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <!--<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->


  <script src="graphiques/code/highcharts.js"></script>
  <script src="graphiques/code/modules/exporting.js"></script>
  <script src="graphiques/code/modules/export-data.js"></script>

  <link rel="icon" href="../../images/logo.jpeg" type="image/x-icon">
      <style type="text/css">
    
      .tableau1{
        width: auto;
        overflow-x: scroll;
        margin-left: 17em;
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


    </style>
</head>