<?php 
require_once '../model/conexion/conexion.php';            
    $msg = "";
    $codigo = $_POST["codigo"];
    $nombre = $_POST["nombre"];
    $precioVenta = $_POST["precioVenta"];
    $precioCompra = $_POST["precioCompra"];
    $existencia = $_POST["existencia"];
    $materia_prima = $_POST["materia_prima"];
    
    if($materia_prima > 0){
    $sentencia = "INSERT INTO productos(codigo, nombre, precio_venta, precio_compra, existencia, id_materia_prima) VALUES ('$codigo', '$nombre','$precioVenta', '$precioCompra', '$existencia', '$materia_prima')";
    
    $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
    
    if ($result === true){
        mysqli_close($conn);    
        //header('Location: /POS/src/model/productos/listar_productos.php');
        $msg = "Se han añadido los datos correctamente";
    }
    else {
        $msg = $result;
    }
}
else {
    $msg = "Seleccione un material";
}
    echo $msg;


?>
