<?php
  if ($_SESSION['id_role']=='4') {
    ?>
    <script type="text/javascript">
      window.location.replace('../deconnexion.php');
    </script>
    <?php
  }
?>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed hold-transition pace-success">

  <div id="spinner-div" class="pt-5">
    <!-- <div class="spinner-border text-primary" role="status"></div> -->
    <!-- <img src="../images/86b6e3f28ee33d8104291ba874349e04_w200.gif" width="250px"> -->
    <img src="../images/GD.gif" width="250px">
  </div>
  <div id="loading">
    <img id="loading-image" src="ajax-loader.gif" alt="Loading..." />
  </div>
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
    <ul class="navbar-nav ml-auto">
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
        <a href="#" role="button">
          <!--<i class="fa fa-signout"></i>-->
          <?php
            //echo $maClasse-> getIp()['ip'].' '.$maClasse-> getIp()['hostname'].' '.$maClasse-> getIp()['latitude'].' '.$maClasse-> getIp()['longitude'];
          ?>
        </a>
        <a href="../deconnexion.php" role="button">
          <!--<i class="fa fa-signout"></i>-->
          <button class="btn btn-dark">Se deconnecter</button>
        </a>
      </li>
    </ul>
  </nav>