<?php
  include("tetePopCDN.php");
  //include("licenceExcel.php");
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-list nav-icon"></i> Licences <?php echo $maClasse-> getNomClient($_GET['id_cli']).' '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']);?></h5>
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
   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">

              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="statut_licence" cellspacing="0" width="100%" class="table text-center table-header-fixed display compact table-bordered table-striped table table-sm small text-nowrap">
                  <thead>
                    <tr>
                      <th style="">#</th>
                      <th style="">Licence Ref.</th>
                      <th style="">Client</th>
                      <th style="">Date Validation</th>
                      <th style="">Date Expiration</th>
                      <th style="">Delai</th>
                      <th style="">Dossiers</th>
                      <th style="">Tonnage Licence</th>
                      <th style="">Tonnage Dossiers</th>
                      <th style="">Balance Tonnage</th>
                      <th style="">FOB Licence</th>
                      <th style="">FOB Dossiers</th>
                      <th style="">Balance FOB</th>
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


<div class="modal fade " id="modal_edit_statut_licence">
  <div class="modal-dialog modal-md">
    <form id="form_edit_statut_licence" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_dos" id="id_dos">
      <input type="hidden" name="operation" id="operation" value="edit_statut_licence">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">File Ref.</label>
            <input name="ref_dos" id="ref_dos" class="form-control form-control-sm cc-exp" disabled>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">AWB Num.</label>
            <input name="road_manif" id="road_manif" class="form-control form-control-sm cc-exp" disabled>
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Border Arrival Date</label>
            <input type="date" name="klsa_arriv" id="klsa_arriv" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Border warehouse arrival date</label>
            <input type="date" name="wiski_arriv" id="wiski_arriv" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Border departure arrival date</label>
            <input type="date" name="wiski_dep" id="wiski_dep" class="form-control form-control-sm cc-exp">
          </div>

          <div class="col-md-6">
            <label for="x_card_code" class="control-label mb-1">Dispatch from border</label>
            <input type="date" name="dispatch_klsa" id="dispatch_klsa" class="form-control form-control-sm cc-exp">
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

  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

<script type="text/javascript">

  function modal_edit_statut_licence(id_dos){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, operation: 'modal_edit_statut_licence'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_dos').val(data.id_dos);
          $('#ref_dos').val(data.ref_dos);
          $('#road_manif').val(data.road_manif);
          $('#klsa_arriv').val(data.klsa_arriv);
          $('#wiski_arriv').val(data.wiski_arriv);
          $('#wiski_dep').val(data.wiski_dep);
          $('#dispatch_klsa').val(data.dispatch_klsa);
          $('#modal_edit_statut_licence').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#form_edit_statut_licence').submit(function(e){

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
                $('#modal_edit_statut_licence').modal('hide');
                $( '#form_edit_statut_licence' ).each(function(){
                    this.reset();
                });
                $('#statut_licence').DataTable().ajax.reload();
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
  $('#statut_licence').DataTable({
     lengthMenu: [
        [100, 200, -1],
        [100, 200, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        'excel',
        'pageLength'
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
          "id_cli": "<?php echo $_GET['id_cli']?>"
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli']?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>",
          "operation": "statut_licence"
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
      {"data":"date_val"},
      {"data":"date_exp"},
      {"data":"delai"},
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
      }
    ] 
  });
</script>
