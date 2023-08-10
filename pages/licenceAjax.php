<?php
  include("tetePopCDN.php");
  include("menuHaut.php");
  // include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);
  
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h3><i class="far fa-eye nav-icon"></i> SYNTHESE LICENCES <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')';?></h3>
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
                <h3 class="card-title" style="font-weight: bold;">
                  <?php

                  ?>
                <button class="btn btn-dark btn-xs square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                    <i class="fa fa-filter"></i> Filtrage Client
                </button>
                  <?php
                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='1') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicenceExport">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }else if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') ){
                    ?>
                <button class="btn btn-primary btn-xs square-btn-adjust" data-toggle="modal" data-target=".nouvelleLicence">
                    <i class="fa fa-plus"></i> Nouvelle Licence
                </button>
                  <?php
                  }

                  if((isset($_GET['id_cli']) && ($_GET['id_cli'] != '')) && ($_GET['id_mod_lic']=='2') && ($maClasse-> getNbrePartielleSansFob($_GET['id_cli'])>0)){
                    ?>
                <button class="clignoteb btn btn-xs bg-dark square-btn-adjust" onclick="window.open('popUpPartielleSansFOB.php?id_cli=<?php echo $_GET['id_cli']; ?>','pop1','width=900,height=950');">
                    <i class="fa fa-edit"></i> Partielle Sans FOB <sup><span class="badge badge-danger"><?php echo number_format($maClasse-> getNbrePartielleSansFob($_GET['id_cli']), 0, '', '');?></span></sup>
                </button>
                  <?php
                  }
                  ?>
                <!--<button class="btn btn-success square-btn-adjust" data-toggle="modal" data-target=".appurement">
                    <i class="fa fa-check"></i> Appurement
                </button>
                <button class="btn bg-dark square-btn-adjust" data-toggle="modal" data-target=".uploadeFichierLicence">
                    <i class="fa fa-upload"></i> Uploade Fichier
                </button>-->
                </h3>
                  <div class="card-tools">
                    <div class="pull-right">
                    <?php
                    if ($_GET['id_mod_lic']=='1') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Exporter Rapport
                      <div class="dropdown-menu" role="menu">
                        <?php
                          for ($annee=date('Y'); $annee >= 2020 ; $annee--) { 
                          ?>
                          <a class="dropdown-item"onclick="window.location.replace('exportLicenceExport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=<?php echo $annee;?>','pop1','width=80,height=80');">
                            Export <?php echo $annee;?> Licenses
                          </a>
                          <?php
                          }
                        ?>
                      </div>
                    </button>
                    <?php
                    }
                    else if ($_GET['id_mod_lic']=='2') {
                    ?>
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Exporter Rapport
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                          Export All Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>','pop1','width=80,height=80');">
                          Export Syntheses/License
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicenceClient.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>','pop1','width=80,height=80');">
                          Export Syntheses/CLient
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Synthese
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportLicence2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Licenses
                        </a>
                        <a class="dropdown-item"onclick="window.location.replace('exportSyntheseLicence.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_type_lic=<?php echo $_GET['id_type_lic']; ?>&annee=2019','pop1','width=80,height=80');">
                          Export 2019 Synthese
                        </a>
                      </div>
                    </button>
                    <?php
                    }
                    ?>
                    

                    </div>

                  </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">

                <table id="file_data_afficherLicence" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                  <thead>
                    <?php
                      if ($_GET['id_mod_lic']=='2') {
                       ?>
                       <tr class="">
                          <th>#</th>
                          <th>Numero</th>
                          <th>Statut</th>
                          <th>Client</th>
                          <th>Date Val.</th>
                          <th>Extreme Val.</th>
                          <th>COD</th>
                          <th>Type</th>
                          <th>Fournisseur</th>
                          <th>Marchandise</th>
                          <th>Banque</th>
                          <th>Monnaie</th>
                          <th>FOB Licence</th>
                          <th>Dossier(s)</th>
                          <th>FOB Dossiers</th>
                          <th>Balance Licence</th>
                          <th>Commerc.Inv.</th>
                          <th>Remarque</th>
                          <th>Action</th>
                        </tr>
                       <?php
                      }
                    ?>
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

<div class="modal fade rechercheClient" id="rechercheClient">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage Licence <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select id="nom_cli" onchange="selectLicence(this.value);" class="form-control form-control-sm cc-exp">
              <option></option>
              <!-- <option value="1">1</option>
              <option value="2">2</option> -->
                <?php
                  $maClasse->selectionnerClientModeleLicence2($_GET['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <!-- <button type="submit" name="rechercheClient" class="btn btn-xs btn-primary">Valider</button> -->
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

    function selectLicence(){
      $('#rechercheClient').modal('hide');
      $('#file_data_afficherLicence').DataTable().column( 3 ).search($('#nom_cli').val()).ajax.reload();
    }

    $('#file_data_afficherLicence').DataTable({
       lengthMenu: [
          [10, 20, 50, 100, 500, -1],
          [10, 20, 50, 100, 500, 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [
          'excel',
          'pageLength', "colvis"
      ],
      processing: true,
      language: { "processing": '<img src="../images/GD.gif" width="100px">' },
      fixedColumns: {
          left: 2
          // ,
          // right: 1
      },
      "paging": true,
      "scrollX": true,
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
              "id_cli": "",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
              "operation": "afficherLicenceAjax"
          }
        },
        <?php
          if ($_GET['id_mod_lic']=='2'){
            ?>
        "columns":[
          {"data":"compteur"},
          {"data":"num_lic"},
          {"data":"statut",
      className: 'dt-body-center'},
          {"data":"nom_cli"},
          {"data":"date_val_2"},
          {"data":"date_exp"},
          {"data":"cod"},
          {"data":"type_lic"},
          {"data":"fournisseur"},
          {"data":"commodity"},
          {"data":"nom_banq"},
          {"data":"sig_mon"},
          {"data":"fob",
            render: DataTable.render.number( null, null, 2, null ),
            className: 'dt-body-right'
          },
          {"data":"nbre_dos",
            className: 'dt-body-right'
          },
          {"data":"fob_dos",
      render: DataTable.render.number( null, null, 2, null ),
      className: 'dt-body-right'},
          {"data":"solde_fob",
      render: DataTable.render.number( null, null, 2, null ),
      className: 'dt-body-right'},
          {"data":"ref_fact"},
          {"data":"remarque"},
          {"data":"fichier"}
        ],
        "createdRow": function( row, data, dataIndex ) {
          if ( data.solde_fob < 0) {
            console.log(data.solde_fob);
            $('td:eq(15)', row).addClass("font-weight-bold bg-danger");
          }
        } 
            <?php
          }
        ?>
      });
    
</script>