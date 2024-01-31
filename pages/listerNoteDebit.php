<?php
  // include("tete.php");
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
    echo "<script>window.location='listerFactureDossier.php?id_mod_lic=$id_mod_lic&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
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

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-copy nav-icon"></i> <?php echo $modele['nom_mod_lic'].' DEBIT NOTES '.$client;?>
          <div class="btn-group float-center">
            <button type="button" class="btn btn-xs btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
              Navigation <span class="sr-only">Toggle Dropdown</span>
            </button>
            <div class="dropdown-menu" role="menu">
              <?php echo $maClasse-> get_aff_nd_client($_GET['id_mod_lic'], $_GET['id_cli']);?>
                <a class="dropdown-item text-sm" href="listerNoteDebit.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>"><i class="fa fa-list"></i> View Note(s)</a>
                <div class="dropdown-divider"></div>
            </div>
          </div>
          </h5>
          
        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                 <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_debit_note_pending_validation"></span> PENDING VALIDATION
                </h5>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="debit_note_pending_validation" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;" width="5px">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">ITEM</th>
                      <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                      <th style="border: 1px solid white; text-align: center;">ACTION</th>
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

          <div class="col-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                 <span style="color: #CCCC00;" class="badge badge-dark" id="nbre_debit_note_pending_validation"></span> VALIDATED
                </h5>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="debit_note_validated" class=" table table-dark table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;" width="5px">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">DATE</th>
                      <th style="border: 1px solid white; text-align: center;">ITEM</th>
                      <th style="border: 1px solid white; text-align: center;">AMOUNT</th>
                      <th style="border: 1px solid white; text-align: center;">ACTION</th>
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

<div class="modal fade" id="modal_send_invoice">
  <div class="modal-dialog modal-sm small">
    <form id="modal_send_invoice_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="send_invoice_mail">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-envelope"></i> Send email</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Invoice Ref.</label>
            <input id="label_ref_fact" class="form-control form-control-sm cc-exp bg-dark" disabled>
            <input type="hidden" name="ref_fact" id="ref_fact">
          </div>

          <div class="col-md-12"><hr></div>

          <div class="col-md-12">
            <table class=" table table-dark table-bordered table-hover text-nowrap table-sm">
              <thead>
                <tr class="bg bg-dark">
                  <th>#</th>
                  <th>Email Address</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="tableau_email">
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_dossiers_facture">
  <div class="modal-dialog modal-lg small">
   
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-file"></i> File(s) in invoices</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Invoice Ref.</label>
            <input id="label_ref_fact_2" class="form-control form-control-sm cc-exp bg-dark" disabled>
          </div>

          <div class="col-md-12"><hr></div>

          <div class="col-md-12">
            <table id="dossiers_facture" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
              <thead>
              <tr>
                <th>#</th>
                <th>File Ref.</th>
                <th>Truck(Wagon)</th>
                <th>Declaration</th>
                <th>Liquidation</th>
                <th>Quittance</th>
                <th>Amount</th>
              </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_edit_note_debit">
  <div class="modal-dialog modal-md">
    <!-- <form id="edit_note_debit_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" id="operation" value="edit_note_debit">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Debit Note</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-4">
            <label for="x_card_code" class="control-label mb-1">Debit Note Ref.</label>
            <input type="text" id="ref_note_edit" class="form-control form-control-sm cc-exp bg-dark" disabled>
          </div>

          <div class="col-md-12">
            <hr>
          </div>

          <div class="col-md-12">
            <div class="card-body table-responsive p-0 small" style="height: 500px;">
            <table class=" table table-bordered table-hover table-head-fixed  text-nowrap table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th>MCA File Ref.</th>
                  <th>Item</th>
                  <th>Amount</th>
                  <th></th>
                </tr>
              </thead>
              <tbody id="detail_debit_note">
              </tbody>
            </table>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
        <button type="submit" name="ok" class="btn-xs btn-primary">Submit</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">
  
  function edit_detail_depense(ref_note, id_dep_dos, montant){
    // if(confirm('Do really you want to remove this data ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {ref_note: ref_note, id_dep_dos: id_dep_dos, montant: montant, operation: "edit_detail_depense"},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#debit_note_validated').DataTable().ajax.reload();
            $('#debit_note_pending_validation').DataTable().ajax.reload();
          }
        }
      });
    // }
  }

  function delete_detail_depense(ref_note, id_dep_dos){
    if(confirm('Do really you want to remove this data ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {ref_note: ref_note, id_dep_dos: id_dep_dos, operation: "delete_detail_depense"},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#detail_debit_note').html(data.detail_debit_note);
            $('#debit_note_validated').DataTable().ajax.reload();
            $('#debit_note_pending_validation').DataTable().ajax.reload();
          }
        }
      });
    }
  }

  function modal_edit_note_debit(ref_note){

    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {ref_note: ref_note, operation: 'modal_edit_note_debit'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_note_edit').val(ref_note);
          $('#detail_debit_note').html(data.detail_debit_note);
          $('#modal_edit_note_debit').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#edit_note_debit_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          var fd = new FormData(this);
          $('#modal_edit_note_debit').modal('hide');
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

              }
            },
            complete: function () {
                // $('#dossiers_facture').DataTable().ajax.reload();
                $('#debit_note_validated').DataTable().ajax.reload();
                $('#debit_note_pending_validation').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function remove_file_invoice(id_dos){
    if(confirm('Do really you want to remove this file ?')) {
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {id_dos: id_dos, operation: "remove_file_invoice"},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else if(data.message){
            
            $('#dossiers_facture').DataTable().ajax.reload();
            $('#invoice_waiting_to_send').DataTable().ajax.reload();
            $('#debit_note_pending_validation').DataTable().ajax.reload();
            $('#invoice_send').DataTable().ajax.reload();
          }
        }
      });
    }
  }

  function modal_dossiers_facture(ref_fact){
    
    $('#spinner-div').show();

    $('#label_ref_fact_2').val(ref_fact);

    if ( $.fn.dataTable.isDataTable( '#dossiers_facture' ) ) {
        table = $('#dossiers_facture').DataTable();
    }
    else {
        table = $('#dossiers_facture').DataTable( {
            paging: false
        } );
    }

    table.destroy();

    $('#dossiers_facture').DataTable({
       lengthMenu: [
          [20, 50, 100, -1],
          [20, 50, 100, 500, 'All'],
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
            "id_cli": "844"
        },
        "data": {
            "ref_fact": ref_fact,
            "operation": "dossiers_facture"
        }
      },
      "columns":[
        {"data":"compteur"},
        {"data":"ref_dos"},
        {"data":"truck"},
        {"data":"declaration"},
        {"data":"liquidation"},
        {"data":"quittance"},
        {"data":"ttc_usd",
          render: DataTable.render.number( null, null, 2, null ),
          className: 'dt-body-right'
        }
      ] 
    });
    $('#spinner-div').hide();//Request is complete so hide spinner

    $('#modal_dossiers_facture').modal('show');
    
  }
  // $(document).ready(function(){
    
  //   $('#spinner-div').show();

  //    $.ajax({
  //     type: 'post',
  //     url: 'ajax.php',
  //     data: {operation: 'getAllNoteDebit', id_cli:<?php echo $_GET['id_cli'];?>, id_mod_lic:<?php echo $_GET['id_mod_lic'];?>},
  //     dataType: 'json',
  //     success:function(data){
  //       if (data.logout) {
  //         alert(data.logout);
  //         window.location="../deconnexion.php";
  //       }else{
  //         $('#debit_note_pending_validation').html(data.debit_note_pending_validation);
  //         $('#nbre_debit_note_pending_validation').html(data.nbre_debit_note_pending_validation);
  //         $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
  //         $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
  //         $('#invoice_send').html(data.invoice_send);
  //         $('#nbre_invoice_send').html(data.nbre_invoice_send);
  //       }
  //     },
  //     complete: function () {
  //         $('#spinner-div').hide();//Request is complete so hide spinner
  //     }
  //   });

  // });

  $('#debit_note_validated').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        [10, 100, 500, 'All'],
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
      // ,
      // {
      //   text: '<i class="fa fa-check"></i>',
      //   className: 'btn btn-info bt',
      //   action: function ( e, dt, node, config ) {
      //       modal_check_multiple();
      //   }
      // }
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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "statut": "debit_note_validated",
          "operation": "getNoteDebitAjax"
      }
    },
    rowGroup: {
        dataSrc: "nom_dep",

    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_note"},
      {"data":"date_note"},
      {"data":"nom_dep"},
      {"data":"montant_ttc",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"action"}
    ] 
  });

  $('#debit_note_pending_validation').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        [10, 100, 500, 'All'],
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
      // ,
      // {
      //   text: '<i class="fa fa-check"></i>',
      //   className: 'btn btn-info bt',
      //   action: function ( e, dt, node, config ) {
      //       modal_check_multiple();
      //   }
      // }
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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "statut": "debit_note_pending_validation",
          "operation": "getNoteDebitAjax"
      }
    },
    rowGroup: {
        dataSrc: "nom_dep",

    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_note"},
      {"data":"date_note"},
      {"data":"nom_dep"},
      {"data":"montant_ttc",
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"action"}
    ] 
  });

//Recuperation des factures

 function getAllNoteDebit(){
  $('#spinner-div').show();

  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {operation: 'getAllNoteDebit', id_cli:<?php echo $_GET['id_cli'];?>, id_mod_lic:<?php echo $_GET['id_mod_lic'];?>},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#debit_note_pending_validation').html(data.debit_note_pending_validation);
        $('#nbre_debit_note_pending_validation').html(data.nbre_debit_note_pending_validation);
        $('#invoice_waiting_to_send').html(data.invoice_waiting_to_send);
        $('#nbre_invoice_waiting_to_send').html(data.nbre_invoice_waiting_to_send);
        $('#invoice_send').html(data.invoice_send);
        $('#nbre_invoice_send').html(data.nbre_invoice_send);
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

  }

  function validerNoteDebit(ref_note){

    if(confirm('Do really you want to validate this debite note '+ref_note+'?')) {

      $('#spinner-div').show();

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { ref_note: ref_note, id_cli:<?php echo $_GET['id_cli'];?>, id_mod_lic:<?php echo $_GET['id_mod_lic'];?>, operation: 'validerNoteDebit'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#debit_note_pending_validation').DataTable().ajax.reload();
              $('#debit_note_validated').DataTable().ajax.reload();
              alert('Debit note ' + ref_note + ' has been validated!');
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

    }

  }

  function supprimerFacture(ref_fact){

    if(confirm('Do really you want to validate this invoice '+ref_fact+'?')) {

      $('#spinner-div').show();

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { ref_fact: ref_fact, id_cli:<?php echo $_GET['id_cli'];?>, id_mod_lic:<?php echo $_GET['id_mod_lic'];?>, operation: 'supprimerFacture'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#invoice_waiting_to_send').DataTable().ajax.reload();
              $('#debit_note_pending_validation').DataTable().ajax.reload();
              $('#invoice_send').DataTable().ajax.reload();
              alert('Invoice ' + ref_fact + ' has been deleted!');
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

    }

  }

function searchInvoice(ref_fact){

  document.getElementById("searchInvoice").style.display = "block";

  $('#spinner-div').show();
  $.ajax({
    type: "POST",
    url: "ajax.php",
    data: { ref_fact: ref_fact, id_cli:<?php echo $_GET['id_cli'];?>, id_mod_lic:<?php echo $_GET['id_mod_lic'];?>, operation: 'searchInvoice'},
    dataType:"json",
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#label_searchInvoice').html(ref_fact);
        $('#nbre_searchInvoice').html(data.nbre_searchInvoice);
        $('#results_searchInvoice').html(data.results_searchInvoice);
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

}

function editerFacture(ref_fact, edit_page){
  if(confirm('Do really you want to edit this invoice '+ref_fact+'?')) {
    window.location= edit_page + '?ref_fact='+ref_fact;
  }
}

</script>
