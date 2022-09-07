<?php
include 'conexion.php';
$sql = $bd->prepare("SELECT CURDATE()");
$sql->execute();
foreach($sql as $fech){
    $fechaactual="'".$fech[0]."'";
}
//    echo $fechaactual;
    $fdia=substr($fechaactual,9,-1);
    $fmes= substr($fechaactual,6,-4);
    $fano=substr($fechaactual,1,4);
//    $mesfijo=$fmes-1;
//    echo $fdia."<br>";
//    echo $fmes."<br>";
//    echo $fano."<br>";
//    echo $mesfijo."<br>";
//    switch ($mesfijo){
//        case 0:  case 2: case 4: case 6: case 7: case 9: case 11:
//            $fdia=31;
//            break;
//        case 1:   
//            if($fano%4==0){
//                $fdia=29;
//            }else{
//                $fdia=28;
//            }
//            break;
//        case 3: case 5: case 8: case 10:   
//            $fdia=30;
//            break;
//    }
//    if($fmes==1){
//        $fano=$fano-1;
//    }
//    if($mesfijo==0){
//        $fmesfijo=12;
//    }else{
//        $fmesfijo=$mesfijo+1;
//    }
    $fechavaler="'".$fano."-".$fmes."-".$fdia."'";
//    echo $fechavaler."<br>";
$stmt = $bd->prepare("SELECT * FROM colegiado ORDER BY nrocolegiatura ASC"); 
$stmt->execute();
foreach($stmt as $colegiado)
{   
//    echo $colegiado['fecha_habilitacion']."<br>";
    $dia=substr($colegiado['habilitado_hasta'],8,10);
    $mes= substr($colegiado['habilitado_hasta'], 5,-3);
    $ano=substr($colegiado['habilitado_hasta'],0,4);
//    echo $dia."<br>";
//    echo $mes."<br>";
//    echo $ano."<br>";
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
//    echo $fechahab."<br>";exit;
    if($fechahab<$fechavaler){
        $sql = $bd->prepare("UPDATE colegiado SET estado=0 WHERE id=".$colegiado['id']);
        $sql->execute();
    }else{
        $sql = $bd->prepare("UPDATE colegiado SET estado=1 WHERE id=".$colegiado['id']);
        $sql->execute();
    }
}
header("Location: colegiados.php");