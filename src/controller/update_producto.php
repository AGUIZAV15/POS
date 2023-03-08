<?php 
 require_once '../model/conexion/conexion.php';            
    $msg = "";
    $id = $_POST["id"];
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $precioVenta = $_POST["precioVenta"];
    $precioCompra = $_POST["precioCompra"];
    $existencia = $_POST["existencia"];
    $materia_prima = $_POST["materia_prima"];
    $sentencia = 
    "UPDATE `productos` SET `codigo` = '$codigo', `nombre` = '$nombre', `precio_venta` = '$precioVenta', `precio_compra` = '$precioCompra', `existencia` = '$existencia', `id_materia_prima` = '$materia_prima' WHERE `productos`.`id` = '$id'";
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