
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed hold-transition pace-success">
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
            mois = new Array('Janvier', 'F&eacute;vrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Ao&ucirc;t', 'Septembre', 'Octobre', 'Novembre', 'D&eacute;cembre');
            j = today.getDate();
            jour = today.getDay();
            jours = new Array('Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
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
          <!--<i class="fa fa-signout"></i>-->
          <button class="btn btn-dark">Se deconnecter</button>
        </a>
      </li>
    </ul>
  </nav>