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
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-red sidebar-mini">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
<!--      <span class="logo-mini"><b>CE</b> HU&Aacute;NUCO</span>
       logo for regular state and mobile devices 
      <span class="logo-lg"><b>CE</b> HU&Aacute;NUCO</span>-->
      <img src="dist/img/Logo-CEH_chico.jpg" alt="" height="100%" width="100%"/>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="dist/img/avatar5.png"  class="user-image"/>
              <span class="hidden-xs">
                  <?php echo TRIM($_SESSION['apellidos'] . ", " . $_SESSION['nombre']); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="dist/img/avatar5.png"  class="img-circle" alt="User Image"/>
                <p>
                  <?php echo $_SESSION['apellidos'] . ", " . $_SESSION['nombre']; ?>
                  <small>Miembro desde  <?php echo $_SESSION['fecha_habilitacion']; ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <!--<a href="#" class="btn btn-default btn-flat">Profile</a>-->
                </div>
                <div class="pull-right">
                    <a href="logout.php" class="btn btn-default btn-flat">Salir</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
                <img src="dist/img/avatar5.png"  class="img-circle"/>
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['dni']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU PRINCIPAL</li>
          <?PHP
        //MENU ADMINISTRADOR
        if ($_SESSION['nivel']==2)
        {
            ?>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-dashboard"></i> <span>PRINCIPAL</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="colegiados.php"><i class="fa fa-circle-o"></i>COLEGIADOS</a></li>
                          <li><a href="tipodeuda.php"><i class="fa fa-circle-o"></i> TIPO DE PAGO</a></li>
                          <li><a href="universidad.php"><i class="fa fa-circle-o"></i>UNIVERSIDADES</a></li>
                          <li><a href="comunicadolist.php"><i class="fa fa-circle-o"></i>COMUNICADOS</a></li>
                          <li><a href="anio.php"><i class="fa fa-circle-o"></i>AÑO</a></li>
                          <li><a href="mescuenta.php"><i class="fa fa-circle-o"></i>RENDICION DE CUENTAS</a></li>
                          <li><a href="listapartido.php"><i class="fa fa-circle-o"></i>LISTA DE PARTIDOS</a></li>
                      </ul>
                    </li>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-dashboard"></i><span>REPORTES</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="rep_colegiadoshab.php"><i class="fa fa-circle-o"></i>COLEGIADOS</a></li>
                          <li><a href="rep_pordia.php"><i class="fa fa-circle-o"></i>PAGO/DIA</a></li>
                      </ul>
                    </li>

                     </section>
                <!-- /.sidebar -->
              </aside>
            <?PHP
        }
        else 
        {
            ?>
                    <li class="treeview">
                      <a href="#">
                        <i class="fa fa-dashboard"></i> <span>PRINCIPAL</span>
                        <span class="pull-right-container">
                          <i class="fa fa-angle-left pull-right"></i>
                        </span>
                      </a>
                      <ul class="treeview-menu">
                          <li><a href="colegiado.php"><i class="fa fa-circle-o"></i>COLEGIADO</a></li>
                          <li><a href="historialpagos.php"><i class="fa fa-circle-o"></i>PAGOS</a></li>
                          <li><a href="comunicadocolegiado.php"><i class="fa fa-circle-o"></i>COMUNICADOS</a></li>
                      </ul>
                    </li>

                     </section>
                <!-- /.sidebar -->
              </aside>
            <?PHP
        }
            ?>
