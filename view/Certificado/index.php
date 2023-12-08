<?php
require_once("../../config/conexion.php");
if (isset($_SESSION["usu_id"])) {
    require_once __DIR__ . "/../../public/lib/TCPDF/tcpdf.php";
    require_once("../../models/Evento.php");
    require_once("../../models/Usuario.php");
    require_once("../../models/Ponente.php");
    $conexion = new Conectar();
    $evento = new Evento();
    $usuario = new Usuario();
    $ponente = new Ponente();
    $even_id = 0;
    $curd_id = 0;
    $isPonencia = false;
    $ponen_id = '';
    $c1Ponencia = '';
    $qr1 = '';
    $zip = false;
    if (isset($_GET['zip'])) {
        $zip = true;
    }
    if (isset($_GET['qr']) && isset($_GET['c1'])) {
        $qr1 = $_GET['qr'];
        if ($_GET['c1'] == '481516') {
            $isPonencia = true;
            $ponen_id = $qr1;
        } else {
            $curd_id = $qr1;
        }
    } else {
        if (isset($_GET['ponen_id'])) {
            $ponen_id = $_GET['ponen_id'];
            $isPonencia = true;
        }
        if (isset($_GET['even_id'])) {
            $even_id = $_GET['even_id'];
        }
        if (isset($_GET['curd_id'])) {
            $curd_id = $_GET['curd_id'];
        }
    }


    $ruta_web = $conexion->ruta();
    $parts = parse_url($ruta_web);
    $ruta_web = isset($parts['path']) ? $parts['path'] : '';

    $fondo = '../../public/5.png';

    $cedula  = '0000000000';
    $curso = 'NOMBRE DEL CURSO';
    $curso_des = 'Descripcion de curso';
    $fecha_ini = '00-00-0000';
    $fecha_fin = '00-00-0000';
    $nhoras = '00 Horas';
    $modalidad = 'Modalidad';
    $nombres  = 'Nombres Participante';
    $QR = $conexion->ruta()  . 'view/AdminVerificarCertificado/index.php?qr=' . 'ID CURSO' . '&481516=181515';
    $facultad = '';
    $tipoe = '';
    $tipo_participante = '';
    $ponen_titulo = '';

    $midesc = 0;
    $mddesc = 0;
    $mieven = 0;
    $mdeven = 0;


    if ($even_id > 0) {

        $datos1 = $evento->get_evento_id($even_id);
        if (is_array($datos1) == true and count($datos1) <> 0) {
            foreach ($datos1 as $row) {
                //DATOS
                $cedula  = '0000000000';
                $curso = $row["cur_nom"];
                $fecha_ini = $row["cur_fechini"];
                $fecha_fin = $row["cur_fechfin"];
                $nhoras = $row["nhours"];
                $modalidad = 'MODALIDAD';
                $nombres  = 'PARTICIPANTE NOMBRES';
                $QR = $conexion->ruta()  . 'view/AdminVerificarCertificado/index.php?qr=' . $even_id . '&481516=181515';
                $facultad =  "DEPENDENCIA";
                $fondo = $row["cur_img"];
                $tipo_participante = 'T PARTICIPANTE';
                $tipoe = 'EVENTO T';
            }
        }


        $datos = $evento->get_coordenadas_id($even_id);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $xCurso  = $row["xcurso"];
                $yCurso  = $row["ycurso"];
                $xCedula  = $row["xcedula"];
                $yCedula = $row["ycedula"];
                $xNombres  = $row["xnombres"];
                $yNombres  = $row["ynombres"];
                $xFacultad  = $row["xfacultad"];
                $yFacultad = $row["yfacultad"];
                $xQR = $row["xqr"];
                $yQR = $row["yqr"];
                $xdescripcion = $row["xdescripcion"];
                $ydescripcion  = $row["ydescripcion"];
                //MARGENES
                $midesc = $row["midesc"];
                $mddesc = $row["mddesc"];
                $mieven = $row["mieven"];
                $mieven = $row["mieven"];
            }
        }
    } else {
        $xCurso  = 0;
        $yCurso  = 0;
        $xCedula  = 0;
        $yCedula = 0;
        $xNombres  = 0;
        $yNombres  = 0;
        $xdescripcion  = 0;
        $ydescripcion  = 0;
        $xFacultad  = 0;
        $yFacultad = 0;
        $xQR = 0;
        $yQR = 0;
        //MARGENES
        $mCurso = 20;
    }


    if ($curd_id > 0) {
        $datos1 = $usuario->get_evento_x_id_detalle($curd_id);
        if (is_array($datos1) == true and count($datos1) <> 0) {
            foreach ($datos1 as $row) {
                //DATOS

                $datos = $evento->get_coordenadas_id($row["even_id"]);
                if (is_array($datos) == true and count($datos) <> 0) {
                    foreach ($datos as $row1) {
                        $xCurso  = $row1["xcurso"];
                        $yCurso  = $row1["ycurso"];
                        $xCedula  = $row1["xcedula"];
                        $yCedula = $row1["ycedula"];
                        $xNombres  = $row1["xnombres"];
                        $yNombres  = $row1["ynombres"];
                        $xFacultad  = $row1["xfacultad"];
                        $yFacultad = $row1["yfacultad"];
                        $xQR = $row1["xqr"];
                        $yQR = $row1["yqr"];
                        $xdescripcion = $row1["xdescripcion"];
                        $ydescripcion  = $row1["ydescripcion"];
                        //MARGENES
                        $midesc = $row1["midesc"];
                        $mddesc = $row1["mddesc"];
                        $mieven = $row1["mieven"];
                        $mieven = $row1["mieven"];
                    }
                }

                $cedula  = $row["usu_ci"];
                $curso = $row["cur_nom"];
                $fecha_ini = $row["cur_fechini"];
                $fecha_fin = $row["cur_fechfin"];
                $nhoras = $row["nhours"];
                $modalidad = $row["modalidad"];
                $nombres  = $row["usu_nom"] . ' ' . $row["usu_apellidos"];
                $QR = $conexion->ruta()  . 'view/AdminVerificarCertificado/index.php?qr=' . $curd_id . '&481516=181523';
                $facultad =  $row["cat_nom"];
                $fondo = $row["cur_img"];
                //$tipo_participante = $row["cur_img"];
                $tipoe = $row["tevento"];
            }
        }
    }




    if ($isPonencia) {
        if ($ponen_id > 0) {
            $datos = $ponente->get_ponencia_x_id_detalle($ponen_id);
            if (is_array($datos) == true and count($datos) <> 0) {
                foreach ($datos as $row) {
                    $fondo = $row["cur_img"];
                    $curso = $row["cur_nom"];
                    $fecha_ini = $row["cur_fechini"];
                    $fecha_fin = $row["cur_fechfin"];
                    $nombres = $row["usu_nom"] . ' ' . $row["usu_apellidos"];
                    $cedula = $row["usu_ci"];
                    $nhoras = $row["nhours"];
                    $ponen_titulo = $row["ponen_titulo"];
                    $modalidad = $row["mname"];
                    $facultad = $row["cat_nom"];
                    $QR = $conexion->ruta()  . 'view/AdminVerificarCertificado/index.php?qr=' . $row["ponen_id"] . '&481516=481516';
                    $datos = $evento->get_coordenadas_id($row["even_id"]);
                    if (is_array($datos) == true and count($datos) <> 0) {
                        foreach ($datos as $row1) {
                            $xCurso  = $row1["xcurso"];
                            $yCurso  = $row1["ycurso"];
                            $xCedula  = $row1["xcedula"];
                            $yCedula = $row1["ycedula"];
                            $xNombres  = $row1["xnombres"];
                            $yNombres  = $row1["ynombres"];
                            $xFacultad  = $row1["xfacultad"];
                            $yFacultad = $row1["yfacultad"];
                            $xQR = $row1["xqr"];
                            $yQR = $row1["yqr"];
                            $xdescripcion = $row1["xdescripcion"];
                            $ydescripcion  = $row1["ydescripcion"];
                            //MARGENES
                            $midesc = $row1["midesc"];
                            $mddesc = $row1["mddesc"];
                            $mieven = $row1["mieven"];
                            $mieven = $row1["mieven"];
                        }
                    }
                    /*
                    $output["ponen_id"] = $row["ponen_id"];
                    $output["ponen_type"] = $row["ponen_type"];
                    $output["ponen_fechaexpo"] = $row["ponen_fechaexpo"];
                    $output["ponen_time"] = $row["ponen_time"];
                    $output["even_id"] = $row["even_id"];
                    $output["cur_descrip"] = $row["cur_descrip"];

                    $output["mname"] = $row["mname"];

                    $output["aclevel_id"] = $row["aclevel_id"];*/
                }
            }
        }
    }
    // Crear objetos DateTime para las fechas
    $fecha_ini_obj = new DateTime($fecha_ini);
    $fecha_fin_obj = new DateTime($fecha_fin);

    // Formatear las fechas según las especificaciones
    $formato_inicio = 'd \d\e F';
    $formato_fin = 'd \d\e F';

    // Obtener el formato de fecha para fecha_ini
    $fecha_ini_formateada = $fecha_ini_obj->format($formato_inicio);

    // Obtener el formato de fecha para fecha_fin
    $fecha_fin_formateada = $fecha_fin_obj->format($formato_fin);

    // Obtener el formato del año para fecha_ini y fecha_fin
    $formato_anio = 'Y';
    $anio_ini_formateado = $fecha_ini_obj->format($formato_anio);
    $anio_fin_formateado = $fecha_fin_obj->format($formato_anio);

    if ($isPonencia) {
        $descripcion = 'Por haber participado en el ' . $tipoe . ' desarrollado con su intervención en calidad de ' . $tipo_participante . ' con la temática ' . $ponen_titulo . ', organizado por la Universidad Estatal de Bolívar ' .
            'Desarrollado del ' . $fecha_ini_formateada . ' del ' . $anio_ini_formateado . ' al ' . $fecha_fin_formateada . ' del ' . $anio_fin_formateado . ', modalidad ' . $modalidad . ', con una duración de ' . $nhoras . ' horas. Dado en la ciudad de Guaranda.';
    } else {
        $descripcion = 'En el ' . $tipoe . ' desarrollado del ' . $fecha_ini_formateada . ' del ' . $anio_ini_formateado . ' al ' . $fecha_fin_formateada . ' del ' . $anio_fin_formateado . ' con una duración de ' . $nhoras . ' horas, realizado de manera ' . $modalidad . '';
    }

    ob_start();

    $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
    $pdf->SetProtection(array('print'), '', null, 0, null);
    $pdf->SetMargins(0, 0, 0);
    $pdf->SetAutoPageBreak(true, 0);
    $pdf->SetCreator('Alexander Luna, Wilson Paredes');
    $pdf->SetAuthor('Universidad Estatal de Bolívar');
    $pdf->SetTitle('Certificados UEB');
    $pdf->SetSubject('Por Haber Asistido o Aprobado');
    $pdf->SetKeywords('Certificado de Asistencia o Aprobación de un Evento');
    $pdf->AddPage();
    $pdf->setFontSubsetting(false);
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
    $pdf->Image($fondo, -1, 0, $pdf->getPageWidth() + 1, $pdf->getPageHeight(), 'PNG', '', '', true, 300, '', false, false, 0, false, false, false);
    $pdf->setTextRenderingMode($stroke = 0.2, $fill = true, $clip = false);

    $pdf->SetFont('mickycaviar', '', 25);
    $pdf->SetTextColor(0, 0, 0, 10);
    $pdf->Text($xCedula, $yCedula, $cedula);

    $pdf->SetFont('mickycaviar', '',0.8);
    $pdf->SetTextColor(0, 0, 0, 10);
    $pdf->Text($xQR, $yQR+35, $evento->geteven());
    
    $pdf->SetTextColor(0, 0, 0);
    $pdf->SetXY($xNombres, $yNombres);
    //$pdf->SetFont('bilya', '', 40);
    $pdf->SetFont('balladeer', '', 40);
    $pdf->MultiCell($pdf->getPageHeight(), 1, $nombres, 0, 'C', false);


    $pdf->SetXY($xCurso, $yCurso);
    $pdf->SetFont('times', 'B', 18);
    $pdf->MultiCell($pdf->getPageWidth() - $mieven - $mdeven, 5, $curso, 0, 'C', false);
    $pdf->SetXY($xdescripcion, $ydescripcion);
    $pdf->SetFont('mulish', 'B', 16);
    $pdf->MultiCell($pdf->getPageWidth() - $midesc - $mddesc, 5, $descripcion, 0, 'C', false);
    // Restablecer los márgenes a 0 después de usarlos
    $pdf->SetLeftMargin(0);
    $pdf->SetRightMargin(0);




    // Restablecer los márgenes a 0 después de usarlos
    $pdf->SetLeftMargin(0);
    $pdf->SetRightMargin(0);

    $pdf->SetFont('Courgette', '', 20);
    $pdf->Text($xFacultad, $yFacultad, $facultad);
    $style = array(
        'border' => 2,
        'vpadding' => 'auto',
        'hpadding' => 'auto',
        'fgcolor' => array(0, 0, 0),
        'bgcolor' => array(255, 255, 255),
        'module_width' => 1,
        'module_height' => 1
    );

    $pdf->write2DBarcode($QR, 'QRCODE,L', $xQR, $yQR, 35, 35, $style, 'N');
    $pdf->SetFont('helvetica', '', 8);
    $pdf->Text($xQR + 1, $yQR + 31, $ruta_web);

    ob_end_clean();
    if ($zip) {
        $nombreArchivo = $cedula . '_' . $nombres . '.pdf';
        $rutaArchivo = 'C:/xampp/htdocs/CursosCongresosUEB/public/' . $nombreArchivo;  // Reemplaza con tu ruta real
        $pdf->Output($rutaArchivo, 'F');
    } else {
        if ($qr1 == '') {
            if ($curd_id > 0 || $isPonencia) {
                $pdf->Output($cedula . '_' . $nombres . '.pdf', 'D');
            } else {
                $pdf->Output('certificado.pdf', 'I');
            }
        } else {

            $pdf->Output('certificado.pdf', 'I');
        }
    }
} else {
    /* Si no a iniciado sesion se redireccionada a la ventana principal */
    header("Location:" . Conectar::ruta() . "view/404/");
}
