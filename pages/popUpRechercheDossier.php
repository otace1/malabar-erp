<?php
  include("tete.php");

  $couleur = '';
  
  $nombre_dossier = $maClasse-> nbreSearchFile($_GET['mot_cle'], $_GET['id_mod_lic']);

if ($_GET['id_mod_lic']=='1') {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Num. Lot</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Status</td>
                         </tr>
                         '.$maClasse-> afficherSearchFile($_GET['mot_cle'], $_GET['id_mod_lic']).'
                    </table>';

}else if ($_GET['id_mod_lic']=='2') {

  $message = '<table class="table table-dark table-hover text-nowrap table-sm">
                         <tr>
                              <td style="border: 1px solid black;">N.</td>
                              <td style="border: 1px solid black;">MCA REF. FILE</td>
                              <td style="border: 1px solid black;">Client</td>
                              <td style="border: 1px solid black;">Horse</td>
                              <td style="border: 1px solid black;">Trailer 1</td>
                              <td style="border: 1px solid black;">Trailer 2</td>
                              <td style="border: 1px solid black;">Prealerte Date</td>
                              <td style="border: 1px solid black;">Invoice</td>
                              <td style="border: 1px solid black;">CRF Ref.</td>
                              <td style="border: 1px solid black;">Status</td>
                         </tr>
                         '.$maClasse-> afficherSearchFile($_GET['mot_cle'], $_GET['id_mod_lic']).'
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
                          <?php echo  'Resultat(s) Recherche: <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$_GET['mot_cle'].'</span> | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.number_format($nombre_dossier, 0, ',', ' ').'</span>';?>
                        
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
