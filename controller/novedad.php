<?php
    require_once("../config/conexion.php");
    require_once("../models/Novedad.php");
    $novedad = new Novedad();

    switch($_GET["op"]){
        case "combo":

            $div_id = isset($_POST["div_id"])?$_POST["div_id"]: null;

            if ($div_id !== null && is_numeric($div_id)){
                $datos = $novedad->get_novedad($div_id);
            }else{
                $datos = [];
            }

            if(is_array($datos)==true and count($datos)>0){
                $html ="";
                foreach($datos as $row)
                {

                    $html.="<option value ='".$row['id_nov']."'>".$row['novedad']."</option>";
                    }
                    echo $html;
            }else{
                echo "<option value=''>No hay novedades para esta división</option>";
            }
            break;
    }
?>