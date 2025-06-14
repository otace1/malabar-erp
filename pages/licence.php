<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

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

  if( isset($_POST['appurement']) ){
    ?>
    <script type="text/javascript">
      window.open('appurement.php?num_lic=<?php echo $_POST['num_lic']; ?>','pop1','width=800,height=800');
    </script>
    <?php
  }

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
      $licence = $_POST['debut'];
      $num_lic = $_POST['num_lic_'.$licence];

      //echo $_POST['id_dos_'.$num_lic.'_'.$i].' - '.$_POST['cod_'.$num_lic.'_'.$i];

        $maClasse-> MAJ_cod($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['cod_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fxi($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fxi_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_montant_av($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['montant_av_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fob($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fob_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_fret($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fret_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_assurance($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['assurance_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_autre_frais($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['autre_frais_'.$num_lic.'_'.$i]);

      /*if (isset($_POST['fret_dos_'.$i]) && ($_POST['fret_dos_'.$i] != '')) {
        $maClasse-> MAJ_fret_dos($_POST['id_dos_'.$i], $_POST['fret_dos_'.$i]);
      }

      if (isset($_POST['assurance_dos_'.$i]) && ($_POST['assurance_dos_'.$i] != '')) {
        $maClasse-> MAJ_assurance_dos($_POST['id_dos_'.$i], $_POST['assurance_dos_'.$i]);
      }

      if (isset($_POST['autre_frais_dos_'.$i]) && ($_POST['autre_frais_dos_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais_dos($_POST['id_dos_'.$i], $_POST['autre_frais_dos_'.$i]);
      }*/
    }

  }
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-eye nav-icon"></i> SYNTHESE LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client.' | '.$maClasse-> getNomTypeLicence($_GET['id_type_lic']);?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                  <?php


                    if(isset($_POST['uploadeFichierLicence'])){

                      $fichier_pointage = $_FILES['fichier_licence']['tmp_name'];

                      require('../PHPExcel/Classes/PHPExcel.php');
                      require_once('../PHPExcel/Classes/PHPExcel/IOFactory.php');

                      $objExcel = PHPExcel_IOFactory::load($fichier_pointage);

                      foreach ($objExcel->getWorksheetIterator() AS $worsheet) {
                        $highestRow = $worsheet-> getHighestRow();
                        for ($row=2; $row < $highestRow ; $row++) { 
                          
                          $fournisseur = $worsheet-> getCellByColumnAndRow(0, $row)-> getValue();
                          if (isset($fournisseur)) {

                            if (isset($_POST['id_cli']) && ($_POST['id_cli'] |= '')) {
                              $client = $_POST['id_cli'];
                            }else{
                              $client = $_POST['new_client'];
                              if ( ($maClasse-> verifierClient($client) == false)) {
                                $maClasse-> creerClient($client);
                                $client = $maClasse-> getIdClient($client);
                              }else{
                                $client = $maClasse-> getIdClient($client);
                              }
                            }
                            $commodity = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $po = $worsheet-> getCellByColumnAndRow(2, $row)-> getValue();
                            $facture = $worsheet-> getCellByColumnAndRow(3, $row)-> getValue();
                            //$ = $worsheet-> getCellByColumnAndRow(1, $row)-> getValue();
                            $num_licence = $worsheet-> getCellByColumnAndRow(4, $row)-> getValue();
                            if (!isset($num_licence) || ($num_licence=='')) {
                              $num_licence = 'LIC-'.rand(1, 300).'-'.rand(301, 500);
                            }
                            $monnaie = $worsheet-> getCellByColumnAndRow(5, $row)-> getValue();
                            if ( ($maClasse-> getIdMonnaie($monnaie) == false)) {
                              $maClasse-> creerMonnaie($monnaie);
                              $monnaie = $maClasse-> getIdMonnaie($monnaie);
                            }else{
                              $monnaie = $maClasse-> getIdMonnaie($monnaie);
                            }
                            $fob = $worsheet-> getCellByColumnAndRow(6, $row)-> getValue();
                            $fret = $worsheet-> getCellByColumnAndRow(7, $row)-> getValue();
                            $assurance = $worsheet-> getCellByColumnAndRow(8, $row)-> getValue();
                            $autre_frais = $worsheet-> getCellByColumnAndRow(9, $row)-> getValue();
                            $fsi = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $aur = $worsheet-> getCellByColumnAndRow(11, $row)-> getValue();
                            $validation = $worsheet-> getCellByColumnAndRow(12, $row)-> getFormattedValue();
                            $extreme = $worsheet-> getCellByColumnAndRow(13, $row)-> getFormattedValue();
                            /*$ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();
                            $ = $worsheet-> getCellByColumnAndRow(10, $row)-> getValue();*/

                            echo $client.' - '.$fournisseur.' - '.$commodity.' - '.$po.' - '.$facture.' - '.$num_licence.' - '.$monnaie.' - '.$fob.' - '.$fret.' - '.$assurance.' - '.$autre_frais.' - '.$aur.' - '.$validation.' - '.$extreme.'<br>';
                            $maClasse-> creerLicenceIBUpload($client, $fournisseur, $po, $facture, 
                                                            $num_licence, $monnaie, $fob, $fret, 
                                                            $assurance, $autre_frais, $aur, 
                                                            $validation, $_SESSION['id_util'], $_GET['id_mod_lic'], $extreme);

                          }

                          //$periode_agent = $maClasse-> getElementPeriodeAgent($_POST['id_per'], $id_ag);

                          //$maClasse-> MAJPeriodeAgent($_POST['id_per'], $periode_agent['id_ag_bar'], $jour, $nuit, $maladie, $cc, $a_mp, $h_sup_130, $h_sup_160, $jour_f, $nuit_f);

                        }
                      }

                      /*$maClasse-> uploadeFichierPointage($_POST['id_per'], $_POST['id_ag_bar'], $_POST['jour'], $_POST['nuit'], $_POST['maladie'], $_POST['cc'], $_POST['a_mp'], $_POST['h_sup_130'], $_POST['h_sup_160'], $_POST['jour_f'], $_POST['nuit_f']);*/
                    }


                    if(isset($_POST['modifierLicence'])){
                      if ($_GET['id_mod_lic'] == '2') {
                        $maClasse-> modifierLicence($_POST['num_lic'], $_POST['date_val'], $_POST['date_exp'], 
                                                  $_POST['fournisseur'], $_POST['commodity'], $_POST['fob'], 
                                                  $_POST['fret'], $_POST['assurance'], $_POST['autre_frais'], 
                                                  $_POST['num_lic_old'], $_POST['id_mon'], $_POST['id_mod_paie'], 
                                                  $_POST['id_type_lic'], $_POST['id_sous_type_paie'], $_POST['poids'], 
                                                  $_POST['id_mod_trans'], $_POST['cod'], $_POST['consommable'], $_POST['id_banq']);
                      }else{
                        $maClasse-> modifierLicenceExport($_POST['num_lic'], $_POST['date_val'], $_POST['date_exp'], 
                                                  $_POST['acheteur'], $_POST['commodity'], $_POST['fob'], 
                                                  $_POST['fret'], $_POST['assurance'], $_POST['autre_frais'], 
                                                  $_POST['num_lic_old'], $_POST['id_mon'], $_POST['id_mod_paie'], 
                                                  $_POST['id_type_lic'], $_POST['id_mod_trans'], $_POST['id_banq']);
                      }
                      

                      if (isset($_FILES['fichier_lic']['name'])) {

                        $fichier_lic = $_FILES['fichier_lic']['name'];
                        $tmp = $_FILES['fichier_lic']['tmp_name'];

                        if (!empty($fichier_lic) && !empty($tmp) && ($fichier_lic!='') && ($tmp!='')) {
                          $maClasse-> modifierFichierLicence($_POST['num_lic'], $fichier_lic, $tmp);
                        }
                        

                      }

                      echo '<script>alert("Opération reussie!! Licence '.$_POST['num_lic_old'].' modifiée avec succès.");</script>';
                    }

                    if(isset($_POST['creerLicence'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){
                            $maClasse-> creerLicenceIB2($_POST['id_banq'], $_POST['num_lic'], $_POST['id_cli'], 
                                                      $_POST['id_post'], $_POST['id_mon'], $_POST['fob'], 
                                                      $_POST['assurance'], $_POST['fret'], $_POST['autre_frais'], 
                                                      $_POST['fsi'], $_POST['aur'], 
                                                      $_POST['id_mod_trans'], $_POST['ref_fact'], $_POST['date_fact'], 
                                                      $_POST['fournisseur'], $_POST['date_val'], $_POST['date_exp'], 
                                                      NULL, $_GET['id_mod_lic'], $_SESSION['id_util'], 
                                                      $fichier_lic, $tmp, $fichier_fact, $tmp_fact, 
                                                      $_POST['id_type_lic'], $_POST['id_mod_paie'], 
                                                      $_POST['id_sous_type_paie'], $_POST['provenance'],
                                                      $_POST['commodity'], $_POST['tonnage'], 
                                                      $_POST['poids'], $_POST['unit_mes'], $_POST['cod'], $_POST['consommable']);
                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }


                    if(isset($_POST['nouvelleLicenceExport'])){

                      if($_GET['id_mod_lic']){

                        if(!isset($_POST['num_lic']) || ($_POST['num_lic'] == '')){
                          $_POST['num_lic'] = 'INVOICE '.$_POST['ref_fact'];
                        }

                        if (isset($_FILES['fichier_lic']['name'])) {

                          $fichier_lic = $_FILES['fichier_lic']['name'];
                          $tmp = $_FILES['fichier_lic']['tmp_name'];

                        }else{
                          $fichier_lic = NULL;
                          $tmp = NULL;
                        }

                        if (isset($_FILES['fichier_fact']['name'])) {

                          $fichier_fact = $_FILES['fichier_fact']['name'];
                          $tmp_fact = $_FILES['fichier_fact']['tmp_name'];

                        }else{
                          $fichier_fact = NULL;
                          $tmp_fact = NULL;
                        }
                        if ( $maClasse-> getLicenceFacture($_POST['ref_fact']) != null ){

                          echo '<script>alert("Erreur!! Impossible de créer cette licence avec la facture '.$_POST['ref_fact'].' car il existe déjà une licence ayant cette facture.");</script>';

                        }else{

                          if ( $maClasse-> getLicence($_POST['num_lic']) == null ){

    
                            $maClasse-> creerEBTracking($_POST['num_lic'], $_POST['date_val'], $_POST['poids'], 
                                                        $_POST['unit_mes'], $_GET['id_cli'], $_POST['id_march'], 
                                                        $_POST['date_exp'], $_SESSION['id_util'], $_POST['destination'], 
                                                        $_POST['acheteur'], $_POST['id_mod_trans'], 
                                                        $_POST['ref_fact'], $fichier_lic, $tmp);


                            }else{

                              echo '<script>alert("Erreur!! Impossible de créer la licence '.$_POST['num_lic'].' car il existe déjà une licence ayant ce numéro.");</script>';

                            }
                        }

                      }

                    }
                  ?>
                <button class="btn btn-dark btn-xs square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                  <?php
                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='1') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicenceExport">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }else if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicence">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }

                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') && ($maClasse-> getNbrePartielleSansFob($_GET['id_cli'])>0)){
                    ?>
                <button class="clignoteb btn btn-xs bg-dark square-btn-adjust" onclick="window.open('popUpPartielleSansFOB.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=900,height=950');">
                    <i class="fa fa-edit"></i> Partielle Sans FOB <sup><span class="badge badge-danger"><?php echo number_format($maClasse-> getNbrePartielleSansFob($_GET['id_cli']), 0, '', '');?></span></sup>
                </button>
                  <?php
                  }
                  ?>
                <!--<button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->
                </h3>
                  <div class="card-tools">
                    <div class="pull-right">

                    <form method="POST" action="">
                        <div class="input-group input-group-sm">
                          <input type="text" name="num_lic" class="form-control float-right" placeholder="Entrez le numéro">

                          <div class="input-group-append">
                            <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                          </div>
                        </div>
                    </form>
                    <hr>
                      <!--<i class="fa fa-circle text-success"></i>--> <span class="badge badge-success">Apurée</span>
                      <!--<i class="fa fa-circle text-success"></i>--> <span class="badge badge-dark">Cloturée</span>
                      <!--<i class="fa fa-circle text-info"></i>--> <span class="badge badge-info">Partiellement</span>
                      <!--<i class="fa fa-circle text-danger"></i>--> <span class="badge badge-danger">Expirée</span>
                    <!--<button class="btn btn-success square-btn-adjust" onclick="tableToExcel('exportationExcel', 'Trackings')">
                        <i class="fas fa-file-excel"></i> Export
                    </button>-->

                    <!-- <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button> -->
                    <?php
                    if ($_GET['id_mod_lic']=='1') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Export
                      <div class="dropdown-menu" role="menu">
                        <?php
                          for ($annee=date('Y'); $annee >= 2020 ; $annee--) { 
                          ?>
                          <a class="dropdown-item"onclick="window.location.replace('exportLicenceExport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=<?php echo $annee;?>','pop1','width=80,height=80');">
                            Export <?php echo $annee;?> Licenses
                          </a>
                          <?php
                          }
                        ?>
                      </div>
                    </button>
                    <?php
                    }
                    else if ($_GET['id_mod_lic']=='2') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Export
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                          Export All Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                          Export Syntheses/License
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicenceClient.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');">
                          Export Syntheses/CLient
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2025','pop1','width=80,height=80');">
                          Export 2025 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2025','pop1','width=80,height=80');">
                          Export 2025 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2024','pop1','width=80,height=80');">
                          Export 2024 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2024','pop1','width=80,height=80');">
                          Export 2024 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2023','pop1','width=80,height=80');">
                          Export 2023 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2023','pop1','width=80,height=80');">
                          Export 2023 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Synthese
                        </a>
                      </div>
                    </button>
                    <?php
                    }
                    ?>
                    

                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <?php
                  if(isset($_POST['rech'])){
                    ?>

                <table class="tableauLicence table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      include("enTeteLicence.php");
                    ?>
                  </thead>
                  <tbody>
                    <?php
                      $maClasse-> afficherLicenceRecherche($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic'], 
                                            $_POST['num_lic']);
                    ?>
                  </tbody>

                    <?php
                  }
                ?>
                </table>
                <hr>
                <table class="tableauLicence table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      include("enTeteLicence.php");
                    ?>
                  </thead>
                  <tbody>
                    <?php
                      if( isset($_GET['id_cli']) && isset($_GET['id_type_lic']) ){
                        //$_GET['id_cli'] = null;


                        /*if(isset($_POST['rech'])){
                          $maClasse-> afficherLicenceRecherche($_GET['id_mod_lic'], $_GET['id_cli'], 
                                                      $_GET['id_type_lic'], $_POST['num_lic']);
                        }*/

                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;

                        $nombre_total_dossier = $maClasse-> getNombreLicenceClientModeLicenceTypeLicence($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_type_lic']);

                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                        if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
                        {
                           $page_actuelle=intval($_GET['page']);

                           if($page_actuelle>$nombre_de_pages) // Si la valeur de $page_actuelle (le numéro de la page) est plus grande que $nombreDePages...
                           {
                              $page_actuelle = $nombre_de_pages ;
                           }

                        }
                        else
                        {
                           $page_actuelle=1; // La page actuelle est la n°1
                        }
                        $premiere_entree=($page_actuelle-1)*$nombre_dossier_par_page; // On calcul la première entrée à lire
                        
                        if ($_GET['id_mod_lic'] == 1) {
                          $maClasse-> afficherLicenceExport($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic'],$premiere_entree, $nombre_dossier_par_page);
                        }else{
                          $maClasse-> afficherLicence($_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic'],$premiere_entree, $nombre_dossier_par_page);
                        }
                        
                      }else{
                        $page_actuelle = 1;
                        $nombre_dossier_par_page = 15;
                        $debut_affichage_pagination = 1;
                        $nombre_total_dossier = 1;
                        $nombre_de_pages = ceil($nombre_total_dossier/$nombre_dossier_par_page);

                      }
                      
                    ?>
                  </tbody>
                </table>
              </div>
              <ul class="pagination pull-right card-tools">
                  <?php
                  if ($page_actuelle > 1)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="licence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $page_actuelle - 1; ?>">Page pr&eacute;c&eacute;dente</a>
                    </li>
                  <?php
                  }

                  //Début calcul affichage boucle de pagination
                  if($page_actuelle <= 1)
                  {
                    $debut_affichage_pagination = 1;
                  }
                  else if($page_actuelle == 2)
                  {
                    $debut_affichage_pagination = $page_actuelle - 1;
                  }
                  else if($page_actuelle == 3)
                  {
                    $debut_affichage_pagination = $page_actuelle - 2;
                  }
                  else
                  {
                    $debut_affichage_pagination = $page_actuelle - 3;
                  }
                  //Fin calcul affichage boucle de pagination

                  if(($page_actuelle+6) <= $nombre_de_pages)
                  {
                    $pagination_limite = $page_actuelle+6;
                  }
                  else
                  {
                    $pagination_limite = $nombre_de_pages;
                  }

                  for($i=$debut_affichage_pagination; $i<=$pagination_limite; $i++)
                  {

                   //On va faire notre condition
                   if($i==$page_actuelle) //Si il s'agit de la page actuelle...
                   {
                  ?>
                    <li class="page-item" class="active">
                      <a class="page-link" ><?php echo $i; ?></a>
                    </li>
                  <?php
                   }
                   else
                   {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="licence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>

                  <?php
                   }
                  }

                  if ($page_actuelle < $nombre_de_pages)
                  {
                  ?>
                    <li class="page-item">
                      <a class="page-link" href="licence.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_type_lic=<?php echo $_GET['id_type_lic'];?>&page=<?php echo $page_actuelle + 1; ?>">Page suivante</a>
                    </li>
                  <?php
                  }

                  ?>
            </ul>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

  <?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])
?>

<div class="modal fade nouvelleLicence" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Licence <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">BANQUE</label>
            <select name="id_banq" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerBanque();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">NUMERO LICENCE</label>
            <input type="text" name="num_lic" class="form-control cc-exp">
          </div>
          <?php
          if(isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
            ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
            <select name="id_cli" value="<?php echo $_GET['id_cli'];?>" id="id_cli_1" onchange="xajax_selectionnerFacturePourClientModele(<?php echo $_GET['id_cli'];?>, <?php echo $_GET['id_mod_lic'];?>), xajax_afficherDetailFacture(ref_fact_systeme.value)" class="form-control cc-exp" required>
                <option value="<?php echo $_GET['id_cli'];?>">
                  <?php echo $maClasse-> getNomClient($_GET['id_cli']);?>
                </option>
                <?php
                    //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>
            <?php
            }else{
            ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUSCRIPTEUR</label>
            <select name="id_cli" id="id_cli_1" onchange="xajax_selectionnerFacturePourClientModele(this.value, <?php echo $_GET['id_mod_lic'];?>), xajax_afficherDetailFacture(ref_fact_systeme.value)" class="form-control cc-exp" required>
                <option></option>
                <?php
                    $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>
           <?php 
            }
            ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">POSTE D'ENTREE</label>
            <select name="id_post" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerPoste();
                ?>
            </select>
          </div>

          <input type="hidden" name="tonnage" value="0">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">REF. COD</label>
            <input type="text" name="cod" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TYPE MARCHANDISE</label>
            <select id="consommable" name="consommable" onchange="xajax_afficherPoidsLicenceConsommable(this.value);" class="form-control cc-exp" required>
                <option></option>
                <option value="1">CONSOMMABLE</option>
                <option value="0">DIVERS</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">WEIGHT</label>
            <span id="poids"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">UNIT OF MEASUREMENT</label>
            <select name="unit_mes" onchange="" class="form-control cc-exp">
                <option></option>
                <option value="Kg">Kg</option>
                <option value="T">T</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" onchange="" class="form-control cc-exp">
                <?php
                  $maClasse->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FOB DECLAREE</label>
            <input type="number" step="0.01" name="fob" class="form-control cc-exp">
          </div>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">ASSURANCE</label>
              <input type="number" min="0" step="0.01" name="assurance" class="form-control cc-exp">
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FRET</label>
              <input type="number" min="0" step="0.01" name="fret" class="form-control cc-exp">
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUTRES FRAIS</label>
              <input type="number" min="0" step="0.01" name="autre_frais" class="form-control cc-exp">
            </div>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODE TRANSPORT</label>
            <select name="id_mod_trans" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerModeTransport();
                ?>
            </select>
          </div>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
          <?php
          if(isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
            ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE SYSTEME</label>
              <select id="ref_fact_systeme" class="form-control cc-exp" onchange="xajax_afficherDetailFacture(this.value)">
                <option value=""></option>
                  <?php
                    $maClasse->selectionnerFacturePourClientModele($_GET['id_cli'], $_GET['id_mod_lic']);
                  ?>
              </select>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <span id="ref_fact"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <span id="date_fact"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
              <span id="commodity"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <span id="fournisseur"></span>
            </div>
            <?php
            }else{
            ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE SYSTEME</label>
              <select id="ref_fact_systeme" class="form-control cc-exp" onchange="xajax_afficherDetailFacture(this.value)">
                <option value=""></option>
                  <?php
                    //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                  ?>
              </select>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <span id="ref_fact"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <span id="date_fact"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
              <input type="text" value="N/A" name="commodity">
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <span id="fournisseur"></span>
            </div>
           <?php 
            }
            ?>
            <?php
                }
              ?>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE EMISSION LICENCE</label>
              <span id="date_val"></span>
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION LICENCE</label>
            <input type="date" name="date_val" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp">
          </div>
          
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">DATE EXPIRATION LICENCE</label>
            <input type="date" name="date_exp" min="<?php echo date('Y-m-d');?>" class="form-control cc-exp">
          </div>
          
          <?php
            if($modele['id_mod_lic'] == '1' && isset($modele)){
              ?>
              
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">ACHETEUR</label>
            <input type="text" name="acheteur" class="form-control cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">QUANTITE DECLAREE (Kg)</label>
            <input type="number" step="0.01" name="qte_decl" class="form-control cc-exp" required>
          </div>
            <?php
                }
              ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER LICENCE</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp" required>
              <option value="<?php echo $_GET['id_type_lic'];?>">
                <?php echo $maClasse-> getNomTypeLicence($_GET['id_type_lic']); ?>
              </option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">MODALITE PAIEMENT</label>
            <select name="id_mod_paie" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerModalitePaiement();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">SOUS-TYPE PAIEMENT</label>
            <select name="id_sous_type_paie" onchange="" class="form-control cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerSousTypePaiement($modele['id_mod_lic']);
                ?>
            </select>
          </div>

            <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
                
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">PROVENANCE</label>
              <input type="text" name="provenance" class="form-control cc-exp" required>
            </div>
            <?php
                }
              ?>

          <?php
              if($modele['id_mod_lic'] == '2' && isset($modele)){
                ?>
            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">FSI</label>
              <span id="fsi"></span>
            </div>

            <div class="col-md-3">
              <label for="x_card_code" class="control-label mb-1">AUR</label>
              <span id="aur"></span>
            </div>
            <?php
                }
              ?>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerLicence" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <input type="hidden" name="id_type_lic" value="<?php echo $_GET['id_type_lic'];?>">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>
<!-- 
          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerTypeLicence();
                ?>
            </select>
          </div> -->

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>



<div class="modal fade nouvelleLicenceExport" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Licence <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">NUMERO LICENCE</label>
            <input name="num_lic" type="text" class="form-control cc-exp" required>
          </div>

          <?php
          if ($_GET['id_mod_lic'] == 1) {
          ?>
          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MARCHANDISE</label>
            <select name="id_march" type="text" class="form-control cc-exp" required>
              <option></option>
              <?php $maClasse-> selectionnerMarchandiseClientModeleLicence2($_GET['id_cli'], $_GET['id_mod_lic']);?>
            </select>
          </div>

          <?php
          }
          ?>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DESTINATION</label>
            <input name="destination" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">ACHETEUR</label>
            <input name="acheteur" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MODE DE TRANSPORT</label>
            <select name="id_mod_trans" type="text" class="form-control cc-exp" required>
              <option></option>
              <?php $maClasse-> selectionnerModeTransport();?>
            </select>
          </div>
          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE VALIDATION</label>
            <input name="date_val" type="date" class="form-control cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE EXTREME VALIDATION</label>
            <input name="date_exp" type="date" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">POIDS/WEIGHT</label>
            <input name="poids" type="number" step="0.001" min="0" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">U.M.</label>
            <select name="unit_mes" onchange="" class="form-control cc-exp">
              <option value='T'>T</option>
              <option value='Kg'>Kg</option>
            </select>
          </div>

          <?php
          if(isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
            ?>
            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE SYSTEME</label>
              <select id="ref_fact_systeme" class="form-control cc-exp" onchange="xajax_afficherDetailFactureExport(this.value)">
                <option value=""></option>
                  <?php
                    $maClasse->selectionnerFacturePourClientModele($_GET['id_cli'], $_GET['id_mod_lic']);
                  ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <span id="ref_factExport"></span>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <span id="date_factExport"></span>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
              <span id="commodityExport"></span>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <span id="fournisseurExport"></span>
            </div>
            <?php
            }else{
            ?>
            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE SYSTEME</label>
              <select id="ref_fact_systeme" class="form-control cc-exp" onchange="xajax_afficherDetailFacture(this.value)">
                <option value=""></option>
                  <?php
                    //$maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_trac']);
                  ?>
              </select>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">N<sup><u>o</u></sup> FACTURE</label>
              <span id="ref_factExport"></span>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">DATE FACTURE</label>
              <span id="date_factExport"></span>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
              <input type="text" value="N/A" name="commodityExport">
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOURNISSEUR</label>
              <span id="fournisseurExport"></span>
            </div>
           <?php 
            }
            ?>
          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">FICHIER LICENCE</label>
            <input type="file" name="fichier_lic" class="form-control cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="nouvelleLicenceExport" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>

<?php
if(isset($_GET['id_mod_lic']) && isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade appurement" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Appurement Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">LICENCE</label>
            <select name="num_lic" onchange="" class="form-control cc-exp">
              <option value=''></option>
                <?php
                  if(!isset($_GET['id_cli']) || ($_GET['id_cli'] == '')){
                    $_GET['id_cli'] = null;
                  }
                  if(!isset($_GET['id_type_lic']) || ($_GET['id_type_lic'] == '')){
                    $_GET['id_type_lic'] = null;
                  }
                  
                  $maClasse->selectionnerLicenceModele2($modele['id_mod_lic'], $_GET['id_cli'], $_GET['id_type_lic']);
                  
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="appurement" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>
