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

          <div class="col-md-3">
            <div class="card">

              <!-- /.card-header -->
              <div class="card-file_data_dossier_risque_douane table-responsive p-0">
                <table id="" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">Notification</th>
                      <th style="">Nbre</th>
                      <th style=""></th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td colspan="3"><u>Presentation</u></td>
                    </tr>
                    <tr>
                      <td>En attente presentation</td>
                      <td style="text-align: center;"><span id="nbre_not_pres"></span></td>
                      <td><a href="#" onclick="window.open('popUpPresentation.php?statut=En attente presentation','pop1','width=900,height=700');">Voir Details</a></td>
                    </tr>
                    <tr>
                      <td>Presentation -10 jrs</td>
                      <td style="text-align: center;"><span id="nbre_not_pres_10"></span></td>
                      <td><a href="#" onclick="window.open('popUpPresentation.php?statut=Presentation -10 jrs','pop1','width=900,height=700');">Voir Details</a></td>
                    </tr>
                    <tr></tr>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

          <div class="col-md-9">
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
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit <span id="label_ref_doc" class="text-md badge badge-dark"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="card card-primary card-outline card-outline-tabs">
          <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
              <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">Info Principale</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">Presentation</a>
              </li>
              <!-- <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">Fichiers</a>
              </li> -->
            </ul>
          </div>
          <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">
                 
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
                  
                  <div class="col-md-12">
                    <hr>
                    <label for="x_card_code" class="control-label mb-1">Documents Joints</label>
                    <table class="table hover display compact table-bordered table-striped table-sm small text-nowrap">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Intitule</th>
                          <th>Document Actuel</th>
                          <th>Nouveau Document</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>PV</td>
                          <td></td>
                          <td>
                            <input class="form-control cc-exp form-control-sm" type="file" id="fi" name="fi">
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Memo / Lettres de réponse</td>
                          <td></td>
                          <td>
                            <input class="form-control cc-exp form-control-sm" type="file" id="fi" name="fi">
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Preuve de paiement / Protocole d’accord</td>
                          <td></td>
                          <td>
                            <input class="form-control cc-exp form-control-sm" type="file" id="fi" name="fi">
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Note de classement sans suite</td>
                          <td></td>
                          <td>
                            <input class="form-control cc-exp form-control-sm" type="file" id="fi" name="fi">
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>

                </div>
              </div>
              <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel" aria-labelledby="custom-tabs-four-profile-tab">
                <table class="table hover display compact table-bordered table-striped table-sm small">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Date Prevue</th>
                      <th>Presentation</th>
                      <th>Remarque</th>
                      <th width="10%"><span class="btn btn-xs bg-primary" onclick="modal_creerPresentationRisqueDouane(id_edit.value);"><i class="fa fa-plus"></i></span></th>
                    </tr>
                  </thead>
                  <tbody id="presentation_risque_douane">
                  </tbody>
                </table>
              </div>
             <!--  <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel" aria-labelledby="custom-tabs-four-messages-tab">
                 Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend ac ornare magna.
              </div> -->
            </div>
          </div>
          <!-- /.card -->
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

<div class="modal fade creerPresentationRisqueDouane" id="modal_creerPresentationRisqueDouane">
  <div class="modal-dialog modal-sm">
    <form method="POST" id="form_creerPresentationRisqueDouane" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="creerPresentationRisqueDouane">
      <input type="hidden" name="id" id="id_dos_risq">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Presentation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Prevue</label>
            <input class="form-control cc-exp form-control-sm" type="date" name="date_prevu" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" name="date_pres">
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <textarea class="form-control cc-exp form-control-sm" name="remarque"></textarea>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Fichier</label>
            <input class="form-control cc-exp form-control-sm" type="file" id="fichier" name="fichier" >
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

<div class="modal fade" id="modal_editPresentation">
  <div class="modal-dialog modal-sm">
    <form method="POST" id="form_editPresentation" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="editPresentation">
      <input type="hidden" name="id_pres" id="id_pres_edit">
      <input type="hidden" name="id" id="id_pres_id">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Presentation</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <div class="row"> -->

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Prevue</label>
            <input class="form-control cc-exp form-control-sm" type="date" name="date_prevu" id="date_prevu_edit" required>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Date Presentation</label>
            <input class="form-control cc-exp form-control-sm" type="date" name="date_pres" id="date_pres_edit_2">
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <textarea class="form-control cc-exp form-control-sm" name="remarque" id="remarque_edit_2"></textarea>
          </div>

          <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Fichier</label>
            <input class="form-control cc-exp form-control-sm" type="file" name="fichier" >
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

<script type="text/javascript">


  $(document).ready(function(){

    getNombreDossierRisqueDouane();

  });

  function getNombreDossierRisqueDouane(){

    $('#spinner-div').show();
    $.ajax({

      url: 'ajax.php',
      type: 'post',
      data: {operation: 'getNombreDossierRisqueDouane'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#nbre_not_pres').html(data.nbre_not_pres);

          $('#nbre_not_pres_10').html(data.nbre_not_pres_10);
        }
      },
      complete: function () {
          loadPV();
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

    $('#form_editPresentation').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous modifier cette presentation ?')) {
          
          $('#spinner-div').show();
          $('#modal_editPresentation').modal('hide');

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
                
                $('#presentation_risque_douane').html(data.presentation_risque_douane);
                getNombreDossierRisqueDouane();
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

  function modal_editPresentation(id_pres, id){
    
    $('#spinner-div').show();

     $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_editPresentation', id_pres: id_pres},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_pres_id').val(id);
          //date_prevu
          $('#id_pres_edit').val(id_pres);
          //date_prevu
          $('#date_prevu_edit').val(data.date_prevu);
          //date_pres
          $('#date_pres_edit_2').val(data.date_pres);
          //remarque
          $('#remarque_edit_2').val(data.remarque);
          $('#modal_editPresentation').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_creerPresentationRisqueDouane(id){
    
    $('#id_dos_risq').val(id);
    
    $('#modal_creerPresentationRisqueDouane').modal('show');

  }

  function deletePresentation(id_pres, id){
    if(confirm('Voulez-vous supprimer cette presentation ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'deletePresentation', id: id, id_pres: id_pres},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            
            $('#presentation_risque_douane').html(data.presentation_risque_douane);

          }
        }
      });
      
    }
  }

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
          //label_ref_doc
          $('#label_ref_doc').html(data.ref_doc);

          $('#presentation_risque_douane').html(data.presentation_risque_douane);

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
          className: 'btn btn-info bt',
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
      {"data":"nom_bur_douane"},
      {"data":"nom_reg"},
      {"data":"remarque"}
    ] 
  });

  $(document).ready(function(){

    $('#form_creerPresentationRisqueDouane').submit(function(e){

      e.preventDefault();

       if(confirm('Voulez-vous creer cette presentation ?')) {
          
          $('#spinner-div').show();
          $('#modal_creerPresentationRisqueDouane').modal('hide');

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

                $('#presentation_risque_douane').html(data.presentation_risque_douane);
                getNombreDossierRisqueDouane();

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
                getNombreDossierRisqueDouane();
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