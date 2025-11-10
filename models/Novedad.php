<?php
    class Novedad extends Conectar{

        public function get_novedad($div_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT id_nov, novedad,descripcion FROM tm_novedades WHERE div_id = ? ORDER BY novedad ASC";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $div_id, PDO::PARAM_INT);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>