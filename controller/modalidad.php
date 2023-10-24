<?php
/* TODO: Incluye tus archivos de conexión y modelo aquí */
require_once("../config/conexion.php");
require_once("../models/Modalidad.php");

/* TODO: Inicializa la clase del modelo */
$modalidad = new Modalidad();

/* TODO: Procesa la solicitud del controlador */
switch ($_GET["op"]) {
        /* Guardar y editar una modalidad */
    case "guardaryeditar":
        if (empty($_POST["modality_id"])) {
            $modalidad->insert_modalidad($_POST["name"], $_POST["est"]);
        } else {
            $modalidad->update_modalidad($_POST["modality_id"], $_POST["name"], $_POST["est"]);
        }
        break;

        /* Mostrar detalles de una modalidad */
    case "mostrar":
        $datos = $modalidad->get_modalidad_id($_POST["modality_id"]);
        if (is_array($datos) == true && count($datos) > 0) {
            foreach ($datos as $row) {
                $output["modality_id"] = $row["modality_id"];
                $output["name"] = $row["name"];
                $output["est"] = $row["est"];
            }
            echo json_encode($output);
        }
        break;

        /* Eliminar una modalidad */
    case "eliminar":
        $modalidad->delete_modalidad($_POST["modality_id"]);
        break;

        /* Listar todas las modalidades en formato DataTable */
    case "listar":
        $datos = $modalidad->get_modalidad();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["est"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["modality_id"] . ');" id="' . $row["modality_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["modality_id"] . ');" id="' . $row["modality_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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

        /* Obtener modalidades para cargar en un combo */
    case "combo":
        $datos = $modalidad->get_modalidad();
        if (is_array($datos) == true && count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['modality_id'] . "'>" . $row['name'] . "</option>";
            }
            echo $html;
        }
        break;
}
