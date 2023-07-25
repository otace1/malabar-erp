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
            <i class="fa fa-calculator nav-icon"></i> NEW <?php if($_GET['note_debit']=='1'){echo 'DEBIT NOTE';}else{echo 'CREDIT NOTE';}?>
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
                
<!-- <form id="enregistrerFactureImportMMGAcid_form" method="POST" action="" data-parsley-validate enctype="multipart/form-data"> -->
<!-- <form method="POST" id="enregistrerFactureImportMMGAcid_form" action="" data-parsley-validate enctype="multipart/form-data"> -->
  <input type="hidden" name="operation" id="operation" value="enregistrerFactureNote">

  <div class="card-body">

    <div class="row">
      
      <input type="hidden" name="id_cli" id="id_cli" value="<?php echo $_GET['id_cli'];?>">
      <input type="hidden" name="note_debit" id="note_debit" value="<?php echo $_GET['note_debit'];?>">
      <input type="hidden" name="id_mod_lic" id="id_mod_lic" value="<?php echo $_GET['id_mod_lic_fact'];?>">
      <input type="hidden" name="id_mod_fact" id="id_mod_fact" value="9">
      <div class="col-md-3">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Invoice Ref.: </label>
          <input class="form-control form-control-sm bg bg-dark" type="text" name="ref_fact" id="ref_fact" value="<?php echo $maClasse-> buildRefFactureNoteDebitCredit($_GET['id_cli'], $_GET['note_debit']);?>" required>
          </div>

      </div>
      <div class="col-md-5">
        
          <div class="form-group">
            <label for="inputEmail3" class="col-form-label">Naration: </label>
            <textarea class="form-control form-control-sm" type="text" name="information" id="information" required></textarea>
          </div>

      </div>

      <div class="col-md-12">
        <hr>
      </div>

      <div class="col-md-12">
        <div class="row">
          <div class="col-md-4">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">File</label>
              <div class="input-group mb-6  input-group-sm">
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-info" onclick="liste_dossier_ajax();"><i class="fa fa-list"></i></button>
                </div>
              <!-- /btn-group -->
                <input type="text" id="ref_dos" class="form-control text-dark form-control-sm" disabled>
                <input type="hidden" id="id_dos" class="form-control text-dark form-control-sm">
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">Amount</label>
              <!-- /btn-group -->
              <input type="text" id="montant" class="form-control text-dark form-control-sm">
            </div>
          </div>
          <div class="col-md-2">
            <div class="form-group">
              <label for="inputEmail3" class="col-form-label">TVA</label>
              <div class="input-group mb-6  input-group-sm">
              <!-- /btn-group -->
                <select id="tva" class="form-control text-dark form-control-sm">
                  <option></option>
                  <option value="0">NO</option>
                  <option value="1">YES</option>
                </select>
                <div class="input-group-prepend">
                  <button type="button" class="btn btn-sm btn-primary" onclick="creerDetailFactureDossier(ref_fact.value, id_dos.value, 174, montant.value, tva.value, '1', id_mod_lic.value, id_mod_fact.value, id_cli.value, note_debit.value, information.value);"><i class="fa fa-check"></i></button>
                </div>
              </div>
            </div>
          </div>
          
        </div>
        <hr>
      </div>

      <div class="col-md-6">
        <label for="x_card_code" class="control-label mb-1"><u>Invoice Details</u></label>
        <table class="table table-bordered table-responsive table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed table-dark">
          <thead>
              <tr>
                  <th>#</th>
                  <th>Files</th>
                  <th>Amount($)</th>
              </tr>
          </thead>
          <tbody id="detail_invoice">
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
    <!-- <span  data-toggle="modal" data-target=".validerCotation"class="btn btn-xs btn-primary" onclick="enregistrerFactureImportMMGAcid(roe_decl.value, id_dos.value, ref_fact.value, id_deb_1.value, montant_1.value, usd_1.value, tva_1.value);">Submit</span> -->
    <button class="btn btn-xs btn-primary" onclick="closeAndSave(ref_fact.value);"><i class="fa fa-save"></i> Save and Close</button>
  </div>


<!-- -------FIN VALIDATION FORMULAIRE------- -->

<!-- </form> -->

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


<div class="modal fade" id="modal_liste_dossier">
  <div class="modal-dialog modal-md">
    <!-- <form method="POST" id="form_actePV" action="" data-parsley-validate enctype="multipart/form-data"> -->
    <div class="modal-content">
      <!-- <div class="modal-header ">
        <h4 class="modal-title"><img src="../images/presse-papiers.png" width="30px"> Account </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> -->
        <input type="hidden" id="compteur_compte2">
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 table-responsive">
            <table id="liste_dossier_ajax" cellspacing="0" width="100%" class="table hover display compact table-bordered table-striped table-sm text-nowrap small">
              <thead class="">
                <tr class="">
                  <th style="">File Ref.</th>
                </tr>
              </thead>
              <tbody id="">
                
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn-xs btn-danger" data-dismiss="modal">Close</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

  <?php include("pied.php");?>

<script type="text/javascript">
  function supprimerDetailFactureDossier3(ref_fact, id_dos){
    
      if(confirm('Do really you want to remove ?')) {
        $('#spinner-div').show();

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {ref_fact: ref_fact, id_dos: id_dos, operation: "supprimerDetailFactureDossier3"},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#detail_invoice').html(data.detail_invoice);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });
      }
  }
  
  function creerDetailFactureDossier(ref_fact, id_dos, id_deb, montant, tva, usd, id_mod_lic, id_mod_fact, id_cli, note_debit, information){
    if ($('#ref_fact').val()===null || $('#ref_fact').val()==='' ) {
      alert('Error !! Please enter the invoice ref.');
    }else if ($('#information').val()===null || $('#information').val()==='' ) {
      alert('Error !! Please enter the naration.');
    }else if ($('#id_dos').val()===null || $('#id_dos').val()==='' ) {
      alert('Error !! Please select the file.');
    }else if ($('#montant').val()===null || $('#montant').val()==='' ) {
      alert('Error !! Please enter the amount.');
    }else if ($('#tva').val()===null || $('#tva').val()==='' ) {
      alert('Error !! Please specify the vat.');
    }else{
      if(confirm('Do really you want to submit ?')) {
        $('#spinner-div').show();

        $.ajax({
          type: 'post',
          url: 'ajax.php',
          data: {ref_fact: ref_fact, id_dos: id_dos, id_deb: id_deb, montant: montant, tva: tva, usd: usd, id_mod_lic: id_mod_lic, id_mod_fact: id_mod_fact, id_cli: id_cli, note_debit: note_debit, information: information, operation: "creerDetailFactureDossier"},
          dataType: 'json',
          success:function(data){
            if (data.logout) {
              alert(data.logout);
              window.location="../deconnexion.php";
            }else{
              $('#id_dos').val('');
              $('#ref_dos').val('');
              $('#montant').val('');
              $('#tva').val('');
              $('#detail_invoice').html(data.detail_invoice);
            }
          },
          complete: function () {
              $('#spinner-div').hide();//Request is complete so hide spinner
          }
        });
      }
    }
  }

  function closeAndSave(ref_fact){
    
    if(confirm('Do really you want to close and save ?')) {
      
      window.open('viewFactureNote.php?ref_fact='+ref_fact,'pop1','width=1000,height=800');
      window.location="listerFactureDossier.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic_fact=<?php echo $_GET['id_mod_lic_fact']?>";
    }
  }

  function select_dossier(id_dos, ref_dos){
    $('#modal_liste_dossier').modal('hide');
    $('#ref_dos').val(ref_dos);
    $('#id_dos').val(id_dos);
  }

  function liste_dossier_ajax(id_cli, id_mod_lic){
    
    if ( $.fn.dataTable.isDataTable( '#liste_dossier_ajax' ) ) {
        table = $('#liste_dossier_ajax').DataTable();
    }
    else {
        table = $('#liste_dossier_ajax').DataTable( {
            paging: false
        } );
    }

    table.destroy();

    $('#liste_dossier_ajax').DataTable({
       lengthMenu: [
          [10, 100, 500, -1],
          ['10 Rows', '100 Rows', '500 Rows', 'All'],
      ],
      dom: 'Bfrtip',
      buttons: [
          // {
          //   extend: 'excel',
          //   text: '<i class="fa fa-file-excel"></i>',
          //   className: 'btn btn-success'
          // },
          // {
          //   extend: 'pageLength',
          //   text: '<i class="fa fa-list"></i>',
          //   className: 'btn btn-dark'
          // }
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
        "url":"ajax.php",
        "method":"post",
        "dataSrc":{
            "id_cli": ""
        },
        "data": {
            "operation": "liste_dossier_ajax",
            "id_cli":<?php echo $_GET['id_cli']?>,
            "id_mod_lic":<?php echo $_GET['id_mod_lic_fact']?>
        }
      },
      "columns":[
        {"data":"dossier"}
      ] 
    });

    // $('#liste_dossier_ajax').html(data.liste_compte);
    $('#modal_liste_dossier').modal('show');

  }

</script>
