<?php
  include("tete.php");

  $couleur = '';
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
  }else{
    $client = '';
  }

if ($_GET['type']=='KASUMBALESA TRUCK ARRIVAL') {

  $nombre_dossier = $maClasse-> nbreArriveKlsa2Jour();
  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                         </tr>
                         '.$maClasse-> afficherArriveKlsa2Jour().'
                    </table>';

}else if ($_GET['type']=='WISKI TRUCK ARRIVAL') {

  $nombre_dossier = $maClasse-> nbreArriveWiski2Jour();
  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                         </tr>
                         '.$maClasse-> afficherArriveWiski2Jour().'
                    </table>';

}else if ($_GET['type']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT KASUMBALESA') {

  $nombre_dossier = $maClasse-> nbreDelaiDateKlsa();
  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherDelaiDateKlsa().'
                    </table>';

}else if ($_GET['type']=='DATES ERROR') {

  $nombre_dossier = $maClasse-> nbreErreurDateKlsa();
  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                        <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherErreurDateKlsa().'
                    </table>';

}else if ($_GET['type']=='TRUCK OVERSTAY MORE THAN 2 DAYS AT WISKI') {

  $nombre_dossier = $maClasse-> nbreDelaiDateWiski();
  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                        <tr style="font-weight: bold; background-color: black; color: white;">
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Klsa Arrival</td>
                              <td style="border: 1px solid black;">Wiski Arrival</td>
                              <td style="border: 1px solid black;">Wiski Departure</td>
                              <td style="border: 1px solid black;">Dispatch From Klsa</td>
                              <td style="border: 1px solid black;">Delay</td>
                         </tr>
                         '.$maClasse-> afficherDelaiDateWiski().'
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
                          <?php echo  '<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['type'].'</span>';?>
                        <!--<button class="btn btn-default" onclick="exportToExcel('popUpDossier')">
                          <img src="../images/xls.png" width="30px">
                        </button>-->

                    <button class="btn btn-success square-btn-adjust" onclick="window.location.replace('exportExcelDashboardKlsaPopUp.php?type=<?php echo $_GET['type']; ?>','pop1','width=80,height=80');">
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
