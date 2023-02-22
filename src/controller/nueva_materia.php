<?php 
require_once '../model/conexion/conexion.php';            
    $msg = "";
    
    $nombre = $_POST["nombre"];    
    $existencia = $_POST["existencia"];
    
    $sentencia = "INSERT INTO materia_prima(nombre, cantidad) VALUES ('$nombre', '$existencia')";
    
    $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
    
    if ($result === true){
        mysqli_close($conn);    
        //header('Location: /POS/src/model/productos/listar_productos.php');
        $msg = "Se han añadido los datos correctamente";
    }
    else {
        $msg = $result;
    }

    echo $msg;


?>
