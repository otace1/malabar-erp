<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

   if( isset($_POST['creerFactureDossier']) ){
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
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
          <h5>
            <i class="fa fa-calculator nav-icon"></i> NEW INVOICE
          </h5>
        </div>

      </div><!-- /.container-fluid -->
    </section>


    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="enregistrerFactureExportMultiple_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureExportMultiple_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureExportMultiple">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_march" value="<?php echo $_GET['id_march'];?>">
      <input type="hidden" name="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>">
      <div class="col-md-4">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-4 col-form-label">Invoice Ref.: </label>
            <div class="col-sm-8">
              <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($_GET['id_cli']);?>">
            </div>
          </div>

      </div>

      <div class="col-12"></div>

      <div class="col-md-8 table-responsive" style="height: 500px;">
        <label for="x_card_code" class="control-label mb-1"><u>Files</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th>#</th>
                  <th>File Ref.</th>
                  <th>Lot. No.</th>
                  <th>Declaration</th>
                  <th>Liquidation</th>
                  <th>Quittance</th>
                  <th>Qty(Mt)</th>
                  <th>Duty in CDF</th>
                  <th>Exchange Rate</th>
                  <th>Duty in USD</th>
              </tr>
          </thead>
          <tbody>
            <?php
              $maClasse-> getDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-4 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>Fixed Charges</u></label>
        <table class="table table-bordered table-striped table-hover table-sm small table-head-fixed table-dark">
          <thead>
            <tr>
              <th width="40%">Taxe</th>
              <th width="20%">Unit</th>
              <th width="20%">Cost/Unit</th>
              <th width="20%">Amount</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>GOVERNORS TAX($50/MT) / TAXE VOIRIE</th>
              <th><input idid="unite_deb_7" name="unite_deb_7" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_poids'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_7" name="montant_deb_7" style="width: 8em; text-align: center;" value="50" class="bg bg-dark"></th>
              <th><input idid="total_deb_7" name="total_deb_7" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['gov_tax_50'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>FICHE ELECTRONIQUE DE RENSEIGNEMENT A L'EXPORTATION</th>
              <th><input id="unite_deb_5" name="unite_deb_5" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_poids'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_5" name="montant_deb_5" style="width: 8em; text-align: center;" value="3" class="bg bg-dark"></th>
              <th><input idid="total_deb_5" name="total_deb_5" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['fere_3'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>LIGNE MARITIME CONGOLAISE (LMC)</th>
              <th><input id="unite_deb_6" name="unite_deb_6" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_poids'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_6" name="montant_deb_6" style="width: 8em; text-align: center;" value="5" class="bg bg-dark"></th>
              <th><input idid="total_deb_6" name="total_deb_6" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['lmc_5'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OCC : SAMPLING / ECHATILLIONNAGE OCC</th>
              <th><input id="unite_deb_9" name="unite_deb_9" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_9" name="montant_deb_9" style="width: 8em; text-align: center;" value="250" class="bg bg-dark"></th>
              <th><input idid="total_deb_9" name="total_deb_9" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['occ_250'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OCC/CGEA : RADIO ACTIVITY TEST / RADIO ACTIVITE OCC/CGEA</th>
              <th><input id="unite_deb_10" name="unite_deb_10" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_10" name="montant_deb_10" style="width: 8em; text-align: center;" value="80" class="bg bg-dark"></th>
              <th><input idid="total_deb_10" name="total_deb_10" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['cgea_80'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>CEEC CERTIFICATE / CERTIFICAT CEEC (UPTO 30MT)</th>
              <th><input id="unite_deb_11" name="unite_deb_11" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_ceec_30'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_11" name="montant_deb_11" style="width: 8em; text-align: center;" value="125" class="bg bg-dark"></th>
              <th><input idid="total_deb_11" name="total_deb_11" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['ceec_30'], 3, ',', '.');?>"  class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>CEEC CERTIFICATE / CERTIFICAT CEEC (30MT to 60MT) - WEF 13/12/2017</th>
              <th><input id="unite_deb_12" name="unite_deb_12" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_ceec_60'];?>"  class="bg bg-dark"></th>
              <th><input idid="montant_deb_12" name="montant_deb_12" style="width: 8em; text-align: center;" value="250" class="bg bg-dark"></th>
              <th><input idid="total_deb_12" name="total_deb_12" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['ceec_60'], 3, ',', '.');?>"  class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>DGDA SECURITY SEALS / FRAIS DE PLOMB DGDA</th>
              <th><input id="unite_deb_13" name="unite_deb_13" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_13" name="montant_deb_13" style="width: 8em; text-align: center;" value="40" class="bg bg-dark"></th>
              <th><input idid="total_deb_13" name="total_deb_13" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['dgda_seal_40'], 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>

            <tr>
              <th>ASSAY FEE / FRAIS LABO</th>
              <th><input id="unite_deb_15" name="unite_deb_15" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_15" name="montant_deb_15" style="width: 8em; text-align: center;" value="125" class="bg bg-dark"></th>
              <th><input idid="total_deb_15" name="total_deb_15" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*125, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OCC FEES / FRAIS OCC</th>
              <th><input id="unite_deb_18" name="unite_deb_18" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_18" name="montant_deb_18" style="width: 8em; text-align: center;" value="20" class="bg bg-dark"></th>
              <th><input idid="total_deb_18" name="total_deb_18" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*20, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>COMMERCE EXTERIOR / COMMERCE EXTERIEUR</th>
              <th><input id="unite_deb_17" name="unite_deb_17" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_17" name="montant_deb_17" style="width: 8em; text-align: center;" value="25" class="bg bg-dark"></th>
              <th><input idid="total_deb_17" name="total_deb_17" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*25, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>KASUMBALEA BORDER CHARGES / FORMALITES FRONTIERE KASUMBALESA</th>
              <th><input id="unite_deb_22" name="unite_deb_22" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_22" name="montant_deb_22" style="width: 8em; text-align: center;" value="50" class="bg bg-dark"></th>
              <th><input idid="total_deb_22" name="total_deb_22" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*50, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : OCC FEES / COUT OPERATIONNEL FRAIS OCC</th>
              <th><input id="unite_deb_23" name="unite_deb_23" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_23" name="montant_deb_23" style="width: 8em; text-align: center;" value="35" class="bg bg-dark"></th>
              <th><input idid="total_deb_23" name="total_deb_23" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*35, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : MINE DIVISION /COUT OPERATIONNEL DIVISION DES MINES</th>
              <th><input id="unite_deb_24" name="unite_deb_24" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_24" name="montant_deb_24" style="width: 8em; text-align: center;" value="45" class="bg bg-dark"></th>
              <th><input idid="total_deb_24" name="total_deb_24" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*45, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : MINE POLICE / COUT OPERATIONNEL POLICE DES MINES</th>
              <th><input id="unite_deb_25" name="unite_deb_25" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_25" name="montant_deb_25" style="width: 8em; text-align: center;" value="20" class="bg bg-dark"></th>
              <th><input idid="total_deb_25" name="total_deb_25" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*20, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : ANR / COUT OPERATIONNEL ANR</th>
              <th><input id="unite_deb_26" name="unite_deb_26" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_26" name="montant_deb_26" style="width: 8em; text-align: center;" value="20" class="bg bg-dark"></th>
              <th><input idid="total_deb_26" name="total_deb_26" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*20, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : DGDA / COUT OPERATIONNEL DGDA</th>
              <th><input id="unite_deb_27" name="unite_deb_27" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_27" name="montant_deb_27" style="width: 8em; text-align: center;" value="75" class="bg bg-dark"></th>
              <th><input idid="total_deb_27" name="total_deb_27" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*75, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : PRINTING AND STATIONERY / FRAIS ADMINISTRATIFS</th>
              <th><input id="unite_deb_28" name="unite_deb_28" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_28" name="montant_deb_28" style="width: 8em; text-align: center;" value="10" class="bg bg-dark"></th>
              <th><input idid="total_deb_28" name="total_deb_28" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*10, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : BANK CHARGES / FRAIS BANCAIRE</th>
              <th><input id="unite_deb_29" name="unite_deb_29" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_29" name="montant_deb_29" style="width: 8em; text-align: center;" value="10" class="bg bg-dark"></th>
              <th><input idid="total_deb_29" name="total_deb_29" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*10, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>OPERATIONS COST : KISANGA TOLL GATES / COUT OPERATIONNEL PEAGE</th>
              <th><input id="unite_deb_30" name="unite_deb_30" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_30" name="montant_deb_30" style="width: 8em; text-align: center;" value="5" class="bg bg-dark"></th>
              <th><input idid="total_deb_30" name="total_deb_30" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*5, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>TRANSFER FEE / FRAIS DE TRANSFERT</th>
              <th><input id="unite_deb_31" name="unite_deb_31" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_31" name="montant_deb_31" style="width: 8em; text-align: center;" value="35" class="bg bg-dark"></th>
              <th><input idid="total_deb_31" name="total_deb_31" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*35, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>CONTRACTOR AGENCY FEE / FRAIS D`AGENCE</th>
              <th><input id="unite_deb_21" name="unite_deb_21" style="width: 8em; text-align: center;" value="<?php echo $maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos'];?>" class="bg bg-dark"></th>
              <th><input idid="montant_deb_21" name="montant_deb_21" style="width: 8em; text-align: center;" value="120" class="bg bg-dark"></th>
              <th><input idid="total_deb_21" name="total_deb_21" disabled style="width: 8em; text-align: center;" value="<?php echo number_format($maClasse-> getParametreDossiersExportAFactures($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'])['nbre_dos']*120, 3, ',', '.');?>" class="bg bg-dark"></th>
            </tr>
          </tbody>
        </table>
      </div>

    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="enregistrerFactureExportSingle(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
    <button type="submit" class="btn btn-xs btn-primary">Submit</button>
  </div>


<!-- -------FIN VALIDATION FORMULAIRE------- -->

</form>

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
  <?php include("pied.php");?>

<script type="text/javascript">

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function calculDDE(compteur){

    var roe_decl = 1;
    var id_deb = 1;

    if (parseInt($('#id_deb_2_'+compteur).val()) > 1 && Number.isInteger($('#id_deb_2_'+compteur).val()) ) {
      // alert($('#id_deb_2_'+compteur).val());
      id_deb = parseInt($('#id_deb_2_'+compteur));
    }

    if (parseInt($('#roe_decl_'+compteur).val()) > 1 && Number.isInteger($('#roe_decl_'+compteur).val())) {
      roe_decl = parseInt($('#roe_decl_'+compteur));
    }

    if (Math.round(parseInt($('#id_deb_2_'+compteur).val())/parseInt($('#roe_decl_'+compteur).val())*1000)/1000 > 0) {
      
      $('#dde_usd_'+compteur).html(new Intl.NumberFormat('en-DE').format(Math.round(parseInt($('#id_deb_2_'+compteur).val())/parseInt($('#roe_decl_'+compteur).val())*1000)/1000));
      $('#dde_usd_'+compteur).addClass("badge badge-primary");

    }else{
      
      $('#dde_usd_'+compteur).html('');
      $('#dde_usd_'+compteur).removeClass("badge badge-primary");

    }

  }

  let USDollar = new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD',
  });
  

  function getTotal(){

  }


  $(document).ready(function(){

      $('#enregistrerFactureExportMultiple_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

            // alert('Hello');

            var fd = new FormData(this);
            $('#spinner-div').show();

            $.ajax({
              type: 'post',
              url: 'ajax.php',
              processData: false,
              contentType: false,
              data: fd,
              dataType: 'json',
              success:function(data){
                if (data.logout) {
                  alert(data.logout);
                  window.location="../deconnexion.php";
                }else if(data.message){
                  $( '#enregistrerFactureExportMultiple_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewExportInvoiceMultiple2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });


        }

      });
    
  });

</script>
