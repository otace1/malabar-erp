<?php
  // include("tete.php");
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
          <h5 class="" style="font-weight: bold;">
           <i class="fa fa-edit nav-icon"></i>
           Edit Payment Request
            <div class="float-right">
              <button class="btn btn-xs btn-danger" onclick="if(confirm('Do really you want to cancel ?')) {window.location='demande_fond.php';}">
                <i class="fa fa-arrow-left"></i>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Cancel & Return';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Annuler et Retourner';
                  }
                ?>
              </button>
            </div>

          </h5>
        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-12">
            <span id="message"></span>
          </div>
          <div class="col-12">
            <form id="form_edit_demande_fond" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
                <input type="hidden" name="operation" value="edit_demande_fond">
                <input type="hidden" name="id_df" value="<?php echo $_GET['id_df'];?>">
              <div class="card-body">
                <div class="row callout callout-info">
                  <div class="col-sm-12"><h5 class="text-uderline">General Informations</h5></div>
                  <div class="col-md-12"><span id="msg_check_camion"></span><span id="message"></span></div>
                  
                  <div class="col-md-3">
                    <label for="id_dept">Department</label>
                    <select name="id_dept" id="id_dept" class="form-control form-control-sm" required>
                      <option></option>
                      <?php
                        $maClasse-> selectionnerDepartement();
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="id_site">Location</label>
                    <select name="id_site" id="id_site" class="form-control form-control-sm" required>
                      <option></option>
                      <?php
                        $maClasse-> selectionnerSite();
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="beneficiaire">Beneficiary</label>
                    <input type="text" name="beneficiaire" id="beneficiaire" class="form-control form-control-sm" required>
                  </div>
                  <div class="col-md-3">
                    <label for="id_cli">Client</label>
                    <select name="id_cli" id="id_cli" class="form-control form-control-sm" required>
                      <option></option>
                      <?php
                        $maClasse-> selectionnerClient();
                      ?>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="cash">Payment Type</label>
                    <select name="cash" id="cash" class="form-control form-control-sm" required>
                      <option></option>
                      <option value="1">Cash</option>
                      <option value="0">Bank</option>
                    </select>
                  </div>
                  <div class="col-md-3">
                    <label for="usd">Currency</label>
                    <select name="usd" id="usd" class="form-control form-control-sm" required>
                      <option></option>
                      <option value="1">USD</option>
                      <option value="0">CDF</option>
                    </select>
                  </div>
                  <!-- <div class="col-md-3">
                    <label for="taux">Rate Of Exchange</label>
                    <input type="number" step="0.01" value="1" onkeyup="convert_usd();" name="taux" id="taux" class="form-control form-control-sm text-center " required>
                  </div> -->
                  <div class="col-md-3">
                    <label for="montant">Amount</label>
                    <input type="number" step="0.001" name="montant" id="montant" onkeyup="convert_usd();" class="form-control form-control-sm text-center " required>
                  </div>
                  <!-- <div class="col-md-3">
                    <label for="usd_net">USD Net Amount</label>
                    <input step="0.01" id="usd_net" class="form-control form-control-sm text-center bg bg-dark font-weight-bold " disabled>
                  </div> -->
                  <div class="col-md-3">
                    <label for="id_dep">Expense Type</label>
                    <select name="id_dep" id="id_dep" class="form-control form-control-sm" onchange="$('#id_dep_new_d').val(this.value);" required>
                      <option></option>
                      <?php
                        $maClasse-> selectionnerDepense();
                      ?>
                    </select> 
                  </div>
                  <div class="col-md-3">
                    <label for="libelle">Motif / Reason</label>
                    <textarea name="libelle" id="libelle" class="form-control form-control-sm" required></textarea>
                  </div>
                  <div class="col-md-3">
                    <label for="fichier_df">Support Doc. <span class="btn btn-xs text-xs text-primary" onclick="$('#modal_update_fichier_df').modal('show');"><i class="fa fa-upload"></i> Upload</span> <span class="btn btn-xs text-xs text-danger" onclick="remove_fichier_df('<?php echo $_GET['id_df'];?>');"><i class="fa fa-times"></i> Remove</span> </label>
                    <span class="form-control form-control-sm" id="fichier_demande"></span>
                  </div>
                </div>

                <div class="row callout callout-info">
                  <div class="col-sm-12"><h5 class="text-uderline">Files</h5></div>
                  <div class="col-md-12">
                    <table class="table-bordered table-striped table-responsive text-nowrap table-hover table-sm text-nowrap table-head-fixed">
                      <thead>
                          <tr>
                              <th style="">#</th>
                              <th style="">MCA File Ref.</th>
                              <th style="">Amount</th>
                          </tr>
                      </thead>
                      <tbody id="table_dossier_demande">
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <input type="hidden" id="montant_dossier_df">
                          <input type="hidden" id="id_dep_new_d">
                          <td></td>
                          <td>
                            <input type="hidden" id="id_dos_1" name="id_dos"><span id="label_ref_dos_1"></span><a href="#" class="text-primary" onclick="modal_search_dossier_df(1)"><i class="fa fa-search"></i></a>
                          </td>
                          <td>
                            <input type="number" step="0.001" class=" text-right" style="width: 8em;" id="montant_1">
                          </td>
                          <td>
                            <span class="btn btn-xs btn-primary" onclick="creerDepenseDossierDF(id_dep_new_d.value, id_dos_1.value, montant_1.value, '<?php echo $_GET['id_df'];?>');">
                              <i class="fa fa-check"></i>
                            </span>
                          </td>
                        </tr>
                      </tfoot>
                    </table>
                    <input type="hidden" name="nbre" id="nbre">
                  </div>
                </div>

                <div class="row callout callout-info">
                  <div class="col-sm-12"><h5 class="text-uderline">Approval</h5></div>
                  
                  <div class="col-md-3">
                    <label for="fret">Visa</label>
                    <select name="id_util_visa_dept" id="id_util_visa_dept" class="form-control form-control-sm" required>
                      <option></option>
                      <?php
                        $maClasse-> selectionnerUserVisaDept();
                      ?>
                    </select>
                  </div>
                </div>

                <button class="btn btn-sm btn-primary" type="submit">Submit</button>
              </div>
              </form>
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

<div class="modal fade" id="modal_search_dossier_df">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"><i class="fa fa-search"></i> File </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <input type="hidden" id="index_ligne">

          <input type="text" class="form-control form-control-sm" placeholder="MCA-RF24-096" onkeyup="modal_search_dossier_df(index_ligne.value, this.value);">
          <hr>
          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed ">
              <thead>
                  <tr>
                  <tr>
                      <th>#</th>
                      <th>MCA File Ref.</th>
                  </tr>
              </thead>
              <tbody id="table_dossier_df">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_update_fichier_df">
  <div class="modal-dialog modal-sm">
    <form id="form_update_fichier_df" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="update_fichier_df">
      <input type="hidden" name="id_df" value="<?php echo $_GET['id_df'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-upload"></i> Upload File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">File</label>
            <input type="file" name="fichier_df" class="form-control form-control-sm cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_upload_dossier_df">
  <div class="modal-dialog modal-sm">
    <form id="form_upload_dossier_df" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="upload_dossier_df">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-upload"></i> Upload Excel File</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">File</label>
            <input type="file" name="fichier_dossier_df" class="form-control form-control-sm cc-exp" required>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

      $('#form_edit_demande_fond').submit(function(e){

        e.preventDefault();

        somme = 0;

        var fd = new FormData(this);
        if(confirm('Do really you want to submit ?')) {
          
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
                window.location="demande_fond.php";
              }
            },
            complete: function () {
                // $('#dossier_cvee').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  $(document).ready(function(){

    selectionnerDepenseAjax();
    getDemandeFond();
    getFichierDemande();
    table_dossier_demande();

  });

  function table_dossier_demande(){

    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'table_dossier_demande', id_df: "<?php echo $_GET['id_df'];?>"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#table_dossier_demande').html(data.table_dossier_demande);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function creerDepenseDossierDF(id_dep, id_dos, montant, id_df){

    // get_montant_total_depense_dossier_DF(id_df);

    // console.log('montant_dossier_df = '+$('#montant_dossier_df').val());

    // console.log('Montant dossier = '+(Math.round($('#montant_dossier_df').val() * 100) / 100));
    // console.log('Montant demande  = '+(Math.round($('#montant').val() * 100) / 100));


    // if ((Math.round($('#montant_dossier_df').val() * 100) / 100)==(Math.round($('#montant').val() * 100) / 100)) {

      if(confirm('Do really you want to add this file ?')) {
        $('#spinner-div').show();
        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {operation: 'creerDepenseDossierDF', id_dep: id_dep, id_dos: id_dos, montant: montant, id_df: id_df},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              table_dossier_demande();
              $('#label_ref_dos_1').html('');
              $('#id_dos_1').val('');
              $('#montant_1').val('');
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });
      }

    // }else{

    //   alert('Error! The balance isn\'t correct.');

    // }
  }
   
  function get_montant_total_depense_dossier_DF(id_df){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'get_montant_total_depense_dossier_DF', id_df: id_df},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#montant_dossier_df').val(data.montant);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }
  
  function delete_depense_dossier(id_dos, id_df){
    if(confirm('Do really you want to remove this file ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'delete_depense_dossier', id_df: id_df, id_dos: id_dos},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            table_dossier_demande();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }

  }
  
  function remove_fichier_df(){
    if(confirm('Do really you want to remove the support document ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'remove_fichier_df', id_df: "<?php echo $_GET['id_df'];?>"},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            getFichierDemande();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }

  }
  
  function getDemandeFond(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: "<?php echo $_GET['id_df'];?>"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // id_dept
          $('#id_dept').val(data.id_dept);
          $('#id_dep_new_d').val(data.id_dep);
          // id_site
          $('#id_site').val(data.id_site);
          // beneficiaire
          $('#beneficiaire').val(data.beneficiaire);
          // id_cli
          $('#id_cli').val(data.id_cli);
          // cash
          $('#cash').val(data.cash);
          // usd
          $('#usd').val(data.usd);
          // montant
          $('#montant').val(data.montant);
          // id_dep
          $('#id_dep').val(data.id_dep);
          // libelle
          $('#libelle').val(data.libelle);
          // id_util_visa_dept
          $('#id_util_visa_dept').val(data.id_util_visa_dept);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function getFichierDemande(){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: "<?php echo $_GET['id_df'];?>"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          if(data.fichier_df!=null){
            $('#fichier_demande').html(data.support_doc);
          }else{
            $('#fichier_demande').html('');
          }
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  $(document).ready(function(){

      $('#form_upload_dossier_df').submit(function(e){

        e.preventDefault();

        var fd = new FormData(this);

        $('#spinner-div').show();
        $('#modal_upload_dossier_df').modal('hide');

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
              $( '#form_upload_dossier_df' ).each(function(){
                  this.reset();
              });

              $('#table_dossier_demande').html(data.table_dossier_df);
              $('#nbre').val(data.nbre);
              // selectionnerDepenseAjax();
            }
          },
          complete: function () {
              // $('#dossier_cvee').DataTable().ajax.reload();
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });
      });
    
  });

  $(document).ready(function(){

      $('#form_update_fichier_df').submit(function(e){
        if(confirm('Do really you want to submit ?')) {
          e.preventDefault();

          var fd = new FormData(this);

          $('#spinner-div').show();
          $('#modal_update_fichier_df').modal('hide');

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
                $( '#form_update_fichier_df' ).each(function(){
                    this.reset();
                });
                getFichierDemande();
              }
            },
            complete: function () {
                // $('#dossier_cvee').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });
        }
      });
    
  });

  function selectionnerDepenseAjax(){
    $('#spinner-div').show();

   $.ajax({
     type: "POST",
     url: "ajax.php",
     data: { operation: 'selectionnerDepenseAjax'},
     dataType:"json",
     success:function(data){
       if (data.logout) {
         alert(data.logout);
         window.location="../deconnexion.php";
       }else{
         $('#select_id_dep').html(data.option);
       }
     },
     complete: function () {
         $('#spinner-div').hide();//Request is complete so hide spinner
     }
   });

  }

  function convert_usd() {
    

    if (parseFloat($('#montant').val()) > 0 ) {
      montant = parseFloat($('#montant').val());
    }else{
      montant=0;
    }

    if (parseFloat($('#taux').val()) > 0 ) {
      taux = parseFloat($('#taux').val());
    }else{
      taux=1;
    }

    usd_net = montant/taux;

    $('#usd_net').val(usd_net.toFixed(2));

  }

  function get_dossier(id_dos, ref_dos, ligne){
    $('#id_dos_'+ligne).val(id_dos);
    $('#label_ref_dos_'+ligne).html(ref_dos);
    $('#modal_search_dossier_df').modal('hide');


    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'double_check_request', id_dos: id_dos, id_dep: $('#id_dep').val()},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else if(data.id_dos){
          $('#remarque_'+ligne).html('<span class="text-danger font-weight-bold clignoteb">Already Encoded !! Voucher Ref.'+data.id_df+'</span>');
        }else{
          $('#remarque_'+ligne).html('');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_search_dossier_df(ligne, mot_cle=null){
    $('#spinner-div').show();
    $('#index_ligne').val(ligne);

   $.ajax({
     type: "POST",
     url: "ajax.php",
     data: { id_cli: $('#id_cli').val(), id_dep: $('#id_dep').val(), ligne: ligne, mot_cle: mot_cle, operation: 'modal_search_dossier_df'},
     dataType:"json",
     success:function(data){
       if (data.logout) {
         alert(data.logout);
         window.location="../deconnexion.php";
       }else{
         $('#table_dossier_df').html(data.table_dossier_df);
         $('#modal_search_dossier_df').modal('show');
       }
     },
     complete: function () {
         $('#spinner-div').hide();//Request is complete so hide spinner
     }
   });

  }

  function ajouterLigne() {
    var table = document.getElementById("table_dossier_demande");
    var ligne = table.rows.length;
    var row = table.insertRow(ligne);
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);
    var cell3 = row.insertCell(2);
    var cell4 = row.insertCell(3);
    cell1.innerHTML = ligne+1;
    cell2.innerHTML = '<input type="hidden" id="id_dos_'+ligne+'" name="id_dos_'+ligne+'"><span id="label_ref_dos_'+ligne+'"></span><a href="#" class="text-primary" onclick="modal_search_dossier_df('+ligne+')"><i class="fa fa-search"></i></a>';
    cell3.innerHTML = '<input type="number" step="0.001" class=" text-right" style="width: 8em;" id="montant_'+ligne+'" name="montant_'+ligne+'" required>';
    cell4.innerHTML = '<span id="remarque_'+ligne+'"></span>';
    $('#nbre').val(ligne+1);
    // cell2.innerHTML = table.rows.length;
  }

  function modal_edit_cvee(id_dos){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDossier', id_dos: id_dos},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_ref_dos').html(data.ref_dos);
          //id_dos
          $('#id_dos_edit').val(data.id_dos);
          //num_lot
          $('#num_lot_edit').val(data.num_lot);
          //ref_cvee
          $('#ref_cvee_edit').val(data.ref_cvee);
          //fob_cvee
          $('#fob_cvee_edit').val(data.fob_cvee);
          $('#modal_edit_cvee').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
 function modal_worksheet(id_dos){
  $('#spinner-div').show();

  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {operation: 'modal_worksheet', id_dos: id_dos},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#id_dos_worsheet').val(data.id_dos);
        $('#ref_dos').html(data.ref_dos);
        $('#ref_crf').val(data.ref_crf);
        $('#ref_fact').val(data.ref_fact);
        $('#incoterm').val(data.incoterm);
        $('#roe_feuil_calc').val(data.roe_feuil_calc);
        $('#regime').html(data.regime);
        $('#num_lic').html(data.num_lic);
        $('#fret_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.fret*1000)/1000));
        $('#assurance_worksheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.assurance*1000)/1000));
        $('#autre_frais_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.autre_frais*1000)/1000));
        $('#fret').html(data.fret);
        $('#assurance').html(data.assurance);
        $('#autre_frais').html(data.autre_frais);
        $('#marchandiseDossier').html(data.marchandiseDossier);
        getSommeMarchandiseDossier(id_dos);
        $('#modal_worksheet').modal('show');
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

  }

  $('#dossier_cvee').DataTable({
     lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i>',
          className: 'btn btn-success'
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
          "operation": "dossier_cvee"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      // {"data":"code_cli"},
      {"data":"num_lot",
        className: 'dt-body-center'
      },
      {"data":"num_lic",
        className: 'dt-body-center'
      },
      {"data":"nom_march",
        className: 'dt-body-center'
      },
      {"data":"poids",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"ref_cvee",
        className: 'dt-body-center'
      },
      {"data":"fob_cvee",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"nom_mod_trans",
        className: 'dt-body-center'
      },
      {"data":"truck",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

</script>
