<?php
  include("tete.php");
  include("menuHaut.php");
  include("menuGauche.php");

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
            <!-- <img src="../images/calculator.png" width="25px" /> -->
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo $maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']).' DEBIT NOTE DASHBOARD ';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'TABLEAU DE BORD FACTURE '.$maClasse-> getNomModeleLicence($_GET['id_mod_lic_fact']);
              }
            ?>
            <span class="float-right">
              <!-- <button class="btn btn-xs btn-info" ></button> -->
              <div class="btn-group">
                <button type="button" class="btn btn-xs btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-upload"></i> Uplaod Expenses
                </button>
                <div class="dropdown-menu">
                  <?php
                   $maClasse-> getListeUploadDepense();
                  ?>
                </div>
              </div>
            </span>
          </h5>
          <div class="pull-right">
            <!-- <button class="btn btn-xs btn-dark square-btn-adjust" data-toggle="modal" data-target=".rechercheClient">
                <i class="fa fa-filter"></i> Filtrage
            </button> -->
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-primary">
              <div class="inner">
                <h5>
                  <span id="nbre_note_debit"></span>
                </h5>

                <p> 
                  Reporting - Debit Note Summary
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_factures"></a>
              
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-info">
              <div class="inner">
                <h5>
                  <span id="nbre_note_debit_per_file"></span>
                </h5>

                <p> 
                  Reporting - As Per Files Cleared
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_note_debit_per_file"></a>
              
            </div>

            <!-- /.info-box -->
          </div>
        
          <div class="col-md-3 col-sm-6 col-12">

            <div class="small-box bg-danger">
              <div class="inner">
                <h5>
                  <span id="nbre_depenses"></span>
                </h5>

                <p> 
                  <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Expenses pending invoicing';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Depenses non-facturees';
                  }
                  ?> 
                </p>
              </div>
              <div class="icon">
                <i class="fas fa-copy"></i>
              </div>
              <a href="#" class="small-box-footer" id="btn_info_depense"></a>
              
            </div>

            <!-- /.info-box -->
          </div>
        
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>

<div class="modal fade" id="modal_upload_depense">
  <div class="modal-dialog modal-sm">
    <form id="form_upload_depense" method="POST" action="" data-parsley-validate enctype="multipart/form-data">
      <input type="hidden" name="operation" value="upload_depense">
      <input type="hidden" name="id_dep" id="id_dep">
    <div class="modal-content">
      <div class="modal-header ">
        <h4 class="modal-title"><i class="fa fa-upload"></i> Upload</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="x_card_code" class="control-label mb-1"><span id="nom_dep"></span> Expenses File</label>
          <input name="fichier" type="file" class="form-control form-control-sm cc-exp" required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-danger btn-xs" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary btn-xs">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

    $('#form_upload_depense').submit(function(e){

            e.preventDefault();

      if(confirm('Do really you want to submit ?')) {

          $('#modal_upload_depense').modal('hide');
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
              }else{
                $( '#form_upload_depense' ).each(function(){
                    this.reset();
                });
              }
            },
            complete: function () {
                afficherMonitoringNoteDebit(<?php echo $_GET['id_mod_lic_fact'];?>);
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });


      }

    });
  
  });

  function modal_upload_depense(id_dep, nom_dep){

    $('#id_dep').val(id_dep);
    $('#nom_dep').html(nom_dep);
    $('#modal_upload_depense').modal('show');

  }

  $(document).ready(function(){
    afficherMonitoringNoteDebit(<?php echo $_GET['id_mod_lic_fact'];?>);
  });

  function afficherMonitoringNoteDebit(id_mod_lic, debut=null, fin=null){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'afficherMonitoringNoteDebit', id_mod_lic: id_mod_lic, debut: debut, fin: fin},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          $('#label_monitoring').html('Report between '+debut+' and '+fin);
          $('#nbre_note_debit').html(data.nbre_note_debit);
          $('#nbre_note_debit_per_file').html(data.nbre_note_debit_per_file);
          $('#nbre_depenses').html(data.nbre_depenses);
          $('#btn_info_note_debit_per_file').html(data.btn_info_note_debit_per_file);
          $('#btn_info_depense').html(data.btn_info_depense);
          // $('#nbre_dossier_facture').html(data.nbre_dossier_facture);
          // $('#btn_info_dossiers_factures').html(data.btn_info_dossiers_factures);
          // $('#afficherMonitoringNoteDebit').html(data.afficherMonitoringNoteDebit);
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }


</script>
