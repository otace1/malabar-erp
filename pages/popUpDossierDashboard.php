<?php
  include("tete.php");

  $couleur = '';
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
  }else{
    $client = '';
  }

  if( isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic'] != '')){
    $modele_licence = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeleLicence($_GET['id_mod_lic']).'</span>';
  }else{
    $modele_licence = '';
  }

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomModeTransport($_GET['id_mod_trans']).'</span>';
  }else{
    $mode_transport = '';
  }

  if( isset($_GET['commodity']) && ($_GET['commodity'] != '')){
    $commodity = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['commodity'].'</span>';
  }else{
    $commodity = '';
  }

//if ($_GET['type']=='TOTAL FILES') {

  $nombre_dossier = $maClasse-> nbreDossierDashboardEtat($_GET['etat'], $_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['commodity']);
  $message = '<table class="table table-dark table-hover  table-head-fixed text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Commodity</td>
                              <td style="border: 1px solid black;">Ref. Decl.</td>
                              <td style="border: 1px solid black;">Date Decl.</td>
                              <td style="border: 1px solid black;">Ref. Liq.</td>
                              <td style="border: 1px solid black;">Date Liq.</td>
                              <td style="border: 1px solid black;">Ref. Quit.</td>
                              <td style="border: 1px solid black;">Date Quit.</td>
                         </tr>
                         '.$maClasse-> afficherDossierDashboardEtat($_GET['etat'], $_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['commodity']).'
                    </table>';

//}
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
                          <?php echo  '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['etat'].'</span>'.$client.$modele_licence.$mode_transport.$commodity;?>
                        <!--<button class="btn btn-default" onclick="exportToExcel('popUpDossier')">
                          <img src="../images/xls.png" width="30px">
                        </button>-->

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelDashboardDossierPopUp.php?etat=<?php echo $_GET['etat']; ?>&id_cli=<?php echo $_GET['id_cli']; ?>&id_mod_lic=<?php echo $_GET['id_mod_lic']; ?>&id_mod_trans=<?php echo $_GET['id_mod_trans']; ?>&commodity=<?php echo $_GET['commodity']; ?>&','pop1','width=80,height=80');">
                      <i class="fas fa-file-excel"></i> Export
                    </button>

                      </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <?php
                              echo $message;
                            ?>  
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
