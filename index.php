<?php
  session_start();

  include('classes/maClasse.class.php');

  $maClasse = new MaClasse();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MALABAR-ERP</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons 
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">-->
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="icon" href="images/logo.jpeg" type="image/x-icon"> -->
  <link rel="icon" href="images/logo.jpeg" type="image/x-icon">
</head>
<body class="hold-transition login-page small" style="background: url('images/logo1.jpeg') no-repeat center center fixed;-webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;/*background-image: url(images/logo.jpg);*/">
<div class="login-box" style="background-color: rgb(193, 0, 0); border-radius: 5px;">
  <div class="login-logo">
    <a style="color: white;"><b>MALABAR | </b>ERP</a>
  </div>

  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Veuillez entrer vos coordonnées afin d'ouvrir votre session</p>

      <form action="" method="post">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="pseudo_util" placeholder="Nom d'utilisateur">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="pass_util" placeholder="Mot de passe">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
          </div>
          <!-- /.col -->
          <div class="col-6">
            <button type="submit" name="ok" class="btn btn-dark btn-block">Se connecter</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

    </div>
    <!-- /.login-card-body -->
  </div>
  <div class="small text-light">
    <div style="text-align: center;">
      <b>Version</b> 1.8 <br>
      Build by <a href="http://www.belej-consulting.com/" onclick="window.open(this.href);return false;"><font color="orange">BELEJ</font><font color="black">-CONSULTING</font></a>
    </div>
  </div>
</div>
<!-- /.login-box -->

  <?php
    if(isset($_POST['ok'])){
      if($maClasse-> verifierUtilisateur($_POST['pseudo_util'], $_POST['pass_util']) == false){
      ?>
      <script language="javascript">
        alert('Coordonnées incorrectes !!');
      </script>
      <?php
      }else{
        $_SESSION['id_util'] = $maClasse-> verifierUtilisateur($_POST['pseudo_util'], $_POST['pass_util']);
        $_SESSION['id_role'] = $maClasse-> getIdRoleUtilisateur($_SESSION['id_util']);
        $_SESSION['nom_role'] = $maClasse-> getNomRoleUtilisateur($_SESSION['id_util']);

        $maClasse-> creerLogUtilisateur($_SESSION['id_util'], $maClasse-> getIp()['ip'], $maClasse-> getIp()['hostname'], $maClasse-> getIp()['latitude'], $maClasse-> getIp()['longitude']);

        if ($_SESSION['id_role']=='4') {
          header('Location: client/');
        }else{
          header('Location: pages/');
        }
      }
    }
  ?>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

</body>
</html>
