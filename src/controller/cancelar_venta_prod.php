<?php 
 require_once '../model/conexion/conexion.php';            
    
               
    $result = mysqli_query ($conn,"SELECT * FROM carrito WHERE status = 1") or die(mysqli_error($conn));
    

foreach ($result as $val): 
    $res = mysqli_query($conn, "DELETE FROM `carrito` WHERE `carrito`.`id` = ".$val['id']);    
endforeach;

 
 mysqli_free_result($result);
 mysqli_close($conn); 
 echo "d-ok";
?>