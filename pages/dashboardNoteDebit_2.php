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
            <i class="nav-icon fas fa-list"></i>
            Report
            <span class="float-right">
              <!-- <button class="btn btn-xs btn-info" ></button> -->
              <button class="btn btn-xs btn-info" onclick="$('#modal_depense').modal('show');">
                <i class="fa fa-upload"></i> Upload Expenses
              </button>
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
        
          <div class="col-12">
            <div class="card table-responsive p-0">
              <div class="card-header">
                <h5><i class="fa fa-folder-open nav-icon"></i> Files to be invoiced 
                </h5>
                <div class="card-tools">
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body">
                <table id="pay_report_file_pending_invoice" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>MCA File Ref.</th>
                      <th>Request No.</th>
                      <th>Request Date</th>
                      <th>Expense</th>
                      <th>Expense Date</th>
                      <th>Assigned To</th>
                      <th>Currency</th>
                      <th>Amount</th>
                      <th>Statut</th>
                      <th>Decl.Ref.</th>
                      <th>Decl.Date</th>
                      <th>Liq.Ref.</th>
                      <th>Liq.Date</th>
                      <th>Liq.Amount CDF</th>
                      <th>Rate</th>
                      <th>Liq.Amount USD</th>
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
$('#pay_report_file_pending_invoice').DataTable({
         lengthMenu: [
            [15, 30, 50, 100, 500, -1],
            [15, 30, 50, 100, 500, 'All'],
        ],
        dom: 'Bfrtip',
        buttons: [
            'excel',
            'pageLength', 'colvis'
        ],
        // fixedColumns: {
        //   left: 3
        // },
        paging: false,
        scrollCollapse: true,
        scrollX: true,
        // scrollY: 300,

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
          },          "data": {
              "id_cli": "",
              "operation": "pay_report_file_pending_invoice",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>"
          }
        },
        "columns":[
      {"data":"compteur"},
      {"data":"ref_dos",
        className: 'dt-body-center'
      },
      {"data":"id_df",
        className: 'dt-body-center'
      },
      // {"data":"code_cli"},
      {"data":"date_df",
        className: 'dt-body-center'
      },
      {"data":"nom_dep",
        className: 'dt-body-center'
      },
      {"data":"date_dep",
        className: 'dt-body-center'
      },
      {"data":"assigned_to",
        className: 'dt-body-center'
      },
      {"data":"monnaie",
        className: 'dt-body-center'
      },
      {"data":"montant",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"statut",
        className: 'dt-body-center'
      },
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
      {"data":"montant_liq",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"roe_decl",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"montant_liq_usd",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] ,
      "createdRow": function( row, data, dataIndex ) {
        if ( data['statut'] == "Rejected") {
          $(row).addClass('text text-danger');
        }
        else if ( data['statut'] == "Paid") {
          $(row).addClass('text text-primary');
        }
      } 
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
