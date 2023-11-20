<?php
/*TODO: Llamando a cadena de Conexion */
require_once("../config/conexion.php");
/*TODO: Llamando a la clase */
require_once("../models/Usuario.php");
/*TODO: Inicializando Clase */
$usuario = new Usuario();

/*TODO: Opcion de solicitud de controller */
switch ($_GET["op"]) {

        /*TODO: MicroServicio para poder mostrar el listado de eventos de un usuario con certificado */
    case "listar_eventos":
        $datos = $usuario->get_eventos_x_usuario($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = $row["nhours"];
            if ($row["est_aprueba"] == 1) {
                $sub_array[] = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            } else {
                $sub_array[] = 'Pendiente';
            }
            if ($row["est_asistencia"] == 1) {
                $sub_array[] = '<button type="button" onClick="FuncionAsistencia(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div></button>';
            } else {
                $sub_array[] = 'Desactivado';
            }
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
    case "listar_ponencia":
        $datos = $usuario->get_ponencia_x_usuario($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["ponen_titulo"];
            $sub_array[] = $row["ponen_fechaexpo"];
            $sub_array[] = $row["ponen_time"];
            if ($row["ponen_type"] == '1') {
                $sub_array[] = 'Ponencia';
            } else if ($row["ponen_type"] == '2') {
                $sub_array[] = 'Conferencia Magistral';
            }
            $sub_array[] = '<button type="button" onClick="CertificadoPonencia(' . $row["ponen_id"] . ');"  id="' . $row["ponen_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
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
        /*TODO: MicroServicio para poder mostrar el listado de eventos de un usuario con certificado */
    case "listar_eventos_top10":
        $datos = $usuario->get_eventos_x_usuario_top10($_POST["usu_id"]);
        $data = array();
        foreach ($datos as $row) {
            $certificado = '<div>Pendiente</div>';
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];

            if ($row["est_aprueba"] == 1) {
                $certificado = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            }
            $sub_array[] = $certificado;
            if ($row["est_asistencia"] == 1) {
                $sub_array[] = '<button type="button" onClick="FuncionAsistencia(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-calendar-check-o" aria-hidden="true"></i></div></button>';
            } else {
                $sub_array[] = 'Desactivado';
            }
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

        /*TODO: Microservicio para mostar informacion del certificado con el curd_id */
    case "mostrar_evento_detalle":
        $datos = $usuario->get_evento_x_id_detalle($_POST["curd_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["curd_id"] = $row["curd_id"];
                $output["even_id"] = $row["even_id"];
                $output["cur_nom"] = $row["cur_nom"];
                $output["cur_descrip"] = $row["cur_descrip"];
                $output["cur_fechini"] = $row["cur_fechini"];
                $output["cur_fechfin"] = $row["cur_fechfin"];
                $output["cur_img"] = $row["cur_img"];
                $output["nhours"] = $row["nhours"];
                $output["modality_id"] = $row["modality_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apellidos"] = $row["usu_apellidos"];
                $output["aclevel_id"] = $row["aclevel_id"];
            }

            echo json_encode($output);
        }
        break;

        /*TODO: Total de Eventos por usuario para el dashboard */
    case "total":
        $datos = $usuario->get_total_eventos_x_usuario($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;
        /*TODO: Total de Eventos por usuario para el dashboard */
    case "totalusuarios":
        $datos = $usuario->get_total_usuarios();
        if (is_array($datos) == true and count($datos) > 0) {
            foreach ($datos as $row) {
                $output["total"] = $row["total"];
            }
            echo json_encode($output);
        }
        break;
        /*TODO: Mostrar informacion del usuario en la vista perfil */
    case "mostrar":
        $datos = $usuario->get_usuario_x_id($_POST["usu_id"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apellidos"] = $row["usu_apellidos"];
                $output["usu_correo"] = $row["usu_correo"];
                $output["usu_sex"] = $row["usu_sex"];
                $output["usu_telf"] = $row["usu_telf"];
                $output["rol_id"] = $row["rol_id"];
                $output["usu_ci"] = $row["usu_ci"];
                $output["facultad_id"] = $row["facultad_id"];
                $output["carrera_id"] = $row["carrera_id"];
                $output["usu_otracarrera"] = $row["usu_otracarrera"];
                $output["aclevel_id"] = $row["aclevel_id"];
            }
            echo json_encode($output);
        }
        break;

        /*TODO: Mostrar informacion segun ci del usuario registrado */
    case "consulta_ci":
        $datos = $usuario->get_usuario_x_ci($_POST["usu_ci"]);
        if (is_array($datos) == true and count($datos) <> 0) {
            foreach ($datos as $row) {
                $output["usu_id"] = $row["usu_id"];
                $output["usu_nom"] = $row["usu_nom"];
                $output["usu_apellidos"] = $row["usu_apellidos"];
                $output["usu_correo"] = $row["usu_correo"];
                $output["usu_sex"] = $row["usu_sex"];
                $output["usu_telf"] = $row["usu_telf"];
                $output["rol_id"] = $row["rol_id"];
                $output["usu_ci"] = $row["usu_ci"];
                $output["facultad_id"] = $row["facultad_id"];
                $output["carrera_id"] = $row["carrera_id"];
                $output["usu_otracarrera"] = $row["usu_otracarrera"];
                $output["aclevel_id"] = $row["aclevel_id"];
            }
            echo json_encode($output);
        }
        break;
        /*TODO: Actualizar datos de perfil */
    case "update_perfil":
        if ($_POST["usu_facultad"] == 7) {
            $_POST["usu_carrera"] = null;
        } else {
            $_POST["usu_otracarrera"] = null;
        }
        $usuario->update_usuario_perfil(
            $_POST["usu_id"],
            $_POST["usu_nom"],
            $_POST["usu_apellidos"],
            $_POST["usu_sex"],
            $_POST["usu_telf"],
            $_POST["usu_ci"],
            $_POST["aclevel_id"],
            $_POST["usu_facultad"],
            $_POST["usu_carrera"],
            $_POST["usu_otracarrera"]
        );
        break;
        /*TODO: Guardar y editar cuando se tenga el ID */
    case "guardaryeditar":
        if (empty($_POST["usu_id"])) {
            $usuario->insert_usuario($_POST["usu_nom"], $_POST["usu_apellidos"], $_POST["usu_correo"], $_POST["usu_sex"], $_POST["usu_telf"], $_POST["rol_id"], $_POST["usu_ci"], $_POST["aclevel_id"]);
        } else {
            $usuario->update_usuario($_POST["usu_id"], $_POST["usu_nom"], $_POST["usu_apellidos"], $_POST["usu_correo"], $_POST["usu_sex"], $_POST["usu_telf"], $_POST["rol_id"], $_POST["usu_ci"], $_POST["aclevel_id"]);
        }
        break;
    case "resetpass":
        if (!empty($_POST['usu_pass1']) && !empty($_POST['usu_pass'])) {
            if ($_POST['usu_pass1'] == $_POST['usu_pass']) {
                $usuario->resetpass_usuario($_POST["usu_id"], $usuario->encriptarPassword($_POST["usu_pass"]));
            } else {
                echo 'Las Password No Coinciden';
            }
        } else {
            echo 'Llene las password';
        }
        break;
    case "cambiarPassword":
        if (isset($_POST["usu_id"]) && isset($_POST["nuevaContraseña"])) {
            $usu_id = $_POST["usu_id"];
            $nuevaContraseña = $_POST["nuevaContraseña"];
            $datos = $usuario->get_usuario_x_id($usu_id);
            if (is_array($datos) == true && count($datos) > 0) {
                $hashNuevaContraseña = $usuario->encriptarPassword($nuevaContraseña); // Utiliza tu función de encriptación
                $usuario->actualizarPassword($usu_id, $hashNuevaContraseña);
                echo "Contraseña actualizada con éxito";
            } else {
                echo "El usuario no existe";
            }
        } else {
            echo "Faltan datos necesarios";
        }
        break;
        /*TODO: Eliminar segun ID */
    case "eliminar":
        $usuario->delete_usuario($_POST["usu_id"]);
        break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "listar":
        $datos = $usuario->get_usuario();
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["usu_ci"];
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_apellidos"];
            $sub_array[] = $row["usu_correo"];
            $sub_array[] = $row["usu_telf"];

            if ($row["rol_id"] == 1) {
                $sub_array[] = "Usuario";
            } else {
                $sub_array[] = "Admin";
            }
            if ($row["aclevel_id"] == 1) {
                $sub_array[] = "Estudiante";
            } else if ($row["aclevel_id"] == 2) {
                $sub_array[] = "Magister";
            } else if ($row["aclevel_id"] == 3) {
                $sub_array[] = "Doctorado";
            } else {
                $sub_array[] = "No Definido";
            }
            $sub_array[] = '<button type="button" onClick="editar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["usu_id"] . ');"  id="' . $row["usu_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';



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
    case "listar_eventos_usuario_excel":
        $datos = $usuario->get_eventos_usuario_x_id($_POST["even_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_ci"];
            $sub_array[] = $row["usu_apellidos"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            if (isset($row["nhours"])) {
                $sub_array[] = $row["nhours"];
            } else {
                $sub_array[] = 'Valor Predeterminado';
            }
            $data[] = $sub_array;
        }

        // Devuelve los datos como un array JSON
        echo json_encode($data);
        break;
        /*TODO: Listar todos los usuarios pertenecientes a un evento */
    case "listar_eventos_usuario":
        $datos = $usuario->get_eventos_usuario_x_id($_POST["even_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();



            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apellidos"];
            $sub_array[] = $row["cur_fechini"];
            $sub_array[] = $row["cur_fechfin"];
            if (isset($row["nhours"])) {
                $sub_array[] = $row["nhours"];
            } else {
                $sub_array[] = '0'; // Reemplaza 'Valor Predeterminado' con lo que necesites.
            }
            $sub_array[] = '<button type="button" onClick="certificado(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-primary btn-icon"><div><i class="fa fa-id-card-o"></i></div></button>';
            $sub_array[] = '<button type="button" onClick="eliminar(' . $row["curd_id"] . ');"  id="' . $row["curd_id"] . '" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';

            // Agregar columnas adicionales con la clase CSS 'hidden-column' para ocultarlas inicialmente
            $sub_array[] = '<span class="wd-0p hidden-column">' . $row["facultad"] . '</span>';

            if ($row["facultad"] == null || $row["facultad"] == 7) {
                $sub_array[] = '<span class="wd-0p hidden-column">' . $row["usu_otracarrera"] . '</span>';
            } else {
                $sub_array[] = '<span class="wd-0p hidden-column">' . $row["carrera"] . '</span>';
            }

            $sub_array[] = '<span class="wd-0p hidden-column">' . $row["usu_correo"] . '</span>';
            $sub_array[] = '<span class="wd-0p hidden-column">' . " " . $row["usu_ci"] . '</span>';
            $sub_array[] = '<span class="wd-0p hidden-column">' . " " . $row["usu_telf"] . '</span>';

            if ($row["est_aprueba"] == 1) {
                $sub_array[] = '<span class="wd-0p hidden-column">' . "Aprobado" . '</span>';
            } else {
                $sub_array[] = '<span class="wd-0p hidden-column">' . "Reprobado" . '</span>';
            }
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
    case "listar_eventos_usuario_asistencia":
        $datos = $usuario->get_eventos_usuario_x_id_x_asistencia($_POST["even_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = $row["cur_nom"];
            $sub_array[] = $row["usu_nom"] . " " . $row["usu_apellidos"];
            $sub_array[] = $row["cur_fechfin"];
            $sub_array[] = $row["asistencia_count"];
            $sub_array[] = '<label class="switch"><input type="checkbox" class="checkbox" onClick="Aprueba(' . $row["curd_id"] . ');" name="C' . $row["curd_id"] . '" id="C' . $row["curd_id"] . '"' . ($row["est_aprueba"] == 1 ? ' checked' : '') . '><div class="slider"></div></label>';
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
    case "listar_detalle_usuario":
        $datos = $usuario->get_usuario_modal($_POST["even_id"]);
        $data = array();
        foreach ($datos as $row) {
            $sub_array = array();
            $sub_array[] = '<label class="switch"><input type="checkbox" class="checkbox" name="detallecheck[]" value="' . $row["usu_id"] . '"><div class="slider"></div></label>';
            $sub_array[] = $row["usu_nom"];
            $sub_array[] = $row["usu_apellidos"];
            $sub_array[] = $row["usu_correo"];
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

    case "guardar_desde_excel":


        $usu_nom = $_POST["usu_nom"];
        $usu_apellidos = $_POST["usu_apellidos"];
        $usu_correo = $_POST["usu_correo"];
        $usu_sex = $_POST["usu_sex"];
        $usu_telf = $_POST["usu_telf"];
        $rol_id = $_POST["rol_id"];
        $usu_ci = $_POST["usu_ci"];
        $aclevel_id = $_POST["aclevel_id"];

        // Verificar si el usuario ya existe en la base de datos
        if (!$usuario->existe_usuario($usu_ci)) {
            // Si el usuario no existe, insertarlo
            $usuario->insert_usuario($usu_nom, $usu_apellidos, $usu_correo, $usu_sex, $usu_telf, $rol_id, $usu_ci, $aclevel_id);
        } else {
            //   echo "El usuario ya existe en la base de datos.";
        }
        break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
    case "combo":
        $datos = $usuario->get_usuario();
        if (is_array($datos) == true and count($datos) > 0) {
            $html = " <option label='Seleccione'></option>";
            foreach ($datos as $row) {
                $html .= "<option value='" . $row['usu_id'] . "'>" . $row['abreviature'] . " " . $row['usu_nom'] . " " . $row['usu_apellidos']  . "</option>";
            }
            echo $html;
        }
        break;
}
