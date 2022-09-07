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
               UNIVERSIDAD
               <small>Informaci&oacute;n</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Universidad</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
     <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM universidad WHERE id_universidad = " . $_GET['id'] ); 
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
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NOMBRE </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['nombre'] ?>" id="nombre" name="nombre" required="true">
                    <input type="hidden" value="<?php echo $colegiado['id_universidad'] ?>" id="iduni" name="iduni">
                    <input type="hidden" value="7" id="op" name="op">
                </div>
                  <input type="submit" class='btn btn-success' value="Guardar">
              </div>
            </div>
            <!-- /.box-body -->           
          </div>         
          <!-- /.box -->
        </div>
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
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
<!-- DataTables -->
