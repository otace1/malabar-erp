<?php
  include("tete.php");

  if ($_GET['id_mod_lic'] == '1') {
    $filtre = ' | <u> LOADING DATE BETWEEN <span class="bg bg-danger" style="padding-left: 5px; padding-right: 5px;">'.$_GET['debut'].' AND '.$_GET['fin'].'</span></u>';
  }else if ($_GET['id_mod_lic'] == '2' && $_GET['id_mod_trans'] == '1') {
    $filtre = ' | <u> WISKI ARRIVAL DATE BETWEEN <span class="bg bg-danger" style="padding-left: 5px; padding-right: 5px;">'.$_GET['debut'].' AND '.$_GET['fin'].'</span></u>';
  }else if ($_GET['id_mod_lic'] == '2') {
    $filtre = ' | <u> ARRIVAL DATE BETWEEN <span class="bg bg-danger" style="padding-left: 5px; padding-right: 5px;">'.$_GET['debut'].' AND '.$_GET['fin'].'</span></u>';
  }
  
  $nombre_dossier = $maClasse-> nbreKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']);

  $avg = ' | AVG TIME <span class="bg bg-primary" style="padding-left: 5px; padding-right: 5px;">'.round(($maClasse-> getAvgKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin'])/$nombre_dossier), 2).' DAY(S)</span>';

  if( isset($_GET['id_mod_trans']) && ($_GET['id_mod_trans'] != '')){
    $mode_transport = ' | '.$maClasse-> getNomModeTransport($_GET['id_mod_trans']);
  }else{
    $mode_transport = '';
  }

  if( isset($_GET['id_mod_lic']) && ($_GET['id_mod_lic'] != '')){
    $modele_licence = $maClasse-> getNomModeleLicence($_GET['id_mod_lic']);
  }else{
    $modele_licence = '';
  }

  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getElementClient($_GET['id_cli'])['nom_cli'];
  }else{
    $client = '';
  }

if ($_GET['id_mod_lic']=='1' && ($_GET['id_mod_trans']=='3' || $_GET['id_mod_trans']=='4') ) {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid white;">N.</td>
                              <td style="border: 1px solid white;">MCA REF. FILE</td>
                              <td style="border: 1px solid white;">Client</td>
                              <td style="border: 1px solid white;">Commodity</td>
                              <td style="border: 1px solid white;">AWB Num.</td>
                              <td style="border: 1px solid white;">Prealerte Date</td>
                              <td style="border: 1px solid white;">Loading Arrival</td>
                              <td style="border: 1px solid white;">Ref. Decl.</td>
                              <td style="border: 1px solid white;">Date. Decl.</td>
                              <td style="border: 1px solid white;">Ref. Liq.</td>
                              <td style="border: 1px solid white;">Date. Liq.</td>
                              <td style="border: 1px solid white;">Ref. Quit.</td>
                              <td style="border: 1px solid white;">Date. Quit.</td>
                              <td style="border: 1px solid white;">Exit Drc Date</td>
                              <td style="border: 1px solid white;">Timing</td>
                              <td style="border: 1px solid white;">Status</td>
                              <td style="border: 1px solid white;">Comment</td>
                         </tr>
                         '.$maClasse-> afficherKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']).'
                    </table>';

}if ($_GET['id_mod_lic']=='1' && ($_GET['id_mod_trans']=='1' || $_GET['id_mod_trans']=='5') ) {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid white;">N.</td>
                              <td style="border: 1px solid white;">MCA REF. FILE</td>
                              <td style="border: 1px solid white;">Client</td>
                              <td style="border: 1px solid white;">Commodity</td>
                              <td style="border: 1px solid white;">Horse</td>
                              <td style="border: 1px solid white;">Trailer 1</td>
                              <td style="border: 1px solid white;">Trailer 2</td>
                              <td style="border: 1px solid white;">Prealerte Date</td>
                              <td style="border: 1px solid white;">Loading Arrival</td>
                              <td style="border: 1px solid white;">Ref. Decl.</td>
                              <td style="border: 1px solid white;">Date. Decl.</td>
                              <td style="border: 1px solid white;">Ref. Liq.</td>
                              <td style="border: 1px solid white;">Date. Liq.</td>
                              <td style="border: 1px solid white;">Ref. Quit.</td>
                              <td style="border: 1px solid white;">Date. Quit.</td>
                              <td style="border: 1px solid white;">Exit Drc Date</td>
                              <td style="border: 1px solid white;">Timing</td>
                              <td style="border: 1px solid white;">Status</td>
                              <td style="border: 1px solid white;">Comment</td>
                         </tr>
                         '.$maClasse-> afficherKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']).'
                    </table>';

}if ($_GET['id_mod_lic']=='1') {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid white;">N.</td>
                              <td style="border: 1px solid white;">MCA REF. FILE</td>
                              <td style="border: 1px solid white;">Client</td>
                              <td style="border: 1px solid white;">Commodity</td>
                              <td style="border: 1px solid white;">Horse</td>
                              <td style="border: 1px solid white;">Trailer 1</td>
                              <td style="border: 1px solid white;">Trailer 2</td>
                              <td style="border: 1px solid white;">Prealerte Date</td>
                              <td style="border: 1px solid white;">Loading Arrival</td>
                              <td style="border: 1px solid white;">Ref. Decl.</td>
                              <td style="border: 1px solid white;">Date. Decl.</td>
                              <td style="border: 1px solid white;">Ref. Liq.</td>
                              <td style="border: 1px solid white;">Date. Liq.</td>
                              <td style="border: 1px solid white;">Ref. Quit.</td>
                              <td style="border: 1px solid white;">Date. Quit.</td>
                              <td style="border: 1px solid white;">Exit Drc Date</td>
                              <td style="border: 1px solid white;">Timing</td>
                              <td style="border: 1px solid white;">Status</td>
                              <td style="border: 1px solid white;">Comment</td>
                         </tr>
                         '.$maClasse-> afficherKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']).'
                    </table>';

}else if ($_GET['id_mod_lic']=='2' && ($_GET['id_mod_trans']=='3' || $_GET['id_mod_trans']=='4') ) {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid white;">N.</td>
                              <td style="border: 1px solid white;">MCA REF. FILE</td>
                              <td style="border: 1px solid white;">Client</td>
                              <td style="border: 1px solid white;">Commodity</td>
                              <td style="border: 1px solid white;">AWB Num.</td>
                              <td style="border: 1px solid white;">Prealerte Date</td>
                              <td style="border: 1px solid white;">Arrival Date</td>
                              <td style="border: 1px solid white;">Ref. Decl.</td>
                              <td style="border: 1px solid white;">Date. Decl.</td>
                              <td style="border: 1px solid white;">Ref. Liq.</td>
                              <td style="border: 1px solid white;">Date. Liq.</td>
                              <td style="border: 1px solid white;">Ref. Quit.</td>
                              <td style="border: 1px solid white;">Date. Quit.</td>
                              <td style="border: 1px solid white;">Dispatch/Deliver Date</td>
                              <td style="border: 1px solid white;">Timing</td>
                              <td style="border: 1px solid white;">Status</td>
                              <td style="border: 1px solid white;">Comment</td>
                         </tr>
                         '.$maClasse-> afficherKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']).'
                    </table>';

}else if ($_GET['id_mod_lic']=='2') {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid white;">N.</td>
                              <td style="border: 1px solid white;">MCA REF. FILE</td>
                              <td style="border: 1px solid white;">Client</td>
                              <td style="border: 1px solid white;">Commodity</td>
                              <td style="border: 1px solid white;">Horse</td>
                              <td style="border: 1px solid white;">Trailer 1</td>
                              <td style="border: 1px solid white;">Trailer 2</td>
                              <td style="border: 1px solid white;">Prealerte Date</td>
                              <td style="border: 1px solid white;">Wiski Arrival</td>
                              <td style="border: 1px solid white;">Ref. Decl.</td>
                              <td style="border: 1px solid white;">Date. Decl.</td>
                              <td style="border: 1px solid white;">Ref. Liq.</td>
                              <td style="border: 1px solid white;">Date. Liq.</td>
                              <td style="border: 1px solid white;">Ref. Quit.</td>
                              <td style="border: 1px solid white;">Date. Quit.</td>
                              <td style="border: 1px solid white;">Dispatch/Deliver Date</td>
                              <td style="border: 1px solid white;">Timing</td>
                              <td style="border: 1px solid white;">Status</td>
                              <td style="border: 1px solid white;">Comment</td>
                         </tr>
                         '.$maClasse-> afficherKpiFile($_GET['id_cli'], $_GET['id_mod_lic'], $_GET['id_mod_trans'], $_GET['debut'], $_GET['fin']).'
                    </table>';

}
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
                          <?php echo  'KPIs <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$modele_licence.$client.$mode_transport.$filtre.$avg.'</span> | TOTAL FILES <span class="bg bg-warning" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').'</span>';?>
                        
                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelDashboardKpiPopUp.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>&id_mod_trans=<?php echo $_GET['id_mod_trans'];?>&debut=<?php echo $_GET['debut'];?>&fin=<?php echo $_GET['fin'];?>','pop1','width=80,height=80');">
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
