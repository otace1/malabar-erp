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

      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid" style="text-align: center;">
        <div class="card">
          <div class="card-body">
            
            <div class="table-responsive">
              <table id="file_data" class="table table-bordered table-striped table-sm">
                <thead>
                  <tr>
                    <th>N.</th>
                    <th>MCA File REF</th>
                    <th>PRE-ALERTE DATE</th>
                    <th>INVOICE</th>
                    <th>COMMODITY</th>
                    <th>SUPPLIER</th>
                    <th>PO Ref</th>
                    <th>WEIGHT</th>
                  </tr>
                </thead>
              </table>
            </div>

          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include("pied.php");?>