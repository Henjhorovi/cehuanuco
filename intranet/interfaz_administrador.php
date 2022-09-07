 
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
      
      <!-- /.row -->
      <!-- Main row -->
      
      <!------------------------------------------------ /.row (main row) -->
        <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
                <span class="info-box-text"><b>COLEGIADOS INSCRITOS</b></span>
              <h3><?php
                include "conexion.php";
                $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c" ); 
                $stmt->execute();
                foreach($stmt as $colegiado)
                {
                        echo $colegiado['totalcolegiado'];
                }
              ?></h3>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b>NO HABILITADOS DEL ULTIMO MES</b></span>
              <h3><?php
                $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c WHERE habilitado_hasta<'" . date('Y-m',strtotime ( '-1 month' , strtotime ( date('Y-m-d') ) )) . "-01'" ); 
                $stmt->execute();
                foreach($stmt as $colegiado_deudor)
                {
                        echo $colegiado_deudor['totalcolegiado'];
                }
                
              ?></h3>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text"><b>INGRESOS HOY</b></span>
              <H3>                  
                  <?php
                    $stmt = $bd->prepare("SELECT SUM(monto) as totalingreso FROM cep.deudas WHERE DATE(fecha_pago) = CURDATE()" ); 
                    $stmt->execute();
                    foreach($stmt as $cobros_hoy)
                    {
                            echo $cobros_hoy['totalingreso'];
                    }
              ?>
              </H3>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">

            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text"><b>NUEVOS COLEGIADOS DEL MES</b></span>
              <H3>                  
                  <?php
                    $stmt = $bd->prepare("SELECT count(*) as nuevos FROM cep.colegiado
                                where MONTH(fecha_habilitacion)= MONTH(CURDATE())
                                AND YEAR(fecha_habilitacion)= YEAR(CURDATE())" ); 
                    $stmt->execute();
                    foreach($stmt as $colegiado_nuevos)
                    {
                            echo $colegiado_nuevos['nuevos'];
                    }
              ?>
              </H3>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">INFORMACI&Oacute;N</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                
                <!-- /.col -->
                <div class="col-md-4">
                  <p class="text-center">
                    <strong>PENDIENTES DE PAGO</strong>
                  </p>
<?php
$mes = array(1=>'ENERO',2=>'FEBRERO',3=>'MARZO',4=>'ABRIL',5=>'MAYO',6=>'JUNIO',7=>'JULIO',8=>'AGOSTO',9=>'SEPTIEMBRE',
                10=>'OCTUBRE',11=>'NOVIEMBRE',12=>'DICIEMBRE');
?>
                  <div class="progress-group">
                    <span class="progress-text"><?PHP echo $mes[(int)date('m',strtotime ( '-1 month' , strtotime ( date('Y-m-d') ) ))];?></span>
                    <span class="progress-number"><b>
                        <?php
                            $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c WHERE habilitado_hasta<'" . date('Y-m',strtotime ( '-1 month' , strtotime ( date('Y-m-d') ) )) . "-01'" ); 
                            
                            $stmt->execute();
                            foreach($stmt as $colegiado_deudor)
                            {
                                    echo $colegiado_deudor['totalcolegiado'];
                            }

                          ?>
                        </b>/<?php   echo $colegiado['totalcolegiado']; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-aqua" style="width: <?php echo $colegiado_deudor['totalcolegiado']*100/$colegiado['totalcolegiado']?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"><?PHP echo $mes[(int)date('m',strtotime ( '-2 month' , strtotime ( date('Y-m-d') ) ))];?></span>
                    <span class="progress-number"><b><?php
                            $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c WHERE habilitado_hasta<'" . date('Y-m',strtotime ( '-2 month' , strtotime ( date('Y-m-d') ) )) . "-01'" ); 
                            $stmt->execute();
                            foreach($stmt as $colegiado_deudor)
                            {
                                    echo $colegiado_deudor['totalcolegiado'];
                            }

                          ?></b>/<?php   echo $colegiado['totalcolegiado']; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-red" style="width: <?php echo $colegiado_deudor['totalcolegiado']*100/$colegiado['totalcolegiado']?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"><?PHP echo $mes[(int)date('m',strtotime ( '-3 month' , strtotime ( date('Y-m-d') ) ))];?></span>
                    <span class="progress-number"><b><?php
                            $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c WHERE habilitado_hasta<'" . date('Y-m',strtotime ( '-3 month' , strtotime ( date('Y-m-d') ) )) . "-01'" ); 
                            $stmt->execute();
                            foreach($stmt as $colegiado_deudor)
                            {
                                    echo $colegiado_deudor['totalcolegiado'];
                            }

                          ?></b>/<?php   echo $colegiado['totalcolegiado']; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-green" style="width: <?php echo $colegiado_deudor['totalcolegiado']*100/$colegiado['totalcolegiado']?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                  <div class="progress-group">
                    <span class="progress-text"><?PHP echo $mes[(int)date('m',strtotime ( '-4 month' , strtotime ( date('Y-m-d') ) ))];?></span>
                    <span class="progress-number"><b><?php
                            $stmt = $bd->prepare("SELECT count(*) as totalcolegiado FROM colegiado c WHERE habilitado_hasta<'" . date('Y-m',strtotime ( '-4 month' , strtotime ( date('Y-m-d') ) )) . "-01'" ); 
                            $stmt->execute();
                            foreach($stmt as $colegiado_deudor)
                            {
                                    echo $colegiado_deudor['totalcolegiado'];
                            }

                          ?></b>/<?php   echo $colegiado['totalcolegiado']; ?></span>

                    <div class="progress sm">
                      <div class="progress-bar progress-bar-yellow" style="width: <?php echo $colegiado_deudor['totalcolegiado']*100/$colegiado['totalcolegiado']?>%"></div>
                    </div>
                  </div>
                  <!-- /.progress-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- ./box-body -->
            
            <!-- /.box-footer -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
  </div>