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
            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '2'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="">
                <img src="../images/business-report.png" width="30px" /> 
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'REPORTING & KPI\'s';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'RAPPORTS & KPI\'s';
                  }
                ?>
                <br>
              </p></span>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboardFacturation.php" class="nav-link">
              &nbsp;<img src="../images/calculator.png" width="25px" /> 
              <p><?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Invoicing';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Facturation';
                  }
                ?></p>
            </a>
          </li>
          <li class="nav-item">
            <a href="dashboardOPS.php" class="nav-link">
              &nbsp;<img src="../images/dossier.png" width="25px" /> 
              <p><?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Operations';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Operations';
                  }
                ?></p>
            </a>
          </li>

            <hr>
            <?php
            }

            if(!empty($maClasse-> getAffectationUtilisateurModule($_SESSION['id_util'], 11))){
          ?>
          <a href="#" class="nav-link active bg-danger">
              <img src="../images/gestion-des-risques.png" width="25px">
              <span class="">
              <p>
                DOSSSIERS CONTENTIEUX<br>
              </p></span>
            </a>
          </li>
           <!--  <li class="nav-item">
                <a href="dashboardRisque.php" class="nav-link">
                  <img src="../images/risque (1).png" width="30px">
                  <p>Dashboard</p>
                </a>
            </li>
 -->
            <li class="nav-item">
                <!-- <a href="pv_contentieux.php" class="nav-link"> -->
                <a href="risque_douane.php" class="nav-link">
                  <img src="../images/conforme.png" width="25px">
                  <p>Documents</p>
                </a>
            </li>

            <?php
              // $maClasse-> afficherMenuFinanceOPS();
              echo '<hr>';
            }

            if(!empty($maClasse-> getAffectationUtilisateurModule($_SESSION['id_util'], 12))){
          ?>
          <a href="#" class="nav-link active bg-danger">
              <img src="../images/argent.png" width="25px">
              <span class="">
              <p>
                FINANCE<br>
              </p></span>
            </a>
          </li>
          <li class="nav-header font-weight-bold">
            <?php
              if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                echo 'Accounting';
              }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                echo 'Comptabilité';
              }
            ?>
          </li>
          <li class="nav-item">
            <a href="transaction.php" class="nav-link" class="nav-link">
              <img src="../images/dollar.png" width="25px">
              <p>
              <?php
                if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                  echo 'Transactions';
                }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                  echo 'Transactions';
                }
              ?>
              </p>
            </a>
          </li>

           <li class="nav-item has-treeview">
              <a href="#" class="nav-link" class="nav-link">
                <img src="../images/rapport-dactivite (1).png" width="25px">
                <p>
                  <?php
                    if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                      echo 'Reports';
                    }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                      echo 'Rapports / Etat';
                    }
                  ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="trialBalance.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-balance-scale nav-icon"></i> 
                    <p>
                    <?php
                      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                        echo 'Trial Balance';
                      }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                        echo 'Balance de Comptes';
                      }
                    ?>
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="grandLivre.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open nav-icon"></i>
                    <p>
                    <?php
                      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                        echo 'General Ledger Accounts';
                      }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                        echo 'Grand Livre de Comptes';
                      }
                    ?>
                    </p>
                  </a>
                </li>
                <!-- <li class="nav-item">
                  <a href="balanceSheet.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open nav-icon"></i>
                    <p>
                    <?php
                      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                        echo 'Balance Sheet';
                      }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                        echo 'Balance de Comptes';
                      }
                    ?>
                    </p>
                  </a>
                </li> -->
              </ul>
          </li>
           <!--<li class="nav-item has-treeview">
              <a href="#" class="nav-link" class="nav-link">
                <img src="../images/transaction.png" width="25px">
                <p>
                  Tansactions
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="approCompte.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-arrow-down nav-icon"></i>
                    <p>
                    <?php
                      if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                        echo 'Account Funding';
                      }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                        echo 'Appro Compte';
                      }
                    ?>
                    </p>
                  </a>
                </li>
              </ul>
          </li>
           <li class="nav-item has-treeview">
              <a href="#" class="nav-link" class="nav-link">
                <img src="../images/registre.png" width="25px">
                <p>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Register';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Journal';
                  }
                ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <?php
                echo $maClasse-> afficherMenuRegistreAJAX();
              ?>
            </li>-->
           <li class="nav-item has-treeview">
              <a href="#" class="nav-link" class="nav-link">
                <img src="../images/parametres.png" width="25px">
                <p>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Settings';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Parametres';
                  }
                ?>
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="journaux.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-folder-open nav-icon"></i>
                    <p>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Registers';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Journaux';
                  }
                ?>
                  </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="account.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-table nav-icon"></i>
                    <p>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Accounts';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Comptes';
                  }
                ?>
                  </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="groups_account.php" class="nav-link">
                    &nbsp;&nbsp;&nbsp;<i class="fa fa-object-group nav-icon"></i>
                    <p>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Groups Of Accounts';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Groupe de Comptes';
                  }
                ?>
                    </p>
                  </a>
                </li>
              </ul>
            </li>
            <?php
              // $maClasse-> afficherMenuFinanceOPS();
              echo '<hr>';
            }

          if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '5' || $_SESSION['id_role'] == '11' || $_SESSION['id_role'] == '2'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="">
                LICENSES<br>
              </p></span>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Definitives
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
                $maClasse-> afficherMenuLicence(1);
              ?>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Temporaire
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php
                $maClasse-> afficherMenuLicence(2);
              ?>
            </ul>
          </li>
            <hr>
            <?php
            }

            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '2' || $_SESSION['id_role'] == '6' || $_SESSION['id_role'] == '7' || $_SESSION['id_role'] == '8' || $_SESSION['id_role'] == '9' || $_SESSION['id_role'] == '10' || $_SESSION['id_role'] == '11' || $_SESSION['id_role'] == '14'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="">
                TRACKING<br>
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
              <p style="">
                LOGISTIC<br>
              </p></span>
            </a>
          </li>

            <?php
              $maClasse-> afficherMenuTrackingLogistique();
            }
            
            if($_SESSION['id_role'] == '1' || $_SESSION['id_role'] == '12' || $_SESSION['id_role'] == '2'){
          ?>
          <hr>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="">
                INVOICING<br>
              </p></span>
            </a>
          </li>
          <li class="nav-header font-weight-bold font-weight-light">Clearing Invoicing</li>
          <li class="nav-item">
            <a href="pending_report.php" class="nav-link">
              &nbsp;<img src="../images/calculator.png" width="25px">
              <p><?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Pending Invoices Report';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Rapport factures en souffrance';
                  }
                ?></p>
            </a>
          </li>
            <?php
              $maClasse-> afficherMenuFacturation();
            ?>
          <li class="nav-header font-weight-bold font-weight-light">Debit Note</li>
            <?php
              $maClasse-> afficherMenuFacturationDebitNote();
            ?>
            <hr>
            <?php
            }
            ?>
          <?php
          if($_SESSION['id_role'] == '1'){
          ?>
          <li class="nav-item"  style="">
            <a href="#" class="nav-link active bg bg-danger" style=" font-weight: bold;">
              <!--<i class="nav-icon fas fa-tachometer-alt"></i>-->
              <span class="">
              <p style="">
                <i class="fa fa-cogs"></i>
                <?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'SETTING';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'PARAMETRAGE';
                  }
                ?>
                <br>
              </p></span>
            </a>
          </li>
          <li class="nav-item">
            <a href="client.php" class="nav-link">
              &nbsp;<img src="../images/poignee-de-main.png" width="25px">
              <p><?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'Clients';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Clients';
                  }
                ?></p>
            </a>
          </li>
         <!--  <li class="nav-item">
            <a href="dashboardOPS.php" class="nav-link">
              &nbsp;<img src="../images/dossier.png" width="25px" /> 
              <p><?php
                  if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='ENG') {
                    echo 'User';
                  }else if ($maClasse-> getUtilisateur($_SESSION['id_util'])['langue']=='FR') {
                    echo 'Operations';
                  }
                ?></p>
            </a>
          </li> -->

            <hr>
            <?php
            }
            if($_SESSION['id_util'] == '1'){
              ?>
            <li class="nav-item">
            <a href="files.php" class="nav-link">
              &nbsp;
              <p>Files</p>
            </a>
          </li>
              <?php
            }
          ?>
          <hr>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
