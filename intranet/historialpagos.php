<?php
session_start();
//var_dump($_SESSION);Exit;

if(empty($_SESSION['dni']))
{
    header("Location: login.php");
}
include "header.php";
?>

      
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      
        <?PHP
        //MENU ADMINISTRADOR
        //if ($_SESSION['nivel']==2)
        {
            ?>    
       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
             <h1>
               DEUDAS
               <small>Cobrar</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Colegiado</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">DATOS PERSONALES</h3>
            </div>
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              
 <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM colegiado WHERE id=" . $_SESSION['id'] ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                        }
                    ?>
              <div class="form-group">
                <label>NOMBRES Y APELLIDOS</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"></i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['nombre'] . " " . $colegiado['apellidos'];?>" disabled="true">
                </div>
                <!-- /.input group -->
              </div>
            
              <!-- IP mask -->
              <div class="form-group">
                <label>EMAIL</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-internet-explorer "></i>
                  </div>
                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" value="<?php echo $colegiado['email'];?>" disabled="true">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">COLEGIATURA</h3>
            </div>
            <div class="box-body">
              <!-- Color Picker -->
              <div class="form-group">
                  <label>FECHA DE COLEGIACI&Oacute;N</label>
                  <input type="text" class="form-control my-colorpicker1 colorpicker-element" value="<?php echo $colegiado['fecha_habilitacion'];?>" disabled="true">
              </div>
              <!-- /.form group -->

              <!-- Color Picker -->
              <div class="form-group">
                  <label>HABILITADO HASTA</label>

                <div class="input-group my-colorpicker2 colorpicker-element" >
                    <input type="text" class="form-control" value="<?php echo $colegiado['habilitado_hasta'];?>" disabled="true">

                  <div class="input-group-addon">
                    <i></i>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
      </div>
               <div class="row">
                   <?php
                    //GENERAR DEUDAS
                        $año = substr($colegiado['habilitado_hasta'],0,4);
                        $mes = substr($colegiado['habilitado_hasta'],5,2);
                        $deudas = array();
                        $añofinal = date('Y');
                        $mesfinal = date('m');
                        //var_dump($colegiado);exit;
                        if (($añofinal-$año)>0)
                        {
                            $totalmesesdeuda=($añofinal-$año)*12-$mes+1+(int)$mesfinal;
                            
//                            if ((int)$mes==1)
//                            {
//                                $totalmesesdeuda=$totalmesesdeuda+ $mesfinal-1;   
//                            }                            
                        }
                        else
                        {
                            $totalmesesdeuda=$mesfinal-$mes;
                        }
                        //DEUDAS MENSUAL
                        
                        $stmt = $bd->prepare("SELECT * FROM tipo_pago WHERE pago_mensual=1 AND estado = 1" ); 
                        $stmt->execute();
                        $tipodeudas = array();
                        $i=0;
                        foreach($stmt as $deudasmensuales)
                        {                            
                            $tipodeudas[$i]['tipo_pago_id']=$deudasmensuales['id'];
                            $tipodeudas[$i]['concepto']=$deudasmensuales['descripcion'];
                            $tipodeudas[$i]['monto']=$deudasmensuales['monto'];
                            $i++;
                        }
                        $mes_cont = $mes+1;
                        $año_cont = $año;
                        for($j=0;$j<$i;$j++)
                        {
                            for($k=0;$k<$totalmesesdeuda;$k++)
                            {
                                //calculo ultimo dia
                                $month = $año_cont . '-' . $mes_cont++;
                                $aux = date('Y-m-d', strtotime("{$month} + 1 month"));
                                $last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));
                                
                                $deudas[]=array('idcolegiado'=>$colegiado['id'],
                                                'tipo_pago_id'=>$tipodeudas[$j]['tipo_pago_id'],
                                                'descripciondeuda'=>$tipodeudas[$j]['concepto'],
                                                'vencimiento'=>$last_day,
                                                'monto'=>$tipodeudas[$j]['monto']);
                                if ($mes_cont==13)
                                {
                                    $mes_cont = 1;
                                    $año_cont ++ ;
                                }
                            }
                        }
                        //---------------------------------
                        //DEUDAS ANUAL
                        
                      
                        //---------------------------------
                        
                        
                       ?>
                    
                        <div class="box box-info">
                            <H1>DEUDAS</h1>
                        <table id="example2" class="table table-bordered table-hover">
                          <thead>
                          <tr>
                            <th>N</th>
                            <th>CONCEPTO</th>
                            <th>MODO PAGO</th>
                            <th>RECIBO</th>
                            <th>FECHA PAGO</th>
                            <th>MONTO</th>
                            <th>VENCIMIENTO</th>
                          </tr>
                          </thead>
                          <tbody>
                              <?PHP           
                              
                                $cont=1;
                                $stmt = $bd->prepare("SELECT * FROM deudas WHERE colegiado_id=" . $_SESSION['id'] . " ORDER BY vencimiento ASC " ); 
                                $stmt->execute();
                                foreach($stmt as $deudas_pago)                                    
                                {
                                     echo "<tr><td> " . $cont . "</td>"
                                              . "<td>" . $deudas_pago['descripciondeuda'] . "</td>"
                                              . "<td>" . $deudas_pago['modopago'] . "</td>"
                                              . "<td>" . $deudas_pago['recibo'] . "</td>"
                                              . "<td>" . $deudas_pago['fecha_pago'] . "</td>"
                                              . "<td>" . $deudas_pago['monto'] . "</td>"
                                              . "<td>" . $deudas_pago['vencimiento'] . "</td>"
                                              . "</tr>";
                                      $cont++;
                                }
                                  foreach($deudas as $deuda)
                                  {
                                      echo "<tr><td> " . $cont . "</td>"
                                              . "<td> " . $deuda['descripciondeuda'] . "</td>"
                                              . "<td></td>"
                                              . "<td> " . "</td>"
                                              . "<td> " .  "</td>"
                                              . "<td>" . $deuda['monto'] . "</td>"
                                              . "<td>" . $deuda['vencimiento'] . "</td>"
                                              . "<td></td>"
                                              . "</tr>";
                                      $cont++;
                                  }
                              ?>
                          </tbody>
                          <tfoot>
                          <tr>
                            <th>N</th>
                            <th>CONCEPTO</th>
                            <th>MODO PAGO</th>
                            <th>RECIBO</th>
                            <th>FECHA PAGO</th>
                            <th>MONTO</th>
                            <th>VENCIMIENTO</th>
                          </tr>
                          </tfoot>
                        </table>
                      </div>
                   <?PHP
                        //--------------------------------------------------------

                   ?>
               </div>
           </section>
           <!-- /.content -->
         </div>
            <?php
           
        }
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
