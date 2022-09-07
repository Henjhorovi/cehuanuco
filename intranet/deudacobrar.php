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
        if ($_SESSION['nivel']==2)
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
                        $stmt = $bd->prepare("SELECT * FROM colegiado WHERE id=" . $_GET['id'] ); 
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
              <!-- /.form group -->
              <!-- Date mm/dd/yyyy -->
              <!-- /.form group -->

              <!-- phone mask -->
<!--              <div class="form-group">
                <label>FECHA DE NACIMIENTO</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="text" class="form-control" value="<?php echo $colegiado['fecha_nacimiento'];?>" >
                </div>
                 /.input group 
              </div>-->
              <!-- /.form group -->

              <!-- phone mask -->
<!--              <div class="form-group">
                <label>CELULAR</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" value="<?php echo $colegiado['telefono'];?>">
                </div>
                 /.input group 
              </div>-->
              <!-- /.form group -->

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
                  <label>FECHA DE COLEGIACI&Oacute;N (PAGO)</label>
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
                        if($mes==12)
                        {
                           $año++;
                           $mes=1;
                        }
                        else
                        {
                            $mes++;
                        }
                        //var_dump($colegiado);exit;
                        if (($añofinal-$año)>0)
                        {
                            $totalmesesdeuda=($añofinal-$año)*12-$mes+(int)$mesfinal;
                            
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
                        $mes_cont = $mes;
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
                        
                        $stmt = $bd->prepare("SELECT * FROM tipo_pago WHERE pago_anual=1 AND estado = 1" ); 
                        $stmt->execute();
                        $tipodeudas = array();
                        $i=0;
                        foreach($stmt as $deudaanual)
                        {                            
                            $tipodeudas[$i]['tipo_pago_id']=$deudaanual['id'];
                            $tipodeudas[$i]['concepto']=$deudaanual['descripcion'];
                            $tipodeudas[$i]['monto']=$deudaanual['monto'];
                            $tipodeudas[$i]['vencimiento']=$deudaanual['vencimiento'];
                            $i++;
                        }
                        
                        for($j=0;$j<$i;$j++)
                        {
                            for($k=0;$k<$totalañodeudas;$k++)
                            {
                                $deudas[]=array('idcolegiado'=>$colegiado['id'],
                                                'tipo_pago_id'=>$tipodeudas[$j]['tipo_pago_id'],
                                                'descripciondeuda'=>$tipodeudas[$j]['concepto'],
                                                'monto'=>$tipodeudas[$j]['monto']);
                            }
                        }
                        //---------------------------------
                        
                        
                       ?><form method="POST" id="formulario_crear"> <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">PAGAR</h3>
                        </div>
                        <div class="box-body">
                            <div class="col-md-3">
                                 <div class="form-group">
                                <label>TIPO DEUDA</label>
                                <select id="tipodeuda" name="tipodeuda" class="form-control">
                                   <?php
                                        echo "<option value='0'>SELECCIONE UNA DEUDA</option>";
                                    foreach($bd->query("SELECT * FROM tipo_pago WHERE estado = 1" ) as $tipo_deuda)
                                    {                            
                                        echo "<option value='" . $tipo_deuda['id'] . "'>" . utf8_encode($tipo_deuda['descripcion']) . "</option>";
                                    }
                                   ?>
                                </select>
                            </div>
                            </div>
                            <div class="col-md-2">
                                 <div class="form-group">
                                    <label>MONTO</label>
                                    <input type="text" class="form-control" value="" disabled="true" id="deuda_mostrar">
                                    <input type="hidden"  value=""id="deuda_monto">
                                    <input type="hidden"  name="op" value="5">
                                    <input type="hidden"  value="<?php echo $_GET['id']; ?>" id="idcolegiado" name="idcolegiado">
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                <label>CANTIDAD</label>
                                    <div class="input-group my-colorpicker2 colorpicker-element" >
                                        <select id="cantidad" name="cantidad" class="form-control">
                                              <option value="1">1</option>
                                              <option value="2">2</option>
                                              <option value="3">3</option>
                                              <option value="4">4</option>
                                              <option value="5">5</option>
                                              <option value="6">6</option>
                                              <option value="7">7</option>
                                              <option value="8">8</option>
                                              <option value="9">9</option>
                                              <option value="10">10</option>
                                              <option value="11">11</option>
                                              <option value="12">12</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2"> 
                                    <label>TOTAL</label>
                                <div class="form-group">
                                     <input type="text" class="form-control" value="" disabled="true" id="total_mostrar">
                                </div>                                
                            </div>
                            <div class="col-md-2"> 
                                    <label>RECIBO</label>
                                <div class="form-group">
                                    <input type="text" class="form-control" value="" id="recibo" name="recibo">
                                </div>                                
                            </div><div class="col-md-1">
                                <div class="form-group">
                                <label>TIPO PAGO</label>
                                    <div class="input-group my-colorpicker2 colorpicker-element" >
                                        <select id="tipo_pago" name="tipo_pago" class="form-control">
                                              <option value="EFECTIVO">EFECTIVO</option>
                                              <option value="DEPOSITO">DEPOSITO</option>
                                          </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-1"> 
                                <br>
                                <div class="form-group">
                                    <input type="submit" id="pagar" name="pagar" class="btn btn-danger" value="PAGAR">
                                </div>                                
                            </div>
                        </div>
                    </div>
                    </form>       
                        <div class="box box-info">
                            DEUDAS
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
                                 $stmt = $bd->prepare("SELECT * FROM deudas WHERE colegiado_id=" . $_GET['id'] . " ORDER BY vencimiento ASC " ); 
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
        else 
        {
            exit;
        }
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    
  });
  $('#tipodeuda').change(function (){
       $.ajax({
            type: "POST",
            url: "auxiliar.php",
            dataType: "json",
            data: {op:4,id:$("#tipodeuda").val()},
            success: function(result){
                  $("#deuda_mostrar").val(result.monto);
                  $("#deuda_monto").val(result.monto);
                  $("#total_mostrar").val(result.monto*$("#cantidad").val());
             }
           });

    
    });
   $('#cantidad').change(function (){
        $("#total_mostrar").val($("#deuda_monto").val()*$("#cantidad").val());
    });
   $('#pagar').click(function (){
        if ($('#tipodeuda').val()==0){
            alert("SELECCIONE UN TIPO DE PAGO");
            return;
        }
        if ($('#recibo').val().length<1){
            alert("INGRESE UN NUMERO DE RECIBO");
            return;
        }
     });   
        $("#formulario_crear").submit(function(e){                
    e.preventDefault();
    var formData = new FormData(document.getElementById("formulario_crear"));
       $.ajax({
            type: 'POST',
            url: 'auxiliar.php',
            dataType: "HTML",
            data:  formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function()
            {
                alert("GUARDO CORRECTAMENTE");
                location.reload(true);
            }                            
        }).fail(function(){
            });
            e.preventDefault();
            return false;
         });
     
    });
  
</script>
