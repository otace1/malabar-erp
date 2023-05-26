<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  // include("menuGauche.php");
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
          <h5><img src="../images/conforme.png" width="30px"> PV CONTENTIEUX</h5>
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
                <h5 class="card-title" style="font-weight: bold;">
                  Suivi PV de Contentieux
                </h5>


                <div class="card-tools">

                    <div class="pull-right">
                      <button class="btn btn-xs bg-purple square-btn-adjust" data-toggle="modal" data-target=".creerPVContentieux">
                          <i class="fa fa-plus"></i> Nouveau PV
                      </button>

                      <button class="btn btn-xs bg-teal square-btn-adjust" onclick="loadPV()">
                          <i class="fa fa-refresh"></i> Actualiser
                      </button>
<!-- 
                      <button class="btn btn-xs btn-success square-btn-adjust btn-xs" onclick="window.location.replace('exportTicket.php?id_util=<?php echo $_SESSION['id_util'];?>','pop1','width=80,height=80');">
                        <i class="fas fa-file-excel"></i> Exporter en Excel
                      </button> -->

                    </div>

                </div>
              
              </div>   
              <!-- /.card-header -->
              <div class="card-file_data_tableau_pv_contentieux table-responsive p-0">
                <table id="file_data_tableau_pv_contentieux" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-dark table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">N° PV</th>
                      <th style=""></th>
                      <th style="">Bureau initiateur du PV</th>
                      <th style="">Date PV</th>
                      <th style="">Date réception Pv</th>
                      <th style="">Statut</th>
                      <th style="">Scenario</th>
                      <th style="">Dernier acte sur le PV</th>
                      <th style="">Année du PV</th>
                      <th style="">Client</th>
                      <th style="">Procédure</th>
                      <th style="">Nature marchandise</th>
                      <th style="">Infraction annoncée</th>
                      <th style="">Droits éludés CDF</th>
                      <th style="">Droits éludés $</th>
                      <th style="">Amendes ou penalités CDF</th>
                      <th style="">Amendes ou penalités $</th>
                      <th style="">Risques potentiels</th>
                      <th style="">Date Debat Contradictoire</th>
                      <th style="">Date Prochaine Presentation</th>
                      <th style="">Delai Grief Retenu</th>
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

<div class="modal fade creerPVContentieux" id="modal_creerPVContentieux">
  <div class="modal-dialog modal-lg">
    <form method="POST" id="form_creerPVContentieux" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="creerPVContentieux">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouveau PV Contentieux</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Bureau Initiateur</label>
            <select name="id_bur_douane" id="id_bur_douane" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerBureauDouane3();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Ref.PV</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="ref_pv" name="ref_pv" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date PV</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_pv" name="date_pv" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date Reception</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_reception" name="date_reception" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Annee PV</label>
            <select name="annee" id="annee" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  for ($i=date('Y'); $i >= 2020 ; $i--) { 
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  }
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Client</label>
            <select name="id_cli" id="id_cli" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerClient();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Procedure</label>
            <select name="id_mod_lic" id="id_mod_lic" class="form-control cc-exp form-control-sm" required>
              <option></option>
              <option value="2">Import</option>
              <option value="1">Export</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Nature Marchandise</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="marchandise" name="marchandise" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Fichier PV</label>
            <input class="form-control cc-exp form-control-sm" type="file" id="fichier_pv" name="fichier_pv" required>
          </div>

        </div>
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

<div class="modal fade modificationPVContentieux" id="modal_modificationPVContentieux">
  <div class="modal-dialog modal-lg">
    <form method="POST" id="form_modificationPVContentieux" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="modificationPVContentieux">
      <input type="hidden" id="id_pv_edit" name="id_pv_edit">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/crayon.png" width="30px"> Editer PV Contentieux</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Ref.PV</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="ref_pv_edit" name="ref_pv" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Etat</label>
            <select class="form-control cc-exp form-control-sm" id="id_etat_edit" name="id_etat_edit" required>
              <?php
                $maClasse-> selectionnerEtatPV();
              ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Scenario</label>
            <select class="form-control cc-exp form-control-sm" id="id_sen_edit" name="id_sen" required>
              <?php
                $maClasse-> selectionnerScenariioPV();
              ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Bureau Initiateur</label>
            <span id="select_id_bur"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date PV</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_pv_edit" name="date_pv" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date Reception</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_reception_edit" name="date_reception" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Annee PV</label>
            <select name="annee" id="annee_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  for ($i=date('Y'); $i >= 2020 ; $i--) { 
                    echo '<option value="'.$i.'">'.$i.'</option>';
                  }
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Client</label>
            <select name="id_cli" id="id_cli_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
                <?php
                  $maClasse->selectionnerClient();
                ?>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Procedure</label>
            <select name="id_mod_lic" id="id_mod_lic_edit" class="form-control cc-exp form-control-sm" required>
              <option></option>
              <option value="2">Import</option>
              <option value="1">Export</option>
            </select>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Nature Marchandise</label>
            <input class="form-control cc-exp form-control-sm" type="text" id="marchandise_edit" name="marchandise" required>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Infraction annoncée</label>
            <!-- <input class="form-control cc-exp form-control-sm" type="text" id="infraction_edit" name="infraction" required> -->
            <textarea class="form-control cc-exp form-control-sm" type="text" id="infraction_edit" name="infraction" ></textarea>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Risques potentiels</label>
            <!-- <input class="form-control cc-exp form-control-sm" type="text" id="infraction_edit" name="infraction" required> -->
            <textarea class="form-control cc-exp form-control-sm" type="text" id="risque_potentiel_edit" name="risque_potentiel" ></textarea>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Droits éludé (CDF)</label>
            <input class="form-control cc-exp form-control-sm" type="number" min="0" step="0.01" id="droit_cdf_edit" name="droit_cdf" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Droits éludé (USD)</label>
            <input class="form-control cc-exp form-control-sm" type="number" min="0" step="0.01" id="droit_usd_edit" name="droit_usd" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Amende/Penalité(CDF)</label>
            <input class="form-control cc-exp form-control-sm" type="number" min="0" step="0.01" id="amende_cdf_edit" name="amende_cdf" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Amende/Penalité(USD)</label>
            <input class="form-control cc-exp form-control-sm" type="number" min="0" step="0.01" id="amende_usd_edit" name="amende_usd" >
          </div>

          <div class="col-md-12"></div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Debat Contradictoire</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_deb_contrad_edit" name="date_deb_contrad" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Prochaine Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" id="date_next_pres_edit" name="date_next_pres" >
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Delai Grief Retenu</label>
            <input class="form-control cc-exp form-control-sm" type="number" min="0" id="delai_grief_edit" name="delai_grief" >
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <textarea class="form-control cc-exp form-control-sm" type="text" id="remarque_edit" name="remarque"></textarea>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="" class="btn-xs btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade actePV" id="modal_actePV">
  <div class="modal-dialog modal-lg">
    <!-- <form method="POST" id="form_actePV" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="actePV">
      <input type="hidden" id="id_pv_acte" name="id_pv_acte">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/presse-papiers.png" width="30px"> Actes </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Ref.PV</label>
            <input class="form-control cc-exp bg-dark" type="text" id="ref_pv_acte" disabled>
          </div>

          <div class="col-md-12"><hr></div>

          <div class="col-md-12">
            <table class="table table-hover table-bordered text-nowrap table-sm">
              <thead class="">
                <tr class="">
                  <th style="">#</th>
                  <th style="">Date</th>
                  <th style="">Detail</th>
                  <th style="">Action</th>
                </tr>
              </thead>
              <tbody id="tableau_acte_pv">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Fermer</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  $('#file_data_tableau_pv_contentieux').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        'excel',
        'pageLength'
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
          "operation": "tableau_pv_contentieux"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_pv"},
      {"data":"btn_action"},
      {"data":"nom_bur_douane"},
      {"data":"date_pv"},
      {"data":"date_reception"},
      {"data":"nom_etat"},
      {"data":"nom_sen"},
      {"data":"detail_act"},
      {"data":"annee"},
      {"data":"nom_cli"},
      {"data":"nom_mod_lic"},
      {"data":"marchandise"},
      {"data":"infraction"},
      {"data":"droit_cdf"},
      {"data":"droit_usd"},
      {"data":"amende_cdf"},
      {"data":"amende_usd"},
      {"data":"risque_potentiel"},
      {"data":"date_deb_contrad"},
      {"data":"date_next_pres"},
      {"data":"delai_grief"},
      {"data":"remarque"}
    ] 
  });

  $(document).ready(function(){

    $('#form_creerPVContentieux').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous creer ce PV ?')) {
          
          $('#spinner-div').show();
          $('#modal_creerPVContentieux').modal('hide');

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

                $('#file_data_tableau_pv_contentieux').DataTable().ajax.reload();
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
      data: {operation: 'tableau_pv_contentieux'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#file_data_tableau_pv_contentieux').DataTable().ajax.reload();
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
      data: {operation: 'tableau_pv_contentieux'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#file_data_tableau_pv_contentieux').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modalModificationPV(id_pv){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_modificationPVContentieux', id_pv: id_pv},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_pv_edit').val(data.id_pv);
          $('#select_id_bur').html(data.select_id_bur);
          $('#ref_pv_edit').val(data.ref_pv);
          $('#date_pv_edit').val(data.date_pv);
          $('#date_reception_edit').val(data.date_reception);
          $('#annee_edit').val(data.annee);
          $('#id_cli_edit').val(data.id_cli);
          $('#id_mod_lic_edit').val(data.id_mod_lic);
          $('#marchandise_edit').val(data.marchandise);
          $('#date_deb_contrad_edit').val(data.date_deb_contrad);
          $('#date_next_pres_edit').val(data.date_next_pres);
          $('#delai_grief_edit').val(data.delai_grief);
          $('#action_en_cours_edit').val(data.action_en_cours);
          $('#remarque_edit').val(data.remarque);
          $('#id_etat_edit').val(data.id_etat);
          $('#id_sen_edit').val(data.id_sen);
          $('#date_deb_contrad_edit').val(data.date_deb_contrad);
          $('#date_next_pres_edit').val(data.date_next_pres);
          $('#delai_grief_edit').val(data.delai_grief);
          $('#action_en_cours_edit').val(data.action_en_cours);
          $('#infraction_edit').val(data.infraction);
          $('#droit_cdf_edit').val(data.droit_cdf);
          $('#droit_usd_edit').val(data.droit_usd);
          $('#amende_cdf_edit').val(data.amende_cdf);
          $('#amende_usd_edit').val(data.amende_usd);
          $('#risque_potentiel_edit').val(data.risque_potentiel);
          $('#modal_modificationPVContentieux').modal('show');
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
          $('#modal_modificationPVContentieux').modal('hide');

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
                $('#file_data_tableau_pv_contentieux').DataTable().ajax.reload();
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

  function modal_actePV(id_pv){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_actePV', id_pv: id_pv},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_pv_acte').val(data.id_pv_acte);
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

  function ajouterActePV(date_act, detail_act, id_pv){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'ajouterActePV', id_pv: id_pv, date_act: date_act, detail_act: detail_act},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_acte_pv').html(data.tableau_acte_pv);
          $('#file_data_tableau_pv_contentieux').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

</script>