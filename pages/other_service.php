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
          <h5>
            <i class="fa fa-file"></i> Others Service
            <!-- <span class="float-right">
              <input class="form-control-sm" type="date" name="debut" id="debut" onchange="get_tableau_kpis()">
              <input class="form-control-sm" type="date" name="fin" id="fin" onchange="get_tableau_kpis()">
            </span> -->
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
              <!-- /.card-header -->
              <!-- style="cursor:pointer" -->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>

        </div>

        <div class="row">
          <div class="col-6">
            <div class="card">
              <!-- /.card-header -->
              <!-- style="cursor:pointer" -->
              <div class="card-body table-responsive p-0 small">
                <table id="file_other_service" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th width="5%">#</th>
                      <th>File Ref.</th>
                      <th>Client</th>
                      <th>Description</th>
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


<div class="modal fade" id="modal_new_file_other_service">
  <div class="modal-dialog modal-sm">
    <form method="POST" id="form_new_file_other_service" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="new_file_other_service">
    <div class="modal-content">
      <div class="modal-header ">
        <h5 class="modal-title">
          <i class="fa fa-plus"></i> New Other Service File
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      
      <div class="modal-body">

        <div class="form-group">
           <label>MCA File Ref.</label>
           <input type="text" id="ref_dos" name="ref_dos" class="form-control form-control-sm" required>
        </div>

        <div class="form-group">
           <label>Client</label>
           <select id="id_cli" name="id_cli" class="form-control form-control-sm" required>
             <option></option>
             <?php
              $maClasse-> selectionnerClient();
             ?>
           </select>
        </div>

        <div class="form-group">
           <label>Description/Comment</label>
           <textarea type="text" id="remarque" name="remarque" class="form-control form-control-sm" required></textarea>
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
      </div>

    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<script type="text/javascript">
  
  $(document).ready(function(){

    $('#form_new_file_other_service').submit(function(e){

      e.preventDefault();

      if(confirm('Do really you want to submit ?')){


        var fd = new FormData(this);

        $('#spinner-div').show();
        $('#modal_new_file_other_service').modal('hide');

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
              $( '#form_new_file_other_service' ).each(function(){
                  this.reset();
              });
              $('#file_other_service').DataTable().ajax.reload();
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

 function build_new_file_other_service(){
  $('#spinner-div').show();

  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {operation: 'build_new_file_other_service'},
    dataType: 'json',
    success:function(data){
      if (data.logout) {
        alert(data.logout);
        window.location="../deconnexion.php";
      }else{
        $('#ref_dos').val(data.ref_dos);
        $('#modal_new_file_other_service').modal('show');
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

  }

  $('#spinner-div').show();
  $('#file_other_service').DataTable({
     lengthMenu: [
        [15, 25, 50, -1],
        [15, 25, 50, 'All'],
    ],
    dom: 'Bfrtip',
  buttons: [
         {
            text: '<i class="fa fa-plus"></i> New File',
            className: 'btn btn-info',
            action: function ( e, dt, node, config ) {
                build_new_file_other_service();
            }
        },
      {
        extend: 'excel',
        text: '<i class="fa fa-file-excel"></i>',
        title: 'Tracking KPI\'S',
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
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "file_other_service"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"nom_cli",
        className: 'dt-body-center'
      },
      {"data":"remarque"}
    ]
  });
  $('#spinner-div').hide();

</script>
