<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='listerFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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
    $_GET['id_cli'] = NULL;
  }

  if( isset($_POST['facturerDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
    </script>
    <?php
  }

  if( isset($_POST['facturerSousDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>&note_debit=1';
    </script>
    <?php
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
          <h5><i class="fa fa-folder-open nav-icon"></i> PENDING FILES INVOICING <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h5>
        </div>

      </div><!-- /.container-fluid -->

                  <!-- <div class="card-tools">
                    <div class="pull-right">
                      <button class="btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                          <i class="fa fa-filter"></i> Filtrage Client
                      </button>
                    </div>
                  </div> -->
    </section>
    <?php

    if( isset($_POST['validerFacture']) ){
     $maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact'], '1');
    }

    if( isset($_POST['transmissionFacture']) ){
     $maClasse-> MAJ_transmission_facture_dossier($_POST['ref_fact'], '1', $_SESSION['id_util']);
    }

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  Awaiting Support Documents
                </h5>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs" class=" table table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="" width="5px">#</th>
                      <th style="">File Ref.</th>
                      <th style="">Commodity</th>
                      <th style=" text-align: center;">Decl.Ref.</th>
                      <th style=" text-align: center;">Decl.Date</th>
                      <th style=" text-align: center;">Liq.Ref.</th>
                      <th style=" text-align: center;">Liq.Date</th>
                      <th style=" text-align: center;">Quit.Ref.</th>
                      <th style=" text-align: center;">Quit.Date</th>
                      <th style=" text-align: center;"></th>
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

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  To Be Invoiced
                </h5>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="afficherDossierEnAttenteFactureAjaxWithSupportDocs" class=" table table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="">#</th>
                      <th style="">File Ref.</th>
                      <th style="">Commodity</th>
                      <th style=" text-align: center;">Decl.Ref.</th>
                      <th style=" text-align: center;">Decl.Date</th>
                      <th style=" text-align: center;">Liq.Ref.</th>
                      <th style=" text-align: center;">Liq.Date</th>
                      <th style=" text-align: center;">Quit.Ref.</th>
                      <th style=" text-align: center;">Quit.Date</th>
                      <th style=" text-align: center;"></th>
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
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<div class="modal fade rechercheClient" id="modal_desactiver_facturation_dossier">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="ref_fact" id="ref_fact">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
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
                  // $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  function find_support_doc(id_dos) {
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, operation: "getPathArchive"},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $( '#enregistrerFactureExportMultiple_form' ).each(function(){
              this.reset();
          });
          // console.log('file:\\\\\\'+data.lien);
          window.open('file:\\\\\\'+data.lien,'pop1','width=500,height=400');
          // var txt = '';
          // var xmlhttp = new XMLHttpRequest();
          // xmlhttp.onreadystatechange = function(){
          //   if(xmlhttp.status == 200 && xmlhttp.readyState == 4){
          //     txt = xmlhttp.responseText;
          //   }
          // };
          // xmlhttp.open("GET",'file:\\\\\\'+data.lien,true);
          // xmlhttp.send();
          // // window.location=data.lien;
        }
      }
    });

  }

  $('#afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs').DataTable({
     lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
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
  "autoWidth": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact'];?>",
          "support_doc": "0",
          "operation": "afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"commodity"},
      {"data":"ref_decl",
        className: 'dt-body-center'
      },
      {"data":"date_decl",
        className: 'dt-body-center'
      },
      {"data":"ref_liq",
        className: 'dt-body-center'
      },
      {"data":"date_liq",
        className: 'dt-body-center'
      },
      {"data":"ref_quit",
        className: 'dt-body-center'
      },
      {"data":"date_quit",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  $('#afficherDossierEnAttenteFactureAjaxWithSupportDocs').DataTable({
     lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
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
  "autoWidth": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact'];?>",
          "support_doc": "1",
          "operation": "afficherDossierEnAttenteFactureAjaxWithSupportDocs"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"commodity"},
      {"data":"ref_decl",
        className: 'dt-body-center'
      },
      {"data":"date_decl",
        className: 'dt-body-center'
      },
      {"data":"ref_liq",
        className: 'dt-body-center'
      },
      {"data":"date_liq",
        className: 'dt-body-center'
      },
      {"data":"ref_quit",
        className: 'dt-body-center'
      },
      {"data":"date_quit",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  $(document).ready(function(){

      $('#enregistrerFactureExportMultiple_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

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
                }else if(data.message){
                  $( '#enregistrerFactureExportMultiple_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewExportInvoiceMultiple2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
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

    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_cli: <?php echo $_GET['id_cli'];?>, id_mod_lic: <?php echo $_GET['id_mod_lic_fact'];?>, operation: 'afficherDossierEnAttenteFactureAjax'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#afficherDossierEnAttenteFactureAjax').html(data.afficherDossierEnAttenteFactureAjax);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

    
  });

  function MAJ_support_doc(id_dos, ref_dos, support_doc){
    if (support_doc=='1') {
      if(confirm('Do really you want to confirm support documents for '+ref_dos+' ?')) {

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {support_doc: support_doc, id_dos: id_dos, operation: 'MAJ_support_doc'},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs').DataTable().ajax.reload();
              $('#afficherDossierEnAttenteFactureAjaxWithSupportDocs').DataTable().ajax.reload();
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }
    }else{
      if(confirm('Do really you want to unconfirm support documents for '+ref_dos+' ?')) {

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {support_doc: support_doc, id_dos: id_dos, operation: 'MAJ_support_doc'},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs').DataTable().ajax.reload();
              $('#afficherDossierEnAttenteFactureAjaxWithSupportDocs').DataTable().ajax.reload();
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }
    }
  }

  function MAJ_not_fact(id_dos, ref_dos, id_cli, id_mod_lic){
    if(confirm('Do really you want to disable '+ref_dos+' ?')) {

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_cli: id_cli, id_mod_lic: id_mod_lic, id_dos: id_dos, operation: 'MAJ_not_fact'},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#afficherDossierEnAttenteFactureAjaxAwaitingSupportDocs').DataTable().ajax.reload();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }
  }
</script>