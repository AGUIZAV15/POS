<?php 
require_once '../model/conexion/conexion.php';  

session_start();

$id = $_POST['id'];
$q = $_POST['qty'];


$qtyDb = 0;

$bandera = 0;

$result = mysqli_query ($conn,"SELECT * FROM carrito WHERE status = 1 AND id_producto = ".$id) or die(mysqli_error($conn));

foreach ($result as $val): 
    $bandera = $bandera+1;
    $qtyDb += $val['cantidad'];
    
endforeach;

mysqli_free_result($result); 


if($bandera > 0){    
    $suma = $qtyDb + $q;
    $result = mysqli_query ($conn,"UPDATE `carrito` SET `cantidad` = '{$suma}' WHERE `carrito`.`id_producto` = {$id}") or die(mysqli_error($conn));
    
    if ($result === true){
            mysqli_close($conn);                       
            //header('Location: /POS/src/model/productos/listar_productos.php');            
            echo "ok";
        }
        else {
            echo "error";
        }                
}else{
    
    $result = mysqli_query ($conn,"INSERT INTO `carrito` ( `id_producto`, `cantidad`) VALUES ( '{$id}', '{$q}')") or die(mysqli_error($conn));
    
    if ($result === true){
            mysqli_close($conn);             
            //header('Location: /POS/src/model/productos/listar_productos.php');
            echo "ok";
        }
        else {
            echo "error";
        }               
}

        
  

?>