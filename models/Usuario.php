<?php
class Usuario extends Conectar{

    public function login(){
        $conectar=parent::Conexion();
        parent::set_names();
        if(isset($_POST["enviar"])){
            $correo = $_POST["usu_correo"];
            $pass = $_POST["usu_pass"];
            if(empty($correo) and empty($pass)){
                header("Location:".conectar::ruta()."index.php?m=2");
                exit();
            }else{
                    $sql = "SELECT * FROM tm_usuario WHERE usu_correo = ? AND usu_pass = ? AND est=1";
                    $stmt=$conectar->prepare($sql);
                    $stmt->bindvalue(1, $correo);
                    $stmt->bindvalue(2, $pass);
                    $stmt->execute();
                    $resultado = $stmt->fetch();
                    if(is_array($resultado) and count($resultado)>0){
                        $_SESSION["usu_id"]=$resultado["usu_id"];
                        $_SESSION["usu_nom"]=$resultado["usu_nom"];
                        $_SESSION["usu_ape"]=$resultado["usu_ape"];
                        header("Location:".Conectar::ruta()."view/Home/");
                        exit();
                    }else{
                        header("Location:".Conectar::ruta()."index.php?m=1");
                        exit();
                    }
                }
            }
        }

        public function insert_usuario($usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="INSERT INTO tm_usuario (usu_id, usu_nom, usu_ape, usu_correo, usu_pass, rol_id, fech_crea, fech_modi, fech_elim, est) VALUES (NULL,?,?,?,MD5(?),?,NOW(),NULL,NULL,'1');";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_usuario($usu_id,$usu_nom,$usu_ape,$usu_correo,$usu_pass,$rol_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="UPDATE tm_usuario SET usu_nom=?, usu_ape=?, usu_correo=?, usu_pass=MD5(?), rol_id = ? WHERE usu_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_nom);
            $sql->bindValue(2, $usu_ape);
            $sql->bindValue(3, $usu_correo);
            $sql->bindValue(4, $usu_pass);
            $sql->bindValue(5, $rol_id);
            $sql->bindValue(6, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function delete_usuario($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="call sp_d_usuario_01(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_01()";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_rol(){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT * FROM tm_usuario WHERE rol_id=2 AND est=1;";
            $sql=$conectar->prepare($sql);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_x_id($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="call sp_l_usuario_02(?)";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_total_x_id($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ?";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalabierto_x_id($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ? AND tick_estado = 'Abierto'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_totalcerrado_x_id($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT COUNT (*) as total FROM tm_ticket WHERE usu_id = ? AND tick_estado = 'Cerrado'";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function get_usuario_grafico($usu_id){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tm_division.div_nom, COUNT(*) AS total FROM tm_ticket JOIN tm_division ON tm_ticket.div_id = tm_division.div_id WHERE tm_ticket.est = 1 AND tm_ticket.usu_id = ? GROUP BY tm_division.div_nom; ORDER BY total DESC";  
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }

        public function update_usuario_pass($usu_id, $usu_pass){
            $conectar=parent::conexion();
            parent::set_names();
            $sql="SELECT tm_usuario SET usu_pass=MD5(?) WHERE usu_id=?;";
            $sql=$conectar->prepare($sql);
            $sql->bindValue(1, $usu_pass);
            $sql->bindValue(2, $usu_id);
            $sql->execute();
            return $resultado=$sql->fetchAll();
        }
    }
?>

