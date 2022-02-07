<?php
  include("tete.php");
  include('dossierExcel.php');
 ?>

  <div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="">
        <div class="row">
          <div class="col-12">
            <button class="btn btn-app btn-success square-btn-adjust" onclick="tableToExcel('exportationExcel', 'Trackings')">
                <i class="fas fa-file-excel"></i> Export
            </button>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>