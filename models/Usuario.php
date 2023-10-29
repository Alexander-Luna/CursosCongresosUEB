<?php
class Usuario extends Conectar
{

    function encriptarPassword($password)
    {
        $options = [
            'cost' => 12,
            // Factor de trabajo recomendado para bcrypt
        ];
        $hash = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hash;
    }

    /*TODO: Funcion para login de acceso del usuario */

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

                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo=? and usu_pass=? and est=1";
                    $stmt = $conectar->prepare($sql);
                    $stmt->bindValue(1, $correo);
                    // $stmt->bindValue(2, password_verify($pass, $hashAlmacenado));
                    $stmt->bindValue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if (is_array($resultado) and count($resultado) > 0) {
                        $_SESSION["usu_id"] = $resultado["usu_id"];
                        $_SESSION["usu_nom"] = $resultado["usu_nom"];
                        $_SESSION["usu_ape"] = $resultado["usu_ape"];
                        $_SESSION["usu_correo"] = $resultado["usu_correo"];
                        $_SESSION["rol_id"] = $resultado["rol_id"];
                        $_SESSION["aclevel_id"] = $resultado["aclevel_id"];
                        header("Location:" . Conectar::ruta() . "view/UsuHome/");
                        exit();
                    }
                }
            }
        }
    }
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
    /*TODO: Mostrar todos los eventos en los cuales esta inscrito un usuario */
    public function get_eventos_x_usuario($usu_id)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "SELECT 
                td_evento_usuario.curd_id,
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.nhours,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
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
        echo '<script> console.log($resultado);</script>';
        
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
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
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
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.portada_img,
                tm_evento.nhours,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
                tm_usuario.usu_ci,
                tm_usuario.aclevel_id
                FROM td_evento_usuario INNER JOIN 
                tm_evento ON td_evento_usuario.even_id = tm_evento.even_id INNER JOIN
                tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id 
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
            tm_usuario.usu_apep,
            tm_usuario.usu_apem,
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
                tm_evento.nhours,
                tm_evento.cur_img,
                tm_usuario.usu_id,
                tm_usuario.usu_nom,
                tm_usuario.usu_apep,
                tm_usuario.usu_apem,
                tm_usuario.aclevel_id
                FROM td_evento_usuario INNER JOIN 
                tm_evento ON td_evento_usuario.even_id = tm_evento.even_id INNER JOIN
                tm_usuario ON td_evento_usuario.usu_id = tm_usuario.usu_id 
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

    /*TODO: Mostrar los datos del usuario segun el ID */
    public function get_usuario_x_id($usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_usuario WHERE est=1 AND usu_id=?";
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

    /*TODO: Actualizar la informacion del perfil del usuario segun ID */
    public function update_usuario_perfil($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_pass, $usu_sex, $usu_telf, $aclevel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_usuario 
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    aclevel_id = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_pass);
        $sql->bindValue(5, $usu_sex);
        $sql->bindValue(6, $usu_telf);
        $sql->bindValue(7, $usu_id);
        $sql->bindValue(8, $aclevel_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para insertar usuario */
    public function insert_usuario($usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id, $usu_ci, $aclevel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_usuario (usu_id,usu_nom,usu_apep,usu_apem,usu_correo,usu_pass,usu_sex,usu_telf,rol_id,usu_ci,fech_crea, est,aclevel_id) VALUES (NULL,?,?,?,?,?,?,?,?,?,now(),'1',?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_correo);
        $sql->bindValue(5, $usu_pass);
        $sql->bindValue(6, $usu_sex);
        $sql->bindValue(7, $usu_telf);
        $sql->bindValue(8, $rol_id);
        $sql->bindValue(9, $usu_ci);
        $sql->bindValue(10, $aclevel_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para actualizar usuario */
    public function update_usuario($usu_id, $usu_nom, $usu_apep, $usu_apem, $usu_correo, $usu_pass, $usu_sex, $usu_telf, $rol_id, $usu_ci, $aclevel_id)
    {
        $conectar = parent::conexion();

        parent::set_names();
        $sql = "UPDATE tm_usuario
                SET
                    usu_nom = ?,
                    usu_apep = ?,
                    usu_apem = ?,
                    usu_correo = ?,
                    usu_pass = ?,
                    usu_sex = ?,
                    usu_telf = ?,
                    rol_id = ?,
                    usu_ci = ?,
                    aclevel_id = ?
                WHERE
                    usu_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_nom);
        $sql->bindValue(2, $usu_apep);
        $sql->bindValue(3, $usu_apem);
        $sql->bindValue(4, $usu_correo);
        $sql->bindValue(5, $usu_pass);
        $sql->bindValue(6, $usu_sex);
        $sql->bindValue(7, $usu_telf);
        $sql->bindValue(8, $rol_id);
        $sql->bindValue(9, $usu_ci);
        $sql->bindValue(10, $usu_id);
        $sql->bindValue(11, $aclevel_id);
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
