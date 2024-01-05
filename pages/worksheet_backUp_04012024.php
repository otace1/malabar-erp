<?php
  // include("tete.php");
  include("tetePopCDN.php");
  include("menuHaut.php");
  include("menuGauche.php");
  //include("licenceExcel.php");

?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

    </section>
    <?php

    if( isset($_POST['supprimerFacture']) ){
     $maClasse-> supprimerFactureDossier($_POST['ref_fact']);
      ?>
        <div class="alert alert-danger alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <strong>Successful operation!</strong> Invoice <b><?php echo $_POST['ref_fact'];?></b> deleted successfully.
        </div>
      <?php
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
                 <i class="fa fa-calculator nav-icon"></i> <?php
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Worksheet | '.$maClasse-> getDossier($_GET['id_dos'])['ref_dos'];
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Feuille de calcul | '.$maClasse-> getDossier($_GET['id_dos'])['ref_dos'];
                    }
                  ?>
                </h5>

                <div class="float-right">
                  <button class="btn btn-primary btn-sm" onclick="window.open('generateurWorksheet.php?id_dos=<?php echo $_GET['id_dos'];?>&ref_dos=<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>','Feuille de calcul <?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>', 'width=1000,height=800');"><i class="fa fa-file"></i> Feuille de calcul</button>
                  <button class="btn btn-warning btn-sm" onclick="window.location.replace('file_pending_worksheet.php?id_cli=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_cli'];?>&id_mod_lic=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_mod_lic'];?>');"><i class="fa fa-exclamation-triangle"></i> Pending Files</button>
                  <button class="btn btn-info btn-sm" onclick="window.location.replace('list_worksheet.php?id_cli=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_cli'];?>&id_mod_lic=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_mod_lic'];?>');"><i class="fa fa-list"></i> Worksheet List</button>
                </div>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                
                <!--  --  -- -->

          <div class="col-md-12">

            <div class="row">
              <div class="col-md-4">
                <table class=" table  table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <tbody>
                    <tr>
                      <td>MCA File Ref.</td>
                      <td><span id="ref_dos"></span></td>
                    </tr>
                    <tr>
                      <td>Incoterm</td>
                      <td><input type="text" id="incoterm" onblur="maj_incoterm(id_dos_worsheet.value, this.value);"></td>
                    </tr>
                    <tr>
                      <td>Regime</td>
                      <td><span id="regime"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-8">
                <table class=" table  table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <tbody>
                   <tr>
                     <td>Fob Général</td>
                     <td><span id="fob_worksheet"></span></td>
                     <input type="hidden" id="fob">
                   </tr>
                   <tr>
                     <td>Fret</td>
                     <td><span id="fret_worsheet"></span></td>
                     <input type="hidden" id="fret">
                   </tr>
                   <tr>
                     <td>Autres Charges</td>
                     <td><span id="autre_frais_worsheet"></span></td>
                     <input type="hidden" id="autre_frais">
                   </tr>
                   <tr>
                     <td>Assurance</td>
                     <td><span id="assurance_worksheet"></span></td>
                     <input type="hidden" id="assurance">
                   </tr>
                   <tr>
                     <td>CIF</td>
                     <td><span id="cif_worsheet"></span></td>
                     <input type="hidden" id="cif">
                   </tr>
                   <tr>
                     <td>Coefficient</td>
                     <td><span id="coef_worsheet"></span></td>
                     <input type="hidden" id="coef">
                   </tr>
                   <tr>
                     <td>Licence</td>
                     <td><span id="num_lic"></span></td>
                   </tr>
                   <tr>
                     <td>Taux de change</td>
                     <td><input type="number" step="0.0001" id="roe_feuil_calc" onblur="maj_roe_feuil_calc(id_dos_worsheet.value, this.value);"></td>
                   </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>

          <div class="col-md-12 table-responsive p-0">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm text-nowrap table-head-fixed ">
              <thead>
                  <tr>
                      <th>#</th>
                      <th>Description sur facture</th>
                      <th>N.BIVAC</th>
                      <th>N.Facture</th>
                      <!-- <th>N.</th> -->
                      <th>Position Tarifaire</th>
                      <!-- <th>AV</th> -->
                      <th>ORG</th>
                      <th>PROV</th>
                      <th>Code Add</th>
                      <th>Colis</th>
                      <!-- <th>Qte</th> -->
                      <th>Poids</th>
                      <th>FOB Par Article</th>
                      <th>Coef</th>
                      <th>CIF Par Article</th>
                      <th>Taux DDI</th>
                      <th>DDI en CDF</th>
                  </tr>
              </thead>
              <tbody id="marchandiseDossier">
                
              </tbody>

          <form method="POST" id="form_creerWorksheet" action="">
                    <input type="hidden" name="id_dos" id="id_dos_worsheet">
                    <input type="hidden" name="operation" value="creerWorksheet">
                    <tr>
                        <td></td>
                        <td><textarea class="form-control form-control-sm" name="nom_march" id="nom_march" placeholder="Description sur la facture" required></textarea></td>
                        <td><input type="text" placeholder="N° BIVAC" name="num_av" id="ref_crf" required></td>
                        <td><input type="text" placeholder="N° Facture" name="ref_fact" id="ref_fact" style="width: 15em;" required></td>
                        <td>
                          <input type="text" placeholder="Position Tarifaire" style="width: 15em;" name="code_tarif_march" id="code_tarif_march" required>
                          <span onclick="$('#modal_code_tarifaire').modal('show');"><i class="fa fa-search"></i></span>
                        </td>
                        <td><input type="text" placeholder="Origine" style="width: 8em;" name="origine" required></td>
                        <td><input type="text" placeholder="Provenance" style="width: 8em;" name="provenance" required></td>
                        <td><input type="text" placeholder="Code Additionnel" style="width: 8em;" name="code_add" required></td>
                        <td><input type="number" placeholder="Qte" style="width: 5em;" name="nbr_bags" step="0.01" required></td>
                        <td><input type="number" placeholder="Poids" style="width: 8em;" name="poids" step="0.01" required></td>
                        <td><input type="number" placeholder="FOB" style="width: 8em;" name="fob" step="0.01" required></td>
                        <td><button class="btn btn-xs btn-primary" type="submit"><i class="fa fa-check"></i></button></td>
                    </tr>
                  </form>
            </table>
          </div>
          
                <!--  --  -- -->

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
  ?>

<div class="modal fade " id="modal_code_tarifaire">
  <div class="modal-dialog modal-lg">
    <!-- <form method="POST" id="form_" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="">
      <input type="hidden" id="id_pv_acte" name="id_pv_acte">
    <div class="modal-content">
      
      <div class="modal-body">
    
        <div class="card-body table-responsive p-0 small">
          <table id="code_tarifaire_ajax" width="100%" class=" table table-bordered table-hover  table-sm">
            <thead>
              <tr>
                <!-- <th style="" width="5%">#</th> -->
                <th style="">Code</th>
                <th style="">Description</th>
                <th style="">DDI</th>
                <th style="">TVA</th>
                <th style="">DCI</th>
                <th style="">DCL</th>
                <th style="">TPI</th>
              </tr>
            </thead>
            <tbody>
             
            </tbody>
          </table>
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

<script type="text/javascript">

  $('#code_tarifaire_ajax').DataTable({
     lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i>',
          className: 'btn btn-success'
        }
    ],
  "paging": true,
  "lengthChange": true,
  "searching": true,
  "ordering": true,
  "info": true,
  "autoWidth": true,
  // "responsive": true,
    "ajax":{
      "type": "GET",
      "url":"ajax.php",
      "method":"post",
      "dataSrc":{
          "id_cli": ""
      },
      "data": {
          "operation": "code_tarifaire_ajax"
      }
    },
    "columns":[
      // {"data":"compteur"},
      {"data":"code_tarif"},
      {"data":"description"},
      {"data":"DDI",
        className: 'dt-body-center'
      },
      {"data":"TVA",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      },
      {"data":"DCI",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      },
      {"data":"DCL",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      },
      {"data":"TPI",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null )
      }
    ] 
  });

let table = new DataTable('#code_tarifaire_ajax');
 
table.on('click', 'tbody tr', function () {
    let data = table.row(this).data();
    $('#code_tarif_march').val(data['code_tarif']);
    $('#modal_code_tarifaire').modal('hide');
});

  $(document).ready(function(){

      $('#form_creerWorksheet').submit(function(e){

              e.preventDefault();

        if(confirm('Do really you want to submit ?')) {

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
                $('#marchandiseDossier').html(data.marchandiseDossier);
                $( '#form_creerWorksheet' ).each(function(){
                    this.reset();
                });

                $('#ref_crf').val(fd.get('num_av'));
                $('#ref_fact').val(fd.get('ref_fact'));

                getSommeMarchandiseDossier(fd.get('id_dos'));
              }
            },
            complete: function () {
                $('#dossier_pending_worsheet').DataTable().ajax.reload();
                $('#dossier_worsheet_waiting_validation').DataTable().ajax.reload();
                $("#nom_march").focus()
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function supprimerMarchandiseDossier(id_march_dos, id_dos){

    if(confirm('Do really you want to submit ?')) {

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'supprimerMarchandiseDossier', id_dos: id_dos, id_march_dos: id_march_dos},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#marchandiseDossier').html(data.marchandiseDossier);
            getSommeMarchandiseDossier(id_dos);
            $('#dossier_pending_worsheet').DataTable().ajax.reload();
            $('#dossier_worsheet_waiting_validation').DataTable().ajax.reload();
            $('#dossier_worsheet_validated').DataTable().ajax.reload();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });

    }

  }

  function maj_roe_feuil_calc(id_dos, roe_feuil_calc){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_roe_feuil_calc', id_dos: id_dos, roe_feuil_calc: roe_feuil_calc},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#marchandiseDossier').html(data.marchandiseDossier);
          getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_incoterm(id_dos, incoterm){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_incoterm', id_dos: id_dos, incoterm: incoterm},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function round(num, decimalPlaces = 0) {
    return new Decimal(num).toDecimalPlaces(decimalPlaces).toNumber();
  }

  function getSommeMarchandiseDossier(id_dos){
    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getSommeMarchandiseDossier', id_dos: id_dos},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#fob_worksheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.fob*1000)/1000));
          $('#fob_worksheet').addClass('text-primary font-weight-bold');

          fob=data.fob;
          if (parseFloat($('#fret').text()) > 0 ) {
            fret = parseFloat($('#fret').text());
          }else{
            fret=0;
          }
          if (parseFloat($('#assurance').text()) > 0 ) {
            assurance = parseFloat($('#assurance').text());
          }else{
            assurance=0;
          }
          if (parseFloat($('#autre_frais').text()) > 0 ) {
            autre_frais = parseFloat($('#autre_frais').text());
          }else{
            autre_frais=0;
          }

          cif = parseFloat(fob) + parseFloat(fret) + parseFloat(assurance) + parseFloat(autre_frais);
          coef = cif / parseFloat(fob);
          $('#coef').val(coef);

          console.log(cif);

          $('#cif_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(cif*1000)/1000));
          $('#cif_worsheet').addClass('text-success font-weight-bold');

          $('#coef_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(coef*10)/10));
          $('#coef_worsheet').addClass('text-red font-weight-bold');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  $(document).ready(function(){
    $('#spinner-div').show();

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_worksheet', id_dos: <?php echo $_GET['id_dos'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#id_dos_worsheet').val(data.id_dos);
          $('#ref_dos').html(data.ref_dos);
          $('#ref_crf').val(data.ref_crf);
          $('#ref_fact').val(data.ref_fact);
          $('#incoterm').val(data.incoterm);
          $('#roe_feuil_calc').val(data.roe_feuil_calc);
          $('#regime').html(data.regime);
          $('#num_lic').html(data.num_lic);
          $('#fret_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.fret*1000)/1000));
          $('#assurance_worksheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.assurance*1000)/1000));
          $('#autre_frais_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.autre_frais*1000)/1000));
          $('#fret').html(data.fret);
          $('#assurance').html(data.assurance);
          $('#autre_frais').html(data.autre_frais);
          $('#marchandiseDossier').html(data.marchandiseDossier);
          getSommeMarchandiseDossier(<?php echo $_GET['id_dos'];?>);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });


</script>
