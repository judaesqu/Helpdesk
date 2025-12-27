<?php
    require_once("../Helpdesk/config/conexion.php");
    require_once("../Helpdesk/models/Email.php");
    $email = new Email();

    switch ($_GET["op"]){
        case "ticket_abierto":
            $email->ticket_abierto($_POST["tick_id"]);
            break;

        case "ticket_cerrado":
            $email->ticket_cerrado($_POST["tick_id"]);
            break;
        
        case "ticket_asignado":
            $email->ticket_asignado($_POST["tick_id"]);
            break;
    }

?>