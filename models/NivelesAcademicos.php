<?php
class NivelAcademico extends Conectar
{

    public function insert_academiclevel($aclevel_name, $aclevel_abreviature)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO academic_level (name, abreviature,est) VALUES (?,?,'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aclevel_name);
        $sql->bindValue(2, $aclevel_abreviature);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_academiclevel($aclevel_id, $aclevel_name, $aclevel_abreviature)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE academic_level
                SET
                    name = ?,
                    abreviature = ?
                WHERE
                    aclevel_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aclevel_name);
        $sql->bindValue(2, $aclevel_abreviature);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function delete_academiclevel($aclevel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE academic_level
                SET
                    est = 0
                WHERE
                    aclevel_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aclevel_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_academiclevel()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM academic_level";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function get_academiclevel_id($aclevel_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM academic_level WHERE aclevel_id = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $aclevel_id);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
}
?>