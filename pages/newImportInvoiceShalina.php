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
              <!-- /.card-header -->

              <div class="card-body table-responsive p-0">
                
<!-- <form id="enregistrerFactureImportShalina_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<form method="POST" id="enregistrerFactureImportShalina_form" action="" data-parsley-validate enctype="multipart/form-data">
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureImportShalina">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_march" id="id_march" value="<?php echo $_GET['id_march'];?>">
      <input type="hidden" name="id_mod_fact" id="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" id="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>">
      <input type="hidden" name="consommable" id="consommable" value="<?php echo $_GET['consommable'];?>">
      <input type="hidden" name="num_lic" id="num_lic" value="<?php echo $_GET['num_lic'];?>">
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label"><sup><span class="btn-xs btn-primary" onclick="modal_creer_facture_en_cours(<?php echo $_GET['id_cli']; ?>, <?php echo $_GET['id_mod_lic_fact']; ?>, <?php echo $_GET['id_march']; ?>, <?php echo $_GET['id_mod_trans']; ?>);"><i class="fa fa-plus"></i></span></sup>Invoice Ref.: </label>
            <span id="liste_ref_fact_non_validee"></span>
          </div>

      </div>

      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Files Ref.:</label>
            <select class="form-control form-control-sm" name="id_dos" id="id_dos" onchange="getTableauImportInvoiceSingle(id_mod_fact.value, this.value, id_mod_lic.value, id_march.value, id_mod_trans.value, consommable.value)" required>
              <option></option>
              <?php
                echo $maClasse-> selectionnerDossierClientModeleLicenceMarchandise2($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans'], $_GET['num_lic']);
              ?>
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

      <div class="col-md-12">
        <hr>
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Rate</label>
              <input type="number" step="0.0001" class="form-control form-control-sm" name="roe_decl" id="roe_decl" onblur="maj_roe_decl(id_dos.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Horse</label>
              <input type="text" class="form-control form-control-sm" name="horse" id="horse" onblur="maj_horse(id_dos.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Trailer 1</label>
              <input type="text" class="form-control form-control-sm" name="trailer_1" id="trailer_1" onblur="maj_trailer_1(id_dos.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Trailer 2</label>
              <input type="text" class="form-control form-control-sm" name="trailer_2" id="trailer_2" onblur="maj_trailer_2(id_dos.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Weight</label>
              <input type="number" step="0.0001" class="form-control form-control-sm" name="poids" id="poids" onblur="maj_poids(id_dos.value, this.value)">
            </div>
          </div>
        </div>
        <hr>
      </div>

      <div class="col-md-8">
        <label for="x_card_code" class="control-label mb-1"><u>Items</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th colspan="2">ITEMS</th>
                  <th>% / Qty</th>
                  <th>AMOUNT</th>
                  <th>CURRENCY</th>
                  <th>TVA</th>
              </tr>
          </thead>
          <tbody id="debours">
            <?php
              // $maClasse-> getDeboursPourFactureClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
            ?>
          </tbody>
        </table>
      </div>

      <div class="col-md-4">
        <label for="x_card_code" class="control-label mb-1"><u>Invoice Details</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Files</th>
                  <th>Rate</th>
                  <th>Liq.(CDF)</th>
                  <th>Liq.($)</th>
                  <th>Duty(CDF)</th>
                  <th>Duty($)</th>
                  <th>Other Fees($)</th>
                  <th>Total($)</th>
              </tr>
          </thead>
          <tbody id="detail_invoice_acid">
            <?php
              // $maClasse-> getDeboursPourFactureClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
            ?>
          </tbody>
        </table>
      </div>

    </div>

    </div>  


<!-- -------VALIDATION FORMULAIRE------- -->

  <div class="modal-footer justify-content-between">
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="enregistrerFactureImportShalina(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
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


<div class="modal fade" id="modal_creer_facture_en_cours">
  <div class="modal-dialog modal-sm">
    <form id="form_creer_facture_en_cours" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-plus"></i> Create Invoice</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

          <div class="col-md-12">
            <label for="x_card_code" class="control-label mb-1">Reference:</label>
            <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact_new" id="ref_fact_new">
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <span type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</span>
        <span type="button" name="rechercheClient1" class="btn btn-xs btn-primary" onclick="creer_facture_en_cours(ref_fact_new.value, id_mod_fact.value, id_cli.value, id_mod_lic.value, '<?php echo $_GET['id_mod_trans'];?>');">Create</span>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modalEditDetailFactureDossier">
  <div class="modal-dialog modal-lg">
    <form id="form_edit_facture_en_cours" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="editerDetailFactureDossier">

      <input type="hidden" name="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_march" value="<?php echo $_GET['id_march'];?>">
      <input type="hidden" name="id_mod_fact" value="<?php echo $_GET['id_mod_fact'];?>">
      <input type="hidden" name="id_mod_trans" value="<?php echo $_GET['id_mod_trans'];?>">
      <input type="hidden" name="num_lic" value="<?php echo $_GET['num_lic'];?>">
      <input type="hidden" name="id_dos_edit" id="id_dos_edit">
      <input type="hidden" name="ref_fact_edit" id="ref_fact_edit">

    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Details <span id="label_ref_dos" class="badge badge-primary"></span> </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Rate</label>
              <input type="number" step="0.0001" class="form-control form-control-sm" name="roe_decl" id="roe_decl_edit" onblur="maj_roe_decl(id_dos_edit.value, this.value); detail_invoice_acid(ref_fact_edit.value);">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Horse</label>
              <input type="text" class="form-control form-control-sm" name="horse" id="horse_edit" onblur="maj_horse(id_dos_edit.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Trailer 1</label>
              <input type="text" class="form-control form-control-sm" name="trailer_1" id="trailer_1_edit" onblur="maj_trailer_1(id_dos_edit.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Trailer 2</label>
              <input type="text" class="form-control form-control-sm" name="trailer_2" id="trailer_2_edit" onblur="maj_trailer_2(id_dos_edit.value, this.value)">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Weight</label>
              <input type="number" step="0.0001" class="form-control form-control-sm" name="poids" id="poids_edit" onblur="maj_poids(id_dos_edit.value, this.value)">
            </div>
          </div>
        </div>
        <div class="row">

          <div class="col-md-12">
            <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
              <thead>
                  <tr>
                      <th colspan="2">ITEMS</th>
                      <th>% / Qty</th>
                      <th>AMOUNT</th>
                      <th>CURRENCY</th>
                      <th>TVA</th>
                  </tr>
              </thead>
              <tbody id="detail_facture_dossier">
                <?php
                  // $maClasse-> getDeboursPourFactureClientModeleLicence($_GET['id_cli'], $_GET['id_mod_lic_fact'], $_GET['id_march'], $_GET['id_mod_trans']);
                ?>
              </tbody>
            </table>
          </div>

        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-xs btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-xs btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>


  <?php include("pied.php");?>

<script type="text/javascript">

  $(document).ready(function(){
    liste_ref_fact_non_validee();
  });

  function liste_ref_fact_non_validee(){

    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'liste_ref_fact_non_validee', id_cli: '<?php echo $_GET['id_cli'];?>', id_mod_trans: '<?php echo $_GET['id_mod_trans'];?>', id_mod_lic: '<?php echo $_GET['id_mod_lic_fact'];?>'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#liste_ref_fact_non_validee').html(data.liste_ref_fact_non_validee);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
    
  }

  function detail_invoice_acid(ref_fact){

    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'detail_invoice_acid', ref_fact: ref_fact},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#detail_invoice_acid').html(data.detail_invoice_acid);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
    
  }

  function creer_facture_en_cours(ref_fact, id_mod_fact, id_cli, id_mod_lic, id_mod_trans) {
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_cli: id_cli, id_mod_lic: id_mod_lic, ref_fact:ref_fact, id_mod_fact:id_mod_fact, id_mod_trans:id_mod_trans, operation: 'creer_facture_en_cours'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          liste_ref_fact_non_validee();
          $('#modal_creer_facture_en_cours').modal('hide');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }

  function modal_creer_facture_en_cours(id_cli, id_mod_lic, id_march, id_mod_trans) {
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_cli: id_cli, id_mod_lic: id_mod_lic, id_march:id_march, id_mod_trans:id_mod_trans, operation: 'modal_creer_facture_en_cours'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#ref_fact_new').val(data.ref_fact);
          $('#modal_creer_facture_en_cours').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });
  }

  function supprimerDetailFactureDossier2(id_dos, ref_fact, ref_dos, id_cli, id_mod_lic, id_march, id_mod_trans, num_lic) {
    if(confirm('Do really you want to cancel '+ref_dos+' ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_dos: id_dos, id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, num_lic: num_lic, operation: 'supprimerDetailFactureDossier2'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            detail_invoice_acid(ref_fact);
            $('#id_dos').html(data.ref_dos);
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }
  }

  function modalEditDetailFactureDossier(id_dos, ref_fact, ref_dos, id_cli, id_mod_lic, id_march, id_mod_trans, num_lic, ref_fact) {
    // if(confirm('Do really you want to cancel '+ref_dos+' ?')) {
      $('#spinner-div').show();
      $.ajax({
        type: "POST",
        url: "ajax.php",
        data: { id_dos: id_dos, id_cli: id_cli, id_mod_lic: id_mod_lic, id_march: id_march, id_mod_trans: id_mod_trans, num_lic: num_lic, ref_fact: ref_fact, operation: 'modalEditDetailFactureDossier'},
        dataType:"json",
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#detail_facture_dossier').html(data.detail_facture_dossier);
            $('#id_dos_edit').val(id_dos);
            $('#ref_fact_edit').val(ref_fact);
            $('#label_ref_dos').html(ref_dos);
            $('#horse_edit').val(data.horse);
            $('#trailer_1_edit').val(data.trailer_1);
            $('#trailer_2_edit').val(data.trailer_2);
            $('#roe_decl_edit').val(data.roe_decl);
            $('#poids_edit').val(data.poids);
            $('#modalEditDetailFactureDossier').modal('show');
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    // }
  }

  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function getTableauImportInvoiceSingle(id_mod_fact, id_dos, id_mod_lic, id_march, id_mod_trans, consommable){
    $('#spinner-div').show();
    $.ajax({
      type: "POST",
      url: "ajax.php",
      data: { id_mod_fact: id_mod_fact, id_dos: id_dos, id_mod_lic: id_mod_lic, id_march:id_march, id_mod_trans:id_mod_trans, consommable:consommable, operation: 'getTableauImportInvoiceSingle'},
      dataType:"json",
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // alert('Hello');
          $('#id_mon').html(data.id_mon);
          $('#mon_fob').html(data.mon_fob);
          $('#mon_fret').html(data.mon_fret);
          $('#mon_assurance').html(data.mon_assurance);
          $('#mon_autre_frais').html(data.mon_autre_frais);
          // $('#id_mon').html(data.id_mon);
          $('#fob').val(data.fob);
          $('#fret').val(data.fret);
          $('#assurance').val(data.assurance);
          $('#autre_frais').val(data.autre_frais);
          $('#cif').val(data.cif);
          $('#roe_decl').val(data.roe_decl);
          $('#roe_inv').val(data.roe_inv);
          $('#commodity').val(data.commodity);
          // $('#truck').val(data.truck);
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
          calculTresco();
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){

      $('#enregistrerFactureImportShalina_form').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          if ($('#ref_fact').val()===null || $('#ref_fact').val()==='' ) {

            alert('Error !! Please select the invoice.');

          }else if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {

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
                  // $( '#enregistrerFactureImportShalina_form' ).each(function(){
                  //     this.reset();
                  // });
                  $('#horse').val('');
                  // $('#roe_decl').val('');
                  $('#trailer_1').val('');
                  $('#trailer_1').val('');
                  $('#id_dos').html(data.ref_dos);
                  detail_invoice_acid(fd.get('ref_fact'));
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  alert(data.message);
                  // window.open('viewImportInvoiceSingle2023.php?ref_fact='+fd.get('ref_fact'),'pop1','width=1000,height=800');
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

  $(document).ready(function(){

      $('#form_edit_facture_en_cours').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

          if ($('#ref_fact').val()===null || $('#ref_fact').val()==='' ) {

            alert('Error !! Please select the invoice.');

          }else if ($('#id_dos_edit').val()===null || $('#id_dos_edit').val()==='' ) {

            alert('Error !! Please select the file.');

          }else{
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
                  $('#horse').val('');
                  $('#roe_decl').val('');
                  $('#trailer_1').val('');
                  $('#trailer_1').val('');
                  $('#id_dos').html(data.ref_dos);
                  detail_invoice_acid(fd.get('ref_fact_edit'));
                  $('#spinner-div').hide();//Request is complete so hide spinner
                  // alert(data.message);
                  $('#modalEditDetailFactureDossier').modal('hide');
                }
              },
              complete: function () {
                  $('#spinner-div').hide();//Request is complete so hide spinner
              }
            });

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

    if (parseFloat($('#ddi_2').val()) > 0 ) {
      ddi_2 = parseFloat($('#ddi_2').val());
    }else{
      ddi_2=0;
    }

    if (parseFloat($('#ddi_3').val()) > 0 ) {
      ddi_3 = parseFloat($('#ddi_3').val());
    }else{
      ddi_3=0;
    }

    if (parseFloat($('#ddi_4').val()) > 0 ) {
      ddi_4 = parseFloat($('#ddi_4').val());
    }else{
      ddi_4=0;
    }

    if (parseFloat($('#roe_decl').val()) > 0 ) {
      roe_decl = parseFloat($('#roe_decl').val());
    }else{
      roe_decl=0;
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

    if (parseFloat($('#rri').val()) > 0 ) {
      rri = parseFloat($('#rri').val());
    }else{
      rri=0;
    }

    if (parseFloat($('#cog').val()) > 0 ) {
      cog = parseFloat($('#cog').val());
    }else{
      cog=0;
    }

    if (parseFloat($('#rls').val()) > 0 ) {
      rls = parseFloat($('#rls').val());
    }else{
      rls=0;
    }

    // fpi = (cif_cdf+ddi)*0.0184;
    // rri = (cif_cdf*0.0225);
    // cog = (cif_cdf*0.00457);
    
    // rls = 85*unite_rls*roe_decl;

    // autres_taxes = montant_liq-(ddi+fpi+rri+cog+dci+rls+tva+ddi_2+ddi_3+ddi_4);

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
      $('#autres_taxes').val(autres_taxes.toFixed(0));
    }else{
      $('#autres_taxes').val('');
    }
    if (Math.round(frais_bancaire*1000)/1000 > 0) {
      
      $('#frais_bancaire').val(frais_bancaire.toFixed(2));
      
    }else{
      $('#frais_bancaire').val('');
    }


  }

  function calculTresco(){

    if (parseFloat($('#poids').val()) > 0 ) {
      poids = parseFloat($('#poids').val());
    }else{
      poids=0;
    }

    tresco = (poids*0.5)+15;


    if (Math.round(tresco*1000)/1000 > 0) {
      $('#tresco').val(tresco.toFixed(2));
    }else{
      $('#tresco').val('');
    }

  }

  function getTotal(){

  }
</script>
