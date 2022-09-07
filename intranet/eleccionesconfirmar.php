<?php
session_start();
include 'conexion.php';
//var_dump($_SESSION);Exit;

if(empty($_SESSION['idcolegiadovoto']))
{
    header("Location: eleccioneslogin.php");
}
$contador=0;
$sql = $bd->prepare("SELECT COUNT(*) FROM votos WHERE id_colegiado=".$_SESSION['idcolegiadovoto']);
    $sql->execute();
    
    foreach($sql as $count){
        $contador=$count[0];
    }
if($contador==1){
    header("Location: eleccionesbug.php");
} 
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
                <h3 class="box-title" style="font-size: 25px;font-weight: bold;">CONFIRMAR VOTO</h3>
              <br><br>
            </div>
            <div class="box-body">
                <center>
                    <h2>Usted ha seleccionado:</h2> 
                    <?PHP
                        
                        $stmt = $bd->prepare("SELECT * FROM listapartido WHERE id='".$_GET['id']."'"); 
                        $stmt->execute();
                        foreach($stmt as $colegiado)
                        {
                            $_SESSION['idpartido']=$colegiado['id'];
                    ?> 
                    <img src="partido/<?php echo $colegiado['archivo']; ?>" width="400px">
                    <h2><?PHP echo $colegiado['nombre']; ?></h2>
                    <br><br>
                    <a href='eleccionarvotacion.php?id=<?PHP echo $colegiado['id']; ?>' class='btn btn-success btn-lg' title='CONFIRMAR VOTO'><b style='font-size:130%;'>CONFIRMAR</b></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <a href='eleccionespartidos.php' class='btn btn-danger btn-lg' title='VOLVER'><b style='font-size:130%;'>VOLVER</b></a>
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
  ?>

