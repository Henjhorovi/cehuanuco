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
               RENDICION DE CUENTAS
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
                        $stmt = $bd->prepare("SELECT * FROM mescuenta WHERE id = " . $_GET['id'] );
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
                    <i class="fa  fa-child"> MES </i>
                  </div>
                    <input type="hidden" value="20" id="op" name="op">
                    <input type="hidden" value="<?php echo $colegiado['id'] ?>" id="id" name="id">
                    <input type="text" class="form-control" data-mask="" id="mes" name="mes" required="true" value="<?php echo $colegiado['mes'] ?>" readonly="">
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa  fa-child">AÑO</i>
                  </div>
                    <select class="form-control" id="anio" name="anio" disabled="">
                        <?php 
                        $stmt = $bd->prepare("SELECT*FROM anio ORDER BY anio ASC"); 
                        $stmt->execute();
                        foreach($stmt as $mes)
                        {
                            if($colegiado['id_anio']==$mes['id']){ ?>
                                <option value="<?PHP echo $mes['id']; ?>" selected=""><?PHP echo $mes['anio']; ?></option>
                            <?PHP }else{ ?>
                                <option value="<?PHP echo $mes['id']; ?>"><?PHP echo $mes['anio']; ?></option>
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
                    <input type="text" class="form-control"  value="<?php echo $colegiado['archivo'] ?>" id="archivoant" name="archivoant" readonly="">
                </div>
              </div>
              <input type="submit" class='btn btn-success' value="Eliminar">
            </div>
          </div>       
          <!-- /.box -->
        </div>
               </form>
</div>
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
                location.href="mescuenta.php";
            }                            
        }).fail(function(){
        });
        e.preventDefault();
        return false;
     });
   
    });
</script>
