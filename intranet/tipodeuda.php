<?php
session_start();
//var_dump($_SESSION);Exit;
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
               TIPO DE DEUDA
               <small>Principal</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Tipo de Deuda</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tipo de Deuda</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover" >
                <thead>
                <tr>
                  <th>DESCRIPCI&Oacute;N</th>
                  <th>MONTO</th>
                  <th>PAGO &Uacute;NICO</th>
                  <th>PAGO MENSUAL</th>
                  <th>PAGO ANUAL</th>
                  <th>PAGO VARIOS</th>
                  <th>ESTADO</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                    <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM tipo_pago" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            echo "<tr><td> " . utf8_encode($colegiado['descripcion']) . "</td><td> " . $colegiado['monto'] . "</td>"
                                    . "<td  align='center'> " . (($colegiado['pago_unico']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"")  . 
                                    "</td><td  align='center'>" . (($colegiado['pago_mensual']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"")   . "</td><td>" . 
                                    (($colegiado['pago_anual']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"") . "</td>"
                                    . "<td  align='center'> " . (($colegiado['pago_varios']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"") . "</td>"
                                    . "<td  align='center'> " . (($colegiado['estado']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"") . "</td>"
                                    . "<td></td>"
                                    . "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>DESCRIPCI&Oacute;N</th>
                  <th>MONTO</th>
                  <th>PAGO &Uacute;NICO</th>
                  <th>PAGO MENSUAL</th>
                  <th>PAGO ANUAL</th>
                  <th>PAGO VARIOS</th>
                  <th>ESTADO</th>
                  <th>ACCIONES</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
          <!-- /.box -->
        </div>
        <!-- /.col -->
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
