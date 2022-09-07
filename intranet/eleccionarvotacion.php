<?php
session_start();
if(empty($_SESSION['idcolegiadovoto']))
{
    header("Location: eleccioneslogin.php");
}
include 'conexion.php';

$sql = $bd->prepare("SELECT CURDATE()");
    $sql->execute();
    foreach($sql as $fech){
        $fechaactual=$fech[0];
    }

$sql = $bd->prepare("SELECT CURTIME()");
    $sql->execute();
    foreach($sql as $fech){
        $horaactual=$fech[0];
    }
                        
$stmt = $bd->prepare("INSERT INTO votos(id_colegiado, id_partido, fecha, hora) VALUES(".$_SESSION['idcolegiadovoto'].", ".$_GET['id'].", '".$fechaactual."', '".$horaactual."')"); 
if(!$stmt->execute()){
    header("Location: eleccioneslogin.php");
}else{
include "eleccionesheader.php";
?>

       <div class="content-wrapper">
           <!-- Content Header (Page header) -->
           <section class="content-header">
               <h1 style="font-size: 35px;font-weight: bold;color: #b03036;">
               ELECCIONES 2021
               <small>Votacion</small>
             </h1>

           </section>

           <!-- Main content -->
           <section class="content">
             
<div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <h3 class="box-title" style="font-size: 25px;font-weight: bold;">VOTO REALIZADO CON EXITO</h3>
              <br><br>
            </div>
            <div class="box-body">
                <center>
                    <h2>Usted ha votado por:</h2> 
                    <?PHP
                        include 'conexion.php';
                        $stmt = $bd->prepare("SELECT * FROM listapartido WHERE id='".$_GET['id']."'"); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            $_SESSION['idpartido']=$colegiado['id'];
                    ?> 
                    <img src="partido/<?php echo $colegiado['archivo']; ?>" width="400px">
                    <h2><?PHP echo $colegiado['nombre']; ?></h2>
                    <br><br>
                </center> 
                    <?PHP } ?>
            </div>
            <!-- /.box-body -->
          </div>
        </div>
        <!-- /.col -->
      </div>
           </section>
           <!-- /.content -->
         </div>
  <?php
  include 'footer.php';
}


