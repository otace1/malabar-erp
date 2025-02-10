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
           <i class="fa fa-plus nav-icon"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'New Payment Request';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Nouvelle Demande de Fond';
              }
            ?>

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
            <form id="form_creer_demande_fond" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
                <input type="hidden" name="operation" value="creer_demande_fond">
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
                    <label for="id_dep">Expense Type 
                      <?php
                      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['creation_depense']=='1') {
                        ?>
                        <span class="btn-xs btn-primary"><i class="fa fa-plus" onclick="$('#modal_new_depense').modal('show');"></i></span>
                        <?php
                      }
                      ?>
                    </label>
                    <span id="select_id_dep"></span>
                    <!-- <label for="id_dep">Expense Type</label>
                    <select name="id_dep" id="id_dep" class="form-control form-control-sm" required>
                      <option></option>
                      <?php
                        // $maClasse-> selectionnerDepense();
                      ?>
                    </select> -->
                  </div>
                  <div class="col-md-3">
                    <label for="libelle">Motif / Reason</label>
                    <textarea name="libelle" id="libelle" class="form-control form-control-sm" required></textarea>
                  </div>
                  <div class="col-md-3">
                    <label for="fichier_df">Support Doc.</label>
                    <input type="file" name="fichier_df" id="fichier_df" class="form-control form-control-sm">
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
                      <tbody id="table_marchandise_dossier">
                        
                      </tbody>
                      <tfoot>
                        <tr>
                          <td colspan="2"><span class="btn btn-xs btn-info" onclick="ajouterLigne()"><i class="fa fa-plus"></i> Add File</span> <span class="btn btn-xs btn-success" onclick="$('#modal_upload_dossier_df').modal('show');"><i class="fa fa-upload"></i> Upload Excel File</span></td>
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

                <button class="btn btn-sm btn-primary" type="submit" id="submit_btn">Submit</button>
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

<div class="modal fade" id="modal_new_depense">
  <div class="modal-dialog modal-sm">
    <form id="form_new_depense" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="new_depense">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Expense</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Name</label>
            <input type="text" name="nom_dep" class="form-control form-control-sm cc-exp" required>
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

    selectionnerDepenseAjax();

  });

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

              $('#table_marchandise_dossier').html(data.table_dossier_df);
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

      $('#form_new_depense').submit(function(e){

        e.preventDefault();

        var fd = new FormData(this);

        $('#spinner-div').show();
        $('#modal_new_depense').modal('hide');

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
              $( '#form_new_depense' ).each(function(){
                  this.reset();
              });
              selectionnerDepenseAjax();
            }
          },
          complete: function () {
              // $('#dossier_cvee').DataTable().ajax.reload();
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });
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
          document.getElementById("submit_btn").setAttribute("disabled","true");
        }else{
          $('#remarque_'+ligne).html('');
          document.getElementById("submit_btn").removeAttribute("disabled");
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
     data: { id_cli: $('#id_cli').val(), ligne: ligne, mot_cle: mot_cle, operation: 'modal_search_dossier_df'},
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
    var table = document.getElementById("table_marchandise_dossier");
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

  $(document).ready(function(){

      $('#form_creer_demande_fond').submit(function(e){

        e.preventDefault();

        somme = 0;

        var fd = new FormData(this);

        for (var i = 0; i < fd.get('nbre'); i++) {

          if (parseFloat(fd.get('montant_'+i)) > 0 ) {
            montant = parseFloat(fd.get('montant_'+i));
          }else{
            montant=0;
          }
          
          somme+= montant;

        }

          console.log('somme == '+(Math.round(somme * 100) / 100));
          console.log('montant == '+(Math.round(fd.get('montant') * 100) / 100));
          // Math.round(num * 100) / 100

        if((Math.round(somme * 100) / 100)!=(Math.round(fd.get('montant') * 100) / 100) && fd.get('id_dos_0')){

          console.log('somme = '+(Math.round(somme * 100) / 100));
          console.log('montant = '+(Math.round(fd.get('montant') * 100) / 100));

          alert('Error! The balance isn\'t correct.');


        }else if(confirm('Do really you want to submit ?')) {
          
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
                $( '#form_creer_demande_fond' ).each(function(){
                    this.reset();
                });
                $('#table_marchandise_dossier').html('');
                $('#message').html(data.message);
                window.open('generateur_demande_fond.php?id_df='+data.id_df+'&couleur=','pop1','width=500,height=700');
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
