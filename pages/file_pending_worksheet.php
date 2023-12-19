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
      <div class="container-fluid">
        <div class="header">
          <h5><i class="fa fa-calculator nav-icon"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Worksheet | '.$maClasse-> getNomClient($_GET['id_cli']);
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Feuille de calcul | '.$maClasse-> getNomClient($_GET['id_cli']);
              }
            ?>
          <div class="float-right">
            <button class="btn btn-info btn-sm" onclick="window.location.replace('list_worksheet.php?id_cli=<?php echo $_GET['id_cli'];?>&id_mod_lic=<?php echo $_GET['id_mod_lic'];?>');"><i class="fa fa-list"></i> Worksheet List</button>
          </div>

          </h5>
        </div>

      </div><!-- /.container-fluid -->

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
                 <span style="color: #CCCC00;" class="badge " id="nbre_invoice_pending_validation"></span> Pending
                </h5>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0 small">
                <table id="dossier_pending_worsheet" class=" table table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                    <tr class="">
                      <th style="" width="5%">#</th>
                      <th style="">Ref.Dossier</th>
                      <th style="">Client</th>
                      <th style="">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                   
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
  ?>

<div class="modal fade" id="modal_worksheet">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header bg bg-dark">
        <h4 class="modal-title"><i class="fa fa-calculator"></i> Feuille de calcul </h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

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

          <div class="col-md-12 table-responsive p-0 small">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm small text-nowrap table-head-fixed ">
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
                        <td><input type="text" placeholder="Position Tarifaire" style="width: 12em;" name="code_tarif_march" required></td>
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
          
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
        <button type="submit" name="creerAV" class="btn btn-primary">Valider</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<script type="text/javascript">

  function valider_worksheet(id_dos){

    if(confirm('Do really you want to submit ?')) {

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'valider_worksheet', id_dos: id_dos},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
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

          $('#coef_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(coef*100)/100));
          $('#coef_worsheet').addClass('text-red font-weight-bold');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

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

 function modal_worksheet(id_dos){
  $('#spinner-div').show();

  $.ajax({
    type: 'post',
    url: 'ajax.php',
    data: {operation: 'modal_worksheet', id_dos: id_dos},
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
        getSommeMarchandiseDossier(id_dos);
        $('#modal_worksheet').modal('show');
      }
    },
    complete: function () {
        $('#spinner-div').hide();//Request is complete so hide spinner
    }
  });

  }

  $('#dossier_pending_worsheet').DataTable({
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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "dossier_pending_worsheet"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"code_cli"},
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  $('#dossier_worsheet_waiting_validation').DataTable({
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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "dossier_worsheet_waiting_validation"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"code_cli"},
      {"data":"date_feuil_calc"},
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

  $('#dossier_worsheet_validated').DataTable({
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
          "id_cli": "<?php echo $_GET['id_cli'];?>",
          "id_mod_lic": "<?php echo $_GET['id_mod_lic'];?>",
          "operation": "dossier_worsheet_validated"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"ref_dos"},
      {"data":"code_cli"},
      {"data":"date_feuil_calc"},
      {"data":"date_verif_feuil_calc"},
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] 
  });

</script>
