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
          <h3 class="" style="font-weight: bold;">
           <i class="fa fa-calculator nav-icon"></i>
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Directory | Bank';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Repertoire | Banque';
              }
            ?>

            <div class="float-right">
              <button class="btn btn-xs btn-primary" onclick="window.location='new_demande_fond.php';">
                <i class="fa fa-plus"></i>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'New Request';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Nouvelle Demande';
                  }
                ?>
              </button>
            </div>

          </h3>
        </div>

      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">

          <div class="col-12">
            <span id="message"></span>
          </div>

          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h5>
                  <?php
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Request Table | Bank';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Table des Requettes | Banque';
                    }
                  ?>
                </h5>
              </div>    

              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table id="demande_fond" cellspacing="0" width="100%" class=" table hover display compact table-bordered table-striped table-sm">
                  <thead>
                    <tr>
                      <th width="5%">#</th>
                      <th>No.</th>
                      <th>Date</th>
                      <th>Client</th>
                      <th>Depart.</th>
                      <th>Requestor</th>
                      <th>Category</th>
                      <th>Currency</th>
                      <th>Amount</th>
                      <th>Statut</th>
                      <th>Action</th>
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

<div class="modal fade" id="modal_afficher_df">
  <div class="modal-dialog modal-md">
   <!--  <form action="" method="POST" id="form_df">
      <input type="hidden" name="id_dos" id="id_dos_edit">
      <input type="hidden" name="operation" value="update_CVEE"> -->
    <div class="modal-content">
      <div class="modal-header">
        <input type="hidden" id="id_df_print">
        <h5 class="modal-title"><i class="fa fa-list"></i> Request Payment Detail <button class="btn btn-xs btn-primary" title="Print" onclick="window.open('generateur_demande_fond.php?id_df='+id_df_print.value+'&couleur=','pop1','width=500,height=700');"><i class="fa fa-print"></i></button></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body row">
        <div class="col-md-12">
          <!-- <span id="detail_df"></span> -->
          <table class=" table table-hover table-striped table-sm small">
            <tbody id="detail_df"></tbody>
          </table>
        </div>
      </div>
      <!-- <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </div> -->
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_visa_dept_df">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" id="form_visa_dept_df">
      <input type="hidden" name="id_df" id="id_df_visa_dept">
      <input type="hidden" name="operation" value="visa_dept_df">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-check"></i> Depart. Approval</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="a_facturer">Chargeback</label>
          <select name="a_facturer" id="a_facturer" class="form-control form-control-sm " onchange="charge_back();" required>
            <option></option>
            <option value="1">Yes</option>
            <option value="0">No</option>
          </select>
        </div>
        <div class="form-group" id="montant_fact_group">
          
        </div>
        <div class="form-group" id="fichier_fact_group">
          
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_search">
  <div class="modal-dialog modal-md small">
    <!-- <form action="" method="POST" id="form_reject_dept_df"> -->
      <!-- <input type="hidden" name="id_df" id="id_df_reject_dept">
      <input type="hidden" name="operation" value="reject_dept_df"> -->
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-times"></i> Refusal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12"><u><b>Create Date</b></u></div>
          <div class="col-md-6">
            <label for="date_create_debut_search">From</label>
            <input type="date" name="date_create_debut_search" id="date_create_debut_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-6">
            <label for="date_create_fin_search">To</label>
            <input type="date" name="date_create_fin_search" id="date_create_fin_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-12"><u><b>Department Approval</b></u></div>
          <div class="col-md-6">
            <label for="date_visa_dept_debut_search">From</label>
            <input type="date" name="date_visa_dept_debut_search" id="date_visa_dept_debut_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-6">
            <label for="date_visa_dept_fin_search">To</label>
            <input type="date" name="date_visa_dept_fin_search" id="date_visa_dept_fin_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-12"><u><b>Finance Approval</b></u></div>
          <div class="col-md-6">
            <label for="date_visa_fin_debut_search">From</label>
            <input type="date" name="date_visa_fin_debut_search" id="date_visa_fin_debut_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-6">
            <label for="date_visa_fin_fin_search">To</label>
            <input type="date" name="date_visa_fin_fin_search" id="date_visa_fin_fin_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-12"><u><b>Payment</b></u></div>
          <div class="col-md-6">
            <label for="date_decaiss_debut_search">From</label>
            <input type="date" name="date_decaiss_debut_search" id="date_decaiss_debut_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-6">
            <label for="date_decaiss_fin_search">To</label>
            <input type="date" name="date_decaiss_fin_search" id="date_decaiss_fin_search" class="form-control form-control-sm ">
          </div>
          <div class="col-md-12">
            <label for="statut_search">Status</label>
            <select name="statut_search" id="statut_search" class="form-control form-control-sm ">
              <option></option>
              <option value="Awaiting Dept. Approval">Awaiting Dept. Approval</option>
              <option value="Awaiting chargeback Approval">Awaiting chargeback Approval</option>
              <option value="Awaiting Finance Approval">Awaiting Finance Approval</option>
              <option value="Pending payment">Pending payment</option>
              <option value="Paid">Paid</option>
              <option value="Rejected">Rejected</option>
            </select>
          </div>
        </div>
        <!-- <div class="form-group">
          
        </div> -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-sm btn-primary" onclick="window.open('popUpRapportPay.php?statut='+statut_search.value+'&date_create_debut='+date_create_debut_search.value+'&date_create_fin='+date_create_fin_search.value+'&date_visa_dept_debut='+date_visa_dept_debut_search.value+'&date_visa_dept_fin='+date_visa_dept_fin_search.value+'&date_visa_fin_debut='+date_visa_fin_debut_search.value+'&date_visa_fin_fin='+date_visa_fin_fin_search.value,'pop1','width=1300,height=900')">Submit</button>
      </div>
    </div>
    <!-- </form> -->
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_reject_dept_df">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" id="form_reject_dept_df">
      <input type="hidden" name="id_df" id="id_df_reject_dept">
      <input type="hidden" name="operation" value="reject_dept_df">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-times"></i> Refusal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="motif_reject_dept">Reason for Refusal</label>
          <textarea name="motif_reject_dept" id="motif_reject_dept" class="form-control form-control-sm "></textarea>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<div class="modal fade" id="modal_decaiss_df">
  <div class="modal-dialog modal-sm">
    <form action="" method="POST" id="form_decaiss_df">
      <input type="hidden" name="id_df" id="id_df_decaiss">
      <input type="hidden" name="operation" value="decaiss_df">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fa fa-check"></i> Payment</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label for="ref_decaiss">Voucher Ref.</label>
          <input type="text" name="ref_decaiss" id="ref_decaiss" class="form-control form-control-sm " required>
        </div>
        <div class="form-group">
          <label for="montant_decaiss">Amount</label>
          <input type="number" step="0.0001" name="montant_decaiss" id="montant_decaiss" class="form-control form-control-sm " required>
        </div>
        <div class="form-group">
          <label for="nom_recep_fond">Receipt By</label>
          <input type="text" name="nom_recep_fond" id="nom_recep_fond" class="form-control form-control-sm " required>
        </div>
        <div class="form-group">
          <label for="fichier_decaiss">Voucher File</label>
          <input type="file" name="fichier_decaiss" id="fichier_decaiss" class="form-control form-control-sm " required>
        </div>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-sm btn-danger" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
      </div>
    </div>
    </form>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>

<script type="text/javascript">

  $(document).ready(function(){

      $('#form_reject_dept_df').submit(function(e){

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
                $('#message').html(data.message);
                // $( '#form_reject_dept_df' ).each(function(){
                //     this.reset();
                // });
              }
            },
            complete: function () {
                $('#modal_reject_dept_df').modal('hide');
                modal_afficher_df(fd.get('id_df'));
                $('#demande_fond').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  $(document).ready(function(){

      $('#form_decaiss_df').submit(function(e){

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
                $('#message').html(data.message);
                // $( '#form_decaiss_df' ).each(function(){
                //     this.reset();
                // });
              }
            },
            complete: function () {
                $('#modal_decaiss_df').modal('hide');
                modal_afficher_df(fd.get('id_df'));
                $('#demande_fond').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function modal_decaiss_df(id_df){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: id_df},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          charge_back();
          $('#id_df_decaiss').val(id_df);
          $('#modal_decaiss_df').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function ok_visa_fin_df(id_df){
    if(confirm('Do really you want to approve ?')) {
      $('#spinner-div').show();
      // $('#modal_afficher_df').modal('hide');
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'ok_visa_fin_df', id_df: id_df},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#message').html(data.message);
            $('#modal_afficher_df').modal('hide');
            $('#demande_fond').DataTable().ajax.reload();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }

  }
  
  function ok_visa_dir_df(id_df){
    if(confirm('Do really you want to approve ?')) {
      $('#spinner-div').show();
      // $('#modal_afficher_df').modal('hide');
      $.ajax({
        type: 'post',
        url: 'ajax.php',
        data: {operation: 'ok_visa_dir_df', id_df: id_df},
        dataType: 'json',
        success:function(data){
          if (data.logout) {
            alert(data.logout);
            window.location="../deconnexion.php";
          }else{
            $('#message').html(data.message);
            $('#modal_afficher_df').modal('hide');
            $('#demande_fond').DataTable().ajax.reload();
          }
        },
        complete: function () {
            $('#spinner-div').hide();//Request is complete so hide spinner
        }
      });
    }

  }
  
  $(document).ready(function(){

      $('#form_visa_dept_df').submit(function(e){

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
                $('#message').html(data.message);
                // $( '#form_visa_dept_df' ).each(function(){
                //     this.reset();
                // });
              }
            },
            complete: function () {
                $('#modal_visa_dept_df').modal('hide');
                modal_afficher_df(fd.get('id_df'));
                $('#demande_fond').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  $(document).ready(function(){

      $('#form_visa_dept_df').submit(function(e){

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
                $('#message').html(data.message);
                // $( '#form_visa_dept_df' ).each(function(){
                //     this.reset();
                // });
              }
            },
            complete: function () {
                $('#modal_visa_dept_df').modal('hide');
                modal_afficher_df(fd.get('id_df'));
                $('#demande_fond').DataTable().ajax.reload();
                $('#spinner-div').hide();//Request is complete so hide spinner
            }
          });

        }

      });
    
  });

  function charge_back() {
    
    if($('#a_facturer').val()=='1'){
      $('#montant_fact_group').html('<label for="montant_fact">Amount to be Charged back</label><input type="number" step="0.01" name="montant_fact" id="montant_fact" class="form-control form-control-sm" required>');
      $('#fichier_fact_group').html('<label for="fichier_fact">Support Document</label><input type="file" name="fichier_fact" id="fichier_fact" class="form-control form-control-sm" required>');
    }else{
      $('#montant_fact_group').html('');
      $('#fichier_fact_group').html('');
    }

  }

  function modal_reject_dept_df(id_df){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: id_df},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          charge_back();
          $('#id_df_reject_dept').val(id_df);
          $('#modal_reject_dept_df').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function modal_visa_dept_df(id_df){
    $('#spinner-div').show();
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: id_df},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{
          charge_back();
          $('#id_df_visa_dept').val(id_df);
          $('#modal_visa_dept_df').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  function modal_afficher_df(id_df){
    $('#spinner-div').show()
    $.ajax({
      type: 'post',
      url: 'ajax.php',
      data: {operation: 'getDemandeFond', id_df: id_df},
      dataType: 'json',
      success:function(data){
        if (data.logout) {
          alert(data.logout);
          window.location="../deconnexion.php";
        }else{

          $('#id_df_print').val(id_df);

          btn_visa_dept_df = '';
          btn_visa_dir_df = '';
          btn_visa_fin_df = '';
          btn_decaiss_df = '';

          if(data.visa_dept_df=='1'){
            btn_visa_dept_df = '<span class=\"btn btn-xs btn-success\"\" onclick=\"modal_visa_dept_df('+data.id_df+')\"><i class=\"fa fa-check\"></i> Approve</span> <span class=\"btn btn-xs btn-danger\"\" onclick=\"modal_reject_dept_df('+data.id_df+')\"><i class=\"fa fa-times\"></i> Reject</span>';
          }
          if(data.visa_dir_df=='1'){
            btn_visa_dir_df = '<span class=\"btn btn-xs btn-success\"\" onclick=\"ok_visa_dir_df('+data.id_df+')\"><i class=\"fa fa-check\"></i> Approve</span> <span class=\"btn btn-xs btn-danger\"\" onclick=\"modal_reject_dept_df('+data.id_df+')\"><i class=\"fa fa-times\"></i> Reject</span>';
          }
          if(data.visa_fin_df=='1'){
            btn_visa_fin_df = '<span class=\"btn btn-xs btn-success\"\" onclick=\"ok_visa_fin_df('+data.id_df+')\"><i class=\"fa fa-check\"></i> Approve</span> <span class=\"btn btn-xs btn-danger\"\" onclick=\"modal_reject_dept_df('+data.id_df+')\"><i class=\"fa fa-times\"></i> Reject</span>';
          }

          if(data.decaiss_df=='1'){
            btn_decaiss_df = '<span class=\"btn btn-xs btn-success\"\" onclick=\"modal_decaiss_df('+data.id_df+')\"><i class=\"fa fa-check\"></i></span>';
          }

          if (data.id_util_reject_dept!=null){
            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-danger">Rejected</span><br><span class="text-sm text text-danger">by '+data.nom_util_reject_dept+' | '+data.date_reject_dept+' <br> '+data.motif_reject_dept+'</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Depart.Approval: </td><td><b>'+data.nom_util_visa_dept+' | '+data.date_visa_dept+'</b></td></tr><tr><td>Finance Approval: </td><td><b>'+data.nom_util_visa_fin+' | '+data.date_visa_fin+'</b></td></tr><tr><td>Paid by: </td><td><b>'+data.nom_util_decaiss+' | '+data.date_decaiss+'</b></td></tr><tr><td>Voucher Ref.: </td><td><b>'+data.ref_decaiss+' | '+data.btn_fichier_decaiss+'</b></td></tr>');
          }else if (data.date_visa_dept==null) {

            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-warning">Awaiting Departement Approval</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Action: </td><td>'+btn_visa_dept_df+'</td></tr>');

          }else if (data.date_visa_dept!=null && data.date_visa_dir==null && (data.a_facturer=='1' || data.cash=='1')) {

            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-info">Awaiting Management Approval</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td><tr><td>Chargeback: </td><td class="bg bg-warning"><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant_fact)+'</b> <b>'+data.btn_fichier_fact+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Depart.Approval: </td><td><b>'+data.nom_util_visa_dept+' | '+data.date_visa_dept+'</b></td></tr><tr><td>Action: </td><td>'+btn_visa_dir_df+'</td></tr>');

          }else if ( data.date_visa_dept!=null && ((data.date_visa_dir!=null && data.a_facturer=='1') || data.a_facturer=='0') && data.date_visa_fin==null ) {

            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-warning">Awaiting Finance Approval</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td><tr><td>Chargeback: </td><td class="bg bg-warning"><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant_fact)+'</b> <b>'+data.btn_fichier_fact+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Depart.Approval: </td><td><b>'+data.nom_util_visa_dept+' | '+data.date_visa_dept+'</b></td></tr><tr><td>Action: </td><td>'+btn_visa_fin_df+'</td></tr>');

          }else if ( data.date_visa_fin!=null && data.date_decaiss==null ) {
            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-warning">Pending Payment</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td></tr><tr><td>Chargeback: </td><td class="bg bg-warning"><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant_fact)+'</b> <b>'+data.btn_fichier_fact+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Depart.Approval: </td><td><b>'+data.nom_util_visa_dept+' | '+data.date_visa_dept+'</b></td></tr><tr><td>Finance Approval: </td><td><b>'+data.nom_util_visa_fin+' | '+data.date_visa_fin+'</b></td></tr><tr><td>Action: </td><td>'+btn_decaiss_df+'</td></tr>');
          }else{
            $('#detail_df').html('<tr><td colspan="2" class="text-center"><span class="text-sm badge badge-success">Paid</span></td></tr><tr><td>Reference: </td><td><b>'+data.id_df+'</b></td></tr><tr><td>Date: </td><td><b>'+data.date_create+'</b></td></tr><tr><td>Departement: </td><td><b>'+data.nom_dept+'</b></td></tr><tr><td>Location: </td><td><b>'+data.nom_site+'</b></td></tr><tr><td>Requestor: </td><td><b>'+data.nom_util+'</b></td></tr><tr><td>Type Payment: </td><td><b>'+data.type_payment+'</b></td></tr><tr><td>Amount: </td><td><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant)+'</b></td></tr><tr><td>Chargeback: </td><td class="bg bg-warning"><b>'+data.monnaie+' '+new Intl.NumberFormat().format(data.montant_fact)+'</b> <b>'+data.btn_fichier_fact+'</b></td></tr><tr><td>Motif: </td><td><b>'+data.libelle+'</b></td></tr><tr><td>Beneficiary: </td><td><b>'+data.beneficiaire+'</b></td></tr><tr><td>Client: </td><td><b>'+data.nom_cli+'</b></td></tr><tr><td>Support Doc.: </td><td><b>'+data.support_doc+'</b></td></tr><tr><td>Depart.Approval: </td><td><b>'+data.nom_util_visa_dept+' | '+data.date_visa_dept+'</b></td></tr><tr><td>Finance Approval: </td><td><b>'+data.nom_util_visa_fin+' | '+data.date_visa_fin+'</b></td></tr><tr><td>Paid by: </td><td><b>'+data.nom_util_decaiss+' | '+data.date_decaiss+'</b></td></tr><tr><td>Voucher Ref.: </td><td><b>'+data.ref_decaiss+' | '+data.btn_fichier_decaiss+'</b></td></tr>');
          }

          $('#modal_afficher_df').modal('show');
        }
      },
      complete: function () {
          $('#spinner-div').hide();//Request is complete so hide spinner
      }
    });

  }
  
  $('#demande_fond').DataTable({
     lengthMenu: [
        [10, 20, 50, -1],
        [10, 20, 50, 500, 'All'],
    ],
    dom: 'Bfrtip',
    buttons: [
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel"></i>',
          title: 'Payment_Request_<?php echo date('dmY');?>',
          className: 'btn btn-success'
        }
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
          "statut": "no_dept",
          "operation": "demande_fond_cash"
      }
    },
    "columns":[
      {"data":"compteur"},
      {"data":"id_df",
        className: 'dt-body-center'
      },
      // {"data":"code_cli"},
      {"data":"date_df",
        className: 'dt-body-center'
      },
      {"data":"nom_cli"},
      {"data":"nom_dept",
        className: 'dt-body-center'
      },
      {"data":"nom_util"},
      {"data":"label_cash",
        className: 'dt-body-center'
      },
      {"data":"monnaie",
        className: 'dt-body-center'
      },
      {"data":"montant",
        className: 'dt-body-center',
        render: DataTable.render.number( null, null, 2, null ),
        className: 'dt-body-right'
      },
      {"data":"statut",
        className: 'dt-body-center'
      },
      {"data":"btn_action",
        className: 'dt-body-center'
      }
    ] ,
      "createdRow": function( row, data, dataIndex ) {
        if ( data['statut'] == "Rejected") {
          $(row).addClass('text text-danger');
        }
        else if ( data['statut'] == "Paid") {
          $(row).addClass('text text-primary');
        }
      }  
  });

  $(document).ready(function(){

      $('#form_df').submit(function(e){

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
                $( '#form_df' ).each(function(){
                    this.reset();
                });
                $('#modal_df').modal('hide');
              }
            },
            complete: function () {
                $('#demande_fond').DataTable().ajax.reload();
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

</script>
