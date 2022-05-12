<?php
  include("tete.php");

  $couleur = '';
  
  $nombre_dossier = $maClasse-> nbreSearchFileKPB($_GET['debut'], $_GET['fin'], $_GET['id_mod_lic']);
  

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         
                    </table>';


//UPDATES

  
//FIN UPDATES

  //include('excel/popUpDossier.php');

 ?>

  <div class="wrapper">
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
                  <div class="card card-dark">
                    <div class="card-header">
                      <h3 class="card-title">
                        <i class="fa fa-folder-open nav-icon"></i>
                          <?php echo  'Report KBP| Prealert Date(s) Between <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['debut'].' and '.$_GET['fin'].'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').' File(s)</span>';?>
                       

                       <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelPopUpKBP.php?debut=<?php echo $_GET['debut']; ?>&fin=<?php echo $_GET['fin']; ?>&id_cli=&id_mod_trans=1&id_mod_trac=2&id_march=','pop1','width=80,height=80');">
                        <i class="fas fa-file-excel"></i> Export
                      </button>

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
                          <div class="col-sm-12  table-responsive">
                            <table id="user_data_2" cellspacing="0" width="100%" class="tableau-de-donnees  table table-hover text-nowrap table-sm small">
                              <thead>
                                <tr>
                                  <th style="color: white; text-align: center;">N.</th>
                                  <th style="color: white; text-align: center;">MCA REF</th>
                                  <th style="color: white; text-align: center;">CUSTOMER NAME</th>
                                  <th style="color: white; text-align: center;">PRE-ALERTE DATE</th>
                                  <th style="color: white; text-align: center;">INVOICE</th>
                                  <th style="color: white; text-align: center;">COMMODITY</th>
                                  <th style="color: white; text-align: center;">SUPPLIER</th>
                                  <th style="color: white; text-align: center;">PO Ref</th>
                                  <th style="color: white; text-align: center;">WEIGHT</th>
                                  <th style="color: white; text-align: center;">ROAD MANIF</th>
                                  <th style="color: white; text-align: center;">HORSE</th>
                                  <th style="color: white; text-align: center;">TRAILER 1</th>
                                  <th style="color: white; text-align: center;">TRAILER 2/CONTAINER</th>
                                  <th style="color: white; text-align: center;">Klesa arrival date </th>
                                  <th style="color: white; text-align: center;">Wiski arrival date</th>
                                  <th style="color: white; text-align: center;">Dispacth from K'lsa</th>
                                  <th style="color: white; text-align: center;">REMARKS</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php
                                $maClasse-> afficherSearchFileKBP($_GET['debut'], $_GET['fin'], 1, 2, 
                                                                  NULL, NULL, NULL, NULL, NULL)
                                ?>
                              </tbody>
                            </table>
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





<?php
include('pied.php');
?>

</body>
</script>
</html>
