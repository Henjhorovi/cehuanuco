<?php
session_start();
//var_dump($_SESSION);Exit;
if(empty($_SESSION['dni']))
{
    header("Location: login.php");
}
include "header.php";
?>    
   <div class="content-wrapper">
       <!-- Content Header (Page header) -->
        <section class="content-header">
             <h1>
               PAGOS
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
                            <div class="form-group">
                                <label>EMAIL</label>

                                <div class="input-group">
                                  <div class="input-group-addon">
                                    <i class="fa fa-internet-explorer "></i>
                                  </div>
                                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" value="<?php echo $colegiado['email'];?>" disabled="true">
                                </div>
                            </div>
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
                          <div class="form-group">
                              <label>HABILITADO HASTA</label>
                            <div class="input-group my-colorpicker2 colorpicker-element" >
                                <input type="text" class="form-control" value="<?php echo $colegiado['habilitado_hasta'];?>" disabled="true">
                              <div class="input-group-addon">
                                <i></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
               <div class="row">      
                        <div class="box box-info">
                            <h4 class="box-title">HISTORIAL DE PAGOS</h4>
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
                                 $stmt = $bd->prepare("SELECT * FROM registro_pago AS r INNER JOIN tipo_pago AS t ON r.tipo_pago_id=t.id WHERE colegiado_id=" . $_SESSION['id']); 
                                $stmt->execute();
                                foreach($stmt as $deudas_pago)                                    
                                {
                                     echo "<tr><td> " . $cont . "</td>"
                                              . "<td>" . $deudas_pago['descripcion'] . "</td>"
                                              . "<td>" . $deudas_pago['modopago'] . "</td>"
                                              . "<td>" . $deudas_pago['n_recibo'] . "</td>"
                                              . "<td>" . $deudas_pago['fecha_pago'] . "</td>"
                                              . "<td>" . $deudas_pago['monto'] . "</td>"
                                              . "<td>" . $deudas_pago['fecha_vence'] . "</td>"
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
               </div>
           </section>
         </div>    
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
   $('#cantidad').change(function (){
        $("#total_mostrar").val($("#deuda_monto").val()*$("#cantidad").val());
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
