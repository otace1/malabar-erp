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
          <div class="row mb-2">
            <div class="col-sm-6">
              <h5><img src="../images/parametres.png" width="25px"> Settings</h5>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <!-- <li class="breadcrumb-item"><a href="#">Home</a></li> -->
                <li class="breadcrumb-item active">Settings</li>
              </ol>
            </div>
          </div>
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
              <div class="card-body table-responsive p-0 small">
                <table id="invoice_assigned" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="">#</th>
                      <th style="">Short Name</th>
                      <th style="">Complet Name</th>
                      <th style="">Code</th>
                      <th style=""></th>
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

<div class="modal fade" id="modal_create_assignement">
  <div class="modal-dialog modal-sm small">
    <form id="create_assignement_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="create_assignement">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> New Assignement</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Person</label>
          <select class="form-control cc-exp form-control-sm" name="id_util">
            <option></option>
            <?php
              $maClasse-> selectionnerUtilisateurRole(12);
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Client</label>
          <select class="form-control cc-exp form-control-sm" name="id_cli">
            <option></option>
            <?php
              $maClasse-> selectionnerClient();
            ?>
          </select>
        </div>

        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1">Transit</label>
          <select class="form-control cc-exp form-control-sm" name="id_mod_lic">
            <option></option>
            <?php
              $maClasse-> selectionnerModeleLicence();
            ?>
          </select>
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

<script type="text/javascript">
  
  $(document).ready(function(){

    $('#create_assignement_form').submit(function(e){

      e.preventDefault();

       if(confirm('Do you really want to submit ?')) {
          
          $('#spinner-div').show();
          $('#modal_create_assignement').modal('hide');

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

                $('#pending_report').DataTable().ajax.reload();
                $('#invoice_assigned').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
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
  function remove_assignement(id_util, id_mod_lic, id_cli){

    if(confirm('Do really you want to delete this assignement ?')) {

      $('#spinner-div').show();

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { id_util: id_util, id_cli:id_cli, id_mod_lic:id_mod_lic, operation: 'remove_assignement'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#invoice_assigned').DataTable().ajax.reload();
              $('#pending_report').DataTable().ajax.reload();
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

    }

  }

  $('#invoice_assigned').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'ASSIGNEMENT',
        className: 'btn btn-success'
      },
      {
        extend: 'pageLength',
        text: '<i class="fa fa-list"></i>',
        className: 'btn btn-dark'
      },
      {
        text: '<i class="fa fa-plus"></i> New',
        className: 'btn btn-info',
        action: function ( e, dt, node, config ) {
            $( '#create_assignement_form' ).each(function(){
              this.reset();
            });
            $('#modal_create_assignement').modal('show');
        }
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
          "operation": "liste_client"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"nom_cli"},
      {"data":"nom_complet"},
      {"data":"code_cli"},
      {"data":"btn_action_2"}
    ]
  });

</script>
