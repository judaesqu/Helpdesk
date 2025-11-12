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
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>