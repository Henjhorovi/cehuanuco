
<table id="example2" class="table table-bordered table-hover">
    <thead>
    <tr>
      <th>#</th>
      <th>N°</th>
      <th>DNI</th>
      <th>COLEGIADO</th>
      <th>FECHA HABILITACION</th>
      <th>MODO</th>
      <th>RECIBO</th>
      <th>FECHA PAGO</th>
      <th>MONTO</th>
    </tr>
    </thead>
    <tbody>
        <?PHP
            $fechapago=$_GET['fecha'];
//            $_SESSION['fechapago']=$_GET['fecha'];
            include 'conexion.php';                   
            $stmt = $bd->prepare("SELECT*FROM colegiado AS c INNER JOIN deudas AS d ON c.id=d.colegiado_id WHERE DATE(fecha_pago)='".$fechapago."'" ); 
            $stmt->execute();
            $j=1;
            foreach($stmt as $colegiado)
            {
                echo "<tr><td> " . $j . "</td>"
                ."<td> " . $colegiado['nrocolegiatura'] . "</td><td> " . $colegiado['dni'] . "</td>"
                ."<td> " . $colegiado['apellidos'] . ", " . $colegiado['nombre'] . "</td>"
                . "<td> " . $colegiado['fecha_habilitacion'] . "</td>"
                . "<td> " . $colegiado['modopago'] . "</td>"
                . "<td> " . $colegiado['recibo'] . "</td>"
                . "<td> " . $colegiado['fecha_pago'] . "</td>"
                . "<td> " . $colegiado['monto'] . "</td>"
                . "</tr>";
                $j++;
            }
        ?>
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>N°</th>
        <th>DNI</th>
        <th>COLEGIADO</th>
        <th>FECHA HABILITACION</th>
        <th>MODO</th>
        <th>RECIBO</th>
        <th>FECHA PAGO</th>
        <th>MONTO</th>                  
    </tr>
    </tfoot>
</table>
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
                    <td width="100"><a href="reportes/reporte_pordia/por_numero.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reporte_pordia/pdfpor_numero.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>                
                </tr>
                <tr>
                    <td style="font-size:17px;">Por DNI</td>
                    <td width="100"><a href="reportes/reporte_pordia/por_DNI.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                        <a href="reportes/reporte_pordia/pdfpor_DNI.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Nombre</td>
                    <td width="100"><a href="reportes/reporte_pordia/por_nombre.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reporte_pordia/pdfpor_nombre.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Apellido</td>
                    <td width="100"><a href="reportes/reporte_pordia/por_apellido.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reporte_pordia/pdfpor_apellido.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>
                </tr>
                <tr>
                    <td style="font-size:17px;">Por Fecha Habilitacion</td>
                    <td width="100"><a href="reportes/reporte_pordia/por_fechahabilitacion.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>&nbsp;&nbsp;&nbsp;
                    <a href="reportes/reporte_pordia/pdfpor_fechahabilitacion.php?fecha='<?php echo $fechapago;?>'" target="_blank"><img src="dist/img/pdf.png" alt="" width="40%"/></a></td>                    
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