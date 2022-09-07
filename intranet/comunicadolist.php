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
               COMUNICADOS
               <small>Principal</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
               <li class="active">Comunicados</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">COMUNICADOS</h3>
              <br><br>
              <a href='crearcomunicadolist.php' class='btn btn-success'><i class='fa fa-plus-circle'></i> Agregar</a>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>FECHA INICIO</th>
                  <th>FECHA FIN</th>
                  <th>ARCHIVO</th>
                  <th>ACCIONES</th>
                </tr>
                </thead>
                <tbody>
                    <?PHP
                        include 'conexion.php';
                        $sql = $bd->prepare("SELECT CURDATE()" );
                        $sql->execute();
                        foreach($sql as $fech){
                            $fechaactual=$fech[0];
                        }
                        
                        $stmt = $bd->prepare("SELECT * FROM comunicado" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            if($fechaactual>=$colegiado['fecha_inicio'] && $fechaactual<=$colegiado['fecha_fin']){
                                $sqlx="UPDATE comunicado SET estado='1' WHERE id=".$colegiado['id'];
                                $stmt = $bd->prepare($sqlx); 
                                $stmt->execute();
                            }else{
                                    $sqlx="UPDATE comunicado SET estado='0' WHERE id=".$colegiado['id'];
                                    $stmt = $bd->prepare($sqlx); 
                                    $stmt->execute();                             
                            }
                            echo "<tr><td> " . $colegiado['fecha_inicio'] . "</td>"
                                    . "<td> " . $colegiado['fecha_fin'] . "</td>"
                                    . "<td> " . $colegiado['archivo'] . "</td>"
                                    . "<td width='100px'><div class='btn-group'>
                        <a href='comunicadover.php?id=" . $colegiado['id'] ."' class='btn btn-success' title='VER COMUNICADO'><i class='fa fa-eye'></i></a>
                        <a href='eliminarcomunicado.php?id=" . $colegiado['id'] ."' class='btn btn-danger' title='ELIMINAR'><i class='fa fa-trash'></i></a>
                        </div></td></tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>FECHA INICIO</th>
                  <th>FECHA FIN</th>
                  <th>ARCHIVO</th>
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
