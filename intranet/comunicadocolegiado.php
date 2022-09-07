 <?php
session_start();
//var_dump($_SESSION);Exit;

if(empty($_SESSION['dni']))
{
    header("Location: login.php");
}
include "header.php";
?>
<!--<link href="bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js" type="text/javascript"></script>-->
<link href="css/comunicado.css" rel="stylesheet" type="text/css"/>
<script src="js/jquery-1.11.1.js" type="text/javascript"></script>
<!------ Include the above in your HEAD tag ---------->
<div class="content-wrapper">
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
<section class="gallery">
  <div class="carousel">
    <?php
        include 'conexion.php';
        $sql = $bd->prepare("SELECT CURDATE()" );
        $sql->execute();
        foreach($sql as $fech){
            $fechaactual=$fech[0];
        }
        
        $stmt = $bd->prepare("SELECT * FROM comunicado WHERE estado=1" ); 
        $stmt->execute();
        $cont=0;
        $i=1;
        foreach($stmt as $colegiado)
        {
            if($fechaactual>=$colegiado['fecha_inicio'] && $fechaactual<=$colegiado['fecha_fin']){
                $sqlx="UPDATE comunicado SET estado='1' WHERE id=".$colegiado['id'];
                $stmt = $bd->prepare($sqlx); 
                $stmt->execute();
            }else{
                $sqlx="UPDATE comunicado SET estado='0' WHERE id=".$colegiado['id'];
                $stmt = $bd->prepare($sqlx); 
                $stmt->execute();
            }
            if($cont==0){
                ?>
                    <input type="radio" id="image<?php echo $i; ?>" name="gallery-control" checked>
                <?php        
            }
            else{
                ?>
                    <input type="radio" id="image<?php echo $i; ?>" name="gallery-control">
                <?php 
            }
            $cont++;
            $i++;
        }
      ?>
<!--    <input type="radio" id="image1" name="gallery-control" checked>
    <input type="radio" id="image2" name="gallery-control">
    <input type="radio" id="image3" name="gallery-control">
    <input type="radio" id="image4" name="gallery-control">-->
    
    
    <input type="checkbox" id="fullscreen" name="gallery-fullscreen-control"/>
    
    <div class="wrap">
      <?php
        $stmt = $bd->prepare("SELECT * FROM comunicado WHERE estado=1" ); 
        $stmt->execute();
        $j=1;
        foreach($stmt as $colegiado)
        {
        ?>
            <figure>
                <label for="fullscreen">
                    <img src="comunicados/<?php echo $colegiado['archivo']; ?>" alt="image<?php echo $j; ?>"/>
                </label>
            </figure>
        <?php 
        $j++;
        }
      ?>
    </div>
    
    <div class="thumbnails">
      
      <div class="slider"><div class="indicator"></div></div>
      <?php
        $stmt = $bd->prepare("SELECT * FROM comunicado WHERE estado=1" ); 
        $stmt->execute();
        $j=1;
        foreach($stmt as $colegiado)
        {
        ?>
            <label for="image<?php echo $j; ?>" class="thumb" style="background-image: url('comunicados/<?php echo $colegiado['archivo']; ?>')"></label>
        <?php 
        $j++;
        }
      ?>
    </div>
        </div>
      </section>
    </div>
<?php
  include 'footer.php';
?>
