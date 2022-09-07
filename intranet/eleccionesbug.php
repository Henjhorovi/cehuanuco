<?php
session_start();
if(empty($_SESSION['idcolegiadovoto']))
{
    header("Location: eleccioneslogin.php");
}
include 'conexion.php';

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
                    <h2>USTED YA HA REALIZADO SU VOTO</h2> 
                    <img src="partido/votacionralizada.jpg" width="400px">
                    <br><br>
                </center> 
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


