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
          <h5>
            <!-- <img src="../images/calculator.png" width="25px" /> -->
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo $maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']).' INVOICES DASHBOARD ';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'TABLEAU DE BORD FACTURE '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']);
              }
            ?>
          </h5>
          <div class="pull-right">
            <!-- <button class="btn btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button> -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-primary">
              <div class="inner">
                <h5>
                  <span id="nbre_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Invoices';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Factures';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_factures"></a>
              
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h5>
                  <span id="nbre_dossier_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Invoiced Files';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Facturés';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_dossiers_factures"></a>
              <!-- <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFacturation.php?statut=Dossiers Facturés&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>','pop1','width=1200,height=700');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a> -->
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h5>
                  <span id="nbre_dossier_non_facture"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Pending Files';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Non Facturés';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDashboardFacturation.php?statut=Dossiers Non Facturés&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>','pop1','width=1200,height=700');">
                Details <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-6 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <!-- <h5 class="card-title" style="font-weight: bold;">
                          Monitoring
                        </h5> -->
                        <div class="row">
                            <div class="col-md-4">
                              <label for="x_card_code" class="control-label mb-1">Starting</label>
                              <input id="debut" type="date" class="form-control form-control-sm cc-exp">
                            </div>

                            <div class="col-md-4">
                              <label for="x_card_code" class="control-label mb-1">End</label>
                              <input id="fin" type="date" class="form-control form-control-sm cc-exp">
                            </div>

                            <div class="col-md-4">
                              <label for="x_card_code" class="control-label mb-1">-</label>
                              <button class="form-control form-control-sm cc-exp btn-xs btn-primary" onclick="afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>, debut.value, fin.value);">Submit</button>
                            </div>

                          </div>
<!-- 
                        <div class="card-tools">
                          <div class="row">
                            <div class="col-md-4">
                              <label for="x_card_code" class="control-label mb-1">Begin</label>
                              <input id="debut" type="date" class="form-control cc-exp">
                            </div>

                          </div>
                        </div> -->
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <span id="label_monitoring"></span>
                        <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                          <thead>
                            <tr class="bg bg-dark">
                              <th style="border: 1px solid white;">#</th>
                              <th style="border: 1px solid white;">Users</th>
                              <th style="border: 1px solid white; text-align: center;" colspan="2">Invoices Created</th>
                              <th style="border: 1px solid white; text-align: center;" colspan="2">Files Invoiced</th>
                            </tr>
                          </thead>
                          <tbody id="afficherMonitoringFacturation">
                            <?php
                            // $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
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
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<?php
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog">
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

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

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

<?php
}
?>

<script type="text/javascript">
  
  $(document).ready(function(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'rapportFacturation', id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nbre_facture').html(data.nbre_facture);
          $('#nbre_dossier_facture').html(data.nbre_dossier_facture);
          $('#nbre_dossier_non_facture').html(data.nbre_dossier_non_facture);
          $('#btn_info_factures').html(data.btn_info_factures);
          $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });

  function afficherMonitoringFacturation(id_mod_lic, debut=null, fin=null){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringFacturation', id_mod_lic: id_mod_lic, debut: debut, fin: fin},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_monitoring').html('Report between '+debut+' and '+fin);
          $('#nbre_facture').html(data.nbre_facture);
          $('#nbre_dossier_facture').html(data.nbre_dossier_facture);
          $('#btn_info_factures').html(data.btn_info_factures);
          $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          $('#afficherMonitoringFacturation').html(data.afficherMonitoringFacturation);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }


</script>
