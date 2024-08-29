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
                <h5 class="card-title" style="font-weight: bold;">
                 <i class="fa fa-calculator nav-icon"></i>
                  <?php
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Directory | '.$maClasse-> getNomClient($_GET['id_cli']);
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Repertoire | '.$maClasse-> getNomClient($_GET['id_cli']);
                    }
                  ?>
                </h5>
                  <div class="float-right">
                    <button class="btn btn-xs btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                        <i class="fa fa-list"></i> Statut Licence
                        <div class="dropdown-menu" role="menu">
                          <a class="dropdown-item" href="#" onclick="window.open('popUpStatutLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=1','popUpStatutLicence','width=1500,height=950');">
                            <?php echo $maClasse-> getNomClient($_GET['id_cli']);?>
                          </a>
                          <a class="dropdown-item" href="#" onclick="window.open('popUpStatutLicence.php?id_cli=&id_mod_lic=1','popUpStatutLicence2','width=1500,height=950');">
                            Autres
                          </a>
                        </div>
                    </button>
                  </div>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="dossier_cvee" cellspacing="0" width="100%" class="small table hover display compact table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Ref.Dossier</th>
                      <!-- <th>Client</th> -->
                      <th>Lot Num.</th>
                      <th>Licence Num.</th>
                      <th>Product</th>
                      <th>Weight</th>
                      <th>Ref.CVEE</th>
                      <th>FOB CVEE</th>
                      <th>Mode of Transport</th>
                      <th>Truck/Wagon</th>
                      <th>Action</th>
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
  ?>

<div class="modal fade" id="modal_edit_cvee">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" id="form_edit_cvee">
      <input type="hidden" name="id_dos" id="id_dos_edit">
      <input type="hidden" name="operation" value="update_CVEE">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-edit"></i> <span id="label_ref_dos"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="num_lot_edit" class="control-label">Lot Num</label>
          <input type="text" id="num_lot_edit" class="form-control form-control-sm cc-exp" disabled>
        </div>
        <div class="form-group">
          <label for="ref_cvee_edit" class="control-label">Ref.CVEE</label>
          <input type="text" name="ref_cvee" id="ref_cvee_edit" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
          <label for="fob_cvee_edit" class="control-label">Montant CVEE</label>
          <input type="number" step="0.01" name="fob_cvee" id="fob_cvee_edit" class="form-control form-control-sm text-center cc-exp">
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

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
  
  $(document).ready(function(){

      $('#form_edit_cvee').submit(function(e){

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
              }else{
                $( '#form_edit_cvee' ).each(function(){
                    this.reset();
                });
                $('#modal_edit_cvee').modal('hide');
              }
            },
            complete: function () {
                $('#dossier_cvee').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
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
