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
            <span class="float-right">
              <!-- <button class="btn btn-xs btn-info" ></button> -->
              <div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-list"></i> View all files
                </button>
                <div class="dropdown-menu">
                  <?php
                    for ($i=date('Y'); $i >= 2020 ; $i--) { 
                  ?><a class="dropdown-item" href="#" onclick="window.open('popFilesInvoicingStatus.php?statut=Factures&amp;id_mod_lic=<?php echo $_GET['id_mod_lic_fact']?>&annee=<?php echo $i;?>','pop1','width=1200,height=700');"><?php echo $i;?> Files</a><?php
                    }
                  ?>
                </div>
              </div>
            </span>
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
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h5>
                  <span id="nbre_facture_sans_taux"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Files invoiced awaiting banks rates';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Dossiers Factures en attente des taux bancaires';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-exclamation"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="modal_awaiting_rate(<?php echo $_GET['id_mod_lic_fact'];?>);">
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
                        
<!-- 
                        <div class="card-tools">
                          <div class="row">
                            <div class="col-md-4">
                              <label for="x_card_code" class="control-label mb-1">Begin</label>
                              <input id="debut" type="date" class="form-control cc-exp">
                            </div>

                          </div>
                        </div> -->
                        <button class="btn btn-primary btn-xs" onclick="$('#modal_search').modal('show');"><i class="fa fa-search"></i> Search</button>
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

          <div class="col-md-4 col-sm-6 col-12">
             <section class="content">
              <div class="container-fluid" style="">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h5 class="card-title" style="font-weight: bold;">
                          <i class="fa fa-tachometer-alt"></i> Files Status Monitoring
                        </h5>
                        <div class="float-right">
                          
                        </div>
                      </div>    
                      <!-- /.card-header -->

                      <div class="card-body table-responsive p-0">
                        <span id="label_monitoring"></span>
                        <table class=" table table-head-fixed table-bordered table-hover text-nowrap table-sm">
                          <thead>
                            <tr class="">
                              <th>Status</th>
                              <th width="20%">Nbre</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Missing E, L or Q','Missing E, L or Q','width=1000,height=800');">
                              <td>Missing E, L or Q</td>
                              <td style="text-align: right;"><span class="badge badge-warning text-sm" id="nbre_awaiting_elq"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Waiting to be invoiced','Waiting to be invoiced','width=1000,height=800');">
                              <td>Waiting to be invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-info text-sm" id="nbre_awaiting_invoice"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Invoiced','Invoiced','width=1000,height=800');">
                              <td>Invoiced</td>
                              <td style="text-align: right;"><span class="badge badge-success text-sm" id="nbre_invoiced"></span></td>
                            </tr>
                            <tr  onMouseOver="this.style.cursor='pointer'" onclick="window.open('statutDossierFacturation2.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_cli='+id_cli.value+'&statut=Disabled','Disabled','width=1000,height=800');">
                              <td>Disabled</td>
                              <td style="text-align: right;"><span class="badge badge-danger text-sm" id="nbre_disabled"></span></td>
                            </tr>
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

<div class="modal fade " id="modal_search">
  <div class="modal-dialog modal-md">
    <!-- <form id="form_edit_statut_dossier_facturation" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-search"></i> Search </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Client</label>
            <select id="id_cli" class="form-control form-control-sm cc-exp">
              <option></option>
              <?php
                $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
              ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Starting</label>
            <input id="debut" type="date" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">End</label>
            <input id="fin" type="date" class="form-control form-control-sm cc-exp">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button name="" class="btn btn-xs btn-primary" onclick="afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>, debut.value, fin.value);">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    afficherMonitoringFile();
  });

  function afficherMonitoringFile(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringFile', id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, id_cli: $('#id_cli').val()},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nbre_awaiting_elq').html(new Intl.NumberFormat('en-US').format(data.nbre_awaiting_elq));
          $('#nbre_awaiting_invoice').html(new Intl.NumberFormat('en-US').format(data.nbre_awaiting_invoice));
          $('#nbre_invoiced').html(new Intl.NumberFormat('en-US').format(data.nbre_invoiced));
          $('#nbre_disabled').html(new Intl.NumberFormat('en-US').format(data.nbre_disabled));
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function appliquer_taux(id){
    if(confirm('Do really you want to update the files rates regarding this rates ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'appliquer_taux', id: id},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            // afficherMonitoringTaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }

  function MAJ_id_bank_liq(id_dos, id_bank_liq, id_mod_lic){
    if(confirm('Do really you want to update ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'maj_id_bank_liq2', id_dos: id_dos, id_bank_liq: id_bank_liq, id_mod_lic: id_mod_lic},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#files_awaiting_rate').html(data.files_awaiting_rate);
            $('#nbre_facture_sans_taux').html(data.nbre_facture_sans_taux);
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }

  function modal_awaiting_rate(id_mod_lic){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'files_awaiting_rate', id_mod_lic: id_mod_lic},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#files_awaiting_rate').html(data.files_awaiting_rate);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
    $('#modal_awaiting_rate').modal('show');
  }

  function delete_taux_banque(id){
    if(confirm('Do really you want to delete this rates ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'delete_taux_banque', id: id},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            // afficherMonitoringTaux();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }


  $(document).ready(function(){

    $('#form_creation_taux_banque').submit(function(e){

            e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

          $('#modal_creation_taux_banque').modal('hide');
          // alert('Hello');

          var fd = new FormData(this);
          $('#spinner-div').show();

          $.ajax({
            type: 'post',
            url: 'ajax.php',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $( '#form_creation_taux_banque' ).each(function(){
                    this.reset();
                });
                // afficherMonitoringTaux();
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  function modal_creation_taux_banque(){
    $('#modal_creation_taux_banque').modal('show');
  }
  
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
          $('#nbre_facture_sans_taux').html(data.nbre_facture_sans_taux);
          $('#btn_info_factures').html(data.btn_info_factures);
          $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          afficherMonitoringFacturation(<?php echo $_GET['id_mod_lic_fact'];?>);
          // afficherMonitoringTaux();
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
      data: {operation: 'afficherMonitoringFacturation', id_mod_lic: id_mod_lic, debut: debut, fin: fin, id_cli: $('#id_cli').val()},
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
          afficherMonitoringFile();
          $('#modal_search').modal('hide');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }


</script>
