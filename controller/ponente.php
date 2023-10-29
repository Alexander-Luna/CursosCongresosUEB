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
            $result = $ponente->insert_ponente($_POST["even_id"], $_POST["ponen_names"], $_POST["ponen_titulo"], $_POST["ponen_description"], $_POST["ponen_correo"], $_POST["ponen_sex"], $_POST["ponen_telf"], $_POST["ponen_fechaexpo"], $_POST["ponen_time"]);
            if ($result) {
                echo "Inserción exitosa"; // Puedes enviar un mensaje de éxito
            } else {
                echo "Error al guardar los datos"; // Puedes enviar un mensaje de error
            }
        } else {
            $ponente->update_ponente($_POST["ponen_id"], $_POST["even_id"], $_POST["ponen_names"], $_POST["ponen_titulo"], $_POST["ponen_description"], $_POST["ponen_correo"], $_POST["ponen_sex"], $_POST["ponen_telf"], $_POST["ponen_fechaexpo"], $_POST["ponen_time"]);
        }
        break;

    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $ponente->get_ponente_id($_POST["ponen_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["ponen_id"] = $row["ponen_id"];
                $output["even_id"] = $row["even_id"];
                $output["ponen_names"] = $row["ponen_names"];
                $output["ponen_titulo"] = $row["ponen_titulo"];
                $output["ponen_description"] = $row["ponen_description"];
                $output["ponen_correo"] = $row["ponen_correo"];
                $output["ponen_sex"] = $row["ponen_sex"];
                $output["ponen_telf"] = $row["ponen_telf"];
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
            $sub_array[] = $row["ponen_names"];
            $sub_array[] = $row["ponen_titulo"];
            $sub_array[] = $row["ponen_description"];
            $sub_array[] = $row["ponen_correo"];
            $sub_array[] = $row["ponen_telf"];
            $sub_array[] = $row["ponen_fechaexpo"] . " " . $row["ponen_time"];
            $sub_array[] = '<button type="button" onClick="imagen(' . $row["ponen_id"] . ');"  id="' . $row["ponen_id"] . '" class="btn btn-outline-info btn-icon"><div><i class="fa fa-image"></i></div></button>';
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
                $html .= "<option value='" . $row['ponen_id'] . "'>" . $row['ponen_names'] . " " . $row['ponen_titulo'] . " " . $row['ponen_description'] . "</option>";
            }
            echo $html;
        }
        break;
    case "update_imagen_evento":
        $evento->update_imagen_ponente($_POST["curx_idx"], $_POST["ponen_img"]);
        break;
}
?>