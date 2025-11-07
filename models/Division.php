<?php
    class Division extends Conectar{

        public function get_division(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_division WHERE est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>