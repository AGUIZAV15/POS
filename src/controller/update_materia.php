<?php 
 require_once '../model/conexion/conexion.php';            
    $msg = "";
    $id = $_POST["id"];    
    $nombre = $_POST["nombre"];    
    $existencia = $_POST["existencia"];
    
    $sentencia = 
    "UPDATE `materia_prima` SET `nombre` = '$nombre', `cantidad` = '$existencia' WHERE `materia_prima`.`id` = '$id'";
    $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
    
    if ($result === true){
        mysqli_close($conn);    
        //header('Location: /POS/src/model/productos/listar_productos.php');
        $msg = "Se han guardado los datos correctamente";
    }
    else {
        $msg = $result;
    }

    echo $msg;


?>