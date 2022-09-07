<?php
session_start();
if(empty($_SESSION['dni']))
{
    header("Location: login.php");
}
include "header.php";
?>
        <?PHP
        //MENU ADMINISTRADOR
        if ($_SESSION['nivel']==2)
        {
            ?>    
       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
             <h1>
               COMUNICADO
               <small>Informaci&oacute;n</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Comunicado</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
     <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM comunicado WHERE id = " . $_GET['id'] ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                    ?>
    <form action="auxiliar.php" method="POST" id="formulario_crear">
        <div class="col-md-6">
          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">DATOS</h3>
            </div>
            <div class="box-body">
              <!-- phone mask -->
              <div class="form-group">
                <label>FECHA INICIO</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="hidden" value="11" id="op" name="op">
                    <input type="hidden" value="<?php echo $colegiado['id'] ?>" id="iduni" name="idarc">
                    <input type="date" class="form-control" value="<?php echo $colegiado['fecha_inicio'] ?>" disabled="">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>FECHA FIN</label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="date" class="form-control" value="<?php echo $colegiado['fecha_fin'] ?>" disabled="">
                </div>
              </div>
              <div class="form-group">
                <label>ARCHIVO</label>
                <div class="input-group">
                  <div class="input-group-addon">
                  </div>
                    <input type="text" class="form-control"  value="<?php echo $colegiado['archivo'] ?>" disabled="">
                </div>
              </div>
              <input type="submit" class='btn btn-danger' value="Eliminar">
            </div>
          </div>         
          <!-- /.box -->
        </div>
               </form>
           </section>
           <!-- /.content -->
         </div>
            <?php
            }
        }
        else 
        {
            exit;
        }
  include 'footer.php';
  ?>
<script>
    $(document).ready(function() {
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
                location.href="comunicadolist.php";
            }                            
        }).fail(function(){
        });
        e.preventDefault();
        return false;
     });
   
    });
</script>
