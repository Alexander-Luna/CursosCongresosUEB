<?php
class NivelAcademico extends Conectar
{

    public function insert_academiclevel($name, $abreviature)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO academic_level (name, abreviature,est) VALUES (?,?,'1');";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $abreviature);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }

    public function update_academiclevel($aclevel_id, $name, $abreviature)
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
        $sql->bindValue(1, $aclevel_id);
        $sql->bindValue(2, $name);
        $sql->bindValue(3, $abreviature);
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
        $sql = "SELECT * FROM academic_level WHERE est!='0'";
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