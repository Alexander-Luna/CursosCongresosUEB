<?php
class Dependencia extends Conectar
{
    /*TODO: Funcion para insertar dependencia */
    public function insert_dependencia($cat_nom)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_dependencias (cat_id, cat_nom,fech_crea, est) VALUES (NULL,?,now(),'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_nom);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para actualizar dependencia */
    public function update_dependencia($cat_id, $cat_nom)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_dependencias
                SET
                    cat_nom = ?
                WHERE
                    cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_nom);
        $sql->bindValue(2, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Eliminar cambiar de estado a la dependencia */
    public function delete_dependencia($cat_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_dependencias
                SET
                    est = 0
                WHERE
                    cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Listar todas las dependencias */
    public function get_dependencia()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_dependencias WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_tipoevento()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM event_type WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    /*TODO: Filtrar segun ID de dependencia */
    public function get_dependencia_id($cat_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_dependencias WHERE cat_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>