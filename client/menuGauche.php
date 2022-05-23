  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">
      <img src="../images/logo.jpeg"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .95">
      <span class="brand-text font-weight-light">MALABAR | ERP</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../images/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">
            <?php 
              echo '<b>'.$maClasse-> getNom($_SESSION['id_util']).'</b><br>'.$maClasse-> getNomRoleUtilisateur($_SESSION['id_util']);
            ?>
          </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <?php
            if( $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1') != false){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <img src="../images/export.png" width="20px">&nbsp;&nbsp;
              EXPORT
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboardDossier.php?id_mod_trac=1&id_mod_trans=1&commodity=&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/business-report.png" width="30px">&nbsp;&nbsp;
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dossier.php?id_mod_lic=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1')['id_cli'];?>&id_mod_trans=1&id_march=" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/truck.png" width="30px">&nbsp;&nbsp;
              <p>Road Files</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dossier.php?id_mod_lic=1&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '1')['id_cli'];?>&id_mod_trans=4&id_march=" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/train.png" width="30px">&nbsp;&nbsp;
              <p>Wagon</p>
            </a>
          </li>
            <?php
              //$maClasse-> afficherMenuLicence();
            ?>
            <hr>
            <?php
            }

            if( $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2') != false){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <img src="../images/import.png" width="20px">&nbsp;&nbsp;
              IMPORT
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboardDossier.php?id_mod_trac=2&id_mod_trans=1&commodity=&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/business-report.png" width="30px">&nbsp;&nbsp;
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dossier.php?id_mod_lic=2&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&id_mod_trans=1&id_march=" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/truck.png" width="30px">&nbsp;&nbsp;
              <p>Road Files</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dossier.php?id_mod_lic=2&id_cli=<?php echo $maClasse-> getUtilisateurClientModeleLicence($_SESSION['id_util'], '2')['id_cli'];?>&id_mod_trans=3&id_march=" class="nav-link">
              &nbsp;&nbsp;&nbsp;&nbsp;<!-- <i class="nav-icon fas fa-tachometer-alt"></i> -->
              <img src="../images/airplane.png" width="30px">&nbsp;&nbsp;
              <p>Air Files</p>
            </a>
          </li>
            <?php
              //$maClasse-> afficherMenuLicence();
            ?>
            <hr>
            <?php
            }
            ?>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
