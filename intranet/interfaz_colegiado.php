
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        PRINCIPAL
        <small>Panel de Control</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Principal</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <!-- ./col -->
        
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php
                include 'conexion.php';
                $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c" ); 
                $stmt->execute();
                foreach($stmt as $colegiado)
                {
                        echo $colegiado['totalcolegiado'];
                }
              ?></h3>

              <p>COLEGIADOS INSCRITOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php
                include 'conexion.php';
                $stmt = $bd->prepare("SELECT count(*) as total FROM comunicado WHERE estado=1" ); 
                $stmt->execute();
                foreach($stmt as $colegiado)
                {
                        echo $colegiado['total'];
                }
              ?></h3>

              <p>COMUNICADOS</p>
            </div>
            <div class="icon">
              <i class="ion ion-alert"></i>
            </div>
          </div>
        </div>
        
        <!-- ./col -->
      </div>
      <!-- /.row -->
      <!-- Main row -->
      
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>    