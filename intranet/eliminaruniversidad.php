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
                    ?>
        <form action="auxiliar.php" method="post">             
        <div class="">
        <div class="col-md-6">

          <div class="box box-danger">
            <div class="box-header">
              <h3 class="box-title">DATOS</h3>
            </div>
            <div class="box-body">
              <div class="form-group">
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa  fa-child"> NOMBRE </i>
                  </div>
                    <input type="text" class="form-control" data-mask="" value="<?php echo $colegiado['nombre'] ?>" id="nombre" name="nombre" disabled="true">
                    <input type="hidden" value="<?php echo $colegiado['id_universidad'] ?>" id="iduni" name="iduni">
                    <input type="hidden" value="8" id="op" name="op">
                </div>
                  <input type="submit" class='btn btn-danger' value="Eliminar">
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
