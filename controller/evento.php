<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Evento.php");
/*TODO: Inicializando Clase */
$evento = new Evento();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
        /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["even_id"])) {
            $evento->insert_evento($_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fechini"], $_POST["cur_fechfin"], $_POST["modality_id"], $_POST["nhours"], $_POST["eventype_id"]);
        } else {
            $evento->update_evento($_POST["even_id"], $_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fechini"], $_POST["cur_fechfin"], $_POST["modality_id"], $_POST["nhours"], $_POST["eventype_id"]);
        }
        break;
    case "update_coordenadas":
        $evento->insert_coordenadas(
            $_POST["even_id"],
            $_POST["xqr"],
            $_POST["yqr"],
            $_POST["xci"],
            $_POST["yci"],
            $_POST["xnombres"],
            $_POST["ynombres"],
            $_POST["xcurso"],
            $_POST["ycurso"],
            $_POST["xfacultad"],
            $_POST["yfacultad"],
            $_POST["xdescripcion"],
            $_POST["ydescripcion"],
            $_POST["midesc"],
            $_POST["mddesc"],
            $_POST["mieven"],
            $_POST["mdeven"]
        );

        break;
        /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $evento->get_evento_id($_POST["even_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["even_id"] = $row["even_id"];
                $output["cat_id"] = $row["cat_id"];
                $output["modality_id"] = $row["modality_id"];
                $output["cur_nom"] = $row["cur_nom"];
                $output["portada_img"] = $row["portada_img"];
                $output["nhours"] = $row["nhours"];
                $output["eventype_id"] = $row["eventype_id"];
                $output["cur_descrip"] = $row["cur_descrip"];
                $output["cur_fechini"] = $row["cur_fechini"];
                $output["cur_fechfin"] = $row["cur_fechfin"];
                $output["est_asistencia"] = $row["est_asistencia"];
            }
            echo json_encode($output);
        }
    case "mostrar_coordenadas":
        $datos = $evento->get_coordenadas_id($_POST["even_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["mieven"] = $row["mieven"];
                $output["mdeven"] = $row["mdeven"];
                $output["midesc"] = $row["midesc"];
                $output["mddesc"] = $row["mddesc"];
                $output["xqr"] = $row["xqr"];
                $output["yqr"] = $row["yqr"];
                $output["xnombres"] = $row["xnombres"];
                $output["ynombres"] = $row["ynombres"];
                $output["xfacultad"] = $row["xfacultad"];
                $output["yfacultad"] = $row["yfacultad"];
                $output["xcedula"] = $row["xcedula"];
                $output["ycedula"] = $row["ycedula"];
                $output["xdescripcion"] = $row["xdescripcion"];
                $output["ydescripcion"] = $row["ydescripcion"];
                $output["xcurso"] = $row["xcurso"];
                $output["ycurso"] = $row["ycurso"];
            }
            echo json_encode($output);
        }
        break;
    case "asignar_coordenadas":
        $coordenadas = json_decode($_POST['coordenadas']);


        $mieven = $coordenadas['mieven'];
        $mdeven = $coordenadas['mdeven'];
        $midesc = $coordenadas['midesc'];
        $mddesc = $coordenadas['mddesc'];
        $xCurso = $coordenadas['xcurso'];
        $xCedula = $coordenadas['xcedula'];
        $xNombres = $coordenadas['xnombres'];
        $xdescripcion = $coordenadas['xdescripcion'];
        $xFacultad = $coordenadas['xfacultad'];
        $xQR = $coordenadas['xqr'];
        $yCurso = $coordenadas['ycurso'];
        $yCedula = $coordenadas['ycedula'];
        $yNombres = $coordenadas['ynombres'];
        $ydescripcion = $coordenadas['ydescripcion'];
        $yFacultad = $coordenadas['yfacultad'];
        $yQR = $coordenadas['yqr'];
        break;
    case "guardar_desde_excel":
        $usu_ci = $_POST["usu_ci"];
        $even_id = $_POST["even_id"];

        if (!$evento->existe_usuario_evento($usu_ci, $even_id)) {
            $evento->insert_evento_usuario_excel($even_id, $usu_ci);
        } else {
            // echo "El usuario ya esta registrado en este evento.";
        }
        break;
    case "insert_evento_usuario":

        $datos = explode(',', $_POST['usu_id']);

        /*TODO: Registrar tantos usuarios vengan de la vista */
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $idx = $evento->insert_evento_usuario($_POST["even_id"], $row);
            $sub_array[] = $idx;
            $data[] = $sub_array;
        }

        echo json_encode($data);
        break;

        /*TODO: Creando Json segun el ID */
    case "modalidad":
        $datos = $evento->get_modalidad_id($_POST["modality_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["modality_id"] = $row["modality_id"];
                $output["name"] = $row["name"];
                $output["est"] = $row["est"];
            }
            echo json_encode($output);
        }
        break;


        /*TODO: Eliminar segun ID */
    case "eliminar":
        $evento->delete_evento($_POST["even_id"]);
        break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $evento->get_evento();
        $data = array();

        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = '<a href="' . $row["cur_img"] . '" target="_blank">' . strtoupper($row["cur_nom"]) . '</a>';
            $type = $evento->get_eventype($row["eventype_id"]);
            if ($type) {
                $sub_array[] = $type['name'];
            } else {
                $sub_array[] = 'No Definido';
            }
            if ($type['eventype_id'] == 1) {
                $sub_array[] = '<button type="button" onClick="ponente(' . $row["even_id"] . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-users"></i></div></button>';
            } else {
                $sub_array[] = 'No Aplica';
            }
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["even_id"] . ",'portada'" . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-info btn-icon"><div><i class="fa fa-image"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="coordenadas(' . $row["even_id"] . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="icon ion-arrow-resize"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["even_id"] . ",'certificado'" . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="editar(' . $row["even_id"] . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["even_id"] . ');"  id="' . $row["even_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
            $sub_array[] = '<label class="switch"><input type="checkbox" class="checkbox" onClick="habilitarAsistencia(' . $row["even_id"] . ');" name="C' . $row["even_id"] . '" id="C' . $row["even_id"] . '"' . ($row["est_asistencia"] == 1 ? ' checked' : '') . '><div class="slider"></div></label>';

            $modality = $evento->get_modalidad_id($row["modality_id"]);

            $sub_array[] = '<span class="wd-0p hidden-column">' . $row["nhours"] . '</span>';
            $sub_array[] = '<span class="wd-0p hidden-column">' . $modality['name'] . '</span>';

            $data[] = $sub_array;
        }

        $results = array(
            "sEcho" => 1,
            "iTotalRecords" => count($data),
            "iTotalDisplayRecords" => count($data),
            "aaData" => $data
        );
        echo json_encode($results);
        break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "combo":
        $datos = $evento->get_evento();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['even_id'] . "'>" . $row['cur_nom'] . "</option>";
            }
            echo $html;
        }
        break;
    case "cardevento":
        $datos = $evento->get_evento_card();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = "";
            foreach ($datos as $row) {
                if ($row['portada_img']=='') {
                    $row['portada_img']='../../public/img/img11.jpg';
                }

                $html .= '
                    <div class="cardE">
                    <div class="cardE-image">
                    <img class="cardE-image" src="' . $row['portada_img'] . '" alt="' . $row['nombre_evento'] . '">
                    </div>
                    <div class="category">
                    <h3 class="cardE__title">
                    ' . $row['nombre_evento'] . '
                    </h3>
                    </div>
                    <div class="heading">
                    <p class="cardE__content">Dependencia:
                    ' . $row['dependencia'] . '
                    </p>
                    <p class="cardE__content">Fecha de Inicio:
                    ' . $row['fecha_inicio'] . '
                    </p>
                    <p class="cardE__content">Fecha de Finalización:
                    ' . $row['fecha_fin'] . '
                    </p>
                    </div>
                    </div>
                    </div>';
            }
            echo $html;
        }
        break;
    case "slider":
        $datos = $evento->get_evento_slider();
        if (is_array($datos) && count($datos) > 0) {
            $data = [];

            foreach ($datos as $row) {
                $data[] = [
                    'src' => $row['portada_img'], // Cambia a 'portada_img' si es la ruta correcta
                    'alt' => $row['cur_nom'],
                ];
            }

            echo json_encode($data);
        }
        break;

    case "eliminar_evento_usuario":
        $evento->delete_evento_usuario($_POST["curd_id"]);
        break;
        /*TODO: Insetar detalle de evento usuario */


    case "generar_qr":
        require 'phpqrcode/qrlib.php';
        //Primer Parametro - Text del QR
        //Segundo Parametro - Ruta donde se guardara el archivo
        QRcode::png(conectar::ruta() . "view/Certificado/index.php?curd_id=" . $_POST["curd_id"], "../public/qr/" . $_POST["curd_id"] . ".png", 'L', 32, 5);
        break;

    case "update_imagen_evento":
        $evento->update_imagen_evento($_POST["curx_idx"], $_POST["cur_img"]);
        break;
    case "update_portada_evento":
        $evento->update_portada_evento($_POST["curx_idx"], $_POST["cur_img"]);
        break;
        /*TODO: Guardar y editar cuando se tenga el ID */
    case "asistencia":
        $evento->insert_asistencia($_POST["curd_id"]);
        break;
        /*TODO: Guardar y editar cuando se tenga el ID */
    case "habilitarAsistencia":
        $evento->habilitar_asistencia($_POST["even_id"], $_POST["est_asistencia"]);
        break;
    case "apruebaevento":
        $evento->aprueba_evento($_POST["curd_id"], $_POST["est_aprueba"]);
        break;
    case "combomodalidad":
        $datos = $evento->get_modalidad();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['modality_id'] . "'>" . $row['name'] . "</option>";
            }
            echo $html;
        }
        break;
    case "totalasistencia":
        $datos = $evento->get_total_asistencia();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;
}
