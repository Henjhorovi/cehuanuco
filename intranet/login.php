<?php 
session_start();
if(isset($_POST['usuario']) && isset($_POST['password']))
{
    include 'conexion.php';
    $usernameEmail = $_POST['usuario'];
    $hash_password = $_POST['password'];
    $stmt = $bd->prepare("SELECT * FROM colegiado c"
            . " WHERE (dni=:usernameEmail) AND (clave=:hash_password)" ); 
    $stmt->bindParam("usernameEmail", $usernameEmail,PDO::PARAM_STR) ;
    $stmt->bindParam("hash_password", $hash_password,PDO::PARAM_STR) ;
    $stmt->execute();
    foreach($stmt as $colegiado)
    {
        $_SESSION['dni']=$colegiado['dni'];
        $_SESSION['id']=$colegiado['id'];
        $_SESSION['nrocolegiatura']=$colegiado['nrocolegiatura'];
        $_SESSION['nombre']=$colegiado['nombre'];
        $_SESSION['apellidos']=$colegiado['apellidos'];
        $_SESSION['fecha_habilitacion']=$colegiado['fecha_habilitacion'];
        $_SESSION['nivel']=$colegiado['nivel'];
    }
    $count=$stmt->rowCount();
    
    if ($count>0)
    {
        header('Location: index.php');
        
    }
    else
    {        
        header('Location: login.php');
    }
}
else
{
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>CE HU&Aacute;NUCO</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
  <!-- /.login-logo -->
  <center>
          <table>
              <tr>
                  <td>
                      <img src="dist/img/Logo-CEH_chico_1.jpg" alt="" />   
                  </td>
                  <td>
                      <div class="login-box-body">
                    <form method="post">
                      <div class="form-group has-feedback">
                          <input type="text" class="form-control" placeholder="Usuario" name="usuario">
                        <span class="glyphicon glyphicon-envelope form-control-feedback" ></span>
                      </div>
                      <div class="form-group has-feedback">
                        <input type="password" class="form-control" placeholder="Password" name="password">
                        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                      </div>
                      <div class="row">        
                        <!-- /.col -->
                        <div class="col-xs-4">
                          <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
                        </div>
                        <!-- /.col -->
                      </div>
                    </form>
                    </div>
                  </td>
              </tr>
          </table>
  </center>
    <!--<p class="login-box-msg">Sign in to start your session</p>-->
 
        
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
</body>
</html>
<?php
}
?>