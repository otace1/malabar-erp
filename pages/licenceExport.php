<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic = $_GET['id_mod_lic'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='licence.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        

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
                 <img src="../images/dossier.png" width="25px"> SYNTHESE LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client.' | '.$maClasse-> getNomTypeLicence($_GET['id_type_lic']);?>
                </h3>
                  <div class="card-tools">
                    <div class="pull-right">
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Report Export
                      <div class="dropdown-menu" role="menu">
                        <?php
                          for ($annee=date('Y'); $annee >= 2020 ; $annee--) { 
                          ?>
                          <a class="dropdown-item"onclick="window.location.replace('exportLicenceExport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=<?php echo $annee;?>','pop1','width=80,height=80');">
                            Export <?php echo $annee;?> Licenses
                          </a>
                          <?php
                          }
                        ?>
                      </div>
                    </button>
                    

                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="synthese_licence" cellspacing="0" width="100%" class="table text-center table-header-fixed display compact table-bordered table-striped table table-responsive p-0 table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Licence Ref.</th>
                      <th style="">Client</th>
                      <th style="">Marchandise</th>
                      <th style="">Date Validation</th>
                      <th style="">Date Expiration</th>
                      <th style="">Delai</th>
                      <th style="">Banque</th>
                      <th style="">Dossiers</th>
                      <th style="">Tonnage Licence</th>
                      <th style="">Tonnage Dossiers</th>
                      <th style="">Balance Tonnage</th>
                      <th style="">FOB Licence</th>
                      <th style="">FOB Dossiers</th>
                      <th style="">Balance FOB</th>
                      <th></th>
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
  ?>

<div class="modal fade" id="modal_new_synthese_licence">
  <div class="modal-dialog modal-md">
    <form method="POST" id="form_new_synthese_licence" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic'];?>">
      <input type="hidden" name="id_type_lic" id="id_type_lic" value="<?php echo $_GET['id_type_lic'];?>">
      <input type="hidden" name="operation" id="operation" value="new_synthese_licence">
      <div class="modal-content">
        <div class="modal-header bg bg-info">
          <h4 class="modal-title"><i class="fa fa-plus"></i> Insert License </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label for="num_lic">Numero Licence</label><sup class="text-danger">*</sup>
              <input type="text" name="num_lic" id="num_lic" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="id_banq">Banque</label><sup class="text-danger">*</sup>
              <select name="id_banq" id="id_banq" class="form-control form-control-sm" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerBanque();
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="id_march">Marchandise</label><sup class="text-danger">*</sup>
              <select name="id_march" id="id_march" class="form-control form-control-sm" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerMarchandiseClientModeleLicence2($_GET['id_cli'], $_GET['id_mod_lic']);
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="id_mod_trans">Mode Transport</label><sup class="text-danger">*</sup>
              <select name="id_mod_trans" id="id_mod_trans" class="form-control form-control-sm" required>
                <option></option>
                <option value='1'>Route</option>
                <option value='4'>Rail</option>
                <option value='3'>Air</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="date_val">Date Validation</label><sup class="text-danger">*</sup>
              <input type="date" name="date_val" id="date_val" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="date_exp">Date Extreme Validation</label><sup class="text-danger">*</sup>
              <input type="date" name="date_exp" id="date_exp" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="poids">Weight</label><sup class="text-danger">*</sup>
              <input type="number" step="0.001" name="poids" id="poids" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="unit_mes">U.M</label><sup class="text-danger">*</sup>
              <select name="unit_mes" id="unit_mes" class="form-control form-control-sm" required>
                <option></option>
                <option value='T'>T</option>
                <option value='Kg'>Kg</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="fob">FOB</label><sup class="text-danger">*</sup>
              <input type="number" step="0.001" name="fob" id="fob" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="lot_pret">Lot Pret</label>
              <input type="text" name="lot_pret" id="lot_pret" class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
              <label for="destination">Destination</label><sup class="text-danger">*</sup>
              <input type="text" name="destination" id="destination" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="acheteur">Acheteur</label>
              <input type="text" name="acheteur" id="acheteur" class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
              <label for="fichier_lic">Fichier</label><sup class="text-danger">*</sup>
              <input type="file" name="fichier_lic" id="fichier_lic" class="form-control form-control-sm" required>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-save"></i> Valider</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_synthese_licence">
  <div class="modal-dialog modal-md">
    <form method="POST" id="form_edit_synthese_licence" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic'];?>">
      <input type="hidden" name="id_type_lic" id="id_type_lic" value="<?php echo $_GET['id_type_lic'];?>">
      <input type="hidden" name="operation" id="operation" value="edit_synthese_licence">
      <input type="hidden" name="num_lic_old" id="num_lic_old">
      <div class="modal-content">
        <div class="modal-header bg bg-warning">
          <h4 class="modal-title"><i class="fa fa-edit"></i> Edit License </h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-6">
              <label for="num_lic">Numero Licence</label><sup class="text-danger">*</sup>
              <input type="text" name="num_lic" id="num_lic_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="id_banq">Banque</label><sup class="text-danger">*</sup>
              <select name="id_banq" id="id_banq_edit" class="form-control form-control-sm" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerBanque();
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="id_march">Marchandise</label><sup class="text-danger">*</sup>
              <select name="id_march" id="id_march_edit" class="form-control form-control-sm" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerMarchandiseClientModeleLicence2($_GET['id_cli'], $_GET['id_mod_lic']);
                ?>
              </select>
            </div>
            <div class="col-md-6">
              <label for="id_mod_trans">Mode Transport</label><sup class="text-danger">*</sup>
              <select name="id_mod_trans" id="id_mod_trans_edit" class="form-control form-control-sm" required>
                <option></option>
                <option value='1'>Route</option>
                <option value='4'>Rail</option>
                <option value='3'>Air</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="date_val">Date Validation</label><sup class="text-danger">*</sup>
              <input type="date" name="date_val" id="date_val_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="date_exp">Date Extreme Validation</label><sup class="text-danger">*</sup>
              <input type="date" name="date_exp" id="date_exp_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="poids">Weight</label><sup class="text-danger">*</sup>
              <input type="number" step="0.001" name="poids" id="poids_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="unit_mes">U.M</label><sup class="text-danger">*</sup>
              <select name="unit_mes" id="unit_mes_edit" class="form-control form-control-sm" required>
                <option></option>
                <option value='T'>T</option>
                <option value='Kg'>Kg</option>
              </select>
            </div>
            <div class="col-md-6">
              <label for="fob">FOB</label><sup class="text-danger">*</sup>
              <input type="number" step="0.001" name="fob" id="fob_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="lot_pret">Lot Pret</label>
              <input type="text" name="lot_pret" id="lot_pret_edit" class="form-control form-control-sm">
            </div>
            <div class="col-md-6">
              <label for="destination">Destination</label><sup class="text-danger">*</sup>
              <input type="text" name="destination" id="destination_edit" class="form-control form-control-sm" required>
            </div>
            <div class="col-md-6">
              <label for="acheteur">Acheteur</label>
              <input type="text" name="acheteur" id="acheteur_edit" class="form-control form-control-sm">
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal"><i class="fa fa-times"></i> Annuler</button>
          <button type="submit" class="btn btn-primary btn-xs"><i class="fa fa-save"></i> Valider</button>
        </div>
      </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  function modal_edit_licence_export(num_lic){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {num_lic: num_lic, operation: 'modal_edit_synthese_licence'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#num_lic_old').val(num_lic);
          // num_lic
          $('#num_lic_edit').val(data.num_lic);
          // id_banq
          $('#id_banq_edit').val(data.id_banq);
          // id_march
          $('#id_march_edit').val(data.id_march);
          // id_mod_trans
          $('#id_mod_trans_edit').val(data.id_mod_trans);
          // date_val
          $('#date_val_edit').val(data.date_val);
          // date_exp
          $('#date_exp_edit').val(data.date_exp);
          // poids
          $('#poids_edit').val(data.poids);
          // unit_mes
          $('#unit_mes_edit').val(data.unit_mes);
          // fob
          $('#fob_edit').val(data.fob);
          // lot_pret
          $('#lot_pret_edit').val(data.lot_pret);
          // destination
          $('#destination_edit').val(data.destination);
          // acheteur
          $('#acheteur_edit').val(data.acheteur);

          $('#modal_edit_synthese_licence').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#form_new_synthese_licence').submit(function(e){

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
                $('#modal_new_synthese_licence').modal('hide');
                $( '#form_new_synthese_licence' ).each(function(){
                    this.reset();
                });
                $('#synthese_licence').DataTable().ajax.reload();
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

  $(document).ready(function(){

      $('#form_edit_synthese_licence').submit(function(e){

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
                $('#modal_edit_synthese_licence').modal('hide');
                $( '#form_edit_synthese_licence' ).each(function(){
                    this.reset();
                });
                $('#synthese_licence').DataTable().ajax.reload();
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

  var today   = new Date();
  $('#synthese_licence').DataTable({
     lengthMenu: [
        [20, 50, 100, -1],
        [20, 50, 100, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
       {
          text: '<i class="fa fa-plus"></i> Insert License',
          className: 'btn btn-info',
          action: function ( e, dt, node, config ) {
              $('#modal_new_synthese_licence').modal('show');
          }
      },
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'Export License <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?>',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      }
    ],
    
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  // "autoWidth": true,
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": "<?php echo $_GET['id_cli']?>"
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli']?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>",
          "id_type_lic": "<?php echo $_GET['id_type_lic']?>",
          "operation": "synthese_licence"
      }
    },
    "createdRow": function( row, data, dataIndex ) {
      //cleared
      if ( data['id_mod_lic'] == "1" ) {  

        if (data['balance_poids']>=35 && data['delai']<=0) {
           $(row).addClass('bg-danger');
          $('td:eq(5)', row).addClass('clignote bg-dark');
         }else if (data['balance_poids']>=35 && data['delai']<=40) {
           $(row).addClass('bg-warning');
          $('td:eq(5)', row).addClass('clignote bg-dark');
         }

       }else if ( data['id_mod_lic'] == "2" ) {  

        if ((data['balance_fob']>=35) && data['delai']<=0) {
           $(row).addClass('bg-danger');
          $('td:eq(5)', row).addClass('clignote bg-dark');
         }

       }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"num_lic"},
      {"data":"nom_cli"},
      {"data":"nom_march"},
      {"data":"date_val"},
      {"data":"date_exp"},
      {"data":"delai"},
      {"data":"nom_banq"},
      {"data":"nbre_dossier"},
      {"data":"poids_licence",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"poids_dossier",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"balance_poids",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"fob_licence",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"fob_dossier",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"balance_fob",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });
</script>