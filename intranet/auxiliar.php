<?php
session_start();
switch($_POST['op'])
{
    case 1: //consulta dni
            $json = file_get_contents('http://www.munihuanuco.gob.pe/intranetmunihco/wspide.php?numdoc=' . trim($_POST['std_dni']) .'&m=d');
            //    $json = file_get_contents('http://localhost/intranetmunihco/wspide.php?numdoc=42883191&m=d');

            $json = utf8_encode($json); 
            //$json = substr($json, 6,  strlen($json)-3);
            //VAR_DUMP($json);EXIT;
            $obj = json_decode($json,true);
            $json_new= $obj['data']['data'];
            
            echo json_encode($json_new);
        break;
    case 2:
        include 'conexion.php';
        $sql= "INSERT INTO `colegiado` (`nrocolegiatura`,`dni`,`nombre`,`apellidos`,`clave`,`sexo`,`fecha_nacimiento`,`fecha_titulo`,`fecha_habilitacion`,
            `estado`,`nivel`,`email`,`telefono`,`direccion`,`habilitado_hasta`,`universidad`) VALUES
                (" . $_POST['numero_colegiatura'] . ",'" . $_POST['dni'] . "','" . $_POST['nombre'] . "','" . $_POST['apellidos'] . "'
                    ,'" . substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 6) . 
                "','" . $_POST['sexo'] . "','" . $_POST['fecha_nacimiento'] . "','" . $_POST['fecha_titulo'] . "',
                '" . $_POST['fecha_colegiatura'] . "','" . $_POST['estado'] . "',1,'" . $_POST['email'] . "','" . $_POST['celular'] . "','" . $_POST['direccion'] . "','" . $_POST['fecha_colegiatura'] . "','" . $_POST['universidad'] . "');";
        
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: colegiados.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }

        break;
    case 3:
        include 'conexion.php';
        if($_POST['fecha_nacimiento']==''){
            $fechanac='null';
        }else{
            $fechanac="'".$_POST['fecha_nacimiento']."'";
        }
        if($_POST['fecha_titulo']==''){
            $fechatit='null';
        }else{
            $fechatit="'".$_POST['fecha_titulo']."'";
        }
        $dia=substr($_POST['fecha_colegiatura'],8,10);
        $mes= substr($_POST['fecha_colegiatura'], 5,-3);
        $ano=substr($_POST['fecha_colegiatura'],0,4);

        switch ($mes){
            case 1:  case 3: case 5: case 7: case 8: case 10: case 12:
                $dia=31;
                break;
            case 2:   
                if($ano%4==0){
                    $dia=29;
                }else{
                    $dia=28;
                }
                break;
            case 4: case 6: case 9: case 11:   
                $dia=30;
                break;
        }
        $fechahab="'".$ano."-".$mes."-".$dia."'";
        $sql= "UPDATE `colegiado` SET "
                . "`nrocolegiatura`=" . $_POST['numero_colegiatura'] . ",
                    `dni`='" . $_POST['dni'] . "',
                    `clave`='" . $_POST['clave'] . "',
                    `nombre`='" . $_POST['nombre'] . "',
                    `apellidos`='" . $_POST['apellidos'] . "',
                    `sexo`='" . $_POST['sexo'] . "',
                    `fecha_nacimiento`=".$fechanac.",
                    `fecha_titulo`=" . $fechatit . ",
                    `fecha_habilitacion`='" . $_POST['fecha_colegiatura'] . "',
                    `estado`=" . $_POST['estado'] . ",
                    `email`='" . $_POST['email'] . "',
                    `telefono`='" . $_POST['celular'] . "',
                    `direccion`='" . $_POST['direccion'] . "',
                    `habilitado_hasta`=" . $fechahab . ",    
                    `universidad`='" . $_POST['universidad'] . "'
                        WHERE id=" . $_POST['id'] . "
                        ";
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: colegiados.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }

        break;
    case 4:
        include 'conexion.php';
        $sql= "SELECT * FROM tipo_pago WHERE id=" . $_POST['id'];
        foreach ($bd->query($sql) as $deuda)
        {
            echo json_encode(array('monto'=>(float)$deuda['monto']));
        }

        break;
    case 5:
        //grabar venta
        include 'conexion.php';
        $sql= "SELECT * FROM tipo_pago WHERE id=" . $_POST['tipodeuda'];
        $descripcion ="";
        $monto=0;
          
          
        foreach ($bd->query($sql) as $deuda)
        {
            $descripcion = $deuda['descripcion'];
            $monto = $deuda['monto'];
        }
        
        if ($_POST['tipodeuda']==2 || $_POST['tipodeuda']==8)
        {           
             $sql= "SELECT * FROM colegiado WHERE id=" . $_POST['idcolegiado'];
             $mes_cont="";
             $año_cont="";
             foreach ($bd->query($sql) as $colegiado_habilitado)
            {
                $mes_cont=date('m',strtotime($colegiado_habilitado['habilitado_hasta']));
                $año_cont=date('Y',strtotime($colegiado_habilitado['habilitado_hasta']));
            }
             if ($mes_cont==12)
            {
                $año_cont++;
            }       
            $mes_cont = $año_cont . "-" . $mes_cont;
            $mes_cont = date('m', strtotime("{$mes_cont} + 1 month"));
            
            for ($i=0;$i<$_POST['cantidad'];$i++)
            {
                
                if (((int)$mes_cont==13)&&($i>0))
                {
                    $año_cont++;
                    $mes_cont=1;
                }
                $month = $año_cont . '-' . $mes_cont++;
                $aux = date('Y-m-d', strtotime("{$month} + 1 month"));
                $last_day = date('Y-m-d', strtotime("{$aux} - 1 day"));
                
                $sql= "INSERT INTO deudas VALUES (" . $_POST['idcolegiado'] . "," . $_POST['tipodeuda'] . ",'" . 
                   $descripcion . "','" . $_POST['tipo_pago'] . "','" .$_POST['recibo'] . "',NOW()," . ($monto) . ",'" . $last_day . "');";
                
                $bd->query($sql);
                
                $sql= "UPDATE colegiado SET habilitado_hasta='" .  $last_day . "' WHERE id=" . $_POST['idcolegiado'];
                
                $bd->query($sql);
                
                $fech ="SELECT CURDATE()";
                foreach ($bd->query($fech) as $fechaact){
                    $fechaactual=$fechaact[0];
                }
                $fdia=substr($fechaactual,8,10);
                $fmes= substr($fechaactual,5,-3);
                $fano=substr($fechaactual,0,4);
                $mesfijo=$fmes-1;
                switch ($mesfijo){
                    case 0:  case 2: case 4: case 6: case 7: case 9: case 11:
                        $fdia=31;
                        break;
                    case 1:   
                        if($fano%4==0){
                            $fdia=29;
                        }else{
                            $fdia=28;
                        }
                        break;
                    case 3: case 5: case 8: case 10:   
                        $fdia=30;
                        break;
                }
                if($fmes==1){
                    $fano=$fano-1;
                }
                if($mesfijo==0){
                    $fmesfijo=12;
                }
                $fechavaler="'".$fano."-".$fmesfijo."-".$fdia."'";
//                echo $fechavaler; 
//                echo $last_day; exit;
                if($last_day>$fechavaler){
                    $sql ="UPDATE colegiado SET estado=1 WHERE id=".$_POST['idcolegiado'];
                    $bd->query($sql);
                }
            }
        }
        else
        {           
            $sql= "INSERT INTO deudas VALUES (" . $_POST['idcolegiado'] . "," . $_POST['tipodeuda'] . ",'" . 
            $descripcion . "','" . $_POST['tipo_pago'] . "','" .$_POST['recibo'] . "',NOW()," . ($_POST['cantidad']*$monto) . ",NOW());";
            $bd->query($sql);
        }
//        header("Location: deudacobrar.php?id=".$_POST['idcolegiado']."");
       //echo $sql;
        break;
    case 6:
        include 'conexion.php';
        $sql="INSERT INTO universidad(nombre) VALUES('".$_POST['nombre']."')";
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: universidad.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 7:
        include 'conexion.php';
        $sql="UPDATE universidad SET nombre='".$_POST['nombre']."' WHERE id_universidad=".$_POST['iduni'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: universidad.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 8:
        include 'conexion.php';
        $sql="DELETE FROM universidad WHERE id_universidad=".$_POST['iduni'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: universidad.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 9:
        include 'conexion.php';
        if($_FILES["archivo"]['name']==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/comunicados/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
                 move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
                }
        $sql="INSERT INTO comunicado(fecha_inicio,fecha_fin,estado,archivo) VALUES('".$_POST['fecha_inicio']."','".$_POST['fecha_fin']."','".$_POST['estado']."','".$file."')";
//        var_dump($sql);exit;
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: comunicadolist.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 10:
        include 'conexion.php';
        if($_FILES["archivo"]['name']==''){
                if($_POST["archivoant"]==''){
                    $filearchivo=null;
                }else{
                    $filearchivo=$_POST["archivoant"];
                }                 
            }else{
                $filearchivo=$_FILES["archivo"]['name'];
            }
            //load
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/comunicados/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
            {
            $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
             move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
            }
        $sql="UPDATE comunicado SET fecha_inicio='".$_POST['fecha_inicio']."', fecha_fin='".$_POST['fecha_fin']."', estado='".$_POST['estado']."', archivo='".$filearchivo."' WHERE id=".$_POST['idarc'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: comunicadolist.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 11:
        include 'conexion.php';
        $sql="DELETE FROM comunicado WHERE id=".$_POST['idarc'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: comunicadolist.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 12:
        include 'conexion.php';
        if($_FILES["archivo"]==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/pagos/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
            {
            $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
             move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
            }
        if($_POST['fecha_vence']==''){
            $vence='null';
        }
        else{
            $vence="'".$_POST['fecha_vence']."'";
        }
        if($_POST['tipo_pago']='OTRO'){
            $tipopago='OTRO DOCUMENTO';
        }
        $sql="INSERT INTO registro_pago(colegiado_id,tipo_pago_id,fecha_pago,fecha_vence,monto,n_recibo,modopago,archivo) "
             ."VALUES(".$_POST['idcolegiado'].",".$_POST['tipodeuda'].",'".$_POST['fecha_pago']."',".$vence.",".$_POST['monto'].",'".$_POST['recibo']."','".$tipopago."','".$file."')";
//     var_dump($sql);exit;
        try {
            $stmt = $bd->prepare($sql); 
            $stmt->execute();
            if($_POST['tipodeuda']==2){
                $sql= "UPDATE colegiado SET habilitado_hasta='" .$_POST['fecha_vence']. "' WHERE id=" . $_POST['idcolegiado'];       
                $bd->query($sql);
            }
//            header("Location: comunicado.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 13:
        include 'conexion.php';
        if($_FILES["archivo"]==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/registro/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
                 move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
                }
        $sql="INSERT INTO registro(colegiado_id,archivo) VALUES('".$_POST['idcolegiado']."','".$file."')";
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 14:
        include 'conexion.php';
        if($_FILES["archivo"]==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/registro/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
                 move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
                }
        $sql="UPDATE registro SET archivo='".$file."' WHERE colegiado_id=".$_POST['idcolegiado'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 15:
        include 'conexion.php';
        $sql="INSERT INTO anio(anio) VALUES('".$_POST['anio']."')";
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: anio.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 16:
        include 'conexion.php';
        $sql="UPDATE anio SET anio='".$_POST['anio']."' WHERE id=".$_POST['id'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: anio.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break; 
    case 17:
        include 'conexion.php';
        $sql="DELETE FROM anio WHERE id=".$_POST['id'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: anio.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 18:
        include 'conexion.php';
        if($_FILES["archivo"]==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/mescuenta/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
                 move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
                }
        $sql="INSERT INTO mescuenta(mes, id_anio, archivo) VALUES('".$_POST['mes']."', '".$_POST['anio']."', '".$file."')";
        var_dump($sql);
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: mescuenta.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 19:
        include 'conexion.php';
        if($_FILES["archivo"]['name']==''){
                if($_POST["archivoant"]==''){
                    $filearchivo=null;
                }else{
                    $filearchivo=$_POST["archivoant"];
                }                 
            }else{
                $filearchivo=$_FILES["archivo"]['name'];
            }
            //load
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/comunicados/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
            {
            $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
             move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
            }
        $sql="UPDATE mescuenta SET archivo='".$filearchivo."', id_anio='".$_POST['anio']."', mes='".$_POST['mes']."' WHERE id=".$_POST['id'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                        header("Location: mescuenta.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 20:
        include 'conexion.php';
        $sql="DELETE FROM mescuenta WHERE id=".$_POST['id'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: mescuenta.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 21:
        include 'conexion.php';
        if($_FILES["archivo"]==''){
                $file=null;                
            }else{
                $file=$_FILES["archivo"]['name'];
            }
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/partido/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
                 move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
                }
                
        if($_FILES["file"]==''){
                $filepdf=null;                
            }else{
                $filepdf=$_FILES["file"]['name'];
            }
        $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/partido/";
            if (is_uploaded_file($_FILES['file']['tmp_name']))
                {
                $nombreCompleto = $nombreDirectorio . $_FILES['file']['name'];        
                 move_uploaded_file($_FILES['file']['tmp_name'], $nombreCompleto);
                }
            
        $sql="INSERT INTO listapartido(numero, nombre, archivo, file) VALUES('".$_POST['numero']."', '".$_POST['nombre']."', '".$file."', '".$filepdf."')";
        var_dump($sql);
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
            header("Location: listapartido.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 22:
        include 'conexion.php';
        if($_FILES["archivo"]['name']==''){
                if($_POST["archivoant"]==''){
                    $filearchivo=null;
                }else{
                    $filearchivo=$_POST["archivoant"];
                }                 
            }else{
                $filearchivo=$_FILES["archivo"]['name'];
            }
            //load
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/partido/";
            if (is_uploaded_file($_FILES['archivo']['tmp_name']))
            {
            $nombreCompleto = $nombreDirectorio . $_FILES['archivo']['name'];        
             move_uploaded_file($_FILES['archivo']['tmp_name'], $nombreCompleto);
            }
            
        if($_FILES["file"]['name']==''){
                if($_POST["fileant"]==''){
                    $filearchivo=null;
                }else{
                    $filefile=$_POST["fileant"];
                }                 
            }else{
                $filefile=$_FILES["file"]['name'];
            }
            //load
            $nombreDirectorio = $_SERVER["DOCUMENT_ROOT"]."/intranet/partido/";
            if (is_uploaded_file($_FILES['file']['tmp_name']))
            {
            $nombreCompleto = $nombreDirectorio . $_FILES['file']['name'];        
             move_uploaded_file($_FILES['file']['tmp_name'], $nombreCompleto);
            }
            
        $sql="UPDATE listapartido SET file='".$filefile."', archivo='".$filearchivo."', numero='".$_POST['numero']."', nombre='".$_POST['nombre']."' WHERE id=".$_POST['id'];
        
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                        header("Location: listapartido.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
    case 23:
        include 'conexion.php';
        $sql="DELETE FROM listapartido WHERE id=".$_POST['id'];
        try {
            $stmt = $bd->prepare($sql); 
                        $stmt->execute();
                header("Location: listapartido.php");
        }
        catch( PDOException $Exception ) {
            throw new MyDatabaseException( $Exception->getMessage( ) , $Exception->getCode( ) );
        }
        break;
}
 