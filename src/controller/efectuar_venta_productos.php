<?php 
 require_once '../model/conexion/conexion.php';            
$str = $_POST['descuento'];
 $descuento = floatval($str) > 0 ? floatval($str) : 0.0;
$total = floatval(substr($_POST['total'],1)) - $descuento;
$idVenta = 0;

    $result = mysqli_query ($conn,"INSERT INTO `ventas` (`total`, `descuento`) VALUES ( '$total', '$descuento')") or die(mysqli_error($conn));
    
    if($result === true){
        $res = mysqli_query ($conn,"SELECT count(*) AS tot FROM ventas") or die(mysqli_error($conn));
        foreach ($res as $val): 
            $idVenta = $val['tot'];
        endforeach;
        $resC = mysqli_query ($conn,"SELECT productos.id AS pid, carrito.id AS cid,nombre, precio_venta, cantidad
        FROM productos
        INNER JOIN carrito ON productos.id = carrito.id_producto WHERE productos.active = 1 AND carrito.status = 1") or die(mysqli_error($conn));
        foreach ($resC as $val): 
            mysqli_query ($conn, "INSERT INTO `productos_vendidos` (`id_producto`, `cantidad`, `costo_producto`, `id_venta`) VALUES ( ".$val["pid"].", ".$val['cantidad'].", ".$val['precio_venta'].", ".$idVenta.")");
            mysqli_query($conn, "DELETE FROM `carrito` WHERE `carrito`.`id` = ".$val['cid']);
        endforeach;

        mysqli_close($conn); 
        echo "ok";
    }else{
        echo "error";
    }



 
 


// echo gettype($descuento);
?>