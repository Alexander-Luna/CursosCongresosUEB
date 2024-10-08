<?php
class Usuario extends Conectar
{

    public function encriptarPassword($password)
    {
        $options = [
            'cost' => 12,
            // Factor de trabajo recomendado para bcrypt
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }
    public function resetpass_usuario($usu_id, $usu_pass)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    usu_pass = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_pass);
        $sql->bindValue(2, $usu_id);
        $sql->execute();
        $resultado = $sql->fetchAll();
        //echo "Entraaa " + $resultado;
        return $resultado;
    }
    /*TODO: Funcion para login de acceso del usuario */
    public function actualizarPassword($usu_id, $usu_pass)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario SET usu_pass = ? WHERE usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_pass);
        $sql->bindValue(2, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function login()
    {
        $conectar = parent::conexion();
        parent::set_names();
        if (isset($_POST["enviar"])) {
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];
            if (empty($correo) and empty($pass)) {
                /*TODO: En caso esten vacios correo y contraseña, devolver al index con mensaje = 2 */
                header("Location:" . conectar::ruta() . "index.php?m=2");
                exit();
            } else {
                $sql = "SELECT usu_pass FROM tm_usuario WHERE usu_correo=? and est=1";
                $stmt = $conectar->prepare($sql);
                $stmt->bindValue(1, $correo);
                $stmt->execute();
                $resultado1 = $stmt->fetch();

                if ($resultado1) {
                    $hashAlmacenado = $resultado1['usu_pass'];

                    // Verifica la contraseña utilizando password_verify
                    if (password_verify($pass, $hashAlmacenado)) {
                        $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and est=1";
                        $stmt = $conectar->prepare($sql);
                        $stmt->bindValue(1, $correo);
                        $stmt->execute();
                        $resultado = $stmt->fetch();

                        if ($resultado) {
                            // Establece las variables de sesión
                            $_SESSION["usu_id"] = $resultado["usu_id"];
                            $_SESSION["usu_nom"] = $resultado["usu_nom"];
                            $_SESSION["usu_ape"] = $resultado["usu_ape"];
                            $_SESSION["usu_correo"] = $resultado["usu_correo"];
                            $_SESSION["rol_id"] = $resultado["rol_id"];
                            $_SESSION["aclevel_id"] = $resultado["aclevel_id"];

                            // Redirige al usuario a la página de inicio
                            header("Location: " . Conectar::ruta() . "view/UsuHome/");
                            exit();
                        }
                    }
                }
            }
        }
    }

    /*TODO: Mostrar todos los eventos en los cuales esta inscrito un usuario */
    public function get_eventos_x_usuario($usu_id)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "SELECT 
                td_evento_usuario.curd_id,
                td_evento_usuario.est_aprueba,
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.nhours,
                tm_evento.cur_descrip,
                tm_evento.est_asistencia,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apellidos,
                tm_usuario.usu_ci,
                tm_usuario.aclevel_id
                FROM td_evento_usuario INNER JOIN 
                tm_evento ON td_evento_usuario.even_id = tm_evento.even_id INNER JOIN
                tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id 
                WHERE 
                td_evento_usuario.usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        $resultado = $sql->fetchAll();
        //  echo '<script> console.log($resultado);</script>';

        return $resultado;
    }
    public function get_ponencia_x_usuario($usu_id)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "SELECT 
                tm_ponente.ponen_id,
                tm_ponente.ponen_type,
                tm_ponente.ponen_fechaexpo,
                tm_ponente.ponen_time,
                tm_ponente.ponen_titulo,
                tm_ponente.usu_id,
                tm_ponente.est,
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.nhours,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_evento.est_asistencia,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apellidos,
                tm_usuario.usu_ci,
                tm_usuario.aclevel_id
                FROM tm_ponente INNER JOIN 
                tm_usuario ON tm_usuario.usu_id = tm_ponente.usu_id INNER JOIN
                tm_evento ON tm_evento.even_id = tm_ponente.even_id 
                WHERE 
                tm_ponente.usu_id = ? AND tm_ponente.est=1";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        $resultado = $sql->fetchAll();
        //  echo '<script> console.log($resultado);</script>';

        return $resultado;
    }
    /*TODO: Mostrar todos los eventos en los cuales esta inscrito un usuario */
    public function get_eventos_x_usuario_top10($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                td_evento_usuario.curd_id,
                td_evento_usuario.est_aprueba,
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.nhours,
                tm_evento.est_asistencia,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apellidos,
                tm_usuario.usu_ci,
                tm_usuario.aclevel_id
                FROM td_evento_usuario INNER JOIN 
                tm_evento ON td_evento_usuario.even_id = tm_evento.even_id INNER JOIN
                tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id 
                WHERE 
                td_evento_usuario.usu_id = ?
                AND td_evento_usuario.est = 1
                LIMIT 10";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_eventos_usuario_x_id($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
        td_evento_usuario.curd_id,
        td_evento_usuario.est_aprueba,
        tm_evento.even_id,
        tm_evento.cur_nom,
        tm_evento.cur_descrip,
        tm_evento.cur_fechini,
        tm_evento.cur_fechfin,
        tm_evento.portada_img,
        tm_evento.nhours,
        tm_usuario.usu_id,
        tm_usuario.usu_correo,
        tm_usuario.facultad_id,
        tm_usuario.carrera_id,
        tm_usuario.usu_otracarrera,
        tm_usuario.usu_nom,
        tm_usuario.usu_telf,
        tm_usuario.usu_apellidos,
        tm_usuario.usu_ci,
        tm_usuario.aclevel_id,
        tm_facultad.name AS facultad,
        tm_carrera.name AS carrera
    FROM td_evento_usuario
    INNER JOIN tm_evento ON td_evento_usuario.even_id = tm_evento.even_id
    INNER JOIN tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id
    LEFT JOIN tm_facultad ON tm_usuario.facultad_id = tm_facultad.facultad_id
    LEFT JOIN tm_carrera ON tm_usuario.carrera_id = tm_carrera.carrera_id
    WHERE 
        tm_evento.even_id = ?
        AND td_evento_usuario.est = 1";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_eventos_usuario_x_id_x_asistencia($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Consulta para obtener los registros de usuario y su recuento de asistencias
        $sql = "SELECT 
            td_evento_usuario.curd_id AS curd_id,
            td_evento_usuario.est_aprueba,
            tm_evento.even_id,
            tm_evento.cur_nom,
            tm_evento.cur_descrip,
            tm_evento.cur_fechini,
            tm_evento.cur_fechfin,
            tm_evento.nhours,
            tm_usuario.usu_id,
            tm_usuario.usu_nom,
            tm_usuario.usu_apellidos,
            tm_usuario.usu_ci,
            tm_usuario.aclevel_id,
            COUNT(td_evento_usuario_dias.asistencia_id) AS asistencia_count
            FROM td_evento_usuario
            INNER JOIN tm_evento ON td_evento_usuario.even_id = tm_evento.even_id
            INNER JOIN tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id
            LEFT JOIN td_evento_usuario_dias ON td_evento_usuario.curd_id = td_evento_usuario_dias.curd_id
            WHERE tm_evento.even_id = ? AND td_evento_usuario.est = 1
            GROUP BY td_evento_usuario.curd_id";

        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        $resultados_usuario = $sql->fetchAll();

        return $resultados_usuario;
    }

    /*TODO: Mostrar todos los datos de un evento por su id de detalle */
    public function get_evento_x_id_detalle($curd_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT 
                td_evento_usuario.curd_id,

                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.modality_id,
                modality.name as modalidad,
                tm_evento.cat_id,
                tm_evento.eventype_id,
                event_type.name AS tevento,
                tm_evento.nhours,
                tm_evento.cur_img,
                tm_dependencias.cat_nom,
                tm_usuario.usu_id,
                tm_usuario.usu_ci,
                tm_usuario.usu_nom,
                tm_usuario.usu_apellidos,
                tm_usuario.aclevel_id
                FROM td_evento_usuario INNER JOIN 
                tm_evento ON td_evento_usuario.even_id = tm_evento.even_id INNER JOIN
                tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id  INNER JOIN
                tm_dependencias ON tm_evento.cat_id = tm_dependencias.cat_id INNER JOIN
                event_type ON tm_evento.eventype_id = event_type.eventype_id INNER JOIN
                modality ON tm_evento.modality_id = modality.modality_id
                WHERE 
                td_evento_usuario.curd_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curd_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Cantidad de Eventos por Usuario */
    public function get_total_eventos_x_usuario($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT count(*) as total FROM td_evento_usuario WHERE usu_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_total_usuarios()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT count(*) as total FROM tm_usuario";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    /*TODO: Mostrar los datos del usuario segun el ID */
    public function get_usuario_x_id($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT tm_usuario.*, CASE WHEN tm_facultad.facultad_id IS NOT NULL THEN tm_facultad.name 
        ELSE tm_usuario.usu_otracarrera END AS facultad_nombre, CASE WHEN tm_carrera.carrera_id IS NOT NULL 
        THEN tm_carrera.name ELSE NULL END AS carrera_nombre FROM tm_usuario 
        LEFT JOIN tm_facultad ON tm_facultad.facultad_id = tm_usuario.facultad_id 
        LEFT JOIN tm_carrera ON tm_carrera.carrera_id = tm_usuario.carrera_id 
        WHERE tm_usuario.est = 1 AND tm_usuario.usu_id = ?";


        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();

        return $resultado = $sql->fetchAll();
    }

    /*TODO: Mostrar los datos del usuario segun el ci */
    public function get_usuario_x_ci($usu_ci)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE est=1 AND usu_ci=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_ci);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function existe_usuario($usu_ci)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) as count FROM tm_usuario WHERE est=1 AND usu_ci=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_ci);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        return $resultado['count'] > 0;
    }
    /*TODO: Actualizar la informacion del perfil del usuario segun ID */
    public function update_usuario_perfil($usu_id, $usu_nom, $usu_apellidos, $usu_sex, $usu_telf, $usu_ci, $aclevel_id, $facultad_id, $carrera_id, $otra_carrera)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario 
                SET
                    usu_nom = ?,
                    usu_apellidos = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    usu_ci = ?,
                    facultad_id = ?,
                    carrera_id = ?,
                    usu_otracarrera = ?,
                    aclevel_id = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apellidos);
        $sql->bindValue(3, $usu_sex);
        $sql->bindValue(4, $usu_telf);
        $sql->bindValue(5, $usu_ci);
        $sql->bindValue(6, $facultad_id);
        $sql->bindValue(7, $carrera_id);
        $sql->bindValue(8, $otra_carrera);
        $sql->bindValue(9, $aclevel_id);
        $sql->bindValue(10, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para insertar usuario */
    public function insert_usuario($usu_nom, $usu_apellidos, $usu_correo, $usu_sex, $usu_telf, $rol_id, $usu_ci, $aclevel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_usuario (usu_id,usu_nom,usu_apellidos,usu_correo,usu_sex,usu_telf,rol_id,usu_ci,usu_pass,aclevel_id,fech_crea, est) VALUES (NULL,?,?,?,?,?,?,?,?,?,now(),'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apellidos);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_sex);
        $sql->bindValue(5, $usu_telf);
        $sql->bindValue(6, $rol_id);
        $sql->bindValue(7, $usu_ci);
        $sql->bindValue(8, $this->encriptarPassword($usu_ci));
        $sql->bindValue(9, $aclevel_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para actualizar usuario */
    public function update_usuario($usu_id, $usu_nom, $usu_apellidos, $usu_correo, $usu_sex, $usu_telf, $rol_id, $usu_ci, $aclevel_id)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    usu_nom = ?,
                    usu_apellidos = ?,
                    usu_correo = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    rol_id = ?,
                    usu_ci = ?,
                    aclevel_id = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apellidos);
        $sql->bindValue(3, $usu_correo);
        $sql->bindValue(4, $usu_sex);
        $sql->bindValue(5, $usu_telf);
        $sql->bindValue(6, $rol_id);
        $sql->bindValue(7, $usu_ci);
        $sql->bindValue(8, $aclevel_id);
        $sql->bindValue(9, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Eliminar cambiar de estado a la dependencia */
    public function delete_usuario($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    est = 0
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Listar todas las dependencias */
    public function get_usuario()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario INNER JOIN academic_level on tm_usuario.aclevel_id = academic_level.aclevel_id WHERE tm_usuario.est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Listar todas las dependencias */
    public function get_usuario_modal($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario 
                WHERE est = 1
                AND usu_id not in (select usu_id from td_evento_usuario where even_id=? AND est=1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
