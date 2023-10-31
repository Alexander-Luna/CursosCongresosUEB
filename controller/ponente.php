<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Ponente.php");
/*TODO: Inicializando Clase */
$ponente = new Ponente();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["ponen_id"])) {
            $result = $ponente->insert_ponente($_POST["even_id"], $_POST["usu_id"], $_POST["ponen_type"], $_POST["ponen_titulo"], $_POST["ponen_description"], $_POST["ponen_fechaexpo"], $_POST["ponen_time"]);
            echo $result;
            if ($result) {
                echo "Inserción exitosa";
            } else {
                echo "Error al guardar los datos";
            }
        } else {
            $ponente->update_ponente($_POST["ponen_id"], $_POST["even_id"], $_POST["usu_id"], $_POST["ponen_type"], $_POST["ponen_titulo"], $_POST["ponen_description"], $_POST["ponen_fechaexpo"], $_POST["ponen_time"]);
        }
        break;

    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $ponente->get_ponente_id($_POST["ponen_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["ponen_id"] = $row["ponen_id"];
                $output["even_id"] = $row["even_id"];
                $output["usu_id"] = $row["usu_id"];
                $output["ponen_type"] = $row["ponen_type"];
                $output["ponen_titulo"] = $row["ponen_titulo"];
                $output["ponen_description"] = $row["ponen_description"];
                $output["usu_correo"] = $row["usu_correo"];
                $output["usu_sex"] = $row["usu_sex"];
                $output["usu_telf"] = $row["usu_telf"];
                $output["ponen_img"] = $row["ponen_img"];
                $output["ponen_fechaexpo"] = $row["ponen_fechaexpo"];
                $output["ponen_time"] = $row["ponen_time"];
            }
            echo json_encode($output);
        }
        break;
    /*TODO: Eliminar segun ID */
    case "eliminar":
        $ponente->delete_ponente($_POST["ponen_id"]);
        break;
    /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $ponente->get_ponente($_GET["even_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();

            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apep"] . " " . $row["usu_apem"];
            $sub_array[] = '<a href="' . $row["ponen_img"] . '" target="_blank">' . strtoupper(($row["ponen_titulo"])) . '</a>';
            $sub_array[] = $row["ponen_description"];
            if ($row["ponen_type"] == "P") {
                $sub_array[] = "Ponencia";
            } else if ($row["ponen_type"] == "M") {
                $sub_array[] = "Conferencia Magistral";
            }
            $sub_array[] = $row["usu_telf"];
            $sub_array[] = $row["ponen_fechaexpo"] . " " . $row["ponen_time"];
            $sub_array[] = '<button type="button" onClick="imagenG(' . $row["ponen_id"] . ');"  id="' . $row["ponen_id"] . '" class="btn btn-outline-info btn-icon"><div><i class="fa fa-image"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="editar(' . $row["ponen_id"] . ');"  id="' . $row["ponen_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["ponen_id"] . ');"  id="' . $row["ponen_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
        $datos = $ponente->get_ponente($_GET["even_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['ponen_id'] . "'>" . $row['usu_id'] . " " . $row['ponen_titulo'] . " " . $row['ponen_description'] . "</option>";
            }
            echo $html;
        }
        break;
    case "update_imagen_evento":
        $ponente->update_imagen_ponente($_POST["curx_idx"], $_POST["ponen_img"]);
        break;
    case "mostrar_ponencia_detalle":
        $datos = $ponente->get_ponencia_x_id_detalle($_POST["ponen_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["ponen_id"] = $row["ponen_id"];
                $output["ponen_type"] = $row["ponen_type"];
                $output["ponen_fechaexpo"] = $row["ponen_fechaexpo"];
                $output["ponen_time"] = $row["ponen_time"];
                $output["ponen_titulo"] = $row["ponen_titulo"];
                $output["usu_id"] = $row["usu_id"];
                $output["even_id"] = $row["even_id"];
                $output["cur_nom"] = $row["cur_nom"];
                $output["nhours"] = $row["nhours"];
                $output["cur_descrip"] = $row["cur_descrip"];
                $output["cur_fechini"] = $row["cur_fechini"];
                $output["cur_fechfin"] = $row["cur_fechfin"];
                $output["cur_img"] = $row["cur_img"];
                $output["modality_id"] = $row["modality_id"];
                $output["mname"] = $row["mname"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apep"] = $row["usu_apep"];
                $output["usu_apem"] = $row["usu_apem"];
                $output["aclevel_id"] = $row["aclevel_id"];
            }

            echo json_encode($output);
        }
        break;
    case "totalponencia":
        $datos = $ponente->get_total_ponencias($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;
}
?>