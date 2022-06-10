
<body class="hold-transition sidebar-mini layout-fixed layout-top-nav layout-navbar-fixed hold-transition pace-success">
<div class="wrapper small">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light bg-danger" >
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button" style="color: white;"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- Right navbar links -->
    <!-- <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <script type="text/javascript">
          var timerRunning = false;
          function runClock() 
          {
            var today   = new Date();
            var jour = today.getDay();
            var mois = today.getMonth();
            var annee = today.getYear();
            annee = today.getFullYear();
            moi = today.getMonth();
            mois = new Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
            j = today.getDate();
            jour = today.getDay();
            jours = new Array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
            var hours   = today.getHours();
            var minutes = today.getMinutes();
            var seconds = today.getSeconds();
            var timeValue = hours;
           
            // Les deux prochaines conditions ne servent que pour l'affichage.
            // Si le nombre de minutes est inférieur à 10, alors on ajoute un 0 devant...
           
            timeValue += ((minutes < 10) ? ":0" : ":") + minutes;
            timeValue += ((seconds < 10) ? ":0" : ":") + seconds;
            document.getElementById("time").value = jours[jour]+' '+j+' '+mois[moi]+' '+annee+ '  ' +timeValue;
            timerRunning = true;
          }
           
          var timerID = setInterval(runClock,1000);
        </script>
        <input type="text" style="text-align: center; background-color: black; color: white; font-weight: bold;" disabled id="time" size="30" />
        <a href="../deconnexion.php" role="button">
          <button class="btn btn-xs btn-dark"><img src="../images/logout.png" width="20px"> Logout</button>
        </a>
      </li>
    </ul> -->

    <!-- --------- -->


    <nav class="main-header navbar navbar-expand-md navbar-light  bg-danger">
    <div class="container">
      <a href="" class="navbar-brand">
        <img src="../images/logo.jpeg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">MALABAR RDC</span>
      </a>
      <!-- <a href="" class="brand-link">
        <img src="../images/logo.jpeg"
             alt="AdminLTE Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .95">
        <span class="brand-text font-weight-light">MALABAR | ERP</span>
      </a> -->
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <!-- <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
        </ul> -->

        <!-- SEARCH FORM -->
        <!-- <form class="form-inline ml-0 ml-md-3">
          <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-navbar" type="submit">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </form> -->
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a class="nav-link text-light" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fa fa-user"></i>
             <?php 
              echo '<b>'.$maClasse-> getNom($_SESSION['id_util']);
            ?>
          </a>
        </li>
        <!-- <li class="nav-item">
          <a href="../deconnexion.php" class="nav-link text-light" role="button">
            <button class="btn btn-xs btn-dark"><img src="../images/logout.png" width="20px"> Logout</button>
          </a>
        </li> -->
      </ul>
    </div>
  </nav>
  </nav>