<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><img src="../images/conforme.png" width="30px"> Risque Douane</h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-file_data_dossier_risque_douane table-responsive p-0">
                <table id="file_data_dossier_risque_douane" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Reference</th>
                      <th style=""></th>
                      <th style="">Etape / Type</th>
                      <th style="">Statut</th>
                      <th style="">Date Document</th>
                      <th style="">Date réception</th>
                      <th style="">Date Prochaine Pres.</th>
                      <th style="">Date Presentation</th>
                      <th style="">Initiateur</th>
                      <th style="">Regime / Procedure</th>
                      <th style="">Remarques</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    // $maClasse-> afficherStatutDossierFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
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
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<div class="modal fade creerDossierRisque" id="modal_creerDossierRisque">
  <div class="modal-dialog ">
    <form method="POST" id="form_creerDossierRisque" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="creerDossierRisque">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Notification</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Ref. Document</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="ref_doc" name="ref_doc" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Etape/Type Document</label>
            <select name="id_etap" id="id_etap" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerEtatPV();
                ?>
            </select>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Document</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_doc" name="date_doc" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Reception</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_recept" name="date_recept" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Prochaine Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_proch_pres" name="date_proch_pres" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Initiateur de la notification</label>
            <select name="id_bur_douane" id="id_bur_douane" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerBureauDouane3();
                ?>
            </select>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Procedure / Regime</label>
            <select name="id_reg" id="id_reg" class="form-control cc-exp form-control-sm" required>
              <option></option>
              <?php
                $maClasse-> selectionnerRegimeGrouping();
              ?>
            </select>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Fichier</label>
            <input class="form-control cc-exp form-control-sm" type="file" id="fichier" name="fichier" required>
          </div>

        <!-- </div> -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="" class="btn-xs btn-primary">Créer</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_dossier_risque_douane">
  <div class="modal-dialog modal-lg">
    <form method="POST" id="form_editDossierRisque" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="editDossierRisque">
      <input type="hidden" name="id" id="id_edit">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Ref. Document</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="ref_doc_edit" name="ref_doc" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Etape/Type Document</label>
            <select name="id_etap" id="id_etap_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerEtatPV();
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Statut</label>
            <select name="id_sen" id="id_sen_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerScenario();
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date Document</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_doc_edit" name="date_doc" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date Reception</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_recept_edit" name="date_recept" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date Prochaine Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_proch_pres_edit" name="date_proch_pres" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Date Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_pres_edit" name="date_pres">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Initiateur de la notification</label>
            <select name="id_bur_douane" id="id_bur_douane_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerBureauDouane3();
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Procedure / Regime</label>
            <select name="id_reg" id="id_reg_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
              <?php
                $maClasse-> selectionnerRegimeGrouping();
              ?>
            </select>
          </div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <textarea class="form-control cc-exp form-control-sm" id="remarque_edit" name="remarque"></textarea>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Nouveau Fichier</label>
            <input class="form-control cc-exp form-control-sm" type="file" id="fichier_edit" name="fichier">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button> -->
        <button type="submit" name="" class="btn-xs btn-primary">Enregistrer</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  function modal_dossier_risque_douane(id){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_dossier_risque_douane', id: id},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_edit').val(id);
          //ref_doc
          $('#ref_doc_edit').val(data.ref_doc);
          //date_doc
          $('#date_doc_edit').val(data.date_doc);
          //date_recept
          $('#date_recept_edit').val(data.date_recept);
          //date_proch_pres
          $('#date_proch_pres_edit').val(data.date_proch_pres);
          //date_pres
          $('#date_pres_edit').val(data.date_pres);
          //id_bur_douane
          $('#id_bur_douane_edit').val(data.id_bur_douane);
          //id_reg
          $('#id_reg_edit').val(data.id_reg);
          //id_etap
          $('#id_etap_edit').val(data.id_etap);
          //id_sen
          $('#id_sen_edit').val(data.id_sen);
          //remarque
          $('#remarque_edit').val(data.remarque);

          $('#modal_dossier_risque_douane').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $('#file_data_dossier_risque_douane').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        ['10 Lignes', '100 Lignes', '500 Lignes', 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        {
          text: '<i class="fa fa-plus"></i> Notification',
          className: 'btn btn-info',
          action: function ( e, dt, node, config ) {
              $('#modal_creerDossierRisque').modal('show');
          }
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i> Exporter En Excel',
          className: 'btn btn-success'
        },
        {
          extend: 'pageLength',
          text: '<i class="fa fa-list"></i> Affichage',
          className: 'btn btn-dark'
        }
    ],
    
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": true,
  "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "dossier_risque_douane"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_doc"},
      {"data":"btn_action"},
      {"data":"nom_etap"},
      {"data":"nom_sen"},
      {"data":"date_doc"},
      {"data":"date_recept"},
      {"data":"date_proch_pres"},
      {"data":"date_pres"},
      {"data":"nom_bur_douane"},
      {"data":"nom_reg"},
      {"data":"remarque"}
    ] 
  });

  $(document).ready(function(){

    $('#form_creerDossierRisque').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous creer cette notification ?')) {
          
          $('#spinner-div').show();
          $('#modal_creerDossierRisque').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
                alert(data.message);
              }
            },
            complete: function () {
                loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

  $(document).ready(function(){

    $('#form_editDossierRisque').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous modifier notification ?')) {
          
          $('#spinner-div').show();
          $('#modal_dossier_risque_douane').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                
                $( 'form' ).each(function(){
                    this.reset();
                });

                $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
                alert(data.message);
              }
            },
            complete: function () {
                loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

  $(document).ready(function(){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'dossier_risque_douane'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });

  function loadPV(){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'dossier_risque_douane'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

    $('#form_modificationPVContentieux').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous modifier ce PV ?')) {
          
          $('#spinner-div').show();
          $('#modal_dossier_risque_douane').modal('hide');

          var fd = new FormData(this);
          // alert($(this).attr('action'));
          $.ajax({

            url: 'ajax.php',
            type: 'post',
            processData: false,
            contentType: false,
            data: fd,
            dataType: 'json',
            success:function(data){
              if (data.logout) {
                alert(data.logout);
                window.location="../deconnexion.php";
              }else{
                $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
                alert(data.message);
              }
            },
            complete: function () {
                loadPV();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }

          });


      }

    });
  
  });

  function modal_actePV(id){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_actePV', id: id},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_acte').val(data.id_acte);
          $('#ref_pv_acte').val(data.ref_pv_acte);
          $('#tableau_acte_pv').html(data.tableau_acte_pv);
          $('#modal_actePV').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function ajouterActePV(date_act, detail_act, id){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'ajouterActePV', id: id, date_act: date_act, detail_act: detail_act},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_acte_pv').html(data.tableau_acte_pv);
          $('#file_data_dossier_risque_douane').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

</script>