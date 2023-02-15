<?php
  include("tete.php");
  // $licence = $maClasse-> getLicence($_GET['num_lic']);

  if (isset($_POST['creerPartielle'])) {

    $maClasse-> creerPartielle($_POST['num_part'], $_POST['fob'], $_POST['poids'], $_GET['cod']);

  }

  if (isset($_POST['editPartielle'])) {

    $maClasse-> editPartielle($_POST['id_part'], $_POST['fob'], $_POST['poids'], $_SESSION['id_util']);
    echo '<script>alert("Partielle modifiee avec succes!");</script>';

  }

 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <!-- /.card-header -->
                  <div class="card ">
                    <div class="card-header">
                      <h3 class="card-title">
                        <?php echo $_GET['etat'];?>
                        <!-- <button class="btn btn-success" onclick="window.location.replace('exportPopPartielleLicence.php?num_lic=<?php echo $_GET['num_lic']; ?>','pop1','width=80,height=80');">
                          <i class="fa fa-file-excel"></i>
                        </button> -->
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="height: 600px;">
                              <!-- <button class="btn btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".creerPartielle">
                                  <i class="fa fa-plus"></i> Nouvelle Partielle
                              </button> -->
                              <table class="table  table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm small">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th style="text-align: left; ">COD</th>
                                    <th style="text-align: center; ">Partial</th>
                                    <th></th>
                                    <th style="text-align: center; ">Client</th>
                                    <th style="text-align: left; ">License Ref.</th>
                                    <th style="text-align: center; ">License Type</th>
                                    <th style="text-align: center; ">Partial Weight</th>
                                    <th style="text-align: center; ">Partial FOB</th>
                                    <th style="text-align: center; " colspan="2">Partial Files</th>
                                    <th style="text-align: center; ">Files Weight</th>
                                    <th style="text-align: center; ">Files FOB</th>
                                    <th style="text-align: center; ">Balance Weight</th>
                                    <th style="text-align: center; ">Balance FOB</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherPartielleEtat($_GET['id_cli'], $_GET['etat'], $_GET['consommable']);
                                  ?>
                                </tbody>
                              </table>
                              <hr>
                            </div>
                        </div>
                    </div>
                        <!-- input states -->
                    <!-- /.card-body -->
                  </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>

  <div class="modal fade creerPartielle" id="modal-default">
    <div class="modal-dialog">
      <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nouvelle Partielle</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">COD</label>
              <input type="text" value="<?php echo $_GET['cod'];?>" class="form-control form-control-sm cc-exp bg bg-dark" disabled>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Num.Partielle</label>
              <input type="text" name="num_part" class="form-control form-control-sm cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" step="0.01" min="0" max="<?php echo $licence['fob']-$maClasse-> getPartielleCOD($_GET['cod'])['fob'];?>" name="fob" class="form-control form-control-sm cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Poids</label>
              <input type="number" step="0.01" min="0" name="poids" class="form-control form-control-sm cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Annuler</button>
          <button type="submit" name="creerPartielle" class="btn btn-primary btn-sm">Valider</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <?php
  include 'pied.php';
  ?>