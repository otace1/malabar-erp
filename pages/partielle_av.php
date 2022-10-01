<?php
  include("tete.php");

  if (isset($_POST['creerPartielle'])) {

    $maClasse-> creerPartielle($_POST['num_part'], $_POST['fob'], $_POST['poids'], $_GET['cod']);

  }

 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card-<?php echo $couleur;?>">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i> 
                        Partielles 
                        <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">
                          <?php echo $_GET['cod'];?>
                          </span> | 
                          Solde Fob: 
                          <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">
                            <?php echo number_format($_GET['fob_lic']-$maClasse-> getPartielleCOD($_GET['cod'])['fob'], 2, ',', ' ');?>
                          </span> | 
                          Solde poids: 
                          <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">
                            <?php echo number_format($_GET['poids_lic']-$maClasse-> getPartielleCOD($_GET['cod'])['poids'], 2, ',', ' ');?>
                          </span>  
                          <sup><button class="btn btn-xs btn-primary square-btn-adjust" data-toggle="modal" data-target=".creerPartielle">
                            <i class="fa fa-plus"></i>
                        </button></sup>

                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0" style="height: 500px;">
                              <table class="table table-dark  table-head-fixed table-bordered table-hover text-nowrap table-sm">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>Partielle</th>
                                    <th>FOB</th>
                                    <th>FOB Dossiers</th>
                                    <th>Solde FOB</th>
                                    <th>Poids</th>
                                    <th>Poids Dossiers</th>
                                    <th>Solde Poids</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php
                                    $maClasse-> afficherPartielleCOD($_GET['cod']);
                                  ?>
                                </tbody>
                              </table>
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
              <input type="text" value="<?php echo $_GET['cod'];?>" class="form-control cc-exp bg bg-dark" disabled>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Num.Partielle</label>
              <input type="text" name="num_part" class="form-control cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">FOB</label>
              <input type="number" step="0.01" max="<?php echo $_GET['fob_lic']-$maClasse-> getPartielleCOD($_GET['cod'])['fob'];?>" name="fob" class="form-control cc-exp" required>
            </div>

            <div class="col-md-4">
              <label for="x_card_code" class="control-label mb-1">Poids</label>
              <input type="number" step="0.01" name="poids" class="form-control cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
          <button type="submit" name="creerPartielle" class="btn btn-primary">Valider</button>
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
