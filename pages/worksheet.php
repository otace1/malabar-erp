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
                  <div class="btn-group">
                    <button type="button" class="btn btn-dark btn-xs dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <i class="fa fa-file"></i> Afficher la Feuille de calcul
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                      <a class="dropdown-item" href="#" onclick="window.open('generateurWorksheet.php?id_dos=<?php echo $_GET['id_dos'];?>&ref_dos=<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>&groupe=','Feuille de calcul <?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>', 'width=1000,height=800');"><i class="fa fa-list"></i> Feuille Brute</a>
                      <a class="dropdown-item" href="#" onclick="window.open('generateurWorksheet.php?id_dos=<?php echo $_GET['id_dos'];?>&ref_dos=<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>&groupe=tarifaire','Feuille de calcul <?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>', 'width=1000,height=800');"><i class="fa fa-object-group"></i> Gouper Par Position Tarifaire</a>
                      <a class="dropdown-item" href="#" onclick="window.open('generateurWorksheet.php?id_dos=<?php echo $_GET['id_dos'];?>&ref_dos=<?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>&groupe=code Additionnel','Feuille de calcul <?php echo $maClasse-> getDossier($_GET['id_dos'])['ref_dos'];?>', 'width=1000,height=800');"><i class="fa fa-object-group"></i> Gouper Par Code Additionnel</a>
                    </div>
                  </div>
                  <!-- <button class="btn btn-warning btn-xs" onclick="window.location.replace('file_pending_worksheet.php?id_cli=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_cli'];?>&id_mod_lic=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_mod_lic'];?>');"><i class="fa fa-exclamation-triangle"></i> Pending Files</button> -->
                  <button class="btn btn-dark btn-xs" onclick="window.location.replace('list_worksheet.php?id_cli=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_cli'];?>&id_mod_lic=<?php echo $maClasse-> getDossier($_GET['id_dos'])['id_mod_lic'];?>');"><i class="fa fa-list"></i> Worksheet List</button>
                </div>

              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                
                <!--  --  -- -->

          <div class="col-md-12">

            <div class="row">
              <div class="col-md-3">
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
                      <td><input type="text" id="regime" onblur="maj_regime(id_dos_worsheet.value, this.value);"></td>
                    </tr>
                    <?php
                        if (!empty($maClasse-> checkRegimeSuspens($_GET['id_dos']))) {
                      ?>
                    <tr>
                      <td>Duree Loyer</td>
                      <td>
                        <select id="duree_loyer" name="duree_loyer" onchange="MAJ_duree_loyer(id_dos_worsheet.value, this.value);">
                          <option value="0">0</option>
                          <option value="6">6</option>
                          <option value="12">12</option>
                        </select>
                      </td>
                    </tr>
                      <?php
                        }
                      ?>
                      <tr>
                        <td colspan="2">
                          <textarea class="form-control form-control-sm" placeholder="Note" id="note_feuille" onblur="MAJ_note_feuille(id_dos_worsheet.value, this.value);" ></textarea>
                        </td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-9">
                <table class=" table  table-bordered table-hover text-nowrap table-head-fixed table-sm">
                  <thead>
                   <tr>
                     <th>Item</th>
                     <th>Monnaie</th>
                     <th>Montant</th>
                     <th>Taux</th>
                     <th>Montant / <span id="label_mon_fob"></span></th>
                     <th>Commentaire</th>
                   </tr>
                  </thead>
                  <tbody>
                   <tr>
                     <td>Fob Général</td>
                     <td><span id="mon_fob"></span></td>
                     <td style="text-align: center;"><span id="fob_worksheet"></span></td>
                     <td>
                       <input type="number" step="0.01" name="roe_fob" style="width: 8em; text-align: center;" id="roe_fob" onblur="MAJ_roe_fob(id_dos_worsheet.value, this.value);">
                     </td>
                     <td style="text-align: center;"><span id="montant_fob"></span></td>
                     <input type="hidden" id="fob">
                   </tr>
                   <tr>
                     <td>Fret</td>
                     <td><span id="mon_fret"></span></td>
                     <td style="text-align: center;">
                       <input type="number" step="0.01" name="fret" id="fret" style="width: 8em; text-align: center;" onblur="MAJ_fret(id_dos_worsheet.value, this.value);">
                     </td>
                     <td>
                       <input type="number" step="0.01" name="roe_fret" style="width: 8em; text-align: center;" id="roe_fret" onblur="MAJ_roe_fret(id_dos_worsheet.value, this.value);">
                     </td>
                     <td style="text-align: center;"><span id="montant_fret"></span></td>
                     <td>
                       <textarea class="form-control form-control-sm" id="note_fret" onblur="MAJ_note_fret(id_dos_worsheet.value, this.value);"  placeholder="Note Fret"></textarea>
                     </td>
                   </tr>
                   <tr>
                     <td>Assurance</td>
                     <td><span id="mon_assurance"></span></td>
                     <!-- <td><span id="assurance_worksheet"></span></td>
                     <input type="hidden" id="assurance"> -->
                     <td style="text-align: center;">
                       <input type="number" step="0.01" style="width: 8em; text-align: center;" name="assurance" id="assurance" onblur="MAJ_assurance(id_dos_worsheet.value, this.value);">
                     </td>
                     <td>
                       <input type="number" step="0.01" name="roe_assurance" style="width: 8em; text-align: center;" id="roe_assurance" onblur="MAJ_roe_assurance(id_dos_worsheet.value, this.value);">
                     </td>
                     <td style="text-align: center;"><span id="montant_assurance"></span></td>
                     <td>
                       <textarea class="form-control form-control-sm" id="note_assurance" onblur="MAJ_note_assurance(id_dos_worsheet.value, this.value);"  placeholder="Note Assurance"></textarea>
                     </td>
                   </tr>
                   <tr>
                     <td>Autres Charges</td>
                     <td><span id="mon_autre_frais"></span></td>
                     <td style="text-align: center;">
                       <input type="number" step="0.01" style="width: 8em; text-align: center;" name="autre_frais" id="autre_frais" onblur="MAJ_autre_frais(id_dos_worsheet.value, this.value);">
                     </td>
                     <td style="text-align: center;">
                       <input type="number" step="0.01" name="roe_autre_frais" style="width: 8em; text-align: center;" id="roe_autre_frais" onblur="MAJ_roe_autre_frais(id_dos_worsheet.value, this.value);">
                     </td>
                     <td style="text-align: center;"><span id="montant_autre_frais"></span></td>
                     <td>
                       <textarea class="form-control form-control-sm" id="note_autre_frais" onblur="MAJ_note_autre_frais(id_dos_worsheet.value, this.value);"  placeholder="Note Autres Frais"></textarea>
                     </td>
                   </tr>
                   <tr>
                     <td>CIF</td>
                     <td></td>
                     <td style="text-align: center;"><span id="cif_worsheet"></span></td>
                     <input type="hidden" id="cif">
                   </tr>
                   <tr>
                     <td>Coefficient</td>
                     <td style="text-align: center;"></td>
                     <td style="text-align: center;"><span id="coef_worsheet"></span></td>
                     <input type="hidden" id="coef">
                   </tr>
                   <tr>
                     <td>Licence</td>
                     <td style="text-align: center;"></td>
                     <td style="text-align: center;"><span id="num_lic"></span></td>
                   </tr>
                   <tr>
                     <td>Taux de change</td>
                     <td></td>
                     <td><input type="number" step="0.0001" id="roe_feuil_calc" onblur="maj_roe_feuil_calc(id_dos_worsheet.value, this.value);"></td>
                   </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>
<!-- 
          <div class="col-md-2">
            <button class="btn btn-xs btn-primary" onclick="grouper_marchandise(id_dos_worsheet.value);">
              <i class="fa fa-object-group"></i> Grouper par Code Tarifaire
            </button>
            <hr>
          </div>
 -->
          <div class="col-md-12 table-responsive p-0" style="height: 500px;">
            <table class="table table-bordered table-striped text-nowrap table-hover table-sm text-nowrap table-head-fixed ">
              <thead>
                  <tr>
                      <th>#</th>
                      <th></th>
                      <th>Description sur facture</th>
                      <th>N.BIVAC</th>
                      <th>N.Facture</th>
                      <!-- <th>N.</th> -->
                      <th>Position Tarifaire</th>
                      <th>AV</th>
                      <th>ORG</th>
                      <th>Derniere PROV</th>
                      <th>Code Add</th>
                      <th>Colis</th>
                      <!-- <th>Qte</th> -->
                      <th>Qte</th>
                      <th>Poids</th>
                      <th>FOB Par Article</th>
                      <th>Coef</th>
                      <th>CIF Par Article</th>
                      <th>Taux DDI</th>
                      <th>DDI en CDF</th>
                      <?php
                        if (!empty($maClasse-> checkRegimeSuspens($_GET['id_dos']))) {
                      ?>
                      <th>TVA</th>
                      <th>Loyer <span id="label_duree_loyer"></span> mois</th>
                      <?php
                        }
                      ?>
                  </tr>
              </thead>
              <tbody id="marchandiseDossier">
                
              </tbody>

          <form method="POST" id="form_creerWorksheet" action="">
                    <input type="hidden" name="id_dos" id="id_dos_worsheet">
                    <input type="hidden" name="operation" value="creerWorksheet">
                    <tr>
                        <td></td>
                        <td></td>
                        <td><textarea class="form-control form-control-sm" name="nom_march" id="nom_march" placeholder="Description sur la facture" required></textarea></td>
                        <td><input type="text" placeholder="N° BIVAC" name="num_av" id="ref_crf" required></td>
                        <td><input type="text" placeholder="N° Facture" name="ref_fact" id="ref_fact" style="width: 15em;" required></td>
                        <td>
                          <input type="hidden" style="width: 15em;" name="code_tarif_march" id="code_tarif_march" required>
                          <span onclick="$('#modal_code_tarifaire').modal('show');"><i class="fa fa-search"></i></span>
                          <span id="label_code_tarif_march"></span>
                        </td>
                        <td><input type="text" placeholder="Position AV" style="width: 8em;" name="position_av" required></td>
                        <td><input type="text" placeholder="Origine" style="width: 8em;" name="origine" required></td>
                        <td><input type="text" placeholder="Provenance" style="width: 8em;" name="provenance" required></td>
                        <td><input type="text" placeholder="Code Additionnel" style="width: 8em;" name="code_add" required></td>
                        <td><input type="number" placeholder="Colis" style="width: 5em;" name="nbr_bags" step="0.01" required></td>
                        <td><input type="number" placeholder="Qte" style="width: 5em;" name="qte" step="0.01" required></td>
                        <td><input type="number" placeholder="Poids" style="width: 8em;" name="poids" step="0.01" required></td>
                        <td><input type="number" placeholder="FOB" style="width: 8em;" name="fob" id="fob_input" onkeyup="calculFOBWorksheet();" step="0.01" required></td>
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

<div class="modal fade " id="modal_edit_marchandise_dossier">
  <div class="modal-dialog modal-lg">
    <!-- <form method="POST" id="form_" action="" data-parsley-validate enctype="multipart/form-data"> -->
      <input type="hidden" name="operation" value="edit_marchandise_dossier">
      <input type="hidden" id="id_march_dos_edit" name="id_march_dos">
      <input type="hidden" id="id_dos_edit" name="id_dos">
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
  
  function MAJ_roe_fob(id_dos, roe_fob){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_fob: roe_fob, operation: 'MAJ_roe_fob'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_mon_fob').html(data.label_mon_fob);
          // $('#label_mon_cif').html(data.label_mon_fob);
          getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function MAJ_roe_fret(id_dos, roe_fret){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_fret: roe_fret, operation: 'MAJ_roe_fret'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#label_mon_fob').html(data.label_mon_fob);
          // $('#label_mon_cif').html(data.label_mon_fob);
          getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function MAJ_roe_assurance(id_dos, roe_assurance){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_assurance: roe_assurance, operation: 'MAJ_roe_assurance'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#label_mon_fob').html(data.label_mon_fob);
          // $('#label_mon_cif').html(data.label_mon_fob);
          getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function MAJ_roe_autre_frais(id_dos, roe_autre_frais){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {id_dos: id_dos, roe_autre_frais: roe_autre_frais, operation: 'MAJ_roe_autre_frais'},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#label_mon_fob').html(data.label_mon_fob);
          // $('#label_mon_cif').html(data.label_mon_fob);
          getSommeMarchandiseDossier(id_dos);
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
          $('#label_mon_fob').html(data.label_mon_fob);
          // $('#label_mon_cif').html(data.label_mon_fob);
          getSommeMarchandiseDossier(id_dos);
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
        }else{
          getSommeMarchandiseDossier(id_dos);
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
        }else{
          getSommeMarchandiseDossier(id_dos);
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
        }else{
          getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function calculFOBWorksheet(){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'calculFOBWorksheet', id_dos: <?php echo $_GET['id_dos'];?>},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          if (parseFloat($('#fob_input').val()) > 0 ) {
            fob_input = parseFloat($('#fob_input').val());
          }else{
            fob_input=0;
          }
          fob = parseFloat(data.fob)+fob_input;

          $('#fob_worksheet').html(new Intl.NumberFormat('en-US').format(Math.round(fob*1000)/1000));
          console.log(fob);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function MAJ_not_feuille(id_dos, not_feuille){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_not_feuille', id_dos: id_dos, not_feuille: not_feuille},
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

  //note_assurance
  function MAJ_note_assurance(id_dos, note_assurance){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_note_assurance', id_dos: id_dos, note_assurance: note_assurance},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  //note_fret
  function MAJ_note_fret(id_dos, note_fret){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_note_fret', id_dos: id_dos, note_fret: note_fret},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  //note_autre_frais
  function MAJ_note_autre_frais(id_dos, note_autre_frais){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_note_autre_frais', id_dos: id_dos, note_autre_frais: note_autre_frais},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  //note_feuille
  function MAJ_note_feuille(id_dos, note_feuille){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_note_feuille', id_dos: id_dos, note_feuille: note_feuille},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // getSommeMarchandiseDossier(id_dos);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function reloadMarchandiseDossier(id_dos){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'reloadMarchandiseDossier', id_dos: id_dos},
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

  function maj_march_dos_nom_march(id_march_dos, nom_march){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_nom_march', id_march_dos: id_march_dos, nom_march: nom_march},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_num_av(id_march_dos, num_av){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_num_av', id_march_dos: id_march_dos, num_av: num_av},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_ref_fact(id_march_dos, ref_fact){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_ref_fact', id_march_dos: id_march_dos, ref_fact: ref_fact},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_position_av(id_march_dos, position_av){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_position_av', id_march_dos: id_march_dos, position_av: position_av},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_origine(id_march_dos, origine){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_origine', id_march_dos: id_march_dos, origine: origine},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_provenance(id_march_dos, provenance){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_provenance', id_march_dos: id_march_dos, provenance: provenance},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_code_add(id_march_dos, code_add){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_code_add', id_march_dos: id_march_dos, code_add: code_add},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_nbr_bags(id_march_dos, nbr_bags){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_nbr_bags', id_march_dos: id_march_dos, nbr_bags: nbr_bags},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_qte(id_march_dos, qte){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_qte', id_march_dos: id_march_dos, qte: qte},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_poids(id_march_dos, poids){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_poids', id_march_dos: id_march_dos, poids: poids},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function maj_march_dos_fob(id_march_dos, fob){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_march_dos_fob', id_march_dos: id_march_dos, fob: fob},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          // $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function modal_edit_marchandise_dossier(id_march_dos, id_dos, ligne){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'modal_edit_marchandise_dossier', id_dos: id_dos, id_march_dos: id_march_dos, ligne: ligne},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#marchandiseDossier').html(data.marchandiseDossier);
          // $('#modal_edit_marchandise_dossier').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  // function modal_edit_marchandise_dossier(id_march_dos, id_dos){

  //   $.ajax({
  //     type: 'post',
  //     url: 'ajax.php',
  //     data: {operation: 'modal_edit_marchandise_dossier', id_dos: id_dos, id_march_dos: id_march_dos},
  //     dataType: 'json',
  //     success:function(data){
  //       if (data.logout) {
  //         alert(data.logout);
  //         window.location="../deconnexion.php";
  //       }else{
  //         $('#id_march_dos_edit').val(id_march_dos);
  //         $('#id_dos_edit').val(id_dos);
  //         $('#modal_edit_marchandise_dossier').modal('show');
  //       }
  //     },
  //     complete: function () {
  //         $('#spinner-div').hide();//Request is complete so hide spinner
  //     }
  //   });

  // }

  function grouper_marchandise(id_dos){

    if(confirm('This operation is irreversible, do really you want to submit ?')) {

      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'grouper_marchandise', id_dos: id_dos},
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

  }
  
  function MAJ_duree_loyer(id_dos, duree_loyer){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_duree_loyer', id_dos: id_dos, duree_loyer: duree_loyer},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#marchandiseDossier').html(data.marchandiseDossier);
          getSommeMarchandiseDossier(id_dos);
          $('#label_duree_loyer').html(duree_loyer);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }

  function MAJ_fret(id_dos, fret){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_fret', id_dos: id_dos, fret: fret},
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

  function MAJ_autre_frais(id_dos, autre_frais){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_autre_frais', id_dos: id_dos, autre_frais: autre_frais},
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

  function MAJ_assurance(id_dos, assurance){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'MAJ_assurance', id_dos: id_dos, assurance: assurance},
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
    $('#label_code_tarif_march').html(data['code_tarif']);
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
                $('#label_code_tarif_march').html('');

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

    if(confirm('Do really you want to delete this item ?')) {

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
  
  function maj_regime(id_dos, regime){

    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'maj_regime', id_dos: id_dos, regime: regime},
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
          if (data.fob > 0 ) {
            fob = data.fob;
          }else{
            fob=0;
          }
          if (parseFloat($('#fret').val()) > 0 ) {

            if (parseFloat($('#mon_fret').val()) == parseFloat($('#mon_fob').val())) {
              fret = parseFloat($('#fret').val());
            }else{
              fret = parseFloat($('#fret').val())*parseFloat($('#roe_fret').val());
            }

          }else{
            fret=0;
          }

          if (parseFloat($('#assurance').val()) > 0 ) {

            if (parseFloat($('#mon_assurance').val()) == parseFloat($('#mon_fob').val())) {
              assurance = parseFloat($('#assurance').val());
            }else{
              assurance = parseFloat($('#assurance').val())*parseFloat($('#roe_assurance').val());
            }

          }else{
            assurance=0;
          }

          if (parseFloat($('#autre_frais').val()) > 0 ) {

            if (parseFloat($('#mon_autre_frais').val()) == parseFloat($('#mon_fob').val())) {
              autre_frais = parseFloat($('#autre_frais').val());
            }else{
              autre_frais = parseFloat($('#autre_frais').val())*parseFloat($('#roe_autre_frais').val());
            }

          }else{
            autre_frais=0;
          }
          // if (parseFloat($('#fret').val()) > 0 ) {
          //   fret = parseFloat($('#fret').val());
          // }else{
          //   fret=0;
          // }
          // if (parseFloat($('#assurance').val()) > 0 ) {
          //   assurance = parseFloat($('#assurance').val());
          // }else{
          //   assurance=0;
          // }
          // if (parseFloat($('#autre_frais').val()) > 0 ) {
          //   autre_frais = parseFloat($('#autre_frais').val());
          // }else{
          //   autre_frais=0;
          // }

          cif = parseFloat(fob) + parseFloat(fret) + parseFloat(assurance) + parseFloat(autre_frais);
          if (fob>0) {
            coef = cif / parseFloat(fob);
          }else{
            coef = '';
          }
          
          $('#coef').val(coef);

          console.log(cif);
          console.log(coef);

          $('#cif_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(cif*1000)/1000));
          $('#cif_worsheet').addClass('text-success font-weight-bold');

          $('#coef_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(coef*10)/10));
          $('#coef_worsheet').addClass('text-red font-weight-bold');

          $('#montant_fob').html(new Intl.NumberFormat('en-US').format(Math.round(fob*1000)/1000));
          $('#montant_fret').html(new Intl.NumberFormat('en-US').format(Math.round(fret*1000)/1000));
          // $('#montant_fret').addClass('text-red font-weight-bold');
        
          $('#montant_assurance').html(new Intl.NumberFormat('en-US').format(Math.round(assurance*1000)/1000));
          // $('#montant_assurance').addClass('text-red font-weight-bold');
        
          $('#montant_autre_frais').html(new Intl.NumberFormat('en-US').format(Math.round(autre_frais*1000)/1000));
          // $('#montant_autre_frais').addClass('text-red font-weight-bold');
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
          $('#note_feuille').val(data.note_feuille);
          $('#note_fret').val(data.note_fret);
          $('#note_assurance').val(data.note_assurance);
          $('#note_autre_frais').val(data.note_autre_frais);
          $('#regime').val(data.regime);
          $('#num_lic').html(data.num_lic);
          $('#fret_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.fret*1000)/1000));
          $('#assurance_worksheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.assurance*1000)/1000));
          $('#autre_frais_worsheet').html(new Intl.NumberFormat('en-US').format(Math.round(data.autre_frais*1000)/1000));
          $('#fret').val(data.fret);
          $('#assurance').val(data.assurance);
          $('#autre_frais').val(data.autre_frais);
          $('#marchandiseDossier').html(data.marchandiseDossier);
          $('#duree_loyer').val(data.duree_loyer);
          $('#label_duree_loyer').html(data.duree_loyer);
          $('#mon_fob').html(data.mon_fob);
          $('#label_mon_fob').html(data.label_mon_fob);
          // console.log(data.label_mon_fob);
          $('#mon_fret').html(data.mon_fret);
          $('#mon_autre_frais').html(data.mon_autre_frais);
          $('#mon_assurance').html(data.mon_assurance);
          //roe_fob
          $('#roe_fob').val(data.roe_fob);
          //roe_fret
          $('#roe_fret').val(data.roe_fret);
          //roe_assurance
          $('#roe_assurance').val(data.roe_assurance);
          //roe_autre_frais
          $('#roe_autre_frais').val(data.roe_autre_frais);
          getSommeMarchandiseDossier(<?php echo $_GET['id_dos'];?>);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  });


</script>
