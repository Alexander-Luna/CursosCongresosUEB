<?php
class Evento extends Conectar
{

    public function insert_evento($cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $modality_id, $nhours, $portada_img)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_evento (even_id, cat_id, cur_nom, cur_descrip, cur_fechini, cur_fechfin,cur_img, fech_crea,modality_id,nhours,portada_img, est,est_asistencia) VALUES (NULL,?,?,?,?,?,?,'../../public/1.png', now(),?,?,?,'1',0);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $cur_nom);
        $sql->bindValue(3, $cur_descrip);
        $sql->bindValue(4, $cur_fechini);
        $sql->bindValue(5, $cur_fechfin);
        $sql->bindValue(6, $modality_id);
        $sql->bindValue(7, $nhours);
        $sql->bindValue(8, $portada_img);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function insert_asistencia($curd_id)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Primero, realiza una consulta para obtener el valor de even_id desde td_evento_usuario
        $sql1 = "SELECT even_id FROM td_evento_usuario WHERE curd_id = ?";
        $sql1 = $conectar->prepare($sql1);
        $sql1->bindValue(1, $curd_id);
        $sql1->execute();
        $resultado1 = $sql1->fetch(PDO::FETCH_ASSOC);

        if ($resultado1 && isset($resultado1['even_id'])) {
            // Luego, verifica si est_asistencia es igual a 1 en tm_evento
            $sql2 = "SELECT est_asistencia FROM tm_evento WHERE even_id = ? AND est_asistencia = 1";
            $sql2 = $conectar->prepare($sql2);
            $sql2->bindValue(1, $resultado1['even_id']);
            $sql2->execute();
            $resultado2 = $sql2->fetch(PDO::FETCH_ASSOC);

            if ($resultado2 && isset($resultado2['est_asistencia'])) {
                // Si est_asistencia es igual a 1, inserta la asistencia en td_evento_usuario_dias
                $sql3 = "INSERT INTO td_evento_usuario_dias (curd_id, fecha_asistencia, estado) VALUES (?, now(), 1)";
                $sql3 = $conectar->prepare($sql3);
                $sql3->bindValue(1, $curd_id);
                $sql3->execute();
                return true; // La asistencia se insertó con éxito
            }
        }

        return false; // No se insertó la asistencia
    }
    public function aprueba_evento($curd_id, $est_aprueba)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE td_evento_usuario
                SET
                    est_aprueba = :est_aprueba
                WHERE
                    curd_id = :curd_id";

        $sql = $conectar->prepare($sql);

        // Vincular los valores a los marcadores de posición
        $sql->bindParam(':est_aprueba', $est_aprueba, PDO::PARAM_INT);
        $sql->bindParam(':curd_id', $curd_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function habilitar_asistencia($even_id, $est_asistencia)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "UPDATE tm_evento
                SET
                    est_asistencia = :est_asistencia
                WHERE
                    even_id = :even_id";

        $sql = $conectar->prepare($sql);

        // Vincular los valores a los marcadores de posición
        $sql->bindParam(':est_asistencia', $est_asistencia, PDO::PARAM_INT);
        $sql->bindParam(':even_id', $even_id, PDO::PARAM_INT);

        // Ejecutar la consulta
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_evento($even_id, $cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $modality_id, $nhours, $est_asistencia, $portada_img)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_evento
                SET
                    cat_id =?,
                    cur_nom = ?,
                    cur_descrip = ?,
                    cur_fechini = ?,
                    cur_fechfin = ?,
                    modality_id = ?,
                    nhours = ?,
                    portada_img = ?,
                    est_asistencia = ?
                WHERE
                    even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $cur_nom);
        $sql->bindValue(3, $cur_descrip);
        $sql->bindValue(4, $cur_fechini);
        $sql->bindValue(5, $cur_fechfin);
        $sql->bindValue(6, $modality_id);
        $sql->bindValue(7, $nhours);
        $sql->bindValue(8, $portada_img);
        $sql->bindValue(9, $est_asistencia);
        $sql->bindValue(10, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_evento($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_evento
                SET
                    est = 0
                WHERE
                    even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_eventype($eventype_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM event_type WHERE eventype_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $eventype_id);
        $sql->execute();
        return $resultado = $sql->fetch(PDO::FETCH_ASSOC); // Utiliza fetch para obtener un solo resultado
    }
    public function get_evento()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.cur_descrip,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.cat_id,
                tm_evento.eventype_id,
                tm_evento.cur_img,
                tm_evento.portada_img,
                tm_evento.modality_id,
                tm_evento.nhours,
                tm_evento.est_asistencia,
                tm_dependencias.cat_nom,
                tm_dependencias.cat_id
           
                FROM tm_evento
                INNER JOIN tm_dependencias on tm_evento.cat_id = tm_dependencias.cat_id
                WHERE tm_evento.est = 1";
        $sql = $conectar->prepare($sql);

        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_modalidad_id($modality_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM modality WHERE est = 1 AND modality_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $modality_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_evento_id($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_evento WHERE est = 1 AND even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_evento_usuario($curd_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE td_evento_usuario
                SET
                    est = 0
                WHERE
                    curd_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $curd_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Insert Evento por Usuario */
    public function insert_evento_usuario($even_id, $usu_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO td_evento_usuario (curd_id,even_id,usu_id,fech_crea,est) VALUES (NULL,?,?,now(),1);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->bindValue(2, $usu_id);
        $sql->execute();

        $sql1 = "select last_insert_id() as 'curd_id'";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();
        return $resultado = $sql1->fetch(pdo::FETCH_ASSOC);
    }

    public function update_imagen_evento($even_id, $cur_img)
    {
        $conectar = parent::conexion();
        parent::set_names();

        require_once("Evento.php");
        $curx = new Evento();
        $cur_img = '';
        if ($_FILES["cur_img"]["name"] != '') {
            $cur_img = $curx->upload_file();
        }

        $sql = "UPDATE tm_evento
                SET
                    cur_img = ?
                WHERE
                    even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cur_img);
        $sql->bindValue(2, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function update_portada_evento($even_id, $portada_img)
    {
        $conectar = parent::conexion();
        parent::set_names();

        require_once("Evento.php");
        $curx = new Evento();
        $portada_img = '';
        if ($_FILES["cur_img"]["name"] != '') {
            $portada_img = $curx->upload_file1();
        }

        $sql = "UPDATE tm_evento
                SET
                    portada_img = ?
                WHERE
                    even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $portada_img);
        $sql->bindValue(2, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function upload_file()
    {
        if (isset($_FILES["cur_img"])) {
            $extension = explode('.', $_FILES['cur_img']['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = '../public/' . $new_name;
            move_uploaded_file($_FILES['cur_img']['tmp_name'], $destination);
            return "../../public/" . $new_name;
        }
    }
    public function upload_file1()
    {
        if (isset($_FILES["cur_img"])) {
            $extension = explode('.', $_FILES['cur_img']['name']);
            $new_name = rand() . '.' . $extension[1];
            $destination = '../assets/' . $new_name;
            move_uploaded_file($_FILES['cur_img']['tmp_name'], $destination);
            return "assets/" . $new_name;
        }
    }
    public function get_modalidad()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM modality WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>