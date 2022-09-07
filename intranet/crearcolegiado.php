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
               COLEGIADO
               <small>Informaci&oacute;n</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Colegiado</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
               <form action="auxiliar.php" method="post">             
<div class="row">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">DATOS PERSONALES</h3>
            </div>
            <div class="box-body">
              <!-- Date dd/mm/yyyy -->
              <div class="form-group">
                <label>DNI</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> DNI </i>
                  </div>
                    <input type="text" class="form-control input-lg" data-mask="" value="" id="dni" name="dni" required>
                    <input type="hidden" value="2" id="op" name="op">
                    <div class="input-group-addon">                    
                        <a href='#' class='btn btn-success' id="buscardni"><i class='fa fa-download'></i></a>
                  </div>
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NOMBRE </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="" id="nombre" name="nombre" required="true">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->
              <!-- Date mm/dd/yyyy -->
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> APELLIDOS</i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="" id="apellidos" name="apellidos" required="true">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa  fa-child"> DIRECCI&Oacute;N</i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="" id="direccion" name="direccion">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa  fa-child">SEXO</i>
                  </div>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="M">MASCULINO</option>
                        <option value="F">FEMENINO</option>
                    </select>
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group">
                <label>FECHA DE NACIMIENTO</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="date" class="form-control" value="" id="fecha_nacimiento" name="fecha_nacimiento"  >
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- phone mask -->
              <div class="form-group">
                <label>CELULAR</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                    <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" value="" id="celular" name="celular">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- IP mask -->
              <div class="form-group">
                <label>EMAIL</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-internet-explorer "></i>
                  </div>
                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" value="" id="email" name="email">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">COLEGIATURA</h3>
            </div>
            <div class="box-body">
              <!-- Color Picker -->
              <div class="form-group">
                  <label>NRO COLEGIACI&Oacute;N</label>
                  
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-dashboard"></i>
                  </div>
                    <input type="number" class="form-control" value="" id="numero_colegiatura" name="numero_colegiatura" required="true">
                </div>
                  
              </div>
              <div class="form-group">
                  <label>HABILITADO HASTA</label>
                  
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="date" class="form-control" value="" id="fecha_colegiatura" name="fecha_colegiatura" required="true">
                </div>
                  
              </div>
              <!-- /.form group -->

              <!-- Color Picker -->
              <div class="form-group">
                  <label>FECHA DE T&Iacute;TULO</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="date" class="form-control" value="" id="fecha_titulo" name="fecha_titulo" >
                </div>
                </div>
                <div class="form-group">
                  <label>ESTADO</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-asterisk"></i>
                  </div>
                    <select id="estado" name="estado" class="form-control">
                        <option value="1">ACTIVO</option>
                        <option value="0">DESACTIVO</option>
                    </select>
                </div>
                </div>
              <div class="form-group">
                  <label>UNIVERSIDAD</label>

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-asterisk"></i>
                  </div>
                    <select id="universidad" name="universidad" class="form-control">
                    <?php 
                    include 'conexion.php';
                        $uni = $bd->prepare("SELECT * FROM universidad"); 
                        $uni->execute();
                        foreach($uni as $univer)
                        {
                            echo "<option value=".$univer['id_universidad'].">".utf8_encode($univer['nombre'])."</option>";
                        }
                    ?>
                    
                    </select>
                </div>
                </div>
              
              <input type="submit" class='btn btn-success' value="Guardar">
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
               </form>
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
  $('#buscardni').click(function (){
       $.ajax({
            type: "POST",
            url: "auxiliar.php",
            dataType: "json",
            data: {op:1,std_dni:$("#dni").val()},
            success: function(result){
                  $("#nombre").val(result.nombres);
                  $("#apellidos").val(result.apepat + " " + result.apemat);
                  $("#direccion").val(result.direccion);
             }
           });

    
    });
   
    });
  
</script>
