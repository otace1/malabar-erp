<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-cogs"></i>
            Settings | Debit Note |<?php echo $maClasse-> getNomClient($_GET['id_cli']);?>
          </h5>
          <div class="pull-right">
            <!-- <button class="btn btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button> -->
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
              <div class="card-header">
                <!-- <h5><i class="fa fa-folder-open nav-icon"></i> 
                  
                </h5>
 -->
                <div class="card-tools">
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="client_note_debit" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th width="10px">#</th>
                      <th>Expense</th>
                      <th>Transit</th>
                      <th>Template</th>
                      <th>Action</th>
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
  <?php include("pied.php");?>

<div class="modal fade" id="modal_add_aff_modele_note_debit">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <form method="POST" action="" id="form_add_aff_modele_note_debit">
        <input type="hidden" name="operation" value="add_aff_modele_note_debit">
        <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
        <div class="modal-header ">
          <h4 class="modal-title"><i class="fa fa-plus"></i> Add</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <label>Expense</label>
            <select class="form-control form-control-sm" name="id_dep" required>
              <option></option>
              <?php
                $maClasse-> selectionnerDepense();
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Transit</label>
            <select class="form-control form-control-sm" name="id_mod_lic" required>
              <option></option>
              <option value="2">Import</option>
              <option value="1">Export</option>
            </select>
          </div>
          <div class="form-group">
            <label>Template</label>
            <select class="form-control form-control-sm" name="id_model_nd" required>
              <option></option>
              <?php
                $maClasse-> selectionnerModeleNoteDebit();
              ?>
            </select>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
          <button type="submit" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Submit</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


<script type="text/javascript">

  $(document).ready(function(){

    $('#form_add_aff_modele_note_debit').submit(function(e){

      e.preventDefault();

      if(confirm('Do really you want to submit ?')){


        var fd = new FormData(this);

        $('#spinner-div').show();
        $('#modal_add_aff_modele_note_debit').modal('hide');

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
              $( '#form_add_aff_modele_note_debit' ).each(function(){
                  this.reset();
              });
              $('#client_note_debit').DataTable().ajax.reload();
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

function delete_aff_modele_note_debit(id_model_nd, id_cli, id_mod_lic, id_dep){
  if(confirm('Do really you want to delete ?')){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_model_nd: id_model_nd, id_cli: id_cli, id_mod_lic: id_mod_lic, id_dep: id_dep, operation: 'delete_aff_modele_note_debit'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#client_note_debit').DataTable().ajax.reload();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }

}

  var today   = new Date();
$('#spinner-div').show();
  $('#client_note_debit').DataTable({
     lengthMenu: [
        [10, 100, 500, -1],
        [10, 100, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
         {
            text: '<i class="fa fa-plus"></i> Add',
            className: 'btn btn-info',
            action: function ( e, dt, node, config ) {
                $('#modal_add_aff_modele_note_debit').modal('show');
            }
        },
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
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "operation": "client_note_debit2"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"nom_dep"},
      {"data":"nom_mod_lic"},
      {"data":"nom_model_nd"},
      {"data":"btn_action"}
    ] 
  });
  $('#spinner-div').hide();
</script>
