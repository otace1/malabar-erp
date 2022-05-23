<?php
  include("tete.php");
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
        <h5>
          <?php echo $maClasse-> getClient($_GET['id_cli'])['nom_cli'];?> | 
          <?php echo $maClasse-> getModeTransport($_GET['id_mod_trans'])['nom_mod_trans'];?> | 
          <?php echo $maClasse-> getElementModeleLicence($_GET['id_mod_lic'])['nom_mod_lic'];?>
        </h5>
        
              <div class="card-tools" style="text-align: left;">
                <div class="input-group input-group-sm">
                  <?php
                      if ($_GET['id_cli'] == 869 && $_GET['id_mod_trac'] == 2) {
                        ?>
                    <button class="btn btn-xs btn-success square-btn-adjust" onclick="window.location.replace('exportExcelMMGImport.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>
                        <?php
                      }else{
                        ?>
                    <!-- <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('../pages/exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button> -->
                    <button type="button" class="btn btn-xs btn-success dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fas fa-file-excel"></i> Export
                      <div class="dropdown-menu" role="menu">
                        <a class="dropdown-item"onclick="window.location.replace('../pages/exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>','pop1','width=80,height=80');">
                          Export All Files
                        </a>
                        <a class="dropdown-item" href="#"><hr></a>
                        <a class="dropdown-item"onclick="window.location.replace('../pages/exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>&annee=2022','pop1','width=80,height=80');">
                          Export 2022 Files
                        </a>
                        <a class="dropdown-item" href="#"><hr></a>
                        <a class="dropdown-item"onclick="window.location.replace('../pages/exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>&annee=2021','pop1','width=80,height=80');">
                          Export 2021 Files
                        </a>
                        <a class="dropdown-item" href="#"><hr></a>
                        <a class="dropdown-item"onclick="window.location.replace('../pages/exportExcel2.php?id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&id_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&commodity=&statut=&id_march=<?php echo $_GET['id_march'];?>&annee=2020','pop1','width=80,height=80');">
                          Export 2020 Files
                        </a>
                        <a class="dropdown-item" href="#"><hr></a>
                      </div>
                    </button>
                        <?php
                      }
                    ?>
                  </div>
                </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="text-align: ;">
        <div class="card">
          <div class="card-body">
            
            <div class="table-responsive">

              <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap table-hover">
                <thead>
                <?php
                if ($_GET['id_mod_lic']=='2') {
                ?>
                <tr>
                  <th>MCA File REF</th>
                  <th>PRE-ALERTE DATE</th>
                  <th>INVOICE</th>
                  <th>HORSE</th>
                  <th>TRAILER 1</th>
                  <th>TRAILER 2</th>
                  <th>COMMODITY</th>
                  <th>SUPPLIER</th>
                  <th>PO Ref</th>
                  <th>WEIGHT</th>
                  <th>STATUS</th>
                </tr>
                <?php
                }else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']=='1') {
                ?>
                <tr>
                  <th>MCA File REF</th>
                  <th>LOT NUM.</th>
                  <th>LICENCE NUM.</th>
                  <th>HORSE</th>
                  <th>TRAILER 1</th>
                  <th>TRAILER 2</th>
                  <th>COMMODITY</th>
                  <th>LOADING DATE</th>
                  <th>TRANSPORTER</th>
                  <th>WEIGHT</th>
                  <th>STATUS</th>
                </tr>
                <?php
                }else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']=='4') {
                ?>
                <tr>
                  <th>MCA File REF</th>
                  <th>LOT NUM.</th>
                  <th>LICENCE NUM.</th>
                  <th>WAGON</th>
                  <th>COMMODITY</th>
                  <th>LOADING DATE</th>
                  <th>TRANSPORTER</th>
                  <th>WEIGHT</th>
                  <th>STATUS</th>
                </tr>
                <?php
                }
                ?>
                </thead>
              </table>
            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

<?php
  if ($_GET['id_mod_lic']=='2') {
  ?>
    <script type="text/javascript">
      $('#file_data').DataTable({

        createdRow: function (row, data, index) {
            if (data['statut'] == 'CLEARING COMPLETED') {
                $('td', row).eq(0).addClass('highlight');
                $('td', row).eq(10).addClass('highlight');
            }
        },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"data.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_trans": "<?php echo $_GET['id_mod_trans']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>"
          }
        },
        "columns":[
          {"data":"ref_dos"},
          {"data":"date_preal"},
          {"data":"ref_fact"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"commodity"},
          {"data":"supplier"},
          {"data":"po_ref"},
          {"data":"poids"},
          {"data":"statut"}
        ]  
      });
    </script>
    <?php
    }else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']=='1') {
  ?>
    <script type="text/javascript">
      $('#file_data').DataTable({

        createdRow: function (row, data, index) {
            if (data['statut'] == 'CLEARING COMPLETED') {
                $('td', row).eq(0).addClass('highlight');
                $('td', row).eq(10).addClass('highlight');
            }
        },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"data.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_trans": "<?php echo $_GET['id_mod_trans']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>"
          }
        },
        "columns":[
          {"data":"ref_dos"},
          {"data":"num_lot"},
          {"data":"num_lic"},
          {"data":"horse"},
          {"data":"trailer_1"},
          {"data":"trailer_2"},
          {"data":"commodity"},
          {"data":"load_date"},
          {"data":"transporter"},
          {"data":"poids"},
          {"data":"statut"}
        ]  
      });
    </script>
    <?php
    }else if ($_GET['id_mod_lic']=='1' && $_GET['id_mod_trans']=='4') {
  ?>
    <script type="text/javascript">
      $('#file_data').DataTable({

        createdRow: function (row, data, index) {
            if (data['statut'] == 'CLEARING COMPLETED') {
                $('td', row).eq(0).addClass('highlight');
                $('td', row).eq(8).addClass('highlight');
            }
        },
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"data.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_trans": "<?php echo $_GET['id_mod_trans']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>"
          }
        },
        "columns":[
          {"data":"ref_dos"},
          {"data":"num_lot"},
          {"data":"num_lic"},
          {"data":"horse"},
          {"data":"commodity"},
          {"data":"load_date"},
          {"data":"transporter"},
          {"data":"poids"},
          {"data":"statut"}
        ]  
      });
    </script>
    <?php
    }
    ?>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>