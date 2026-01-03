<?php
    class Ticket extends Conectar{

        public function insert_ticket($usu_id,$id_nov,$novedad,$tick_descripcion){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_ticket (tick_id, usu_id, id_nov, novedad, tick_descripcion, tick_estado, fech_crea, usu_asig, fech_asig, est) VALUES (NULL,?,?,?,?,?,?,?,?'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->bindValue(2, $id_nov);
            $sql->bindValue(3, $novedad);
            $sql->bindValue(4, $tick_descripcion);
            $sql->execute();

            $sql1="SELECT LAST_INSERT_ID() as tick_id";
            $sql1=$conectar->prepare($sql1);
            $sql1->execute();
            return $resultado=$sql1->fetchAll(pdo::FETCH_ASSOC);
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
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig, 
                tm_usuario.usu_nom, 
                tm_usuario.usu_ap, 
                tm_division.div_nom 
                FROM 
                tm_ticket 
                INNER JOIN tm_novedades ON tm_ticket.id_nov = tm_novedades.id_nov 
                INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id 
                WHERE tm_ticket.est = 1
                AND tm_usuario.usu_id=?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function listar_ticket_x_id($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id, 
                tm_ticket.usu_id, 
                tm_ticket.id_nov, 
                tm_ticket.novedad, 
                tm_ticket.tick_descripcion,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_usuario.usu_nom, 
                tm_usuario.usu_ap,
                tm_usuario.usu_correo,
                tm_division.div_nom
                FROM
                tm_ticket
                INNER JOIN tm_novedades ON tm_ticket.id_nov = tm_novedades.id_nov 
                INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id
                WHERE tm_ticket.est = 1
                AND tm_usuario.usu_id=?";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $tick_id);
                $sql->execute();
                return $resultado=$sql->fetchAll();                
        }

        public function listar_ticket(){
            $conectar= parent::conexion();
            parent::set_names();
            $sql="SELECT
                tm_ticket.tick_id, 
                tm_ticket.usu_id, 
                tm_ticket.id_nov, 
                tm_ticket.novedad, 
                tm_ticket.tick_descripcion,
                tm_ticket.tick_estado,
                tm_ticket.fech_crea,
                tm_ticket.usu_asig,
                tm_ticket.fech_asig,
                tm_usuario.usu_nom, 
                tm_usuario.usu_ap,
                tm_division.div_nom
                FROM
                tm_ticket
                INNER JOIN tm_novedades ON tm_ticket.id_nov = tm_novedades.id_nov
                INNER JOIN tm_usuario ON tm_ticket.usu_id = tm_usuario.usu_id
                WHERE
                tm_ticket.est = 1
                ";
                $sql=$conectar->prepare($sql);
                $sql->execute();
                return $resultado=$sql->fetchAll();
        }

        public function listar_ticketdetalle_x_ticket($tick_id){
            $conectar = parent::conexion();
            parent::set_names();
            $sql="SELECT
                td_ticketdetalle.tick_id,
                td_ticketdetalle.tickd_descrip,
                td_ticketdetalle.fech_crea,
                tm_usuario.usu_nom,
                tm_usuario.usu_ape,
                tm_usuario.rol_id
                FROM
                td_ticketdetalle
                INNER JOIN tm_usuario on td_ticketdetalle.usu_id = tm_usuario.usu_id
                WHERE 
                tick_id =?";
                $sql=$conectar->prepare($sql);
                $sql->bindValue(1, $tick_id);
                $sql->execute();
                return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle($tick_id,$usu_id,$tickd_descrip){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle (tickd_id, tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (NULL,?,?,?,now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->bindValue(3, $tickd_descrip);
            $sql->execute();
        }

        public function insert_ticketdetalle_cerrar($tick_id,$usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="call sp_i_ticketdetalle_01(?,?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function insert_ticketdetalle_reabrir($tick_id,$usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO td_ticketdetalle (tickd_id, tick_id, usu_id, tickd_descrip, fech_crea, est) VALUES (NULL,?,?,'Ticket Re-Abierto...',now(),'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket($tick_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_ticket SET tick_estado='Cerrado'WHERE tick_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function reabrir_ticket($tick_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_ticket SET tick_estado='Abierto'WHERE tick_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_ticket_asignacion($tick_id,$usu_asig){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_ticket SET usu_asig=?,fech_asig=NOW() WHERE tick_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_asig);
            $sql->bindValue(2, $tick_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_total(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS total FROM tm_ticket";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalabierto(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS total FROM tm_ticket WHERE tick_estado = 'Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_totalcerrado(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT(*) AS total FROM tm_ticket WHERE tick_estado = 'Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_ticket_grafico(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT novedad, COUNT(*) AS total FROM tm_ticket JOIN tm_novedades ON tm_ticket.id_nov = tm_novedades.id_nov WHERE tm_ticket.est = 1 GROUP BY novedad ORDER BY total DESC";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
        ?>