<?php
class Facultad extends Conectar
{
    /*TODO: Funcion para insertar facultad */
    public function insert_facultad($name)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_facultad (facultad_id, name,fech_crea, est) VALUES (NULL,?,now(),'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para actualizar facultad */
    public function update_facultad($facultad_id, $name)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_facultad
                SET
                    name = ?
                WHERE
                    facultad_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $facultad_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Eliminar cambiar de estado a la facultad */
    public function delete_facultad($facultad_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_facultad
                SET
                    est = 0
                WHERE
                    facultad_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $facultad_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Listar todas las facultads */
    public function get_facultad()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_facultad WHERE est = 1";
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
    /*TODO: Filtrar segun ID de facultad */
    public function get_facultad_id($facultad_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_facultad WHERE facultad_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $facultad_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>