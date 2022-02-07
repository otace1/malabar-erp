<?php
  include("tete.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    echo "<script>window.location='licence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli';</script>";
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
  <!-- /.navbar -->
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
        <h3><i class="far fa-eye nav-icon"></i> SYNTHESE LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?></h3>
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
                    if(isset($_POST['creerDossier'])){
                        if($_GET['id_mod_trac'] == '2'){
                          $maClasse-> creerDossierIB($_POST['ref_dos'], $_POST['id_cli'], $_POST['ref_fact'], 
                                                      $_POST['fob'], $_POST['fret'], $_POST['assurance'], 
                                                      $_POST['autre_frais'], $_POST['num_lic'], $_GET['id_mod_trac'], 
                                                      $_GET['id_march']);
                        }
                        /*
                        ?>
                        <script type="text/javascript">
                            alert('Agent <?php echo $_POST['nom_ag'].' '.$_POST['postnom_ag'].' '.$_POST['prenom_ag'];?> créé avec succes!');
                        </script>
                        <?php
                        */
                    }
                  ?>
                <button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".nouveauDossier">
                    <i class="fa fa-plus"></i> Nouveau Dossier
                </button>
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient1">
                    <i class="fa fa-filter"></i> Recherche
                </button>
                </h3>
                  <div class="card-tools">
                <form method="POST" action="">
                    <div class="input-group input-group-sm">
                      <input type="text" name="" class="form-control float-right" placeholder="Entrez le numéro">

                      <div class="input-group-append">
                        <button type="submit" name="rech" class="btn btn-info"><i class="fas fa-search"></i></button>
                      </div>
                    </div>
                </form>
                    <div class="pull-right">
                      <!--<i class="fa fa-circle text-success"></i>--> <span class="badge badge-success">Appurée</span>
                      <!--<i class="fa fa-circle text-info"></i>--> <span class="badge badge-info">Partiellement</span>
                      <!--<i class="fa fa-circle text-danger"></i>--> <span class="badge badge-danger">Expiree</span>
                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      include("enTeteDossier.php");
                    ?>
                  </thead>
                  <tbody>
                    <?php
                      if(!isset($_GET['id_cli'])){
                        $_GET['id_cli'] = null;
                      }
                      $maClasse-> afficherDossier($_GET['id_march'], $_GET['id_cli']);
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php //include("pied.php");?>
  </div>
  </body>
  </html>