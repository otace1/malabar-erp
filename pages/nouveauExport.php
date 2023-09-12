<?php
if(isset($_GET['id_mod_trac']) && $_GET['id_mod_trac'] == 1){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_trac']);
  if ($_GET['id_cli'] == '874') {
    ?>

<div class="modal fade nouveauDossierExport" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Export File(s).</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli" onchange="xajax_selectionnerLicencePourClientModele(this.value, <?php echo $_GET['id_mod_trac'];?>),xajax_afficherRefDos(this.value, <?php echo $_GET['id_mod_trans'];?>, <?php echo $_GET['id_march'];?>), xajax_afficherFobMaxLicence(num_lic.value),xajax_selectionnerAVPourLicence(num_lic.value),xajax_afficherMaskAV(av.value)" class="form-control cc-exp" required>
                <option value="<?php echo $_GET['id_cli'];?>"><?php echo $maClasse-> getNomClient($_GET['id_cli']);?></option>
                <?php
                    //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-12"><hr></div>
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">
                        #
                      </th>
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">
                        MCA File REF
                      </th>
                      <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licence Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="border: 1px solid white;">Loading Date</th>
                      <th style="border: 1px solid white;">Site Of Loading</th>
                      <th style="border: 1px solid white;">Destination</th>
                      <th style="border: 1px solid white;">Horse</th>
                      <th style="border: 1px solid white;">Trailer 1</th>
                      <th style="border: 1px solid white;">Trailer 2</th>
                      <th style="border: 1px solid white;">Nbre Bags</th>
                      <th style="border: 1px solid white;">Weight</th>
                      <th style="border: 1px solid white;">Lot Num</th>
                      <th style="border: 1px solid white;">Shipment Num.</th>
                      <th style="border: 1px solid white;">Barge</th>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      // $maClasse-> afficherCelluleTableauNewExportAMC($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
                    ?>
                    </form>
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

<?php
  }else{
?>

<div class="modal fade" id="modal_nouveauDossierLicence">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-list"></i> Licences</h4>
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
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Files.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau-de-donnees  table table-hover text-nowrap table-sm">
                  <thead class="bg bg-dark">
                    <tr class="">
                      <th class="col_1" style="">
                        #
                      </th>
                      <th class="col_6" style="">
                        MCA File REF
                      </th>
                      <th style="">Licence Number</th>
                      <th style="">Loading Date</th>
                      <th style="">Site Of Loading</th>
                      <th style="">Destination</th>
                      <?php
                      if($_GET['id_mod_trans'] == '4'){
                        ?>
                      <th style="">WAGON</th>
                        <?php
                      }else{
                        ?>
                      <th style="">Horse</th>
                      <th style="">Trailer 1</th>
                      <th style="">Trailer 2</th>
                        <?php
                      }
                      ?>
                      <th style="">Nbre Bags</th>
                      <th style="">Weight</th>
                      <th style="">Lot Num</th>
                      <th style="">Seal DGDA</th>
                      <?php
                      if($_GET['id_mod_trans'] != '4'){
                        ?>
                      <th style="">Transporter</th>
                        <?php
                      }
                      ?>
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

<div class="modal fade nouveauDossierExport" id="modal-default">
  <div class="modal-dialog modal-xl">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Export File(s).</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-3">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" id="id_cli" onchange="xajax_selectionnerLicencePourClientModele(this.value, <?php echo $_GET['id_mod_trac'];?>),xajax_afficherRefDos(this.value, <?php echo $_GET['id_mod_trans'];?>, <?php echo $_GET['id_march'];?>), xajax_afficherFobMaxLicence(num_lic.value),xajax_selectionnerAVPourLicence(num_lic.value),xajax_afficherMaskAV(av.value)" class="form-control cc-exp" required>
                <option value="<?php echo $_GET['id_cli'];?>"><?php echo $maClasse-> getNomClient($_GET['id_cli']);?></option>
                <?php
                    //$maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                  
                ?>
            </select>
          </div>

          <div class="col-md-12"><hr></div>
          <div class="col-md-12">
            
            <div class="card-body table-responsive p-0">
                <table id="user_data_2" cellspacing="0" width="100%" class="tableau1  table table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_1">
                        #
                      </th>
                      <th style="border: 1px solid white; background-color: #222530; color: white;" class="col_6">
                        MCA File REF
                      </th>
                      <th style="border: 1px solid white;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Licence Number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                      <th style="border: 1px solid white;">Loading Date</th>
                      <th style="border: 1px solid white;">Site Of Loading</th>
                      <th style="border: 1px solid white;">Destination</th>
                      <?php
                      if($_GET['id_mod_trans'] == '4'){
                        ?>
                      <th style="border: 1px solid white;">WAGON</th>
                        <?php
                      }else{
                        ?>
                      <th style="border: 1px solid white;">Horse</th>
                      <th style="border: 1px solid white;">Trailer 1</th>
                      <th style="border: 1px solid white;">Trailer 2</th>
                        <?php
                      }
                      ?>
                      <th style="border: 1px solid white;">Nbre Bags</th>
                      <th style="border: 1px solid white;">Weight</th>
                      <th style="border: 1px solid white;">Lot Num</th>
                      <th style="border: 1px solid white;">Seal DGDA</th>
                      <?php
                      if($_GET['id_mod_trans'] != '4'){
                        ?>
                      <th style="border: 1px solid white;">Transporter</th>
                        <?php
                      }
                      ?>
                    </tr>
                  </thead>
                  <tbody>
                    <form method="POST" action="">
                    <?php
                      // $maClasse-> afficherCelluleTableauNewExport($_GET['id_mod_trac'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['id_march'], $_GET['num_lic']);
                    ?>
                    </form>
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

<?php
  }
}
?>

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
          $('#modal_nouveauDossierAcid').modal('show');
      }
    });


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