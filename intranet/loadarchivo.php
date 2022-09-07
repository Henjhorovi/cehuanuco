<?php
$tipo = $_GET['arch'];
$otro = 'OTRO';
if($tipo==$otro){
    ?>
    <label>ARCHIVO</label>
    <div class="form-group">
        <input type="file" class="form-control" id="archivo" name="archivo">
    </div>   
    <?php
}else{
   ?>
    <?php
}
