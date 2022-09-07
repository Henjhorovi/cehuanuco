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
        <?PHP
        //MENU ADMINISTRADOR
        if ($_SESSION['nivel']==2)
        {
            ?>    
       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
             <h1>
               LISTA DE PARTIDOS
               <small>Informaci&oacute;n</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Lista de Partidos</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
            
     <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM listapartido WHERE id = " . $_GET['id'] ); 
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
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NUMERO </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['numero'] ?>" id="numero" name="numero" required="true">
                    <input type="hidden" value="<?php echo $colegiado['id'] ?>" id="id" name="id">
                    <input type="hidden" value="22" id="op" name="op"
                <!-- /.input group -->
              </div>
              <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NUMERO </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['nombre'] ?>" id="nombre" name="nombre" required="true">
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <label>ARCHIVO</label>
                <div class="input-group">
                  <div class="input-group-addon">
                  </div>
                    <input type="text" class="form-control"  value="<?php echo $colegiado['archivo'] ?>" id="archivoant" name="archivoant">
                    <input type="file" class="form-control"  value="" id="archivo" name="archivo">
                </div>
              </div>
              <div class="form-group">
                <label>PDF</label>
                <div class="input-group">
                  <div class="input-group-addon">
                  </div>
                    <input type="text" class="form-control"  value="<?php echo $colegiado['file'] ?>" id="fileant" name="fileant">
                    <input type="file" class="form-control"  value="" id="file" name="file">
                </div>
              </div>
              <input type="submit" class='btn btn-success' value="Guardar">
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
                location.href="listapartido.php";
            }                            
        }).fail(function(){
        });
        e.preventDefault();
        return false;
     });
   
    });
</script>
