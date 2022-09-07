<?php
//============================================================+
// File name   : example_001.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 001 for TCPDF class
//               Default Header and Footer
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Default Header and Footer
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('lib/tcpdf/tcpdf.php');
class MYPDF extends TCPDF {

    //Page header
//    public function Header() {
//        // Logo
//        // Set font
//        $this->SetFont('helvetica', 'B', 20);
//        // Title
//        $this->Cell(0, 15, '<< TCPDF Example 003 >>', 0, false, 'C', 0, '', 0, false, 'M', 'M');
//    }
//
//    // Page footer
//    public function Footer() {
//        // Position at 15 mm from bottom
//        $this->SetY(-15);
//        // Set font
//        $this->SetFont('helvetica', 'I', 8);
//        // Page number
//        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
//    }
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Colwgio de Economistas');
$pdf->SetTitle('Constancia de Habilitacion');
$pdf->SetSubject('');
$pdf->SetKeywords('');
//$pdf->SetFont('times', '', 12, '', 'false');
// set default header data
//$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
//$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
//$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
//$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
//$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
//$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
//$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
//$pdf->SetFont('times', 'BI', 12);

// add a page
$pdf->AddPage();

$bMargin = $pdf->getBreakMargin();
// get current auto-page-break mode
$auto_page_break = $pdf->getAutoPageBreak();
// disable auto-page-break
$pdf->SetAutoPageBreak(false, 0);
// set bacground image
$image_file = K_PATH_IMAGES.'fondo ceh.jpg';
$pdf->Image($image_file, 0, 0, 210, 297, '', '', '', false, 300, '', false, false, 0);
// set some text to print
// restore auto-page-break status
//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
// set the starting point for the page content
$pdf->setPageMark();
$pdf->SetAutoPageBreak(TRUE, 0);


include 'conexion.php';
$idcolegiado=$_GET['id'];
//==================fecha actual===========
$fec="SELECT CURRENT_DATE";
foreach($bd->query($fec) as $fech){
    $fechareg=$fech[0];
}

$fadia=substr($fechareg,8,10);
$fames= substr($fechareg, 5,-3);
$faano=substr($fechareg,0,4);
switch ($fames){
        case 1:
            $famesletra='Enero';
            break;
        case 2:    
            $famesletra='Febrero';
            break;
        case 3:    
            $famesletra='Marzo';
            break;
        case 4:    
            $famesletra='Abril';
            break;
        case 5:    
            $famesletra='Mayo';
            break;
        case 6:    
            $famesletra='Junio';
            break;
        case 7:    
            $famesletra='Julio';
            break;
        case 8:    
            $famesletra='Agosto';
            break;
        case 9:    
            $famesletra='Setiembre';
            break;
        case 10:    
            $famesletra='Octubre';
            break;
        case 11:    
            $famesletra='Noviembre';
            break;
        case 12:    
            $famesletra='Diciembre';
            break;
    }
                        
$stmt = $bd->prepare("SELECT * FROM colegiado WHERE id=".$idcolegiado ); 
$stmt->execute();
foreach($stmt as $colegiado)
{
    if($colegiado['nrocolegiatura']<10){
        $numcolegiado='0000'.$colegiado['nrocolegiatura'];
    }else{
        if($colegiado['nrocolegiatura']<100){
            $numcolegiado='000'.$colegiado['nrocolegiatura'];
        }else{
            if($colegiado['nrocolegiatura']<1000){
            $numcolegiado='00'.$colegiado['nrocolegiatura'];
            }else{
                 if($colegiado['nrocolegiatura']<10000){
                $numcolegiado='0'.$colegiado['nrocolegiatura'];
                 }
            }
        }
    }
    
    $dia=substr($colegiado['fecha_habilitacion'],8,10);
    $mes= substr($colegiado['fecha_habilitacion'], 5,-3);
    $ano=substr($colegiado['fecha_habilitacion'],0,4);
    
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
    switch ($mes){
        case 1:
            $mesletra='Enero';
            break;
        case 2:    
            $mesletra='Febrero';
            break;
        case 3:    
            $mesletra='Marzo';
            break;
        case 4:    
            $mesletra='Abril';
            break;
        case 5:    
            $mesletra='Mayo';
            break;
        case 6:    
            $mesletra='Junio';
            break;
        case 7:    
            $mesletra='Julio';
            break;
        case 8:    
            $mesletra='Agosto';
            break;
        case 9:    
            $mesletra='Setiembre';
            break;
        case 10:    
            $mesletra='Octubre';
            break;
        case 11:    
            $mesletra='Noviembre';
            break;
        case 12:    
            $mesletra='Diciembre';
            break;
    }
//$empresaxid=51;
    
//$fecha = $licencia['fecha'];
//$vigencia="";
//if(substr($licencia['tipolicencia'], 0,10)!='PERMANENTE')
//{
//    $fecha = date('Y-m-j',strtotime($fecha));
//    $vigencia = " VIGENTE DESDE <b>" . date('d/m/Y',strtotime($fecha)) ."</b> AL <b>" . date('d/m/Y',strtotime ( '+6 month' , strtotime ( $fecha ) )) ."</b>";
//}
$html = '
    <br><br><br><br><br><br><br><br><br>
    
    <table>
        <tr>
            <td style="width:20%;text-align: center;">
            </td>
            <td style="width:70%;text-align: center;">
                <font style="font-size: 22px;"><b>CONSTANCIA DE HABILITACION PROFESIONAL</b></font>
            </td>
            <td style="width:10%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:86%;text-align: justify;">
                <font style="font-size: 15px;"><b>EL DECANO Y EL DIRECTOR SECRETARIO DEL COLEGIO DE ECONOMISTAS DE HUÁNUCO</b></font>
            </td>
            <td style="width:6%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:86%;text-align: justify;">
                <font style="font-size: 15px;"><b>QUE SUSCRIBEN:</b></font>
            </td>
            <td style="width:6%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:86%;text-align: justify;">
                <font style="font-size: 14px;">Declaran que en base a los registros de la institucion se ha verificado que el(la) Economista.</font>
            </td>
            <td style="width:6%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>
    <table>
        <tr>
            <td style="width:10%;text-align: center;">
            </td>
            <td style="width:80%;text-align: center;">
                <font style="font-size: 19px;"><b>'.$colegiado['apellidos'].', '.$colegiado['nombre'].'</b></font>
            </td>
            <td style="width:10%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>
    <br><br>
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:86%;text-align: justify;">
                <font style="font-size: 14px;">Es Miembro Hábil de la Orden con el registro N° <b>'.$numcolegiado.'</b> y de encuentra <b>habilitado hasta el
            '.$dia.' de '.$mesletra.' del '.$ano.'</b> para el ejercicio de las funciones profesionales, que facultan las leyes N° 15488 y N° 24531 y D.S. N° 
             02421-87-EF conforme a las normas vigentes y el Estatuto del Colegio.</font> 
            </td>
            <td style="width:6%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>    
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:84%;text-align: justify;">
                <font style="font-size: 14px;">En fe de lo cual y a solicitud de la parte se expide se extienda la presente constancia para los efectos y usos que estime conveniente.</font> 
            </td>
            <td style="width:8%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <img></img>    
    <table>
        <tr>
            <td style="width:8%;text-align: center;">
            </td>
            <td style="width:86%;text-align: right;">
                <font style="font-size: 14px;">Huánuco, <b>'.$fadia.' de '.$famesletra.' del '.$faano.'</b> </font> 
            </td>
            <td style="width:6%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <table>
        <tr>
            <td style="width:10%;text-align: center;">
            </td>
            <td style="width:80%;text-align: center;">
                <font style="font-size: 15px;"><b>Registro de Constancias de Habilitaciones:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font><font style="font-size: 17px;color:#F25805"><b>E-'.$numcolegiado.'</b></font>
            </td>
            <td style="width:10%;text-align: center;">
                <b></b>
            </td>
        </tr>
    </table>
        ' ;
}
$pdf->writeHTML($html, true, false, true, false, '');
$style = array(
    'border' => 2,
    'vpadding' => 'auto',
    'hpadding' => 'auto',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);
//$pdf->write2DBarcode('http://www.munihuanuco.gob.pe/intranetmunihco/transportes/imprimir/constancia.php?empresaxid='.$empresaxid, 'QRCODE,L', 140, 210, 35, 35, $style, 'N');
//$pdf->write2DBarcode($licencia['numerolic'], 'QRCODE,L', 15, 230, 18, 18, $style, 'N');

//$pdf->write2DBarcode($licencia['numerolic'], 'PDF417', 15, 250, 0, 18, $style, 'N');

//$pdf->Line(59, 219, $y, 219);
// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('constancia_colegiado_'.$numcolegiado.'.pdf', 'I');