<?php
  include("tetePopCDN.php");
  //include("licenceExcel.php");
?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper.Contains page content -->
  <div class="">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-folder-open nav-icon"></i> <?php echo $_GET['statut'];?></h5>
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
    <?php

    if( isset($_POST['validerFacture']) ){
     $maClasse-> MAJ_validation_facture_dossier($_POST['ref_fact'], '1');
    }

    if( isset($_POST['transmissionFacture']) ){
     $maClasse-> MAJ_transmission_facture_dossier($_POST['ref_fact'], '1', $_SESSION['id_util']);
    }

    ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title" style="font-weight: bold;">
                  <!--MASTER DATA&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;FACTURE:&nbsp;&nbsp;<input style="background-color: black; color: white; font-size: 16px;" disabled type="text" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
                    <button class="btn-xs btn-success square-btn-adjust" onclick="window.location.replace('exportFacturationDossier.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']; ?>&type=EN ATTENTE FACTURES','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>-->
                </h5>


                <div class="card-tools">
                  <!-- <button class="btn-success square-btn-adjust btn-xs" onclick="window.location.replace('exportExcelKccImport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&id_mod_trac=<?php echo $_GET['id_mod_lic_fact']; ?>&commodity=<?php echo $_GET['commodity'];?>&statut=<?php echo $_GET['statut'];?>&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                    <i class="fas fa-file-excel"></i> Exporter Daily en Excel
                  </button> -->
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-dark table-sm text-nowrap">
                  <thead>
                    <tr>

                      <?php
                      if($_GET['statut']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF.FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Horse</th>
                      <th style="border: 1px solid black;">Trailer 1</th>
                      <th style="border: 1px solid black;">Trailer 2</th>
                      <th style="border: 1px solid black;">Preal.Date</th>
                      <th style="border: 1px solid black;">Klsa Arrival</th>
                      <th style="border: 1px solid black;">Dispatch From Klsa</th>
                      <th style="border: 1px solid black;">Delay</th>
                      <?php
                      }else if($_GET['statut']=='K\'LSA DATES ERROR'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF.FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Horse</th>
                      <th style="border: 1px solid black;">Trailer 1</th>
                      <th style="border: 1px solid black;">Trailer 2</th>
                      <th style="border: 1px solid black;">Preal.Date</th>
                      <th style="border: 1px solid black;">Klsa Arrival</th>
                      <th style="border: 1px solid black;">Dispatch From Klsa</th>
                      <th style="border: 1px solid black;">Delay</th>
                      <?php
                      }else if($_GET['statut']=='FILES WITHOUT LIQUIDATION BEYOND 2 DAYS'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF.FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Preal.Date</th>
                      <th style="border: 1px solid black;">Preal.Delay</th>
                      <th style="border: 1px solid black;">Decl.Ref.</th>
                      <th style="border: 1px solid black;">Decl.Date</th>
                      <th style="border: 1px solid black;">Decl.Delay</th>
                      <th style="border: 1px solid black;">Liq.Ref.</th>
                      <th style="border: 1px solid black;">Liq.Date</th>
                      <?php
                      }else if($_GET['statut']=='FILES WITHOUT QUITTANCE BEYOND 2 DAYS'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF.FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Preal.Date</th>
                      <th style="border: 1px solid black;">Preal.Delay</th>
                      <th style="border: 1px solid black;">Decl.Ref.</th>
                      <th style="border: 1px solid black;">Decl.Date</th>
                      <th style="border: 1px solid black;">Liq.Ref.</th>
                      <th style="border: 1px solid black;">Liq.Date</th>
                      <th style="border: 1px solid black;">Liq.Delay</th>
                      <th style="border: 1px solid black;">Quit.Ref.</th>
                      <th style="border: 1px solid black;">Quit.Date</th>
                      <?php
                      }else if($_GET['statut']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF. FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Horse</th>
                      <th style="border: 1px solid black;">Trailer 1</th>
                      <th style="border: 1px solid black;">Trailer 2</th>
                      <th style="border: 1px solid black;">Prealerte Date</th>
                      <th style="border: 1px solid black;">Klsa Arrival</th>
                      <th style="border: 1px solid black;">Wiski Arrival</th>
                      <th style="border: 1px solid black;">Wiski Departure</th>
                      <th style="border: 1px solid black;">Delay</th>
                      <th style="border: 1px solid black;">Dispatch From Klsa</th>
                      <?php
                      }else if($_GET['statut']=='FILES UNDER PREPARATION OVER 15 DAYS'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF. FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Horse</th>
                      <th style="border: 1px solid black;">Trailer 1</th>
                      <th style="border: 1px solid black;">Trailer 2</th>
                      <th style="border: 1px solid black;">Prealerte Date</th>
                      <th style="border: 1px solid black;">Klsa Arrival</th>
                      <th style="border: 1px solid black;">Wiski Arrival</th>
                      <th style="border: 1px solid black;">Wiski Departure</th>
                      <th style="border: 1px solid black;">Dispatch From Klsa</th>
                      <th style="border: 1px solid black;">Delay</th>
                      <?php
                      }else if($_GET['statut']=='KASUMBALESA TRUCK ARRIVAL'){
                      ?>
                      <th style="border: 1px solid black;">N.</th>
                      <th style="border: 1px solid black;">MCA REF. FILE</th>
                      <th style="border: 1px solid black;">Client</th>
                      <th style="border: 1px solid black;">Horse</th>
                      <th style="border: 1px solid black;">Trailer 1</th>
                      <th style="border: 1px solid black;">Trailer 2</th>
                      <th style="border: 1px solid black;">Prealerte Date</th>
                      <th style="border: 1px solid black;">Klsa Arrival</th>
                      <?php
                      }
                      ?>
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
  <?php 

  include("pied.php");
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  // ------------------------------------------------------------------------------------------------------
  ?>

    <script type="text/javascript">
      var today   = new Date();
      document.title = "Files_<?php echo $_GET['statut'];?>_" + today.getDay() + "_" + today.getMonth() + "_" + today.getYear() + "_" + today.getHours() + "_" + today.getMinutes() + "_" + today.getSeconds();
      $('#file_data').DataTable({
         lengthMenu: [
            [10, 100, 500, -1],
            [10, 100, 500, 'All'],
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
              "statut": "<?php echo $_GET['statut']?>"
          },
          "data": {
              "statut": "<?php echo $_GET['statut']?>",
              "operation": "rapportEmail"
          }
        },
        <?php
          if($_GET['statut']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"date_preal"},
          {"data":"klsa_arriv"},
          {"data":"dispatch_klsa"},
          {"data":"duree"}
        ] 
          <?php
        }else if($_GET['statut']=='K\'LSA DATES ERROR'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"date_preal"},
          {"data":"klsa_arriv"},
          {"data":"dispatch_klsa"},
          {"data":"duree"}
        ] 
          <?php
        }else if($_GET['statut']=='FILES WITHOUT LIQUIDATION BEYOND 2 DAYS'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"date_preal"},
          {"data":"duree_preal"},
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"duree"},
          {"data":"ref_liq"},
          {"data":"date_liq"}
        ] 
          <?php
        }else if($_GET['statut']=='FILES WITHOUT QUITTANCE BEYOND 2 DAYS'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"date_preal"},
          {"data":"duree_preal"},
          {"data":"ref_decl"},
          {"data":"date_decl"},
          {"data":"ref_liq"},
          {"data":"date_liq"},
          {"data":"duree_liq"},
          {"data":"ref_quit"},
          {"data":"date_quit"}
        ] 
          <?php
        }else if($_GET['statut']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"date_preal"},
          {"data":"klsa_arriv"},
          {"data":"wiski_arriv"},
          {"data":"wiski_dep"},
          {"data":"duree"},
          {"data":"dispatch_klsa"}
        ] 
          <?php
        }else if($_GET['statut']=='FILES UNDER PREPARATION OVER 15 DAYS'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"date_preal"},
          {"data":"klsa_arriv"},
          {"data":"wiski_arriv"},
          {"data":"wiski_dep"},
          {"data":"duree"},
          {"data":"dispatch_klsa"}
        ] 
          <?php
        }else if($_GET['statut']=='KASUMBALESA TRUCK ARRIVAL'){

          ?>
        "columns":[
          {"data":"compteur"},
          {"data":"ref_dos"},
          {"data":"nom_cli"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"date_preal"},
          {"data":"klsa_arriv"}
        ] 
          <?php
        }
        ?>
      });
    </script>
