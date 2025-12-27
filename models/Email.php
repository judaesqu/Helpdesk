<?php
    require('class.phpmailer.php');
    include("class.smtp.php");

    require_once("../Helpdesk/config/conexion.php");
    require_once("../Helpdesk/models/Ticket.php");

    class Email extends PHPMailer{

        protected $gCorreo = "jdeq92@gmail.com";
        protected $gContrasena= "16022018Jm*";

        public function ticket_abierto($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["novedad"];
                $novedad = $row["div_nom"];
                $correo = $row["usu_correo"];
            }

            $this->IsSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587;
            $this->SMTPAuth = true;


            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;

            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = "Ticket Abierto".$id;
            $this->CharSet  = 'UTF-8';
            $this->addAddress($correo);
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Abierto";

            //Cuerpo del mensaje

            $cuerpo = file_get_contents('../public/NuevoTicket.html');
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblNov", $novedad, $cuerpo);

            $this->Body =  $cuerpo;
            $this->AltBody = strip_tags("Ticket Abierto");
            return $this->Send();
        }

        public function ticket_cerrado($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach ($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["novedad"];
                $novedad = $row["div_nom"];
                $correo = $row["usu_correo"];
            }
            $this->IsSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587;
            $this->SMTPAuth = true;


            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;

            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName ="Ticket Cerrado".$id;
            $this->CharSet  = 'UTF-8';
            $this->addAddress($correo);
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Cerrado";

            //Cuerpo del mensaje

            $cuerpo = file_get_contents('../public/CerradoTicket.html');
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblNov", $novedad, $cuerpo);

            $this->Body =  $cuerpo;
            $this->AltBody = strip_tags("Ticket Cerrado");
            return $this->Send();
        
        }


        public function ticket_asignado($tick_id){
            $ticket = new Ticket();
            $datos = $ticket->listar_ticket_x_id($tick_id);
            foreach ($datos as $row){
                $id = $row["tick_id"];
                $usu = $row["usu_nom"];
                $titulo = $row["novedad"];
                $novedad = $row["div_nom"];
                $correo = $row["usu_correo"];
            }
            $this->IsSMTP();
            $this->Host = 'smtp.gmail.com';
            $this->Port = 587;
            $this->SMTPAuth = true;


            $this->Username = $this->gCorreo;
            $this->Password = $this->gContrasena;

            $this->From = $this->gCorreo;
            $this->SMTPSecure = 'tls';
            $this->FromName = "Ticket Asignado".$id;
            $this->CharSet  = 'UTF-8';
            $this->addAddress($correo);
            $this->WordWrap = 50;
            $this->IsHTML(true);
            $this->Subject = "Ticket Asignado";

            //Cuerpo del mensaje

            $cuerpo = file_get_contents('../public/AsignarTicket.html');
            $cuerpo = str_replace("xnroticket", $id, $cuerpo);
            $cuerpo = str_replace("lblNomUsu", $usu, $cuerpo);
            $cuerpo = str_replace("lblTitu", $titulo, $cuerpo);
            $cuerpo = str_replace("lblNov", $novedad, $cuerpo);

            $this->Body =  $cuerpo;
            $this->AltBody = strip_tags("Ticket Asignado");
            return $this->Send();
            }
    }
?>