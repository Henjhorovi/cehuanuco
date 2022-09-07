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
             
<div class="row">
     <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM colegiado WHERE id = " . $_SESSION['id'] ); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
//                            echo "<tr><td> " . $colegiado['nrocolegiatura'] . "</td><td> " . $colegiado['dni'] . "</td>"
//                                    . "<td> " . $colegiado['apellidos'] . ", " . $colegiado['nombre'] . "</td><td> " . 
//                                    $colegiado['fecha_habilitacion'] . "</td>"
//                                    . "<td> " . (($colegiado['estado']==1) ? "<i class='fa fa-fw fa-check-circle'></i>":"")  . "</td>"
//                                    . "<td><div class='btn-group'>
//                      <a href='colegiadover.php?id=" . $colegiado['id'] ."' class='btn btn-success'><i class='fa fa-eye'></i></button>
//                      <a href='colegiadover.php?id=" . $colegiado['id'] ."' class='btn btn-danger'><i class='fa fa-money'></i></button>
//                      <a href='colegiadover.php?id=" . $colegiado['id'] ."' class='btn btn-info'><i class='fa fa-cogs'></i></button>
//                    </div></td>"
//                                    . "</tr>";
                        }
                    ?>         
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
                    <input type="text" class="form-control input-lg" data-mask="" id="dni" name="dni" value="<?php echo $colegiado['dni'] ?>">
                </div>
                <br>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> PASSWORD </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" id="clave" name="clave" value="<?php echo $colegiado['clave'] ?>">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">

                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NOMBRE </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['nombre'] ?>" id="nombre" name="nombre" required="true">
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
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['apellidos'] ?>" id="apellidos" name="apellidos" required="true">
                </div>
                <!-- /.input group -->
              </div>
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                      <i class="fa  fa-child"> DIRECCI&Oacute;N</i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['direccion'] ?>" id="direccion" name="direccion">
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
                    <input type="date" class="form-control" value="" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $colegiado['fecha_nacimiento'] ?>" >
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
                    <input type="text" class="form-control" data-inputmask="'mask': ['999-999-9999 [x99999]', '+099 99 99 9999[9]-9999']" value="<?php echo $colegiado['telefono'] ?>" id="celular" name="celular" >
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
                    <input type="text" class="form-control" data-inputmask="'alias': 'ip'" value="<?php echo $colegiado['email'] ?>" id="email" name="email" >
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
                    <input type="number" class="form-control" value="<?php echo $colegiado['nrocolegiatura'] ?>" id="numero_colegiatura" name="numero_colegiatura" required="true">
                </div>
                  
              </div>
              <div class="form-group">
                  <label>FECHA DE COLEGIACI&Oacute;N</label>
                  
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="date" class="form-control" value="<?php echo $colegiado['fecha_habilitacion'] ?>" id="fecha_colegiatura" name="fecha_colegiatura" required="true">
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
                  <input type="date" class="form-control" value="<?php echo $colegiado['fecha_titulo'] ?>" id="fecha_titulo" name="fecha_titulo" >
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
              
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              
            </div>
            <!-- /.box-body -->
            <?PHP 
            if($colegiado['estado']==1){?>
            <a href='imprimirconstancia.php?id=<?PHP echo $colegiado['id'] ?>' class='btn btn-warning' title='IMPRIMIR CONSTANCIA'><i class='fa fa-clipboard'> IMPRIMIR CONSTANCIA</i></a>
            <?PHP
            } ?>
            <a href='registro/REGISTRO_DE_COLEGIADOS.xlsx' class='btn btn-success' title='IMPRIMIR CONSTANCIA' target='_blank'><i class='fa fa-clipboard'> DESCARGAR REGISTRO</i></a>
            Descargue el formato de registro rellenelo y vuelvalo a subir.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <?php 
                $count = $bd->prepare("SELECT COUNT(*) FROM registro WHERE colegiado_id=".$_SESSION['id']); 
                $count->execute();
                $contar=1;
                foreach($count as $row)
                {
                    $contar=$row[0]+1;
                }
                $sqlx = $bd->prepare("SELECT * FROM registro WHERE colegiado_id=".$_SESSION['id']." ORDER BY id_r DESC LIMIT 1"); 
//                        var_dump($sqlx);
                $sqlx->execute();
                foreach($sqlx as $excel)
                {   }
                    if($contar==1){

                    }else{
                        echo '<a href="registro/'.$excel['archivo'].'" target="_blank" title="Descargar Archivo Rellenado"><img src="dist/img/excel.png" alt="" width="7%"/></a>';
                    }
            ?>
            <br><br>
            <?PHP 
            ?>
            <div class="box box-success">
                <div class="box-header">
                    <h3 class="box-title">REGISTRO</h3>
                  </div>
                <div class="box-body">
                    <form id="formulario_crear" method="POST">    
                <div class="col-md-10"> 
                    <label>SUBIR ARCHIVO DE REGISTRO</label>
                    <div class="form-group">
                        <?PHP
                            if($contar==1){
                        ?>
                                <input type="hidden"  name="op" value="13">
                        <?PHP
                            }else{
                        ?>
                                <input type="hidden"  name="op" value="14">
                        <?PHP
                            }
                        ?>
                        <input type="hidden"  value="<?php echo $_SESSION['id']; ?>" id="idcolegiado" name="idcolegiado">
                        <input type="file" class="form-control" id="archivo" name="archivo">
                    </div>                                
                  </div>
                  <div class="col-md-1"> 
                    <br>
                    <div class="form-group">
                        <input type="submit" id="subir" name="subir" class="btn btn-danger" value="SUBIR">
                    </div> 
                  </div> 
                </form>    
                </div>
            </div>  
        </div>
                 
        </div>
           </section>
           <!-- /.content -->
         </div>
            <?php
        }
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
<!-- DataTables -->
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
//                location.reload(true);
            }                            
        }).fail(function(){
            });
            e.preventDefault();
            return false;
         });
     
    });
  
</script>