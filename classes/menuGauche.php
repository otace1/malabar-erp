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
            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '5' || $_SESSION['id_role'] == '11'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="font-size: 17px;">
                MODULE LICENCES<br>
              </p></span>
            </a>
          </li>

            <?php
              $maClasse-> afficherMenuLicence();
            ?>
            <hr>
            <?php
            }

            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '6' || $_SESSION['id_role'] == '7' || $_SESSION['id_role'] == '8' || $_SESSION['id_role'] == '9' || $_SESSION['id_role'] == '10' || $_SESSION['id_role'] == '11'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="font-size: 17px;">
                MODULE TRACKING<br>
              </p></span>
            </a>
          </li>

            <?php
              $maClasse-> afficherMenuTracking();
            }

            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '6' || $_SESSION['id_role'] == '7' || $_SESSION['id_role'] == '8' || $_SESSION['id_role'] == '9' || $_SESSION['id_role'] == '10' || $_SESSION['id_role'] == '11'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="font-size: 17px;">
                MODULE LOGISTIQUE<br>
              </p></span>
            </a>
          </li>

            <?php
              $maClasse-> afficherMenuTrackingLogistique();
            }
            
            if($_SESSION['id_role'] == '1'){
          ?>
          <hr>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="font-size: 17px;">
                MODULE FACTURATION<br>
              </p></span>
            </a>
          </li>

            <?php
              $maClasse-> afficherMenuFacturation();
            ?>
            <hr>
            <?php
            }
            ?>
            <hr>
          <!--<li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-boxes"></i>
              <p>
                COMPLEMENT DATA
                  <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              <li class="nav-item has-treeview">
                  <a href="complementData.php?id_mod_lic=2&id_cli=" class="nav-link" class="nav-link">
                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-download"></i>
                        <p>Import </p>
                  </a>
              </li>
              <li class="nav-item has-treeview">
                  <a href="complementData.php?id_mod_lic=1&id_cli=" class="nav-link" class="nav-link">
                        &nbsp;&nbsp;&nbsp;&nbsp;<i class="nav-icon fas fa-upload"></i>
                        <p>Export </p>
                  </a>
              </li>
            </ul>

          </li>-->
          <hr>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
