
<?php
if($_GET['id_cli'] == 869 && $_GET['id_mod_trac'] == 2){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
?>

<div class="modal fade" id="modal_nouveauDossierLicence">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Licences</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body table-responsive p-0 ">
        <table id="nouveauDossierLicence" class="tableau1 table table-bordered table-hover text-nowrap table-sm small">
          <thead>
            <tr class="">
              <th style="">#</th>
              <th style="">Licence Num.</th>
              <th style="">Commodity</th>
              <th style="">Extrem Val.</th>
              <th style="">Lic. FOB</th>
              <th style="">Files FOB</th>
              <th style="">Solde FOB</th>
              <th style="">Lic. Weight</th>
              <th style="">Files Weight</th>
              <th style="">Solde Weight</th>
              <th style=""></th>
            </tr>
          </thead>
          <tbody>
           
          </tbody>
        </table>
      </div>
      <div class="modal-footer justify-content-between">
        <!-- <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerDossier" class="btn btn-primary">Valider</button> -->
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_nouveauDossierAcid">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
            <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Import Acid File(s).</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="table table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="">
                      <th style="">
                        #
                      </th>
                      <th style="">
                        MCA File REF
                      </th>
                      <th style="">Licence Number</th>
                      <th style="">T1 Ref.</th>
                      <th style="">Weight</th>
                      <th style="">FOB</th>
                      <th style="">Invoice</th>
                      <th style="">Horse</th>
                      <th style="">Trailer 1</th>
                      <th style="">Trailer 2</th>
                      <th style="">Arrival Date K'lesa</th>
                      <th style="">Crossing Date</th>
                      <th style="">Arrival Date Wiski</th>
                      <th style="">Departure Wiski</th>
                      <th style="">CRF Reference</th>
                      <th style="">CRF Received Date</th>
                  </thead>
                  <tbody id="tableau_creation_dossiers_lot">
                    <?php
                      // $maClasse-> afficherCelluleTableauNewImportAcid($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
                    ?>
                  </tbody>
                </table>
              </div>

            </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerDossier" class="btn btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script language="javascript">
  
  function modal_nouveauDossierLicence() {
    $('#modal_nouveauDossierLicence').modal('show');
    $('#nouveauDossierLicence').DataTable().ajax.reload();
  }

  function modal_nouveauDossierAcid(num_lic, id_cli, id_mod_lic) {
    $('#modal_nouveauDossierLicence').modal('hide');
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_cli: id_cli, id_mod_lic: id_mod_lic, num_lic: num_lic, id_mod_trans: <?php echo $_GET['id_mod_trans'];?>, id_march: <?php echo $_GET['id_march'];?>, nbre: 10, operation: 'tableau_creation_dossiers_lot'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#tableau_creation_dossiers_lot').html(data.tableau_creation_dossiers_lot);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

    $('#modal_nouveauDossierAcid').modal('show');

    // for (var i = 1; i <= 10; i++) {
    //   $('#num_lic_'+i).val(num_lic);
    // }
  }

  $('#nouveauDossierLicence').DataTable({
     lengthMenu: [
        [10, 20, 50, 100, -1],
        [10, 20, 50, 100, 'All'],
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
          "id_mod_lic": "<?php echo $_GET['id_mod_trac'];?>",
          "operation": "nouveauDossierLicence"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"num_lic"},
      {"data":"commodity"},
      {"data":"date_exp",
        className: 'dt-body-center'
      },
      {"data":"fob_lic",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"sum_fob",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"solde_fob",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"poids_lic",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"sum_poids",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"solde_poids",
        className: 'dt-body-right',
        className: 'dt-body-right'
      },
      {"data":"btn_action",
        className: 'dt-body-right',
        className: 'dt-body-right'
      }
    ] 
  });

</script>
<?php
}
?>
