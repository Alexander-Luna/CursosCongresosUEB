<?php
    /*TODO: Llamando a cadena de Conexion */
    require_once("../config/conexion.php");
    /*TODO: Llamando a la clase */
    require_once("../models/Facultad.php");
    /*TODO: Inicializando Clase */
    $facultad = new Facultad();

    /*TODO: Opcion de solicitud de controller */
    switch($_GET["op"]){
        /*TODO: Guardar y editar cuando se tenga el ID */
        case "guardaryeditar":
            if(empty($_POST["facultad_id"])){
                $facultad->insert_facultad($_POST["name"]);
            }else{
                $facultad->update_facultad($_POST["facultad_id"],$_POST["name"]);
            }
            break;
        /*TODO: Creando Json segun el ID */
        case "mostrar":
            $datos = $facultad->get_facultad_id($_POST["facultad_id"]);
            if(is_array($datos)==true and count($datos)<>0){
                foreach($datos as $row){
                    $output["facultad_id"] = $row["facultad_id"];
                    $output["name"] = $row["name"];
                }
                echo json_encode($output);
            }
            break;
        /*TODO: Eliminar segun ID */
        case "eliminar":
            $facultad->delete_facultad($_POST["facultad_id"]);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "listar":
            $datos=$facultad->get_facultad();
            $data= Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array[] = $row["name"];
                $sub_array[] = '<button type="button" onClick="carreras('.$row["facultad_id"].');"  id="'.$row["facultad_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="icon ion-ios-book"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="editar('.$row["facultad_id"].');"  id="'.$row["facultad_id"].'" class="btn btn-outline-warning btn-icon"><div><i class="fa fa-edit"></i></div></button>';
                $sub_array[] = '<button type="button" onClick="eliminar('.$row["facultad_id"].');"  id="'.$row["facultad_id"].'" class="btn btn-outline-danger btn-icon"><div><i class="fa fa-close"></i></div></button>';                
                $data[] = $sub_array;
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
            echo json_encode($results);
            break;
        /*TODO:  Listar toda la informacion segun formato de datatable */
        case "combo":
            $datos=$facultad->get_facultad();
            if(is_array($datos)==true and count($datos)>0){
                $html= " <option label='Seleccione'></option>";
                foreach($datos as $row){
                    $html.= "<option value='".$row['facultad_id']."'>".$row['name']."</option>";
                }
                echo $html;
            }
            break;
            case "combotipo":
                $datos=$facultad->get_tipoevento();
                if(is_array($datos)==true and count($datos)>0){
                    $html= " <option label='Seleccione'></option>";
                    foreach($datos as $row){
                        $html.= "<option value='".$row['eventype_id']."'>".$row['name']."</option>";
                    }
                    echo $html;
                }
                break;
    }
?>