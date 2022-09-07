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
               COLEGIADOS
               <small>Reportes</small>
             </h1>
             <ol class="breadcrumb">
               <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
               <li class="active">Colegiados</li>
             </ol>
           </section>

           <!-- Main content -->
           <section class="content">
             
    <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
                <div class="row form-group col-md-3">
                    <div class="input-group">
                        <div class="input-group-addon">
                            <i class="fa fa-calendar"></i>
                        </div>
                        <input type="date" class="form-control" value="" id="fecha_pago" name="fecha_pago"  >
                    </div>
                </div>
                <a class="btn btn-info" style="width: 40px;height: 35px;" id="buscarreporte"><span class="oi oi-magnifying-glass"></span></a>
                <div style="float:right;"><button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal"><i class='fa fa-edit'></i> Exportar</button></div>
            </div>            
            <!-- /.box-header -->
            <div class="box-body" id="reportediario">
              
            </div>
          </div>
        </div>
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
  $(function () {
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false,
      dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'pdfHtml5'
        ]
    })
  })

  $( document ).ready(function() {
      $( '#buscarreporte' ).click(function()
        {
//                alert($('#rdni').val());
          $('#reportediario').load("rep_pordiamostrar.php?fecha=" +  $( '#fecha_pago' ).val());
        });
  });
</script>
<script src="js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="js/jszip.min.js" type="text/javascript"></script>
<script src="js/pdfmake.min.js" type="text/javascript"></script>
<script src="js/vfs_fonts.js" type="text/javascript"></script>
<script src="js/buttons.html5.min.js" type="text/javascript"></script>