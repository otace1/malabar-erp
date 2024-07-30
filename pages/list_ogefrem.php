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

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="dossier_ogefrem" class="table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="" width="5px">#</th>
                      <th style="">Ref.Dossier</th>
                      <th>Client</th>
                      <th>Product</th>
                      <th>Mode of Transport</th>
                      <th>Truck/Wagon</th>
                      <th>Loading Date</th>
                      <th>OGEFREM Inv.Ref.</th>
                      <th>LMC Id.</th>
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

<div class="modal fade" id="modal_edit_ogefrem">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" id="form_edit_ogefrem">
      <input type="hidden" name="id_dos" id="id_dos_edit">
      <input type="hidden" name="operation" value="update_OGEFREM">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-edit"></i> <span id="label_ref_dos"></span> </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="truck_edit" class="control-label">Truck/Wagon</label>
          <input type="text" id="truck_edit" class="form-control form-control-sm cc-exp" disabled>
        </div>
        <div class="form-group">
          <label for="ogefrem_ref_fact_edit" class="control-label">OGEFREM Inv.Ref.</label>
          <input type="text" name="ogefrem_ref_fact" id="ogefrem_ref_fact_edit" class="form-control form-control-sm cc-exp">
        </div>
        <div class="form-group">
          <label for="lmc_id_edit" class="control-label">LMC Id.</label>
          <input type="text" name="lmc_id" id="lmc_id_edit" class="form-control form-control-sm cc-exp">
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

  function modal_edit_ogefrem(id_dos){

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
          //truck
          $('#truck_edit').val(data.truck);
          //ogefrem_ref_fact
          $('#ogefrem_ref_fact_edit').val(data.ogefrem_ref_fact);
          //lmc_id
          $('#lmc_id_edit').val(data.lmc_id);
          $('#modal_edit_ogefrem').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  $(document).ready(function(){

      $('#form_edit_ogefrem').submit(function(e){

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
                $( '#form_edit_ogefrem' ).each(function(){
                    this.reset();
                });
                $('#modal_edit_ogefrem').modal('hide');
              }
            },
            complete: function () {
                $('#dossier_ogefrem').DataTable().ajax.reload();
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

  $('#dossier_ogefrem').DataTable({
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
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "operation": "dossier_ogefrem"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"code_cli"},
      {"data":"nom_march",
        className: 'dt-body-center'
      },
      {"data":"nom_mod_trans",
        className: 'dt-body-center'
      },
      {"data":"truck",
        className: 'dt-body-center'
      },
      {"data":"load_date",
        className: 'dt-body-center'
      },
      {"data":"ogefrem_ref_fact",
        className: 'dt-body-center'
      },
      {"data":"lmc_id",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

</script>
