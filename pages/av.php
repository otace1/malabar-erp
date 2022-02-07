<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

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

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-file nav-icon"></i> ATTESTASTION DE VERIFICATION <?php echo $client;?></h3>
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
                <button class="btn btn-primary square-btn-adjust" data-toggle="modal" data-target=".creerAV">
                    <i class="fa fa-plus"></i> Nouvelle AV
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
                    <!--<div class="pull-right">
                      <span class="badge badge-success">Ayant une licence</span>
                      <span class="badge badge-danger">Ayant depasser 2 jours sans Licence</span>
                    </div>-->

                  </div>

                  <?php
                    if(isset($_POST['creerAV'])){

                      if($_GET['id_mod_lic']){

                        if (isset($_FILES['fichier_av']['name'])) {

                          $fichier_av = $_FILES['fichier_av']['name'];
                          $tmp_av = $_FILES['fichier_av']['tmp_name'];

                        }else{
                          $fichier_av = NULL;
                          $tmp_av = NULL;
                        }

                        $maClasse-> creerAV($_POST['cod'], $_POST['date_av'], $_POST['montant_av'], 
                                                  $_POST['fix'], $_POST['num_lic'], $fichier_av, $tmp_av,
                                                  $_SESSION['id_util'], $_POST['id_mon']);

                        echo '<script>alert("Opération réussie! Attestation de vérification '.$_POST['cod'].' a été créée avec succès.");</script>';
                        

                      }

                    }
                  ?>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 cadre-tableau-de-donnees">
                <table class="tableau-de-donnees  table  table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;">#</th>
                      <th style="border: 1px solid white;">COD BIV REF</th>
                      <th style="border: 1px solid white;">DATE COD</th>
                      <th style="border: 1px solid white;">LICENCE</th>
                      <th style="border: 1px solid white;">FXI</th>
                      <th style="border: 1px solid white;">MONNAIE</th>
                      <th style="border: 1px solid white;">FOB AV</th>
                      <th colspan="2" style="border: 1px solid white;">DOSSIERS</th>
                      <th style="border: 1px solid white;">FOB DOSSIERS</th>
                      <th style="border: 1px solid white;">BALANCE FOB</th>
                      <th style="border: 1px solid white;">FICHIER</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                      if(!isset($_GET['id_cli'])){
                        $_GET['id_cli'] = null;
                      }
                      if(!isset($_GET['id_type_lic'])){
                        $_GET['id_type_lic'] = null;
                      }
                      $maClasse-> afficherAV($_GET['id_mod_lic'], $_GET['id_cli']);
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
  <?php include("pied.php");?>
  
<?php
if(isset($_GET['id_mod_lic'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])
?>

<div class="modal fade creerAV" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle AV.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">LICENCE </label>
            <select name="num_lic" id="" class="form-control cc-exp" onchange="" required>
              <option value=""></option>
              <option value="UNDER VALUE">UNDER VALUE</option>
                <?php
                  $maClasse->selectionnerLicenceEnCoursModele($_GET['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">COD BIV REF</label>
            <input type="text" name="cod" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE COD</label>
            <input type="date" name="date_av" max="<?php echo date('Y-m-d');?>" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MONTANT AV</label>
            <input type="number" step="0.01" min="0" name="montant_av" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">MONNAIE</label>
            <select name="id_mon" onchange="" class="form-control cc-exp" required>
                <?php
                  $maClasse->selectionnerMonnaie();
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">FXI REF</label>
            <input type="text" name="fix" class="form-control cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">FICHIER AV</label>
            <input type="file" name="fichier_av" class="form-control cc-exp">
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
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
