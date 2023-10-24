<?php
class Modalidad extends Conectar
{
    /* Función para insertar modalidad */
    public function insert_modalidad($name, $est)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO modality (modality_id, name, est) VALUES (NULL, ?, ?)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $est);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Función para actualizar modalidad */
    public function update_modalidad($modality_id, $name, $est)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE modality
                SET
                    name = ?,
                    est = ?
                WHERE
                    modality_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $est);
        $sql->bindValue(3, $modality_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Cambiar el estado de la modalidad (eliminar) */
    public function delete_modalidad($modality_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE modality
                SET
                    est = 0
                WHERE
                    modality_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $modality_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Listar todas las modalidades activas */
    public function get_modalidad()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM modality WHERE est = 1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    /* Obtener detalles de una modalidad por su ID */
    public function get_modalidad_id($modality_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM modality WHERE modality_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $modality_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
