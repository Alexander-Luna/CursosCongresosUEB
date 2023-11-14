<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Carrera.php");
/*TODO: Inicializando Clase */
$carrera = new Carrera();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["carrera_id"])) {
            $carrera->insert_carrera($_POST["name"], $_POST["facultad_id"]);
        } else {
            $carrera->update_carrera($_POST["carrera_id"], $_POST["facultad_id"], $_POST["name"]);
        }
        break;
    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $carrera->get_carrera_id($_POST["carrera_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["carrera_id"] = $row["carrera_id"];
                $output["name"] = $row["name"];
                $output["facultad_id"] = $row["facultad_id"];
            }
            echo json_encode($output);
        }
        break;
    /*TODO: Eliminar segun ID */
    case "eliminar":
        $carrera->delete_carrera($_POST["carrera_id"]);
        break;
    /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $carrera->get_carrera($_GET["facultad"]);
        //  echo $datos . " ENTRAAA";
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["carrera_id"] . ');"  id="' . $row["carrera_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["carrera_id"] . ');"  id="' . $row["carrera_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
    case "combo":
        $datos = $carrera->get_carreras();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['carrera_id'] . "' data-facultad-id='" . $row['facultad_id'] . "'>" . $row['name'] . "</option>";

            }
            echo $html;
        }
        break;
}
?>