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
          <h5>
            <!-- <img src="../images/calculator.png" width="25px" /> -->
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo $maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']).' DEBIT NOTE DASHBOARD ';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'TABLEAU DE BORD FACTURE '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']);
              }
            ?>
            <span class="float-right">
              <!-- <button class="btn btn-xs btn-info" ></button> -->
              <button class="btn btn-xs btn-info" onclick="$('#modal_depense').modal('show');">
                <i class="fa fa-upload"></i> Upload Expenses
              </button>
              <!-- <div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-upload"></i> Uplaod Expenses
                </button>
                <div class="dropdown-menu">
                  <?php
                   $maClasse-> getListeUploadDepense();
                  ?>
                </div>
              </div> -->
            </span>
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
        
          <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Expenses Monitoring
                </h5>
              </div>
              <div class="card-body">

                <table id="monitoring_depenses" cellspacing="0" width="100%" class=" table hover display compact table-bordered table-striped text-nowrap">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Items</th>
                    <th>Pending Invoicing</th>
                    <th>Invoiced</th>
                    <th>Debit Note</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

              </div>
            </div>
          </div>

        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<div class="modal fade" id="modal_depense">
  <div class="modal-dialog modal-md">
    <div class="modal-content">
      <div class="modal-header btn-dark">
        <h4 class="modal-title"><i class="fa fa-list"></i> Expenses List </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <!-- <input type="hidden" id="id_mod_lic_search">

          <input type="text" id="mot_cle" class="form-control form-control-sm" placeholder="Ex.: Mining DRC LTD" onkeyup="table_menuLicence_synthese($('#id_mod_lic_search').val(), $('#id_type_lic_search').val(), $('#page_search').val(), this.value);"> -->
          <hr>
          <div class="col-md-12 table-responsive p-0 " style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed ">
              <thead>
                  <tr>
                  <tr>
                      <th>#</th>
                      <th>Expense</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                  echo $maClasse-> getListeUploadDepense();
                ?>
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

<div class="modal fade" id="modal_upload_depense">
  <div class="modal-dialog modal-sm">
    <form id="form_upload_depense" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="upload_depense">
      <input type="hidden" name="id_dep" id="id_dep">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-upload"></i> Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1"><span id="nom_dep"></span> Expenses File</label>
          <input name="fichier" type="file" class="form-control form-control-sm cc-exp" required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

    $('#monitoring_depenses').DataTable({
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
            "id_mod_lic": "<?php echo $_GET['id_mod_lic_fact'];?>",
            "operation": "monitoring_depenses"
        }
      },
     "createdRow": function( row, data, dataIndex ) {
      
       if ( data['pending'] >= 1) {        
         // $(row).addClass('text-danger');
         $('td:eq(2)', row).addClass('text-sm font-weight-bold bg bg-warning');

       }

       // if ( data['invoiced'] >= 1) {        
       //   // $(row).addClass('text-danger');
       //   $('td:eq(3)', row).addClass('text-sm font-weight-bold bg bg-info');

       // }

    },

      "columns":[
        {"data":"compteur"},
        {"data":"nom_dep"},
        {"data":"pending",
          render: DataTable.render.number( null, null, 0, null ),
          className: 'dt-body-center'
        },
        {"data":"invoiced",
          render: DataTable.render.number( null, null, 0, null ),
          className: 'dt-body-center'
        },
        {"data":"debite_note",
          render: DataTable.render.number( null, null, 0, null ),
          className: 'dt-body-center'
        }
      ] 
    });

let table = new DataTable('#monitoring_depenses');
 
table.on('click', 'tbody tr', function () {
    let data = table.row(this).data();
 
    // alert('You clicked on ' + data[0] + "'s row");

    window.open('popUpNotificationMonitoringDepense.php?id_mod_lic=<?php echo $_GET['id_mod_lic_fact'];?>&id_dep='+data['id_dep']+'&notification=Monitoring Depense','Monitoring Depense','width=1500,height=900');
});

  $(document).ready(function(){

    $('#form_upload_depense').submit(function(e){

            e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

          $('#modal_upload_depense').modal('hide');
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
              }else{
                $( '#form_upload_depense' ).each(function(){
                    this.reset();
                });
              }
            },
            complete: function () {
                // afficherMonitoringNoteDebit(<?php echo $_GET['id_mod_lic_fact'];?>);
                $('#monitoring_depenses').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  function modal_upload_depense(id_dep, nom_dep){

    $('#id_dep').val(id_dep);
    $('#nom_dep').html(nom_dep);
    $('#modal_upload_depense').modal('show');

  }


</script>
