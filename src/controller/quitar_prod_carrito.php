<?php 
 require_once '../model/conexion/conexion.php';            
    $msg = "";
    $id = $_POST["id"];
    $qty = $_POST["qty"];
    $cant = $qty - 1;
    if($cant > 0){
        $sentencia = 
        "UPDATE `carrito` SET `cantidad` = '$cant' WHERE `carrito`.`id` = '$id'";
        $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
        
        if ($result === true){
            mysqli_close($conn);    
            //header('Location: /POS/src/model/productos/listar_productos.php');
            $msg = "u-ok";
        }
        else {
            $msg = $result;
        }
    }else{
        $sentencia = 
        "UPDATE `carrito` SET `status` = 2, `cantidad` = 0 WHERE `carrito`.`id` = '$id'";
        $result = mysqli_query($conn, $sentencia) or die(mysqli_error($conn));    
        
        if ($result === true){
            mysqli_close($conn);    
            //header('Location: /POS/src/model/productos/listar_productos.php');
            $msg = "d-ok";
        }
        else {
            $msg = $result;
        }
    }
   

    echo $msg;


?>