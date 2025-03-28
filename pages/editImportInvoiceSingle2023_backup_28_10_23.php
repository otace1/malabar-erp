<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

   if( isset($_POST['creerFactureDossier']) ){
    ?>
    <script type="text/javascript">
      window.location = 'nouvelleFacturePartielle2.php?id_cli=<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_cli'];?>&id_mod_lic=<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_lic'];?>&id_dos=<?php echo $_POST['id_dos'];?>&ref_fact=<?php echo $_POST['ref_fact'];?>';
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
            <i class="fa fa-edit nav-icon"></i> EDIT INVOICE
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
                <button class="btn btn-xs btn-danger" onclick="window.location='listerFactureDossier.php?type_fact=globale&id_mod_lic_fact=2&id_cli=<?php echo $maClasse-> getClientFacture($_GET['ref_fact'])['id_cli'];?>'"><< Go Back</button>
                <div class="float-right">
                  <button class="btn btn-xs btn-info" onclick="modal_edit_avance('<?php echo $_GET['ref_fact'];?>');"><i class="fa fa-edit"></i>Advanced modification</button>
                </div>
              </div>
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="editFactureImportSingle_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="editFactureImportSingle_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="editFactureImportSingle">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_lic'];?>">
      <input type="hidden" name="id_march" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'];?>">
      <input type="hidden" name="id_mod_fact" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_trans'];?>">
      <input type="hidden" name="id_dos" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>">
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
            <!-- <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureGlobale($maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_cli']);?>"> -->
            <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $_GET['ref_fact'];?>">
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Files Ref.:</label>
            <select class="form-control form-control-sm" onchange="getTableauImportInvoiceSingle(id_mod_fact.value, this.value, id_mod_lic.value, id_march.value, id_mod_trans.value)" required>
              <option><?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['ref_dos'];?></option>
            </select>
          </div>

      </div>

      <div class="col-md-2">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Tax and Duty Part:</label>
            <select class="form-control form-control-sm" name="tax_duty_part" id="tax_duty_part" required>
              <option value="Include">Include</option>
              <option value="Exclude">Exclude</option>
            </select>
          </div>

      </div>

      <div class="col-md-12"></div>
      
      <div class="col-md-5">
        <label for="x_card_code" class="control-label mb-1"><u>File Data</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small table-head-fixed table-dark">
          <tbody>
            <tr>
              <th>FOB</th>
              <th><input style="text-align: center; width: 9em;" id="fob" name="fob" onblur="majjjj(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" disabled class="bg bg-dark"></th>
              <th>Fret</th>
              <th><input style="text-align: center; width: 9em;" id="fret" name="fret" onblur="majjjj(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Assurance</th>
              <th><input style="text-align: center; width: 9em;" id="assurance" name="assurance" onblur="majjjj(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1"  disabled class="bg bg-dark"></th>
              <th>Autres Charges</th>
              <th><input style="text-align: center; width: 9em;" id="autre_frais" name="autre_frais" onblur="majjjj(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1"  disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>CIF</th>
              <th><input style="text-align: center; width: 9em;" id="cif" name="cif" onblur="majjjj(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1"  disabled class="bg bg-dark"></th>
              <th>Currency</th>
              <th><span id="id_mon"></span></th>
            </tr>
            <tr>
              <th>FOB <select class="bg bg-dark" name="mon_fob" id="mon_fob" onchange="maj_id_mon_fob(id_dos.value, this.value);" required>
                  <?php echo $maClasse-> selectionnerMonnaie2(); ?>
                </select></th>
              <th><input style="text-align: center; width: 9em;" id="fob_usd" name="fob_usd" onblur="maj_fob_usd(id_dos.value, this.value);calculCIF();calculCIF();" type="number" step="0.000001" min="0" class="" required></th>
              <th>Fret <select class="bg bg-dark" name="mon_fret" id="mon_fret" onchange="maj_id_mon_fret(id_dos.value, this.value);" required>
                  <?php echo $maClasse-> selectionnerMonnaie2(); ?>
                </select></th>
              <th><input style="text-align: center; width: 9em;" id="fret_usd" name="fret_usd" onblur="maj_fret_usd(id_dos.value, this.value);calculCIF();" class="" type="number" step="0.000001" min="0" required></th>
            </tr>
            <tr>
              <th>Autres Charges <select class="bg bg-dark" name="mon_autre_frais" id="mon_autre_frais" onchange="maj_id_mon_autre_frais(id_dos.value, this.value);" required>
                  <?php echo $maClasse-> selectionnerMonnaie2(); ?>
                </select></th>
              <th><input style="text-align: center; width: 9em;" id="autre_frais_usd" name="autre_frais_usd" onblur="maj_autre_frais_usd(id_dos.value, this.value);calculCIF();" class="" type="number" step="0.000001" min="0" required></th>
              <th>Assurance <select class="bg bg-dark" name="mon_assurance" id="mon_assurance" onchange="maj_id_mon_assurance(id_dos.value, this.value);" required>
                  <?php echo $maClasse-> selectionnerMonnaie2(); ?>
                </select></th>
              <th><input style="text-align: center; width: 9em;" id="assurance_usd" name="assurance_usd" onblur="maj_assurance_usd(id_dos.value, this.value);calculCIF();" class="" type="number" step="0.000001" min="0" required></th>
            </tr>
            <tr>
              <th>Bank</th>
              <th>
                <select style="width: 9em;" id="id_bank_liq" name="id_bank_liq" onchange="maj_id_bank_liq(id_dos.value, this.value);calculCIF();"required>
                  <option></option>
                  <?php
                    $maClasse-> selectionnerBanqueLiquidation();
                  ?>
                </select>
              </th>
              <th>Bank Rate</th>
              <th><input style="text-align: center; width: 9em;" id="roe_decl" name="roe_decl" onblur="maj_roe_decl(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" required></th>
            </tr>
            <tr>
              <th>Rate (CDF/<span id="label_mon_fob"></span>) INV.</th>
              <th><input style="text-align: center; width: 9em;" id="roe_inv" name="roe_inv" onblur="maj_roe_inv(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" required></th>
              <th>Rate(CDF/USD) BCC</th>
              <th><input style="text-align: center; width: 9em;" id="roe_liq" name="roe_liq" onblur="maj_roe_liq(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="1" required></th>
            </tr>
            <tr>
              <th>CIF (USD)</th>
              <th><input style="text-align: center; width: 9em; font-weight: bold;" id="cif_usd" class="bg bg-primary" disabled></th>
              <th>CIF (CDF) <a href="#" onclick="modal_ajuster_cif_cdf(<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>);" title="Adjust"><i class="fa fa-cogs text-warning"></i></a></th>
              <th><input style="text-align: center; width: 9em; font-weight: bold;" id="cif_cdf" class="bg bg-primary" disabled></th>
            </tr>
            <tr>
              <th>Total of Duty (CDF)</th>
              <th><input style="text-align: center; width: 9em;" id="montant_liq" onblur="maj_montant_liq(id_dos.value, this.value);calculCIF();" type="number" step="0.000001" min="0" class="" required></th>
            </tr>
            <tr>
              <th>Poids (kg)</th>
              <th><input style="text-align: center; width: 9em;" id="poids" name="poids" onblur="maj_poids(id_dos.value, this.value);calculTresco();" required></th>
              <th>Tariff Code Client:</th>
              <th><input style="text-align: center; width: 9em;" id="code_tarif" name="code_tarif" onblur="maj_code_tarif(id_dos.value, this.value);" type="text" class="" required></th>
            </tr>
            <tr>
              <th>Truck (Wagon / AWB)</th>
              <th><input style="text-align: center; width: 8em;" id="horse" onblur="maj_horse(id_dos.value, this.value);" class=""></th>
              <th><input style="text-align: center; width: 8em;" id="trailer_1" onblur="maj_trailer_1(id_dos.value, this.value);" class=""></th>
              <th><input style="text-align: center; width: 8em;" id="trailer_2" onblur="maj_trailer_2(id_dos.value, this.value);" class=""></th>
            </tr>
            <tr>
              <th>Facture/PFI No.:</th>
              <th><input style="text-align: center; width: 9em;" id="ref_fact_dos" disabled class="bg bg-dark"></th>
              <th>BIVAC inspection:</th>
              <th><input style="text-align: center; width: 9em;" id="cod" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Produit</th>
              <th><input style="text-align: center; width: 9em;" id="commodity" disabled class="bg bg-dark"></th>
              <th>Exoneration/Code:</th>
              <th><input style="text-align: center; width: 9em;" id="num_exo" onblur="maj_num_exo(id_dos.value, this.value);" class=""></th>
            </tr>
            <tr>
              <th>Declaration No.</th>
              <th><input style="text-align: center; width: 9em;" id="ref_decl" disabled class="bg bg-dark"></th>
              <th>Declaration Date</th>
              <th><input style="text-align: center; width: 9em;" id="date_decl" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Liquidation No.</th>
              <th><input style="text-align: center; width: 9em;" id="ref_liq" disabled class="bg bg-dark"></th>
              <th>Liquidation Date</th>
              <th><input style="text-align: center; width: 9em;" id="date_liq" disabled class="bg bg-dark"></th>
            </tr>
            <tr>
              <th>Quittance No.</th>
              <th><input style="text-align: center; width: 9em;" id="ref_quit" disabled class="bg bg-dark"></th>
              <th>Quittance Date</th>
              <th><input style="text-align: center; width: 9em;" id="date_quit" disabled class="bg bg-dark"></th>
            </tr>
          </tbody>
        </table>
      </div>

      <div class="col-md-7 table-responsive">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>% / Qty</th>
                  <th>AMOUNT</th>
                  <th>CURRENCY</th>
                  <th colspan="2" style="text-align: center;">TVA</th>
              </tr>
          </thead>
          <tbody id="debours">
            <?php
              // $maClasse-> getDeboursPourFactureClientModeleLicence($maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_cli'], $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_lic'], $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'], $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_trans']);
            ?>
            </div>
          </tbody>
        </table>
      </div>

    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="editFactureImportSingle(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
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

  <div class="modal fade" id="modal_ajuster_cif_cdf">
    <div class="modal-dialog">
      <form id="ajuster_cif_cdf_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
        <input type="hidden" name="operation" value="ajuster_cif_cdf">
        <input type="hidden" name="id_dos" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-cogs"></i> Adjust</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12">
              <label for="x_card_code" class="control-label mb-1">CIF(CDF)</label>
              <input name="cif_cdf" min="0" id="cif_cdf_adj" onchange="" class="form-control form-control-sm cc-exp" required>
            </div>

          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
        </div>
      </div>
      </form>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

  <div class="modal fade" id="modal_edit_avance">
    <div class="modal-dialog modal-xl">
      <!-- <form id="ajuster_cif_cdf_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
        <input type="hidden" name="operation" value="ajuster_cif_cdf">
        <input type="hidden" name="id_dos" value="<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><i class="fa fa-edit"></i> Advanced modification | <?php echo $_GET['ref_fact'];?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">

            <div class="col-md-12 table-responsive">
              <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>File Ref.</th>
                    <th>Amount</th>
                    <th>Currency</th>
                    <th>TVA</th>
                    <th>TVA Amount</th>
                  </tr>
                </thead>
                <tbody class="small" id="detail_facture_avance"></tbody>
              </table>
            </div>

          </div>
        </div>
        <!-- <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
          <button type="submit" name="" class="btn btn-xs btn-primary">Submit</button>
        </div> -->
      </div>
      <!-- </form> -->
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

<script type="text/javascript">

  function getDeboursFacture(){
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_mod_fact: 3, id_dos: <?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>, id_mod_lic: 2, id_march:<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'];?>, id_mod_trans:<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'];?>, ref_fact:'<?php echo $_GET['ref_fact'];?>', operation: 'getTableauImportInvoiceSingleEdit'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#debours').html(data.debours);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function advance_edit(ref_fact, id_dos, id_deb, montant, montant_tva, tva, usd){
    // console.log('------------\n');
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {ref_fact: ref_fact, id_dos: id_dos, id_deb: id_deb, montant: montant, montant_tva: montant_tva, tva: tva, usd: usd, operation: 'advance_edit'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          getDeboursFacture();
          $('#detail_facture_avance').html(data.detail_facture_avance);
          $('#montant_t_deb_1').html((new Intl.NumberFormat('en-DE').format(Math.round(data.taxe*1000)/1000)));
          $('#montant_t_deb_2').html((new Intl.NumberFormat('en-DE').format(Math.round(data.other*1000)/1000)));
          $('#montant_t_deb_3').html((new Intl.NumberFormat('en-DE').format(Math.round(data.ops*1000)/1000)));
          $('#montant_t_deb_4').html((new Intl.NumberFormat('en-DE').format(Math.round(data.service*1000)/1000)));
          // $('#modal_edit_avance').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }

  function modal_edit_avance(ref_fact){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {ref_fact: ref_fact, id_dos: <?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>, operation: 'modal_edit_avance'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{

          $('#detail_facture_avance').html(data.detail_facture_avance);
          $('#montant_t_deb_1').html((new Intl.NumberFormat('en-DE').format(Math.round(data.taxe*1000)/1000)));
          $('#montant_t_deb_2').html((new Intl.NumberFormat('en-DE').format(Math.round(data.other*1000)/1000)));
          $('#montant_t_deb_3').html((new Intl.NumberFormat('en-DE').format(Math.round(data.ops*1000)/1000)));
          $('#montant_t_deb_4').html((new Intl.NumberFormat('en-DE').format(Math.round(data.service*1000)/1000)));
          $('#modal_edit_avance').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_ajuster_cif_cdf(id_dos){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, operation: 'modal_ajuster_cif_cdf'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#cif_cdf_adj').val(data.cif_cdf);
          $('#modal_ajuster_cif_cdf').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#ajuster_cif_cdf_form').submit(function(e){
        if(confirm('Do really you want to submit ?')) {
          $('#modal_ajuster_cif_cdf').modal('hide');
          e.preventDefault();
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
              }else{
                $( '#ajuster_cif_cdf_form' ).each(function(){
                    this.reset();
                });

                $('#assurance_usd').val(data.assurance_usd);
                calculCIF();
                alert('Update complete!');
              }
            },
            complete: function () {
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });
        }

      });
    
  });

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function getTableauImportInvoiceSingle(id_mod_fact, id_dos, id_mod_lic, id_march, id_mod_trans){
    
  }

  $(document).ready(function(){
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_mod_fact: 3, id_dos: <?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_dos'];?>, id_mod_lic: 2, id_march:<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'];?>, id_mod_trans:<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_march'];?>, ref_fact:'<?php echo $_GET['ref_fact'];?>', operation: 'getTableauImportInvoiceSingleEdit'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_mon').html(data.id_mon);
          $('#tax_duty_part').val(data.tax_duty_part);
          $('#mon_fob').val(data.id_mon_fob);
          $('#mon_fret').val(data.id_mon_fret);
          $('#mon_assurance').val(data.id_mon_assurance);
          $('#mon_autre_frais').val(data.id_mon_autre_frais);
          $('#label_mon_fob').html(data.label_mon_fob);
          $('#fob').val(data.fob);
          $('#fret').val(data.fret);
          $('#assurance').val(data.assurance);
          $('#autre_frais').val(data.autre_frais);
          $('#cif').val(data.cif);
          $('#roe_decl').val(data.roe_decl);
          $('#roe_inv').val(data.roe_inv);
          $('#commodity').val(data.commodity);
          // $('#truck').val(data.truck);
          // alert('Hello');
          $('#id_bank_liq').val(data.id_bank_liq);
          $('#roe_liq').val(data.roe_liq);
          $('#commodity').val(data.commodity);
          $('#horse').val(data.horse);
          $('#trailer_1').val(data.trailer_1);
          $('#trailer_2').val(data.trailer_2);
          $('#ref_fact_dos').val(data.ref_fact);
          $('#cod').val(data.cod);
          $('#num_exo').val(data.num_exo);
          $('#code_tarif').val(data.code_tarif);
          $('#ref_decl').val(data.ref_decl);
          $('#date_decl').val(data.date_decl_dos);
          $('#ref_liq').val(data.ref_liq);
          $('#date_liq').val(data.date_liq_dos);
          $('#ref_quit').val(data.ref_quit);
          $('#date_quit').val(data.date_quit_dos);
          $('#poids').val(Math.round((data.poids*1000))/1000);
          $('#fob_usd').val(Math.round((data.fob_usd*1000))/1000);
          $('#fret_usd').val(Math.round((data.fret_usd*1000))/1000);
          $('#assurance_usd').val(Math.round((data.assurance_usd*1000))/1000);
          $('#autre_frais_usd').val(Math.round((data.autre_frais_usd*1000))/1000);
          $('#cif_usd').val(Math.round((data.cif_usd*1000))/1000);
          $('#montant_liq').val(Math.round((data.montant_liq*1000))/1000);
          calculCIF();
          //Items ------------
          $('#debours').html(data.debours);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });

  $(document).ready(function(){

      $('#editFactureImportSingle_form').submit(function(e){

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
                  $( '#editFactureImportSingle_form' ).each(function(){
                      this.reset();
                  });
                  $('#ref_fact').val(data.ref_fact);
                  $('#id_dos').html(data.ref_dos);
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  window.open('viewImportInvoiceSingle2023.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
                  window.location="listerFactureDossier.php?type_fact=globale&id_cli=<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_cli'];?>&id_mod_lic_fact=<?php echo $maClasse-> getDataFactureGlobale($_GET['ref_fact'])['id_mod_lic']?>";
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


  function calculCIF(){

    if (parseFloat($('#fob_usd').val()) > 0 ) {
      fob_usd = parseFloat($('#fob_usd').val());
    }else{
      fob_usd=0;
    }

    if (parseFloat($('#fret_usd').val()) > 0 ) {
      fret_usd = parseFloat($('#fret_usd').val());
    }else{
      fret_usd=0;
    }

    if (parseFloat($('#assurance_usd').val()) > 0 ) {
      assurance_usd = parseFloat($('#assurance_usd').val());
    }else{
      assurance_usd=0;
    }

    if (parseFloat($('#autre_frais_usd').val()) > 0 ) {
      autre_frais_usd = parseFloat($('#autre_frais_usd').val());
    }else{
      autre_frais_usd=0;
    }

    if (parseFloat($('#roe_decl').val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=1;
    }

    if (parseFloat($('#roe_inv').val()) > 0 ) {
      roe_inv = parseFloat($('#roe_inv').val());
    }else{
      roe_inv=1;
    }

    cif_usd = fob_usd + fret_usd + assurance_usd + autre_frais_usd;

    cif_cdf = cif_usd*roe_inv;


    if (Math.round(cif_usd*1000)/1000 > 0) {
      
      $('#cif_usd').val(new Intl.NumberFormat('en-DE').format(Math.round(cif_usd*1000)/1000));
      // $('#cif_usd').addClass("badge badge-danger");

    }else{
      
      $('#cif_usd').val('');
      $('#cif_usd').removeClass("badge badge-danger");

    }

    if (Math.round(cif_cdf*1000)/1000 > 0) {
      
      // $('#cif_cdf').val(new Intl.NumberFormat('en-DE').format(Math.round(cif_cdf*1000)/1000));
      $('#cif_cdf').val(cif_cdf);
      // $('#cif_cdf').addClass("badge badge-danger");

    }else{
      
      $('#cif_cdf').val('');
      $('#cif_cdf').removeClass("badge badge-danger");

    }

  }

  function maj_roe_decl(id_dos, roe_decl){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_decl: roe_decl, operation: 'maj_roe_decl'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_roe_liq(id_dos, roe_liq){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_liq: roe_liq, operation: 'maj_roe_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_id_bank_liq(id_dos, id_bank_liq){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_bank_liq: id_bank_liq, operation: 'maj_id_bank_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#roe_decl').val(data.roe_decl);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_roe_inv(id_dos, roe_inv){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_inv: roe_inv, operation: 'maj_roe_inv'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_montant_liq(id_dos, montant_liq){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, montant_liq: montant_liq, operation: 'maj_montant_liq'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_horse(id_dos, horse){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, horse: horse, operation: 'maj_horse'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_trailer_1(id_dos, trailer_1){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, trailer_1: trailer_1, operation: 'maj_trailer_1'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_trailer_2(id_dos, trailer_2){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, trailer_2: trailer_2, operation: 'maj_trailer_2'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_fob_usd(id_dos, fob_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, fob_usd: fob_usd, operation: 'maj_fob_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_fret_usd(id_dos, fret_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, fret_usd: fret_usd, operation: 'maj_fret_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_assurance_usd(id_dos, assurance_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, assurance_usd: assurance_usd, operation: 'maj_assurance_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_autre_frais_usd(id_dos, autre_frais_usd){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, autre_frais_usd: autre_frais_usd, operation: 'maj_autre_frais_usd'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_code_tarif(id_dos, code_tarif){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, code_tarif: code_tarif, operation: 'maj_code_tarif'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_poids(id_dos, poids){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, poids: poids, operation: 'maj_poids'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_num_exo(id_dos, num_exo){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, num_exo: num_exo, operation: 'maj_num_exo'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_id_mon_fob(id_dos, id_mon_fob){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_mon_fob: id_mon_fob, operation: 'maj_id_mon_fob'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_mon_fob').html(data.label_mon_fob)
          $('#label_mon_cif').html(data.label_mon_fob)
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_id_mon_fret(id_dos, id_mon_fret){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_mon_fret: id_mon_fret, operation: 'maj_id_mon_fret'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_id_mon_assurance(id_dos, id_mon_assurance){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_mon_assurance: id_mon_assurance, operation: 'maj_id_mon_assurance'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_id_mon_autre_frais(id_dos, id_mon_autre_frais){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, id_mon_autre_frais: id_mon_autre_frais, operation: 'maj_id_mon_autre_frais'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function calculDroit(){


    if (parseFloat($('#cif_cdf').val()) > 0 ) {
      cif_cdf = parseFloat($('#cif_cdf').val());
    }else{
      cif_cdf=0;
    }

    if (parseFloat($('#ddi').val()) > 0 ) {
      ddi = parseFloat($('#ddi').val());
    }else{
      ddi=1;
    }
    if (parseFloat($('#pourcentage_qte_ddi').val()) > 0 ) {
      pourcentage_qte_ddi = parseFloat($('#pourcentage_qte_ddi').val());
      if ($('#tva_ddi').val() == '1' ) {
        tva_ddi = (((ddi*100)+(ddi*pourcentage_qte_ddi))/pourcentage_qte_ddi)*0.16;
      }else{
        tva_ddi=0;
      }
    }else{
      pourcentage_qte_ddi=0;
      tva_ddi=0;
    }
    $('#montant_tva_ddi').val(tva_ddi.toFixed(0));

    if (parseFloat($('#ddi_2').val()) > 0 ) {
      ddi_2 = parseFloat($('#ddi_2').val());
    }else{
      ddi_2=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_2').val()) > 0 ) {
      pourcentage_qte_ddi_2 = parseFloat($('#pourcentage_qte_ddi_2').val());
      if ($('#tva_ddi_2').val() == '1' ) {
        tva_ddi_2 = (((ddi_2*100)+(ddi_2*pourcentage_qte_ddi_2))/pourcentage_qte_ddi_2)*0.16;
      }else{
        tva_ddi_2=0;
      }
    }else{
      pourcentage_qte_ddi_2=0;
      tva_ddi_2=0;
    }
    $('#montant_tva_ddi_2').val(tva_ddi_2.toFixed(0));

    if (parseFloat($('#ddi_3').val()) > 0 ) {
      ddi_3 = parseFloat($('#ddi_3').val());
    }else{
      ddi_3=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_3').val()) > 0 ) {
      pourcentage_qte_ddi_3 = parseFloat($('#pourcentage_qte_ddi_3').val());
      if ($('#tva_ddi_3').val() == '1' ) {
        tva_ddi_3 = (((ddi_3*100)+(ddi_3*pourcentage_qte_ddi_3))/pourcentage_qte_ddi_3)*0.16;
      }else{
        tva_ddi_3=0;
      }
    }else{
      pourcentage_qte_ddi_3=0;
      tva_ddi_3=0;
    }
    $('#montant_tva_ddi_3').val(tva_ddi_3.toFixed(0));

    if (parseFloat($('#ddi_4').val()) > 0 ) {
      ddi_4 = parseFloat($('#ddi_4').val());
    }else{
      ddi_4=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_4').val()) > 0 ) {
      pourcentage_qte_ddi_4 = parseFloat($('#pourcentage_qte_ddi_4').val());
      if ($('#tva_ddi_4').val() == '1' ) {
        tva_ddi_4 = (((ddi_4*100)+(ddi_4*pourcentage_qte_ddi_4))/pourcentage_qte_ddi_4)*0.16;
      }else{
        tva_ddi_4=0;
      }
    }else{
      pourcentage_qte_ddi_4=0;
      tva_ddi_4=0;
    }
    $('#montant_tva_ddi_4').val(tva_ddi_4.toFixed(0));

    if (parseFloat($('#roe_decl').val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=0;
    }

    if (parseFloat($('#roe_liq').val()) > 0 ) {
      roe_liq = parseFloat($('#roe_liq').val());
    }else{
      roe_liq=0;
    }

    if (parseFloat($('#unite_rls').val()) > 0 ) {
      unite_rls = parseFloat($('#unite_rls').val());
    }else{
      unite_rls=0;
    }

    if (parseFloat($('#dci').val()) > 0 ) {
      dci = parseFloat($('#dci').val());
    }else{
      dci=0;
    }
    if ($('#tva_dci').val() == '1' ) {
      tva_dci = dci*0.16;
    }else{
      tva_dci=0;
    }
    $('#montant_tva_dci').val(tva_dci.toFixed(0));

    if (parseFloat($('#tva').val()) > 0 ) {
      tva = parseFloat($('#tva').val());
    }else{
      tva=0;
    }

    if (parseFloat($('#montant_liq').val()) > 0 ) {
      montant_liq = parseFloat($('#montant_liq').val());
    }else{
      montant_liq=0;
    }

    if (parseFloat($('#unite_frais_bancaire').val()) > 0 ) {
      unite_frais_bancaire = parseFloat($('#unite_frais_bancaire').val());
    }else{
      unite_frais_bancaire=1;
    }
    $('#unite_frais_bancaire').val(unite_frais_bancaire);

    if (parseFloat($('#montant_min').val()) > 0 ) {
      montant_min = parseFloat($('#montant_min').val());
    }else{
      montant_min=0;
    }

    if (parseFloat($('#fpi').val()) > 0 ) {
      fpi = parseFloat($('#fpi').val());
    }else{
      fpi=0;
    }
    if ($('#tva_fpi').val() == '1' ) {
      tva_fpi = fpi*0.16;
    }else{
      tva_fpi=0;
    }

    if (parseFloat($('#rri').val()) > 0 ) {
      rri = parseFloat($('#rri').val());
    }else{
      rri=0;
    }
    if ($('#tva_rri').val() == '1' ) {
      tva_rri = rri*0.16;
    }else{
      tva_rri=0;
    }

    if (parseFloat($('#cog').val()) > 0 ) {
      cog = parseFloat($('#cog').val());
    }else{
      cog=0;
    }
    if ($('#tva_cog').val() == '1' ) {
      tva_cog = cog*0.16;
    }else{
      tva_cog=0;
    }

    // fpi = (cif_cdf+ddi)*0.0184;
    // rri = (cif_cdf*0.0225);
    // cog = (cif_cdf*0.00457);
    
    // alert(tva_ddi);
    rls = 85*unite_rls*roe_liq;
    if ($('#tva_rls').val() == '1' ) {
      tva_rls = rls*0.16;
    }else{
      tva_rls=0;
    }

    autres_taxes = montant_liq-(ddi+tva_ddi+fpi+tva_fpi+rri+tva_rri+cog+tva_cog+dci+tva_dci+rls+tva_rls+tva+ddi_2+tva_ddi_2+ddi_3+tva_ddi_3+ddi_4+tva_ddi_4);

    // console.log(autres_taxes);

    frais_bancaire = (montant_liq/roe_decl)*(unite_frais_bancaire/100);

    if(frais_bancaire > montant_min){
      frais_bancaire = (montant_liq/roe_decl)*(unite_frais_bancaire/100);
    }else{
      frais_bancaire = montant_min;
    }



    if (Math.round(fpi*1000)/1000 > 0) {
      $('#fpi').val(fpi.toFixed(0));
    }else{
      $('#fpi').val('');
    }
    if (Math.round(rri*1000)/1000 > 0) {
      $('#rri').val(rri.toFixed(0));
    }else{
      $('#rri').val('');
    }
    if (Math.round(cog*1000)/1000 > 0) {
      $('#cog').val(cog.toFixed(0));
    }else{
      $('#cog').val('');
    }
    if (Math.round(rls*1000)/1000 > 0) {
      $('#rls').val(rls.toFixed(0));
    }else{
      $('#rls').val('');
    }
    if (Math.round(autres_taxes*1000)/1000 > 0) {
      $('#autres_taxes').val(autres_taxes.toFixed(2));
    }else{
      $('#autres_taxes').val('');
    }
    if (Math.round(frais_bancaire*1000)/1000 > 0) {
      
      $('#frais_bancaire').val(frais_bancaire.toFixed(2));
      
    }else{
      $('#frais_bancaire').val('');
    }


  }

  function calculDroit2(){


    if (parseFloat($('#cif_cdf').val()) > 0 ) {
      cif_cdf = parseFloat($('#cif_cdf').val());
    }else{
      cif_cdf=0;
    }

    if (parseFloat($('#ddi').val()) > 0 ) {
      ddi = parseFloat($('#ddi').val());
    }else{
      ddi=1;
    }
    if (parseFloat($('#pourcentage_qte_ddi').val()) > 0 ) {
      pourcentage_qte_ddi = parseFloat($('#pourcentage_qte_ddi').val());
      if ($('#tva_ddi').val() == '1' ) {
        tva_ddi = (((ddi*100)+(ddi*pourcentage_qte_ddi))/pourcentage_qte_ddi)*0.16;
      }else{
        tva_ddi=0;
      }
    }else{
      pourcentage_qte_ddi=0;
      tva_ddi=0;
    }
    // tva_ddi = $('#montant_tva_ddi').val();
    if (parseFloat($('#montant_tva_ddi').val()) > 0 ) {
      tva_ddi = parseFloat($('#montant_tva_ddi').val());
    }else{
      tva_ddi=0;
    }

    if (parseFloat($('#ddi_2').val()) > 0 ) {
      ddi_2 = parseFloat($('#ddi_2').val());
    }else{
      ddi_2=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_2').val()) > 0 ) {
      pourcentage_qte_ddi_2 = parseFloat($('#pourcentage_qte_ddi_2').val());
      if ($('#tva_ddi_2').val() == '1' ) {
        tva_ddi_2 = (((ddi_2*100)+(ddi_2*pourcentage_qte_ddi_2))/pourcentage_qte_ddi_2)*0.16;
      }else{
        tva_ddi_2=0;
      }
    }else{
      pourcentage_qte_ddi_2=0;
      tva_ddi_2=0;
    }
    if (parseFloat($('#montant_tva_ddi_2').val()) > 0 ) {
      tva_ddi_2 = parseFloat($('#montant_tva_ddi_2').val());
    }else{
      tva_ddi_2=0;
    }

    if (parseFloat($('#ddi_3').val()) > 0 ) {
      ddi_3 = parseFloat($('#ddi_3').val());
    }else{
      ddi_3=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_3').val()) > 0 ) {
      pourcentage_qte_ddi_3 = parseFloat($('#pourcentage_qte_ddi_3').val());
      if ($('#tva_ddi_3').val() == '1' ) {
        tva_ddi_3 = (((ddi_3*100)+(ddi_3*pourcentage_qte_ddi_3))/pourcentage_qte_ddi_3)*0.16;
      }else{
        tva_ddi_3=0;
      }
    }else{
      pourcentage_qte_ddi_3=0;
      tva_ddi_3=0;
    }
    if (parseFloat($('#montant_tva_ddi_3').val()) > 0 ) {
      tva_ddi_3 = parseFloat($('#montant_tva_ddi_3').val());
    }else{
      tva_ddi_3=0;
    }
    

    if (parseFloat($('#ddi_4').val()) > 0 ) {
      ddi_4 = parseFloat($('#ddi_4').val());
    }else{
      ddi_4=0;
    }
    if (parseFloat($('#pourcentage_qte_ddi_4').val()) > 0 ) {
      pourcentage_qte_ddi_4 = parseFloat($('#pourcentage_qte_ddi_4').val());
      if ($('#tva_ddi_4').val() == '1' ) {
        tva_ddi_4 = (((ddi_4*100)+(ddi_4*pourcentage_qte_ddi_4))/pourcentage_qte_ddi_4)*0.16;
      }else{
        tva_ddi_4=0;
      }
    }else{
      pourcentage_qte_ddi_4=0;
      tva_ddi_4=0;
    }
    if (parseFloat($('#montant_tva_ddi_4').val()) > 0 ) {
      tva_ddi_4 = parseFloat($('#montant_tva_ddi_4').val());
    }else{
      tva_ddi_4=0;
    }
    

    if (parseFloat($('#roe_decl').val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=0;
    }

    if (parseFloat($('#roe_liq').val()) > 0 ) {
      roe_liq = parseFloat($('#roe_liq').val());
    }else{
      roe_liq=0;
    }

    if (parseFloat($('#unite_rls').val()) > 0 ) {
      unite_rls = parseFloat($('#unite_rls').val());
    }else{
      unite_rls=0;
    }

    if (parseFloat($('#dci').val()) > 0 ) {
      dci = parseFloat($('#dci').val());
    }else{
      dci=0;
    }
    if (parseFloat($('#montant_tva_dci').val()) > 0 ) {
      tva_dci = parseFloat($('#montant_tva_dci').val());
    }else{
      tva_dci=0;
    }

    if (parseFloat($('#tva').val()) > 0 ) {
      tva = parseFloat($('#tva').val());
    }else{
      tva=0;
    }

    if (parseFloat($('#montant_liq').val()) > 0 ) {
      montant_liq = parseFloat($('#montant_liq').val());
    }else{
      montant_liq=0;
    }

    if (parseFloat($('#unite_frais_bancaire').val()) > 0 ) {
      unite_frais_bancaire = parseFloat($('#unite_frais_bancaire').val());
    }else{
      unite_frais_bancaire=1;
    }
    $('#unite_frais_bancaire').val(unite_frais_bancaire);

    if (parseFloat($('#fpi').val()) > 0 ) {
      fpi = parseFloat($('#fpi').val());
    }else{
      fpi=0;
    }
    if ($('#tva_fpi').val() == '1' ) {
      tva_fpi = fpi*0.16;
    }else{
      tva_fpi=0;
    }

    if (parseFloat($('#rri').val()) > 0 ) {
      rri = parseFloat($('#rri').val());
    }else{
      rri=0;
    }
    if ($('#tva_rri').val() == '1' ) {
      tva_rri = rri*0.16;
    }else{
      tva_rri=0;
    }

    if (parseFloat($('#cog').val()) > 0 ) {
      cog = parseFloat($('#cog').val());
    }else{
      cog=0;
    }
    if ($('#tva_cog').val() == '1' ) {
      tva_cog = cog*0.16;
    }else{
      tva_cog=0;
    }

    // fpi = (cif_cdf+ddi)*0.0184;
    // rri = (cif_cdf*0.0225);
    // cog = (cif_cdf*0.00457);
    
    // alert(tva_ddi);
    rls = 85*unite_rls*roe_liq;
    if ($('#tva_rls').val() == '1' ) {
      tva_rls = rls*0.16;
    }else{
      tva_rls=0;
    }

    autres_taxes = montant_liq-(ddi+tva_ddi+fpi+tva_fpi+rri+tva_rri+cog+tva_cog+dci+tva_dci+rls+tva_rls+tva+ddi_2+tva_ddi_2+ddi_3+tva_ddi_3+ddi_4+tva_ddi_4);

    // console.log(autres_taxes);

    frais_bancaire = (montant_liq/roe_decl)*(unite_frais_bancaire/100);



    if (Math.round(fpi*1000)/1000 > 0) {
      $('#fpi').val(fpi.toFixed(0));
    }else{
      $('#fpi').val('');
    }
    if (Math.round(rri*1000)/1000 > 0) {
      $('#rri').val(rri.toFixed(0));
    }else{
      $('#rri').val('');
    }
    if (Math.round(cog*1000)/1000 > 0) {
      $('#cog').val(cog.toFixed(0));
    }else{
      $('#cog').val('');
    }
    if (Math.round(rls*1000)/1000 > 0) {
      $('#rls').val(rls.toFixed(0));
    }else{
      $('#rls').val('');
    }
    if (Math.round(autres_taxes*1000)/1000 > 0) {
      $('#autres_taxes').val(autres_taxes.toFixed(2));
    }else{
      $('#autres_taxes').val('');
    }
    if (Math.round(frais_bancaire*1000)/1000 > 0) {
      
      $('#frais_bancaire').val(frais_bancaire.toFixed(2));
      
    }else{
      $('#frais_bancaire').val('');
    }


  }

  function getTotal(){

  }
</script>
