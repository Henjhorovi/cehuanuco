<?php


$colegiado='2019-09-05';
 $dia=substr($colegiado,8,10);
                    $mes= substr($colegiado, 5,-3);
                    $ano=substr($colegiado,0,4);
                    
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
                    
                    $fecha="'".$ano."-".$mes."-".$dia."'";
                    echo $fecha;