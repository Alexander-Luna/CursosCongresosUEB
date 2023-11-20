<?php
class Evento extends Conectar
{

    public function insert_evento($cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $modality_id, $nhours, $eventype_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO tm_evento (even_id, cat_id, cur_nom, cur_descrip, cur_fechini, cur_fechfin,cur_img, fech_crea,modality_id,nhours,eventype_id, est,est_asistencia)
        VALUES (NULL,?,?,?,?,?,'../../public/1.png', now(),?,?,?,'1',0);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $cat_id);
        $sql->bindValue(2, $cur_nom);
        $sql->bindValue(3, $cur_descrip);
        $sql->bindValue(4, $cur_fechini);
        $sql->bindValue(5, $cur_fechfin);
        $sql->bindValue(6, $modality_id);
        $sql->bindValue(7, $nhours);
        $sql->bindValue(8, $eventype_id);
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
    public function update_evento($even_id, $cat_id, $cur_nom, $cur_descrip, $cur_fechini, $cur_fechfin, $modality_id, $nhours, $eventype_id)
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
                    eventype_id = ?
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
        $sql->bindValue(8, $eventype_id);
        $sql->bindValue(9, $even_id);
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
    public function get_evento_slider()
    {
        $conectar = parent::conexion();
        parent::set_names();
        
        $sql = "SELECT
                tm_evento.even_id,
                tm_evento.cur_nom,
                tm_evento.cur_fechini,
                tm_evento.cur_fechfin,
                tm_evento.fech_crea,
                tm_evento.portada_img
                FROM tm_evento
                WHERE tm_evento.est = 1
                AND tm_evento.cur_img IS NOT NULL
                ORDER BY tm_evento.fech_crea DESC
                LIMIT 3";
    
        $sql = $conectar->prepare($sql);
        $sql->execute();
        
        return $resultado = $sql->fetchAll();
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
        return $resultado = $sql->fetch(PDO::FETCH_ASSOC);
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
    public function get_coordenadas_id($even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM tm_coordenadas WHERE even_id = ?";
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
    public function insert_coordenadas($even_id, $xqr, $yqr, $xci, $yci, $xnombres, $ynombres, $xcurso, $ycurso, $xfacultad, $yfacultad, $xdescripcion, $ydescripcion, $midesc, $mddesc, $mieven, $mdeven)
    {
        $conectar = parent::conexion();
        parent::set_names();

        // Verificar si el even_id ya existe en la base de datos
        $checkSql = "SELECT COUNT(*) as count FROM tm_coordenadas WHERE even_id = ?";
        $checkStmt = $conectar->prepare($checkSql);
        $checkStmt->bindValue(1, $even_id);
        $checkStmt->execute();
        $result = $checkStmt->fetch(PDO::FETCH_ASSOC);

        // La sentencia SQL para la inserción o actualización
        if ($result['count'] == 0) {
            $sql = "INSERT INTO tm_coordenadas (
                even_id, xqr, yqr, xnombres, ynombres, xcurso, ycurso, xfacultad, yfacultad,  xdescripcion, ydescripcion, xcedula, ycedula,midesc,mddesc,mieven,mdeven, fech_crea
            )
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        } else {
            $sql = "UPDATE tm_coordenadas SET
                xqr = ?,
                yqr = ?,
                xnombres = ?,
                ynombres = ?,
                xcurso = ?,
                ycurso = ?,
                xfacultad = ?,
                yfacultad = ?,
                xdescripcion = ?,
                ydescripcion = ?,
                xcedula = ?,
                ycedula = ?,
                midesc = ?,
                mddesc = ?,
                mieven = ?,
                mdeven = ?,
                fech_crea = NOW()
            WHERE even_id = ?";
        }

        // Preparar la sentencia


        // Si es una actualización, también vincula el even_id al final
        $sqladd = $conectar->prepare($sql);
        if ($result['count'] > 0) {
            $sqladd->bindValue(1, $xqr);
            $sqladd->bindValue(2, $yqr);
            $sqladd->bindValue(3, $xnombres);
            $sqladd->bindValue(4, $ynombres);
            $sqladd->bindValue(5, $xcurso);
            $sqladd->bindValue(6, $ycurso);
            $sqladd->bindValue(7, $xfacultad);
            $sqladd->bindValue(8, $yfacultad);
            $sqladd->bindValue(9, $xdescripcion);
            $sqladd->bindValue(10, $ydescripcion);
            $sqladd->bindValue(11, $xci);
            $sqladd->bindValue(12, $yci);
            $sqladd->bindValue(13, $midesc);
            $sqladd->bindValue(14, $mddesc);
            $sqladd->bindValue(15, $mieven);
            $sqladd->bindValue(16, $mdeven);
            $sqladd->bindValue(17, $even_id);
        } else {
            $sqladd->bindValue(1, $even_id);
            $sqladd->bindValue(2, $xqr);
            $sqladd->bindValue(3, $yqr);
            $sqladd->bindValue(4, $xnombres);
            $sqladd->bindValue(5, $ynombres);
            $sqladd->bindValue(6, $xcurso);
            $sqladd->bindValue(7, $ycurso);
            $sqladd->bindValue(8, $xfacultad);
            $sqladd->bindValue(9, $yfacultad);
            $sqladd->bindValue(10, $xdescripcion);
            $sqladd->bindValue(11, $ydescripcion);
            $sqladd->bindValue(12, $xci);
            $sqladd->bindValue(13, $yci);
            $sqladd->bindValue(14, $midesc);
            $sqladd->bindValue(15, $mddesc);
            $sqladd->bindValue(16, $mieven);
            $sqladd->bindValue(17, $mdeven);
        }

        // Ejecutar la sentencia
        $sqladd->execute();

        // Obtener el ID de las coordenadas
        $sql1 = "SELECT last_insert_id() as 'coordenadas_id'";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();

        // Devolver el resultado
        return $resultado = $sql1->fetch(PDO::FETCH_ASSOC);
    }


    public function insert_evento_usuario_excel($even_id, $usu_ci)
    {
        $conectar = parent::conexion();
        parent::set_names();

        $sql = "SELECT usu_id FROM tm_usuario WHERE est = 1 AND usu_ci = ?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_ci);
        $sql->execute();
        $usuario = $sql->fetch(PDO::FETCH_ASSOC);
        if (!$usuario) {
            // El usuario no se encontró, puedes manejar el error o mostrar un mensaje
            return false;
        }

        // Insertar el registro en la tabla td_evento_usuario
        $sql = "INSERT INTO td_evento_usuario (curd_id, even_id, usu_id, fech_crea, est) VALUES (NULL, ?, ?, now(), 1)";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $even_id);
        $sql->bindValue(2, $usuario['usu_id']);
        $sql->execute();

        // Obtener el último ID insertado
        $sql1 = "SELECT LAST_INSERT_ID() AS 'curd_id'";
        $sql1 = $conectar->prepare($sql1);
        $sql1->execute();
        $resultado = $sql1->fetch(PDO::FETCH_ASSOC);

        return $resultado['curd_id'];
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

    public function get_total_asistencia()
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT count(*) as total FROM tm_evento WHERE est_asistencia=1";
        $sql = $conectar->prepare($sql);
        $sql->execute();
        return $resultado = $sql->fetchAll();
    }
    public function existe_usuario_evento($usu_ci, $even_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT COUNT(*) as count FROM td_evento_usuario INNER JOIN tm_usuario ON tm_usuario.usu_id=td_evento_usuario.usu_id WHERE tm_usuario.usu_ci=? AND td_evento_usuario.even_id=?";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $usu_ci);
        $sql->bindValue(2, $even_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_ASSOC);

        return $resultado['count'] > 0;
    }
}
