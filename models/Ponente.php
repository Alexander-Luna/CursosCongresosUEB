<?php
class Ponente extends Conectar
{

    public function insert_ponente($even_id, $usu_id, $ponen_type, $ponen_titulo, $ponen_description, $ponen_fechaexpo, $ponen_time)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_ponente (usu_id, even_id,ponen_type, ponen_titulo, ponen_description, ponen_fechaexpo, ponen_time, fech_crea, est) VALUES (?,?,?,?,?,?,?, now(),'1')";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $even_id);
        $sql->bindValue(3, $ponen_type);
        $sql->bindValue(4, $ponen_titulo);
        $sql->bindValue(5, $ponen_description);
        $sql->bindValue(6, $ponen_fechaexpo);
        $sql->bindValue(7, $ponen_time);
        try {
            $sql->execute();
            if ($sql->rowCount() > 0) {
                return true;
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            return false;
        }
    }


    public function update_ponente($ponen_id, $even_id, $usu_id, $ponen_type, $ponen_titulo, $ponen_description, $ponen_fechaexpo, $ponen_time)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ponente
                SET
                    usu_id = ?,
                    even_id = ?,
                    ponen_type = ?,
                    ponen_titulo = ?,
                    ponen_description = ?,
                    ponen_fechaexpo = ?,
                    ponen_time = ?
                WHERE
                    ponen_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_id);
        $sql->bindValue(2, $even_id);
        $sql->bindValue(3, $ponen_type);
        $sql->bindValue(4, $ponen_titulo);
        $sql->bindValue(5, $ponen_description);
        $sql->bindValue(6, $ponen_fechaexpo);
        $sql->bindValue(7, $ponen_time);
        $sql->bindValue(8, $ponen_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_ponente($ponen_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ponente
                SET
                    est = 0
                WHERE
                    ponen_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ponen_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_ponente($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_ponente AS ponen  INNER JOIN tm_usuario AS user 
        ON user.usu_id=ponen.usu_id WHERE ponen.est = 1 AND ponen.even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_ponente_id($ponen_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * 
        FROM tm_ponente AS ponen 
        INNER JOIN tm_usuario AS user 
        ON user.usu_id=ponen.usu_id 
        WHERE ponen.est = 1 AND ponen.ponen_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ponen_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_imagen_ponente($ponen_id, $ponen_img)
    {
        $conectar = parent::conexion();
        parent::set_names();

        require_once("Ponente.php");
        $curx = new Ponente();
        $ponen_img = '';
        if ($_FILES["ponen_img"]["name"] != '') {
            $ponen_img = $curx->upload_file();
        }

        $sql = "UPDATE tm_ponente
                SET
                    ponen_img = ?
                WHERE
                    ponen_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ponen_img);
        $sql->bindValue(2, $ponen_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function upload_file()
    {
        if (isset($_FILES["ponen_img"])) {
            $extension = explode('.', $_FILES['ponen_img']['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = '../assets/' . $new_name;
            move_uploaded_file($_FILES['ponen_img']['tmp_name'], $destination);
            return "../../assets/" . $new_name;
        }
    }
    public function get_ponencia_x_id_detalle($ponen_id)
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
        tm_evento.cur_img,
        tm_evento.nhours,
        tm_evento.cur_descrip,
        tm_evento.modality_id,
        tm_evento.cur_fechini,
        tm_evento.cur_fechfin,
        tm_evento.portada_img,
        tm_evento.est_asistencia,
        tm_usuario.usu_id,
        tm_usuario.usu_nom,
        tm_usuario.usu_apep,
        tm_usuario.usu_apem,
        tm_usuario.usu_ci,
        tm_usuario.aclevel_id
        FROM tm_ponente INNER JOIN 
        tm_usuario ON tm_usuario.usu_id = tm_ponente.usu_id INNER JOIN
        tm_evento ON tm_evento.even_id = tm_ponente.even_id 
        WHERE 
        tm_ponente.ponen_id = ? AND tm_ponente.est=1";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ponen_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>