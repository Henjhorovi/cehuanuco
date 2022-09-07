<?php
session_start();
include 'conexion.php';
//var_dump($_SESSION);Exit;

if(empty($_SESSION['idcolegiadovoto']))
{
    header("Location: eleccioneslogin.php");
}
$contador=0;
$sql = $bd->prepare("SELECT COUNT(*) FROM votos WHERE id_colegiado=".$_SESSION['idcolegiadovoto']);
    $sql->execute();
    
    foreach($sql as $count){
        $contador=$count[0];
    }
if($contador==1){
    header("Location: eleccionesbug.php");
}    
include "eleccionesheader.php";
?>

       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
               <h1 style="font-size: 35px;font-weight: bold;color: #b03036;">
               ELECCIONES 2021
               <small>Votacion</small>
             </h1>

           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="font-size: 25px;font-weight: bold;">LISTA DE PARTIDOS</h3>
              <br><br>
            </div>
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                    <th>N°</th>
                  <th>NOMBRE</th>
                  <th>IMAGEN</th>
                  <th>VOTOS</th>
                </tr>
                </thead>
                
                <tbody>
                    <?PHP
                        
                        
                        $stmt = $bd->prepare("SELECT * FROM listapartido"); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            
                            echo "<tr><td style='width:3%;vertical-align:middle;text-align:center;font-size:150%;text-transform: uppercase;'> " . $colegiado['numero'] . "</td>"
                                    . "<td style='width:50%;vertical-align:middle;text-align:center;font-size:150%;text-transform: uppercase;'> " . $colegiado['nombre'] . "</td>"
                                    . "<td><center><img class='img-responsive' src='partido/".$colegiado['archivo']."' width='250px' height='250px'></center></td>"
                                    . "<td width='200px' style='vertical-align:middle;text-align:center;'><div class='btn-group'>
                        <a href='eleccionesconfirmar.php?id=" . $colegiado['id'] ."' class='btn btn-success btn-lg' title='VER PARTIDO'><b style='font-size:130%;'>VOTAR</b></a>
                        </div></td></tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>N°</th>
                  <th>NOMBRE</th>
                  <th>IMAGEN</th>
                  <th>VOTOS</th>
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
  include 'footer.php';
  ?>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#example2').DataTable({
      'paging'      : false,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : false,
      'autoWidth'   : false
    })
  })
</script>
