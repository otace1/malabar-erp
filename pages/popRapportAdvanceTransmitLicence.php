<?php
  include("tetePopCDN.php");
  //include("popUpDashboardLicenceExcel.php");
  $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getClient($_GET['id_cli'])['nom_cli'].'</span>';
  $modeleLicence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'</span>';
 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card-<?php echo $couleur;?>">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i> Advanced Report | Licenses <?php echo $client.$modeleLicence;?>
                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body">
                              <table id="rapportAdvanceTransmitLicence" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm small text-nowrap table-responsive p-0">
                                <thead>
                                  <tr>
                                    <th style="text-align: center; ">#</th>
                                    <th>Num.Licence</th>
                                    <th>Dossiers non-tranmis</th>
                                    <th>Transmis sans AR</th>
                                    <th>Transmis avec AR</th>
                                    <th></th>
                                  </tr>
                                </thead>
                                <tbody>
                                 
                                </tbody>
                              </table>
                            </div>
                        </div>
                    </div>
                        <!-- input states -->
                    <!-- /.card-body -->
                  </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>

  <?php
  include('pied.php');
  ?>

<div class="modal fade" id="modal_edit_dossier">
  <div class="modal-dialog modal-sm small">
    <form id="form_edit_dossier" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" id="operation" value="edit_dossier">
      <input type="hidden" name="id_dos" id="id_dos">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">MCA Ref.</label>
            <input id="ref_dos" class="form-control form-control-sm cc-exp bg-dark" disabled>
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Assurance Ref.</label>
            <input id="ref_assurance" name="ref_assurance" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Type</label>
            <select id="type_apurement" name="type_apurement" class="form-control form-control-sm cc-exp">
              <option value=""></option>
              <option value="Partiel">Partiel</option>
              <option value="Total">Total</option>
            </select>
        </div>
        <div class="form-group">
            <label for="x_card_code" class="control-label mb-1">Remarque</label>
            <select id="remarque_apurement" name="remarque_apurement" class="form-control form-control-sm cc-exp">
              <option></option>
              <option value="Provision AV">Provision AV</option>
              <option value="Provision Licence">Provision Licence</option>
            </select>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Cancelled</button>
        <button type="submit" name="ok" class="btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <script type="text/javascript">
    
  $(document).ready(function(){

      $('#form_edit_dossier').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          var fd = new FormData(this);
          $('#modal_edit_dossier').modal('hide');
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
                $('#rapportAdvanceTransmitLicence').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function modal_edit_dossier(id_dos){

    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: {id_dos: id_dos, operation: 'getDossier'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_dos').val(data.ref_dos);
          $('#id_dos').val(data.id_dos);
          $('#ref_assurance').val(data.ref_assurance);
          $('#type_apurement').val(data.type_apurement);
          $('#remarque_apurement').val(data.remarque_apurement);
          $('#modal_edit_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $('#rapportAdvanceTransmitLicence').DataTable({
     lengthMenu: [
        [15, 30, 50, 100, 500, -1],
        [15, 30, 50, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
        // fixedColumns: {
        //   left: 3
        // },
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
      //       modal_edit_dossier();
      //   }
      // }
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
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "rapportAdvanceTransmitLicence"
      }
    },
    // rowGroup: {
    //     dataSrc: "num_lic",

    // },
    "columns":[
      {"data":"compteur"},
      {"data":"num_lic",
        className: 'dt-body-left'
      },
      {"data":"dos_non_trans",
        className: 'dt-body-center'
      },
      {"data":"dos_trans_sans_ar",
        className: 'dt-body-center'
      },
      {"data":"dos_trans_avec_ar",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  </script>