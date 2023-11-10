<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/NivelesAcademicos.php");
/*TODO: Inicializando Clase */
$nivel_academico = new NivelAcademico();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {
    /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["aclevel_id"])) {
            $nivel_academico->insert_academiclevel($_POST["aclevel_name"], $_POST["aclevel_abreviature"]);
        } else {
            $nivel_academico->update_academiclevel($_POST["aclevel_id"], $_POST["aclevel_name"], $_POST["aclevel_abreviature"]);
        }
        break;
    /*TODO: Creando Json segun el ID */
    case "mostrar":
        $datos = $nivel_academico->get_academiclevel_id($_POST["aclevel_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["aclevel_id"] = $row["aclevel_id"];
                $output["aclevel_name"] = $row["name"];
                $output["aclevel_abreviature"] = $row["abreviature"];
            }
            echo json_encode($output);
        }
        break;
    /*TODO: Eliminar segun ID */
    case "eliminar":
        $nivel_academico->delete_academiclevel($_POST["aclevel_id"]);
        break;
    /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $nivel_academico->get_academiclevel();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["name"];
            $sub_array[] = $row["abreviature"];
            $sub_array[] = '<button type="button" onClick="editar(' . $row["aclevel_id"] . ');"  id="' . $row["aclevel_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["aclevel_id"] . ');"  id="' . $row["aclevel_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';
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
        $datos = $nivel_academico->get_academiclevel();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['aclevel_id'] . "'>" . $row['name'] . "</option>";
            }
            echo $html;
        }
        break;
}
?>