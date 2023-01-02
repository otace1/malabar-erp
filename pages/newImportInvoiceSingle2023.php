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
                
<!-- <form id="enregistrerFactureExportSingle_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureExportSingle_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureExportSingle">

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

      <div class="col-md-6">
        
          <div class="form-group row">
            <label for="inputEmail3" class="col-sm-3 col-form-label">Files Ref.:</label>
            <div class="col-sm-9">  
              <select class="form-control form-control-sm" name="id_dos" id="id_dos" onchange="getTableauExportInvoiceSingle(id_mod_fact.value, this.value, id_mod_lic.value, id_march.value, id_mod_trans.value)" required>
                <option></option>
                <?php
                  $maClasse-> selectionnerDossierClientModeleLicenceMarchandise($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
                ?>
              </select>
            </div>
          </div>

      </div>

      <div class="col-12"><hr></div>

      <div class="col-md-8 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>UNIT</th>
                  <th>AMOUNT</th>
                  <th>CURRENCY</th>
                  <th>TVA</th>
              </tr>
          </thead>
          <tbody>
            <?php
              // $maClasse-> getDeboursModeleFacture($_GET['id_mod_fact']);
            ?>
            <tr id="headingOne_1">
              <th colspan="6">
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1_1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_1">
                  <i class="fa fa-plus"></i>
                </a>
                CUSTOMS CLEARANCE FEES / FRAIS DEDOUANEMENT
              </th>
            </tr>
            <div>
              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_1" id="id_deb_1" value="1">
                  RIE
                </td>
                <td width="50%">
                  REDEVANCE REMUNERATOIRE INFORMATIQUE A LEXPORT
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_1" id="unite_1">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_1" id="montant_1" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_1" id="usd_1" onchange="getTotal()">
                    <option value="0">CDF</option>
                    <option value="1">USD</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_1" id="tva_1" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_2" id="id_deb_2" value="2">
                  DDE
                </td>
                <td width="50%">
                  DROIT DE DOUANE A LEXPORT
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_2" id="unite_2">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_2" id="montant_2" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_2" id="usd_2" onchange="getTotal()">
                    <option value="0">CDF</option>
                    <option value="1">USD</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_2" id="tva_2" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_3" id="id_deb_3" value="3">
                  RLS
                </td>
                <td width="50%">
                  REDEVANCE LOGISTIQUE TERRESTRE SNCC
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_3" id="unite_3">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_3" id="montant_3" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_3" id="usd_3" onchange="getTotal()">
                    <option value="0">CDF</option>
                    <option value="1">USD</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_3" id="tva_3" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_4" id="id_deb_4" value="4">
                  FSR
                </td>
                <td width="50%">
                  FRAIS SERVICES RENDUS PROD. MINIERS
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_4" id="unite_4">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_4" id="montant_4" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_4" id="usd_4" onchange="getTotal()">
                    <option value="0">CDF</option>
                    <option value="1">USD</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_4" id="tva_4" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>
              
              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_5" id="id_deb_5" value="5">
                  FERE
                </td>
                <td width="50%">
                  FICHE ELECTRONIQUE DE RENSEIGNEMENT A L'EXPORTATION
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_5" id="unite_5">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_5" id="montant_5" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_5" id="usd_5" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_5" id="tva_5" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_6" id="id_deb_6" value="6">
                  LMC
                </td>
                <td width="50%">
                  LIGNE MARITIME CONGOLAISE
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_6" id="unite_6">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_6" id="montant_6" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_6" id="usd_6" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_6" id="tva_6" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_7" id="id_deb_7" value="7">
                  
                </td>
                <td width="50%">
                  GOVERNORS TAX($50/MT) / TAXE VOIRIE
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_7" id="unite_7">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_7" id="montant_7" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_7" id="usd_7" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_7" id="tva_7" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_8" id="id_deb_8" value="8">
                  
                </td>
                <td width="50%">
                  CONCENTRATE TAX($100/MT) / TAXE CONCENTREE
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_8" id="unite_8">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_8" id="montant_8" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_8" id="usd_8" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_8" id="tva_8" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_9" id="id_deb_9" value="9">
                  OCC
                </td>
                <td width="50%">
                  SAMPLING / ECHATILLIONNAGE OCC
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_9" id="unite_9">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_9" id="montant_9" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_9" id="usd_9" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_9" id="tva_9" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_10" id="id_deb_10" value="10">
                  CGEA
                </td>
                <td width="50%">
                  RADIO ACTIVITY TEST / RADIO ACTIVITE 
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_10" id="unite_10">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_10" id="montant_10" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_10" id="usd_10" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_10" id="tva_10" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_11" id="id_deb_11" value="11">
                  CEEC
                </td>
                <td width="50%">
                  CEEC CERTIFICATE / CERTIFICAT CEEC (UPTO 30MT)
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_11" id="unite_11">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_11" id="montant_11" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_11" id="usd_11" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_11" id="tva_11" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_12" id="id_deb_12" value="12">
                  CEEC
                </td>
                <td width="50%">
                  CEEC CERTIFICATE / CERTIFICAT CEEC (30MT to 60MT) - WEF 13/12/2017
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_12" id="unite_12">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_12" id="montant_12" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_12" id="usd_12" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_12" id="tva_12" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_13" id="id_deb_13" value="13">
                  
                </td>
                <td width="50%">
                  DGDA SECURITY SEALS / FRAIS DE PLOMB DGDA (3 X SEALS PER TRUCK)
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_13" id="unite_13">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_13" id="montant_13" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_13" id="usd_13" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_13" id="tva_13" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_14" id="id_deb_14" value="14">
                  
                </td>
                <td width="50%">
                  PNHF - NAC
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_14" id="unite_14">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_14" id="montant_14" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_14" id="usd_14" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_14" id="tva_14" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_1">
                <td width="10%">
                  <input type="hidden" name="id_deb_15" id="id_deb_15" value="15">
                  
                </td>
                <td width="50%">
                  ASSAY FEE / FRAIS LABO
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_15" id="unite_15">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_15" id="montant_15" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_15" id="usd_15" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_15" id="tva_15" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

            <tr id="headingOne_2">
              <th colspan="6">
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1_2" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_2">
                  <i class="fa fa-plus"></i>
                </a>
                OTHER CHARGES / AUTRES FRAIS
              </th>
            </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_2">
                <td width="10%">
                  <input type="hidden" name="id_deb_16" id="id_deb_16" value="16">
                  
                </td>
                <td width="50%">
                  MINE DIVISION /DIVISION DES MINES
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_16" id="unite_16">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_16" id="montant_16" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_16" id="usd_16" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_16" id="tva_16" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_2">
                <td width="10%">
                  <input type="hidden" name="id_deb_17" id="id_deb_17" value="17">
                  
                </td>
                <td width="50%">
                  COMMERCE EXTERIOR / COMMERCE EXTERIEUR
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_17" id="unite_17">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_17" id="montant_17" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_17" id="usd_17" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_17" id="tva_17" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_2">
                <td width="10%">
                  <input type="hidden" name="id_deb_18" id="id_deb_18" value="18">
                  
                </td>
                <td width="50%">
                  OCC FEES / FRAIS OCC
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_18" id="unite_18">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_18" id="montant_18" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_18" id="usd_18" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_18" id="tva_18" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_2">
                <td width="10%">
                  <input type="hidden" name="id_deb_19" id="id_deb_19" value="19">
                  
                </td>
                <td width="50%">
                  PRE-CLEARANCE FEES/ FRAIS PRE-DEDOUANEMENT
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_19" id="unite_19">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_19" id="montant_19" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_19" id="usd_19" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_19" id="tva_19" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

            <tr id="headingOne_3">
              <th colspan="6">
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1_3" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_3">
                  <i class="fa fa-plus"></i>
                </a>
                OPERATIONAL COSTS / COUT OPERATIONEL
              </th>
            </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_3">
                <td width="10%">
                  <input type="hidden" name="id_deb_20" id="id_deb_20" value="20">
                  
                </td>
                <td width="50%">
                  OPERATIONS COST : OPERATIONS COST -INTERNAL
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_20" id="unite_20">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_20" id="montant_20" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_20" id="usd_20" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_20" id="tva_20" onchange="getTotal()">
                    <option value="0">NO</option>
                    <option value="1">YES</option>
                  </select>
                </td>
              </tr>

            <tr id="headingOne_4">
              <th colspan="6">
                <a class="btn btn-primary btn-sm" data-toggle="collapse" href="#multiCollapseExample1_4" role="button" aria-expanded="false" aria-controls="multiCollapseExample1_4">
                  <i class="fa fa-plus"></i>
                </a>
                SERVICE FEE / SERVICES
              </th>
            </tr>

              <tr class="collapse multi-collapse" id="multiCollapseExample1_4">
                <td width="10%">
                  <input type="hidden" name="id_deb_21" id="id_deb_21" value="21">
                  
                </td>
                <td width="50%">
                  CONTRACTOR AGENCY FEE / FRAIS D`AGENCE
                </td>
                <td style="text-align: center;">
                  <input type="text" style="text-align: center; width: 8em;" class="bg bg-dark" name="unite_21" id="unite_21">
                </td>
                <td style="text-align: center;">
                  <input type="number" step="0.001" class="bg bg-dark" style="text-align: center;" name="montant_21" id="montant_21" value="" onblur="getTotal()">

                </td>
                <td style="text-align: center;">
                  <select name="usd_21" id="usd_21" onchange="getTotal()">
                    <option value="1">USD</option>
                    <option value="0">CDF</option>
                  </select>
                </td>
                <td style="text-align: center;">
                  <select name="tva_21" id="tva_21" onchange="getTotal()">
                    <option value="1">YES</option>
                    <option value="0">NO</option>
                  </select>
                </td>
              </tr>

            </div>
          </tbody>
        </table>
      </div>

      <div class="col-md-4 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>File Data</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <tbody>
            <tr>
              <th>Rate</th>
              <th><input id="roe_decl" name="roe_decl" type="number" step="0.000001" min="1" ></th>
            </tr>
            <tr>
              <th>Produit</th>
              <th><input id="commodity" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Destination</th>
              <th><input id="destination" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Horse</th>
              <th><input id="horse" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Trailer 1</th>
              <th><input id="trailer_1" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Trailer 2</th>
              <th><input id="trailer_2" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Qty(Mt)</th>
              <th><input id="poids" disabled class="bg bg-dark"></th>
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

  function getTableauExportInvoiceSingle(id_mod_fact, id_dos, id_mod_lic, id_march, id_mod_trans){
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_mod_fact: id_mod_fact, id_dos: id_dos, id_mod_lic: id_mod_lic, id_march:id_march, id_mod_trans:id_mod_trans, operation: 'getTableauExportInvoiceSingle'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // alert('Hello');
          $('#roe_decl').val(data.roe_decl);
          $('#commodity').val(data.commodity);
          $('#destination').val(data.destination);
          $('#horse').val(data.horse);
          $('#trailer_1').val(data.trailer_1);
          $('#trailer_2').val(data.trailer_2);
          $('#poids').val(Math.round((data.poids*1000))/1000);
          //Items ------------
          $('#unite_1').val(Math.round((data.poids*1000))/1000);
          $('#unite_2').val(Math.round((data.poids*1000))/1000);
          $('#unite_3').val(Math.round((data.poids*1000))/1000);
          $('#unite_4').val(Math.round((data.poids*1000))/1000);
          $('#unite_5').val(Math.round((data.poids*1000))/1000);
          $('#montant_5').val(Math.round((data.poids*3*1000))/1000);
          $('#unite_6').val(Math.round((data.poids*1000))/1000);
          $('#montant_6').val(Math.round((data.poids*8*1000))/1000);
          $('#unite_7').val(Math.round((data.poids*1000))/1000);
          $('#montant_7').val(Math.round((data.poids*50*1000))/1000);
          $('#unite_8').val(Math.round((data.poids*1000))/1000);
          $('#montant_8').val(Math.round((data.poids*100*1000))/1000);
          $('#unite_9').val(1);
          $('#montant_9').val(250);
          $('#unite_10').val(1);
          $('#montant_10').val(80);

          if (data.poids<30) {
            $('#unite_11').val(1);
            $('#montant_11').val(125);
          }else{
            $('#unite_11').val(0);
            $('#montant_11').val(0);
          }
          
          if (data.poids>=30) {
            $('#unite_12').val(1);
            $('#montant_12').val(250);
          }else{
            $('#unite_12').val(0);
            $('#montant_12').val(0);
          }
          
          $('#unite_13').val(1);
          $('#montant_13').val(40);

          $('#unite_14').val(1);
          $('#montant_14').val(15);

          $('#unite_15').val(1);
          $('#montant_15').val(110);

          $('#unite_16').val(1);
          $('#montant_16').val(75);

          $('#unite_17').val(1);
          $('#montant_17').val(35);

          $('#unite_18').val(1);
          $('#montant_18').val(20);

          $('#unite_19').val(1);
          $('#montant_19').val(75);

          $('#unite_20').val(1);
          $('#montant_20').val(200);

          $('#unite_21').val(1);
          $('#montant_21').val(150);

          // $('#msg_modalite_fss').html(data.msg_modalite_fss);
          // $("#updateModaliteFss").modal("hide");
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function enregistrerFactureExportSingle(roe_decl, id_dos, ref_fact, id_deb_1, montant_1, usd_1, tva_1){

    // var ref_po = $('#ref_po').val();

    $('#spinner-div').show();

    if(confirm('Do really you want to submit ?')) {

      if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

        $('#spinner-div').hide();//Request is complete so hide spinner
        alert('Error !! Please select the file.');

      }else if (roe_decl > 1) {

        $.ajax({
          type: "POST",
          url: "ajax.php",
          data: { roe_decl: roe_decl, id_deb_1: id_deb_1, montant_1: montant_1, usd_1: usd_1, tva_1: tva_1, operation: 'enregistrerFactureExportSingle'},
          dataType:"json",
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              // $('#tableau_modalite_fss').html(data.tableau_modalite_fss);
              // $('#msg_modalite_fss').html(data.msg_modalite_fss);
              // $("#updateModaliteFss").modal("hide");
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });

      }else{
        $('#spinner-div').hide();//Request is complete so hide spinner
        alert('Error !! Please enter the rate of exchange of this file.');
        $('#roe_decl').addClass("bg bg-danger");
      }

    }
        $('#spinner-div').hide();//Request is complete so hide spinner

  }

  $(document).ready(function(){

      $('#enregistrerFactureExportSingle_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

            alert('Error !! Please select the file.');

          }else if ($('#roe_decl').val() > 1) {
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
                  $( '#enregistrerFactureExportSingle_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewExportInvoiceSingle2022.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  // window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });

          }else{
            $('#spinner-div').hide();//Request is complete so hide spinner
            alert('Error !! Please enter the rate of exchange of this file.');
            $('#roe_decl').addClass("bg bg-danger");
          }

        }

      });
    
  });


  function getTotal(){

  }
</script>
