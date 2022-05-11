<?php
  include("tete.php");

  $couleur = '';
  
  $nombre_dossier = $maClasse-> nbreSearchFileKPB($_GET['date_preal'], $_GET['id_mod_lic']);
  

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
                          <?php echo  'Resultat(s) KBP date Prealerte: <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['date_preal'].'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').'</span>';?>
                        
                    <!-- <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelDashboardKlsaPopUp.php?type=<?php echo $_GET['type']; ?>','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button> -->

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
                            <table id="user_data_2" cellspacing="0" width="100%" class="tableau-de-donnees  table table-hover text-nowrap table-sm">
                              <thead>
                                <?php
                                $maClasse-> afficherEnTeteTableau($maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['id_mod_lic'], $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['id_cli'], $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['id_mod_trans']);
                                ?>
                              </thead>
                              <tbody>
                                <?php
                                $maClasse-> afficherSearchFileKBP($_GET['date_preal'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], 
                          $_GET['id_mod_lic'])['id_mod_trans'], $_GET['id_mod_lic'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], 
                            $_GET['id_mod_lic'])['commodity'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['id_march'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['statut'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['num_lic'], 
                          $maClasse-> getDataDossierPrealertKBP($_GET['date_preal'], $_GET['id_mod_lic'])['cleared'])
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
