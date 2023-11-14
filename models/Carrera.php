<?php
class Carrera extends Conectar
{
    /*TODO: Funcion para insertar carrera */
    public function insert_carrera($name, $facultad_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_carrera (carrera_id, name,facultad_id,fech_crea, est) VALUES (NULL,?,?,now(),'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $facultad_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Funcion para actualizar carrera */
    public function update_carrera($carrera_id, $facultad_id, $name)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_carrera
                SET
                    name = ?,
                    facultad_id = ?
                WHERE
                    carrera_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $facultad_id);
        $sql->bindValue(3, $carrera_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Eliminar cambiar de estado a la carrera */
    public function delete_carrera($carrera_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE tm_carrera
                SET
                    est = 0
                WHERE
                    carrera_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $carrera_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /*TODO: Listar todas las carreras */
    public function get_carrera($facultad_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_carrera WHERE est = 1 AND facultad_id= ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $facultad_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function get_carreras()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_carrera WHERE est = 1 ";
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
    /*TODO: Filtrar segun ID de carrera */
    public function get_carrera_id($carrera_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_carrera WHERE carrera_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $carrera_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>