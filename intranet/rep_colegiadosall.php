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
               <small>Reportes</small>
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
                <a href='rep_colegiadoshab.php' class='btn btn-success'><i class='fa fa-list-ul'></i> Habilitados</a>
                <a href='rep_colegiadosdes.php' class='btn btn-success'><i class='fa fa-list-ul'></i> No Habilitados</a>
                <a href='rep_colegiadospre.php' class='btn btn-success'><i class='fa fa-list-ul'></i> Preferencial</a>
                <a href='rep_colegiadosall.php' class='btn btn-warning'><i class='fa fa-list-ul'></i> Todos</a>
                <div style="float:right;"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class='fa fa-edit'></i> Exportar</button></div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>N°</th>
                  <th>DNI</th>
                  <th>COLEGIADO</th>
                  <th>G</th>
                  <th>FECHA NAC.</th>
                  <th>FECHA HABILITACION</th>
                  <th>EMAIL</th>
                  <th>TELEFONO</th>
                  <th>DIRECCION</th>                  
                </tr>
                </thead>
                <tbody>
                    <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM colegiado" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            echo "<tr><td> " . $colegiado['nrocolegiatura'] . "</td><td> " . $colegiado['dni'] . "</td>"
                                    ."<td> " . $colegiado['apellidos'] . ", " . $colegiado['nombre'] . "</td>"
                                    . "<td> " . $colegiado['sexo'] . "</td>"
                                    . "<td> " . $colegiado['fecha_nacimiento'] . "</td>"
                                    . "<td> " . $colegiado['fecha_habilitacion'] . "</td>"
                                    . "<td> " . $colegiado['email'] . "</td>"
                                    . "<td> " . $colegiado['telefono'] . "</td>"
                                    . "<td> " . $colegiado['direccion'] . "</td>"                                    
                                    . "</tr>";
                        }
                    ?>
                </tbody>
                <tfoot>
                <tr>
                  <th>N°</th>
                  <th>DNI</th>
                  <th>COLEGIADO</th>
                  <th>G</th>
                  <th>FECHA NAC.</th>
                  <th>FECHA HABILITACION</th>
                  <th>EMAIL</th>
                  <th>TELEFONO</th>
                  <th>DIRECCION</th>                  
                </tr>
                </tfoot>
              </table>
            </div>
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
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">   
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Reportes</h4>
        </div>
        <div class="modal-body">
            <table class="table">
                <tr>
                    <td style="font-size:17px;">Por Numero</td>
                    <td width="100"><a href="reportes/reportes_todos/por_numero.php" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reportes_todos/pdfpor_numero.php" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>                
                </tr>
                <tr>
                    <td style="font-size:17px;">Por DNI</td>
                    <td width="100"><a href="reportes/reportes_todos/por_DNI.php" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                        <a href="reportes/reportes_todos/pdfpor_DNI.php" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Nombre</td>
                    <td width="100"><a href="reportes/reportes_todos/por_nombre.php" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reportes_todos/pdfpor_nombre.php" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Apellido</td>
                    <td width="100"><a href="reportes/reportes_todos/por_apellido.php" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reportes_todos/pdfpor_apellido.php" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Fecha Habilitacion</td>
                    <td width="100"><a href="reportes/reportes_todos/por_fechahabilitacion.php" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reportes_todos/pdfpor_fechahabilitacion.php" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>                    
                </tr>                
            </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>      
    </div>
</div>       
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
      'autoWidth'   : false,
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ]
    })
  })
</script>
<script src="js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="js/jszip.min.js" type="text/javascript"></script>
<script src="js/pdfmake.min.js" type="text/javascript"></script>
<script src="js/vfs_fonts.js" type="text/javascript"></script>
<script src="js/buttons.html5.min.js" type="text/javascript"></script>