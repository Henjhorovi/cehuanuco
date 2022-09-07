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
            include "interfaz_administrador.php";
        }
        else 
        {
            include "interfaz_colegiado.php";
        }
            ?>
        
        
  <?php
  include 'footer.php';
  ?>
