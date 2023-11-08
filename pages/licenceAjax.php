<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGaucheAjax.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="fa fa-list nav-icon"></i> LICENSES | <span class="badge badge-dark"><?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?></span> | <span class="badge badge-dark"><?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?></span></h3>
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

                  ?>
                <button class="btn btn-dark btn-xs square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                  <?php
                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='1') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicenceExport">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }else if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicence">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }

                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') && ($maClasse-> getNbrePartielleSansFob($_GET['id_cli'])>0)){
                    ?>
                <button class="clignoteb btn btn-xs bg-dark square-btn-adjust" onclick="window.open('popUpPartielleSansFOB.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=900,height=950');">
                    <i class="fa fa-edit"></i> Partielle Sans FOB <sup><span class="badge badge-danger"><?php echo number_format($maClasse-> getNbrePartielleSansFob($_GET['id_cli']), 0, '', '');?></span></sup>
                </button>
                  <?php
                  }
                  ?>
                <!--<button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->
                </h3>
                  <div class="card-tools">
                    <div class="pull-right">
                    <?php
                    if ($_GET['id_mod_lic']=='1') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Exporter Rapport
                      <div class="dropdown-menu" role="menu">
                        <?php
                          for ($annee=date('Y'); $annee >= 2020 ; $annee--) { 
                          ?>
                          <a class="dropdown-item"onclick="window.location.replace('exportLicenceExport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=<?php echo $annee;?>','pop1','width=80,height=80');">
                            Export <?php echo $annee;?> Licenses
                          </a>
                          <?php
                          }
                        ?>
                      </div>
                    </button>
                    <?php
                    }
                    else if ($_GET['id_mod_lic']=='2') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Exporter Rapport
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1','pop1','width=80,height=80');">
                          Export All Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1','pop1','width=80,height=80');">
                          Export Syntheses/License
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicenceClient.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');">
                          Export Syntheses/CLient
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Synthese
                        </a>
                      </div>
                    </button>
                    <?php
                    }
                    ?>
                    

                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table id="file_data_afficherLicence" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <?php
                      if ($_GET['id_mod_lic']=='2') {
                       ?>
                       <tr class="">
                          <th>#</th>
                          <th>Numero</th>
                          <th>Statut</th>
                          <th>Client</th>
                          <th>Date Val.</th>
                          <th>Extreme Val.</th>
                          <th>COD</th>
                          <th>Type</th>
                          <th>Fournisseur</th>
                          <th>Marchandise</th>
                          <th>Banque</th>
                          <th>Monnaie</th>
                          <th>FOB Licence</th>
                          <th>Dossier(s)</th>
                          <th>FOB Dossiers</th>
                          <th>Balance Licence</th>
                          <th>Commerc.Inv.</th>
                          <th>Remarque</th>
                          <th>Action</th>
                        </tr>
                       <?php
                      }
                    ?>
                  </thead>
                  <tbody>
                    
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
  ?>

<div class="modal fade" id="modal_nouvelle_licence_import">
  <div class="modal-dialog modal-xl">
    <form id="form_nouvelle_licence_import" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="nouvelle_licence_import">
      <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic'];?>">
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <span class="text-decoration-underline font-weight-bold"><u>Facture Commerciale</u></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Ref.Facture</label>
            <span id="factureLicenceDisponible"></span>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Date Facte</label>
            <input id="date_fact" name="date_fact" type="date" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">Fournisseur</label>
            <input type="text" id="fournisseur" name="fournisseur" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-12">
            <hr>
            <span class="text-decoration-underline font-weight-bold"><u>Licence</u></span>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Numero</label>
            <input type="text" id="num_lic" name="num_lic" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Ref.COD</label>
            <input type="text" id="cod" name="cod" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Type Marchandise</label>
            <select name="consommable" class="form-control form-control-sm cc-exp">
                <option></option>
                <option value="1">Consommable</option>
                <option value="0">Divers</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Banque</label>
            <select id="id_banq" name="id_banq" class="form-control form-control-sm cc-exp" required>
              <option></option>
              <?php $maClasse-> selectionnerBanque();?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Date Validation</label>
            <input type="date" id="date_val" name="date_val" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Date Expiration</label>
            <input type="date" id="date_exp" name="date_exp" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Commodity</label>
            <input type="text" id="commodity" name="commodity" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Monnaie</label>
            <select id="id_mon" name="id_mon" class="form-control form-control-sm cc-exp" required>
              <option></option>
              <?php
                $maClasse-> selectionnerMonnaie();
              ?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">FOB</label>
            <input type="numnber" step="0.001" min="0" id="fob" name="fob" class="form-control form-control-sm cc-exp text-right" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Fret</label>
            <input type="numnber" step="0.001" min="0" id="fret" name="fret" class="form-control form-control-sm cc-exp text-right" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Assurance</label>
            <input type="numnber" step="0.001" min="0" id="assurance" name="assurance" class="form-control form-control-sm cc-exp text-right" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Autre Frais</label>
            <input type="numnber" step="0.001" min="0" id="autre_frais" name="autre_frais" class="form-control form-control-sm cc-exp text-right" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Poids</label>
            <input type="numnber" step="0.001" min="0" id="poids" name="poids" class="form-control form-control-sm cc-exp text-right" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">UOM</label>
            <select name="unit_mes" onchange="" class="form-control form-control-sm cc-exp">
                <option></option>
                <option value="Kg">Kg</option>
                <option value="T">T</option>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Provenance</label>
            <input type="text" id="provenance" name="provenance" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">FSI</label>
            <input type="text" id="fsi" name="fsi" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">AUR</label>
            <input type="text" id="aur" name="aur" class="form-control form-control-sm cc-exp" required>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Type Licence</label>
            <select name="id_type_lic" onchange="" class="form-control form-control-sm cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerTypeLicence();
                ?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Modalite Paiement</label>
            <select name="id_mod_paie" onchange="" class="form-control form-control-sm cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerModalitePaiement();
                ?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Sous-type Paiement</label>
            <select name="id_sous_type_paie" onchange="" class="form-control form-control-sm cc-exp" required>
              <option value=""></option>
                <?php
                  $maClasse->selectionnerSousTypePaiement($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-2">
            <label for="x_card_code" class="control-label mb-1">Fichier</label>
            <input name="fichier_lic" type="file" class="form-control form-control-sm cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" class="btn btn-xs btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#form_nouvelle_licence_import').submit(function(e){

      e.preventDefault();
      
      if(confirm('Do really you want to submit ?')) {

        var fd = new FormData(this);
        $('#spinner-div').show();
        $('#modal_nouvelle_licence_import').modal('hide');


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
            }else if(data.message){
              $( '#form_nouvelle_licence_import' ).each(function(){
                  this.reset();
              });
              $('#file_data_afficherLicence').DataTable().ajax.reload();
              $('#spinner-div').hide();//Request is complete so hide spinner
              // alert(data.message);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }


    });
    
  });

  function getDataFacture(ref_fact){
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDataFacture', ref_fact: ref_fact},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#date_fact').val(data.date_fact);
          $('#date_val').val(data.date_val);
          $('#fob').val(data.montant_fact);
          $('#fret').val(data.fret_fact);
          $('#assurance').val(data.assurance_fact);
          $('#autre_frais').val(data.autre_frais_fact);
          $('#id_mon').val(data.id_mon);
          $('#commodity').val(data.commodity);
          $('#fournisseur').val(data.fournisseur);
          $('#fsi').val(data.fsi);
          $('#aur').val(data.aur);
        }
      }
    });

  }

  $(document).ready(function(){
    factureLicenceDisponible('<?php echo $_GET['id_cli']?>', '<?php echo $_GET['id_mod_lic']?>');
  });

  function factureLicenceDisponible(id_cli, id_mod_lic){
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'factureLicenceDisponible', id_cli: id_cli, id_mod_lic: id_mod_lic},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#factureLicenceDisponible').html(data.factureLicenceDisponible);
        }
      }
    });

  }

  function selectLicence(){
    $('#rechercheClient').modal('hide');
    $('#file_data_afficherLicence').DataTable().column( 3 ).search($('#nom_cli').val()).ajax.reload();
  }

  $('#file_data_afficherLicence').DataTable({
     lengthMenu: [
        [10, 20, 50, 100, 500, -1],
        [10, 20, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
    {
        text: '<i class="fa fa-plus"></i> Nouvelle Licence',
        className: 'btn btn-info bt',
        action: function ( e, dt, node, config ) {
            $( '#form_nouvelle_licence_import' ).each(function(){
              this.reset();
            });
            $('#modal_nouvelle_licence_import').modal('show');
        }
      },
      {
        extend: 'collection',
        text: '<i class="fa fa-plus"></i> Extraction Rapport',
        className: 'btn btn-success',
        buttons: [
           <?php
                  if ($_GET['id_mod_lic']=='1') {
                    for ($annee=date('Y'); $annee >= 2020 ; $annee--) { 
                      ?>
                      {
                        text: '<i class="fa fa-file-excel"></i> Export <?php echo $annee;?> Licenses',
                        className: 'btn btn-success bt',
                        action: function ( e, dt, node, config ) {
                          window.location.replace('exportLicenceExport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=<?php echo $annee;?>','pop1','width=80,height=80');
                        }
                      },
                      <?php
                    }

                  }else if ($_GET['id_mod_lic']=='2') {
                  ?>
                   {
                      text: '<i class="fa fa-file-excel"></i> Export All Licenses',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export Syntheses/License',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export Syntheses/CLient',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportSyntheseLicenceClient.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export 2023 Licenses',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2023','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export 2023 Synthese',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2023','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export 2022 Licenses',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2022','pop1','width=80,height=80');
                      }
                    },
                   {
                      text: '<i class="fa fa-file-excel"></i> Export 2022 Synthese',
                      className: 'btn btn-success bt',
                      action: function ( e, dt, node, config ) {
                        window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=1&annee=2022','pop1','width=80,height=80');
                      }
                    }
                  <?php
                  }
                  ?>
        ]
      },
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i> Gross',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i> Showing',
        className: 'btn btn-dark'
      }
    ],
    processing: true,
    language: { "processing": '<img src="../images/GD.gif" width="100px">' },
    // fixedColumns: {
    //     left: 2
    //     // ,
    //     // right: 1
    // },
    "paging": true,
    "scrollX": true,
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    // "responsive": true,
      "ajax":{
        "type": "GET",
        "url":"ajax.php",
        "method":"post",
        "dataSrc":{
            "id_cli": ""
        },
        "data": {
            "id_cli": "<?php echo $_GET['id_cli'];?>",
            "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
            "operation": "afficherLicenceAjax"
        }
      },
      <?php
        if ($_GET['id_mod_lic']=='2'){
          ?>
      "columns":[
        {"data":"compteur"},
        {"data":"num_lic"},
        {"data":"statut",
    className: 'dt-body-left'},
        {"data":"nom_cli"},
        {"data":"date_val_2"},
        {"data":"date_exp"},
        {"data":"cod"},
        {"data":"type_lic"},
        {"data":"fournisseur"},
        {"data":"commodity"},
        {"data":"nom_banq"},
        {"data":"sig_mon"},
        {"data":"fob",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        },
        {"data":"nbre_dos",
          className: 'dt-body-right'
        },
        {"data":"fob_dos",
    render: DataTable.render.number( null, null, 2, null ),
    className: 'dt-body-right'},
        {"data":"solde_fob",
    render: DataTable.render.number( null, null, 2, null ),
    className: 'dt-body-right'},
        {"data":"ref_fact"},
        {"data":"remarque"},
        {"data":"fichier"}
      ],
      "createdRow": function( row, data, dataIndex ) {
        if ( data.solde_fob < 0) {
          // console.log(data.solde_fob);
          $('td:eq(15)', row).addClass("font-weight-bold bg-danger");
        }

        if ( data['statut'] == "Totalement Apurée") {
          $(row).addClass('bg bg-success');
        }
      } 
          <?php
        }
      ?>
    });
  
</script>