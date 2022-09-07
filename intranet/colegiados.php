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
               COLEGIADOS
               <small>Principal</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Colegiados</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">COLEGIADOS</h3>
              <br><br>
                <a href='crearcolegiado.php' class='btn btn-success'><i class='fa fa-plus-circle'></i> Agregar</a>
                <a href='verificar.php' class='btn btn-danger' style="float: right;"><i class='fa fa-check-circle'></i> Verificar</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>NUMERO</th>
                  <th>DNI</th>
                  <th>COLEGIADO</th>
                  <th>HABILITADO HASTA</th>
                  <th>ESTADO</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                    <?PHP
                        include 'conexion.php';
                        $sql = $bd->prepare("SELECT CURDATE()" );
                        $sql->execute();
                        foreach($sql as $fech){
                            $fechaactual="'".$fech[0]."'";
                        }
                        $stmt = $bd->prepare("SELECT * FROM colegiado ORDER BY nrocolegiatura ASC" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            echo "<tr><td> " . $colegiado['nrocolegiatura'] . "</td><td> " . $colegiado['dni'] . "</td>"
                                    . "<td> " . $colegiado['apellidos'] . ", " . $colegiado['nombre'] . "</td><td> " . 
                                    $colegiado['habilitado_hasta'] . "</td>"
                                    . "<td> " . (($colegiado['estado']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"")  . "</td>"
                                    . "<td><div class='btn-group'>
                      <a href='colegiadover.php?id=" . $colegiado['id'] ."' class='btn btn-success' title='VER COLEGIADO'><i class='fa fa-eye'></i></a>
                      <a href='pagos.php?id=" . $colegiado['id'] ."' class='btn btn-danger' title='REALIZAR PAGOS'><i class='fa fa-money'></i></a>
                      <a href='imprimirconstancia.php?id=" . $colegiado['id'] ."' class='btn btn-warning' title='IMPRIMIR CONSTANCIA' target='_blank'><i class='fa fa-clipboard'></i></a>
                    </div></td>"
                                    . "</tr>";
                        }
                        
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>NUMERO</th>
                  <th>DNI</th>
                  <th>COLEGIADO</th>
                  <th>FECHA HABILITACION</th>
                  <th>ESTADO</th>
                  <th>ACCIONES</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
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
