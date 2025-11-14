<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$id_nov,$novedad,$tick_descripcion){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id, usu_id, id_nov, novedad, tick_descripcion, est) VALUES (NULL,?,?,?,?,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $id_nov);
            $sql->bindValue(3, $novedad);
            $sql->bindValue(4, $tick_descripcion);
            $sql->execute();
            return $conectar->lastInsertId();
        }

        public function listar_ticket_x_usu($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT 
                tm_ticket.tick_id, 
                tm_ticket.usu_id, 
                tm_ticket.id_nov, 
                tm_ticket.novedad, 
                tm_ticket.tick_descripcion, 
                tm_usuario.usu_nom, 
                tm_usuario.usu_ap, 
                tm_division.div_nom 
                FROM 
                tm_ticket 
                INNER JOIN tm_novedades ON tm_ticket.id_nov = tm_novedades.id_nov 
                INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id 
                INNER JOIN tm_division ON tm_novedades.div_id = tm_division.div_id WHERE tm_ticket.est = 1
                AND tm_usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>