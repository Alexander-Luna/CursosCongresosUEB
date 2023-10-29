<?php
class Ponente extends Conectar
{

    public function insert_ponente($even_id, $ponen_names, $ponen_titulo, $ponen_description, $ponen_correo, $ponen_sex, $ponen_telf, $ponen_fechaexpo, $ponen_time)
{
    $conectar = parent::conexion();
    parent::set_names();
    $sql = "INSERT INTO tm_ponente (ponen_names, ponen_titulo, ponen_description, ponen_correo, ponen_sex, ponen_telf, ponen_fechaexpo, ponen_time, even_id, fech_crea, est) VALUES (?,?,?,?,?,?,?,?,?, now(),'1')";
    $sql = $conectar->prepare($sql);
    $sql->bindValue(1, $ponen_names);
    $sql->bindValue(2, $ponen_titulo);
    $sql->bindValue(3, $ponen_description);
    $sql->bindValue(4, $ponen_correo);
    $sql->bindValue(5, $ponen_sex);
    $sql->bindValue(6, $ponen_telf);
    $sql->bindValue(7, $ponen_fechaexpo);
    $sql->bindValue(8, $ponen_time);
    $sql->bindValue(9, $even_id);

    // Intenta ejecutar la consulta
    try {
        $sql->execute();
        // Verifica si se insertaron filas (éxito)
        if ($sql->rowCount() > 0) {
            return true; // Inserción exitosa
        } else {
            return false; // No se insertaron filas (falló la inserción)
        }
    } catch (PDOException $e) {
        // En caso de error en la base de datos, puedes devolver un mensaje de error
        $error_message = $e->getMessage();
        return false;
    }
}


    public function update_ponente($ponen_id, $even_id, $ponen_names, $ponen_titulo, $ponen_description, $ponen_correo, $ponen_sex, $ponen_telf, $ponen_fechaexpo, $ponen_time)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_ponente
                SET
                    ponen_names = ?,
                    ponen_titulo = ?,
                    ponen_description = ?,
                    ponen_correo = ?,
                    ponen_sex = ?,
                    ponen_telf = ?,
                    ponen_fechaexpo = ?,
                    ponen_time = ?,
                    even_id = ?
                WHERE
                    ponen_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $ponen_names);
        $sql->bindValue(2, $ponen_titulo);
        $sql->bindValue(3, $ponen_description);
        $sql->bindValue(4, $ponen_correo);
        $sql->bindValue(5, $ponen_sex);
        $sql->bindValue(6, $ponen_telf);
        $sql->bindValue(7, $ponen_fechaexpo);
        $sql->bindValue(8, $ponen_time);
        $sql->bindValue(9, $even_id);
        $sql->bindValue(10, $ponen_id);
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
        $sql = "SELECT * FROM tm_ponente WHERE est = 1 AND even_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_ponente_id($ponen_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_ponente WHERE est = 1 AND ponen_id = ?";
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
}
?>