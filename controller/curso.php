<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Curso.php");
/*TODO: Inicializando Clase */
$curso = new Curso();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["cur_id"])) {
            $curso->insert_curso($_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fechini"], $_POST["cur_fechfin"], $_POST["inst_id"], $_POST["modality_id"], $_POST["nhours"], $_POST["portada_img"]);
        } else {
            $curso->update_curso($_POST["cur_id"], $_POST["cat_id"], $_POST["cur_nom"], $_POST["cur_descrip"], $_POST["cur_fechini"], $_POST["cur_fechfin"], $_POST["inst_id"], $_POST["modality_id"], $_POST["nhours"], $_POST["est_asistencia"], $_POST["portada_img"]);
        }
        break;
    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $curso->get_curso_id($_POST["cur_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["cur_id"] = $row["cur_id"];
                $output["cat_id"] = $row["cat_id"];
                $output["modality_id"] = $row["modality_id"];
                $output["cur_nom"] = $row["cur_nom"];
                $output["portada_img"] = $row["portada_img"];
                $output["nhours"] = $row["nhours"];
                $output["cur_descrip"] = $row["cur_descrip"];
                $output["cur_fechini"] = $row["cur_fechini"];
                $output["cur_fechfin"] = $row["cur_fechfin"];
                $output["inst_id"] = $row["inst_id"];
                $output["est_asistencia"] = $row["est_asistencia"];
            }
            echo json_encode($output);
        }
        break;
    /*TODO: Creando Json segun el ID */
    case "modalidad":
        $datos = $curso->get_modalidad_id($_POST["modality_id"]);
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
        $curso->delete_curso($_POST["cur_id"]);
        break;
    /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $curso->get_curso();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cat_nom"];
            $sub_array[] = '<a href="' . $row["cur_img"] . '" target="_blank">' . strtoupper($row["cur_nom"]) . '</a>';
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = $row["inst_nom"] . " " . $row["inst_apep"] . " " . $row["inst_apem"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["cur_id"] . ');"  id="' . $row["cur_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["cur_id"] . ');"  id="' . $row["cur_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["cur_id"] . ');"  id="' . $row["cur_id"] . '" class="btn btn-outline-success btn-icon"><div><i class="fa fa-file"></i></div></button>';
            $sub_array[] = '<input type="checkbox" onClick="habilitarAsistencia(' . $row["cur_id"] . ');" name="C' . $row["cur_id"] . '" id="C' . $row["cur_id"] . '"' . ($row["est_asistencia"] == 1 ? ' checked' : '') . '>';
            $sub_array[] = $row["modality_id"];
            $sub_array[] = $row["nhours"];
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
        $datos = $curso->get_curso();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['cur_id'] . "'>" . $row['cur_nom'] . "</option>";
            }
            echo $html;
        }
        break;

    case "eliminar_curso_usuario":
        $curso->delete_curso_usuario($_POST["curd_id"]);
        break;
    /*TODO: Insetar detalle de curso usuario */
    case "insert_curso_usuario":
        /*TODO: Array de usuario separado por comas */
        $datos = explode(',', $_POST['usu_id']);
        /*TODO: Registrar tantos usuarios vengan de la vista */
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $idx = $curso->insert_curso_usuario($_POST["cur_id"], $row);
            $sub_array[] = $idx;
            $data[] = $sub_array;
        }

        echo json_encode($data);
        break;

    case "generar_qr":
        require 'phpqrcode/qrlib.php';
        //Primer Parametro - Text del QR
        //Segundo Parametro - Ruta donde se guardara el archivo
        QRcode::png(conectar::ruta() . "view/Certificado/index.php?curd_id=" . $_POST["curd_id"], "../public/qr/" . $_POST["curd_id"] . ".png", 'L', 32, 5);
        break;

    case "update_imagen_curso":
        $curso->update_imagen_curso($_POST["curx_idx"], $_POST["cur_img"]);
        break;
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "asistencia":
        $curso->insert_asistencia($_POST["curd_id"]);
        break;
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "habilitarAsistencia":
        $curso->habilitar_asistencia($_POST["cur_id"], $_POST["est_asistencia"]);
        break;
    case "combomodalidad":
        $datos = $curso->get_modalidad();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['modality_id'] . "'>" . $row['name'] . "</option>";
            }
            echo $html;
        }
        break;
}
?>