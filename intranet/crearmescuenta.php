<?php
session_start();
//var_dump($_SESSION);Exit;

if(empty($_SESSION['dni']))
{
    header("Location: login.php");
}
include "header.php";

        //MENU ADMINISTRADOR
        if ($_SESSION['nivel']==2)
        {
            ?>    
       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
             <h1>
               RENDICION DE CUENTAS
               <small>Informaci&oacute;n</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Rendicion de Cuentas</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
               <form action="auxiliar.php" method="POST" id="formulario_crear">            
        <div class="row">
            <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">DATOS</h3>
            </div>
            <div class="box-body">
              <!-- phone mask -->
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> MES </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="" id="mes" name="mes" required="true">
                    <input type="hidden" value="18" id="op" name="op"
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa  fa-child">AÑO</i>
                  </div>
                    <select class="form-control" id="anio" name="anio">
                        <?php 
                            include 'conexion.php';
                            $stmt = $bd->prepare("SELECt*FROM anio ORDER BY anio ASC" ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            if($colegiado['anio']=='2020'){ ?>
                                <option value="<?PHP echo $colegiado['id']; ?>" selected=""><?PHP echo $colegiado['anio']; ?></option>
                            <?PHP }else{ ?>
                                <option value="<?PHP echo $colegiado['id']; ?>"><?PHP echo $colegiado['anio']; ?></option>
                            <?PHP }
                        }
                        ?>
                    </select>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>ARCHIVO</label>
                <div class="input-group">
                  <div class="input-group-addon">
                  </div>
                    <input type="file" class="form-control"  value="" id="archivo" name="archivo">
                </div>
              </div>
              <input type="submit" class='btn btn-success' value="Guardar">
            </div>
          </div>
        </div>
        </div>
      </form>
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
    $('#dni').focus();
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    });
    
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
                location.href="mescuenta.php";
//                window.locationf="comunicado.php";
//                $("#contenido").load("comunicado.php");
            }                            
        }).fail(function(){
        });
        e.preventDefault();
        return false;
     });
    });
</script>