<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    switch($_GET["op"]){
        case "insert":

            if(isset($_SESSION["usu_id"])){
                $usu_id_logeado = $_SESSION["usu_id"];
            }else{
                http_response_code(401);
                die(json_encode(['error'=> 'Usuario no autenticado.']));
            }

            $id_novedad = isset($_POST["id_nov"]) ? $_POST["id_nov"]: null;

            $tick_descripcion_limpia = strip_tags($_POST["tick_descripcion"]) ? strip_tags($_POST["tick_descripcion"]):null;

            if ($id_novedad !== null && $tick_descripcion_limpia !== null){
            $tick_id_num=$ticket->insert_ticket
            ($usu_id_logeado,
            $_POST["id_nov"],
            $_POST["novedad"],
            $tick_descripcion_limpia
            );

            $codigo_ticket = 'INGS-' . str_pad($tick_id_num, 4, '0', STR_PAD_LEFT);

            header('Content-Type: application/json');
            echo json_encode(['codigo_ticket'=>$codigo_ticket, 'mensaje'=>'Registro exitoso']);
            
         }else{
            http_response_code(400);
            echo json_encode(['error'=> 'Faltan datos requeridos (Novedad o Descripcion).']);
         }   
         break;

         case "listar_x_usu":
            $datos=$ticket->listar_ticket_x_usu($_POST["usu_id"]);
            $data = Array();
            foreach($datos as $row){
                $sub_array = array();
                $sub_array [] = $row["tick_id"];
                $sub_array [] = $row["div_nom"];
                $sub_array [] = $row["novedad"];
                $sub_array [] = '<button type="button" onClick = "ver('.$row["tick_id"].');" id="'.$row["tick_id"].'" class="btn btn-outline-primary btn-icon"><div><i class ="fa fa-edit"></i></div></button>';
            }

            $results = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>($data),
                "aaData"=>$data
            );
            echo json_encode($results);

            break;

         
    }
?>