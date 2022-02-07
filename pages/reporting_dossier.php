<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-copy nav-icon"></i> REPORTING </h3>
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
                                                      $_POST['fob'], NULL, NULL, 
                                                      NULL, $_POST['num_lic'], $_GET['id_mod_trac'], 
                                                      $_GET['id_march'], $_GET['id_mod_trans'],
                                                      $_POST['ref_av'], $_POST['cod']);
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
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClientLicence">
                    <i class="fa fa-filter"></i> Filtrage
                </button>
                </h3>
                  <div class="card-tools">
                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <?php
                      /*if ($_GET['id_mod_trans'] == '1') {
                        include("enTeteImportRoute.php");
                      }*/
                    ?>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                        
                        //$maClasse-> afficherDossierClientModeTransportModeLicence2($_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_mod_trac'], 0, 25);

                    ?>
                    </form>
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
if(isset($_GET['id_mod_trac'])){

?>

<div class="modal fade rechercheMarchandise" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage MARCHANDISE.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">COMMODITY</label>
            <select name="commodity" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerMarchandiseClientModeleLicence($_GET['id_cli'], $_GET['id_mod_trac']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheMarchandise" class="btn btn-primary">Valider</button>
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
