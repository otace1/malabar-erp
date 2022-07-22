<?php
  include("tete.php");
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
  }else{
    $client = '';
  }

  if( isset($_GET['id_type_lic']) && ($_GET['id_type_lic'] != '')){
    $type_licence = ' | '.$maClasse-> getNomTypeLicence($_GET['id_type_lic']);
  }else{
    $type_licence = '';
  }

  if(!isset($_GET['id_cli'])){
    $_GET['id_cli'] = null;
  }
  if(!isset($_GET['id_type_lic'])){
    $_GET['id_type_lic'] = null;
  }

  if ($_GET['id_mod_lic'] == '1') {
    
    if ($_GET['id_cli'] == '') {
      $_GET['id_cli'] = NULL;
    }

  }else if ($_GET['id_mod_lic'] == '2') {
    
    if ($_GET['id_cli'] == '') {
      $_GET['id_cli'] = NULL;
    }

  }
//UPDATES

  
//FIN UPDATES

  //include('excel/popUpDossier.php');

 ?>

  <div class="wrapper small">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">

              <div class="card-header">
                <h3 class="card-title" style="font-weight: bold;">
                </h3>
              </div>
              <!-- /.card-header -->
                  <div class="card card-<?php echo $couleur;?>">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i>
                          <?php echo  '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($maClasse-> nbreSummaryStatusClient($_GET['statut'], $_GET['id_mod_lic'], $_GET['id_cli'], $_GET['id_mod_trans'], $_GET['commodity']), 0, ',', ' ').'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['statut'].'</span>'.$client.$type_licence;?>
                        <!--<button class="btn btn-default" onclick="exportToExcel('popUpDossier')">
                          <img src="../images/xls.png" width="30px">
                        </button>-->

                   <!--  <button class="btn btn-success btn-xs square-btn-adjust" onclick="window.location.replace('../pages/exportExcelPopUp.php?id_cli=<?php echo $_GET['id_cli']; ?>&ampid_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&ampid_mod_trac=<?php echo $_GET['id_mod_lic']; ?>&ampcommodity=<?php echo $_GET['commodity']; ?>&ampstatut=<?php echo $_GET['statut'];?>&id_march=','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export To Excel
                    </button>
 -->
                      </h3>

                  <!--<div class="card-tools">
                    <button class="btn btn-info square-btn-adjust" data-toggle="modal" data-target=".update">
                        <i class="fa fa-edit"></i> Update Multiple Files
                    </button>
                  </div>-->
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="card-body table-responsive p-0  cadre-tableau-de-donnees" style="">

                              <table id="file_data" cellspacing="0" width="100%" class="table table-bordered table-striped table-sm text-nowrap">
                                <thead>
                                  <?php
                                  include('enTetePopUp.php');
                                  ?>
                                </thead>
                              </table>
                            </div>
                        </div>
                    </div>
                        <!-- input states -->
                    <!-- /.card-body -->
                  </div>
            <!-- /.card -->
            </div>


          </div>
    </section>
    <!-- /.content -->
  </div>
</div>
</section>
</div>
    <script language="javascript">
        document.title = "<?php echo $_GET['statut'];?>";
    </script>
    <script type="text/javascript">
      $('#file_data').DataTable({

        createdRow: function (row, data, index) {
            if (data['statut'] == 'CLEARING COMPLETED') {
                $('td', row).eq(0).addClass('highlight');
                $('td', row).eq(30).addClass('highlight');
            }
        },
        dom: 'Bfrtip',
        // buttons: [
        //     'copy', 'csv', 'excel', 'print'
        // ], 
        buttons: [{
            extend: 'excelHtml5',
            customize: function(xlsx) {
                var sheet = xlsx.xl.worksheets['sheet1.xml'];
                
                <?php
                  if ($_GET['id_mod_lic']=='2' && $_GET['id_mod_trans']=='1') {
                ?>
                    // Loop over the cells in column `AE`
                    $('row c[r^="AE"]', sheet).each( function () {
                        // Get the value
                        if ( $('is t', this).text() == 'CLEARING COMPLETED' ) {
                            $(this).attr( 's', '20' );
                        }
                    });
                <?php
                  }
                ?>

            }
        }],
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
        "ajax":{
          "type": "GET",
          "url":"dataDashboard.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_trans": "<?php echo $_GET['id_mod_trans']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>",
              "statut": "<?php echo $_GET['statut']?>"
          }
        },
        <?php
        include('dataColumns.php');
        ?>  
      });
    </script>


<?php
include('pied.php');
?>

</body>
</script>
</html>
