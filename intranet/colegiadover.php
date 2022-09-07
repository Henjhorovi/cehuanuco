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
             
<div class="row">
     <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM colegiado WHERE id = " . $_GET['id'] ); 
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
                        
                    ?>
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
                    <input type="text" class="form-control input-lg" data-mask="" id="dni" name="dni" value="<?php echo $colegiado['dni'] ?>">
                    <input type="hidden" value="3" id="op" name="op">
                    <input type="hidden" value="<?php echo $_GET['id']; ?>" id="id" name="id">
                    <div class="input-group-addon">                    
                        <a href='#' class='btn btn-success' id="buscardni"><i class='fa fa-download'></i></a>
                  </div>
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
                  <?php if($colegiado['sexo']=='M'){ ?>
                    <select class="form-control" id="sexo" name="sexo">
                        <option value="M">MASCULINO</option>
                        <option value="F">FEMENINO</option>
                    </select>
                    <?php }else{ ?>
                        <select class="form-control" id="sexo" name="sexo">
                            <option value="F">FEMENINO</option>
                            <option value="M">MASCULINO</option>
                    </select>
                    <?php } ?>
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
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="<?php echo $colegiado['fecha_nacimiento'] ?>" >
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
                  <label>HABILITADO HASTA</label>
                  
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                    <input type="date" class="form-control" value="<?php echo $colegiado['habilitado_hasta'] ?>" id="fecha_colegiatura" name="fecha_colegiatura" required="true">
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
                        <?php if($colegiado['estado']==1){ ?>
                            <option value="1" selected>ACTIVO</option>
                            <option value="0">DESACTIVO</option>
                        <?php }else{ ?>
                        <option value="1">ACTIVO</option>
                        <option value="0" selected>DESACTIVO</option>
                        <?php } ?>
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
                    <?php $sql = $bd->prepare("SELECT * FROM universidad"); 
                        $sql->execute();
                        foreach($sql as $universidad)
                        {   if($universidad['id_universidad']==$colegiado['universidad']){
                            echo '<option value="'.$universidad['id_universidad'].'" selected>'.utf8_encode($universidad['nombre']).' </option>';
                        }else{
                            echo '<option value="'.$universidad['id_universidad'].'">'.utf8_encode($universidad['nombre']).' </option>';
                        }
                        } }?>
                    </select>
                </div>    
                </div>
              
              <input type="submit" class='btn btn-success' value="Guardar">
                <!-- /.input group -->
                
              </div>
              <!-- /.form group -->
            </div>
            <!-- /.box-body -->
            <div class="box box-success">
            <div class="form-group">
                    <label>REGISTRO GOLEGIADO</label>

                <div class="input-group">
                    <!--<a href="#" target="_blank"><img src="dist/img/excel.png" alt="" width="30%"/></a>-->
                    <?php 
                        $count = $bd->prepare("SELECT COUNT(*) FROM registro WHERE colegiado_id=".$_GET['id']); 
                        $count->execute();
                        $contar=1;
                        foreach($count as $row)
                        {
                            $contar=$row[0]+1;
                        }
                        $sqlx = $bd->prepare("SELECT * FROM registro WHERE colegiado_id=".$_GET['id']." ORDER BY id_r DESC LIMIT 1"); 
//                        var_dump($sqlx);
                        $sqlx->execute();
                        foreach($sqlx as $excel)
                        {   }
                            if($contar==1){
                                echo "<h3><b>Aun no ha rellenado el registro</b><h3>";
                            }else{
                                echo '<a href="registro/'.$excel['archivo'].'" target="_blank"><img src="dist/img/excel.png" alt="" width="15%"/></a>';
                            }
                            ?>
                </div>    
                </div>
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
        else 
        {
            exit;
        }
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
<!-- DataTables -->
