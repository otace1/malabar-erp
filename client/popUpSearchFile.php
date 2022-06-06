<?php
  include("tete.php");
  $modele_licence = $maClasse-> getElementModeleLicence($_GET['id_mod_lic']);

  $couleur = '';
  
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$maClasse-> getNomClient($_GET['id_cli']).'</span>';
  }else{
    $client = '';
  }

  if( isset($_GET['champs_1']) && ($_GET['champs_1'] != '')){
    $champs_1 = ''.$maClasse-> getNomColonneClient($_GET['champs_1'], $_GET['id_cli'], '1', $_GET['id_mod_lic']);
  }else{
    $champs_1 = '';
  }

  if( isset($_GET['champs_2']) && ($_GET['champs_2'] != '')){
    $champs_2 = ''.$maClasse-> getNomColonneClient($_GET['champs_2'], $_GET['id_cli'], '1', $_GET['id_mod_lic']);
  }else{
    $champs_2 = '';
  }

  if( isset($_GET['valeur']) && ($_GET['valeur'] != '')){
    $valeur = ''.$_GET['valeur'];
  }else{
    $valeur = '';
  }

  if( isset($_GET['debut']) && ($_GET['debut'] != '')){
    $debut = ''.$_GET['debut'];
  }else{
    $debut = '';
  }

  if( isset($_GET['fin']) && ($_GET['fin'] != '')){
    $fin = ''.$_GET['fin'];
  }else{
    $fin = '';
  }


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
                          <?php echo  $client.' | '.'<span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$champs_1.' : '.$valeur.'</span>
                          <span class="bg bg-dark" style="padding-left: 5px; padding-right: 5px;">'.$champs_2.' Between '.$debut.' and '.$fin.' </span>';?>
                       
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
                                  //echo $_GET['champs_1'].' '.$_GET['champs_2'];
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
                                  }else if ($_GET['id_mod_lic']=='1') {
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
                                  }
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
    document.title = "<?php echo $champs_1.'_'.$valeur.'_'.$champs_2.'_'.$debut.'_'.$fin;?>";
</script>

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
      dom: 'Bfrtip',
      buttons: [
          'copy', 'csv', 'excel', 'print'
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
          "url":"dataSearchFile.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>",
              "champs_1": "<?php echo $_GET['champs_1']?>",
              "valeur": "<?php echo $_GET['valeur']?>",
              "champs_2": "<?php echo $_GET['champs_2']?>",
              "debut": "<?php echo $_GET['debut']?>",
              "fin": "<?php echo $_GET['fin']?>"
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
  }else if ($_GET['id_mod_lic']=='1') {
  ?>
    <script type="text/javascript">
      $('#file_data').DataTable({

        createdRow: function (row, data, index) {
            if (data['statut'] == 'CLEARING COMPLETED') {
                $('td', row).eq(0).addClass('highlight');
                $('td', row).eq(10).addClass('highlight');
            }
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'print'
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
          "url":"dataSearchFile.php",
          "dataSrc":{
              "id_cli": "<?php echo $_GET['id_cli']?>"
          },
          "data": {
              "id_cli": "<?php echo $_GET['id_cli']?>",
              "id_mod_lic": "<?php echo $_GET['id_mod_lic']?>",
              "champs_1": "<?php echo $_GET['champs_1']?>",
              "valeur": "<?php echo $_GET['valeur']?>",
              "champs_2": "<?php echo $_GET['champs_2']?>",
              "debut": "<?php echo $_GET['debut']?>",
              "fin": "<?php echo $_GET['fin']?>"
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
  }
?>



<?php
include('pied.php');
?>

</body>
</script>
</html>
