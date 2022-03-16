<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  $client = '';
  if(isset($_POST['rechercheClient'])){
    $id_mod_lic_fact = $_GET['id_mod_lic_fact'];
    $id_cli = $_POST['id_cli'];
    $id_type_lic = $_POST['id_type_lic'];
    echo "<script>window.location='listerFactureDossier.php?id_mod_lic_fact=$id_mod_lic_fact&id_cli=$id_cli&id_type_lic=$id_type_lic';</script>";
    if( $id_cli > 0){
      $client = ' | '.$maClasse-> getNomClient($id_cli);
    }else{
      $client = '';
    }
  }
  if( isset($_GET['id_cli']) && ($_GET['id_cli'] != '')){
    $client = ' | '.$maClasse-> getNomClient($_GET['id_cli']);
  }else{
    $client = '';
    $_GET['id_cli'] = NULL;
  }

  if( isset($_POST['facturerDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
    </script>
    <?php
  }

  if( isset($_POST['facturerSousDossier']) ){
    // echo '<br>------------------------------------------id_cli = '.$_GET['id_cli'];
    // echo '<br>------------------------------------------id_mod_lic_fact = '.$_GET['id_mod_lic_fact'];
    // echo '<br>------------------------------------------id_dos = '.$_POST['id_dos'];
    // echo '<br>------------------------------------------ref_fact = '.$_POST['ref_fact'];
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>&note_debit=1';
    </script>
    <?php
  }

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-folder-open nav-icon"></i> DOSSIERS EN ATTENTE FACTURE <?php echo $modele['nom_mod_lic'].' ('.$modele['sigle_mod_lic'].')'.$client;?></h5>
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

                </h5>


                <div class="card-tools">
                  
                </div>
              </div>    
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class=" table table-dark table-head-fixed table-bordered table-hover text-nowrap table-sm">
                  <thead>
                    <tr class="bg bg-dark">
                      <th style="border: 1px solid white;">#</th>
                      <th style="border: 1px solid white;">REFERENCE</th>
                      <th style="border: 1px solid white; text-align: center;">NATURE</th>
                      <th style="border: 1px solid white; text-align: center;">DECL. REF.</th>
                      <th style="border: 1px solid white; text-align: center;">DECL. DATE</th>
                      <th style="border: 1px solid white; text-align: center;">LIQ. REF.</th>
                      <th style="border: 1px solid white; text-align: center;">LIQ. DATE</th>
                      <th style="border: 1px solid white; text-align: center;">QUIT. REF.</th>
                      <th style="border: 1px solid white; text-align: center;">QUIT. DATE</th>
                      <th style="border: 1px solid white; text-align: center;">FOB</th>
                      <th style="border: 1px solid white; text-align: center;">FREIGHT</th>
                      <th style="border: 1px solid white; text-align: center;">ASSURANCE</th>
                      <th style="border: 1px solid white; text-align: center;">AUTRES FRAIS</th>
                      <th style="border: 1px solid white; text-align: center;">CIF</th>
                      <th style="border: 1px solid white; text-align: center;">SUPPLIER</th>
                      <th style="border: 1px solid white; text-align: center;">REF. FACT.</th>
                      <th style="border: 1px solid white; text-align: center;">PO REF.</th>
                      <th style="border: 1px solid white; text-align: center;">POIDS</th>
                      <th style="border: 1px solid white; text-align: center;">CUSTOMS OFFICE</th>
                      <th style="border: 1px solid white; text-align: center;">INCOTERM</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $maClasse-> afficherDossierEnAttenteFacture($_GET['id_cli'], $_GET['id_mod_lic_fact']);
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

<?php
if(isset($_GET['id_mod_lic_fact']) && isset($_GET['id_mod_lic_fact'])){

  $modele = $maClasse-> getElementModeleLicence($_GET['id_mod_lic_fact']);
  //$marchandise = $maClasse-> getElementMarchandise($_GET['id_march']);
?>

<div class="modal fade rechercheClient" id="modal-default">
  <div class="modal-dialog modal-md">
    <form id="demo-form2" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="id_type_lic" value="">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-filter"></i> Filtrage CLIENT <?php echo $modele['sigle_mod_lic'];?>.</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">CLIENT</label>
            <select name="id_cli" onchange="" class="form-control cc-exp">
              <option value=''>ALL</option>
                <?php
                  $maClasse->selectionnerClientModeleLicence($modele['id_mod_lic']);
                ?>
            </select>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="rechercheClient" class="btn-xs btn-primary">Valider</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<?php
}
?>
