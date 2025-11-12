<?php
    require_once("../config/conexion.php");
    require_once("../models/Ticket.php");
    $ticket = new Ticket();

    switch($_GET["op"]){
        case "insert":

            if(isset($_SESSION["usu_id"])){
                $usu_id_logeado = $_SESSION["usu_id"];
            }else{
                die("Error: Usuario no autenticado");
            }

            $ticket->insert_ticket
            ($usu_id_logeado,
            $_POST["id_nov"],
            $_POST["novedad"],
            $_POST["tick_descripcion"]
        );
            break;
    }
?>