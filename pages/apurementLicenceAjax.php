<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  // include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='apurementLicenceAjax.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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

  if(isset($_POST['update'])){

    for ($i=1; $i <= $_POST['nbre'] ; $i++) { 
      $licence = $_POST['debut'];
      $num_lic = $_POST['num_lic_'.$licence];

      //echo $_POST['id_dos_'.$num_lic.'_'.$i].' - '.$_POST['cod_'.$num_lic.'_'.$i];

        $maClasse-> MAJ_cod($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['cod_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fxi($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fxi_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_montant_av($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['montant_av_'.$num_lic.'_'.$i]);

        $maClasse-> MAJ_fob($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fob_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_fret($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['fret_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_assurance($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['assurance_'.$num_lic.'_'.$i]);
        $maClasse-> MAJ_autre_frais($_POST['id_dos_'.$num_lic.'_'.$i], $_POST['autre_frais_'.$num_lic.'_'.$i]);

      /*if (isset($_POST['fret_dos_'.$i]) && ($_POST['fret_dos_'.$i] != '')) {
        $maClasse-> MAJ_fret_dos($_POST['id_dos_'.$i], $_POST['fret_dos_'.$i]);
      }

      if (isset($_POST['assurance_dos_'.$i]) && ($_POST['assurance_dos_'.$i] != '')) {
        $maClasse-> MAJ_assurance_dos($_POST['id_dos_'.$i], $_POST['assurance_dos_'.$i]);
      }

      if (isset($_POST['autre_frais_dos_'.$i]) && ($_POST['autre_frais_dos_'.$i] != '')) {
        $maClasse-> MAJ_autre_frais_dos($_POST['id_dos_'.$i], $_POST['autre_frais_dos_'.$i]);
      }*/
    }

  }


  if (isset($_POST['appurement'])) {
    
    //Creation Transmission Apurement
    $maClasse-> creerTransmissionApurement(NULL, $_POST['ref_trans_ap'], 
                                  $_SESSION['id_util'], NULL, $_POST['banque'], $_POST['date_trans_ap']);

    $id_trans_ap = $maClasse-> verifierTransmissionApurement($_POST['ref_trans_ap'], $_POST['date_trans_ap'], $_POST['banque']);

    for ($i=1; $i <= 50 ; $i++) { 
      
      if (isset($_POST['id_dos_'.$i]) && ($_POST['id_dos_'.$i]!='')) {
        
        $maClasse-> creerDetailApurement($id_trans_ap, $_POST['id_dos_'.$i]);

      }

    }


    /*?>
    <script type="text/javascript">
      alert('Transmission Apurement <?php echo $_POST['ref_trans_ap'];?> créée avec succès.')
    </script>
    <?php*/
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
          <h3><i class="fa fa-check nav-icon"></i> APUREMENT LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h3>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-warning">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreDossierPretAEtreApuresLicenceClient($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers en attente apurement</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossierEnAttenteApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-olive">
              <div class="inner">
                <h3 id="DivClignotante" style="visibility:visible;">
                  <?php 
                    echo $maClasse-> getNombreTransmissionApurement($_GET['id_mod_lic'], $_GET['id_cli']);
                  ?>
                </h3>

                <p>Transmission(s) Apurement</p>
              </div>
              <div class="icon" id="DivClignotante2" style="visibility:visible;">
                <i class="fas fa-file"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurement.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

              <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h3 class="clignote">
                  <?php echo $maClasse-> getNombreTransmissionApurementSansFichier($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Transmission(s) Apurement sans Accusée de reception</p>
              </div>
              <div class="icon clignote">
                <i class="fas fa-bell"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpTransmissionApurementNotificationSansFichier.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-success">
              <div class="inner">
                <h3 class="">
                  <?php echo $maClasse-> getNombreDossierApures($_GET['id_mod_lic'], $_GET['id_cli']);?>
                </h3>

                <p>Dossiers Apurés</p>
              </div>
              <div class="icon">
                <i class="fas fa-check"></i>
              </div>
              <a href="#" class="small-box-footer" onclick="window.open('popUpDossiersApuresNotification.php?id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_cli=<?php echo $_GET['id_cli'];?>','pop1','width=1500,height=900');">
                More info <i class="fas fa-arrow-circle-right"></i>
              </a>
            </div>

            <!-- /.info-box -->
          </div>

            <!-- /.card -->
          
            <!-- /.card -->
          
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
                <button class="btn btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                </h3>
                  <div class="card-tools">
                    <div class="pull-right">

                      <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".creerTransmisionApurement">
                          <i class="fa fa-plus"></i> Nouvelle Transmission Apurement
                      </button>

                      <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportTramissionApurementAll.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=80,height=80');">
                        <i class="fas fa-file-excel"></i> Export
                      </button>

                    </div>

                </div>
              </div>                
              <?php
              if (isset($_POST['appurement'])) {
              ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Opération reussie!</strong> Transmission Apurement <b><?php echo $_POST['ref_trans_ap'];?></b> créée avec succès.
                </div>
              <?php
              }
              ?>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="transmis_apurement" cellspacing="0" width="100%" class="table table-bordered table-striped table text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Client</th>
                      <th style="">Reference.</th>
                      <th style="">Date Creation</th>
                      <th style="">Date Depot</th>
                      <th style="">Banque</th>
                      <th style="">Nbre. Licences</th>
                      <th style="">Nbre. Dossiers</th>
                      <th></th>
                    </tr>
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

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-lg">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">TYPE</label>
            <select name="id_type_lic" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerTypeLicence();
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
  include("pied.php");
  ?>
<div class="modal fade" id="modal_archive_transmis_apurement">
  <div class="modal-dialog modal-sm">
    <form id="form_archive_transmis_apurement" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" id="modal_id_trans_ap" name="id_trans_ap">
      <input type="hidden" name="operation" value="archive_transmis_apurement">
    <div class="modal-content">
      <div class="modal-header btn-secondary">
        <h4 class="modal-title"><i class="fa fa-upload"></i>Transmis <span class="badge badge-dark text-sm" id="modal_ref_trans_ap"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Accusee de reception</label>
            <input type="file" name="fichier_trans_ap" class="form-control form-control-sm cc-exp">
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

<div class="modal fade" id="modal_modifier_transmis">
  <div class="modal-dialog modal-sm">
    <form id="form_modifier_transmis" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" id="modal_modifier_id_trans_ap" name="id_trans_ap">
      <input type="hidden" name="operation" value="modifier_transmis_apurement">
    <div class="modal-content">
      <div class="modal-header btn-warning">
        <h4 class="modal-title"><i class="fa fa-edit"></i>Edit <span class="badge badge-dark text-sm" id="ref_trans_ap_2"></span></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Date Depot</label>
            <input type="date" name="date_depot" id="date_depot" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-12"><hr></div>

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">
              <a href="#" class="text-danger text-xs" onclick="annuler_accuser_reception_transmis_apurement(modal_modifier_id_trans_ap.value);">Annuler l'accusee de reception</a>
            </label>
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

<div class="modal fade" id="modal_creerTransmisionApurement">
  <div class="modal-dialog modal-xl">
    <form id="form_creerTransmisionApurement" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="creerTransmisionApurement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Nouvelle Transmission Apurement <?php echo $modele['sigle_mod_lic'].$client;?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">BANQUE</label>
            <select name="banque" onchange="" class="form-control cc-exp" required>
              <option></option>
                <?php
                  $maClasse->selectionnerNomBanque();
                ?>
            </select>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">REF.</label>
            <input id="ref_trans_ap_create" name="ref_trans_ap" type="text" class="form-control cc-exp" required>
          </div>

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">DATE</label>
            <input name="date_trans_ap" type="date" value="" class="form-control cc-exp" required>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive p-0" style="height: 400px;">
            <table class="table table-bordered table-hover table-dark table-head-fixed">
              <thead>
                <tr class="" style="text-align: center;">
                  <th>#</th>
                  <th width="20%">MCA REF</th>
                  <th width="25%">LICENCE</th>
                  <th width="15%">MONTANT DECL.</th>
                  <th>REF. DECL.</th>
                  <th>REF. LIQ.</th>
                  <th>REF. QUIT.</th>
                </tr>
              </thead>
              <tbody id="dossier_a_apures">
                <?php
                  
                ?>
              </tbody>
            </table>
            </div>
          </div>
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="appurement" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script type="text/javascript">

  function build_reference_transmis(id_mod_lic, id_cli){

    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_mod_lic: id_mod_lic, id_cli: id_cli, operation: 'build_reference_transmis'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_trans_ap_create').val(data.ref_trans_ap);
          $('#dossier_a_apures').html(data.dossier_a_apures);
          $('#modal_creerTransmisionApurement').modal('show');
          // alert(data.ref_trans_ap);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }
  
  function annuler_accuser_reception_transmis_apurement(id_trans_ap){
    if(confirm('Do really you want to submit ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_trans_ap: id_trans_ap, operation: 'annuler_accuser_reception_transmis_apurement'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#transmis_apurement').DataTable().ajax.reload();
            $('#modal_modifier_transmis').modal('hide');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }
  
  $(document).ready(function(){

    $('#form_archive_transmis_apurement').submit(function(e){

      e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

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
              }else if(data.message){
                $( '#form_archive_transmis_apurement' ).each(function(){
                    this.reset();
                });
                $('#modal_archive_transmis_apurement').modal('hide');
                $('#transmis_apurement').DataTable().ajax.reload();
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  $(document).ready(function(){

    $('#form_modifier_transmis').submit(function(e){

      e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

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
              }else if(data.message){
                $( '#form_modifier_transmis' ).each(function(){
                    this.reset();
                });
                $('#modal_modifier_transmis').modal('hide');
                $('#transmis_apurement').DataTable().ajax.reload();
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  function modal_modifier_transmis(id_trans_ap){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_trans_ap: id_trans_ap, operation: 'modal_modifier_transmis'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_trans_ap_2').html(data.ref_trans_ap);
          $('#modal_modifier_id_trans_ap').val(id_trans_ap);
          $('#date_depot').val(data.date_depot);
          $('#modal_modifier_transmis').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_archive_transmis_apurement(id_trans_ap, ref_trans_ap){
    $('#modal_id_trans_ap').val(id_trans_ap);
    $('#modal_ref_trans_ap').html(ref_trans_ap);
    $('#modal_archive_transmis_apurement').modal('show');
  }

  $('#spinner-div').show();
      $('#transmis_apurement').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
          {
            text: '<i class="fa fa-plus"></i> Nouvelle Transmission',
            className: 'btn btn-info bt',
            action: function ( e, dt, node, config ) {
              build_reference_transmis(<?php echo $_GET['id_mod_lic'];?>, <?php echo $_GET['id_cli'];?>);
              // $('#modal_creerTransmisionApurement').modal('show');
            }
          },
          {
            text: '<i class="fa fa-file-excel"></i> Rapport Transmis',
            className: 'btn btn-success bt',
            action: function ( e, dt, node, config ) {
                window.location.replace('exportTramissionApurementAll.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=80,height=80');
            }
          },
          {
            text: '<i class="fa fa-table"></i> Master Data',
            className: 'btn btn-dark bt',
            action: function ( e, dt, node, config ) {

            }
          },
          'excel',
          'pageLength', 'colvis'
        ],
        // fixedColumns: {
        //   left: 2
        // },
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,

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
              "id_cli": "",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
              "id_cli": "<?php echo $_GET['id_cli'];?>",
              "operation": "transmis_apurement"
          }
        },
        "columns":[
          {"data":"compteur"},
          {"data":"nom_cli"},
          {"data":"ref_trans_ap"},
          {"data":"date_trans_ap"},
          {"data":"date_depot"},
          {"data":"banque"},
          {"data":"nbre_dos"},
          {"data":"nbre_lic"},
          {"data":"btn_action"}
        ],
        "createdRow": function( row, data, dataIndex ) {
          if ( data['status'] == "0") {
            $(row).addClass('clignoteb text-danger');
          }
        }  
      });
      $('#spinner-div').hide();
</script>